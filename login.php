<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Carlos A. Ávila P.
  Descripción General:  muestra la pantalla mediante la cual el usuario debe identificarse.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Se realizaron mejoras visuales, además de la captura de la ip de la maquina
						del cliente y la insersión de la marca de rastreo correspondiente.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/

session_start();
if (isset($_SESSION['login']))  // si "login" existe, entonces se registra la salida del usuario de la intranet.
  {
     //Se añaden los rastros de auditoria respectivos	 
	$descripcion='Salida de la Intranet.';
	$ip = $REMOTE_ADDR; 
	include("db/conexion.php");
    include("db/inserta_rastreo.php");
    inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'L',$descripcion,$ip);
	
  };
  session_destroy();     
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Identif&iacute;quese para acceder a la Intranet</title>
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


<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="css/formularios.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
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
<form id="form1" name="form1" method="post" action="db/script_login.php">
  <br />
  <br />
  <br />
  <table width="497" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td width="24%" rowspan="5" align="center"><img src="imgs/password.png" alt="password" width="128" height="128" /></td>
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
      <td colspan="2" align="center" class="datos_formularios"><div align="justify">Coloque su nombre de usuario (el mismo que usa para ingresar a su perfil bajo Linux), luego ingrese su clave y haga click en el bot&oacute;n &quot;ACEPTAR&quot;. Se recomienda la visita a este sitio web mediante Mozilla FireFox.</div></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
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