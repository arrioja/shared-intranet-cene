<?php 
    if (isset($_GET['sis'])) {$adicional="?sis=".$_GET['sis'];} else {$adicional="";}
	echo '<script languaje="Javascript">location.href="../index_para_sub_directorios.php'.$adicional.'"</script>';
	exit();
?>
