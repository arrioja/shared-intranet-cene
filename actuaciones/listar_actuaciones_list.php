<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  este archivo es un complemento de listar_actuaciones.php y muestra una lista de las actuaciones dependiendo del
  						tipo de ente y órgano seleccionado y del año.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						05/11/2008 por Pedro E. Arrioja M. Se incluye columna de dias de prórroga de la actuación fiscal
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
// $cedula=$_POST['cedula'];
$tip=$_GET['tipo'];
$anio=$_GET['anio'];
 include("../db/conexion.php");
 include("../libs/utilidades.php");
// $link=conectarse("intranet");  
 $link=conectarse("asistencias"); 

/*if (isset($_GET['id']) == true) 
{ // si el id viene en el url, entonces el usuario ha seleccionado a un usuario para activar/desactivar.
  $id=$_GET['id'];
  $activo=$_GET['activo'];  
  $actualiza=mysql_query("update intranet_usuarios set activo='$activo' where id='$id'",$link) or die(mysql_error());
  header ("Location: listar_usuarios_intranet.php", true); 
}*/
 
 $consulta=mysql_query("SELECT a.id, a.oficio, a.dias_habiles, a.dias_prorroga, a.desde, a.hasta, e.nombre  
 						FROM actuaciones as a,entes_organos as e 
 						WHERE ((a.codigo_ente_organismo=e.codigo) and 
						(e.tipo='$tip') and
						(a.desde LIKE '$anio%'))
						ORDER BY desde DESC,oficio",$link) or die(mysql_error());
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Listado de Actuaciones Fiscales</title>

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
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="749" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
          <td width="75" class="encabezado_formularios"># Oficio</td>
      <td width="364" class="encabezado_formularios">Nombre del Ente u &Oacute;rgano</td>
      <td width="38" class="encabezado_formularios">Dias</td>
      <td width="81" class="encabezado_formularios">Pr&oacute;rroga</td>
      <td width="81" class="encabezado_formularios">Inicio</td>
      <td width="87" class="encabezado_formularios">Fin</td>
      <td colspan="4" class="encabezado_formularios">Opciones</td>
    </tr>
        <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($consulta)) { ?>
        <tr>
          <td class="datos_formularios"><div align="center"><?php echo $resultado['oficio']; ?></div></td>
      <td class="datos_formularios">&nbsp;<?php echo $resultado['nombre']; ?>
        <div align="center"></div>
        <div align="center"></div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['dias_habiles']; ?></div>        </td>
      <td align="center" class="datos_formularios"><?php echo $resultado['dias_prorroga']; ?></td>
      <td class="datos_formularios"><div align="center"><?php echo cambiaf_a_normal($resultado['desde']); ?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo cambiaf_a_normal($resultado['hasta']); ?></div></td>
      <?php 
	    if ($resultado['desde'] < date("Y-m-d") ) 
	//	  if ($resultado['desde'] > date("Y-m-d") )  para el definitivo, quitar la anterior y dejar esta
	      { 
	  ?>
		              <td width="23" valign="top" class="datos_formularios" align="center"><div align="center">
                      <a href="editar_actuacion.php?id=<?php echo $resultado['id'];?>"><img src="../imgs/editar.jpg" alt="editar" width="23" height="20" border="0" /></a></div></td>
                      <td width="24" valign="top" class="datos_formularios"><div align="center">
                      <a href="vincular_funcionario_actuacion.php?oficio=<?php echo $resultado['oficio'] ?>">
                      <img src="../imgs/add_group.png" alt="Añadir Auditores a la Comision" width="24" height="24" border="0" /></a></div></td>
                      <td width="15" valign="top" class="datos_formularios"><div align="center">
                      <img src="../imgs/led_rojo_p.png" alt="Estatus: POR EJECUTAR" width="24" height="24" /></div></td>  
         <?php
	      }
		else // Este es el 1er Else
		  {
		    if (($resultado['desde'] <= date("Y-m-d")) && ( $resultado['hasta'] >= date("Y-m-d"))) 
	          {?>
		        <td align="center" colspan="2"><div align="center"><img src="../imgs/led_amarillo_p.png" alt="Estatus: EN EJECUCION" width="24" height="24" /></div></td><td width="35" valign="top" class="datos_formularios"><div align="center">
                      <a href="vincular_funcionario_actuacion.php?oficio=<?php echo $resultado['oficio'] ?>">
                      <img src="../imgs/add_group.png" alt="Añadir Auditores a la Comision" width="24" height="24" border="0" /></a></div></td>
	         <?php }
			else // Este es el 2do else
			  {	
		        if ($resultado['hasta'] < date("Y-m-d"))     
	              { 
				    echo '<td align="center" colspan="3"><div align="center"><img src="../imgs/led_verde_p.png" alt="Estatus: EJECUTADO" width="24" height="24" /></div></td>';       
	              }
               } // del 2do else     
	   } // del primer else
	   ?>
    </tr>
        <?php }?>
        <tr valign="top">
          <td colspan="10" class="datos_formularios">&nbsp;</td>
  </tr>
      </table>
</body>
</html>
