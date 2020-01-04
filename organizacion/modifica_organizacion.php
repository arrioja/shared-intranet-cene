<?php 

/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Paúl González y Rosanny Yáñez
  Descripción General:  Este archivo modifica los datos de la organización
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. Se modificaron las rutas de acceso para trabajar con la intranet y los nombres
														   de las bases de datos, así como los Css.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/

session_start();  // se inicia la sesión 
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
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
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

<?php 
  include ("../db/conexion.php"); 
  $link=conectarse("organizacion");
  $result=mysql_query("select * from organizaciones where codigo=$_GET[codigo_organizacion]",$link);
  $row=mysql_fetch_array($result);
?>
<form id="f1" name="form1" method="post" action="db/guarda_modificacion.php?seleccionado=<?php echo $row['codigo']?>">
  <br />
  <table width="576" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2"><div align="center"><strong>Registro de Organizaci&oacute;n</strong></div></td>
    </tr>
    <tr>
      <td width="93" class="titulos_formularios"><strong>C&oacute;digo</strong></td>
      <td width="463" class="datos_formularios"><label><span id="sprytextfield1">
      <input name="codigo" type="text" disabled="disabled" id="codigo"  value="<?php echo $row['codigo']?>" size="60"/>
      <span class="textfieldRequiredMsg">Se Requiere un Valor</span><span class="textfieldInvalidFormatMsg">Valor N&uacute;merico</span></span>
          <input name="cod" type="hidden" id="cod" value="<?php echo $row['codigo']?>" />
      </label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Nombre</strong></td>
      <td class="datos_formularios"><label><span id="sprytextfield2">
      <input name="nombre" type="text" id="nombre" value="<?php echo $row['nombre']?>" size="60" />
      <span class="textfieldRequiredMsg">Se Requiere Nombre</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Misi&oacute;n </strong></td>
      <td class="datos_formularios"><label></label>        <span id="sprytextarea1">
        <label>
        <textarea name="mision" id="mision" cols="45" rows="5" ><?php echo $row['mision']?></textarea>
        </label>
      <span class="textareaRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Visi&oacute;n</strong></td>
      <td class="datos_formularios"><label><span id="sprytextarea2">
        <textarea name="vision" id="vision" cols="45" rows="5" ><?php echo $row['vision']?></textarea>
      <span class="textareaRequiredMsg">A value is required.</span></span></label></td>
    </tr>
    <tr class="encabezado">
      <td height="30" colspan="2"><label>
        <div align="center">
          <input type="submit" name="insertar" id="insertar" value="Guardar" />
          <a href="listar_organizacion.php">
          <input type="submit" name="atras" id="atras" value="Atras" on />
          </a>                    </div>
      </label></td>
    </tr>
  </table>
  <p>
    <label></label>
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>




<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2");
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
