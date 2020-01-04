<?php
$imagen="imagenes/".$_GET['imagen'];
$texto=$_GET['texto'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mensaje</title></head>
    <body>    
<p><?php printf ("$texto")?></p>
 <img src=<?php printf ("$imagen")?>>
    </body>
</html>