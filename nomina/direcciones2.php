<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Direcciones</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="500" border="1" align="center">
    <tr>
      <td width="127">Codigo</td>
      <td width="109"><span id="sprytextfield1">
        <input type="text" name="codigo" id="codigo" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td width="118">Nombre Completo</td>
      <td width="118"><span id="sprytextfield2">
        <input type="text" name="nombre_completo" id="nombre_completo" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Nombre Abreviado</td>
      <td><span id="sprytextfield3">
        <input type="text" name="nombre_abreviado" id="nombre_abreviado" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td>Siglas</td>
      <td><span id="sprytextfield4">
        <input type="text" name="siglas" id="siglas" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Fecha Creaci&oacute;n</td>
      <td>&nbsp;</td>
      <td>Status</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="guardar" id="guardar" value="Submit" /></td>
      <td colspan="2" align="center"><input type="submit" name="cancelar" id="cancelar" value="Submit" /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
//-->
</script>
</body>
</html>
