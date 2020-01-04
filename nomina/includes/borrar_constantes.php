<?php
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['id'];
mysql_query("delete from constantes where id = '$id'",$link); 
abrir_popup("../mensaje.php?texto=Constante Eliminada&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");  
echo '<script languaje="Javascript">location.href="../constantes.php"</script>';
?>