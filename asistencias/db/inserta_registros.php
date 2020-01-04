<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Este archivo toma el archivo de texto proporcionado y procesa la información de marcado contenida en el; 
  						se toman las columnas 10,11 y 12 y se guardan en la base de datos.  Nótese que este php funciona para unos requerimientos 
						específicos de la Contraloría de Nueva Esparta, quizás sea necesaria cierta modificación de las columnas a tomar si no 
						usa el mismo tipo de Biométrico que nosotros usamos para registrar los datos de entrada / salida.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						11/09/2008 por Pedro E. Arrioja M. - Se añade rastreo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
   session_start();
// se comprueba que vengan los parámetros correctos via POST antes de continuar, si no existen, se envia directamente al inicio
if (!isset($_POST['nombre_archivo'])) 
  {
	echo '<script languaje="Javascript">location.href="../index.php"</script>';
	exit();
  }
include("../../db/conexion.php");
include("../../db/inserta_rastreo.php");
$link=conectarse("asistencias"); 
$cuenta_linea=1;
$cuenta_error=0;
$ruta="../archivos_biometrico/".$_POST['nombre_archivo'];
$nomb_arch=$_POST['nombre_archivo'];
if(isset($_POST['id'])) { $id=$_POST['id']; }
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
	background-image: url(../../imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->

        <link href="../../css/index.css" rel="stylesheet" type="text/css" />
        <link href="../../css/formularios.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
        <!--
        .Estilo1 {color: #009900}
        .Estilo2 {color: #FF0000}
        -->
        </style>       
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="../../imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="../../imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="../../imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="../../imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="../../imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="../../imgs/CENE_07.png">      <div align="right">
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
/*Tengo que hacer:
1.- que no se inserten registros repetidos en la entrada y salida y en el de registro de eventos
*/

if($file = fopen($ruta, 'r')) // se abre el archivo de texto en modo de lectura
{
  $ocurrio_error='NO'; // inicializacion de la variable para saber si todo ocurrio bien
  while(!feof($file)) //se recorre el archivo de principio a fin
  {
    $linea = fgets($file);  // se lee la linea
	//se busca en la linea extraida dos cadenas que si existen no hay registro de funcionario en esa linea.
	if  ((ereg("Door Contact",$linea)==false) && (ereg("Exit Button",$linea)==false) && (strlen($linea)>53)) 
	{
	  $arreglo=explode(";",$linea);  // se convierte la linea en arreglo (el separador es es punto y coma ;)	  
	  mysql_query("BEGIN");  //inicio la transaccion
	  if ($insertar=mysql_query("insert into asistencias.entrada_salida(fecha,hora,cedula) values ('$arreglo[9]','$arreglo[10]','$arreglo[11]')")) 
	  { if (isset($id_resultante)== false) { $id_resultante=mysql_insert_id($link);}
	    mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
		$cuenta_linea=$cuenta_linea+1;
	  }
	  else
	  {// si hay un error en algun dato se muestra el mismo en la hoja como errores separados?>
        </span></p>
              <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr class="encabezado_formularios">
                  <td width="500"><span class="Estilo2">ERROR al procesar dato</span></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="justify">Al momento de procesar la l&iacute;nea 
                  Nro:<strong> <?php echo $cuenta_linea ?>,</strong> el servidor de base de datos ha arrojado el siguiente 
                  error:<strong> <?php echo mysql_error() ?> &nbsp;&nbsp;</strong>--- Se continuar&aacute; con el proceso.</div></td>
                </tr>
              </table>     

              <?php
		 $ocurrio_error='SI'; // variable para saber si todo ocurrio bien
	    mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
		$cuenta_error=$cuenta_error+1;
		$cuenta_linea=$cuenta_linea+1;
	  };  // del else del insertar
	}// del if del exit button y door contact	
  } // del while
 
 // se intenta ahora guardar los datos del archivo procesado para llevar el registro y evitar que se procese de nuevo;
 if(isset($id))
 { // si el id existe simplemente actualizo el registro con el mismo nombre para que modifique el timestamp
     if ($insertar_archivo=mysql_query("update asistencias.archivos set nombre_archivo='$nomb_arch' where id='$id'",$link) or die(mysql_error()));
    
 }
 else
 { // si id no existe entonces añado el registro
  if ($insertar_archivo=mysql_query("insert into asistencias.archivos (nombre_archivo) values ('$nomb_arch')"
	 ,$link) or die(mysql_error()));
 
 }
  
  if ($ocurrio_error=="NO") { // si no ocurre error durante la insersión se inserta rastreo y se muestra mensaje de exito.  
     // para ingresar marca de auditoria.   
   $descripcion='Añadidos '.$cuenta_linea-1 .' nuevos registros de Entrada/Salida del archivo'.$nomb_arch;
   $ip = $REMOTE_ADDR; 
   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
  
  ?>
   </span></p>
              <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr class="encabezado_formularios">
                  <td width="500"><span class="Estilo1">&Eacute;XITO al guardar en Base de Datos</span></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="justify">El 100% (<?php echo $cuenta_linea-1; ?>) de los datos de 
                  entrada y salida extraidos del archivo de texto (<?php echo $nomb_arch; ?>) se han almacenado correctamente en la base de datos.</div></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="center">
                    <input type="button" name="Volver" id="Volver" value="Volver" onclick="javascript: 
                    location.href='../cargar_archivo.php'" />
                  </div></td>
                </tr>
              </table>
  
              <?php }

else  // si existen errores en el procesamiento de datos.
{
     // para ingresar marca de auditoria.   
   $descripcion='Añadidos '.$cuenta_linea-1-$cuenta_error.' nuevos registros de un total de '.$cuenta_linea.' de Entrada/Salida del archivo'.$nomb_arch.' ya que '.$cuenta_error.' presentaron inconsistencias.';
   $ip = $REMOTE_ADDR; 
   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);

?>
              <br />
              <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr class="encabezado_formularios">
                  <td width="500"><span class="Estilo2">Resumen de errores</span></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="justify">Se han guardado en la base de datos<strong> <?php echo $cuenta_linea-1-$cuenta_error ?> </strong>de un total de<strong> <?php echo $cuenta_linea-1 ?> </strong>registros, ya que <strong><?php echo $cuenta_error ?> </strong>presentaron inconsistencias, antes de cerrar este mensaje, y para evitar errores en los reportes de asistencias, <strong>es importante que la Direcci&oacute;n de Organizaci&oacute;n y Sistemas sea notificada</strong>; en este sentido, se recomienda que lo imprima y lo entregue a DOS o que llame a algun t&eacute;cnico de DOS para que vea el mensaje en pantalla&quot;.</div></td>
                </tr>
                <tr>
                  <td class="datos_formularios"><div align="center">
                    <input type="button" name="Volver" id="Volver" value="Volver" onclick="javascript: location.href='../cargar_archivo.php'" />
                  </div></td>
                </tr>
              </table>

<?php

}
  
}
else
{
echo "<br><b>Archivo no encontrado</b>";
}
?>
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