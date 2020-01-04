<?php
include_once("definition.php"); /* auto-ajax definition */
global $ajax; /* Important, always do this, because this page will be include */
$ajax->destiny("central"); /* the ajax destination of this page */
$ajax->start();//the page start here

?>
<h2>Welcome to the test of AutoAjax.</h2>
<p>Here you can surfer well with ajax brower and with old browser.</p>
<p>To simulate old browser with mozilla do &quot;control + click&quot; on links. </p>
<?php
$ajax->end(); //and ends here
?>