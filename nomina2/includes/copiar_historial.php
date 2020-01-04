<?php 
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['cod'];
$tipo=$_GET['tipo'];
echo $id;
echo $tipo;

$result=mysql_query("select * from nomina where cod='$id' and tipo_nomina='$tipo'",$link);
mysql_query("BEGIN",$link);//empezar transaccion
while ($registros=mysql_fetch_array($result))
	{
	$cod=$registros['cod'];$cedula=$registros['cedula'];$cod_incidencia=$registros['cod_incidencia'];$descripcion=$registros['descripcion'];$monto_incidencia=$registros['monto_incidencia'];$tipo=$registros['tipo'];$tipo_nomina=$registros['tipo_nomina'];
	
	if (!mysql_query("insert into nomina_historial (cod,cedula,cod_incidencia,descripcion,monto_incidencia,tipo,tipo_nomina) values('$cod','$cedula','$cod_incidencia','$descripcion','$monto_incidencia','$tipo','$tipo_nomina')",$link))//llenar historial
		{
		mysql_query("ROLLBACK",$link);
		echo '<script languaje="Javascript">location.href="../nominas.php"</script>';
		exit;
		}
	}
	
	if (!mysql_query("delete from nomina where cod='$id' and tipo_nomina='$tipo'",$link))//borrar datos de la tabla nomina
		{
		mysql_query("ROLLBACK",$link);
		echo '<script languaje="Javascript">location.href="../nominas.php"</script>';
		exit;
		}		
mysql_query("COMMIT",$link);	//ejecutar transaccion
echo '<script languaje="Javascript">location.href="../nominas.php"</script>';
?>