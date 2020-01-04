<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title></head>

<body>
<?php include "../conexion/conectar.php";
  $result=mysql_query("select * from gestion_fases WHERE cod_actividad=$_GET[seleccionado]",$link);
  if ($result) {
?>


<form id="form1" name="form1" method="post" action="../actividades/actividades.php">
<table width="835" border="1" align="center" cellpadding="2">
    <tr>
      <td width="108"><div align="center"><strong>C&oacute;digo</strong></div></td>
      <td width="401"><div align="center"><strong>Nombre</strong></div></td>
      <td width="106"> <div align="center"><strong>Fecha Inicio</strong></div></td>
      <td width="61"><div align="center"><strong>Duraci&oacute;n</strong></div></td>
      <td width="115"><div align="center"><strong>Estado</strong></div></td>
    </tr>
    <?php while ($row=mysql_fetch_array($result)){?>
    <tr>
      <td><div align="center"><?php echo $row[0] ?></div></td>
      <td><div align="justify"><?php echo $row[1] ?></div></td>
      <td><div align="center"><?php echo $row[2]?></div></td>
      <td><div align="center"><?php echo $row[3]?></td>
      <td><label>
        <input name="checkbox" type="checkbox" id="checkbox" />
        Cumplida
      </label></td>
    </tr>
    <?php }
	}?>
  </table>

<label> 
  
      <div align="center"></div>
  </label>
</form>
</body>
</html>
