<?php
  include "../db/conexion.php";
  $link=conectarse("personal"); 
  $cvee=$_GET['cvee'];
  $consulta=mysql_query("select nombres from integrantes where cedula = $cvee",$link) or die(mysql_error());
  $resultado=mysql_fetch_array($consulta);
  $nomb = $resultado['nombres']; 
  if(trim($nomb) == "") $nomb = "<font color=red>NO Existe detalle para esa clave</font>"; 
?>
<div><big> <?php echo "$nomb"; ?> </big></div>
