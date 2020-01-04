<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Paúl González y Rosanny Yáñez
  Descripción General:  Este archivo inserta los registros de organizaciones en la tabla gestion_organizacion en la base de datos
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. Se modificaron las rutas de acceso para trabajar con la intranet y los nombres
														   de las bases de datos, así como los Css.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
  include("../db/conexion.php");
  $link=conectarse("organizacion");
  $codigo=$_POST['codigo'];
//valida que no este el objetivo
  $sql="select * from direcciones where codigo='$codigo'";
  $result=mysql_query($sql,$link);
  $cant_row=mysql_affected_rows($link);
  if ($cant_row==0)
    {
	  $nombre=$_POST['nombre'];
	  $abrevia=$_POST['abrevia'];
	  $siglas=$_POST['siglas'];
	  $mision=$_POST['mision'];
	  $vision=$_POST['vision'];
	  $select=$_POST['select'];
	  $fecha=date("Y-m-d");
      $sql="insert into direcciones (codigo, nombre_completo, nombre_abreviado, siglas, mision, vision, 
	  								 codigo_organizacion, fecha_creacion, status) 
	                          value ('$codigo','$nombre', '$abrevia','$siglas', '$mision', '$vision', '$select','$fecha','ACTIVO')";
      if ($result=mysql_query($sql,$link) or die (mysql_error()))
	    {
          echo "<script language='javascript'> location.href='admin_direccion.php';";
          echo "</script>";
        }
    }
 else 
   echo "<script language='javascript'>  alert('El Codigo ya Existe');location.href='direccion.php';</script>";
 
 ?>