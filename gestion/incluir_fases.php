<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
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
<?php 
include "../db/conexion.php";
$link=conectarse("gestion");

$cod=$_GET['codigo_actividad'];
$consulta="select a.id,a.nombre, po.codigo, po.nombre,d.codigo, d.nombre_completo,o.codigo, o.nombre from gestion.gestion_actividades a inner join gestion.gestion_planes_operativos po on (a.cod_plan_operativo=po.codigo) inner join organizacion.direcciones d on (d.codigo=po.cod_direccion) inner join organizacion.organizaciones o on (d.codigo_organizacion=o.codigo)  where a.id='$cod'";

//$result=mysql_query("select * from gestion.gestion_fases WHERE cod_actividad=$_GET[seleccionado] order by id",$link);
$result=mysql_query($consulta,$link);
$row=mysql_fetch_array($result);
?>
<SCRIPT SRC="javascript/java.js"> </SCRIPT> 
<script>
function desactivar(boton)
{
boton.disabled='disabled';
}
</script>


<script language="javascript" type="text/javascript">

function mostrar_fases()
{ 
      ajax=nuevoAjax();
	  ajax.open("GET", "select/select_total.php?seleccionado="+document.form1.cod_actividad.value+"&select=18", true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
		 {
            document.getElementById("fase").innerHTML="Cargando....";
		 }	
         
         if (ajax.readyState==4)
         {
            document.getElementById("fase").innerHTML=ajax.responseText;
         }
      }
      ajax.send(null);
}


function muestra_fases()
{
	  ajax=nuevoAjax();
	   ajax.open("GET", "muestra_fases.php?seleccionado="+document.form1.cod_actividad.value, true);
      
	  ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
           document.getElementById("fases").innerHTML="Cargando...";
          		  
         if (ajax.readyState==4)
		 {
            document.getElementById("fases").innerHTML=ajax.responseText;
			carga_fase();
         }
	 }
      ajax.send(null);
 }

function confirma_eliminar(cod_fase,fase)
{
if (confirm("Se dispone a eliminar la Fase: "+fase+". ¿Desea continuar?"))
   elimina_fase(cod_fase);
}
 
</script>



<!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="../libs/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <!-- main calendar program -->
  <script type="text/javascript" src="../libs/calendar/calendar.js"></script>
  <!-- language for the calendar -->
  <script type="text/javascript" src="../libs/calendar/lang/calendar-es.js"></script>
  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="../libs/calendar/calendar-setup.js"></script>


<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />


<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
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


<form id="f1" name="form1" method="post" action="inserta_fase.php">
  <table width="675" border="1" align="center" cellpadding="2" cellspacing="0">
    <tr bgcolor="#FFFFFF" class="encabezado_formularios">
      <td colspan="3"><div align="center" class="style3"><strong>Registro de Fases</strong>          
          <input name="insertar" type="hidden" id="insertar" value="1" />
          <?php //include "genera_codigo_fase.php";?>
      </div></td>
    </tr>
    <tr>
      <td width="155" class="titulos_formularios"><strong>Organizaci&oacute;n</strong></td>
      <td class="datos_formularios"><label>
        <input name="select" type="text"  disabled="disabled" id="select" value="<?php echo $row[7];?>" size="50"/>
      </label></td>
    </tr>
    <tr>
      <td align="center" class="titulos_formularios" id=> <strong>Direcci&oacute;n</strong></td>
      <td align="" class="datos_formularios" id="cod"> <div align="justify"><label></label>
          <label>
          
          <input name="select2" type="text"  disabled="disabled" id="select2" value="<?php echo $row[5];?>" size="50"/>
          </label>
      </div> </td>
    </tr>
    <tr>
      <td align="center" class="titulos_formularios" id=> <strong>Plan Operativo</strong></td>
      <td align="" class="datos_formularios" id="plan_operativo"> <div align="justify"><label></label>
     
          
          
          <label>
          
         
          <input name="select3" type="text"  disabled="disabled" id="select3" value="<?php echo $row[3];?>" size="50"/>
          </label>
      </div>      </td>
      </tr>
    <tr>
      <td class="titulos_formularios"><strong>Actividad</strong></td>
      <td width="506" class="datos_formularios"><span id="sprytextfield1">
        <label>
        
      
        
        <input name="actividad" type="text" disabled="disabled" id="actividad" value="<?php echo $row[1];?>" size="50" />
        </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span>
      <input name="cod_actividad" type="hidden" id="cod_actividad" value="<?php echo $row[0];?>" /></td>
      
>    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Nombre de la Fase</strong></td>
      <td class="datos_formularios"><span id="sprytextfield2">
        <label>
        <input name="nombre" type="text" id="nombre" size="50" />
        </label>
      <span class="textfieldRequiredMsg">Se requiere un Nombre</span></span></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Fecha de Inicio</strong></td>
      <td class="datos_formularios" id="objetivo"><label>
        <input  name="fecha_inicio" type="text" id="fecha_inicio" size="15" />
        <img src="../imgs/img.gif" alt="cal" name="f_trigger_c" width="20" height="20" border="0" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></label></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Duraci&oacute;n (D&iacute;as)</strong></td>
      <td class="datos_formularios" id="objetivo2"><span id="sprytextfield3">
      <label>
      <input name="duracion" type="text" id="duracion" size="15" />
      </label>
      <span class="textfieldRequiredMsg">Se requiere un valor</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></td>
    </tr>
    <tr>
      <td height="25" class="titulos_formularios"><strong>Precedencia  de la Fase</strong></td>
      <td class="datos_formularios" id="fase"><label>
        <input type="button" name="fases2" id="fases2" value="Ver Fases" onclick="mostrar_fases()" />
      </label></td>
    </tr>
    <tr>
      <td colspan="3" id="ficha2"><div align="center">
        <input type="submit" name="insertar2" id="insertar2" value="Guardar Fase" onclick="javascript:disactivar(this)"/>
        <input type="submit" name="incluir" id="incluir" value="Añadir nueva" />
      </div></td>
    </tr>
    <tr>
      <td colspan="3" id="ficha">&nbsp;</td>
    </tr>
    <tr>
      <td height="25" colspan="3" valign="middle" id="fases">&nbsp;</td>
    </tr>
  </table>
  <p>
  <label>
    <div align="center">
<p align="center">
        <label></label>
        <label></label>
</p>
<p align="center">
  <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='admin_actividades.php'" />
</p>
<div align="center">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
  </label>
</form>
<script type="text/javascript">
<!--
//-->
//carga_objetivo_operativo();
muestra_fases();
//carga_fase();
</script>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur", "change"]});
</script>

<script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_inicio",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_c",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 18 September, 2008 12:18 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
