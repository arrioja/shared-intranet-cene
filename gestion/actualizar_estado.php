<?php 	
include "../db/conexion.php";
include "../libs/utilidades.php";
$link=conectarse("gestion");
//include '../conexion/libreria.php';
$estado=$_POST['estado'];
$id=$_POST['id'];
$fecha_actualizacion=$_POST['fecha'];
//echo($fecha_actualizacion);
$fecha_final=cambiaf_a_mysql($fecha_actualizacion); 

//////////////////////////////////////////actualiza estado de la fase
$sql="UPDATE gestion.gestion_fases set estado= '$estado', fecha_actualizacion= '$fecha_final' where id='$id'";
mysql_query($sql,$link);

//busco codigo actividad 
$res=mysql_query("SELECT cod_actividad FROM gestion.gestion_fases WHERE id=$id")or die(mysql_error());
$row=mysql_fetch_array($res);
$codigo_actividad=$row["cod_actividad"];

//busco el total de fases para una actividad
$result = "SELECT COUNT(estado) FROM gestion.gestion_fases where cod_actividad=$codigo_actividad;";
$fases = mysql_query($result) or die(mysql_error());
$row2 = mysql_fetch_row($fases);
$total_fases = $row2[0];

//busco el total de fases cumplidas para una actividad
$result2 = "SELECT COUNT(estado) FROM gestion.gestion_fases where cod_actividad=$codigo_actividad and estado='2';";
$fases2 = mysql_query($result2) or die(mysql_error());
$row3 = mysql_fetch_row($fases2);
$total_completas = $row3[0];

$completados = (($total_completas*100)/($total_fases));
$completados=round($completados);//redondea
$completados=(int)$completados;//parte entera
//actualiza en el campo completado de actividad
$sql2="UPDATE gestion.gestion_actividades set completados=$completados where id='$codigo_actividad'";
mysql_query($sql2,$link);



///////////////////////////////////////actualizar los objetivos operativos
//busco los objetivos operativos de la actividad
$res=mysql_query("SELECT ooa.cod_obj_operativo FROM gestion.gestion_obj_operativos_actividades ooa WHERE ooa.cod_actividad=$codigo_actividad")or die(mysql_error());

while ($objetivo=mysql_fetch_array($res))//recorrido de todos los objetivos operativos de la actividad 
{	
	$cod_obj=$objetivo[0];
	$sql_promedio="Select avg(a.completados) promedio from gestion.gestion_actividades a inner join gestion.gestion_obj_operativos_actividades ooa on (ooa.cod_actividad=a.id) where ooa.cod_obj_operativo='$cod_obj'";
	$resultado=mysql_query($sql_promedio,$link);
	$prom=mysql_fetch_array($resultado);
	$p=$prom[0];
	$p=round($p);
	$p=(int)$p;
	mysql_query("update gestion.gestion_obj_operativos set completados='$p' where codigo='$cod_obj'",$link);//actualizar el objetivo
}

/////////////////////////////////////actualizo plan operativo
//busco codigo plan operativo
$res_plan=mysql_query("SELECT cod_plan_operativo FROM gestion.gestion_actividades WHERE id=$codigo_actividad")or die(mysql_error());
$result_plan=mysql_fetch_array($res_plan);
$codigo_plan_operativo=$result_plan["cod_plan_operativo"];
$sql_promedio_plan="Select avg(completados) promedio from gestion.gestion_obj_operativos where cod_plan_o_dir='$codigo_plan_operativo'";
$resultado_plan=mysql_query($sql_promedio_plan,$link);
$prom=mysql_fetch_array($resultado_plan);
$p=$prom[0];
$p=round($p);
$p=(int)$p;
mysql_query("update gestion.gestion_planes_operativos set completados='$p' where codigo='$codigo_plan_operativo'",$link);//actualizar el plan
/////////////////////////////////////


///////////////////////////////////////actualizar los objetivos estrategicos
//busco los objetivos estrategicos relacionados con el objetivo operativo
$res=mysql_query("SELECT cod_obj_e_dir FROM gestion.gestion_obje_objo_dir WHERE cod_obj_o_dir=$cod_obj")or die(mysql_error());

