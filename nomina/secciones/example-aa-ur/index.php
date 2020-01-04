<html>
<head>
<title>Test</title>
<?php
include_once("definition.php");
	global $ajax;
?>
<?php $ajax->printjs() ?>
</head>
<body>
<h1 align="center">Welcome to URL Rewriter </h1>
<h1 align="center">and Auto Ajax test</h1>
<p align="center">Matching URLs</p>
<hr />
<center>
<a href="/Paraguay/">Paraguay</a><br />
<a href="/Argentina/index.html">Argentina</a><br />
<a href="/Brasil/index.html">Brasil</a><br />
<a href="/string-1-site-2.html">Something</a><br />
</center>
<hr />
This page is downloaded by ajax.
<?php
	//Printing Ajax section
	$ajax->AjaxSection("central");
?>
<hr />
<center>
<a href="/china/">china</a><br />
<a href="/chile/index.html">chile</a><br />
<a href="/foo-foo-56456465.html">Something</a><br />
</center>
<hr />
</body>
</html>