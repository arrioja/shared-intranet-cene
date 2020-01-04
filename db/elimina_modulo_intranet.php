<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  elimina los datos de un modulo la base de datos.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 $codigo=$_GET['cod'];
 include("conexion.php");
 $link=conectarse("intranet"); 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 
 if (($borra1=mysql_query("delete from intranet.modulos where codigo_modulo='$codigo'") or die(mysql_error())) && 
     ($borra2=mysql_query("delete from intranet.permisos_grupos where codigo_modulo='$codigo'") or die(mysql_error())) &&
	 ($borra3=mysql_query("delete from intranet.permisos_usuarios where codigo_modulo='$codigo'") or die(mysql_error())))
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
