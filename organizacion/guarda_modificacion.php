<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Paúl González y Rosanny Yáñez
  Descripción General:  Este archivo inserta los registros de organizaciones en la tabla gestion_organizacion en la base de datos
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. Se modificaron las rutas de acceso para trabajar con la intranet y los nombres
														   de las bases de datos.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
  include("../db/conexion.php");
  $link=conectarse("organizacion");
  $cod=$_GET['seleccionado'];
  $nombre=$_POST['nombre'];
  $abrevia=$_POST['abrevia'];
  $siglas=$_POST['siglas'];
  $mision=$_POST['mision'];
  $vision=$_POST['vision'];
 
  $sql="UPDATE organizacion.direcciones set nombre_completo='$nombre', nombre_abreviado='$abrevia', siglas='$siglas', mision='$mision', vision='$vision' where codigo=$cod";
     if ($result=mysql_query($sql,$link));
       {
         echo "<script language='javascript'> location.href='admin_direccion.php';";
         echo "</script>";
       }

?>