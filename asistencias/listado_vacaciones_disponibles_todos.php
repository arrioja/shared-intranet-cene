<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra un listado con todas las vacaciones disponibles de todos los funcionarios activos del sistema.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creación
						05/09/2008 por Pedro E. Arrioja M. - Se añade comprobación de acceso al módulo
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 $link=conectarse("asistencias");
 $link=conectarse("organizacion"); 
 $consulta=mysql_query("select * from asistencias.vacaciones as v, organizacion.personas as p where((v.cedula=p.cedula) and (v.pendientes>'0')) order by p.nombres, p.apellidos, p.cedula,  v.disponible_desde",$link) or die(mysql_error());
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Listado de Vacaciones Disponibles</title>
<!-- InstanceEndEditable -->
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
<!-- InstanceBeginEditable name="head" -->


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
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="../imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="../imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="../imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="../imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="../imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="../imgs/CENE_07.png">      <div align="right">
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
     $consulta_cuenta_cedulas=mysql_query("select cedula, count(cedula) as linea from asistencias.vacaciones where ((pendientes>'0')
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
    <td colspan="8" class="datos_formularios Estilo1">Leyenda: Dis: D&iacute;as disfrutados, PEND: d&iacute;as pendientes para el disfrute. A&Ntilde;OS: en CENE + Previos en la Adm. Pub; Si en A&ntilde;os aparece &quot;---&quot;,  el registro fu&eacute; ingresadoal sistema como dato previo al funcionamiento del mismo.</td>
  </tr>
  <tr>
    <td colspan="8" class="datos_formularios"><div align="right">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" />      
    </div></td>
  </tr>
</table>
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
