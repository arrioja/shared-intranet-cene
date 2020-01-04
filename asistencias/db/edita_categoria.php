<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Edita una categoría de la base de datos.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						11/09/2008 por Pedro E. Arrioja M. - Se añade rastreo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 $descripcion=$_POST['desc'];
 $descuento=$_POST['descuento'];
 $visible=$_POST['visible'];
 $id=$_POST['id'];
 include("../../db/conexion.php");
 $link=conectarse("asistencias"); 
 mysql_query("BEGIN");  //inicio la transaccion
 
 if ($insertar=mysql_query("update tipo_justificaciones set descripcion='$descripcion', descuenta_ticket='$descuento', visible='$visible' where id='$id'") or die(mysql_error()))
 {
    // para ingresar marca de auditoria.   
   session_start();
   include("../../db/inserta_rastreo.php");
   $descripcion='Modificado tipo de justificaci&oacute;n: '.$descripcion;
   $ip = $REMOTE_ADDR; 
   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'M',$descripcion,$ip);
 
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../listar_categorias.php", true); 
 }
  else
 {
   $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
   // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
   echo '<script languaje="Javascript">location.href="../../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';
  };  
?>
