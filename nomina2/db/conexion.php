<?php 
/*
     Bases de Datos en la Contralor�a:
	 
	 intranet:  relacionado con los accesos, sistemas, modulos y configuraciones generales de los mismos, la intranet es el macro sistema
	 			que contiene los dem�s sistemas creados para la Contralor�a del Estado.
				
	 asistencias: se encuentran las tablas relacionadas con el sistema de control de entrada y salida del personal de CENE.
	 
	 nomina: contiene las tablas relacionadas con el sistema de n�mina de la Contralor�a.
			   
	 administracion: corresponde al sistema de control presupuestario, financiero, de bienes muebles y consumibles de la contraloria.
	 
	 gestion: relacionadas con el control de actividades, planes operativos, planes estrat�gicos e indicadores de gesti�n de la instituci�n
	 
	 djp: relacionado con en sistema de registro de comprobantes de declaraciones juradas de patrimonio
	 
	 organizacion:  tablas relacionadas con datos generales que necesitan ser accesados desde varios sistemas, como por ejemplo, 
	 				se encuentra una tabla llamada personas que contiene los datos personales de cualquier persona registrada en el 
					sistema, los cuales, pueden formar parte de la n�mina como pueden ser pasantes que estan registrados en la 
					intranet pero no vecesariamente son parte de la n�mina.
	 
*/
// en caso de necesitarse accesos separados por bases de datos (solo si se tienen bases de datos con claves diferentes), 
// estas siguientes lineas deben encontrarse en el switch de adelante.
define("servidor","localhost");
define("usuario","root");
define("contrasena","ncc1701");
function conectarse($base) 
{ 
   if (!($link=mysql_connect(servidor,usuario,contrasena))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   
   
   if (!mysql_select_db($base,$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $link; 
};


?>
