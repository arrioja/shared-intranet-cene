<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  este archivo contiene una función que puede ser llamada desde cualquier php que haga referencia al mismo
  						y dado los parámetros que se explican abajo, incluye en el sistema las marcas de rastreos necesarias para
						dar seguimiento a las actividades de los usuarios en el sistema.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 /* Con respecto a esta función, el parámetro tipo puede tener uno de los siguientes valores: 
 	L: Login y Logout de la Intranet
	C: Consulta de Datos, sea en forma de Listado o individualmente
	I: Inclusión de Datos en el Sistema.
	M: Modificación de Datos en el Sistema
	E: Eliminación de Datos en el Sistema
	R: Error en la insersión de Datos.
	A: Aprobaciones o Autorizaciones.
	D: Desaprobaciones o Rechazos
 */
  function inserta_rastro($login,$cedula,$tipo,$descripcion,$ip)
    {
	  // Con esta comprobacion evito que me de el error de redeclarar la conexión cuando se llama a esta función desde un php que haya
	  // usado el "conectarse".
	 // if ($link999=conectarse("personal") == false) {include("conexion.php");}
	  $link999=conectarse("intranet"); 
	  // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
	  mysql_query("BEGIN");  //inicio la transaccion
	  if ($insertar=mysql_query("insert into rastreo(login,cedula,tipo,descripcion,ip) values ('$login','$cedula','$tipo','$descripcion','$ip')",$link999) or die(mysql_error()))
	   {
		 mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
		// header ("Location: ../listar_grupos_intranet.php", true); 
	   }
		  else
		 {		  
           $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
           mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
           // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
           echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';	
		  };  
	}
?>
