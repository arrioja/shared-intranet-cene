<?php
$rif=$_GET['rif'];
//require "includes/miclase.php";
$link=conectarse3();
//$res=mysql_query("select * from empresas where rif='$rif'");
//$empresa=mysql_fetch_array($res);

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
		echo '<script languaje="Javascript">location.href="empresas.php"</script>';
	}

if (isset($_POST['guardar']))
	{ 	if (($_POST['select1']!='')&&($_POST['select2']!='')&&($_POST['select3']!='')&&($_POST['select4']!='')&&(is_numeric($_POST['select4'])))
		{
		$objeto = new miclase();
			if ($objeto->insertar_empresa_partida($empresa['rif'],$_POST['select1'],$_POST['select2'],$_POST['select3'],$_POST['select4'],$link))
				{
				abrir_popup("mensaje.php?texto=Inserto Correctamente la Empresa '$rif'&imagen=success.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				echo '<script languaje="Javascript">location.href="empresas.php"</script>';
				}
			else
				{
				$mens=mysql_error($link);
				abrir_popup("mensaje.php?texto=Error '$mens'&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
				}
		}
		else	
		abrir_popup("mensaje.php?texto=Error, Seleccione todos los datos del codigo presupuestario&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");	
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="select_multiniveles.js"></script>
<title>Empresa Partida</title>
<style type="text/css">
<!--
.style5 {font-size: large; font-weight: bold; font-style: italic; }
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action=""><table width="931" border="1" align="center">
<tr>
              <td width="69"><strong>Nombre:</strong></td>
                <td colspan="2"><span class="style5"><?php echo $empresa['nombre'];?></span></td>
                <td width="84"><strong>RIF:</strong></td>
                <td width="122"><span class="style5"><?php echo $empresa['rif'];?></span></td>
                <td width="77"><strong>Marca:</strong></td>
                <td width="118"><span class="style5"><?php echo $empresa['representante'];?></span></td>
                <td width="102">&nbsp;</td>
                <td width="124">&nbsp;</td>
    </tr>
              <tr>
                <td height="26">&nbsp;</td>
                <td width="62"><strong>Partida:
                    
                    
                </strong></td>
                <td width="115"><strong>
                  <?php generaSelect(); ?>
                </strong></td>
                <td><strong>Gen&eacute;rica:
                    
                </strong></td>
                <td>                  <select disabled="disabled" name="select2" id="select2">
                    <option value="0">Seleccione..</option>
                </select>&nbsp;</td>
                <td><strong>Espec&iacute;fica: 
                    
                </strong></td>
                <td><strong>
                  <select disabled="disabled" name="select3" id="select3">
                    <option value="0">Seleccione..</option>
                  </select>
                </strong></td>
                <td><strong>SubEspec&iacute;fica:
                    
                </strong></td>
                <td><strong>
                  <select disabled="disabled" name="select4" id="select4">
                    <option value="0">Seleccione..</option>
                  </select>
                </strong></td>
    </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5"><div align="center">
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
