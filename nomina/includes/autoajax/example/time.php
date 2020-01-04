<?php
include_once("definition.php"); /* auto-ajax definition */
global $ajax; /* Important, always do this, because this page will be include */
$ajax->destiny("bottom"); /* the ajax destination of this page */
$ajax->start();//the page start here

?>
Right now is <?=date("Y/m/d H:i:s");?>
<?php
$ajax->end();
?>