<?php 
 session_start();
 include("../db/conexion.php");
 $link=conectarse("asistencias"); 
 $link=conectarse("organizacion");
 $link=conectarse("nomina");
 $consulta=mysql_query("select p.id, p.cedula, p.nombres, p.apellidos, n.status, s.status_asistencia 
 						from organizacion.personas as p, nomina.integrantes as n, asistencias.personas_status_asistencias as s
						where ((p.cedula=n.cedula) and (p.cedula=s.cedula) and (s.status_asistencia='1')) order by p.nombres",$link) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Incluir Justificaci&oacute;n</title>
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

<script>  // Función para chequear y deschequear todos los elementos de la pantalla para que no tenga que ir uno por uno
function Chequea_Todos(chkbox){
chkbox = document.forms["form1"].elements[chkbox];
for(var n=0;n<chkbox.length;n++){
	chkbox[n].checked = document.forms.form1.todos.checked;
	}
}
</script>


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
<form id="form1" name="form1" method="post" action="incluir_justificacion.php">
  <br />
  <table width="547" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" bgcolor="#E0DFE3"><div align="center" class="encabezado_formularios">Justificaci&oacute;n grupal - Seleccione los funcionarios:</div></td>
    </tr>
    <tr>
      <td width="43" bgcolor="#E0DFE3" class="encabezado_formularios">Selec</td>
      <td width="92" class="encabezado_formularios">C&eacute;dula</td>
      <td width="404" class="encabezado_formularios">Nombres y Apellidos</td>
    </tr>
    
      <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($consulta)) { // inicia el ciclo que dibuja la linea del listado ?> 
    <tr>
      <td>
        <div align="center">
          <input name="sel[]" type="checkbox" id="" value="<?php echo $resultado['cedula']; ?>" />
        </div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['cedula']; ?></div></td>
      <td class="datos_formularios">&nbsp;&nbsp;<?php echo $resultado['nombres'].' '.$resultado['apellidos']; ?></td>
      <?php  }   //   Para cerrar el ciclo que dibuja la linea del listado?> 
    </tr>
    <tr>
      <td colspan="2"><div align="center">
  <input type="checkbox" name="todos" value="" id="todos" onclick="Chequea_Todos('sel[]');" />
  &nbsp;TODOS</div></td>
      <td class="datos_formularios"><input name="cant" type="hidden" id="cant" value="varios" /></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td class="datos_formularios"><input type="submit" name="consultar" id="consultar" value="Seleccionar" />
        &nbsp;&nbsp;&nbsp;
        <input type="reset" name="limpiar" id="limpiar" value="Limpiar Formulario" />&nbsp;&nbsp;&nbsp; <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" /></td>
    </tr>
    </table>
</form>

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
