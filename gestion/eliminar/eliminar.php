<?php
include "../../db/conexion.php";
$link=conectarse("gestion");
switch ($_GET['elimina'])
{
case '1':
elimina_fase($link);
break;
case '2':
elimina_direccion();
break;
case '3':
elimina_objetivo_operativo($link);
break;
case '4':
elimina_plan_operativo();
break;
case '5':
elimina_plan_estrategico_direccion();
break;
case '6':
elimina_objetivo_estrategico_direccion();
break;
case '7':
elimina_objetivo_estrategico_organizacion();
break;
case '8':
elimina_plan_estrategico_organizacion();
break;
case '9':
elimina_actividad($link);
break;
}

function elimina_fase($link)
{
$sql="DELETE FROM gestion.gestion_fases where id=$_GET[seleccionado]";
$result=mysql_query($sql,$link);
}

function elimina_objetivo_operativo($link)
{mysql_query("begin",$link);

 $sql="DELETE FROM gestion.gestion_obj_operativos where codigo=$_GET[seleccionado]";
$result=mysql_query($sql,$link);
$sql1="DELETE FROM gestion.gestion_obje_objo_dir where cod_obj_o_dir=$_GET[seleccionado]";
$result1=mysql_query($sql1,$link);
$sql2="DELETE FROM gestion.gestion_obj_operativos_actividades cod_obj_operativo=$_GET[seleccionado]";
$result2=mysql_query($sql2,$link);
if (($result) || ($result1) || ($result2))
{
mysql_query("commit",$link);
 echo "El Objetivo Operativo fue eliminado";
 exit;
 }
 mysql_query("rollback",$link);
}

//Completa
function elimina_plan_operativo()
{
$res=mysql_query("SELECT codigo FROM gestion.gestion_obj_operativos where cod_plan_o_dir=$_GET[seleccionado]") or die();
$row=mysql_fetch_array($res);
$codigo_objetivo_operativo=$row["codigo"];

 $sql="DELETE FROM gestion.gestion_planes_operativos where codigo=$_GET[seleccionado]";
 $result=mysql_query($sql);
 $sql1="DELETE FROM gestion.gestion_obj_operativos where cod_plan_o_dir=$_GET[seleccionado]";
 $result1=mysql_query($sql1);
 $sql2="DELETE FROM gestion.gestion_plan_e_o_dir where cod_plan_o_dir=$_GET[seleccionado]";
 $result2=mysql_query($sql2);
 $sql3="DELETE FROM gestion.gestion_obje_objo_dir where cod_obj_o_dir=$codigo_objetivo_operativo";
 $result3=mysql_query($sql3);
 $sql4="DELETE FROM gestion.gestion_obj_operativos_actividades where cod_obj_operativo=$codigo_objetivo_operativo";
 $result4=mysql_query($sql4);
if (($result) || ($result1) || ($result2) || ($result3) || ($result4))
 echo "El Plan Operativo fue eliminado";
}

//Completa
function elimina_plan_estrategico_direccion()
{
$res=mysql_query("SELECT codigo FROM gestion_obj_estrategicos_direcciones where cod_plan_e_dir=$_GET[seleccionado]") or die();
$row=mysql_fetch_array($res);
$codigo_objetivo_estrategico=$row["codigo"];

 $sql="DELETE FROM gestion.gestion_planes_estrategicos_direcciones where codigo=$_GET[seleccionado]";
 $result=mysql_query($sql);
 $sql1="DELETE FROM gestion.gestion_obj_estrategicos_direcciones where cod_plan_e_dir=$_GET[seleccionado]";
 $result1=mysql_query($sql1);
 $sql2="DELETE FROM gestion.gestion_plan_e_org_dir where cod_plan_e_dir=$_GET[seleccionado]";
 $result2=mysql_query($sql2);
 $sql3="DELETE FROM gestion.gestion_plan_e_o_dir where cod_plan_e_dir=$_GET[seleccionado]";
 $result3=mysql_query($sql3);
 $sql4="DELETE FROM gestion.gestion_obje_objo_dir where cod_obj_e_dir=$codigo_objetivo_estrategico";
 $result4=mysql_query($sql4);
 $sql5="DELETE FROM gestion.gestion_obje_org_dir where cod_obj_e_dir=$codigo_objetivo_estrategico";
 $result5=mysql_query($sql5);
if (($result) || ($result1) || ($result2) || ($result3) || ($result4) || ($result5))
 echo "El Plan Estratégico de la Dirección fue eliminado";
}

//Completa
function elimina_objetivo_estrategico_direccion()
{
 $sql="DELETE FROM gestion.gestion_obj_estrategicos_direcciones where codigo=$_GET[seleccionado]";
 $result=mysql_query($sql);
 $sql1="DELETE FROM gestion.gestion_obje_objo_dir where cod_obj_e_dir=$_GET[seleccionado]";
 $result1=mysql_query($sql1);
 $sql2="DELETE FROM gestion.gestion_obje_org_dir where cod_obj_e_dir=$_GET[seleccionado]";
 $result2=mysql_query($sql2);
if (($result) || ($result1) || ($result2))
 echo "El Objetivo Estratégico fue eliminado";
}

