<?php 
 $cedula=$_POST['cedula'];
 $pago_banco=$_POST['pago_banco'];
 $codigo=$_POST['codigo'];
 $tipo_nomina=$_POST['tipo_nomina'];
 $status=$_POST['status'];
 $anos=$_POST['anos'];

 include("conexion.php");
 $link=conectarse("nomina"); 
 // para seleccionar la base de datos de Nómina porque ahi deben estar los datos del usuario que deseamos incluir en el sistema
 mysql_query("BEGIN");  //inicio la transaccion
 if ($insertar=mysql_query("insert into nomina.integrantes (cedula,status, tipo_nomina, anos_servicio,pago_banco,cod) values ('$cedula','$status','$tipo_nomina','$anos_servicio','$pago_banco','$cod')",$link) or die(mysql_error())) 
 {
   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
   header ("Location: ../visualizar_integrantes.php", true); 
 }
  else
 {
   echo " Error gruardando los datos de usuario - ";
   echo mysql_error();
   echo " ----- Antes de cerrar este mensaje de error, por favor contacte al soporte t&eacute;cnico de la Direcci&oacute;n de Sistemas para tomen las previsiones y lo corrijan oportunamente"; 
   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
  };  
?>