<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  este archivo posee una funci�n que comprueba que un usuario tenga acceso a un modulo registrado o no, adem�s de 
  						otras funciones relacionadas con codigos de m�dulos y de sistemas registrados
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versi�n: 	0.1b
     ****************************************************  FIN DE INFO
*/
    // para comprobar que el funcionario tenga permiso al m�dulo al cual desea acceder
    function tiene_permiso($login,$modulo)
    {
	  //require("db/conexion.php");
      $linkp=conectarse("intranet"); 
      $result=mysql_query("SELECT * 
	  					   FROM usuarios_grupos as a, permisos_grupos as b
						   WHERE (a.login='$login') and (b.codigo_modulo='$modulo') and a.codigo=b.codigo_grupo",$linkp);
	  // la consulta anterior debe retornar s�lo un registro si el usuario tiene acceso al m�dulo en cuesti�n, si no tiene permiso, 
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
	
	// para saber el c�digo de un m�dulo dado su nombre de archivo
	function codigo_modulo($nombrearch)
    {
	 // require("db/conexion.php");
      $linkp=conectarse("intranet"); 
      $result=mysql_query("SELECT codigo_modulo 
	  					   FROM modulos WHERE (archivo_php='$nombrearch')",$linkp);
	  // la consulta anterior debe retornar s�lo un registro si el usuario tiene acceso al m�dulo en cuesti�n, si no tiene permiso, 
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
	
	
	// para saber el c�digo del sistema de un m�dulo dado su nombre de archivo
	function codigo_sistema($nombrearch)
    {
	 // require("db/conexion.php");
      $linkp=conectarse("intranet"); 
      $result=mysql_query("SELECT codigo_modulo 
	  					   FROM modulos WHERE (archivo_php='$nombrearch')",$linkp);
	  // la consulta anterior debe retornar s�lo un registro si el usuario tiene acceso al m�dulo en cuesti�n, si no tiene permiso, 
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
    Este c�digo pretende realizar una comprobaci�n gen�rica del acceso que tiene el usuario a p�gina en cuesti�n  
   ***************************************************************************************************************
   */
  session_start();  // se inicia la sesi�n 
  $php_actual = solo_nombre_arch($nombrearch);
  if (!isset($_SESSION['login']))  // si "login" no existe, no hay sesi�n iniciada y se envia al login para ingresar autenticar
    {
	  session_destroy();
	  echo '<script languaje="Javascript">location.href="/intranet/login.php?pag=index.php"</script>';
	  exit();
    }
  else
    {  // si la sesi�n y el login existen, ahora se comprueba que el usuario tenga acceso a este m�dulo
       // include("libs/comprueba_permiso.php"); 
	  $codigo_actual=codigo_modulo($php_actual);
	  if ($codigo_actual!=false) 
	    { // si codigo actual no es falso entonces trajo resultado, asi que se continua
	    // en esta funci�n se debe pasar como par�metro el login del usuario que se trae desde el sesion y el 
	    //c�digo del m�dulo asignado al momento de insgribirlo en el sistema mediante la p�gina de administraci�n de m�dulos
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
