<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Se muestra un listado de funcionarios con un led verde si esta sujeto al control de asistencias y rojo
  						si no esta sujeto al mismo, este modulo es pespecialmente útil si tenemos por ejemplo funcionarios
						que deben ser usuarios del sistema, sin parte de la nómina pero no se les chequea asistencia, por ejemplo: El 
						Contralor y Contralora del Estado
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creación
						04/09/2008 por Pedro E. Arrioja M. - Se añade comprobación de acceso al módulo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 $link=conectarse("asistencias"); 

if (isset($_GET['id']) == true) 
{ // si el id viene en el url, entonces el usuario ha seleccionado a un usuario para activar/desactivar.
  $id=$_GET['id'];
  $activo=$_GET['activo'];  
  $actualiza=mysql_query("update asistencias.personas_status_asistencias set status_asistencia='$activo' where id='$id'",$link) or die(mysql_error());
  header ("Location: estatus_asistencia.php", true); 
}
 
 $consulta=mysql_query("select u.id, u.status_asistencia, p.cedula, p.nombres, p.apellidos  
 						FROM asistencias.personas_status_asistencias as u, organizacion.personas as p
						WHERE (u.cedula=p.cedula)
						ORDER BY p.nombres, p.apellidos",$link) or die(mysql_error());
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Personas sujetas al control de asistencias</title>
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

<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
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
      <table width="749" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="8" class="encabezado_formularios">Listado de Personas sujetas al control de asistencias</td>
  </tr>
  <tr>
    <td width="134" class="encabezado_formularios">C&eacute;dula</td>
    <td width="528" class="encabezado_formularios">Nombres y Apellidos</td>
    <td width="79" colspan="4" class="encabezado_formularios">Acci&oacute;n</td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($consulta)) { ?> 
  <tr>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['cedula']; ?></div></td>
    <td class="datos_formularios">&nbsp;<?php echo $resultado['nombres']." ".$resultado['apellidos']; ?></td>
    <td valign="top" class="datos_formularios"><div align="center">
      <?php if ($resultado['status_asistencia'] == "1") { echo '<a href="estatus_asistencia.php?id='.$resultado['id'].'&activo=0"><img src="../imgs/led_verde_p.png" alt="Activo (Click para desactivar)" width="24" height="24" border="0" />';} else {echo '<a href="estatus_asistencia.php?id='.$resultado['id'].'&activo=1"><img src="../imgs/led_rojo_p.png" alt="Inactivo (Click para activar)" width="24" height="24" border="0" />';}?>
    </div></td>
  </tr>
  <?php }?> 
     <tr>
       <td colspan="8" class="datos_formularios"> <div align="center">Verde = Sujeto a control de asistencias, Rojo = NO sujeto al control de asistencias</div></td>
     </tr>
     <tr>
    <td colspan="8" class="datos_formularios"><div align="center">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" />
    </div></td>
  </tr>
</table>
      <br />
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
