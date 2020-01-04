<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Carlos A. Ávila P.
  Descripción General:  Muestra la forma para incluir datos de personas en el sistema
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. Se modificaron las rutas de acceso para trabajar con la intranet y los nombres
														   de las bases de datos, así como los Css.
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
<title>Inclusi&oacute;n de persona nueva en el sistema</title>
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



<script type="text/javascript" src="../libs/calendar/calendar.js"></script>
<script type="text/javascript" src="../libs/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="../libs/calendar/lang/calendar-es.js"></script>
<style type="text/css"> @import url("../css/calendar-win2k-cold-1.css"); </style>

<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style4 {
	font-size: 9px;
	font-weight: bold;
}
-->
</style>
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
 <SCRIPT language="JavaScript">
<!--
function cargar_contenido(target,valor,func)
{
  var peticion;
  document.getElementById(target).value = 'Cargando Datos...';
  var myConn = new XHConn();
  if (!myConn) alert("XMLHTTP no esta disponible. Intalo con un navegador mas nuevo.");
  peticion=function(oXML){document.getElementById(target).value=oXML.responseText;};
  myConn.connect("../libs/detalle.php?valor="+valor+"&func="+func, "GET", "", peticion);
}
//-->
</SCRIPT>
<script language="JavaScript" src="../libs/XHConn.js"></script>
<form id="form1" name="form1" method="post" action="db/incluye_persona.php">
<br />

<table width="705" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr class="encabezado_formularios">
    <td colspan="4">Inclusi&oacute;n de nueva persona en el sistema</td>
  </tr>
  <tr>
    <td width="160" class="titulos_formularios">C&eacute;dula:</td>
    <td colspan="3" class="datos_formularios"><span id="sprytextfield1">
      <label>
      <input name="cedula" type="text" id="cedula" onkeypress="if(event.keyCode == 13){ 
                                							   cargar_contenido('apellidos',this.value,2); 
                                                               cargar_contenido('nombres',this.value,1);
                                							   return false;
                        									   }" size="15" maxlength="10" />
      </label>
      <span class="textfieldRequiredMsg">Valor Requerido.</span></span> (y presione ENTER para saber si ya est&aacute; registrado)</td>
  </tr>
  <tr>
    <td class="titulos_formularios">Nombres:</td>
    <td colspan="3" class="datos_formularios"><span id="sprytextfield2">
      <label>
      <input name="nombres" type="text" id="nombres" size="60" />
      </label>
      <span class="textfieldRequiredMsg">Valor Requerido.</span></span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Apellidos:</td>
    <td colspan="3" class="datos_formularios"><span id="sprytextfield3">
      <label>
      <input name="apellidos" type="text" id="apellidos" size="60" />
      </label>
      <span class="textfieldRequiredMsg">Valor Requerido.</span></span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Fecha Nacimiento:</td>
    <td width="186" class="datos_formularios"><span id="sprytextfield4">
      <label>
      <input name="fnac" type="text" id="fnac" size="12" maxlength="10" />
      </label>
      
      <img src="../imgs/jscalendar.gif" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
        <script type="text/javascript">
            Calendar.setup({
              inputField    : "fnac",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%d/%m/%Y"
            });
          </script>
      <span class="textfieldRequiredMsg">Valor Requerido.</span></span>      </td>
    <td width="156" class="titulos_formularios">Lugar Nacimiento:</td>
    <td width="193" class="datos_formularios"><span id="sprytextfield5">
      <label>
      <input type="text" name="lnac" id="lnac" />
      </label>
      </span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Sexo:</td>
    <td class="datos_formularios"><span id="spryselect1">
      <label>
      <select name="sexo" id="sexo">
        <option value="-1" selected="selected">Seleccione un Valor</option>
        <option value="MASCULINO">Masculino</option>
        <option value="FEMENINO">Femenino</option>
      </select>
      </label>
      <span class="selectInvalidMsg">Seleccione un elemento v&aacute;lido.</span>      <span class="selectRequiredMsg">Please select an item.</span></span></td>
    <td class="titulos_formularios">Estado Civil:</td>
    <td class="datos_formularios"><span id="spryselect2">
      <label>
      <select name="edocivil" id="edocivil">
        <option value="-1" selected="selected">Seleccione un Valor</option>
        <option value="SOLTERO">Soltero(a)</option>
        <option value="CASADO">Casado(a)</option>
        <option value="DIVORCIADO">Divorciado(a)</option>
        <option value="VIUDO">Viudo(a)</option>
        <option value="CONCUBINATO">*Contubinato*</option>
      </select>
      </label>
      <span class="selectInvalidMsg">Seleccione un elemento v&aacute;lido.</span>      <span class="selectRequiredMsg">Please select an item.</span></span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Profesi&oacute;n:</td>
    <td class="datos_formularios"><span id="sprytextfield6">
      <label>
      <input type="text" name="profesion" id="profesion" />
      </label>
      </span></td>
    <td class="titulos_formularios">Grado Instrucci&oacute;n:</td>
    <td class="datos_formularios"><span id="sprytextfield7">
      <label>
      <input type="text" name="instruccion" id="instruccion" />
      </label>
      </span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Telef. Habitaci&oacute;n</td>
    <td class="datos_formularios"><span id="sprytextfield8">
      <label>
      <input type="text" name="telef" id="telef" />
      </label>
      </span></td>
    <td class="titulos_formularios">Telef. Celular:</td>
    <td class="datos_formularios"><span id="sprytextfield9">
      <label>
      <input type="text" name="celular" id="celular" />
      </label>
      </span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Fecha Ingreso:</td>
    <td class="datos_formularios"><span id="sprytextfield10">
      <label>
      <input name="fechain" type="text" id="fechain" size="12" maxlength="10" />
      </label>
      
      <img src="../imgs/jscalendar.gif" name="f_trigger_a" id="f_trigger_a" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
        <script type="text/javascript">
            Calendar.setup({
              inputField    : "fechain",
              button        : "f_trigger_a",
              align         : "Tr",
			  ifFormat    	: "%d/%m/%Y"
            });
          </script>
      
      <span class="textfieldRequiredMsg">Valor Requerido.</span></span></td>
    <td class="titulos_formularios">&nbsp;</td>
    <td class="datos_formularios">&nbsp;</td>
  </tr>
  <tr>
    <td class="titulos_formularios">Dir. Habitaci&oacute;n:</td>
    <td colspan="3" class="datos_formularios"><span id="sprytextarea1">
      <label>
      <textarea name="direccion" id="direccion" cols="60" rows="5"></textarea>
      </label>
      </span></td>
  </tr>
  <tr class="datos_formularios">
    <td height="26" colspan="4" class="datos_formularios"><span class="style4">
      </label>
      </span>
      <div align="justify" class="style4">Nota: Por pol&iacute;tica general, todas las personas registradas mediante este m&oacute;dulo: 1.- Se inician en Nivel 
      05: &quot;Invitado&quot;, 2.- No se encuentra habilitado para el marcado de asistencias, 3.- No forma parte de la nomina de la instituci&oacute;n en ninguna de sus formas y No posee cuenta de usuario asignada para el uso de la intranet de la Contralor&iacute;a.</div></td>
  </tr>
  <tr class="datos_formularios">
    <td height="26" colspan="4" class="datos_formularios"><div align="right">
      <input type="button" name="volver" id="volver" value="Listado" onclick="javascript: location.href='listar_personas.php'"  />
       <input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
      <input type="submit" name="guardar" id="guardar" value="Guardar" />
    </div></td>
  </tr>
</table>

</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"], invalidValue:"-1"});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"-1", validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "none", {validateOn:["blur"]});
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
