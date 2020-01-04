<?php
include "../conexion/conectar.php";
if ($_GET['activo']==1)//inserta
 $sql="insert into gestion_obje_objo_dir (cod_obj_e_dir, cod_obj_o_dir) value ('$seleccionado','$codigo')";
else
 $sql="delete from gestion_obje_objo_dir where cod_obj_e_dir = $_GET[seleccionado] and cod_obj_o_dir= $_GET[codigo]";
 $result=mysql_query($sql,$link);
 
 mysql_close($link);
 ?>