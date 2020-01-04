<?php 
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['cod'];
$tipo=$_GET['tipo'];
mysql_query("delete from nomina where cod='$id' and tipo_nomina='$tipo'",$link) or die('no pudo eliminar la nomina seleccionada');

echo '<script languaje="Javascript">location.href="../nominas.php"</script>';
?>
