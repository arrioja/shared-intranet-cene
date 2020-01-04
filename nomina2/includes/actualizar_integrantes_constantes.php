<?php 
$total=$_POST['total'];
$cod=$_POST['codigo'];

include("miclase.php");
$link=conectarse("nomina");
mysql_query("begin",$link);
foreach ($_POST['cedula'] as $cedula=>$monto)
{

$query = "update integrantes_constantes set  monto='$monto' where cedula='$cedula' and cod_constantes='$cod'";
if (!mysql_query($query, $link))
	{
	echo mysql_error();
	mysql_query("rollback",$link);
	exit();	
	}
}//end for
mysql_query("commit",$link);
echo '<script languaje="Javascript">location.href="../asignacion_constantes_general.php"</script>';
?>