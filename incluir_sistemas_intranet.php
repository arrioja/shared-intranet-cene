<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra la forma correspondiente a la inclusión de los sistemas en la intranet.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Inclusi&oacute;n de M&oacute;dulos a la Intranet</title>
<!-- InstanceEndEditable -->
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
<!-- InstanceBeginEditable name="head" -->


<link href="css/formularios.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="imgs/CENE_07.png">      <div align="right">
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
<form id="form1" name="form1" method="post" action="db/inserta_sistema_intranet.php">
  <br />
  <table width="552" border="1" align="center" cellpadding="0" cellspacing="0" class="datos_formularios">
    <tr>
      <td colspan="2"><div align="center" class="encabezado_formularios">Ingrese el nuevo Sistema para la Intranet de CENE</div></td>
    </tr>
    <tr>
      <td width="200" class="titulos_formularios">C&oacute;digo:</td>
      <td><span id="sprytextfield1">
        <input name="codigo" type="text" id="codigo" size="7" maxlength="5" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Nombre Corto:</td>
      <td width="346"><span id="sprytextfield2">
        <input name="nombre_corto" type="text" id="nombre_corto" size="40" maxlength="30" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Nombre Largo:</td>
      <td><span id="sprytextfield3">
        <input name="nombre_largo" type="text" id="nombre_largo" size="60" maxlength="50" />
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
        <tr>
      <td class="titulos_formularios">Im&aacute;gen Men&uacute; Off:</td>
      <td><span id="sprytextfield4">
        <input name="imagen_grande" type="text" id="imagen_grande" size="60" maxlength="50" />
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
        <tr>
      <td class="titulos_formularios">Im&aacute;gen Men&uacute; On:</td>
      <td><span id="sprytextfield5">
        <input name="imagen_pequena" type="text" id="imagen_pequena" size="60" maxlength="50" />
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
        <tr>
      <td class="titulos_formularios">Directorio de Sistema:</td>
      <td><span id="sprytextfield6">
        <input name="directorio" type="text" id="directorio" size="60" maxlength="50" />
        </span></td>
    </tr>
    <tr>
      <td colspan="2">Nota: Para el campo &quot;Directorio de Sistema&quot;, Si no aplica dejarlo vac&iacute;o, pero si aplica <strong>es IMPORTANTE que el directorio del sistema termine con un caracter &quot;/&quot;</strong>, por ejemplo: <strong>asistencias/</strong> N&oacute;tese el caracter &quot;/&quot; al final.</td>
    </tr>
    <tr>
      <td colspan="2"><div align="right">
        <input type="submit" name="Incluir" id="Incluir" value="Incluir" />
        &nbsp;&nbsp;
        <input type="button" name="Cancelar" id="Cancelar" value="Listado" onclick="javascript: location.href='listar_sistemas_intranet.php'" />
      </div></td>
    </tr>
  </table>
  <div align="center"></div>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"], isRequired:false});
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
