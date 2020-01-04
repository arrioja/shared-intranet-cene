<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra la información de los disfrutes de vacaciones que ha tenido el funcionario para el 
  						período vacacional seleccionado. funciona con AJAX como complemento de detalle_vacacion_funcionario.php
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creación
						01/09/2008 por Pedro E. Arrioja M. - Se añade columna que muestre el estatus de la vacación.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 include("../db/conexion.php");
 $link=conectarse("asistencias");
 $cedula=$_GET['cedula'];
 $periodo=$_GET['periodo'];
 $consulta_vac=mysql_query("select * 
 							from vacaciones_disfrute
 							where ((vacaciones_disfrute.cedula='$cedula') and 
								   (vacaciones_disfrute.periodo='$periodo'))
							order by vacaciones_disfrute.fecha_desde",$link) or die(mysql_error()); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php if (mysql_num_rows($consulta_vac) == 0) {
     echo '<p class="style1">No existen datos de disfrutes de vacaciones para el per&iacute;odo seleccionado</p>';}
  else
  {?>
<table width="647" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="6" class="encabezado_formularios">Detalles del Disfrute de Vacaciones para el Per&iacute;odo <?php echo $periodo;?></td>
  </tr>
  <tr>
    <td class="encabezado_formularios">Desde</td>
    <td class="encabezado_formularios">Hasta</td>
    <td class="encabezado_formularios">D&iacute;as h&aacute;biles</td>
    <td class="encabezado_formularios">D&iacute;as Feriados</td>
        <td class="encabezado_formularios">D&iacute;as Restados</td>
    <td class="encabezado_formularios">Estatus</td>
  </tr>
  
  <?php  
  
    while($resultado=mysql_fetch_array($consulta_vac)) { ?>
  <tr>
    <td class="datos_formularios"><div align="center"><?php echo date("d/m/Y",strtotime($resultado['fecha_desde']));?></div></td>
    <td class="datos_formularios"><div align="center"><?php echo date("d/m/Y",strtotime($resultado['fecha_hasta']));?></div></td>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['dias_disfrute'];?></div></td>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['dias_feriados'];?></div>    </td>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['dias_restados'];?></div>    </td>
    <td class="datos_formularios"  
    <?php 
	switch ($resultado['estatus'])
	{
	  case 0: echo 'bgcolor="#FFFF00"';
	 		 break;
	  case 1: echo 'bgcolor="#00FF00"';
	 		 break;
	  case 2: echo 'bgcolor="#FF0000"';
	 		 break;
	}
	?>
    
    
     ><div align="center"><strong><?php 
	switch ($resultado['estatus'])
	{
	  case 0: echo "POR APROBAR";
	 		 break;
	  case 1: echo "APROBADO";
	 		 break;
	  case 2: echo "NEGADO";
	 		 break;
	}
	?></strong></div></td>
  </tr>

    <?php } // del ciclo para llenar los datos?>
</table>
<?php } // del if de la comprobacion de que la consulta haya arrojado datos?>
</body>

</html>
