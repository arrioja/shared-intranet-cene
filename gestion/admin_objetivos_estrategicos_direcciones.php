<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
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


<link href="../css/formularios.css" rel="stylesheet" type="text/css">
<link href="../css/index.css" rel="stylesheet" type="text/css">

<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">

function confirma_eliminar(cod,objetivo_estrategico_direccion)
{
if (confirm("Se dispone a eliminar el objetivo estratégico: "+objetivo_estrategico_direccion+". ¿Desea continuar?"))
   elimina_objetivo_estrategico_direccion(cod);
}

function nuevoAjax()
{
   /* Crea el objeto AJAX*/
   var xmlhttp=false;
   try
   {
      // Creacion del objeto AJAX para navegadores no IE
      xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
   }
   catch(e)
   {
      try
      {
         // Creacion del objet AJAX para IE
         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(E) { xmlhttp=false; }
   }
   if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }

   return xmlhttp;
}



function carga_direccion()
{
   var valor=document.getElementById("select_0").options[document.getElementById("select_0").selectedIndex].value;
   if(valor==0)
   {
      // Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
      combo=document.getElementById("select_1");
      combo.length=0;
      var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona Dirección...";
      combo.appendChild(nuevaOpcion);   combo.disabled=true;
	 
   }
   else
   {
      ajax=nuevoAjax();
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=4", true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            // Mientras carga elimino la opcion "Elige " y se coloca una que dice "Cargando"
            combo=document.getElementById("select_1");
            combo.length=0;
            var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
            combo.appendChild(nuevaOpcion); combo.disabled=true;   
         }
         if (ajax.readyState==4)
         {
            document.getElementById("cod").innerHTML=ajax.responseText;
         }
      }
      ajax.send(null);
   }
}

function carga_plan()
{
   var valor=document.getElementById("select_1").options[document.getElementById("select_1").selectedIndex].value;
   if(valor==0)
   {
      // Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
      combo=document.getElementById("select_2");
      combo.length=0;
      var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona Plan...";
      combo.appendChild(nuevaOpcion);   combo.disabled=true;
	  }
   else
   {
      ajax=nuevoAjax();
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=12", true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            // Mientras carga elimino la opcion "Elige plan" y pongo una que dice "Cargando"
            combo=document.getElementById("select_2");
            combo.length=0;
            var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
            combo.appendChild(nuevaOpcion); combo.disabled=true;   
         }
         if (ajax.readyState==4)
         {
            document.getElementById("plan").innerHTML=ajax.responseText;
         }
      }
      ajax.send(null);
   }
}

function carga_objetivo()
{
  var org=document.getElementById("select_0").options[document.getElementById("select_0").selectedIndex].value;
 
   var valor=document.getElementById("select_2").options[document.getElementById("select_2").selectedIndex].value;
   var codigo=document.getElementById("select_1").options[document.getElementById("select_1").selectedIndex].value;
// alert(valor);
   if(valor==0){
    document.getElementById("objetivo").innerHTML="No disponible";
   }
   else
   {
      ajax=nuevoAjax();
	 //alert(valor)
      ajax.open("GET", "muestra_objetivos_estrategicos_direcciones.php?seleccionado="+valor+"&cod_direccion="+document.form1.direccion.value+"&cod_org="+org, true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            document.getElementById("objetivo").innerHTML="Cargando....";
         }
         if (ajax.readyState==4)
         {
            document.getElementById("objetivo").innerHTML=ajax.responseText;
			
         }
      }
      ajax.send(null);
   }
}

function elimina_objetivo_estrategico_direccion(cod)
{
      ajax=nuevoAjax();
      ajax.open("GET", "db/eliminar.php?seleccionado="+cod+"&elimina=6", true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==4)
		 {
            document.getElementById("objetivo2").innerHTML=ajax.responseText;
		    carga_objetivo();
		}
      }
      ajax.send(null);
}
</script>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Gesti&oacute;n/Direcci&oacute;n/Listado de Objetivos Estrat&eacute;gicos</title>

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
  
  <?php

function genera_organizacion()
{
   require("../db/conexion.php");
   $link=conectarse("organizacion");
   $result=mysql_query("SELECT * FROM organizacion.organizaciones");
   mysql_close($link);
   // Muestra el primer select compuesto por las organizaciones
   echo "<select class='combo' id='select_0' name='organizacion' onChange='carga_direccion()'>",
      "<option value='0'>Elige Organización....</option>";
	  
   while($row=mysql_fetch_row($result))
   {
      echo "<option value='".$row[1]."'>".$row[2]."</option>";
   }
   echo "</select>";
}
?>

<form id="f1" name="form1" method="POST" action="objetivos_estrategicos_direccion.php">
  <table width="600" height="160" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2" id="fila_1"><div align="center"><strong>Listado de Objetivos Estrat&eacute;gicos</strong> <strong>Direcci&oacute;n</strong>
          <input type="hidden" name="insertar" id="insertar" value="insertar" />
      </div></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Organizaci&oacute;n:</strong></td>
      <td class="datos_formularios"><?php genera_organizacion(); ?> </td>
    </tr>
    <tr>
      <td width="31%" align="" class="titulos_formularios"><strong>Direcci&oacute;n:</strong></td>
      <td width="69%" align="" class="datos_formularios" id="cod"> <div align="justify">
        <select class="combo" disabled="disabled" id="select_1" name="direccion" onChange="carga_plan();">
          <option value="0">Selecciona Direcci&oacute;n...</option>
        </select>
      </div>  </td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Plan Estrat&eacute;gico:</strong></td>
      <td height="28" class="datos_formularios" id="plan">
      <select class="combo" disabled="disabled" name="plan" id="select_2" onChange="carga_objetivo();">
        <option value="0">Selecciona Plan...</option>
      </select>      </td>
    </tr>
    <tr>
      <td height="27" colspan="2" id="objetivo"></td>
    </tr>
    <tr>
      <td height="27" colspan="2" id="objetivo2"></td>
    </tr>
  </table>
  <p align="center">
    <input type="button" name="volver" id="volver" value="Volver" onClick="javascript: location.href='menu.php'" />
  </p>
</form>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Wednesday, 17 September, 2008 11:56 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>