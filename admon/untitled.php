<?php
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Geraldo Marcano.
  Descripción General:  Elimina una Descripción de Presupuesto.
  		Modificado el: 	Geraldo Marcano. - Creación.
						13/11/2008 por Pedro E. Arrioja M. - Adaptación a bases de datos de intranet y plantillas, se cambio el metodo get a post y 
								   se eliminaron códigos de validación en java que ya no aplican; y se dividió el archivo para mejor comprension y uso de
								   AJAX.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 $link=conectarse("administracion"); 
 $sqlpresupuesto="select * from presupuesto";
 $sql="select * from descripcion_presupuesto";
 $ejecutar=mysql_query($sql);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Eliminar Descripcion Presupuesto</title>
<link href="../css/index.css" rel="stylesheet" type="text/css">
<link href="../css/formularios.css" rel="stylesheet" type="text/css">

 <SCRIPT language="JavaScript">
<!--
function cargar_contenido(target,valor,func)
{
  var peticion;
  document.getElementById(target).innerHTML = 'Cargando Datos...';
  anio = document.getElementById("ano").value;
  var myConn = new XHConn();
  if (!myConn) alert("XMLHTTP no esta disponible. Inténtalo con un navegador mas nuevo.");
  peticion=function(oXML){document.getElementById(target).innerHTML=oXML.responseText;};
  myConn.connect("db/detalle_descripcion_ppto.php", "POST", "valor="+valor+"&func="+func+"&anio="+anio, peticion);
}
//-->
</SCRIPT>
<script language="JavaScript" src="../libs/XHConn.js"></script>


</head>
<body>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr class="encabezado_formularios">
    <td>Seleccione el c&oacute;digo presupuestario para modificar su descripci&oacute;n</td>
  </tr>
  <tr class="datos_formularios">
    <td>&nbsp;</td>
  </tr>
</table>




