<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Inserta un permiso en la base de datos y lo deja pendiente para su aprobación.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						11/09/2008 por Pedro E. Arrioja M. - Se añade rastreo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 require("../../libs/utilidades.php");
 require("../../db/conexion.php");
 $cedula=$_POST['cedula']; 
 $fecha_desde=cambiaf_a_mysql($_POST['fecha_desde']);
 $hora_desde=date("G:i",strtotime($_POST['hora_desde']));//Para convertir la hora de formato 12 a 24   ;
 $fecha_hasta=cambiaf_a_mysql($_POST['fecha_hasta']);
 $hora_hasta=date("G:i",strtotime($_POST['hora_hasta']));
 $falta=$_POST['falta'];

 $tipo=$_POST['tipo'];

 $observaciones=$_POST['observaciones'];
 
 $link=conectarse("asistencias"); 
 
 
 $consulta_tipo=mysql_query("select descuenta_ticket from tipo_justificaciones 
                             where id='$tipo'",$link) or die(mysql_error());
 $resultado_tipo=mysql_fetch_array($consulta_tipo);
 $descuento=$resultado_tipo['descuenta_ticket'];

 $maximo_codigo_consult= mysql_query("select max(codigo) as maxcod from asistencias.justificaciones",$link);
 $maximo_codigo=mysql_fetch_array($maximo_codigo_consult);
 $codigo_nuevo=$maximo_codigo['maxcod']+1;  
 
  mysql_query("BEGIN");  //inicio la transaccion

 if ($insertar=mysql_query("insert into asistencias.justificaciones (codigo, tipo_id_doc, estatus) 
 values ('$codigo_nuevo','PE', '0')",$link) or die(mysql_error()))
 {
   $id_resultante=mysql_insert_id($link);
   
   // si se han gramado los datos generales correctamente seguimos con los dos pasos que restan:
   // 1.- Guardar los datos de la persona.
	 if ($insertar2=mysql_query("insert into asistencias.justificaciones_personas (cedula, codigo_just) 
								 values ('$cedula','$codigo_nuevo')",$link) or die(mysql_error()))
	   {
		 // 2.- pasar los datos de fechas y horas desde la tabla temporal a la definitiva
		 if ($insertar3=mysql_query("insert into asistencias.justificaciones_dias (codigo_just, fecha_desde, hora_desde, fecha_hasta,
									 hora_hasta, codigo_tipo_falta, descuenta_ticket,lun,mar,mie,jue,vie,codigo_tipo_justificacion,observaciones) 
									 values ('$codigo_nuevo','$fecha_desde','$hora_desde','$fecha_hasta','$hora_hasta','$falta','$descuento',
									 '1','1','1','1','1','$tipo','$observaciones')",$link) or die(mysql_error()))
		   {
		   
		      // para ingresar marca de auditoria.   

			   include("../../db/inserta_rastreo.php");
			   $descripcion='Inserta solicitud de permiso: '.$codigo_nuevo;
			   $ip = $REMOTE_ADDR; 
			   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
		   
			 mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
			 ?>
             
                <link href="../../css/formularios.css" rel="stylesheet" type="text/css" />
                <link href="../../css/index.css" rel="stylesheet" type="text/css" />
                <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr class="encabezado_formularios">
                      <td width="500">Permiso solicitado exitosamente</td>
                    </tr>
                    <tr>
                      <td class="datos_formularios"><div align="justify">El permiso ha sido solicitado exitosamente, y
                      ha sido almacenado con el n&uacute;mero<strong> <?php echo $codigo_nuevo ?>,</strong> el siguiente paso es la 
                      aprobaci&oacute;n o negaci&oacute;n por parte del director respectivo.</div></td>
                    </tr>
                    <tr>
                      <td class="datos_formularios"><div align="center">
                        <input type="button" name="Volver" id="Volver" value="Volver" 
                        onclick="javascript: location.href='../incluir_permiso_cedula.php'" />
                      </div></td>
                    </tr>
                  </table>              
			<?php
		   } // del insertar3
		 else
		  {
			$msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
			mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
			// mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
			echo '<script languaje="Javascript">location.href="../../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';
		  } // del else del insertar 3 (fechas y horas)
			 
	  } // del insertar2 (personas)
  } // del insertar (datos generales del permiso  
?>