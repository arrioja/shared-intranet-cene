<?php 
include "includes/miclase.php";
$link=conectarse("nomina");
$result=mysql_query('select * from constantes',$link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Constantes Disponibles</title>
<script> 
function cerrarVentana(){ 
var ventana = window.self; 
ventana.opener = window.self; 
ventana.close(); 
} 
</script> 

</head>

<body>
<table width="336" border="1">
  <tr>
    <td width="242"><strong>Descripcion</strong></td>
    <td width="78"><strong>Abreviatura</strong></td>
  </tr>
  <?php while($constantes=mysql_fetch_array($result)){?>
  <tr>
    <td><?php echo $constantes['descripcion']; ?></td>
    <td><?php echo $constantes['abreviatura']; ?></td>
  </tr>
  <?php }?>
  <tr>
    <td colspan="2"><input type=button value="Cerrar" onclick="cerrarVentana()"> 
    &nbsp;</td>
  </tr>
</table>
</body>
</html>
