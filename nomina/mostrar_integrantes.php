<?php session_start();
if (!isset($_SESSION['login'])){
session_destroy();
echo '<script languaje="Javascript">location.href="login.php?pag=mostrar_integrantes.php?id='.$_GET['id'].'"</script>';
exit();}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mostrar Integrantes</title>
<style type="text/css">
<!--
.style1 {
	color: #00FF01;
	font-weight: bold;
}
.style2 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<?php
	$cod_bono_antiguedad='0001';
	require "includes/miclase.php";
	include('includes/evalmath/evalmath.class.php');
	$objeto=new miclase();
   $link=conectarse("nomina"); 
	$id=$_GET['id'];
	$sql=mysql_query("select i.cedula, p.nombres, p.apellidos,p.fecha_nacimiento,p.lugar_nacimiento, p.sexo,p.fecha_ingreso, i.tipo_nomina,i.anos_servicio  from nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula where i.cedula = '$id'",$link);
	
	$funcionario = mysql_fetch_array($sql); 	           
	  
 $result1=mysql_query("select c.cod,ic.monto,c.descripcion,c.tipo,c.fecha,c.abreviatura from integrantes_constantes as ic inner join constantes as c on ic.cod_constantes=c.cod  where ic.cedula='$id'",$link);

 $result2=mysql_query("select c.cod, c.descripcion, c.tipo, c.formula, c.general, c.frecuencia from integrantes_conceptos as ic inner join conceptos as c on ic.cod_concepto=c.cod  where ic.cedula='$id' order by c.tipo asc",$link);
 	 


