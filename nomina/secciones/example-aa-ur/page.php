<?php
global $ajax; /* Important, always do this, because this page will be include */
$ajax->destiny("central"); /* the ajax destination of this page */
$ajax->start();//the page start here
?><p>Params</p>
<p><pre><?php print_r($urlVars); ?></pre></p>
<p align="center">Do not match</p>
<?php
$ajax->end();
?>