while ($objetivo_estrategico=mysql_fetch_array($res))//recorrido de todos los objetivos estrategicos
{	
	$cod_obj_estrategico=$objetivo_estrategico[0];
	$sql_promedio_objetivo="Select avg(a.completados) promedio from gestion.gestion_obj_operativos a inner join gestion.gestion_obje_objo_dir ooa on (ooa.cod_obj_o_dir=a.codigo) where ooa.cod_obj_e_dir='$cod_obj_estrategico'";
	$resultado_objetivo_estrategico=mysql_query($sql_promedio_objetivo,$link);
	$prom=mysql_fetch_array($resultado_objetivo_estrategico);
	$p=$prom[0];
	$p=round($p);
	$p=(int)$p;
	mysql_query("update gestion.gestion_obj_estrategicos_direcciones set completados='$p' where codigo='$cod_obj_estrategico'",$link);//actualizar el objetivo
}
/////////////////////////////////////

/////////////////////////////////////actualizo plan estrategico direccion
//busco codigo plan estrategico
$res_plan_estrategico=mysql_query("SELECT cod_plan_e_dir FROM gestion.gestion_obj_estrategicos_direcciones WHERE codigo=$cod_obj_estrategico")or die(mysql_error());
$result_plan_estrategico=mysql_fetch_array($res_plan_estrategico);
$codigo_plan_estrategico_direccion=$result_plan_estrategico["cod_plan_e_dir"];
$sql_promedio_plan_estrategico="Select avg(completados) promedio from gestion.gestion_obj_estrategicos_direcciones where cod_plan_e_dir='$codigo_plan_estrategico_direccion'";
$resultado_plan_estrategico=mysql_query($sql_promedio_plan_estrategico,$link);
$prom=mysql_fetch_array($resultado_plan_estrategico);
$p=$prom[0];
$p=round($p);
$p=(int)$p;
mysql_query("update gestion.gestion_planes_estrategicos_direcciones set completados='$p' where codigo='$codigo_plan_estrategico_direccion'",$link);//actualizar el plan
/////////////////////////////////////

///////////////////////////////////////actualizar los objetivos estrategicos organización
//busco los objetivos estrategicos de la organización relacionado con los objetivos estratégicos de la dirección
$res=mysql_query("SELECT cod_obj_e_org FROM gestion.gestion_obje_org_dir WHERE cod_obj_e_dir=$cod_obj_estrategico")or die(mysql_error());

while ($objetivo_estrategico_direcciones=mysql_fetch_array($res))//recorrido de todos los objetivos estrategicos relacionados al obj estr dir 
{	
	$cod_obj_organizacion=$objetivo_estrategico_direcciones[0];
	$sql_promedio="Select avg(a.completados) promedio from gestion.gestion_obj_estrategicos_direcciones a inner join gestion.gestion_obje_org_dir ooa on (ooa.cod_obj_e_dir=a.codigo) where ooa.cod_obj_e_org='$cod_obj_organizacion'";
	$resultado_organizacion=mysql_query($sql_promedio,$link);
	$prom=mysql_fetch_array($resultado_organizacion);
	$p=$prom[0];
	$p=round($p);
	$p=(int)$p;
	mysql_query("update gestion.gestion_obj_estrategicos set completados='$p' where codigo='$cod_obj_organizacion'",$link);//actualizar el objetivo estrategico
}

/////////////////////////////////////actualizo plan estrategico organización
//busco codigo plan estrategico organización
$res_plan_estrategico=mysql_query("SELECT codigo_plan_estrategico FROM gestion.gestion_obj_estrategicos WHERE codigo=$cod_obj_organizacion")or die(mysql_error());
$result_plan_estrategico=mysql_fetch_array($res_plan_estrategico);
$codigo_plan_estrategico=$result_plan_estrategico["codigo_plan_estrategico"];
$sql_promedio_plan_estrategico="Select avg(completados) promedio from gestion.gestion_obj_estrategicos where codigo_plan_estrategico='$codigo_plan_estrategico'";
$resultado_plan_estrategico=mysql_query($sql_promedio_plan_estrategico,$link);
$prom=mysql_fetch_array($resultado_plan_estrategico);
$p=$prom[0];
$p=round($p);
$p=(int)$p;
mysql_query("update gestion.gestion_planes_estrategicos set completados='$p' where codigo='$codigo_plan_estrategico'",$link);//actualizar el plan
/////////////////////////////////////




