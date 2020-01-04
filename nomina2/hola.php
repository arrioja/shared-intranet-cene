<?php 
 include ("db/conexion.php");
 $link=conectarse("organizacion");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Nuevo Integrante de la Nómina</title>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>



<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<link href="css/formularios.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%" valign="top">&nbsp;    </td>
    <td width="98%" valign="top">
 <br />
			
 <SCRIPT language="JavaScript">
<!--
function cargar_contenido(target,valor,func)
{
  var peticion;
  document.getElementById(target).value = 'Cargando Datos...';
  var myConn = new XHConn();
  if (!myConn) alert("XMLHTTP no esta disponible. Intalo con un navegador mas nuevo.");
  peticion=function(oXML){document.getElementById(target).value=oXML.responseText;};
  myConn.connect("libs/detalle.php?valor="+valor+"&func="+func, "GET", "", peticion);
}
//-->
 </SCRIPT>
 <script language="JavaScript" src="libs/XHConn.js"></script>


 <form id="form1" name="form1" method="post" action="db/inserta_integrante.php">
   <table border="1" align="center" cellpadding="0" cellspacing="0">
     <tr>
       <td colspan="2" class="encabezado_formularios">Datos del Nuevo Integrante de la N&oacute;mina</td>
      </tr>
     <tr>
       <td class="titulos_formularios">C&eacute;dula:&nbsp;</td>
        <td class="datos_formularios"><span id="sprytextfield5">
          <label>
            <input type="text" name="cedula" id="cedula" onkeypress="if(event.keyCode == 13){ 
                                							   cargar_contenido('apellidos',this.value,2); 
                                                               cargar_contenido('nombres',this.value,1);
                                							   return false;
                        									   }" />
            </label>
          <span class="textfieldRequiredMsg">Ingrese Cédula.</span></span></td>
      </tr>
      <tr>
        <td class="titulos_formularios">Apellidos:&nbsp;</td>
        <td class="datos_formularios"><span id="sprytextfield6">
          <label>
          <input name="apellidos" type="text" id="apellidos" size="60" maxlength="50" readonly="readonly" />
          </label>
          <span class="textfieldRequiredMsg">Ingrese Apellidos.</span></span></td>
      </tr>
     
     <tr>
        <td class="titulos_formularios">Nombres:&nbsp;</td>
        <td class="datos_formularios"><span id="sprytextfield7">
          <label>
          <input name="nombres" type="text" id="nombres" size="60" maxlength="50" readonly="readonly" />
          </label>
          <span class="textfieldRequiredMsg">Ingrese Nombres.</span></span></td>
      </tr>
     <tr>
       <td>Codigo</td>
       <td><span id="codi">
         <input type="text" name="codigo" id="codigo" />
         <span class="textfieldInvalidFormatMsg">Invalid format.</span> </span></td>
     </tr>
     <tr>
       <td>N&oacute;mina que Pertenece</td>
       <td><select name="tipo_nomina" id="tipo_nomina">
           <option value="EMPLEADOS">EMPLEADOS</option>
           <option value="DIRECTORES">DIRECTORES</option>
           <option value="JUBILADOS">JUBILADOS</option>
           <option value="PENSIONADOS">PENSIONADOS</option>
         </select>       </td>
     </tr>
     <tr>
       <td height="24">A&ntilde;os previos Admin. Publica</td>
       <td><span id="sprytextfield13">
         <input name="anos" type="text" id="anos" size="5" maxlength="2" />
         <span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
     </tr>
     <tr>
       <td>Pago en Banco?</td>
       <td><select name="pago_banco" id="pago_banco">
           <option value="1">SI</option>
           <option value="0">NO</option>
         </select>       </td>
     </tr>
     <tr>
       <td>Estatus</td>
       <td><select name="status" id="status">
           <option value="1">ACTIVO</option>
           <option value="2">INACTIVO</option>
         </select>       </td>
     </tr>
     
     <tr>
       <td colspan="2" align="right"><input type="submit" name="button" id="button" value="Incluir usuario" />
         <input type="reset" name="button2" id="button2" value="Limpiar formulario" />
         <span class="datos_formularios">
           <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='listar_usuarios_intranet.php'" />
           </span></td>
      </tr>
     </table>
   </form> <script type="text/javascript">
<!--
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"]});
//-->
 </script></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 17 July, 2008 9:59 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>
<script type="text/javascript">
<!--
var sprytextfield4 = new Spry.Widget.ValidationTextField("codi", "integer", {isRequired:false, validateOn:["blur"]});
//-->
</script>
</body>
</html>
