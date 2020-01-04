<?php 
/*
* Este archivo inserta los registros de organizaciones en la tabla gestion_organizacion en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/?>
<?php
   require("../db/conexion.php");
   $link=conectarse("gestion");
   $codigo=$_POST[codigo];
   $nombre=$_POST[nombre];
   $descripcion=$_POST[descripcion];
   $plan=$_POST[plan];
   $cod_obj_estrategico=$_POST['cod_obj_estrategico'];

 $sql="insert into gestion.gestion_obj_estrategicos_direcciones (codigo, nombre, descripcion, cod_plan_e_dir) value ('$codigo','$nombre', '$descripcion','$plan')";
 mysql_query("begin",$link);
 mysql_query($sql,$link) or die (mysql_error()) ;
 for($i=0;$i<count($cod_obj_estrategico);$i++)
		{
		$sql="insert into gestion_obje_org_dir (cod_obj_e_dir, cod_obj_e_org) value ('$codigo','$cod_obj_estrategico[$i]')";
		if (!mysql_query($sql,$link))
			{
			$error=mysql_error($link);
			mysql_query("rollback",$link);
			echo "<script language='javascript'> alert (\"Los datos NO han sido almacenados $error\"); 
   			location.href='admin_objetivos_estrategicos_direcciones.php';";
   			echo "</script>";	
			}
  		}
mysql_query("commit",$link);
echo "<script language='javascript'> alert (\"Los datos han sido almacenados\"); 
   			location.href='admin_objetivos_estrategicos_direcciones.php';";
   			echo "</script>";
?>

