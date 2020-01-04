<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  este archivo posee una función que comprueba que un usuario tenga acceso a un modulo registrado o no, además de 
  						otras funciones relacionadas con codigos de módulos y de sistemas registrados
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
    // para comprobar que el funcionario tenga permiso al módulo al cual desea acceder
    function tiene_permiso($login,$modulo)
    {
	  //require("db/conexion.php");
      $linkp=conectarse("intranet"); 
      $result=mysql_query("SELECT * 
	  					   FROM usuarios_grupos as a, permisos_grupos as b
						   WHERE (a.login='$login') and (b.codigo_modulo='$modulo') and a.codigo=b.codigo_grupo",$linkp);
	  // la consulta anterior debe retornar sólo un registro si el usuario tiene acceso al módulo en cuestión, si no tiene permiso, 
	  // cimplemente no retorna resultado.
	  if ($permiso=mysql_fetch_array($result))
	    {
		  return true;
	    }
	  else
	    {
		  return false;
		}
    }
	
	// para saber el código de un módulo dado su nombre de archivo
	function codigo_modulo($nombrearch)
    {
	 // require("db/conexion.php");
      $linkp=conectarse("intranet"); 
      $result=mysql_query("SELECT codigo_modulo 
	  					   FROM modulos WHERE (archivo_php='$nombrearch')",$linkp);
	  // la consulta anterior debe retornar sólo un registro si el usuario tiene acceso al módulo en cuestión, si no tiene permiso, 
	  // cimplemente no retorna resultado.
	  if ($result_archivo=mysql_fetch_array($result))
	    {
		  return $result_archivo['codigo_modulo'];
	    }
	  else
	    {
		  return false;
		}
    }
	
	
	// para saber el código del sistema de un módulo dado su nombre de archivo
	function codigo_sistema($nombrearch)
    {
	 // require("db/conexion.php");
      $linkp=conectarse("intranet"); 
      $result=mysql_query("SELECT codigo_modulo 
	  					   FROM modulos WHERE (archivo_php='$nombrearch')",$linkp);
	  // la consulta anterior debe retornar sólo un registro si el usuario tiene acceso al módulo en cuestión, si no tiene permiso, 
	  // cimplemente no retorna resultado.
	  if ($result_archivo=mysql_fetch_array($result))
	    {
		  $codigo_sis=$result_archivo['codigo_modulo'][0].$result_archivo['codigo_modulo'][1];
		  return $codigo_sis;
	    }
	  else
	    {
		  return false;
		}
    }

	
function comprueba_acceso($nombrearch)
{
  /* ***************************************************************************************************************
    Este código pretende realizar una comprobación genérica del acceso que tiene el usuario a página en cuestión  
   ***************************************************************************************************************
   */
  session_start();  // se inicia la sesión 
  $php_actual = solo_nombre_arch($nombrearch);
  if (!isset($_SESSION['login']))  // si "login" no existe, no hay sesión iniciada y se envia al login para ingresar autenticar
    {
	  session_destroy();
	  echo '<script languaje="Javascript">location.href="/intranet/login.php?pag=index.php"</script>';
	  exit();
    }
  else
    {  // si la sesión y el login existen, ahora se comprueba que el usuario tenga acceso a este módulo
       // include("libs/comprueba_permiso.php"); 
	  $codigo_actual=codigo_modulo($php_actual);
	  if ($codigo_actual!=false) 
	    { // si codigo actual no es falso entonces trajo resultado, asi que se continua
	    // en esta función se debe pasar como parámetro el login del usuario que se trae desde el sesion y el 
	    //código del módulo asignado al momento de insgribirlo en el sistema mediante la página de administración de módulos
	      if (tiene_permiso($_SESSION['login'],$codigo_actual) == false )
	        {
	          echo '<script languaje="Javascript">location.href="/intranet/mensaje.php?codigo=00003"</script>';
	          exit;
	        }	    
	    }
	  else
	    { // si codigo_actual es falso, entonces no hay coincidencias con el nombre del archivo, 
	      // quiere decir que no se ha incluido el modulo en el sistema
	        echo '<script languaje="Javascript">location.href="/intranet/mensaje.php?codigo=00004"</script>';
	        exit;		
	    }
    }
}
// ************************************************************************************************************
	

?>
