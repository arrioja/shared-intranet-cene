<?php
 require("../db/conexion.php");
 $link=conectarse("gestion");
 $cod=$_GET['seleccionado'];
//echo ($cod);
 $nombre=$_POST['nombre'];
 $descripcion=$_POST['descripcion'];
 
 $sql="UPDATE gestion_obj_estrategicos set nombre='$nombre', descripcion='$descripcion' where codigo=$cod";
 if ($result=mysql_query($sql,$link));
 {
 echo "<script language='javascript'>
	location.href='admin_objetivos_estrategicos.php';";
    echo "</script>";
 }

 ?>