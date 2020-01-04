<?php
session_start();
if (!isset($_SESSION['login']))
{
session_destroy();
echo '<script languaje="Javascript">location.href="login.php"</script>';
exit();
}
else
{
include "includes/miclase.php";	        
$link=conectarse("nomina");      
$id=$_GET['id'];
$result=mysql_query("select * from constantes where id='$id'");
$constantes=mysql_fetch_array($result);
}
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Edición de Constantes</title>
        <script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
        <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
        <link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
        <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
        <!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <script type="text/javascript" src="jscalendar/calendar.js"></script>
  <script type="text/javascript" src="jscalendar/lang/calendar-espanol.js"></script>
  <script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
    </head>
    <body>
  <form id="form1" name="form1" method="post" action="">
    <table width="593" border="1" align="center">
      <tr>
        <td width="79">Código</td>
        <td width="188"><span id="sprytextfield1">
          <input type="text" name="codigo" id="codigo" value="<?php echo $constantes['cod'];$_SESSION['codigo']=$constantes['cod'];?>" />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">ingrese solo numeros.</span></span></td>
        <td width="132">Descripción</td>
        <td width="144"><span id="sprytextfield2">
    <input type="text" name="descripcion" id="descripcion" value="<?php echo $constantes['descripcion'];$_SESSION['descripcion']=$constantes['descripcion'];?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>Abreviatura</td>
        <td><span id="sprytextfield3">
          <input type="text" name="abreviatura" id="abreviatura" value="<?php echo $constantes['abreviatura'];$_SESSION['abreviatura']=$constantes['abreviatura'];?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
        <td>Tipo</td>
        <td><span id="spryselect1">
          <select name="tipo" id="tipo">
            <OPTION VALUE="CREDITO"<?php if($constantes['tipo']=='CREDITO') echo "selected";?>>CREDITO</OPTION>
            <OPTION VALUE="DEBITO"<?php if ($constantes['tipo']=='DEBITO') echo "selected";?>>DEBITO</OPTION>
            <option value="OTRO">OTRO</option>
      </select>
          </span></td>
      </tr>
      <tr>
        <td>Fecha</td>
        <td><input type="text" name="fecha" id="f_date_c" readonly="1" value="<?php echo cambiaf_a_normal($constantes['fecha']);?>"/>
            <img src="jscalendar/img.gif" alt="fecha" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" /></td>
        <td colspan="2"><a href="constantes_general.php?cod=<?php echo $constantes['cod'];?>"<?php $_SESSION['temporal_creada']=''; ?>>Asignacion Multiple</a>
        <input type="hidden" name="id" id="id" value="<?php echo  $constantes['id'];?>">          <a href="asignacion_constantes_general.php"></a></td>
      </tr>
      <tr>
        <td colspan="2" align="right"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
        <td colspan="2"><a href="constantes.php">Volver</a></td>
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
<?php 
if (isset($_POST['guardar']))
        {
			$objeto = new miclase();
			$fecha=$objeto->cambiaf_a_mysql($_POST['fecha']);
			if ($objeto->editar_constantes($_POST['codigo'],$_POST['descripcion'],$_POST['tipo'],$_POST['abreviatura'],$fecha,$_GET['id'],$link))
			 	{//ojo revisar este error   con   ob_start
				abrir_popup("mensaje.php?texto=Edito Correctamente la Constante&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				echo '<script languaje="Javascript">location.href="constantes.php"</script>';
				//header("Location: constantes.php");
				}
			else
				{
			   $error= mysql_error($link);
				abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				}
		  mysql_close($link);

        }
?>
<script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
//-->
</script>
</body>
</html>