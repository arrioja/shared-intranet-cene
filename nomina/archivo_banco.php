<?php 
session_start();
include "includes/miclase.php";
$link=conectarse("nomina");
$php_actual = solo_nombre_arch($_SERVER["SCRIPT_NAME"]);
if (!isset($_SESSION['login']))  // si "login" no existe, no hay sesión iniciada y se envia al login para ingresar autenticar
  {
	session_destroy();
	echo '<script languaje="Javascript">location.href="../login.php?pag='.'nomina/'.$php_actual.'"</script>';
	exit();
  }
else
  {  // si la sesión y el login existen, ahora se comprueba que el usuario tenga acceso a este módulo
    include("../libs/comprueba_permiso.php"); 
	$codigo_actual=codigo_modulo($php_actual);
	if ($codigo_actual!=false) 
	  { // si codigo actual no es falso entonces trajo resultado, asi que se continua
	    // en esta función se debe pasar como parámetro el login del usuario que se trae desde el sesion y el 
	    //código del módulo asignado al momento de insgribirlo en el sistema mediante la página de administración de módulos
	    if (tiene_permiso($_SESSION['login'],$codigo_actual) == false )
	      {
	        echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00003"</script>';
	        exit;
	      }	    
	  }
	else
	  { // si codigo_actual es falso, entonces no hay coincidencias con el nombre del archivo, 
	    // quiere decir que no se ha incluido el modulo en el sistema
	        echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00004"</script>';
	        exit;		
	  }
  }?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Generar Archivo del  Banco</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<?php
if (isset($_POST['volver']))
	{
	echo '<script languaje="Javascript">location.href="visualizar_integrantes.php"</script>';
	}

 if(isset($_POST['crear']))
	{
	$nombre=$_POST['nombre'];
	$tipo=$_POST['tipo_nomina'];
	echo '<script languaje="Javascript">location.href="upload.php?nombre='.$nombre.'&tipo='.$tipo.'"</script>';
	}
?>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="390" border="1" align="center">
    <tr>
      <td colspan="2"><div align="center"><strong>Generar un Archivo de Texto a Partir de la N&oacute;mina Actual Creada</strong></div></td>
    </tr>
    <tr>
      <td align="right"><strong>Seleccione el Tipo Nomina</strong></td>
      <td align="left"><select name="tipo_nomina" id="tipo_nomina">
        <option value="EMPLEADOS" <?php if ($_POST['ver_nomina']=='EMPLEADOS') echo "selected='selected'"?>>EMPLEADOS</option>
        <option value="DIRECTORES" <?php if ($_POST['ver_nomina']=='DIRECTORES') echo "selected='selected'"?>>DIRECTORES</option>
        <option value="JUBILADOS" <?php if ($_POST['ver_nomina']=='JUBILADOS') echo "selected='selected'"?>>JUBILADOS</option>
        <option value="PENSIONADOS" <?php if ($_POST['ver_nomina']=='PENSIONADOS') echo "selected='selected'"?>>PENSIONADOS</option>
        <option value="TODOS" <?php if ($_POST['ver_nomina']=='TODOS') echo "selected='selected'"?>>TODOS</option>
      </select></td>
    </tr>
    <tr>
      <td width="180" align="right"><strong>Nombre del Archivo</strong>&nbsp;</td>
      <td width="194" align="left"><span id="sprytextfield1">
        <input name="nombre" type="text" id="nombre" size="30" maxlength="40" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="crear" id="crear" value="Generar" />
        <label><a href="visualizar_integrantes.php"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
      </span></a></label></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>
</body>
</html>
