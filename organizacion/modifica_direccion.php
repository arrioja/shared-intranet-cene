<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Paúl González y Rosanny Yáñez
  Descripción General:  Este archivo modifica los datos de las direcciones
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
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
      <?php 
  include("../db/conexion.php");
  $link=conectarse("organizacion");
  $cod=$_GET['seleccionado'];
  $consulta="select a.codigo,a.nombre_completo, a.nombre_abreviado, a.mision, a.vision, a.codigo_organizacion, 
  				    a.siglas, o.nombre 
  			from organizacion.direcciones a inner join organizacion.organizaciones o on (a.codigo_organizacion=o.codigo) 
			where a.codigo='$cod'";
  $result=mysql_query($consulta,$link);
  $row=mysql_fetch_array($result);

?>
        <br />
    <form id="form1" name="form1" method="post" action="guarda_modificacion.php?seleccionado=<?php echo $cod?>">
  
    <label></label>
  
  <table width="430" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2" align="center">Modificar Datos de Direcci&oacute;n</td>
    </tr>
    <tr>
      <td class="titulos_formularios">Organizaci&oacute;n</td>
      <td><label>
        <input type="text" name="organizacion" id="organizacion"  disabled="disabled" value="<?php echo $row['nombre']?>"/>
      </label>
      </span>        </select></td>
    </tr>
    <tr>
      <td width="123" class="titulos_formularios">C&oacute;digo</td>
      <td width="287">
      <label>
      <input type="text" name="codigo" id="codigo" disabled="disabled" value="<?php echo $row['codigo']?>" />
      </label>      </td>
    </tr>
    <tr>
      <td class="titulos_formularios">Nombre</td>
      <td>
        <label>
        <input name="nombre" type="text" id="nombre" value="<?php echo $row['nombre_completo']?>" size="60" maxlength="50"/>
        </label>
      <span class="textfieldRequiredMsg">Se Requiere Nombre</span></td>
    </tr>
            <tr>
      <td class="titulos_formularios"><strong>Abreviatura</strong></td>
      <td class="datos_formularios"><span id="sprytextfield2">
        <label>
        <input name="abrevia" type="text" id="abrevia" value="<?php echo $row['nombre_abreviado']?>" size="40" maxlength="35" />
        </label>
      <span class="textfieldRequiredMsg">Se Requiere Nombre</span></span></td>
    </tr>

    <tr>
      <td class="titulos_formularios"><strong>Siglas</strong></td>
      <td class="datos_formularios"><span id="sprytextfield2">
        <label>
        <input name="siglas" type="text" id="siglas" value="<?php echo $row['siglas']?>" size="20" maxlength="10" />
        </label>
      <span class="textfieldRequiredMsg">Se Requiere Nombre</span></span></td>
    </tr>

    <tr>
      <td class="titulos_formularios">Misi&oacute;n </td>
      <td>
        <label>
        <input name="mision" type="text" id="mision" size="60" value="<?php echo $row['mision']?>" />
        </label>
      <span class="textfieldRequiredMsg">Se requiere misión</span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Visi&oacute;n</td>
      <td>
        <label>
        <input name="vision" type="text" id="vision" size="60" value="<?php echo $row['vision']?>"/>
        </label>
      <span class="textfieldRequiredMsg">Se requiere visión</span></td>
    </tr>
    <tr bgcolor="#FFFFFF" class="encabezado">
      <td colspan="2">
        <div align="center">
          <input type="submit" name="insertar" id="insertar" value="Guardar" />
          <a href="admin_direccion.php">
          <input type="submit" name="atras" id="atras" value="Atras" />
          </a>                  </div>
      <div align="center" class="style3"></div>      </td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
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
