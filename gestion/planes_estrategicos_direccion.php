<?php 
/*
* Este archivo realiza el llamado al modulo para la inserción de los planes estratégicos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/
session_start();?>

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
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
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
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=2", true);
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
   var valor=document.getElementById("select_0").options[document.getElementById("select_0").selectedIndex].value;
 //alert ("valor "+ valor);
   if(valor==0){
    document.getElementById("plan").innerHTML="No disponible";
   }
   else
   {
      ajax=nuevoAjax();
	 //alert(valor);
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=3"+"&codigo="+document.form1.codigo.value, true);
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


function crear_vinculo(valor, activo)
{
  if (document.form1.codigo.value=="")
   alert("debe colocar un codigo para el objetivo");
   else
    if (document.form1.nombre.value=="")
   alert("debe colocar un Nombre ");
   else
   if (document.form1.aqo_inicio.value=="")
   alert("debe colocar un año de inicio para el plan");
   else
   if (document.form1.aqo_fin.value=="")
   alert("debe colocar un año de fin para el plan");
   else
   {//LLAMO A ENVIAR FORMULARIO PARA QUE INSERTE EL OBJETIVO ESTRATEG DE LA DIRECCION
      enviarFormulario("inserta_planes_estrategicos_direcciones.php", "f1");
	  
	  if (activo)
	    activo=1;
        ajax.open("GET", "actualiza_vinculo_plan_estrategico_org.php?seleccionado="+valor+"&codigo="+document.form1.codigo.value+"&activo="+activo, true);
       // ajax.open("GET", "elimina_vinculo_obj_estr_direc.php?seleccionado="+valor+"&codigo="+document.form1.codigo.value, true);
		
		ajax.onreadystatechange=function()
      {        
		  if (ajax.readyState==4)
               carga_plan();//cargo de nuevo los planes estrategicos de org para que actualice la tabla que los muestra
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
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

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
   require("../db/conexion.php");
   $link=conectarse("gestion");
   $result=mysql_query("SELECT * FROM organizacion.organizaciones",$link);
?>
      <br />
    <form id="f1" name="form1" method="POST" action="inserta_planes_estrategicos_direcciones.php">
  <table width="606" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="encabezado_formularios">
      <td colspan="2" id="fila_1"><div align="center" class="style2"><strong>Registro de Planes Estrat&eacute;gicos</strong> <strong>Direcci&oacute;n</strong> 
        <input type="hidden" name="insertar" id="insertar" value="insertar" />
      </div></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Organizaci&oacute;n:</strong></td>
      <td><?php  $result=mysql_query("SELECT * FROM organizacion.organizaciones where codigo=$_POST[organizacion]",$link);?> 
        <select name="organizacion" id="organizacion">
        <?php 	   while($row=mysql_fetch_row($result))
	   {
		  echo "<option value='".$row[1]."'>".$row[2]."</option>";
	   }?>
        </select> &nbsp;
        <label></label></td>
    </tr>
    <tr>
      <td width="39%" align="center" class="titulos_formularios" >Direcci&oacute;n: </td>
      <td width="61%" align="" id="cod"> <div align="justify">
        <label>        <?php  $result=mysql_query("SELECT * FROM organizacion.direcciones where codigo=$_POST[direccion]",$link);?> 
        <select class="combo"  id="select_1" name="direccion" >
           <?php 	   while($row=mysql_fetch_row($result))
	   {
		  echo "<option value='".$row[1]."'>".$row[2]."</option>";
	   }?>
        </select></label>
      </div>  </td>
    </tr>
    <tr>
      <td width="39%" class="titulos_formularios"><strong>C&oacute;digo:</strong></td>
      <td width="61%"><label><span id="sprytextfield1">
      <input type="text" name="codigo" id="codigo"  value="00" />
      <span class="textfieldRequiredMsg">Se Requiere un valor</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Nombre:</strong></td>
      <td><label><span id="sprytextarea1">
      <textarea name="nombre" id="nombre" cols="45" rows="1"></textarea>
      <span class="textareaRequiredMsg">Se Requiere Nombre</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de Inicio:</strong></td>
      <td><label><span id="sprytextfield3">
      <input name="aqo_inicio" type="text" id="aqo_inicio" maxlength="4" />
      <span class="textfieldRequiredMsg">Ingrese Año de inicio</span><span class="textfieldInvalidFormatMsg">Sólo Números</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de fin:</strong></td>
      <td><label><span id="sprytextfield4">
      <input name="aqo_fin" type="text" id="aqo_fin" maxlength="4" />
      <span class="textfieldRequiredMsg">Ingrese Año de fin</span><span class="textfieldInvalidFormatMsg">Sólo Números</span></span></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Plan Estrat&eacute;gico de la Organizaci&oacute;n que impacta: </strong></td>
      <td id="plan">	<?php $result=mysql_query("SELECT * FROM gestion.gestion_planes_estrategicos pe
				WHERE pe.codigo_organizacion=$_POST[organizacion]",$link);
		echo "<table width='75%' border='0'>"; 

	  while($row=mysql_fetch_row($result))
	   {
	   echo "<tr>";
	   $row[2]=htmlentities($row[2]);
	   echo "<td> <input type='checkbox' name='cod_plan_estrategico_org[]' value='".$row[1]."'>".$row[2]."</td>";
	   echo "</tr>";
	   } 
  
  echo "</table>";?> </td>
    </tr>
    <tr>
      <td colspan="2" align="center" id="ficha"><label>
      <input type="submit" name="guardar" id="guardar" value="Guardar" />
      </label></td>
    </tr>
  </table>
  <label></label>
  <p align="center"><a href="admin_planes_estrategicos_direccion.php">
    <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='admin_planes_estrategicos_direccion.php'" />
    <label></label>
  </a>  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"]});
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
