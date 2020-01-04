<?php
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
