<?php
   include("includes/miclase.php");
   $link=conectarse("nomina"); 
   $id=$_GET['id'];
   $sql=mysql_query("select * from usuarios where id = '$id'",$link);
   $usuario= mysql_fetch_array($sql);     		 			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="331" border="1" align="center">
    <tr>
      <td width="139">Login</td>
      <td width="176"><span id="sprytextfield1">
        <input type="text" name="login" id="login" value="<?php echo $usuario['login'];?>" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><span id="sprytextfield2">
        <input type="password" name="password" id="password" value="<?php echo $usuario['password']; ?>" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Confirmar Password</td>
      <td><span id="sprytextfield3">
        <input type="password" name="confirm_password" id="confirm_password" value="<?php echo $usuario['password']; ?>" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Tipo de Usuario</td>
      <td><span id="spryselect1">
        <select name="privilegios" id="privilegios">
          <option value="1"<?php if ($usuario['privilegios']=='1') echo 'selected="selected"'?>>ADMINISTRADOR</option>
          <option value="2"<?php if ($usuario['privilegios']=='2') echo 'selected="selected"'?>>USUARIO</option>
        </select>
        <span class="selectRequiredMsg">Please select an item.</span></span></td>
    </tr>
    <tr>
      <td align="right"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td><a href="usuarios.php">Volver</a></td>
    </tr>
          </table>
</form>
<?php  
       if (isset($_POST['guardar']))//si presiona el boton guardar  
        {
		   $objeto = new miclase();			
			if ($objeto->editar_usuarios($_POST['login'],$_POST['password'],$_POST['privilegios'],$id,$link)==true)
				{
				abrir_popup("mensaje.php?texto=Edito Correctamente el Usuario&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				echo '<script languaje="Javascript">location.href="usuarios.php"</script>';
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
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>
</body>
</html>
