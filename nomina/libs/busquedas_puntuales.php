<?php 

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