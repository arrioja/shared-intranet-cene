<?php
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['id'];
mysql_query("update integrantes set status='0'  where cedula = '$id'",$link);   
header("Location: ../integrantes.php");
?>