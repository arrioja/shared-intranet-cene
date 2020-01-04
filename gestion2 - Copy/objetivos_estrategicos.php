<?php 
/*
* Este archivo realiza el llamado al modulo para la inserción de los objetivos estratégicos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
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



<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.style1 {
	font-weight: bold;
	font-size: medium;
}
-->
</style>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" type="text/javascript">
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

function carga_plan()
{
   var valor=document.getElementById("select_0").options[document.getElementById("select_0").selectedIndex].value;
   if(valor==0)
   {
      // Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
      combo=document.getElementById("select_1");
      combo.length=0;
      var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona plan...";
      combo.appendChild(nuevaOpcion);   combo.disabled=true;
   }
   else
   {
      ajax=nuevoAjax();
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=1", true);
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
</script>


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
   echo "<select class='combo' id='select_0' name='organizacion' onChange='carga_plan()'>",
      "<option value='0'>Elige Organización....</option>";
	  
   while($row=mysql_fetch_row($result))
   {
      echo "<option value='".$row[1]."'>".$row[2]."</option>";
   }
   echo "</select>";
}
?>
      <form action="inserta_objetivos_estrategicos.php" method="post" name="aqui" id="aqui">
      <br />
    
      <table width="602" height="219" border="1" align="center" cellpadding="0" cellspacing="0" >
        <tr bgcolor="#FFFFFF" class="encabezado_formularios">
          <td colspan="2" id="fila_1">Registro de Objetivos Estrategicos Organizaci&oacute;n</td>
        </tr>
        <tr>
          <td width="27%" align="center" class="titulos_formularios" id="nombre">Organizacion:</td>
          <td width="73%" align="center" id="nombre"><div align="justify">
            <?php genera_organizacion(); ?>          
          </div></td>
        </tr>
        <tr>
          <td width="27%" align="center" class="titulos_formularios" >Plan Estrat&eacute;gico:</td>
          <td width="73%" align="" id="cod"><div align="justify">
            <select class="combo" disabled="disabled" id="select_1" name="direccion">
              <option id="valor_defecto"  value="0">Selecciona Plan...</option>
            </select>
          </div></td>
        </tr>
        <tr>
          <td width="27%" align="center" class="titulos_formularios" id="plan">Codigo:</td>
          <td width="73%" align="center" id="plan"><span id="sprytextfield1">
          <label> </label>
          <div align="justify">
            <input type="text" name="codigo" id="codigo" />
          </div>
          <span class="textfieldRequiredMsg">Se requiere un Valor</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></td>
        </tr>
        <tr>
          <td class="titulos_formularios" id="plan">Nombre:</td>
          <td class="datos_formularios" id="plan"><span id="sprytextarea1">
            <label>
            <textarea name="nombre" id="nombre2" cols="45" rows="1"></textarea>
            </label>
            <span class="textareaRequiredMsg">Se Requiere Nombre</span></span></td>
        </tr>
        <tr>
          <td class="titulos_formularios" id="plan6">Descripcion:</td>
          <td class="datos_formularios" id="plan6"><span id="sprytextarea2">
            <label>
            <textarea name="descripcion" id="descripcion" cols="45" rows="1"></textarea>
            </label>
            <span class="textareaRequiredMsg">Ingrese Descripción</span></span></td>
        </tr>
        <tr bgcolor="#FFFFFF" class="encabezado">
          <td colspan="2" align="center" id="plan5"><label>
            <input type="submit" name="insertar" id="insertar" value="Guardar" />
          </label></td>
          </tr>
      </table>
  </form>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"]});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {validateOn:["blur", "change"]});
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