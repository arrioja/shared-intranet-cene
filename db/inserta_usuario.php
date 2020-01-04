<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  inserta los datos de un nuevo usuario en la base de datos.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Creación
						27/08/2008 por Pedro E. Arrioja M. - Se incluye comprobación de existencia o no del usuario y de datos del nivel antes 
															 de incluirlo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/ 
 $cedula=$_POST['cedula'];
 $clave=$_POST['clave'];
// $nombres=$_POST['nombres'];
// $apellidos=$_POST['apellidos'];
 $email=$_POST['email'];
 $login=$_POST['login'];
 $niv=$_POST['nivel'];
 $dir=$_POST['direccion'];
 include("conexion.php");
// $link=conectarse("intranet"); 
 $link=conectarse("intranet"); 
 
 $consulta_usr=mysql_query("select u.cedula from intranet.usuarios u where u.cedula='$cedula'",$link);
 
 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 if (mysql_num_rows($consulta_usr) == 0)
   {
     mysql_query("BEGIN");  //inicio la transaccion
	 if ($insertar=mysql_query("insert into intranet.usuarios(cedula,login,clave,email) 
								 values ('$cedula','$login','$clave','$email')",$link) or die(mysql_error())) 
	   { 
		 $consulta_niv=mysql_query("select o.cedula from organizacion.personas_nivel_dir o where o.cedula='$cedula'",$link); 
		 if (mysql_num_rows($consulta_niv) == 0)
		   {
			 $insertar2=mysql_query("insert into organizacion.personas_nivel_dir(cedula,nivel,cod_direccion) 
								 values ('$cedula','$niv','$dir')",$link) or die(mysql_error());
		   } // del numrows consulta_niv
		 mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
		 header ("Location: ../listar_usuarios_intranet.php", true); 
	   }
	 else
	   {
		 $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
		 mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
		 // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
		 echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';	  
	   }
   }//del numrows consulta_usr
 else
   {
      echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00006&adic='.$msg_error.'"</script>';
   }  
?>
