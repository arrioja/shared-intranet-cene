<?php
include_once("definition.php"); /* auto-ajax definition */
global $ajax; /* Important, always do this, because this page will be include */
$ajax->add("central","welcome.php");
$ajax->add("bottom","time.php");
?><html>
<head>
	<title>Testing Auto-Ajax</title>
	<?php $ajax->printjs() ?>
</head>
<body>
<form action="prueba.php" method="post" name="form1" target="_blank">
  <table width="100%">
    <tr>
      <td colspan="2" align="center"><h1>Testing AutoAjax</h1></td>
    </tr>
    <tr>
      <td width="12%" valign="top"><a href="welcome.php">Home</a><br />
          <a href="about.php">About</a>
          <input type="text" name="nombre" id="nombre">
          <br />
          <a href="copyleft.php">Copyleft</a><br />
        <a href="time.php">Refresh time</a> <a href="normal-request.php" rel="no-ajax">Normal request</a> </td>
      <td width="88%"><?php
		//Printing Ajax section
		$ajax->AjaxSection("central");
	?>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><?php
		//Printing Ajax section
		$ajax->AjaxSection("bottom");
	?>
        <input type="submit" name="post" id="post" value="Submit"></td>
    </tr>
  </table>
</form>
</body>
</html>