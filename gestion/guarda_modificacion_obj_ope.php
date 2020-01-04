<?php
require("../db/conexion.php");
$link=conectarse("gestion");
$cod=$_POST['codigo'];
 $sql="UPDATE gestion.gestion_obj_operativos set nombre='$_POST[nombre]', descripcion='$_POST[descripcion]' where codigo='$cod'";
 if ($result=mysql_query($sql,$link))
 {
 echo "<script language='javascript'> alert (\"Los datos han sido modificados correctamente\"); 
	location.href='admin_objetivos_operativos.php';";
    echo "</script>";
 }
 else
 echo mysql_error($link);
 ?>