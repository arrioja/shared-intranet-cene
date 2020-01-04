<?php
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['id'];
mysql_query("delete from integrantes  where cedula = '$id'",$link);   
header("Location: ../integrantes.php");
?>