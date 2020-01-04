<?php 
 $nombre_corto=$_POST['nombre_corto'];
 $nombre_largo=$_POST['nombre_largo'];
 $imagen_grande=$_POST['imagen_grande']; 
 $imagen_pequena=$_POST['imagen_pequena'];
 $directorio=$_POST['directorio'];
 $id=$_POST['id'];
 include("conexion.php");
 $link=conectarse("intranet"); 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 
 if ($edita=mysql_query("update sistemas set nombre_corto='$nombre_corto', nombre_largo='$nombre_largo', imagen_g='$imagen_grande', imagen_p='$imagen_pequena', directorio='$directorio' where id='$id'") or die(mysql_error()))
 {
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../listar_sistemas_intranet.php", true); 
 }
  else
 {
   echo " Error guardando los datos - ";
   echo mysql_error();
   echo " ----- Antes de cerrar este mensaje de error, por favor contacte al soporte t&eacute;cnico de la Direcci&oacute;n de Sistemas para tomen las previsiones y lo corrijan oportunamente"; 
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
  };  
?>
