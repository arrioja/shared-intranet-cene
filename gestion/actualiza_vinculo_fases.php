 <?php
include "../db/conexion.php";
$link=conectarse("gestion");
if ($_GET['activo']==1)//inserta
 $sql="insert into gestion_relacion_actividades_fases (fase,precedida) value ('$codigo','$seleccionado')";
else
 $sql="delete from gestion_relacion_actividades_fases where precedida = '$seleccionado' and fase = '$codigo'";
 $result=mysql_query($sql,$link);
 mysql_close($link);
 ?>