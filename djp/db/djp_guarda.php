<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Brinda el soporte para la inclusión en la base de datos del comprobante de DJP de la persona.
  		Modificado el: 	05/09/2008 por Pedro E. Arrioja M. - Creación
  			  Versión: 	0.2b
     ****************************************************  FIN DE INFO
*/
 include("../../libs/utilidades.php");
 require("../../db/conexion.php");
   // para ingresar marca de auditoria.   
   session_start();
   include("../../db/inserta_rastreo.php");
   
// Se recuperan las variables via GET y se almacenan en variables locales 
   $cedula=$_POST['cedula']; 
   $nombre=$_POST['nombre'];
   $apellido=$_POST['apellido']; 
   $instituto=$_POST['instituto']; 
   $cargo=$_POST['cargo']; 
   $iddoc=$_POST['iddoc']; 
   $anexos=$_POST['anexos']; 
   $folios=$_POST['folios']; 
   $tipo=$_POST['tipo']; 
   $sexo=$_POST['sexo'];
   $fecha=cambiaf_a_mysql($_POST['fecha']);
   $observaciones=$_POST['observaciones']; 
   
   //Se graban los datos en la tabla de declarantes

   $link=conectarse("djp");  
   $consulta_declarantes = mysql_query("select d.cedula from declarantes d where d.cedula=$cedula", $link); 
   if (mysql_num_rows($consulta_declarantes) == 0) 
      { // si es cero quiere decir que no encontro la cedula y debemos incluir el declarante
         mysql_query("BEGIN");  //inicio la transaccion
         if (mysql_query("insert into djp.declarantes (cedula,nombre,apellido,sexo) values ('$cedula','$nombre','$apellido','$sexo')",$link))
           {  // si se insertan los datos del declarante y si no hay problemas se continua con los datos del comprobante
	         if (mysql_query("insert into djp.comprobantes (cedula_declarante,folios,anexos,fecha,observaciones,status,iddoc,cargo,instituto) values ".
                "('$cedula','$folios','$anexos','$fecha','$observaciones','$tipo','$iddoc','$cargo','$instituto')",$link))
                {  // si no hay problemas con el declarante no con el comprobante, se graba en la transacción
   		           mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
				   $descripcion='Inserta nuevo comprobante de DJP: '.$cedula.' - '.$nombre.' '.$apellido;
                   $ip = $REMOTE_ADDR; 
                   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
  	         //      echo "Datos Incluidos";
		           header ("Location: ../incluir_cedula.php", true);
		        }
	   	     else
		       {
                 $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
                 mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
                 // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
                 echo '<script languaje="Javascript">location.href="../../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';			   
		       };  
           } 
         else
          {
            $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
            mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
            // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
            echo '<script languaje="Javascript">location.href="../../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';	
           };   
         mysql_close($link);
    }
   else 
    { //no se inserta el declarante porque la consulta arrojó mas de una cédula existente
         mysql_query("BEGIN");  //inicio la transaccion
	     if (mysql_query("insert into djp.comprobantes (cedula_declarante,folios,anexos,fecha,observaciones,status,iddoc,cargo,instituto) values ".
            "('$cedula','$folios','$anexos','$fecha','$observaciones','$tipo','$iddoc','$cargo','$instituto')",$link))
            {  // si no hay problemas con el declarante no con el comprobante, se graba en la transacción
   		       mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
			   $descripcion='Inserta nuevo comprobante de DJP: '.$cedula.' - '.$nombre.' '.$apellido;
			   $ip = $REMOTE_ADDR; 
			   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
		       header ("Location: ../incluir_cedula.php", true);
		    }
	   	 else
		    {
               $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
               mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
               // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
               echo '<script languaje="Javascript">location.href="../../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';	
		     };   
         mysql_close($link);	
	};
?> 