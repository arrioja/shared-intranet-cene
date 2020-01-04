<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php    require("../db/conexion.php");
   $link=conectarse("gestion");
  $result=mysql_query("select * from gestion.gestion_planes_operativos WHERE cod_direccion=$_GET[cod_dir] order by codigo asc",$link);
?>
<table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
<tr class="encabezado_formularios">
    <td width="176"><div align="center"><strong>C&oacute;digo</strong></div></td>
      <td width="423"><div align="center"><strong>Nombre</strong></div></td>
      <td width="56"><strong>Vincular</strong></td>
      <td width="47"><strong>Editar</strong></td>
      <td width="56"><strong>Eliminar</strong></td>
    </tr>
    <?php while ($row=mysql_fetch_array($result)){?>
    <tr class="datos_formularios">
      <td><div align="center"><?php echo $row[1] ?></div></td>
      <td><div align="justify" ><?php echo $row[2] ?></div></td>
      <td><div align="center"><a href="editar_vinculo_plan_operativo.php?seleccionado=<?php echo $_GET['cod_org']?>&codigo_plan=<?php echo $row[1]?>&direccion=<?php echo $_GET['cod_dir'] ?>"><img src="../imgs/vinculo.png" width="16" height="16" border="0" title="Vincular Plan" /></a><a href="editar_vinculo_plan_operativo.php?seleccionado=<?php echo $_GET['cod_org']?>&codigo_plan=<?php echo $row[1]?>&direccion=<?php echo $_GET['cod_dir'] ?>"></a><a href="editar_vinculo_plan_operativo.php?seleccionado=<?php echo $_GET['cod_org']?>&codigo_plan=<?php echo $row[1]?>&direccion=<?php echo $_GET['cod_dir'] ?>"></a></div></td>
      <td><div align="center"><a href="modifica_plan_operativo.php?seleccionado=<?php echo $row[1]?>"><img src="../imgs/edit.png" width="16" height="16" border="0" title="Editar Plan" /></a></div></td>
      <td><div align="center"><img style="cursor:pointer" src="../imgs/delete.png" width="16" height="16" title="Eliminar Plan" onclick="confirma_eliminar('<?php echo $row[1];?>','<?php echo $row[2]?>')" /></div></td>
    </tr>
    <?php }?>
  </table>
<p>
    <label>
    <div align="center">
  <div align="center">
        <p>
          <input type="submit" name="insertar" id="insertar" value="Insertar Nuevo Plan" />
          <a href="fpdf/reporte_plan_operativo.php?seleccionado=<?php echo $_GET['cod_dir'];?>" target="_blank"><img src="../imgs/printer.png" border="0" title="Imprimir" /></a></p>
        <p>&nbsp;</p>
  </div>
  <p>&nbsp;</p>
</body>
</html>