<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  edita un dia no laborable en la base de datos
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						11/09/2008 por PEdro E. Arrioja M. - Se añade rastreo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 $descripcion=$_POST['desc'];
 $ano=$_POST['ano'];
 $mes=$_POST['mes'];
 $dia=$_POST['dia'];
 $id=$_POST['id'];
 include("../../db/conexion.php");
 $link=conectarse("organizacion"); 
 mysql_query("BEGIN");  //inicio la transaccion
 
 if ($editar=mysql_query("update organizacion.dias_no_laborables set dia='$dia', mes='$mes', ano='$ano', descripcion='$descripcion' where id='$id'",$link) or die(mysql_error()))
 {
    session_start();
   include("../../db/inserta_rastreo.php");
   $descripcion='Modificado dia no laborable: '.$dia.'/'.$mes.'/'.$ano;
   $ip = $REMOTE_ADDR; 
   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'M',$descripcion,$ip);
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../listar_no_laborables.php", true); 
 }
  else
 {
   $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
   // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
   echo '<script languaje="Javascript">location.href="../../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';
  };  
?>
