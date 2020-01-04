<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Es el complemento del archivo listado_vacaciones_disponibles_list.php, este archivo muestra el listado de vacaciones 
  						disponibles dependiendo de la dirección seleccionada en el archivo mencionado.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 include("../db/conexion.php");
 $link=conectarse("organizacion");
 
 $dir=$_GET['dir'];

  // para ingresar marca de auditoria.    
 $consulta_dir2=mysql_query("select o.nombre_completo from organizacion.direcciones as o where (o.codigo='$dir')",$link);
 $result_dir2=mysql_fetch_array($consulta_dir2);
 include("../db/inserta_rastreo.php");
 $descripcion='Consulta Vacaciones de: '.$result_dir2['nombre_completo'];
 $ip = $REMOTE_ADDR; 
 inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'C',$descripcion,$ip);

 $consulta=mysql_query("select * 
 						from asistencias.vacaciones as v, organizacion.personas as p, 
						organizacion.personas_nivel_dir as c, organizacion.direcciones as d  
						where((v.cedula=p.cedula) and 
						      (p.cedula=c.cedula) and 
							  (d.codigo=c.cod_direccion) and 
							  (c.cod_direccion LIKE '$dir%') and 
							  (v.pendientes>'0')) 
						order by p.nombres, p.apellidos, p.cedula,  v.disponible_desde",$link) or die(mysql_error());
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Listado de Vacaciones Disponibles</title>

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
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {
	font-size: 10px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="9" class="encabezado_formularios">D&iacute;as de vacaciones disponibles para disfrute.</td>
    </tr>
        <tr>
          <td class="encabezado_formularios">C&eacute;dula</td>
      <td class="encabezado_formularios">Nombres y Apellidos</td>
      <td class="encabezado_formularios">A&ntilde;os</td>
      <td class="encabezado_formularios">Dias</td>
      <td class="encabezado_formularios">Dis.*</td>
      <td class="encabezado_formularios">Pend.*</td>
      <td class="encabezado_formularios">Per&iacute;odo</td>
      <td class="encabezado_formularios">Disp. desde:</td>
      <td class="encabezado_formularios">Detalle</td>
  </tr>
        <?php 
   $cedi="XX";
   $color=array("#FFFFFF","#CCFFFF"); // para darle colores alternos a las lineas que muestro
   $contador=0; // este contador permitira darle la alternabilidad a los colores
   while($resultado=mysql_fetch_array($consulta)) { 
 ?>  
        
        
        <?php 
  
     if ($cedi<>$resultado['cedula'])
   {
     $cedi=$resultado['cedula']; 
     $consulta_cuenta_cedulas=mysql_query("select cedula, count(cedula) as linea from asistencias.vacaciones where ((pendientes>'0')
	  and (cedula='$cedi')) group by cedula",$link) or die(mysql_error()); 
     $resultado_lineas=mysql_fetch_array($consulta_cuenta_cedulas);
     $num_lineas=$resultado_lineas['linea']; 
     $contador++; // es otra persona asi que se cambia el color;	 
  ?>
        <tr bgcolor="<?php echo $color[$contador%2]; ?>">
          <td rowspan="<?php echo $num_lineas; ?>" class="datos_formularios"><div align="center"><?php echo $resultado['cedula']; ?></div>     </td>
       <td rowspan="<?php echo $num_lineas; ?>" class="datos_formularios" align="left">&nbsp; <?php echo $resultado['nombres']." ".
	 $resultado['apellidos'];?></td> 
       
  <?php 

  }
  else // si no es uno diferente, sino que seguimos con el mismo empleado, simplemente se coloca el color de fondo
  { ?>
        <tr bgcolor="<?php echo $color[$contador%2]; ?>">
          <?php
   }
  
   ?>  
          <td class="datos_formularios"><div align="center"><?php if ($resultado['antiguo']==1){echo "---";} else 
	{ echo $resultado['anos_antiguedad']." + ".$resultado['anos_antiguedad_otro']; }?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['dias'];?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['disfrutados'];?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['pendientes']; ?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['periodo']; ?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo date("d/m/Y",strtotime($resultado['disponible_desde']));?>
        </div></td>  
        
         <?php    if ($cedi2<>$resultado['cedula'])
   {   $cedi2=$resultado['cedula'];      ?>     
             
              <td rowspan="<?php echo $num_lineas; ?>"  class="datos_formularios"><div align="center">
        <label>
        <input type="submit" name="detalle" id="detalle" value="Detalle" onclick="javascript: location.href='detalle_vacacion_funcionario.php?cedula=<?php echo $resultado['cedula']; ?>';" />
        </label>
      </div></td>
      <?php }?>
            
  </tr>
        <?php // fin del ciclo repetitivo que dibuja las lineas
   }?>
        <tr>
          <td colspan="9" class="datos_formularios Estilo1">Leyenda: Dis: D&iacute;as disfrutados, Pend: d&iacute;as pendientes para el disfrute. A&Ntilde;OS: en CENE + Previos en la Administraci&oacute;n  P&uacute;blica; Si en A&ntilde;os aparece &quot;---&quot;,  el registro fu&eacute; ingresado al sistema como dato previo al funcionamiento del mismo.</td>
    </tr>

</table>
</body>
</html>
