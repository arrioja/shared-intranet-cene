<?php 
 include("../../db/conexion.php");
 include("../../libs/utilidades.php");
  
 $link=conectarse("asistencias");
 $link=conectarse("organizacion");
  
 $desde=cambiaf_a_mysql($_POST['desde']);
 $hasta=cambiaf_a_mysql(suma_dias(cambiaf_a_normal($desde), 4)); // s�lo 4 porque ya se esta tomando el cuenta el dia del inicio,
  
 // se consulta las asistencias del empleado desde la fecha de inicio hasta la fecha de fin, ambas inclusive.
 $consulta=mysql_query("SELECT (p.cedula) as cedula_integrantes, p.nombres, p.apellidos, e.fecha,  
							   MIN(e.hora) as entrada, MAX(e.hora) as salida 
					    FROM organizacion.personas as p LEFT JOIN asistencias.entrada_salida as e ON p.cedula = e.cedula 
						WHERE ((p.fecha_ingreso <= '$desde') and	
						       (e.fecha >= '$desde') and
							   (e.fecha <= '$hasta')) 
					    GROUP BY p.cedula, e.fecha 
						ORDER BY p.nombres, p.apellidos, e.fecha",$link) or die(mysql_error());


$consulta_inasistencias=mysql_query("SELECT p.cedula, p.nombres, p.apellidos 
									 FROM organizacion.personas as p, asistencias.personas_status_asistencias as s
									 WHERE ((s.status_asistencia = '1') and
									 		(s.cedula = p.cedula) and
									        (p.fecha_ingreso <= '$desde') and	 
									        (p.cedula NOT IN 
											  (SELECT e.cedula
											   FROM asistencias.entrada_salida as e
											   WHERE ((e.fecha >= '$desde') AND 
											          (e.fecha <= '$hasta'))
											   GROUP BY e.cedula)))
									ORDER BY p.nombres, p.apellidos",$link) or die(mysql_error());

 $datos=array();
 while($resultado=mysql_fetch_array($consulta))
 {
   list($anio, $mes, $dia) = split("-", $resultado['fecha']);
   $dia_semana = date("w", mktime(0, 0, 0, $mes, $dia, $anio));
   $datos[$resultado['cedula_integrantes']][$dia_semana]['F']=$resultado['fecha'];
   $datos[$resultado['cedula_integrantes']][$dia_semana]['E']=$resultado['entrada'];
   $datos[$resultado['cedula_integrantes']][$dia_semana]['S']=$resultado['salida']; 
 }					
						
/*

Para poder hacer este m�dulo, lo que hay que hacer es un arreglo y cargarlo con los datos de la consulta, cuyo indice sea la cedula del funcionario y con diez datos de hora para cada elemento del arreglo: Lunes_Entrada, Lunes_Salida, Martes_Entrada, Martes Salida, y asi, ademas del campo para nombres y apellidos, luego para dibujar la tabla, se recorre el arreglo y lo que sea de Lunes Entrada se coloca en el sitio que le corresponde, el truco esta en buscar las faltas y asociarlas con cada dia del arreglo. 
consulta

Esta es la consulta que funciona para extraer la asistencia semanal.
SELECT integrantes.cedula, integrantes.nombres, integrantes.apellidos,
asistencias_entrada_salida.fecha,
MIN(asistencias_entrada_salida.hora) as entrada, MAX(asistencias_entrada_salida.hora) as salida
FROM integrantes, asistencias_entrada_salida
	WHERE ((integrantes.cedula = asistencias_entrada_salida.cedula) and
 (asistencias_entrada_salida.fecha <= '2008-01-25') and
  (asistencias_entrada_salida.fecha >= '2008-01-21'))
 GROUP BY integrantes.cedula,fecha
ORDER BY integrantes.nombres, integrantes.apellidos, fecha	*/					
						
  $consulta_horario=mysql_query("select * from asistencias.opciones",$link) or die(mysql_error());
  $resultado_horario=mysql_fetch_array($consulta_horario);  
  
  
// Ahora consulto las justificaciones que tengan los empleados para la fecha seleccionada y que se encuentren aprobadas  
 $consulta_just=mysql_query("SELECT (p.cedula) as cedula_just, p.nombres, p.apellidos, j.* 
					    FROM asistencias.justificaciones as j, organizacion.personas as p  
						WHERE ((p.cedula = j.cedula) and 
						       ((
							     (j.fecha_desde <= '$desde') and
							     (j.fecha_hasta >= '$desde')
								 ) Or
							    (
							     (j.fecha_desde <= '$hasta') and
							     (j.fecha_hasta >= '$hasta')
							   ) or 
							   (
							     (j.fecha_desde >= '$desde') and
							     (j.fecha_hasta <= '$hasta')
								)) and							   
							   (j.estatus='1')) 
						ORDER BY j.fecha_desde",$link) or die(mysql_error()); 
 // para cargar todo esto en un arreglo
 while($resultado_just[]=mysql_fetch_array($consulta_just)) {};  
/* 						       (asistencias_justificaciones.fecha_desde >= '$desde') and
							   (asistencias_justificaciones.fecha_hasta <= '$hasta') and  */
  
  // Consulto los tipos de justificaciones para construir el array y asi poder mostrarlo en el reporte
  // para cargar todo esto en un arreglo
 $consulta_tipo_just=mysql_query("SELECT id, codigo, descripcion FROM asistencias.tipo_justificaciones",$link) or die(mysql_error()); 
 $arreglo_tipo=array();
 while($resultado_tipo_just=mysql_fetch_array($consulta_tipo_just)) 
   {
    $arreglo_tipo[$resultado_tipo_just['id']]=$resultado_tipo_just['descripcion'];
   };
// hago lo mismo con los tipos de falta en las que puede incurrir el funcionario.
 $consulta_tipo_falta=mysql_query("SELECT id, codigo, descripcion FROM asistencias.tipo_faltas",$link) or die(mysql_error()); 
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
<title>Reporte de Asistencia Semanal</title>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(../imgs/CENE_11.png);
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
-->
</style>
<link href="../../css/formularios.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="../imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="../imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="../imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="../imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="../imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="../imgs/CENE_07.png">      <div align="right">
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
                  <table width="520" border="1" cellpadding="0" cellspacing="0">
                  <tr class="encabezado_formularios">
                    <td colspan="5">Reporte de asistencias semanal</td>
                    </tr>
                  <tr>
                    <td colspan="2" class="titulos_formularios">Desde:</td>
                    <td width="150" class="datos_formularios">&nbsp;<?php echo $_POST['desde'];?></td>
                    <td width="90" class="titulos_formularios">Hasta:</td>
                    <td width="179" class="datos_formularios">&nbsp;<?php echo cambiaf_a_normal($hasta);?></td>
                  </tr>
</table>
<table width="1432" border="1" cellpadding="0" cellspacing="0">
<tr>
                    <td width="82" rowspan="2" class="encabezado_formularios">C&eacute;dula</td>
    <td width="320" rowspan="2" class="encabezado_formularios">Nombre</td>
    <td colspan="2" class="encabezado_formularios">Fecha: <?php echo cambiaf_a_normal($desde);?></td>
                    <td colspan="2" class="encabezado_formularios">Fecha: <?php echo suma_dias(cambiaf_a_normal($desde), 1)?></td>
                    <td colspan="2" class="encabezado_formularios">Fecha: <?php echo suma_dias(cambiaf_a_normal($desde), 2)?></td>
                    <td colspan="2" class="encabezado_formularios">Fecha: <?php echo suma_dias(cambiaf_a_normal($desde), 3)?></td>         
                    <td colspan="2" class="encabezado_formularios">Fecha: <?php echo suma_dias(cambiaf_a_normal($desde), 4)?></td>                                        
  </tr>
                  <tr>
                    <td width="100" class="encabezado_formularios">Entrada</td>
                    <td width="100" class="encabezado_formularios">Salida</td>
                    <td width="100" class="encabezado_formularios">Entrada</td>
                    <td width="100" class="encabezado_formularios">Salida</td>
                    <td width="100" class="encabezado_formularios">Entrada</td>
                    <td width="100" class="encabezado_formularios">Salida</td>
                    <td width="100" class="encabezado_formularios">Entrada</td>
                    <td width="100" class="encabezado_formularios">Salida</td> 
                    <td width="100" class="encabezado_formularios">Entrada</td>
                    <td width="100" class="encabezado_formularios">Salida</td> 
                  </tr>       
                  
        <?php 
		   //   $cuenta_personal=count($datos);  
		   //   while ($cuenta_personal > 0) { //foreach ($datos as $un_dato) {	
		    $cedi='0';
            mysql_data_seek($consulta, 0);
			$color=array("#FFFFFF","#CCFFFF"); // para darle colores alternos a las lineas que muestro
	        $contador=0; // este contador permitira darle la alternabilidad a los colores
		    while($resultado=mysql_fetch_array($consulta)) {
			if ($cedi != $resultado['cedula_integrantes']) {
		 ?>
                      
<tr bgcolor="<?php echo $color[$contador%2]; ?>">
                        <td class="datos_formularios"><div align="center"><?php echo $resultado['cedula_integrantes']; ?></div></td>
    <td class="datos_formularios">&nbsp;<?php echo $resultado['nombres']." ".$resultado['apellidos']; ?></td>     
          
          
<?php  
//********************************************************************************************************************************************************************************************
//**************************************************************     ENTRADA Y SALIDA DEL PRIMER DIA    **************************************************************************************
//********************************************************************************************************************************************************************************************
?>         
                     
                        <td class="datos_formularios" <?php if ( (isset ($datos[$resultado['cedula_integrantes']]['1']['E']) == false) &&
						                                         (isset ($datos[$resultado['cedula_integrantes']]['1']['S']) == false)) { echo 'colspan="2"'; }?> ><div align="center"><?php 		
					
		                            if (isset ($datos[$resultado['cedula_integrantes']]['1']['E']) == true) 
			                          { 									
										if (strtotime($datos[$resultado['cedula_integrantes']]['1']['E'])>= (strtotime($resultado_horario['hora_entrada']." + ".
																							$resultado_horario['holgura_entrada']." minutes")))
											{ // si el emplado esta llegando tarde, busco la justificaci�n
											  // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
												$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      ($datos[$resultado['cedula_integrantes']]['1']['F'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  ($datos[$resultado['cedula_integrantes']]['1']['F'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
													  (strtotime($datos[$resultado['cedula_integrantes']]['1']['E']) >= strtotime($resultado_just[$cuenta_just]['hora_desde'])) && 
													  (strtotime($datos[$resultado['cedula_integrantes']]['1']['E']) <= strtotime($resultado_just[$cuenta_just]['hora_hasta']))
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												 $cuenta_just++;
												}
												if ($just_encontrada == false) 
												 { 
											       echo "<span class='Estilo1'>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{
												   echo "<span class='Estilo2'>"; 			
												}
											  } // del si esta llegando tarde
									
										echo date("h:i:s a",strtotime($datos[$resultado['cedula_integrantes']]['1']['E']));  
										if (strtotime($datos[$resultado['cedula_integrantes']]['1']['E'])>= (strtotime($resultado_horario['hora_entrada']." + ".
										$resultado_horario['holgura_entrada']." minutes")))
										{
										echo "</span>";
									    }       
								      }  // del isset
									else
									  { // si no tiene entrada, me aseguro de que no tenga salida tampoco y si no la tiene le coloco "INASISTENTE" ese d�a 
									   if (isset ($datos[$resultado['cedula_integrantes']]['1']['S']) == false)
									     { // si no vino este dia, entonces se busca en las justificaciones de ese dia a ver que tiene y se le coloca, si no tiene, se pone inasistente
										   		$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      ($desde >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  ($desde <= $resultado_just[$cuenta_just]['fecha_hasta'])
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												  else
												  {
												     $cuenta_just++;
												  }
												}
												if ($just_encontrada == false) 
												 { 
										           echo " <span class='Estilo1'> I N A S I S T E N T E </span>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{  // si la justificacon concuerda se le coloca en verde con el codigo de justificacion
												 echo "<span class='Estilo2'> INASISTENTE, Cod:".$resultado_just[$cuenta_just]['id']."</span>";
												}
										} // del si esta llegando tarde
									  }						
						         
									 ?></div></td>
                                     
                                     
                                     <?php 
									 
								  if (isset ($datos[$resultado['cedula_integrantes']]['1']['S']) == true) {?>
								  
                        <td class="datos_formularios"><div align="center">
			                          <?php 									
										if (strtotime($datos[$resultado['cedula_integrantes']]['1']['S']) < (strtotime($resultado_horario['hora_salida'])))
											{ // si el emplado esta llegando tarde, busco la justificaci�n
											  // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
												$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      ($datos[$resultado['cedula_integrantes']]['1']['F'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  ($datos[$resultado['cedula_integrantes']]['1']['F'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
													  (strtotime($datos[$resultado['cedula_integrantes']]['1']['S']) >= strtotime($resultado_just[$cuenta_just]['hora_desde'])) && 
													  (strtotime($datos[$resultado['cedula_integrantes']]['1']['S']) <= strtotime($resultado_just[$cuenta_just]['hora_hasta']))
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												 $cuenta_just++;
												}
												if ($just_encontrada == false) 
												 { 
											       echo "<span class='Estilo1'>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{
												   echo "<span class='Estilo2'>"; 			
												}
											  } // del si esta llegando tarde
									
										echo date("h:i:s a",strtotime($datos[$resultado['cedula_integrantes']]['1']['S']));  
										if (strtotime($datos[$resultado['cedula_integrantes']]['1']['S']) < (strtotime($resultado_horario['hora_salida'])))
										{
										echo "</span>";
									    }       
							
									 ?></div></td>
                                     
                                     <?php 	 } // del isset	 ?>
                                     
                                     
 <?php  
//********************************************************************************************************************************************************************************************
//**************************************************************     ENTRADA Y SALIDA DEL SEGUNDO DIA    **************************************************************************************
//********************************************************************************************************************************************************************************************
?> 
                        <td class="datos_formularios" <?php if ( (isset ($datos[$resultado['cedula_integrantes']]['2']['E']) == false) &&
						                                         (isset ($datos[$resultado['cedula_integrantes']]['2']['S']) == false)) { echo 'colspan="2"'; }?> ><div align="center"><?php 		
					
		                            if (isset ($datos[$resultado['cedula_integrantes']]['2']['E']) == true) 
			                          { 									
										if (strtotime($datos[$resultado['cedula_integrantes']]['2']['E'])>= (strtotime($resultado_horario['hora_entrada']." + ".
																							$resultado_horario['holgura_entrada']." minutes")))
											{ // si el emplado esta llegando tarde, busco la justificaci�n
											  // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
												$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      ($datos[$resultado['cedula_integrantes']]['2']['F'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  ($datos[$resultado['cedula_integrantes']]['2']['F'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
													  (strtotime($datos[$resultado['cedula_integrantes']]['2']['E']) >= strtotime($resultado_just[$cuenta_just]['hora_desde'])) && 
													  (strtotime($datos[$resultado['cedula_integrantes']]['2']['E']) <= strtotime($resultado_just[$cuenta_just]['hora_hasta']))
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												 $cuenta_just++;
												}
												if ($just_encontrada == false) 
												 { 
											       echo "<span class='Estilo1'>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{
												   echo "<span class='Estilo2'>"; 			
												}
											  } // del si esta llegando tarde
									
										echo date("h:i:s a",strtotime($datos[$resultado['cedula_integrantes']]['2']['E']));  
										if (strtotime($datos[$resultado['cedula_integrantes']]['2']['E'])>= (strtotime($resultado_horario['hora_entrada']." + ".
										$resultado_horario['holgura_entrada']." minutes")))
										{
										echo "</span>";
									    }       
								      }  // del isset
									else
									  { // si no tiene entrada, me aseguro de que no tenga salida tampoco y si no la tiene le coloco "INASISTENTE" ese d�a 
									   if (isset ($datos[$resultado['cedula_integrantes']]['2']['S']) == false)
									     { // si no vino este dia, entonces se busca en las justificaciones de ese dia a ver que tiene y se le coloca, si no tiene, se pone inasistente
										   		$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      (cambiaf_a_mysql(suma_dias(cambiaf_a_normal($desde), 1)) >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  (cambiaf_a_mysql(suma_dias(cambiaf_a_normal($desde), 1)) <= $resultado_just[$cuenta_just]['fecha_hasta'])
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												  else
												  {
												     $cuenta_just++;
												  }
												}
												if ($just_encontrada == false) 
												 { 
										           echo " <span class='Estilo1'> I N A S I S T E N T E </span>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{  // si la justificacon concuerda se le coloca en verde con el codigo de justificacion
												 echo "<span class='Estilo2'> INASISTENTE, Cod:".$resultado_just[$cuenta_just]['id']."</span>";
												}
										} // del si esta llegando tarde
									  }						
						         
									 ?></div></td>
                                     
                                     
                                     <?php 
									 
								  if (isset ($datos[$resultado['cedula_integrantes']]['2']['S']) == true) {?>
								  
                        <td class="datos_formularios"><div align="center">
			                          <?php 									
										if (strtotime($datos[$resultado['cedula_integrantes']]['2']['S']) < (strtotime($resultado_horario['hora_salida'])))
											{ // si el emplado esta llegando tarde, busco la justificaci�n
											  // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
												$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      ($datos[$resultado['cedula_integrantes']]['2']['F'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  ($datos[$resultado['cedula_integrantes']]['2']['F'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
													  (strtotime($datos[$resultado['cedula_integrantes']]['2']['S']) >= strtotime($resultado_just[$cuenta_just]['hora_desde'])) && 
													  (strtotime($datos[$resultado['cedula_integrantes']]['2']['S']) <= strtotime($resultado_just[$cuenta_just]['hora_hasta']))
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												 $cuenta_just++;
												}
												if ($just_encontrada == false) 
												 { 
											       echo "<span class='Estilo1'>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{
												   echo "<span class='Estilo2'>"; 			
												}
											  } // del si esta llegando tarde
									
										echo date("h:i:s a",strtotime($datos[$resultado['cedula_integrantes']]['2']['S']));  
										if (strtotime($datos[$resultado['cedula_integrantes']]['2']['S']) < (strtotime($resultado_horario['hora_salida'])))
										{
										echo "</span>";
									    }       
							
									 ?></div></td>
                                     
                                     <?php 	 } // del isset	 ?>
                                     
                                     
 <?php  
//********************************************************************************************************************************************************************************************
//**************************************************************     ENTRADA Y SALIDA DEL TERCER DIA    **************************************************************************************
//********************************************************************************************************************************************************************************************
?> 
                        <td class="datos_formularios" <?php if ( (isset ($datos[$resultado['cedula_integrantes']]['3']['E']) == false) &&
						                                         (isset ($datos[$resultado['cedula_integrantes']]['3']['S']) == false)) { echo 'colspan="2"'; }?> ><div align="center"><?php 		
					
		                            if (isset ($datos[$resultado['cedula_integrantes']]['3']['E']) == true) 
			                          { // Si tiene entrada por lo menos vino en algun momento del dia.									
										if (strtotime($datos[$resultado['cedula_integrantes']]['3']['E'])>= (strtotime($resultado_horario['hora_entrada']." + ".
																							$resultado_horario['holgura_entrada']." minutes")))
											{ // si el emplado esta llegando tarde, busco la justificaci�n
											  // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
												$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      ($datos[$resultado['cedula_integrantes']]['3']['F'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  ($datos[$resultado['cedula_integrantes']]['3']['F'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
													  (strtotime($datos[$resultado['cedula_integrantes']]['3']['E']) >= strtotime($resultado_just[$cuenta_just]['hora_desde'])) && 
													  (strtotime($datos[$resultado['cedula_integrantes']]['3']['E']) <= strtotime($resultado_just[$cuenta_just]['hora_hasta']))
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												 $cuenta_just++;
												}
												if ($just_encontrada == false) 
												 { 
											       echo "<span class='Estilo1'>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{
												   echo "<span class='Estilo2'>"; 			
												}
											  } // del si esta llegando tarde
									
										echo date("h:i:s a",strtotime($datos[$resultado['cedula_integrantes']]['3']['E']));  
										if (strtotime($datos[$resultado['cedula_integrantes']]['3']['E'])>= (strtotime($resultado_horario['hora_entrada']." + ".
										$resultado_horario['holgura_entrada']." minutes")))
										{
										echo "</span>";
									    }       
								      }  // del isset del datos-resultado-e
									else
									  { // si no tiene entrada, me aseguro de que no tenga salida tampoco y si no la tiene le coloco "INASISTENTE" ese d�a 
									   if (isset ($datos[$resultado['cedula_integrantes']]['3']['S']) == false)
									     { // si no vino este dia, entonces se busca en las justificaciones de ese dia a ver que tiene y se le coloca, si no tiene, se pone inasistente
										   		$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      (cambiaf_a_mysql(suma_dias(cambiaf_a_normal($desde), 2)) >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  (cambiaf_a_mysql(suma_dias(cambiaf_a_normal($desde), 2)) <= $resultado_just[$cuenta_just]['fecha_hasta'])
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												  else
												  {
												     $cuenta_just++;
												  }
												}
												if ($just_encontrada == false) 
												 { 
										           echo " <span class='Estilo1'> I N A S I S T E N T E </span>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{  // si la justificacon concuerda se le coloca en verde con el codigo de justificacion
												 echo "<span class='Estilo2'> INASISTENTE, Cod:".$resultado_just[$cuenta_just]['id']."</span>";
												}
										} // del si esta llegando tarde
									  }						
						         
									 ?></div></td>
                                     
                                     
                                     <?php 
									 
								  if (isset ($datos[$resultado['cedula_integrantes']]['3']['S']) == true) {?>
								  
                        <td class="datos_formularios"><div align="center">
			                          <?php 									
										if (strtotime($datos[$resultado['cedula_integrantes']]['3']['S']) < (strtotime($resultado_horario['hora_salida'])))
											{ // si el emplado esta llegando tarde, busco la justificaci�n
											  // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
												$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      ($datos[$resultado['cedula_integrantes']]['3']['F'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  ($datos[$resultado['cedula_integrantes']]['3']['F'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
													  (strtotime($datos[$resultado['cedula_integrantes']]['3']['S']) >= strtotime($resultado_just[$cuenta_just]['hora_desde'])) && 
													  (strtotime($datos[$resultado['cedula_integrantes']]['3']['S']) <= strtotime($resultado_just[$cuenta_just]['hora_hasta']))
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												 $cuenta_just++;
												}
												if ($just_encontrada == false) 
												 { 
											       echo "<span class='Estilo1'>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{
												   echo "<span class='Estilo2'>"; 			
												}
											  } // del si esta llegando tarde
									
										echo date("h:i:s a",strtotime($datos[$resultado['cedula_integrantes']]['3']['S']));  
										if (strtotime($datos[$resultado['cedula_integrantes']]['3']['S']) < (strtotime($resultado_horario['hora_salida'])))
										{
										echo "</span>";
									    }       
							
									 ?></div></td>
                                     
                                     <?php 	 } // del isset	 ?>
                                     
                                     
                                     
<?php  
//********************************************************************************************************************************************************************************************
//**************************************************************     ENTRADA Y SALIDA DEL CUARTO DIA    **************************************************************************************
//********************************************************************************************************************************************************************************************
?> 
                        <td class="datos_formularios" <?php if ( (isset ($datos[$resultado['cedula_integrantes']]['4']['E']) == false) &&
						                                         (isset ($datos[$resultado['cedula_integrantes']]['4']['S']) == false)) { echo 'colspan="2"'; }?> ><div align="center"><?php 		
					
		                            if (isset ($datos[$resultado['cedula_integrantes']]['4']['E']) == true) 
			                          { 									
										if (strtotime($datos[$resultado['cedula_integrantes']]['4']['E'])>= (strtotime($resultado_horario['hora_entrada']." + ".
																							$resultado_horario['holgura_entrada']." minutes")))
											{ // si el emplado esta llegando tarde, busco la justificaci�n
											  // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
												$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      ($datos[$resultado['cedula_integrantes']]['4']['F'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  ($datos[$resultado['cedula_integrantes']]['4']['F'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
													  (strtotime($datos[$resultado['cedula_integrantes']]['4']['E']) >= strtotime($resultado_just[$cuenta_just]['hora_desde'])) && 
													  (strtotime($datos[$resultado['cedula_integrantes']]['4']['E']) <= strtotime($resultado_just[$cuenta_just]['hora_hasta']))
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												 $cuenta_just++;
												}
												if ($just_encontrada == false) 
												 { 
											       echo "<span class='Estilo1'>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{
												   echo "<span class='Estilo2'>"; 			
												}
											  } // del si esta llegando tarde
									
										echo date("h:i:s a",strtotime($datos[$resultado['cedula_integrantes']]['4']['E']));  
										if (strtotime($datos[$resultado['cedula_integrantes']]['4']['E'])>= (strtotime($resultado_horario['hora_entrada']." + ".
										$resultado_horario['holgura_entrada']." minutes")))
										{
										echo "</span>";
									    }       
								      }  // del isset
									else
									  { // si no tiene entrada, me aseguro de que no tenga salida tampoco y si no la tiene le coloco "INASISTENTE" ese d�a 
									   if (isset ($datos[$resultado['cedula_integrantes']]['4']['S']) == false)
									     { // si no vino este dia, entonces se busca en las justificaciones de ese dia a ver que tiene y se le coloca, si no tiene, se pone inasistente
										   		$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      (cambiaf_a_mysql(suma_dias(cambiaf_a_normal($desde), 3)) >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  (cambiaf_a_mysql(suma_dias(cambiaf_a_normal($desde), 3)) <= $resultado_just[$cuenta_just]['fecha_hasta'])
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												  else
												  {
												     $cuenta_just++;
												  }
												}
												if ($just_encontrada == false) 
												 { 
										           echo " <span class='Estilo1'> I N A S I S T E N T E </span>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{  // si la justificacon concuerda se le coloca en verde con el codigo de justificacion
												 echo "<span class='Estilo2'> INASISTENTE, Cod:".$resultado_just[$cuenta_just]['id']."</span>";
												}
										} // del si esta llegando tarde
									  }						
						         
									 ?></div></td>
                                     
                                     
                                     <?php 
									 
								  if (isset ($datos[$resultado['cedula_integrantes']]['4']['S']) == true) {?>
								  
                        <td class="datos_formularios"><div align="center">
			                          <?php 									
										if (strtotime($datos[$resultado['cedula_integrantes']]['4']['S']) < (strtotime($resultado_horario['hora_salida'])))
											{ // si el emplado esta llegando tarde, busco la justificaci�n
											  // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
												$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      ($datos[$resultado['cedula_integrantes']]['4']['F'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  ($datos[$resultado['cedula_integrantes']]['4']['F'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
													  (strtotime($datos[$resultado['cedula_integrantes']]['4']['S']) >= strtotime($resultado_just[$cuenta_just]['hora_desde'])) && 
													  (strtotime($datos[$resultado['cedula_integrantes']]['4']['S']) <= strtotime($resultado_just[$cuenta_just]['hora_hasta']))
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												 $cuenta_just++;
												}
												if ($just_encontrada == false) 
												 { 
											       echo "<span class='Estilo1'>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{
												   echo "<span class='Estilo2'>"; 			
												}
											  } // del si esta llegando tarde
									
										echo date("h:i:s a",strtotime($datos[$resultado['cedula_integrantes']]['4']['S']));  
										if (strtotime($datos[$resultado['cedula_integrantes']]['4']['S']) < (strtotime($resultado_horario['hora_salida'])))
										{
										echo "</span>";
									    }       
							
									 ?></div></td>
                                     
                                     <?php 	 } // del isset	 ?>
                                     
                                     
 <?php  
//********************************************************************************************************************************************************************************************
//**************************************************************     ENTRADA Y SALIDA DEL QUINTO DIA    **************************************************************************************
//********************************************************************************************************************************************************************************************
?> 
                        <td class="datos_formularios" <?php if ( (isset ($datos[$resultado['cedula_integrantes']]['5']['E']) == false) &&
						                                         (isset ($datos[$resultado['cedula_integrantes']]['5']['S']) == false)) { echo 'colspan="2"'; }?> ><div align="center"><?php 		
					
		                            if (isset ($datos[$resultado['cedula_integrantes']]['5']['E']) == true) 
			                          { 									
										if (strtotime($datos[$resultado['cedula_integrantes']]['5']['E'])>= (strtotime($resultado_horario['hora_entrada']." + ".
																							$resultado_horario['holgura_entrada']." minutes")))
											{ // si el emplado esta llegando tarde, busco la justificaci�n
											  // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
												$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      ($datos[$resultado['cedula_integrantes']]['5']['F'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  ($datos[$resultado['cedula_integrantes']]['5']['F'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
													  (strtotime($datos[$resultado['cedula_integrantes']]['5']['E']) >= strtotime($resultado_just[$cuenta_just]['hora_desde'])) && 
													  (strtotime($datos[$resultado['cedula_integrantes']]['5']['E']) <= strtotime($resultado_just[$cuenta_just]['hora_hasta']))
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												 $cuenta_just++;
												}
												if ($just_encontrada == false) 
												 { 
											       echo "<span class='Estilo1'>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{
												   echo "<span class='Estilo2'>"; 			
												}
											  } // del si esta llegando tarde
									
										echo date("h:i:s a",strtotime($datos[$resultado['cedula_integrantes']]['5']['E']));  
										if (strtotime($datos[$resultado['cedula_integrantes']]['5']['E'])>= (strtotime($resultado_horario['hora_entrada']." + ".
										$resultado_horario['holgura_entrada']." minutes")))
										{
										echo "</span>";
									    }       
								      }  // del isset
									else
									  { // si no tiene entrada, me aseguro de que no tenga salida tampoco y si no la tiene le coloco "INASISTENTE" ese d�a 
									   if (isset ($datos[$resultado['cedula_integrantes']]['5']['S']) == false)
									     { // si no vino este dia, entonces se busca en las justificaciones de ese dia a ver que tiene y se le coloca, si no tiene, se pone inasistente
										   		$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      (cambiaf_a_mysql(suma_dias(cambiaf_a_normal($desde), 4)) >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  (cambiaf_a_mysql(suma_dias(cambiaf_a_normal($desde), 4)) <= $resultado_just[$cuenta_just]['fecha_hasta'])
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												  else
												  {
												     $cuenta_just++;
												  }
												}
												if ($just_encontrada == false) 
												 { 
										           echo " <span class='Estilo1'> I N A S I S T E N T E </span>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{  // si la justificacon concuerda se le coloca en verde con el codigo de justificacion
												 echo "<span class='Estilo2'> INASISTENTE, Cod:".$resultado_just[$cuenta_just]['id']."</span>";
												}
										} // del si esta llegando tarde
									  }						
						         
									 ?></div></td>
                                     
                                     
                                     <?php 
									 
								  if (isset ($datos[$resultado['cedula_integrantes']]['5']['S']) == true) {?>
								  
                        <td class="datos_formularios"><div align="center">
			                          <?php 									
										if (strtotime($datos[$resultado['cedula_integrantes']]['5']['S']) < (strtotime($resultado_horario['hora_salida'])))
											{ // si el emplado esta llegando tarde, busco la justificaci�n
											  // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
												$cuenta_just=0;
												$just_encontrada=false;
												while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
												{ 												      
												  if (
												      ($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
												      ($datos[$resultado['cedula_integrantes']]['5']['F'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
													  ($datos[$resultado['cedula_integrantes']]['5']['F'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
													  (strtotime($datos[$resultado['cedula_integrantes']]['5']['S']) >= strtotime($resultado_just[$cuenta_just]['hora_desde'])) && 
													  (strtotime($datos[$resultado['cedula_integrantes']]['5']['S']) <= strtotime($resultado_just[$cuenta_just]['hora_hasta']))
													  ) 
														{ 
														  $just_encontrada = true; 
														}
												 $cuenta_just++;
												}
												if ($just_encontrada == false) 
												 { 
											       echo "<span class='Estilo1'>";
											     } // del encontrada false )osea, si la justificaci�n no concuerda, se coloca en rojo
												else
												{
												   echo "<span class='Estilo2'>"; 			
												}
											  } // del si esta llegando tarde
									
										echo date("h:i:s a",strtotime($datos[$resultado['cedula_integrantes']]['5']['S']));  
										if (strtotime($datos[$resultado['cedula_integrantes']]['5']['S']) < (strtotime($resultado_horario['hora_salida'])))
										{
										echo "</span>";
									    }       
							
									 ?></div></td>
                                     
                                     <?php 	 } // del isset	 ?>
  </tr>
                      
                      <?php 
					//  $cuenta_personal--;
					     $contador++;
					     $cedi=$resultado['cedula_integrantes'];
					    }
					  }?>
</table>

 <p>
   <?php 
     $fechas_a_consultar=array();
     $nro_dias = dias_entre_fechas(cambiaf_a_normal($desde),cambiaf_a_normal($hasta))+1; // tuve que sumarle uno porque a como dise�e la funci�n no tomo en cuenta la fecha de inicio para poder contar losdias entre una y otra ya que se cuenta del timestamp actual hasta el siguiente 24 horas despues; asi que lo mas f�cil es sumarle uno ac� para compensar por ese dia que no cuenta.
//	 $primera_corrida=true;
     $fecha=cambiaf_a_normal($desde);
		while ($nro_dias!=0) 
		{ 
//		  if ($primera_corrida == false) {$fecha = suma_dias($fecha, 1);}
//		  $primera_corrida = false;
		  if (es_feriado($fecha,$link) == 0) 
		  {  // si no es feriado ni fin de semana, se comprueba que no haya venido a trabajar
		     // si se consigue, quiere decir que vino a trabajar ese dia.
			 mysql_data_seek($consulta, 0);
			 $fecha_encontrada = false;
			 while($resultado = mysql_fetch_array($consulta) and ($fecha_encontrada == false)) 
			   { 
			     if (cambiaf_a_normal($resultado['fecha']) == $fecha) 
				   { 
				     $fecha_encontrada = true; 
				   }     
			   } 
			 if ($fecha_encontrada == false) 
			   {
			     $fechas_a_consultar[]=$fecha;
			   }  	     
		  }
		  $nro_dias--; 	 
		  $fecha = suma_dias($fecha, 1); 
	    };

	// teniendo todos los dias que deben ser laborables de la fecha de inicio a la fecha de fin (ambas inclusives), las inasistencias del
	// empleado serian todos aquellos dias que queden despues de haber eliminado aquellos en los que haya laborado, 
	// no tenga permiso y no este de vacaciones.

?>
 </p>

 <table width="663" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" class="encabezado_formularios">Funcionarios que no chequearon entrada y salida en la semana</td>
  </tr>
  <tr>
    <td width="88" class="encabezado_formularios">C&eacute;dula</td>
    <td width="328" class="encabezado_formularios">Nombre</td>
    <td class="encabezado_formularios">Observaci�n</td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
  	   $contador=0; // este contador permitira darle la alternabilidad a los colores
	   // La l�gica para esta secci�n es que si no vino (osea que se encuentra dentro de la consulta que se sac� de los inasistentes para el dia) y posee una justificaci�n
	   // entonces lo que se esta justificando ese dia debe ser su inasistencia, no obstante, seria bueno comprobar que la justificaci�n fuera desde el principio al final del dia.
       while($resultado_inasistencias=mysql_fetch_array($consulta_inasistencias)) { ?>
  <tr bgcolor="<?php echo $color[$contador%2]; ?>">
    <td class="datos_formularios"><div align="center"><?php echo $resultado_inasistencias['cedula']; ?></div></td>
    <td class="datos_formularios"><div align="left"> &nbsp;<?php echo $resultado_inasistencias['nombres']." ".
			                                                             $resultado_inasistencias['apellidos']; ?></div></td>
    <td class="datos_formularios"><div align="center"><?php  $cuenta_ina=0; $colocado=false;
															 while (($colocado == false) && ($cuenta_ina < count($resultado_just)-1)) { 
													//		 echo $resultado_inasistencias['cedula']." ".$resultado_just[$cuenta_ina]['cedula_just'];
															   if ($resultado_inasistencias['cedula'] == 
															       $resultado_just[$cuenta_ina]['cedula_just']) 
																   { 
																	 $colocado=true;
																   }
																else 
																{
															      $cuenta_ina++;
															    }
															   } // del while
															  
															  if ($colocado == true) 
															  {
															 	 echo "Tipo: ".$arreglo_tipo[$resultado_just[$cuenta_ina]
														                ['codigo_tipo_justificacion']].", C&oacute;d: ".
																		$resultado_just[$cuenta_ina]['id']; 
															  }
															  else
															  {
															 	echo "<span class='Estilo1'> I N A S I S T E N T E </span>";
															  }
															  
															   ?></div></td>
  </tr>
  <?php $contador++;}?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
 <br />
 <table width="999" border="1" cellpadding="0" cellspacing="0">
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
  <tr bgcolor="<?php echo $color[$contador_color%2]; $contador_color++;?>">
    <td colspan="3" class="datos_formularios"><div align="justify"><?php echo "<strong>C&oacute;digo: ".$resultado_just[$cuenta_just]['id'].", C&eacute;dula: ".$resultado_just[$cuenta_just]['cedula_just'].", Funcionario: ".$resultado_just[$cuenta_just]['nombres']." ".$resultado_just[$cuenta_just]['apellidos'].", Desde el: ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_desde'])." hasta el ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_hasta']).", de ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_desde']))." a ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_hasta'])).", </strong> Tipo de Permiso: ".$arreglo_tipo[$resultado_just[$cuenta_just]['codigo_tipo_justificacion']].", Tipo de Falta: ".$arreglo_tipo_falta[$resultado_just[$cuenta_just]['codigo_tipo_falta']].", Motivo: ".$resultado_just[$cuenta_just]['observaciones']; ?></div></td>
  </tr>
  <?php 
       	 } // si cedi = cedula
	 else
	   {  // si es el mismo funcionario, pero con otro permiso, simplemente se a&ntilde;ade otra descripcion con otro color
	     $contador_color++;
	?>
  <tr bgcolor="<?php echo $color[$contador_color%2]; ?>">
    <td colspan="3" class="datos_formularios"><div align="justify"><?php echo "<strong>C&oacute;digo: ".$resultado_just[$cuenta_just]['id'].", C&eacute;dula: ".$resultado_just[$cuenta_just]['cedula_just'].", Funcionario: ".$resultado_just[$cuenta_just]['nombres']." ".$resultado_just[$cuenta_just]['apellidos'].", Desde el: ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_desde'])." hasta el ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_hasta']).", de ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_desde']))." a ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_hasta'])).", </strong> Tipo de Permiso: ".$arreglo_tipo[$resultado_just[$cuenta_just]['codigo_tipo_justificacion']].", Tipo de Falta: ".$arreglo_tipo_falta[$resultado_just[$cuenta_just]['codigo_tipo_falta']].", Motivo: ".$resultado_just[$cuenta_just]['observaciones']; ?></div></td>
  </tr>
  <?php 	
	 
	   }
  $cuenta_just++;
  }?>
</table>
 <table width="511" border="1" cellpadding="0" cellspacing="0">
   <tr>
     <td><div align="center">
         <input type="button" name="volver" id="volver" value="Consultar otra semana" onclick="javascript: location.href='../asistencia_semanal.php'" />
     </div></td>
   </tr>
 </table>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 21 August, 2008 12:13 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>