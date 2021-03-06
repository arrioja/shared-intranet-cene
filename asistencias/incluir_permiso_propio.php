<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  Muestra la c�dula del usuario actual para que pueda solicitar un permiso para s� mismo, este m�dulo es �til para 
  						darle acceso a los funcionarios de mas bajo nivel que no tienen permiso para introdicir un permiso laboral de otro
						funcionario como podr�an hacerlo tal vez un coordinador o un director.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creaci�n
						05/09/2008 por Pedro E. Arrioja M. - Se a�ade comprobaci�n de acceso al m�dulo.
  			  Versi�n: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesi�n 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Solicitar Permiso</title>
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



<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
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
<form id="form1" name="form1" method="post" action="incluir_permiso.php">
  <table width="497" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" bgcolor="#E0DFE3"><div align="center" class="encabezado_formularios">Solicitud de permiso propio del funcionario</div></td>
    </tr>
    <tr>
      <td width="123" bgcolor="#E0DFE3"><div align="right" class="titulos_formularios">C&eacute;dula:&nbsp;</div></td>
      <td width="383" class="datos_formularios"><input name="cedula" type="hidden" id="cedula" value="<?php if (isset($_SESSION['cedula'])) {echo $_SESSION['cedula']; } else {echo "C�dula No Espeficicada";}?>" /><?php if (isset($_SESSION['cedula'])) {echo $_SESSION['cedula']; } else {echo "C�dula No Espeficicada";}?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="datos_formularios">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="datos_formularios"><input type="submit" name="consultar" id="consultar" value="Seleccionar" />
        &nbsp;&nbsp;&nbsp;
        <input type="button" name="volver" id="volver" value="Volver al Inicio" onclick="javascript: location.href='index.php'" /></td>
    </tr>
    </table>
</form>

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
