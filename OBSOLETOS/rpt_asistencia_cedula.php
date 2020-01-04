<?php 
 include("../../db/conexion.php");
 include("../../libs/utilidades.php");
 include("../../libs/libchart/classes/libchart.php");
 
// Para limpiar los valores de las variables que se mostraran en los graficos de los indicadores.
$ind_asistentes=0;
$ind_asistentes_no_retrasados=0;
$ind_asistentes_tarde_no_just=0;
$ind_asistentes_tarde_si_just=0;
$ind_inasistentes_no_just=0;
$ind_inasistentes_si_just=0;
$dias_semana_retrasos=array();
$dias_semana_retrasos_si_just=array();
$dias_semana_retrasos_no_just=array();

 
 $link=conectarse("asistencias");
 $link=conectarse("organizacion"); 
// $link=conectarse("asistencias"); 
  
  $cedula=$_POST['cedula'];
  $desde=cambiaf_a_mysql($_POST['desde']);
  $hasta=cambiaf_a_mysql($_POST['hasta']);
  
  $consulta_integrantes=mysql_query("select p.id, p.cedula, p.nombres, p.apellidos from organizacion.personas as p where p.cedula='$cedula'",$link) 
						or die(mysql_error()); 
  $resultado_integrantes=mysql_fetch_array($consulta_integrantes);	
  
  // se consulta las asistencias del empleado desde la fecha de inicio hasta la fecha de fin, ambas inclusive.
 $consulta=mysql_query("SELECT (p.cedula) as cedula_integrantes, p.nombres, p.apellidos, 
                               e.cedula, e.fecha,  
							   MIN(e.hora) as entrada, MAX(e.hora) as salida 
					    FROM asistencias.entrada_salida as e, organizacion.personas as p  
						WHERE ((p.cedula = e.cedula) and 
						       (p.cedula = '$cedula') and
						       (e.fecha <= '$hasta') and
							   (e.fecha >= '$desde')) 
					    GROUP BY fecha 
						ORDER BY fecha",$link) or die(mysql_error());
						
						
						
  $consulta_horario=mysql_query("select * from asistencias.opciones",$link) or die(mysql_error());
  $resultado_horario=mysql_fetch_array($consulta_horario);  
  
  
// Ahora consulto las justificaciones que tengan los empleados para la fecha seleccionada y que se encuentren aprobadas  
 $consulta_just=mysql_query("SELECT (p.cedula) as cedula_just, p.nombres, p.apellidos, j.* 
					    FROM asistencias.justificaciones as j, organizacion.personas as p  
						WHERE (
						       (p.cedula = j.cedula) and 
						       (p.cedula = '$cedula') and
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
							   (j.estatus='1')
							  ) 
						ORDER BY j.fecha_desde",$link) or die(mysql_error()); 
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
  
  
/*  $consulta_vacaciones=mysql_query("select * from asistencias_vacaciones
                                    where((cedula='$cedula') and 
									(pendientes>'0')) 
									order by asistencias_vacaciones.disponible_desde",$link) or die(mysql_error());
   $cuenta_vacaciones=mysql_num_rows($consulta_vacaciones);
   $lineas=1;
   
   $sumatoria_vacaciones=mysql_query("select sum(pendientes) as sumatoria from asistencias_vacaciones
                                    where((cedula='$cedula') and 
									(pendientes>'0')) 
									order by asistencias_vacaciones.disponible_desde",$link) or die(mysql_error());
   $resultado_sumatoria=mysql_fetch_array($sumatoria_vacaciones); 
   $total_dias=$resultado_sumatoria['sumatoria']; */
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
                    <a href="../asistencia_cedula.php">aqui</a> </div></td></tr>
              </table>                 
             
             <br />

             <?php
		}
	else
		{ // La cédula si existe
              ?> 
                  <br />
                  <table width="511" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr class="encabezado_formularios">
                    <td colspan="4">Reporte de Asistencias Individuales</td>
                    </tr>
                  <tr>
                    <td width="132" class="titulos_formularios">C&eacute;dula:</td>
                    <td colspan="3" class="datos_formularios">&nbsp;<?php echo $_POST['cedula'];?>&nbsp;</td>
                    </tr>
                  <tr>
                    <td class="titulos_formularios">Nombre:</td>
                    <td colspan="3" class="datos_formularios">&nbsp;<?php echo $resultado_integrantes['nombres']." ".
			                                                             $resultado_integrantes['apellidos']; ?></td>
                    </tr>
                  <tr>
                    <td class="titulos_formularios">Desde:</td>
                    <td width="94" class="datos_formularios">&nbsp;<?php echo $_POST['desde'];?></td>
                    <td width="111" class="titulos_formularios">Hasta:</td>
                    <td width="164" class="datos_formularios">&nbsp;<?php echo $_POST['hasta'];?></td>
                  </tr>
                  <tr>
                    <td class="encabezado_formularios">Fecha</td>
                    <td colspan="2" class="encabezado_formularios">Entrada</td>
                    <td class="encabezado_formularios">Salida</td>
                  </tr>
                   <?php while($resultado=mysql_fetch_array($consulta)) { ?>                    
                      <tr>
                        <td class="datos_formularios"><div align="center"><?php 
/*								list($diaY ,$mesY, $anioY) = split("/", cambiaf_a_normal($resultado['fecha']));
								
								if (isset($dias_semana_retrasos[date("D", mktime(0, 0, 0, $mesY, $diaY, $anioY))])) 
								  {
								    $dias_semana_retrasos[date("D", mktime(0, 0, 0, $mesY, $diaY, $anioY))]++;
								  }
								else
								  {
								    $dias_semana_retrasos[date("D", mktime(0, 0, 0, $mesY, $diaY, $anioY))]=1;
								  }*/
						
						
						
						
						
						echo cambiaf_a_normal($resultado['fecha']); ?></div></td>
                        <td colspan="2" class="datos_formularios"><div align="center">
								<?php if (strtotime($resultado['entrada'])>= (strtotime($resultado_horario['hora_entrada']." + ".
                                                                            $resultado_horario['holgura_entrada']." minutes")))
                            { // si el emplado esta llegando tarde, busco la justificación
                              // recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
                             
								// Para sacar las estadísticas de la distribución de los días que el empleado llega tarde
								list($diaX ,$mesX, $anioX) = split("/", cambiaf_a_normal($resultado['fecha']));
								if (isset($dias_semana_retrasos[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))])) 
								  {
									$dias_semana_retrasos[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]++;
								  }
								else
								  {
									$dias_semana_retrasos[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]=1;
								  } 							 
							 
							    
								$cuenta_just=0;
                                $just_encontrada=false;
                                while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
                                {
                                  if (($resultado['fecha'] >= $resultado_just[$cuenta_just]['fecha_desde']) &&
								      ($resultado['fecha'] <= $resultado_just[$cuenta_just]['fecha_hasta']) &&
                                      ($resultado['entrada'] >= $resultado_just[$cuenta_just]['hora_desde']) && 
                                      ($resultado['entrada'] <= $resultado_just[$cuenta_just]['hora_hasta'])) 
                                        { 
                                          $just_encontrada = true; 
                                        }
                                 $cuenta_just++;
                                }
                                if ($just_encontrada == false) 
								  { 
									// Para sacar las estadísticas de la distribución de los días que el empleado llega tarde
									list($diaX ,$mesX, $anioX) = split("/", cambiaf_a_normal($resultado['fecha']));
									if (isset($dias_semana_retrasos_no_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))])) 
									  {
										$dias_semana_retrasos_no_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]++;
									  }
									else
									  {
										$dias_semana_retrasos_no_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]=1;
									  } 
 
								    $ind_asistentes_tarde_no_just++; 
								    echo "<span class='Estilo1'>";
                                  } // del encontrada false )osea, si la justificación no concuerda, se coloca en rojo
                                else
                                  { 
									// Para sacar las estadísticas de la distribución de los días que el empleado llega tarde
									list($diaX ,$mesX, $anioX) = split("/", cambiaf_a_normal($resultado['fecha']));
									if (isset($dias_semana_retrasos_si_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))])) 
									  {
										$dias_semana_retrasos_si_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]++;
									  }
									else
									  {
										$dias_semana_retrasos_si_just[date("D", mktime(0, 0, 0, $mesX, $diaX, $anioX))]=1;
									  }

								    $ind_asistentes_tarde_si_just++;
                                    ?>            
                                    <span class="Estilo2">
                                    <?php 			
                                  }
                              } // del si esta llegando tarde
                                ?>
                    
						<?php echo date("h:i:s a",strtotime($resultado['entrada'])); $ind_asistentes++;?> 
                        <?php if (strtotime($resultado['entrada'])>= (strtotime($resultado_horario['hora_entrada']." + ".
                        $resultado_horario['holgura_entrada']." minutes"))){?>
                        </span>
                        <?php }?>            
            
                        
                        
                        </div></td>
                        <td class="datos_formularios"><div align="center">
						
                        
					  	    <?php if (strtotime($resultado['salida'])< strtotime($resultado_horario['hora_salida'])){?>            
                            <span class="Estilo1">
                            <?php }?>
                            
                            <?php echo date("h:i:s a",strtotime($resultado['salida'])); ?> 
                            <?php if (strtotime($resultado['salida'])< strtotime($resultado_horario['hora_salida'])){?>
                            </span>
                            <?php }?>                         
                        
                        </div></td>
                      </tr>
                      
                      <?php }// del while que recorre la consulta ?>
                </table>


