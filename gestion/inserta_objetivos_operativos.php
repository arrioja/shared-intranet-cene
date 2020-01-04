
<?php 
/*
* Este archivo inserta los registros de organizaciones en la tabla gestion_organizacion en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/?>
<?php
include "../db/conexion.php";
$link=conectarse("gestion");

$cod_obj_oper_dir=$_POST['codigo'];
$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$plan_operativo=$_POST['plan_operativo'];
$cod_obj_est_dir=$_POST['cod_obj_estrategico_dir'];


//valida que no este el objetivo
 $sql="select * from gestion.gestion_obj_operativos where codigo='$cod_obj_oper_dir'";
 $result=mysql_query($sql,$link);
 $cant_row=mysql_affected_rows($link);
 mysql_query("begin",$link);
 if ($cant_row==0)
 {

 $sql="insert into gestion.gestion_obj_operativos(codigo, nombre, descripcion, cod_plan_o_dir) value ('$cod_obj_oper_dir','$nombre', '$descripcion', '$plan_operativo')";
 $result=mysql_query($sql,$link);
	 for($i=0;$i<count($cod_obj_est_dir);$i++)
		{
		$sql="insert into gestion.gestion_obje_objo_dir (cod_obj_e_dir, cod_obj_o_dir) value ('$cod_obj_est_dir[$i]','$cod_obj_oper_dir')";
		if (!mysql_query($sql,$link))
			{
			mysql_query("rollback",$link);
			break;
			}
		}

  }
  
  mysql_query("commit",$link);
  echo '<script languaje="Javascript">location.href="admin_objetivos_operativos.php"</script>';
?>


