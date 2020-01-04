<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra la información general de las vacaciones del funcionario y permite ver el detalle de sus disfrutes con AJAX
  						con el archivo detalle_vacacion_funcionario_disfrute.php
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 include("../db/conexion.php");
 $link=conectarse("asistencias");
 $link=conectarse("organizacion");
 if (isset($_GET['cedula'])) {$cedula=$_GET['cedula'];}
 if (isset($_POST['cedula'])) {$cedula=$_POST['cedula'];} 
 if (isset($_POST['restringido'])) {$retorno="index.php";} else {$retorno="listado_vacaciones_disponibles.php";}

  
 $consulta_vac=mysql_query("select * 
 							from asistencias.vacaciones as v 
 							where (v.cedula='$cedula') 
							order by v.disponible_desde",$link) or die(mysql_error());
						
 $consulta_funcionario=mysql_query("select p.cedula, p.nombres, p.apellidos 
 									from organizacion.personas as p
 									where (p.cedula='$cedula')",$link) or die(mysql_error());
 $resultado_funcionario=mysql_fetch_array($consulta_funcionario);
									
  // para ingresar marca de auditoria.    
 include("../db/inserta_rastreo.php");
 $descripcion='Consulta Detalle Vacaciones de: '.$resultado_funcionario['apellidos'].' '.
 				$resultado_funcionario['nombres'].', C&eacute;dula: '.$cedula;
 $ip = $REMOTE_ADDR; 
 inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'C',$descripcion,$ip); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Detalle de Vacaciones</title>
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
.style5 {
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
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" --> <br />
    <script language="javascript" type="text/javascript">
function objetoAjax()
  {
	var xmlhttp=false;
	try 
	  {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	  } 
	catch (e) 
	  {
	    try 
		  {
		    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } 
		 catch (E) 
		  {
		    xmlhttp = false;
		  }
	  }

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') 
	  {
		xmlhttp = new XMLHttpRequest();
	  }
	return xmlhttp;
}

function VerDetalle(datos,ced,peri)
  {
    datos=datos+"?cedula="+ced+"&periodo="+peri;
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", datos);
	ajax.onreadystatechange=function() 
	  {
		if (ajax.readyState==4) 
		  {
			divResultado.innerHTML = ajax.responseText
		  }
	  }
	ajax.send(null)
}    
    
</script>
      
  <table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" class="encabezado_formularios">Informaci&oacute;n Detallada de  Vacaciones</td>
    </tr>
    <tr>
      <td colspan="2" class="encabezado_formularios">Datos del Funcionario</td>
    </tr>
    <tr>
      <td width="178" class="titulos_formularios">C&eacute;dula:</td>
      <td width="466" class="datos_formularios"><?php echo $resultado_funcionario['cedula'];?></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Apellidos y Nombres:</td>
      <td class="datos_formularios"><?php echo $resultado_funcionario['apellidos']." ".$resultado_funcionario['nombres'];?></td>
    </tr>
  </table>
  <table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="8" class="encabezado_formularios">Listado de vacaciones por per&iacute;odos</td>
    </tr>
    <tr>
      <td width="88" class="encabezado_formularios">Per&iacute;odo</td>
      <td width="61" class="encabezado_formularios">A&ntilde;os</td>
      <td width="56" class="encabezado_formularios">D&iacute;as</td>
      <td width="116" class="encabezado_formularios">Disfrutados</td>
      <td width="108" class="encabezado_formularios">Pendientes</td>
      <td width="108" class="encabezado_formularios">Descontados</td>
      <td width="152" class="encabezado_formularios">Disponible desde</td>
      <td width="53" class="encabezado_formularios">Detalle</td>
    </tr>
    
    <?php  while($resultado=mysql_fetch_array($consulta_vac)) { ?>
    <tr>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['periodo']; ?></div></td>
      <td class="datos_formularios"><div align="center">
        <?php if ($resultado['antiguo']==1){echo "---";} else 
	{ echo $resultado['anos_antiguedad']." + ".$resultado['anos_antiguedad_otro']; }?>
        </div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['dias'];?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['disfrutados'];?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['pendientes']; ?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo $resultado['restados']; ?></div></td>
      <td class="datos_formularios"><div align="center"><?php echo date("d/m/Y",strtotime($resultado['disponible_desde']));?></div></td>
      <td class="datos_formularios"><div align="center"><?php if ($resultado['disfrutados']>=1){?>
        <label>
          <input type="button" name="Ver" id="Ver" value="Ver" onclick="VerDetalle('detalle_vacacion_funcionario_disfrute.php','<?php echo $resultado_funcionario['cedula'];?>','<?php echo $resultado['periodo'];?>')" />
          </label>
        </div><?php } else echo "N/D";?></td>
      </tr>
    
    <?php }?>
  </table>
  <table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="datos_formularios">
      <td><div align="center" id="resultado">Para ver el detalle del disfrute, haga Click en &quot;Ver&quot; en el listado de vacaciones por per&iacute;odo</div></td>
    </tr>
  </table>
  <table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
    <?php  while($resultado=mysql_fetch_array($consulta_vac)) { ?>
    <?php }?>
    <tr>
      <td colspan="7"><div align="justify"><span class="datos_formularios Estilo1 style5">Nota: Los valores de  las columnas: D&iacute;as, Disfrutados, Pendientes, D&iacute;as H&aacute;biles y D&iacute;as Feriados se encuentran expresados en D&iacute;as h&aacute;biles laborables. A&Ntilde;OS: CENE + Previos en la Administraci&oacute;n  P&uacute;blica; Si en A&ntilde;os aparece &quot;---&quot;,  el registro fu&eacute; ingresado al sistema como dato previo al funcionamiento del mismo; N/D=No Disponible.</span></div></td>
    </tr>
    <tr>
      <td colspan="7"><label>
        <div align="right">
          <input type="submit" name="volver" id="volver" value="Volver" onclick="javascript: location.href='<?php echo $retorno; ?>'"/>
          </div>
      </label></td>
    </tr>
  </table>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Friday, 26 September, 2008 11:05 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
