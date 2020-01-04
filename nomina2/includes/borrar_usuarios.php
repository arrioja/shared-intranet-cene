<?php
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['id'];
mysql_query("delete from usuarios where id = '$id'",$link); 
abrir_popup("../mensaje.php?texto=Usuario Eliminado&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");   
echo '<script languaje="Javascript">location.href="../usuarios.php"</script>';
?>