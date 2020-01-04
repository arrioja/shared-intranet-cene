<?php
include("includes/miclase.php");
$link=conectarse("nomina");
$result=mysql_query("select distinct n.cod,n.tipo_nomina, na.titulo from nomina n inner join nomina_actual na on n.cod=na.cod",$link);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listado de Nóminas</title>
</head>

<body>
<table width="792" border="1">
  <tr>
    <td colspan="4" align="center"><strong>Listado de Nóminas</strong></td>
  </tr>
  <tr>
    <td width="48"><strong>Cod</strong></td>
    <td width="405"><strong>Descripción</strong></td>
    <td width="152"><strong>Tipo de Nómina</strong></td>
    <td width="159"><strong>Acciones</strong></td>
  </tr>
  <?php while($nomina=mysql_fetch_array($result)){?>
  <tr>
    <td><?php echo $nomina['cod'];?></td>
    <td><?php echo $nomina['titulo'];?></td>
    <td><?php echo $nomina['tipo_nomina'];?></td>
    <td><a href="includes/copiar_historial.php?cod=<?php echo $nomina['cod'];?>&tipo=<?php echo $nomina['tipo_nomina'];?>">Pasar a Historial</a> <a href="includes/eliminar_nomina.php?cod=<?php echo $nomina['cod'];?>&tipo=<?php echo $nomina['tipo_nomina'];?>">Eliminar</a></td>  </tr>
  <?php }?>
   <tr>
    <td colspan="4" align="right" background="crear_nomina.php"><a href="crear_nomina.php">Volver</a></td>
  </tr>
</table>
</body>
</html>
