<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Carlos A. Ávila P.
  Descripción General:  Este archivo muestra el listado de personas inscritas en el sistema
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. Se modificaron las rutas de acceso para trabajar con la intranet y los nombres
														   de las bases de datos, así como los Css; adicionalmente se le añadió funcionalidad
														   de filtrado de datos y paginación de resultados.
						05/09/2008 por Pedro E. Arrioja M. Se añade comprobación de acceso a módulo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/

 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 
 $link=conectarse("organizacion");
 $registros=20;//numero de registros para la paginacion



 if (isset($_POST['ver']) || isset($_POST['ced']) || isset($_POST['nomb']))
 {
  $inicio = 0;
  $pagina = 1;
 }
 else
  {
    $pagina = $_GET["pagina"];//pagina de la paginacion  
    if (!$pagina) 
	  {
	    $inicio = 0;
	    $pagina = 1;
	  }
    else 
	  {
        $inicio = ($pagina - 1) * $registros;
      }
  }


                
 if (isset($_POST['ver']))//si presiona el boton VER (Apellidos) 
    {
      $apellido=$_POST['apellidos'];
      $result=mysql_query("select p.apellidos from organizacion.personas p 
		 				   where p.apellidos like '$apellido%' order by p.apellidos asc",$link);
 	  $total_registros = mysql_num_rows($result);
 	  $result=mysql_query("select p.id, p.cedula, p.nombres, p.apellidos from organizacion.personas  p
		 				   where p.apellidos like '$apellido%' order by p.apellidos asc LIMIT $inicio, $registros",$link);			
	  $total_paginas = ceil($total_registros / $registros);

    }
    else // si no se presiona el boton ver (apellidos sino otro)
	{
	  if (isset($_POST['nomb']))//si presiona el boton para nombres 
        {
          $nombre=$_POST['nombres'];
          $result=mysql_query("select p.nombres from organizacion.personas p 
		 				      where p.nombres like '$nombre%' order by p.nombres asc",$link);
 		  $total_registros = mysql_num_rows($result);
 		  $result=mysql_query("select p.id, p.cedula, p.nombres, p.apellidos from organizacion.personas  p
		 				      where p.nombres like '$nombre%' order by p.nombres asc LIMIT $inicio, $registros",$link);			
		  $total_paginas = ceil($total_registros / $registros);
        } // de la presión del botón nombres
	  else // si no se presiona el boton de nombres
	    {
 		  if (isset($_POST['ced']))//si presiona el boton para cedula 
    		{
    		  $cedula=$_POST['cedula'];
    		  $result=mysql_query("select p.cedula from organizacion.personas p  
								   where p.cedula like '$cedula%' order by p.cedula asc",$link);
 			  $total_registros = mysql_num_rows($result);
 			  $result=mysql_query("select p.id, p.cedula, p.nombres, p.apellidos from organizacion.personas p  
								   where p.cedula like '$cedula%' order by p.cedula asc LIMIT $inicio, $registros",$link);
 			  $total_paginas = ceil($total_registros / $registros);
    		} // de la presión del boton ced	
		  else // si tampoco se ha presionado cédula, entonces no se ha presionado ninguno de los botones de filtro y se toma todo el mundo
		    {
			  $result=mysql_query("select p.id from organizacion.personas p",$link);
 			  $total_registros = mysql_num_rows($result);
 			  $result=mysql_query("select p.id, p.cedula, p.nombres, p.apellidos from organizacion.personas p  
								   order by p.apellidos asc LIMIT $inicio, $registros",$link);
 			  $total_paginas = ceil($total_registros / $registros);

			}	
		} // del else del boton de nombres	
	} // del else de la presión del botón apellidos
	 
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

<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {font-size: xx-small}
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 
  <tr height="98%">
    <td width="294%" height="100%" colspan="3" align="center" valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr height="98%">
          <td width="98%" height="100%" align="center" valign="top">
           
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="44%" valign="top"><form id="form1" name="form1" method="post" action="">
                      <br />
                      <table height="54" border="1" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="191" rowspan="2" align="left" valign="top" class="encabezado_formularios">Seleccione el filtro de b&uacute;squeda: <span class="style2">(s&oacute;lo las primeras letras o n&uacute;meros)</span></td>
                          <td width="57" height="26" class="titulos">Apellidos:                              </td>
                          <td width="236" class="datos_formularios"><input name="apellidos" type="text" id="apellidos" size="22" value="<?php echo $_POST['apellidos']; ?>" />
                          <input type="submit" name="ver" id="ver" value="Ver" /></td>
                          <td width="68" class="titulos"> Nombres:              </td>
                          <td width="220"><input name="nombres" type="text" id="nombres" size="22" value="<?php echo $_POST['nombres']; ?>" />
                            <input type="submit" name="nomb" id="nomb" value="Ver" /></td>
                        </tr>
                        <tr>
                          <td height="26" class="titulos">C&eacute;dula:</td>
                          <td height="26" class="datos_formularios"><span id="sprytextfield1">
                          <input name="cedula" type="text" id="cedula" size="21" maxlength="15" value="<?php echo $_POST['cedula'];?>" />
                          <span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
                            <input type="submit" name="ced" id="ced" value="Ver" /></td>
                          <td colspan="2" align="center" class="datos_formularios"><input type="submit" name="todos" id="todos" value="Ver TODOS" /> &nbsp;&nbsp;
                            <input type="button" name="todos2" id="todos2" value="Volver" onclick="javascript: location.href='index.php'" /></td>
                        </tr>
                      </table>
                <table border="1" align="center" cellpadding="0" cellspacing="0">
               
    <tr class="encabezado_formularios">
                          <td width="104">C&eacute;dula</td>
                          <td width="299">Apellidos</td>
                          <td width="327">Nombres</td>
                          <td width="71">Acci&oacute;n</td>
                      </tr>
                        <?php
  $contador=0;
while($row = mysql_fetch_array($result)) { ?>
                        <tr class="datos_formularios">
                          <td class="datos_formularios" align="center"><?php echo $row["cedula"];?></td>
                          <td align="left">&nbsp;&nbsp;<?php echo $row["apellidos"];?></td>
                          <td align="left" class="datos_formularios">&nbsp;&nbsp;<?php echo $row["nombres"];?></td>
                          <td align="center">&nbsp;<a href="editar_persona.php?id=<?php echo $row['id']; ?>"><img src="../imgs/edit.png" width="16" height="16" border="0"  title="Editar Datos Personales"/></a></td>
                          <?php ++$contador;}?>
                        </tr>
                        <tr class="datos_formularios">
                        <td colspan="4" align="center">P&aacute;gina: &nbsp;&nbsp;<?php if(($pagina - 1) > 0) {
echo "<a href='listar_personas.php?pagina=".($pagina-1)."'>< Anterior</a> ";
}  ?>                          <?php for ($i=1; $i<=$total_paginas; $i++){
if ($pagina == $i) {
echo "<b>".$pagina."</b> ";
} else {
echo "<a href='listar_personas.php?pagina=$i'>$i</a> ";
} }?>                          <?php if(($pagina + 1)<=$total_paginas) {
echo " <a href='listar_personas.php?pagina=".($pagina+1)."'>Siguiente ></a>";
} ?></td>
                      </tr>
                        <tr class="datos_formularios">
                          <td colspan="4" align="center">En total <strong><?php echo $total_registros; ?></strong> personas listadas en <strong><?php echo $total_paginas ?> </strong>p&aacute;gina(s). (Filtro aplicado: 
						  <?php 
						    if (isset($_POST['ver']))
							  {echo "Apellido: ''".$_POST['apellidos']."''";}
							else
							  {if (isset($_POST['ced']))
								  {echo "Cédula: ''".$_POST['cedula']."''";}
							   else
								  {if (isset($_POST['nomb']))
									  {echo "Nombre: ''".$_POST['nombres']."''";}
								   else
									  {echo "NINGUNO";}
								  }
							  }					  
						  ?>)</td>
                        </tr>
                      </table>
                  </form></td>
                </tr>
              </table>                      </tr>
      </table>
      <script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"], isRequired:false});
//-->
      </script></td>
  </tr>
</table>

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
