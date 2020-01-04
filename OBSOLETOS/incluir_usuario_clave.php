<?php 
 $cedula=$_POST['cedula'];
 include("db/conexion.php");
 $link=conectarse("personal");  
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
// mysql_select_db("personal");
 
 $consulta=mysql_query("select id, cedula, nombres, apellidos from integrantes where cedula='$cedula'",$link) or die(mysql_error());
 $resultado=mysql_fetch_array($consulta);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Nuevo Usuario</title>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(../imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->


<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<link href="css/formularios.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="../imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="../imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="../imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="../imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="../imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="../imgs/CENE_07.png">      <div align="right">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="vinculos"><div align="left">Usuario: <?php if (isset($_SESSION['nombres'])) { echo $_SESSION['apellidos']." ".$_SESSION['nombres']; } else {echo " Sin sesi&oacute;n iniciada";}?></div></td>
            <td><div align="right"><span class="vinculos"><a href="index.php" class="vinculos">Inicio</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="login.php" class="vinculos">Salir</a>&nbsp;&nbsp;</span></div></td>
          </tr>
        </table>
        </div></td>
  </tr>
  <tr>
    <td valign="top"><!-- InstanceBeginEditable name="menu_izquierda" --><!-- InstanceEndEditable -->    </td>
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" -->
<br />
<?php 
	if (mysql_num_rows($consulta) == 0) // la consulta no tiene resultados, por lo tanto la cedula no existe en nomina
  		{
			echo " La C&eacute;dula que ha introducido no se encuentra en nuestros registros, 
			int&eacute;ntelo de nuevo; si el error persiste y est&aacute; seguro que la c&eacute;dula es correcta, 
			contacte al soporte t&eacute;cnico de la Direcci&oacute;n de Sistemas para tomen las previsiones y lo corrijan oportunamente.";
			?>
			 <br />	<br />
             <?php 
			echo " Para volver haga click "?> <a href="incluir_usuario_cedula.php">aqui</a>
  <?php
		}
	else
		{ // si la consulta tiene por lo menos un registro como resultado, ahora se comprueba que no este tegistrado como usuario ya.
?> 

<?php 
// se abre otra conexión ahora para saber si la cedula ya se encuentra registrada como usuario o no
 //	$link2=conectarse("intranet");  
 	$consulta_usuario=mysql_query("select * from intranet_usuarios where cedula='$cedula'",$link) or die(mysql_error());
 	$resultado_usuario=mysql_fetch_array($consulta);
	if (mysql_num_rows($consulta_usuario) == 1) // si la consulta tiene resultados, quiere decir que el usuario ya existe
  		{
			echo " La C&eacute;dula que ha introducido ya se encuentra registrado como usuario(a) de la intranet de la Contralor&iacute;a, 
			si considera que esta informaci&oacute;n es incorrecta, contacte al soporte t&eacute;cnico de la Direcci&oacute;n de Sistemas 
			para tomen las previsiones y lo corrijan oportunamente.";
			?>
			 <br />	<br />
             <?php 
			echo " Para volver haga click "?> <a href="incluir_usuario_cedula.php">aqui</a>
  <?php
		}
	else
		{ // si la consulta tiene por lo menos un registro como resultado, ahora se comprueba que no este tegistrado como usuario ya.
?> 

<form id="form1" name="form1" method="post" action="db/inserta_usuario.php">
  <p>&nbsp;</p>
  <table width="618" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" class="encabezado_formularios">Datos del Nuevo Usuario</td>
    </tr>
    <tr>
      <td width="173" class="titulos_formularios">C&eacute;dula:&nbsp;</td>
      <td width="439" class="datos_formularios">&nbsp;<?php echo $resultado['cedula']; ?>
      <input name="cedula_oculta" type="hidden" id="cedula_oculta" value="<?php echo $cedula; ?>" />
      <input name="id_oculto" type="hidden" id="id_oculto" value="<?php echo $resultado['id']; ?>" /></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Apellidos y Nombres:&nbsp;</td>
      <td class="datos_formularios">&nbsp;<?php echo $resultado['apellidos'].' '.$resultado['nombres']; ?></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Login:&nbsp;</td>
      <td class="datos_formularios"><span id="sprytextfield1">
        <input type="text" name="login" id="login" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Clave:&nbsp;</td>
      <td class="datos_formularios"><span id="sprytextfield2">
      <input name="clave" type="password" id="clave" maxlength="10" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldMinCharsMsg">M&iacute;nimo seis (6) caracteres.</span><span class="textfieldMaxCharsMsg">M&aacute;ximo 50 caracteres.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Confirmaci&oacute;n:&nbsp;</td>
      <td class="datos_formularios"><span id="sprytextfield3">
      <input name="conf" type="password" id="conf" maxlength="10" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldMinCharsMsg">M&iacute;nimo seis (6) caracteres.</span><span class="textfieldMaxCharsMsg">M&aacute;ximo 50 caracteres.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">e-mail:&nbsp;</td>
      <td class="datos_formularios"><span id="sprytextfield4">
      <input name="email" type="text" id="email" size="40" maxlength="50" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">E-mail no v&aacute;lido.</span></span></td>
    </tr>
    <tr>
      <td colspan="2" align="right"><input type="submit" name="button" id="button" value="Incluir usuario" />
      <input type="reset" name="button2" id="button2" value="Limpiar formulario" />
      <span class="datos_formularios">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='incluir_usuario_cedula.php'" />
      </span></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"], minChars:6, maxChars:50});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"], minChars:6, maxChars:50});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
//-->
</script>

<?php 
} // con esto se cierra la llave de la comprobación de que el usuario de la intranet exista, si no, simplemente aparece un mensaje de error.
?>

<?php 
} // con esto se cierra la llave de la comprobación de que la consulta haya traido resultado, el efecto es que si trae resultado, 
  // el formulario se muestra, si no, simplemente aparece un mensaje de error.
?>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 21 August, 2008 12:13 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
