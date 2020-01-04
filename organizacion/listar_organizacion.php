<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Paúl González y Rosanny Yáñez
  Descripción General:  Muestra un listado de las organizaciones
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. Se modificaron las rutas de acceso para trabajar con la intranet y los nombres
														   de las bases de datos, así como los Css.
						05/09/2008 por Pedro E. Arrioja M. Se añade comprobación de acceso a módulo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 $link=conectarse("organizacion");

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


<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
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

<p></p>
<form id="form1" name="form1" method="post" action="insertar_organizacion.php">
  <table width="535" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="3">Listado de Organizaciones</td>
    </tr>
    <tr>
      <td width="92" class="encabezado_formularios">C&oacute;digo</td>
      <td width="367" class="encabezado_formularios">Nombre</td>
      <td width="48" class="encabezado_formularios">Editar</td>
    </tr>
    <?php 
	 $resultado=mysql_query("select * from organizacion.organizaciones order by nombre",$link);
	 while ($row=mysql_fetch_array($resultado)){?>
    <tr>
      <td class="datos_formularios"><div align="center"><?php echo $row[1] ?></div></td>
      <td class="datos_formularios">&nbsp;<?php echo $row[2] ?></td>
      <td class="datos_formularios"><div align="center"><a href="modifica_organizacion.php?codigo_organizacion=<?php echo $row[1] ?>"><img src="../imgs/edit.png" width="16" height="16" border="0"  title="Editar Organización"/></a></div></td>
    </tr>
    <?php }?>
    <tr>
      <td colspan="3" class="datos_formularios"><div align="right">
        <input type="button" name="todos2" id="todos2" value="Volver" onclick="javascript: location.href='index.php'" />
        &nbsp;&nbsp;
        <input type="submit" name="insertar" id="insertar" value="Insertar Organizacion" />
      </div></td>
    </tr>
  </table>
  <p>
    <label>
  </label>

</form>
<p>&nbsp;</p>
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
