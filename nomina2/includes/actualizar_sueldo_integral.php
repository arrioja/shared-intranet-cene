<?php
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['id'];
$cod=$_GET['cod'];
if (mysql_query("delete from integrantes_conceptos where cedula = $id and cod_concepto=$cod",$link))
{
		//echo "concepto eliminado del funcionario ci:'$id'";
}
header("Location: ../conceptos_integrantes.php?id=$id");
?>