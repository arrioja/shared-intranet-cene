<?php session_start();?>
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




<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />


<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
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
   $cod=$_GET['cod'];
   $result=mysql_query("SELECT * FROM gestion.gestion_fases where id ='$cod'");
   $row=mysql_fetch_array($result);

//busco cod actividad
   $result_cod=mysql_query("SELECT cod_actividad FROM gestion.gestion_fases where id ='$cod'");
   $row2=mysql_fetch_array($result_cod);
  // $cod_actividad=$row2["cod_actividad"]
?>


<form id="f1" name="form1" method="post" action="actualiza_estado_fase.php">
  <p>&nbsp;</p>
  <table width="658" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="titulos_formularios">
      <td colspan="3"><div align="center" class="style3"><strong>Estado de Fase</strong>
              <input name="id" type="hidden" id="id" value="<?php echo $row['id'];?>" />
      </div></td>
    </tr>
      
    <tr>
      <td class="titulos"><strong>Nombre de la Fase</strong></td>
      <td class="datos_formularios"><span id="sprytextfield2">
        <label>
        <input name="nombre" type="text" id="nombre" value="<?php echo $row['nombre'];?>" size="50" />
        </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td class="titulos"><strong>Fecha</strong></td>
      <td class="datos_formularios"><label>
        <input type="text" name="fecha" id="fecha"  value="<?php echo date('d/m/Y');?>" readonly="readonly"/>
      </label></td>
    </tr>
    <tr>
      <td class="titulos"><strong>Estado</strong></td>
      <td class="datos_formularios" id="objetivo"><label>
        <select name="estado" id="estado">
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
<p align="center">
  <input type="submit" name="Button" id="button" value="Guardar Cambios" />
  <a href="incluir_fases.php?codigo_actividad=<?php echo $row2['cod_actividad']?>">
  <input  type="button" name="atras" id="atras" value="Atras"   />
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>

<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Friday, 19 September, 2008 10:22 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
