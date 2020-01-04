<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  es un redireccionamiento al index de la raíz del sitio.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
    session_start();  // se inicia la sesión 
	if (isset($_GET['sis'])) {$adicional="?sis=".$_SESSION['sis'];} else {$adicional="";}
	echo '<script languaje="Javascript">location.href="index.php'.$adicional.'"</script>';
	exit();
?>
