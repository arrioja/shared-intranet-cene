<?php 
include_once("definicion_fijo_contratado.php"); 
global $ajax; /* Important, always do this, because this page will be include */
$ajax->add("seccion","fijo.php");
//$ajax->add("bottom","time.php");
 require "../includes/miclase.php";	
 $link=conectarse("nomina");        
$cedula=$_GET['id']; 
$res=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.cedula='$cedula'", $link);
$datos=mysql_fetch_array($res);
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
		if ($objeto->insertar_integrantes_cargo($status,$_POST['denominacion'],$_POST['nivel'],$_POST['condicion'],$_POST['decreto'],$_POST['fecha_ini'],$_POST['fecha_fin'],$_POST['lugar_trabajo'],$_POST['direccion'],$_POST['cod_rac'],$fecha_elab, $_POST['sueldo_basico'],$_POST['asignaciones'],$_POST['causa_egreso'],$fecha_egreso,$_POST['fecha_ingreso'],$_POST['observaciones'], $cedula, $link)==true)
		{
		abrir_popup("../mensaje.php?texto=Inserto Correctamente el Cargo&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		}
		else
		{
		$error= mysql_error($link);
		abrir_popup("../mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		} 

	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php $ajax->printjs(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Integrantes Cargo</title>

<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" media="all" href="../jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <script type="text/javascript" src="../jscalendar/calendar.js"></script>
  <script type="text/javascript" src="../jscalendar/lang/calendar-espanol.js"></script>
  <script type="text/javascript" src="../jscalendar/calendar-setup.js"></script>

<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="500" border="1">
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
  <table width="873" border="1">
    <tr>
      <td width="162"><strong>Denominacion</strong></td>
      <td width="279"><span id="sprytextfield1">
        <input name="denominacion" type="text" id="denominacion" size="40" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td width="204"><strong>Nivel</strong></td>
      <td width="200">
      <?php $result1=mysql_query("select nombre from nivel",$link);?>
      <select name="nivel" id="nivel">
      <?php while ($nivel=mysql_fetch_array($result1)){?>
      <option value="<?php echo $nivel['nombre']; ?>"><?php echo $nivel['nombre'];?></option>
      <?php }?>
      </select>      </td>
    </tr>
    <tr>
      <td><strong>Condici&oacute;n</strong></td>
      <td><p>
        <label></label><label></label>
        <a href="fijo.php">Fijo</a> <a href="contratado.php">Contratado</a><br />
      </p>
      
      </td>
      <td colspan="2" rowspan="2"><?php 		//Printing Ajax section
		$ajax->AjaxSection("seccion");?>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Lugar Trabajo</strong></td>
      <td><input name="lugar_trabajo" type="text" id="lugar_trabajo" size="40" /></td>
      <td><strong>Direccion</strong></td>
      <td><span id="spryselect1">
<?php $result=mysql_query("select nombre_abreviado,nombre_completo,codigo from direcciones",$link);?>      
        <select name="direccion" id="direccion">
        <?php while ($direcciones=mysql_fetch_array($result)){?>
          <option value="<?php echo $direcciones['codigo']; ?>"><?php echo $direcciones['nombre_abreviado'];?></option>
          <?php }?>
        </select>
      </span></td>
    </tr>
    <tr>
      <td><strong>Cod Rac</strong></td>
      <td><input type="text" name="cod_rac" id="cod_rac" /></td>
      <td><strong>Fecha Elaboraci&oacute;n</strong></td>
      <td><input type="text" name="fecha_elab" id="fecha_elab" readonly="1" />
        <img src="../jscalendar/img.gif" alt="r" name="f_trigger_elab" id="f_trigger_elab" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
    </tr>
    <tr>
      <td><strong>Sueldo Basico</strong></td>
      <td><span id="sprytextfield2">
        <input type="text" name="sueldo_basico" id="sueldo_basico" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td><strong>Asignaciones</strong></td>
      <td><input type="text" name="asignaciones" id="asignaciones" /></td>
    </tr>
    <tr>
      <td><strong>Causa Egreso</strong></td>
      <td><input type="text" name="causa_egreso" id="causa_egreso" /></td>
      <td><strong>Fecha Egreso</strong></td>
      <td><input type="text" name="fecha_egreso" id="fecha_egreso" readonly="1" />
        <img src="../jscalendar/img.gif" alt="r" name="f_trigger_egreso" id="f_trigger_egreso" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
    </tr>
    <tr>
      <td><strong>Observaciones</strong></td>
      <td><textarea name="observaciones" cols="40" id="observaciones"></textarea></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td colspan="2" align="center"><input type="submit" name="cancelar" id="cancelar" value="Cancelar" /></td>
    </tr>
  </table>
</form>

<?php 
$resultado=mysql_query("select * from integrantes_cargo where cedula='$cedula'",$link);
?>
<table width="680" border="1">

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
    <td><?php echo $cargos['cod_direccion']?></td>
    <td><a href="editar_integrantes_cargo.php?id=<?php echo $cargos['id'];?>"><img src="../imagenes/b_edit.png" width="16" height="16" border="0" /></a> <a href="../includes/quitar_integrantes_cargo.php?id=<?php echo $cargos['id'];?>&ced=<?php echo $_GET['id'];?>"><img src="../imagenes/b_drop.png" width="16" height="16" border="0" /></a></td>
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
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>
</body>
</html>
