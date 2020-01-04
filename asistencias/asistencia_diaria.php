<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra el reporte de asistencia diaria tipo sabana por todos los funcionarios sujetos al control de asitencias.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creación
						01/09/2008 por Pedro E. Arrioja M. - Se añaden funcionalidades de AJAX para la selección de fechas y Direcciones y se
								   crea en libs un archivo para eliminar las imagenes temporales de gráficos creadas.
						04/09/2008 por Pedro E. Arrioja M. - Se añade comprobación de acceso a módulo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.

 $fecha_reporte=cambiaf_a_mysql($_POST['fecha']);
 
 $link=conectarse("organizacion");  

 $consulta_dir=mysql_query("select codigo, nombre_completo from direcciones where status='ACTIVO' ORDER BY nombre_completo",$link)

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Reporte de asistencia diaria</title>
<meta http-equiv="Expires" content="0">
<meta http-equiv="Cache-Control" Cache-Control: max-age=1, mustrevalidate>
<meta http-equiv="Pragma" content="no-cache">
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
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />


<style type="text/css">
<!--
.Estilo1 { 
	color: #FF0000;
	font-weight: bold;
}
.Estilo2 {
    color: #009900;
	font-weight: bold;	
	}
-->
</style>

<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" --><br />
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
 

function Procesar(datos)
  {
    var alea = parseInt(Math.random()*1000000);	
	datos=datos+"?dir="+document.getElementById('dire').value+"&fecha="+document.getElementById('fecha').value+"&ale="+alea;
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("GET", datos);
	ajax.onreadystatechange=function() 
	  {
	   if (ajax.readyState==1)
         { 
            divResultado.innerHTML = "Cargando Datos de Asistencia, por favor espere...";
         }	  
		if (ajax.readyState==4) 
		  {
		    if(ajax.status==200)
              {
                 divResultado.innerHTML = ajax.responseText;	
				 
				 datos2="../libs/elimina_imagen.php?num="+alea;
				 ajax2=objetoAjax();
				 ajax2.open("GET", datos2);
				 ajax2.send(null);				 		 
			  }
		  }
	  }
	ajax.send(null);
  } 
    
</script>
  
    <table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="titulos">Dia: </td>
    <td class="datos_formularios"><span id="sprytextfield1">
    <input name="fecha" type="text" id="fecha" value="<?php echo date("d/m/Y",strtotime("-1 day"));?>" size="13" maxlength="10" />
    <img src="../imgs/jscalendar.gif" alt="image" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
    <script type="text/javascript">
            Calendar.setup({
              inputField    : "fecha",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%d/%m/%Y"
            });
          </script>
    <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no v&aacute;lido.</span></span></td>
  </tr>
  <tr>
    <td class="titulos">Direcci&oacute;n:</td>
    <td class="datos_formularios"><span id="spryselect1">
    <select name="dire" id="dire" onchange="Procesar('asistencia_diaria_list.php')">
      <option value="-1" selected="selected">Seleccione una Direcci&oacute;n</option>
      <option value="1">TODAS</option>		
      <?php while ($result_dir=mysql_fetch_array($consulta_dir)) 
		  {?>
      <option value="<?php echo $result_dir['codigo']; ?>"><?php echo $result_dir['nombre_completo'];?></option>
      <?php }?>
    </select>
    <span class="selectInvalidMsg">Seleccione un elemento v&aacute;lido.</span> <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
    </tr>
  <tr>
    <td colspan="2" class="datos_formularios" id="resultado">Seleccione una Direcci&oacute;n para generar la asistencia seleccionada</td>
  </tr>       
  <tr>
    <td colspan="2" class="datos_formularios"><div align="right">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" />      
    </div></td>
  </tr>
</table>

      <script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", validateOn:["blur"]});
//-->
    </script>
      <br />
<p></p>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Monday, 8 December, 2008 9:45 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>

