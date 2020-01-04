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
<title>REPORTE RESUMEN DE CONCEPTOS</title>
<style type="text/css">
<!--
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
    <td align="center"><strong>REPORTE RESUMEN DE CONCEPTOS</strong></td>
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
$result2=mysql_query("select distinct cod_incidencia, descripcion, tipo, sum(monto_incidencia) suma,count(cod_incidencia) num  from nomina where tipo_nomina='$tipo_nomina' and (tipo='DEBITO' OR tipo='CREDITO')group by cod_incidencia order by tipo ",$link);
?>
<table width="876" border="1" bordercolor="0" bgcolor="#FFFFFF">
  <tr>
    <td width="55"><strong>COD</strong></td>
    <td width="292"><strong>Descripción del Concepto</strong></td>
    <td width="172"><strong>Asignaciones</strong></td>
    <td width="221"><strong>Deducciones</strong></td>
    <td width="102"><strong>No. Personas</strong></td>
  </tr>
  <?php $num=0; $asignaciones=0;$deducciones=0;
  while($conceptos=mysql_fetch_array($result2)){?><tr><td><?php echo $conceptos['cod_incidencia'];?></td>
  <td><strong><?php echo $conceptos['descripcion'];?></strong></td><td align="right"><span class="style5"><?php if ($conceptos['tipo']=='CREDITO')  {echo $conceptos['suma'];$asignaciones=$asignaciones+$conceptos['suma'];}?></span></td>
  <td align="right"><span class="style7"><?php if ($conceptos['tipo']=='DEBITO') {echo $conceptos['suma'];$deducciones=$deducciones+$conceptos['suma'];}?></span></td>
  <td align="center"><span class="dgBold"><?php {echo $conceptos['num'];$num=$num+$conceptos['num'];}?></span></td>
  </tr>

<?php }//while?>
<tr><td></td><td><strong>Totales</strong></td>
<td align="right" class="style5"><em><?php echo $asignaciones; ?></em></td>
<td align="right" class="style7"><em><?php echo $deducciones; ?></em></td>
<td align="center" class="dgBold">&nbsp;</td>
</tr>
<tr><td></td><td><strong>Neto</strong></td>
<td align="right"><em></em></td>
<td align="right" class="style5"><em><?php echo $asignaciones-$deducciones; ?></em></td>
<td align="center"><em></em></td>
</tr>
</table>
<?php }//if isset?>
<p></p>
<p>&nbsp;</p>
</body>
</html>
