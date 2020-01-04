<?php 
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
 $link=conectarse("personal"); 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 if ($insertar=mysql_query("insert into intranet_usuarios(cedula,login,clave,email,nivel,direccion) values ('$cedula','$login','$clave','$email','$niv','$dir')",$link) or die(mysql_error())) 
 {
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../listar_usuarios_intranet.php", true); 
 }
  else
 {
   echo " Error gruardando los datos de usuario - ";
   echo mysql_error();
   echo " ----- Antes de cerrar este mensaje de error, por favor contacte al soporte t&eacute;cnico de la Direcci&oacute;n de Sistemas para tomen las previsiones y lo corrijan oportunamente"; 
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
  };  
?>
