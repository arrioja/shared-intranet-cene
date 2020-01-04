<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Inserta en la base de datos las nuevas vacaciones que han sido calculadas de acuerdo a lo establecido en la Ley:
  						15 días para el primer año de servicio y luego un día más por cada año de servicio adicional.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
include("../../db/conexion.php");
include("../../libs/utilidades.php");
session_start();
include("../../db/inserta_rastreo.php");
   
$link=conectarse("asistencias");

 
$consulta_integrantes=mysql_query("select p.cedula, p.nombres, p.apellidos, p.fecha_ingreso, i.*  
									from organizacion.personas as p, nomina.integrantes as i 
									where (i.status='1') and (i.tipo_nomina<>'PENSIONADOS') and
										  (i.cedula = p.cedula) and 
										  (i.tipo_nomina<>'JUBILADOS') order by p.nombres, p.apellidos",$link) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>C&aacute;lculo de d&iacute;as de Vacaciones</title>
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
  <style type="text/css">
<!--
.Estilo1 {color: #FF0000}
.Estilo2 {color: #009900}
-->
  </style>
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
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" --><br />
  <table width="730" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" class="encabezado_formularios">C&aacute;lculo de d&iacute;as de vacaciones</td>
    </tr>
    <tr>
      <td width="65" class="encabezado_formularios">C&eacute;dula</td>
      <td width="326" class="encabezado_formularios">Nombres</td>
      <td width="309" class="encabezado_formularios">Status</td>
    </tr>
<?php
while($resultado_integrantes=mysql_fetch_array($consulta_integrantes)) 
{ // recorro cada registro del personal activo para calcular vacaciones 
  $fecha_ingreso=cambiaf_a_normal($resultado_integrantes['fecha_ingreso']);
  // separo para tener los datos de dia y mes para fecha de calculo
  list($dia_ingreso,$mes_ingreso,$ano_ingreso) = explode("/",$fecha_ingreso); 
  //$ano_actual=date("Y"); esto aplica si no se usa el listbox de la ventana que llama a esta
  $ano_actual=$_POST['ano']; // esto aplica para seleccionar cual es el año que se quiere procesar
  $periodo=($ano_actual-1)."-".$ano_actual;
  $cedula=$resultado_integrantes['cedula'];
  
  // Lo que hago ahora es ver si ya existe registro del calculo de vacaciones para ese empleado en el periodo que se calcula y no se hace nada, pero se podría lograr que actualice el registro, habria que ver la conveniencia de esto.
  $consulta_periodo=mysql_query("select * from asistencias.vacaciones as v where (v.cedula='$cedula' and v.periodo='$periodo')",$link) or die(mysql_error()); 
  
  if (mysql_num_rows($consulta_periodo) > 0 )
  {
  //////////////////////Mensaje de registro obviado
  ?>

    <tr>
      <td class="datos_formularios"><div align="right"><?php echo $cedula?></div></td>
      <td class="datos_formularios">&nbsp;<?php echo $resultado_integrantes['nombres']." ".
      $resultado_integrantes['apellidos'] ?></td>
      <td class="datos_formularios Estilo1"><strong>Período <?php echo $periodo ?> obviado</strong>, ya existen datos.</td>
    </tr>
                    
<?php

  }
  else
  {
	  
	  $fecha_calculo=$dia_ingreso."/".$mes_ingreso."/".$ano_actual;
	 // echo $dia_ingreso." - ".$mes_ingreso." - ".$ano_actual;
	  $dias_servicio=intval(dias_entre_fechas($fecha_ingreso,$fecha_calculo));
	  $anos_servicio=intval($dias_servicio/365);
	
	  $antiguedad_otro=$resultado_integrantes['anos_servicio'];
	 // se calculan los dias de vacaciones de la siguiente manera (segun la LOT)
	 // un dia por cada año de servicio comenzando por quince dias el primer año hasta máximo treinta días.
	  $dias_calculados=(intval($dias_servicio/365)+$resultado_integrantes['anos_servicio']+14);
	  if ($dias_calculados > 30) { $dias_calculados=30; } 
	  $disponible_desde=cambiaf_a_mysql($fecha_calculo);
	 // se insertan los valores en la tabla vacaciones
	  if ($insertar=mysql_query("insert into asistencias.vacaciones(cedula,anos_antiguedad,anos_antiguedad_otro,dias,disfrutados,pendientes,periodo,disponible_desde) values ('$cedula','$anos_servicio','$antiguedad_otro','$dias_calculados','0','$dias_calculados','$periodo','$disponible_desde')",$link))
		  {
		  
		     // para ingresar marca de auditoria.   
		    $descripcion='Insertados '.$dias_calculados.' dias disponibles de vacaci&oacute;n del periodo '.$periodo.' para '.$resultado_integrantes['nombres'].' '.$resultado_integrantes['apellidos'].', C.I.: '.$cedula;
		    $ip = $REMOTE_ADDR; 
		    inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
		  
			mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
			?>
            
                <tr>
                  <td class="datos_formularios"><div align="right"><?php echo $cedula?></div></td>
                  <td class="datos_formularios">&nbsp;<?php echo $resultado_integrantes['nombres']." ".
                  $resultado_integrantes['apellidos'] ?></td>
                  <td class="datos_formularios"><span class="Estilo2">Per&iacute;odo <?php echo $periodo; ?>, 
                  días: <?php echo $dias_calculados;?>, status: <strong>OK..</strong></span></td>
                </tr>    

   	                <?php
		  }
		  else
		  {	  
		  
		  		     // para ingresar marca de auditoria.   
		    $descripcion='Error insertando dias disponibles de vacaci&oacute;n del periodo '.$periodo.' para '.$resultado_integrantes['nombres'].' '.$resultado_integrantes['apellidos'].', C.I.: '.$cedula;
		    $ip = $REMOTE_ADDR; 
		    inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'R',$descripcion,$ip);
		  
		  
		  ?>          

                <tr>
                  <td class="datos_formularios"><div align="right"><?php echo $cedula?></div></td>
                  <td class="datos_formularios">&nbsp;<?php echo $resultado_integrantes['nombres']." ".
                  $resultado_integrantes['apellidos'] ?></td>
                  <td class="datos_formularios Estilo1"><strong>Error</strong> en BD:<strong>  <?php echo mysql_error($link) ?>.</strong></td>
                </tr>         
                              <tr>
                                <td colspan="3" class="datos_formularios">&nbsp;</td>
                              </tr>
                              <tr>
                      <td colspan="3" class="datos_formularios"><div align="center"><a href="../listado_vacaciones_disponibles_todos.php">Listado de Vacaciones</a></div></td>
                    </tr>
	      <?php
		  
			mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada	  
		  }

	} // del if del record count de la consulta de los periodos
} // del while de la tabla de integrantes

?>
  </table>  
  <!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Tuesday, 13 January, 2009 10:56 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>