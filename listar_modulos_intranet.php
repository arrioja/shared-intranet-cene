<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra un mensaje listado de los módulos registrados en los sistemas de la intranet, los dos primeros 
  						caracteres del código del módulo indican a que sistema pertenecen..
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creación
						04/09/2008 por Pedro E. Arrioja M. - Se añadió comprobación de acceso al módulo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("libs/utilidades.php");
 include("libs/comprueba_permiso.php");
 require("db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 
 $link=conectarse("intranet"); 
 $consulta=mysql_query("select id, codigo_modulo, nombre_largo FROM modulos ORDER BY codigo_modulo",$link) or die(mysql_error());
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Listado de M&oacute;dulos de la Intranet CENE</title>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->

<link href="css/formularios.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="imgs/CENE_07.png">      <div align="right">
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
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" --><br />
      <table width="749" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" class="encabezado_formularios">Listado de M&oacute;dulos de la Intranet</td>
  </tr>
  <tr>
    <td width="82" class="encabezado_formularios">C&oacute;digo</td>
    <td class="encabezado_formularios">Nombre del M&oacute;dulo</td>
    <td colspan="3" class="encabezado_formularios">Acci&oacute;n</td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($consulta)) { ?> 
  <tr>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['codigo_modulo']; ?></div></td>
    <td class="datos_formularios">&nbsp;<?php echo $resultado['nombre_largo']; ?></td>
    <td width="26" valign="top" class="datos_formularios">
      
            <div align="center"><a href="editar_modulos_intranet.php?id=<?php echo $resultado['id'];?>"><img src="imgs/editar.jpg" alt="editar" width="23" height="20" border="0" /></a></div></td>
    <td width="26" valign="top" class="datos_formularios"><div align="center"><a href="db/elimina_modulo_intranet.php?cod=<?php echo $resultado['codigo_modulo'];?>"><img src="imgs/borrar.jpg" alt="Elimina el m&oacute;dulo de la intranet" width="23" height="20" border="0" /></a></div></td>
    </tr>
  <?php }?> 
     <tr>
       <td colspan="5" class="datos_formularios">&nbsp;</td>
     </tr>
     <tr>
    <td colspan="5" class="datos_formularios"><div align="center"><a href="incluir_modulos_intranet.php">Incluir</a> &nbsp;&nbsp;&nbsp;  
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php?sis=<?php echo $_SESSION['sis']; ?>'" />
    </div></td>
  </tr>
</table>
      <br />
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 30 October, 2008 3:03 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
