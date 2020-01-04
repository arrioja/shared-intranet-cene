<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"select1"=>"descripcion_presupuesto",
"select2"=>"descripcion_presupuesto",
"select3"=>"descripcion_presupuesto",
"select4"=>"descripcion_presupuesto",
//"select5"=>"descripcion_presupuesto"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
	include 'conexion.php';
	conectar();
	
	//consulta por defecto
	$consulta=mysql_query("SELECT distinct generica FROM $tabla WHERE partida='$opcionSeleccionada' order by generica asc") or die(mysql_error());
		
	if ($selectDestino=='select3')
		$consulta=mysql_query("SELECT distinct especifica FROM $tabla WHERE generica='$opcionSeleccionada' order by especifica desc") or die(mysql_error());
		
	if ($selectDestino=='select4')
		$consulta=mysql_query("SELECT distinct subespecifica FROM $tabla WHERE especifica='$opcionSeleccionada' order by subespecifica desc") or die(mysql_error());

	desconectar();
	
	// Comienzo a imprimir el select
	echo "<select name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registro[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".$registro[0]."</option>";
	}			
	echo "</select>";
}
?>