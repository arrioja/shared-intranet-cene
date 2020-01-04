<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra la forma para incluir un nuevo día no laborable.
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


<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
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
<form id="form1" name="form1" method="post" action="db/inserta_no_laborable.php">
  <br />
  <table width="400" border="1" align="center" cellpadding="0" cellspacing="0" class="datos_formularios">
    <tr>
      <td colspan="2"><div align="center" class="encabezado_formularios">Inclusi&oacute;n de fecha NO LABORABLE</div></td>
    </tr>
    <tr>
      <td class="titulos_formularios">D&iacute;a:</td>
      <td><span id="spryselect1">
        <label>
        <select name="dia" id="dia">
          <option value="-1">???</option>
          <?php 
		  for($i=1;$i<=31;$i++) { ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php }?>
        </select>
        </label>
        <span class="selectInvalidMsg">Please select a valid item.</span>        <span class="selectRequiredMsg">Please select an item.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Mes:</td>
      <td><span id="spryselect2">
        <select name="mes" id="mes">
          <option value="-1" selected="selected">Seleccione</option>
          <option value="01">Enero</option>
          <option value="02">Febrero</option>
          <option value="03">Marzo</option>
          <option value="04">Abril</option>
          <option value="05">Mayo</option>
          <option value="06">Junio</option>
          <option value="07">Julio</option>
          <option value="08">Agosto</option>
          <option value="09">Septiembre</option>
          <option value="10">Ocubre</option>
          <option value="11">Noviembre</option>
          <option value="12">Diciembre</option>
        </select>
        <span class="selectInvalidMsg">Please select a valid item.</span>        <span class="selectRequiredMsg">Please select an item.</span></span> </td>
    </tr>
    <tr>
      <td class="titulos_formularios">A&ntilde;o:</td>
      <td><span id="spryselect3">
        <select name="ano" id="ano">
          <option value="-1" selected="selected">Seleccione</option>
          <option value="XXXX">Todos</option>
          <?php 
		   $anomenor=date("Y");
		   for($i=$anomenor;$i<=2020;$i++) 
		     { ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php }?>
        </select>
        <span class="selectInvalidMsg">Please select a valid item.</span>        <span class="selectRequiredMsg">Please select an item.</span></span> </td>
    </tr>
    <tr>
      <td width="106" class="titulos_formularios">Descripci&oacute;n:</td>
      <td width="288"><span id="sprytextarea1">
      <label>
      <textarea name="desc" id="desc" cols="45" rows="5"></textarea>
      </label>
      <span class="textareaRequiredMsg">A value is required.</span><span class="textareaMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="right">
        <input type="submit" name="Incluir" id="Incluir" value="Incluir" />
        &nbsp;&nbsp;
        <input type="button" name="Cancelar" id="Cancelar" value="Listado" onclick="javascript: location.href='listar_no_laborables.php'" />
      </div></td>
    </tr>
  </table>
  <div align="center"></div>
</form>
<script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur", "change"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"-1", validateOn:["blur", "change"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["change", "blur"], invalidValue:"-1"});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], maxChars:1500});
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
