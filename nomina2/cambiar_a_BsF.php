<?php
   include("includes/miclase.php");
   $link=conectarse("nomina");
   $result=mysql_query("select * from integrantes_constantes where cod_constantes<>'9000' order by id asc",$link);
?>
<?php if (isset($_POST['guardar']))
		{
		while ($viejo=mysql_fetch_array($result))
			{
			$id=$viejo['id'];
			$nuevo_valor=cambiar_BsF($viejo['monto']);
			$sql="update integrantes_constantes set monto='$nuevo_valor' where id='$id'";
			if (!mysql_query($sql,$link))
				echo ('nooooo'.mysql_error($link));
			
			}
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cambiar a BsF</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="331" border="1">
  <?php while ($antiguo=mysql_fetch_array($result)){?>
    <tr>
      <td><?php echo $antiguo['cedula'];?>
      <td><?php echo $antiguo['monto'];?></td>
      <td><?php //echo cambiar_BsF($antiguo['monto']);?></td>
    </tr>
    <?php }?>
    <tr>
      <td width="149" align="right"><input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td width="166"><a href="index.php">Volver</a></td>
      <td></td>
    </tr>
  </table>
</form>
</body>
</html>