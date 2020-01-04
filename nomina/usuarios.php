<?php
   include("includes/miclase.php");
   $link=conectarse("nomina");
   $result=mysql_query("select * from usuarios order by id asc",$link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Usuarios</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="331" border="1" align="center">
    <tr>
      <td width="149"><strong>Login:</strong></td>
      <td width="166"><span id="sprytextfield1">
        <input type="text" name="login" id="login" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Password:</strong></td>
      <td><span id="sprytextfield2">
        <input type="password" name="password" id="password" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Confirmar Password:</strong></td>
      <td><span id="sprytextfield3">
      <input type="password" name="text1" id="text1" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Tipo de Usuario:</strong></td>
      <td><span id="spryselect1">
        <select name="privilegios" id="privilegios">
          <option value="1" selected="selected">ADMINISTRADOR</option>
          <option value="2">USUARIO</option>
        </select>
      </span></td>
    </tr>
    <tr>
      <td align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td align="center"><a href="visualizar_integrantes.php"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
      </span></a></td>
    </tr>
  </table>
</form>
<table width="446" border="1" align="center">
  <tr>
    <td width="116"><strong>Login</strong></td>
    <td width="164"><strong>Privilegios</strong></td>
    <td width="144"><strong>Acci&oacute;n</strong></td>
  </tr>
  <?php while($usuario=mysql_fetch_array($result)){?>
  <tr>
    <td><?php echo $usuario['login'];?></td>
    <td><?php if ($usuario['privilegios']=='1')echo 'ADMINISTRADOR'; else if($usuario['privilegios']=='2') echo 'USUARIO'; ?></td>
    <td><a href="editar_usuarios.php?id=<?php echo $usuario['id'];?>">Editar</a> <a href="includes/borrar_usuarios.php?id=<?php echo $usuario['id'];?>">Eliminar</a></td>
  </tr>
  <?php }?>
</table>
<?php       
       if (isset($_POST['guardar']))//si presiona el boton guardar  
        {
		   $objeto = new miclase();
			
			if ($objeto->insertar_usuario($_POST['login'],$_POST['password'],$_POST['privilegios'],$link)==true)
				{
				abrir_popup("mensaje.php?texto=Inserto Correctamente el Usuario&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				echo '<script languaje="Javascript">location.href="usuarios.php"</script>';
				}
			else
				{
				$error= mysql_error($link);
				abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				} 
			mysql_close($link);			
			}
?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {isRequired:false});
//-->
</script>
</body>
</html>