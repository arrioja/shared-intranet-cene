<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra el reporte de entrada y salida intrahorario del funcionario o funcionaria que se haya seleccionado.
  		Modificado el: 	20/11/2008 por Pedro E. Arrioja M. - Creación
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 include("../db/conexion.php");
 include("../libs/utilidades.php");
 include("../libs/libchart/classes/libchart.php");
 $fecha_reporte=cambiaf_a_mysql($_GET['fecha']);
 //$fecha_mysql = $_GET['fecha'];
 $dir=$_GET['dir'];
 
 // para ingresar marca de auditoria.   
 include("../db/inserta_rastreo.php");

// Para limpiar los valores de las variables que se mostraran en los graficos de los indicadores.
 $link=conectarse("asistencias"); 
 
 if ($dir == 1) // quiere decir que se selecciono a todos los empleados
   {
     // Consulta de registro de entrada y salida para todos
     $consulta=mysql_query("SELECT (p.cedula) as cedula_integrantes, p.nombres, p.apellidos, 
                                    e.fecha, e.hora  
		  			        FROM asistencias.entrada_salida as e, organizacion.personas as p
						    WHERE ((p.cedula = e.cedula) and (e.fecha = '$fecha_reporte'))
						    ORDER BY e.hora",$link) or die(mysql_error());	
							
	 // Consulta de justificaciones para todos.						
     $consulta_just=mysql_query("SELECT (p.cedula) as cedula_just, p.nombres, p.apellidos, j.*, jp.*, jd.*
					    	     FROM asistencias.justificaciones as j, asistencias.justificaciones_dias as jd, 
						              asistencias.justificaciones_personas as jp, organizacion.personas as p
						         WHERE ((p.cedula = jp.cedula) and 
						                (p.fecha_ingreso <= '$fecha_reporte') and 
						                (jd.fecha_desde <= '$fecha_reporte') and
							            (jd.fecha_hasta >= '$fecha_reporte') and 
							            (j.estatus='1') and (j.codigo=jd.codigo_just) and (j.codigo=jp.codigo_just)) 
						         ORDER BY jp.cedula",$link) or die(mysql_error()); 							
							

     $descripcion='Consulta Entrada/Salida Diaria del '.$_GET['fecha'];
   }
 else
   {
     $consulta=mysql_query("SELECT (p.cedula) as cedula_integrantes, p.nombres, p.apellidos, 
                                    e.cedula, e.fecha, e.hora  
		  			        FROM asistencias.entrada_salida as e, organizacion.personas as p
						    WHERE ((p.cedula = e.cedula) and (e.fecha = '$fecha_reporte') and
							       (p.cedula = '$dir'))
						    ORDER BY e.hora",$link) or die(mysql_error());
							
							
     $consulta_just=mysql_query("SELECT (p.cedula) as cedula_just, p.nombres, p.apellidos, j.*, jp.*, jd.*
					    	     FROM asistencias.justificaciones as j, asistencias.justificaciones_dias as jd, 
						              asistencias.justificaciones_personas as jp, organizacion.personas as p
						         WHERE ((p.cedula = jp.cedula) and 
								        (p.cedula = '$dir') and
						                (p.fecha_ingreso <= '$fecha_reporte') and 
						                (jd.fecha_desde <= '$fecha_reporte') and
							            (jd.fecha_hasta >= '$fecha_reporte') and 
							            (j.estatus='1') and (j.codigo=jd.codigo_just) and (j.codigo=jp.codigo_just)) 
						         ORDER BY jp.cedula",$link) or die(mysql_error()); 	
													
     $descripcion='Consulta Entrada/Salida Diaria del '.$_GET['fecha'].' de C.I:'.$dir;	   
   }
	
 $ip = $REMOTE_ADDR; 
 inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'C',$descripcion,$ip);

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
 
// $resultado=mysql_fetch_array($consulta);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Expires" content="0">
<meta http-equiv="Cache-Control" Cache-Control: max-age=1, mustrevalidate>
<meta http-equiv="Pragma" content="no-cache">

<title>Reporte de asistencia diaria</title>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
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
      <table width="661" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <div align="right">
              <input type="button" name="volver" id="volver" value="Consultar otro dia" onclick="javascript: location.href='consulta_intrahorario.php'" />
        </div></td></tr>
      </table>
      <table width="663" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3" class="encabezado_formularios">Reporte de Asistencia</td>
    </tr>
        <tr>
          <td colspan="3" class="encabezado_formularios">Fecha Seleccionada: <?php echo $_POST['fecha'] ?></td>
    </tr>
        <tr>
          <td width="88" class="encabezado_formularios">C&eacute;dula</td>
      <td width="328" class="encabezado_formularios">Nombre</td>
      <td class="encabezado_formularios">Hora de Marcado</td>
      </tr>
        <?php //cada vez que escribo el fetch array el va bajando una linea en la tabla
       $color=array("#FFFFFF","#CCFFFF"); // para darle colores alternos a las lineas que muestro
	   $contador=0; // este contador permitira darle la alternabilidad a los colores
       while($resultado=mysql_fetch_array($consulta)) { ?>   
        <tr bgcolor="<?php echo $color[$contador%2]; ?>">
          <td class="datos_formularios"><div align="center"><?php $ind_asistentes++; echo $resultado['cedula_integrantes']; ?></div></td>
          <td class="datos_formularios"><div align="left"> &nbsp;<?php echo $resultado['nombres']." ".
			                                                             $resultado['apellidos']; ?></div></td>
          <td class="datos_formularios"><div align="center"><?php echo date("h:i:s a",strtotime($resultado['hora'])); ?> </div>            <div align="center"></div></td>
        </tr> 
        <?php $contador++; }?>
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
              <input type="button" name="volver" id="volver" value="Consultar otro dia" onclick="javascript: location.href='consulta_intrahorario.php'" />
        </div></td></tr>
      </table>
      <br />
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
	   
	   if (es_dia($_GET['fecha'],$resultado_just[$cuenta_just]['lun'],$resultado_just[$cuenta_just]['mar'],$resultado_just[$cuenta_just]['mie'],
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
          
          <td colspan="2" class="datos_formularios"><div align="justify"><?php echo "<strong>C&oacute;digo: ".$resultado_just[$cuenta_just]['codigo'].", Desde el: ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_desde'])." hasta el ".cambiaf_a_normal($resultado_just[$cuenta_just]['fecha_hasta']).", de ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_desde']))." a ".date("h:i:s a",strtotime($resultado_just[$cuenta_just]['hora_hasta'])).", </strong> Tipo: ".$arreglo_tipo[$resultado_just[$cuenta_just]['codigo_tipo_justificacion']].", Falta: ".$arreglo_tipo_falta[$resultado_just[$cuenta_just]['codigo_tipo_falta']].", Motivo: ".$resultado_just[$cuenta_just]['observaciones']; ?></div></td>
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
              <input type="button" name="volver" id="volver" value="Consultar otro dia" onclick="javascript: location.href='consulta_intrahorario.php'" />
        </div></td></tr>
      </table>
      <br />
      <br />  
</body>

</html>

