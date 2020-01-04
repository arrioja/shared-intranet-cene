<?php session_start();?>
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
include "../db/conexion.php";
$link=conectarse("gestion");

$cod=$_GET['seleccionado'];
$consulta="select po.codigo, po.nombre, po.aqo_inicio, po.aqo_fin, po.cod_direccion, d.codigo, d.nombre_completo, d.codigo_organizacion, o.codigo, o.nombre from gestion.gestion_planes_operativos po inner join organizacion.direcciones d on (po.cod_direccion=d.codigo) inner join organizacion.organizaciones o on (d.codigo_organizacion=o.codigo) where po.codigo='$cod'";
$result=mysql_query($consulta,$link);
$row=mysql_fetch_array($result);
?>



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
<form id="f1" name="form1" method="post" action="guarda_modificacion_plan_op.php?seleccionado=<?php echo $cod?>">
  <br />
  <table width="621" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2" id="fila_1"><div align="center" class="style3"><strong>Modificaci&oacute;n de  Plan Operativo Direcci&oacute;n</strong></div></td>
    </tr>
    <tr>
      <td width="241" class="titulos_formularios"><strong>Organizaci&oacute;n</strong></td>
      <td width="360" class="datos_formularios"><label>
        <input name="organizacion" type="text" id="organizacion"  value="<?php echo $row[9]?>" size="50" readonly="readonly"/>
      </label></td>
    </tr>
    <tr>
      <td width="241"="50%" align="center" class="titulos_formularios">Direcci&oacute;n</td>
      <td width="360"="50%" align="" class="datos_formularios" id="cod"><label>
        <input name="direccion" type="text" id="direccion"  value="<?php echo $row[6]?>" size="50" readonly="readonly"/>
      </label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>C&oacute;digo</strong></td>
      <td class="datos_formularios"><input type="text" name="codigo" id="codigo"  readonly="readonly"  value="<?php echo $cod?>"/></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Nombre</strong></td>
      <td class="datos_formularios"><span id="sprytextfield2">
        <label>
        <input name="nombre" type="text" id="nombre" size="60"  value="<?php echo $row[1]?>"/>
        </label>
      <span class="textfieldRequiredMsg">Se requiere un valor</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de Inicio</strong></td>
      <td class="datos_formularios"><span id="sprytextfield3">
      <label>
      <input name="aqo_inicio" type="text" id="aqo_inicio" maxlength="4"  value="<?php echo $row[2]?>" />
      </label>
      <span class="textfieldRequiredMsg">Ingrese Fecha de Incicio.</span><span class="textfieldInvalidFormatMsg">Sólo Números</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de Fin</strong></td>
      <td class="datos_formularios"><span id="sprytextfield1">
        <label>
        <input name="aqo_fin" type="text" id="aqo_fin"  value="<?php echo $row[3]?>" maxlength="4"/>
        </label>
      <span class="textfieldRequiredMsg">Se requiere un valor.</span></span></td>
    </tr>
    <tr>
      <td colspan="2">
          <div align="center">
            <input type="submit" name="insertar" id="button" value="Guardar" />
            <a href="admin_plan_operativo.php?seleccionado">
            <input type="submit" name="atras" id="atras" value="Atras" />
          </a>          </div></td>
    </tr>
  </table>
  <p>
  
  
</form>
<script type="text/javascript">
<!--
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur", "change"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 18 September, 2008 9:15 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
