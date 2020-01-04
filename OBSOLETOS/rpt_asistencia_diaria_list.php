<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra el reporte de asistencia diaria tipo sabana por todos los funcionarios sujetos al control de asitencias.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
?>
<?php 



 session_start();
 include("../../db/conexion.php");
 include("../../libs/utilidades.php");
 include("../../libs/libchart/classes/libchart.php");
 $fecha_reporte=cambiaf_a_mysql($_POST['fecha']);
 
 // para ingresar marca de auditoria.   
 include("../../db/inserta_rastreo.php");
 $descripcion='Consulta Asistencia Diaria del '.$_POST['fecha'];
 $ip = $REMOTE_ADDR; 
 inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'C',$descripcion,$ip);

// Para limpiar los valores de las variables que se mostraran en los graficos de los indicadores.
$ind_asistentes=0;
$ind_asistentes_no_retrasados=0;
$ind_asistentes_tarde_no_just=0;
$ind_asistentes_tarde_si_just=0;
$ind_inasistentes_no_just=0;
$ind_inasistentes_si_just=0;
// $cedula=$_POST['cedula'];

 $link=conectarse("organizacion");  
 $link=conectarse("asistencias"); 
// $link=conectarse("nomina"); 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
// mysql_select_db("personal");
 
 $consulta=mysql_query("SELECT (p.cedula) as cedula_integrantes, p.nombres, p.apellidos, 
                               e.cedula, e.fecha, MIN(e.hora) as entrada, MAX(e.hora) as salida 
					    FROM asistencias.entrada_salida as e, organizacion.personas as p 
						WHERE ((p.cedula = e.cedula) and 
							   (p.fecha_ingreso <= '$fecha_reporte') and
						       (e.fecha <= '$fecha_reporte') and
							   (e.fecha >= '$fecha_reporte')) 
					    GROUP BY e.cedula 
						ORDER BY entrada, p.nombres, p.apellidos",$link) or die(mysql_error());
						
  $consulta_horario=mysql_query("select * from asistencias.opciones",$link) or die(mysql_error());
  $resultado_horario=mysql_fetch_array($consulta_horario);
 
 
// Ahora consulto las justificaciones que tengan los empleados para la fecha seleccionada y que se encuentren aprobadas  
 $consulta_just=mysql_query("SELECT (p.cedula) as cedula_just, p.nombres, p.apellidos, j.*, jp.*, jd.*
					    FROM asistencias.justificaciones as j, asistencias.justificaciones_dias as jd, 
						     asistencias.justificaciones_personas as jp, organizacion.personas as p
						WHERE ((p.cedula = jp.cedula) and 
						       (p.fecha_ingreso <= '$fecha_reporte') and 
						       (jd.fecha_desde <= '$fecha_reporte') and
							   (jd.fecha_hasta >= '$fecha_reporte') and 
							   (j.estatus='1') and (j.codigo=jd.codigo_just) and (j.codigo=jp.codigo_just)) 
						ORDER BY jp.cedula",$link) or die(mysql_error()); 
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



// Ahora se realiza la consulta de los inasistentes.

 $consulta_inasistencias=mysql_query("SELECT p.cedula as cedula_integrantes, p.nombres, p.apellidos  
									  FROM organizacion.personas as p, asistencias.personas_status_asistencias as s
									  WHERE ((s.status_asistencia = '1') and
									  		 (s.cedula = p.cedula) and
									         (p.fecha_ingreso <= '$fecha_reporte') and
									         (p.cedula not in 
									           (SELECT e.cedula 
										        FROM asistencias.entrada_salida as e 
										   	    WHERE (e.fecha = '$fecha_reporte') 
											    GROUP BY e.cedula))) 
									  ORDER BY p.nombres, p.apellidos",$link) or die(mysql_error());
 
// $resultado=mysql_fetch_array($consulta);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Reporte de asistencia diaria</title>
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


<link href="../../css/formularios.css" rel="stylesheet" type="text/css" />
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
-->
</style>
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
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" --><br />
<table width="661" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <div align="right">
        <input type="button" name="volver" id="volver" value="Consultar otro dia" onclick="javascript: location.href='../asistencia_diaria.php'" />
        </div></td></tr>
</table>
<table width="663" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" class="encabezado_formularios">Reporte de Asistencia</td>
  </tr>
  <tr>
    <td colspan="4" class="encabezado_formularios">Fecha Seleccionada: <?php echo $_POST['fecha'] ?></td>
  </tr>
  <tr>
    <td width="88" class="encabezado_formularios">C&eacute;dula</td>
    <td width="328" class="encabezado_formularios">Nombre</td>
    <td width="120" class="encabezado_formularios">Entrada</td>
    <td width="117" class="encabezado_formularios">Salida</td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
       $color=array("#FFFFFF","#CCFFFF"); // para darle colores alternos a las lineas que muestro
	   $contador=0; // este contador permitira darle la alternabilidad a los colores
       while($resultado=mysql_fetch_array($consulta)) { ?>   
          <tr bgcolor="<?php echo $color[$contador%2]; ?>">
            <td class="datos_formularios"><div align="center"><?php $ind_asistentes++; echo $resultado['cedula_integrantes']; ?></div></td>
            <td class="datos_formularios"><div align="left"> &nbsp;<?php echo $resultado['nombres']." ".
			                                                             $resultado['apellidos']; ?></div></td>
            <td class="datos_formularios"><div align="center">
			<?php if (strtotime($resultado['entrada'])>= (strtotime($resultado_horario['hora_entrada']." + ".
			                                                        $resultado_horario['holgura_entrada']." minutes")))
					{ // si el emplado esta llegando tarde, busco la justificación
			// recorro el arreglo que me traje para saber si la falta se encuentra contemplada en el permiso.
						$cuenta_just=0;
						$just_encontrada=false;
						while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
						{
						  if (($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
							  ($resultado['entrada'] >= $resultado_just[$cuenta_just]['hora_desde']) && 
							  ($resultado['entrada'] <= $resultado_just[$cuenta_just]['hora_hasta'])&&
							  (es_dia($_POST['fecha'],$resultado_just[$cuenta_just]['lun'],$resultado_just[$cuenta_just]['mar'],
							   $resultado_just[$cuenta_just]['mie'],$resultado_just[$cuenta_just]['jue'],
							   $resultado_just[$cuenta_just]['vie'])==true)) 
								{ 
								  $just_encontrada = true; 
								}
						 $cuenta_just++;
						}
						if ($just_encontrada == false) { echo "<span class='Estilo1'>"; $ind_asistentes_tarde_no_just++;
						} // del encontrada false )osea, si la justificación no concuerda, se coloca en rojo
						else
						{ // si esta justificado, se coloca en verde
						  $ind_asistentes_tarde_si_just++;
						?>            
						  <span class="Estilo2">
						<?php 			
						}
			} // del si esta llegando tarde
			?>
            
            <?php echo date("h:i:s a",strtotime($resultado['entrada'])); ?> 
			<?php if (strtotime($resultado['entrada'])>= (strtotime($resultado_horario['hora_entrada']." + ".$resultado_horario['holgura_entrada']." minutes"))){?>
            </span>
            <?php }?>            
            </div></td>
            <td class="datos_formularios"><div align="center">


             <?php if (strtotime($resultado['salida'])< strtotime($resultado_horario['hora_salida']))
			 { // si esta saliendo temprano busco la justificacion			 
				$cuenta_just=0;
				$just_encontrada=false;
				while (($cuenta_just < count($resultado_just)) && ($just_encontrada == false))
				{
				  if (($resultado['cedula_integrantes'] == $resultado_just[$cuenta_just]['cedula_just']) &&
					  ($resultado['salida'] >= $resultado_just[$cuenta_just]['hora_desde']) && 
					  ($resultado['salida'] <= $resultado_just[$cuenta_just]['hora_hasta'])&&
					  (es_dia($_POST['fecha'],$resultado_just[$cuenta_just]['lun'],$resultado_just[$cuenta_just]['mar'],
					   $resultado_just[$cuenta_just]['mie'],$resultado_just[$cuenta_just]['jue'],
					   $resultado_just[$cuenta_just]['vie'])==true)) 
						{ 
						  $just_encontrada = true; 
						}
				 $cuenta_just++;
				}
				if ($just_encontrada == false) 
				  { 
				    echo "<span class='Estilo1'>"; //$ind_asistentes_tarde_no_just++;
				  } // del encontrada false )osea, si la justificación no concuerda, se coloca en rojo
				else
				  { // si esta justificado, se coloca en verde
				   //$ind_asistentes_tarde_si_just++;
				?>            
				   <span class="Estilo2">
				<?php 			
				  }
			} // del si llega tarde			 		 
			 ?>            
            
            <?php echo date("h:i:s a",strtotime($resultado['salida'])); ?> 
			<?php if (strtotime($resultado['salida'])< strtotime($resultado_horario['hora_salida'])){?>
            </span>
            <?php }?>
            </div></td>
          </tr> 
  <?php $contador++; }?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="661" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <div align="right">
        <input type="button" name="volver" id="volver" value="Consultar otro dia" onclick="javascript: location.href='../asistencia_diaria.php'" />
        </div></td></tr>
</table>
<br />
<br />
<table width="663" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" class="encabezado_formularios">Reporte de Inasistencias</td>
  </tr>
  <tr>
    <td colspan="3" class="encabezado_formularios">Fecha Seleccionada: <?php echo $_POST['fecha'] ?></td>
  </tr>
  <tr>
    <td width="88" class="encabezado_formularios">C&eacute;dula</td>
    <td width="328" class="encabezado_formularios">Nombre</td>
    <td class="encabezado_formularios">Observaci&oacute;n</td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
  	   $contador=0; // este contador permitira darle la alternabilidad a los colores
	   // La lógica para esta sección es que si no vino (osea que se encuentra dentro de la consulta que se sacó de los inasistentes para el dia) y posee una justificación
	   // entonces lo que se esta justificando ese dia debe ser su inasistencia, no obstante, seria bueno comprobar que la justificación fuera desde el principio al final del dia.
       while($resultado_inasistencias=mysql_fetch_array($consulta_inasistencias)) { ?>
  <tr bgcolor="<?php echo $color[$contador%2]; ?>">
    <td class="datos_formularios"><div align="center"><?php echo $resultado_inasistencias['cedula_integrantes']; ?></div></td>
    <td class="datos_formularios"><div align="left"> &nbsp;<?php echo $resultado_inasistencias['nombres']." ".
			                                                             $resultado_inasistencias['apellidos']; ?></div></td>
    <td class="datos_formularios"><div align="center"><?php  $cuenta_ina=0; $colocado=false;
															 while (($colocado == false) && ($cuenta_ina < count($resultado_just)-1)) 
															   { 
															     if (($resultado_inasistencias['cedula_integrantes'] == 
															          $resultado_just[$cuenta_ina]['cedula_just']) &&
							  									     (es_dia($_POST['fecha'],$resultado_just[$cuenta_ina]['lun'],
																	  $resultado_just[$cuenta_ina]['mar'],$resultado_just[$cuenta_ina]['mie'],
																	  $resultado_just[$cuenta_ina]['jue'],
																	  $resultado_just[$cuenta_ina]['vie'])==true)) 
																     {    
																	   echo $arreglo_tipo[$resultado_just[$cuenta_ina]
														                             ['codigo_tipo_justificacion']].", C&oacute;d: ".
																  				  $resultado_just[$cuenta_ina]['codigo'];
																	 
																	   $ind_inasistentes_si_just++;
																	   $colocado=true;
																     }
																  $cuenta_ina++;
																} // del while   
																   
															   if ($colocado == false)
															   {
															    echo "<span class='Estilo1'> I N A S I S T E N T E </span>";
																$ind_inasistentes_no_just++;
															   // $colocado=true;
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
<table width="661" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <div align="right">
        <input type="button" name="volver" id="volver" value="Consultar otro dia" onclick="javascript: location.href='../asistencia_diaria.php'" />
        </div></td></tr>
</table><br />
<br />
<table width="661" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr class="encabezado_formularios">
    <td colspan="2">Observaciones a la asistencia</td>
  </tr>
    <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
       $cedi="XX";
       $color=array("#FFFFFF","#CCFFFF"); // para darle colores alternos a las lineas que muestro
       $contador_color=0; // este contador permitira darle la alternabilidad a los colores
	   $cuenta_just=0;
	   while ($cuenta_just < count($resultado_just)-1) { 
	   
	   if (es_dia($_POST['fecha'],$resultado_just[$cuenta_just]['lun'],$resultado_just[$cuenta_just]['mar'],$resultado_just[$cuenta_just]['mie'],
	       $resultado_just[$cuenta_just]['jue'], $resultado_just[$cuenta_just]['vie'])==true)
         {
	   
		   if ($cedi != $resultado_just[$cuenta_just]['cedula_just'])
		   { // si no son iguales, se escribe el nuevo encabezado del funcionario	
			 $cedi=$resultado_just[$cuenta_just]['cedula_just']; 
			// $contador_color++;  
		   ?>   
			  <tr>
				<td width="73" class="encabezado_formularios"><?php echo $resultado_just[$cuenta_just]['cedula_just']; ?></td>
				<td width="582" class="encabezado_formularios"><div align="left">&nbsp;&nbsp;&nbsp;<?php echo $resultado_just[$cuenta_just]['nombres']." ".
				$resultado_just[$cuenta_just]['apellidos']; ?></div></td>
			</tr>
			  <tr>
				<td colspan="2" class="datos_formularios"><div align="justify"><?php echo "<strong>C&oacute;digo: ".$resultado_just[$cuenta_just]['codigo'].", Desde el: ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_desde'])." hasta el ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_hasta']).", de ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_desde']))." a ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_hasta'])).", </strong> Tipo: ".$arreglo_tipo[$resultado_just[$cuenta_just]['codigo_tipo_justificacion']].", Falta: ".$arreglo_tipo_falta[$resultado_just[$cuenta_just]['codigo_tipo_falta']].", Motivo: ".$resultado_just[$cuenta_just]['observaciones']; ?></div></td>
			  </tr>
	  <?php 
			 } // si cedi = cedula
		 else
		   {  // si es el mismo funcionario, pero con otro permiso, simplemente se añade otra descripcion con otro color
			 $contador_color++;
		?>
			  <tr bgcolor="<?php echo $color[$contador_color%2]; ?>">
			  
				<td colspan="2" class="datos_formularios"><div align="justify"><?php echo "<strong>C&oacute;digo: ".$resultado_just[$cuenta_just]['id'].", Desde el: ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_desde'])." hasta el ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_hasta']).", de ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_desde']))." a ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_hasta'])).", </strong> Tipo: ".$arreglo_tipo[$resultado_just[$cuenta_just]['codigo_tipo_justificacion']].", Falta: ".$arreglo_tipo_falta[$resultado_just[$cuenta_just]['codigo_tipo_falta']].", Motivo: ".$resultado_just[$cuenta_just]['observaciones']; ?></div></td>
			  </tr>	     
			<?php 	
		 
	       }
		 } // del if es dia
  $cuenta_just++;
  } // del while cuentajust?>
