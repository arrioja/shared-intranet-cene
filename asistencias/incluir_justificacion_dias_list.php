<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Es un complemento de AJAX para incluir_justificacion.php, cuando se presiona el boton añadir, aparece este listado con las 
  						justificaciones que se hayan diseñado para luego guardarlas.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 include("../db/conexion.php");
 $link=conectarse("asistencias");
 include("../libs/utilidades.php");
 $accion=$_GET['accion'];
 $aleat=$_GET['aleat'];
 if ($accion == 'IN') 
   {
 	 $fdesde=cambiaf_a_mysql($_GET['fdesde']);
 	 $fhasta=cambiaf_a_mysql($_GET['fhasta']);
 	 $hdesde=date("G:i",strtotime($_GET['hdesde']));
 	 $hhasta=date("G:i",strtotime($_GET['hhasta']));
 	 $falta=$_GET['falta'];
	 $tipo=$_GET['tipo'];
 	 if ($_GET['lu'] == 'true') {$lu='1';} else {$lu='0';}
 	 if ($_GET['ma'] == 'true') {$ma='1';} else {$ma='0';}
 	 if ($_GET['mi'] == 'true') {$mi='1';} else {$mi='0';}
 	 if ($_GET['ju'] == 'true') {$ju='1';} else {$ju='0';}
 	 if ($_GET['vi'] == 'true') {$vi='1';} else {$vi='0';}
 	 $ticket=$_GET['ticket'];	
	 $observaciones=$_GET['obs'];
//Para depuración:	 echo $aleat." ".$fdesde." ".$fhasta." ".$hdesde." ".$hhasta." ".$falta." ".$lu." ".$ma." ".$mi." ".$ju." ".$vi." ".$ticket;
	 
	 $insertar=mysql_query("insert into asistencias.justificaciones_dias_tmp(codigo_just,fecha_desde,hora_desde,fecha_hasta,hora_hasta,codigo_tipo_falta,codigo_tipo_justificacion,descuenta_ticket,lun,mar,mie,jue,vie,observaciones)  values ('$aleat','$fdesde','$hdesde','$fhasta','$hhasta','$falta','$tipo','$ticket','$lu','$ma','$mi','$ju','$vi','$observaciones')",$link) or die(mysql_error()); 
   }
   
 if ($accion == 'EL') 
   { // si la acción es EL, se eliminan los datos que correspondan al id que viene del url
     $id=$_GET['id'];
     $eliminar=mysql_query("delete from asistencias.justificaciones_dias_tmp where id='$id'",$link) or die(mysql_error()); 
   }

 
 $consulta_vac=mysql_query("select * from asistencias.justificaciones_dias_tmp where (codigo_just = '$aleat')",$link) or die(mysql_error()); 
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<?php if (mysql_num_rows($consulta_vac) == 0) {
     echo '<p class="style1">Incluya los datos de la fecha, hora y tipo de permiso</p>';}
  else
  {?>
<table width="647" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="79" class="encabezado_formularios">Desde</td>
    <td width="79" class="encabezado_formularios">Hasta</td>
    <td width="89" class="encabezado_formularios">Hora Desde</td>
    <td width="89" class="encabezado_formularios">Hora Hasta</td>
    <td width="19" class="encabezado_formularios">L</td>
    <td width="19" class="encabezado_formularios">M</td>
    <td width="19" class="encabezado_formularios">M</td>
    <td width="19" class="encabezado_formularios">J</td>
    <td width="19" class="encabezado_formularios">V</td>
    <td width="51" class="encabezado_formularios">Falta</td>
    <td width="106" class="encabezado_formularios">Desc Tickt</td>
    <td width="33" class="encabezado_formularios">Elim</td>
  </tr>
  
  <?php  
  
    while($resultado=mysql_fetch_array($consulta_vac)) { ?>
  <tr>
    <td width="79" class="datos_formularios"><div align="center"><?php echo date("d/m/Y",strtotime($resultado['fecha_desde']));?></div></td>
    <td class="datos_formularios"><div align="center"><?php echo date("d/m/Y",strtotime($resultado['fecha_hasta']));?></div></td>
    <td class="datos_formularios"><div align="center"> <?php echo date("h:i:s a",strtotime($resultado['hora_desde'])); ?> </div></td>
    <td class="datos_formularios"><div align="center"> <?php echo date("h:i:s a",strtotime($resultado['hora_hasta'])); ?> </div></td>
    <td class="datos_formularios"><div align="center"> <?php if ($resultado['lun'] == '1') {echo '<img src="../imgs/led_verde_p.png" alt="Si" width="24" height="24" longdesc="Si" />';} else {echo '<img src="../imgs/led_rojo_p.png" alt="No" width="24" height="24" longdesc="No" />';} ?> </div></td>
    <td class="datos_formularios"><div align="center"> <?php if ($resultado['mar'] == '1') {echo '<img src="../imgs/led_verde_p.png" alt="Si" width="24" height="24" longdesc="Si" />';} else {echo '<img src="../imgs/led_rojo_p.png" alt="No" width="24" height="24" longdesc="No" />';} ?> </div></td>
    <td class="datos_formularios"><div align="center"> <?php if ($resultado['mie'] == '1') {echo '<img src="../imgs/led_verde_p.png" alt="Si" width="24" height="24" longdesc="Si" />';} else {echo '<img src="../imgs/led_rojo_p.png" alt="No" width="24" height="24" longdesc="No" />';} ?> </div></td>
    <td class="datos_formularios"><div align="center"> <?php if ($resultado['jue'] == '1') {echo '<img src="../imgs/led_verde_p.png" alt="Si" width="24" height="24" longdesc="Si" />';} else {echo '<img src="../imgs/led_rojo_p.png" alt="No" width="24" height="24" longdesc="No" />';} ?> </div></td>
    <td class="datos_formularios"><div align="center"> <?php if ($resultado['vie'] == '1') {echo '<img src="../imgs/led_verde_p.png" alt="Si" width="24" height="24" longdesc="Si" />';} else {echo '<img src="../imgs/led_rojo_p.png" alt="No" width="24" height="24" longdesc="No" />';} ?> </div></td>
    <td class="datos_formularios"><div align="center"> <?php echo $resultado['codigo_tipo_falta']; ?> </div></td>
    <td class="datos_formularios"><div align="center"> <?php echo $resultado['descuenta_ticket']; ?> </div></td>
    <td class="datos_formularios"><div align="center"><img src="../imgs/rechazar.png" width="24" height="24" onclick="Elimina('incluir_justificacion_dias_list.php','EL',<?php echo $resultado['id']; ?>)" /></div></td>
  </tr>

    <?php } // del ciclo para llenar los datos?>
</table>
<?php } // del if de la comprobacion de que la consulta haya arrojado datos?>
</body>

</html>
