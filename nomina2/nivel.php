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
	$objGrid -> form('nivel', true);
	$objGrid -> searchby("nombre");
	
	/* Connect with the database */
	$objGrid -> conectadb("127.0.0.1", "capepo", "capepo", "personal");
	
	/* Select the table to use */
	$objGrid -> tabla ("nivel");
	$objGrid -> TituloGrid("Listado de Niveles");
	$objGrid -> buttons(true,true,true,true);
	$objGrid -> keyfield("id");
	$objGrid -> datarows(22);//cantidad de registros por pagina
	$objGrid -> linkparam("sess=".$_REQUEST["sess"]."&username=".$_REQUEST["username"]);//para q funcione la edicion en linea
	$objGrid -> language("es");
	
	/* Define the initial ordering field and its direction */
	$objGrid -> orderby("codigo", "DESC");
	$objGrid -> noorderarrows();

	/* Define fields to show */
	$objGrid -> FormatColumn("id", "ID Direccion", 5, 5, 2, "50", "center","integer");
	$objGrid -> FormatColumn("nombre", "Nombre", 40, 30, 0, "150", "center");
	$objGrid -> FormatColumn("codigo", "C�digo", 40, 30, 0, "50", "center");


	/* The setHeader function MUST be set between the <HEAD> and </HEAD> 
	   to correctly set the CSS and JS parameters */
	$objGrid -> setHeader();
?>
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
?>
      &nbsp;</td>
  </tr>
</table>
</body>
</html>