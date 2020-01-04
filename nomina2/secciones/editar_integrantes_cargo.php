<?php 
include_once("definicion_fijo_contratado.php"); 
global $ajax; /* Important, always do this, because this page will be include */
$ajax->add("seccion","fijo.php");
//$ajax->add("bottom","time.php");
 require "../includes/miclase.php";	
$link=conectarse("nomina");        
$id=$_GET['id']; 
$res=mysql_query("select * from integrantes_cargo where id='$id'", $link);
$datos=mysql_fetch_array($res);
?>


<?php 
if (isset($_POST['guardar']))
	{
	 /*$objeto = new miclase();
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

	*/}
	
if (isset($_POST['cancelar']))	
{
echo '<script languaje="Javascript">location.href="integrantes_cargo.php?id='.$ced.'"</script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="873" border="1">
    <tr>
      <td width="162"><strong>Denominacion</strong></td>
      <td width="279"><span id="sprytextfield1">
        <input name="denominacion" type="text" id="denominacion" size="40" value="<?php echo $datos['denominacion'];?>" />
      </span></td>
      <td width="204"><strong>Nivel</strong></td>
      <td width="200"><?php $result1=mysql_query("select nombre from nivel",$link);?>
          <select name="nivel" id="nivel">
            <?php while ($nivel=mysql_fetch_array($result1)){?>
            <option value="<?php echo $nivel['nombre']; ?>"><?php echo $nivel['nombre'];?></option>
            <?php }?>
          </select>
      </td>
    </tr>
    <tr>
      <td><strong>Condici&oacute;n</strong></td>
      <td><p>
        <label></label>
        <label></label>
        <select name="condicion" id="condicion">
          <option value="FIJO"<?php if ($datos['condicion']=='FIJO') echo "selected='selected'";?>>FIJO</option>
          <option value="CONTRATADO"<?php if ($datos['condicion']=='CONTRATADO') echo "selected='selected'";?>>CONTRATADO</option>
        </select>
        <br />
      </p></td>
      <td colspan="2" rowspan="2"><?php 		//Printing Ajax section
		$ajax->AjaxSection("seccion");?>
        &nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Lugar Trabajo</strong></td>
      <td><input name="lugar_trabajo" type="text" id="lugar_trabajo" size="40" value="<?php echo $datos['lugar_trabajo'];?>" /></td>
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
      <td><input type="text" name="cod_rac" id="cod_rac" value="<?php echo $datos['cod_rac'];?>" /></td>
      <td><strong>Fecha Elaboraci&oacute;n</strong></td>
      <td><input type="text" name="fecha_elab" id="fecha_elab" readonly="1"value="<?php echo $datos['fecha_elab'];?>" />
          <img src="../jscalendar/img.gif" alt="r" name="f_trigger_elab" id="f_trigger_elab" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
    </tr>
    <tr>
      <td><strong>Sueldo Basico</strong></td>
      <td><span id="sprytextfield2">
        <input type="text" name="sueldo_basico" id="sueldo_basico" value="<?php echo $datos['sueldo_basico'];?>" />
      </span></td>
      <td><strong>Asignaciones</strong></td>
      <td><input type="text" name="asignaciones" id="asignaciones" value="<?php echo $datos['asignaciones'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Causa Egreso</strong></td>
      <td><input type="text" name="causa_egreso" id="causa_egreso"value="<?php echo $datos['causa_egreso'];?>" /></td>
      <td><strong>Fecha Egreso</strong></td>
      <td><input type="text" name="fecha_egreso" id="fecha_egreso" readonly="1" value="<?php echo $datos['fecha_egreso'];?>" />
          <img src="../jscalendar/img.gif" alt="r" name="f_trigger_egreso" id="f_trigger_egreso" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
    </tr>
    <tr>
      <td><strong>Observaciones</strong></td>
      <td><textarea name="observaciones" cols="40" id="observaciones" value="<?php echo $datos['observaciones'];?>"> </textarea></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
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
</script>

</body>
</html>
