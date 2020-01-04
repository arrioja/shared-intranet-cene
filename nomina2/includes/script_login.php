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
    require 'libreria.php';
    $link=conectarse("nomina"); 
    $result=mysql_query("select * from usuarios where (login='$login' and password='$password')",$link);
	
	if ($usuario=mysql_fetch_array($result))
	  {
			$_SESSION['login']=$login;
			if (    (isset($_POST['pagina'])) &&  ($_POST['pagina']!='')     )
			  {
				$pagina=$_POST['pagina'];//pag a redireccionar
			echo '<script languaje="Javascript">location.href="../'.$pagina.'"</script>';
			  }
			else//abajo deberia llevar al menu o pag principal
			  {
			echo '<script languaje="Javascript">location.href="../visualizar_integrantes.php"</script>';
			  }   
			exit(); 
	  }
	else
	  {
	    session_destroy();		
	    echo '<script languaje="Javascript">location.href="../login.php"</script>';
	    exit;
	  }
  }
?>