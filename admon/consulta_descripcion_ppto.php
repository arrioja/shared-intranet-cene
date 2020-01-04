<?php
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Trabaja conjuntamente con detalle_descripcion_ppto para realizar una cunsulta a la descripcion del codigo presupuestario que
  						se haya introducido.
  		Modificado el: 	11/11/2008 por Pedro E. Arrioja M. - Creación.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 $link=conectarse("administracion"); 
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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
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
  document.getElementById(target).innerHTML = 'Cargando Datos...';
  anio = document.getElementById("ano").value;
  var myConn = new XHConn();
  if (!myConn) alert("XMLHTTP no esta disponible. Inténtalo con un navegador mas nuevo.");
  peticion=function(oXML){document.getElementById(target).innerHTML=oXML.responseText;};
  myConn.connect("db/detalle_descripcion_ppto.php", "POST", "valor="+valor+"&func="+func+"&anio="+anio, peticion);
}
//-->
</SCRIPT>
<script language="JavaScript" src="../libs/XHConn.js"></script>

<form id="form1" name="form1" method="post" action="">
<br />
<table width="753" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr class="encabezado_formularios">
    <td colspan="2">Consulta de Descripci&oacute;n Presupuestaria</td>
  </tr>
  <tr>
    <td class="titulos_formularios">Presupuesto:</td>
    <td class="datos_formularios"><span id="spryselect1">
      <label>
      <select name="ano" id="ano">
        <option value="2008" selected="selected">2008</option>
      </select>
      </label>
      <span class="selectRequiredMsg">Please select an item.</span></span></td>
  </tr>
  <tr>
    <td width="127" class="titulos_formularios">C&oacute;digo:</td>
    <td width="620" class="datos_formularios"><span id="sprytextfield1">
    <label>
    <input name="codigo" type="text" id="codigo" onkeypress="if(event.keyCode == 13){ 
                                							   cargar_contenido('partida',this.value,1); 
                                                               cargar_contenido('generica',this.value,2);
                                							   cargar_contenido('especifica',this.value,3); 
                                                               cargar_contenido('subespecifica',this.value,4);
                                							   return false;
                        									   }" value="000-00-00-00" size="15" maxlength="20" />
    </label>
    <span class="textfieldRequiredMsg">Valor Requerido.</span><span class="textfieldInvalidFormatMsg">Formato Inv&aacute;lido, intente de la forma: "000-00-00-00".</span></span> Coloque el C&oacute;d. Presup. y presione &quot;ENTER&quot; (forma: PPP-GG-EE-SS)</td>
  </tr>
  <tr>
    <td class="titulos_formularios">Partida:</td>
    <td class="datos_formularios" id="partida">&nbsp;</td>
  </tr>
  <tr>
    <td class="titulos_formularios">Gen&eacute;rica:</td>
    <td class="datos_formularios" id="generica">&nbsp;</td>
  </tr>
  <tr>
    <td class="titulos_formularios">Espec&iacute;fica:</td>
    <td class="datos_formularios" id="especifica">&nbsp;</td>
  </tr>
  <tr>
    <td class="titulos_formularios">Sub-Espec&iacute;fica:</td>
    <td class="datos_formularios" id="subespecifica">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php?sis=<?php echo $_SESSION['sis']; ?>'" /></td>
  </tr>
</table>

</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {validateOn:["blur", "change"], useCharacterMasking:true, pattern:"000-00-00-00"});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
//-->
</script>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Friday, 14 November, 2008 9:13 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
