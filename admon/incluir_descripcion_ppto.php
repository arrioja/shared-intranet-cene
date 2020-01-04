<?php
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Geraldo Marcano.
  Descripción General:  Incluir una nueva Descripción de código presupuestario en la base de datos.
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


<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" -->
<!--//captura de datos-->
<form action='incluir_descripcion_ppto.php' method='post'>
       <br />
       <table width="461" border='1' align='center' cellpadding="0" cellspacing="0">
        <tr>
         <td width="123" class="titulos_formularios">Año</td>
         <td width="332">
         <select name="select1" id="select1">
          <?php
		   $topeano=date("Y");
           for($i=2008;$i<=$topeano;$i=$i+1){ 
		    if ($i<10){$i="0".$i;}?>
             <option value="<?php echo $i; ?>" <?php if($topeano==$i){ echo "selected='selected'"; }?>><?php echo $i; ?></option>
          <?php }?>
        </select>         </td>
        </tr>
        <tr>
         <td class="titulos_formularios">Partida</td>
         <td>
         <select name="select2" id="select2">
         <option value="401" selected="selected">401</option>
         <option value="402">402</option>
         <option value="403">403</option>
         <option value="404">404</option>
         <option value="407">407</option>
         </select>         </td>
        </tr>
        <tr>
         <td class="titulos_formularios">Generica</td>
         <td>
         <select name="select3" id="select3">
         <?php
		  $topegenerica="99";
          for($i=0;$i<=$topegenerica;$i=$i+1){ 
		   if ($i<10){$i="0".$i;}?>
            <option value="<?php echo $i; ?>" <?php if($i == '00'){ echo "selected='selected'"; }?>><?php echo $i; ?></option>
         <?php }?>
         </select>         </td>
        </tr>
        <tr>
         <td class="titulos_formularios">Especifica</td>
         <td>
         <select name="select4" id="select4">
         <?php
		  $topeespecifica="99";
          for($i=0;$i<=$topeespecifica;$i=$i+1){ 
		   if ($i<10){$i="0".$i;}?>
            <option value="<?php echo $i; ?>" <?php if($i == '00'){ echo "selected='selected'"; }?>><?php echo $i; ?></option>
         <?php }?>
         </select>         </td>
        </tr>
        <tr>
         <td class="titulos_formularios">Subespecifica</td>
         <td>
         <select name="select5" id="select5">
         <?php
		  $topesubespecifica="99";
          for($i=0;$i<=$topesubespecifica;$i=$i+1){ 
		   if ($i<10){$i="0".$i;}?>
            <option value="<?php echo $i; ?>" <?php if($i == '00'){ echo "selected='selected'"; }?>><?php echo $i; ?></option>
         <?php }?>
         </select>         </td>
        </tr>
        <tr>
         <td class="titulos_formularios">Descripcion</td>
         <td><span id="sprytextfield1">
           <label>
           <input name="descripcion" type="text" id="descripcion" size="50" />
           </label>
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
        </tr>
        <tr>
         <td colspan="2"><div align="right">
           <input name="incluir" type='submit' id="incluir" value="Incluir" />
           &nbsp;&nbsp;           
           <input name="borrar" type='reset' id="borrar" value="Limpiar" />
           <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php?sis=<?php echo $_SESSION['sis']; ?>'" />
         </div></td>
        </tr>
       </table>
</form>
<div align="center">
  <?php
//añadir a la db
if(($_POST['descripcion']!='') and ($_POST['incluir']=='Incluir'))
{
  $consulta=mysql_query("select * 
  			 from descripcion_presupuesto 
			 where ((ano = '".$_POST['select1']."') and (partida = '".$_POST['select2']."') and (generica='".$_POST['select3']."') and            
			        (especifica = '".$_POST['select4']."') and (subespecifica='".$_POST['select5']."'))") or die(mysql_error()); 
  if (mysql_num_rows($consulta) == 0)
  { 
    $consulta="insert into descripcion_presupuesto(ano, partida, generica, especifica, subespecifica, descripcion)values('".$_POST['select1']."', '".$_POST['select2']."', '".$_POST['select3']."', '".$_POST['select4']."', '".$_POST['select5']."', '".$_POST['descripcion']."' )";
    $resultado=mysql_query($consulta) or die(mysql_error());   	   	
    if($result==false)
      {
         echo "La nueva descripci&oacute;n de presupuesto se ha a&ntilde;adido correctamente";
      }
    else
     {
        echo "Error";
     }
   }
  else
    {
      echo "El C&oacute;digo presupuestario para esta descripci&oacute;n ya existe";
	}
}
/************************************************************************fin de añadir a la db*/
?>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
//-->
</script>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 13 November, 2008 8:29 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>