<?php /****************************************************************************************************************
    Este código pretende realizar una comprobación genérica del acceso que tiene el usuario a página en cuestión  
   ***************************************************************************************************************
 */
session_start();  // se inicia la sesión 
//include("../libs/utilidades.php");
include "includes/miclase.php";
$link=conectarse("nomina");
$php_actual = solo_nombre_arch($_SERVER["SCRIPT_NAME"]);
if (!isset($_SESSION['login']))  // si "login" no existe, no hay sesión iniciada y se envia al login para ingresar autenticar
  {
	session_destroy();
	echo '<script languaje="Javascript">location.href="../login.php?pag='.'nomina/'.$php_actual.'"</script>';
	exit();
  }
else
  {  // si la sesión y el login existen, ahora se comprueba que el usuario tenga acceso a este módulo
    include("../libs/comprueba_permiso.php"); 
	$codigo_actual=codigo_modulo($php_actual);
	if ($codigo_actual!=false) 
	  { // si codigo actual no es falso entonces trajo resultado, asi que se continua
	    // en esta función se debe pasar como parámetro el login del usuario que se trae desde el sesion y el 
	    //código del módulo asignado al momento de insgribirlo en el sistema mediante la página de administración de módulos
	    if (tiene_permiso($_SESSION['login'],$codigo_actual) == false )
	      {
	        echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00003"</script>';
	        exit;
	      }	    
	  }
	else
	  { // si codigo_actual es falso, entonces no hay coincidencias con el nombre del archivo, 
	    // quiere decir que no se ha incluido el modulo en el sistema
	        echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00004"</script>';
	        exit;		
	  }
  }?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reportes</title>
</head>

<body>
<table width="359" height="84" border="1" align="center">
  <tr>
    <td align="center">REPORTES</td>
  </tr>
  <tr>
    <td><a href="reportes/reporte_general.php">GENERAL</a></td>
  </tr>
  <tr>
    <td><a href="reportes/reporte_individual.php">INDIVIDUAL</a></td>
  </tr>
  <tr>
    <td><a href="reportes/reporte_revision_nomina.php">REVISIÓN DE NOMINA</a></td>
  </tr>
  <tr>
    <td><a href="reportes/resumen_de_conceptos.php">RESUMEN DE CONCEPTOS</a></td>
  </tr>
  <tr>
    <td align="center"><a href="visualizar_integrantes.php"><span class="datos_formularios">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
    </span></a></td>
  </tr>
</table>
</body>
</html>