</table>
<table width="661" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <div align="right">
        <input type="button" name="volver" id="volver" value="Consultar otro dia" onclick="javascript: location.href='../asistencia_diaria.php'" />
        </div></td></tr>
</table>

<?php 	
    // Se realiza la construcción del gráfico para indicadores
    $chart = new PieChart();
	$dataSet = new XYDataSet();
	if ($ind_asistentes>=1) {$dataSet->addPoint(new Point("Funcionarios Asistentes: (".$ind_asistentes.")", $ind_asistentes));};
	if ($ind_inasistentes_no_just>=1) {$dataSet->addPoint(new Point("Inasistentes NO JUSTIFICADOS: (".$ind_inasistentes_no_just.")", $ind_inasistentes_no_just));};
	if ($ind_inasistentes_si_just>=1) {$dataSet->addPoint(new Point("Inasistentes JUSTIFICADOS: (".$ind_inasistentes_si_just.")", $ind_inasistentes_si_just));};
	$chart->setDataSet($dataSet);
	$chart->setTitle("Porcentajes de Asistencias / Inasistencias del: ".$_POST['fecha']);
	$chart->render("../../imgs/graf/asistencia_diaria_01.png");


    $chart2 = new PieChart();
	$dataSet2 = new XYDataSet();
	$ind_asistentes_no_retrasados=$ind_asistentes-$ind_asistentes_tarde_no_just-$ind_asistentes_tarde_si_just;
	if ($ind_asistentes_no_retrasados>=1) {$dataSet2->addPoint(new Point("Puntuales: (".$ind_asistentes_no_retrasados.")", $ind_asistentes_no_retrasados));};
	if ($ind_asistentes_tarde_no_just>=1) {$dataSet2->addPoint(new Point("Impuntuales NO JUSTIFICADOS: (".$ind_asistentes_tarde_no_just.")", $ind_asistentes_tarde_no_just));};
	if ($ind_asistentes_tarde_si_just>=1) {$dataSet2->addPoint(new Point("Impuntuales JUSTIFICADOS: (".$ind_asistentes_tarde_si_just.")", $ind_asistentes_tarde_si_just));};
	$chart2->setDataSet($dataSet2);
	$chart2->setTitle("Porcentajes de Retrasos del: ".$_POST['fecha']);
	$chart2->render("../../imgs/graf/asistencia_diaria_02.png");?>


<br />
<table width="661" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" class="encabezado_formularios">Indicadores</div></td>
  </tr>
  <tr>
    <td><div align="center">
      <p><img alt="Vertical bars chart" src="../../imgs/graf/asistencia_diaria_02.png" style="border: 1px solid gray;"/></p>
      <br />
      <img alt="Vertical bars chart" src="../../imgs/graf/asistencia_diaria_01.png" style="border: 1px solid gray;"/></div></td>
  </tr>
</table>
<br />
<table width="661" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <div align="right">
        <input type="button" name="volver" id="volver" value="Consultar otro dia" onclick="javascript: location.href='../asistencia_diaria.php'" />
        </div></td></tr>
</table>
<p></p>
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
