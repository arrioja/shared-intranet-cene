<?php 
/*
* Este archivo inserta los registros de planes estratégicos en la tabla gestion_planes_estratégicos en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*/
   include ("../db/conexion.php");
   $link=conectarse("gestion");
   
   $codigo=$_POST['codigo'];
   $nombre=$_POST['nombre'];
   $aqo_inicio=$_POST['aqo_inicio'];
   $aqo_fin=$_POST['aqo_fin'];
   $select=$_POST['select'];
//valida que no este el objetivo

 $sql="select * from gestion_planes_estrategicos where codigo='$codigo'";
 $result=mysql_query($sql,$link);
 $cant_row=mysql_affected_rows($link);
 if ($cant_row==0)
  {
    $sql="insert into gestion_planes_estrategicos (codigo, nombre, aqo_inicio, aqo_fin, codigo_organizacion) value ('$codigo','$nombre',
	     '$aqo_inicio', '$aqo_fin', '$select')";
    if ($result=mysql_query($sql,$link)or die(mysql_error()));
     {
       header ("Location: admin_plan_estrategico.php", true); 
     }
   }
 else 
   echo "<script language='javascript'>  alert('El Codigo ya Existe');location.href='planes_estrategicos.php';</script>";

 ?>
