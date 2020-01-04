<?php 
/*
* Este archivo inserta los registros de organizaciones en la tabla gestion_organizacion en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/?>
<?php
include "../conexion/conectar.php";
if (isset($insertar))
 {
//valida que no este el objetivo
 $sql="select * from gestion_organizacion where codigo='$codigo'";
  $result=mysql_query($sql,$link);
 $cant_row=mysql_affected_rows($link);
 if ($cant_row==0)
 {
 $sql="insert into gestion_organizacion(codigo, nombre, mision, vision) value ('$codigo','$nombre', '$mision', '$vision')";
 if ($result=mysql_query($sql,$link));
 {
 echo "<script language='javascript'> alert (\"Los datos han sido almacenados correctamente\"); 
	location.href='muestra_organizacion.php';";
    echo "</script>";
 }
 }
 else 
 echo "<script language='javascript'>  alert('El Codigo ya Existe');location.href='organizacion.php';</script>";
 }
 ?>


