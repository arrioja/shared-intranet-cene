<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Paúl González y Rosanny Yáñez
  Descripción General:  Este archivo muestra el listado de direcciones 
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. Se modificaron las rutas de acceso para trabajar con la intranet y los nombres
														   de las bases de datos, así como los Css.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 require("../db/conexion.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Listado de Direcciones</title>
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 
  $link=conectarse("organizacion");
  $result=mysql_query("select * from organizacion.direcciones WHERE codigo_organizacion=$_GET[seleccionado]",$link);
?>

<form id="form1" name="form1" method="post" action="direccion.php">
  <table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="100" class="encabezado_formularios">C&oacute;digo</td>
      <td width="370" class="encabezado_formularios">Nombre</td>
      <td width="41" class="encabezado_formularios">Editar</td>
      <td width="57" class="encabezado_formularios">Eliminar</td>
    </tr>
    <?php while ($row=mysql_fetch_array($result)){?>
    <tr>
      <td><div align="center"><?php echo $row[1] ?></div></td>
      <td><div align="justify"><?php echo $row[2] ?></div></td>
      <td><div align="center"><a href="modifica_direccion.php?seleccionado=<?php echo $row[1]?>"><img src="../imgs/edit.png" width="16" height="16" border="0"  title="Editar Direcci&oacute;n"/></a></div></td>
      <td><div align="center">
        <div align="center"><img src="../imgs/delete.png" width="16" height="16" border="0" title="Eliminar Direcci&oacute;n" onclick="confirma_eliminar('<?php echo $row[1];?>','<?php echo $row[2]?>')" /></div>
      </div></td>
    </tr>
    <?php }?>
  </table>
  <div align="center">
    <p><a href="../fpdf/reporte_direccion.php?seleccionado=<?php echo $_GET['seleccionado']?>" target="_blank"><img src="../imag/printer.png" border="0" title="Imprimir" /></a></p>
  </div>
</form>
</body>
</html>
