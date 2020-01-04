<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra el reporte de asistencia individual por un funcionario seleccionado.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 include("../../db/conexion.php");
 include("../../libs/utilidades.php");
 include("../../libs/libchart/classes/libchart.php");
 
  // para ingresar marca de auditoria.   
 include("../../db/inserta_rastreo.php");
 $descripcion='Consulta Asistencia Individual de la C&eacute;dula: '.$_POST['cedula'].' del '.$_POST['desde'].' al '.$_POST['hasta'];
 $ip = $REMOTE_ADDR; 
 inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'C',$descripcion,$ip);
 
 
// Para limpiar los valores de las variables que se mostraran en los graficos de los indicadores.
$ind_asistentes=0;
$ind_asistentes_no_retrasados=0;
$ind_asistentes_tarde_no_just=0;
$ind_asistentes_tarde_si_just=0;
$ind_inasistentes_no_just=0;
$ind_inasistentes_si_just=0;
$ind_asistentes_salidas_no_just=0;
$ind_asistentes_salidas_si_just=0;
$ind_asistentes_salidas_tot=0;
$dias_semana_retrasos=array();
$dias_semana_retrasos_si_just=array();
$dias_semana_retrasos_no_just=array();

 $link=conectarse("asistencias");
  
  $cedula=$_POST['cedula'];
  $desde=cambiaf_a_mysql($_POST['desde']);
  $hasta=cambiaf_a_mysql($_POST['hasta']);
  if (isset($_POST['restringido'])) {$retorno="../asistencia_propia.php";} else {$retorno="../asistencia_cedula.php";}
  
  $consulta_integrantes=mysql_query("select p.id, p.cedula, p.nombres, p.apellidos, p.fecha_ingreso from organizacion.personas as p where p.cedula='$cedula'",$link) 
						or die(mysql_error()); 
  $resultado_integrantes=mysql_fetch_array($consulta_integrantes);	
  
  // se consulta las asistencias del empleado desde la fecha de inicio hasta la fecha de fin, ambas inclusive.
 $consulta=mysql_query("SELECT p.nombres, p.apellidos, 
                               e.cedula, e.fecha,  
							   MIN(e.hora) as entrada, MAX(e.hora) as salida 
					    FROM asistencias.entrada_salida as e, organizacion.personas as p  
						WHERE ((p.cedula = e.cedula) and 
						       (p.cedula = '$cedula') and
						       (e.fecha <= '$hasta') and
							   (e.fecha >= '$desde')) 
					    GROUP BY fecha 
						ORDER BY fecha",$link) or die(mysql_error());
											
  //$consulta_horario=mysql_query("select * from asistencias.opciones where (status = '1')",$link) or die(mysql_error());
  //$resultado_horario=mysql_fetch_array($consulta_horario);  
  

  
  
// Ahora consulto las justificaciones que tengan los empleados para la fecha seleccionada y que se encuentren aprobadas  
 $consulta_just=mysql_query("SELECT (p.cedula) as cedula_just, p.nombres, p.apellidos, j.*, jp.*, jd.*
					    FROM asistencias.justificaciones as j, asistencias.justificaciones_dias as jd, 
						     asistencias.justificaciones_personas as jp, organizacion.personas as p 
						WHERE (
						       (p.cedula = jp.cedula) and 
						       (p.cedula = '$cedula') and
						       ((
							     (jd.fecha_desde <= '$desde') and
							     (jd.fecha_hasta >= '$desde')
								 ) Or
							    (
							     (jd.fecha_desde <= '$hasta') and
							     (jd.fecha_hasta >= '$hasta')
							   ) or 
							   (
							     (jd.fecha_desde >= '$desde') and
							     (jd.fecha_hasta <= '$hasta')
								)) and							   
							   (j.estatus='1') and (j.codigo=jd.codigo_just) and (j.codigo=jp.codigo_just)
							  ) 
						ORDER BY jd.fecha_desde",$link) or die(mysql_error()); 
 // para cargar todo esto en un arreglo
 while($resultado_just[]=mysql_fetch_array($consulta_just)) {};  
  
  
  // Consulto los tipos de justificaciones para construir el array y asi poder mostrarlo en el reporte
  // para cargar todo esto en un arreglo
 $consulta_tipo_just=mysql_query("SELECT tj.id, tj.codigo, tj.descripcion FROM asistencias.tipo_justificaciones as tj",$link) or die(mysql_error()); 
 $arreglo_tipo=array();
 while($resultado_tipo_just=mysql_fetch_array($consulta_tipo_just)) 
   {
    $arreglo_tipo[$resultado_tipo_just['id']]=$resultado_tipo_just['descripcion'];
   };
// hago lo mismo con los tipos de falta en las que puede incurrir el funcionario.
 $consulta_tipo_falta=mysql_query("SELECT tf.id, tf.codigo, tf.descripcion FROM asistencias.tipo_faltas as tf",$link) or die(mysql_error()); 
 $arreglo_tipo_falta=array();
 while($resultado_tipo_falta=mysql_fetch_array($consulta_tipo_falta)) 
   {
    $arreglo_tipo_falta[$resultado_tipo_falta['codigo']]=$resultado_tipo_falta['descripcion'];
   };
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Reporte individual por funcionario</title>
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


<script type="text/javascript" src="../../reportes/libs/calendar/calendar.js"></script>
<script type="text/javascript" src="../../reportes/libs/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="../../reportes/libs/calendar/lang/calendar-es.js"></script>
<script src="../../reportes/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<style type="text/css"> @import url("../../reportes/css/calendar-win2k-cold-1.css"); </style>
<link href="../../reportes/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../../css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
}
.Estilo2 {
    color: #009900;
	font-weight: bold;	
	}
.Estilo3 {
    color: #0000FF;
	font-weight: bold;	
	}
.Estilo4 {
    color: #000000;
	font-weight: bold;	
	}
-->
</style>
<link href="../../css/formularios.css" rel="stylesheet" type="text/css" />
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
	if (mysql_num_rows($consulta_integrantes) == 0)// la consulta no tiene resultados, por lo tanto la cedula no existe en nomina
  		{
			?>                     
			 <br />
             
               <br />
               <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr class="encabezado_formularios">
                  <td width="500"><span class="Estilo1">ERROR al procesar dato</span></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="justify"><strong><br />
                  La C&eacute;dula: <?php echo $cedula ?> no pertenece a ning&uacute;n funcionario</strong> registrado en el sistema.
                  <br />
                  <br /> 
                  </div></td>
                </tr>
                <tr>
                  <td class="datos_formularios"> <div align="center">
                    <?php 
			echo " Para volver haga click "?> 
                    <a href="<?php echo $retorno; ?>">aqui</a> </div></td></tr>
              </table>                 
             
             <br />

             <?php
		}
	else
		{ // La cédula si existe	
		?>
		
		        <br />
<table width="616" border="1" align="center" cellpadding="0" cellspacing="0">
<tr class="encabezado_formularios">
                    <td colspan="4">Reporte de Asistencias Individuales</td>
        </tr>
                  <tr>
                    <td width="166" class="titulos_formularios">C&eacute;dula:</td>
                    <td colspan="3" class="datos_formularios">&nbsp;<?php echo $_POST['cedula'];?>&nbsp;</td>
        </tr>
                  <tr>
                    <td class="titulos_formularios">Nombre:</td>
                    <td colspan="3" class="datos_formularios">&nbsp;<?php echo $resultado_integrantes['nombres']." ".
			                                                             $resultado_integrantes['apellidos']; ?></td>
        </tr>
                  <tr>
                    <td class="titulos_formularios">Desde:</td>
                    <td width="131" class="datos_formularios">&nbsp;<?php echo $_POST['desde'];?></td>
                    <td width="62" class="titulos_formularios">Hasta:</td>
                    <td width="199" class="datos_formularios">&nbsp;<?php echo $_POST['hasta'];?></td>
        </tr>
                  <tr>
                    <td class="encabezado_formularios">Fecha</td>
                    <td colspan="2" class="encabezado_formularios">Entrada</td>
                    <td class="encabezado_formularios">Salida</td>
                  </tr>

		<?php
     		$nro_dias = dias_entre_fechas(cambiaf_a_normal($desde),cambiaf_a_normal($hasta))+1; // se suma uno porque a como diseñe la función
	 // no tomo en cuenta la fecha de inicio para poder contar los dias entre una y otra ya que se cuenta del timestamo actual hasta el siguiente 24
	 // horas despues; asi que lo mas fácil es sumarle uno acá para compensar por ese dia que no cuenta.
     		$fecha=cambiaf_a_normal($desde);
			
			$fecha_antes=0; // para saber si se ha colocado el mensaje correspondiente o no, para no repetirlo linea por linea
			$fecha_futura=0;
	 		while ($nro_dias > 0) 
				{ 
				  $resultado_horario = obtener_horario_vigente(cambiaf_a_mysql($fecha),$link);
				  $feriado='99'; // para tener un valor inicial para comparar si la función no trae resultado
				  $descrip_feriado='XX'; // igual que el anterior  				  
				 // $fecha_actual=date("Y-m-d");
				   //echo $resultado_integrantes['fecha_ingreso']." ".cambiaf_a_mysql($fecha);
				    if (cambiaf_a_mysql($fecha) < $resultado_integrantes['fecha_ingreso'])
					  { // Si el reporte incluye fechas de antes de que el funcionario ingrese a la institución, se pone la advertencia
						if ($fecha_antes == 0)
						  {
						    $fecha_antes = 1; ?>
					        <tr>
                              <td colspan="4" class="datos_formularios"><div align="justify"><span class='Estilo3'>
                              El o La Funcionario(a) comenz&oacute; a marcar entrada y salida desde el 
						      <?php echo cambiaf_a_normal($resultado_integrantes['fecha_ingreso']); ?>, por lo tanto no 
                              existen registros previos a la mencionada fecha que puedan ser mostrados en este reporte.</span></div></td>
                            </tr>
						 <?php 
						  } // del if fecha antes
					  }
					else
					 {
					   if (cambiaf_a_mysql($fecha) > date("Y-m-d"))
					     {// si es una fecha futura no deberia haber registro de ella 
						   if ($fecha_futura == 0)
						    {
						      $fecha_futura = 1; 
							  $nro_dias = -1; // para que en la próxima iteración se detenga;?>				 
					          <tr>
                                <td colspan="4" class="datos_formularios"><div align="justify"><span class='Estilo3'>
                                Como los reportes de asistencias est&aacute;n basados en eventos pasados, 
                                no se pueden mostrar datos de fechas posteriores a la actual (<?php echo date("d-m-Y"); ?>). 
                                </span></div></td>
                              </tr>
<?php
							  continue; // para que se salte lo que queda de iteracción pq ya es irrelevante que siga.
							} // del fecha_futura
						 }
					   else
					     {
						  if ((list($feriado,$descrip_feriado) = es_feriado($fecha,$link)) && ($feriado==1))
							{?>
							  <tr>
								<td class="datos_formularios"><div align="center"><span class='Estilo4'><?php	echo $fecha; ?></span></div></td>
								<td colspan="3" class="datos_formularios"><div align="center"><span class='Estilo2'>
								***** <?php echo $descrip_feriado;?> ***** </span></div></td>
							  </tr>				  
							 <?php 
							}
						  else
						   {
							if (es_feriado($fecha,$link) == 0) // para mayor referencia, ver la función en utilidades.php
							  {  // si no es feriado ni fin de semana, se comprueba que no haya venido a trabajar
								 // si se consigue, quiere decir que vino a trabajar ese dia.
								 // nos colocamos al principio de la consulta
								?>
								 <tr>
								   <td class="datos_formularios"><div align="center"><?php echo $fecha; ?></div></td>
								   <?php 			 
								   mysql_data_seek($consulta, 0);
								   $fecha_encontrada = false;
								   while($resultado = mysql_fetch_array($consulta) and ($fecha_encontrada == false)) 
									 { 
									   if (cambiaf_a_normal($resultado['fecha']) == $fecha) 
										 {   //echo "Es laborable y vino a trabajar: ".$resultado['fecha']." ".$nro_dias."<br />";
										   $fecha_encontrada = true; 
										   ?>
										   <td colspan="2" class="datos_formularios"><div align="center"><?php 
										   if (strtotime($resultado['entrada'])>= (strtotime($resultado_horario['hora_entrada']." + ".
																				   $resultado_horario['holgura_entrada']." minutes")))
											 { // si el emplado esta llegando tarde, busco la justificación
											   // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.                          
											   // Para sacar las estadísticas de la distribución de los días que el empleado llega tarde
											   list($diaX ,$mesX, $anioX) = split("/", cambiaf_a_normal($resultado['fecha']));
											   if (isset($dias_semana_retrasos[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))])) 
												 { $dias_semana_retrasos[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]++;}
											   else
												 { $dias_semana_retrasos[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]=1;} 							 
											   $cuenta_just=0;
											   $just_encontrada=false;
											   while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												 {
												   if (($resultado['fecha'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													   ($resultado['fecha'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
													   ($resultado['entrada'] >= $resultado_just[$cuenta_just]['hora_desde']) && 
													   ($resultado['entrada'] <= $resultado_just[$cuenta_just]['hora_hasta']) &&
													   (es_dia($fecha,$resultado_just[$cuenta_just]['lun'],$resultado_just[$cuenta_just]['mar'],
													   $resultado_just[$cuenta_just]['mie'],$resultado_just[$cuenta_just]['jue'],
													   $resultado_just[$cuenta_just]['vie'])==true)) 
													 { $just_encontrada = true; }
												   $cuenta_just++;
												 } // del while cuentajust
											   if ($just_encontrada == false) 
												 { // Para sacar las estadísticas de la distribución de los días que el empleado llega tarde
												   list($diaX ,$mesX, $anioX) = split("/", cambiaf_a_normal($resultado['fecha']));
												   if (isset($dias_semana_retrasos_no_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))])) 
													 { $dias_semana_retrasos_no_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]++; }
												   else
													 { $dias_semana_retrasos_no_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]=1; } 
												   $ind_asistentes_tarde_no_just++; 
												   echo '<span class="Estilo1">';
												 } // del encontrada false )osea, si la justificación no concuerda, se coloca en rojo
											   else
												 { // Para sacar las estadísticas de la distribución de los días que el empleado llega tarde
												   list($diaX ,$mesX, $anioX) = split("/", cambiaf_a_normal($resultado['fecha']));
												   if (isset($dias_semana_retrasos_si_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))])) 
													 { $dias_semana_retrasos_si_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]++; }
												   else
													 { $dias_semana_retrasos_si_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]=1; }
												   $ind_asistentes_tarde_si_just++;
												   echo '<span class="Estilo2">';
												 } // del else del encontrada false
											 } // del si esta llegando tarde ?>
										   <?php echo date("h:i:s a",strtotime($resultado['entrada'])); $ind_asistentes++;?> 
										   <?php if (strtotime($resultado['entrada'])>= (strtotime($resultado_horario['hora_entrada']." + ".
																								   $resultado_horario['holgura_entrada']." minutes")))
												   { echo "</span>"; }?>     
										   </div></td>
										   <td class="datos_formularios"><div align="center">
											 <?php if (strtotime($resultado['salida'])< strtotime($resultado_horario['hora_salida']))
													 { // si esta saliendo antes de la hora de salida
													   $cuenta_just=0;
													   $just_encontrada=false;
													   while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
														 {
														   if (($resultado['fecha'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
															   ($resultado['fecha'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
															   ($resultado['salida'] >= $resultado_just[$cuenta_just]['hora_desde']) && 
															   ($resultado['salida'] <= $resultado_just[$cuenta_just]['hora_hasta']) &&
													   		   (es_dia($fecha,$resultado_just[$cuenta_just]['lun'],
															    $resultado_just[$cuenta_just]['mar'],$resultado_just[$cuenta_just]['mie'],
															    $resultado_just[$cuenta_just]['jue'],$resultado_just[$cuenta_just]['vie'])==true)) 
															 { $just_encontrada = true; }
														   $cuenta_just++;
														 } // del while cuentajust
													   if ($just_encontrada == false) 
														 { // Para sacar las estadísticas de la distribución de los días que el empleado se va temprano
														   list($diaX ,$mesX, $anioX) = split("/", cambiaf_a_normal($resultado['fecha']));
														   if (isset($dias_semana_salidas_no_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))])) 
															 { $dias_semana_salidas_no_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]++; }
														   else
															 { $dias_semana_salidas_no_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]=1; } 
														   $ind_asistentes_salidas_no_just++; 
														   echo '<span class="Estilo1">';
														 } // del encontrada false )osea, si la justificación no concuerda, se coloca en rojo
													   else
														 { // Para sacar las estadísticas de la distribución de los días que el empleado se va temprano
														   list($diaX ,$mesX, $anioX) = split("/", cambiaf_a_normal($resultado['fecha']));
														   if (isset($dias_semana_salidas_si_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))])) 
															 { $dias_semana_salidas_si_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]++; }
														   else
															 { $dias_semana_salidas_si_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]=1; }
														   $ind_asistentes_salidas_si_just++;
														   echo '<span class="Estilo2">';
														 } // del else del encontrada false
													   // para parte de las estadísticas (los totales)
													   if (isset($dias_semana_salidas_tot[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))])) 
														 { $dias_semana_salidas_tot[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]++; }
													   else
														 { $dias_semana_salidas_tot[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]=1; } 
	
													   $ind_asistentes_salidas_tot++;
													 }// de la comprobación de estar saliendo antes de la hora?>
											 <?php echo date("h:i:s a",strtotime($resultado['salida'])); ?> 
											 <?php if (strtotime($resultado['salida'])< strtotime($resultado_horario['hora_salida']))
												   {echo "</span>";}?>                         
										   </div></td><?php					
										 } // del if si es laborable y vino a trabajar   
									 } // del while resultado
								   // luego del ciclo que busca ahora se comprueba si se encontró o no para hacer las acciones.
								   if ($fecha_encontrada == false) 
									 {  //echo "Es laborable y NO vino a trabajar: ".$fecha." ".$nro_dias."<br />"; ?>		
									   <td colspan="3" class="datos_formularios"><div align="center"><?php  $cuenta_ina=0; $esta=false;
										 while (($esta == false) && ($cuenta_ina < count($resultado_just)-1)) 
										   { 
											 if ((cambiaf_a_mysql($fecha) >= $resultado_just[$cuenta_ina]['fecha_desde']) &&
												 (cambiaf_a_mysql($fecha) <= $resultado_just[$cuenta_ina]['fecha_hasta']) &&
												 ($resultado_just[$cuenta_ina]['hora_desde'] <= $resultado_horario['hora_entrada']) &&
												 ($resultado_just[$cuenta_ina]['hora_desde'] >= $resultado_horario['hora_entrada']) &&
												 (es_dia($fecha,$resultado_just[$cuenta_ina]['lun'],$resultado_just[$cuenta_ina]['mar'],
												  $resultado_just[$cuenta_ina]['mie'],$resultado_just[$cuenta_ina]['jue'],
												  $resultado_just[$cuenta_ina]['vie'])==true)) 
											   { $esta=true;}
											 else
											   { $cuenta_ina++;}
										   } // del while
										 // si lo encontre, le pongo la observación, si no le pongo inasistente.
										 if ($esta == true)
										   {
											 $ind_inasistentes_si_just++;
											 echo "<span class='Estilo2'> TIPO: ".$arreglo_tipo[$resultado_just[$cuenta_ina]
																				  ['codigo_tipo_justificacion']].", &nbsp;C&oacute;digo: ".
																				  $resultado_just[$cuenta_ina]['codigo']."</span>";
										   } 
										 else
										   {
											  $ind_inasistentes_no_just++;
											  echo "<span class='Estilo1'> I N A S I S T E N T E </span>";
										   }
									   ?></div></td><?php					
									 } // del fecha_encontrada true  	     
							  } // del es_feriado que comprueba si es laborable
							 } // del else del esferiado que comprueba que sea ferado y no fin de semana
						   } // de la comprobación de fecha futura
						} // de la comprobación de la fecha de entrada del funcionario a la organización
				     $nro_dias--;  
		 		     $fecha = suma_dias($fecha, 1);
	    		   } // del while nro_dias ?>
                             </tr>
      </table>

