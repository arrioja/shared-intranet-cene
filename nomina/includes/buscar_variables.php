<?php
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['id'];
$sql=mysql_query("select * from variables where cod = '$id'",$link);
$row = mysql_fetch_array($sql);
$cod=$row['cod'];
$desc=$row['descripcion'];
$valor=$row['valor'];
$abreviatura=$row['abreviatura'];   
header("Location: ../editar_variables.php?cod=$cod&desc=$desc&valor=$valor&abreviatura=$abreviatura");
?>