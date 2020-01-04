<?php
function generaSelect()
{
	include 'conexion.php';
	conectar();
	$consulta=mysql_query("SELECT distinct ano FROM descripcion_presupuesto order by ano asc");
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
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!-- 

Este contenido es de libre uso y modificación bajo la siguiente licencia: http://creativecommons.org/licenses/by-nc-sa/2.5/deed.es

Sobre el reconocimiento:
Todos los códigos han sido realizados con la idea de que sirvan para colaborar con el aprendizage de aquellos que se están introduciendo
en estas tecnologías y no con el objetivo de que sean utilizados directamente en sitios web. No obstante si utilizas algún código en tu sitio 
(ya sea sin modificar o modificado), o si ofreces los fuentes para descargar o si bien decides publicar alguno de los artículos debes cumplir con:
-Colocar un link a http://www.formatoweb.com.ar/ajax/ visible por tus usuarios como forma de mención a la fuente original del contenido.
-Enviar un correo a edanps@gmail.com informando la URL donde el contenido se ha publicado o se va a publicar en un futuro.
-Si publicas los fuentes para descargar este texto no debe ser eliminado ni alterado.

Más ejemplos y material sobre AJAX en: http://www.formatoweb.com.ar/ajax/
Cualquier sugerencia, crítica o comentario son bienvenidos.
Contacto: edanps@gmail.com
-->

<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>AJAX, Combos dependientes </title>
<link rel="stylesheet" type="text/css" href="select_dependientes_3_niveles.css">
<script type="text/javascript" src="select_dependientes_3_niveles.js"></script>
</head>

<body>
<table width="700" border="1">
              <tr>
                <td><?php generaSelect(); ?>&nbsp;</td>
                <td><select disabled="disabled" name="select2" id="select2">
                  <option value="0">Seleccione..</option>
                </select></td>
                <td><select disabled="disabled" name="select3" id="select3">
                  <option value="0">Seleccione..</option>
                </select></td>
                <td><select disabled="disabled" name="select4" id="select4">
                  <option value="0">Seleccione..</option>
                </select></td>
                <td><select disabled="disabled" name="select5" id="select5">
                  <option value="0">Seleccione..</option>
                </select></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
</body>
</html>