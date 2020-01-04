<?php
include "../db/conexion.php";
$link=conectarse("gestion");
if ($_GET['activo']==1)//inserta
 $sql="insert into gestion_plan_e_o_dir (cod_plan_e_dir, cod_plan_o_dir) value ('$seleccionado','$codigo')";
else
 $sql="delete from gestion_plan_e_o_dir where cod_plan_e_dir = $_GET[seleccionado] and cod_plan_o_dir= $_GET[codigo]";
 
 $result=mysql_query($sql,$link);
  mysql_close($link); 
  
  /*
  include "conectar.php";
 $result=mysql_query("SELECT * FROM gestion_planes_estrategicos_direcciones AS a inner join gestion_plan_e_o_dir AS b on a.codigo=b.cod_plan_e_dir WHERE a.cod_direccion=$_GET[seleccionado] and  b.cod_plan_o_dir=$_GET[codigo]",$link) or die(mysql_error);
 
 $cant_rows=mysql_affected_rows($link);
 if ($cant_rows==0)
 {
 $sql="delete from gestion_planes_operativos where codigo ='$codigo'";
 $result=mysql_query($sql,$link);
 }
 mysql_close($link); 
 //header ("location:select_plan_operativo.php?seleccionado=$_GET[seleccionado]&codigo=$_GET[codigo]");
*/
?>