<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra una forma en la que se complementan los datos de la solicitud de vacaciones; el listado de vacaciones disponibles
  						se genera dependiendo de la cédula que el usuario haya introducido, de la misma manera, el mávimo número de días que
						puede pedir de vacaciones se restringe al número de día hábiles que tenga disponible ese funcionario.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						03/11/2008 por Pedro E. Arrioja M. - Se incluye una variable oculta total_dias, que se usa para comprobar si el funcionario tiene
															 suficientes dias para un descuento (si le es aplicable).
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
  session_start();
  include("../db/conexion.php");
  $link=conectarse("organizacion");
  $link=conectarse("asistencias");
  $cedula=$_POST['cedula'];
  
  $consulta_integrantes=mysql_query("select p.id, p.cedula, p.nombres, p.apellidos from organizacion.personas as p where p.cedula='$cedula'",$link) or die(mysql_error()); 
  $resultado_integrantes=mysql_fetch_array($consulta_integrantes);	
  
  $consulta_vacaciones=mysql_query("select * from asistencias.vacaciones as v
                                    where((v.cedula='$cedula') and 
									(v.pendientes>'0')) 
									order by v.disponible_desde",$link) or die(mysql_error());
   $cuenta_vacaciones=mysql_num_rows($consulta_vacaciones);
   $lineas=1;
   
   $sumatoria_vacaciones=mysql_query("select sum(v.pendientes) as sumatoria from asistencias.vacaciones as v
                                    where((v.cedula='$cedula') and 
									(v.pendientes>'0')) 
									order by v.disponible_desde",$link) or die(mysql_error());
   $resultado_sumatoria=mysql_fetch_array($sumatoria_vacaciones); 
   $total_dias=$resultado_sumatoria['sumatoria']; 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Solicitud de Vacaci&oacute;n</title>
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
<script type="text/javascript" src="../libs/calendar/calendar.js"></script>
<script type="text/javascript" src="../libs/calendar/calendar-setup.js"></script>
<script type="text/javascript" src="../libs/calendar/lang/calendar-es.js"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<style type="text/css"> @import url("../css/calendar-win2k-cold-1.css"); </style>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
.Estilo2 {font-weight: bold}
-->
</style>
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
 <?php 
	if (mysql_num_rows($consulta_integrantes) == 0)// la consulta no tiene resultados, por lo tanto la cedula no existe en nomina
  		{
			?>                     
			 <br />
      <br />
<table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr class="encabezado_formularios">
                  <td width="500"><span class="Estilo2 Estilo1">ERROR al procesar dato</span></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="justify"><strong><br />
                  La C&eacute;dula: <?php echo $cedula ?> no pertenece a ning&uacute;n funcionario</strong> registrado en el sistema.
                  <br />
                  <br /> 
                  </div></td>
                </tr>
                <tr>
                  <td class="datos_formularios"> <div align="center">
                    <?php 
			echo " Para volver haga click "?> 
                    <a href="incluir_vacacion_cedula.php">aqui</a> </div></td></tr>
              </table>                 
             
             <br />

             <?php
		}
	else
		{ // La cédula si existe
              ?> 

<form id="form1" name="form1" method="post" action="db/inserta_solicitud_vacacion.php">
  <br />
  <table width="594" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="7" class="encabezado_formularios">Solicitud de Vacaciones</td>
    </tr>
    <tr>
      <td width="143" class="titulos_formularios">C&eacute;dula:</td>
      <td colspan="6" class="datos_formularios">&nbsp;<?php 
	    echo $resultado_integrantes['cedula'];  ?>
        <input name="cedula" type="hidden" id="cedula" value="<?php echo $resultado_integrantes['cedula']; ?>" /></td>
    </tr>
    <tr>
      <td class="titulos_formularios">Nombre:</td>
      <td colspan="6" class="datos_formularios">&nbsp;<?php 
	   echo $resultado_integrantes['apellidos'].' '.$resultado_integrantes['nombres'];?></td>
    </tr> 
   
    <?php while($datos_periodos[$lineas]=mysql_fetch_array($consulta_vacaciones)) 
	{ 	
	?>  
      <tr>
      <?php if ($lineas==1) // para que funcione el rowspan y tengan un solo titulo
	  {  ?>    
        <td rowspan="<?php echo $cuenta_vacaciones;?>" class="titulos_formularios" >Disponibles:</td> 
	  <?php 
	  }?>
      <td class="datos_formularios"><strong>&nbsp;Per&iacute;odo:</strong></td>
      <td width="96" class="datos_formularios"><div align="center">
        <?php echo $datos_periodos[$lineas]['periodo']; ?></div></td>
      <td width="81" class="datos_formularios"><strong> &nbsp;D&iacute;as Disp.:</strong></td>
      <td width="43" class="datos_formularios"><div align="center">
        <?php echo $datos_periodos[$lineas]['pendientes']; ?></div></td> 
      <td width="54" class="datos_formularios"><strong>Desde:</strong></td>
      <td width="101" class="datos_formularios">&nbsp;<?php echo date("d/m/Y",strtotime($datos_periodos[$lineas]['disponible_desde']));
  
	  ?></td>
    </tr>
    <?php $lineas++;}?>     

    <tr>
    
      <td class="titulos_formularios">Desde:</td>
      <td width="60" class="datos_formularios">Fecha:</td>
      <td colspan="5" class="datos_formularios"><span id="sprytextfield1">
        <input name="fecha_desde" type="text" id="fecha_desde" value="<?php echo date("d/m/Y",strtotime("+1 day"));?>" size="13" maxlength="10" />
        <img src="../imgs/jscalendar.gif" name="f_trigger_c" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
        <script type="text/javascript">
            Calendar.setup({
              inputField    : "fecha_desde",
              button        : "f_trigger_c",
              align         : "Tr",
			  ifFormat    	: "%d/%m/%Y"
            });
          </script>
        <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios">N&uacute;m. de D&iacute;as:</td>
      <td colspan="6" class="datos_formularios"><select name="dias" id="dias">
          <?php for ($x=1;$x<=$total_dias;$x++) { ?>
          <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
          <?php }?>
        </select> 
        * Recuerde, son &quot;D&iacute;as h&aacute;biles&quot;.</td>
    </tr>
    <tr>
      <td class="titulos_formularios">Observaciones:</td>
      <td colspan="6" class="datos_formularios"><textarea name="observaciones" id="observaciones" cols="50" rows="5"></textarea></td>
    </tr>
    <tr><?php 
	
	      function implode_r ($glue, $pieces){ 
      $out = ""; 
      foreach ($pieces as $piece) 
      if (is_array ($piece)) $out .= implode_r ($glue, $piece); // recurse 
      else $out .= $glue.$piece;   
      return $out; 
      } 
 
      $arreglo=implode_r ( ';', $datos_periodos);
	
	?>
      <td>&nbsp;</td>
      <td colspan="6"><input name="total_dias" type="hidden" id="total_dias" value="<?php echo $total_dias;?>" />
      <input name="cuenta_vacaciones" type="hidden" id="cuenta_vacaciones" value="<?php echo $cuenta_vacaciones; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><div align="right">
        <input type="submit" name="Incluir" id="Incluir" value="Realizar Solicitud" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="volver" id="volver" value="Cancelar" onclick="javascript: location.href='index.php'" />
      </div></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", validateOn:["blur"]});
//-->
  </script>
  
  <?php } // fin del si la cedula existe ?>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Monday, 3 November, 2008 12:23 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
