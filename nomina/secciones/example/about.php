<?php
include_once("definition.php"); /* auto-ajax definition */
global $ajax; /* Important, always do this, because this page will be include */
$ajax->destiny("central"); /* the ajax destination of this page */
$ajax->start();//the page start here
?>
<form id="form1" name="form1" method="post" action="">
  <input type="text" name="cedula" id="cedula" />
</form>
