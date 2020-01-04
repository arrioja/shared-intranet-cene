<?php 
/*
* Este archivo inserta los registros de objetivos estratégicos en la tabla gestion_obj_estrategicos en la base de datos 
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/?>

<?php
   require("../db/conexion.php");
   $link=conectarse("gestion");
 $codigo=$_POST['codigo'];
//valida que no este el objetivo
 $sql="select * from gestion_obj_estrategicos where codigo='$codigo'";
 $result=mysql_query($sql,$link) or die(mysql_error());
 $cant_row=mysql_affected_rows($link);
 if ($cant_row==0){

 $nombre=$_POST['nombre'];
 $descripcion=$_POST['descripcion'];
 $plan=$_POST['plan'];
$sql="insert into gestion_obj_estrategicos (codigo, nombre, descripcion, codigo_plan_estrategico,completados,tiempo_ejecucion) value ('$codigo','$nombre', '$descripcion', '$plan','0','0')";

 if ($result=mysql_query($sql,$link) or die (mysql_error()));
 {
 echo "<script language='javascript'> 
	location.href='admin_objetivos_estrategicos.php';";
    echo "</script>";
 }
 }
 else 
 echo "<script language='javascript'>  alert('El Codigo ya Existe');location.href='objetivos_estrategicos.php';</script>";
 
  ?>


