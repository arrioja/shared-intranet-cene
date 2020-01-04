<?php
include("includes/miclase.php");
$link=conectarse("nomina");
$result=mysql_query("select * from configuracion",$link);
$datos = mysql_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Configuraci&oacute;n Actual de la N&oacute;mina</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="516" border="1" align="center">
    <tr>
      <td width="91"><strong>A&ntilde;o en Curso</strong></td>
      <td width="122"><span id="sprytextfield2">
        <input name="ano_curso" type="text" id="ano_curso" size="10" maxlength="10" value="<?php echo $datos["ano_curso"];?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td width="162"><strong>N&uacute;mero de Per&iacute;odos</strong></td>
      <td width="113"><span id="sprytextfield1">
        <input name="n_periodos" type="text" id="n_periodos" size="10" maxlength="2" value="<?php echo $datos["num_periodos"];?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span><span class="textfieldRequiredMsg">A value is required.</span></td>
    </tr>
    <tr>
      <td colspan="2">
        <div align="center">
          <input type="submit" name="guardar" id="guardar" value="Guardar" />
        </div></td>
      <td colspan="2"><div align="center"><a href="nomina_actual.php">Volver</a></div></td>
    </tr>
  </table>
</form>
<?php 
if (isset($_POST['guardar']))		
	{
	$objeto = new miclase();
	if ($objeto->editar_configuracion($_POST['ano_curso'],$_POST['n_periodos'],$datos['id'],$link)==true)
		{
	    abrir_popup("mensaje.php?texto=Configuracion Actualizada&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		echo '<script languaje="Javascript">location.href="nomina_actual.php"</script>';
		}
	else
		{
	    $error= mysql_error($link);
	    abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		}
	}	
?>

<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>
</body>
</html>
