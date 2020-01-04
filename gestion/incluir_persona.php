<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Integrantes</title>




<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="../css/calendar-win2k-cold-1.css" title="win2k-cold-1" />
<script type="text/javascript" src="../libs/calendar/calendar.js"></script>
<script type="text/javascript" src="../libs/calendar/lang/calendar-espanol.js"></script>
<script type="text/javascript" src="../libs/calendar/calendar-setup.js"></script>
  <link href="../css/formularios.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="116%" border="0" cellpadding="0" cellspacing="0">
  
  <tr>
    <td width="44%" align="left" valign="top"><form action="" method="post" name="form1" id="form1">
      <table width="687" height="307" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr class="encabezado_formularios">
            <td height="30" colspan="4">Registro de nueva persona en el sistema</td>
          </tr>
          <tr>
            <td width="163" height="30" class="titulos_formularios"><div align="right">Nombres</div></td>
        <td width="200"><span id="nomb">
          <input type="text" name="nombres" id="nombres" />
          <span class="textfieldRequiredMsg">Ingrese un Valor.</span></span></td>
        <td width="109" class="titulos_formularios"><div align="right">Apellidos</div></td>
        <td width="187"><span id="ape">
          <input type="text" name="apellidos" id="apellidos" />
          <span class="textfieldRequiredMsg">Ingrese un Valor.</span></span></td>
      </tr>
          <tr>
            <td class="titulos_formularios"><div align="right">Cedula</div></td>
        <td><span id="ced">
          <input type="text" name="cedula" id="cedula" />
          <span class="textfieldRequiredMsg">Ingrese un Valor.</span><span class="textfieldInvalidFormatMsg">Formato Invalido.</span></span></td>
        <td class="titulos_formularios"><div align="right">Codigo</div></td>
        <td><span id="codi">
          <input type="text" name="codigo" id="codigo" />
          <span class="textfieldInvalidFormatMsg">Invalid format.</span>      </span></td>
      </tr>
          <tr>
            <td class="titulos_formularios"><div align="right">Fecha Nacimiento</div></td>
        <td><input type="text" name="fecha_nac" id="f_date_c" readonly="1" />
          <img src="../imgs/jscalendar.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" /></td>
        <td class="titulos_formularios"><div align="right">Lugar Nacimiento</div></td>
        <td><input type="text" name="lugar_nacimiento" id="lugar_nacimiento" /></td>
      </tr>
          <tr>
            <td class="titulos_formularios"><div align="right">Sexo</div></td>
        <td><select name="sexo" id="sexo">
          <OPTION VALUE="MASCULINO">MASCULINO</OPTION> 
          <OPTION VALUE="FEMENINO">FEMENINO</OPTION> 
          </select>      </td>
        <td class="titulos_formularios">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
          <tr>
            <td class="titulos_formularios"><div align="right">Estado Civil</div></td>
        <td><select name="edo_civil" id="edo_civil">
          <OPTION VALUE="SOLTERO" selected="selected">SOLTERO</OPTION> 
          <OPTION VALUE="CASADO">CASADO</OPTION>
          <OPTION VALUE="VIUDO">VIUDO</OPTION>
          <OPTION VALUE="DIVORCIADO">DIVORCIADO</OPTION>
          <OPTION VALUE="CONCUBINATO">*CONCUBINATO*</OPTION> 
          </select>      </td>
        <td class="titulos_formularios"><div align="right">Profesion</div></td>
        <td><span id="prof">
          <input type="text" name="profesion" id="profesion" />
          </span></td>
      </tr>
          <tr>
            <td class="titulos_formularios"><div align="right">Grado de Instruccion</div></td>
        <td><span id="sprytextfield7">
          <input type="text" name="g_instruccion" id="g_instruccion" />
          </span></td>
        <td class="titulos_formularios"><div align="right">Cargo</div></td>
        <td><span id="sprytextfield8">
          <input type="text" name="cargo" id="cargo" />
          </span></td>
      </tr>
          <tr>
            <td height="23" class="titulos_formularios"><div align="right">Departamento</div></td>
        <td><span id="sprytextfield9">
          <input type="text" name="departamento" id="departamento" />
          </span></td>
        <td class="titulos_formularios"><div align="right">Fecha de Ingreso</div></td>
        <td><input type="text" name="fecha_ing" id="f_date_c2" readonly="1" />
          <img src="../imgs/jscalendar.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
  &nbsp;&nbsp;</td>
      </tr>
          <tr>
            <td height="24" class="titulos_formularios"><div align="right">Años previos Admin. Publica</div></td>
        <td><span id="sprytextfield13">
          <input name="anos" type="text" id="anos" size="5" maxlength="2" />
          <span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
        <td class="titulos_formularios"><div align="right">Direccion</div></td>
        <td><textarea name="direccion" id="direccion" cols="26" rows="3"></textarea></td>
      </tr>
          <tr>
            <td class="titulos_formularios"><div align="right">Tlf Habitacion</div></td>
        <td><span id="tel_casa">
          <input type="text" name="tlf_casa" id="tlf_casa" />
          <span class="textfieldInvalidFormatMsg">Formato Invalido.</span></span></td>
        <td class="titulos_formularios"><div align="right">Tlf Celular</div></td>
        <td><span id="tel_cel">
          <input type="text" name="tlf_celular" id="tlf_celular" />
          <span class="textfieldInvalidFormatMsg">Formato Invalido.</span></span></td>
      </tr>
          <tr>
            <td class="titulos_formularios"><div align="right">Estatus</div></td>
        <td><select name="status" id="status">
          <OPTION VALUE="1">ACTIVO</OPTION> 
          <OPTION VALUE="2">INACTIVO</OPTION>      
          </select>      </td>
        <td class="titulos_formularios"><div align="right">Nomina que Pertenece</div></td>
        <td><select name="t_nomina" id="t_nomina">
          <OPTION VALUE="EMPLEADOS">EMPLEADOS</OPTION> 
          <OPTION VALUE="DIRECTORES">DIRECTORES</OPTION>
          <OPTION VALUE="JUBILADOS">JUBILADOS</OPTION>
          <OPTION VALUE="PENSIONADOS">PENSIONADOS</OPTION>            
          </select>      </td>
      </tr>
          <tr>
            <td class="titulos_formularios"><div align="right">Pago en Banco?</div></td>
        <td><select name="pago_banco" id="pago_banco">
          <OPTION VALUE="1">SI</OPTION>
          <OPTION VALUE="0">NO</OPTION>      
          </select>      </td>
        <td colspan="2">&nbsp;</td>
        </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
        <td colspan="2"><a href="visualizar_integrantes.php">Volver a Integrantes</a></td>
        </tr>
        </table>
        </form>
      <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
      </script>
      <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
      </script>
      <script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("nomb", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("ape", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("ced", "integer", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("codi", "integer", {isRequired:false, validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("prof", "none", {isRequired:false});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {isRequired:false});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {isRequired:false});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("tel_casa", "phone_number", {isRequired:false, validateOn:["blur"], format:"phone_custom"});
var sprytextfield11 = new Spry.Widget.ValidationTextField("tel_cel", "phone_number", {format:"phone_custom", validateOn:["blur"], isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13", "integer", {validateOn:["blur"], maxChars:2, isRequired:false});
//-->
      </script>      <?php
include "includes/miclase.php";

 if (isset($_POST["guardar"]))
{
 $link=Conectarse();
 $objeto = new miclase();
 $fecha=$objeto->cambiaf_a_mysql($_POST['fecha_nac']);
 $fechai=$objeto->cambiaf_a_mysql($_POST['fecha_ing']);
	if ($objeto->insertar_funcionario($_POST['nombres'],$_POST['apellidos'],$_POST['cedula'],$fecha,$_POST['sexo'],$_POST['lugar_nacimiento'],$_POST['edo_civil'],$_POST['g_instruccion'],$_POST['profesion'],$_POST['tlf_casa'],$_POST['tlf_celular'],$_POST['direccion'],$_POST['status'],$_POST['t_nomina'],$fechai,$_POST['anos'],$_POST['departamento'],$_POST['pago_banco'],$_POST['cargo'],$_POST['codigo'],$link)==true)
    {
	abrir_popup("mensaje.php?texto=Inserto Correctamente el Funcionario&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
	}
	else
	{
	$error= mysql_error($link);
	abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
	} 
mysql_close($link);
} 
?></td>
  </tr>
</table>

</body>
</html>

