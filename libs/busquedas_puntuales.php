<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  esta funci�n devuelve el nombre o el apellidos de un funcionario dado su numero de c�dula.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versi�n: 	0.1b
     ****************************************************  FIN DE INFO
*/

	function busca_funcionario($cedula,$dato)
	{
      $consulta=mysql_query("select id, cedula, nombres, apellidos from integrantes where cedula='$cedula'",$link) or die(mysql_error());
      $resultado=mysql_fetch_array($consulta);
	  switch ($dato) 
	    { 
	      case 1: $valor=$resultado['nombres'];
		          break;
		  case 2: $valor=$resultado['apellidos'];
		          break;
		};  	  
	  return $valor;
	}



?>