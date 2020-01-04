<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Permite editar una actuación fiscal.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 $id=$_GET['id'];
 include("../db/conexion.php");
 include("../libs/utilidades.php");
 $link=conectarse("asistencias");
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 $consulta=mysql_query("SELECT a.*, e.codigo, e.tipo 
 						FROM actuaciones as a,entes_organos as e 
 						WHERE ((a.codigo_ente_organismo=e.codigo) and 
						       (a.id='$id'))
						ORDER BY desde,oficio DESC") or die(mysql_error());
 $resultado=mysql_fetch_array($consulta);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Editar Actuaci&oacute;n Fiscal</title>
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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript" src="../libs/calendar/calendar.js"></script>
<script type="text/javascript" src="../libs/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="../libs/calendar/lang/calendar-es.js"></script>
<style type="text/css"> @import url("../css/calendar-win2k-cold-1.css"); </style>

<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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

    <script language="javascript" type="text/javascript">
      <!--
      // Obtiene el objeto HTTP
      function getHTTPObject()
	  {
        if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
        else 
		  if (window.XMLHttpRequest) return new XMLHttpRequest();
          else 
		  {
            alert("Su Explorador no soporta AJAX, habilite JavaScript.");
            return null;
          }
      }
       
      // Cambia el valor del control que recibe la salida
      function setOutput()
	  {
        if(httpObject.readyState == 4)
		  {
            var combo = document.getElementById('ente');
            combo.options.length = 0;
       
            var response = httpObject.responseText;
            var items = response.split("/");
			// lo normal es que la linea siguiente diga: var count = items.length;  pero tuve que ponerle -1 porque el último
			// caracter que la cadena siempre trae es un ";" y lo lee como un elemento mas, y me deja una linea vacia, asi
			// que con el -1 se elimina este inconveniente
            var count = items.length-1;
            for (var i=0;i<count;i++)
			  {
                var options = items[i].split("-");
				if (options[1] == <?php echo $resultado['codigo'];?>) { combo.options[i] = new Option(options[0],options[1],"defaultSelected"); }
				else { combo.options[i] = new Option(options[0],options[1]); }
              }
          }
      }
       
      // Se genera la lista de entes y órganos sujetos a control dependiendo del tipo
      function listar()
	  {
        httpObject = getHTTPObject();
        if (httpObject != null) 
		  {
            httpObject.open("GET", "db/obtener_entes.php?tipo="+document.getElementById('tipo').value, true);
            httpObject.onreadystatechange = setOutput;
            httpObject.send(null);
          }
      }

      var httpObject = null;

      //-->
    </script>
    <br />
  <form id="form1" name="form1" method="post" action="db/edita_actuacion_fiscal.php">
    <table width="552" border="1" align="center" cellpadding="0" cellspacing="0" class="datos_formularios">
    <tr>
      <td colspan="2"><div align="center" class="encabezado_formularios">Editar datos de actuaci&oacute;n fiscal</div></td>
    </tr>
    <tr>
      <td width="200" class="titulos_formularios"> Oficio Presentaci&oacute;n:</td>
      <td><span id="sprytextfield1">
      <input name="oficio" type="text" id="oficio" value="<?php echo $resultado['oficio']; ?>" size="20" maxlength="15" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
        <input name="id" type="hidden" id="id" value="<?php echo $id; ?>" />
        <input name="oficioviejo" type="hidden" id="oficioviejo" value="<?php echo $resultado['oficio']; ?>" /></td>
    </tr>
    <tr>
      <td width="200" class="titulos_formularios"> Tipo de Ente/&Oacute;rgano:</td>
      <td><span id="spryselect3">
        <select name="tipo" id="tipo" onchange="listar()" >
          <option value="-1" selected="selected">Seleccione Tipo</option>
          <option value="C" <?php if ($resultado['tipo']=="C"){ echo 'selected="selected"';}?> onchange="listar()">Centralizado</option>
          <option value="D" <?php if ($resultado['tipo']=="D"){ echo 'selected="selected"';}?> onchange="listar()">Descentralizado</option>
                        </select>
        <span class="selectInvalidMsg">Seleccione un elemento válido.</span>        <span class="selectRequiredMsg">Seleccione un elemento.</span></span> </td>
    </tr>
    
    <tr>
      <td class="titulos_formularios">Ente u &Oacute;rgano:</td>
      <td width="346"><span id="spryselect1">
        <select name="ente" id="ente">
          <option value="-1">Seleccione el Ente u Organismo</option>
        </select>
        <script> listar(); </script>
        <span class="selectInvalidMsg">Seleccione un elemento válido.</span>        <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">D&iacute;as h&aacute;biles:</td>
      <td><span id="spryselect2">
        <select name="dias" id="dias">
          <option value="-1">00</option>
          <?php for ($co=1;$co<=100;$co++) {?>
          <option value="<?php echo $co; ?>" <?php if ($resultado['dias_habiles']==$co){ echo 'selected="selected"';}?>>
            <?php if ($co<10){echo "0";} echo $co;?>
            </option>
          <?php }?>
        </select>
        <span class="selectInvalidMsg">Seleccione un elemento válido.</span>        <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Fecha de Inicio:</td>
      <td><span id="sprytextfield2">
      <input name="desde" type="text" id="desde" value="<?php echo cambiaf_a_normal($resultado['desde']); ?>" size="13" maxlength="10" />
      <img src="../imgs/jscalendar.gif" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
        <script type="text/javascript">
            Calendar.setup({
              inputField    : "desde",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%d/%m/%Y"
            });
          </script>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>


    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><div align="right">
          <input type="submit" name="Incluir" id="Incluir" value="Modificar" />
        &nbsp;&nbsp;
        <input type="button" name="Cancelar" id="Cancelar" value="Listado" onclick="javascript: location.href='listar_actuaciones.php'" />
      </div></td>
    </tr>
</table>
  <div align="center"></div>
  <table width="552" border="1" align="center" cellpadding="0" cellspacing="0" class="datos_formularios">
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"], invalidValue:"-1"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd/mm/yyyy", validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {invalidValue:"-1", validateOn:["blur"]});
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
