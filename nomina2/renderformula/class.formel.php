<?php
/*
*	renderformula-Class
*	Class to generate an image out of a given formula.
*
*	@author Aresch Yavari <ay@databay.de>
*	Copyright 2006 Databay AG, Aresch Yavari
*	E-Mail: ay@databay.de
*	Phone: +49 241 991210
*	License: LGPL
*/

class formel {
	var $functionNames = array("WURZEL","sin","cos","pow","ARCSIN");
	var $ttf;
	var $ttfFile;
	
	function formel() {
		// {{{
		$this->ttf = false;
		$this->ttfSize = 15;
		// }}}
	}
	
	function useTTF($ttfFile) {
		// {{{
		$this->ttf = true;
		$this->ttfFile = $ttfFile;
		// }}}
	}
	
	function parse($f) {
		// {{{
		$f = str_replace(" ","",$f);
		$i = 0;
		while($i<strlen($f)) {
			
			do {
				$c = substr($f,$i,1);
				if($c==" ") $i++;
			} while($c==" ");
			//echo $c."<br>";
			
			$functionName = "";
			
			for($j=0;$j<count($this->functionNames);$j++) {
				if(strtoupper(substr($f,$i,strlen($this->functionNames[$j]))) == strtoupper($this->functionNames[$j])) {
					$i += strlen($this->functionNames[$j]);
					$c = substr($f,$i,1);
					$functionName = strtoupper($this->functionNames[$j]);
					//echo $c."<br>";
					//exit;
				}
			}
			
			
			if($c=="+") {
				if($nr!="") $Z[] = array("type"=>"number", "value"=>$nr);
				$Z[] = array("type"=>"+", "value"=>"+");
				$nr="";
			} else if($c=="-") {
				if($nr!="") $Z[] = array("type"=>"number", "value"=>$nr);
				$Z[] = array("type"=>"-", "value"=>"-");
				$nr="";
			} else if($c=="=") {
				if($nr!="") $Z[] = array("type"=>"number", "value"=>$nr);
				$Z[] = array("type"=>"=", "value"=>"=");
				$nr="";
			} else if($c=="*") {
				if($nr!="") $Z[] = array("type"=>"number", "value"=>$nr);
				$Z[] = array("type"=>"*", "value"=>"*");
				$nr="";
			} else if($c=="/") {
				if($nr!="") $Z[] = array("type"=>"number", "value"=>$nr);
				$Z[] = array("type"=>"/", "value"=>"/");
				$nr="";
			} else if($c=="^") {
				if($nr!="") $Z[] = array("type"=>"number", "value"=>$nr);
				$Z[] = array("type"=>"^", "value"=>"^");
				$nr="";
			} else if($c=="(") {
				$klammer = 1;
				$f2 = "";
				while($i<strlen($f)) {
					$i++;
					$c = substr($f,$i,1);
					if($c=="(") $klammer++;
					if($c==")") {
						$klammer--;
						if($klammer==0) {
							//echo "<b>".$f2."</b><br>";
							$D = array("type"=>"klammer");
							if($functionName!="") $D["function"] = $functionName;
							$D["value"] = $this->parse($f2);
							$Z[] = $D;
							break;
						} else $f2 .= $c;
					} else {
						$f2 .= $c;
					}
				}
			} else {
				$nr .= $c;
			}
			
			
			$i++;
		}
		if($nr!="") $Z[] = array("type"=>"number", "value"=>$nr);
		return($Z);
		// }}}
	}
	
