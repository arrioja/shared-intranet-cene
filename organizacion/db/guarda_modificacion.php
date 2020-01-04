<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Paúl González y Rosanny Yáñez
  Descripción General:  Este archivo inserta los registros de organizaciones en la tabla gestion_organizacion en la base de datos 
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - se modificaron las rutas de acceso para trabajar con la intranet y los nombres
															de las bases de datos.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
include ("../../db/conexion.php");
$link=conectarse("organizacion");
$cod=$_POST['cod'];
$nombre=$_POST['nombre'];
$mision=$_POST['mision'];
$vision=$_POST['vision'];
$sql="UPDATE organizaciones set nombre='$nombre', mision='$mision', vision='$vision' where codigo=$cod";
if ($result=mysql_query($sql,$link) or die(mysql_error()));
  {
    echo "<script language='javascript'> location.href='../listar_organizacion.php';";
    echo "</script>";
  }
?>
