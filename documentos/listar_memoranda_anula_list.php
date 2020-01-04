<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  este archivo es un complemento de listar_memoranda_anula.php y muestra una lista de la memoranda dependiendo de la 
  						Dirección y el año seleccionado.
  		Modificado el: 	12/08/2008 por Pedro E. Arrioja M - Creación.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 $dir=$_GET['tipo'];
 $anio=$_GET['anio'];
 include("../db/conexion.php");
 include("../libs/utilidades.php");
 $link=conectarse("organizacion");
 $consulta=mysql_query("SELECT m.*, d.nombre_completo 
   						FROM memoranda m, direcciones d
 						WHERE ((m.direccion='$dir') and 
						       (m.ano='$anio') and
							   (m.direccion=d.codigo))
						ORDER BY m.correlativo DESC",$link) or die(mysql_error());
 if (mysql_num_rows($consulta) > 0) 
   {						
     $resultado=mysql_fetch_array($consulta);
     // para ingresar marca de auditoria.   
     include("../db/inserta_rastreo.php");
     $descripcion="Consulta Listado (Anulaci&oacute;n) de Memoranda de: ".$resultado['nombre_completo'];
     $ip = $REMOTE_ADDR; 
     inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'C',$descripcion,$ip);	
     mysql_data_seek($consulta, 0);
   };
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
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->

</style>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php if (mysql_num_rows($consulta) == 0) {
     echo '<p class="datos_formularios" class="style1">No Hay memoranda dosponible para la Direcci&oacute;n y a&ntilde;o seleccionados</p>';}
  else
  {?>

<table border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
          <td class="encabezado_formularios"># Memo</td>
                   <td class="encabezado_formularios">Fecha</td>
      <td class="encabezado_formularios">Destinatario</td>
      <td class="encabezado_formularios">Asunto</td>
            <td class="encabezado_formularios">Acci&oacute;n</td>
  </tr>
        <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla		
       $color=array("#FFFFFF","#CCFFFF"); // para darle colores alternos a las lineas que muestro
	   $rojo="#FF0000";
       $contador_color=0; // este contador permitira darle la alternabilidad a los colores		
 while($resultado=mysql_fetch_array($consulta)) { 
 $numdoc=$resultado['siglas']."-".$resultado['correlativo']."-".$resultado['ano'];
 
 ?>
       <tr bgcolor="<?php if ($resultado['status'] == 2) {echo $rojo;} else {echo $color[$contador_color%2];} ?>">
          <td class="datos_formularios"><div align="center"><?php echo $numdoc; ?></div></td>
                <td class="datos_formularios">
                <div align="center">&nbsp;<?php echo cambiaf_a_normal($resultado['fecha']); ?>&nbsp;</div></td>
      <td class="datos_formularios">&nbsp;<?php echo $resultado['destinatario']; ?></td>
      <td class="datos_formularios">&nbsp;<?php echo $resultado['asunto']; ?></td>
                <td class="datos_formularios" align="center"><?php if ($resultado['status'] == 1) {echo '<a href="db/cambia_status.php?numdoc='.$numdoc.'&tipo=2&st=2&id='.$resultado['id'].'"><img src="../imgs/rechazar.png" alt="Anular" width="24" height="24" border="0" /></a>';} else {echo '<a href="db/cambia_status.php?numdoc='.$numdoc.'&tipo=2&st=1&id='.$resultado['id'].'"><img src="../imgs/aprobar.png" alt="Habilitar" width="24" height="24" border="0" /></a>';} ?>
          </td>
    </tr>
        <?php
		   $contador_color++;
		 }?>
        <tr valign="top">
          <td colspan="5" class="datos_formularios"><div align="center">NOTA: EL Memorando que aparece en <span class="style1">ROJO</span> se encuentra <strong>ANULADO</strong></div></td>
  </tr>
      </table>
      
<?php } // del if count records?>
</body>
</html>
