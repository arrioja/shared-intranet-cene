<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Vincula a los grupos de usuarios con los módulos a los cuales debe tener acceso, si no estan vinculado, el grupo no
  						tiene acceso a dicho módulo.
  Última modificación: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/

 session_start();
 include("db/conexion.php");
 $link=conectarse("intranet"); 
 $codigo=$_GET['codigo'];
 $nombre=$_GET['nombre'];
 if (isset($_GET['id2'])) // si viene el id2 es porque quiero eliminar ese vinculo
  { // se elimina del registro
    $id2=$_GET['id2'];
    $eliminar=mysql_query("DELETE FROM permisos_grupos WHERE id='$id2'");
    header("Location: vincular_grupos_modulos.php?codigo=".$codigo."&nombre=".$nombre, true); 	   
  }
 else
  { // si no viene el id2 se comprueba se se quiere insertar o simplemente consultar 
    if (isset($_GET['modulo'])) // si viene "modulo" entonces se quiere vincular con dicho modulo
	  {
	    $modulo=$_GET['modulo'];
        $insertar=mysql_query("insert into permisos_grupos(codigo_grupo,codigo_modulo) values ('$codigo','$modulo')");
        header("Location: vincular_grupos_modulos.php?codigo=".$codigo."&nombre=".$nombre, true); 	 
  	  }
	else
	  { // si no viene "modulo" entonces lo que se quiere es hacer una consulta
        $consulta=mysql_query("SELECT m.id, m.codigo_modulo, m.nombre_largo, g.codigo_grupo, g.id as id2
			 		    	  FROM modulos as m, permisos_grupos as g
						      WHERE ((m.codigo_modulo = g.codigo_modulo) and (g.codigo_grupo='$codigo'))",$link) or die(mysql_error());	  
	    $consulta2=mysql_query("SELECT id,codigo_modulo,nombre_largo from modulos where codigo_modulo not in 
									(SELECT m1.codigo_modulo 
			 		    	  		 FROM modulos as m1, permisos_grupos as g1
						      		 WHERE ((m1.codigo_modulo = g1.codigo_modulo) and (g1.codigo_grupo='$codigo')))",$link) or die(mysql_error());							  
											  
	  }
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
    <td colspan="3" class="encabezado_formularios">El grupo   <?php echo $nombre ?> da acceso a: </td>
  </tr>
  <tr>
    <td width="55" class="encabezado_formularios">C&oacute;digo</td>
    <td width="321" class="encabezado_formularios">Nombre del M&oacute;dulo</td>
    <td width="77" class="encabezado_formularios">Vinculado</td>
    </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($consulta)) { ?> 
  <tr>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['codigo_modulo']; ?></div></td>
    <td class="datos_formularios">&nbsp;&nbsp;<?php echo $resultado['nombre_largo']; ?></td>
    <td class="datos_formularios"><div align="center"><a href="vincular_grupos_modulos.php?codigo=<?php echo $codigo?>&nombre=<?php echo $nombre;?>&id2=<?php echo $resultado['id2'];?>"> <?php if (isset($resultado['id2'])) { echo '<img src="imgs/led_verde_p.png" alt="Vinculado, (Click para desvincular)" width="24" height="24" border="0" />';} else {echo '<img src="imgs/led_rojo_p.png" alt="Desvinculado (Click para vincular)" width="24" height="24" border="0" />';}?></a></a></div></td>
    </tr>
  <?php }?> 
     <tr>
    <td colspan="3" class="datos_formularios"><div align="center">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='listar_grupos_intranet.php'" /></div></td>
  </tr>
</table>
<br />
<table width="461" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" class="encabezado_formularios">M&oacute;dulos Disponibles: </td>
  </tr>
  <tr>
    <td width="55" class="encabezado_formularios">C&oacute;digo</td>
    <td width="321" class="encabezado_formularios">Nombre del M&oacute;dulo</td>
    <td width="77" class="encabezado_formularios">Vinculado</td>
    </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado2=mysql_fetch_array($consulta2)) { ?> 
  <tr>
    <td class="datos_formularios"><div align="center"><?php echo $resultado2['codigo_modulo']; ?></div></td>
    <td class="datos_formularios">&nbsp;&nbsp;<?php echo $resultado2['nombre_largo']; ?></td>
    <td class="datos_formularios"><div align="center"><a href="vincular_grupos_modulos.php?codigo=<?php echo $codigo?>&nombre=<?php echo $nombre;?>&modulo=<?php echo $resultado2['codigo_modulo'];?>"> <?php echo '<img src="imgs/led_rojo_p.png" alt="Desvinculado (Click para vincular)" width="24" height="24" border="0" />';?></a></a></div></td>
    </tr>
  <?php }?>  
     <tr>
    <td colspan="3" class="datos_formularios"><div align="center">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='listar_grupos_intranet.php'" /></div></td>
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
