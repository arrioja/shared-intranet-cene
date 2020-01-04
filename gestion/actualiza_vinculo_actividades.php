 <?php
	include "../db/conexion.php";
   $link=conectarse("gestion");
if ($_GET['activo']==1)//inserta
 $sql="insert into gestion.gestion_obj_operativos_actividades (cod_actividad,cod_obj_operativo) value ('$_GET[codigo]','$_GET[seleccionado]')";
else
 $sql="delete from gestion.gestion_obj_operativos_actividades where cod_obj_operativo = $_GET[seleccionado]";
 $result=mysql_query($sql,$link);
 mysql_close($link);
 ?>