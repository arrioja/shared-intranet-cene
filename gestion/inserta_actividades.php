<?php
include "../db/conexion.php";
include "../libs/utilidades.php";
$link=conectarse("gestion");

$nombre=$_POST['nombre'];
$fecha_inicio=$_POST['fecha_inicio'];
$duracion=$_POST['duracion'];
$plan_operativo=$_POST['plan_operativo'];
$cod_obj_operativo=$_POST['cod_obj_operativo'];

$fecha=cambiaf_a_mysql($fecha_inicio);
$genera=mysql_query("select count(id)+1 from gestion.gestion_actividades",$link);
$genera_id=mysql_fetch_array($genera);
$row=$genera_id[0];

$sql="insert into gestion.gestion_actividades (id, nombre, fecha_inicio, duracion, cod_plan_operativo) value ('$row','$nombre','$fecha', '$duracion','$plan_operativo')";

//insert into gestion.gestion_obj_operativos_actividades (cod_actividad,cod_obj_operativo) value ('$codigo','$seleccionado')
mysql_query("begin",$link);
if ($result=mysql_query($sql,$link))
	{
	for($i=0;$i<count($cod_obj_operativo);$i++)
		{
		$sql="insert into gestion.gestion_obj_operativos_actividades (cod_actividad,cod_obj_operativo) value ('$row','$cod_obj_operativo[$i]')";
		if (!mysql_query($sql,$link))
			{
			mysql_query("rollback",$link);
			break;
			}
		}
	}
	else 
		{mysql_query("rollback",$link);
		}
mysql_query("commit",$link);	
echo "<script language='javascript'> alert (\"Los datos han sido almacenados correctamente\"); 
location.href='admin_actividades.php';";
echo "</script>";	
?>