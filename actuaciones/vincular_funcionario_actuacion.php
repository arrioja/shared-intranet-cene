<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  en esta página se vincula a los funcionarios con la actuación fiscal seleccionada, en el listado se muestran todos
  						los funcionarios que sean de la dirección a la que pertenezca el usuario y además que sean de menor nivel
						por ejemplo: si eres director de Control Central, te aparecen todos los funcionarios de tu dirección, si eres 
						un coordinador, aparecen todos los funcionarios menos otros coordinadores y tampoco tu director. Aparecen en rojo 
						los que no estan vinculados y en verde los que si.   Al vincularlo, el sistema añade automáticamente una observación
						a la asistencia del funcionario en la que dice que esta de actuación fiscal de x fecha a x fecha y su inasistencia
						queda entonces justificada en verde; al desvincularlo, dicha justificación de la asistencia es eliminada.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
session_start();  // se inicia la sesión 
if (!isset($_SESSION['login']))  // si "login" no existe, no hay sesión iniciada y se envia al login para ingresar autenticar
  {
	session_destroy();
	echo '<script languaje="Javascript">location.href="login.php?pag=index.php"</script>';
	exit();
  }; 

 $dir=$_SESSION['direccion'];
 $niv=$_SESSION['nivel'];
 include("../db/conexion.php");
 include("../libs/utilidades.php");
 $link=conectarse("asistencias"); 
 $ofi=$_GET['oficio'];
 $desde_f=cambiaf_a_mysql($_GET['desde']);
 $hasta_f=cambiaf_a_mysql($_GET['hasta']);
 
 $consulta_actuacion=mysql_query("SELECT a.id, a.oficio, a.dias_habiles, a.desde, a.hasta, e.nombre  
					              FROM asistencias.actuaciones as a, asistencias.entes_organos as e 
					              WHERE ((a.codigo_ente_organismo=e.codigo) and 
						                 (a.oficio='$ofi'))",$link) or die(mysql_error());	
 $resultado_act=mysql_fetch_array($consulta_actuacion); 
 
 

 if (isset($_GET['cedula']))
   { 
     $cedula=$_GET['cedula'];
	 $nombres=$_GET['nom'];
	 $apellidos=$_GET['ape'];
     

 	 $consulta_h=mysql_query("select * from asistencias.opciones where status='1'",$link) or die(mysql_error());
 	 $resultado_h=mysql_fetch_array($consulta_h);
	 $h_desde=$resultado_h['hora_entrada'];
	 $h_hasta=$resultado_h['hora_salida'];


// Para comprobar que las fechas no se encuentren fuera del rango de la comisión de auditoria.
 $desde_f=cambiaf_a_mysql($_GET['desde']);
 $hasta_f=cambiaf_a_mysql($_GET['hasta']);
 
 if ($desde_f < $resultado_act['desde']) {$f_desde=$resultado_act['desde'];} else {$f_desde=$desde_f;}
 if ($hasta_f > $resultado_act['hasta']) {$f_hasta=$resultado_act['hasta'];} else {$f_hasta=$hasta_f;}
//********************************************
	
	 
	 
	 
	 // Se genera la observación para incluirse en la asistencia.
	 $observaciones="El funcionario(a) ".$nombres." ".$apellidos.", titular de la c&eacute;dula de identidad ".$cedula.", se encuentra ". 
					  "realizando actuaci&oacute;n fiscal en: ".$resultado_act['nombre'].", durante ".$resultado_act['dias_habiles'].
					  " d&iacute;as, desde el ".cambiaf_a_normal($f_desde)." hasta el d&iacute;a ".
					  cambiaf_a_normal($f_hasta)." seg&uacute;n oficio n&uacute;mero ".$resultado_act['oficio'];



	 // Se incluye la observación de la asistencia 

     $maximo_codigo_consult= mysql_query("select max(codigo) as maxcod from asistencias.justificaciones",$link);
	 $maximo_codigo=mysql_fetch_array($maximo_codigo_consult);
	 $codigo_nuevo=$maximo_codigo['maxcod']+1;  
	 if ($insertar=mysql_query("insert into asistencias.justificaciones (codigo, tipo_id_doc, estatus) 
	 							values ('$codigo_nuevo','AF', '1')",$link) or die(mysql_error()))
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
										 values ('$codigo_nuevo','$f_desde', '$h_desde', '$f_hasta', '$h_hasta','IN','No','1','1','1','1','1',
										         '9','$observaciones')",$link) or die(mysql_error()))
			   { // Si todo se guardo bien, solo debo hacer commit a la transacción.
			     mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
			   }
		   }
	  } 
	
	$insertar=mysql_query("insert into asistencias.actuaciones_funcionarios(oficio,cedula,id_obs_asistencia,desde,hasta) 
							values ('$ofi','$cedula','$codigo_nuevo','$f_desde','$f_hasta')",$link);  
	 
     header("Location: vincular_funcionario_actuacion.php?oficio=".$_GET['oficio'], true);  
   }
 else
   {
     if (isset($_GET['id2']))
       { // se elimina del registro
	     $id2=$_GET['id2'];
		 $idoa=$_GET['idoa'];
	     $eliminar=mysql_query("DELETE FROM asistencias.actuaciones_funcionarios WHERE id='$id2'");
		 $eliminar2=mysql_query("DELETE FROM asistencias.justificaciones WHERE codigo='$idoa'");
		 $eliminar3=mysql_query("DELETE FROM asistencias.justificaciones_personas WHERE codigo_just='$idoa'");
		 $eliminar4=mysql_query("DELETE FROM asistencias.justificaciones_dias WHERE codigo_just='$idoa'");
		 
	     header("Location: vincular_funcionario_actuacion.php?oficio=".$_GET['oficio'], true); 	   
       }
   }
   
   $consulta=mysql_query("SELECT i.cedula, i.nombres, i.apellidos, F.id as id2, F.id_obs_asistencia as idoa, F.desde, F.hasta
			 			  FROM organizacion.personas as i,
						       asistencias.actuaciones_funcionarios as F 
						  WHERE (
						         (F.oficio='$ofi') and 
								 (i.cedula=F.cedula)
								 )
								 ",$link) or die(mysql_error());
									  
   $consulta2=mysql_query("SELECT p.id, p.cedula, p.nombres,p.apellidos
			 			   FROM organizacion.personas as p, nomina.integrantes as i, 
						   organizacion.personas_nivel_dir as n
						   WHERE ((i.status=1) and (i.tipo_nomina<>'PENSIONADOS') and (i.tipo_nomina<>'JUBILADOS') and 
						   (n.cod_direccion like '$dir%') and (p.cedula=i.cedula) and (n.nivel < '$niv') and
						   (n.cedula=p.cedula) and
						   (p.cedula not in (
						      SELECT p.cedula
			 			      FROM organizacion.personas as p, asistencias.actuaciones_funcionarios as f
						     WHERE ((p.cedula=f.cedula) and
							     (f.oficio='$ofi')))))
							ORDER BY p.nombres, p.apellidos",$link) or die(mysql_error());			 



/*
Este es el vínculo que existía antes en vez del botén Incorporar
 <a href="vincular_funcionario_actuacion.php?cedula=<?php echo $resultado2['cedula'];?>&amp;oficio=<?php echo $ofi;?>&amp;nom=<?php echo $resultado2['nombres'];?>&amp;ape=<?php echo $resultado2['apellidos'];?>&amp;des=document.getElementById('desde_<?php echo $resultado2['cedula']; ?>').innerHTML"> <?php echo '<img src="../imgs/led_rojo_p.png" alt="Desvinculado (Click para vincular)" width="24" height="24" border="0" />';?></a></a> */

								 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Conformar Comisi&oacute;n</title>
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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
<p>&nbsp;</p>
<table width="668" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" class="encabezado_formularios">Funcionarios que conforman la comisi&oacute;n para la Actuaci&oacute;n</td>
  </tr>
    <tr>
    <td width="110" class="encabezado_formularios">Oficio</td>
    <td width="237" class="datos_formularios">&nbsp;<?php echo $resultado_act['oficio'];?></td>
    <td width="47" class="encabezado_formularios">Desde</td>
    <td width="105" class="datos_formularios">&nbsp;<?php echo cambiaf_a_normal($resultado_act['desde']); ?></td>
    <td width="47" class="encabezado_formularios">Hasta</td>
    <td colspan="2" class="datos_formularios">&nbsp;<?php echo cambiaf_a_normal($resultado_act['hasta']);?></td>
  </tr>
    <tr>
    <td class="encabezado_formularios">Ente/&Oacute;rgano:</td>
    <td colspan="6" class="datos_formularios">&nbsp;<?php echo $resultado_act['nombre'] ?></td>
  </tr>
  <tr>
    <td class="encabezado_formularios">C&eacute;dula</td>
      <td colspan="3" class="encabezado_formularios">Nombre y Apellido</td>
      <td class="encabezado_formularios">Desde</td>
      <td width="69" class="encabezado_formularios">Hasta</td>
      <td width="81" class="encabezado_formularios">Vinculado</td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($consulta)) { ?> 
  <tr>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['cedula']; ?></div></td>
      <td colspan="3" class="datos_formularios">&nbsp;&nbsp;<?php echo $resultado['nombres']." ".$resultado['apellidos']; ?></td>
      <td class="datos_formularios"><div align="center"><?php echo cambiaf_a_normal($resultado['desde']); ?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo cambiaf_a_normal($resultado['hasta']); ?></div></td>
      <td class="datos_formularios"><div align="center"><a href="vincular_funcionario_actuacion.php?id2=<?php echo $resultado['id2'];?>&amp;oficio=<?php echo $ofi;?>&amp;idoa=<?php echo $resultado['idoa'];?>"> <?php if (isset($resultado['id2'])) { echo '<img src="../imgs/led_verde_p.png" alt="Vinculado, (Click para desvincular)" width="24" height="24" border="0" />';} else {echo '<img src="../imgs/led_rojo_p.png" alt="Desvinculado (Click para vincular)" width="24" height="24" border="0" />';}?></a></a></div></td>
  </tr>
  <?php }?> 
  <tr>
    <td colspan="7" class="datos_formularios"><div align="center">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='listar_actuaciones.php'" /></div></td>
  </tr>
</table>
<br />
<table width="693" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" class="encabezado_formularios">Funcionarios disponibles: </td>
  </tr>
  <tr>
    <td width="71" class="encabezado_formularios">C&eacute;dula</td>
      <td width="513" class="encabezado_formularios">Nombre y Apellido</td>
      <td width="70" class="encabezado_formularios">Desde</td>
      <td width="70" class="encabezado_formularios">Hasta</td>
    <td width="110" class="encabezado_formularios">Vinculado</td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado2=mysql_fetch_array($consulta2)) { ?> 
  <tr>
  <form id="form1" name="form1" method="get" action="vincular_funcionario_actuacion.php">
    <td class="datos_formularios"><div align="center"><?php echo $resultado2['cedula']; ?></div></td>
      <td class="datos_formularios"><?php echo $resultado2['nombres']." ".$resultado2['apellidos']; ?>
        <input name="cedula" type="hidden" id="cedula" value="<?php echo $resultado2['cedula']; ?>" />
        <input name="nombre" type="hidden" id="nombre" value="<?php echo $resultado2['nombres']; ?>" />
        <input name="apellido" type="hidden" id="apellido" value="<?php echo $resultado2['apellidos']; ?>" />
        <input name="oficio" type="hidden" id="oficio" value="<?php echo $resultado_act['oficio'];?>" /></td>
      <td align="center" class="datos_formularios"><span id="sprytextfield1">
      <label>
      <input name="desde" type="text" id="desde" value="<?php echo cambiaf_a_normal($resultado_act['desde']); ?>" size="10" maxlength="10" />
      </label>
      <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      <td align="center" class="datos_formularios"><span id="sprytextfield2">
      <label>
      <input name="hasta" type="text" id="hasta" value="<?php echo cambiaf_a_normal($resultado_act['hasta']);?>" size="10" maxlength="10" />
      </label>
      <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      <td class="datos_formularios"><div align="center">
        <label>
        <input type="submit" name="enviar" id="enviar" value="Incorporar" />
        </label>
      </div></td>
  </form>
  </tr>
  <?php }?> 
  <tr>
    <td colspan="5" class="datos_formularios"><div align="center">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='listar_actuaciones.php'" /></div></td>
  </tr>
</table>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", isRequired:false, validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd/mm/yyyy", isRequired:false, validateOn:["blur"]});
//-->
</script>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Tuesday, 4 November, 2008 12:17 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
