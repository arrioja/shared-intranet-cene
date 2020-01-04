<?php 
/*
* Este archivo muestra los objetivos estratégicos almacenados en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
   require("../db/conexion.php");
   $link=conectarse("gestion");
  $result=mysql_query("select * from gestion_obj_estrategicos where codigo_plan_estrategico=$_GET[seleccionado] order by codigo asc",$link);
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
</head>
<p>
  
</p>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="83" class="encabezado_formularios"><div align="center"><strong>C&oacute;digo</strong></div></td>
      <td width="573" class="encabezado_formularios"><div align="center"><strong>Nombre</strong></div></td>
      <td width="56" class="encabezado_formularios"><div align="center"><strong>Editar</strong></div></td>
      <td width="56" class="encabezado_formularios"><div align="center"><strong>Eliminar</strong></div></td>
    </tr>
    <?php while ($row=mysql_fetch_array($result)){?>
    <tr>
      <td class="datos_formularios"><div align="center"><?php echo $row[1] ?></div></td>
      <td class="datos_formularios"><div align="justify"><?php echo $row[2] ?></div></td>
      <td class="datos_formularios"><div align="center"><a href="modifica_objetivos_estrategicos.php?seleccionado=<?php echo $row[1]?>"><img src="../imgs/edit.png" width="16" height="16" border="0" title="Editar Objetivo" /></a><a href="../select/select_planes_estrategicos.php?seleccionado=<?php echo $_GET['cod_org']?>&codigo=<?php echo $row[1]?>&direccion=<?php echo $_GET['seleccionado'] ?>&operacion=1"></a></div></td>
      <td class="datos_formularios"><div align="center"><img src="../imgs/delete.png" width="16" height="16" title="Eliminar Objetivo" onclick="confirma_eliminar('<?php echo $row[1];?>','<?php echo $row[2]?>')"/></div></td>
    </tr>
    <?php }?>
  </table>
  <div align="center">
    <input type="submit" name="insertar" id="insertar" value="Insertar Objetivo" />
  </div>
  </form>
</body>
</html>
