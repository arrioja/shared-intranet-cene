<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  es un redireccionamiento al index de la ra�z del sitio.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versi�n: 	0.1b
     ****************************************************  FIN DE INFO
*/
    if (isset($_GET['sis'])) {$adicional="?sis=".$_GET['sis'];} else {$adicional="";}
	echo '<script languaje="Javascript">location.href="../index_para_sub_directorios.php'.$adicional.'"</script>';
	exit();
?>
