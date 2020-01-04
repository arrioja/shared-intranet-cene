<?php 
/*
* Este archivo muestra el listado de direcciones almacenadas en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/
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


<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
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
<?php include "../db/conexion.php";
$link=conectarse("gestion");
$result=mysql_query("select * from organizacion.organizaciones order by codigo asc",$link);
?>
<form id="form1" name="form1" method="post" action="organizacion.php">
  <table width="535" border="1" align="center" cellpadding="2">
    <tr class="encabezado">
      <td><div align="center"><strong><img src="../imgs/j0432636.png" width="54" height="40" /></strong></div></td>
      <td><div align="center"><strong>Listado de Organizaciones</strong></div></td>
    </tr>
    <tr>
      <td width="92"><div align="center"><strong>Código</strong></div></td>
      <td width="367"><div align="justify"><strong>Nombre</strong></div></td>
    </tr>
    <?php while ($row=mysql_fetch_array($result)){?>
    <tr>
      <td><div align="center"><?php echo $row[1] ?></div></td>
      <td><div align="justify"><?php echo $row[2] ?></div></td>
    </tr>

    <?php }?>
  </table>
<p>
    <label>
    <div align="center">
  <div align="center">
    <p>
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='menu.php'" />
    <a href="fpdf/reporte_organizacion.php" target="_blank"><img src="../imgs/printer.png"  border="0" title="Imprimir"/></a>      </p>
    <p>&nbsp;</p>
  </div>
  </label>
</form>
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
