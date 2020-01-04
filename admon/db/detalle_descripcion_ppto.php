<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Esta función devuelve la descripción del presupuesto.
  		Modificado el: 	24/10/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
   include ("../../db/conexion.php");
   $link=conectarse("administracion"); 
   $valor=$_POST['valor']; 
   $partida=$valor[0].$valor[1].$valor[2];
   $generica=$valor[4].$valor[5];
   $especifica=$valor[7].$valor[8];
   $subespecifica=$valor[10].$valor[11];
   $func=$_POST['func'];
   $anio=$_POST['anio'];

// dependiendo de lo que se quiera buscar, se van seleccionando mas y mas valores en el select.
   switch ($func) 
	    { // se busca la partida
	      case 1: $sql="select descripcion from descripcion_presupuesto where ((ano = '$anio') and
		  																	   (partida = '$partida') and 
		  																	   (generica = '00') and 
																			   (especifica = '00') and 
																			   (subespecifica = '00'))";		  
		          break;
		  case 2: $sql="select descripcion from descripcion_presupuesto where ((ano = '$anio') and 
		  																	   (partida = '$partida') and 
		  																	   (generica = '$generica') and 
																			   (especifica = '00') and 
																			   (subespecifica = '00'))";
		          break;
		  case 3: $sql="select descripcion from descripcion_presupuesto where ((ano = '$anio') and 
		  																	   (partida = '$partida') and 
		  																	   (generica = '$generica') and 
																			   (especifica = '$especifica') and 
																			   (subespecifica = '00'))";
		          break;
		  case 4: $sql="select descripcion from descripcion_presupuesto where ((ano = '$anio') and 
		  																	   (partida = '$partida') and 
		  																	   (generica = '$generica') and 
																			   (especifica = '$especifica') and 
																			   (subespecifica = '$subespecifica'))";
		          break;
		};
 
    $consulta=mysql_query($sql,$link) or die(mysql_error());
    $resultado=mysql_fetch_array($consulta); 
   
    if($resultado['descripcion'] == "") {$valor = "**************************************************";} else {$valor = $resultado['descripcion'];}
	echo $valor;


 ?>
