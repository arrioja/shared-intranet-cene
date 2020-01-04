<?php session_start();
if (!isset($_SESSION['login'])){
session_destroy();
echo '<script languaje="Javascript">location.href="login.php?pag=editar_integrantes.php?id='.$_GET['id'].'"</script>';
exit();}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edicion de Funcionarios</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
</head>
<?php
require "includes/miclase.php";
$link=conectarse("nomina");	  
	$cedula=$_GET['id'];
	$sql=mysql_query("select i.id,i.cedula, p.nombres, p.apellidos, i.anos_servicio, i.status,i.cod,i.tipo_nomina from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.cedula = '$cedula'",$link);
	$row = mysql_fetch_array($sql);        
        // instantiate the class
?>		
<body>
<form action="" method="post" name="form1" id="form1" >
  <table width="683" height="177" border="1" align="center">
    <tr>
      <td width="168" height="30"><div align="right">Nombres</div></td>
      <td width="195"><span id="sprytextfield1">
      <input type="text" name="nombres" id="nombres"value="<?php echo $row['nombres'];?>" readonly="readonly"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td width="109"><div align="right">Apellidos</div></td>
      <td width="187"><span id="sprytextfield2">
        <input type="text" name="apellidos" id="apellidos"value="<?php echo $row['apellidos'];?>" readonly="readonly" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><div align="right">Cedula</div></td>
      <td><span id="sprytextfield3">
        <input type="text" name="cedula" id="cedula"value="<?php echo $row['cedula'];?>" readonly="readonly" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td><div align="right">Codigo</div></td>
      <td><span id="codi">
        <input name="codigo" type="text" id="codigo" value="<?php echo $row['cod'];?>" />
      </span></td>
    </tr>
    <tr>
      <td height="24"><div align="right">A&ntilde;os previos Admin. Publica</div></td>
      <td><span id="sprytextfield4">
        <input name="anos_servicio" type="text" id="anos_servicio"value="<?php echo $row['anos_servicio'];?>" size="5" />
      </span></td>
      <td><div align="right">Nomina que Pertenece</div></td>
      <td><select name="t_nomina" id="t_nomina">
          <option value="EMPLEADOS"<?php if  ($row['tipo_nomina']=="EMPLEADOS") echo "selected='selected'";?>>EMPLEADOS</option>
          <option value="DIRECTORES"<?php if  ($row['tipo_nomina']=="DIRECTORES") echo "selected='selected'";?>>DIRECTORES</option>
          <option value="JUBILADOS"<?php if  ($row['tipo_nomina']=="JUBILADOS") echo "selected='selected'";?>>JUBILADOS</option>
          <option value="PENSIONADOS"<?php if  ($row['tipo_nomina']=="PENSIONADOS") echo "selected='selected'";?>>PENSIONADOS</option>
        </select>
        <input type="hidden" name="id" id="hiddenField" value="<?php echo $row['id']; ?>" /></td>
    </tr>
    <tr>
      <td height="37"><div align="right">Estatus</div></td>
      <td><select name="status" id="status">
          <option value="1"<?php if  ($row['status']==1) echo "selected='selected'";?>>ACTIVO</option>
          <option value="0"<?php if  ($row['status']==0) echo "selected='selected'";?>>INACTIVO</option>
        </select>      </td>
      <td><div align="right">Pago en Banco?</div></td>
      <td><select name="pago_banco" id="pago_banco">
          <option value="1"<?php if  ($row['pago_banco']=="1") echo "selected='selected'";?>>SI</option>
          <option value="0"<?php if  ($row['pago_banco']=="0") echo "selected='selected'";?>>NO</option>
        </select>
        <a href="integrantes_banco.php?ced=<?php echo $row['cedula'];?>">Asignar Cuenta</a> </td>
    </tr>
    <tr>
      <td height="28" colspan="2" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td colspan="2" align="center"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
      </span></td>
    </tr>
  </table>
</form>

<?php        
        if (isset($_POST['guardar']))
        {
			$objeto = new miclase();
			if ($objeto->editar_integrante($_POST['id'],$_POST['status'],$_POST['t_nomina'],$_POST['anos_servicio'],$_POST['pago_banco'],$_POST['codigo'],$link)==true)
				{
				abrir_popup("mensaje.php?texto=Editó Correctamente al Funcionario&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				echo '<script languaje="Javascript">location.href="visualizar_integrantes.php"</script>';
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {isRequired:false});
//-->
</script>
</body>
</html>
