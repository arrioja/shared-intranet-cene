<?php
 if (!($link=mysql_connect("localhost","capepo","capepo")))
  {
     echo "Error conectando a la base de datos.";
     exit();
  }

  if (!mysql_select_db("organizacion",$link))
  {
     echo "Error seleccionando la base de datos.";
     exit();
  }
  $valor=$_GET['valor'];
  $func=$_GET['func'];
  $consulta=mysql_query("select p.nombres, p.apellidos from organizacion.personas p where p.cedula = $valor",$link) or die(mysql_error());
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