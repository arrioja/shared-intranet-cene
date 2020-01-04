<?php 
/*
* Este archivo realiza el llamado al modulo para la inserción de los objetivos estratégicos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/
session_start();
require("../db/conexion.php");
$link=conectarse("organizacion");
$cod_org=$_POST['organizacion'];
$cod_plan=$_POST['plan'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
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
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.style1 {
	font-weight: bold;
	font-size: medium;
}
-->
</style>
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

   
      <form action="inserta_objetivos_estrategicos.php" method="post" name="aqui" id="aqui">
      <br />
    
      <table width="602" height="219" border="1" align="center" cellpadding="0" cellspacing="0" >
        <tr bgcolor="#FFFFFF" class="encabezado_formularios">
          <td colspan="3" id="fila_1">Registro de Objetivos Estrategicos Organizaci&oacute;n</td>
        </tr>
        <tr>
          <td width="27%" align="center" class="titulos_formularios" id="nombre">Organizacion:</td>
          <td colspan="2" align="center" id="nombre"><div align="justify">         
            <label>
		<select name="organizacion" >
		<?php       
		$result=mysql_query("SELECT * FROM organizacion.organizaciones where codigo='$cod_org'",$link);
        while($row=mysql_fetch_row($result))
   		{
      	echo "<option value='".$row[1]."'>".$row[2]."</option>";
   		}
		?>
            </select>
            </label>
          </div></td>
        </tr>
        <tr>
          <td width="27%" align="center" class="titulos_formularios" >Plan Estrat&eacute;gico:</td>
          <td colspan="2" align="" id="cod"><div align="justify">
          <?php $result2=mysql_query("SELECT * FROM gestion.gestion_planes_estrategicos WHERE codigo='$cod_plan'",$link);
		  $row=mysql_fetch_array($result2);
		  ?>
            <select class="combo" id="select_1" name="plan">
              <option value="<?php echo $cod_plan;?>"><?php echo $row[2];?></option>
            </select>
          </div></td>
        </tr>
        <tr>
          <td width="27%" align="center" class="titulos_formularios" id="plan">Codigo:</td>
          <td colspan="2" align="center" id="plan"><span id="sprytextfield1">
          <label> </label>
          <div align="justify">
            <input type="text" name="codigo" id="codigo" />
          </div>
          <span class="textfieldRequiredMsg">Se requiere un Valor</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></td>
        </tr>
        <tr>
          <td class="titulos_formularios" id="plan">Nombre:</td>
          <td colspan="2" class="datos_formularios" id="plan"><span id="sprytextarea1">
            <label>
            <textarea name="nombre" id="nombre2" cols="45" rows="1"></textarea>
            </label>
            <span class="textareaRequiredMsg">Se Requiere Nombre</span></span></td>
        </tr>
        <tr>
          <td class="titulos_formularios" id="plan6">Descripcion:</td>
          <td colspan="2" class="datos_formularios" id="plan6"><span id="sprytextarea2">
            <label>
            <textarea name="descripcion" id="descripcion" cols="45" rows="1"></textarea>
            </label>
            <span class="textareaRequiredMsg">Ingrese Descripción</span></span></td>
        </tr>
        <tr bgcolor="#FFFFFF" class="encabezado">
          <td colspan="3" align="center" id="plan5"><label></span></a></label>            <input type="submit" name="insertar" id="insertar" value="Guardar"   />            <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='admin_objetivos_estrategicos.php'" /></td>
          </tr>
      </table>
  </form>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"]});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {validateOn:["blur", "change"]});
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