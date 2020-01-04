<?php  
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Paúl González y Rosanny Yáñez
  Descripción General:  Este archivo inserta los registros de organizaciones en la tabla gestion_organizacion en la base de datos 
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - se modificaron las rutas de acceso para trabajar con la intranet y los nombres
															de las bases de datos.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$mision=$_POST['mision'];
$vision=$_POST['vision'];

include ("../../db/conexion.php");
$link=conectarse("organizacion");
if (isset($codigo))
 {
    //valida que no este el objetivo
    $sql="select * from organizaciones where codigo='$codigo'";
    $result=mysql_query($sql,$link);
    $cant_row=mysql_affected_rows($link);
    if ($cant_row==0)
	 {
       $sql="insert into organizaciones(codigo, nombre, mision, vision) value ('$codigo','$nombre', '$mision', '$vision')";
       if ($result=mysql_query($sql,$link) or die(mysql_error()));
         {
            echo "<script language='javascript'> location.href='../listar_organizacion.php';";
            echo "</script>";
         }
     }
    else 
      echo "<script language='javascript'>  alert('El Codigo ya Existe');location.href='../insertar_organizacion.php';</script>";
  } // del isset organizacion
 ?>


