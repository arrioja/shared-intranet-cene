<?php 
include "libreria.php";
$link=conectarse("nomina");
$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS integrantes_temporal(";
$sql .= "cedula int(10), ";
$sql .= "nombres varchar(50), ";
$sql .= "apellidos varchar(50))TYPE=HEAP;";


if(mysql_query ($sql ,$link)) {
echo "<h2> Tabla $tabla creada con EXITO </h2><br>";
}else{
echo "<h2> La tabla $tabla NO HA PODIDO CREARSE</h2><br>";
};

$consulta = "INSERT INTO integrantes_temporal (cedula, nombres, apellidos) VALUES('123','caslo','janbento')";
mysql_query($consulta,$link) or die(mysql_error());
echo '<script languaje="Javascript">location.href="../constantes_general.php"</script>';
?>