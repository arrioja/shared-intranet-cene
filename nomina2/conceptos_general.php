<?php 
/** 
* Asignacion multiple de conceptos a un grupo de integrantes de la nomina
* @versión:       @modificado: 
* @autor: capepo
*
*/

session_start();
require 'includes/miclase.php';
$link=conectarse("nomina");	
$cod=$_GET['cod'];

$res_concept=mysql_query("select * from conceptos where cod='$cod'",$link);
$concept=mysql_fetch_array($res_const);
	


if (isset($_POST['atodos']))//agregar todos hacia la derecha
{
$re=mysql_query('select * from integrantes_temporal',$link);
while ($todos=mysql_fetch_array($re))//carga los integrantes de la tabla izquierda
		{
		$ced=$todos['cedula'];
		$nomb=$todos['nombres'];
		$ape=$todos['apellidos'];
		$consulta = "INSERT INTO integrantes_temporal2 (cedula, nombres, apellidos) VALUES('$ced','$nomb','$ape')";
		mysql_query($consulta,$link) or die(mysql_error());
		}	
mysql_query('truncate integrantes_temporal');		
}

/*if (isset($_POST['qtodos']))//agregar todos hacia la izquierda
{
$re=mysql_query('select * from integrantes_temporal2',$link);
while ($todos=mysql_fetch_array($re))//carga los integrantes de la tabla izquierda
		{
		$ced=$todos['cedula'];
		$nomb=$todos['nombres'];
		$ape=$todos['apellidos'];
		$consulta = "INSERT INTO integrantes_temporal (cedula, nombres, apellidos) VALUES('$ced','$nomb','$ape')";
		mysql_query($consulta,$link) or die(mysql_error());
		}	
mysql_query('truncate integrantes_temporal2',$link);		
}*/
//si ya metio los datos por primera vez solo los muestra
if (isset($_POST['agregar'])) //si agrego algun integrante
	{
	if ($_GET['add']!='') //si esta agregando y si manda un valor	(cedula)
		{ 
		$add=$_GET['add'];		
		mysql_query("insert into integrantes_conceptos (cedula,cod_concepto) values('$add','$cod')",$link);//inserta a la derecha
		}
	}
if (isset($_POST['quitar'])) //si quito algun integrante
	{
	if ($_GET['rem']!='') //si esta agregando y si manda un valor	(cedula)
		{ 
		$rem=$_GET['rem'];
		mysql_query("delete from integrantes_constantes where cedula='$rem' and cod_concepto='$cod'",$link);//borra la derecha
		}
	}	


$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on p.cedula=i.cedula where i.cedula not in (select cedula from integrantes_conceptos where cod_concepto='$cod') and i.status>0",$link);//datos de todos los integrantes no tienen asignada el concepto actual	

$result2=mysql_query("select p.nombres, p.apellidos, i.cedula from nomina.integrantes i inner join organizacion.personas p on p.cedula=i.cedula inner join integrantes_conceptos ic on (ic.cedula=i.cedula) where ic.cod_concepto='$cod' and i.status>0",$link);//datos de todos los integrantes no tienen asignada el concepto actual	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asignacion General de Conceptos</title>

<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	left:21px;
	top:71px;
	width:350px;
	height:443px;
	z-index:1;
}
#apDiv2 {
	position:absolute;
	left:479px;
	top:68px;
	width:350px;
	height:445px;
	z-index:2;
}
#apDiv3 {	position:absolute;
	left:22px;
	top:29px;
	width:246px;
	height:443px;
	z-index:1;
}
#apDiv4 {
	position:absolute;
	left:388px;
	top:278px;
	width:75px;
	height:91px;
	z-index:3;
}
#apDiv5 {
	position:absolute;
	left:242px;
	top:5px;
	width:397px;
	height:55px;
	z-index:4;
}
-->
</style>
</head>

<body>
<div id="apDiv1" title="No Asignados">
<label>
<div align="center"><strong>Integrantes no Asignados</strong></div>
<table width="101%" border="1">
    <tr>
      <td width="116"><strong>Nombres</strong></td>
      <td width="106"><strong>Apellidos</strong></td>
      <td width="52"><strong>Cedula</strong></td>
      <td width="52"><strong>Accion</strong></td>
    </tr>
    <?php $tot_izq=0;;	

	 while ($integrantes=mysql_fetch_array($result)){?>
    <tr>
      <td><?php echo $integrantes['nombres']; ++$tot_izq;?></td>
      <td><?php echo $integrantes['apellidos'];?></td>
      <td><?php echo $integrantes['cedula']; $ced=$integrantes['cedula'];?></td>
      <td><form id="form1" name="form1" method="post" action="conceptos_general.php?cod=<?php echo $cod;?>&add=<?php echo $ced;?>">
        <input type="submit" name="agregar" id="<?php $integrantes['cedula'];?>" value="+" />
      </form>      </td>
    </tr>
    <?php }echo $tot_izq?>
  </table>
</div>
<div id="apDiv2">
<label>
<div align="center"><strong>Integrantes Asignados</strong></div>
</label>
  <table width="101%" border="1">
    <tr>
      <td width="104"><strong>Nombres</strong></td>
      <td width="112"><strong>Apellidos</strong></td>
      <td width="65"><strong>Cedula</strong></td>
      <td width="45"><strong>Accion</strong></td>
    </tr>        
    <?php $tot_der=0; while ($integrantes2=mysql_fetch_array($result2)){?>
    <tr>
      <td><?php echo $integrantes2['nombres'];++$tot_der;?></td>
      <td><?php echo $integrantes2['apellidos'];?></td>
      <td><?php echo $integrantes2['cedula'];$ced=$integrantes2['cedula'];?></td>
      <td><form id="form2" name="form2" method="post" action="conceptos_general.php?cod=<?php echo $cod;?>&rem=<?php echo $ced;?>">
        <input type="submit" name="quitar" id="quitar" value="-" />
      </form>
      </td>
    </tr>
    <?php } echo $tot_der;?>
  </table>
</div>
<div id="apDiv4">
  <table width="100%" border="1">
    
    <tr>
      <td><form id="form4" name="form4" method="post" action="">
        <input type="submit" name="atodos" id="atodos" value="+ Todos" />
            </form>      </td>
    </tr>
    
    <tr>
      <td><a href="constantes.php"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='conceptos.php'" />
      </span></a><a href="conceptos.php"></a></td>
    </tr>
  </table>
</div>
<div id="apDiv5">
  <table width="100%" border="1">
    <tr>
      <td width="40%"><strong>Concepto a Asignar</strong></td>
      <td width="60%"><input name="descripcion" type="text" id="descripcion" size="35" value="<?php echo $concept['descripcion'];?>" /></td>
    </tr>
    <tr>
      <td><strong>Formula</strong></td>
      <td><input name="abreviatura" type="text" id="abreviatura" size="30" value="<?php echo $concept['formula'];?>" /></td>
    </tr>
  </table>
</div>
</body>
</html>