<?php
include("libreria.phtml");
$link=conectarse("nomina");
$id=$_GET['id'];
$sql=mysql_query("select * from constantes where cod = '$id'",$link);
$row = mysql_fetch_array($sql);
$cod=$row['cod'];
$desc=$row['descripcion'];
$tipo=$row['tipo'];
$abreviatura=$row['abreviatura']; 
$fecha=cambiaf_a_normal($row['fecha']);  
header("Location: ../editar_constantes.php?cod=$cod&desc=$desc&tipo=$tipo&abreviatura=$abreviatura&fecha=$fecha");
?>