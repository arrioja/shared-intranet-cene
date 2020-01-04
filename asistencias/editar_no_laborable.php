<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra la forma para editar el un dia no laborable
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 $id=$_GET['id'];
 include("../db/conexion.php");
 $link=conectarse("organizacion");
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 $consulta=mysql_query("select * from dias_no_laborables where id='$id'") or die(mysql_error());
 $resultado=mysql_fetch_array($consulta);
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
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
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
<form id="form1" name="form1" method="post" action="db/edita_no_laborable.php">
  <br />
  <table width="400" border="1" align="center" cellpadding="0" cellspacing="0" class="datos_formularios">
    <tr>
      <td colspan="2"><div align="center" class="encabezado_formularios">Editar fecha NO LABORABLE</div></td>
    </tr>
    <tr>
      <td class="titulos_formularios">D&iacute;a:</td>
      <td><select name="dia" id="dia">
          <?php 
		  for($i=1;$i<=31;$i++) { ?>
			<option value="<?php echo $i; ?>" <?php if ($resultado['dia']==$i) { echo " selected='selected'"; } ?>><?php echo $i; ?></option>;
			<?php }?>
      </select>
      <input name="id" type="hidden" id="id" value="<?php echo $resultado['id']; ?>" />      </td>
    </tr>
    <tr>
      <td class="titulos_formularios">Mes:</td>
      <td><select name="mes" id="mes">
        <option value="1" <?php if ($resultado['mes']=='01') { echo " selected='selected'"; } ?>>Enero</option>
        <option value="2" <?php if ($resultado['mes']=='02') { echo " selected='selected'"; } ?>>Febrero</option>
        <option value="3" <?php if ($resultado['mes']=='03') { echo " selected='selected'"; } ?>>Marzo</option>
        <option value="4" <?php if ($resultado['mes']=='04') { echo " selected='selected'"; } ?>>Abril</option>
        <option value="5" <?php if ($resultado['mes']=='05') { echo " selected='selected'"; } ?>>Mayo</option>
        <option value="6" <?php if ($resultado['mes']=='06') { echo " selected='selected'"; } ?>>Junio</option>
        <option value="7" <?php if ($resultado['mes']=='07') { echo " selected='selected'"; } ?>>Julio</option>
        <option value="8" <?php if ($resultado['mes']=='08') { echo " selected='selected'"; } ?>>Agosto</option>
        <option value="9" <?php if ($resultado['mes']=='09') { echo " selected='selected'"; } ?>>Septiembre</option>
        <option value="10" <?php if ($resultado['mes']=='10') { echo " selected='selected'"; } ?>>Ocubre</option>
        <option value="11" <?php if ($resultado['mes']=='11') { echo " selected='selected'"; } ?>>Noviembre</option>
        <option value="12" <?php if ($resultado['mes']=='12') { echo " selected='selected'"; } ?>>Diciembre</option>
      </select>      </td>
    </tr>
    <tr>
      <td class="titulos_formularios">A&ntilde;o:</td>
      <td><select name="ano" id="ano">
        <option value="XXXX">Todos</option>
        <?php 
		  
		   for($i=2008;$i<=2020;$i++) 
		     { ?>;
		  	    <option value="<?php echo $i; ?>" <?php if ($resultado['ano']==$i) { echo " selected='selected'"; } ?>><?php echo $i; ?></option>;
			<?php }?>	
      </select>      </td>
    </tr>
    <tr>
      <td width="106" class="titulos_formularios">Descripci&oacute;n:</td>
      <td width="288"><span id="sprytextarea1">
        <label>
        <textarea name="desc" id="desc" cols="45" rows="5"><?php echo $resultado['descripcion']; ?></textarea>
        </label>
        <span class="textareaRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="right">
        <input type="submit" name="Incluir" id="Incluir" value="Editar" />
        &nbsp;&nbsp;
        <input type="button" name="Cancelar" id="Cancelar" value="Listado" onclick="javascript: location.href='listar_no_laborables.php'" />
      </div></td>
    </tr>
  </table>
  <div align="center"></div>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
//-->
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
