<?php 
session_start();
include "includes/miclase.php";
$link=conectarse("nomina");
$id=$_GET['id'];
$sql=mysql_query("select p.nombres, p.apellidos, p.cedula from organizacion.personas p  where p.cedula = '$id'",$link);//obtener datos del funcionario
$row = mysql_fetch_array($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asignar Constantes Integrantes</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="644" border="1" align="center">
    <tr>
      <td width="149">Nombres</td>
      <td width="185"><input type="text" name="nombres" id="nombres" readonly="readonly"value="<?php echo $row['nombres'];?>" /></td>
      <td colspan="2" rowspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>Apellidos</td>
      <td><input type="text" name="apellidos" id="apellidos" readonly="readonly"value="<?php echo $row['apellidos'];?>" /></td>
    </tr>
    <tr>
      <td>C&eacute;dula</td>
      <td><input type="text" name="cedula" id="cedula" readonly="readonly"value="<?php echo $row['cedula'];?>" /></td>
      <td>Monto</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Constantes Disponibles</td>
      <td><span id="spryselect1">
        <select name="constantes" id="constantes"><?php $arreglo=mysql_evaluate_array("select descripcion from constantes",$link);//mando la consulta para llenar el arreglo
	  foreach ($arreglo as $const){?><option value="<?php echo $const ?>"><?php echo $const;?></option><?php }?></select>
      </span></td>
      <td><span id="sprytextfield1">
      <input type="text" name="monto" id="monto" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Formato Inv&aacute;lido</span></span></td>
      <td><input type="submit" name="asignar" id="asignar" value="Asignar" /></td>
    </tr>
    <tr>
      <td align="right"><a href="visualizar_integrantes.php"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
      </span></a><a href="mostrar_integrantes.php?id=<?php echo $id ?>"></a></td>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>
<form id="form2" name="form2" method="post" action="">
  <table width="574" border="1" align="center">
    <tr>
      <td width="90"><strong>C&oacute;digo</strong></td>
      <td width="144"><strong>Descripci&oacute;n</strong></td>
      <td width="96"><strong>Tipo</strong></td>
      <td width="123"><strong>Monto</strong></td>
      <td width="87"><strong>Acci&oacute;n</strong></td>
    </tr><?php 
if (isset($_POST['asignar']))//si presiona el boton asignar  
{
$descripcion=$_POST['constantes'];
$res=mysql_query("select * from constantes where descripcion='$descripcion'");			
if ($res)//para buscar los datos de la constante
	{$fila = mysql_fetch_array($res);//carga la fila de la constante(necesito el codigo de la constante)
	$objeto = new miclase();
	if ($objeto->insertar_integrantes_constantes($_POST['cedula'],$fila['cod'],$_POST['monto'],$link))
		{
		}else
		{$error= mysql_error($link);
		abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		}
	}
	else
		{$error= mysql_error($link);
		abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		}
}

$result=mysql_query("select c.cod, c.descripcion, c.tipo, ic.monto, ic.id from constantes as c inner join integrantes_constantes as ic on ic.cod_constantes=c.cod inner join integrantes as i on i.cedula=ic.cedula  where i.cedula='$id'",$link);
$integral=0;//para calcular el sueldo integral     
   while($row2 = mysql_fetch_array($result)) {
 		$integral=$integral+$row2["monto"];
 		$cod=$row2["cod"];
 		if ($row2["cod"]=='4444')//si es el sueldo integral (ahi va el codigo del sueldo integral 
?><tr>
      <td><?php echo $row2["cod"];?></td>
      <td><?php echo $row2["descripcion"];?></td>
      <td><?php echo $row2["tipo"];?></td>
      <td><?php if ($row2["cod"]=='4444'){echo $integral;} else {echo $row2['monto'];}?></td>
      <td><a href="editar_constantes_integrantes.php?id=<?php echo $row2['id'];?>&ced=<?php echo $id;?>&cod=<?php echo $row2["cod"];?>">Editar</a> <a href="includes/borrar_integrantes_constantes.php?id=<?php echo $id;?>&cod=<?php echo $row2['cod'];?>">Quitar</a></td>
    </tr><?php }?></table>
</form>
<script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "real", {validateOn:["blur"]});
//-->
</script>
</body>
</html>