<?php 



	// teniendo todos los dias que deben ser laborables de la fecha de inicio a la fecha de fin (ambas inclusives), las inasistencias del
	// empleado serian todos aquellos dias que queden despues de haber eliminado aquellos en los que haya laborado, 
	// no tenga permiso y no este de vacaciones.
?>
<table width="618" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
      <input type="button" name="volver" id="volver" value="Realizar otra consulta" onclick="javascript: location.href='<?php echo $retorno; ?>'" />
    </div></td>
  </tr>
</table>

<br />

<table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr class="encabezado_formularios">
    <td colspan="3">Observaciones a la asistencia</td>
  </tr>
    <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
       $cedi="XX";
       $color=array("#FFFFFF","#CCFFFF"); // para darle colores alternos a las lineas que muestro
       $contador_color=0; // este contador permitira darle la alternabilidad a los colores
	   $cuenta_just=0;
	   while ($cuenta_just < count($resultado_just)-1) { 
	   if ($cedi != $resultado_just[$cuenta_just]['cedula_just'])
	   { // si no son iguales, se escribe el nuevo encabezado del funcionario	
	     $cedi=$resultado_just[$cuenta_just]['cedula_just']; 
		// $contador_color++;  
	   ?>   
          <tr>
            <td colspan="3" class="datos_formularios"><div align="justify"><?php echo "<strong>C&oacute;digo: ".$resultado_just[$cuenta_just]['codigo'].", Desde el: ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_desde'])." hasta el ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_hasta']).", de ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_desde']))." a ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_hasta'])).", </strong> Tipo de Permiso: ".$arreglo_tipo[$resultado_just[$cuenta_just]['codigo_tipo_justificacion']].", Tipo de Falta: ".$arreglo_tipo_falta[$resultado_just[$cuenta_just]['codigo_tipo_falta']].", Motivo: ".$resultado_just[$cuenta_just]['observaciones']; ?></div></td>
          </tr>
  <?php 
       	 } // si cedi = cedula
	 else
	   {  // si es el mismo funcionario, pero con otro permiso, simplemente se añade otra descripcion con otro color
	     $contador_color++;
	?>
          <tr bgcolor="<?php echo $color[$contador_color%2]; ?>">
          
            <td colspan="3" class="datos_formularios"><div align="justify"><?php echo "<strong>C&oacute;digo: ".$resultado_just[$cuenta_just]['codigo'].", Desde el: ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_desde'])." hasta el ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_hasta']).", de ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_desde']))." a ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_hasta'])).", </strong> Tipo de Permiso: ".$arreglo_tipo[$resultado_just[$cuenta_just]['codigo_tipo_justificacion']].", Tipo de Falta: ".$arreglo_tipo_falta[$resultado_just[$cuenta_just]['codigo_tipo_falta']].", Motivo: ".$resultado_just[$cuenta_just]['observaciones']; ?></div></td>
          </tr>	     
		<?php 	
	 
	   }
  $cuenta_just++;
  }?>
