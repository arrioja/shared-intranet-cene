<?php 
/*
* Este archivo realiza el llamado al modulo para la inserción de los planes estratégicos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/
session_start();  // se inicia la sesión 
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

<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">


function confirma_eliminar(cod,plan_estrategico_organizacion)
{
if (confirm("Se dispone a eliminar el plan estratégico: "+plan_estrategico_organizacion+". ¿Desea continuar?"))
   elimina_plan_estrategico_organizacion(cod);
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



function carga_plan()
{ 
   var valor=document.getElementById("select_0").options[document.getElementById("select_0").selectedIndex].value;
 //alert ("valor "+ valor);
   if(valor==0){
    document.getElementById("plan").innerHTML="No disponible";
   }
   else
   {
      ajax=nuevoAjax();
	 // document.write(valor);
      ajax.open("GET", "muestra_planes_estrategicos.php?seleccionado="+valor+"&cod_org="+document.form1.organizacion.value, true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            document.getElementById("plan").innerHTML="Cargando....";
         }
         if (ajax.readyState==4)
         {
            document.getElementById("plan").innerHTML=ajax.responseText;
         }
      }
      ajax.send(null);
   }
}

function elimina_plan_estrategico_organizacion(cod)
{
      ajax=nuevoAjax();
      ajax.open("GET", "db/eliminar.php?seleccionado="+cod+"&elimina=8", true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==4)
		 {
            document.getElementById("plan2").innerHTML=ajax.responseText;
		    carga_plan();
		}
      }
      ajax.send(null);
}

</script>

<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
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
   include ("../db/conexion.php");
   $link=conectarse("organizacion");
   $result=mysql_query("SELECT * FROM organizaciones",$link);
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
      <br />
    <form id="f1" name="form1" method="POST" action="planes_estrategicos.php">
  <table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2" align="center" id="fila_1"><div align="center"><strong>Listado de Planes Estrat&eacute;gicos Organizaci&oacute;n</strong><strong></strong>
          <input type="hidden" name="insertar" id="insertar" value="insertar" />
      </div></td>
    </tr>
    <tr>
      <td width="25%" class="titulos_formularios"><strong>Organizaci&oacute;n</strong></td>
      <td width="75%"><?php genera_organizacion(); ?> &nbsp;</td>
    </tr>
    <tr>
      <td height="25" colspan="2" id="plan">&nbsp;</td>
    </tr>
    <tr>
      <td height="25" colspan="2" id="plan2"><label>
        <div align="right">
          <input type="button" name="Volver al Inicio" id="Volver al Inicio" value="Volver al Inicio" onclick="javascript: location.href='index.php'" />
          </div>
      </label></td>
    </tr>
  </table>
  <label></label>
</form>

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
