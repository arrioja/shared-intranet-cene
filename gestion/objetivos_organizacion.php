<?php 
/*
* Este archivo realiza el llamado al modulo para la inserción de los planes estratégicos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/?>

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

<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../progressbar/lib/style.css" rel="stylesheet" type="text/css" media="screen" />
<script language="javascript" type="text/javascript" src="../progressbar/lib/prototype.js"></script>
<script language="javascript" type="text/javascript" src="../progressbar/lib/progress.js"></script>

<script language="javascript" type="text/javascript">


</script>





<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<script src="../../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
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
<?php 
include "../db/conexion.php";
$link=conectarse("gestion");
$cod=$_GET['seleccionado'];
 
$sql=mysql_query("select oe.codigo, oe.nombre, oe.completados, oe.codigo_plan_estrategico, pe.codigo, pe.nombre, pe.codigo_organizacion, o.codigo, o.nombre, oe.tiempo_ejecucion from gestion.gestion_obj_estrategicos oe inner join gestion.gestion_planes_estrategicos pe on (oe.codigo_plan_estrategico=pe.codigo) inner join organizacion.organizaciones o on (pe.codigo_organizacion=o.codigo) WHERE oe.codigo_plan_estrategico=$cod",$link);
/* $a=mysql_fetch_array($sql);
$b=$a[5]; */
?>
<form id="f1" name="form1" method="POST" action="">
  <p>&nbsp;</p>
  <table width="800" border="1" align="center" cellpadding="2">
    <tr class="encabezado">
      <td colspan="4" align="center" id="fila_1"><div align="center"><strong><img src="../imgs/Volume Manager.png" width="24" height="24" />Indicadores de Objetivos Estrat&eacute;gicos Organizaci&oacute;n</strong><strong></strong></div></td>
    </tr>
    <tr><?php /* $result=mysql_fetch_array($sql);{ ?>
      <td colspan="3"><?php echo $result[5]  ?></td>
      <?php } */?>
    </tr>
    <tr>
      <td height="25" id="plan2"><div align="center"><strong>C&oacute;digo</strong></div></td>
      <td id="plan2"><div align="center"><strong>Nombre</strong></div></td>
      <td width="30%" id="plan2"><strong>Indicador de Cumplimiento</strong></td>
      <td width="20%" height="25" id="plan2"><div align="center"><strong>Indicador de Tiempo</strong></div></td>
    </tr>
    <tr>
    <?php while ($result=mysql_fetch_array($sql)){?>
    <input name="oculto" type="hidden" value="<?php echo $result[8] ?>" />
      <td width="7%" height="25" id="plan"><div align="center"><?php echo $result[0] ?></div></td>
      <td width="43%" id="plan"><div align="left"><?php echo $result[1] ?></div></td>
      <td height="25"><div id="demo2">
        <div align="center">
          <script>display ('element2',<?php echo $result[2]?>,1);</script>
          <span>Completado</span></div>
      </div></td>
      <td height="25" id="plan">
        <div align="center">
          <?php if ($result[9]=='0') echo "<img src='../imag/por_iniciar.png' border='0' title='Muy Retrasada'/>"; else if ($result[9]=='1') echo "<img src='../imag/en_proceso.png' border='0' title='Retraso Moderado'/>"; else if ($result[9]=='2') echo "<img src='../imag/finalizada.png' border='0' title='En Tiempo'/>"?>
          <?php if ($result[9]=='0') echo "Retraso Grave"; else if ($result[9]=='1') echo "Retraso Moderado"; if ($result[9]=='2') echo "En Tiempo";  ?>
        </div></td>
    </tr>
     <?php }?>
  </table>
  
  <p align="center">
    <input type="button" name="volver" id="volver" value="Men&uacute; Indicadores" onclick="javascript: location.href='menu_indicadores.php'" />
  </p>
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
