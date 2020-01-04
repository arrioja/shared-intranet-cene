<?php 
/*include_once("secciones/definicion_fijo_contratado.php"); 
global $ajax; /* Important, always do this, because this page will be include */
//$ajax->add("seccion","fijo.php");
//$ajax->add("bottom","time.php");
 require "includes/miclase.php";	
$link=conectarse("nomina");        
$id=$_GET['id']; 
$res=mysql_query("select * from integrantes_cargo where id='$id'", $link);
$datos=mysql_fetch_array($res);
$res_cargo=mysql_query("select * from cargos",$link);
?>


<?php 
if (isset($_POST['guardar']))
	{
	 $objeto = new miclase();
	 $fecha_elab=$objeto->cambiaf_a_mysql($_POST['fecha_elab']);
	 $fecha_egreso=$objeto->cambiaf_a_mysql($_POST['fecha_egreso']);
	 $fecha_ini=$objeto->cambiaf_a_mysql($_POST['fecha_ini']);
	 $fecha_fin=$objeto->cambiaf_a_mysql($_POST['fecha_fin']);
	 $fecha_ingreso=$objeto->cambiaf_a_mysql($_POST['fecha_ingreso']);
	    if ($objeto->editar_integrantes_cargo($status,$_POST['denominacion'],$_POST['nivel'],$_POST['condicion'],$_POST['decreto'],$fecha_ini,$fecha_fin ,$_POST['lugar_trabajo'],$_POST['direccion'],$_POST['cod_rac'],$fecha_elab, $_POST['sueldo_basico'], $_POST['asignaciones'],$_POST['causa_egreso'],$fecha_egreso,$fecha_ingreso,$_POST['observaciones'], $datos['cedula'],$_GET['id'],$_POST['paso'], $link)==true)
		{
		abrir_popup("mensaje.php?texto=Edito Correctamente el Cargo&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		echo '<script languaje="Javascript">location.href="integrantes_cargo.php?id='.$datos['cedula'].'"</script>';
		}
		else
		{
		$error= mysql_error($link);
		abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		} 

	}
	
if (isset($_POST['cancelar']))	
{
echo '<script languaje="Javascript">location.href="integrantes_cargo.php?id='.$datos['cedula'].'"</script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Editar Cargo</title>
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <script type="text/javascript" src="jscalendar/calendar.js"></script>
  <script type="text/javascript" src="jscalendar/lang/calendar-espanol.js"></script>
  <script type="text/javascript" src="jscalendar/calendar-setup.js"></script>

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="873" border="1" align="center">
    <tr>
      <td width="138"><strong>Denominaci&oacute;n</strong></td>
      <td colspan="3"><select name="denominacion" id="denominacion">
      <?php while ($cargo=mysql_fetch_array($res_cargo)){?>
        <option value="<?php echo $cargo['denominacion']; ?>" <?php if ($datos['denominacion']==$cargo['denominacion']) echo "selected='selected'";?>><?php echo $cargo['denominacion']; ?></option>
        <?php }?>
      </select>  &nbsp;</td>
      <td width="152"><strong>Nivel</strong></td>
    <td width="191"><?php $result1=mysql_query("select * from nivel order by codigo asc",$link);?>
      <select name="nivel" id="nivel">
            <?php while ($nivel=mysql_fetch_array($result1)){?>
            <option value="<?php echo $nivel['codigo']; ?>" <?php if ($nivel['codigo']==$datos['nivel']) echo "selected='selected'";?>><?php echo $nivel['nombre'];?></option>
            <?php }?>
      </select>      </td>
    </tr>
    <tr>
      <td><strong>Condici&oacute;n</strong></td>
      <td><p>
          <label></label>
        <label></label>
          <select name="condicion" id="condicion">
            <option value="FIJO" <?php if ('FIJO'==$datos['condicion']) echo "selected='selected'";?>>FIJO</option>
            <option value="CONTRATADO" <?php if ('CONTRATADO'==$datos['condicion']) echo "selected='selected'";?>>CONTRATADO</option>
          </select>
          <br />
      </p></td>
      <td><strong>Decreto</strong></td>
      <td><span id="sprytextfield3">
        <input name="decreto" type="text" id="decreto" size="19" value="<?php echo $datos['decreto_contrato'];?>" />
        </span></td>
      <td><strong>Direcci&oacute;n</strong></td>
      <td><?php $result=mysql_query("select nombre_abreviado,nombre_completo,codigo from direcciones",$link);?>
          <select name="direccion" id="direccion">
            <?php while ($direcciones=mysql_fetch_array($result)){?>
            <option value="<?php echo $direcciones['codigo']; ?>" <?php if ($direcciones['codigo']==$datos['cod_direccion'])echo "selected='selected'"?>><?php echo $direcciones['nombre_abreviado'];?></option>
            <?php }?>
          </select></td>
    </tr>
    <tr>
      <td><strong>F. Inicio</strong></td>
      <td width="148"><input name="fecha_ini" type="text" id="fecha_ini" size="15" readonly="1" value="<?php echo cambiaf_a_normal($datos['fecha_ini']);?>" />
          <img src="jscalendar/img.gif" alt="r" name="f_trigger_ini" id="f_trigger_ini" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
      <td width="56"><strong>F. Fin</strong></td>
  <td width="148"><input name="fecha_fin" type="text" id="fecha_fin" size="15" readonly="1" value="<?php echo cambiaf_a_normal($datos['fecha_fin']);?>" />
          <img src="jscalendar/img.gif" alt="r" name="f_trigger_fin" id="f_trigger_fin" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
      <td><strong>Paso</strong></td>
      <td><span id="sprytextfield1">
      <input name="paso" type="text" id="paso" size="10" maxlength="3" value="<?php echo $datos['paso'];?>" />
      <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td><strong>Lugar Trabajo</strong></td>
      <td colspan="3"><input name="lugar_trabajo" type="text" id="lugar_trabajo" size="40" value="<?php echo $datos['lugar_trabajo'];?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Cod Rac</strong></td>
      <td colspan="3"><input type="text" name="cod_rac" id="cod_rac" value="<?php echo $datos['cod_rac'];?>" /></td>
      <td><strong>Fecha Elaboraci&oacute;n</strong></td>
      <td><input type="text" name="fecha_elab" id="fecha_elab" readonly="1"value="<?php echo cambiaf_a_normal($datos['fecha_elab']);?>" />
          <img src="jscalendar/img.gif" alt="r" name="f_trigger_elab" id="f_trigger_elab" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
    </tr>
    <tr>
      <td><strong>Sueldo Basico</strong></td>
      <td colspan="3"><span id="sprytextfield2">
        <input type="text" name="sueldo_basico" id="sueldo_basico" value="<?php echo $datos['sueldo_basico'];?>" />
      </span></td>
      <td><strong>Asignaciones</strong></td>
      <td><input type="text" name="asignaciones" id="asignaciones" value="<?php echo $datos['asignaciones'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Causa Egreso</strong></td>
      <td colspan="3"><input type="text" name="causa_egreso" id="causa_egreso"value="<?php echo $datos['causa_egreso'];?>" /></td>
      <td><strong>Fecha Egreso</strong></td>
      <td><input type="text" name="fecha_egreso" id="fecha_egreso" readonly="1" value="<?php echo cambiaf_a_normal($datos['fecha_egreso']);?>" />
          <img src="jscalendar/img.gif" alt="r" name="f_trigger_egreso" id="f_trigger_egreso" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
    </tr>
    <tr>
      <td><strong>Observaciones</strong></td>
      <td colspan="3"><textarea name="observaciones" cols="40" id="observaciones"><?php echo $datos['observaciones'];?></textarea></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td colspan="2" align="center"><input type="submit" name="cancelar" id="cancelar" value="Cancelar" /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
Calendar.setup({
        inputField     :    "fecha_egreso",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_egreso",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {isRequired:false});
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
Calendar.setup({
        inputField     :    "fecha_elab",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_elab",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {isRequired:false, validateOn:["blur"]});
</script>

</body>
</html>