<?php 
     $fechas_a_consultar=array();
     $nro_dias = dias_entre_fechas(cambiaf_a_normal($desde),cambiaf_a_normal($hasta))+1; // tuve que sumarle uno porque a como diseñe la función no tomo en cuenta la fecha de inicio para poder contar losdias entre una y otra ya que se cuenta del timestamo actual hasta el siguiente 24 horas despues; asi que lo mas fácil es sumerle uno acá para compensar por ese dia que no cuenta.
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
<table width="511" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
      <input type="button" name="volver" id="volver" value="Realizar otra consulta" onclick="javascript: location.href='../asistencia_cedula.php'" />
    </div></td>
  </tr>
</table>
<br />
<table width="513" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="encabezado_formularios">Inasistencias</td>
  </tr>
  <tr>
    <td class="encabezado_formularios">Fecha</td>
    <td width="364" class="encabezado_formularios">Observación</td>
  </tr>
  <?php //cada vez que escribo el fetch array el va bajando una linea en la tabla //   while($resultado_inasistencias=mysql_fetch_array($consulta_inasistencias)) { 
    //   for ($cuenta_datos=0;$cuenta_datos<count($fechas_a_consultar); $cuenta_datos++) { 
         foreach ($fechas_a_consultar as $valor) { ?>
  <tr>
    <td class="datos_formularios"><div align="center"><?php echo $valor;//$fechas_a_consultar[$cuenta_datos]; ?></div>      
      <div align="left"></div></td>
    <td class="datos_formularios"><div align="center"><?php  $cuenta_ina=0; $esta=false;
													    while (($esta == false) && ($cuenta_ina < count($resultado_just)-1)) 
														 { 
														   if ((cambiaf_a_mysql($valor) >= $resultado_just[$cuenta_ina]['fecha_desde']) and
															   (cambiaf_a_mysql($valor) <= $resultado_just[$cuenta_ina]['fecha_hasta']) and
															   ($resultado_just[$cuenta_ina]['hora_desde'] <= $resultado_horario['hora_entrada']) and
															   ($resultado_just[$cuenta_ina]['hora_desde'] >= $resultado_horario['hora_entrada'])) 
																   {
																	 $esta=true;
																   }
															else
															{
															  $cuenta_ina++;
															}
														 }
														 // si lo encontre, le pongo la observación, si no le pongo inasistente.
														if ($esta == true)
														 {
														   $ind_inasistentes_si_just++;
														   echo "Tipo: ".$arreglo_tipo[$resultado_just[$cuenta_ina]
														                              ['codigo_tipo_justificacion']].", C&oacute;d: ".
																					  $resultado_just[$cuenta_ina]['id'];
																
																//$resultado_just[$cuenta_ina]['observaciones'];
														 } 
														else
														 {
														   $ind_inasistentes_no_just++;
														   echo "<span class='Estilo1'> I N A S I S T E N T E </span>";
															    //$colocado=true;
														 }
															   ?></div></td>
  </tr>
  <?php } // del foreach ?>
