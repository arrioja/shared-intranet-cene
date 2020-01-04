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
<title>REPORTE REVISION DE NOMINA</title>
<style type="text/css">
<!--
.style1 {color: #006600}
.style2 {color: #FF0000}
.style3 {
	color: #009900;
	font-style: italic;
}
.style5 {
	color: #006600;
	font-weight: bold;
}
.style7 {color: #FF0000; font-style: italic; }
-->
</style>
<link href="../css/dgstyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="300" border="1" align="center">
  <tr>
    <td align="center"><strong>REPORTE REVISION DE NOMINA</strong></td>
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
    <td align="right" class="dgLinks"><a href="../visualizar_integrantes.php">Volver</a></td>
  </tr>
</table>
<?php if (isset($_POST['ver']))
{
$tipo_nomina=$_POST['t_nomina'];
$result2=mysql_query("select p.apellidos, p.nombres,i.cod as cod_nomina, n.cedula, n.descripcion,n.monto_incidencia,n.cod_incidencia, n.tipo,n.tipo_nomina from nomina n inner join integrantes i on i.cedula=n.cedula inner join organizacion.personas p on p.cedula=n.cedula where (n.cod='$cod' and n.tipo_nomina='$tipo_nomina') and(n.cod_incidencia='7001' or n.cod_incidencia='7002' or n.cod_incidencia='7003' ) order by cod_nomina asc, n.cod_incidencia asc",$link);
?>
<table width="875" border="1" cellpadding="0" cellspacing="0" bordercolor="0" bgcolor="#FFFFFF">
  <tr>
    <td width="45"><strong>COD</strong></td>
    <td width="409"><strong>Apellidos y Nombres</strong></td>
    <td width="91" align="center"><strong>Cédula</strong></td>
    <td width="111"><strong>Asignaciones</strong></td>
    <td width="104"><strong>Deducciones</strong></td>
    <td width="101"><strong>Total Neto</strong></td>
  </tr>
  <?php $asignaciones=0; $deducciones=0; $neto=0; $ced=''; 
  $i=0; while($nomina=mysql_fetch_array($result2)){?><td><?php echo $nomina['cod_nomina'];?></td>
  <td><?php echo $nomina['nombres'].' '.$nomina['apellidos'];?></td>
  <td align="center"><?php echo $nomina['cedula'];?></td>
  <td align="right"><span class="style3"><?php echo $nomina['monto_incidencia'];$nomina=mysql_fetch_array($result2);?></span></td>
  <td align="right"><span class="style7"><?php echo $nomina['monto_incidencia'];$nomina=mysql_fetch_array($result2);?></span></td>
  <td align="right"><span class="style5"><?php echo $nomina['monto_incidencia'];?></span></td>
  <tr></tr>

<?php }//while?>
</table>
<?php }//if isset?>
<p></p>
<p>&nbsp;</p>
</body>
</html>