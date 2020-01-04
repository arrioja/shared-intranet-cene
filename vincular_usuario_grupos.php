<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Vincula a los usuarios registrados con el grupo al cual pertenece para tener sus privilegios y accesos.
  Última modificación: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
  session_start();
 include("db/conexion.php");
 $link=conectarse("intranet"); 
 if (isset($_GET['codigo']))
 {
   $codigo=$_GET['codigo'];
   if (isset($_GET['id2']))
     { // se elimina del registro
	   $id2=$_GET['id2'];
	   $eliminar=mysql_query("DELETE FROM usuarios_grupos WHERE id='$id2'");
	   header("Location: vincular_usuario_grupos.php?login=".$_GET['login'], true); 	   
     }
   else
     { // se inserta en el registro
	   $login=$_GET['login'];
	   $insertar=mysql_query("insert into usuarios_grupos(login,codigo) values ('$login','$codigo')");
	   header("Location: vincular_usuario_grupos.php?login=".$_GET['login'], true); 	 
     }
 }
 else
 {  
   $login=$_GET['login'];
   $consulta=mysql_query("SELECT g.id, g.codigo, g.nombre, u.login, u.id as id2
			 			  FROM grupos as g
						  LEFT JOIN usuarios_grupos as u ON g.codigo = u.codigo
						  WHERE (u.login = '$login')",$link) or die(mysql_error());
									  
   $consulta2=mysql_query("SELECT g.id, g.codigo, g.nombre
			 			   FROM grupos as g
						   WHERE (g.codigo not in (SELECT g.codigo
			 			  FROM grupos as g
						  LEFT JOIN usuarios_grupos as u ON g.codigo = u.codigo
						  WHERE (u.login = '$login')))",$link) or die(mysql_error());
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Vincular usuarios a grupos</title>
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
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" -->
<br />
<table width="461" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" class="encabezado_formularios">Grupos a los que pertenece el usuario  <?php echo $login ?>: </td>
  </tr>
  <tr>
    <td width="55" class="encabezado_formularios">C&oacute;digo</td>
    <td width="321" class="encabezado_formularios">Descripci&oacute;n</td>
    <td width="77" class="encabezado_formularios">Vinculado</td>
    </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($consulta)) { ?> 
  <tr>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['codigo']; ?></div></td>
    <td class="datos_formularios">&nbsp;&nbsp;<?php echo $resultado['nombre']; ?></td>
    <td class="datos_formularios"><div align="center"><a href="vincular_usuario_grupos.php?id2=<?php echo $resultado['id2'];?>&codigo=<?php echo $resultado['codigo'];?>&login=<?php echo $login;?>"> <?php if (isset($resultado['id2'])) { echo '<img src="imgs/led_verde_p.png" alt="Vinculado, (Click para desvincular)" width="24" height="24" border="0" />';} else {echo '<img src="imgs/led_rojo_p.png" alt="Desvinculado (Click para vincular)" width="24" height="24" border="0" />';}?></a></a></div></td>
    </tr>
  <?php }?> 
     <tr>
    <td colspan="3" class="datos_formularios"><div align="center">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='listar_usuarios_intranet.php'" /></div></td>
  </tr>
</table>
<br />
<table width="461" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" class="encabezado_formularios">Grupos disponibles: </td>
  </tr>
  <tr>
    <td width="55" class="encabezado_formularios">C&oacute;digo</td>
    <td width="321" class="encabezado_formularios">Descripci&oacute;n</td>
    <td width="77" class="encabezado_formularios">Vinculado</td>
    </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado2=mysql_fetch_array($consulta2)) { ?> 
  <tr>
    <td class="datos_formularios"><div align="center"><?php echo $resultado2['codigo']; ?></div></td>
    <td class="datos_formularios">&nbsp;&nbsp;<?php echo $resultado2['nombre']; ?></td>
    <td class="datos_formularios"><div align="center"><a href="vincular_usuario_grupos.php?codigo=<?php echo $resultado2['codigo'];?>&login=<?php echo $login;?>"> <?php echo '<img src="imgs/led_rojo_p.png" alt="Desvinculado (Click para vincular)" width="24" height="24" border="0" />';?></a></a></div></td>
    </tr>
  <?php }?> 
     <tr>
    <td colspan="3" class="datos_formularios"><div align="center">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='listar_usuarios_intranet.php'" /></div></td>
  </tr>
</table>
    <br />
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
