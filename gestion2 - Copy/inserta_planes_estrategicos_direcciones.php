<?php

   require("../db/conexion.php");
   $link=conectarse("gestion");
if (isset($_POST['insertar']))
 {
 $codigo=$_POST['codigo'];
 $nombre=$_POST['nombre'];
 $aqo_inicio=$_POST['aqo_inicio'];
 $aqo_fin=$_POST['aqo_fin'];
 $direccion=$_POST['direccion'];
//valida que no este el objetivo
 $sql="select * from gestion_planes_estrategicos_direcciones where codigo='$codigo'";
 $result=mysql_query($sql,$link);
 $cant_row=mysql_affected_rows($link);
 if ($cant_row==0)
 {
 $sql="insert into gestion_planes_estrategicos_direcciones (codigo, nombre, aqo_inicio, aqo_fin, cod_direccion) value ('$codigo','$nombre', '$aqo_inicio', '$aqo_fin', '$direccion')";
 ($result=mysql_query($sql,$link));
 }
 }
 ?>

 








