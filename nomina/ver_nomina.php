<?php
require "includes/miclase.php";
$link=conectarse("nomina");        
$result=mysql_query("select * from nomina_actual where status='ACTIVA'",$link);
$datos = mysql_fetch_array($result);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ver Nomina Creada</title>
</head>

<body>
<table width="644" border="1" align="center">
  <tr>
    <td width="126"><strong>Periodo:</strong> <?php echo $datos["periodo"];?></td>
    <td width="147"><strong>Cod. N&oacute;mina:</strong> <?php echo $datos["cod"];?> </td>
    <td width="305"><strong>Desde:</strong> <?php echo $datos['f_ini'];?><strong> Hasta:</strong> <?php echo $datos['f_fin'];?></td>
  </tr>
  <tr>
    <td><strong>Fecha Elaboracion:</strong> <?php echo $datos['f_elab'];?></td>
    <td><strong>Titulo:</strong> <?php echo $datos['titulo'];  ?></td>
    <td><form id="form1" name="form1" method="post" action="">
      <strong>Tipo Nomina:</strong>
      <select name="t_nomina" id="t_nomina">
        <option value="EMPLEADOS" <?php if ($_POST['t_nomina']=='EMPLEADOS') echo "selected='selected';"?>>EMPLEADOS</option>
        <option value="DIRECTORES"<?php if ($_POST['t_nomina']=='DIRECTORES') echo "selected='selected';"?>>DIRECTORES</option>
        <option value="JUBILADOS"<?php if ($_POST['t_nomina']=='JUBILADOS') echo "selected='selected';"?>>JUBILADOS</option>
        <option value="PENSIONADOS"<?php if ($_POST['t_nomina']=='PENSIONADOS') echo "selected='selected';"?>>PENSIONADOS</option>
      </select>
      <input type="submit" name="ver" id="ver" value="Ver" />
        </form>
    </td>
  </tr>
</table>
<div align="center">
  <?php
if (isset($_POST['ver']))
{
$t_nomina=$_POST["t_nomina"];	 
if ($result2=mysql_query("select distinct n.cedula, i.nombres,i.apellidos from nomina n inner join integrantes i on i.cedula=n.cedula where n.tipo_nomina='$t_nomina'",$link)){//integrantes de la nomina escogida   
?> 
  <a href="index.php">Volver
  </a>
</div>
<table width="644" border="1" align="center">
  <tr>
    <td width="65"><strong>Cedula </strong></td>
    <td width="110"><strong>Nombres</strong></td>
    <td width="105"><strong>Apellidos</strong></td>
    <td width="95"><strong>Asignaciones</strong></td>
    <td width="85"><strong>Deducciones</strong></td>
    <td width="86"><strong>Total Neto</strong></td>
    <td width="52"><strong>Detalle</strong></td>
  </tr>
<?php

while ($integrantes=mysql_fetch_array($result2))//mientras hayan registros en la tabla nomina
{
$asignaciones=asignaciones($integrantes["cedula"],$link);
$deducciones=deducciones($integrantes["cedula"],$link);
$total=$asignaciones-$deducciones;
?>  
  <tr>
    <td><?php echo $integrantes["cedula"];?></td>
    <td><?php echo $integrantes["nombres"];?></td>
    <td><?php echo $integrantes["apellidos"];  ?></td>
    <td><?php echo $asignaciones;?></td>
    <td><?php echo $deducciones?></td>
    <td><?php echo $total;?></td>
    <td><a href="mostrar_integrantes.php?id=<?php echo $integrantes["cedula"];?>">Ver</a></td>
  </tr>
  <?php }}}?>
</table>
<p>&nbsp;</p>
</body>
</html>
