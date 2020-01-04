<?php session_start(); ?>
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

<!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="../libs/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <!-- main calendar program -->
  <script type="text/javascript" src="../libs/calendar/calendar.js"></script>
  <!-- language for the calendar -->
  <script type="text/javascript" src="../libs/calendar/lang/calendar-es.js"></script>
  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="../libs/calendar/calendar-setup.js"></script>


<script language="javascript" type="text/javascript">

function desactivar(boton)
{
boton.disabled='disabled';
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


function carga_objetivo_operativo()
{ 
   var valor=document.getElementById("select_2").options[document.getElementById("select_2").selectedIndex].value;
 //alert ("valor "+ valor);
   if(valor==0){
    document.getElementById("objetivo").innerHTML="No disponible";
   }
   else
   {
      ajax=nuevoAjax();
	
//alert(valor);

      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=15"+"&codigo="+document.form1.codigo.value, true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            document.getElementById("objetivo").innerHTML="Cargando....";
         }
         if (ajax.readyState==4)
         {
            document.getElementById("objetivo").innerHTML=ajax.responseText;
			//alert("skhd");
			
         }
      }
      ajax.send(null);
   }
}



function crear_vinculo(valor, activo)
{
   if (document.form1.nombre.value=="")
      alert("debe colocar un Nombre ");
   else
   if (document.form1.fecha_inicio.value=="")
      alert("debe colocar una fecha de inicio para la actividad");
   else
   if (document.form1.duracion.value=="")
      alert("debe colocar los dias de duración de la actividad");
   
   else
   {//LLAMO A ENVIAR FORMULARIO PARA QUE INSERTE EL OBJETIVO ESTRATEG DE LA DIRECCION
     //alert("sdsdsd3434");
         enviarFormulario("inserta_actividades.php", "f1");
	  
	  if (activo)
	    activo=1;
        ajax.open("GET", "actualiza_vinculo_actividades.php?seleccionado="+valor+"&codigo="+document.form1.codigo.value+"&activo="+activo, true);
       // ajax.open("GET", "elimina_vinculo_obj_estr_direc.php?seleccionado="+valor+"&codigo="+document.form1.codigo.value, true);
		
		ajax.onreadystatechange=function()
          {        
		  if (ajax.readyState==4)
               carga_objetivo_operativo();//cargo de nuevo los obj estrateg de org para que actualice la tabla que los muestra
   	     }
		
	  ajax.send(null);
	 
	}
}

//CODIGO PARA ENVIAR FORMULARIO POR POST

var peticion = false;
try {
      peticion = new XMLHttpRequest();
} catch (trymicrosoft) {
      try {
            peticion = new ActiveXObject("Msxml2.XMLHTTP");
} catch (othermicrosoft) {
      try {
            peticion = new ActiveXObject("Microsoft.XMLHTTP");
} catch (failed) {
            peticion = false;
} 
}
}
 
  function enviarFormulario(url, formid){
  
         var Formulario = document.getElementById(formid);
         var longitudFormulario = Formulario.elements.length;
		 
         var cadenaFormulario = "";
         var sepCampos;
         sepCampos = "";
         for (var i=0; i <= Formulario.elements.length-1;i++) {
         cadenaFormulario += sepCampos+Formulario.elements[i].name+'='+encodeURI(Formulario.elements[i].value);
         sepCampos="&";
}
  peticion.open("POST", url, true);		

  peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
  peticion.onreadystatechange = function () {
  if (peticion.readyState == 4) {
     document.getElementById('ficha').innerHTML = "Los datos han sido enviados correctamente";
  }
}
peticion.send(cadenaFormulario);
}


   
</script>





<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

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
<?php
include "../db/conexion.php";
$link=conectarse("gestion");
?>

 

