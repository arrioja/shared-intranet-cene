<?php session_start();
session_destroy();   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Identif&iacute;quese para acceder a la Intranet</title>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>



<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="css/formularios.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%" valign="top">&nbsp;    </td>
    <td width="98%" valign="top"><form id="form1" name="form1" method="post" action="includes/script_login.php">
      <table width="497" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td width="24%" rowspan="5" align="center"><img src="imagenes/password.png" alt="password" width="128" height="128" /></td>
        <td colspan="2" align="center"><strong>Identif&iacute;quese para acceder</strong></td>
      </tr>
    <tr>
      <td width="12%" class="titulos_formularios"><strong>Login:</strong></td>
        <td width="64%" class="datos_formularios"><span id="sprytextfield1">
          <input name="login" type="text" id="login" size="26" />
          <span class="textfieldRequiredMsg">Ingrese Login.</span></span></td>
      </tr>
    <tr>
      <td class="titulos_formularios"><strong>Clave:</strong></td>
        <td class="datos_formularios"><span id="sprytextfield2">
          <input name="password" type="password" id="password" size="26" />
          <span class="textfieldRequiredMsg">Ingrese Clave.</span></span></td>
      </tr>
    <tr>
      <td colspan="2" align="center"><div align="right">
        <input type="submit" name="Submit" value="Aceptar" />
        <input type="hidden" name="pagina" id="hiddenField" value="<?php if (isset($_GET['pag'])) {echo $_GET['pag'];}?>" />
        </div></td>
      </tr>
    <tr>
      <td colspan="2" align="center" class="datos_formularios"><div align="justify">Coloque su nombre de usuario, luego ingrese su clave y haga click en el bot&oacute;n &quot;ACEPTAR&quot;.</div></td>
      </tr>
    <tr>
      <td colspan="3" align="center"></td>
      </tr>
    </table>
</form><script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
//-->
</script></td>
  </tr>
</table>
</body>
</html>