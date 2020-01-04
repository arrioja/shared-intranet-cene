<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  Muestra un listado de los oficios, para lo cual usa AJAX conjuntamente con listar_oficios_list.php que es llamado
  						con el c�digo de la Direcci�n como par�metro.
  		Modificado el: 	28/08/2008 por Pedro E. Arrioja M. - Creaci�n
						05/09/2008 por Pedro E. Arrioja M. - Se a�ade comprobaci�n de acceso a m�dulo
  			  Versi�n: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesi�n 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 $link=conectarse("organizacion"); 
 $coddir=$_SESSION['direccion'];
 $consulta=mysql_query("select o.codigo, o.nombre_completo 
 						FROM organizacion.direcciones o 
						WHERE (o.codigo like '$coddir%') and (o.status='ACTIVO') 
						ORDER BY o.nombre_completo",$link) or die(mysql_error());

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Listado de Oficios</title>
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

function MostrarConsulta(datos)
  {
    datos=datos+"?tipo="+document.getElementById('dire').value+"&anio="+document.getElementById('anio').value;
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
    <td colspan="2" class="encabezado_formularios">Listado de Oficios para ANULAR</td>
  </tr>
  <tr>
    <td width="137" class="titulos_formularios">Direcci&oacute;n:</td>
    <td width="606" class="datos_formularios"><span id="spryselect1">
      
      <select name="dire" id="dire" onchange="MostrarConsulta('listar_oficios_anula_list.php')">
        <option value="-1" selected="selected">Seleccione una Direcci&oacute;n</option>      
        <?php while ($result_dir=mysql_fetch_array($consulta)) 
		  {?>
            <option value="<?php echo $result_dir['codigo']; ?>"><?php echo $result_dir['nombre_completo'];?></option>
        <?php }?>
      </select>      
      <span class="selectInvalidMsg">Seleccione un elemento v�lido.</span>      <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
  </tr>
    <tr>
    <td class="titulos_formularios">Per&iacute;odo Fiscal:</td>
    <td class="datos_formularios"><span id="spryselect2">
      <select name="anio" id="anio" onchange="MostrarConsulta('listar_memoranda_list.php')">
        <option value="-1">Seleccione</option>
        <option value="2012" selected="selected">2012</option>
        <option value="2011">2011</option>
        <option value="2010">2010</option>
        <option value="2009">2009</option>
        <option value="2008">2008</option>
            </select>
      <span class="selectInvalidMsg">Seleccione un elemento v�lido.</span>      <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
  </tr>
  <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
 while($resultado=mysql_fetch_array($consulta)) { ?>
  <?php }?>
  <tr>
  <td colspan="2"> <div align="left" id="resultado"></div></td>  
  </tr>
  <tr>
    <td colspan="2" class="datos_formularios"><div align="center">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" />
    </div></td>
  </tr>
</table>
<script type="text/javascript">
<!--
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
    <!-- #BeginDate format:fcSw1a -->Wednesday, 7 January, 2009 9:17 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
