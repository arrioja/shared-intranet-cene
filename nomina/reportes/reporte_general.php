<?php 
include "../includes/miclase.php";
$link=conectarse("nomina");
$result=mysql_query("select * from nomina_actual where status='ACTIVA'",$link);
$nomina_actual=mysql_fetch_array($result);
$cod=$nomina_actual['cod'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte General</title>
<style type="text/css">
<!--
.style2 {color: #FF0000}
.style3 {
	color: #009900;
	font-style: italic;
}
.style5 {
	color: #006600;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="300" border="1" align="center">
  <tr>
    <td align="center"><strong>REPORTE GENERAL DE PAGO</strong></td>
  </tr>
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <strong>NOMINA DE</strong>:
	<select name="t_nomina" id="ver_nomina">
    <option value="EMPLEADOS" <?php if ($_POST['t_nomina']=='EMPLEADOS') echo "selected='selected'"?>>EMPLEADOS</option>
    <option value="DIRECTORES" <?php if ($_POST['t_nomina']=='DIRECTORES')  echo "selected='selected'"?>>DIRECTORES</option>
    <option value="JUBILADOS" <?php if ($_POST['t_nomina']=='JUBILADOS')  echo "selected='selected'"?>>JUBILADOS</option>
    <option value="PENSIONADOS" <?php if ($_POST['t_nomina']=='PENSIONADOS')  echo "selected='selected'"?>>PENSIONADOS</option>
    </select>	
        <input type="submit" name="ver" id="ver" value="Ver" />
    </form>    </td>
  </tr>
  <tr>
    <td><strong>PERIODO:</strong> <?php echo $nomina_actual['f_ini']; ?> al <?php echo $nomina_actual['f_fin']; ?> </td>
  </tr>
  <tr>
    <td align="right"><a href="../visualizar_integrantes.php">Volver</a></td>
  </tr>
</table>
<?php if (isset($_POST['ver']))
{
$tipo_nomina=$_POST['t_nomina'];

$res_cedula=mysql_query("select distinct p.apellidos, p.nombres,i.cod as cod_nomina, n.cedula from nomina n inner join integrantes i on i.cedula=n.cedula inner join organizacion.personas p on p.cedula=n.cedula  where n.cod='$cod' and n.tipo_nomina='$tipo_nomina' order by cod_nomina asc",$link);//lista de nombres apellidos cedula y cod nomina de los integrantes de la nomina

?>
<table width="831" border="1">
  <tr>
    <td width="42"><strong>cod</strong></td>
    <td width="365"><strong>Apellidos y Nombres</strong></td>
    <td width="90" align="center"><strong>Cedula</strong></td>
    <td width="99"><strong>Asignaciones</strong></td>
    <td width="96"><strong>Deducciones</strong></td>
    <td width="99"><strong>Total Neto</strong></td>
  </tr>
  <?php while($integrantes=mysql_fetch_array($res_cedula)){?>
  <tr>
    <td><?php echo $integrantes['cod_nomina']; ?></td>
    <td><strong><?php echo $integrantes['nombres'].' '.$integrantes['apellidos'];?></strong></td>
    <td align="center"><?php echo $integrantes['cedula']; ?></td>
<?php $ced=$integrantes['cedula']; $result2=mysql_query("select n.descripcion,n.monto_incidencia,n.cod_incidencia, n.tipo from nomina n where n.cedula='$ced' order by n.tipo asc",$link); while ($incidencias=mysql_fetch_array($result2)){?>
    	<?php if (($incidencias['tipo']=='CREDITO')||($incidencias['tipo']=='DEBITO')) {//si es credito o debito?>
        <tr>
    	<td><span class="style3"></span></td>
    	<td><?php echo $incidencias['descripcion']; ?></td>

			
    	<td><span class="style5"></span></td>
        <td align="right"><span class="style5"><?php if ($incidencias['tipo']=='CREDITO') echo $incidencias['monto_incidencia'];?></span></td>
        <td align="right"><span class="style2"><?php if ($incidencias['tipo']=='DEBITO') echo $incidencias['monto_incidencia'];?></span></td>
  		</tr>
      <?php }//if credito o debito
	  else if ($incidencias['tipo']=='ASIGNACION')$asignacion=$incidencias['monto_incidencia'];
		else  if ($incidencias['tipo']=='DEDUCCION')$deduccion=$incidencias['monto_incidencia'];?>
      <?php }//while?>
            <tr><td></td>
            <td align="right"><strong>Totales</strong></td>
            <td></td><td align="right" class="style5"><?php echo $asignacion;?></td>
            <td align="right" class="style2"><?php echo $deduccion;?></td><td align="right" class="style5"><?php echo $asignacion-$deduccion;?></td>
    
  </tr>
 <tr>
   <td colspan="6">----------------------------------------------------------------------------------------------------------------------------------------</td>
 </tr> 
<?php }//while?>
</table>
<?php }//if isset?>
<p></p>
<p>&nbsp;</p>
</body>
</html>