<?php
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['id'];
$sql=mysql_query("select * from conceptos where cod = '$id'",$link);
$row = mysql_fetch_array($sql);
$cod=$row['cod'];
$desc=$row['descripcion'];
$tipo=$row['tipo'];
$formula=$row['formula'];
$general=$row['general'];
$frecuencia=$row['frecuencia'];  
header("Location: ../editar_conceptos.php?cod=$cod&desc=$desc&tipo=$tipo&formula=$formula&general=$general&frecuencia=$frecuencia");
?>