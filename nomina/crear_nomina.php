<?php
session_start();
include "includes/miclase.php";
$link=conectarse("nomina");
$php_actual = solo_nombre_arch($_SERVER["SCRIPT_NAME"]);
if (!isset($_SESSION['login']))  // si "login" no existe, no hay sesión iniciada y se envia al login para ingresar autenticar
  {
	session_destroy();
	echo '<script languaje="Javascript">location.href="../login.php?pag='.'nomina/'.$php_actual.'"</script>';
	exit();
  }
else
  {  // si la sesión y el login existen, ahora se comprueba que el usuario tenga acceso a este módulo
    include("../libs/comprueba_permiso.php"); 
	$codigo_actual=codigo_modulo($php_actual);
	if ($codigo_actual!=false) 
	  { // si codigo actual no es falso entonces trajo resultado, asi que se continua
	    // en esta función se debe pasar como parámetro el login del usuario que se trae desde el sesion y el 
	    //código del módulo asignado al momento de insgribirlo en el sistema mediante la página de administración de módulos
	    if (tiene_permiso($_SESSION['login'],$codigo_actual) == false )
	      {
	        echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00003"</script>';
	        exit;
	      }	    
	  }
	else
	  { // si codigo_actual es falso, entonces no hay coincidencias con el nombre del archivo, 
	    // quiere decir que no se ha incluido el modulo en el sistema
	        echo '<script languaje="Javascript">location.href="../mensaje.php?codigo=00004"</script>';
	        exit;		
	  }
  }
include('includes/evalmath/evalmath.class.php');
$result=mysql_query("select * from nomina.nomina_actual where status='ACTIVA'",$link);
$datos = mysql_fetch_array($result);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<link href="progressBar/lib/style.css" rel="stylesheet" type="text/css" media="screen" />
<script language="javascript" type="text/javascript" src="progressBar/lib/prototype.js"></script>
<script language="javascript" type="text/javascript" src="progressBar/lib/progress.js"></script>


<style type = "text/css">
/* General Links */
a:link { text-decoration : none; color : #3366cc; border: 0px;} 
a:active { text-decoration : underline; color : #3366cc; border: 0px;} 
a:visited { text-decoration : none; color : #3366cc; border: 0px;} 
a:hover { text-decoration : underline; color : #ff5a00; border: 0px;} 
img { padding: 0px; margin: 0px; border: none;}

body {
margin : 0 auto;
width:100%;
font-family: 'Verdana';
color: #40454b;
font-size: 12px;

 text-align:center;
}

.content {
margin:20px;
line-height:20px;
}

body h1 {
font-size:14px;
font-weight:bold;
color:#CC0000;
padding:5px;
margin-left:10px;
border-bottom:solid;
border-bottom-width:1px;
border-bottom-color:#333333;
}

#demo {
margin : 0 auto;
width:100%;
margin:20px;

}

#demo .extra {
padding-left:30px;
}

#demo .options {
padding-left:10px;
}

#demo .getOption {
padding-left:40px;
}

.document {
margin : 0 auto;

border-style:solid;
border-width:1px;
background:#f7f7f7;
border-color:#efefef;
margin:20px;
}

.document h2 {
padding:5px;
padding-bottom:0px;
color:#333333;
font-weight:bold;
font-size:12px;
}

.document h3 {
padding:5px;
padding-bottom:0px;
padding-top:0px;
font-weight:normal;
font-size:12px;
}

</style>
<title>Creacion de la Nomina</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="508" border="1" align="center">
    <tr>
      <td colspan="2"><strong>Tipo de N&oacute;mina a Crear:</strong></td>
      <td colspan="2"><select name="t_nomina" id="t_nomina">
        <option value="EMPLEADOS" selected="selected">EMPLEADOS</option>
        <option value="DIRECTORES">DIRECTORES</option>
        <option value="JUBILADOS">JUBILADOS</option>
        <option value="PENSIONADOS">PENSIONADOS</option>
                              </select></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center"><strong>Datos de la N&oacute;mina Actual</strong></div></td>
    </tr>
    <tr>
      <td width="85"><strong>C&oacute;digo</strong></td>
      <td width="102"><span id="sprytextfield1">
        <input name="codigo" type="text" id="codigo" size="10" maxlength="6" value="<?php echo $datos["cod"];?>" readonly="readonly"/>
        </span></td>
      <td width="96"><strong>T&iacute;tulo</strong></td>
      <td width="197"><span id="sprytextfield7">
        <input name="titulo" type="text" id="titulo" size="30" value="<?php echo $datos["titulo"];?>" readonly="readonly" />
        </span></td>
    </tr>
    <tr>
      <td><strong>Fecha Inicial</strong></td>
      <td><input name="f_ini" type="text" id="f_ini" size="10" readonly="1" value="<?php echo cambiaf_a_normal($datos['f_ini']);?>"/>        
      &nbsp;</td>
      <td><strong>Fecha Final</strong></td>
      <td><input name="f_fin" type="text" id="f_fin" size="10" readonly="1" value="<?php echo cambiaf_a_normal($datos['f_fin']);?>"/></td>
    </tr>
    <tr>
      <td><strong>Per&iacute;odo</strong></td>
      <td><span id="sprytextfield6">
        <input name="periodo" type="text" id="periodo" size="10" value="<?php echo $datos["periodo"] ?>" readonly="readonly" />
        </span></td>
      <td colspan="2"><a href="nomina_actual.php">Editar Nomina Actual</a></td>
    </tr>
    <tr>
      <td colspan="2">
        <div align="center">
          <input type="submit" name="procesar" id="procesar" value="Procesar" />
          <label></label>
        </div></td>
      <td colspan="2"><div align="center"><a href="constantes.php"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
      </span></a><a href="visualizar_integrantes.php"></a></div></td>
    </tr>
  </table>
</form>
<?php 
	function mostrar_element()
	{
	?><script>display ('element1',0,1);
	fillProgress ('element1','25');
	</script>
	<?
	}
	function llenar_completo()
	{
	?><script>
	fillProgress ('element1','100');
	</script>
	<?
	}
	
 if (isset($_POST['procesar']))//si presiona el boton procesar  
   { //mostrar_element();
      $objeto = new miclase();
      if ($objeto->crear_nomina($_POST['t_nomina'],$link))
      {//llenar_completo();
	  abrir_popup("mensaje.php?texto=Nomina Creada&imagen=tips.png","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");        	
       }
	   else
	   abrir_popup("mensaje.php?texto=Nomina no Creada&imagen=error.png","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
   }
?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {isRequired:false});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {isRequired:false});
//-->
</script>
</body>
</html>
