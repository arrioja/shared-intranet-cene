<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Muestra los datos generales de la persona y los comprobantes de DJP que han sido emitidos a su nombre.
  		Modificado el: 	05/09/2008 por Pedro E. Arrioja M. - Creación
						11/09/2008 por Pedro E. Arrioja M. - Se añade rastreo.
  			  Versión: 	0.2b
     ****************************************************  FIN DE INFO
*/


   session_start();
   require("../db/conexion.php");
   require("../libs/utilidades.php");
   $cedula=$_POST['cedula'];
   $link=conectarse("djp");  
   $consulta_comprobantes = mysql_query("select c.id,c.iddoc,c.fecha,c.cargo,c.status 
   										 from djp.comprobantes c where c.cedula_declarante=$cedula", $link); 
   $consulta_declarantes = mysql_query("select * from djp.declarantes d where d.cedula=$cedula", $link); 
 
   // para ingresar marca de auditoria.   

   include("../db/inserta_rastreo.php");
   $descripcion='Consulta de comprobante de DJP por C&eacute;dula: '.$cedula;
   $ip = $REMOTE_ADDR; 
   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Intranet CENE</title>

<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
</head>

<body> 
<SCRIPT language="JavaScript">
<!--
function cargar_contenido2(target2,id2,cedul2)
{
  var peticion2;
  document.getElementById(target2).innerHTML = 'Cargando Datos...';
  var myConn2 = new XHConn();
  if (!myConn2) alert("XMLHTTP no esta disponible. Inténtalo con un navegador mas nuevo.");
  peticion2=function(oXML){document.getElementById(target2).innerHTML=oXML.responseText;};
  myConn2.connect("detalle_comprobante.php", "POST", "cedula="+cedul2+"&id="+id2, peticion2);
 // myConn.connect("comprobantes_por_cedula.php", "POST", "parametro1=a&parametro2=b", fnWhenDone);
}
//-->
</SCRIPT>


      <?php 
   if (mysql_num_rows($consulta_declarantes) == 0) 
      { // si es cero quiere decir que la cédula no se encuentra registrada
	  ?>
       La c&eacute;dula no se encuentra.
	     <?php
	  }
   else
      { // la cédula si se encuentra registrada 
	  $resultado2=mysql_fetch_array($consulta_declarantes)
	  
	  ?>
	     <br />
</p>
       <table width="459" border="1" align="center" cellpadding="0" cellspacing="0">
         <tr class="encabezado_formularios">
           <td colspan="2"><strong>Datos del Declarante</strong></td>
         </tr>
         <tr>
           <td width="90" class="titulos_formularios"><div align="right">Cedula:&nbsp;&nbsp;</div></td>
           <td width="363" class="datos_formularios">&nbsp;&nbsp;<?php echo $resultado2['cedula']; ?></td>
         </tr>
         <tr>
           <td width="90" class="titulos_formularios"><div align="right">Nombres:&nbsp;&nbsp;</div></td>
           <td width="363" class="datos_formularios">&nbsp;&nbsp;<?php echo $resultado2['nombre']; ?></td>
         </tr>
         <tr>
           <td class="titulos_formularios"><div align="right">Apellidos:&nbsp;&nbsp;</div></td>
           <td class="datos_formularios">&nbsp;&nbsp;<?php echo $resultado2['apellido']; ?></td>
         </tr>
       </table>
      <br />
<table width="641" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr class="encabezado_formularios">
    <td colspan="5"><strong>Datos de los Comprobantes de DJP</strong></td>
    </tr>  
        <tr class="encabezado_formularios">
          <td width="90"><strong>Nro Comp.</strong></td>
	  <td width="82"><strong>Fecha</strong></td>
	  <td width="303"><strong>Cargo</strong></td>
	  <td width="94"><strong>Tipo</strong></td>
	  <td width="60"><strong>Acci&oacute;n</strong></td>
    </tr> 
         <?php //cada vez que escribo el fetch ayyar el va bajando una linea en la tabla
		 while($resultado=mysql_fetch_array($consulta_comprobantes)) { ?> 
         <tr>
           <td align="center"><?php echo $resultado['iddoc']; ?></td>
		   <td align="center"><?php echo cambiaf_a_normal($resultado['fecha']); ?></td>
		   <td><?php echo $resultado['cargo']; ?></td>
		   <td align="center"><?php echo $resultado['status']; ?></td>
		   <td align="center" > <input type="button" name="volver" id="volver" value="Volver" onclick="cargar_contenido2('resultadodetalle','1','3009182')" />
           <img src="../imgs/detalle.png" alt="detalle" width="16" height="16" /></td>
  </tr>
         
         <?php }?>
</table>
      <div align="center" id="resultadodetalle"><br />
          
 </div>  
  <br /></td><?php	  }
         mysql_close($link);	?>
</body>
</html>