/////////////////////////////indicadores de tiempo////////////////////////////////////
/////////////////////////////FASES///////////////////////////////////////////////////
$data=mysql_query("select * from gestion.gestion_fases where id='$id'",$link);
$fase=mysql_fetch_array($data);
$fecha_ini=$fase['fecha_inicio'];
$fecha_act=$fase['fecha_actualizacion'];
$duracion=$fase['duracion'];


$fecha_inicial=cambiaf_a_normal($fecha_ini);

$porcentaje=($duracion*0.3);
//echo $fecha_ini;
//echo $duracion; 
$fecha_fin=suma_dias_habiles($fecha_inicial,$duracion,$link);
//echo ($fecha_fin);
$fecha_culminada=cambiaf_a_mysql($fecha_fin);
$consulta_fecha=mysql_query("SELECT DATEDIFF('$fecha_act','$fecha_culminada' ) AS dias");
$dato_fecha=mysql_fetch_array($consulta_fecha);
 // echo ($dato_fecha[0]);
// echo ($porcentaje);
 
 if ($dato_fecha[0]<=0) 
 {
// echo "Bien";
 $tiempo=2;
 }
 else 
  if (($dato_fecha[0]>0) && ($dato_fecha[0]<$porcentaje))
    {
   //echo  "Regular";
    $tiempo=1;
	}
    else 
	 if ($dato_fecha[0]>=$porcentaje) 
      {
	  //echo  "Malo";
	   $tiempo=0;
	  }

mysql_query("update gestion.gestion_fases set tiempo_ejecucion='$tiempo' where id='$id'",$link);//actualizar     
/////////////////////////////FASES///////////////////////////////////////////////////


/////////////////////////////ACTIVIDADES////////////////////////////////////////////
$consulta_tiempo=mysql_query("select COUNT(id), SUM(tiempo_ejecucion) from gestion.gestion_fases where cod_actividad=$codigo_actividad") or die (mysql_error);
//echo $tiempo[0];
//echo $tiempo[1];
$tiempo=mysql_fetch_array($consulta_tiempo);

if ($tiempo[0]*2==$tiempo[1])
{
$data_actividad=mysql_query("select * from gestion.gestion_actividades where id=$codigo_actividad;",$link);
$actividad=mysql_fetch_array($data_actividad);
$fecha_ini_actividad=$actividad['fecha_inicio'];
//$fecha_fin_actividad=$fecha_act;
$duracion_actividad=$actividad['duracion'];


$porcentaje_actividad=($duracion_actividad*0.3);
//echo $porcentaje_actividad;
$fecha_inicial_actividad=cambiaf_a_normal($fecha_ini_actividad);

//echo $fecha_inicial_actividad;
//echo $duracion_actividad;
$fecha_fin_actividad=suma_dias_habiles($fecha_inicial_actividad,$duracion_actividad,$link);

//echo $fecha_fin_actividad;

$fecha_culminada_actividad=cambiaf_a_mysql($fecha_fin_actividad);
$consulta_fecha=mysql_query("SELECT DATEDIFF('$fecha_act','$fecha_culminada_actividad') AS dias");
$dato_fecha_actividad=mysql_fetch_array($consulta_fecha);

//echo $dato_fecha_actividad[0];
//echo ($codigo_actividad);
if ($dato_fecha_actividad[0]<=0) 
 {
 //echo "Bien";
 $tiempo_actividad=2;
 }
 else 
  if (($dato_fecha_actividad[0]>0) && ($dato_fecha_actividad[0]<$porcentaje_actividad))
  {
//echo  "Regular";
    $tiempo_actividad=1;
   }
    else 
	 if ($dato_fecha_actividad[0]>=$porcentaje_actividad) 
      {
//echo  "Malo";
	   $tiempo_actividad=0;
	  }
	 
	mysql_query("update gestion.gestion_actividades set tiempo_ejecucion='$tiempo_actividad' where id='$codigo_actividad'",$link);//actualizar  
}
 
/////////////////////////////ACTIVIDADES///////////////////////////////////////////


