<?php
session_start();
include("../db/conexion.php");
//include("includes/miclase.php");
$link=conectarse("nomina");
$result=mysql_query("select distinct n.cod,n.tipo_nomina, na.titulo from nomina n inner join nomina_actual na on n.cod=na.cod",$link);

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
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" --><br />
<table width="700" border="1" cellpadding="0" cellspacing="0" align="center">
  <tr class="encabezado_formularios">
    <td colspan="4" align="center"><strong>Listado de Nóminas</strong></td>
  </tr>
  <tr>
    <td width="48" class="encabezado_formularios"><strong>Cod</strong></td>
    <td class="encabezado_formularios"><strong>Descripci&oacute;n</strong></td>
    <td width="152" class="encabezado_formularios"><strong>Tipo de N&oacute;mina</strong></td>
    <td width="159" class="encabezado_formularios"><strong>Acciones</strong></td>
  </tr>
  <?php while($nomina=mysql_fetch_array($result)){?>
  <tr class="datos_formularios">
    <td><?php echo $nomina['cod'];?></td>
    <td><?php echo $nomina['titulo'];?></td>
    <td><?php echo $nomina['tipo_nomina'];?></td>
    <td><a href="includes/copiar_historial.php?cod=<?php echo $nomina['cod'];?>&tipo=<?php echo $nomina['tipo_nomina'];?>">Pasar a Historial</a> <a href="includes/eliminar_nomina.php?cod=<?php echo $nomina['cod'];?>&tipo=<?php echo $nomina['tipo_nomina'];?>">Eliminar</a></td>  </tr>
  <?php }?>
   <tr class="datos_formularios">
    <td colspan="4" align="right" background="crear_nomina.php"><a href="crear_nomina.php">Volver</a></td>
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
