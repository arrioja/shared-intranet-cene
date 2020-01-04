<?php 
/*
* Este archivo inserta los registros de organizaciones en la tabla gestion_organizacion en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/?>
<?php
include "../db/conexion.php";
$link=conectarse("gestion");
$cod=$_GET['seleccionado'];
if (isset($insertar))
 {
 $sql="UPDATE gestion_organizacion set nombre='$nombre', mision='$mision', vision='$vision' where codigo=$cod";
 if ($result=mysql_query($sql,$link));
 {
 echo "<script language='javascript'> alert (\"Los datos han sido modificados correctamente\"); 
	location.href='muestra_organizacion.php';";
    echo "</script>";
 }
 }
 ?>