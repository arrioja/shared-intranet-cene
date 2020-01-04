<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  edita los tatos de una actuación fiscal, este archivo además modifica los datos de la asistencia de todos aquellos
  						funcionarios vinculados con la actuación objeto de modificación. para que aparezcan de una forma automática
						y no haya que ir a cada funcionario y modificar las observaciones de asistencia en cada caso.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 include("../../db/conexion.php");
 include("../../libs/utilidades.php");
 $oficio=$_POST['oficio'];
 $ente=$_POST['ente'];
 $dias=$_POST['dias'];
 $oficioviejo=$_POST['oficioviejo'];
 $desde=cambiaf_a_mysql($_POST['desde']); 
 $link=conectarse("asistencias"); 
 $hasta=suma_dias_habiles($_POST['desde'], $dias, $link);
 $hasta=cambiaf_a_mysql($hasta);
 $id=$_POST['id'];
 mysql_query("BEGIN");  //inicio la transaccion
 
 if ($editar=mysql_query("UPDATE actuaciones SET 
 						  oficio='$oficio',dias_habiles='$dias',desde='$desde',hasta='$hasta',codigo_ente_organismo='$ente' 
						  WHERE id='$id' ",$link) or die(mysql_error()))
 { // ahora modifico fechas y duración en las observaciones de asistencias de los funcionarios involucrados en la actuación.
   $consulta=mysql_query("Select a.*, p.nombres, p.apellidos 
   						  from organizacion.personas p, asistencias.actuaciones_funcionarios a 
   						  where ((a.oficio='$oficioviejo') and (a.cedula=p.cedula))",$link);
   while($resultado=mysql_fetch_array($consulta)) // lo hago por cada uno de los funcionarios involucrados
     { $cod_just=$resultado['id_obs_asistencia'];
 
       $consulta_actuacion=mysql_query("SELECT e.nombre FROM asistencias.entes_organos as e 
					                    WHERE (e.codigo='$ente')",$link) or die(mysql_error());	
       $resultado_act=mysql_fetch_array($consulta_actuacion); 

	   // Se genera la observación para incluirse en la asistencia.
	   $observaciones="El funcionario(a) ".$resultado['nombres']." ".$resultado['apellidos'].", titular de la c&eacute;dula de identidad ".
	   				  $resultado['cedula'].", se encuentra realizando actuaci&oacute;n fiscal en: ".$resultado_act['nombre'].", durante ".$dias.
					  " d&iacute;as, desde el ".cambiaf_a_normal($desde)." hasta el d&iacute;a ".
					  cambiaf_a_normal($hasta)." seg&uacute;n oficio n&uacute;mero ".$oficio;	   
	      
	   $editar2=mysql_query("UPDATE justificaciones_dias SET 
 						     fecha_desde='$desde',fecha_hasta='$hasta',observaciones='$observaciones' 
						     WHERE codigo_just='$cod_just' ",$link) or die(mysql_error());  
	 } // del ehile resultado

   if ($oficio != $oficioviejo)
     { // si se modificó el nro de oficio, entonces tengo que actualizar ese campo en actuaciones_funcionarios
       if ($editar=mysql_query("UPDATE actuaciones_funcionarios SET 
 		  				      oficio='$oficio' WHERE oficio='$oficioviejo' ",$link) or die(mysql_error()))
	     { 
           mysql_query("COMMIT",$link);  // para grabar los datos definitivamente y cerrar la transaccion
           header ("Location: ../listar_actuaciones.php", true); 
         }
     }
   else
     { // si no se modificó el nro de oficio, simplemente hago commit
	    mysql_query("COMMIT",$link);  // para grabar los datos definitivamente y cerrar la transaccion
        header ("Location: ../listar_actuaciones.php", true); 
	 }
 } //del editar
  else
 {
   echo " Error gruardando los datos - ";
   echo mysql_error();
   echo " ----- Antes de cerrar este mensaje de error, por favor contacte al soporte t&eacute;cnico de la Direcci&oacute;n de Sistemas para tomen las previsiones y lo corrijan oportunamente"; 
   mysql_query("ROLLBACK",$link); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
  };  
?>
