<?php
require "includes/miclase.php";
$link=conectarse("nomina");
$id=$_GET['id'];
$result=mysql_query("select * from banco where id='$id'",$link);
$banco=mysql_fetch_array($result);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edicion de Banco</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="320" border="1" align="center">
    <tr>
      <td width="114"><strong>C&oacute;digo</strong></td>
      <td width="190"><span id="sprytextfield1">
        <input name="codigo" type="text" id="codigo" size="10" maxlength="5" value="<?php echo $banco['cod'];?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Nombre</strong></td>
      <td><span id="sprytextfield4">
        <input name="nombre" type="text" id="nombre" value="<?php echo $banco['nombre'];?>" size="30" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Descripci&oacute;n</strong></td>
      <td><span id="sprytextfield2">
        <input name="descripcion" type="text" id="descripcion" size="30" value="<?php echo $banco['descripcion'];?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Tipo de Cuenta</strong></td>
      <td><span id="spryselect1">
        <select name="tipo" id="tipo">
        <OPTION VALUE="CORRIENTE" <?php if ($banco['tipo']=='CORRIENTE') echo "selected='selected'"?>>CORRIENTE</OPTION>
        <OPTION VALUE="AHORROS"<?php if ($banco['tipo']=='AHORROS') echo "selected='selected'"?>>AHORROS</OPTION>
        <OPTION VALUE="NOMINA"<?php if ($banco['tipo']=='NOMINA') echo "selected='selected'"?>>NOMINA</OPTION>
        </select>
      </span></td>
    </tr>
    <tr>
      <td><strong>N&uacute;mero</strong></td>
      <td><span id="sprytextfield3">
        <input name="numero" type="text" id="numero" value="<?php echo $banco['numero'];?>" size="30" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td><a href="banco.php">Salir</a></td>
    </tr>
  </table>
</form>
<?php 
if (isset($_POST['guardar']))
	{
	$objeto = new miclase();
			if ($objeto->editar_banco($_POST['codigo'],$_POST['descripcion'],$_POST['tipo'],$_POST['numero'],$_POST['nombre'],$link))
				{
				abrir_popup("mensaje.php?texto=Edito Correctamente el Banco&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		echo '<script languaje="Javascript">location.href="banco.php"</script>';
				}
	}
?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
//-->
</script>
</body>
</html>