</table>
<table width="511" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
      <input type="button" name="volver" id="volver" value="Realizar otra consulta" onclick="javascript: location.href='../asistencia_cedula.php'" />
    </div></td>
  </tr>
</table>
<br />

<table width="511" border="1" align="center" cellpadding="0" cellspacing="0">
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
            <td colspan="3" class="datos_formularios"><div align="justify"><?php echo "<strong>C&oacute;digo: ".$resultado_just[$cuenta_just]['id'].", Desde el: ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_desde'])." hasta el ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_hasta']).", de ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_desde']))." a ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_hasta'])).", </strong> Tipo de Permiso: ".$arreglo_tipo[$resultado_just[$cuenta_just]['codigo_tipo_justificacion']].", Tipo de Falta: ".$arreglo_tipo_falta[$resultado_just[$cuenta_just]['codigo_tipo_falta']].", Motivo: ".$resultado_just[$cuenta_just]['observaciones']; ?></div></td>
          </tr>
  <?php 
       	 } // si cedi = cedula
	 else
	   {  // si es el mismo funcionario, pero con otro permiso, simplemente se añade otra descripcion con otro color
	     $contador_color++;
	?>
          <tr bgcolor="<?php echo $color[$contador_color%2]; ?>">
          
            <td colspan="3" class="datos_formularios"><div align="justify"><?php echo "<strong>C&oacute;digo: ".$resultado_just[$cuenta_just]['id'].", Desde el: ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_desde'])." hasta el ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_hasta']).", de ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_desde']))." a ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_hasta'])).", </strong> Tipo de Permiso: ".$arreglo_tipo[$resultado_just[$cuenta_just]['codigo_tipo_justificacion']].", Tipo de Falta: ".$arreglo_tipo_falta[$resultado_just[$cuenta_just]['codigo_tipo_falta']].", Motivo: ".$resultado_just[$cuenta_just]['observaciones']; ?></div></td>
          </tr>	     
		<?php 	
	 
	   }
  $cuenta_just++;
  }?>
