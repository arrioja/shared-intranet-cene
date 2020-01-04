<?php 
define("servidor","localhost");
define("usuario","root");
define("contrasena","ncc1701");
function conectarse($basedatos) 
{ 
   if (!($link=mysql_connect(servidor,usuario,contrasena))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db($basedatos,$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $link; 
};

//$base=$_POST['base'];

// dependiendo de la base de datos que se quiera conectar se hacen las conexiones independientes por si acaso
// se establecen contraseñas individuales por cada base de datos;
/*  switch ($base) {
    case "personal":
		 $basedatos="personal";

	break;    
    case "administracion":
		 $basedatos="administracion";
		 $contrasena="";
	break;
    case "djp":			 
	     $basedatos="djp";
		 $contrasena="";
	break;
    case "intranet":		 
	     $basedatos="intranet";
		 $contrasena="";
	break;
  }
*/

//mysql_select_db($basedatos);
?>
