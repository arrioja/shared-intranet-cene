<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra un listado con todas los permisos disponibles que el usuario puede aprobar o rechazar, se mostrarán todas los
  						permisos pendientes de aprobación que pertenezcan a su misma dirección y a personas de menor rango que él. 
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creación
						04/09/2008 por Pedro E. Arrioja M. - Se añade comprobación de acceso al módulo.
						11/09/2008 por Pedro E. Arrioja M. - se corrije el vinculo del form a aprobar_permisos.php pq estaba mal direccionado a 
						           aprobar_vacaciones, adicionalmente, se usa ahora el codigo del permiso como identificador en vez del campo id y
								   se añade rastreo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 include("../db/inserta_rastreo.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 $link=conectarse("asistencias"); 

if (isset($_GET['id']) == true) 
{ // si el id viene en el url, entonces el usuario ha seleccionado alguna opcion de aprobar o rechazar la vacación, si no, entonces
  // no se hace nada sino que se consulta a la base de datos.
  $st=$_GET['st'];
  $id=$_GET['id'];
  mysql_query("update asistencias.justificaciones j set j.estatus='$st' where j.codigo='$id'",$link)or die(mysql_error());	
  
  // para ingresar marca de auditoria.  
  if ($st == 1) 
    {
	  $descripcion='Aprobado permiso c&oacute;digo: '.$id;
      $ip = $REMOTE_ADDR; 
      inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'A',$descripcion,$ip); 	  
	}
  else 
    {
	  $descripcion='Rechazado permiso c&oacute;digo: '.$id;
      $ip = $REMOTE_ADDR; 
      inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'D',$descripcion,$ip);	  
	}
  
  header ("Location: aprobar_permisos.php", true);
}

// si no hay ningun inconveniente o si no se debe realizar una aprobacion o desaprobacion, entonces, se muestra el listado que le corresponda a la direccion a la que pertenece el usuario.

 $codigo_dir=$_SESSION['direccion'];
 $cod_nivel=$_SESSION['nivel'];

 $consulta=mysql_query("SELECT (p.cedula) as cedula_integrantes, p.nombres, p.apellidos, 
 							    j.codigo, jd.fecha_desde, jd.hora_desde, jd.fecha_hasta, jd.hora_hasta 
 						FROM organizacion.personas as p, asistencias.justificaciones as j, organizacion.personas_nivel_dir as c,  
						     asistencias.justificaciones_dias as jd, asistencias.justificaciones_personas as jp 
						WHERE ((p.cedula=jp.cedula) and (j.estatus='0') and (jp.codigo_just=j.codigo) and (jd.codigo_just=j.codigo) and 
						       (p.cedula=c.cedula) and (c.cod_direccion like'$codigo_dir%') 
						       and (c.nivel<'$cod_nivel')) order by p.nombres, p.apellidos",$link) or die(mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Aprobar/Rechazar Permisos</title>
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
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" -->
<br />
<form id="form1" name="form1" method="get" action="aprobar_permisos.php">
  <table width="818" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="5" class="encabezado_formularios">Aprobar o Rechazar Permisos</td>
    </tr>
    <tr>
      <td width="66" class="encabezado_formularios">C&eacute;dula</td>
      <td width="276" class="encabezado_formularios">Nombre</td>
      <td width="153" class="encabezado_formularios">Desde</td>
      <td width="156" class="encabezado_formularios">Hasta</td>
      <td width="155" class="encabezado_formularios">Acci&oacute;n</td>
    </tr>
    <?php //cada vez que escribo el fetch array el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($consulta)) { ?>
    <tr>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['cedula_integrantes']; ?></div></td>
      <td class="datos_formularios">&nbsp;<?php echo $resultado['nombres']." ".$resultado['apellidos']; ?>        <div align="center"></div>        <div align="center"></div></td>
      <td class="datos_formularios"><div align="center"><?php echo cambiaf_a_normal($resultado['fecha_desde'])." - ".date("h:i A",strtotime($resultado['hora_desde']));?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo cambiaf_a_normal($resultado['fecha_hasta'])." - ".date("h:i A",strtotime($resultado['hora_hasta']));?></div></td>
      <td class="datos_formularios"><div align="center">
        <input type="button" name="aprobar" id="aprobar" value="Aprobar" 
        onclick="javascript: location.href='aprobar_permisos.php?id=<?php echo $resultado['codigo'];?>&st=1'" />       
          <input type="button" name="rechazar" id="rechazar" value="Rechazar" 
          onclick="javascript: location.href='aprobar_permisos.php?id=<?php echo $resultado['codigo'];?>&st=2'" />
      </div></td>
    </tr>
    <?php }?>
    <tr>
      <td colspan="5" class="datos_formularios">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" class="datos_formularios"><div align="center"><input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" /></div></td>
    </tr>
  </table>
</form>
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
