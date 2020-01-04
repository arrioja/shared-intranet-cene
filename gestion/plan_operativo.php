<?php 
session_start();
$cod_org=$_POST['organizacion'];
$cod_dir=$_POST['direccion'];
include "../db/conexion.php";
$link=conectarse("organizacion");
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

function carga_plan()
{ 
   var valor=document.getElementById("select_1").options[document.getElementById("select_1").selectedIndex].value;
 //alert ("valor "+ valor);
   if(valor==0){
    document.getElementById("plan_impacto").innerHTML="No disponible";
   }
   else
   {
      ajax=nuevoAjax();
	 // document.write(valor);
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=7"+"&codigo="+document.form1.codigo.value, true);
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
      enviarFormulario("inserta_plan_operativo.php", "f1");
	  
	  if (activo)
	    activo=1;
        ajax.open("GET", "actualiza_vinculo_plan_operativo.php?seleccionado="+valor+"&codigo="+document.form1.codigo.value+"&activo="+activo, true);
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

<link href="../css/formularios.css" rel="stylesheet" type="text/css">
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

<form id="f1" name="form1" method="post" action="inserta_plan_operativo.php">
  <br />
  <table width="587" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="encabezado_formularios">
      <td height="25" colspan="2" id="fila_1"><div align="center" class="style3"><strong>Registro de Plan Operativo Direcci&oacute;n</strong>
          <input type="hidden" name="insertar" id="insertar" value="insertar" />
      </div></td>
    </tr>
    <tr>
      <td width="186" class="titulos_formularios">Organizaci&oacute;n</td>
      <td width="365"><label>
        <select name="organizacion" id="organizacion">
    <?php
   $result=mysql_query("SELECT * FROM organizacion.organizaciones where codigo=$cod_org",$link);
   $row=mysql_fetch_array($result);
   ?>
        <option value="<?php echo $row[1];?>"><?php echo $row[2];?></option>
        </select>
      </label>
      <label>      </label></td>
    </tr>
    <tr>
      <td width="186"="50%"class="titulos_formularios">Direcci&oacute;n</td>
      <td width="365"="50%" align="" id="cod"> <div align="justify"> <label>
        <select class="combo" id="select_1"  name="direccion" >
          <?php
   $result=mysql_query("SELECT * FROM organizacion.direcciones where codigo=$cod_dir",$link);
   $row=mysql_fetch_array($result);
   ?>
        <option value="<?php echo $row[1];?>"><?php echo $row[2];?></option>
        </select>
         </label>
         </div> </td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>C&oacute;digo</strong></td>
      <td><span id="sprytextfield1">
      <label>
      <input type="text" name="codigo" id="codigo" value="00"' />
      </label>
      <span class="textfieldRequiredMsg">Se Requiere un Valor</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Nombre</strong></td>
      <td><span id="sprytextfield2">
        <label>
        <input name="nombre" type="text" id="nombre" size="50" />
        </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de Inicio</strong></td>
      <td><span id="sprytextfield3">
      <label>
      <input name="aqo_inicio" type="text" id="aqo_inicio" maxlength="4" />
      </label>
      <span class="textfieldRequiredMsg">Ingrese Fecha de Incicio.</span><span class="textfieldInvalidFormatMsg">Sólo Números</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>A&ntilde;o de Fin</strong></td>
      <td><span id="sprytextfield4">
      <label>
      <input name="aqo_fin" type="text" id="aqo_fin" maxlength="4" />
      </label>
      <span class="textfieldRequiredMsg">Ingrese Fecha de Fin</span><span class="textfieldInvalidFormatMsg">Sólo Números</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Plan Estrat&eacute;gico de la Direcci&oacute;n que Impacta</strong></td>
      <td id="plan_impacto"><?php 

$result1=mysql_query("SELECT * FROM gestion.gestion_planes_estrategicos_direcciones WHERE cod_direccion=$cod_dir",$link)or die();
   echo "<table width='75%' border='0'>"; 

while($row=mysql_fetch_row($result1))
   {
   echo "<tr>";
   $row[2]=htmlentities($row[2]); 
   echo '<td> <input type="checkbox" name="plan_estrategico[]" value="'.$row[1].'"> '.$row[2].'</td>';
   //echo "<td> <input type='checkbox' name='plan_estrategico' id='plan_estrategico[".$row[1]."]' value='".$row[1]."'>".$row[2]."</td>";
  echo "</tr>";
  } 
echo "</table>";
	  ?>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center" id="ficha"><label>
        <div align="center"></div>
      </label></td>
    </tr>
    <tr>
      <td colspan="2" align="center" id="ficha2">
         <label>
         <input type="submit" name="guardar" id="guardar" value="Guardar" />
         </label>
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='admin_plan_operativo.php'" />
      </span></td>
    </tr>
  </table>
  <p>
  <label>
    <div align="center">
<div align="center"></div>
  </label>
  <div align="center"></div>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Wednesday, 17 September, 2008 12:29 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
