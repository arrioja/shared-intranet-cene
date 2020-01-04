<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Gestión/Dirección/Listado de Objetivos Estrategicos</title>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 
   require("../db/conexion.php");
   $link=conectarse("gestion");
   $result=mysql_query("select * from gestion_obj_estrategicos_direcciones WHERE cod_plan_e_dir=$_GET[seleccionado] order by codigo asc",$link);
?>
  <div align="center"></div>
  <table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td width="108">C&oacute;digo</td>
      <td width="499">Nombre</td>
      <td width="60">Vincular</td>
      <td width="41">Editar</td>
      <td width="56">Eliminar</td>
    </tr>
    <?php while ($row=mysql_fetch_array($result)){?>
    <tr class="datos_formularios">
      <td><div align="center"><?php echo $row[1] ?></div></td>
      <td><div align="justify"><?php echo $row[2] ?></div></td>
 <td><div align="center"><a href="editar_vinculo_objetivos_estrategicos_direccion.php?seleccionado=<?php echo $_GET['cod_org']?>&codigo_objetivo=<?php echo $row[1]?>&direccion=<?php echo $_GET['cod_direccion'] ?> &plan=<?php echo $_GET['seleccionado']?>"><img src="../imgs/vinculo.png" width="16" height="16" border="0" title="Vincular Objetivo" /></a></div></td>
      <td><div align="center"><a href="modifica_objetivos_estrategicos_direccion.php?seleccionado=<?php echo $row[1]?>"><img src="../imgs/edit.png" width="16" height="16" border="0" title="Editar Objetivo" /></a></div></td>
      <td><div align="center"><img style="CURSOR: pointer" src="../imgs/delete.png" width="16" height="16" title="Eliminar Objetivo" onclick="confirma_eliminar('<?php echo $row[1];?>','<?php echo $row[2]?>')"/></div></td>
    </tr>
    <?php }?>
    <tr class="datos_formularios">
      <td colspan="5"><div align="center">
        <input type="submit" name="insertar" id="insertar" value="Insertar Nuevo Objetivo" />
      </div></td>
    </tr>

  </table>
</body>
</html>
