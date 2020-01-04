<?php 
/** 
* Conceptos de la nomina
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

include("renderformula/class.formel.php");
$result=mysql_query("select * from nomina.conceptos",$link);

?>
<?php
$formula=$_POST["formula"];
$codigo=$_POST["codigo"];
$descripcion=$_POST["descripcion"];
$tipo=$_POST["tipo"];
$general=$_POST["general"];
$frecuencia=$_POST["frecuencia"];
if($_POST["formula"]!="") {
	$FP = new formel();
	$im  = $FP->getImage($_POST["formula"]); 
	imagePng($im, "renderformula/formel.png");	
	/*echo '<script languaje="Javascript">location.href="conceptos.php"</script>';
	//echo "<script>parent.document.getElementById('image').src='renderformula/formel.png?x=".time()."';</script>";	*/
	//exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Conceptos</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" /></head>

<body>
<form action="conceptos.php" method="post" name="form1" id="form1">
  <table width="740" border="1" align="center">
    <tr>
      <td width="61">C&oacute;digo</td>
      <td width="317"><span id="sprytextfield1">
      <input name="codigo" type="text" id="codigo" size="8" maxlength="4" value="<?php echo $codigo; ?>" />
      <span class="textfieldRequiredMsg">ingrese un valor</span><span class="textfieldMinCharsMsg">El codigo debe tener 4 digitos.</span><span class="textfieldMaxCharsMsg">Exede el limite maximo de caracteres.</span><span class="textfieldInvalidFormatMsg">Formato invalido</span></span></td>
      <td width="139">Descripci&oacute;n</td>
      <td width="195"><span id="sprytextfield2">
        <input name="descripcion" type="text" id="descripcion" size="40" value="<?php echo $descripcion;?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Tipo</td>
      <td><span id="spryselect1">
        <select name="tipo" id="tipo">
       <OPTION VALUE="CREDITO" <?php if ($tipo=='CREDITO') echo 'selected="selected"';?> >CREDITO</OPTION> 
       <OPTION VALUE="DEBITO"<?php if ($tipo=='DEBITO') echo 'selected="selected"';?>>DEBITO</OPTION>
        </select>
      </span></td>
      <td>F&oacute;rmula</td>
      <td><span id="sprytextfield3">
        <input name="formula" type="text" id="formula" size="40" value="<?php echo $formula;?>" onblur="sendFormel();" />
      <span class="textfieldRequiredMsg">A value is required.</span></span><img src="renderformula/formel.png?x=<?php echo time();?>" name="image" id="image"></td>
    </tr>
    <tr>
      <td>General</td>
      <td><span id="spryselect2">
        <select name="general" id="general">
       <OPTION VALUE="0" <?php if ($general=='0') echo 'selected="selected"';?>>NO</OPTION> 
       <OPTION VALUE="1" <?php if ($general=='1') echo 'selected="selected"';?>>SI</OPTION>
        </select>
      </span></td>
      <td>Frecuencia</td>
      <td><span id="spryselect3">
        <select name="frecuencia" id="frecuencia">
        <OPTION VALUE="SEMANAL"<?php if ($frecuencia=='SEMANAL') echo 'selected="selected"';?>>SEMANAL</OPTION> 
       <OPTION VALUE="QUINCENAL" <?php if ($frecuencia=='QUINCENAL') echo 'selected="selected"';?>>QUINCENAL</OPTION>
       <OPTION VALUE="MENSUAL"<?php if ($frecuencia=='MENSUAL') echo 'selected="selected"';?>>MENSUAL</OPTION> 
       <OPTION VALUE="TRIMESTRAL"<?php if ($frecuencia=='TRIMESTRAL') echo 'selected="selected"';?>>TRIMESTRAL</OPTION>
       <OPTION VALUE="SEMESTRAL"<?php if ($frecuencia=='SEMESTRAL') echo 'selected="selected"';?>>SEMESTRAL</OPTION> 
       <OPTION VALUE="ANUAL"<?php if ($frecuencia=='ANUAL') echo 'selected="selected"';?>>ANUAL</OPTION> 
        </select>
      </span></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td colspan="2" align="center"><a href="visualizar_integrantes.php"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
      </span></a></td>
    </tr>
    <tr>
      <td colspan="4" align="center"><a href="constantes_disponibles.php" target="_blank">Ver Constantes Disponibles</a></td>
    </tr>
  </table>
</form>

<a href="constantes_disponibles.php" target="_blank"></a>
<table width="739" border="1" align="center">
  <tr>
    <td width="51"><strong>C&oacute;digo</strong></td>
    <td width="192"><strong>Descripci&oacute;n</strong></td>
    <td width="176"><strong>Formula</strong></td>
    <td width="63"><strong>Tipo</strong></td>
    <td width="81"><strong>Frecuencia</strong></td>
    <td width="136"><strong>Acci&oacute;n</strong></td>
  </tr>
  <?php while ($conceptos=mysql_fetch_array($result)){?>
  <tr>
    <td><?php echo $conceptos['cod'];?></td>
    <td><?php echo $conceptos['descripcion'];?></td>
    <td><?php echo $conceptos['formula'];?></td>
    <td><?php echo $conceptos['tipo'];?></td>
    <td><?php echo $conceptos['frecuencia'];?></td>
    <td><a href="editar_conceptos.php?id=<?php echo $conceptos['id'];?>">Editar</a> <a href="includes/borrar_conceptos.php?id=<?php echo $conceptos['id'];?>"> Eliminar</td>
  </tr>
  <?php }?>
</table>
<?php
if (isset($_POST['guardar']))//si presiona el boton guardar  
        {
			$objeto = new miclase();
			if ($objeto->insertar_conceptos($_POST['codigo'],$_POST['descripcion'],$_POST['tipo'],strtolower($_POST['formula']),$_POST['general'],$_POST['frecuencia'],$link))
			{
			abrir_popup("mensaje.php?texto=Inserto Correctamente el Concepto&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
			echo '<script languaje="Javascript">location.href="conceptos.php"</script>';//recargar pagina
			}else
			{$error= mysql_error($link);
				abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
			}
			mysql_close($link);  
		   }	
?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"], minChars:4, maxChars:4});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"], isRequired:false});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"], isRequired:false});
//-->
</script>
<script>
var sendCount=0;
function doSend() {
	// {{{
	if(sendCount>0) {
		sendCount--;
		if(sendCount==0) {
			document.form1.submit();//llamar propiedad submit
			sendCount=0;
		}
	}
	setTimeout("doSend()", 100);
	// }}}
}
setTimeout("doSend()", 100);

function sendFormel() {
	// {{{
	sendCount=5;
	// }}}
}
</script>
</body>
</html>