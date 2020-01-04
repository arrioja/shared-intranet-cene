<?php

  function inserta_rastro($login,$cedula,$tipo,$descripcion,$ip)
    {
	  // Con esta comprobacion evito que me de el error de redeclarar la conexión cuando se llama a esta función desde un php que haya
	  // usado el "conectarse".
	 // if ($link999=conectarse("personal") == false) {include("conexion.php");}
	  $link999=conectarse("intranet"); 
	  // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
	  mysql_query("BEGIN");  //inicio la transaccion
	  if ($insertar=mysql_query("insert into rastreo(login,cedula,tipo,descripcion,ip) values ('$login','$cedula','$tipo','$descripcion','$ip')",$link999) or die(mysql_error()))
	   {
		 mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
		// header ("Location: ../listar_grupos_intranet.php", true); 
	   }
		  else
		 {		  
		   echo " Error gruardando los datos - ";
		   echo mysql_error();
		   echo " ----- Antes de cerrar este mensaje de error, por favor contacte al soporte t&eacute;cnico de la Direcci&oacute;n 
		         de Sistemas para tomen las previsiones y lo corrijan oportunamente"; 
		   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
		  };  
	}
?>
