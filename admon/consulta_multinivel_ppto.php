<?php
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M. Arrioja.
  Descripción General:  éste archivo contiene una consulta multinivel genérica que revuelve los valores de Año, partida, generica, especifica 
  					    y subespecifica, dependiendo del nivel en el que se encuentre el usuario y dependiendo de lo que desee consultar.
  		Modificado el: 	13/11/2008 - Pedro E. Arrioja M. Creación.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
	require("../db/conexion.php");
	$link=conectarse("administracion"); 
	
	$ano = $_POST['a'];
	$partida = $_POST['p'];
	$generica = $_POST['g']; 
	$especifica = $_POST['e'];
	$subespecifica = $_POST['s'];
	
	// si viene con parámetros, se busca lo que se pide.
	if ((isset($_POST['a'])) && ($ano!='') && ($ano!='-1'))
	  { 
	   $sql="select distinct partida from descripcion_presupuesto where (ano = '$ano') order by partida"; 
	   if ((isset($_POST['p'])) && ($partida!='') && ($partida!='-1'))
		 {
		   $sql="select distinct generica from descripcion_presupuesto where ((ano = '$ano') and (partida = '$partida')) order by generica";
		   if ((isset($_POST['g'])) && ($generica!='') && ($generica!='-1'))
			 {
			   $sql="select distinct especifica from descripcion_presupuesto where ((ano = '$ano') and (partida = '$partida') and 
			        (generica = '$generica')) order by especifica";
			   if ((isset($_POST['e'])) && ($especifica!='') && ($especifica!='-1'))  
				 {
				   $sql="select distinct subespecifica from descripcion_presupuesto where ((ano = '$ano') and (partida = '$partida') and 
				         (generica = '$generica') and (especifica = '$especifica')) order by subespecifica";
	   	   
				 } // del if de la especifica  	   
			 }// del if de la genérica
		 }// del if de la partida
	  }// del if del año
	else
	  { // si viene sin parámetros, se asume valor inicial y busqueda por el primer campo (año)
	  	$sqlinicial="select distinct ano from descripcion_presupuesto order by ano";
	    $consulta_inicial=mysql_query($sqlinicial,$link); 
        while($resultadoinicial = mysql_fetch_array($consulta_inicial))
		 {
		  echo $resultadoinicial['ano'].";";
		 }
	  }  
  
  $consulta=mysql_query($sql,$link); 

  while($resultado = mysql_fetch_array($consulta))
 {
     echo $resultado[0].";";
  //echo $resultado['ano']."-".$resultado['partida']."-".$resultado['generica']."-".$resultado['especifica']."-".$resultado['subespecifica'].";";
 }
?>