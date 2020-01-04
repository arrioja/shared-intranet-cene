<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="lib/style.css" rel="stylesheet" type="text/css" media="screen" />
<script language="javascript" type="text/javascript" src="progressBar/lib/prototype.js"></script>
<script language="javascript" type="text/javascript" src="progressBar/lib/progress.js"></script>
<title>Untitled Document</title>
</head>

<body>
<div style="width:540px;margin : 0 auto; text-align:left;" >

<div id="demo">
<span style="color:#006600;font-weight:bold;">Program Efficiency</span> <br/>
<script>display ('element1',15,1);</script>
<span class="extra"><a href="#" onClick="emptyProgress ('element1');return false;"><img src="progressBar/empty.gif" onMouseOver="$('Text1').innerHTML ='Empty Bar'"/></a></span>
<span class="options"><a href="#" onClick="plus ('element1','5');return false;"><img src="progressBar/add.gif" onMouseOver="$('Text1').innerHTML ='Add 5%'"/></a></span>
<span class="options"><a href="#" onClick="minus ('element1','5');return false;"><img src="progressBar/minus.gif" onMouseOver="$('Text1').innerHTML ='Minus 5%'" /></a></span>
<span class="options"><a href="#" onClick="setProgress ('element1','15');return false;"><img src="progressBar/set.gif" onMouseOver="$('Text1').innerHTML ='Set 15%'"/></a></span>
<span class="options"><a href="#" onClick="fillProgress ('element1','100');return false;"><img src="progressBar/fill.gif" onMouseOver="$('Text1').innerHTML ='Fill 100%'" ></a></span>
<span class="getOption"><a href="#" onClick="alert(getProgress ('element1'));return false;"><img src="progressBar/get.gif" onMouseOver="$('Text1').innerHTML ='Get Current %'"/></a></span>
<span id="Text1" style="font-weight:bold">Select Options</span>
<br/>
<br/>


<span style="color:#FFCC00;font-weight:bold;">Website Projects Progress</span> <br/>
<script>display ('element2',35,2);</script>
<span class="extra"><a href="#" onClick="emptyProgress ('element2');return false;"><img src="progressBar/empty.gif" onMouseOver="$('Text2').innerHTML ='Empty Bar'"/></a></span>
<span class="options"><a href="#" onClick="plus ('element2','10');return false;"><img src="progressBar/add.gif" onMouseOver="$('Text2').innerHTML ='Add 10%'"/></a></span>
<span class="options"><a href="#" onClick="minus ('element2','5');return false;"><img src="progressBar/minus.gif" onMouseOver="$('Text2').innerHTML ='Minus 5%'" /></a></span>
<span class="options"><a href="#" onClick="setProgress ('element2','35');return false;"><img src="progressBar/set.gif" onMouseOver="$('Text2').innerHTML ='Set 35%'"/></a></span>
<span class="options"><a href="#" onClick="fillProgress ('element2','80');return false;"><img src="progressBar/fill.gif" onMouseOver="$('Text2').innerHTML ='Fill 80%'" ></a></span>
<span class="getOption"><a href="#" onClick="alert(getProgress ('element2'));return false;"><img src="progressBar/get.gif" onMouseOver="$('Text2').innerHTML ='Get Current %'"/></a></span>
<span id="Text2" style="font-weight:bold">Select Options</span>
<br/>
<br/>

<span style="color:#FF6600;font-weight:bold;">Weight Lost Progress</span> <br/>
<script>display ('element3',50,3);</script>
<span class="extra"><a href="#" onClick="emptyProgress ('element3');return false;"><img src="progressBar/empty.gif" onMouseOver="$('Text3').innerHTML ='Empty Bar'"/></a></span>
<span class="options"><a href="#" onClick="plus ('element3','25');return false;"><img src="progressBar/add.gif" onMouseOver="$('Text3').innerHTML ='Add 25%'"/></a></span>
<span class="options"><a href="#" onClick="minus ('element3','15');return false;"><img src="progressBar/minus.gif" onMouseOver="$('Text3').innerHTML ='Minus 15%'" /></a></span>
<span class="options"><a href="#" onClick="setProgress ('element3','50');return false;"><img src="progressBar/set.gif" onMouseOver="$('Text3').innerHTML ='Set 50%'"/></a></span>
<span class="options"><a href="#" onClick="fillProgress ('element3','65');return false;"><img src="progressBar/fill.gif" onMouseOver="$('Text3').innerHTML ='Fill 65%'" ></a></span>
<span class="getOption"><a href="#" onClick="alert(getProgress ('element3'));return false;"><img src="progressBar/get.gif" onMouseOver="$('Text3').innerHTML ='Get Current %'"/></a></span>
<span id="Text3" style="font-weight:bold">Select Options</span>
<br/>
<br/>

<span style="color:#CC3300;font-weight:bold;">Upload Progress Bar</span> <br/>
<script>display ('element4',80,4);</script>
<span class="extra"><a href="#" onClick="emptyProgress ('element4');return false;"><img src="progressBar/empty.gif" onMouseOver="$('Text4').innerHTML ='Empty Bar'"/></a></span>
<span class="options"><a href="#" onClick="plus ('element4','45');return false;"><img src="progressBar/add.gif" onMouseOver="$('Text4').innerHTML ='Add 45%'"/></a></span>
<span class="options"><a href="#" onClick="minus ('element4','30');return false;"><img src="progressBar/minus.gif" onMouseOver="$('Text4').innerHTML ='Minus 30%'" /></a></span>
<span class="options"><a href="#" onClick="setProgress ('element4','80');return false;"><img src="progressBar/set.gif" onMouseOver="$('Text4').innerHTML ='Set 80%'"/></a></span>
<span class="options"><a href="#" onClick="fillProgress ('element4','50');return false;"><img src="progressBar/fill.gif" onMouseOver="$('Text4').innerHTML ='Fill 50%'" ></a></span>
<span class="getOption"><a href="#" onClick="alert(getProgress ('element4'));return false;"><img src="progressBar/get.gif" onMouseOver="$('Text4').innerHTML ='Get Current %'"/></a></span>
<span id="Text4" style="font-weight:bold">Select Options</span>
<br/>
<br/>

</div>

<h1>Documentation</h1>
<div class="document">
<h2>display(elementId, percentage, colorCode)</h2>
<h3>Display the Percentage Bar</h3>
<h3>int colorCode: 1 = Green</h3>
<h3>int colorCode: 2 = Yellow</h3>
<h3>int colorCode: 3 = Orange</h3>
<h3>int colorCode: 4 = Red</h3>
</div>

<div class="document">
<h2>emptyProgress(elementId)</h2>
<h3>Empty the Percentage Bar by setting 0%</h3>
</div>

<div class="document">
<h2>plus(elementId, percentage)</h2>
<h3>Increment the Percentage Bar by the specified percentage</h3>
</div>

<div class="document">
<h2>minus(elementId, percentage)</h2>
<h3>Decrement the Percentage Bar by the specified percentage</h3>
</div>

<div class="document">
<h2>setProgress(elementId, percentage)</h2>
<h3>Set the Percentage Bar with the specified percentage</h3>
</div>

<div class="document">
<h2>fillProgress(elementId, percentage)</h2>
<h3>Fill up the Percentage Bar with the specified percentage</h3>
</div>



<h1>&nbsp;</h1>
<div class="content"></div>

</div>
</body>
</html>
