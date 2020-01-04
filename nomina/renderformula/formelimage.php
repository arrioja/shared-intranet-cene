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
?>
<html>
<body>

<?php
if($_POST["formelstring"]!="") {
	include("class.formel.php");
	$FP = new formel();
	
	/*
	// Aktivate this to use TTF-Font.
	// copy a fontfile like arial.ttf in this directory.
	$FP->useTTF(dirname(__FILE__)."/arial.ttf");
	$FP->ttfSize=15;
	*/
	
	$im  = $FP->getImage($_POST["formelstring"]); 
	imagePng($im, "formel.png");
	
	echo "<script>parent.document.getElementById('image').src='formel.png?x=".time()."';</script>";
	
	exit;
}
?>

<?php
if($_POST["formelstring"]=="") $_POST["formelstring"] = "x=WURZEL(1+2/3)/(1+2)";
?>

<h2>render formula</h2>

<form method="post" target="formelimage" name="formel">
formula: <input type="text" size=80 name="formelstring" value="<?php echo $_POST["formelstring"];?>" onKeyUp="sendFormel();">
</form> 

<p>
<img src="formel.png?x=<?php echo time();?>" id="image">
</p>
<hr size=1>
Use: + - * / () and WURZEL() for square root.<br>
e.g.: 1+2-3/5 or c=WURZEL(a^2+b^2)
<hr size=1>
<p>
<b>to use this class call:</b>
<pre>
&lt;?php
include("class.formel.php");
$FP = new formel();
$formulaString = "a=1+2*3/4-WURZEL(123/987)";
$im  = $FP->getImage($formulaString); 
imagePng($im, "formel.png");
?&gt;
</pre>
<p>
<b>To use ttf-fonts use:</b>
<pre>
&lt;?php
include("class.formel.php");
$FP = new formel();
$FP->useTTF(dirname(__FILE__)."/arial.ttf");
$FP->ttfSize=15;
$formulaString = "a=1+2*3/4-WURZEL(123/987)";
$im  = $FP->getImage($formulaString); 
imagePng($im, "formel.png");
?&gt;
</pre>

</p>
<hr size=1>
&copy; 2006 Databay AG, Aresch Yavari

<script>
var sendCount=0;
function doSend() {
	// {{{
	if(sendCount>0) {
		sendCount--;
		if(sendCount==0) {
			document.formel.submit();
			sendCount=0;
		}
	}
	setTimeout("doSend()", 100);
	// }}}
}
setTimeout("doSend()", 100);

function sendFormel() {
	// {{{
	sendCount=5;
	// }}}
}
</script>

<iframe src="about:blank" width=1 height=1 border=0 frameborder=0 name="formelimage"></iframe>

</body>
</html>