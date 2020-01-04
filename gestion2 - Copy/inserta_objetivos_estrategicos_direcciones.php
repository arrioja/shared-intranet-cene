<?php 
/*
* Este archivo inserta los registros de organizaciones en la tabla gestion_organizacion en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/
   require("../db/conexion.php");
   $link=conectarse("gestion");
   $codigo=$_POST[codigo];
   $nombre=$_POST[nombre];
   $descripcion=$_POST[descripcion];
   $plan=$_POST[plan];

//valida que no este el objetivo
 $sql="select * from gestion_obj_estrategicos_direcciones where codigo=$codigo";
 $result=mysql_query($sql,$link) or die (mysql_error());
 $cant_row=mysql_affected_rows($link);
 if ($cant_row==0){

 $sql="insert into gestion_obj_estrategicos_direcciones (codigo, nombre, descripcion, cod_plan_e_dir) value ('$codigo','$nombre', '$descripcion','$plan')";
 $result=mysql_query($sql,$link) or die (mysql_error()) ;
 }
 mysql_close($link);
// header ("location:muestra_objetivos_estrategicos_direcciones.php");

?>

