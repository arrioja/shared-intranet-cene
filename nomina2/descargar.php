<?php
    $f = $_GET["f"];
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$f\"\n");
    $fp=fopen("$f", "r");
    fpassthru($fp);
?>