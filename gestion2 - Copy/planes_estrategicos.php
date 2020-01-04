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
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
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
   $link=conectarse("organizacion");
   $result= mysql_query("Select nombre, codigo from organizaciones",$link) or die(mysql_error());
   $row=mysql_fetch_array($result)
?>
      <br />
    <form id="form1" name="form1" method="post" action="inserta_planes.php">
  <table width="604" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="encabezado_formularios">
      <td colspan="2"><div align="center" class="style2"><strong>Registro de Planes Estrat&eacute;gicos</strong> <strong>Organizaci&oacute;n</strong> </div></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Organizaci&oacute;n:</strong></td>
      <td><select name="select" size="1">
      <option value="0"> Selecciona Organización...</option>
        <?php do{?>
          <option value="<?php echo $row['codigo'] ?>" selected="selected">  <?php echo $row['nombre'] ?></option>
          
        <?php 
	
	 }while ($row=mysql_fetch_array($result))?>
      </select></td>
    </tr>
    <tr>
      <td width="151" class="titulos_formularios">C&oacute;digo</td>
      <td width="447"><label><span id="sprytextfield1">
      <input type="text" name="codigo" id="codigo" />
      <span class="textfieldRequiredMsg">Se Requiere un Valor</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Nombre:</strong></td>
      <td><label><span id="sprytextarea1">
      <textarea name="nombre" id="nombre" cols="45" rows="1"></textarea>
      <span class="textareaRequiredMsg">Se Requiere Nombre</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de Inicio:</strong></td>
      <td><label><span id="sprytextfield3">
        <input name="aqo_inicio" type="text" id="aqo_inicio" maxlength="4" /> 
      <span class="textfieldRequiredMsg">Ingrese Año de inicio</span><span class="textfieldInvalidFormatMsg">Ingrese Numeros</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de fin:</strong></td>
      <td><label><span id="sprytextfield4">
      <input name="aqo_fin" type="text" id="aqo_fin" maxlength="4" />
      <span class="textfieldRequiredMsg">Ingrese Año de fin</span><span class="textfieldInvalidFormatMsg">Ingrese Numeros</span></span></label></td>
    </tr>
    <tr bgcolor="#FFFFFF" class="encabezado">
      <td colspan="2"><label>
        <div align="center">
          <input type="submit" name="insertar" id="insertar" value="Guardar" />
        </div>
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
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"]});
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