<form name='form1' method='get' action='eliminar_descripcion_ppto.php'>
<div align="center">  
<select name="select1" id="select" onChange="submit()">
<option>A&ntilde;o</option>
<?php   echo '<table width="100%" border="1" cellspacing="0" cellpadding="0">';
//busca en la tabla presupuesto
$sqlpresupuesto=$sqlpresupuesto." where ano='".$_GET['select1']."'";
$ejecutarpresupuesto=mysql_query($sqlpresupuesto);
//fin buscar en tabla presupuesto
$sqlselect="select distinct ano from descripcion_presupuesto order by ano";
$ejecutarselect=mysql_query($sqlselect);
while($resultadoselect=mysql_fetch_array($ejecutarselect))
{
echo '<option value="'.$resultadoselect['ano'].'"'; if($_GET['select1']==$resultadoselect['ano']){echo "selected";}echo'>'.$resultadoselect['ano'].'</option>';
}
$consultaselect=$consultaselect." where ano='".$_GET['select1']."'";
$sqlselect="";
$ejecutarselect="";
$resultadoselect="";
?>
</select>
<!-- ******************************************************************************************** -->
<select name="select2" id="select2" onChange="submit()">
<?php
echo "<option value=''>Partida</option>";
//busca en la tabla presupuesto
$sqlpresupuesto=$sqlpresupuesto." and partida='".$_GET['select2']."'";
$ejecutarpresupuesto=mysql_query($sqlpresupuesto);
//fin buscar en tabla presupuesto
$sqlselect="select distinct partida from descripcion_presupuesto where(ano=".$_GET['select1'].") order by partida";
$ejecutarselect=mysql_query($sqlselect);
while($resultadoselect=mysql_fetch_array($ejecutarselect))
{
echo '<option value="'.$resultadoselect['partida'].'"'; if($_GET['select2']==$resultadoselect['partida']){echo "selected";}echo'>'.$resultadoselect['partida'].'</option>';
}
if($_GET['select2'])
{
$consultaselect=$consultaselect." and partida='".$_GET['select2']."'";
}
?>
</select>
<!-- ******************************************************************************************** -->
<select name="select3" id="select3" onChange="submit()">
<?php
echo "<option value=''>Generica</option>";
//busca en la tabla presupuesto
$sqlpresupuesto=$sqlpresupuesto." and generica='".$_GET['select3']."'";
$ejecutarpresupuesto=mysql_query($sqlpresupuesto);
//fin buscar en tabla presupuesto
$sqlselect="SELECT distinct generica FROM descripcion_presupuesto where(ano=".$_GET['select1']." and partida=".$_GET['select2'].") order by generica";
$ejecutarselect=mysql_query($sqlselect);
while($resultadoselect=mysql_fetch_array($ejecutarselect))
{
echo '<option value="'.$resultadoselect['generica'].'"'; if($_GET['select3']==$resultadoselect['generica']){echo "selected";}echo'>'.$resultadoselect['generica'].'</option>';
}
if($_GET['select3'])
{
$consultaselect=$consultaselect." and generica='".$_GET['select3']."'";
}
$sqlselect="";
$ejecutarselect="";
$resultadoselect="";
?>
</select>
<!-- ******************************************************************************************** -->
<select name="select4" id="select4" onChange="submit()">
<?php
echo "<option value=''>Especifica</option>";
//busca en la tabla presupuesto
$sqlpresupuesto=$sqlpresupuesto." and especifica='".$_GET['select4']."'";
$ejecutarpresupuesto=mysql_query($sqlpresupuesto);
//fin buscar en tabla presupuesto
$sqlselect="SELECT distinct especifica FROM descripcion_presupuesto where(ano=".$_GET['select1']." and partida=".$_GET['select2']." and generica=".$_GET['select3'].") order by especifica";
$ejecutarselect=mysql_query($sqlselect);
while($resultadoselect=mysql_fetch_array($ejecutarselect))
{
echo '<option value="'.$resultadoselect['especifica'].'"'; if($_GET['select4']==$resultadoselect['especifica']){echo "selected";}echo'>'.$resultadoselect['especifica'].'</option>';
}
if($_GET['select4'])
{
$consultaselect=$consultaselect." and especifica='".$_GET['select4']."'";
}
$sqlselect="";
$ejecutarselect="";
$resultadoselect="";
?>
</select>
<!-- ******************************************************************************************** -->
<select name="select5" id="select5" onChange="submit()">
<?php
echo "<option value=''>Subespecifica</option>";
//busca en la tabla presupuesto
$sqlpresupuesto=$sqlpresupuesto." and subespecifica='".$_GET['select5']."'";
$ejecutarpresupuesto=mysql_query($sqlpresupuesto);
//fin buscar en tabla presupuesto
$sqlselect="SELECT distinct subespecifica FROM descripcion_presupuesto where(ano=".$_GET['select1']." and partida=".$_GET['select2']." and generica=".$_GET['select3']." and especifica=".$_GET['select4'].") order by subespecifica";
$ejecutarselect=mysql_query($sqlselect);
while($resultadoselect=mysql_fetch_array($ejecutarselect))
{
echo '<option value="'.$resultadoselect['subespecifica'].'"'; if($_GET['select5']==$resultadoselect['subespecifica']){echo "selected";}echo'>'.$resultadoselect['subespecifica'].'</option>';
}
if($_GET['select5'])
{
$consultaselect=$consultaselect." and subespecifica='".$_GET['select5']."'";
}
$sqlselect="";
$ejecutarselect="";
$resultadoselect="";
?>
</select>
<!-- ******************************************************************************************** -->
<hr width="50%">
<?php
if(mysql_affected_rows()>0)
{

}
else
{
}
//echo $consultaselect;
echo "<br>";
$sql=$sql.$consultaselect;
//echo $sql;
$ejecutar=mysql_query($sql);
while($resultado = mysql_fetch_array($ejecutar))
{
for ($i=1;$i<7;$i++)//para mostrar el campo id poner en 0 a $i
{
echo "<td>",$resultado[$i],"</td>";
}
echo "<td align=center> <input type=checkbox name=borra[$resultado[0]] value='Si'></td><tr>";
}
//mysql_close($conexion)
?>
</div>
<td colspan=8 align=center><input name="button1" type=submit id="button1" value='Eliminar'>
&nbsp;<input name="button2" type=reset id="button2" value='Limpiar'>
</form>
</table>
<?php
if(empty($borra))
{
echo "<p><center>Seleccione al menos un registro<center><p>";
}
else
{
foreach ($borra as $indice=>$valor)
{
//mysql_query("delete from descripcion_presupuesto where (id=$indice)",$conexion);
$sql="delete from descripcion_presupuesto where (id=$indice)";
$ejecutar=mysql_query($sql);
}
}
?>
