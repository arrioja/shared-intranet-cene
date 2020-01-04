<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

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


//Función para cargar las direcciones correspondientes a una determinada organización
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
	  carga_plan();
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


//Función que carga los planes estratégicos correspondientes a una determinada dirección
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
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=5", true);
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



//Función que carga los objetivos estratégicos de la organización que impactan el objetivo estratégico de la dirección
function carga_objetivo()
{ 
   var valor=document.getElementById("select_2").options[document.getElementById("select_2").selectedIndex].value;
 //alert ("valor "+ valor);
   if(valor==0){
    document.getElementById("objetivo").innerHTML="No disponible";
   }
   else
   {
   //alert (valor)
      ajax=nuevoAjax();
	 //alert(valor);
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=6"+"&codigo="+document.form1.codigo.value, true);
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



function crear_vinculo(valor, activo)
{
  if (document.form1.codigo.value=="")
   alert("debe colocar un codigo para el objetivo");
   else
    if (document.form1.nombre.value=="")
   alert("debe colocar un Nombre ");
   else
   if (document.form1.descripcion.value=="")
   alert("debe colocar una descripcion para el objetivo");
   
   else
   {//LLAMO A ENVIAR FORMULARIO PARA QUE INSERTE EL OBJETIVO ESTRATEG DE LA DIRECCION
      enviarFormulario("inserta_objetivos_estrategicos_direcciones.php", "f1");
	  
	  if (activo)
	    activo=1;
        ajax.open("GET", "actualiza_vinculo_obj_estr_direc.php?seleccionado="+valor+"&codigo="+document.form1.codigo.value+"&activo="+activo, true);
      
		ajax.onreadystatechange=function()
      {        
		  if (ajax.readyState==4)
               carga_objetivo();//cargo de nuevo los obj estrateg de org para que actualice la tabla que los muestra
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

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Gestión/Dirección/Objetivos Estratégicos</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php

function genera_organizacion()
{
   require("../db/conexion.php");
   $link=conectarse("organizacion");
   $result=mysql_query("SELECT * FROM organizaciones");
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

<form id="f1" name="form1" method="post" action="admin_objetivos_estrategicos_direcciones">
<table width="602" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="encabezado_formularios">
      <td colspan="2" id="fila_1">Registro de Objetivos Estrat&eacute;gicos Direcci&oacute;n
        <input name="insertar" type="hidden" id="insertar" value="1" />
      </div></td>
    </tr>
    <tr>
      <td width="36%" class="titulos_formularios" id="nombre">Organizaci&oacute;n:</td>
      <td width="64%" id="nombre"><label> <?php genera_organizacion()?> </label></td>
    </tr>
    <tr>
    
      <td width="36%" align="center" class="titulos_formularios" id=>Direcci&oacute;n: </td>       
      <td width="64%" align="" id="cod"><div align="justify"><label>
        <select name="direccion" disabled="disabled" class="combo" id="select_1" onchange='carga_plan()'>
          <option id="valor_defecto"  value="0">Selecciona Direcci&oacute;n...</option>
        </select>
      </label>
       </div> </td>
    </tr>
    <tr>
      <td width="36%" align="center" class="titulos_formularios" id=>Plan Estrat&eacute;gico Direcci&oacute;n:</td>
      <td width="64%" align="" id="plan"> <div align="justify"><label>
        <select class="combo" disabled="disabled" id="select_2" name="plan" onChange='carga_objetivo()'>
        <option id="valor_defecto" value="0">Selecciona Plan Dirección...</option>
        </select>
      </label>
      </div></td>
    </tr>
    <tr>
      <td class="titulos_formularios">C&oacute;digo:</td>
      <td><span id="sprytextfield1">
      <label>
      <input type="text" name="codigo" id="codigo" value="00" onkeypress="carga_objetivo();"/>
      </label>
      <span class="textfieldRequiredMsg">Ingrese Código</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Nombre:</td>
      <td><span id="sprytextarea1">
        <label>
        <textarea name="nombre" cols="45" rows="1" id="nombre2"></textarea>
        </label>
      <span class="textareaRequiredMsg">Se Requiere Nombre</span></span></td>
    </tr>
    <tr>
      <td align="justify" class="titulos_formularios" id="plan">Descripci&oacute;n:</td>
      <td align="justify" id="plan"><span id="sprytextarea2">
        <label>
        <textarea name="descripcion" cols="45" rows="1" id="descripcion"></textarea>
        </label>
      <span class="textareaRequiredMsg">Ingrese Descripción</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"> Objetivo Estrat&eacute;gico de la Organizaci&oacute;n que Impacta: </td>
      <td align="justify" id="objetivo">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" id="ficha"><label>
        <div align="center"></div>
      </label></td>
    </tr>
  </table>
<p>
    <label>
    <div align="center">
      <div align="center"><a href="admin_objetivos_estrategicos_direcciones.php">
        <input type="submit" name="button" id="button" value="Listado" />
      </a></div>
     
</form>
<label></label>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"]});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {validateOn:["blur", "change"]});
//-->
</script>
</body>
</html>
