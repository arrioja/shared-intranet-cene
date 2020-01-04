<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Inserta un nuevo día no laborable en la base de datos; los dias no laborables son usados por el sistema de 
  						asistencia para justificar la falta de todos los empleados a laborar durante ese día.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						11/09/2008 por Pedro E. Arrioja M. - Se añade rastreo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 $descripcion=$_POST['desc'];
 $dia=$_POST['dia'];
 $mes=$_POST['mes'];
 $ano=$_POST['ano'];
 include("../../db/conexion.php");
 $link=conectarse("organizacion"); 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 if ($insertar=mysql_query("insert into organizacion.dias_no_laborables (dia, mes, ano, descripcion) values ('$dia', '$mes', '$ano', '$descripcion')",$link) or die(mysql_error()))
 {
    // para ingresar marca de auditoria.   
   session_start();
   include("../../db/inserta_rastreo.php");
   $descripcion='Inserta dia no laborable: '.$dia.'/'.$mes.'/'.$ano;
   $ip = $REMOTE_ADDR; 
   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
 
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../incluir_no_laborable.php", true); 
 }
  else
 {
   $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
   // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
   echo '<script languaje="Javascript">location.href="../../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';
  };  
?>
