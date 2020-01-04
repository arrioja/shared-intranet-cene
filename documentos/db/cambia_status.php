<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Cambia el estatus de un documento.
  		Modificado el: 	12/09/2008 - Creación.
  			  Versión: 	0.1
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 //include("../../libs/utilidades.php");
 //include("../../libs/comprueba_permiso.php");
 require("../../db/conexion.php");
 include("../../db/inserta_rastreo.php");
 $link=conectarse("organizacion"); 

     
	

if (isset($_GET['tipo']) == true)
{ // si el tipo viene en el url, entonces el usuario ha seleccionado a un documento para habilitar / anular.
 $tipo=$_GET['tipo'];
 $st=$_GET['st'];
 $id=$_GET['id'];
 $num=$_GET['numdoc'];

 switch ($tipo)
 {
   case 1:{
    		$actualiza=mysql_query("update organizacion.oficios set status='$st' where id='$id'",$link) or die(mysql_error());
			if ($st==1) {$descripcion="HABILITADO el Oficio:".$num;}
			else {$descripcion="ANULADO el Oficio:".$num;}
            $ip = $REMOTE_ADDR; 
            inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'M',$descripcion,$ip);
            header ("Location: ../listar_oficios_anula.php", true); 
   			break;
   		  }
   case 2:{
    		$actualiza=mysql_query("update organizacion.memoranda set status='$st' where id='$id'",$link) or die(mysql_error());
			if ($st==1) {$descripcion="HABILITADO el Memorando:".$num;}
			else {$descripcion="ANULADO el Memorando:".$num;}
            $ip = $REMOTE_ADDR; 
            inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'M',$descripcion,$ip);
            header ("Location: ../listar_memoranda_anula.php", true); 
   			break;
   		  }
 } 
  
}
 

?>
