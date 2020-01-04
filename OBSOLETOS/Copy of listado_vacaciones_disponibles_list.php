<?php 
 include("../db/conexion.php");
 $link=conectarse("personal");
 $dir=$_GET['dir'];
 $consulta=mysql_query("select * from asistencias_vacaciones,integrantes,integrantes_cargo,direcciones  where((asistencias_vacaciones.cedula=integrantes.cedula) and (integrantes.cedula=integrantes_cargo.cedula) and 
(direcciones.codigo=integrantes_cargo.cod_direccion) and (integrantes_cargo.cod_direccion LIKE '$dir%') and (asistencias_vacaciones.pendientes>'0')) order by integrantes.nombres, integrantes.apellidos, integrantes.cedula,  asistencias_vacaciones.disponible_desde",$link) or die(mysql_error());
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
<table width="810" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="8" class="encabezado_formularios">D&iacute;as de vacaciones disponibles para disfrute.</td>
    </tr>
        <tr>
          <td width="68" class="encabezado_formularios">C&eacute;dula</td>
      <td width="347" class="encabezado_formularios">Nombres y Apellidos</td>
      <td width="54" class="encabezado_formularios">A&ntilde;os</td>
      <td width="44" class="encabezado_formularios">Dias</td>
      <td width="45" class="encabezado_formularios">Dis.*</td>
      <td width="54" class="encabezado_formularios">Pend.*</td>
      <td width="82" class="encabezado_formularios">Per&iacute;odo</td>
      <td width="111" class="encabezado_formularios">Disp. desde:</td>
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
     $consulta_cuenta_cedulas=mysql_query("select cedula, count(cedula) as linea from asistencias_vacaciones where ((pendientes>'0')
	  and (cedula='$cedi')) group by cedula",$link) or die(mysql_error()); 
     $resultado_lineas=mysql_fetch_array($consulta_cuenta_cedulas);
     $num_lineas=$resultado_lineas['linea']; 
     $contador++; // es otra persona asi que se cambia el color;	 
  ?>
        <tr bgcolor="<?php echo $color[$contador%2]; ?>">
          <td rowspan="<?php echo $num_lineas; ?>" class="datos_formularios"><div align="right"><?php echo $resultado['cedula']; ?></div>     </td>
       <td rowspan="<?php echo $num_lineas; ?>" class="datos_formularios">&nbsp; <?php echo $resultado['nombres']." ".
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
    </tr>
        <?php // fin del ciclo repetitivo que dibuja las lineas
  
  
   }?>
        <tr>
          <td colspan="8" class="datos_formularios Estilo1">Leyenda: Dis: D&iacute;as disfrutados, Pend: d&iacute;as pendientes para el disfrute. A&Ntilde;OS: en CENE + Previos en la Administraci&oacute;n  P&uacute;blica; Si en A&ntilde;os aparece &quot;---&quot;,  el registro fu&eacute; ingresado al sistema como dato previo al funcionamiento del mismo.</td>
    </tr>

      </table>
</body>
</html>
