<?php 
/*
* Este archivo realiza el llamado al modulo para la inserción de los planes estratégicos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
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
<?php 

   require("../db/conexion.php");
   $link=conectarse("organizacion");

   $cod=$_GET['seleccionado'];
  $consulta="select pe.codigo as codigoplan, pe.nombre as nombreplan, pe.cod_direccion, pe.aqo_inicio, pe.aqo_fin, 
  					d.codigo, d.nombre_completo, d.codigo_organizacion, o.codigo as codorg, o.nombre as nombreorg 
			 from gestion.gestion_planes_estrategicos_direcciones pe inner join organizacion.direcciones d on (pe.cod_direccion=d.codigo) 
			 	  inner join organizacion.organizaciones o on (d.codigo_organizacion=o.codigo) 
			 where pe.codigo='$cod'";
  $result=mysql_query($consulta,$link);
  $row=mysql_fetch_array($result);

?>

<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">



<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
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
<form id="f1" name="form1" method="POST" action="guarda_modificacion_pl_es_dir.php?seleccionado=<?php echo $cod ?>">
  <br />
  <table width="606" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="encabezado_formularios">
      <td colspan="2" id="fila_1"><div align="center" class="style2"><strong>Registro de Planes Estrat&eacute;gicos</strong> <strong>Direcci&oacute;n</strong></div></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Organizaci&oacute;n:</strong></td>
     <td>
         <input type="text" name="organizacion" id="organizacion" disabled="disabled" value="<?php echo $row['nombreorg'] ?>" />    </td>
    </tr>
    <tr>
      <td width="50%" align="center" class="titulos_formularios" >Direcci&oacute;n: </td>
      <td width="50%" align="" id="cod"><label>
        <input type="text" name="direccion" id="direccion"  disabled="disabled" value="<?php echo $row['nombre_completo']?>"/>
      </label></td>
    </tr>
    <tr>
      <td width="50%" class="titulos_formularios"><strong>C&oacute;digo:</strong></td>
      <td width="50%"><input type="text" name="codigo" id="codigo"  disabled="disabled" value="<?php echo $cod?>"/></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Nombre:</strong></td>
      <td><label><span id="sprytextfield2">
        <input name="nombre" type="text" id="nombre" value="<?php echo $row['nombreplan']?>" size="60" />
      <span class="textfieldRequiredMsg">Se requiere un nombre</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de Inicio:</strong></td>
      <td><label><span id="sprytextfield3">
        <input name="aqo_inicio" type="text" id="aqo_inicio" maxlength="4" value="<?php echo $row['aqo_inicio']?>" />
      <span class="textfieldRequiredMsg">Ingrese Año de inicio</span><span class="textfieldInvalidFormatMsg">Sólo Números</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de fin:</strong></td>
      <td><span id="sprytextfield4">
        <label>
        <input name="aqo_fin" type="text" id="aqo_fin" value="<?php echo $row['aqo_fin']?>" maxlength="4"/>
        </label>
      <span class="textfieldRequiredMsg">Se requiere un valor</span></span></td>
    </tr>
    <tr class="encabezado">
      <td colspan="2">
        <div align="center">
          <input type="submit" name="insertar" id="ir_listado" value="Guardar" />
          <a href="admin_planes_estrategicos_direccion.php">
          <input type="submit" name="atras" id="atras" value="Atras" />
        </a>        </div></td>
    </tr>
  </table>
 
  <p align="center">
    <label></label>
  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<script type="text/javascript">
<!--
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
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