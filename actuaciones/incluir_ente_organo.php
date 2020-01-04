<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra una forma para incluir un nuevo órgano o ente sujeto a control.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 include("../db/conexion.php");
 $link=conectarse("asistencias"); 
 $consulta=mysql_query("SELECT max(codigo) as cod from asistencias.entes_organos",$link) or die(mysql_error());	
 $resultado=mysql_fetch_array($consulta); 
 $codigo=$resultado['cod']+1;
 switch (strlen($codigo))
 { case 1: $codigo='0000'.$codigo;
           break;
   case 2: $codigo='000'.$codigo;
           break;
   case 3: $codigo='00'.$codigo;
           break;
   case 4: $codigo='0'.$codigo;
           break;
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Incluir Ente/&Oacute;rgano</title>
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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
<form id="form1" name="form1" method="post" action="db/inserta_ente_organo.php">
  <br />
  <table width="552" border="1" align="center" cellpadding="0" cellspacing="0" class="datos_formularios">
    <tr>
      <td colspan="2"><div align="center" class="encabezado_formularios">Ingrese un nuevo Ente u &Oacute;rgano sujeto a control</div></td>
    </tr>
    <tr>
      <td width="200" class="titulos_formularios">C&oacute;digo:</td>
      <td><span id="sprytextfield1">
      <input name="codigo" type="text" id="codigo" value="<?php echo $codigo; ?>" size="10" maxlength="5" readonly="readonly" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Siglas:</td>
      <td width="346"><span id="sprytextfield2">
      <input name="siglas" type="text" id="siglas" size="20" maxlength="50" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Nombre:</td>
      <td><span id="sprytextfield3">
        <input name="nombre" type="text" id="nombre" size="60" maxlength="300" />
        <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Tipo:</td>
      <td><span id="spryselect1">
        <select name="tipo" id="tipo">
          <option value="-1">Seleccione Tipo</option>
          <option value="C">Centralizada</option>
          <option value="D">Descentralizada</option>
                </select>
      <span class="selectRequiredMsg">Seleccione un elemento.</span>      <span class="selectInvalidMsg">Seleccione un elemento válido.</span>        </span></td>
    </tr>


    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="right">
          <input type="submit" name="Incluir" id="Incluir" value="Incluir" />
        &nbsp;&nbsp;
        <input type="button" name="Cancelar" id="Cancelar" value="Listado" onclick="javascript: location.href='listar_entes_organos.php'" />
      </div></td>
    </tr>
</table>
  <div align="center"></div>
  <table width="552" border="1" align="center" cellpadding="0" cellspacing="0" class="datos_formularios">
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur"]});
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
