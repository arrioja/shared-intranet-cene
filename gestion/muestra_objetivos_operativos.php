<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
include "../db/conexion.php";
$link=conectarse("gestion");
$result=mysql_query("select * from gestion.gestion_obj_operativos WHERE cod_plan_o_dir=$_GET[seleccionado] order by codigo asc",$link);
?>


<table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
<tr class="encabezado_formularios">
    <td width="117">C&oacute;digo</td>
      <td width="481">Nombre</td>
      <td width="56">Vincular</td>
      <td width="52">Editar</td>
      <td width="56">Eliminar</td>
    </tr>
    <?php while ($row=mysql_fetch_array($result)){?>
    <tr class="datos_formularios">
      <td><div align="center"><?php echo $row[1]; ?></div></td>
      <td><div align="justify"><?php echo $row[2]; ?></div></td>
      <td><div align="center"><a href="editar_vinculo_objetivos_operativos_direccion.php?cod_org=<?php echo $_GET['cod_org'];?>&codigo_objetivo=<?php echo $row[1];?>&direccion=<?php echo $_GET['cod_direccion']; ?> &plan=<?php echo $_GET['seleccionado'];?>"><img src="../imgs/vinculo.png" width="16" height="16" border="0" title="Vincular Objetivo" /></a></div></td>
      <td><div align="center"><a href="modifica_objetivo_operativo.php?seleccionado=<?php echo $row[1];?>"><img src="../imgs/b_edit.png" alt="editar" width="16" height="16" border="0" /></a><a href="modifica_objetivo_operativo.php?seleccionado=<?php echo $row[1];?>"></a></div></td>
      <td><div align="center"><img style="CURSOR: pointer" src="../imgs/b_drop.png" width="16" height="16" border="0" title="Eliminar Objetivo" onclick="confirma_eliminar('<?php echo $row[1];?>','<?php echo $row[2];?>')"/></div></td>
    </tr>
    <?php }?>
  </table>
<p>
    <label> 
    <div align="center">
      <div align="center">
        <p>
          <input type="submit" name="insertar" id="insertar" value="Insertar Nuevo Objetivo" />
          <a href="fpdf/reporte_objetivo_operativo.php?seleccionado=<?php echo $_GET['seleccionado']?>" target="_blank"><img src="../imgs/printer.png" border="0" title="Imprimir" /></a></p>
        <p>&nbsp;</p>
  </div>
</body>
</html>
