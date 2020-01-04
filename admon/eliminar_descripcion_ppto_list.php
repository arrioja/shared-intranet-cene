<?php
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M. Arrioja.
  Descripción General:  Muestra el listado de descripciones presupuestarias que coincidan con el criterio de búsqueda .
  		Modificado el: 	13/11/2008 - Pedro E. Arrioja M. Creación.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 include("../libs/utilidades.php");
 require("../db/conexion.php");
 $link=conectarse("administracion"); 

 $ano = $_POST['a'];
 $partida = $_POST['p'];
 $generica = $_POST['g']; 
 $especifica = $_POST['e'];
 $subespecifica = $_POST['s'];

if ((isset($_POST['a'])) && ($ano!='') && ($ano!='-1'))
  { 
   $sql="select * from descripcion_presupuesto where (ano = '$ano') order by ano"; 
   if ((isset($_POST['p'])) && ($partida!='') && ($partida!='-1'))
     {
       $sql="select * from descripcion_presupuesto where ((ano = '$ano') and (partida = '$partida')) order by ano, partida";
       if ((isset($_POST['g'])) && ($generica!='') && ($generica!='-1'))
         {
           $sql="select * from descripcion_presupuesto where ((ano = '$ano') and (partida = '$partida') and (generica = '$generica')) 
		         order by ano, partida, generica";
           if ((isset($_POST['e'])) && ($especifica!='') && ($especifica!='-1'))  
             {
               $sql="select * from descripcion_presupuesto where ((ano = '$ano') and (partida = '$partida') and (generica = '$generica') and
	  	                   (especifica = '$especifica')) order by ano, partida, generica, especifica";
               if ((isset($_POST['s'])) && ($subespecifica!='') && ($subespecifica!='-1'))
                 {
                   $sql="select * from descripcion_presupuesto where ((ano = '$ano') and (partida = '$partida') and 
				               (generica = '$generica') and (especifica = '$especifica') and (subespecifica = '$subespecifica')) 
							   order by ano, partida, generica, especifica, subespecifica";	   	   
	             } // del if de la subespecifica 	   	   
	         } // del if de la especifica  	   
	     }// del if de la genérica
	 }// del if de la partida
 
  }// del if del año
$consulta=mysql_query($sql,$link);
$color=array("#FFFFFF","#CCFFFF"); // para darle colores alternos a las lineas que muestro
$contador_color=0; // este contador permitira darle la alternabilidad a los colores		

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Eliminar Descripcion Presupuesto</title>
<link href="../css/index.css" rel="stylesheet" type="text/css">
<link href="../css/formularios.css" rel="stylesheet" type="text/css">
</head>
<body>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr class="encabezado_formularios">
    <td width="40" align="center">A&ntilde;o</td>
    <td width="131" align="center">C&oacute;d Presup</td>
    <td width="809" align="left">Descripci&oacute;n</td>
    <td width="101" align="center">Selecci&oacute;n</td>
  </tr>
<?php  while($resultado = mysql_fetch_array($consulta))
{?>
  <tr bgcolor="<?php echo $color[$contador_color%2]; ?>">
    <td align="center"><?php echo $resultado['ano']; ?></td>
    <td align="center"><?php echo $resultado['partida']."-".$resultado['generica']."-".$resultado['especifica']."-".$resultado['subespecifica'];
 ?></td>
    <td align="left"><?php echo $resultado['descripcion']; ?></td>
    <td align="center">
      <form name="form<?php echo $resultado['id'];?>" id="<?php echo $resultado['id'];?>" method="post" action="db/elimina_descripcion_ppto.php">
      <input name="id" type="hidden" id="id<?php echo $resultado['id'];?>" value="<?php echo $resultado['id'];?>">
      <input type="submit" name="eliminar<?php echo $resultado['id'];?>" id="eliminar<?php echo $resultado['id'];?>" value="Eliminar"></form>
      </td> 
  </tr>
  <?php $contador_color++;}?>
</table>


