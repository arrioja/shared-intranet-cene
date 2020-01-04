<?php 
 require("../../libs/utilidades.php");
 require("../../db/conexion.php");
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
	background-image: url(../imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->
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
  if (isset($cedula)) // Si cédula existe entonces es solo un empleado y se incluye un solo registro
  {     
	 mysql_query("BEGIN");  //inicio la transaccion
	 if ($insertar=mysql_query("insert into asistencias.justificaciones (cedula, fecha_desde, hora_desde, fecha_hasta, 
	 hora_hasta, codigo_tipo_justificacion, codigo_tipo_falta, observaciones, descuenta_ticket, tipo_id_doc, estatus) values ('$cedula', 
	 '$fecha_desde', '$hora_desde', '$fecha_hasta', '$hora_hasta', '$tipo', '$falta', '$observaciones', '$descuento', 'RH', '1')"
	 ,$link) or die(mysql_error()))
	 {
	   $id_resultante=mysql_insert_id($link);
	   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
	  ?>       
        <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
            <tr class="encabezado_formularios">
              <td width="500">Justificaci&oacute;n insertada correctamente</td>
            </tr>
            <tr>
              <td class="datos_formularios"><div align="justify">La justificaci&oacute;n se ha guardado exitosamente 
              en la base de datos con el n&uacute;mero:<strong> <?php echo $id_resultante ?></strong>.</div></td>
            </tr>
            <tr>
              <td class="datos_formularios"><div align="center">
                <input type="button" name="Volver" id="Volver" value="Volver" 
                onclick="javascript: location.href='../incluir_justificacion_individual_cedula.php'" />
              </div></td>
            </tr>
        </table>	   
	
	<?php
	 }
	  else
	 {
	   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
	   echo " Error gruardando los datos - ";
	   echo mysql_error();
	   echo " ----- Antes de cerrar este mensaje de error, por favor contacte al soporte t&eacute;cnico de la Direcci&oacute;n 
	   de Sistemas para tomen las previsiones y lo corrijan oportunamente"; 
	  };
	 
} else
{ // si cedula no existe, quiere decir que existe "cedulas" y son varios, asi que se hace una inclusion por cada valor del array
  $ocurrio_error='NO'; // inicializacion de la variable para saber si todo ocurrio bien
 
 ?>
 	  <link href="../../css/formularios.css" rel="stylesheet" type="text/css" />	
      <table width="400" border="1" align="center" cellpadding="0" cellspacing="0">
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
	 if ($insertar=mysql_query("insert into asistencias.justificaciones (cedula, fecha_desde, hora_desde, fecha_hasta, 
	 hora_hasta, codigo_tipo_justificacion, codigo_tipo_falta, observaciones, descuenta_ticket, tipo_id_doc, estatus) values ('$una_cedula', 
	 '$fecha_desde', '$hora_desde', '$fecha_hasta', '$hora_hasta', '$tipo', '$falta', '$observaciones', '$descuento', 'RH', '1')"
	 ,$link) or die(mysql_error()))
	 {	   
	   $id_resultante=mysql_insert_id($link);
	   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
     ?>
     
        <tr>
          <td class="datos_formularios"><div align="center"><?php echo $una_cedula ?></div></td>
          <td class="datos_formularios"><div align="center">OK - Guardado con el Nro: 
          <strong><?php echo $id_resultante ?></strong></div></td>
        </tr>   
	   
	  <?php 
	 //  header ("Location: ../incluir_justificacion_individual_cedula.php", true); 
	 }
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
	  };

};      
      
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
    <!-- #BeginDate format:fcSw1a -->Thursday, 21 August, 2008 12:13 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>  