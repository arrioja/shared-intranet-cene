<?php
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['id'];
$cod=$_GET['cod'];
if (mysql_query("delete from integrantes_constantes where cedula = $id and cod_constantes=$cod",$link))
{abrir_popup("../mensaje.php?texto=Constante Eliminada&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
}
if ($_GET['pag']=='')
echo '<script languaje="Javascript">location.href="../constantes_integrantes.php?id='.$_GET['id'].'"</script>';//si es no gral
else
echo '<script languaje="Javascript">location.href="../asignacion_constantes_general.php?cod='.$_GET['cod'].'"</script>';//si es gral
?>