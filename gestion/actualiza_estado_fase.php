<?php 	
include "../db/conexion.php";
$link=conectarse("gestion");
include "../libs/utilidades.php";

$estado=$_POST['estado'];
$id=$_POST['id'];
$fecha_actualizacion=$_POST['fecha'];

$fecha_final=cambiaf_a_mysql($fecha_actualizacion); 

/////////////////////////////FASES///////////////////////////////////////////////////
$data=mysql_query("select * from gestion.gestion_fases where id='$id'",$link) or die(mysql_error());
$fase=mysql_fetch_array($data);
$fecha_ini=$fase['fecha_inicio'];
$fecha_act=$fase['fecha_actualizacion'];
$duracion=$fase['duracion'];

$fecha_inicial=cambiaf_a_normal($fecha_ini);
echo "FI:".$fecha_inicial;

//$porcentaje=($duracion*0.3);
//echo $fecha_ini;
//echo $duracion; 

$f_fin=suma_dias_habiles($fecha_inicial,$duracion,$link);
echo "FF:".$f_fin;
echo"10-2.1";
//echo ($fecha_fin);
?>