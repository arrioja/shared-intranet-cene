<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Intranet CENE</title>
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

<?php 
	include "../db/conexion.php";
	include "../libs/utilidades.php";
   $link=conectarse("gestion");

$cod=$_GET['seleccionado'];
$consulta="select a.id, a.nombre, a.fecha_inicio, a.duracion, a.cod_plan_operativo, po.codigo, po.nombre, po.cod_direccion, d.codigo, d.nombre_completo, o.codigo, o.nombre from gestion.gestion_actividades a inner join gestion.gestion_planes_operativos po on (a.cod_plan_operativo=po.codigo) inner join organizacion.direcciones d on (po.cod_direccion=d.codigo) inner join organizacion.organizaciones o on (d.codigo_organizacion=o.codigo) where a.id='$cod'";
$result=mysql_query($consulta,$link);
$row=mysql_fetch_array($result);
?> 
<!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="../libs/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <!-- main calendar program -->
  <script type="text/javascript" src="../libs/calendar/calendar.js"></script>
  <!-- language for the calendar -->
  <script type="text/javascript" src="../libs/calendar/lang/calendar-es.js"></script>
  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="../libs/calendar/calendar-setup.js"></script>






<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
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
<form id="f1" name="form1" method="post" action="guarda_modificacion_actividades.php?seleccionado=<?php echo $cod?>">
  <p>&nbsp;</p>
  <table width="658" height="249" border="1" align="center" cellpadding="2" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="encabezado_formularios">
      <td height="25" colspan="3"><div align="center" class="style3"><strong>Registro de Actividades</strong></div></td>
    </tr>
    <tr>
      <td width="157" height="25" class="titulos_formularios"><strong>Organizaci&oacute;n</strong></td>
      <td width="487" class="datos_formularios"><label>
        <input name="organizacion" type="text" disabled="disabled" id="organizacion" value="<?php echo $row[11]?>" size="70" />
      </label></td>
    </tr>
    <tr>
      <td height="25" align="center" class="titulos_formularios" id=> <strong>Direcci&oacute;n</strong></td>
      <td align="" class="datos_formularios" id="cod"><label>
        <input name="direccion" type="text" disabled="disabled" id="direccion" value="<?php echo $row[9]?>" size="70" />
      </label></td>
    </tr>
    <tr>
      <td height="25" align="center" class="titulos_formularios" id=> <strong>Plan Operativo</strong></td>
      <td align="" class="datos_formularios" id="plan_operativo"><label>
        <input name="plan" type="text"  disabled="disabled" id="plan" value="<?php echo $row[6]?>" size="70" />
      </label></td>
    </tr>
    <tr>
      <td height="25" class="titulos_formularios"><strong>Nombre</strong></td>
      <td colspan="2" class="datos_formularios"><label><span id="sprytextfield1">
            <input name="nombre" type="text" id="nombre" size="60" value="<?php echo $row[1]?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></label></td>
    </tr>
    <tr>
      <td height="32" class="titulos_formularios"><strong>Fecha de Inicio</strong></td>
      <td class="datos_formularios"> 
     <input type="text" name="fecha_inicio" readonly="readonly" id="fecha_inicio" value="<?php echo cambiaf_a_normal($row[2])?>"/>
        <img src="../imgs/img.gif" alt="cal" name="f_trigger_c" width="20" height="20" border="0" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background='blue'" /></td>
    </tr>
    <tr>
      <td height="28" class="titulos_formularios"><strong>Duraci&oacute;n (D&iacute;as)</strong></td>
      <td class="datos_formularios" ><span id="sprytextfield4">
      <label>
      <input type="text" name="duracion" id="duracion"  value="<?php echo $row[3]?>" />
      </label>
      <span class="textfieldRequiredMsg">Ingrese Duración</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></td>
    </tr>
    <tr>
      <td height="31" colspan="2" >
        <div align="center">
          <input type="submit" name="insertar" id="insertar" value="Guardar" />
          <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='admin_actividades.php'" />
        </div></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["blur", "change"]});
//-->
</script>
<script type="text/javascript">
Calendar.setup({
        inputField     :    "fecha_inicio",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 18 September, 2008 10:22 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
