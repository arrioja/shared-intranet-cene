<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  inserta los datos de un nuevo sistema en la base de datos.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versi�n: 	0.1b
     ****************************************************  FIN DE INFO
*/
 $codigo=$_POST['codigo'];
 $nombre_corto=$_POST['nombre_corto'];
 $nombre_largo=$_POST['nombre_largo'];
 $imagen_grande=$_POST['imagen_grande']; 
 $imagen_pequena=$_POST['imagen_pequena'];
 $directorio=$_POST['directorio'];
 
 include("conexion.php");
 $link=conectarse("intranet"); 
 // para seleccionar la base de datos de N�mina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 if ($insertar=mysql_query("insert into sistemas(codigo_sistema,nombre_corto,nombre_largo,imagen_g,imagen_p, directorio) values ('$codigo','$nombre_corto','$nombre_largo','$imagen_grande','$imagen_pequena','$directorio')") or die(mysql_error()))
 {
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../listar_sistemas_intranet.php", true); 
 }
  else
 {
       $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
       mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
       // mando a mostrar el mensaje.php con el a�adido del mensaje de error generado por el motor de BD
       echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';	
  };  
?>
