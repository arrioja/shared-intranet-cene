<?php 
/*
* Este archivo realiza el llamado al modulo para la inserción de los objetivos estratégicos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
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


<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="../css/formularios.css" rel="stylesheet" type="text/css">
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
   require("../db/conexion.php");
   $link=conectarse("gestion");

   $cod=$_GET['seleccionado'];
   $consulta="select oe.codigo, oe.nombre, oe.descripcion, oe.codigo_plan_estrategico, pe.codigo, pe.nombre, o.codigo, o.nombre 
   			  from gestion_obj_estrategicos oe inner join gestion_planes_estrategicos pe on (oe.codigo_plan_estrategico=pe.codigo) 
			  	   inner join organizacion.organizaciones o on (pe.codigo_organizacion=o.codigo) 
			  where oe.codigo=$cod";
   $result=mysql_query($consulta,$link);
   $row=mysql_fetch_array($result);

  ?>
      <br />
    <form name="aqui" method="POST" action="guarda_modificacion_obj_es_org.php?seleccionado=<?php echo $cod?>">
  <table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2">Modificar objetivos estrat&eacute;gicos de la Organizaci&oacute;n</td>
    </tr>
    <tr>
      <td width="168" class="titulos_formularios">Organizaci&oacute;n:</td>
      <td width="476" class="datos_formularios"><input type="text" name="organizacion" id="organizacion" disabled="disabled" value="<?php echo $row[7]?>"></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Plan Estrat&eacute;gico:</td>
      <td class="datos_formularios"><input type="text" name="plan" id="plan2" disabled="disabled" value="<?php echo $row[5]?>"></td>
    </tr>
    <tr>
      <td class="titulos_formularios">C&oacute;digo:</td>
      <td class="datos_formularios"><input type="text" name="codigo" id="codigo" disabled="disabled" value="<?php echo $cod?>"></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Nombre:</td>
      <td class="datos_formularios"><input name="nombre" type="text" id="nombre" value="<?php echo $row[1]?>" size="60"> </td>
    </tr>
    <tr>
      <td class="titulos_formularios">Descripci&oacute;n:</td>
      <td class="datos_formularios"><input name="descripcion" type="text" id="descripcion" value="<?php echo $row[2]?>" size="60"> </td>
    </tr>
    <tr>
      <td colspan="2" class="datos_formularios"><div align="center">
        <input type="submit" name="insertar" id="insertar" value="Guardar">
        <a href="admin_objetivos_estrategicos.php">
          <input type="submit" name="atras" id="atras" value="Atras">
        </a></div></td>
    </tr>
  </table>


</form>

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
