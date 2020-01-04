<?php
/****************************************************************************************************************
    Este código pretende realizar una comprobación genérica del acceso que tiene el usuario a página en cuestión  
   ***************************************************************************************************************
 */
session_start();  // se inicia la sesión 
include "includes/miclase.php";
$link=conectarse("nomina");
$registros=20;//numero de registros para la paginacion

$pagina = $_GET["pagina"];//pagina de la paginacion

if (!$pagina) { 
$inicio = 0; 
$pagina = 1; 
} 
else { 
$inicio = ($pagina - 1) * $registros; 
} 



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
		               
 if (isset($_POST['ver']))//si presiona el boton VER  
    { 
    $nom=$_POST['ver_nomina'];
	$_SESSION['tipo_nomina']=$_POST['ver_nomina'];
    	if ($_POST['ver_nomina']=='TODOS')//SI VA A VISUALIZAR A TODOS
        {
        	$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.status='1' order by i.cod asc",$link);
			$total_registros = mysql_num_rows($result);
			$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.status='1' order by i.cod asc LIMIT $inicio, $registros",$link);
			$total_paginas = ceil($total_registros / $registros); 
        }else
        { 	$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.tipo_nomina='$nom' and i.status='1' order by i.cod asc",$link);//integrantes activos solamente
			$total_registros = mysql_num_rows($result);
			$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.tipo_nomina='$nom' and i.status='1' order by i.cod asc LIMIT $inicio, $registros",$link);
			$total_paginas = ceil($total_registros / $registros);
        }
    }
    else
	if (!isset($_SESSION['tipo_nomina']))//si no ha especificado el tipo de nomina selecciona todos
    	{$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.status='1' order by i.cod asc ",$link);
		$total_registros = mysql_num_rows($result);
		$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.status='1' order by i.cod asc LIMIT $inicio, $registros",$link);
		$total_paginas = ceil($total_registros / $registros);
		}
	else
		{
		$tipo=$_SESSION['tipo_nomina'];
		$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.tipo_nomina='$tipo' and i.status='1' order by i.cod asc",$link);
		$total_registros = mysql_num_rows($result);
		$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.tipo_nomina='$tipo' and i.status='1' order by i.cod asc LIMIT $inicio, $registros",$link);
		$total_paginas = ceil($total_registros / $registros);
		}
	
	
	if (isset($_POST['ced']))//si presiona el boton para cedula  
    { 
    $cedula=$_POST['cedula'];
   	$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.cedula like '$cedula%' and i.status>0 order by i.cod asc",$link);
	$total_registros = mysql_num_rows($result);
	$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.cedula like '$cedula%' and i.status>0 order by i.cod asc LIMIT $inicio, $registros",$link);
	$total_paginas = ceil($total_registros / $registros);
    }	
	if (isset($_POST['nomb']))//si presiona el boton para cedula  
    { 
    $nombre=$_POST['nombres'];
   	$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where p.nombres like '$nombre%' and i.status>0 order by i.cod asc",$link);
	$total_registros = mysql_num_rows($result);
	$result=mysql_query("select i.cedula, p.nombres, p.apellidos from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where p.nombres like '$nombre%' and i.status>0 order by i.cod asc LIMIT $inicio, $registros",$link);$total_paginas = ceil($total_registros / $registros);
    }	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Intranet CENE</title>







<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-style: italic}
-->
</style>
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
	font-family: Verdana;
	color: #40454b;
	font-size: 12px;
	text-align:center;
}
}

