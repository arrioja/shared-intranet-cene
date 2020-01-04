<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Solicita la cédula de la persoja cuya Declaración Jurada de Patromonio (DJP) se desea consultar.
  		Modificado el: 	05/09/2008 por Pedro E. Arrioja M. - Creación
  			  Versión: 	0.2b
     ****************************************************  FIN DE INFO
*/

 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Conaulta de DJP por c&eacute;dula</title>
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
    
<script language="JavaScript" src="../libs/XHConn.js"></script>    
<SCRIPT language="JavaScript">
<!--
function cargar_contenido(target,valor)
{
  var peticion;
  document.getElementById(target).innerHTML = 'Cargando Datos...';
  var myConn = new XHConn();
  if (!myConn) alert("XMLHTTP no esta disponible. Inténtalo con un navegador mas nuevo.");
  peticion=function(oXML){document.getElementById(target).innerHTML=oXML.responseText;};
  myConn.connect("comprobantes_por_cedula.php", "POST", "cedula="+valor, peticion);
}
//-->
</SCRIPT>

  <br />
  <table border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td class="titulos_formularios" ><div align="right" class="Estilo2">C&eacute;dula:&nbsp;</div></td>
      <td class="datos_formularios" ><span id="sprytextfield1">
      <input name="cedula" type="text" id="cedula" maxlength="8" onkeypress="if(event.keyCode == 13){  
                                                               cargar_contenido('resultado',this.value);
                                							   return false;
                        									   }" />
      <span class="textfieldRequiredMsg">Debe ingresar la c&eacute;dula a consultar.</span><span class="textfieldInvalidFormatMsg">S&oacute;lo n&uacute;meros enteros.</span></span></td>
    </tr>
    <tr class="datos_formularios">
      <td colspan="2" id="resultado">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Coloque la C&eacute;dula y Presione &quot;ENTER&quot;</td>
      </tr>
    <tr>
      <td colspan="2"><div align="right">
         <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='..'" />
        </div></td>
      </tr>
  </table>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
//-->
</script><!-- InstanceEndEditable --></td>
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
