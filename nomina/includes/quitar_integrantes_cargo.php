<?php
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['id'];
$ced=$_GET['ced'];
if (mysql_query("delete from integrantes_cargo where id = $id",$link))
{
		abrir_popup("../mensaje.php?texto=Elimino Correctamente el Cargo&imagen=tips.png","top=200 ,left=500 ,width=350, height=200, scrollbars=no, menubar=no, location=no, resizable=no");
}
else
{
		abrir_popup("../mensaje.php?texto=No se pudo eliminar el Cargo&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
}
echo '<script languaje="Javascript">location.href="../integrantes_cargo.php?id='.$ced.'"</script>';
?>