<?php /*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra los registros de entrada y salida de un funcionario o funcionaria para el día seleccionado.
  		Modificado el: 	20/11/2008 por Pedro E. Arrioja M. - Creación
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

 $consulta_dir=mysql_query("SELECT p.cedula, p.nombres, p.apellidos
						   FROM organizacion.personas AS p, asistencias.personas_status_asistencias AS s
						   WHERE ((p.cedula = s.cedula) and (s.status_asistencia = 1))
						   ORDER BY nombres",$link);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Reporte de Entrada y Salida de un dia para un funcionario</title>
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
	datos=datos+"?dir="+document.getElementById('dire').value+"&fecha="+document.getElementById('fecha').value;
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
    <input name="fecha" type="text" id="fecha" value="<?php echo date("d/m/Y");?>" size="13" maxlength="10" />
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
    <select name="dire" id="dire" onchange="Procesar('consulta_intrahorario_list.php')">
      <option value="-1" selected="selected">Seleccione un(a) Funcionario(a)</option>
      <option value="1">TODOS lo(a)s Funcionario(a)s</option>
      <?php while ($result_dir=mysql_fetch_array($consulta_dir)) 
		  {?>
           <option value="<?php echo $result_dir['cedula']; ?>"><?php echo $result_dir['nombres']." ".$result_dir['apellidos'];?></option>		
      <?php }?>
    </select>
    <span class="selectInvalidMsg">Seleccione un elemento v&aacute;lido.</span> <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
    </tr>
  <tr>
    <td colspan="2" class="datos_formularios" id="resultado">Seleccione un funcionario o funcionaria para generar reporte</td>
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
    <!-- #BeginDate format:fcSw1a -->Monday, 8 December, 2008 1:00 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>