	function parse2($Z, $reparse=true) {
		// {{{
		$Z2 = array();
		for($i=0;$i<count($Z);$i++) {
			// {{{
			
			$wert = $Z[$i];
			if($wert["type"]=="-" || $wert["type"]=="+" || $wert["type"]=="=") {
				$vorzeichen = $wert["type"];
				$i++;
				$wert = $Z[$i];
				if($vorzeichen=="-") $wert["value"] = "-".$wert["value"];
			}
			if($wert["type"]=="klammer") {
				$wert["value"] = $this->parse2($wert["value"]);
			}
			
			if($i+1>=count($Z)) {
				$Z2[] = $wert;
				break;
			}
			if($Z[$i+1]["type"]=="+" || $Z[$i+1]["type"]=="-" || $Z[$i+1]["type"]=="=") {
				$Z2[] = $wert;
				$Z2[] = $Z[$i+1];
				$i++;
			} else if($Z[$i+1]["type"]=="^") {
				$K = array();
				$K[] = $wert;
				$i++;
				$K[] = $Z[$i];
				$i++;
				$W = $Z[$i];
				if($W["type"]=="klammer") {
					$W["value"] = $this->parse2($W["value"]);
				}
				$K[] = $W;
				$Z2[] = array("type"=>"klammer", "potenz"=>true, "value" => $K);
				
				if($i+1<count($Z)) {
					$i++;
					$Z2[] = $Z[$i]; 
				}
				
			} else if($Z[$i+1]["type"]=="*" || $Z[$i+1]["type"]=="/") {
				$K = array();
				$K[] = $wert;
				$i++;
				
				if($Z[$i]["type"]=="/") {
					// {{{
					$K[] = $Z[$i];
					$i++;
					$W = $Z[$i];
					if($W["type"]=="klammer") {
						$W["value"] = $this->parse2($W["value"]);
					}
					$K[] = $W;
					$i++;
					$K2 = array("type"=>"klammer", "division"=>true, "value" => $K );
					$K = array($K2);
					// }}}
				} 
				
				while($i<count($Z)) {
					if($Z[$i]["type"]!="+" && $Z[$i]["type"]!="-" && $Z[$i]["type"]!="=") {
						if($Z[$i]["type"]=="/") {
							
							$K2 = array($K[count($K)-1]);
							$K2[] = $Z[$i];
							$i++;
							$W = $Z[$i];
							if($W["type"]=="klammer") {
								$W["value"] = $this->parse2($W["value"]);
							}
							$K2[] = $W;
							//$K2[] = $Z[$i]; 
							$K[count($K)-1] = array("type"=>"klammer", "division"=>true, "value" => $K2 );
						} else if($Z[$i]["type"]=="^") {
							
							$K2 = array($K[count($K)-1]);
							$K2[] = $Z[$i];
							$i++;
							$W = $Z[$i];
							if($W["type"]=="klammer") {
								$W["value"] = $this->parse2($W["value"]);
							}
							$K2[] = $W;
							$K[count($K)-1] = array("type"=>"klammer", "potenz"=>true, "value" => $K2 );
						} else {
							$W = $Z[$i];
							if($W["type"]=="klammer") {
								$W["value"] = $this->parse2($W["value"]);
							}
							$K[] = $W;
						}
					} else {
						//$i-=2;
						break;
					}
					$i++;
				}
				//if($K2[0]["type"]=="klammer") $K2 = $this->parse2($K2);
				$Z2[] = array("type"=>"klammer", "auto"=>true, "value" => $K );
				if($i+1<count($Z)) $Z2[] = $Z[$i];
			}
			// }}}
		}
		
	
		return($Z2);
		// }}}
	}
	
	
	
