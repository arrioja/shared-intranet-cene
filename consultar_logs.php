<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra una página mediante la cual se puede consultar las actividades que los usuarios realizan en la intranet; es 
  						necesario que cada módulo implemente la inclusión de la información necesaria en la tabla rastreo para que
						este modulo pueda obtener la información que requiere;   Se usa AJAX para mostrar el listado de actividades 
						dependiendo del usuario y fecha seleccionado, se usa el archivo: consulta_logs_contenido.php para mostrarlos.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						03/09/2008 por Pedro E. Arrioja M. - Se modificó el método de envío de datos entre páginas de GET a POST en el AJAX 
								   para aumentar la seguridad y evitar la posibilidad de usar el url de forma indebida.
								   Se incluyó la comprobación de permiso de usuario.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/

 session_start();  // se inicia la sesión 
 include("libs/utilidades.php");
 include("libs/comprueba_permiso.php");
 require("db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.

 $link=conectarse("organizacion");
 $link=conectarse("intranet");
 if (isset($_GET['cedu']))
 {
   $cedu=$_GET['cedu'];
 };
  
 $consulta_dir=mysql_query("select u.cedula, u.login, u.email, u.activo, 
  							 p.nombres, p.apellidos 
 							FROM intranet.usuarios as u, organizacion.personas as p
							WHERE (u.cedula = p.cedula)
							ORDER BY p.apellidos, p.nombres",$link) or die(mysql_error());
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Registro de Actividades</title>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->



<link href="css/formularios.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {
	font-size: 10px;
	font-weight: bold;
}
-->
</style>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="libs/calendar/calendar.js"></script>
<script type="text/javascript" src="libs/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="libs/calendar/lang/calendar-es.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<style type="text/css"> @import url("css/calendar-win2k-cold-1.css"); </style>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="imgs/CENE_07.png">      <div align="right">
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

function MostrarConsulta()
  {
    url="consultar_logs_contenido.php";
	divResultado = document.getElementById('resultado');
	ajax=objetoAjax();
	ajax.open("POST",url);
	ajax.onreadystatechange=function() 
	  {
		if (ajax.readyState==4) 
		  {
			divResultado.innerHTML = ajax.responseText
		  }
	  }
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("usr="+document.getElementById('dire').value+"&des="+document.getElementById('fecha_desde').value+"&has="+document.getElementById('fecha_desde2').value);

}    
    
</script>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" class="encabezado_formularios">Consulta al Registro de Actividades - Indique los par&aacute;metros a buscar.</td>
  </tr>
  <tr>
    <td class="titulos_formularios">Usuario:</td>
    <td colspan="3" class="datos_formularios"><span id="spryselect1">
      <select name="dire" id="dire" onchange="MostrarConsulta('consultar_logs_contenido.php')">
        <option value="-1" selected="selected">Seleccione un Usuario</option>
        <option value="*">TODOS</option>
        <?php while ($result_dir=mysql_fetch_array($consulta_dir)) 
		  {?>
           <option  value="<?php echo $result_dir['cedula']; ?>" 
		            <?php if (isset($_GET['cedu']))
					        {
							  if ($cedu == $result_dir['cedula'])
							    {
								  echo ' selected="selected"';
								}
							}?>>
					<?php echo $result_dir['apellidos'].' '.$result_dir['nombres'];?></option>          
        <?php }?>
      </select>
      <span class="selectInvalidMsg">Seleccione un elemento v&aacute;lido.</span>      <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
  </tr>
  <tr>    
   <td class="titulos_formularios">Desde:</td>
    <td class="datos_formularios"><span id="sprytextfield1">
      <input name="fecha_desde" type="text" id="fecha_desde" onchange="MostrarConsulta()" value="<?php echo date("d/m/Y",strtotime("now"));?>" size="13" maxlength="10" />
      <img src="imgs/jscalendar.gif" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
        <script type="text/javascript">
            Calendar.setup({
              inputField    : "fecha_desde",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%d/%m/%Y"
            });
          </script>
    <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no v&aacute;lido.</span></span></td>
          
    <td class="titulos_formularios">Hasta:</td>
    <td class="datos_formularios"><span id="sprytextfield2">
    <input name="fecha_desde2" type="text" id="fecha_desde2" onchange="MostrarConsulta('consultar_logs_contenido.php')" value="<?php echo date("d/m/Y",strtotime("now"));?>" size="13" maxlength="10" />
    <img src="imgs/jscalendar.gif" name="f_trigger_c2" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
    <script type="text/javascript">
            Calendar.setup({
              inputField    : "fecha_desde2",
              button        : "f_trigger_c2",
              align         : "Tr",
			  ifFormat    	: "%d/%m/%Y"
            });
          </script>
    <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no v&aacute;lido.</span></span></td>
  </tr>    
  
  <tr>
    <td colspan="5" class="datos_formularios"><div id="resultado" align="right">
      <div align="center">Seleccione una Direcci&oacute;n para generar la lista de vacaciones disponibles</div>
    </div></td>
  </tr>   
   
  <tr>
    <td colspan="5" class="datos_formularios"><div align="right">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php?sis=<?php echo $_SESSION['sis']; ?>'" />      
    </div></td>
  </tr>
</table>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd/mm/yyyy", validateOn:["blur"]});
<?php 
    // si viene con la cédula como parámetro simplemente llamo al ajax que me enseña los registros del usuario para que lo ponga en pantalla de una vez.
    if (isset($_GET['cedu']))
	  {?>
	    MostrarConsulta('consultar_logs_contenido.php');
<?php }?>							
</script>

<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 30 October, 2008 3:01 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