function evaluar_concepto($cedula, $formula,$link)
{
//$anos_servicio=anos_servicio($funcionarios['fecha_ingreso']);//años de servicio del funcionario 
$m = new EvalMath;
$m->suppress_errors = false;
//constantes del funcionario	  
$resultado=mysql_query("select c.cod,ic.monto,c.abreviatura from integrantes_constantes as ic inner join constantes as c on ic.cod_constantes=c.cod where ic.cedula='$cedula'",$link);
if ($m->evaluate($formula)) 
	{
	preg_match('/^\s*([a-z]\w*)\s*\(\s*([a-z]\w*(?:\s*,\s*[a-z]\w*)*)\s*\)\s*=\s*(.+)$/', 		$formula, $matches);//divide la ecuacion 	
	$args = explode(",", preg_replace("/\s+/", "", $matches[2]));//aqui tengo los argumentos (variables)
	natsort($args);//ordena el arreglo por tamaño de la variable
	$def=$matches[3];
	foreach ($args as $arg)//recorre el arreglo previamente ordenado no por el indice sino por el tamaño de la variable
	 	{	
	 	while ($constantes=mysql_fetch_array($resultado,MYSQL_ASSOC))
			{
				if ($constantes['abreviatura']==$arg)
					{ 	 	   
					$reemplazo=$constantes['monto'];//monto de la constante
					$patron="($arg)";
					$def= preg_replace ($patron, $reemplazo, $def, 1);//sustituye donde salen las variables por el valor reemplazo
					}
			 }
	   // Reset Our Pointer.
		mysql_data_seek($resultado,0);
	 	}
	$monto=$m->e($def);		   
	$monto=round($monto*100)/100;
	return $monto;
	}
else 
	{
	$error="No pudo evaluar la funcion: ". $m->last_error;
	abrir_popup("../mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
	}    
} 

?>
<table width="400" border="0">
  <tr>
    <td colspan="2"><form id="integrantes" name="integrantes" method="post" action=""><table width="665" height="156" border="1" align="center">
    <tr>
      <td width="141" height="30"><div align="right"><strong>Nombres</strong></div></td>
      <td width="159"><span id="nomb">
        <input name="nombres" type="text" id="nombres" readonly="1"value="<?php echo $funcionario['nombres'];?>" />
      </span></td>
      <td width="138" align="right"><div align="right"><strong>Apellidos</strong></div></td>
      <td width="182"><span id="ape">
        <input type="text" name="apellidos" id="apellidos"readonly="1"value="<?php echo $funcionario['apellidos'];?>" />
      </span></td>
    </tr>
    <tr>
      <td height="32"><div align="right"><strong>Cedula</strong></div></td>
      <td><span id="ced">
        <input type="text" name="cedula" id="cedula"readonly="1"value="<?php echo $funcionario['cedula'];?>" />
      </span></td>
      <td align="right"><div align="right"><strong>Estatus</strong></div></td>
      <td><input type="text" name="status" id="status"readonly="1"value="<?php if ($funcionario['status']==1)echo "ACTIVO"; else echo "INACTIVO";?>" /></td>
    </tr>
    <tr>
      <td height="26"><div align="right"><strong>Fecha Nacimiento</strong></div></td>
      <td><input type="text" name="fecha_nac" id="f_date_c" readonly="1"value="<?php echo cambiaf_a_normal($funcionario['fecha_nacimiento']);?>" /></td>
      <td align="right"><div align="right"><strong>Cargo</strong></div></td>
      <td><span id="sprytextfield8">
        <input type="text" name="cargo" id="cargo" readonly="1" value="<?php $res=mysql_query("select denominacion from organizacion.personas_cargo where cedula='$id'",$link); if ($cargo=mysql_fetch_array($res)) echo $cargo['denominacion'];?>" />
      </span></td>
    </tr>
    <tr>
      <td height="26"><div align="right"><strong>Fecha de Ingreso</strong></div></td>
      <td><input type="text" name="fecha_ing" id="f_date_c2" readonly="1"value="<?php echo cambiaf_a_normal($funcionario['fecha_ingreso']);?>" /></td>
      <td align="right"><div align="right"><strong>Nomina que Pertenece</strong></div></td>
      <td><input type="text" name="t_nomina2" id="t_nomina2"readonly="1"value="<?php echo $funcionario['tipo_nomina'];?>" /></td>
    </tr>    
    <tr>
      <td height="28" colspan="2" align="right"><div align="left"><a href="visualizar_integrantes.php">Volver a Integrantes</a></div></td>
      <td colspan="2">&nbsp;</td>
      </tr>
  </table>
    </form>    </td>
  </tr>

  

    <td width="330"><form id="constantes" name="constantes" method="post" action="">
  <table width="710" border="1" align="center">
    <tr>
      <td width="113"><strong>Codigo</strong></td>
      <td width="214"><strong>Descripcion</strong></td>
      <td width="118"><strong>Abreviatura</strong></td>
      <td width="111"><strong>Tipo</strong></td>
      <td width="120"><strong>Monto</strong></td>
    </tr>
    <?php while($row = mysql_fetch_array($result1)) { ?>
    <tr>
      <td><?php echo $row["cod"]; ?></td>
      <td><?php echo $row["descripcion"]; ?></td>
      <td><?php echo $row["abreviatura"]; ?></td>
      <td><?php echo $row["tipo"]; ?></td>
      <td><?php echo $row["monto"]; ?></td><?php }?>
      <tr><td><a href=constantes_integrantes.php?id=<?php echo $id; ?>>Editar Constantes</a></td></tr>
    </tr>
  </table>
</form> </td>

    <td width="314">&nbsp;</td>
  </tr>
  <tr>
    <td><form id="conceptos" name="conceptos" method="post" action="">
  <table width="783" border="1" align="center">
    <tr>
      <td width="66"><strong>Codigo</strong></td>
      <td width="222"><strong>Descripcion</strong></td>
      <td width="75"><strong>Tipo</strong></td>
      <td width="199"><strong>Formula</strong></td>
      <td width="62"><strong>General</strong></td>
      <td width="119"><strong>Monto</strong></td>
    </tr>
    <?php $asignaciones=0; $monto=0; while($row = mysql_fetch_array($result2)) { 
		if ($row['tipo']=='CREDITO')
		{	if ($row['cod']==$cod_bono_antiguedad){$monto=$objeto->evaluar_bono_antiguedad($funcionario,$row,$link); }
	  		else{$monto=evaluar_concepto($id,$row["formula"],$link);}
		$asignaciones=$asignaciones+$monto;
		}
		else//tipo debito
		{
		if (($row["cod"]=="0005")||($row["cod"]=="9001"))//rsirl etc
					$monto=$objeto->evaluar_concepto_con_asignaciones($funcionario,$row,$asignaciones,$link);
				else	  		
					$monto=evaluar_concepto($id,$row[formula],$link);
			$deducciones=$deducciones+$monto;
		}	
	?>
    <tr>
      <td><?php echo $row["cod"]; ?></td>
      <td><?php echo $row["descripcion"]; ?></td>
      <td><?php echo $row["tipo"]; ?></td>
      <td><?php echo $row["formula"]; ?></td><?php ?>
      <td><?php if ($row["general"]=='0')echo 'no'; else echo 'si'; ?></td><?php ?>
      <td>
        <div align="right">
          <?php if ($row['tipo']=='CREDITO') echo '<span class="style1">'; else echo '<span class="style2">'; echo $monto; echo '</span>';?>
          </div></td><?php }?> 
            <tr><td></td><td></td><td></td><td></td><td><strong>Total Asignado</strong></td>
            <td><div align="right"><strong><?php echo $asignaciones-$deducciones; ?></strong></div></td>
            </tr>
	       
      
      <tr><td><a href=conceptos_integrantes.php?id=<?php echo $id; ?>>Editar Conceptos</a></td></tr>
  </table>
</form>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</body>
</html>
