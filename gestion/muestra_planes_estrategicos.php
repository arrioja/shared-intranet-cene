<?php 
/*
* Este archivo muestra el listado de planes estratégicos almacenados en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/?>

<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<?php 
 include ("../db/conexion.php");
 $link=conectarse("gestion");
 $result=mysql_query("select * from gestion.gestion_planes_estrategicos WHERE codigo_organizacion=$_GET[seleccionado]",$link);
?>
    <table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td width="90"><div align="center"><strong>C&oacute;digo</strong></div></td>
      <td width="443"><div align="center"><strong>Nombre</strong></div></td>
      <td width="78"><div align="center"><strong>Editar</strong></div></td>
      <td width="62"><div align="center"><strong>Eliminar</strong></div></td>
    </tr> 
    <?php while ($row=mysql_fetch_array($result)){?>
    <tr class="datos_formularios">
      <td><div align="center"><?php echo $row['codigo'] ?></div></td>
      <td><div align="justify"><?php echo $row['nombre'] ?></div></td>
      <td><div align="center"><a href="modifica_plan_estrategico.php?seleccionado=<?php echo $row[1]?>"><img src="../imgs/edit.png" width="16" height="16" border="0" title="Editar Plan" /></a><a href="../select/select_planes_estretegicos2.php?seleccionado=<?php echo $_GET['cod_org']?>&codigo=<?php echo $row[1]?>&direccion=<?php echo $_GET['seleccionado'] ?>&operacion=1"></a></div></td>
     <td><div align="center"><img style="CURSOR: pointer" src="../imgs/delete.png" width="16" height="16"  title="Eliminar Plan" onClick="confirma_eliminar('<?php echo $row[1];?>','<?php echo $row[2]?>')" /></div></td>
    </tr>
    <?php }?>
        <tr class="datos_formularios">
      <td colspan="4"><div align="center">
        <input type="submit" name="insertar" id="insertar" value="Insertar Plan" /><?php if (mysql_num_rows($result)>0){?>
        <a href="fpdf/reporte_plan_organizacion.php?seleccionado=<?php echo $_GET['seleccionado']?>" target="_blank"><img src="../imgs/printer.png" border="0" title="Imprimir" /></a><?php }?></div></td>
      </tr>
  </table>