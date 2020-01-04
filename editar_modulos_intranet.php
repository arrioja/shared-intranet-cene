<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra una forma mediante la cual se puede modificar la información de los módulos registrados en la intranet.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 $id=$_GET['id'];
 include("db/conexion.php");
 $link=conectarse("intranet");
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 $consulta=mysql_query("select * from modulos where id='$id'") or die(mysql_error());
 $resultado=mysql_fetch_array($consulta);
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
<form id="form1" name="form1" method="post" action="db/edita_modulo_intranet.php">
  <br />
  <table border="1" align="center" cellpadding="0" cellspacing="0" class="datos_formularios">
    <tr>
      <td colspan="2"><div align="center" class="encabezado_formularios">Modificaci&oacute;n de los datos de m&oacute;dulos de la Intranet de CENE</div></td>
    </tr>
    <tr>
      <td class="titulos_formularios">C&oacute;digo:</td>
      <td>&nbsp;<?php echo $resultado['codigo_modulo']; ?>
        <input name="id" type="hidden" id="id" value="<?php echo $resultado['id']; ?>" /></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Nombre Corto:</td>
      <td width="346"><span id="sprytextfield2">
        <input name="nombre_corto" type="text" id="nombre_corto" value="<?php echo $resultado['nombre_corto']; ?>" size="70" maxlength="60" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Nombre Largo:</td>
      <td><span id="sprytextfield3">
        <input name="nombre_largo" type="text" id="nombre_largo" value="<?php echo $resultado['nombre_largo']; ?>" size="110" maxlength="100" />
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
        <tr>
      <td class="titulos_formularios">Im&aacute;gen Grande:</td>
      <td><span id="sprytextfield4">
        <input name="imagen_grande" type="text" id="imagen_grande" value="<?php echo $resultado['imagen_g']; ?>" size="60" maxlength="50" />
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
        <tr>
      <td class="titulos_formularios">Im&aacute;gen Peque&ntilde;a:</td>
      <td><span id="sprytextfield5">
        <input name="imagen_pequena" type="text" id="imagen_pequena" value="<?php echo $resultado['imagen_p']; ?>" size="60" maxlength="50" />
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
        <tr>
      <td class="titulos_formularios">Archivo PHP:</td>
      <td><span id="sprytextfield6">
        <input name="archivo_php" type="text" id="archivo_php" value="<?php echo $resultado['archivo_php']; ?>" size="60" maxlength="50" />
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="right">
        <input type="submit" name="Modificar" id="Modificar" value="Modificar" />
        &nbsp;&nbsp;
        <input type="button" name="Cancelar" id="Cancelar" value="Listado" onclick="javascript: location.href='listar_modulos_intranet.php'" />
      </div></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
//-->
</script>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 25 September, 2008 12:09 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
