<?php 
/*include_once("secciones/definicion_fijo_contratado.php"); 
global $ajax; /* Important, always do this, because this page will be include */
//$ajax->add("seccion","fijo.php");*/
//$ajax->add("bottom","time.php");
 require "includes/miclase.php";	
 $link=conectarse("nomina");        
$cedula=$_GET['id']; 
$res=mysql_query("select * from integrantes where cedula='$cedula'", $link);
$datos=mysql_fetch_array($res);
$res_cargo=mysql_query("select * from cargos order by denominacion asc",$link);
 
if (isset($_POST['guardar']))
	{
	 $objeto = new miclase();
	 $fecha_elab=$objeto->cambiaf_a_mysql($_POST['fecha_elab']);
	 $fecha_egreso=$objeto->cambiaf_a_mysql($_POST['fecha_egreso']);
	 $fecha_ini=$objeto->cambiaf_a_mysql($_POST['fecha_inicio']);
	 $fecha_fin=$objeto->cambiaf_a_mysql($_POST['fecha_fin']);
	 $fecha_ingreso=$objeto->cambiaf_a_mysql($_POST['fecha_ingreso']);
		if ($objeto->insertar_integrantes_cargo($status,$_POST['denominacion'],$_POST['nivel'],$_POST['condicion'],$_POST['decreto'],$fecha_ini,$fecha_fin,$_POST['lugar_trabajo'],$_POST['direccion'],$_POST['cod_rac'],$fecha_elab, $_POST['sueldo_basico'],$_POST['asignaciones'],$_POST['causa_egreso'],$fecha_egreso,$fecha_ingreso, $_POST['observaciones'], $cedula,$_POST['paso'], $link))
		{
		abrir_popup("mensaje.php?texto=Inserto Correctamente el Cargo&imagen=tips.png","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		echo '<script languaje="Javascript">location.href="editar_integrantes.php?id='.$datos['cedula'].'"</script>';
		}
		else
		{
		$error= mysql_error($link);
		abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		} 

	}
	
if (isset($_POST['cancelar']))	
{
echo '<script languaje="Javascript">location.href="editar_integrantes.php?id='.$datos['cedula'].'"</script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Integrantes Cargo</title>

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <script type="text/javascript" src="jscalendar/calendar.js"></script>
  <script type="text/javascript" src="jscalendar/lang/calendar-espanol.js"></script>
  <script type="text/javascript" src="jscalendar/calendar-setup.js"></script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="500" border="1" align="center">
  <tr>
    <td><strong>Nombres</strong></td>
    <td><input type="text" name="nombres" id="nombres" value="<?php echo $datos['nombres']; ?>" readonly="readonly" /></td>
    <td><strong>Apellidos</strong></td>
    <td><input type="text" name="apellidos" id="apellidos"value="<?php echo $datos['apellidos']; ?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td><strong>C&eacute;dula</strong></td>
    <td><input type="text" name="cedula" id="cedula"value="<?php echo $datos['cedula']; ?>" readonly="readonly" /></td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <table width="828" border="1" align="center">
    <tr>
      <td width="99"><strong>Denominacion</strong></td>
      <td colspan="3"><select name="denominacion" id="denominacion">
      <?php while ($cargo=mysql_fetch_array($res_cargo)){?>
        <option value="<?php echo $cargo['denominacion']; ?>"><?php echo $cargo['denominacion']; ?></option>
        <?php }?>
      </select>      </td>
      <td width="142"><strong>Nivel</strong></td>
      <td width="187">
      <?php $result1=mysql_query("select * from nivel order by codigo asc",$link);?>
      <select name="nivel" id="nivel">
      <?php while ($nivel=mysql_fetch_array($result1)){?>
      <option value="<?php echo $nivel['codigo']; ?>"><?php echo $nivel['nombre'];?></option>
      <?php }?>
      </select>      </td>
    </tr>
    <tr>
      <td height="28"><strong>Condici&oacute;n</strong></td>
      <td><p>
        <label></label><label></label>
        <select name="condicion" id="condicion">
          <option value="FIJO">FIJO</option>
          <option value="CONTRATADO">CONTRATADO</option>
        </select>
        <br />
      </p>      </td>
      <td><strong>Decreto</strong></td>
      <td><span id="sprytextfield3">
        <input name="decreto" type="text" id="decreto" size="19" />
      </span></td>
      <td><strong>Direcci&oacute;n</strong></td>
      <td><?php $result=mysql_query("select nombre_abreviado,nombre_completo,codigo from direcciones",$link);?>
        <select name="direccion" id="direccion">
          <?php while ($direcciones=mysql_fetch_array($result)){?>
          <option value="<?php echo $direcciones['codigo']; ?>"><?php echo $direcciones['nombre_abreviado'];?></option>
          <?php }?>
        </select></td>
    </tr>
    <tr>
      <td><strong>F. Inicio</strong></td>
      <td width="145"><input name="fecha_inicio" type="text" id="fecha_ini" size="15" readonly="1" />
        <img src="jscalendar/img.gif" alt="r" name="f_trigger_ini" id="f_trigger_ini" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
      <td width="59"><strong>F. Fin</strong></td>
      <td width="156"><input name="fecha_fin" type="text" id="fecha_fin" size="15" readonly="1" />
        <img src="jscalendar/img.gif" alt="r" name="f_trigger_fin" id="f_trigger_fin" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
      <td><strong>Paso</strong></td>
      <td><span id="sprytextfield1">
      <input name="paso" type="text" id="paso" size="10" maxlength="3" />
      <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td><strong>Lugar Trabajo</strong></td>
      <td colspan="3"><input name="lugar_trabajo" type="text" id="lugar_trabajo" size="40" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Cod Rac</strong></td>
      <td colspan="3"><input type="text" name="cod_rac" id="cod_rac" /></td>
      <td><strong>Fecha Elaboraci&oacute;n</strong></td>
      <td><input name="fecha_elab" type="text" id="fecha_elab" size="15" readonly="1" />
        <img src="jscalendar/img.gif" alt="r" name="f_trigger_elab" id="f_trigger_elab" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
    </tr>
    <tr>
      <td><strong>Sueldo Basico</strong></td>
      <td colspan="3"><span id="sprytextfield2">
      <input type="text" name="sueldo_basico" id="sueldo_basico" />
      <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      <td><strong>Asignaciones</strong></td>
      <td><span id="sprytextfield4">
      <input type="text" name="asignaciones" id="asignaciones" />
      <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td><strong>Causa Egreso</strong></td>
      <td colspan="3"><input type="text" name="causa_egreso" id="causa_egreso" /></td>
      <td><strong>Fecha Egreso</strong></td>
      <td><input name="fecha_egreso" type="text" id="fecha_egreso" size="15" readonly="1" />
        <img src="jscalendar/img.gif" alt="r" name="f_trigger_egreso" id="f_trigger_egreso" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
    </tr>
    <tr>
      <td><strong>Observaciones</strong></td>
      <td colspan="3"><textarea name="observaciones" cols="40" id="observaciones"></textarea></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td colspan="2" align="center"><input type="submit" name="cancelar" id="cancelar" value="  Salir  " /></td>
    </tr>
  </table>
</form>

<?php 
$resultado=mysql_query("select ic.denominacion, ic.nivel, ic.condicion, d.nombre_abreviado, ic.id from integrantes_cargo ic inner join direcciones d  on ic.cod_direccion=d.codigo where cedula='$cedula'",$link);
?>
<table width="680" border="1" align="center">

  <tr>
    <td width="136"><strong>Denominacion</strong></td>
    <td width="134"><strong>Nivel</strong></td>
    <td width="107"><strong>Condicion</strong></td>
    <td width="159"><strong>Direcci&oacute;n</strong></td>
    <td width="110"><strong>Acci&oacute;n</strong></td>
  </tr>
<?php 
while ($cargos=mysql_fetch_array($resultado))
{
?>  
  <tr>
    <td><?php echo $cargos['denominacion'];?></td>
    <td><?php echo $cargos['nivel'];?></td>
    <td><?php echo $cargos['condicion']?></td>
    <td><?php echo $cargos['nombre_abreviado']?></td>
    <td><a href="editar_integrantes_cargo.php?id=<?php echo $cargos['id'];?>"><img src="imagenes/b_edit.png" width="16" height="16" border="0" /></a> <a href="includes/quitar_integrantes_cargo.php?id=<?php echo $cargos['id'];?>&amp;ced=<?php echo $_GET['id'];?>"><img src="imagenes/b_drop.png" width="16" height="16" border="0" /></a></td>
  </tr>
<?php }?>
</table>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_elab",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_elab",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_egreso",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_egreso",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>


<script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_ini",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_ini",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

<script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_fin",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_fin",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "real", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "real", {validateOn:["blur"], isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {isRequired:false, validateOn:["blur"]});
//-->
</script>
</body>
</html>
