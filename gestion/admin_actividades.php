<?php session_start();?>
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



<SCRIPT SRC="javascript/java.js"> </SCRIPT> 

<script language="javascript" type="text/javascript">

function confirma_eliminar(cod,actividad)
{
if (confirm("Se dispone a eliminar la actividad: "+actividad+". ¿Desea continuar?"))
   elimina_actividad(cod);
}

function carga_plan_operativo()
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
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=16", true);
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
            document.getElementById("plan_operativo").innerHTML=ajax.responseText;	   
		 }
      }
      ajax.send(null);
   }
   
 }
 
 
 function carga_actividad()
{ 
var org=document.getElementById("select_0").options[document.getElementById("select_0").selectedIndex].value;
var codigo=document.getElementById("select_1").options[document.getElementById("select_1").selectedIndex].value; 
var plan_operativo=document.getElementById("select_2").options[document.getElementById("select_2").selectedIndex].value;

   if(plan_operativo==0){
    document.getElementById("actividad").innerHTML="No disponible";
   }
   else
   {
      ajax=nuevoAjax();
      ajax.open("GET", "muestra_actividades.php?seleccionado="+plan_operativo+"&cod_direccion="+document.form1.direccion.value+"&cod_org="+org, true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            document.getElementById("actividad").innerHTML="Cargando....";
         }
         if (ajax.readyState==4)
         {
            document.getElementById("actividad").innerHTML=ajax.responseText;
         }
      }
      ajax.send(null);
   }
}
  
</script>

<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
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
<p>
</p>
<?php
include "../db/conexion.php";
$link=conectarse("gestion");
?>
<form id="form1" name="form1" method="post" action="actividades.php">
  <p align="left">&nbsp;</p>
  
       <table width="561" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr class="encabezado_formularios">
            <td height="25" colspan="2"><div align="center"><strong> Listado de Actividades</strong> </div></td>
          </tr>
          <tr>
            <td width="174" class="titulos_formularios"><strong>Organizaci&oacute;n</strong></td>
            <td width="367" class="datos_formularios"><?php include "select/select_organizaciones.php";?>&nbsp;</td>
          </tr>
          <tr>
            <td class="titulos_formularios" ><strong>Direcci&oacute;n</strong></td>
          <td class="datos_formularios" id="cod"><label>
                <select class="combo" name="direccion" disabled="disabled"  id="select_1" onchange="carga_plan_operativo()">
                  <option id="valor_defecto" value="0"> Selecciona Dirección...</option>
                </select>
              </label></td>
          </tr>
          <tr>
            <td class="titulos_formularios"><strong>Plan Operativo</strong></td>
          <td class="datos_formularios" id="plan_operativo">
            <select class="combo" name="plan_operativo" disabled="disabled" id="select_2" onchange="carga_actividad()">
                  <option id="valor_defecto" value="0"> Selecciona Plan... </option>
              </select></td>
          </tr>
          <tr>
            <td height="25" colspan="2" id="actividad">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" colspan="2" id="actividad2"><label></label></td>
          </tr>
        </table>
       <p align="center"><input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" />
  </p>
  <p>&nbsp;</p>
</form>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 18 September, 2008 10:39 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
