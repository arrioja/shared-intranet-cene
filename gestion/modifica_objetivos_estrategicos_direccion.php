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
<?php 
include "../db/conexion.php";
$link=conectarse("organizacion");

$cod=$_GET['seleccionado'];
$consulta="select oe.codigo, oe.nombre, oe.descripcion, oe.cod_plan_e_dir, pe.codigo, pe.nombre, pe.cod_direccion, d.codigo, d.nombre_completo, d.codigo_organizacion, o.codigo, o.nombre from gestion.gestion_obj_estrategicos_direcciones oe inner join gestion.gestion_planes_estrategicos_direcciones pe on (oe.cod_plan_e_dir=pe.codigo) inner join organizacion.direcciones d on (pe.cod_direccion=d.codigo) inner join organizacion.organizaciones o on (d.codigo_organizacion=o.codigo) where oe.codigo='$cod'";
$result=mysql_query($consulta,$link);
$row=mysql_fetch_array($result);

?>


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
<form id="f1" name="form1" method="post" action="guarda_modificacion_obj_es_dir.php?seleccionado=<?php echo $cod ?>">
  <table width="602" border="1" align="center" cellpadding="2">
    <tr bgcolor="#FFFFFF" class="encabezado">
      <td height="72" colspan="2" id="fila_1"><div align="center" class="style2"><strong><img src="../imgs/usuario.png" alt="" width="58" height="50" />Registro de Objetivos Estrat&eacute;gicos</strong> <strong>Direcci&oacute;n</strong></div></td>
    </tr>
    <tr>
      <td width="36%" id="nombre"><strong>Organizaci&oacute;n</strong></td>
      <td width="64%" id="nombre"><input type="text" name="organizacion" id="organizacion" disabled="disabled" value="<?php echo $row[11] ?>"/></td>
    </tr>
    <tr>
    
      <td width="36%" align="center" id=><div align="justify"> <strong>Direcci&oacute;n</strong></div> </td>       
      <td width="64%" align="" id="cod">
        <input type="text" name="direccion" id="direccion" disabled="disabled" value="<?php echo $row[8]?>" />   </td>
    </tr>
    <tr>
      <td width="36%" align="center" id=><div align="justify"><strong>Plan Estrat&eacute;gico</strong> <strong>Direcci&oacute;n</strong></div></td>
      <td width="64%" align="" id="plan">
        <input type="text" name="plan" id="plan"  disabled="disabled" value="<?php echo $row[5]?>"/>    </td>
    </tr>
    <tr>
      <td><strong>C&oacute;digo</strong></td>
      <td><label>
        <input type="text" name="codigo" id="codigo" disabled="disabled" value="<?php echo $row[0]?>"/>
      </label></td>
    </tr>
    <tr>
      <td><strong>Nombre</strong></td>
      <td>
        <input name="nombre" type="text" id="nombre2" size="60" value="<?php echo $row[1]?>" />     </td>
    </tr>
    <tr>
      <td align="justify" id="plan"><strong>Descripci&oacute;n</strong></td>
      <td align="justify" id="plan"><label>
        <input name="descripcion" type="text" id="descripcion" size="60" value="<?php echo $row[2]?>"/>
      </label></td>
    </tr>
    <tr class="encabezado">
      <td colspan="2" >
        <div align="center">
          <input type="submit" name="insertar" id="button" value="Guardar" />
          
          <input type="submit" name="atras" id="atras" value="Atras" />
      </a>        </div>      </td>
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
