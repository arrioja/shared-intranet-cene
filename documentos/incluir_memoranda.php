<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  Realiza la solicitud de un nuevo n�mero de Memorando de acuerdo a los datos de Direcci�n y a�o
  		Modificado el: 	26/08/2008 por Pedro E. Arrioja M. Creaci�n.
						28/08/2008 por Pedro E, Arrioja M. - Se incluye restricci�n para que el usuario solo vea los memos de la direcci�n
								   a la que pertenece y as� no incluya memos en otras Direcciones.
  			  Versi�n: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
 include("../db/conexion.php");
 include("../libs/utilidades.php");
 $link=conectarse("organizacion"); 
 $coddir=$_SESSION['direccion'];
 $consulta=mysql_query("select o.codigo, o.nombre_completo 
 						FROM organizacion.direcciones o 
						WHERE ((o.status='ACTIVO') and (o.codigo='$coddir'))
						ORDER BY o.nombre_completo",$link) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Inclusi&oacute;n de persona nueva en el sistema</title>
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



<script type="text/javascript" src="../libs/calendar/calendar.js"></script>
<script type="text/javascript" src="../libs/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="../libs/calendar/lang/calendar-es.js"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<style type="text/css"> @import url("../css/calendar-win2k-cold-1.css"); </style>

<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.style4 {
	font-size: 9px;
	font-weight: bold;
}
-->
</style>
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
 <SCRIPT language="JavaScript">
<!--
function cargar_contenido(target,valor,func)
{
  var peticion;
  document.getElementById(target).value = 'Cargando Datos...';
  var myConn = new XHConn();
  if (!myConn) alert("XMLHTTP no esta disponible. Intalo con un navegador mas nuevo.");
  peticion=function(oXML){document.getElementById(target).value=oXML.responseText;};
  myConn.connect("../libs/detalle.php?valor="+valor+"&func="+func, "GET", "", peticion);
}
//-->
</SCRIPT>
<script language="JavaScript" src="../libs/XHConn.js"></script>
<form id="form1" name="form1" method="post" action="db/inserta_memoranda.php">
<br />

<table width="537" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr class="encabezado_formularios">
    <td colspan="4">Solicitud de N&uacute;mero para Memorando</td>
  </tr>
  <tr>
    <td width="99" class="titulos_formularios">Direcci&oacute;n:</td>
    <td colspan="3" class="datos_formularios"><span id="spryselect1">
      <select name="dire" id="dire" onchange="MostrarConsulta('listar_memoranda_list.php')">
        <option value="-1" selected="selected">Seleccione una Direcci&oacute;n</option>
        <?php while ($result_dir=mysql_fetch_array($consulta)) 
		  {?>
        <option value="<?php echo $result_dir['codigo']; ?>"><?php echo $result_dir['nombre_completo'];?></option>
        <?php }?>
      </select>
      <span class="selectInvalidMsg">Please select a valid item.</span>      <span class="selectRequiredMsg">Please select an item.</span></span> </td>
  </tr>
  <tr>
    <td class="titulos_formularios">A&ntilde;o:</td>
    <td width="137" class="datos_formularios"><span id="spryselect2">
    <label>
    <select name="anio" id="anio" onchange="MostrarConsulta('listar_memoranda_list.php')">
      <option value="-1">Seleccione</option>
        <option value="2012" selected="selected">2012</option>
        <option value="2011">2011</option>
        <option value="2010">2010</option>
        <option value="2009">2009</option>
        <option value="2008">2008</option>

    </select>
    </label>
    <span class="selectInvalidMsg">Please select a valid item.</span>    <span class="selectRequiredMsg">Please select an item.</span></span></td>
    <td width="118" class="titulos_formularios">Fecha:</td>
    <td width="173" class="datos_formularios">
    <span id="sprytextfield3">
        <input name="fecha" type="text" id="fecha" value="<?php echo date("d/m/Y");?>" size="13" maxlength="10" />
        <img src="../imgs/jscalendar.gif" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
        <script type="text/javascript">
            Calendar.setup({
              inputField    : "fecha",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%d/%m/%Y"
            });
          </script>
<span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no v�lido.</span></span>
    </td>
  </tr>
  <tr>
    <td class="titulos_formularios">Asunto:</td>
    <td colspan="3" class="datos_formularios"><span id="sprytextfield1">
      <label>
      <input name="asunto" type="text" id="asunto" size="60" maxlength="100" />
      </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td class="titulos_formularios">Destinatario:</td>
    <td colspan="3" class="datos_formularios"><span id="sprytextfield2">
      <label>
      <input name="destinatario" type="text" id="destinatario" size="60" maxlength="100" />
      </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>

  <tr class="datos_formularios">
    <td colspan="4" class="datos_formularios">&nbsp;</td>
  </tr>
  <tr class="datos_formularios">
    <td height="26" colspan="4" class="datos_formularios"><div align="right">
       <input type="button" name="volver" id="volver" value="Listado" onclick="javascript: location.href='listar_memoranda.php'"  />
       <input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
      <input type="submit" name="guardar" id="guardar" value="Guardar" />
    </div></td>
  </tr>
</table>

<p class="datos_formularios"><strong>RECUERDE:</strong> Al momento de incluir un Memorando recuerde las norm&aacute;s b&aacute;sicas de escritura. Se le recomienda que no escriba todo en MAY&Uacute;SCULAS, los nombres de personas comienzan siempre en may&uacute;scula, al igual que los nombres de las Direcciones a las que va dirigido. En caso de colocar las siglas de una Direcci&oacute;n, puede colocarlas en May&uacute;sculas. Por ejmplo:</p>
<p class="datos_formularios"><strong>Destinatario:</strong> Pedro P&eacute;rez - DAP<br />
    <strong>Asunto:</strong> Remisi&oacute;n de informaci&oacute;n solicitada.</p>
</form>
    <script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "date", {validateOn:["blur"], format:"dd/mm/yyyy"});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1"});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"-1"});
//-->
</script>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Wednesday, 7 January, 2009 9:15 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
