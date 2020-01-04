<?php 
 session_start();
 $cant=$_POST['cant']; // Para saber si es individual o en grupo.
  include("../db/conexion.php");
 $link=conectarse("asistencias");
 $link2=conectarse("organizacion");
  
 if ($cant=="uno"){ 
    $cedula=$_POST['cedula'];
    $consulta_integrantes=mysql_query("select id, p.cedula, p.nombres, p.apellidos from organizacion.personas as p where cedula='$cedula'",$link2) or die(mysql_error());
    $resultado_integrantes=mysql_fetch_array($consulta_integrantes);	
	} 
 else{ $lista_cedulas=$_POST['sel']; }
 

 
 
 $consulta_falta=mysql_query("select * from asistencias.tipo_faltas order by descripcion",$link) or die(mysql_error());
 
  $consulta_tipo=mysql_query("select * from asistencias.tipo_justificaciones order by descripcion",$link) or die(mysql_error());
 
 $consulta_opciones=mysql_query("select * from asistencias.opciones where status='1'",$link) or die(mysql_error());
 $resultado_opciones=mysql_fetch_array($consulta_opciones); 
 
// $resultado_tipo=mysql_fetch_array($consulta_tipo);
 
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
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<style type="text/css"> @import url("../css/calendar-win2k-cold-1.css"); </style>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
<form id="form1" name="form1" method="post" action="db/inserta_justificacion.php">
  <br />
  <table width="575" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="5" class="encabezado_formularios">Inclusi&oacute;n de Justificaci&oacute;n</td>
    </tr>
    <tr>
      <td width="171" class="titulos_formularios">C&eacute;dula:</td>
      <td colspan="4" class="datos_formularios"><?php 
      if ($cant=="uno") 
	  {  // si es solo un funcionario, se muestra la cédula y se coloca el valor
	     // en el campo oculto cedula para pasarlo a la otra forma
	    echo $resultado_integrantes['cedula'];  ?>
		<input name="cedula" type="hidden" id="cedula" value="<?php echo $resultado_integrantes['cedula']; ?>" />  <?php
	  } 
	  else 
	  { // si son varios funcionarios, se coloca un mensaje genérico y se crea la lista de cedulas a pasar
	    // a la otra forma (la que guarda en la base de datos.
	    echo "Múltiples funcionarios seleccionados"; ?>
		<input name="cedulas" type="hidden" id="cedulas" value="<?php echo implode(';',$lista_cedulas); ?>" />
      <?php  
	  } ?>      </td>
    </tr>
    <tr>
      <td class="titulos_formularios">Nombre:</td>
      <td colspan="4" class="datos_formularios"><?php 
	   if ($cant=="uno") {echo $resultado_integrantes['apellidos'].' '.$resultado_integrantes['nombres'];} else {echo "Múltiples funcionarios seleccionados";}
  
	   ?></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Desde:</td>
      <td width="52" class="datos_formularios">Fecha:</td>
      <td width="154" class="datos_formularios"><span id="sprytextfield1">
        <input name="fecha_desde" type="text" id="fecha_desde" value="<?php echo date("d/m/Y",strtotime("+1 day"));?>" size="13" maxlength="10" />
        <img src="../imgs/jscalendar.gif" name="f_trigger_a" id="f_trigger_a" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
        <script type="text/javascript">
            Calendar.setup({
              inputField    : "fecha_desde",
              button        : "f_trigger_a",
              align         : "Tr",
			  ifFormat    	: "%d/%m/%Y"
            });
          </script>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
      <td width="35" class="datos_formularios">Hora:</td>
      <td width="177" class="datos_formularios"><span id="sprytextfield2">
        <input name="hora_desde" type="text" id="hora_desde" value="<?php echo date("h:i A",strtotime($resultado_opciones['hora_entrada']));?>" size="12" maxlength="10" />
        <img src="../imgs/jscalendar.gif" name="f_trigger_b" id="f_trigger_b" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
        <script type="text/javascript">
            Calendar.setup({
              inputField    : "hora_desde",
              button        : "f_trigger_b",
              align         : "Tr",
			  ifFormat    	: "%I:%M %p",
			  showsTime		: "true",
			  timeFormat	: "12"
            });
          </script>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Hasta:</td>
      <td class="datos_formularios">Fecha:</td>
      <td class="datos_formularios"><span id="sprytextfield3">
        <input name="fecha_hasta" type="text" id="fecha_hasta" value="<?php echo date("d/m/Y",strtotime("+1 day"));?>" size="13" maxlength="10" />
        <img src="../imgs/jscalendar.gif" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
        <script type="text/javascript">
            Calendar.setup({
              inputField    : "fecha_hasta",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%d/%m/%Y"
            });
          </script>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
      <td class="datos_formularios">Hora:</td>
      <td class="datos_formularios"><span id="sprytextfield4">
        <input name="hora_hasta" type="text" id="hora_hasta" value="<?php echo date("h:i A",strtotime($resultado_opciones['hora_salida']));?>" size="12" maxlength="10" />
        <img src="../imgs/jscalendar.gif" name="f_trigger_d" id="f_trigger_d" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
        <script type="text/javascript">
            Calendar.setup({
              inputField    : "hora_hasta",
              button        : "f_trigger_d",
              align         : "Tr",
			  ifFormat    	: "%I:%M %p",
			  showsTime		: "true",
			  timeFormat	: "12"
            });
          </script>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Falta:</td>
      <td colspan="4" class="datos_formularios"><span id="spryselect1">
        <select name="falta" id="falta">
          <option value="-1">Seleccione</option>
          <?php while($resultado_falta=mysql_fetch_array($consulta_falta)) { ?>
          <option value="<?php echo $resultado_falta['codigo']; ?>"><?php echo $resultado_falta['descripcion']; ?></option>
          <?php }?>
        </select>
        <span class="selectInvalidMsg">Seleccione un elemento válido.</span>        <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Tipo:</td>
      <td colspan="4" class="datos_formularios"><span id="spryselect2">
        <select name="tipo" id="tipo">
          <option value="-1">Seleccione</option>
          <?php while($resultado_tipo=mysql_fetch_array($consulta_tipo)) { ?>
          <option value="<?php echo $resultado_tipo['id']; ?>"><?php echo $resultado_tipo['descripcion']; ?></option>
          <?php }?>
        </select>
        <span class="selectInvalidMsg">Seleccione un elemento válido.</span>        <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Descuenta Ticket?:</td>
      <td colspan="4" class="datos_formularios"><select name="descuento" id="descuento">
        <option value="Si">Si</option>
        <option value="No">No</option>
        </select>
        tengo que ver como actualizar esto via ajax</td>
    </tr>
    <tr>
      <td class="titulos_formularios">Observaciones:</td>
      <td colspan="4" class="datos_formularios"><span id="sprytextarea1">
      <textarea name="observaciones" id="observaciones" cols="45" rows="5"></textarea>
      Quedan:
      <span id="countsprytextarea1">&nbsp;</span>  Caracteres    <span class="textareaMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right"></div></td>
      <td colspan="4"><div align="right">
        <input type="submit" name="Incluir" id="Incluir" value="Incluir" />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" />
      </div></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "time", {format:"hh:mm tt", validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "date", {format:"dd/mm/yyyy", validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "time", {format:"hh:mm tt", validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {maxChars:1500, counterId:"countsprytextarea1", validateOn:["blur"], isRequired:false, counterType:"chars_remaining"});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"-1", validateOn:["blur"]});
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
