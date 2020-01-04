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
<?php include "../templates/CENE_MENU_PRINCIPAL.dwt" ?>







<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />


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
<?php

   include ("../conexion/conectar.php");
   $cod=$_GET['cod'];
   $result=mysql_query("SELECT * FROM gestion_fases where id ='$cod'");
   $row=mysql_fetch_array($result);

//busco cod actividad
   $result_cod=mysql_query("SELECT cod_actividad FROM gestion_fases where id ='$cod'");
   $row2=mysql_fetch_array($result_cod);
  // $cod_actividad=$row2["cod_actividad"]
?>


 

<form id="f1" name="form1" method="post" action="guarda_modificacion.php?seleccionado=<?php echo $cod ?>">
  <p>&nbsp;</p>
  <table width="658" border="1" align="center" cellpadding="2" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="encabezado">
      <td colspan="3"><div align="center" class="style3"><strong><img src="../imgs/usuario.png" alt="" width="57" height="45" />Estado de Fase</strong></div></td>
    </tr>
      
    <tr>
      <td><strong>Nombre de la Fase</strong></td>
      <td><label>
        <input type="text" name="nombre" id="textfield" value="<?php echo $row['nombre'];?>" />
      </label></td>
    </tr>
    <tr>
      <td><strong>Estado</strong></td>
      <td id="objetivo"><label>
        <select name="estado" id="estado"  disabled="disabled">
          <option value="0" <?php if ($row['estado']=='0') echo "selected='selected'";?>>Por Iniciar</option>
          <option value="1"<?php if ($row['estado']=='1') echo "selected='selected'";?>>En Proceso</option>
          <option value="2"<?php if ($row['estado']=='2') echo "selected='selected'";?>>Finalizada</option>
        </select>
      </label></td>
    </tr>
  </table>
  <p>
  <label>
  <div align="center">
<p align="center"><a href="incluir_fases.php?codigo_actividad=<?php echo $row2['cod_actividad']?>"></a>
  <input type="submit" name="insertar" id="button" value="Guardar Cambios" />
  <a href="incluir_fases.php?codigo_actividad=<?php echo $row2['cod_actividad']?>">
  <input type="submit" name="atras" id="atras" value="Atras"   />
  </a></p>
<p align="center">&nbsp;</p>
</label>
</form>
<script type="text/javascript">
<!--
//-->
//carga_objetivo_operativo();
muestra_fases();
//carga_fase();
</script>
<script type="text/javascript">
</script>

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