</table>

<?php 


    $chart = new PieChart();
	$dataSet = new XYDataSet();
	if ($ind_asistentes>=1) {$dataSet->addPoint(new Point("Asistencias: (".$ind_asistentes.")", $ind_asistentes));};
	if ($ind_inasistentes_no_just>=1) {$dataSet->addPoint(new Point("Inasistencias NO JUSTIFICADAS: (".$ind_inasistentes_no_just.")", $ind_inasistentes_no_just));};
	if ($ind_inasistentes_si_just>=1) {$dataSet->addPoint(new Point("Inasistencias JUSTIFICADAS: (".$ind_inasistentes_si_just.")", $ind_inasistentes_si_just));};
	$chart->setDataSet($dataSet);
	$chart->setTitle("% de Asistencias / Inasistencias de: ".$resultado_integrantes['nombres']." ".$resultado_integrantes['apellidos']);
	$chart->render("../../imgs/graf/asistencia_diaria_04.png");


    $chart2 = new PieChart();
	$dataSet2 = new XYDataSet();
	$ind_asistentes_no_retrasados=$ind_asistentes-$ind_asistentes_tarde_no_just-$ind_asistentes_tarde_si_just;
	if ($ind_asistentes_no_retrasados>=1) {$dataSet2->addPoint(new Point("Puntuales: (".$ind_asistentes_no_retrasados.")", $ind_asistentes_no_retrasados));};
	if ($ind_asistentes_tarde_no_just>=1) {$dataSet2->addPoint(new Point("Impuntuales NO JUSTIFICADOS: (".$ind_asistentes_tarde_no_just.")", $ind_asistentes_tarde_no_just));};
	if ($ind_asistentes_tarde_si_just>=1) {$dataSet2->addPoint(new Point("Impuntuales JUSTIFICADOS: (".$ind_asistentes_tarde_si_just.")", $ind_asistentes_tarde_si_just));};
	$chart2->setDataSet($dataSet2);
	$chart2->setTitle("Porcentajes de Retrasos para: ".$resultado_integrantes['nombres']." ".$resultado_integrantes['apellidos']);
	$chart2->render("../../imgs/graf/asistencia_diaria_03.png");
	
	
	
	$chart3 = new VerticalBarChart();
	
	$serie1 = new XYDataSet();
	if (isset($dias_semana_retrasos['Mon'])) {$serie1->addPoint(new Point("Lunes", $dias_semana_retrasos['Mon']));} else {$serie1->addPoint(new Point("Lunes", 0));};
	if (isset($dias_semana_retrasos['Tue'])) {$serie1->addPoint(new Point("Martes", $dias_semana_retrasos['Tue']));}else {$serie1->addPoint(new Point("Martes", 0));};
	if (isset($dias_semana_retrasos['Wed'])) {$serie1->addPoint(new Point("Miércoles", $dias_semana_retrasos['Wed']));}else {$serie1->addPoint(new Point("Miércoles", 0));};
	if (isset($dias_semana_retrasos['Thu'])) {$serie1->addPoint(new Point("Jueves", $dias_semana_retrasos['Thu']));}else {$serie1->addPoint(new Point("Jueves", 0));};
	if (isset($dias_semana_retrasos['Fri'])) {$serie1->addPoint(new Point("Viernes", $dias_semana_retrasos['Fri']));}else {$serie1->addPoint(new Point("Viernes", 0));};
	
	
	$serie2 = new XYDataSet();
	if (isset($dias_semana_retrasos_si_just['Mon'])) {$serie2->addPoint(new Point("Lunes", $dias_semana_retrasos_si_just['Mon']));} else {$serie2->addPoint(new Point("Lunes", 0));};
	if (isset($dias_semana_retrasos_si_just['Tue'])) {$serie2->addPoint(new Point("Martes", $dias_semana_retrasos_si_just['Tue']));}else {$serie2->addPoint(new Point("Martes", 0));};
	if (isset($dias_semana_retrasos_si_just['Wed'])) {$serie2->addPoint(new Point("Miércoles", $dias_semana_retrasos_si_just['Wed']));}else {$serie2->addPoint(new Point("Miércoles", 0));};
	if (isset($dias_semana_retrasos_si_just['Thu'])) {$serie2->addPoint(new Point("Jueves", $dias_semana_retrasos_si_just['Thu']));}else {$serie2->addPoint(new Point("Jueves", 0));};
	if (isset($dias_semana_retrasos_si_just['Fri'])) {$serie2->addPoint(new Point("Viernes", $dias_semana_retrasos_si_just['Fri']));}else {$serie2->addPoint(new Point("Viernes", 0));};
	

	$serie3 = new XYDataSet();
	if (isset($dias_semana_retrasos_no_just['Mon'])) {$serie3->addPoint(new Point("Lunes", $dias_semana_retrasos_no_just['Mon']));} else {$serie3->addPoint(new Point("Lunes", 0));};
	if (isset($dias_semana_retrasos_no_just['Tue'])) {$serie3->addPoint(new Point("Martes", $dias_semana_retrasos_no_just['Tue']));}else {$serie3->addPoint(new Point("Martes", 0));};
	if (isset($dias_semana_retrasos_no_just['Wed'])) {$serie3->addPoint(new Point("Miércoles", $dias_semana_retrasos_no_just['Wed']));}else {$serie3->addPoint(new Point("Miércoles", 0));};
	if (isset($dias_semana_retrasos_no_just['Thu'])) {$serie3->addPoint(new Point("Jueves", $dias_semana_retrasos_no_just['Thu']));}else {$serie3->addPoint(new Point("Jueves", 0));};
	if (isset($dias_semana_retrasos_no_just['Fri'])) {$serie3->addPoint(new Point("Viernes", $dias_semana_retrasos_no_just['Fri']));}else {$serie3->addPoint(new Point("Viernes", 0));};	
	
	
	
	$dataSet3 = new XYSeriesDataSet();
	$dataSet3->addSerie("Retrasos Totales", $serie1);
	$dataSet3->addSerie("Retrasos Justificados", $serie2);
	$dataSet3->addSerie("Retrasos Injustificados", $serie3);
