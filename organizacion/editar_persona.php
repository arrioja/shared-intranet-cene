<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Carlos A. Ávila P.
  Descripción General:  Muestra la forma para editar datos de personas
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. Se modificaron las rutas de acceso para trabajar con la intranet y los nombres
														   de las bases de datos, así como los Css, además se excluyeron datos pertenecientes
														   ecslusivamente a nómina.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
  $id=$_GET['id'];
  include("../db/conexion.php");
  include("../libs/utilidades.php");
  $link=conectarse("organizacion");
  $consulta=mysql_query("select * from personas Where (id='$id') ",$link) or die(mysql_error());
  $resultado=mysql_fetch_array($consulta);
  session_start();  // se inicia la sesión 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Editar datos de persona registrada</title>
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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
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

<form id="form1" name="form1" method="post" action="db/edita_persona.php">
<br />

<table width="705" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr class="encabezado_formularios">
    <td colspan="4">Editar datos de persona registrada</td>
  </tr>
  <tr>
    <td width="160" class="titulos_formularios">C&eacute;dula:</td>
    <td colspan="3" class="datos_formularios"><span id="sprytextfield1">
      <label>
      <input name="cedula" type="text" id="cedula"  readonly="readonly" value="<?php echo $resultado['cedula']; ?>" size="15" maxlength="10" />
      </label>
      <span class="textfieldRequiredMsg">Valor Requerido.</span></span>
      <input name="id" type="hidden" id="id" value="<?php echo $id; ?>" /></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Nombres:</td>
    <td colspan="3" class="datos_formularios"><span id="sprytextfield2">
      <label>
      <input name="nombres" type="text" id="nombres" value="<?php echo $resultado['nombres']; ?>" size="60" />
      </label>
      <span class="textfieldRequiredMsg">Valor Requerido.</span></span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Apellidos:</td>
    <td colspan="3" class="datos_formularios"><span id="sprytextfield3">
      <label>
      <input name="apellidos" type="text" id="apellidos" value="<?php echo $resultado['apellidos']; ?>" size="60" />
      </label>
      <span class="textfieldRequiredMsg">Valor Requerido.</span></span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Fecha Nacimiento:</td>
    <td width="186" class="datos_formularios"><span id="sprytextfield4">
      <label>
      <input name="fnac" type="text" id="fnac" value="<?php echo cambiaf_a_normal($resultado['fecha_nacimiento']); ?>" size="12" maxlength="10" />
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
      <input name="lnac" type="text" id="lnac" value="<?php echo $resultado['lugar_nacimiento']; ?>" />
      </label>
      </span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Sexo:</td>
    <td class="datos_formularios"><span id="spryselect1">
      <label>
      <select name="sexo" id="sexo">
        <option value="-1" selected="selected">Seleccione un Valor</option>
        <option value="MASCULINO" <?php if ($resultado['sexo']=="MASCULINO") { echo " selected='selected'"; } ?>>Masculino</option>
        <option value="FEMENINO" <?php if ($resultado['sexo']=="FEMENINO") { echo " selected='selected'"; } ?>>Femenino</option>
      </select>
      </label>
      <span class="selectInvalidMsg">Seleccione un elemento v&aacute;lido.</span>      <span class="selectRequiredMsg">Please select an item.</span></span></td>
    <td class="titulos_formularios">Estado Civil:</td>
    <td class="datos_formularios"><span id="spryselect2">
      <label>
      <select name="edocivil" id="edocivil">
        <option value="-1" selected="selected">Seleccione un Valor</option>
        <option value="SOLTERO"<?php if ($resultado['edo_civil']=="SOLTERO") { echo " selected='selected'"; } ?>>Soltero(a)</option>
        <option value="CASADO" <?php if ($resultado['edo_civil']=="CASADO") { echo " selected='selected'"; } ?>>Casado(a)</option>
        <option value="DIVORCIADO" <?php if ($resultado['edo_civil']=="DIVORCIADO") { echo " selected='selected'"; } ?>>Divorciado(a)</option>
        <option value="VIUDO" <?php if ($resultado['edo_civil']=="VIUDO") { echo " selected='selected'"; } ?>>Viudo(a)</option>
        <option value="CONCUBINATO" <?php if ($resultado['edo_civil']=="CONCUBINATO") { echo " selected='selected'"; } ?>>*Contubinato*</option>
      </select>
      </label>
      <span class="selectInvalidMsg">Seleccione un elemento v&aacute;lido.</span>      <span class="selectRequiredMsg">Please select an item.</span></span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Profesi&oacute;n:</td>
    <td class="datos_formularios"><span id="sprytextfield6">
      <label>
      <input name="profesion" type="text" id="profesion" value="<?php echo $resultado['profesion']; ?>" />
      </label>
      </span></td>
    <td class="titulos_formularios">Grado Instrucci&oacute;n:</td>
    <td class="datos_formularios"><span id="sprytextfield7">
      <label>
      <input name="instruccion" type="text" id="instruccion" value="<?php echo $resultado['grado_instruccion']; ?>" />
      </label>
      </span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Telef. Habitaci&oacute;n</td>
    <td class="datos_formularios"><span id="sprytextfield8">
      <label>
      <input name="telef" type="text" id="telef" value="<?php echo $resultado['tlf_habitacion']; ?>" />
      </label>
      </span></td>
    <td class="titulos_formularios">Telef. Celular:</td>
    <td class="datos_formularios"><span id="sprytextfield9">
      <label>
      <input name="celular" type="text" id="celular" value="<?php echo $resultado['tlf_habitacion']; ?>" />
      </label>
      </span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Fecha Ingreso:</td>
    <td class="datos_formularios"><span id="sprytextfield10">
      <label>
      <input name="fechain" type="text" id="fechain" value="<?php echo cambiaf_a_normal($resultado['fecha_ingreso']); ?>" size="12" maxlength="10" />
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
      <textarea name="direccion" id="direccion" cols="60" rows="5"><?php echo $resultado['direccion']; ?></textarea>
      </label>
      </span></td>
  </tr>
  <tr class="datos_formularios">
    <td height="26" colspan="4" class="datos_formularios"><span class="style4">
      </label>
      </span>
      </td>
  </tr>
  <tr class="datos_formularios">
    <td height="26" colspan="4" class="datos_formularios"><div align="right">
      <label>
      <input type="button" name="volver" id="volver" value="Listado" onclick="javascript: location.href='listar_personas.php'"  />
      </label>
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
