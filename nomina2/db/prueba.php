
<?php 
 include("../db/conexion.php");
 include("../libs/utilidades.php");
$fecha_reporte=cambiaf_a_mysql($_POST['fecha']);
// $cedula=$_POST['cedula'];

// $link=conectarse("intranet");  
 $link=conectarse("personal"); 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
// mysql_select_db("personal");
 
 $consulta=mysql_query("SELECT (integrantes.cedula) as cedula_integrantes, integrantes.nombres, integrantes.apellidos, 
                               asistencias_entrada_salida.cedula, asistencias_entrada_salida.fecha,  
							   MIN(asistencias_entrada_salida.hora) as entrada, MAX(asistencias_entrada_salida.hora) as salida 
					    FROM asistencias_entrada_salida, integrantes 
						WHERE ((integrantes.cedula = asistencias_entrada_salida.cedula) and 
						       (asistencias_entrada_salida.fecha <= '$fecha_reporte') and
							   (asistencias_entrada_salida.fecha >= '$fecha_reporte')) 
					    GROUP BY cedula 
						ORDER BY entrada, nombres, apellidos",$link) or die(mysql_error());
						
  $consulta_horario=mysql_query("select * from asistencias_opciones") or die(mysql_error());
  $resultado_horario=mysql_fetch_array($consulta_horario);
 
 
// Ahora consulto las justificaciones que tengan los empleados para la fecha seleccionada y que se encuentren aprobadas  
 $consulta_just=mysql_query("SELECT (integrantes.cedula) as cedula_just, integrantes.nombres, integrantes.apellidos,   
                               asistencias_justificaciones.* 
					    FROM asistencias_justificaciones, integrantes 
						WHERE ((integrantes.cedula = asistencias_justificaciones.cedula) and 
						       (asistencias_justificaciones.fecha_desde <= '$fecha_reporte') and
							   (asistencias_justificaciones.fecha_hasta >= '$fecha_reporte') and 
							   (asistencias_justificaciones.estatus='1')) 
						ORDER BY asistencias_justificaciones.cedula",$link) or die(mysql_error()); 
 // para cargar todo esto en un arreglo
 while($resultado_just[]=mysql_fetch_array($consulta_just)) {};
  
  // Consulto los tipos de justificaciones para construir el array y asi poder mostrarlo en el reporte
  // para cargar todo esto en un arreglo
 $consulta_tipo_just=mysql_query("SELECT id, codigo, descripcion FROM asistencias_tipo_justificaciones",$link) or die(mysql_error()); 
 
 $arreglo_tipo=array();
 while($resultado_tipo_just=mysql_fetch_array($consulta_tipo_just)) 
   {
    $arreglo_tipo[$resultado_tipo_just['id']]=$resultado_tipo_just['descripcion'];
   };
// hago lo mismo con los tipos de falta en las que puede incurrir el funcionario.
 $consulta_tipo_falta=mysql_query("SELECT id, codigo, descripcion FROM asistencias_tipo_faltas",$link) or die(mysql_error()); 
 $arreglo_tipo_falta=array();
 while($resultado_tipo_falta=mysql_fetch_array($consulta_tipo_falta)) 
   {
    $arreglo_tipo_falta[$resultado_tipo_falta['codigo']]=$resultado_tipo_falta['descripcion'];
   };


/*SELECT cedula, nombres, apellidos FROM integrantes WHERE ((status='1') and 
(cedula not in (SELECT cedula FROM asistencias_entrada_salida WHERE (fecha = '2007-10-18') GROUP BY cedula))) order by nombres, apellidos




SELECT integrantes.cedula, integrantes.nombres, integrantes.apellidos FROM integrantes LEFT JOIN asistencias_justificaciones ON (integrantes.cedula=asistencias_justificaciones.cedula) WHERE ((integrantes.status='1') and (asistencias_justificaciones.fecha_desde>='2007-10-18') and (asistencias_justificaciones.fecha_hasta<='2007-10-18') and
(integrantes.cedula not in (SELECT asistencias_entrada_salida.cedula FROM asistencias_entrada_salida WHERE (asistencias_entrada_salida.fecha = '2007-10-18') GROUP BY asistencias_entrada_salida.cedula))) order by integrantes.nombres, integrantes.apellidos


// Esta consulta trae todos los que estan inasistentes que tienen observaciones
SELECT integrantes.cedula, integrantes.nombres, integrantes.apellidos FROM integrantes, asistencias_justificaciones WHERE ((integrantes.status='1') and (asistencias_justificaciones.fecha_desde>='2007-10-18') and (asistencias_justificaciones.fecha_hasta<='2007-10-18') and (integrantes.cedula=asistencias_justificaciones.cedula) and (integrantes.cedula not in (SELECT asistencias_entrada_salida.cedula FROM asistencias_entrada_salida WHERE (asistencias_entrada_salida.fecha = '2007-10-18') GROUP BY asistencias_entrada_salida.cedula))) order by integrantes.nombres, integrantes.apellidos

SELECT integrantes.cedula, integrantes.nombres, integrantes.apellidos, asistencias_justificaciones.observaciones FROM integrantes left join asistencias_justificaciones on
(integrantes.cedula=asistencias_justificaciones.cedula) WHERE ((integrantes.status='1') and (asistencias_justificaciones.fecha_desde>='2007-10-18') and (asistencias_justificaciones.fecha_hasta<='2007-10-18') and (integrantes.cedula not in (SELECT asistencias_entrada_salida.cedula FROM asistencias_entrada_salida WHERE (asistencias_entrada_salida.fecha = '2007-10-18') GROUP BY asistencias_entrada_salida.cedula))) order by integrantes.nombres, integrantes.apellidos



// Esta consulta podría funcionar, pero tengo que chequear que pasaria si una persona tiene varias observaciones cuando no viene, como lo imagine, si tengo una observacion para el 17 y una para el 18 de la misma persona, me trae las dos en vez de la que le corresponde a la fecha seleccionada.
SELECT integrantes.cedula, integrantes.nombres, integrantes.apellidos, asistencias_justificaciones.observaciones FROM integrantes LEFT JOIN asistencias_justificaciones ON (integrantes.cedula=asistencias_justificaciones.cedula) WHERE ((integrantes.status='1') and 
(integrantes.cedula not in (SELECT asistencias_entrada_salida.cedula FROM asistencias_entrada_salida WHERE (asistencias_entrada_salida.fecha = '2007-10-18') GROUP BY asistencias_entrada_salida.cedula))) order by integrantes.nombres, integrantes.apellidos


// tratando de corregir el error de arriba
SELECT integrantes.cedula as cedula_integrantes, integrantes.nombres, integrantes.apellidos, 
  asistencias_justificaciones.observaciones 
FROM integrantes 
LEFT JOIN asistencias_justificaciones ON (integrantes.cedula=asistencias_justificaciones.cedula) LEFT JOIN asistencias_entrada_salida ON ((integrantes.cedula=asistencias_entrada_salida.cedula) and (asistencias_justificaciones.fecha_desde <=  asistencias_entrada_salida.fecha) and (asistencias_justificaciones.fecha_hasta >=  asistencias_entrada_salida.fecha) and
(asistencias_entrada_salida.fecha = '2007-10-18')) 
WHERE ((integrantes.status='1') and (integrantes.cedula not in 
(SELECT asistencias_entrada_salida.cedula 
FROM asistencias_entrada_salida 
WHERE (asistencias_entrada_salida.fecha = '2007-10-18') 
GROUP BY asistencias_entrada_salida.cedula))) 
ORDER BY integrantes.nombres, integrantes.apellidos


// voy probando esta consulta, ver por que no funciona
SELECT integrantes.cedula as cedula_integrantes, integrantes.nombres, integrantes.apellidos, 
  asistencias_justificaciones.observaciones 
FROM integrantes, asistencias_entrada_salida,  
LEFT JOIN asistencias_justificaciones ON (integrantes.cedula_integrantes = asistencias_justificaciones.cedula) 
WHERE ((integrantes.status='1') and 
(integrantes.cedula=asistencias_entrada_salida.cedula) and
(asistencias_entrada_salida.fecha = '2007-10-18') and
(integrantes.cedula not in 
(SELECT asistencias_entrada_salida.cedula 
FROM asistencias_entrada_salida 
WHERE (asistencias_entrada_salida.fecha = '2007-10-18') 
GROUP BY asistencias_entrada_salida.cedula))) 
ORDER BY integrantes.nombres, integrantes.apellidos


*/



// Esta consulta funciona pero me trae todos los que tengan observaciones, sean o no de la fecha que deseo.
/* $consulta_inasistencias=mysql_query("SELECT integrantes.cedula as cedula_integrantes, integrantes.nombres, integrantes.apellidos, 
                                             asistencias_justificaciones.observaciones 
									  FROM integrantes
									  LEFT JOIN asistencias_justificaciones ON (integrantes.cedula=asistencias_justificaciones.cedula) 
									  WHERE ((integrantes.status='1') and (integrantes.cedula not in 
									       (SELECT asistencias_entrada_salida.cedula 
										    FROM asistencias_entrada_salida 
											WHERE (asistencias_entrada_salida.fecha = '$fecha_reporte') 
											GROUP BY asistencias_entrada_salida.cedula))) 
									  ORDER BY integrantes.nombres, integrantes.apellidos",$link) or die(mysql_error());
*/


// Ahora se realiza la consulta de los inasistentes.

 $consulta_inasistencias=mysql_query("SELECT integrantes.cedula as cedula_integrantes, integrantes.nombres, integrantes.apellidos  
									  FROM integrantes 
									  WHERE ((integrantes.status = '1') and (integrantes.cedula not in 
									       (SELECT asistencias_entrada_salida.cedula 
										    FROM asistencias_entrada_salida 
											WHERE (asistencias_entrada_salida.fecha = '$fecha_reporte') 
											GROUP BY asistencias_entrada_salida.cedula))) 
									  ORDER BY integrantes.nombres, integrantes.apellidos",$link) or die(mysql_error());
 
// $resultado=mysql_fetch_array($consulta);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reporte de Asistencia Diaria</title>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
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
</head>

<body>
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
       while($resultado=mysql_fetch_array($consulta)) { ?>   
          <tr>
            <td class="datos_formularios"><div align="center"><?php echo $resultado['cedula_integrantes']; ?></div></td>
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
							  ($resultado['entrada'] <= $resultado_just[$cuenta_just]['hora_hasta'])) 
								{ 
								  $just_encontrada = true; 
								}
						 $cuenta_just++;
						}
						if ($just_encontrada == false) { echo "<span class='Estilo1'>";
						} // del encontrada false )osea, si la justificación no concuerda, se coloca en rojo
						else
						{
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


             <?php if (strtotime($resultado['salida'])< strtotime($resultado_horario['hora_salida'])){?>            
            <span class="Estilo1">
            <?php }?>
            
            <?php echo date("h:i:s a",strtotime($resultado['salida'])); ?> 
			<?php if (strtotime($resultado['salida'])< strtotime($resultado_horario['hora_salida'])){?>
            
            </span>
            <?php }?>
            </div></td>
          </tr> 
  <?php }?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
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
    <td class="encabezado_formularios">Observación</td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
       while($resultado_inasistencias=mysql_fetch_array($consulta_inasistencias)) { ?>
  <tr>
    <td class="datos_formularios"><div align="center"><?php echo $resultado_inasistencias['cedula_integrantes']; ?></div></td>
    <td class="datos_formularios"><div align="left"> &nbsp;<?php echo $resultado_inasistencias['nombres']." ".
			                                                             $resultado_inasistencias['apellidos']; ?></div></td>
    <td class="datos_formularios"><div align="center"><?php  $cuenta_ina=0; $colocado=false;
															 while (($colocado == false) && ($cuenta_ina < count($resultado_just)-1)) { 
															   if ($resultado_inasistencias['cedula_integrantes'] == 
															       $resultado_just[$cuenta_ina]['cedula_just']) 
																   {
																     echo $resultado_just[$cuenta_ina]['observaciones'];
																	 $colocado=true;
																   }
															   else
															   {
															    echo " I N A S I S T E N T E ";
															    $colocado=true;
															   }
															  $cuenta_ina++; } // del while
															   ?></div></td>
  </tr>
  <?php }?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table><br />
<br />
<table width="661" border="1" align="center" cellpadding="0" cellspacing="0">
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
            <td width="88" class="encabezado_formularios"><?php echo $resultado_just[$cuenta_just]['cedula_just']; ?></td>
            <td width="327" class="encabezado_formularios"><?php echo $resultado_just[$cuenta_just]['nombres']." ".
			$resultado_just[$cuenta_just]['apellidos']; ?></td>
            <td width="238" class="encabezado_formularios"></td>
  </tr>
          <tr>
            <td colspan="3" class="datos_formularios"><div align="justify"><?php echo "<strong>N&uacute;mero: ".$resultado_just[$cuenta_just]['id'].", Desde el: ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_desde'])." a las ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_desde'])).", hasta el ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_hasta'])." a las ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_hasta'])).", </strong> Tipo de Permiso: ".$arreglo_tipo[$resultado_just[$cuenta_just]['codigo_tipo_justificacion']].", Tipo de Falta: ".$arreglo_tipo_falta[$resultado_just[$cuenta_just]['codigo_tipo_falta']].", Motivo: ".$resultado_just[$cuenta_just]['observaciones']; ?></div></td>
          </tr>
  <?php 
       	 } // si cedi = cedula
	 else
	   {  // si es el mismo funcionario, pero con otro permiso, simplemente se añade otra descripcion con otro color
	     $contador_color++;
	?>
          <tr bgcolor="<?php echo $color[$contador_color%2]; ?>">
          
            <td colspan="3" class="datos_formularios"><div align="justify"><?php echo "<strong>N&uacute;mero: ".$resultado_just[$cuenta_just]['id'].", Desde el: ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_desde'])." a las ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_desde'])).", hasta el ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_hasta'])." a las ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_hasta'])).", </strong> Tipo de Permiso: ".$arreglo_tipo[$resultado_just[$cuenta_just]['codigo_tipo_justificacion']].", Tipo de Falta: ".$arreglo_tipo_falta[$resultado_just[$cuenta_just]['codigo_tipo_falta']].", Motivo: ".$resultado_just[$cuenta_just]['observaciones']; ?></div></td>
          </tr>	     
		<?php 	
	 
	   }
  $cuenta_just++;
  }?>
</table>

<p></p>
</body>
</html>
