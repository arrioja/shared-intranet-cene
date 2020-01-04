<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Editar TXT</title>
</head>
<body>
<?php 
if (isset($_POST['volver']))
	{
	echo '<script languaje="Javascript">location.href="archivo_banco.php"</script>';
	}

require "includes/miclase.php";
$link=conectarse("nomina");
$result=mysql_query("select * from nomina_actual where status='ACTIVA'",$link);//datos nomina actual
$nom=mysql_fetch_array($result);
$cod=$nom['cod'];//codigo de la nomina actual
$data="";
$tipo=$_GET['tipo'];//tipo de nomina (directores, empleados, etc)
$result2=mysql_query("select n.cedula,n.monto_incidencia,ib.numero_cuenta from nomina n inner join  integrantes_banco ib on (ib.cedula=n.cedula)where cod='$cod' and cod_incidencia='7003' and tipo_nomina='$tipo'",$link);//montos de totales nomina actual y tipo nomina
$cont=1;
$num=mysql_num_rows($result2);//numero de registros
$fecha=date("d/m/Y");$fecha=str_replace("/","",$fecha);
$result3=mysql_query("select sum(monto_incidencia) as total from nomina n inner join  integrantes_banco ib on (ib.cedula=n.cedula)where cod='$cod' and cod_incidencia='7003' and tipo_nomina='$tipo'",$link);
$tot=mysql_fetch_array($result3);
$total=$tot['total'];
$total=str_replace(".","",$total);
while (strlen($total)<20)//completar los 20 ceros
		{
		$total='0'.$total;
		}
$data="\n$fecha/$num/$total";
while ($montos=mysql_fetch_array($result2))
	{
	$ced=$montos['cedula'];
	$monto=$montos['monto_incidencia'];
	$cuenta=$montos['numero_cuenta'];
	$data=$data.generar_fila_archivo($cuenta,$monto,$cont);
	$cont++;
	}

//armar el textarea con los datos
$datos=$_POST['newdata'];
$nombre=$_GET['nombre'];
$nomb=$_POST['nomb'];

if (isset($_POST['descargar']))
	{
	if(@$fp = fopen($nomb, "w"))
			  {
			  fwrite($fp, stripslashes($datos));
			  fclose($fp);
			  } 
			  else 
			  {
			  exit ("<h1>Error</h1>\n<p>No se puede escribir el archivo, asegurate que los permisos son correctos(CHMOD 777).</p>");
			  }
	echo '<script languaje="Javascript">location.href="descargar.php?f='.$nomb.'"</script>';
	}?>
<table width="600" border="1" align="center">
  <tr>
    <td align="center"><form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <fieldset>
      <legend>Editar <?php echo $nombre ?></legend>
        <label>Contenido <strong><?php echo $nombre ?></strong>:
          <input name="nomb" type="hidden" id="nomb" value="<?php if ($_GET['nombre']<>'') echo $_GET['nombre']; else echo $_POST['nomb'];?>">
      <br>
          <textarea name="newdata" rows="30" cols="100"><?php
   echo $data;
  ?>
    </textarea>
      </label>
        <input type="submit" name="descargar" id="descargar" value="Descargar">
         <input type="submit" name="volver" id="volver" value="Volver">
         <br>
      <label></label>
      </fieldset>
    </form></td>
  </tr>
</table>
</body>
</html>