//	$dataSet3->addSerie("Product 4", $serie4);
//	$dataSet3->addSerie("Product 5", $serie5);
	$chart3->setDataSet($dataSet3);
	

	$chart3->setTitle("Retrasos por día de la semana: ".$resultado_integrantes['nombres']." ".$resultado_integrantes['apellidos']);
	$chart3->render("../../imgs/graf/asistencia_diaria_05.png");
	
	
	

?>

<br />
<table width="617" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" class="encabezado_formularios">Indicadores</div></td>
  </tr>
  <tr>
    <td><div align="center">
      <p><img alt="Estadisticas de Retrasos" src="../../imgs/graf/asistencia_diaria_03.png" style="border: 1px solid gray;"/><br />
        <br />
        <img alt="Estadística de Inasistencias" src="../../imgs/graf/asistencia_diaria_04.png" style="border: 1px solid gray;"/><br />
        <br />
        <img alt="Estad&iacute;stica de Inasistencias" src="../../imgs/graf/asistencia_diaria_05.png" style="border: 1px solid gray;"/><br />
    </p>
      </div></td>
  </tr>
</table>
<table width="617" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
      <input type="button" name="volver" id="volver" value="Realizar otra consulta" onclick="javascript: location.href='../asistencia_cedula.php'" />
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
    <!-- #BeginDate format:fcSw1a -->Thursday, 21 August, 2008 12:13 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>