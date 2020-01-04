<?php 
/*
* Este archivo muestra el listado de planes estratégicos almacenados en la base de datos
*@ Versión 1.0 @Modificado: 28 de Marzo del 2008
*@Autores: Paúl González y Rosanny Yáñez
*
*/?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../progressBar/lib/style.css" rel="stylesheet" type="text/css" media="screen" />
<script language="javascript" type="text/javascript" src="../progressBar/lib/prototype.js"></script>
<script language="javascript" type="text/javascript" src="../progressBar/lib/progress.js"></script>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<title>Indicadores Planes Operativos</title></head>

<body>
<p>
<?php 

   include "../db/conexion.php";
	$link=conectarse("gestion");
 $result=mysql_query("select * from gestion.gestion_planes_operativos WHERE cod_direccion=$_GET[seleccionado] order by codigo asc",$link);

?>

</p>
<form id="form1" name="form1" method="post" action="">
  
    
    <table width="600" border="1" align="center" cellpadding="2">
    <tr>
      <td width="146" height="28"><div align="center"><strong>C&oacute;digo</strong></div></td>
      <td width="359"><div align="center"><strong>Nombre</strong></div></td>
      <td width="78"><strong> <div align="center"><strong>Indicadores</strong></div></td>
    </tr> 
    <?php while ($row=mysql_fetch_array($result)){?>
    <tr>
      <td height="46"><div align="center"><?php echo $row["codigo"] ?></div>      </td>
      <td><div align="center"><?php echo $row['nombre'] ?></div>      </td>
      <td><div align="center"><a href="barra_planes_operativos.php?seleccionado=<?php echo $row["codigo"] ?>"><img src="../imgs/log.png" width="78" height="40" border="0"  title="Ver Gr&aacute;ficas"/></a><a href="barra_planes_operativos.php?seleccionado=<?php echo $row["codigo"] ?>"></a></div></td>
      </tr>
    <?php }?>
  </table>
 
</form>
</body>

</html>
