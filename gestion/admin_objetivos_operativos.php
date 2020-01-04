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

<SCRIPT SRC="javascript/java.js"> 

</SCRIPT> 
<script language="javascript" type="text/javascript">

function confirma_eliminar(cod,obj_operativo)
{
if (confirm("Se dispone a eliminar el objetivo operativo: "+obj_operativo+". ¿Desea continuar?"))
   elimina_objetivo_operativo(cod);
}


function carga_objetivo()
{ 
   var org=document.getElementById("select_0").options[document.getElementById("select_0").selectedIndex].value;
 
   var valor=document.getElementById("select_2").options[document.getElementById("select_2").selectedIndex].value;
   var codigo=document.getElementById("select_1").options[document.getElementById("select_1").selectedIndex].value;

 //alert ("valor "+ valor);
   if(valor==0){
    document.getElementById("objetivo").innerHTML="No disponible";
   }
   else
   {
      ajax=nuevoAjax();
	//alert(valor)
      ajax.open("GET", "muestra_objetivos_operativos.php?seleccionado="+valor+"&cod_direccion="+document.form1.direccion.value+"&cod_org="+org, true);
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
   
</script>

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
include "../db/conexion.php";
$link=conectarse("gestion");
?>


<form id="form1" name="form1" method="post" action="objetivos_operativos.php">
  <br />
  <table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2"><div align="center"><strong>Listado de Objetivos Operativos</strong>
          <input type="hidden" name="insertar" id="insertar" />
      </div></td>
    </tr>
    <tr>
      <td width="161" class="titulos_formularios">Organizaci&oacute;n</td>
      <td width="433" class="datos_formularios"><label><?php include "select/select_organizaciones.php";?> </label></td>
    </tr>
    <tr>
      <td width="161" class="titulos_formularios" ><strong>Direcci&oacute;n</strong></td>
      <td width="433" class="datos_formularios" id="cod"> <div align="justify"><label>
        <select class="combo" disabled="disabled" id="select_1" name="direccion" onchange='carga_plan_operativo()'>
          <option id="valor_defecto"  value="0">Selecciona Dirección...</option>
        </select>
      </label>
      </div> </td>
    </tr>
    <tr>
      <td width="161" class="titulos_formularios" ><strong>Plan Operativo</strong></td>
      <td width="433" class="datos_formularios" id="plan_operativo"> <div align="justify"><label>
        <select class="combo" disabled="disabled" id="select_2" name="plan_operativo" onchange='carga_objetivo()'>
          <option id="valor_defecto" value="0">Selecciona Plan...</option>
        </select>
      </label>
      </div>      </td>
      </tr>
    <tr>
      <td colspan="2" id="objetivo">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center" id="objetivo2">&nbsp;</td>
    </tr>
  </table>
  <p align="center">
    <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php'" />
  </p>
</form>

<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 18 September, 2008 9:46 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
