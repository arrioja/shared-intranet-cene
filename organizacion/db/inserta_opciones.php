<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Este archivo inserta y modifica los datos del horario de trabajo, etc.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 require("../../libs/utilidades.php");
 require("../../db/conexion.php");
 $hora_entrada=date("G:i",strtotime($_POST['hora_entrada']));//Para convertir la hora de formato 12 a 24   ;
 $hora_salida=date("G:i",strtotime($_POST['hora_salida'])); 
 $holgura_entrada=$_POST['min_entrada'];

 $hora_salida_almuerzo=date("G:i",strtotime($_POST['hora_salida_almuerzo'])); 
 $hora_entrada_almuerzo=date("G:i",strtotime($_POST['hora_entrada_almuerzo']));//Para convertir la hora de formato 12 a 24   ; 
 $almuerzo_minutos=$_POST['min_almuerzo'];
 $max_pot=$_POST['max_pot'];
 
 echo $holgura_entrada.' - '.$almuerzo_minutos;
  
 $link=conectarse("asistencias"); 

// Primero se selecciona el id del que este activo actualmente para desactivarlo si todo sale bien.
 $consulta=mysql_query("select id,status from opciones where status='1'",$link) or die(mysql_error());
 $resultado=mysql_fetch_array($consulta);
 $id_para_desactivar=$resultado['id'];
 
//ahora se inserta y si todo va bien se desactiva el viejo.
  mysql_query("BEGIN");  //inicio la transaccion
  if ($insertar=mysql_query("insert into opciones (hora_entrada, hora_salida, holgura_entrada, almuerzo_salida, almuerzo_entrada, almuerzo_minutos, status, max_pot) values ('$hora_entrada','$hora_salida','$holgura_entrada','$hora_salida_almuerzo','$hora_entrada_almuerzo','$almuerzo_minutos','1',$max_pot)"
	 ,$link) or die(mysql_error()))
	 { // si se realizó bien la insersión, se coloca el anterior como inactivo
	   mysql_query("update opciones set status='0' where id='$id_para_desactivar'",$link);
	   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
	   header ("Location: ../incluir_opciones.php", true); 
	 }
	  else
	 {
	   echo " Error gruardando los datos - ";
	   echo mysql_error();
	   echo " ----- Antes de cerrar este mensaje de error, por favor contacte al soporte t&eacute;cnico de la Direcci&oacute;n 
	   de Sistemas para tomen las previsiones y lo corrijan oportunamente"; 
	   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
	  }; 
?>