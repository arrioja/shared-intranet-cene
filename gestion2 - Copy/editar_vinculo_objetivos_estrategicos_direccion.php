<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "../templates/CENE_MENU_DIRECCION.dwt" ?>

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


//Función que carga los objetivos estratégicos de la dirección que impactan el objetivo operativo de la dirección
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
	 // document.write(valor);
      ajax.open("GET", "../select/select_total.php?seleccionado="+valor+"&select=6"+"&codigo="+document.form1.codigo.value, true);
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
<title>Vincular Objetivos Estratégicos Dirección</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php

   include ("../conexion/conectar.php");
   
   $result=mysql_query("SELECT * FROM gestion_organizacion where codigo = $_GET[seleccionado]");
  
   $row=mysql_fetch_array($result);
      
?>


<form id="f1" name="form1" method="post" action="admin_objetivos_estrategicos_direcciones">
<table width="560" border="1" align="center" cellpadding="2">
    <tr bgcolor="#FFFFFF" class="encabezado">
      <td colspan="2" id="fila_1"><div align="center" class="style2"><strong><img src="../imag/usuario.png" alt="" width="57" height="45" />Vincular Objetivos Estrat&eacute;gicos</strong> <strong>Direcci&oacute;n</strong> 
          <input name="insertar" type="hidden" id="insertar" value="1" />
      </div></td>
    </tr>
    <tr>
      <td width="49%" id="nombre"><strong>Organizaci&oacute;n</strong></td>
      <td width="51%" id="nombre"><label>
      <select name="select" disabled="disabled" id="select_0">
      <?php echo "<option value='".$row[1]."'>".$row[2]."</option>";?>
      </select>
      </label></td>
    </tr>
    <tr>
    
      <td width="49%" align="center" id=><div align="justify"> <strong>Dirección</strong></div> </td>       
      <td width="51%" align="" id="cod"><div align="justify"><label></label>
          <?php
		  $result=mysql_query("SELECT * FROM gestion_direcciones WHERE codigo= $_GET[direccion]");
		   $row=mysql_fetch_row($result);
		   ?>
          
          
          <label>
          
          
          <select name="direccion" disabled="disabled" id="select_1">
          <?php echo "<option value='".$row[1]."'>".$row[2]."</option>";?>
          </select>
          </label>
      </div> </td>
    </tr>
    <tr>
      <td width="49%" align="center" id=><div align="justify"><strong>Plan Estrat&eacute;gico</strong> <strong>Direcci&oacute;n</strong></div></td>
      <td width="51%" align="" id="plan"> <div align="justify"><label></label>
          <label>
          <?php
		  $result=mysql_query ("SELECT *  FROM gestion_planes_estrategicos_direcciones WHERE codigo=$_GET[plan]");
		  $row=mysql_fetch_row($result);
		  ?>
          
          <select name="plan" disabled="disabled" id="select_2">
          <?php echo "<option value= '".$row[1]."'>".$row[2]."</option>"; ?>
          </select>
          </label>
      </div></td>
    </tr>
    <tr>
      <td><strong>C&oacute;digo</strong></td>
      <td><span id="sprytextfield1">
      
      
      
      
      <label>
      <?php
	  $result=mysql_query("SELECT * FROM gestion_obj_estrategicos_direcciones WHERE codigo=$_GET[codigo_objetivo]");
	  $row=mysql_fetch_row($result);
	  ?>
      <input type="text" name="codigo" disabled="disabled" id="codigo" value="<?php echo $row[1];?>" />
      </label>
      <span class="textfieldRequiredMsg">Ingrese Código</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></td>
    </tr>
    <tr>
      <td><strong>Nombre</strong></td>
      <td><span id="sprytextfield2">
        <label>
        <input type="text" disabled="disabled" name="nombre" id="nombre" value="<?php echo $row[2];?>" />
        </label>
      <span class="textfieldRequiredMsg">Se Requiere Nombre</span></span></td>
    </tr>
    <tr>
      <td align="justify" id="plan"><strong>Descripci&oacute;n</strong></td>
      <td align="justify" id="plan"><span id="sprytextfield3">
        <label>
        <input type="text" disabled="disabled" name="descripcion" id="descripcion" value="<?php echo $row[3];?>" />
        </label>
      <span class="textfieldRequiredMsg">Ingrese Descripción</span></span></td>
    </tr>
    <tr>
      <td><strong> Objetivo Estrat&eacute;gico de la Organizaci&oacute;n que Impacta </strong></td>
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
      <div align="center">
        <input type="submit" name="button" id="button" value="Listado" />
      </div>
  </label>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<label></label>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur", "change"]});
//-->
carga_objetivo();
</script>
</body>
</html>
