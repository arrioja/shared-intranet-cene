<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  esta funci�n devuelve el nombre o el apellidos de un funcionario dado su numero de c�dula.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versi�n: 	0.1b
     ****************************************************  FIN DE INFO
*/
  include "../db/conexion.php";
  $link=conectarse("organizacion"); 
  $valor=$_GET['valor'];
  $func=$_GET['func'];
  $consulta=mysql_query("select nombres, apellidos from personas where cedula = $valor",$link) or die(mysql_error());
  $resultado=mysql_fetch_array($consulta);
  
  switch ($func) 
	    { 
	      case 1: $valor=$resultado['nombres'];
		          break;
		  case 2: $valor=$resultado['apellidos'];
		          break;
		};
  if(trim($valor) == "") $valor = "No Existe - debe registrarlo primero"; 
?>
<?php echo "$valor"; ?>
