<?php 
{
$res=mysql_query("SELECT count(id)+1 FROM gestion.gestion_actividades",$link);
$row=mysql_fetch_array($res);
echo "<input type='hidden' name='codigo' value='".$row[0]."'>"; 
}  ?>
