<?php  
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Este archivo inserta los registros de un nuevo memorando para una dirección y un año y devuelve su número al usuario. 
  		Modificado el: 	26/08/2008 por Pedro E. Arrioja M. - Creación.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/

  session_start();
  include ("../../db/conexion.php");
  include ("../../libs/utilidades.php");
  $link=conectarse("organizacion");

  $dire=$_POST['dire'];
  $anio=$_POST['anio'];
  $asunto=$_POST['asunto'];
  $destinatario=$_POST['destinatario'];
  $fecha=cambiaf_a_mysql($_POST['fecha']);

  // ontengo las siglas del codigo de la dirección que estoy incluyendo
  $consulta_dir= mysql_query("select d.siglas from organizacion.direcciones d 
							  where (codigo='$dire')",$link);
  $result_dir=mysql_fetch_array($consulta_dir);
  $siglas=$result_dir['siglas'];
  
  // ahora obtengo las siglas de la Dirección solicitante del oficio
  $dire_tmp=$_SESSION['direccion'];
  $consulta_dir2= mysql_query("select d.siglas from organizacion.direcciones d 
							  where (codigo='$dire_tmp')",$link);
  $result_dir2=mysql_fetch_array($consulta_dir2);
  $siglas2=$result_dir2['siglas'];
  
  // obtengo el siguiente numero correlativo que corresponde a la dirección en ese año
  $maximo_codigo_consult= mysql_query("select max(correlativo) as maxcod 
  									   from organizacion.oficios 
									   where ((direccion='$dire') and (ano='$anio'))",$link);
  $maximo_codigo=mysql_fetch_array($maximo_codigo_consult);
  $codigo_nuevo=$maximo_codigo['maxcod']+1; 
  switch (strlen($codigo_nuevo))
   { case 1: $codigo_nuevo='000'.$codigo_nuevo;
             break;
     case 2: $codigo_nuevo='00'.$codigo_nuevo;
             break;
     case 3: $codigo_nuevo='0'.$codigo_nuevo;
             break;
   };
   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Intranet CENE</title>
                      <link href="../../css/formularios.css" rel="stylesheet" type="text/css" />
                <link href="../../css/index.css" rel="stylesheet" type="text/css" />
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
 // inicio de la inclusión en la bd de el nuevo memo
   mysql_query("BEGIN");  //inicio la transaccion
   $cedula_sol=$_SESSION['cedula'];
   if ($insertar=mysql_query("insert into organizacion.oficios(direccion,siglas,correlativo,ano,fecha,asunto,destinatario,cod_dir_solicitante,dir_solicitante,cedula_solicitante) 
   							  values ('$dire','$siglas','$codigo_nuevo','$anio','$fecha','$asunto','$destinatario','$dire_tmp','$siglas2','$cedula_sol')",$link) or die(mysql_error()))
     {
       mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
	   
	    // para ingresar marca de auditoria.   
       include("../../db/inserta_rastreo.php");
       $descripcion='Inclusi&oacute;n de Oficio Nro: '.$siglas."-".$codigo_nuevo."-".$anio;
       $ip = $REMOTE_ADDR; 
       inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
	  	   
	   ?>

      <br />
<table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr class="encabezado_formularios">
                      <td width="500">N&uacute;mero de Oficio solicitado exitosamente</td>
                    </tr>
                    <tr>
                      <td class="datos_formularios"><div align="justify">El Oficio ha sido registrado exitosamente, y el n&uacute;mero que le ha sido asignado es el: <strong> <?php echo $siglas."-".$codigo_nuevo."-".$anio; ?>,</strong> utilice este n&uacute;mero para identificar el Oficio en papel. Antes de dar click en &quot;volver&quot; tome nota del n&uacute;mero indicado.</div></td>
                    </tr>
                    <tr>
                      <td class="datos_formularios"><div align="center">
                        <input type="button" name="Volver" id="Volver" value="Volver" 
                        onclick="javascript: location.href='../listar_oficios.php'" />
                      </div></td>
                    </tr>
                  </table> 
	  
	  <?php
     }
   else
     {
       $msg_error=mysql_error(); // tengo que tomarlo antes porque despues que hago rollback el error desaparece
       mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
       // mando a mostrar el mensaje.php con el añadido del mensaje de error generado por el motor de BD
       echo '<script languaje="Javascript">location.href="../../mensaje.php?codigo=00005&adic='.$msg_error.'"</script>';
      };  

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