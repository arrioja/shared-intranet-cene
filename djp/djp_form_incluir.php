<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra una forma para incluir el detalle del comprobante de DJP de la persona.
  		Modificado el: 	05/09/2008 por Pedro E. Arrioja M. - Creación
  			  Versión: 	0.2b
     ****************************************************  FIN DE INFO
*/


 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 require("../db/conexion.php");
  $cedula2=$_POST['var_cedula'];
  $link=conectarse("djp");  
//  $consulta_comprobantes = mysql_query("select id,iddoc,fecha,cargo,status from comprobantes where cedula_declarante=$cedula", $link); 
  $consulta_declarantes = mysql_query("select * from declarantes where cedula=$cedula2", $link); 
  if (mysql_num_rows($consulta_declarantes) > 0) 
   {$resultado2=mysql_fetch_array($consulta_declarantes); 
   $cedula_encontrada=true;} else { $cedula_encontrada=false;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Intranet CENE</title>
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


<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript" src="../libs/calendar/calendar.js"></script>
<script type="text/javascript" src="../libs/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="../libs/calendar/lang/calendar-es.js"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<style type="text/css"> 
@import url("../libs/calendar/calendar-win2k-cold-1.css"); 
</style>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
<br />
<form action="db/djp_guarda.php" method="post" target="_self">
  <table width="605" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2" >Datos del Declarante:</td>
    </tr>
    <tr>
      <td width="144" class="titulos_formularios" >C&eacute;dula:&nbsp;</td>
      <td width="455"><label><span id="sprytextfield3">
      <input name="cedula" type="text" id="cedula" size="20" maxlength="8" readonly="readonly" <?php echo 'value="'.$cedula2.'"';?>  />  
      <span class="textfieldRequiredMsg">C&eacute;dula requerida.</span><span class="textfieldInvalidFormatMsg">S&oacute;lo n&uacute;meros enteros.</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios" >Nombres:&nbsp;</td>
      <td>      
      <label><span id="sprytextfield4">
      <input name="nombre" type="text" id="nombre" size="50" maxlength="30" <?php  if ($cedula_encontrada==true) {echo 'readonly="readonly" value="'.$resultado2['nombre'].'"';}?> />
      <span class="textfieldRequiredMsg">Nombre requerido.</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Apellidos:&nbsp;</td>
      <td><label><span id="sprytextfield5">
      <input name="apellido" type="text" id="apellido" size="50" maxlength="30" <?php  if ($cedula_encontrada==true) {echo 'readonly="readonly" value="'.$resultado2['apellido'].'"';}?> />
      <span class="textfieldRequiredMsg">Apellido requerido.</span></span></label></td>
    </tr>
        <tr>
      <td class="titulos_formularios">Sexo:&nbsp;</td>
      <td><span id="spryselect1">
        <select name="sexo" id="sexo">
          <option value="F" <?php  if ($resultado2['sexo'] == "F") { echo "selected='selected'"; }  ?>>Femenino</option>
          <option value="M" <?php  if ($resultado2['sexo'] == "M") { echo "selected='selected'"; }  ?>>Masculino</option>
        </select>
        <span class="selectRequiredMsg">Seleccione un elemento.</span>        </span></td>
    </tr>
    <tr class="encabezado_formularios">
      <td colspan="2">Datos del Comprobante:</td>
    </tr>
    <tr>
      <td class="titulos_formularios">Instituto:&nbsp;</td>
      <td><label><span id="sprytextfield6">
            <input name="instituto" type="text" id="instituto" size="50" maxlength="50" />
      <span class="textfieldRequiredMsg">Instituto requerido.</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios" >Cargo:&nbsp;</td>
      <td><label><span id="sprytextfield7">
        <input name="cargo" type="text" id="cargo" size="50" maxlength="50" />
      <span class="textfieldRequiredMsg">Cargo requerido.</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios" >Nro. -Comprob:&nbsp;</td>
      <td><label><span id="sprytextfield8">
        <input name="iddoc" type="text" id="iddoc" size="15" maxlength="9" />
      <span class="textfieldRequiredMsg"># de comprobante requerido.</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios" >Nro. de Folios:&nbsp;</td>
      <td><label><span id="sprytextfield1">
      <input name="folios" type="text" id="folios" value="1" size="10" maxlength="3" />
      <span class="textfieldInvalidFormatMsg">S&oacute;lo n&uacute;meros son permitodos.</span><span class="textfieldRequiredMsg">Folios requeridos.</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios" >Nro. de Anexos:<strong>&nbsp;</strong></td>
      <td><label><span id="sprytextfield2">
      <input name="anexos" type="text" id="anexos" value="0" size="10" maxlength="3" />
      <span class="textfieldInvalidFormatMsg">S&oacute;lo n&uacute;meros son permitidos.</span><span class="textfieldRequiredMsg">Si no tiene anexos coloque cero "0".</span></span></label></td>
    </tr>
    
     <tr>
      <td class="titulos_formularios" >Fecha:&nbsp;</td>
      <td valign="middle"><span id="sprytextfield9">
      <label>
      <input name="fecha" type="text" id="fecha" value="" size="20" />
      </label>
      <span class="textfieldRequiredMsg">Fecha Requerida.</span><span class="textfieldInvalidFormatMsg">Formato no v&aacute;lido (dd/mm/aaaa).</span></span>
        <label>       </label>
        <img src="../imgs/jscalendar.gif" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
       <script type="text/javascript">
            Calendar.setup({
              inputField    : "fecha",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%d/%m/%Y"
            });
          </script>       </td>
    </tr>
    
    
    <tr>
      <td class="titulos_formularios" >Tipo:<strong>&nbsp;</strong></td>
      <td><label><span id="spryselect2">
<select name="tipo" id="tipo">
  <option value="Ingreso" selected="selected">Ingreso</option>
  <option value="Actualización">Actualizaci&oacute;n</option>
  <option value="Cese">Cese</option>
  <option value="Otros">Otros</option>
</select>
<span class="selectRequiredMsg">Seleccione un elemento.</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios" >Observaciones: (m&aacute;x 200 letras)</td>
      <td><label>
        <textarea name="observaciones" id="observaciones" cols="45" rows="5"></textarea>
      </label></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><label>
        <input type="submit" name="button" id="button" value="Guardar Comprobante" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
      <label>
      <input type="reset" name="button2" id="button2" value="Limpiar Formulario" />
      &nbsp;&nbsp;&nbsp;
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: history.back()" />
      </label></td>
    </tr>
  </table>
</form>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"], minValue:0});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {minValue:0, validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "date", {format:"dd/mm/yyyy", validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
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