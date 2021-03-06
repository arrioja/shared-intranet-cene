<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  Muestra el listado de d�as no laborables.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creaci�n
						05/09/2008 por Pedro E. Arrioja M. - Se a�ade comprobaci�n de acceso al m�dulo
						11/09/2008 por PEdro E. Arrioja M. - Se a�ade rastreo.
  			  Versi�n: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesi�n 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 $link=conectarse("organizacion");  
 $consulta=mysql_query("select * from organizacion.dias_no_laborables order by ano,mes,dia",$link) or die(mysql_error());
   // para ingresar marca de auditoria.   
   include("../db/inserta_rastreo.php");
   $descripcion='Consulta listado de Dias No Laborables.';
   $ip = $REMOTE_ADDR; 
   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'C',$descripcion,$ip);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Intranet CENE</title>
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
<table width="688" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" class="encabezado_formularios">D&iacute;as Patrios y Festivos NO Laborables</td>
  </tr>
  <tr>
    <td width="53" class="encabezado_formularios">D&iacute;a</td>
    <td width="115" class="encabezado_formularios">Mes</td>
    <td width="65" class="encabezado_formularios">A&ntilde;o</td>
    <td width="351" class="encabezado_formularios">Descripci&oacute;n</td>
    <td width="92" class="encabezado_formularios">Acci&oacute;n</td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($consulta)) { ?> 
  <tr>
    <td class="datos_formularios"> <div align="center"><?php echo $resultado['dia']; ?></div></td>
    <td class="datos_formularios">&nbsp;      <?php 
							  			switch($resultado['mes']){
										case 1: echo "Enero"; break;
										case 2: echo "Febrero"; break;
										case 3: echo "Marzo"; break;
										case 4: echo "Abril"; break;
										case 5: echo "Mayo"; break;
										case 6: echo "Junio"; break;
										case 7: echo "Julio"; break;
										case 8: echo "Agosto"; break;
										case 9: echo "Septiembre"; break;
										case 10: echo "Octubre"; break;
										case 11: echo "Noviembre"; break;
										case 12: echo "Diciembre"; break;
										default: echo "Error en Mes, corrija.";break; }?></td>
    <td class="datos_formularios"><div align="center"><?php echo $resultado['ano']; ?></div></td>
    <td class="datos_formularios">&nbsp;<?php echo $resultado['descripcion']; ?></td>
    <td class="datos_formularios"><div align="center"><a href="editar_no_laborable.php?id=<?php echo $resultado['id'];?>"><img src="../imgs/editar.jpg" alt="Editar" width="23" height="20" border="0" /></a><a href="editar_no_laborable.php?id=<?php echo $resultado['id'];?>"></a></div></td>
  </tr>
  <?php }?> 
     <tr>
       <td colspan="5" class="datos_formularios">&nbsp;</td>
     </tr>
     <tr>
    <td colspan="5" class="datos_formularios"><div align="center"><a href="incluir_no_laborable.php">Incluir</a> &nbsp;&nbsp;&nbsp;&nbsp;Imprimir <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" /></div></td>
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