//Completa
function elimina_objetivo_estrategico_organizacion()
{
 $sql="DELETE FROM gestion.gestion_obj_estrategicos where codigo=$_GET[seleccionado]";
 $result=mysql_query($sql);
 $sql1="DELETE FROM gestion.gestion_obje_org_dir where cod_obj_e_org=$_GET[seleccionado]";
 $result1=mysql_query($sql1);

if (($result) || ($result1)) 
 echo "El Objetivo Estratégico fue eliminado";
}

//Completa
function elimina_plan_estrategico_organizacion()
{
$res=mysql_query("SELECT codigo FROM ggestion.estion_obj_estrategicos where codigo_plan_estrategico=$_GET[seleccionado]") or die();
$row=mysql_fetch_array($res);
$codigo_objetivo_estrategico=$row["codigo"];

 $sql="DELETE FROM gestion.gestion_planes_estrategicos where codigo=$_GET[seleccionado]";
 $result=mysql_query($sql);
 $sql1="DELETE FROM gestion.gestion_obj_estrategicos where codigo_plan_estrategico=$_GET[seleccionado]";
 $result1=mysql_query($sql1);
 $sql2="DELETE FROM gestion.gestion_plan_e_org_dir where cod_plan_e_org=$_GET[seleccionado]";
 $result2=mysql_query($sql2);
 $sql3="DELETE FROM gestion.gestion_obje_org_dir where cod_obj_e_org=$codigo_objetivo_estrategico";
 $result3=mysql_query($sql3);
if (($result) || ($result1) || ($result2) || ($result3)) 
 echo "El Plan Estrategico fue eliminado";
}

//Completa
function elimina_direccion()
{
$res=mysql_query("SELECT codigo FROM gestion.gestion_planes_estrategicos_direcciones where cod_direccion=$_GET[seleccionado]") or die();
$row=mysql_fetch_array($res);
$codigo_plan_estrategico=$row["codigo"];

$res2=mysql_query("SELECT codigo FROM gestion.gestion_planes_operativos where cod_direccion=$_GET[seleccionado]") or die();
$row2=mysql_fetch_array($res2);
$codigo_plan_operativo=$row2["codigo"];

$res3=mysql_query("SELECT codigo FROM gestion.gestion_obj_estrategicos_direcciones where cod_plan_e_dir=$codigo_plan_estrategico")or die();
$row3=mysql_fetch_array($res3);
$codigo_objetivo_estrategico=$row3["codigo"];

$res4=mysql_query("SELECT codigo FROM gestion.gestion_obj_operativos where cod_plan_o_dir=$codigo_plan_operativo")or die();
$row4=mysql_fetch_array($res4);
$codigo_objetivo_operativo=$row4["codigo"];

 $sql="DELETE FROM organizacion.direcciones where codigo=$_GET[seleccionado]";
 $result=mysql_query($sql);
 $sql1="DELETE FROM gestion.gestion_planes_estrategicos_direcciones where cod_direccion=$_GET[seleccionado]";
 $result1=mysql_query($sql1);
 $sql2="DELETE FROM gestion.gestion_obj_estrategicos_direcciones where cod_plan_e_dir=$codigo_plan_estrategico";
 $result2=mysql_query($sql2);
 $sql3="DELETE FROM gestion.gestion_plan_e_org_dir where cod_plan_e_dir=$codigo_plan_estrategico";
 $result3=mysql_query($sql3);
  $sql4="DELETE FROM gestion.gestion_plan_e_o_dir where cod_plan_e_dir=$codigo_plan_estrategico";
 $result4=mysql_query($sql4);
 $sql5="DELETE FROM gestion.gestion_planes_operativos where cod_direccion=$_GET[seleccionado]";
 $result5=mysql_query($sql5);
 $sql6="DELETE FROM gestion.gestion_obj_operativos where cod_plan_o_dir=$codigo_plan_operativo";
 $result6=mysql_query($sql6);
 $sql7="DELETE FROM gestion.gestion_obje_org_dir where cod_obj_e_dir=$codigo_objetivo_estrategico";
 $result7=mysql_query($sql7);
 $sql8="DELETE FROM gestion.gestion_obj_operativos_actividades where cod_obj_operativo=$codigo_objetivo_operativo";
 $result8=mysql_query($sql8);

if (($result) || ($result1) || ($result2) || ($result3) || ($result4) || ($result5)|| ($result6)|| ($result7)|| ($result8))
echo "La Dirección fue eliminada";
}

function elimina_actividad($link)
{
mysql_query("begin",$link);
 $sql="DELETE FROM gestion.gestion_actividades where id=$_GET[seleccionado]";
 $result=mysql_query($sql,$link);
 $sql1="DELETE FROM gestion.gestion_obj_operativos_actividades where cod_actividad=$_GET[seleccionado]";
 $result1=mysql_query($sql1,$link);
 $sql2="DELETE FROM gestion.gestion_fases where cod_actividad=$_GET[seleccionado]";
 $result1=mysql_query($sql2,$link);

 if (($result) || ($result1) || ($result2)) 
	{
	echo "La Actividad fue eliminada";
	mysql_query("commit",$link);
	}
else
	{
	mysql_query("rollback",$link);
	}	
}

mysql_close($link);
?>