<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Edita los tados de las personas en la base de datos
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 include("../../db/conexion.php");
 include("../../libs/utilidades.php");
 $id=$_POST['id'];
 $cedula=$_POST['cedula'];
 $nombres=$_POST['nombres'];
 $apellidos=$_POST['apellidos'];
 $fnac=cambiaf_a_mysql($_POST['fnac']);
 $lnac=$_POST['lnac'];
 $sexo=$_POST['sexo'];
 $edocivil=$_POST['edocivil'];
 $profesion=$_POST['profesion'];
 $instruccion=$_POST['instruccion'];
 $telef=$_POST['telef'];
 $celular=$_POST['celular'];
 $fechain=cambiaf_a_mysql($_POST['fechain']);
 $direccion=$_POST['direccion'];
  
 //include("../../db/conexion.php");
// $link=conectarse("intranet"); 
 $link=conectarse("organizacion"); 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 if ($insertar=mysql_query("update personas set nombres='$nombres', apellidos='$apellidos', fecha_nacimiento='$fnac',
 							       				lugar_nacimiento='$lnac', sexo='$sexo', edo_civil='$edocivil', profesion='$profesion', 
												grado_instruccion='$instruccion', fecha_ingreso='$fechain',
							 				    direccion='$direccion',tlf_habitacion='$telef',tlf_celular='$celular'
							where id='$id'",$link) or die(mysql_error())) 
 {
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../listar_personas.php", true); 
 }
  else
 {
   echo " Error gruardando los datos de usuario - ";
   echo mysql_error();
   echo " ----- Antes de cerrar este mensaje de error, por favor contacte al soporte t&eacute;cnico de la Direcci&oacute;n de Sistemas para tomen las previsiones y lo corrijan oportunamente"; 
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
  };  
?>