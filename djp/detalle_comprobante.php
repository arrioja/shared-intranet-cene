<?php 
   $id_comprobante=$_POST['id'];
   require("../db/conexion.php");
   require("../libs/utilidades.php");
   $cedula=$_POST['cedula'];
   $link=conectarse("djp");   
   $consulta_comprobantes = mysql_query("select * from djp.comprobantes c where c.id=$id_comprobante", $link); 
   $consulta_declarantes = mysql_query("select * from djp.declarantes d where d.cedula=$cedula", $link); 
   
   $resultado2=mysql_fetch_array($consulta_declarantes);
   $resultado=mysql_fetch_array($consulta_comprobantes);
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
<form action="db/djp_guarda.php" method="get" target="_self">
  <br />
  <table width="605" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2"><div align="center"><strong>Datos del Declarante:</strong></div></td>
    </tr>
    <tr>
      <td width="140" class="titulos_formularios"><div align="right"><strong>C&eacute;dula:&nbsp;</strong></div></td>
      <td width="459" class="datos_formularios">
      <label>&nbsp;&nbsp;<?php echo $resultado2['cedula']; ?>        </label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><div align="right"><strong>Nombres:&nbsp;</strong></div></td>
      <td class="datos_formularios">
      <label>&nbsp;&nbsp;<?php echo $resultado2['nombre']; ?></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><div align="right"><strong>Apellidos:&nbsp;</strong></div></td>
      <td class="datos_formularios">
      <label>&nbsp;&nbsp;<?php echo $resultado2['apellido']; ?></label></td>
    </tr>
    <tr class="encabezado_formularios">
      <td colspan="2"><div align="center"><strong>Datos del Comprobante:</strong></div></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><div align="right"><strong>Instituto:&nbsp;</strong></div></td>
      <td class="datos_formularios">
      <label>&nbsp;&nbsp;<?php echo $resultado['instituto']; ?></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><div align="right"><strong>Cargo:&nbsp;</strong></div></td>
      <td class="datos_formularios">
      <label>&nbsp;&nbsp;<?php echo $resultado['cargo']; ?></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><div align="right"><strong>Nro. -Comprob:&nbsp;</strong></div></td>
      <td class="datos_formularios">
      <label>&nbsp;&nbsp;<?php echo $resultado['iddoc']; ?></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><div align="right"><strong>Nro. de Folios:&nbsp;</strong></div></td>
      <td class="datos_formularios">
      <label>&nbsp;&nbsp;<?php echo $resultado['folios']; ?></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><div align="right"><strong>Nro. de Anexos:&nbsp;</strong></div></td>
      <td class="datos_formularios">
      <label>&nbsp;&nbsp;<?php echo $resultado['anexos']; ?></label></td>
    </tr>
    
     <tr>
      <td class="titulos_formularios" ><div align="right"><strong>Fecha:</strong>&nbsp;</div></td>
      <td valign="middle" class="datos_formularios">   
&nbsp;&nbsp;<?php echo cambiaf_a_normal($resultado['fecha']); ?></td>
    </tr>
    
    
    <tr>
      <td class="titulos_formularios"><div align="right"><strong>Tipo:&nbsp;</strong></div></td>
      <td class="datos_formularios">
      <label>&nbsp;&nbsp;<?php echo $resultado['status']; ?></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><div align="right"><strong>Observaciones: (m&aacute;x 200 letras)</strong></div></td>
      <td class="datos_formularios">
      <label>&nbsp;&nbsp;<?php echo $resultado['observaciones']; ?></label></td>
    </tr>
    <tr class="datos_formularios">
      <td colspan="2" align="center"><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
      <label>Para ir art&aacute;s haga click <a href="javascript:history.back()">AQUI</a></label></td>
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
