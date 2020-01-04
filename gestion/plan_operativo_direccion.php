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

<script language="javascript" type="text/javascript">


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
   var codigo=document.getElementById("select_0").options[document.getElementById("select_0").selectedIndex].value;
 //alert ("valor "+ valor);
   if(valor==0){
    document.getElementById("plan_impacto").innerHTML="No disponible";
   }
   else
   {
      ajax=nuevoAjax();
	 // document.write(valor);
      ajax.open("GET", "muestra_planes_operativos_direcciones.php?seleccionado="+valor, true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            document.getElementById("plan_impacto").innerHTML="Cargando....";
         }
         if (ajax.readyState==4)
         {
            document.getElementById("plan_impacto").innerHTML=ajax.responseText;
         }
      }
      ajax.send(null);
   }
}
 
 
</script>



<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css">

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
   include "../db/conexion.php";
	$link=conectarse("gestion");
   $result=mysql_query("SELECT * FROM organizacion.organizaciones",$link);
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


<form id="f1" name="form1" method="post" action="../plan_operativo_dir/plan_operativo.php">
  <p>&nbsp;</p>
  <table width="600" border="1" align="center" cellpadding="2">
    <tr class="encabezado">
      <td colspan="2" id="fila_3"><div align="center"><strong><a href="../indicadores_gestion/plan_operativo_direccion.php" class="style4"><img src="../imgs/disksfilesystems.png" alt="" width="37" height="38" border="0" /></a>Indicadores  de Planes Operativos</strong>
          <input type="hidden" name="insertar" id="insertar" value="insertar" />
      </div></td>
    </tr>
    <tr>
      <td width="89"><strong>Organizaci&oacute;n</strong></td>
      <td width="351"><?php genera_organizacion();?>
      <label>      </label></td>
    </tr>
    <tr>
      <td width="89"="50%" align=""><strong>Direcci&oacute;n</strong></td>
      <td width="351"="50%" align="" id="cod"> <div align="justify"> <label>
        <select class="combo" disabled="disabled" id="select_1"  name="direccion" onchange='carga_plan()' >
         <option id="valor_defecto"  value="0">Selecciona Dirección...</option>
        </select>
         </label>
         </div> </td>
    </tr>
    <tr>
      <td height="25" colspan="2" id="plan_impacto">&nbsp;</td>
    </tr>
  </table>
  <p align="center">
    <input type="button" name="volver" id="volver" value="Men&uacute; Indicadores" onclick="javascript: location.href='menu_indicadores.php'" />
  </p>
  <p>&nbsp;</p>
  <div align="center"></div>
</form>

<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Wednesday, 17 September, 2008 12:23 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
