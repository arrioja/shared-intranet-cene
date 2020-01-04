<?php
/*
    Bases de Datos en la Contraloría:

        intranet:  relacionado con los accesos, sistemas, modulos y
configuraciones generales de los mismos, la intranet es el macro
sistema
                               que contiene los demás sistemas creados para la Contraloría del Estado.

        asistencias: se encuentran las tablas relacionadas con el sistema de
control de entrada y salida del personal de CENE.

        nomina: contiene las tablas relacionadas con el sistema de nómina de
la Contraloría.

        administracion: corresponde al sistema de control presupuestario,
financiero, de bienes muebles y consumibles de la contraloria.

        gestion: relacionadas con el control de actividades, planes
operativos, planes estratégicos e indicadores de gestión de la
institución

        djp: relacionado con en sistema de registro de comprobantes de
declaraciones juradas de patrimonio

        organizacion:  tablas relacionadas con datos generales que necesitan
ser accesados desde varios sistemas, como por ejemplo,
                                       se encuentra una tabla llamada personas que contiene los datos
personales de cualquier persona registrada en el
                                       sistema, los cuales, pueden formar parte de la nómina como pueden
ser pasantes que estan registrados en la
                                       intranet pero no vecesariamente son parte de la nómina.

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


 // dependiendo de la base de datos que se quiera conectar se hacenlas conexiones independientes por si acaso
// se establecen contraseñas individuales por cada base de datos;además, si es necesario cambiar el nombre de la base de datos, simplemente
// se cambia en este archivo php y no hay que cambiarlo en todos los archivos que llamen a la base.
  switch ($base) {
   case "personal":
                $basedatos="personal";
//               $contrasena="123456";
       break;
       case "asistencias":
                $basedatos="personal";
//               $contrasena="123456";
       break;
   case "administracion":
                $basedatos="administracion";
//               $contrasena="123456";
       break;
   case "djp":
            $basedatos="djp";
//               $contrasena="123456";
       break;
   case "intranet":
            $basedatos="intranet";
//               $contrasena="";
       break;
       case "organizacion":
            $basedatos="organizacion";
//               $contrasena="123456";
       break;
 }


  if (!mysql_select_db($basedatos,$link))
  {
     echo "Error seleccionando la base de datos.";
     exit();
  }
  return $link;
};


?>