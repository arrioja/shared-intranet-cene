<?php
include "../db/conexion.php";
$link=conectarse("gestion");
$cod=$_GET['seleccionado'];

 $sql="UPDATE gestion_obj_estrategicos_direcciones set nombre='$nombre', descripcion='$descripcion' where codigo=$cod";
 if ($result=mysql_query($sql,$link));
 {
 echo "<script language='javascript'> alert (\"Los datos han sido modificados correctamente\"); 
	location.href='admin_objetivos_estrategicos_direcciones.php';";
    echo "</script>";
 }
 ?>