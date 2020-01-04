<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  edita los datos de un modulo en la base de datos.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 $nombre_corto=$_POST['nombre_corto'];
 $nombre_largo=$_POST['nombre_largo'];
 $imagen_grande=$_POST['imagen_grande']; 
 $imagen_pequena=$_POST['imagen_pequena'];
 $archivo_php=$_POST['archivo_php']; 
 $id=$_POST['id'];
 include("conexion.php");
 $link=conectarse("intranet"); 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 
 if ($edita=mysql_query("update modulos set nombre_corto='$nombre_corto', nombre_largo='$nombre_largo', imagen_g='$imagen_grande', imagen_p='$imagen_pequena', archivo_php='$archivo_php' where id='$id'") or die(mysql_error()))
 {
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../listar_modulos_intranet.php", true); 
 }
  else
 {
   $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
   // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
   echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';	
  };  
?>
