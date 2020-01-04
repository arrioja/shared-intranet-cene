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
<title>Reporte Individual</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {color: #FF0000}
.style4 {color: #006600}
-->
</style>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="336" border="1" align="center">
    <tr>
      <td colspan="2" align="center"><strong>REPORTE INDIVIDUAL DE PAGO</strong></td>
    </tr>
    <tr>
      <td colspan="2" align="right"><strong>Ingrese la Cédula</strong>:<span id="sprytextfield1">
        <input type="text" name="cedula" id="cedula" value="<?php echo $_POST['cedula'] ?>" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    
    <tr>
      <td width="165" align="center"><input type="submit" name="ver" id="ver" value="Ver" /></td>
      <td width="155" align="center"><a href="../visualizar_integrantes.php">Volver</a></td>
    </tr>
      </table>
</form>
<?php if (isset($_POST['ver'])){
$cedula=$_POST['cedula'];

$result2=mysql_query("select p.apellidos, p.nombres,i.cod as cod_nomina, n.cedula, n.descripcion,n.monto_incidencia, n.tipo,n.tipo_nomina from nomina n inner join integrantes i on i.cedula=n.cedula inner join organizacion.personas p on n.cedula=p.cedula where n.cod='$cod' and n.cedula='$cedula' order by n.cedula desc, n.tipo asc",$link);
?>
<table width="737" border="1" align="center">
  <tr>
    <td width="32"><strong>COD</strong></td>
    <td width="196"><strong>Apellidos y Nombres</strong></td>
    <td width="66"><strong>Cedula</strong></td>
    <td width="107"><strong>Asignaciones</strong></td>
    <td width="97"><strong>Deducciones</strong></td>
    <td width="113"><strong>Total Neto</strong></td>
  </tr>
  <?php $ced=''; $deducciones=0;$asignaciones=0;$i=0; while ($nomina=mysql_fetch_array($result2)){$i++; if ($i==1){?>
  <tr>
  <td><?php echo $nomina['cod_nomina'];?></td>
  <td><em><strong><?php echo $nomina['apellidos'].', '.$nomina['nombres'];?><strong></em></td>
  <td align="right"><?php echo $nomina['cedula']; $ced=$nomina['cedula'];$deducciones=0;?></td>
  <tr>
  <?php  }  if (($nomina['tipo']!='ASIGNACION')&&($nomina['tipo']!='DEDUCCION')&&($nomina['tipo']!='NETO'))//tipos de incidencias que muestro solo al final
  {?>
  <td></td>
  <td><em><?php echo $nomina['descripcion'];?></em></td>
  <td></td>
  <td align="right"><span class="style4">
    <?php if ($nomina['tipo']=='CREDITO'){echo $nomina['monto_incidencia'];}?>
  </span></td>
  <td align="right"><span class="style2">
    <?php if ($nomina['tipo']=='DEBITO'){echo $nomina['monto_incidencia'];}?>
  </span></td>
  <td align="right"><span class="style4"></span></td> <?php }?>
  </tr>  
	<?php if ($nomina['tipo']=='ASIGNACION')$asignaciones=$nomina['monto_incidencia']; if ($nomina['tipo']=='DEDUCCION')$deducciones=$nomina['monto_incidencia'];}//while?>
  <tr><td></td><td><strong>Totales</strong></td><td></td><td align="right"><span class="style4"><strong><?php echo $asignaciones;?></strong></span></td> <td align="right"><span class="style2"><strong><?php echo $deducciones;?></strong></span></td><td align="right"><span class="style4"><strong><?php echo $asignaciones-$deducciones;?></strong></span></td>
  </tr>
</table>
<p><?php }//if isset?>
</p>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>
</body>
</html>