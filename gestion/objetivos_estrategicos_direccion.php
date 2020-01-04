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



<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

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
require("../db/conexion.php");
$link=conectarse("organizacion");
$cod_org=$_POST['organizacion'];
$cod_dir=$_POST['direccion'];
$cod_plan=$_POST['plan'];

?>

<form id="f1" name="form1" method="post" action="inserta_objetivos_estrategicos_direcciones.php">
<table width="602" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="encabezado_formularios">
      <td colspan="2" id="fila_1">Registro de Objetivos Estrat&eacute;gicos Direcci&oacute;n
        <input name="insertar" type="hidden" id="insertar" value="1" />
      </div></td>
    </tr>
    <tr>
      <td width="36%" class="titulos_formularios" id="nombre">Organizaci&oacute;n:</td>
      <td width="64%" id="nombre"><label> 		<select name="organizacion" >
		<?php       
		$result=mysql_query("SELECT * FROM organizacion.organizaciones where codigo='$cod_org'",$link);
        while($row=mysql_fetch_row($result))
   		{
      	echo "<option value='".$row[1]."'>".$row[2]."</option>";
   		}
		?>
            </select>
      </label></td>
    </tr>
    <tr>
    
      <td width="36%" align="center" class="titulos_formularios" id=>Direcci&oacute;n: </td>       
      <td width="64%" align="" id="cod"><div align="justify"><label>
        <select name="direccion"  class="combo" id="select_1">
          <?php       
		$result=mysql_query("SELECT * FROM organizacion.direcciones where codigo='$cod_dir'",$link);
        while($row=mysql_fetch_row($result))
   		{
      	echo "<option value='".$row[1]."'>".$row[2]."</option>";
   		}
		?>
        </select>
      </label>
       </div></td>
    </tr>
    <tr>
      <td width="36%" align="center" class="titulos_formularios" id=>Plan Estrat&eacute;gico Direcci&oacute;n:</td>
      <td width="64%" align="" id="plan"> <div align="justify"><label>
        <select class="combo"  id="select_2" name="plan">
         <?php       
		$result=mysql_query("SELECT * FROM gestion.gestion_planes_estrategicos_direcciones WHERE codigo='$cod_plan'",$link);
        while($row=mysql_fetch_row($result))
   		{
      	echo "<option value='".$row[1]."'>".$row[2]."</option>";
   		}
		?>
        </select>
      </label>
      </div></td>
    </tr>
    <tr>
      <td class="titulos_formularios">C&oacute;digo:</td>
      <td><span id="sprytextfield1">
      <label>
      <input type="text" name="codigo" id="codigo" value="00" />
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
      <td align="justify" id="objetivo"><?php $res=mysql_query("SELECT cod_plan_e_org FROM gestion.gestion_plan_e_org_dir WHERE cod_plan_e_dir='$cod_plan'",$link);
$row=mysql_fetch_array($res);
$seleccionado=$row["cod_plan_e_org"];


$result1=mysql_query("SELECT * FROM gestion.gestion_obj_estrategicos where codigo not in (SELECT a.codigo FROM gestion.gestion_obj_estrategicos AS a inner JOIN GESTION.gestion_obje_org_dir AS b ON a.codigo = b.cod_obj_e_org WHERE  a.codigo_plan_estrategico='$seleccionado') and codigo_plan_estrategico='$seleccionado'",$link);

   echo "<table width='75%' border='0'>"; 

  //muestra planes que NO estan vinculados
  while($row=mysql_fetch_row($result1))
   {
   echo "<tr>";
   $row[2]=htmlentities($row[2]);
   echo "<td> <input type='checkbox' name='cod_obj_estrategico[]' value='".$row[1]."'>".$row[1].'-'.$row[2]."</td>";
  echo "</tr>";
  } 
echo "</table>";?>&nbsp;</td>
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
        <input type="submit" name="button" id="button" value="Guardar" />
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='admin_objetivos_estrategicos_direcciones.php'" />
      </div>
</form>
<label></label>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {validateOn:["blur"]});
//-->
</script>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Wednesday, 17 September, 2008 11:57 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
