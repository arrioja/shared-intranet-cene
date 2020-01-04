<?php /** 
* Configuracion de las cuentas bancarias de la institucion
* @versión:       @modificado: 
* @autor: capepo
*
*/
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
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Banco</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="320" border="1" align="center">
    <tr>
      <td width="114"><strong>C&oacute;digo </strong></td>
      <td width="190"><span id="sprytextfield1">
        <input name="codigo" type="text" id="codigo" size="10" maxlength="5" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Nombre</strong></td>
      <td><span id="sprytextfield4">
        <input name="nombre" type="text" id="nombre" size="30" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Descripci&oacute;n</strong></td>
      <td><span id="sprytextfield2">
        <input name="descripcion" type="text" id="descripcion" size="30" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Tipo de Cuenta</strong></td>
      <td><span id="spryselect1">
        <select name="tipo" id="tipo">
        <OPTION VALUE="CORRIENTE">CORRIENTE</OPTION>
        <OPTION VALUE="AHORROS">AHORROS</OPTION>
        <OPTION VALUE="NOMINA">NOMINA</OPTION>
        </select>
      </span></td>
    </tr>
    <tr>
      <td><strong>N&uacute;mero:</strong></td>
      <td><span id="sprytextfield3">
        <input name="numero" type="text" id="numero" size="30" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td align="center"><a href="visualizar_integrantes.php"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
      </span></a></td>
    </tr>
  </table>
</form>
<?php
   
 
  if (isset($_POST['guardar']))//si presiona el boton guardar  
        {
			$objeto = new miclase();
			if ($objeto->insertar_banco($_POST['codigo'],$_POST['descripcion'],$_POST['tipo'],$_POST['numero'],$_POST['nombre'],$link))
			{
			abrir_popup("mensaje.php?texto=Inserto Correctamente el Banco&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
			}else
			{$error= mysql_error($link);
				abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");//.mysql_error());
			}
		   }
?>
<?php 
$result=mysql_query('select * from nomina.banco', $link);
?>

<table width="600" border="1" align="center">
  <tr>
    <td><strong>C&oacute;digo</strong></td>
    <td><strong>Descripci&oacute;n</strong></td>
    <td><strong>Tipo</strong></td>
    <td><strong>N&uacute;mero</strong></td>
    <td><strong>Nombre</strong></td>
    <td><strong>Acci&oacute;n</strong></td>
  </tr>
  <?php while ($banco=mysql_fetch_array($result)){?>
  <tr>
    <td><?php echo $banco['cod']; ?></td>
    <td><?php echo $banco['descripcion']; ?></td>
    <td><?php echo $banco['tipo']; ?></td>
    <td><?php echo $banco['numero']; ?></td>
    <td><?php echo $banco['nombre']; ?></td>
    <td><a href="editar_banco.php?id=<?php echo $banco['id'];?>">Editar</a> <a href="includes/borrar_banco.php?id=<?php echo $banco['id'];?>">Borrar</a></td>
  </tr>
  <?php }?>
</table>
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
