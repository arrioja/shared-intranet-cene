<?php
include "../db/conexion.php";
include "../libs/utilidades.php";
$link=conectarse("gestion");
$cod_fase=$_POST['cod_fase'];
$num=count($cod_fase);
 echo '<script languaje="Javascript">window.open("http://www.desarrolloweb.com?cantidad=$num","ventana1" , "width=120,height=300,scrollbars=NO"); </script>';count($cod_fase);
/*if (isset($insertar))

 {
	for($i=0;$i<count($cod_fase);$i++)
		{
		$sql="insert into gestion_relacion_actividades_fases (fase,precedida) value ('$cant_row[0]','$cod_fase[$i]')";
		if (!mysql_query($sql,$link))
			{
			mysql_query("rollback",$link);
			break;
			}
		}
	}
	else mysql_query("rollback",$link);
mysql_query("commit",$link);
 }/**/
 
 
?>