<?php
		require "includes/miclase.php";	
   		$link=conectarse("nomina");	
		$id=$_GET['id'];
		$result=mysql_query("select * from variables where id='$id'");
		$variables=mysql_fetch_array($result);
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="311" border="1" align="center">
    <tr>
      <td width="85"><strong>C&oacute;digo</strong></td>
      <td width="210"><span id="sprytextfield1">
        <input name="codigo" type="text" id="codigo" size="10" value="<?php echo $variables['cod'];?>" />
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td><strong>Descripci&oacute;n</strong></td>
      <td><span id="sprytextfield2">
        <input name="descripcion" type="text" id="descripcion" size="35" value="<?php echo $variables['descripcion'];?>" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Abreviatura</strong></td>
      <td><span id="sprytextfield3">
        <input name="abreviatura" type="text" id="abreviatura" size="10" maxlength="5" value="<?php echo $variables['abreviatura'];?>" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Valor</strong></td>
      <td><span id="sprytextfield4">
        <input type="text" name="valor" id="valor" value="<?php echo $variables['valor'];?>" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td><a href="variables.php">Volver</a></td>
    </tr>
          </table>
</form>
<?php 
if (isset($_POST['guardar']))
        {
			$objeto = new miclase();
			if ($objeto->editar_variables($_POST['codigo'],$_POST['descripcion'],$_POST['abreviatura'],$_POST['valor'],$id,$link))
			 	{
				abrir_popup("mensaje.php?texto=Edito Correctamente la Variable&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				echo '<script languaje="Javascript">location.href="variables.php"</script>';
				}
			else
				{
			   $error= mysql_error($link);
				abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");//.mysql_error());
				}
		}
?>
<script type="text/javascript">
<!--
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
//-->
</script>
</body>
</html>
