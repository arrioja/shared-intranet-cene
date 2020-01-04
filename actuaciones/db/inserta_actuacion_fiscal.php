<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  inserta una nueva actuación fiscal en la base de datos.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 include("../../db/conexion.php");
 include("../../libs/utilidades.php");
 $oficio=$_POST['oficio'];
 $ente=$_POST['ente'];
 $dias=$_POST['dias'];
 $desde=cambiaf_a_mysql($_POST['desde']); 
 $link=conectarse("asistencias"); 
 $hasta=suma_dias_habiles($_POST['desde'], $dias, $link);
 $hasta=cambiaf_a_mysql($hasta);
 mysql_query("BEGIN");  //inicio la transaccion
 if ($insertar=mysql_query("insert into actuaciones(oficio,dias_habiles,desde,hasta,codigo_ente_organismo) values ('$oficio','$dias','$desde','$hasta','$ente')") or die(mysql_error()))
 {
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../listar_actuaciones.php", true); 
 }
  else
 {
   echo " Error gruardando los datos - ";
   echo mysql_error();
   echo " ----- Antes de cerrar este mensaje de error, por favor contacte al soporte t&eacute;cnico de la Direcci&oacute;n de Sistemas para tomen las previsiones y lo corrijan oportunamente"; 
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
  };  
?>
