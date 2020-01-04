<?php
 include "../db/conexion.php";
 include "../libs/utilidades.php";
 $link=conectarse("gestion");
 $cod_fase=$_POST['cod_fase'];
 $cod_actividad=$_POST['cod_actividad'];
 $fecha=cambiaf_a_mysql($_POST['fecha_inicio']);
 $nombre=$_POST['nombre'];
 $duracion=$_POST['duracion'];

 $sql="select max(id)+1 from gestion.gestion_fases";  
 $result=mysql_query($sql,$link) or die(mysql_error());  
 $cant_row=mysql_fetch_array($result);
 if ($cant_row[0]==0)
 	 $cant_row[0]=1;
mysql_query("BEGIN",$link);
 $sql="insert into gestion_fases (id,nombre, fecha_inicio, duracion, cod_actividad) value ('$cant_row[0]', '$nombre', '$fecha', '$duracion', '$cod_actividad')";

 if (mysql_query($sql,$link) or die(mysql_error()))
 	{
	for($i=0;$i<count($cod_fase);$i++)
		{
		 $sql="insert into gestion_relacion_actividades_fases (fase,precedida) value ('$cant_row[0]','$cod_fase[$i]')";
		 if (!mysql_query($sql,$link))
			{
			  mysql_query("ROLLBACK",$link);
		      break;
			}		
		}
	}
	else mysql_query("ROLLBACK",$link);
mysql_query("COMMIT",$link);
echo '<script languaje="Javascript">location.href="incluir_fases.php?codigo_actividad='.$cod_actividad.'"</script>';
?>