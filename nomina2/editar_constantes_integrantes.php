<?php 
require "includes/miclase.php";
$link=conectarse("nomina");
$ced=$_GET['ced'];
$id=$_GET['id'];
$cod=$_GET['cod'];
$datos_integrantes=mysql_query("select * from integrantes where cedula = '$ced'",$link);//obtener datos del funcionario
$datos_constantes=mysql_query("select * from constantes where cod='$cod'",$link);
$datos_asignacion=mysql_query("select * from integrantes_constantes where id='$id'",$link);
$row = mysql_fetch_array($datos_integrantes);
$row2=mysql_fetch_array($datos_constantes);
$row3=mysql_fetch_array($datos_asignacion);

if (isset($_POST['asignar']))
{$monto=$_POST['monto'];
	if (mysql_query("update integrantes_constantes set cedula='$ced', monto=$monto where id='$id'",$link))
	{
		abrir_popup("mensaje.php?texto=Edito Correctamente la Constante&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		echo '<script languaje="Javascript">location.href="constantes_integrantes.php?id='.$ced.'"</script>';//volver atras
	}
	else
		abrir_popup("mensaje.php?texto=hubo peo&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Integrantes Constantes</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="644" border="1" align="center">
    <tr>
      <td width="154">Nombres</td>
      <td width="180"><input type="text" name="nombres" id="nombres" readonly="readonly"value="<?php echo $row['nombres'];?>" /></td>
      <td colspan="2" rowspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Apellidos</td>
      <td><input type="text" name="apellidos" id="apellidos" readonly="readonly"value="<?php echo $row['apellidos'];?>" /></td>
    </tr>
    <tr>
      <td>C&eacute;dula</td>
      <td><input type="text" name="cedula" id="cedula" readonly="readonly"value="<?php echo $row['cedula'];?>" /></td>
      <td width="201">Asignar Monto</td>
      <td width="81">&nbsp;</td>
    </tr>
    <tr>
      <td>Constante Seleccionada</td>
      <td><input type="text" name="constante" id="constante" readonly="readonly" value="<?php echo $row2['descripcion'];?>"/></td>
      <td><span id="sprytextfield1">
        <input type="text" name="monto" id="monto" value="<?php echo $row3['monto']; ?>" />
        <span class="textfieldRequiredMsg">Valor requerido.</span><span class="textfieldInvalidFormatMsg">Formato Inv&aacute;lido</span></span></td>
      <td><input type="submit" name="asignar" id="asignar" value="Asignar" /></td>
    </tr>
    <tr>
      <td><a href="constantes_integrantes.php?id=<?php echo $ced;?>">Salir</a></td>
      <td colspan="3">&nbsp;</td>
    </tr>
      </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "real", {validateOn:["blur"]});
//-->
</script>
</body>
</html>
