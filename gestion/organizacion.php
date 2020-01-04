<?php 
/*
* Este archivo realiza el llamado al modulo para la inserción de las direcciones
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema Gesti&oacute;n/Organizaci&oacute;n</title>


<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />

</head>

<body>
<span class="style4"></span>

<?php include "../templates/CENE.dwt"?>

<form id="form1" name="form1" method="post" action="inserta_organizacion.php">
  <table width="576" border="1" align="center" cellpadding="2" bordercolor="#000033" bgcolor="#FFFFFF">
    <tr bgcolor="#FFFFFF" class="encabezado">
      <td colspan="2"><div align="center" class="style1 style4"><img src="../imag/usuario.png" alt="" width="57" height="45" /><span class="style2"><strong>Registro de Organizaci&oacute;n</strong></span></div></td>
    </tr>
    <tr>
      <td width="93"><strong>C&oacute;digo</strong></td>
      <td width="463"><label><span id="sprytextfield1">
      <input type="text" name="codigo" id="codigo" />
      <span class="textfieldRequiredMsg">Se Requiere un Valor</span><span class="textfieldInvalidFormatMsg">Valor N&uacute;merico</span></span></label></td>
    </tr>
    <tr>
      <td><strong>Nombre</strong></td>
      <td><label><span id="sprytextfield2">
      <input type="text" name="nombre" id="nombre" />
      <span class="textfieldRequiredMsg">Se Requiere Nombre</span></span></label></td>
    </tr>
    <tr>
      <td><strong>Misi&oacute;n </strong></td>
      <td><label><span id="sprytextfield3"><span class="textfieldRequiredMsg">Ingrese Misión</span></span></label>
        <span id="sprytextarea1">
        <label>
        <textarea name="mision" id="mision" cols="45" rows="1"></textarea>
        </label>
      <span class="textareaRequiredMsg">Ingrese Misión</span></span></td>
    </tr>
    <tr>
      <td><strong>Visi&oacute;n</strong></td>
      <td><label><span id="sprytextfield4"><span class="textfieldRequiredMsg">Ingrese Visión</span></span><span id="sprytextarea2">
      <textarea name="vision" id="vision" cols="45" rows="1"></textarea>
      <span class="textareaRequiredMsg">Ingrese Visión</span></span></label></td>
    </tr>
    <tr bgcolor="#FFFFFF" class="encabezado">
      <td height="20" colspan="2"><label>
        <div align="center">
          <input type="submit" name="insertar" id="insertar" value="Guardar" align="" />
        </div>
        <div align="center"></div>
        <div align="center"></div>
        <div align="center"></div>
      </label></td>
    </tr>
  </table>
  <p>
    <label></label>
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>




<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"]});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {validateOn:["blur", "change"]});
//-->
</script>
</body>
</html>
