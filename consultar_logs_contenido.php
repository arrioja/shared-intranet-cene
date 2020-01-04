<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Este es un complemento del archivo consultar_logs, trabajan juntos, alla se selecciona el usuario y la fech ay aqui
  						se muestra la información correspondiente a los parámetros seleccionados.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creación
						28/08/2008 por Pedro E. Arrioja M. - Se añadió colores a las líneas para mejora visual y se ordenó la lista de manera
								   descendiente por el timestamp.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
// Se comprueba que exista el parámetro del POST que debe venir para la consulta y si no viene entonces se envia al navegador a index
// el cual si no tiene sesión iniciada lo enviará a Login.  El principio fundamental es que si el usuario no tiene permiso para correr
// el php que llama a este, entonces éste no tiene porque recibir nada por Post.
// se ha realizado de esta manera por cuanto esta pagina es parte de un proceso mayor y la comprobación de permisos de usuarios sobre
// la misma sería inefectiva porque cualquiera con login podría querer acceder a ella directamente y esto no se debe permitir.
if (!isset($_POST['usr'])) 
  {
	echo '<script languaje="Javascript">location.href="index.php"</script>';
	exit();
  }

 include("libs/utilidades.php");
 $usuario=$_POST['usr'];
 $desde=$_POST['des'];
 $hasta=$_POST['has'];
 include("db/conexion.php");

 $link=conectarse("organizacion"); 
 $link=conectarse("intranet"); 

	    list($dia1,$mes1,$ano1) = explode("/",$desde); 
	    list($dia2,$mes2,$ano2) = explode("/",$hasta);	
		//calculo timestam de las dos fechas
		$t1 = date('Y-m-d H:i:s',mktime(0,0,0,$mes1,$dia1,$ano1));
		$t2 = date('Y-m-d H:i:s',mktime(23,59,59,$mes2,$dia2,$ano2));	

if ($usuario=='*')
  {// si son todos los usuarios							
     $consulta=mysql_query("select u.id, u.cedula, u.login, p.nombres, p.apellidos, r.descripcion, r.timestamp  
 					  	    FROM intranet.usuarios as u, intranet.rastreo as r, organizacion.personas as p
 						    WHERE ((r.timestamp>='$t1') and (r.timestamp<='$t2')) and (u.cedula=r.cedula) and (p.cedula=u.cedula)
						    ORDER BY r.timestamp DESC, p.nombres, p.apellidos",$link) or die(mysql_error());
  }
else
  {// si es un usuario en particular
     $consulta=mysql_query("select u.id, u.cedula, u.login, p.nombres, p.apellidos, r.descripcion, r.timestamp  
 					  	    FROM intranet.usuarios as u, intranet.rastreo as r, organizacion.personas as p
 						    WHERE ((r.timestamp>='$t1') and (r.timestamp<='$t2')) and 
							      (u.cedula=r.cedula) and (u.cedula=$usuario) and (p.cedula=$usuario)
						    ORDER BY r.timestamp DESC, p.nombres, p.apellidos",$link) or die(mysql_error());  
  }


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consulta de actividades en el sistema</title>
<link href="css/formularios.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php 
$color=array("#FFFFFF","#CCFFFF"); // para darle colores alternos a las lineas que muestro
$contador_color=0; // este contador permitira darle la alternabilidad a los colores	
if ($usuario=='*')
  {// si son todos los usuarios
?>
	<table border="1" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td class="encabezado_formularios">C&eacute;dula</td>
		<td class="encabezado_formularios">Nombres y Apellidos</td>
		<td class="encabezado_formularios">Descripción de la Actividad</td>
		<td class="encabezado_formularios">Fecha/Hora</td>
	  </tr>
	  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
	 while($resultado=mysql_fetch_array($consulta)) { ?>
	  <tr bgcolor="<?php echo $color[$contador_color%2]; ?>">
		<td class="datos_formularios"><div align="center"><?php echo $resultado['cedula']; ?></div></td>
		<td class="datos_formularios">&nbsp;<?php echo $resultado['nombres']." ".$resultado['apellidos']; ?>&nbsp;</td>
		<td class="datos_formularios">&nbsp;<?php echo $resultado['descripcion']; ?>&nbsp;</td>
		<td class="datos_formularios"><div align="center"><?php echo $resultado['timestamp']; ?></div></td>
	  </tr>
	  <?php  $contador_color++; }?>
	</table>

<?php 
  }
else
  {// si es un usuario en particular
?>
	<table border="1" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td class="encabezado_formularios">Descripción de la Actividad</td>
		<td class="encabezado_formularios">Fecha/Hora</td>
	  </tr>
	  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
	 while($resultado=mysql_fetch_array($consulta)) { ?>
	  <tr bgcolor="<?php echo $color[$contador_color%2]; ?>">
		<td class="datos_formularios">&nbsp;<?php echo $resultado['descripcion']; ?>&nbsp;</td>
		<td class="datos_formularios"><div align="center"><?php echo $resultado['timestamp']; ?></div></td>
	  </tr>
	  <?php  $contador_color++; }?>
	</table>

<?php  
  }?>
</body>
</html>