</table>

<?php 
  if (($ind_inasistentes_no_just>=1) || ($ind_inasistentes_si_just>=1)) 
    {  // si hay datos suficientes, creo el gráfico, si no no (para no cargar al servidor) 
      $chart = new PieChart();
	  $dataSet = new XYDataSet();
	  if ($ind_asistentes>=1) {$dataSet->addPoint(new Point("Asistencias: (".$ind_asistentes.")", $ind_asistentes));};
	  if ($ind_inasistentes_no_just>=1) {$dataSet->addPoint(new Point("Inasistencias NO JUSTIFICADAS: (".$ind_inasistentes_no_just.")",
	  																									 $ind_inasistentes_no_just));};
	  if ($ind_inasistentes_si_just>=1) {$dataSet->addPoint(new Point("Inasistencias JUSTIFICADAS: (".$ind_inasistentes_si_just.")",
	  																								  $ind_inasistentes_si_just));};
	  $chart->setDataSet($dataSet);
	  $chart->setTitle("% de Asistencias / Inasistencias de: ".$resultado_integrantes['nombres']." ".$resultado_integrantes['apellidos']);
	  $chart->render("../../imgs/graf/asistencia_diaria_04.png");
	}
    

  if ($ind_asistentes>=1) 
    {  // si hay datos suficientes, creo el gráfico, si no no (para no cargar al servidor) 
      $chart2 = new PieChart();
	  $dataSet2 = new XYDataSet();
	  $ind_asistentes_no_retrasados=$ind_asistentes-$ind_asistentes_tarde_no_just-$ind_asistentes_tarde_si_just;
	  if ($ind_asistentes_no_retrasados>=1) {$dataSet2->addPoint(new Point("Puntuales: (".$ind_asistentes_no_retrasados.")",
	  																					  $ind_asistentes_no_retrasados));};
	  if ($ind_asistentes_tarde_no_just>=1) {$dataSet2->addPoint(new Point("Impuntuales NO JUSTIFICADOS: (".$ind_asistentes_tarde_no_just.")", 
	  																										$ind_asistentes_tarde_no_just));};
	  if ($ind_asistentes_tarde_si_just>=1) {$dataSet2->addPoint(new Point("Impuntuales JUSTIFICADOS: (".$ind_asistentes_tarde_si_just.")",
	  																									 $ind_asistentes_tarde_si_just));};
	  $chart2->setDataSet($dataSet2);
	  $chart2->setTitle("Porcentajes de Retrasos para: ".$resultado_integrantes['nombres']." ".$resultado_integrantes['apellidos']);
	  $chart2->render("../../imgs/graf/asistencia_diaria_03.png");
	} // de la comprobación si har registros ind_asistentes

  if ($ind_asistentes_salidas_tot>=1) 
    {  // si hay datos suficientes, creo el gráfico, si no no (para no cargar al servidor)	
	  $chart4 = new PieChart();
	  $dataSet4 = new XYDataSet();
	  $ind_asistentes_salidas=$ind_asistentes_salidas_tot-$ind_asistentes_salidas_no_just-$ind_asistentes_salidas_si_just;
	  if ($ind_asistentes_salidas>=1) {$dataSet4->addPoint(new Point("Salidas Tempranas: (".$ind_asistentes_salidas.")", $ind_asistentes_salidas));};
	  if ($ind_asistentes_salidas_no_just>=1) 
	  {$dataSet4->addPoint(new Point("Salidas Tempranas NO JUSTIFICADAS: (".$ind_asistentes_salidas_no_just.")", $ind_asistentes_salidas_no_just));};
	  if ($ind_asistentes_salidas_si_just>=1) 
	  {$dataSet4->addPoint(new Point("Salidas Tempranas JUSTIFICADOS: (".$ind_asistentes_salidas_si_just.")", $ind_asistentes_salidas_si_just));};
	  $chart4->setDataSet($dataSet4);
	  $chart4->setTitle("Salidas Tempranas para: ".$resultado_integrantes['nombres']." ".$resultado_integrantes['apellidos']);
	  $chart4->render("../../imgs/graf/asistencia_diaria_06.png");	
	}
	

  if ((isset($dias_semana_retrasos['Mon'])) || (isset($dias_semana_retrasos['Tue'])) || (isset($dias_semana_retrasos['Wed'])) || (isset($dias_semana_retrasos['Thu'])) || (isset($dias_semana_retrasos['Fri']))) 
    {  // si hay datos suficientes, creo el gráfico, si no no (para no cargar al servidor)	
	
	  $chart3 = new VerticalBarChart();
	
	  $serie1 = new XYDataSet();
	  if (isset($dias_semana_retrasos['Mon'])) {$serie1->addPoint(new Point("Lunes", $dias_semana_retrasos['Mon']));} 
	  else {$serie1->addPoint(new Point("Lunes", 0));};
	  if (isset($dias_semana_retrasos['Tue'])) {$serie1->addPoint(new Point("Martes", $dias_semana_retrasos['Tue']));}
	  else {$serie1->addPoint(new Point("Martes", 0));};
	  if (isset($dias_semana_retrasos['Wed'])) {$serie1->addPoint(new Point("Miércoles", $dias_semana_retrasos['Wed']));}
	  else {$serie1->addPoint(new Point("Miércoles", 0));};
	  if (isset($dias_semana_retrasos['Thu'])) {$serie1->addPoint(new Point("Jueves", $dias_semana_retrasos['Thu']));}
	  else {$serie1->addPoint(new Point("Jueves", 0));};
	  if (isset($dias_semana_retrasos['Fri'])) {$serie1->addPoint(new Point("Viernes", $dias_semana_retrasos['Fri']));}
	  else {$serie1->addPoint(new Point("Viernes", 0));};
	
	
	  $serie2 = new XYDataSet();
	  if (isset($dias_semana_retrasos_si_just['Mon'])) {$serie2->addPoint(new Point("Lunes", $dias_semana_retrasos_si_just['Mon']));} 
	  else {$serie2->addPoint(new Point("Lunes", 0));};
	  if (isset($dias_semana_retrasos_si_just['Tue'])) {$serie2->addPoint(new Point("Martes", $dias_semana_retrasos_si_just['Tue']));}
	  else {$serie2->addPoint(new Point("Martes", 0));};
	  if (isset($dias_semana_retrasos_si_just['Wed'])) {$serie2->addPoint(new Point("Miércoles", $dias_semana_retrasos_si_just['Wed']));}
	  else {$serie2->addPoint(new Point("Miércoles", 0));};
	  if (isset($dias_semana_retrasos_si_just['Thu'])) {$serie2->addPoint(new Point("Jueves", $dias_semana_retrasos_si_just['Thu']));}
	  else {$serie2->addPoint(new Point("Jueves", 0));};
	  if (isset($dias_semana_retrasos_si_just['Fri'])) {$serie2->addPoint(new Point("Viernes", $dias_semana_retrasos_si_just['Fri']));}
	  else {$serie2->addPoint(new Point("Viernes", 0));};
	

	  $serie3 = new XYDataSet();
	  if (isset($dias_semana_retrasos_no_just['Mon'])) {$serie3->addPoint(new Point("Lunes", $dias_semana_retrasos_no_just['Mon']));} 
	  else {$serie3->addPoint(new Point("Lunes", 0));};
	  if (isset($dias_semana_retrasos_no_just['Tue'])) {$serie3->addPoint(new Point("Martes", $dias_semana_retrasos_no_just['Tue']));}
	  else {$serie3->addPoint(new Point("Martes", 0));};
	  if (isset($dias_semana_retrasos_no_just['Wed'])) {$serie3->addPoint(new Point("Miércoles", $dias_semana_retrasos_no_just['Wed']));}
	  else {$serie3->addPoint(new Point("Miércoles", 0));};
	  if (isset($dias_semana_retrasos_no_just['Thu'])) {$serie3->addPoint(new Point("Jueves", $dias_semana_retrasos_no_just['Thu']));}
	  else {$serie3->addPoint(new Point("Jueves", 0));};
	  if (isset($dias_semana_retrasos_no_just['Fri'])) {$serie3->addPoint(new Point("Viernes", $dias_semana_retrasos_no_just['Fri']));}
	  else {$serie3->addPoint(new Point("Viernes", 0));};	
	
	
	
	  $dataSet3 = new XYSeriesDataSet();
	  $dataSet3->addSerie("Retrasos Totales", $serie1);
	  $dataSet3->addSerie("Retrasos Justificados", $serie2);
	  $dataSet3->addSerie("Retrasos Injustificados", $serie3);
      //	$dataSet3->addSerie("Product 4", $serie4);
      //	$dataSet3->addSerie("Product 5", $serie5);
	  $chart3->setDataSet($dataSet3);
	  $chart3->setTitle("Retrasos por día de la semana: ".$resultado_integrantes['nombres']." ".$resultado_integrantes['apellidos']);
	  $chart3->render("../../imgs/graf/asistencia_diaria_05.png");
	}
	
	


  if ((isset($dias_semana_salidas_tot['Mon'])) || (isset($dias_semana_salidas_tot['Tue'])) || (isset($dias_semana_salidas_tot['Wed'])) || (isset($dias_semana_salidas_tot['Thu'])) || (isset($dias_semana_salidas_tot['Fri']))) 
    {  // si hay datos suficientes, creo el gráfico, si no no (para no cargar al servidor)	
	
	  $chart5 = new VerticalBarChart();
	
	  $serieA1 = new XYDataSet();
	  if (isset($dias_semana_salidas_tot['Mon'])) {$serieA1->addPoint(new Point("Lunes", $dias_semana_salidas_tot['Mon']));} 
	  else {$serieA1->addPoint(new Point("Lunes", 0));};
	  if (isset($dias_semana_salidas_tot['Tue'])) {$serieA1->addPoint(new Point("Martes", $dias_semana_salidas_tot['Tue']));}
	  else {$serieA1->addPoint(new Point("Martes", 0));};
	  if (isset($dias_semana_salidas_tot['Wed'])) {$serieA1->addPoint(new Point("Miércoles", $dias_semana_salidas_tot['Wed']));}
	  else {$serieA1->addPoint(new Point("Miércoles", 0));};
	  if (isset($dias_semana_salidas_tot['Thu'])) {$serieA1->addPoint(new Point("Jueves", $dias_semana_salidas_tot['Thu']));}
	  else {$serieA1->addPoint(new Point("Jueves", 0));};
	  if (isset($dias_semana_salidas_tot['Fri'])) {$serieA1->addPoint(new Point("Viernes", $dias_semana_salidas_tot['Fri']));}
	  else {$serieA1->addPoint(new Point("Viernes", 0));};
	
	
	  $serieA2 = new XYDataSet();
	  if (isset($dias_semana_salidas_si_just['Mon'])) {$serieA2->addPoint(new Point("Lunes", $dias_semana_salidas_si_just['Mon']));} 
	  else {$serieA2->addPoint(new Point("Lunes", 0));};
	  if (isset($dias_semana_salidas_si_just['Tue'])) {$serieA2->addPoint(new Point("Martes", $dias_semana_salidas_si_just['Tue']));}
	  else {$serieA2->addPoint(new Point("Martes", 0));};
	  if (isset($dias_semana_salidas_si_just['Wed'])) {$serieA2->addPoint(new Point("Miércoles", $dias_semana_salidas_si_just['Wed']));}
	  else {$serieA2->addPoint(new Point("Miércoles", 0));};
	  if (isset($dias_semana_salidas_si_just['Thu'])) {$serieA2->addPoint(new Point("Jueves", $dias_semana_salidas_si_just['Thu']));}
	  else {$serieA2->addPoint(new Point("Jueves", 0));};
	  if (isset($dias_semana_salidas_si_just['Fri'])) {$serieA2->addPoint(new Point("Viernes", $dias_semana_salidas_si_just['Fri']));}
	  else {$serieA2->addPoint(new Point("Viernes", 0));};
	

	  $serieA3 = new XYDataSet();
	  if (isset($dias_semana_salidas_no_just['Mon'])) {$serieA3->addPoint(new Point("Lunes", $dias_semana_salidas_no_just['Mon']));} 
	  else {$serieA3->addPoint(new Point("Lunes", 0));};
	  if (isset($dias_semana_salidas_no_just['Tue'])) {$serieA3->addPoint(new Point("Martes", $dias_semana_salidas_no_just['Tue']));}
	  else {$serieA3->addPoint(new Point("Martes", 0));};
	  if (isset($dias_semana_salidas_no_just['Wed'])) {$serieA3->addPoint(new Point("Miércoles", $dias_semana_salidas_no_just['Wed']));}
	  else {$serieA3->addPoint(new Point("Miércoles", 0));};
	  if (isset($dias_semana_salidas_no_just['Thu'])) {$serieA3->addPoint(new Point("Jueves", $dias_semana_salidas_no_just['Thu']));}
	  else {$serieA3->addPoint(new Point("Jueves", 0));};
	  if (isset($dias_semana_salidas_no_just['Fri'])) {$serieA3->addPoint(new Point("Viernes", $dias_semana_salidas_no_just['Fri']));}
	  else {$serieA3->addPoint(new Point("Viernes", 0));};	
	
	
	
	  $dataSet5 = new XYSeriesDataSet();
	  $dataSet5->addSerie("Salidas Tempranas", $serieA1);
	  $dataSet5->addSerie("Justificadas", $serieA2);
	  $dataSet5->addSerie("Injustificadas", $serieA3);
	  $chart5->setDataSet($dataSet5);
	

	  $chart5->setTitle("Distribución de Salidas Tempranas: ".$resultado_integrantes['nombres']." ".$resultado_integrantes['apellidos']);
	  $chart5->render("../../imgs/graf/asistencia_diaria_07.png");
	}

