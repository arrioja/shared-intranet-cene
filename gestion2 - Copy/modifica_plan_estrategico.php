<?php 
/*
* Este archivo realiza el llamado al modulo para la inserción de los planes estratégicos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/
session_start();
?>

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



<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" -->
      <?php 
 include ("../db/conexion.php");
 $link=conectarse("gestion");

$cod=$_GET['seleccionado'];
$consulta="select pe.codigo, pe.nombre, pe.aqo_inicio, pe.aqo_fin, pe.codigo_organizacion, o.codigo, o.nombre from gestion_planes_estrategicos pe inner join organizacion.organizaciones o on (pe.codigo_organizacion=o.codigo) where pe.codigo='$cod'";
$result=mysql_query($consulta,$link);
$row=mysql_fetch_array($result);

?>
      <br />
    <form id="form1" name="form1" method="post" action="guarda_modificacion.php">

  <table width="604" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2"><div align="center" class="style2"><strong>Registro de Planes Estrat&eacute;gicos</strong> <strong>Organizaci&oacute;n</strong> </div></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Organizaci&oacute;n:</strong></td>
      <td>
        <input name="organizacion" type="text" disabled="disabled" id="organizacion" value="<?php echo $row[6]?>" size="60" />      </td>
    </tr>
    <tr>
      <td width="137" class="titulos_formularios"><strong>C&oacute;digo</strong></td>
      <td width="461"><label><span id="sprytextfield1">
      <input type="text" name="codigo" id="codigo"  disabled="disabled" value="<?php echo $cod?>"/>
      <span class="textfieldRequiredMsg">Se Requiere un Valor</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span>
          <input name="seleccionado" type="hidden" id="seleccionado" value="<?php echo $cod?>" />
      </label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Nombre</strong></td>
      <td><label><span id="sprytextfield2">
      <input name="nombre" type="text" id="nombre" value="<?php echo $row[1]?>" size="60" />
      <span class="textfieldRequiredMsg">Se requiere un nombre</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de Inicio</strong></td>
      <td><label><span id="sprytextfield3">
        <input name="aqo_inicio" type="text" id="aqo_inicio" maxlength="4" value="<?php echo $row[2]?>" />
        <span class="textfieldRequiredMsg">Ingrese Año de inicio</span><span class="textfieldInvalidFormatMsg">Ingrese Numeros</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de fin</strong></td>
      <td><label><span id="sprytextfield4">
        <input name="aqo_fin" type="text" id="aqo_fin" maxlength="4" value="<?php echo $row[3]?>" />
      <span class="textfieldRequiredMsg">Ingrese Año de fin</span><span class="textfieldInvalidFormatMsg">Ingrese Numeros</span></span></label></td>
    </tr>
    <tr bgcolor="#FFFFFF" class="encabezado">
      <td height="30" colspan="2"><label>
        <div align="center">
          <input type="submit" name="insertar" id="insertar" value="Guardar" />
                  <a href="admin_plan_estrategico.php">
                  <input type="submit" name="atras" id="atras" value="Atras" />
                  </a></div>
      </label></td>
    </tr>
  </table>
  <label></label>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>
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