/////////////////////////////OBJETIVOS OPERATIVOS////////////////////////////////////////////
$consulta_objetivos_operativos="Select avg(tiempo_ejecucion) promedio from gestion.gestion_actividades where cod_plan_operativo='$codigo_plan_operativo'";
$tiempo_operativo=mysql_query($consulta_objetivos_operativos,$link);
$tiempo_objetivo_operativo=mysql_fetch_array($tiempo_operativo);
$promedio_actividad=$tiempo_objetivo_operativo[0];
//echo ($promedio_actividad);
//echo ($codigo_plan_operativo);
if (($promedio_actividad==0) && ($promedio_actividad<0.6))
{
//echo "Malo";
$tiempo_o_operativo=0;
}

if (($promedio_actividad>=0.6) && ($promedio_actividad<1.3))
{
//echo "Regular";
$tiempo_o_operativo=1;
}

if (($promedio_actividad>=1.3) && ($promedio_actividad<=2))
{
//echo "Bien";
$tiempo_o_operativo=2;
}
mysql_query("update gestion.gestion_obj_operativos set tiempo_ejecucion='$tiempo_o_operativo' where cod_plan_o_dir='$codigo_plan_operativo'",$link);
/////////////////////////////OBJETIVOS OPERATIVOS////////////////////////////////////////////

/////////////////////////////PLANES OPERATIVOS////////////////////////////////////////////
$consulta_obj_operativo="Select avg(tiempo_ejecucion) promedio from gestion.gestion_obj_operativos where codigo='$cod_obj'";
$tiempo_obj_operativo=mysql_query($consulta_obj_operativo,$link);
$tiempo_plan_operativo=mysql_fetch_array($tiempo_obj_operativo);
$promedio_plan=$tiempo_plan_operativo[0];
//echo ($promedio_plan);
//echo ($codigo_plan_operativo);
if (($promedio_plan==0) && ($promedio_plan<0.6))
{
//echo "Malo";
$tiempo_plan_operativo=0;
}

if (($promedio_plan>=0.6) && ($promedio_plan<1.3))
{
//echo "Regular";
$tiempo_plan_operativo=1;
}

if (($promedio_plan>=1.3) && ($promedio_plan<=2))
{
//echo "Bien";
$tiempo_plan_operativo=2;
}
mysql_query("update gestion.gestion_planes_operativos set tiempo_ejecucion='$tiempo_plan_operativo' where codigo='$codigo_plan_operativo'",$link);
/////////////////////////////PLANES OPERATIVOS////////////////////////////////////////////


/////////////////////////////OBJETIVOS ESTRATEGICOS DIRECCIONES////////////////////////////////////////////
$consulta_plan_operativo="Select avg(tiempo_ejecucion) promedio from gestion.gestion_planes_operativos where codigo='$codigo_plan_operativo'";
$tiempo_p_operativo=mysql_query($consulta_plan_operativo,$link);
$tiempo_objetivo_direccion=mysql_fetch_array($tiempo_p_operativo);
$promedio_objetivo_direccion=$tiempo_objetivo_direccion[0];
//echo ($promedio_objetivo_direccion);
//echo ($cod_obj_estrategico);
if (($promedio_objetivo_direccion==0) && ($promedio_objetivo_direccion<0.6))
{
//echo "Malo";
$tiempo_objetivo_direccion=0;
}

if (($promedio_objetivo_direccion>=0.6) && ($promedio_objetivo_direccion<1.3))
{
//echo "Regular";
$tiempo_objetivo_direccion=1;
}

if (($promedio_objetivo_direccion>=1.3) && ($promedio_objetivo_direccion<=2))
{
//echo "Bien";
$tiempo_objetivo_direccion=2;
}
mysql_query("update gestion.gestion_obj_estrategicos_direcciones set tiempo_ejecucion='$tiempo_objetivo_direccion' where codigo='$cod_obj_estrategico'",$link);
/////////////////////////////OBJETIVOS ESTRATEGICOS DIRECCIONES////////////////////////////////////////////

/////////////////////////////PLANES ESTRATEGICOS DIRECCIONES////////////////////////////////////////////
$consulta_obj_direccion="Select avg(tiempo_ejecucion) promedio from gestion.gestion_obj_estrategicos_direcciones where codigo='$cod_obj_estrategico'";
$tiempo_obj_direccion=mysql_query($consulta_obj_direccion,$link);
$tiempo_plan_direccion=mysql_fetch_array($tiempo_obj_direccion);
$promedio_plan_direccion=$tiempo_plan_direccion[0];
//echo ($promedio_plan_direccion);
//echo ($codigo_plan_estrategico_direccion);

