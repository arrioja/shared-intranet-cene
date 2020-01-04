<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Paúl González y Rosanny Yáñez
  Descripción General:  Este archivo muestra la forma para ingresar Direcciones
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. Se modificaron las rutas de acceso para trabajar con la intranet y los nombres
														   de las bases de datos, así como los Css.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
session_start();?>
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



<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

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
      <?php 
include("../db/conexion.php");
$link=conectarse("organizacion");
$result= mysql_query("select nombre, codigo from organizaciones",$link) or die(mysql_error());
$row=mysql_fetch_array($result)
?>
      <br />
    <form id="form1" name="form1" method="post" action="inserta_direccion.php">
  
    <label></label>
  
  <table width="430" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2" align="center"><div align="center" class="style1 style2"><strong>Registro de Direcciones</strong>
        <input name="insertar" type="hidden" id="insertar" value="1" />
      </div></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Organizaci&oacute;n</strong></td>
      <td class="datos_formularios"></span></select>
           <span id="spryselect1">
              <label>
                 <select name="select" id="select">
                   <option value="-1" selected="selected">Selecciona Organizaci&oacute;n...</option>
                   <?php do{?>
          <option value="<?php echo $row['codigo'] ?>"> <?php echo $row['nombre'] ?></option>
          <?php }while ($row=mysql_fetch_array($result))?>
                                  </select>
                 </label>
              <span class="selectInvalidMsg">Please select a valid item.</span>              <span class="selectRequiredMsg">Please select an item.</span></span></td>
    </tr>
    <tr>
      <td width="123" class="titulos_formularios"><strong>C&oacute;digo</strong></td>
      <td width="287" class="datos_formularios"><span id="sprytextfield1">
      <label>
      <input name="codigo" type="text" id="codigo" size="6" maxlength="4" />
      </label>
      <span class="textfieldRequiredMsg">Se Requiere un Valor</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Nombre</strong></td>
      <td class="datos_formularios"><span id="sprytextfield2">
        <label>
        <input name="nombre" type="text" id="nombre" size="60" maxlength="50" />
        </label>
      <span class="textfieldRequiredMsg">Se Requiere Nombre</span></span></td>
    </tr>
    
        <tr>
      <td class="titulos_formularios"><strong>Abreviatura</strong></td>
      <td class="datos_formularios"><span id="sprytextfield2">
        <label><span id="sprytextfield5">
        <input name="abrevia" type="text" id="abrevia" size="30" maxlength="25" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></label>
      <span class="textfieldRequiredMsg">Se Requiere Nombre</span></span></td>
    </tr>

    <tr>
      <td class="titulos_formularios"><strong>Siglas</strong></td>
      <td class="datos_formularios"><span id="sprytextfield2">
        <label></label>
      <span class="textfieldRequiredMsg">Se Requiere Nombre</span><span id="sprytextfield6">
      <label>
      <input name="siglas" type="text" id="siglas" size="15" maxlength="10" />
      </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></span></td>
    </tr>

    <tr>
      <td class="titulos_formularios"><strong>Misi&oacute;n </strong></td>
      <td class="datos_formularios"><span id="sprytextfield3">
        <label></label>
      <span class="textfieldRequiredMsg">Ingrese Misión</span></span><span id="sprytextarea1">
      <label>
      <textarea name="mision" id="mision" cols="45" rows="5"></textarea>
      </label>
      <span class="textareaRequiredMsg">Ingrese Misión</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Visi&oacute;n</strong></td>
      <td class="datos_formularios"><span id="sprytextfield4">
        <label></label>
      <span class="textfieldRequiredMsg">Ingrese Visión</span></span><span id="sprytextarea2">
      <label>
      <textarea name="vision" cols="45" rows="5" id="vision"></textarea>
      </label>
      <span class="textareaRequiredMsg">Ingrese Visión</span></span></td>
    </tr>
    <tr bgcolor="#FFFFFF" class="encabezado">
      <td colspan="2"><span class="style3">
        <div align="center" class="style3">
          <input type="submit" name="insertar" id="insertar" value="Guardar" />
        </div>
        <span class="style3">
        </label>
      </span></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
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
