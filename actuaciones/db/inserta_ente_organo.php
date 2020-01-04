<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  inserta un ente u organo sujeto a control en la base de datos
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 $codigo=$_POST['codigo'];
 $siglas=$_POST['siglas'];
 $nombre=$_POST['nombre'];
 $tipo=$_POST['tipo']; 

 include("../../db/conexion.php");
 $link=conectarse("asistencias"); 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 if ($insertar=mysql_query("insert into entes_organos(codigo,siglas,nombre,tipo) values ('$codigo','$siglas','$nombre','$tipo')") or die(mysql_error()))
 {
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../listar_entes_organos.php", true); 
 }
  else
 {
   echo " Error gruardando los datos - ";
   echo mysql_error();
   echo " ----- Antes de cerrar este mensaje de error, por favor contacte al soporte t&eacute;cnico de la Direcci&oacute;n de Sistemas para tomen las previsiones y lo corrijan oportunamente"; 
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
  };  
?>
