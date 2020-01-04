<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  este archivo devuelve todos los entes y organos que correspondan a el tipo dado, esto es usado para construir los
  						combos q se usan en las ventanas de listados de entes via AJAX .
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/

 $tipo=$_GET['tipo']; 

 include("../../db/conexion.php");
 $link=conectarse("asistencias"); 
 $cadena='';
 mysql_query("BEGIN");  //inicio la transaccion
 $edita=mysql_query("select codigo, nombre from entes_organos where tipo='$tipo'",$link);

   while ($resultado=mysql_fetch_array($edita))
   {
     $cadena=$cadena.$resultado['nombre']."-".$resultado['codigo']."/";  
   }
   echo $cadena;
?>     