<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
include "../conexion/conectar.php";

$cod=$_GET['seleccionado'];
$consulta="select oe.codigo, oe.nombre, oe.descripcion, oe.cod_plan_e_dir, pe.codigo, pe.nombre, pe.cod_direccion, d.codigo, d.nombre, d.codigo_organizacion, o.codigo, o.nombre from gestion_obj_estrategicos_direcciones oe inner join gestion_planes_estrategicos_direcciones pe on (oe.cod_plan_e_dir=pe.codigo) inner join gestion_direcciones d on (pe.cod_direccion=d.codigo) inner join gestion_organizacion o on (d.codigo_organizacion=o.codigo) where oe.codigo='$cod'";
$result=mysql_query($consulta,$link);
$row=mysql_fetch_array($result);

?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Gestión/Dirección/Objetivos Estratégicos</title>
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="f1" name="form1" method="post" action="guarda_modificacion.php?seleccionado=<?php echo $cod ?>">
  <table width="602" border="1" align="center" cellpadding="2">
    <tr bgcolor="#FFFFFF" class="encabezado">
      <td colspan="2" id="fila_1"><div align="center" class="style2"><strong><img src="../imag/usuario.png" alt="" width="57" height="45" />Registro de Objetivos Estrat&eacute;gicos</strong> <strong>Direcci&oacute;n</strong></div></td>
    </tr>
    <tr>
      <td width="36%" id="nombre"><strong>Organizaci&oacute;n</strong></td>
      <td width="64%" id="nombre"><input type="text" name="organizacion" id="organizacion" disabled="disabled" value="<?php echo $row[11] ?>"/></td>
    </tr>
    <tr>
    
      <td width="36%" align="center" id=><div align="justify"> <strong>Direcci&oacute;n</strong></div> </td>       
      <td width="64%" align="" id="cod">
        <input type="text" name="direccion" id="direccion" disabled="disabled" value="<?php echo $row[8]?>" />   </td>
    </tr>
    <tr>
      <td width="36%" align="center" id=><div align="justify"><strong>Plan Estrat&eacute;gico</strong> <strong>Direcci&oacute;n</strong></div></td>
      <td width="64%" align="" id="plan">
        <input type="text" name="plan" id="plan"  disabled="disabled" value="<?php echo $row[5]?>"/>    </td>
    </tr>
    <tr>
      <td><strong>C&oacute;digo</strong></td>
      <td><label>
        <input type="text" name="codigo" id="codigo" disabled="disabled" value="<?php echo $row[0]?>"/>
      </label></td>
    </tr>
    <tr>
      <td><strong>Nombre</strong></td>
      <td>
        <input name="nombre" type="text" id="nombre2" size="60" value="<?php echo $row[1]?>" />     </td>
    </tr>
    <tr>
      <td align="justify" id="plan"><strong>Descripci&oacute;n</strong></td>
      <td align="justify" id="plan"><label>
        <input name="descripcion" type="text" id="descripcion" size="60" value="<?php echo $row[2]?>"/>
      </label></td>
    </tr>
    <tr class="encabezado">
      <td colspan="2" >
        <div align="center">
          <input type="submit" name="insertar" id="button" value="Guardar" />
          <a href="admin_objetivos_estrategicos_direcciones.php">
          <input type="submit" name="atras" id="atras" value="Atras" />
        </a>        </div>      </td>
    </tr>
  </table>

</form>

</body>
</html>
