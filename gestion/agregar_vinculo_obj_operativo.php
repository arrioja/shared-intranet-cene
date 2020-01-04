<?php
include "../db/conexion.php";
$link=conectarse("gestion");
$codigo=$_POST['codigo'];

mysql_query("begin",$link);
for($i=0;$i<count($plan);$i++)
{
$sql="insert into gestion.gestion_plan_e_o_dir (cod_plan_e_dir, cod_plan_o_dir) value ('$plan[$i]','$codigo')";
if (!mysql_query($sql,$link))
	{
	mysql_query("rollback",$link);
	break;
	}
}
mysql_query("commit",$link);
echo '<script languaje="Javascript">location.href="../asignacion_constantes_general.php"</script>';
?>