<?php 
include 'includes/miclase.php';
$link=conectarse("nomina");
$ced=$_GET['ced'];
$id=$_GET['id'];
$result=mysql_query("select nombres, apellidos, cedula from integrantes where cedula='$ced'",$link);
$result2=mysql_query("select * from integrantes_banco where cedula='$ced'",$link);
$integrante=mysql_fetch_array($result);
$cuenta=mysql_fetch_array($result2);
if (isset($_POST['guardar']))
{
	$id=$cuenta['id'];
	$numero=$_POST['numero'];
	$banco=$_POST['banco'];
	$cedula=$_POST['cedula'];
	$uso=$_POST['uso'];
	$tipo=$_POST['tipo'];
	
	if (mysql_query("update integrantes_banco set numero_cuenta='$numero',tipo='$tipo', banco='$banco', cedula='$cedula', uso='$uso' where id='$id'",$link))
	{
		abrir_popup("mensaje.php?texto=Edito Correctamente la Cuenta&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		echo '<script languaje="Javascript">location.href="editar_integrantes.php?id='.$ced.'"</script>';
		exit();
	}else
	{
			abrir_popup("mensaje.php?texto=Hubo peo&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
	}
	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edicion de Integrantes Banco</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="322" border="1" align="center">
    <tr>
      <td><strong>Nombres:</strong></td>
      <td><span id="sprytextfield4">
        <input type="text" name="nombres" id="nombres" value="<?php echo $integrante['nombres'];?>" readonly="readonly" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td width="114"><strong>Apellidos:</strong></td>
      <td width="192"><span id="sprytextfield1">
        <input name="apellidos" type="text" id="apellidos" value="<?php echo $integrante['apellidos'];?>" readonly="readonly"/>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Cedula:</strong></td>
      <td><span id="sprytextfield2">
        <input name="cedula" type="text" id="cedula" value="<?php echo $integrante['cedula'];?>" readonly="readonly" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Tipo de Cuenta:</strong></td>
      <td><span id="spryselect1">
        <select name="tipo" id="tipo">
          <option value="CORRIENTE" <?php if ($cuenta['tipo']=='CORRIENTE') echo "selected='selected'"?>>CORRIENTE</option>
          <option value="AHORROS" <?php if ($cuenta['tipo']=='AHORROS') echo "selected='selected'"?>>AHORROS</option>
          <option value="NOMINA" <?php if ($cuenta['tipo']=='NOMINA') echo "selected='selected'"?>>NOMINA</option>
        </select>
      </span></td>
    </tr>
    <tr>
      <td><strong>Banco:</strong></td>
      <td><span id="sprytextfield5">
        <input type="text" name="banco" id="banco" value="<?php echo $cuenta['banco'];?>" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Uso de Cuenta:</strong></td>
      <td><select name="uso" id="uso">
          <option value="NOMINA" <?php if ($cuenta['uso']=='NOMINA') echo "selected='selected'"?>>NOMINA</option>
          <option value="FIDEICOMISO" <?php if ($cuenta['uso']=='FIDEICOMISO') echo "selected='selected'"?>>FIDEICOMISO</option>
        </select>      </td>
    </tr>
    <tr>
      <td><strong>N&uacute;mero:</strong></td>
      <td><span id="sprytextfield3">
        <input type="text" name="numero" id="numero" value="<?php echo $cuenta['numero_cuenta'];?>" />
        <span class="textfieldRequiredMsg">A value is required.</span> </span></td>
    </tr>
    <tr>
      <td align="right"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td><a href="editar_integrantes.php?id=<?php echo $integrante['cedula'];?>">Salir</a></td>
    </tr>
              </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
//-->
</script>
</body>
</html>
