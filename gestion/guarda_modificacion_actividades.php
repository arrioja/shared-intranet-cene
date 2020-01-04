<?php 
/*
* Este archivo inserta los registros de organizaciones en la tabla gestion_organizacion en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/
	include "../db/conexion.php";
	include "../libs/utilidades.php";
   $link=conectarse("gestion");
$cod=$_GET['seleccionado'];

 $fecha=cambiaf_a_mysql($_POST['fecha_inicio']);
 $sql="UPDATE gestion_actividades set nombre='$_POST[nombre]', fecha_inicio='$fecha', duracion='$_POST[duracion]' where id=$cod";
 if ($result=mysql_query($sql,$link));
 { echo 'si';
 echo "<script language='javascript'> alert (\"Los datos han sido modificados correctamente\"); 
	location.href='admin_actividades.php';";
    echo "</script>";
 }
 ?>