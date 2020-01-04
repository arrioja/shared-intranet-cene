<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  elimina una descripción de presupuesto.
  		Modificado el: 	13/11/2008 por Pedro E. Arrioja M. - Creación
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 $id=$_POST['id'];
   include ("../../db/conexion.php");
 $link=conectarse("administracion"); 
 mysql_query("BEGIN");  //inicio la transaccion
 
 if ($borra1=mysql_query("delete from administracion.descripcion_presupuesto where id='$id'") or die(mysql_error())) 
 {
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../eliminar_descripcion_ppto.php", true); 
 }
  else
 {
   $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
   // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
   echo '<script languaje="Javascript">location.href="../../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';	
  };  
?>