?>
<table width="648" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
      <input type="button" name="volver" id="volver" value="Realizar otra consulta" onclick="javascript: location.href='<?php echo $retorno; ?>'" />
    </div></td>
  </tr>
</table>
<br />
<table width="651" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" class="encabezado_formularios">Gr&aacute;ficos y Estad&iacute;sticas (Indicadores de primer y segundo nivel)</div></td>
  </tr>
  <tr>
    <td><div align="center">   
      <p>
       <?php        
        if ($ind_asistentes>=1)  
          { echo '<img alt="Estadisticas de Retrasos" src="../../imgs/graf/asistencia_diaria_03.png" style="border: 1px solid gray;"/><br />';}
        else
          { echo '<span class="Estilo1">NO EXISTEN RETRASOS PARA GRAFICAR </span>';} ?>     
        <br />
         <br />
 <?php        
   if (($ind_inasistentes_no_just>=1) || ($ind_inasistentes_si_just>=1)) 
     { echo '<img alt="Estadística de Inasistencias" src="../../imgs/graf/asistencia_diaria_04.png" style="border: 1px solid gray;"/>';}
   else
     { echo '<span class="Estilo1">NO EXISTEN INASISTENCIAS PARA GRAFICAR </span>';} ?>
        <br />
        <br />  
   <?php        
   if ($ind_asistentes_salidas_tot>=1) 
     { echo '<img alt="Estad&iacute;stica de Salidas" src="../../imgs/graf/asistencia_diaria_06.png" style="border: 1px solid gray;"/>';}
   else
     { echo '<span class="Estilo1">NO EXISTEN SALIDAS TEMPRANAS PARA GRAFICAR </span>';} ?>
               
        <br />
              <br />
   <?php              
