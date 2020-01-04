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
	        exit();
	      }	    
	  }
	else
	  { // si codigo_actual es falso, entonces no hay coincidencias con el nombre del archivo, 
	    // quiere decir que no se ha incluido el modulo en el sistema
	        echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00004"</script>';
	        exit();		
	  }
  }

$result=mysql_query("select * from nomina.constantes",$link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Constantes</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <script type="text/javascript" src="jscalendar/calendar.js"></script>
  <script type="text/javascript" src="jscalendar/lang/calendar-espanol.js"></script>
  <script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
  <script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
  <link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="709" border="1">
    <tr>
      <td colspan="4" align="center"><strong>CONSTANTES</strong></td>
    </tr>
    <tr>
      <td width="93"><strong>C&oacute;digo</strong></td>
      <td width="206"><span id="sprytextfield1">
        <input name="codigo" type="text" id="codigo" size="8" maxlength="4" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">ingrese solo numeros.</span><span class="textfieldMinCharsMsg">Minimo 4 caracteres.</span><span class="textfieldMaxCharsMsg">maximo 4 caracteres.</span></span></td>
      <td width="97"><strong>Descripci&oacute;n</strong></td>
      <td width="241"><span id="sprytextfield2">
        <input name="descripcion" type="text" id="descripcion" size="40" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Abreviatura</strong></td>
      <td><span id="sprytextfield3">
      <input name="abreviatura" type="text" id="abreviatura" size="8" maxlength="6" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td><strong>Tipo</strong></td>
      <td><span id="spryselect1">
        <select name="tipo" id="tipo">
          <option value="CREDITO">CREDITO</option>
          <option value="DEBITO">DEBITO</option>
          <option value="OTRO">OTRO</option>
        </select>
        </span></td>
    </tr>
    <tr>
      <td><strong>Tipo de Pago</strong></td>
      <td><select name="tipo_pago" id="tipo_pago">
        <option value="CORRIENTE">CORRIENTE</option>
        <option value="ESPECIAL">ESPECIAL</option>
      </select>
      <a href="asignacion_constantes_general.php">Asignaci&oacute;n Montos</a> </td>
      <td><strong>Fecha</strong></td>
      <td><input type="text" name="fecha" id="f_date_c" readonly="1" />
          <img src="jscalendar/img.gif" alt="fecha" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td colspan="2" align="center"><a href="visualizar_integrantes.php"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
      </span></a></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

<table width="708" border="1">
  <tr>
    <td width="47"><strong>C&oacute;digo</strong></td>
    <td width="223"><strong>Descripci&oacute;n</strong></td>
    <td width="80"><strong>Abreviatura</strong></td>
    <td width="65"><strong>Tipo</strong></td>
    <td width="56"><strong>Fecha</strong></td>
    <td width="102"><strong>Acci&oacute;n</strong></td>
  </tr>
  <?php while ($constantes=mysql_fetch_array($result)){?>
  <tr>
    <td><?php echo $constantes['cod'];?></td>
    <td><?php echo $constantes['descripcion'];?></td>
    <td><div align="center"><?php echo $constantes['abreviatura'];?></div>    </td>
    <td><?php echo $constantes['tipo'];?></td>
    <td><?php echo cambiaf_a_normal($constantes['fecha']);?></td>
    <td><a href="editar_constantes.php?id=<?php echo $constantes['id'];?>">Editar</a> <a href="includes/borrar_constantes.php?id=<?php echo $constantes['id'];?>">Eliminar</a></td>
  </tr>
  <?php }?>
</table>

<?php
if (isset($_POST['guardar']))//si presiona el boton guardar  
        {
			$objeto = new miclase();
			$fecha=$objeto->cambiaf_a_mysql($_POST['fecha']);
			if($objeto->insertar_constantes($_POST['codigo'],$_POST['descripcion'],$_POST['tipo'],strtolower($_POST['abreviatura']),$fecha,$link)==true)
		   	{
				abrir_popup("mensaje.php?texto=Inserto Correctamente la Constante&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		echo '<script languaje="Javascript">location.href="constantes.php"</script>';//recargar pagina
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"], minChars:4, maxChars:4});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"], isRequired:false});
//-->
</script>
</body>
</html>