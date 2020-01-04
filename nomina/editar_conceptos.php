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
$result=mysql_query("select * from conceptos where id='$id'",$link);
$conceptos=mysql_fetch_array($result);
}
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Edición de Conceptos</title>
        <script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
        <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
        <link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
        <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
        <style type="text/css">
<!--
.style18 {font-style: italic}
-->
        </style>
</head>
    <body>
<form id="form1" name="form1" method="post" action="">
  <table width="551" border="1" align="center">
    <tr>
      <td>Código</td>
      <td><span id="sprytextfield1">
        <input type="text" name="codigo" id="codigo"value="<?php echo $conceptos['cod']; $_SESSION['codigo']=$conceptos['cod'];?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td>Descripción</td>
      <td><span id="sprytextfield2">
        <input type="text" name="descripcion" id="descripcion"value="<?php echo $conceptos['descripcion'];$_SESSION['descripcion']=$conceptos['descripcion'];?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Tipo</td>
      <td><span id="spryselect1">
        <select name="tipo" id="tipo">
          <OPTION VALUE="CREDITO"<?php if($conceptos['tipo']=='CREDITO') echo "selected";?>>CREDITO</OPTION>
          <OPTION VALUE="DEBITO"<?php if($conceptos['tipo']=='DEBITO') echo "selected";?>>DEBITO</OPTION>
        </select>
      </span></td>
      <td>Fórmula</td>
      <td><span id="sprytextfield3">
        <input type="text" name="formula" id="formula"value="<?php echo $conceptos['formula'];$_SESSION['formula']=$conceptos['formula'];?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>General</td>
      <td><span id="spryselect2">
        <select name="general" id="general">
          <OPTION VALUE="0"<?php if($conceptos['general']=="0") echo "selected";?>>NO</OPTION>
          <OPTION VALUE="1"<?php if($conceptos['general']=="1") echo "selected";?>>SI</OPTION>
        </select>
      </span><a href="conceptos_general.php?cod=<?php echo $conceptos['cod'];?>"<?php $_SESSION['temporal_creada']='';?>>Asignacion General</a></td>
      <td>Frecuencia</td>
      <td><span id="spryselect3">
        <select name="frecuencia" id="frecuencia">
          <OPTION VALUE="SEMANAL"<?php if($conceptos['frecuencia']=="SEMANAL") echo "selected";?>>SEMANAL</OPTION>
          <OPTION VALUE="QUINCENAL"<?php if($conceptos['frecuencia']=="QUINCENAL") echo "selected";?>>QUINCENAL</OPTION>
          <OPTION VALUE="MENSUAL"<?php if($conceptos['frecuencia']=="MENSUAL") echo "selected";?>>MENSUAL</OPTION>
          <OPTION VALUE="TRIMESTRAL"<?php if($conceptos['frecuencia']=="TRIMESTRAL") echo "selected";?>>TRIMESTRAL</OPTION>
          <OPTION VALUE="SEMESTRAL"<?php if($conceptos['frecuencia']=="SEMESTRAL") echo "selected";?>>SEMESTRAL</OPTION>
          <OPTION VALUE="ANUAL"<?php if($conceptos['frecuencia']=="ANUAL") echo "selected";?>>ANUAL</OPTION>
        </select>
      </span></td>
    </tr>
    
    <tr>
      <td colspan="2" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td colspan="2" align="center"><a href="constantes.php"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='conceptos.php'" />
      </span></a><a href="conceptos.php"></a></td>
    </tr>
              </table>
</form>
<?php
//   include('file:///C|/Documents and Settings/carlos/My Documents/contraloria/includes/evalmath/evalmath.class.php');
if (isset($_POST['guardar']))
{  $objeto = new miclase();
	if ($objeto->editar_conceptos($_POST['codigo'],$_POST['descripcion'],$_POST['tipo'],$_POST['formula'],$_POST['general'],$_POST['frecuencia'],$_GET['id'],$link))
		{
		abrir_popup("mensaje.php?texto=Edito Correctamente el Concepto&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		echo '<script languaje="Javascript">location.href="conceptos.php"</script>';
		}
		else
		{
		$error= mysql_error($link);
		abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");//.mysql_error());
		}
	    mysql_close($link);
}
?> 
<script type="text/javascript">
<!--
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {validateOn:["blur"], isRequired:false});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"], isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"], isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
//-->
</script>
</body>
</html>