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
  $result=mysql_query("select * from gestion.gestion_fases WHERE cod_actividad=$_GET[seleccionado] order by id",$link);
  $result2=mysql_query("select a.id,b.precedida from gestion.gestion_fases as a inner join gestion.gestion_relacion_actividades_fases as b on a.id=b.fase WHERE a.cod_actividad=$_GET[seleccionado] order by a.id",$link);
 if ($result) {
?>


<table width="794" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td width="55"><strong>C&oacute;digo</strong></td>
      <td width="407"><strong>Nombre</strong></td>
      <td width="101"><strong>Precedencia</strong></td>
      <td width="110"><strong>Editar</strong><strong> Estado</strong></td>
      <td width="77"><strong>Eliminar</strong></td>
  </tr>
    <?php while ($row=mysql_fetch_array($result)){
	 $result2=mysql_query("select a.id,b.precedida from gestion.gestion_fases as a inner join gestion.gestion_relacion_actividades_fases as b on a.id=b.fase WHERE a.cod_actividad=$_GET[seleccionado] order by a.id",$link);
 ?>
    <tr class="datos_formularios">
      <td><div align="center"><?php echo $row[0] ?></div></td>
      <td><div align="justify"><?php echo $row[1] ?></div></td>
      
      <td><div align="center">
        <?php $i=0; while (($row2=mysql_fetch_array($result2))){
		  	  if ($row[0]==$row2[0])
	  	      	{if ($i>0)
					echo '-';
				echo $row2[1];				
				$i=$i+1;	
				}
			   }
			  ?>
      </div></td>
      <td><div align="center"><a href="editar_fase.php?cod=<?php echo $row[0];?>"><?php if ($row[5]=='0') echo "<img src='../imgs/por_iniciar.png' alt='Por iniciar' border='0' title='Por Iniciar'/>"; else if ($row[5]=='1') echo "<img src='../imgs/en_proceso.png' alt='En Proceso' border='0' title='En Proceso'/>"; else if ($row[5]=='2') echo "<img src='../imgs/finalizada.png' alt='Finalizada' border='0' title='Finalizada'/>";?></a></div></td>
      <td><div align="center"><img style="cursor:pointer" src="../imgs/b_drop.png" alt="Eliminar" width="16"  height="16" border="0" title="Eliminar Fase" onclick="confirma_eliminar('<?php echo $row[0];?>','<?php echo $row[1]?>')"/></div></td>
    </tr>
    <?php }
	}?>
  </table>

<label> 
  
      <div align="center"><a href="../fpdf/reporte_fase.php?seleccionado=<?php echo $_GET['seleccionado'] ?>" target="_blank"><img src="../imgs/printer.png"  border="0" title="Imprimir"/></a></div>
  <div align="center"></div>
</body>
</html>
