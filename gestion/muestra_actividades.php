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
	include "../libs/utilidades.php";
   $link=conectarse("gestion");
  $result=mysql_query("select * from gestion.gestion_actividades WHERE cod_plan_operativo=$_GET[seleccionado] order by id asc",$link);
?>


<table width="797" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td width="70">C&oacute;digo</td>
      <td width="149">Nombre</td>
      <td width="106">Fecha de Inicio</td>
      <td width="110">Duraci&oacute;n (D&iacute;as)</td>
      <td width="58">Vincular</td>
      <td width="62">Editar</td>
      <td width="56">Eliminar</td>
      <td width="118">Ver/A&ntilde;adir Fases</td>
  </tr>
    <?php while ($row=mysql_fetch_array($result)){?>
    <tr class="datos_formularios">
      <td><div align="center"><?php echo $row[0] ?></div></td>
      <td><div align="center"><?php echo $row[1]?></div></td>
      <td><div align="center"><?php echo cambiaf_a_normal($row[2])?></div></td>
      <td><div align="center"><?php echo $row[3]?></div></td>
      <td><div align="center"><a href="editar_vinculo_actividades.php?seleccionado=<?php echo $_GET['cod_org']?>&codigo_actividad=<?php echo $row[0]?>&direccion=<?php echo $_GET['cod_direccion'] ?> &plan=<?php echo $_GET['seleccionado']?>"><img src="../imgs/vinculo.png" width="16" height="16" border="0" title="Vincular Actividad" /></a><a href="../select/select_objetivos_operativos_impacto.php?seleccionado=<?php echo $_GET['cod_direccion']?>&codigo=<?php echo $row[1]?>&direccion=<?php echo $_GET['seleccionado'] ?>&plan=<?php echo $_GET['seleccionado']?>&operacion=1"></a></div></td>
      <td><div align="center"><a href="modifica_actividades.php?seleccionado=<?php echo $row[0]?>"><img src="../imgs/b_edit.png" width="16" height="16" border="0"  title="Editar Actividad"/></a></div></td>
      <td><div align="center"><img style="cursor:pointer" src="../imgs/b_drop.png" width="16" height="16" border="0" title="Eliminar Actividad"  onclick="confirma_eliminar('<?php echo $row[0];?>','<?php echo $row[1]?>')"/></div></td>
      <td><div align="center"><a href="incluir_fases.php?codigo_actividad=<?php echo $row[0]?>"><img src="../imgs/view_icon.png" width="24" height="26" border="0" /></a></div></td>
    </tr>
    <?php }?>
  </table>

<p align="center">
  <input type="submit" name="insertar" id="insertar" value="Insertar Nueva Actividad" />
  <a href="../fpdf/reporte_actividad.php?seleccionado=<?php echo $_GET['seleccionado'] ?>" target="_blank"><img src="../imgs/printer.png"  border="0" title="Imprimir"/></a></p>

</body>
</html>
