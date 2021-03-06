<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  este archivo es un complemento de listar_oficios.php y muestra una lista de los oficios dependiendo de la 
  						Direcci�n y el a�o seleccionado.
  		Modificado el: 	28/08/2008 por Pedro E. Arrioja M - Creaci�n.
						11/09/2008 por Pedro E. Arrioja M. - Se a�ade la fecha del oficio al listado.
  			  Versi�n: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 $dir=$_GET['tipo'];
 $anio=$_GET['anio'];
 include("../db/conexion.php");
 include("../libs/utilidades.php");
 $link=conectarse("organizacion");
 $consulta=mysql_query("SELECT m.*, d.nombre_completo 
   						FROM oficios m, direcciones d
 						WHERE ((m.direccion='$dir') and 
						       (m.ano='$anio') and
							   (m.direccion=d.codigo))
						ORDER BY m.correlativo DESC",$link) or die(mysql_error());
 if (mysql_num_rows($consulta) > 0) 
   {						
     $resultado=mysql_fetch_array($consulta);
     // para ingresar marca de auditoria.   
     include("../db/inserta_rastreo.php");
     $descripcion="Consulta Listado de Oficios de: ".$resultado['nombre_completo'];
     $ip = $REMOTE_ADDR; 
     inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'C',$descripcion,$ip);	
     mysql_data_seek($consulta, 0);
   };
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Listado de Oficios</title>

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
-->

</style>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>
<body>

<?php if (mysql_num_rows($consulta) == 0) {
     echo '<p class="datos_formularios" class="style1">No Hay oficios disponible para la Direcci&oacute;n y a&ntilde;o seleccionados</p>';}
  else
  {?>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
          <td class="encabezado_formularios"># Oficio</td>
         <td class="encabezado_formularios">Fecha</td>
      <td class="encabezado_formularios">Destinatario</td>
    <td class="encabezado_formularios">Asunto</td>
      <td class="encabezado_formularios">Solicitante</td>
  </tr>
        <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla		
       $color=array("#FFFFFF","#CCFFFF"); // para darle colores alternos a las lineas que muestro
	   $rojo="#FF0000";
       $contador_color=0; // este contador permitira darle la alternabilidad a los colores			
 while($resultado=mysql_fetch_array($consulta)) { ?>
        <tr bgcolor="<?php if ($resultado['status'] == 2) {echo $rojo;} else {echo $color[$contador_color%2];} ?>">
          <td class="datos_formularios"><div align="center"><?php echo $resultado['siglas']."-".$resultado['correlativo']."-".$resultado['ano']; ?></div></td>
            <td class="datos_formularios"><div align="center">&nbsp;<?php echo cambiaf_a_normal($resultado['fecha']); ?>&nbsp;</div></td>
      <td class="datos_formularios">&nbsp;<?php echo $resultado['destinatario']; ?></td>
      <td class="datos_formularios">&nbsp;<?php echo $resultado['asunto']; ?></td>
      <td class="datos_formularios">
        <div align="center"><?php echo $resultado['dir_solicitante']; ?></div></td>
    </tr>
        <?php 
		  $contador_color++;
		}?>
        <tr valign="top">
          <td colspan="5" class="datos_formularios"><div align="center">NOTA: Los Oficios que aparecen en <span class="style1">ROJO</span> se encuentran <strong>ANULADOS</strong>.</div></td>
  </tr>
      </table>
      
<?php } // del if count records?>
</body>
</html>
