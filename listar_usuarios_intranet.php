<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra un listado de los usuarios que se encuentran inscritos en la intranet, además muestra su estatus
  						su es rojo esta deshabilitado y si es verde esta habilitado, cambia haciendole click en el mismo indicador.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						28/08/2008 por Pedro E. Arrioja M. - Mejoras Visuales. se le añadió color y se ajustó ancho de columnas
						04/09/2008 por Pedro E. Arrioja M. - Se añade comprobación de acceso al módulo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/

  session_start();  // se inicia la sesión 
 include("libs/utilidades.php");
 include("libs/comprueba_permiso.php");
 require("db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 
 $link=conectarse("intranet"); 

if (isset($_GET['id']) == true) 
{ // si el id viene en el url, entonces el usuario ha seleccionado a un usuario para activar/desactivar.
  $id=$_GET['id'];
  $activo=$_GET['activo'];  
  $actualiza=mysql_query("update intranet.usuarios set activo='$activo' where id='$id'",$link) or die(mysql_error());
  header ("Location: listar_usuarios_intranet.php", true); 
}
 
 $consulta=mysql_query("select u.*, p.nombres, p.apellidos  
 						FROM intranet.usuarios as u, organizacion.personas as p
						WHERE (u.cedula=p.cedula)
						ORDER BY p.nombres, p.apellidos",$link) or die(mysql_error());
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Listado de Usuarios de la Intranet CENE</title>
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
      <table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" class="encabezado_formularios">Listado de Usuarios de la Intranet</td>
  </tr>
  <tr>
    <td width="82" class="encabezado_formularios">C&eacute;dula</td>
    <td class="encabezado_formularios">Nombres y Apellidos</td>
    <td width="82" class="encabezado_formularios">Login</td>
    <td class="encabezado_formularios">E-mail</td>
    <td colspan="3" class="encabezado_formularios">Acci&oacute;n</td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
       $color=array("#FFFFFF","#CCFFFF"); // para darle colores alternos a las lineas que muestro
       $contador_color=0; // este contador permitira darle la alternabilidad a los colores		
 while($resultado=mysql_fetch_array($consulta)) { ?> 
  <tr bgcolor="<?php echo $color[$contador_color%2]; ?>">
    <td class="datos_formularios"><div align="center"><?php echo $resultado['cedula']; ?></div></td>
    <td class="datos_formularios">&nbsp;<?php echo $resultado['nombres']." ".$resultado['apellidos']; ?></td>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['login']; ?></div></td>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['email']; ?></div>      <div align="center"></div></td>
    <td width="32" valign="top" class="datos_formularios">
      
            <div align="center">
              <?php if ($resultado['activo'] == "S") { echo '<a href="listar_usuarios_intranet.php?id='.$resultado['id'].'&activo=N"><img src="imgs/led_verde_p.png" alt="Activo (Click para desactivar)" width="24" height="24" border="0" />';} else {echo '<a href="listar_usuarios_intranet.php?id='.$resultado['id'].'&activo=S"><img src="imgs/led_rojo_p.png" alt="Inactivo (Click para activar)" width="24" height="24" border="0" />';}?>
            </div></td>
    <td width="35" valign="top" class="datos_formularios"><div align="center"><a href="vincular_usuario_grupos.php?login=<?php echo $resultado['login'] ?>"><img src="imgs/add_group.png" alt="Modificar los grupos a los que pertenece el usuario" width="24" height="24" border="0" /></a></a></div></td>
    <td width="32" valign="top" class="datos_formularios"><div align="center"><a href="consultar_logs.php?cedu=<?php echo $resultado['cedula']; ?>"><img src="imgs/log.png" alt="Log" width="24" height="24" border="0" /></a></div></td>
  </tr>
  <?php $contador_color++; } // del while ?> 
     <tr>
       <td colspan="7" class="datos_formularios"> PI= Permisos Individuales, ES= Estadisticas de conexion y actividades del usuario</td>
     </tr>
     <tr>
    <td colspan="7" class="datos_formularios"><div align="center"><a href="incluir_usuario_nuevo.php">Incluir</a> &nbsp;&nbsp;&nbsp;  
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
