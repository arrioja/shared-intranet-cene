<?php
$ref_producto=$_GET['ref'];
require "includes/miclase.php";
$link=conectarse3();
$ref_producto=$_GET['ref'];
$res=mysql_query("select * from productos where referencia='$ref_producto'");
$producto=mysql_fetch_array($res);
function generaSelect()//genera el 1er select
{  
	$link=conectarse3();
	$consulta=mysql_query("SELECT distinct partida FROM descripcion_presupuesto order by partida asc",$link);
	desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='select1' id='select1' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[0]."</option>";
	}
	echo "</select>";
}

if (isset($_POST['cancelar']))
	{
		echo '<script languaje="Javascript">location.href="productos.php"</script>';
	}

if (isset($_POST['guardar']))
	{
	$objeto = new miclase();
			if ($objeto->insertar_producto_partida($producto['referencia'],$_POST['select1'],$_POST['select2'],$_POST['select3'],$_POST['select4'],$link))
				{
				abrir_popup("mensaje.php?texto=Inserto Correctamente el Producto '$ref_producto'&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				echo '<script languaje="Javascript">location.href="productos.php"</script>';
				}
			else
				{
				$mens=mysql_error($link);
				abrir_popup("mensaje.php?texto=Error '$mens'&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				}
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="select_multiniveles.js"></script>
<title>Producto Partida</title>
<style type="text/css">
<!--
.style5 {font-size: large; font-weight: bold; font-style: italic; }
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action=""><table width="931" border="1" align="center">
<tr>
              <td width="71"><strong>Nombre:</strong></td>
                <td width="173"><span class="style5"><?php echo $producto['nombre'];?></span></td>
                <td width="116"><strong>Referencia:</strong></td>
                <td width="90"><span class="style5"><?php echo $producto['referencia'];?></span></td>
                <td width="66"><strong>Marca:</strong></td>
                <td width="151"><span class="style5"><?php echo $producto['marca'];?></span></td>
                <td width="95"><strong>Unidad</strong></td>
                <td width="117"><span class="style5"><?php echo $producto['unidad'];?></span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><strong>Partida:
                    
                    <?php generaSelect(); ?>
                </strong></td>
                <td colspan="2"><strong>Generica:
                    <select disabled="disabled" name="select2" id="select2">
                        <option value="0">Seleccione..</option>
                        </select>
                </strong></td>
                <td colspan="2"><strong>Espec&iacute;fica: 
                    <select disabled="disabled" name="select3" id="select3">
                        <option value="0">Seleccione..</option>
                        </select>
                </strong></td>
                <td colspan="2"><strong>SubEspec&iacute;fica
                    <select disabled="disabled" name="select4" id="select4">
                        <option value="0">Seleccione..</option>
                        </select>
                </strong></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4"><div align="center">
                  <input type="submit" name="guardar" id="guardar" value="Guardar" />
                </div></td>
                <td colspan="4"><div align="center">
                  <input type="submit" name="cancelar" id="cancelar" value="Cancelar" />
                </div></td>
              </tr>
            </table>
  <p>&nbsp;</p>
</form>
</body>
</html>