if (($promedio_plan_direccion==0) && ($promedio_plan_direccion<0.6))
{
//echo "Malo";
$tiempo_plan_direccion=0;
}

if (($promedio_plan_direccion>=0.6) && ($promedio_plan_direccion<1.3))
{
//echo "Regular";
$tiempo_plan_direccion=1;
}

if (($promedio_plan_direccion>=1.3) && ($promedio_plan_direccion<=2))
{
//echo "Bien";
$tiempo_plan_direccion=2;
}
mysql_query("update gestion.gestion_planes_estrategicos_direcciones set tiempo_ejecucion='$tiempo_plan_direccion' where codigo='$codigo_plan_estrategico_direccion'",$link);
/////////////////////////////PLANES ESTRATEGICOS DIRECCIONES////////////////////////////////////////////

/////////////////////////////OBJETIVOS ESTRATEGICOS ORGANIZACION////////////////////////////////////////////
$consulta_plan_direccion="Select avg(tiempo_ejecucion) promedio from gestion.gestion_planes_estrategicos_direcciones where codigo='$codigo_plan_estrategico_direccion'";
$tiempo_plan_direccion=mysql_query($consulta_plan_direccion,$link);
$tiempo_obj_organizacion=mysql_fetch_array($tiempo_plan_direccion);
$promedio_obj_organizacion=$tiempo_obj_organizacion[0];
//echo ($promedio_obj_organizacion);
//echo ($cod_obj_organizacion);

if (($promedio_obj_organizacion==0) && ($promedio_obj_organizacion<0.6))
{
//echo "Malo";
$tiempo_obj_organizacion=0;
}

if (($promedio_obj_organizacion>=0.6) && ($promedio_obj_organizacion<1.3))
{
//echo "Regular";
$tiempo_obj_organizacion=1;
}

if (($promedio_obj_organizacion>=1.3) && ($promedio_obj_organizacion<=2))
{
//echo "Bien";
$tiempo_obj_organizacion=2;
}
mysql_query("update gestion.gestion_obj_estrategicos set tiempo_ejecucion='$tiempo_obj_organizacion' where codigo='$cod_obj_organizacion'",$link);
/////////////////////////////OBJETIVOS ESTRATEGICOS ORGANIZACION////////////////////////////////////////////

/////////////////////////////PLANES ESTRATEGICOS ORGANIZACION////////////////////////////////////////////
$consulta_obj_organizacion="Select avg(tiempo_ejecucion) promedio from gestion.gestion_obj_estrategicos where codigo='$cod_obj_organizacion'";
$tiempo_obj_organizacion=mysql_query($consulta_obj_organizacion,$link);
$tiempo_plan_organizacion=mysql_fetch_array($tiempo_obj_organizacion);
$promedio_plan_organizacion=$tiempo_plan_organizacion[0];
//echo ($promedio_plan_organizacion);
//echo ($codigo_plan_estrategico);

if (($promedio_plan_organizacion==0) && ($promedio_plan_organizacion<0.6))
{
//echo "Malo";
$tiempo_plan_organizacion=0;
}

if (($promedio_plan_organizacion>=0.6) && ($promedio_plan_organizacion<1.3))
{
//echo "Regular";
$tiempo_plan_organizacion=1;
}

if (($promedio_obj_organizacion>=1.3) && ($promedio_obj_organizacion<=2))
{
//echo "Bien";
$tiempo_plan_organizacion=2;
}
mysql_query("update gestion.gestion_planes_estrategicos set tiempo_ejecucion='$tiempo_plan_organizacion' where codigo='$codigo_plan_estrategico'",$link);
/////////////////////////////PLANES ESTRATEGICOS ORGANIZACION////////////////////////////////////////////
echo 'si';
echo "<script language='javascript'> alert (\"El estado ha sido cambiado correctamente\"); 
	location.href='incluir_fases.php?codigo_actividad=+$codigo_actividad';";
echo "</script>"; 
mysql_close($link);
?>