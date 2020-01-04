<?php
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Geraldo Marcano.
  Descripción General:  Modifica una Descripción de Presupuesto.
  		Modificado el: 	Geraldo Marcano. - Creación.
						11/11/2008 por Pedro E. Arrioja M. - Adaptación a bases de datos de intranet y plantillas, se cambio el metodo get a post y 
								   se eliminaron códigos de validación en java que ya no aplican; además se añadió la comprobación de que el código que
								   se este incluyendo no exista.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 $link=conectarse("administracion"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Intranet CENE</title>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(../imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->


<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="../imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="../imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="../imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="../imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="../imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="../imgs/CENE_07.png">      <div align="right">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="vinculos"><div align="left">Usuario: <?php if (isset($_SESSION['nombres'])) { echo $_SESSION['apellidos']." ".$_SESSION['nombres']; } else {echo " Sin sesi&oacute;n iniciada";}?></div></td>
            <td><div align="right"><span class="vinculos"><a href="index.php" class="vinculos">Inicio</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="login.php" class="vinculos">Salir</a>&nbsp;&nbsp;</span></div></td>
          </tr>
        </table>
        </div></td>
  </tr>
  <tr>
    <td valign="top"><!-- InstanceBeginEditable name="menu_izquierda" --><!-- InstanceEndEditable -->    </td>
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" -->      </br>
      <br />
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr class="encabezado_formularios">
    <td>Seleccione el c&oacute;digo presupuestario para modificar su descripci&oacute;n</td>
  </tr>
  <tr>
    <td>
 <form action='modifica_descripcion_ppto.php' method='get'>
<div align="center">
<span class="datos_formularios">
<select name="select1" id="select" onchange="submit()">
<option>A&ntilde;o</option>
<?php
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
<select name="select2" id="select2" onchange="submit()">
<?php
echo "<option value=''>Partida</option>";
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
<select name="select3" id="select3" onchange="submit()">
<?php
echo "<option value=''>Generica</option>";
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
<select name="select4" id="select4" onchange="submit()">
<?php
echo "<option value=''>Especifica</option>";
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
<select name="select5" id="select5" onchange="submit()">
<?php
echo "<option value=''>Subespecifica</option>";
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
</span>
</div>
</form>   
    
    
    </td>
  </tr>
</table>

<?php
//busca los datos de las variables en la db
$sql="select * from descripcion_presupuesto where(ano='".$_GET['select1']."' and partida='".$_GET['select2']."' and generica='".$_GET['select3']."' and especifica='".$_GET['select4']."' and subespecifica='".$_GET['select5']."')";
//echo "$sql";
$ejecutar=mysql_query($sql);
$resultado=mysql_fetch_array($ejecutar);
$id=$resultado[0];//el numero 0 indica el campo id de la tabla */
$descripcion=$resultado[6];//el numero 6 indica el campo descripcion de la tabla */
?>
<br />
<form action='modifica_descripcion_ppto.php'method='get'>
<table width="523" border='1' align='center' cellpadding="0" cellspacing="0">
<tr>
<td width="123" class="titulos_formularios">id:</td>
<td width="394" colspan="6" class="datos_formularios"><?php echo "<input type='text' name='text1' size='5' value='$id' readonly>";?></td>
</tr>
<tr class="datos_formularios">
  <td class="titulos_formularios"><span class="encabezado_formularios">Año:</span></td>
  <td colspan="6"><?php echo "<input type='text' name='text2' size='5' value='".$_GET['select1']."'>";?></td>
  </tr>
<tr class="datos_formularios">
  <td class="titulos_formularios"><span class="encabezado_formularios">Partida:</span></td>
  <td colspan="6"><?php echo "<input type='text' name='text3' size='5' value='".$_GET['select2']."'>";?>
    <label></label></td>
  </tr>
<tr class="datos_formularios">
  <td class="titulos_formularios"><span class="encabezado_formularios">Generica:</span></td>
  <td colspan="6"><?php echo "<input type='text'name='text4' size='4' value='".$_GET['select3']."'>";?></td>
  </tr>
<tr class="datos_formularios">
  <td class="titulos_formularios"><span class="encabezado_formularios">Especifica:</span></td>
  <td colspan="6"><?php echo "<input type='text'name='text5' size='4' value='".$_GET['select4']."'>";?></td>
  </tr>
<tr class="datos_formularios">
  <td class="titulos_formularios"><span class="encabezado_formularios">Subespecifica:</span></td>
  <td colspan="6"><?php echo "<input type='text'name='text6' size='4' value='".$_GET['select5']."'>";?></td>
  </tr>
<tr class="datos_formularios">
  <td class="titulos_formularios"><span class="encabezado_formularios">Descripci&oacute;n:</span></td>
  <td colspan="6"><?php echo "<input type='text'name='text7' size='70' value='$descripcion'>";?></td>
  </tr>
<tr class="datos_formularios">
<td colspan="7">&nbsp;</td>
</tr>
<tr>
<td colspan="7">
  <div align="right">
    <input type='submit' value='Modificar' />
    <input type='reset' />
    <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php?sis=<?php echo $_SESSION['sis']; ?>'" />
  </div></td>
</tr>
</table>
</form>
<?php
//realiza la consulta de modificacion
$modificar="update descripcion_presupuesto
set ano='".$_GET['text2']."', partida='".$_GET['text3']."', generica='".$_GET['text4']."', especifica='".$_GET['text5']."', subespecifica='".$_GET['text6']."', descripcion='".$_GET['text7']."'
where id='".$_GET['text1']."' ";
$result_modificar=mysql_query($modificar) or die(mysql_error());
/*fin de consulta modificacion*/
?>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 13 November, 2008 8:30 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>