	function drawFormel($Z, $depth=0, $Zx=array(), $fontsize=-1 ) {
		// {{{
		
		if($fontsize==-1) $fontsize = $this->ttfSize;
		// Im ersten Durchlauf nur die Klammern abarbeiten
		for($i=0;$i<count($Z);$i++) {
			// {{{
			if($Z[$i]["type"]=="klammer") {
				$fs = $fontsize;
				if($Zx["potenz"] && $i==2) $fs *= 0.8;
				$Z[$i]["img"] = $this->drawFormel($Z[$i]["value"], $depth+1, $Z[$i], $fs);
				$Z[$i]["imgWidth"] = imageSx($Z[$i]["img"]);
				$Z[$i]["imgHeight"] = imageSy($Z[$i]["img"]);
			} 
			// }}}
		}
		
		// Nun die anderen Zeichen abarbeiten
		for($i=0;$i<count($Z);$i++) {
			// {{{
			if($Z[$i]["type"]!="klammer") {
				if($this->useTTF) {
					$text_data = imagettfbbox( $fontsize, 0, $this->ttfFile, $Z[$i]["value"] );
					$posX_font = min($text_data[0], $text_data[6]) * -1;
					$posY_font = min($text_data[5], $text_data[7]) * -1;
					$height = max($text_data[1], $text_data[3]) - min($text_data[5], $text_data[7])+2;
					$width = max($text_data[2], $text_data[4]) - min($text_data[0], $text_data[6])+2;			
					
					$Z[$i]["img"] = imageCreate( $width, $height );
					$white = imageColorAllocate($Z[$i]["img"], 255,255,255);
					$col = imageColorAllocate($Z[$i]["img"], 0,0,0);
					$fs = $fontsize;
					if($Zx["potenz"] && $i==2) $fs *= 0.8;
					imagettftext( $Z[$i]["img"], $fs, 0, $posX_font, $posY_font, $col, $this->ttfFile, $Z[$i]["value"] );
				} else {
					$width = strlen($Z[$i]["value"])*10;
					$height = 15;
					$Z[$i]["img"] = imageCreate( $width, $height );
					$white = imageColorAllocate($Z[$i]["img"], 255,255,255);
					$col = imageColorAllocate($Z[$i]["img"], 0,0,0);
					imagestring($Z[$i]["img"], 2,2,2,$Z[$i]["value"], $col);
				}
				
				$Z[$i]["imgWidth"] = imageSx($Z[$i]["img"]);
				$Z[$i]["imgHeight"] = imageSy($Z[$i]["img"]);
				
			} 
			// }}}
		}
		
		if($Zx["potenz"]) {
			$maxHeight = $Z[0]["imgHeight"] + ($Z[2]["imgHeight"]*0.8)+10;
			$maxWidth = $Z[0]["imgWidth"] + $Z[2]["imgWidth"]+10;
			$im = imageCreate($maxWidth, $maxHeight);
			$white = imageColorAllocate($im, 255,255,255);
			$col = imageColorAllocate($im, 0,0,0);
			
			$x = 0;
			$y = 0;
			imageCopy($im, $Z[0]["img"], 2, $maxHeight-$Z[0]["imgHeight"]-2 , 0,0, $Z[0]["imgWidth"], $Z[0]["imgHeight"]);
			$x += $Z[0]["imgWidth"]+5;
			$y += $Z[0]["imgHeight"]+5;
			imageCopy($im, $Z[2]["img"], $maxWidth-$Z[2]["imgWidth"]-2,2, 0,0, $Z[2]["imgWidth"], $Z[2]["imgHeight"]);
			
			
		} else if($Zx["division"]) {
			// {{{
			$maxWidth=0;
			for($i=0;$i<count($Z);$i++) {
				if($Z[$i]["imgWidth"] > $maxWidth) $maxWidth = $Z[$i]["imgWidth"];
			}
			$maxWidth += 10;
			$im = imageCreate($maxWidth, $Z[0]["imgHeight"] + $Z[2]["imgHeight"]+10);
			$white = imageColorAllocate($im, 255,255,255);
			$col = imageColorAllocate($im, 0,0,0);
			
			$y = 0;
			imageCopy($im, $Z[0]["img"], $maxWidth/2-$Z[0]["imgWidth"]/2,0 , 0,0, $Z[0]["imgWidth"], $Z[0]["imgHeight"]);
			$y += $Z[0]["imgHeight"]+5;
			imageCopy($im, $Z[2]["img"], $maxWidth/2-$Z[2]["imgWidth"]/2,$y , 0,0, $Z[2]["imgWidth"], $Z[2]["imgHeight"]);
			
			imageLine($im, 2,$y-2, $maxWidth-2, $y-2, $col );
			// }}}
		} else {
			// {{{
			$maxHeight=0;
			$sumWidth = 0;
			for($i=0;$i<count($Z);$i++) {
				$sumWidth += $Z[$i]["imgWidth"];
				if($Z[$i]["imgHeight"] > $maxHeight) $maxHeight = $Z[$i]["imgHeight"];
			}
			$maxHeight+=6;
			
			
			$x=5;
			$addWidth=10;
			
			if($Zx["function"]=="WURZEL") {
				$addWidth += 10;
			} else if($Zx["function"]!="") {
				
				if($this->useTTF) {
					$text_data = imagettfbbox( $this->ttfSize, 0, $this->ttfFile, $Zx["function"] );
					$posX_font = min($text_data[0], $text_data[6]) * -1;
					$posY_font = min($text_data[5], $text_data[7]) * -1;
					$height = max($text_data[1], $text_data[3]) - min($text_data[5], $text_data[7]);
					$width = max($text_data[2], $text_data[4]) - min($text_data[0], $text_data[6]) + 4;			
					
					$funcImg = imageCreate( $width, $height );
					$white = imageColorAllocate($funcImg, 255,255,255);
					$col = imageColorAllocate($funcImg, 0,0,0);
					imagettftext( $funcImg, $this->ttfSize, 0, $posX_font, $posY_font, $col, $this->ttfFile, $Zx["function"] );
					
				
				} else {
					$width = strlen($Zx["function"])*10;
					$height = 15;
					$funcImg = imageCreate( $width, $height );
					$white = imageColorAllocate($funcImg, 255,255,255);
					$col = imageColorAllocate($funcImg, 0,0,0);
					imagestring($funcImg, 2,2,2,$Zx["function"], $col);
				}
				
				$x=2;
				$addWidth += $width;
			}
	
			$im = imageCreate($sumWidth+$addWidth, $maxHeight);
			$white = imageColorAllocate($im, 255,255,255);
			$col = imageColorAllocate($im, 0,0,0);
			
			if($Zx["function"]=="WURZEL") {
				$x += 10;
			} else if($Zx["function"]!="") {
				imageCopy($im, $funcImg, $x, $maxHeight/2-$height/2, 0,0, $width, $height);
				$x += $width;
			}
			if( ($depth>0 || $Zx["function"]!="") && $Zx["function"]!="WURZEL" && ($Z[0]["type"]!="klammer" || count($Z[0]["value"])>1) ) imageArc($im, $x+4-5,$maxHeight/2, 8, $maxHeight-2, 90,270, $col);
			for($i=0;$i<count($Z);$i++) {
				// {{{
				imageCopy($im, $Z[$i]["img"], $x, $maxHeight/2-$Z[$i]["imgHeight"]/2, 0,0, $Z[$i]["imgWidth"], $Z[$i]["imgHeight"]);
				$x += $Z[$i]["imgWidth"];
				// }}}
			}
			if( ($depth>0 || $Zx["function"]!="") && $Zx["function"]!="WURZEL" && ($Z[0]["type"]!="klammer" || count($Z[0]["value"])>1) ) imageArc($im, $x+1,$maxHeight/2, 8, $maxHeight-2, 270,90, $col);
			
			if($Zx["function"]=="WURZEL") {
				imageLine($im, 1, $maxHeight/3,5, $maxHeight/3, $col );
				imageLine($im, 5, $maxHeight/3,8, $maxHeight-2, $col );
				imageLine($im, 8, $maxHeight-2, 11, 1, $col );
				imageLine($im, 11,0 , $sumWidth+$addWidth, 0, $col );
				imageLine($im, $sumWidth+$addWidth-1, 0,$sumWidth+$addWidth-1, 4, $col );
			}
			
			// }}}
		}
		
		return($im);
		
		// }}}
	}
	
	function getImage($f) {
		// {{{
		$Z = $this->parse($f);
		$Z2 = $this->parse2($Z);
		$im = $this->drawFormel($Z2);
		return($im);
		// }}}
	}
}
?>