</style>
<link href="css/formularios.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr height="98%">
    <td width="294%" height="100%" colspan="3" align="center" valign="top">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr height="98%">
          <td width="98%" height="100%" align="center" valign="top"><?php /*<a href="integrantes.php">Integrantes</a> <a href="constantes.php">Constantes</a> <a href="conceptos.php">Conceptos</a> <a href="crear_nomina.php">Crear_Nomina</a> <a href="banco.php">Banco</a> <a href="archivo_banco.php">Archivo Banco</a> <a href="variables.php">Variables
              </a>*/?>
            
    <table width="116%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="44%" valign="top"><form id="form1" name="form1" method="post" action="">
                      <table width="809" height="74" border="1" align="center" bordercolor="#999999">
                      <tr>
                      <td><a href="conceptos.php">Conceptos</a></td>
                      <td width="157"><a href="constantes.php">Constantes</a></td>
                      <td width="153"><a href="banco.php">Banco</a></td>
                      <td width="130"><a href="crear_nomina.php">Crear N&oacute;mina</a></td>
                      <td width="148"><a href="variables.php">Variables</a></td>
                      </tr>
                      
                        <tr>
                          <td width="187" rowspan="2" align="left" valign="top" class="encabezado_formularios"><span class="style1"><strong>Seleccione el tipo de nomina a Visualizar</strong> <strong>o escoja un criterio de busqueda: </strong></span></td>
                          <td height="38" colspan="2" class="encabezado_formularios"><strong>N&oacute;mina</strong>
                            <select name="ver_nomina" id="ver_nomina">
                                <option value="EMPLEADOS" <?php if (($_POST['ver_nomina']=='EMPLEADOS')||($_SESSION['tipo_nomina']=='EMPLEADOS')) echo "selected='selected'"?>>EMPLEADOS</option>
                                <option value="DIRECTORES" <?php if (($_POST['ver_nomina']=='DIRECTORES')||($_SESSION['tipo_nomina']=='DIRECTORES'))  echo "selected='selected'"?>>DIRECTORES</option>
                                <option value="JUBILADOS" <?php if (($_POST['ver_nomina']=='JUBILADOS')||($_SESSION['tipo_nomina']=='JUBILADOS'))  echo "selected='selected'"?>>JUBILADOS</option>
                                <option value="PENSIONADOS" <?php if (($_POST['ver_nomina']=='PENSIONADOS')||($_SESSION['tipo_nomina']=='PENSIONADOS'))  echo "selected='selected'"?>>PENSIONADOS</option>
                                <option value="TODOS" <?php if ($_POST['ver_nomina']=='TODOS') echo "selected='selected'"?>>TODOS</option>
                        </select>
                              <input type="submit" name="ver" id="ver" value="Ver" /></td>
                          <td colspan="2" class="encabezado_formularios"> <strong>Nombres</strong>
              <input name="nombres" type="text" id="nombres" size="22" value="<?php echo $_POST['nombres']; ?>" />
                              <input type="submit" name="nomb" id="nomb" value="Ver" /></td>
                        </tr>
                        <tr>
                          <td height="25" colspan="2" class="encabezado_formularios"><strong>C&eacute;dula</strong><span id="sprytextfield1">
                          <input name="cedula" type="text" id="cedula" size="21" maxlength="15" value="<?php echo $_POST['cedula'];?>" />
                          <span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
                          <input type="submit" name="ced" id="ced" value="Ver" /></td>
                          <td colspan="2" class="encabezado_formularios" > <a href="../index.php?sis=05">salir</a></td>
                        </tr>
                      </table>
                <table width="811" border="1" align="center">
                
    <tr>
                          <td width="215" class="encabezado_formularios"><strong>Nombres</strong></td>
                          <td width="185" class="encabezado_formularios"><strong>Apellidos</strong></td>
                          <td width="98" class="encabezado_formularios"><strong>C&eacute;dula</strong></td>
                          <td width="228" class="encabezado_formularios"><strong>Acci&oacute;n</strong></td>
                      </tr>
                        <?php
  $contador=0;
while($row = mysql_fetch_array($result)) { ?>
                        <tr>
                          <td class="datos_formularios"><?php echo $row["nombres"];?>&nbsp;</td>
                          <td class="datos_formularios"><?php echo $row["apellidos"];?>&nbsp;</td>
                          <td align="right" class="datos_formularios"><?php echo $row["cedula"];?>&nbsp;</td>
                          <td class="datos_formularios">&nbsp;<a href="mostrar_integrantes.php?id=<?php echo $row["cedula"];?>">Opciones  <a href="editar_integrantes.php?id=<?php echo $row["cedula"]?>""><img src="imagenes/b_edit.png" alt="" width="16" height="16" border="0" /></a></td>
                          <?php ++$contador;} echo $contador;?>
                        </tr>
                        <tr>
                        <td colspan="4" align="center"><?php if(($pagina - 1) > 0) { 
echo "<a href='visualizar_integrantes.php?pagina=".($pagina-1)."'>< Anterior</a> "; 
}  ?>                          <?php for ($i=1; $i<=$total_paginas; $i++){ 
if ($pagina == $i) { 
echo "<b>".$pagina."</b> "; 
} else { 
echo "<a href='visualizar_integrantes.php?pagina=$i'>$i</a> "; 
} }?>                          <?php if(($pagina + 1)<=$total_paginas) { 
echo " <a href='visualizar_integrantes.php?pagina=".($pagina+1)."'>Siguiente ></a>"; 
} ?></td>
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
      </script>
    
    <p>&nbsp;</p></td>
  </tr>
</table>

</body>
</html>
