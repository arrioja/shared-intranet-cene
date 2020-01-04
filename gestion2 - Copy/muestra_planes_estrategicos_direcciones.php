<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Intranet CENE</title>
<script language="JavaScript">

</script>



<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
</head>

<body>

      <?php 
   require("../db/conexion.php");
   $link=conectarse("gestion");

  $result=mysql_query("select * from gestion_planes_estrategicos_direcciones where cod_direccion=$_GET[seleccionado]",$link);
?>
      <br />      <form id="form1" name="form1" method="post" action="">
        <table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="108" height="19" class="encabezado_formularios">C&oacute;digo</td>
        <td width="509" class="encabezado_formularios">Nombre</td>
        <td width="56" class="encabezado_formularios">Vincular</td>
        <td width="44" class="encabezado_formularios">Editar</td>
      <td width="59" class="encabezado_formularios">Eliminar</td>    
      </tr>
          <?php while ($row=mysql_fetch_array($result)){?>
          <tr>
            <td height="25" class="datos_formularios"><div align="center"><?php echo $row[1] ?></div></td>
        <td class="datos_formularios"><div align="justify"><?php echo $row[2] ?></div></td>
        <td class="datos_formularios"><div align="center"><a href="editar_vinculo_planes_estrategicos_direccion.php?seleccionado=<?php echo $_GET['cod_org']?>&codigo_plan=<?php echo $row[1]?>&direccion=<?php echo $_GET['seleccionado'] ?>"><img src="../imgs/vinculo.png" width="16" height="16" border="0" title="Vincular Plan" /></a></div></td>
        <td class="datos_formularios"><div align="center"><a href="modifica_plan_estrategico_direccion.php?seleccionado=<?php echo $row[1]?>"><img src="../imgs/edit.png" width="16" height="16" border="0" title="Editar Plan" /></a></div></td>
        <td class="datos_formularios"><div align="center"><img src="../imgs/delete.png" width="16" height="16" title="Eliminar Plan" onclick="confirma_eliminar('<?php echo $row[1];?>','<?php echo $row[2]?>')" /></div></td>
      </tr>
          <?php }?>
        </table>
        <div align="center">
          <p>
            <input type="submit" name="insertar" id="insertar" value="Insertar Nuevo Plan" />
            <a href="../fpdf/reporte_plan_direccion.php?seleccionado=<?php echo $_GET['seleccionado'] ?>"><img src="../imag/printer.png"  border="0" title="Imprimir"/></a>
            <input type="hidden" name="buscar" id="buscar" />
          </p>
    </div>
        </form>
</body>
</html>
