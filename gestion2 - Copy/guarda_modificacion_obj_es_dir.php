<?php
include "../conexion/conectar.php";
$cod=$_GET['seleccionado'];
//echo ($cod);
if (isset($insertar))
 {
 $sql="UPDATE gestion_obj_estrategicos_direcciones set nombre='$nombre', descripcion='$descripcion' where codigo=$cod";
 if ($result=mysql_query($sql,$link));
 {
 echo "<script language='javascript'> alert (\"Los datos han sido modificados correctamente\"); 
	location.href='admin_objetivos_estrategicos_direcciones.php';";
    echo "</script>";
 }
 }
 ?>