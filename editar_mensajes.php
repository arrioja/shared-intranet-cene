<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra una forma mediante la cual se puede modificar la información de los mensajes registrados en la intranet.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 include("db/conexion.php");
 $link=conectarse("intranet");
 $id=$_GET['id'];
 mysql_query("BEGIN");  //inicio la transaccion
 $consulta=mysql_query("select * from mensajes where id='$id'") or die(mysql_error());
 $msg=mysql_fetch_array($consulta);
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
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
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
<form id="form1" name="form1" method="post" action="db/edita_mensaje.php">
  <br />
  <table width="552" border="1" align="center" cellpadding="0" cellspacing="0" class="datos_formularios">
    <tr>
      <td colspan="2"><div align="center" class="encabezado_formularios">Inclusi&oacute;n de Mensaje para la Intranet</div></td>
    </tr>
    <tr>
      <td width="200" class="titulos_formularios">C&oacute;digo:</td>
      <td><?php echo $msg['codigo']; ?> <input name="id" type="hidden" id="id" value="<?php echo $msg['id']; ?>" /></td>
    </tr>
    <tr>
      <td class="titulos_formularios">T&iacute;tulo:</td>
      <td width="346"><span id="sprytextfield2">
        <input name="titulo" type="text" id="titulo" value="<?php echo $msg['titulo']; ?>" size="40" maxlength="30" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
        <tr>
      <td class="titulos_formularios">Im&aacute;gen:</td>
      <td><span id="sprytextfield4">
        <input name="imagen" type="text" id="imagen" value="<?php echo $msg['imagen']; ?>" size="60" maxlength="50" />
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
        <tr>
      <td class="titulos_formularios">Mensaje:</td>
      <td><span id="sprytextarea1">
      <textarea name="texto" id="texto" cols="57" rows="3"><?php echo $msg['mensaje']; ?></textarea>
      Tiene
      <span id="countsprytextarea1">&nbsp;</span> caracteres disponibles.      <span class="textareaRequiredMsg">Se necesita un valor.</span><span class="textareaMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="right">
        <input type="submit" name="Incluir" id="Incluir" value="Modificar" />
        &nbsp;&nbsp;
        <input type="button" name="Cancelar" id="Cancelar" value="Listado" onclick="javascript: location.href='listar_mensaje.php'" />
      </div></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"], maxChars:500, counterType:"chars_remaining", counterId:"countsprytextarea1"});
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
