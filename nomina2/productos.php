<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Intranet CENE</title>
<?php

	/* Include class file */
	include ("includes/phpmydatagrid/phpmydatagrid.class.php");
	
	/* Create object */
	$objGrid = new datagrid;
	
	//$objGrid -> closeTags(true); 

	/* Define the "FORM" will be named employee and Must be 
	   created by the grid script */
	$objGrid -> form('productos', true);
	$objGrid -> searchby("nombre,referencia,marca");
	
	/* Connect with the database */
	$objGrid -> conectadb("127.0.0.1", "capepo", "capepo", "administracion");
	
	/* Select the table to use */
	$objGrid -> tabla ("productos");
	$objGrid -> TituloGrid("Listado de Productos");
	$objGrid -> buttons(true,true,true,true);
	$objGrid -> keyfield("id");
	$objGrid -> datarows(22);//cantidad de registros por pagina
	$objGrid -> linkparam("sess=".$_REQUEST["sess"]."&username=".$_REQUEST["username"]);//para q funcione la edicion en linea
	$objGrid -> language("es");
	$objGrid -> noorderarrows();

	/* Define fields to show */
	$objGrid -> FormatColumn("id", "ID Producto", 5, 5, 2, "50", "center","integer");
		/* Text Links: Displaying a text link is only available to show values stored in fields */
	/* Note: inputtype must be set to 4 */
	//$objGrid -> FormatColumn("id","Asignar Partida", "30", "30","4","100","center","link:producto_partida(%s),id");
	$objGrid -> FormatColumn("referencia", "Referencia", 30, 30, 4, "150", "center","link:asignar_producto_partida(%s),referencia");
	$objGrid -> FormatColumn("nombre", "Nombre", 40, 30, 0, "150", "left");
	$objGrid -> FormatColumn("marca", "Marca", 30, 30, 0, "50", "center");
	$objGrid -> FormatColumn("unidad", "unidad", 10, 10, 0, "60", "center");
	$objGrid -> FormatColumn("max", "Existencia Maxima", 5, 5, 0, "60", "center","number");
	$objGrid -> FormatColumn("min", "Existencia Minima", 5, 5, 0, "60", "center","number");
	$objGrid -> FormatColumn("alerta", "Alerta", 5, 5, 0, "60", "center","number");


	/* The setHeader function MUST be set between the <HEAD> and </HEAD> 
	   to correctly set the CSS and JS parameters */
	$objGrid -> setHeader();
?>
<!-- /* Sample Script to execute when user click over the photo link */ -->
<script type="text/javascript">
	function asignar_producto_partida(ref_producto){
		location.href="producto_partida.php?ref="+ref_producto;//alert ("SAMPLE SCRIPT\n\nHere must go a process to update the picture or something else for:\n\nRecord ID:"+code);
	}
</script>
</head>

<body>
<table width="890" border="1">
  <tr>
    <td><?php
	/* AJAX inline edition comes in two flawors */
	/*	silent: To save record, just enter or double click */
	/*	default: To save record, must click icon */
	/* try yourself and see which one likes more (My preferred is silent) */
	$objGrid -> ajax("silent"); 
	/* draw the grid */
	$objGrid -> grid();
	
	/* Disconnect from database */
	$objGrid -> desconectar();
?>&nbsp;</td>
  </tr>
</table>

</body>
</html>