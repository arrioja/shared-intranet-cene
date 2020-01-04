<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  este archivo inserta una justificación a la asistencia en la base de datos; las justificaciones pueden ser únicas 
  						(por una sola persona) o múltiples (por varias personas), además simples (un solo set de fechas) o complejas (varias
						fechas de inicio con varias fechas de fin con varias justificaciones y varios tipos); por ejemplo: una justificación
						múltiple y compleja sería:
						Juan, Pedro y Luis tiene permiso para llegar los lunes tarde del 01/03/2008 al 31/09/2008 por motivos académicos y además
						los lunes, miércoles y viernes del 01/05/2008 al 31/12/2008 tiene permiso para irse temprano por motivos médicos.
						Es necesario que se estudie este códifo a fondo si se quiere
						modificar por cuanto hay trabajos con tablas temporales, números aleatorios y consultas múltiples y anidadas que 
						pueden oscurecer un poco el panorama; de cualquier manera, está hecha de la forma más entendible que se me ocurrió.
 		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creación
						11/09/2008 por Pedro E. Arrioja M. - Se añade rastreo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 require("../../libs/utilidades.php");
 require("../../db/conexion.php");
 include("../../db/inserta_rastreo.php");
 if(!empty($_POST['cedula']))   // se comprueba que "cedula" tenga valor si es una sola o sino "cedulas" si vienen varios
   {$cedula=$_POST['cedula'];}  // para saber si viene un solo empleados o si vienen en grupo
 else 
   {$lista_cedulas=explode(";",$_POST['cedulas']);}
 
 $fecha_desde=cambiaf_a_mysql($_POST['fecha_desde']);
 $hora_desde=date("G:i",strtotime($_POST['hora_desde']));//Para convertir la hora de formato 12 a 24   ;
 $fecha_hasta=cambiaf_a_mysql($_POST['fecha_hasta']);
 $hora_hasta=date("G:i",strtotime($_POST['hora_hasta']));
 $falta=$_POST['falta'];
 $tipo=$_POST['tipo'];
 $descuento=$_POST['descuento'];
 $observaciones=$_POST['observaciones'];
 $aleatorio=$_POST['aleatorio'];
 
 $link=conectarse("asistencias"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Inserta Justificaci&oacute;n</title>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(../../imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->
        <link href="../../css/formularios.css" rel="stylesheet" type="text/css" />
         <link href="../../css/index.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="../../imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="../../imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="../../imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="../../imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="../../imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="../../imgs/CENE_07.png">      <div align="right">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="vinculos"><div align="left">Usuario: <?php if (isset($_SESSION['nombres'])) { echo $_SESSION['apellidos']." ".$_SESSION['nombres']; } else {echo " Sin sesi&oacute;n iniciada";}?></div></td>
            <td><div align="right"><span class="vinculos"><a href="index.php" class="vinculos">Inicio</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="login.php" class="vinculos">Salir</a>&nbsp;&nbsp;</span></div></td>
          </tr>
        </table>
        </div></td>
  </tr>
  <tr>
    <td valign="top"><!-- InstanceBeginEditable name="menu_izquierda" --><!-- InstanceEndEditable -->    </td>
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" -->
  <?php
	 // se obtiene el máximo código registrado para poder registrar el nuevo, no quiero dejar eso en manos del index pq si llegase a reindexarse la 
	 // tabla por cualquier motivom todas las referencias a permisos se perderían y todos los datos serían inútiles. ESTO ES IMPORTANTE !!!
     $maximo_codigo_consult= mysql_query("select max(codigo) as maxcod from asistencias.justificaciones",$link);
	 $maximo_codigo=mysql_fetch_array($maximo_codigo_consult);
	 $codigo_nuevo=$maximo_codigo['maxcod']+1;  
  
  if (isset($cedula)) // Si cédula existe entonces es solo un empleado y se incluye un solo registro
  {     
	 mysql_query("BEGIN");  //inicio la transaccion
	 
	 // se insertan los datos generales de ls justificación en "justificaciones"
	 if ($insertar=mysql_query("insert into asistencias.justificaciones (codigo, tipo_id_doc, estatus) 
	 values ('$codigo_nuevo','RH', '1')",$link) or die(mysql_error()))
	 {
	   $id_resultante=mysql_insert_id($link);
	   
	   // si se han gramado los datos generales correctamente seguimos con los dos pasos que restan:
	   // 1.- Guardar los datos de la persona.
	   	 if ($insertar2=mysql_query("insert into asistencias.justificaciones_personas (cedula, codigo_just) 
		 							 values ('$cedula','$codigo_nuevo')",$link) or die(mysql_error()))
		   {
		     // 2.- pasar los datos de fechas y horas desde la tabla temporal a la definitiva
			 if ($insertar3=mysql_query("insert into asistencias.justificaciones_dias (codigo_just, fecha_desde, hora_desde, fecha_hasta,
			 						     hora_hasta, codigo_tipo_falta, 
										 descuenta_ticket,lun,mar,mie,jue,vie,codigo_tipo_justificacion,observaciones) 
										 select codigo_just, fecha_desde, hora_desde, fecha_hasta, hora_hasta, codigo_tipo_falta, 
										 descuenta_ticket,lun,mar,mie,jue,vie,codigo_tipo_justificacion,observaciones 
										 from asistencias.justificaciones_dias_tmp 
			 							 where (codigo_just='$aleatorio')",$link) or die(mysql_error()))
			   { // ya que luego del movimiento de datos entre tablas, se guardan los datos del numero aleatorio, se debe sustituir dicho numero
			     // por el codigo que en realidad le corresponde tener.
			     $modif=mysql_query("update asistencias.justificaciones_dias set codigo_just='$codigo_nuevo' where (codigo_just='$aleatorio')",$link);
				 // y ahora se elimina el temporal creado para evitar duplicidad de registros
				 $elimi=mysql_query("delete from asistencias.justificaciones_dias_tmp where (codigo_just='$aleatorio')",$link);
				   
				   // para ingresar marca de auditoria.   
				   $descripcion='Inserta Justificaci&oacute;n N&uacute;mero: '.$codigo_nuevo;
				   $ip = $REMOTE_ADDR; 
				   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
				 
				 
			     mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
				 ?>
	  <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
            		<tr class="encabezado_formularios">
              		<td width="500">Justificaci&oacute;n insertada correctamente</td></tr><tr>
              		<td class="datos_formularios"><div align="justify">La justificaci&oacute;n se ha guardado exitosamente en la base de datos 
                    con el n&uacute;mero:<strong> <?php echo $codigo_nuevo ?></strong> en el registro nro: <?php echo $id_resultante ?>
              		</div></td>
            		</tr>
            		<tr>
                    <td class="datos_formularios"><div align="center">
                      <input type="button" name="Volver" id="Volver" value="Volver" 
                      onclick="javascript: location.href='../incluir_justificacion_individual_cedula.php'" />
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
	 
  } else
  { // si cedula no existe, quiere decir que existe "cedulas" y son varios, asi que se hace una inclusion por cada valor del array
     $ocurrio_error='NO'; // inicializacion de la variable para saber si todo ocurrio bien
	 if ($insertar=mysql_query("insert into asistencias.justificaciones (codigo, tipo_id_doc, estatus) 
	 values ('$codigo_nuevo','RH', '1')",$link) or die(mysql_error()))
	 {
	   $id_resultante=mysql_insert_id($link);	   
	   // si se han gramado los datos generales correctamente seguimos con los dos pasos que restan:
	   // 1.- Guardar los datos de la persona.
	   if ($insertar3=mysql_query("insert into asistencias.justificaciones_dias (codigo_just, fecha_desde, hora_desde, fecha_hasta,
			 						hora_hasta, codigo_tipo_falta, descuenta_ticket,lun,mar,mie,jue,vie,codigo_tipo_justificacion, observaciones) 
	   								select codigo_just, fecha_desde, hora_desde, fecha_hasta, hora_hasta,
									codigo_tipo_falta, descuenta_ticket,lun,mar,mie,jue,vie,codigo_tipo_justificacion, observaciones 
									from asistencias.justificaciones_dias_tmp where (codigo_just='$aleatorio')",$link) or die(mysql_error()))
		 { // ya que luego del movimiento de datos entre tablas, se guardan los datos del numero aleatorio, se debe sustituir dicho numero
		   // por el codigo que en realidad le corresponde tener.
		   $modif=mysql_query("update asistencias.justificaciones_dias set codigo_just='$codigo_nuevo' where (codigo_just='$aleatorio')",$link);	
		   	// y ahora se elimina el temporal creado para evitar duplicidad de registros
		   $elimi=mysql_query("delete from asistencias.justificaciones_dias_tmp where (codigo_just='$aleatorio')",$link);
		   ?>		   
		    <link href="../../css/formularios.css" rel="stylesheet" type="text/css" />	
            <table width="489" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="2" class="encabezado_formularios">Status de las insersiones de las justificaciones</td>
              </tr>
              <tr>
                <td class="encabezado_formularios">C&eacute;dula</td>
                <td class="encabezado_formularios">Status</td>
              </tr> 		   
		   <?php
     			foreach ($lista_cedulas as $una_cedula) {	
	 			mysql_query("BEGIN");  //inicio la transaccion
	 			if ($insertar2=mysql_query("insert into asistencias.justificaciones_personas (cedula, codigo_just) 
		 							       values ('$una_cedula','$codigo_nuevo')",$link) or die(mysql_error()))
	 			 {	   
	  			   $id_resultante=mysql_insert_id($link);
				   // para ingresar marca de auditoria.   
				   $descripcion='Inserta Justificaci&oacute;n N&uacute;mero: '.$codigo_nuevo;
				   $ip = $REMOTE_ADDR; 
				   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
				   
				   
				   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
     		?>     
        		   <tr>
          		     <td class="datos_formularios"><div align="center"><?php echo $una_cedula ?></div></td>
          		     <td class="datos_formularios"><div align="center">OK - Guardado bajo Justificación: <strong><?php echo $codigo_nuevo ?></strong>, registro: <?php echo $id_resultante ?></div></td>
        		   </tr> 
	  		<?php 
	 			 } // del insertar2 personas
	  			else
	 			 { 	  
	   			    $ocurrio_error='SI';
	   				mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
	   		?>
					<tr>
          			  <td class="datos_formularios"><div align="center"><?php echo $una_cedula ?></div></td>
          			  <td class="datos_formularios"><div align="center">ERROR:  <?php echo mysql_error();?>;</div></td>
        			</tr>
	   		<?php	   
	  			  }; // del else de insertar personas
				}; // del for each de las cedulas       
		 } // del insertar 3 (datos de fechas y horas
	  } //del insertar
	
 ?>
        <tr>
          <td colspan="2" class="datos_formularios"><div align="center">
          
<?php   
       if ($ocurrio_error=="SI") 
	   echo " Han ocurrido errores mientras se guardaban las justificaciones, notifique a la dirección de sistemas para que tome nota del tipo de error presentado.";     ?>              
          </div></td>
        </tr>
        <tr>
          <td colspan="2" class="datos_formularios"><div align="right"><input type="button" name="Volver" id="Volver" value="Volver" 
                onclick="javascript: location.href='../incluir_justificacion_grupal.php'" /></div></td>
        </tr>
      </table>

<?php 

}
  
?>

<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Monday, 8 December, 2008 12:22 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>  