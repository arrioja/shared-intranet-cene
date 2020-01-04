<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra un mensaje predeterminado, es realmente útil cuando hay que mostrar el mismo mensaje varias veces en páginas 
  						diferentes del sitio, simplemente se configura una sola y se muestra en cualquier lado, para mayor referencia, ver la 
						llamada a la misma en script_login.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/

 session_start();
 $codigo=$_GET['codigo'];
 if (isset($_GET['adic'])) 
   { $adicional=" ".$_GET['adic']; }
 else
   { $adicional=""; }
 include("db/conexion.php");
 $link=conectarse("intranet");
 mysql_query("BEGIN");  //inicio la transaccion
 $consulta=mysql_query("select * from mensajes where codigo='$codigo'") or die(mysql_error());
 if ($msg=mysql_fetch_array($consulta))
	  {
        $imagen="imgs/".$msg['imagen'];
        $texto=$msg['mensaje'].$adicional;
        $titulo=$msg['titulo'];
	  }
  else
  {
        $imagen="imgs/pregunta.png";
        $texto="El código del mensaje que se está intentando mostrar no aparece en nuestros registros; debe existir el código para mostrar al usuario del sistema un mensaje que lo oriente en las acciones a seguir. Contacte a la Dirección de Organización y Sistemas";
        $titulo="Mensaje INDETERMINADO";
  }


?>
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
	background-image: url(imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->


<link href="css/formularios.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="imgs/CENE_07.png">      <div align="right">
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
<p>&nbsp;</p>
 <table width="497" border="1" align="center" cellpadding="3" cellspacing="0">
   <tr class="encabezado_formularios">
     <td width="24%" rowspan="2" align="center"><img src="<?php echo $imagen; ?>" alt="imagen" width="128" height="128" /></td>
     <td colspan="2" align="center" class="encabezado_formularios"><?php echo $titulo; ?>&nbsp;</td>
   </tr>
   <tr>
     <td colspan="2" class="datos_formularios"><div align="justify"><?php echo $texto; ?>.</div></td>
   </tr>
      <tr>
     <td colspan="3" class="datos_formularios">
       <div align="center">
         <input type="submit" name="ir" id="ir" value="Ir al inicio" onclick="javascript: location.href='index.php'" />
       </div>
     </td>
   </tr>

  </table>
 <p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
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