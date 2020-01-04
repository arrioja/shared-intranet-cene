<?php 
session_start();
if (isset($_SESSION['login']))
  {
    session_destroy();
    echo '<script languaje="Javascript">location.href="../login.php"</script>';
    exit();
  }
else
  {
    $login=$_POST['login'];
    $password=$_POST['password'];
    require('../libs/utilidades.php');
    include("inserta_rastreo.php");
	require('conexion.php');
    $link=conectarse("intranet"); 
	$link=conectarse("organizacion");
    $result=mysql_query("select u.*, p.nombres, p.apellidos  
						 from intranet.usuarios as u, organizacion.personas as p  
						 where ((u.login='$login' and u.clave='$password') and (u.cedula=p.cedula))",$link);
	if ($usuario=mysql_fetch_array($result))
	  {
	    if ($usuario['activo'] == "S") 
		  {
			$_SESSION['login']=$login;
			//$_SESSION['password']=$password;
			$_SESSION['cedula']=$usuario['cedula'];
			$cedula_consulta=$usuario['cedula'];
			$_SESSION['email']=$usuario['email'];
			$_SESSION['nombres']=$usuario['nombres'];
			$_SESSION['apellidos']=$usuario['apellidos'];
			$_SESSION['direccion']=$usuario['direccion'];
			$_SESSION['nivel']=$usuario['nivel'];
			
			   //Se añaden los rastros de auditoria respectivos
			   $cedula=$usuario['cedula'];
			   $descripcion='Acceso PERMITIDO. Motivo: Autentificaci&oacute;n Correcta';
			   $ip = $REMOTE_ADDR; 
			   inserta_rastro($login,$cedula,'L',$descripcion,$ip);
			
			if (    (isset($_POST['pagina'])) &&  ($_POST['pagina']!='')     )
			  {
				$pagina=$_POST['pagina'];//pag a redireccionar
				echo '<script languaje="Javascript">location.href="../'.$pagina.'"</script>';
			  }
			else//abajo deberia llevar al menu o pag principal
			  {
				echo '<script languaje="Javascript">location.href="../index.php"</script>';
			  }   
			exit(); 
		   } // del usuarioactivo
		 else
		   { // si el usuario no se ecuentra activado se muestra el error correspondiente
		    //Se añaden los rastros de auditoria respectivos
			 $cedula=$usuario['cedula'];
			 $tipo='L';
			 $descripcion='Acceso NEGADO. Motivo: Usuario Desactivado';
			 $ip = $REMOTE_ADDR; 
			 inserta_rastro($login,$cedula,'L',$descripcion,$ip);
		     session_destroy();
	         echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00002"</script>';
	         exit;
		   }
	  }
	else
	  { // si no coinciden el nombre de usuario o la contraseña
	  
	  	//Se añaden los rastros de auditoria respectivos
		 $cedula='??????????';
		 $tipo='L';
		 $descripcion='Acceso NEGADO. Motivo: Login o clave incorrecta. Login usado: '.$login;
		 $ip = $REMOTE_ADDR; 
		 inserta_rastro($login,$cedula,'L',$descripcion,$ip);
	    session_destroy();
	    echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00001"</script>';
	    exit;
	  }
  }
?>