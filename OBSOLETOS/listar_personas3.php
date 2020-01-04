<?php 
 include("../db/conexion.php");
 include("../libs/utilidades.php"); 
 $link=conectarse("organizacion"); 
 // para la paginación de resultados
  $registros = $_GET["registros"];
 if (!$registros) 
   {$registros = 20;} 
   
 $pagina = $_GET["pagina"];
 if (!$pagina) 
   { 
     $inicio = 0; 
     $pagina = 1; 
   } 
 else 
   { 
     $inicio = ($pagina - 1) * $registros; 
   }
  echo $inicio." ".$pagina;  
 session_start();  // se inicia la sesión 

/*if (isset($_GET['id']) == true) 
{ // si el id viene en el url, entonces el usuario ha seleccionado a un usuario para activar/desactivar.
  $id=$_GET['id'];
  $activo=$_GET['activo'];  
  $actualiza=mysql_query("update asistencias.personas_status_asistencias set status_asistencia='$activo' where id='$id'",$link) or die(mysql_error());
  header ("Location: estatus_asistencia.php", true); 
}
*/ 
 
 // Para contar cuantos registros existen que se deben mostrar
 $resultados = mysql_query("select p.id FROM organizacion.personas as p",$link);
 $total_registros = mysql_num_rows($resultados);
 
 // ahora si saco los registros para mostrar
 $resultados = mysql_query("select p.id, p.cedula, p.nombres, p.apellidos  
 						    FROM organizacion.personas as p
						    ORDER BY p.nombres, p.apellidos LIMIT $inicio, $registros",$link);
 $total_paginas = ceil($total_registros / $registros); 

/* $consulta=mysql_query("select p.id, p.cedula, p.nombres, p.apellidos  
 						FROM organizacion.personas as p
						ORDER BY p.nombres, p.apellidos",$link) or die(mysql_error());*/
						 
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Personas sujetas al control de asistencias</title>
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
      <table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="8" class="encabezado_formularios">Listado de Personas registradas</td>
  </tr>
  <tr>
    <td width="101" class="encabezado_formularios">C&eacute;dula</td>
    <td width="377" class="encabezado_formularios">Nombres y Apellidos</td>
    <td width="118" colspan="4" class="encabezado_formularios">Acci&oacute;n</td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($resultados)) { ?> 
  <tr>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['cedula']; ?></div></td>
    <td class="datos_formularios">&nbsp;&nbsp;&nbsp;<?php echo $resultado['nombres']." ".$resultado['apellidos']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td valign="top" class="datos_formularios"><div align="center">
      <?php /*if ($resultado['status_asistencia'] == "1") { echo '<a href="estatus_asistencia.php?id='.$resultado['id'].'&activo=0"><img src="../imgs/led_verde_p.png" alt="Activo (Click para desactivar)" width="24" height="24" border="0" />';} else {echo '<a href="estatus_asistencia.php?id='.$resultado['id'].'&activo=1"><img src="../imgs/led_rojo_p.png" alt="Inactivo (Click para activar)" width="24" height="24" border="0" />';}*/?>
    <a href="../organizacion/editar_persona.php?id=<?php echo $resultado['id']; ?>"><img src="../imgs/edit.png" width="16" height="16" border="0"  title="Editar Datos Personales"/></a></div></td>
  </tr>
  <?php }?> 
          <tr>
       <td colspan="8" class="datos_formularios">
	      <div align="center">
	        <?php 
		     // Link a la página anterior
		     if(($pagina - 1) > 0) 
			   {
                 echo "<a href='listar_personas.php?pagina=".($pagina-1)."'>< Anterior</a> ";
			   }
			 // Link de las diversas páginas existentes  
			 for ($i=1; $i<=$total_paginas; $i++)
			   {
			     if ($pagina == $i) 
				   {echo "<b>".$pagina."</b> ";} 
				 else 
				   {echo "<a href='listar_personas.php?pagina=$i'>$i</a> ";}
			   }  
			 // Link a la siguiente página  
			 if(($pagina + 1)<=$total_paginas) 
			 { echo " <a href='listar_personas.php?pagina=".($pagina+1)."'>Siguiente ></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}  
			   
			   
 			 if ($registros < $total_registros) 
  			  { 			   
                echo "<a href='listar_personas.php?registros=".($total_registros)."'> *Ver TODOS*</a ";
		      }
			 else
			  {
			     echo "<a href='listar_personas.php?registros=".'20'."'> *Ver por LISTA*</a ";
			  }

			   
		  ?>
	           </div></td>
     </tr>
     <tr>
       <td colspan="8" class="datos_formularios"> <div align="center">Existen <?php echo $total_registros; ?> personas listadas en <?php echo $total_paginas ?> p&aacute;ginas. &nbsp;&nbsp;&nbsp;</div></td>
     </tr>
     <tr>
    <td colspan="8" class="datos_formularios"><div align="center">
      <a href="../organizacion/incluir_persona.php">Incluir</a>
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" />
    </div></td>
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
