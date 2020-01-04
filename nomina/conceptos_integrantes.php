<?php
/** 
* Asignacion de conceptos a integrantes de la nomina
* @versión:       @modificado: 
* @autor: capepo
*
*/
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
$id=$_GET['id'];
$sql=mysql_query("select p.nombres,p.apellidos,p.cedula from organizacion.personas p where p.cedula = '$id'",$link);//obtener datos del funcionario
$row=mysql_fetch_array($sql);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Conceptos Integrantes</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

</table>    
    </body>
</html>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="469" border="1" align="center">
    <tr>
      <td width="159">Nombres</td>
      <td width="294"><input type="text" name="nombres" id="nombres" readonly="readonly"value="<?php echo $row['nombres'];?>" /></td>
    </tr>
    <tr>
      <td>Apellidos</td>
      <td><input type="text" name="apellidos" id="apellidos" readonly="readonly"value="<?php echo $row['apellidos'];?>" /></td>
    </tr>
    <tr>
      <td>C&eacute;dula</td>
      <td><input type="text" name="cedula" id="cedula" readonly="readonly"value="<?php echo $row['cedula'];?>" /></td>
    </tr>
    <tr>
      <td>Conceptos Disponibles</td>
      <td><span id="spryselect1">
        <select name="conceptos" id="conceptos">
          <?php $arreglo=mysql_query("select * from conceptos",$link);//mando la consulta para llenar el arreglo
	  while ($conc=mysql_fetch_array($arreglo)){?>
          <option value="<?php echo $conc['cod'] ?>"><?php echo $conc['descripcion'];?></option>
          <?php }?>
        </select>
      </span>
        <input type="submit" name="asignar" id="asignar" value="Asignar" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><a href="visualizar_integrantes.php"><span class="datos_formularios">
        <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
      </span></a><a href="mostrar_integrantes.php?id=<?php echo $id ?>"></a></td>
    </tr>
      </table>
</form>
<?php 
        if (isset($_POST['asignar']))//si presiona el boton asignar  
        {
        $cod=$_POST['conceptos'];
		$res=mysql_query("select * from conceptos where cod='$cod'",$link);			
			if ($res)//para buscar los datos de los conceptos
			{
			$fila = mysql_fetch_array($res);//carga la fila
			//verificar cuales conceptos son los que se verifica la existencia en el funcionario 
			/*bono antiguedad 0001 ley de vivienda y habitat 0005 ajuste poliza hcm 0011 sso reg prest empleo 0014  RISRL 9001*/
				if (($fila['cod']=='0001')||($fila['cod']=='0005')||($fila['cod']=='0011')||($fila['cod']=='0014')||($fila['cod']=='9001'))
				{
				$objeto = new miclase();
					if (!$objeto->insertar_integrantes_conceptos($_POST['cedula'],$fila['cod'],$link))
					{$mensaje=mysql_error();
					abrir_popup("mensaje.php?texto=$mensaje, Error insertando el Concepto&imagen=error.gif","top=200 ,left=400 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
					}
					else
					{
					echo '<script languaje="Javascript">location.href="conceptos_integrantes.php?id='.$_GET['id'].'</script>';
					}
				}
				else
					if (comprobar_concepto($fila,$id,$link))//comprueba que las variables del concepto asignado ya estan en las constantes del funcionario exceptuando las arriba mencionadas
					{			
					$objeto = new miclase();
						if (!$objeto->insertar_integrantes_conceptos($_POST['cedula'],$fila['cod'],$link))
						{$mensaje=mysql_error();
						abrir_popup("mensaje.php?texto=$mensaje, Error insertando el Concepto&imagen=error.gif","top=200 ,left=400 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
						}
						else
						{
						echo '<script languaje="Javascript">location.href="conceptos_integrantes.php?id='.$_GET['id'].'</script>';
						}	
					}
					else
					{
					abrir_popup("mensaje.php?texto=Error insertando el Concepto, existe una variable no definida para el funcionario la cual esta en el concepto que intento insertar&imagen=error.gif","top=200 ,left=400 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
					}	   
			}       
		}
?>

<table width="600" border="1" align="center">
  <tr>
    <td><strong>C&oacute;digo</strong></td>
    <td><strong>Descripci&oacute;n</strong></td>
    <td><strong>Tipo</strong></td>
    <td><strong>F&oacute;rmula</strong></td>
    <td><strong>General</strong></td>
    <td><strong>Frecuencia</strong></td>
    <td><strong>Acci&oacute;n</strong></td>
  </tr>
<?php
$result=mysql_query("select c.cod, c.descripcion, c.tipo, c.formula, c.general, c.frecuencia from conceptos as c inner join integrantes_conceptos as ic on ic.cod_concepto=c.cod inner join integrantes as i on i.cedula=ic.cedula where i.cedula='$id'",$link);
?>  
  
<?php while ($conceptos=mysql_fetch_array($result)){?>  
  <tr>
    <td><?php echo $conceptos['cod'];?></td>
    <td><?php echo $conceptos['descripcion'];?></td>
    <td><?php echo $conceptos['tipo'];?></td>
    <td><?php echo $conceptos['formula'];?></td>
    <td><?php echo $conceptos['general'];?></td>
    <td><?php echo $conceptos['frecuencia'];?></td>
    <td><a href="includes/borrar_integrantes_conceptos.php?id=<?php echo $id;?>&cod=<?php echo $conceptos['cod'];?>">Quitar</a></td>   
  </tr>
  <?php }?>
</table>
<script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {isRequired:false});
//-->
</script>
</body>
</html>
