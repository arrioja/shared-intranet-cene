<?php 
  session_start();
  include ("../db/conexion.php");
  include ("../libs/utilidades.php");
   include("../libs/libchart/classes/libchart.php");  // la libreria que generar� el gr�fico
//   include("librerias/libchart/classes/PieChart.php");
   $buscar_sexo="Masculino";
   $link=conectarse("djp");  
   //se hace la consulta para contar cuantos son masculinos
   $consulta_declarantes = mysql_query("select count(sexo) from declarantes where sexo='M'", $link); 
   $cuentasexo=mysql_fetch_row($consulta_declarantes);
   $masculinos=$cuentasexo[0];
   //se hace la consulta para contar cuantos son femeninos   
   $consulta_declarantes = mysql_query("select count(sexo) from declarantes where sexo='F'", $link); 
   $cuentasexo=mysql_fetch_row($consulta_declarantes);
   $femeninos=$cuentasexo[0]; 
   
   //echo "Hay ".$masculinos." hombres y ".$femeninos." mujeres registrado(a)s.";
	$chart = new PieChart();

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("Femeninos: (".$femeninos.")", $femeninos));
	$dataSet->addPoint(new Point("Masculinos: (".$masculinos.")", $masculinos));
	$chart->setDataSet($dataSet);

	$chart->setTitle("Relaci�n de Declarantes por Sexo");
	$chart->render("../imgs/graf/djp_graficosexo.png");
	
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

<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3" align="center"><img alt="Vertical bars chart" src="../imgs/graf/djp_graficosexo.png" style="border: 1px solid gray;"/></td>
  </tr>
  <tr>
    <td align="center" class="datos_formularios">&nbsp;</td>
    <td width="70%" align="center" class="datos_formularios">Los datos reflejados en esta gr&aacute;fica son de referencia y var&iacute;an constantemente, consulte peri&oacute;dicamente esta p&aacute;gina para comprobar el progreso de los valores reflejados. <br />
    <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: history.back()" />
    </td>
    <td align="center" class="datos_formularios">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
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