if ((isset($dias_semana_retrasos['Mon'])) || (isset($dias_semana_retrasos['Tue'])) || (isset($dias_semana_retrasos['Wed'])) || (isset($dias_semana_retrasos['Thu'])) || (isset($dias_semana_retrasos['Fri']))) 
     { echo '<img alt="Distribuci&oacute;n de Retrasos" src="../../imgs/graf/asistencia_diaria_05.png" style="border: 1px solid gray;"/><br /><br />';}?>              
         
                           
    <?php              
if ((isset($dias_semana_salidas_tot['Mon'])) || (isset($dias_semana_salidas_tot['Tue'])) || (isset($dias_semana_salidas_tot['Wed'])) || (isset($dias_semana_salidas_tot['Thu'])) || (isset($dias_semana_salidas_tot['Fri']))) 
     { echo '<img alt="Distribuci&oacute;n de Salidas Tempranas" src="../../imgs/graf/asistencia_diaria_07.png" style="border: 1px solid gray;"/>';}?>              
              
    </p>
      </div></td>
  </tr>
</table>
<table width="649" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
      <input type="button" name="volver" id="volver" value="Realizar otra consulta" onclick="javascript: location.href='<?php echo $retorno; ?>'" />
    </div></td>
  </tr>
</table>
<p>&nbsp;</p>

<?php 
		 } // fin del si la cedula existe ?><br />

    <!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 25 September, 2008 8:42 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>