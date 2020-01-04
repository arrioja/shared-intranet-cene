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
<script src="javascript/java.js"> </script> 

<script language="JavaScript" type="text/javascript">


function carga_objetivo()
{ 
   var valor=document.getElementById("select_2").options[document.getElementById("select_2").selectedIndex].value;
 //alert ("valor "+ valor);
   if(valor==0){
    document.getElementById("objetivo").innerHTML="No disponible";
   }
   else
   {
      ajax=nuevoAjax();
	 //alert(valor);
      ajax.open("GET", "../select/select_total.php?seleccionado="+valor+"&select=10"+"&codigo="+document.form1.codigo.value, true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            document.getElementById("objetivo").innerHTML="Cargando....";
         }
         if (ajax.readyState==4)
         {
            document.getElementById("objetivo").innerHTML=ajax.responseText;
         }
      }
      ajax.send(null);
   }
}


function crear_vinculo(valor, activo)
{
  if (document.form1.codigo.value=="")
   alert("debe colocar un codigo para el objetivo");
   else
    if (document.form1.nombre.value=="")
   alert("debe colocar un Nombre ");
   else
   if (document.form1.descripcion.value=="")
   alert("debe colocar una descripcion para el objetivo");
   
   else
   {//LLAMO A ENVIAR FORMULARIO PARA QUE INSERTE EL OBJETIVO ESTRATEG DE LA DIRECCION
      enviarFormulario("inserta_objetivos_operativos.php", "f1");
	  
	  if (activo)
	    activo=1;
        ajax.open("GET", "actualiza_vinculo_objetivos_operativos.php?seleccionado="+valor+"&codigo="+document.form1.codigo.value+"&activo="+activo, true);
       // ajax.open("GET", "elimina_vinculo_obj_estr_direc.php?seleccionado="+valor+"&codigo="+document.form1.codigo.value, true);
		
		ajax.onreadystatechange=function()
      {        
		  if (ajax.readyState==4)
               carga_objetivo();//cargo de nuevo los obj estrateg de org para que actualice la tabla que los muestra
   	  }
		
	  ajax.send(null);
	 
	}
}
    
</script>





<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<link href="../plan_operativo_dir/invento.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
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
include "../db/conexion.php";
$link=conectarse("gestion");
?>

<form id="f1" name="form1" method="post" action="inserta_objetivos_operativos.php">
  <table border="1" align="center" cellpadding="2">
    <tr class="encabezado">
      <td colspan="2"><div align="center"><strong><img src="../imgs/usuario.png" alt="" width="57" height="45" />Registro de Objetivos Operativos Direcci&oacute;n</strong>          
    <input type="hidden" name="insertar" id="insertar" />
      </div></td>
    </tr>
    <tr>
      <td width="193"><strong>Organizaci&oacute;n</strong></td>
      <td width="189"><label>
      <?php  $result=mysql_query("SELECT * FROM organizacion.organizaciones where codigo=$_POST[organizacion]",$link);?> 
        <select name="organizacion" id="organizacion">
        <?php 	   while($row=mysql_fetch_row($result))
	   {
		  echo "<option value='".$row[1]."'>".$row[2]."</option>";
	   }?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td width="193" align="center" id=""> <div align="justify"><strong>Direcci&oacute;n</strong></div></td>
      <td width="189" align="" id="cod"> <div align="justify"><label>
        <?php  $result=mysql_query("SELECT * FROM organizacion.direcciones where codigo=$_POST[direccion]",$link);?> 
        <select class="combo"  id="select_1" name="direccion" >
           <?php 	   while($row=mysql_fetch_row($result))
	   {
		  echo "<option value='".$row[1]."'>".$row[2]."</option>";
	   }?>
        </select>
      </label>
      </div> </td>
    </tr>
    <tr>
      <td width="193" align="center" id=""> <div align="justify"><strong>Plan Operativo</strong></div></td>
      <td width="189" align="" id="plan_operativo"> <div align="justify"><label>
	<?php  $result=mysql_query("SELECT * FROM gestion.gestion_planes_operativos WHERE codigo=$_POST[plan_operativo]",$link);?>
        <select class="combo" id="select_2" name="plan_operativo">
           <?php 	   while($row=mysql_fetch_row($result))
	   {
		  echo "<option value='".$row[1]."'>".$row[1]." ".$row[2]."</option>";
	   }?>          
        </select>
        <?php echo  $row[1]; ?>
      </label>
      </div>      </td>
      </tr>
    <tr>
      <td><strong>C&oacute;digo</strong></td>
      <td><span id="sprytextfield1">
      <label>
      <input type="text" name="codigo" id="codigo" value="00" />
      </label>
      <span class="textfieldRequiredMsg">Se Requiere un Valor</span><span class="textfieldInvalidFormatMsg">Valor Numérico</span></span></td>
    </tr>
    <tr>
      <td><strong>Nombre</strong></td>
      <td><span id="sprytextfield2">
        <label>
        <input name="nombre" type="text" id="nombre" size="45" />
        </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Descripci&oacute;n</strong></td>
      <td><span id="sprytextfield3">
        <label>
        <textarea name="descripcion" cols="45" rows="2" id="descripcion"></textarea>
        </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td><strong>Objetivo Estrat&eacute;gico de la Direcci&oacute;n que Impacta</strong></td>
      <td id="objetivo">
	  <?php $result=mysql_query("SELECT oe.codigo, oe.nombre FROM gestion.gestion_obj_estrategicos_direcciones oe
		INNER JOIN gestion.gestion_plan_e_o_dir oed ON oed.cod_plan_e_dir = oe.cod_plan_e_dir
		WHERE oed.cod_plan_o_dir =$_POST[plan_operativo]",$link);
		echo "<table width='75%' border='0'>"; 

	  while($row=mysql_fetch_row($result))
	   {
	   echo "<tr>";
	   $row[2]=htmlentities($row[2]);
	   echo "<td> <input type='checkbox' name='cod_obj_estrategico_dir[]' value='".$row[0]."'>".$row[1]."</td>";
	   echo "</tr>";
	   } 
  
  echo "</table>"; 

?>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" id="ficha"><label>
        <div align="center"></div>
      </label></td>
    </tr>
  </table>
 
<label>
 <div align="center">
    <label>
    <input type="submit" name="guardar" id="guardar" value="Guardar" />
    </label>
    <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='admin_objetivos_operativos.php'" />

  </div>
  </label>
</form>


<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
//-->
</script><!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Thursday, 21 August, 2008 12:13 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
