<?php
include ("../../db/conexion.php");
$link=conectarse("gestion");
switch ($_GET['elimina'])
{
case '1':
elimina_fase($link);
break;
case '3':
elimina_objetivo_operativo($link);
break;
case '4':
elimina_plan_operativo($link);
break;
case '5':
elimina_plan_estrategico_direccion($link);
break;
case '6':
elimina_objetivo_estrategico_direccion($link);
break;
case '7':
elimina_objetivo_estrategico_organizacion($link);
break;
case '8':
elimina_plan_estrategico_organizacion($link);
break;
case '9':
elimina_actividad($link);
break;
}

function elimina_fase($link)
{
$sql="DELETE FROM gestion_fases where id=$_GET[seleccionado]";
$result=mysql_query($sql,$link);
}
function elimina_objetivo_operativo($link)
{
 $sql="DELETE FROM gestion_obj_operativos where codigo=$_GET[seleccionado]";
$result=mysql_query($sql,$link);
$sql1="DELETE FROM gestion_obje_objo_dir where cod_obj_o_dir=$_GET[seleccionado]";
$result1=mysql_query($sql1,$link);
$sql2="DELETE FROM gestion_obj_operativos_actividades cod_obj_operativo=$_GET[seleccionado]";
$result2=mysql_query($sql2,$link);
if (($result) || ($result1) || ($result2))
 echo "El Objetivo Operativo fue eliminado";
}

//Completa
function elimina_plan_operativo($link)
{
$res=mysql_query("SELECT codigo FROM gestion_obj_operativos where cod_plan_o_dir=$_GET[seleccionado]",$link) or die();
$row=mysql_fetch_array($res);
$codigo_objetivo_operativo=$row["codigo"];

 $sql="DELETE FROM gestion_planes_operativos where codigo=$_GET[seleccionado]";
 $result=mysql_query($sql,$link);
 $sql1="DELETE FROM gestion_obj_operativos where cod_plan_o_dir=$_GET[seleccionado]";
 $result1=mysql_query($sql1,$link);
 $sql2="DELETE FROM gestion_plan_e_o_dir where cod_plan_o_dir=$_GET[seleccionado]";
 $result2=mysql_query($sql2,$link);
 $sql3="DELETE FROM gestion_obje_objo_dir where cod_obj_o_dir=$codigo_objetivo_operativo";
 $result3=mysql_query($sql3,$link);
 $sql4="DELETE FROM gestion_obj_operativos_actividades where cod_obj_operativo=$codigo_objetivo_operativo";
 $result4=mysql_query($sql4,$link);
if (($result) || ($result1) || ($result2) || ($result3) || ($result4))
 echo "El Plan Operativo fue eliminado";
}

//Completa
function elimina_plan_estrategico_direccion($link)
{
$res=mysql_query("SELECT codigo FROM gestion_obj_estrategicos_direcciones where cod_plan_e_dir=$_GET[seleccionado]",$link) or die();
$row=mysql_fetch_array($res);
$codigo_objetivo_estrategico=$row["codigo"];

 $sql="DELETE FROM gestion_planes_estrategicos_direcciones where codigo=$_GET[seleccionado]";
 $result=mysql_query($sql,$link);
 $sql1="DELETE FROM gestion_obj_estrategicos_direcciones where cod_plan_e_dir=$_GET[seleccionado]";
 $result1=mysql_query($sql1,$link);
 $sql2="DELETE FROM gestion_plan_e_org_dir where cod_plan_e_dir=$_GET[seleccionado]";
 $result2=mysql_query($sql2,$link);
 $sql3="DELETE FROM gestion_plan_e_o_dir where cod_plan_e_dir=$_GET[seleccionado]";
 $result3=mysql_query($sql3,$link);
 $sql4="DELETE FROM gestion_obje_objo_dir where cod_obj_e_dir=$codigo_objetivo_estrategico";
 $result4=mysql_query($sql4,$link);
 $sql5="DELETE FROM gestion_obje_org_dir where cod_obj_e_dir=$codigo_objetivo_estrategico";
 $result5=mysql_query($sql5,$link);
if (($result) || ($result1) || ($result2) || ($result3) || ($result4) || ($result5))
 echo "El Plan Estratégico de la Dirección fue eliminado";
}

//Completa
function elimina_objetivo_estrategico_direccion($link)
{
 $sql="DELETE FROM gestion_obj_estrategicos_direcciones where codigo=$_GET[seleccionado]";
 $result=mysql_query($sql,$link);
 $sql1="DELETE FROM gestion_obje_objo_dir where cod_obj_e_dir=$_GET[seleccionado]";
 $result1=mysql_query($sql1,$link);
 $sql2="DELETE FROM gestion_obje_org_dir where cod_obj_e_dir=$_GET[seleccionado]";
 $result2=mysql_query($sql2,$link);
if (($result) || ($result1) || ($result2))
 echo "El Objetivo Estratégico fue eliminado";
}

//Completa
function elimina_objetivo_estrategico_organizacion($link)
{
 $sql="DELETE FROM gestion_obj_estrategicos where codigo=$_GET[seleccionado]";
 $result=mysql_query($sql,$link);
 $sql1="DELETE FROM gestion_obje_org_dir where cod_obj_e_org=$_GET[seleccionado]";
 $result1=mysql_query($sql1,$link);

if (($result) || ($result1)) 
 echo "El Objetivo Estratégico fue eliminado";
}

//Completa
function elimina_plan_estrategico_organizacion($link)
{
$res=mysql_query("SELECT codigo FROM gestion_obj_estrategicos where codigo_plan_estrategico=$_GET[seleccionado]",$link) or die();
$row=mysql_fetch_array($res);
$codigo_objetivo_estrategico=$row["codigo"];

 $sql="DELETE FROM gestion_planes_estrategicos where codigo=$_GET[seleccionado]";
 $result=mysql_query($sql,$link);
 $sql1="DELETE FROM gestion_obj_estrategicos where codigo_plan_estrategico=$_GET[seleccionado]";
 $result1=mysql_query($sql1,$link);
 $sql2="DELETE FROM gestion_plan_e_org_dir where cod_plan_e_org=$_GET[seleccionado]";
 $result2=mysql_query($sql2,$link);
 $sql3="DELETE FROM gestion_obje_org_dir where cod_obj_e_org=$codigo_objetivo_estrategico";
 $result3=mysql_query($sql3,$link);
if (($result) || ($result1) || ($result2) || ($result3)) 
 echo "El Plan Estrategico $_GET[seleccionado] fue eliminado";
}

function elimina_actividad($link)
{
 $sql="DELETE FROM gestion_actividades where id=$_GET[seleccionado]";
 $result=mysql_query($sql,$link);
 $sql1="DELETE FROM gestion_obj_operativos_actividades where cod_actividad=$_GET[seleccionado]";
 $result1=mysql_query($sql1,$link);
 $sql2="DELETE FROM gestion_fases where cod_actividad=$_GET[seleccionado]";
 $result1=mysql_query($sql2,$link);

 if (($result) || ($result1) || ($result2)) 
echo "La Actividad fue eliminada";
 }

mysql_close($link);
?>