<form id="f1" name="form1" method="post" action="inserta_actividades.php">
  <p>&nbsp;</p>
  <table width="658" height="322" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="encabezado_formularios">
      <td colspan="3"><div align="center" class="style3"><strong>Registro de Actividades</strong> <?php //include "genera_codigo_actividad.php";?> </div></td>
    </tr>
    <tr>
      <td width="209" class="titulos_formularios"><strong>Organizaci&oacute;n</strong></td>
      <td class="datos_formularios"><label><?php  $result=mysql_query("SELECT * FROM organizacion.organizaciones where codigo=$_POST[organizacion]",$link);?> 
        <select name="organizacion" id="organizacion">
        <?php 	   while($row=mysql_fetch_row($result))
	   {
		  echo "<option value='".$row[1]."'>".$row[2]."</option>";
	   }?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="center" class="titulos_formularios" id=> <strong>Direcci&oacute;n</strong></td>
      <td align="" class="datos_formularios" id="cod"> <div align="justify"><label>
      <?php  $result=mysql_query("SELECT * FROM organizacion.direcciones where codigo=$_POST[direccion]",$link);?> 
        <select class="combo"  id="select_1" name="direccion" >
           <?php 	   while($row=mysql_fetch_row($result))
	   {
		  echo "<option value='".$row[1]."'>".$row[2]."</option>";
	   }?>
        </select>
      </label>
      </div> </td>
    </tr>
    <tr>
      <td align="center" class="titulos_formularios" id=> <strong>Plan Operativo</strong></td>
      <td align="" class="datos_formularios" id="plan_operativo"> <div align="justify"><label>
      <?php  $result=mysql_query("SELECT * FROM gestion.gestion_planes_operativos WHERE codigo=$_POST[plan_operativo]",$link);?>
        <select class="combo" id="select_2" name="plan_operativo">
           <?php 	   while($row=mysql_fetch_row($result))
	   {
		  echo "<option value='".$row[1]."'>".$row[2]."</option>";
	   }?>          
        </select>
      </label>
      </div>      </td>
      </tr>
    <tr>
      <td class="titulos_formularios"><strong>Nombre</strong></td>
      <td width="443" class="datos_formularios"><span id="sprytextfield1">
        <label>
        <input name="nombre" type="text" id="nombre" size="45" />
        </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Fecha de Inicio</strong></td>
      <td class="datos_formularios"><label>
        <input type="text" name="fecha_inicio" readonly="readonly" id="fecha_inicio" />
        <img src="../imgs/img.gif" alt="cal" name="f_trigger_c" width="20" height="20" border="0" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Duraci&oacute;n (D&iacute;as)</strong></td>
      <td class="datos_formularios" ><span id="sprytextfield4">
      <label>
      <input type="text" name="duracion" id="duracion" />
      </label>
      <span class="textfieldRequiredMsg">Ingrese Duración</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></td>
    </tr>
    <tr>
      <td height="12" class="titulos_formularios"><strong>Objetivo Operativo de la Direcci&oacute;n que Impacta</strong></td>
      <td height="12" class="datos_formularios" id="objetivo"><?php 
	  $result=mysql_query("SELECT * FROM gestion.gestion_obj_operativos a  where a.cod_plan_o_dir=$_POST[plan_operativo]",$link);
	 echo "<table width='75%' border='0'>"; 

	  while($row=mysql_fetch_row($result))
	   {
	   echo "<tr>";
	   $row[2]=htmlentities($row[2]);
	   echo "<td> <input type='checkbox' name='cod_obj_operativo[]' value='".$row[1]."'>".$row[2]."</td>";
	  echo "</tr>";
	  } 
  
  echo "</table>"; ?></td>
    </tr>
    <tr>
      <td height="31" colspan="2" id="ficha">&nbsp;</td>
    </tr>
    <tr>
      <td height="31" colspan="2" align="center" id="ficha2"><label>
        <input type="submit" name="guardar" id="guardar" value="Guardar" onclick="javascript:desactivar(this)" />
      </label>
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='admin_actividades.php'" /></td>
    </tr>
  </table>
  <p>
  <label>
    <div align="center">
<p align="center">
        <label></label>
        <label></label>
</p>
<div align="center"></div>
  </label>
</form>
<script type="text/javascript">
<!--
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["blur", "change"]});
//-->
</script>
<script type="text/javascript">
Calendar.setup({
        inputField     :    "fecha_inicio",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 18 September, 2008 10:18 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
