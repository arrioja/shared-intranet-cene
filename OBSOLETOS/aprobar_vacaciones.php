<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra un listado con todas las vacaciones disponibles que el usuario puede aprobar o rechazar, se mostrarán todas las
  						vacaciones pendientes de aprobación que pertenezcan a su misma dirección y a personas de menor rango que él. 
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creación.
						04/09/2008 por Pedro E. Arrioja M. - Se añade comprobación de acceso a módulo.
						11/09/2008 por Pedro E. Arrioja M. - Se añade rastreo.
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
 $ip = $REMOTE_ADDR; 

if (isset($_GET['id']) == true) 
{ // si el id viene en el url, entonces el usuario ha seleccionado alguna opcion de aprobar o rechazar la vacación, si no, entonces
  // no se hace nada sino que se consulta a la base de datos.
  $st=$_GET['st'];
  $id=$_GET['id'];
  if (isset($_GET['cedula']) == true) // si la cedula viene en el url, entonces se esta aprobando la vacación y se traen los demás datos 
                                      // para construir la observación 
    {
	  $cedula=$_GET['cedula'];
	  $nombres=$_GET['nom'];
	  $apellidos=$_GET['ape'];
	  $dias=$_GET['dias'];
	  $periodo=$_GET['periodo'];
	  $desde=$_GET['desde'];
	  $hasta=$_GET['hasta'];
	  $restados=$_GET['reco'];
	  
	  $consulta_horario=mysql_query("select * from opciones where status='1'",$link) or die(mysql_error());
	  $resultado_horario=mysql_fetch_array($consulta_horario);
	 
	  $hora_desde=$resultado_horario['hora_entrada'];
	  $hora_hasta=$resultado_horario['hora_salida'];
	  
	  $observaciones="El funcionario(a) ".$nombres." ".$apellidos.", titular de la c&eacute;dula de identidad ".$cedula.", se encuentra ". 
					  "disfrutando ".$dias." d&iacute;as de vacaciones correspondientes al per&iacute;odo ".$periodo.", a partir del d&iacute;a ".
					  cambiaf_a_normal($desde)." hasta el ".cambiaf_a_normal($hasta);
		
	  // Descuento los dias de vacaciones que me especifican en el periodo de las vacaciones disponibles.	
	  mysql_query("update asistencias.vacaciones set pendientes=pendientes-'$dias', disfrutados=disfrutados+'$dias' 
	               where cedula='$cedula' and periodo='$periodo'",$link)or die(mysql_error());

	
	  // Para manejar lo del descuento de dias (si aplica).	
	  if ($restados > 0)
	    { // si hay que descontra algun dia, se llama a la funcion que lo hace.
		  echo "antes";
		  descuento_especial_de_dias($restados,$cedula,$link);
	      echo "respues";
		}		
		 
	   $id_resultante=mysql_insert_id($link);  
 
       $maximo_codigo_consult= mysql_query("select max(codigo) as maxcod from asistencias.justificaciones",$link);
	   $maximo_codigo=mysql_fetch_array($maximo_codigo_consult);
	   $codigo_nuevo=$maximo_codigo['maxcod']+1;  
	   $insertado=0;
	   if ($insertar=mysql_query("insert into asistencias.justificaciones (codigo, tipo_id_doc, estatus) 
	 							values ('$codigo_nuevo','VA', '1')",$link) or die(mysql_error()))
	     { 
	       // si se han gramado los datos generales correctamente seguimos con los dos pasos que restan:
	       // 1.- Guardar los datos de la persona.
	   	     if ($insertar2=mysql_query("insert into asistencias.justificaciones_personas (cedula, codigo_just) 
		    							 values ('$cedula','$codigo_nuevo')",$link) or die(mysql_error()))
	  	       {
		         // 2.- pasar los datos de fechas y horas desde la tabla temporal a la definitiva
			     if ($insertar3=mysql_query("insert into asistencias.justificaciones_dias (codigo_just, fecha_desde, hora_desde, fecha_hasta,
			 						         hora_hasta, codigo_tipo_falta, descuenta_ticket,lun,mar,mie,jue,vie,codigo_tipo_justificacion,
										     observaciones) 
										     values ('$codigo_nuevo','$desde', '$hora_desde', '$hasta', '$hora_hasta','IN','Si','1','1','1','1','1',
										             '1','$observaciones')",$link) or die(mysql_error()))
			       { // Si todo se guardo bien, solo debo hacer commit a la transacción.	  
					 mysql_query("COMMIT",$link);  // para grabar los datos definitivamente y cerrar la transaccion

					 $insertado=1;
			       } // del insertar3
		       } // del insertar2
	      } // del insertar	 
	} // del ifset cedula
	
  if (isset($insertado) == true) 
  // Este if es necesario porque depende de si viene el idresultante se ejecuta una consulta en la que se incluya o no
  {  
    mysql_query("update vacaciones_disfrute set estatus='$st', referencia='$codigo_nuevo' where id='$id'",$link);
	 // primero se inserta el rastreo.
	 $descripcion='Aprobada Vacaci&oacute;n para '.$cedula.' desde el '.cambiaf_a_normal($desde).' hasta el '.cambiaf_a_normal($hasta).', codigo de justificaci&oacute;n de asistencia:'.$codigo_nuevo;
	 inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'A',$descripcion,$ip); 

    header ("Location: aprobar_vacaciones.php", true); 
  }
  else
  {
    mysql_query("update vacaciones_disfrute set estatus='$st' where id='$id'",$link);
  	// primero se inserta el rastreo.
	$descripcion='Rechazada Vacaci&oacute;n: '.$id;
	inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'D',$descripcion,$ip); 
    header ("Location: aprobar_vacaciones.php", true);   
  }
} // del isset id

// si no hay ningun inconveniente o si no se debe realizar una aprobacion o desaprobacion, entonces, se muestra el listado que le corresponda a la direccion a la que pertenece el usuario.

 $codigo_dir=$_SESSION['direccion'];
 $cod_nivel=$_SESSION['nivel'];

$consulta=mysql_query("SELECT (p.cedula) as cedula_integrantes, p.nombres, p.apellidos, v.*,  c.cod_direccion, c.nivel 
FROM organizacion.personas as p, asistencias.vacaciones_disfrute as v, organizacion.personas_nivel_dir as c 
WHERE ((p.cedula=v.cedula) and (v.estatus='0') and (p.cedula=c.cedula) and (c.cod_direccion like'$codigo_dir%') and (c.nivel<='$cod_nivel')) order by p.nombres, p.apellidos",$link) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Aprobar/Rechazar Vacaciones</title>
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
<form id="form1" name="form1" method="get" action="aprobar_vacaciones.php">
  <table border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="8" class="encabezado_formularios">Aprobar o Rechazar Vacaciones</td>
    </tr>
    <tr>
      <td width="62" class="encabezado_formularios">C&eacute;dula</td>
      <td class="encabezado_formularios">Nombre</td>
      <td width="30" class="encabezado_formularios">D&iacute;as</td>
      <td width="75" class="encabezado_formularios">Per&iacute;odo</td>
      <td width="80" class="encabezado_formularios">Desde</td>
      <td width="80" class="encabezado_formularios">Hasta</td>
      <td width="80" class="encabezado_formularios">Descuentos</td>
      <td class="encabezado_formularios">Acci&oacute;n</td>
    </tr>
    <?php //cada vez que escribo el fetch array el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($consulta)) { ?>
    <tr>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['cedula']; ?></div></td>
      <td class="datos_formularios">&nbsp;<?php echo $resultado['nombres']." ".$resultado['apellidos']; ?></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['dias_disfrute']; ?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['periodo']; ?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo cambiaf_a_normal($resultado['fecha_desde']); ?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo cambiaf_a_normal($resultado['fecha_hasta']); ?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['dias_restados']; ?></div></td>
      <td class="datos_formularios"><div align="center"><a href="editar_tipo_justificacion.php?id=<?php echo $resultado['id'];?>"></a>
        <input type="button" name="aprobar" id="aprobar" value="Aprobar" 
        onclick="javascript: location.href='aprobar_vacaciones.php?id=<?php echo $resultado['id'];?>&st=1&cedula=<?php echo $resultado['cedula'];?>&nom=<?php echo $resultado['nombres'];?>&ape=<?php echo $resultado['apellidos'];?>&dias=<?php echo $resultado['dias_disfrute'];?>&reco=<?php echo $resultado['dias_restados'];?>&desde=<?php echo $resultado['fecha_desde'];?>&hasta=<?php echo $resultado['fecha_hasta'];?>&periodo=<?php echo $resultado['periodo'];?>'" />       
          <input type="button" name="rechazar" id="rechazar" value="Rechazar" 
          onclick="javascript: location.href='aprobar_vacaciones.php?id=<?php echo $resultado['id'];?>&st=2'" />
      </div></td>
    </tr>
    <?php }?>
    <tr>
      <td colspan="8" class="datos_formularios">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8" class="datos_formularios"><div align="center"><input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" /></div></td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Monday, 29 September, 2008 11:13 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
