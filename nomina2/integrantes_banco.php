<?php 
include 'includes/miclase.php';
$link=conectarse("nomina");
$ced=$_GET['ced'];
$result=mysql_query("select nombres, apellidos, cedula from integrantes where cedula='$ced'",$link);
$result2=mysql_query("select * from integrantes_banco where cedula='$ced'",$link);
$integrante=mysql_fetch_array($result);
?>

<?php 
if (isset($_POST['guardar']))
{
	$ced=$_POST['cedula'];
	$tipo=$_POST['tipo'];
	$numero=$_POST['numero'];
	$uso=$_POST['uso'];
	$banco=$_POST['banco'];
	$sql="insert into integrantes_banco (numero_cuenta,banco,tipo,cedula,uso) values('$numero','$banco','$tipo','$cedula','$uso')";
	if(mysql_query($sql))
	{
		abrir_popup("mensaje.php?texto=Inserto Correctamente el la cuenta al funcionario&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		echo '<script languaje="Javascript">location.href="editar_integrantes.php?id='.$ced.'"</script>';
		exit();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Integrantes Banco</title>
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
      <input type="text" name="nombres" id="nombres" value="<?php echo $integrante['nombres'];?>" />
    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td width="114"><strong>Apellidos:</strong></td>
    <td width="192"><span id="sprytextfield1">
      <input name="apellidos" type="text" id="apellidos" value="<?php echo $integrante['apellidos'];?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td><strong>Cedula:</strong></td>
    <td><span id="sprytextfield2">
      <input name="cedula" type="text" id="cedula" value="<?php echo $integrante['cedula'];?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td><strong>Tipo de Cuenta:</strong></td>
    <td><span id="spryselect1">
      <select name="tipo" id="tipo">
        <option value="CORRIENTE">CORRIENTE</option>
        <option value="AHORROS">AHORROS</option>
        <option value="NOMINA">NOMINA</option>
      </select>
    </span></td>
  </tr>
  <tr>
    <td><strong>Banco:</strong></td>
    <td><span id="spryselect2">
      <select name="banco" id="banco">
        <option selected="selected">BANCARIBE</option>
        <option>MI CASA EAP</option>
      </select>
      </span></td>
  </tr>
  <tr>
    <td><strong>Uso de Cuenta:</strong></td>
    <td><select name="uso" id="uso">
      <option value="NOMINA" selected="selected">NOMINA</option>
      <option value="FIDEICOMISO">FIDEICOMISO</option>
    </select>    </td>
  </tr>
  <tr>
    <td><strong>N&uacute;mero:</strong></td>
    <td><span id="sprytextfield3">
    <input type="text" name="numero" id="numero" />
    <span class="textfieldRequiredMsg">A value is required.</span> <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
  </tr>
  <tr>
    <td align="right"><input type="submit" name="guardar" id="guardar" value="Asignar" /></td>
    <td><a href="editar_integrantes.php?id=<?php echo $ced;?>">Salir</a></td>
  </tr>
</table>
</form>

<table width="449" border="1" align="center">
  <tr>
    <td width="120"><strong>Tipo Cuenta</strong></td>
    <td width="124"><strong>Uso de Cuenta</strong></td>
    <td width="74"><strong>Numero</strong></td>
    <td width="103"><strong>Accion</strong></td>
  </tr>
  <?php while ($cuentas=mysql_fetch_array($result2)){?>
  <tr>
    <td><?php echo $cuentas['tipo'];?></td>
    <td><?php echo $cuentas['uso'];?></td>
    <td><?php echo $cuentas['numero_cuenta'];?></td>
    <td><a href="editar_integrantes_banco.php?ced=<?php echo $ced;?>&id=<?php echo $cuentas['id']; ?>">Editar</a> Eliminar</td>
  </tr>
  <?php }?>
</table>
<script type="text/javascript">
<!--
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {isRequired:false});
//-->
</script>
</body>
</html>
