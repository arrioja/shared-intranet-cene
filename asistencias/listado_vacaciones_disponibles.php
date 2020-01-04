<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra un listado de las vacaciones disponibles dependiendo de la dirección seleccionads, funciona con AJAX
  						conjuntamente con el archivo listado_vacaciones_disponibles_list.php
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creación
						05/09/2008 por Pedro E. Arrioja M. - Se añade comprobación de acceso al módulo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 $link=conectarse("organizacion"); 
 $consulta_dir=mysql_query("select codigo, nombre_completo from direcciones where status='ACTIVO' ORDER BY nombre_completo",$link)
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Listado de Vacaciones Disponibles</title>
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
<style type="text/css">
<!--
.Estilo1 {
	font-size: 10px;
	font-weight: bold;
}
-->
</style>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
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
function objetoAjax()
  {
	var xmlhttp=false;
	try 
	  {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	  } 
	catch (e) 
	  {
	    try 
		  {
		    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } 
		 catch (E) 
		  {
		    xmlhttp = false;
		  }
	  }

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') 
	  {
		xmlhttp = new XMLHttpRequest();
	  }
	return xmlhttp;
}

function MostrarConsulta(datos)
  {
    datos=datos+"?dir="+document.getElementById('dire').value;
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", datos);
	ajax.onreadystatechange=function() 
	  {
		if (ajax.readyState==4) 
		  {
			divResultado.innerHTML = ajax.responseText
		  }
	  }
	ajax.send(null)
}    
    
</script>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" class="encabezado_formularios">D&iacute;as de vacaciones disponibles para disfrute.</td>
  </tr>
  <tr>
    <td class="titulos_formularios"><div align="left">Seleccione la Direcci&oacute;n a Consultar:</div></td>
    <td colspan="5" class="datos_formularios"><span id="spryselect1">
      <select name="dire" id="dire" onchange="MostrarConsulta('listado_vacaciones_disponibles_list.php')">
        <option value="-1" selected="selected">Seleccione una Direcci&oacute;n</option>
        <option value="1">TODAS</option>        
        <?php while ($result_dir=mysql_fetch_array($consulta_dir)) 
		  {?>
            <option value="<?php echo $result_dir['codigo']; ?>"><?php echo $result_dir['nombre_completo'];?></option>
        <?php }?>
      </select>
      <span class="selectInvalidMsg">Seleccione un elemento válido.</span>      <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
    </tr>
  <tr>
    <td colspan="7" class="datos_formularios"><div id="resultado" align="right">
      <div align="center">Seleccione una Direcci&oacute;n para generar la lista de vacaciones disponibles</div>
    </div></td>
  </tr>   
   
  <tr>
    <td colspan="7" class="datos_formularios"><div align="right">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" />      
    </div></td>
  </tr>
</table>
    <script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur"]});
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
