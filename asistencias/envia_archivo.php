<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Este archivo envia el documento TXT con la información de entradas y salidas de la maquina local al servidor donde
  						debe ser procesado en el siguiente paso.
						Existen ciertas restricciones con respecto al tipo de archivo y el tamaño que han sido incluidas pero que pueden ser
						modificadas a conveniencia.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();
// antes que hacer cualquier cosa, se comprueba que exista el parámetro del POST $_FILES ya que si no existe, se está queriendo
// acceder a la página sin pasar por los pasos previos necesarios.
// se ha realizado de esta manera por cuanto esta pagina es parte de un proceso mayor y la comprobación de permisos de usuarios sobre
// la misma sería inefectiva porque cualquiera con permiso podría querer acceder a ella directamente y esto no se debe permitir.
if (!isset($_FILES['userfile']['name'])) 
  {
	echo '<script languaje="Javascript">location.href="index.php"</script>';
	exit();
  }
include("../db/conexion.php");
$link=conectarse("asistencias"); 
//datos del arhivo
$nombre_archivo = $_FILES['userfile']['name'];
$tipo_archivo = $_FILES['userfile']['type'];
$tamano_archivo = $_FILES['userfile']['size'];

$consulta=mysql_query("select * from archivos where nombre_archivo='$nombre_archivo'",$link) or die(mysql_error());
$resultado=mysql_fetch_array($consulta);
$total =mysql_num_rows($consulta); 
//tomo el valor de un elemento de tipo texto del formulario
//$cadenatexto = $_POST["cadenatexto"];
//echo "Escribió en el campo de texto: " . $cadenatexto . "<br><br>";


//compruebo si las características del archivo son las que deseo

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
	background-image: url(../imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->


<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
.Estilo3 {color: #009900}
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
<p>
  <span class="datos_formularios">
  <?php 
if (($tipo_archivo!="text/plain") || ($tamano_archivo > 1000000)) {  ?>
  </span></p>
<p>&nbsp;</p>
<form id="form0" name="form0" method="post" action="">
              <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr class="encabezado_formularios">
                  <td width="500"><span class="Estilo1">Error de Selecci&oacute;n </span></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="justify">
                    <p>El archivo que intenta subir al servidor <strong>no cumple con las condiciones</strong> establecidas:<br />
                      <br />
                    &nbsp;&nbsp;1.- Que sea un archivo de texto plano (.txt).<br />
                    &nbsp;&nbsp;2.- Que su tama&ntilde;o sea menor de 1000 Kb.<br />
                      <br />
                    <strong>Corrija el problema para poder continuar.</strong></p>
                    </div></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="center">
                    <input type="button" name="Volver" id="Volver" value="Volver" onclick="javascript: location.href='cargar_archivo.php'" />
                  </div></td>
                </tr>
              </table>
            </form>
<?php 
}else  // si los datos del archivos son correctos 
{


 if ($total>=1){ // si el archivo se cargo bien pero ya fué procesado
  ?>
 
        </span></p>
            <form id="form1" name="form1" method="post" action="db/inserta_registros.php">
              <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr class="encabezado_formularios">
                  <td width="500"><span class="Estilo1">ADVERTENCIA DE DUPLICACI&Oacute;N!</span></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="justify">El archivo:<strong><?php echo $nombre_archivo;?> </strong>que desea subir al servidor <strong>aparentemente ha sido procesado el dia <?php echo date("d/m/Y",strtotime($resultado['fecha_procesamiento'])).' a las '.date("h:i A",strtotime($resultado['fecha_procesamiento']));?>, </strong>si lo procesa de nuevo <strong>existe el riesgo de duplicar los registros</strong> de entrada/salida de los empleados en las fechas contenidas en el archivo, , qu&eacute; desea hacer?:
                      <input name="nombre_archivo" type="hidden" id="nombre_archivo" value="<?php echo $nombre_archivo;?>" />
                      <input name="id" type="hidden" id="id" value="<?php echo $resultado['id']; ?>" />
                  </div></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="center">
                    <input type="button" name="Volver" id="Volver" value="Volver" onclick="javascript: location.href='cargar_archivo.php'" />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                  <input type="submit" name="Procesar" id="Procesar" value="Procesar" />
                  </div></td>
                </tr>
              </table>
</form>
 
 
 <?php


} else {



    if (move_uploaded_file($_FILES['userfile']['tmp_name'], "archivos_biometrico/".$nombre_archivo)){ ?>
                
                </span></p>
            <form id="form1" name="form1" method="post" action="db/inserta_registros.php">
              <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr class="encabezado_formularios">
                  <td width="500"><span class="Estilo3">Carga de archivo EXITOSA!</span></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="justify">La subida del archivo ha resultado exitosa!, en este punto todav&iacute;a puede cancelar el proceso haciendo click en &quot;<strong>volver</strong>&quot; o puede hacer click en &quot;<strong>procesar</strong>&quot; para guardar el contenido del archivo en la base de datos. (una vez que la informaci&oacute;n se encuentre almacenada en la base de datos no se puede eliminar), qu&eacute; desea hacer?:
                    <input name="nombre_archivo" type="hidden" id="nombre_archivo" value="<?php echo $nombre_archivo;?>" />
                  </div></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="center">
                    <input type="button" name="Volver" id="Volver" value="Volver" onclick="javascript: location.href='cargar_archivo.php'" />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                  <input type="submit" name="Procesar" id="Procesar" value="Procesar" />
                  </div></td>
                </tr>
              </table>
</form>
	
	<?php
    }else{  ?>
    
    </span></p>
            <form id="form2" name="form2" method="post" action="">
              <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr class="encabezado_formularios">
                  <td width="500"><span class="Estilo1">ERROR al subir el archivo</span></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="justify">Ha ocurrido un error al momento de enviar el archivo al servidor, por favor, int&eacute;ntelo de nuevo y si el problema persoste, contacte a la Direcci&oacute;n de Organizaci&oacute;n y Sistemas para solucionar el mismo.</div></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="center">
                    <input type="button" name="Volver" id="Volver" value="Volver" onclick="javascript: location.href='cargar_archivo.php'" />
                  </div></td>
                </tr>
              </table>
</form>     
	  
	  
	  
	  
	<?php
	// del si viene duplicado o no
	  } 
	
    }
}

?>
  
<p>&nbsp; </p>
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
