<?php
include("includes/miclase.php");
$link=conectarse("nomina");
$result=mysql_query("select * from nomina_actual where status='ACTIVA'",$link);
$datos = mysql_fetch_array($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Configuraci&oacute;n Actual de la N&oacute;mina</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <script type="text/javascript" src="jscalendar/calendar.js"></script>
  <script type="text/javascript" src="jscalendar/lang/calendar-espanol.js"></script>
  <script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="634" border="1" align="center">
    <tr>
      <td width="97"><strong>C&oacute;digo</strong></td>
      <td width="138"><span id="sprytextfield1">
        <input name="codigo" type="text" id="codigo" size="10" maxlength="6" value="<?php echo $datos["cod"];?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td width="86"><strong>T&iacute;tulo</strong></td>
      <td colspan="2"><span id="sprytextfield7">
        <input name="titulo" type="text" id="titulo" size="30" value="<?php echo $datos["titulo"];?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Status</strong></td>
      <td><span id="spryselect1">
        <select name="status" id="status">
          <option value="ACTIVA" <?php if ($datos["status"]=='ACTIVA') echo 'selected="selected"';?>>ACTIVA</option>
          <option value="INACTIVA" <?php if ($datos["status"]=='INACTIVA') echo 'selected="selected"';?>>INACTIVA</option>
        </select>
      </span></td>
      <td><strong>Per&iacute;odo</strong></td>
      <td colspan="2"><span id="sprytextfield6">
        <input name="periodo" type="text" id="periodo" size="10" value="<?php echo $datos["periodo"] ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Fecha Inicial</strong></td>
      <td><input name="f_ini" type="text" id="f_ini" size="10" readonly="1" value="<?php echo cambiaf_a_normal($datos['f_ini']);?>"/>
      <img src="jscalendar/img.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />&nbsp;</td>
      <td><strong>Fecha Final</strong></td>
      <td width="164"><input name="f_fin" type="text" id="f_fin" size="10" readonly="1" value="<?php echo cambiaf_a_normal($datos['f_fin']);?>"/>
      <img src="jscalendar/img.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />&nbsp;</td>
      <td width="115"><a href="configuraciones.php">Configuraciones</a></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="guardar" id="guardar" value="Guardar" />
      </div></td>
      <td colspan="3"><div align="center"><a href="crear_nomina.php">Volver</a></div></td>
    </tr>
  </table>
</form>
<?php 
if (isset($_POST['guardar']))		
	{
	$objeto = new miclase();
	mysql_query("BEGIN",$link);//empezar transaccion
	
	if ($objeto->insertar_nomina_actual($_POST['codigo'],$_POST['titulo'],cambiaf_a_mysql($_POST['f_ini']),cambiaf_a_mysql($_POST['f_fin']),$_POST['periodo'],$_POST['status'],$link)==true)
		{
		mysql_query("COMMIT",$link);//ejecutar transaccion
	    abrir_popup("mensaje.php?texto=Configuracion de la Nomina ActualizadaA&imagen=tips.png","top=200 ,left=500 ,width=400, height=200, scrollbars=no, menubar=no, location=no, resizable=no");
		echo '<script languaje="Javascript">location.href="nomina_actual.php"</script>';
		}
	else
		{
		$error= mysql_error($link);
		mysql_query("ROLLBACK",$link);//devolver transaccion
	    abrir_popup("mensaje.php?texto=$error&imagen=error.png","top=200 ,left=500 ,width=400, height=200, scrollbars=no, menubar=no, location=no, resizable=no");
		}
	}	
?>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_ini",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_fin",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
//-->
</script>
</body>
</html>
