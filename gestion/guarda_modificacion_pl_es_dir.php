<?php 
/*
* Este archivo inserta los registros de organizaciones en la tabla gestion_organizacion en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/?>
<?php
  include("../db/conexion.php");
  $link=conectarse("gestion");
  $cod=$_GET['seleccionado'];
  $nombre=$_POST['nombre'];
  $aqo_inicio=$_POST['aqo_inicio'];
  $aqo_fin=$_POST['aqo_fin'];
   
 $sql="UPDATE gestion_planes_estrategicos_direcciones set nombre='$nombre', aqo_inicio='$aqo_inicio', aqo_fin='$aqo_fin' where codigo=$cod";
 if ($result=mysql_query($sql,$link));
 {
 echo "<script language='javascript'> alert (\"Los datos han sido modificados correctamente\");
  </script>";
 echo "<script language='javascript'>location.href='admin_planes_estrategicos_direccion.php';";
    echo "</script>";
 }

 ?>