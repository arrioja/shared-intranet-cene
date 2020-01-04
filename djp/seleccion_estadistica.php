<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Se presentan los diferentes tipos de gráficos disponibles de las estadísticas de DJP
  		Modificado el: 	05/09/2008 por Pedro E. Arrioja M. - Creación
  			  Versión: 	0.2b
     ****************************************************  FIN DE INFO
*/

 session_start();  // se inicia la sesión 
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
<title>Intranet CENE</title>
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
<div align="center">
  <p><span class="datos_formularios">Seleccione el tipo de estad&iacute;stica que desea:</span><br />
    <br />
  </p>
</div>
<table width="392" border="0" align="center" cellpadding="0" cellspacing="10">
  <tr>
    <td align="center"><a href="estadisticas_sexo.php"><img src="../imgs/djp_grafico_pie.jpg" alt="Grafico de tortas" width="150" height="85" border="0" /></a></td>
    <td><a href="estadisticas_tipo.php"><img src="../imgs/djp_grafico_tipo.jpg" alt="Declaraciones por tipo" width="150" height="80" border="0" /></a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="datos_formularios">
    <td align="center">Declarantes por sexo.</td>
    <td>Declaraciones por tipo</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="datos_formularios">
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="datos_formularios">
    <td colspan="4" align="center">&nbsp;<input type="button" name="volver" id="volver" value="Volver" onclick="javascript: history.back()" /></td>
    </tr>
</table>

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
