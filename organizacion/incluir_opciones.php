<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra la forma para incluir datos de horarios, cantidad maxima de permisos, etc. 
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 require("../libs/utilidades.php");
 require("../db/conexion.php");
 
 $link=conectarse("asistencias"); 
 $consulta=mysql_query("select * from opciones where status='1'",$link) or die(mysql_error());
 $resultado=mysql_fetch_array($consulta);
 session_start();
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
<script type="text/javascript" src="../libs/calendar/calendar.js"></script>
<script type="text/javascript" src="../libs/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="../libs/calendar/lang/calendar-es.js"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<style type="text/css"> @import url("../css/calendar-win2k-cold-1.css"); </style>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
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
<form id="form1" name="form1" method="post" action="db/inserta_opciones.php">
  <p>&nbsp;</p>
  <table width="460" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="5" class="encabezado_formularios">Opciones generales de Asistencias</td>
    </tr>
    <tr>
      <td colspan="5" class="encabezado_formularios">Horario de Trabajo</td>
    </tr>
    <tr>
      <td width="171" class="titulos_formularios">Hora Entrada:</td>
      <td colspan="4" valign="middle" class="datos_formularios"><span id="sprytextfield5">
      <input name="hora_entrada" type="text" id="hora_entrada" value="<?php echo date("h:i A",strtotime($resultado['hora_entrada']));?>" size="12" maxlength="10" />
      <img src="../imgs/jscalendar.gif" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
      <script type="text/javascript">
            Calendar.setup({
              inputField    : "hora_entrada",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%I:%M %p",
			  showsTime		: "true",
			  timeFormat	: "12"
            });
          </script>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span> </td>
    </tr>

    <tr>
      <td class="titulos_formularios">Hora Salida:</td>
      <td colspan="4" valign="middle" class="datos_formularios"><span id="sprytextfield6">
      <input name="hora_salida" type="text" id="hora_salida" value="<?php echo date("h:i A",strtotime($resultado['hora_salida']));?>" size="12" />
      <img src="../imgs/jscalendar.gif" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
      <script type="text/javascript">
            Calendar.setup({
              inputField    : "hora_salida",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%I:%M %p",
			  showsTime		: "true",
			  timeFormat	: "12"
            });
          </script>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
        <tr>
      <td class="titulos_formularios">Holgura Entrada:</td>
      <td colspan="4" class="datos_formularios">&nbsp;<select name="min_entrada" id="min_entrada">
		<?php for($x=0;$x<=60;$x++) { ?>
        <option value="<?php echo $x?>" <?php if ($resultado['holgura_entrada']==$x) { echo " selected='selected'"; } ?>>
          <?php if ($x<=9) {echo '0'.$x;} else {echo $x;} ?>
          </option>
        <?php } ?>
      </select> 
        (minutos)</td>
    </tr>
    <tr>
      <td colspan="5" class="encabezado_formularios">Horario de Almuerzo</td>
    </tr>
    <tr>
      <td class="titulos_formularios">Hora Salida:</td>
      <td colspan="4" valign="middle" class="datos_formularios"><span id="sprytextfield7">
      <input name="hora_salida_almuerzo" type="text" id="hora_salida_almuerzo" value="<?php echo date("h:i A",strtotime($resultado['almuerzo_salida']));?>" size="12" maxlength="10" />
      <img src="../imgs/jscalendar.gif" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
      <script type="text/javascript">
            Calendar.setup({
              inputField    : "hora_salida_almuerzo",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%I:%M %p",
			  showsTime		: "true",
			  timeFormat	: "12"
            });
          </script>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Hora Entrada:</td>
      <td colspan="4" valign="middle" class="datos_formularios"><span id="sprytextfield8">
      <input name="hora_entrada_almuerzo" type="text" id="hora_entrada_almuerzo" value="<?php echo date("h:i A",strtotime($resultado['almuerzo_entrada']));?>" size="12" maxlength="10" />
      <img src="../imgs/jscalendar.gif" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
      <script type="text/javascript">
            Calendar.setup({
              inputField    : "hora_entrada_almuerzo",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%I:%M %p",
			  showsTime		: "true",
			  timeFormat	: "12"
            });
          </script>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Duraci&oacute;n Almuerzo:</td>
      <td colspan="4" class="datos_formularios">&nbsp;<select name="min_almuerzo" id="min_almuerzo">
       		<?php for($x=0;$x<=60;$x++) { ?>
        <option value="<?php echo $x?>" <?php if ($resultado['almuerzo_minutos']==$x) { echo " selected='selected'"; } ?>>
          <?php if ($x<=9) {echo '0'.$x;} else {echo $x;} ?>
          </option>
        <?php } ?>
      </select> 
        (minutos)</td>
    </tr>
    <tr>
      <td class="titulos_formularios"> Permisos Potestativos:</td>
      <td colspan="4" class="datos_formularios">&nbsp;<select name="max_pot" id="max_pot">
       		<?php for($x=0;$x<=5;$x++) { ?>
        <option value="<?php echo $x?>" <?php if ($resultado['max_pot']==$x) { echo " selected='selected'"; } ?>>
          <?php if ($x<=9) {echo '0'.$x;} else {echo $x;} ?>
          </option>
        <?php } ?>
      </select> 
        (permisos m&aacute;ximo al mes)</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" class="datos_formularios"><div align="center">&Eacute;ste registro fu&eacute; actualizado el: <?php echo date("d/m/Y",strtotime($resultado['vigencia'])).' a las '.date("h:i A",strtotime($resultado['vigencia']));?> </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><input type="submit" name="Incluir" id="Incluir" value="Actualizar" />
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "time", {format:"hh:mm tt", validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "time", {format:"hh:mm tt", validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "time", {format:"hh:mm tt", validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "time", {format:"hh:mm tt", validateOn:["blur"]});
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
