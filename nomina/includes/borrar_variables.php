<?php
include("libreria.php");
$link=conectarse("nomina");
$id=$_GET['id'];
if (mysql_query("delete from variables where cod = '$id'",$link))
{
abrir_popup("../mensaje.php?texto=Variable Eliminada&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");  
echo '<script languaje="Javascript">location.href="../variables.php"</script>'; 
//header("Location: ../variables.php");
}
?>