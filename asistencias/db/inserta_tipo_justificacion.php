<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Inserta en la base de datos un nuevo tipo de justificación de asistencias para ser mostrados en los combos.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						11/09/2008 por Pedro E. Arrioja M. - Se añade rastreo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 $descripcion=$_POST['desc'];
 $codigo=$_POST['cod'];
 $visible=$_POST['visible'];
 include("../../db/conexion.php");
 $link=conectarse("asistencias");
// $link=conectarse("organizacion");
  
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 if ($insertar=mysql_query("insert into asistencias.tipo_faltas(codigo,descripcion,visible) values ('$codigo','$descripcion','$visible')") or die(mysql_error()))
 {
    // para ingresar marca de auditoria.   
   session_start();
   include("../../db/inserta_rastreo.php");
   $descripcion='Inserta nuevo tipo de falta a la asistencia: '.$descripcion;
   $ip = $REMOTE_ADDR; 
   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
 
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../incluir_tipo_justificacion.php", true); 
 }
  else
 {
   $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
   mysql_query("ROLLBACK",$link); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
   // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
   echo '<script languaje="Javascript">location.href="../../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';	
  };  
?>
