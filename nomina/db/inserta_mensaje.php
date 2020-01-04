<?php 
 $codigo=$_POST['codigo'];
 $titulo=$_POST['titulo'];
 $texto=$_POST['texto'];
 $imagen=$_POST['imagen']; 

 include("conexion.php");
 $link=conectarse("intranet"); 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 if ($insertar=mysql_query("insert into mensajes(codigo,titulo,imagen,mensaje) values ('$codigo','$titulo','$imagen','$texto')") or die(mysql_error()))
 {
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../listar_mensaje.php", true); 
 }
  else
 {
   echo " Error gruardando los datos - ";
   echo mysql_error();
   echo " ----- Antes de cerrar este mensaje de error, por favor contacte al soporte t&eacute;cnico de la Direcci&oacute;n de Sistemas para tomen las previsiones y lo corrijan oportunamente"; 
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
  };  
?>
