<?php session_start();
if (!isset($_SESSION['login'])){
session_destroy();
echo '<script languaje="Javascript">location.href="login.php?pag=variables.php"</script>';
exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Variables de la Nomina</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="311" border="1" align="center">
    <tr>
      <td width="85"><strong>C&oacute;digo</strong></td>
      <td width="210"><span id="sprytextfield1">
      <input name="codigo" type="text" id="codigo" size="10" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td><strong>Descripci&oacute;n</strong></td>
      <td><span id="sprytextfield2">
        <input name="descripcion" type="text" id="descripcion" size="35" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Abreviatura</strong></td>
      <td><span id="sprytextfield3">
        <input name="abreviatura" type="text" id="abreviatura" size="10" maxlength="5" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Valor</strong></td>
      <td><span id="sprytextfield4">
        <input type="text" name="valor" id="valor" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td align="center"><a href="constantes.php"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
      </span></a><a href="visualizar_integrantes.php"></a></td>
    </tr>
  </table>
</form>

<?php 
include 'includes/miclase.php';
$link=conectarse("nomina");
if (isset($_POST['guardar']))//si presiona el boton guardar  
        {
			$objeto = new miclase();
			if($objeto->insertar_variables($_POST['codigo'],$_POST['descripcion'],strtolower($_POST['abreviatura']),$_POST['valor'],$link)==true)
		   	{
				abrir_popup("mensaje.php?texto=Inserto Correctamente la Variable&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				}
			else
				{
			   $error= mysql_error($link);
				abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");//.mysql_error());
				}
		  }
?>
<?php
$result=mysql_query('select * from variables',$link);
?>
<table width="600" border="1" align="center">
  <tr>
    <td width="50"><strong>C&oacute;digo</strong></td>
    <td width="272"><strong>Descripci&oacute;n</strong></td>
    <td width="75"><strong>Abreviatura</strong></td>
    <td width="67"><strong>Valor</strong></td>
    <td width="102"><strong>Acci&oacute;n</strong></td>
  </tr>
  <?php while($variables=mysql_fetch_array($result)){ ?>
  <tr>
    <td><?php echo $variables['cod']; ?></td>
    <td><?php echo $variables['descripcion']; ?></td>
    <td><?php echo $variables['abreviatura']; ?></td>
    <td><?php echo $variables['valor']; ?></td>
    <td><a href="includes/borrar_variables.php?id=<?php echo $variables['cod']?>">Eliminar</a> <a href="editar_variables.php?id=<?php echo $variables['id']; ?>">Editar</a></td>
  </tr>
  <?php }?>
</table>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
//-->
</script>
</body>
</html>
