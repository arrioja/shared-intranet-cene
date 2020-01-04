<?php 
 include ("includes/libreria.php");
 $link=conectarse("organizacion");
 //$link=conectarse
 
 $consulta_nivel=mysql_query("select * from nivel order by codigo",$link) or die(mysql_error());
 $consulta_dir=mysql_query("select codigo, nombre_completo from direcciones where status='ACTIVO' ORDER BY nombre_completo",$link)
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Nuevo Usuario</title>
<!-- InstanceEndEditable -->
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
<!-- InstanceBeginEditable name="head" -->


<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<link href="css/formularios.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="imgs/CENE_07.png"><!-- InstanceBeginEditable name="menu_superior" -->&nbsp; <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td valign="top"><!-- InstanceBeginEditable name="menu_izquierda" --><!-- InstanceEndEditable -->    </td>
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" -->
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
  myConn.connect("includes/detalle.php?valor="+valor+"&func="+func, "GET", "", peticion);
}
//-->
</SCRIPT>
<script language="JavaScript" src="includes/XHConn.js"></script>


<form id="form1" name="form1" method="post" action="db/inserta_usuario.php">
  <table border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" class="encabezado_formularios">Datos del Nuevo Usuario</td>
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
    <td class="titulos_formularios">Nivel:&nbsp;</td>
    <td class="datos_formularios"><span id="spryselect1">
      <label>
      <select name="nivel" id="nivel">
        <option value="-1">Seleccione el Nivel</option>
        <?php while ($result_nivel=mysql_fetch_array($consulta_nivel)) 
		  {?>
            <option value="<?php echo $result_nivel['codigo']; ?>"><?php echo $result_nivel['nombre'];?></option>
        <?php }?>  
            </select>
      </label>
      <span class="selectInvalidMsg">Please select a valid item.</span>      <span class="selectRequiredMsg">Please select an item.</span></span></td>
    </tr>
      
    <tr>
      <td class="titulos_formularios">Direcci&oacute;n:&nbsp;</td>
      <td class="datos_formularios"><span id="spryselect2">
        <label>
        <select name="direccion" id="direccion">
          <option value="-1" selected="selected">Seleccione una Direcci&oacute;n</option>
          <option value="10">TODA LA CONTRALORIA</option>      
        <?php while ($result_dir=mysql_fetch_array($consulta_dir)) 
		  {?>
            <option value="<?php echo $result_dir['codigo']; ?>"><?php echo $result_dir['nombre_completo'];?></option>
        <?php }?>          
          
        </select>
        </label>
        <span class="selectInvalidMsg">Please select a valid item.</span>        <span class="selectRequiredMsg">Please select an item.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Login:&nbsp;</td>
      <td class="datos_formularios"><span id="sprytextfield1">
        <input type="text" name="login" id="login" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Clave:&nbsp;</td>
      <td class="datos_formularios"><span id="sprytextfield2">
      <input name="clave" type="password" id="clave" maxlength="10" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldMinCharsMsg">M&iacute;nimo seis (6) caracteres.</span><span class="textfieldMaxCharsMsg">M&aacute;ximo 50 caracteres.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Confirmaci&oacute;n:&nbsp;</td>
      <td class="datos_formularios"><span id="sprytextfield3">
      <input name="conf" type="password" id="conf" maxlength="10" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldMinCharsMsg">M&iacute;nimo seis (6) caracteres.</span><span class="textfieldMaxCharsMsg">M&aacute;ximo 50 caracteres.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">e-mail:&nbsp;</td>
      <td class="datos_formularios"><span id="sprytextfield4">
      <input name="email" type="text" id="email" size="40" maxlength="50" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">E-mail no v&aacute;lido.</span></span></td>
    </tr>
        
    <tr>
      <td colspan="2" align="right"><input type="submit" name="button" id="button" value="Incluir usuario" />
      <input type="reset" name="button2" id="button2" value="Limpiar formulario" />
      <span class="datos_formularios">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='listar_usuarios_intranet.php'" />
      </span></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"], minChars:6, maxChars:50});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"], minChars:6, maxChars:50});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur", "change"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur", "change"], invalidValue:"-1"});
//-->
</script>