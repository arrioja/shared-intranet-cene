<?php 
/*
* Este archivo inserta Planes Operativos.
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/
 include ("../db/conexion.php");
 $codigo=$_POST['codigo'];
 $nombre=$_POST['nombre'];
 $inicio=$_POST['aqo_inicio'];
 $fin=$_POST['aqo_fin'];
 $plan=$_POST['plan_estrategico'];
 $direccion=$_POST['direccion'];

 $link=conectarse("gestion");
 //valida que no este el Plan
 $sql="select * from gestion.gestion_planes_operativos where codigo='$codigo'";
 $result=mysql_query($sql,$link) or die (mysql_error()); 
 if (mysql_num_rows($result) == 0)
 {
   mysql_query("BEGIN",$link);
   $sql="insert into gestion.gestion_planes_operativos (codigo,nombre,aqo_inicio,aqo_fin,cod_direccion) value ('$codigo','$nombre','$inicio',
        '$fin','$direccion')";
   mysql_query($sql,$link) or die(mysql_error());
	for($i=0;$i<count($plan);$i++)
	 {
	   $planx=$plan[$i];
	   $sql="insert into gestion.gestion_plan_e_o_dir (cod_plan_e_dir, cod_plan_o_dir) value ('$planx','$codigo')";
	   if (!mysql_query($sql,$link))
		 {
		   mysql_query("ROLLBACK",$link);
		   break;
		  }
	  }	 
    mysql_query("COMMIT",$link);
  }
  echo '<script languaje="Javascript">location.href="admin_plan_operativo.php"</script>';
?>