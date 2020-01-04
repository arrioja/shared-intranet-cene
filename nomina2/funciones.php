<?php
if (isset($_POST["descargar"]))
	{
	echo '<script languaje="Javascript">location.href="descargar.php?f=archivo.txt"</script>';
	}

if(isset($_POST["submit"])){
if(@$fp = fopen("archivo.txt", "w")){
  fwrite($fp, stripslashes($newdata));
  fclose($fp);
} else {
  exit ("<h1>Error</h1>\n<p>No se puede escribir el archivo, asegurate que los permisos son correctos(CHMOD 777).</p>");
}
}

if($fp = fopen("archivo.txt", "r")){
  $data = fread($fp, filesize("archivo.txt"));
  fclose($fp);
} else {
  $data = "";
  exit ("<h1>Error</h1>\n<p>No se puede escribir el archivo, asegurate que los permisos son correctos(CHMOD 777).</p>");
}
?> 