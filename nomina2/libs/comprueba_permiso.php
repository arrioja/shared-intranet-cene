<?php 

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

?>
