<?php 

{
include ("../conexion/conectar.php");
$res=mysql_query("SELECT max(id)+1 FROM gestion_fases",$link);
$row=mysql_fetch_array($res);
echo "<input type='hidden' name='codigo' value='".$row[0]."'>"; 
}  ?>
