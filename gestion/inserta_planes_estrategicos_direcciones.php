<?php
 include "../db/conexion.php";
 $link=conectarse("gestion");
 $codigo=$_POST['codigo'];
 $nombre=$_POST['nombre'];
 $aqo_inicio=$_POST['aqo_inicio'];
 $aqo_fin=$_POST['aqo_fin'];
 $direccion=$_POST['direccion'];
 $cod_plan_estrategico_org=$_POST['cod_plan_estrategico_org'];
 $sql="insert into gestion.gestion_planes_estrategicos_direcciones (codigo, nombre, aqo_inicio, aqo_fin, cod_direccion) value ('$codigo','$nombre', '$aqo_inicio', '$aqo_fin', '$direccion')";
mysql_query("begin",$link);
 if (mysql_query($sql,$link))
 { 
	for($i=0;$i<count($cod_plan_estrategico_org);$i++)
		{
		$sql="insert into gestion.gestion_plan_e_org_dir(cod_plan_e_org, cod_plan_e_dir) value ('$cod_plan_estrategico_org[$i]','$codigo')";
		if (!mysql_query($sql,$link))
			{
			mysql_query("rollback",$link);
			echo "<script language='javascript'> alert (\"Los datos NO han sido almacenados\"); 
   			location.href='admin_planes_estrategicos_direccion.php';";
   			echo "</script>";	
			}
  		}
 mysql_query("commit",$link);	
 			echo "<script language='javascript'> alert (\"Los datos han sido almacenados\"); 
   			location.href='admin_planes_estrategicos_direccion.php';";
   			echo "</script>";			
  }
 else
 {
 echo "<script language='javascript'> alert (\"Los datos NO han sido almacenados\"); 
   location.href='admin_planes_estrategicos_direccion.php';";
   echo "</script>";	
 }
 ?>

 








