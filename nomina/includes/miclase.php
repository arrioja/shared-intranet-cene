<?php
//error_reporting(E_ALL);
include("libreria.php");
class miclase
{
  function actualizar_nomina_actual($link)
	{
	mysql_query("update nomina_actual set f_elab=".date("m-d-Y"));
	}	
	
	function insertar_empresa_partida($rif,$partida,$generica,$especifica,$subespecifica,$link)    
    {
	 if (mysql_query("insert into empresa_partida (rif,partida,generica,especifica,subespecifica) values ('$rif','$partida','$generica','$especifica','$subespecifica')",$link)==true)
	     {
	     return true;
	     }
	  else 
	  	  {	  	  
	  	  return false;
	  	  }
    }	 
	
	function insertar_producto_partida($referencia,$partida,$generica,$especifica,$subespecifica,$link)    
    {
	 if (mysql_query("insert into producto_partida (referencia,partida,generica,especifica,subespecifica) values ('$referencia','$partida','$generica','$especifica','$subespecifica')",$link)==true)
	     {
	     return true;
	     }
	  else 
	  	  {	  	  
	  	  return false;
	  	  }
    }
	
	function insertar_integrantes_cargo($status,$denominacion,$nivel,$condicion,$decreto_contrato,$fecha_ini,$fecha_fin,$lugar_trabajo,$cod_direccion,$cod_rac,$fecha_elab,$sueldo_basico,$asignaciones,$causa_egreso,$fecha_egreso,$fecha_ingreso,$observaciones,$cedula,$paso,$link)
	{
	if (mysql_query("insert into integrantes_cargo(status,denominacion,nivel, condicion,decreto_contrato,fecha_ini, fecha_fin, lugar_trabajo,cod_direccion, cod_rac, fecha_elab,sueldo_basico,asignaciones,causa_egreso,fecha_egreso, fecha_ingreso,observaciones ,cedula,paso)values('$status', '$denominacion', '$nivel', '$condicion', '$decreto_contrato', '$fecha_ini', '$fecha_fin', '$lugar_trabajo', '$cod_direccion' ,'$cod_rac', '$fecha_elab', '$sueldo_basico','$asignaciones', '$causa_egreso','$fecha_egreso', '$fecha_ingreso', '$observaciones', '$cedula','$paso')",$link))
		{
		return true;
		}
	else
		{return false;
		}	
	}
	
	function editar_integrantes_cargo($status,$denominacion,$nivel,$condicion,$decreto_contrato,$fecha_ini,$fecha_fin,$lugar_trabajo,$cod_direccion,$cod_rac,$fecha_elab,$sueldo_basico,$asignaciones,$causa_egreso,$fecha_egreso,$fecha_ingreso,$observaciones,$cedula,$id,$paso,$link)
	{
	if (mysql_query("update integrantes_cargo set status='$status', denominacion='$denominacion',nivel='$nivel', condicion='$condicion', decreto_contrato='$decreto_contrato',fecha_ini='$fecha_ini', fecha_fin='$fecha_fin', lugar_trabajo='$lugar_trabajo',cod_direccion='$cod_direccion', cod_rac='$cod_rac', fecha_elab='$fecha_elab', sueldo_basico='$sueldo_basico', asignaciones='$asignaciones', causa_egreso='$causa_egreso', fecha_egreso='$fecha_egreso', fecha_ingreso='$fecha_ingreso', observaciones='$observaciones' ,cedula='$cedula',paso='$paso' where id='$id' ",$link))
		{
		return true;
		}
	else
		{return false;
		}	
	}

  function insertar_integrantes_constantes($cedula,$cod_constantes,$monto,$link)    
    {
	 if (mysql_query("insert into integrantes_constantes(cedula,cod_constantes,monto) values ($cedula,'$cod_constantes',$monto)",$link)==true)
	     {
	     return true;
	     }
	  else 
	  	  {	  	  
	  	  return false;
	  	  }
    }

	function insertar_usuario($login,$password,$privilegios,$link)    
    {
	 if (mysql_query("insert into usuarios(login,password,privilegios) values ('$login','$password','$privilegios')",$link)==true)
	     {
	     return true;
	     }
	  else 
	  	  {	  	  
	  	  return false;
	  	  }
    }    
    
    function insertar_integrantes_conceptos($cedula,$cod_concepto,$link)    
    {     
	 if (mysql_query("insert into integrantes_conceptos(cedula,cod_concepto) values ($cedula,'$cod_concepto')",$link)==true)
	     { 
	     return true;
	     }
	  else {	  	  
	  		return false;
	  		}	  	              
    }
    
    function insertar_funcionario($nombres,$apellidos,$cedula,$fecha_nacimiento,$sexo,$lugar_nacimiento,$edo_civil,$grado_instruccion,$profesion,$tlf_habitacion,$tlf_celular,$direccion,$status,$t_nomina,$f_ingreso,$a_servicio,$departamento,$p_banco,$cargo,$cod,$link)    
    {
	 if (mysql_query("insert into integrantes (nombres,apellidos,cedula,fecha_nacimiento,sexo,lugar_nacimiento,edo_civil,grado_instruccion,profesion,tlf_habitacion,tlf_celular,direccion,status, tipo_nomina, fecha_ingreso,anos_servicio,departamento,pago_banco,cargo,cod) values ('$nombres','$apellidos','$cedula','$fecha_nacimiento','$sexo','$lugar_nacimiento','$edo_civil','$grado_instruccion','$profesion','$tlf_habitacion','$tlf_celular','$direccion','$status','$t_nomina','$f_ingreso','$a_servicio','$departamento','$p_banco','$cargo','$cod')",$link)==true)
	     { 
	     return true;
	     }
	  else 
	  	  {
	  	  return false;
	  	  }       
    }
    
	function editar_integrante($id,$status,$t_nomina,$a_servicio,$p_banco,$cod,$link)    
    { 
	 if (mysql_query("update integrantes set status='$status',tipo_nomina='$t_nomina',anos_servicio='$a_servicio', pago_banco='$p_banco',cod='$cod' where id='$id'" ,$link)==true)
	     { 
	     return true;
	     }
	  else 
	  	  {
	  	  return false;
	  	  }            
    }    
    
    function editar_usuarios($login,$password,$privilegios,$id,$link)    
    { 
	 if (mysql_query("update usuarios set login='$login',password='$password',privilegios='$privilegios' where id='$id'" ,$link)==true)
	     { 
	     return true;
	     }
	  else 
	  	  {
	  	  return false;
	  	  }            
    } 
    
	 function insertar_nomina_actual($codigo,$titulo,$f_ini,$f_fin,$periodo,$status,$link)    
    {
		 if (!mysql_query("update nomina_actual set status='INACTIVA'",$link))//poner todas las nominas anteriores inactivas
		 	{
			return false;
			}
			
		$fecha_elab=date("Y-m-d");//fecha de elaboracion
		if (mysql_query("insert into nomina_actual (cod,titulo,f_ini,f_fin,f_elab,periodo,status) values('$codigo', '$titulo', '$f_ini', '$f_fin', '$fecha_elab', '$periodo', '$status')",$link)==true)
			 { 
			 return true;			 
			 }
		  else 
			 {
			 return false;
			 }            
    }    
	
    function editar_nomina_actual($codigo,$titulo,$ano_curso,$f_ini,$f_fin,$num_periodos,$periodo,$status,$id,$link)    
    { 
	 if (mysql_query("update nomina_actual set cod='$codigo',titulo='$titulo',ano_curso='$ano_curso',f_ini='$f_ini',f_fin='$f_fin',num_periodos='$num_periodos',periodo='$periodo',status='$status' where cod='$id'" ,$link)==true)
	     { 
	     return true;
	     }
	  else 
	  	  {
	  	  return false;
	  	  }            
    }    
       
	function editar_configuracion($ano_curso,$num_periodos,$id,$link)    
    { 
	 if (mysql_query("update configuracion set ano_curso='$ano_curso',num_periodos='$num_periodos' where id='$id'" ,$link)==true)
	     { 
	     return true;
	     }
	  else 
	  	  {
	  	  return false;
	  	  }            
    }    
    function insertar_constantes($cod,$descripcion,$tipo,$abreviatura,$fecha,$link)    
    {    
	 if (mysql_query("insert into constantes (cod,descripcion,tipo,abreviatura,fecha) values ('$cod','$descripcion','$tipo','$abreviatura','$fecha')",$link)==true)
	     {
	     return true;
	     }
	  else 
	  	 {	    
	    return false;
	  	 } 
	  }
	  
	  function insertar_variables($cod,$descripcion,$abreviatura,$valor,$link)    
    {    
	 if (mysql_query("insert into variables (cod,descripcion,abreviatura,valor) values ('$cod','$descripcion','$abreviatura','$valor')",$link)==true)
	     {
	     return true;
	     }
	  else 
	  	 {	    
	    return false;
	  	 } 
	  }	  

    function insertar_banco($cod,$descripcion,$tipo,$numero,$nombre,$link)    
    {
	 if (mysql_query("insert into banco (cod,descripcion,tipo,numero,nombre) values ('$cod','$descripcion','$tipo','$numero','$nombre')",$link)==true)
	     {
	     return true;
	     }
	  else {
	  		return false;
	  		}
    }
    
    function insertar_conceptos($cod,$descripcion,$tipo,$formula,$general,$frecuencia,$link)    
    {     
	 if (mysql_query("insert into conceptos (cod,descripcion,tipo,formula,general,frecuencia) values ('$cod','$descripcion','$tipo','$formula','$general','$frecuencia')",$link)==true)
	     {      
	     return true;
	     }
	  else 
	  	  {
	  		return false;
	  	  }	  
	 }
	    
    function editar_constantes($cod,$descripcion,$tipo,$abreviatura,$fecha,$id,$link)    
	{
	 if (mysql_query("update constantes set cod='$cod', descripcion='$descripcion',tipo='$tipo',abreviatura='$abreviatura',fecha='$fecha' where id='$id'",$link)==true)
	     {
	     return true;
	     }
	  else 
	  	{	   
	  	return false;
	  	}          
 	}
      
    function editar_variables($cod,$descripcion,$abreviatura,$valor,$id,$link)    
	{
	 if (mysql_query("update variables set cod='$cod', descripcion='$descripcion',valor='$valor',abreviatura='$abreviatura' where id='$id'",$link)==true)
	     {
	     return true;
	     }
	  else 
	  	{	   
	  	return false;
	  	}                  
    }
    
    function editar_conceptos($cod,$descripcion,$tipo,$formula,$general,$frecuencia,$id,$link)    
    {   
	 if (mysql_query("update conceptos set cod='$cod',descripcion='$descripcion',tipo='$tipo',formula='$formula',general='$general',frecuencia='$frecuencia' where id='$id'",$link)==true)
	     {
	     return true;
	     }
	  else 
	  		{
	  		return false;
	  		}            
    }
    
    function editar_banco($cod,$descripcion,$tipo,$numero,$nombre,$link)    
    {   
	 if (mysql_query("update banco set descripcion='$descripcion',tipo='$tipo',numero='$numero',nombre='$nombre' where cod='$cod'",$link)==true)
	     {	      
	     return true;
	     }
	  else 
	  		{
	  		return false;
	  		}            
    }
    //cambia fechas entre los formatos mysql y normal
    function cambiaf_a_mysql($fecha)
    {
    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
    return $lafecha; 
    }
    
    function cambiaf_a_normal($fecha)
    {
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
	 } 
	 
	 function borrar_funcionario($id,$link)
	 {
		if (mysql_query("delete from funcionario where cedula = '$id'",$link))
			{
			return true;
			}
		else
			{
			return false;
			}	   	
	 }		
	 
function insertar_incidencia_nomina($cod_nomina,$cedula,$cod_incidencia,$monto,$tipo,$descripcion,$tipo_nomina,$link)
	 {
	 //redondear a dos decimales los montos a incluir
	 $monto=round($monto*100)/100; 
	 $excluidas=array("4444","5555");//incidencias excluidas para la creacion de la nomina ej: sueldo integral
	 if (in_array($cod_incidencia,$excluidas)==false)//si no esta en las excluidas
	 	{
	 	if ($tipo=='Debito')
	 		{
	 		$monto=-1*$monto;
	 		}
	 	if (mysql_query("insert into nomina(cod,cedula,cod_incidencia,monto_incidencia,tipo,descripcion,tipo_nomina) values ('$cod_nomina','$cedula','$cod_incidencia','$monto','$tipo','$descripcion','$tipo_nomina')",$link)==true)
	      {
	      return true;
	      }
	   else 
	      {
	   	return false;
	  	   }
	  } 
	  return true;//si esta en excluidas igual devuelve true   	  
	 }
	 
function evaluar_bono_antiguedad($funcionarios, $conceptos,$link)
	 {
	  $result= mysql_query("select * from nomina.variables",$link);//variables del sistema
	  $result2=mysql_query("select * from nomina.nomina_actual where status='ACTIVA'",$link);
	  $nomina_actual=mysql_fetch_array($result2);
	  while ($variables=mysql_fetch_array($result))
	  {
	   if ($variables["cod"]=="1000")// si es el monto antiguedad previa
	   $map=$variables["valor"];
	   else 
	   	if ($variables["cod"]=="1001")// si es el monto antiguedad actual
	   	$mas=$variables["valor"];	   
	  } 
	  $cedula=$funcionarios['cedula'];
	  $result3=mysql_query("select fecha_ingreso from organizacion.personas p where p.cedula='$cedula'",$link);//fecha de ingreso del funcionario y se encuentra en la bd organizacion
	  $ingreso=mysql_fetch_array($result3);
	  $as=anos_servicio(cambiaf_a_normal($ingreso['fecha_ingreso']),$nomina_actual['f_fin']);//años de servicio del funcionario 
	  $aap=$funcionarios['anos_servicio'];	 
	  //años anteriores en la administracion publica
	  
///condicion segun el estatuto de personal contraloria de nueva esparta
//se paga el bono de antiguedad previo luego de 3 año en la institucion (contraloria ne)
     if ($as<3)
     	$aap=0;	  
	  
	  $m = new EvalMath;
	  $m->suppress_errors = false;	  	  
	  if ($m->evaluate($conceptos['formula'])) 
	  {
	  preg_match('/^\s*([a-z]\w*)\s*\(\s*([a-z]\w*(?:\s*,\s*[a-z]\w*)*)\s*\)\s*=\s*(.+)$/', $conceptos['formula'], $matches);//divide la ecuacion 	
	 	$def="y(".$matches[2].")";
  	   $def= str_replace ("aap", $aap, $def);//sustituye donde salen las variables por el valor reemplazo
  	   $def= str_replace ("map", $map, $def);//sustituye donde salen las variables por el valor reemplazo
  	   $def= str_replace ("mas", $mas, $def);//sustituye donde salen las variables por el valor reemplazo
  	   $def= str_replace ("as", $as, $def);//sustituye donde salen las variables por el valor reemplazo  	   
	   $monto=$m->e($def);
	   $monto=round($monto*100)/100;//redondear
	   return $monto;
	  }
	  else {
		$error="No pudo evaluar la funcion: ". $m->last_error;
	  	abrir_popup("../mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		//return 0;
	  }    
	 } 	 
	 
function evaluar_concepto_con_asignaciones($funcionarios, $conceptos,$asignaciones,$link)
{
$ta=$asignaciones;//ta=total de asignaciones
$cod=$conceptos['cod'];
$cedula=$funcionarios['cedula'];
if (($conceptos['cod']=='0005'))	// 	ley de vivienda y habitat
	{
	$m = new EvalMath;
	$m->suppress_errors = false;	  	  
	if ($m->evaluate($conceptos['formula'])) 
		{
		preg_match('/^\s*([a-z]\w*)\s*\(\s*([a-z]\w*(?:\s*,\s*[a-z]\w*)*)\s*\)\s*=\s*(.+)$/', $conceptos['formula'], $matches);//divide la ecuacion 	
		$def="y(".$matches[2].")";
		$def= str_replace ("ta", $ta, $def);//sustituye donde salen las variables por el valor reemplazo
		$monto=$m->e($def);
		$monto=round($monto*100)/100;//redondear
		return $monto;
		}
	else//si no evalua 
		{
		$error="No pudo evaluar la funcion: ". $m->last_error;
	  	abrir_popup("../mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		}
	} 
else
	{
	if ($conceptos['cod']=='9001')	//evaluar R.I.S.L.R.
		{
			//porcentaje de impuesto sobre la renta del funcionario	  
		$result=mysql_query("select monto from integrantes_constantes where cedula='$cedula' and cod_constantes='9000'",$link);
		$const=mysql_fetch_array($result);
		$pct=$const['monto'];
		$m = new EvalMath;
		$m->suppress_errors = false;	  	  
		if ($m->evaluate($conceptos['formula'])) 
			  {
			  preg_match('/^\s*([a-z]\w*)\s*\(\s*([a-z]\w*(?:\s*,\s*[a-z]\w*)*)\s*\)\s*=\s*(.+)$/', $conceptos['formula'], $matches);//divide la ecuacion 	
			  $def="y(".$matches[2].")";
			  $def= str_replace ("ta", $ta, $def);//sustituye donde salen las variables por el valor reemplazo
		      $def= str_replace ("pct", $pct, $def);//sustituye donde salen las variables por el valor reemplazo
			  $monto=$m->e($def);
				$monto=round($monto*100)/100;//redondear
				return $monto;
			  }	  
		else {
			 $error="No pudo evaluar la funcion: ". $m->last_error;
			 abrir_popup("../mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
			 }
		} 
	}	
} 	 
	 	 
function evaluar_concepto($funcionarios, $conceptos,$link)
{
$cedula=$funcionarios['cedula'];
//$anos_servicio=anos_servicio($funcionarios['fecha_ingreso']);//años de servicio del funcionario 
$m = new EvalMath;
$m->suppress_errors = false;
//constantes del funcionario	  
$result=mysql_query("select c.cod,ic.monto,c.abreviatura from integrantes_constantes as ic inner join constantes as c on ic.cod_constantes=c.cod where ic.cedula='$cedula'",$link);
if ($m->evaluate($conceptos['formula'])) 
	{
	preg_match('/^\s*([a-z]\w*)\s*\(\s*([a-z]\w*(?:\s*,\s*[a-z]\w*)*)\s*\)\s*=\s*(.+)$/', 		$conceptos['formula'], $matches);//divide la ecuacion 	
	$args = explode(",", preg_replace("/\s+/", "", $matches[2]));//aqui tengo los argumentos (variables)
	natsort($args);//ordena el arreglo por tamaño de la variable
	$def=$matches[3];
	foreach ($args as $arg)//recorre el arreglo previamente ordenado no por el indice sino por el tamaño de la variable
	 	{	
	 	while ($constantes=mysql_fetch_array($result,MYSQL_ASSOC))
			{
				if ($constantes['abreviatura']==$arg)
					{ 	 	   
					$reemplazo=$constantes['monto'];//monto de la constante
					$patron="($arg)";
					$def= preg_replace ($patron, $reemplazo, $def, 1);//sustituye donde salen las variables por el valor reemplazo
					}
			 }
	   // Reset Our Pointer.
		mysql_data_seek($result,0);
	 	}	   
	$monto=$m->e($def);	
	$monto=(round($monto*100))/100;//redondear
	return $monto;	
	}
else 
	{
	$error="No pudo evaluar la funcion: ". $m->last_error;
	abrir_popup("../mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
	}    
} 
	 
function verificar_nomina($actual,$tipo,$link)//verificar si la nomina a crear no fue ya creada
{
$cod=$actual["cod"];//codigo de la nomina actual
$res2=mysql_query("select cod from nomina where cod='$cod' and tipo_nomina='$tipo'",$link);//verificar por codigo y tipo de nomina
$nomina=mysql_fetch_array($res2);

if ($nomina["cod"]==$actual["cod"])// si en la tabla nomina ya hay un codigo y tipo con la nomina actual no duplicaremos la nomina
	{
	mysql_free_result($res2);
	return false;
	} 
else
	{
	return true;
	}	
}	 

/*function asignaciones_deducciones($cod,$asignaciones,$deducciones,$link)//insertar total asignaciones, deducciones y total neto
{
mysql_query("insert into nomina ( )='$cod' and tipo_nomina='$tipo'",$link);//verificar por codigo y tipo de nomina
$nomina=mysql_fetch_array($res2);

if ($nomina["cod"]==$actual["cod"])// si en la tabla nomina ya hay un codigo y tipo con la nomina actual no duplicaremos la nomina
	{
	mysql_free_result($res2);
	return false;
	} 
else
	{
	return true;
	}	
}*/	

function copiar_historial($nomina,$link)
{ //$codigo=$nomina['cod'];
$result=mysql_query("select * from nomina",$link);
while ($registros=mysql_fetch_array($result))
	{
	$cod=$registros['cod'];$cedula=$registros['cedula'];$cod_incidencia=$registros['cod_incidencia'];$descripcion=$registros['descripcion'];$monto_incidencia=$registros['monto_incidencia'];$tipo=$registros['tipo'];$tipo_nomina=$registros['tipo_nomina'];
	
	if (!mysql_query("insert into nomina_historial (cod,cedula,cod_incidencia,descripcion,monto_incidencia,tipo,tipo_nomina) values('$cod','$cedula','$cod_incidencia','$descripcion','$monto_incidencia','$tipo','$tipo_nomina')",$link))//llenar historial
		{
		return false;
		exit;
		}
	if (!mysql_query("delete from nomina",$link))//borrar datos de la tabla nomina
		{
		return false;
		exit;
		}	
	}
return true;
} 
	
	 	 
function crear_nomina($tipo_nomina,$link) 
{
echo $tipo_nomina;
if ($tipo_nomina!='TODOS')	
	$result=mysql_query("select * from integrantes where status>'0' and tipo_nomina='$tipo_nomina'",$link);//todos los funcionarios activos pertenecientes a la nomina seleccionada
else
	$result=mysql_query("select * from integrantes where status>'0'",$link);//todos los funcionarios activos pertenecientes a la nomina seleccionada
		
$result3= mysql_query("select * from nomina_actual where status='ACTIVA'",$link);//datos de la nomina actual
$nomina=mysql_fetch_array($result3);
$contador=0;   //verificar si la nomina a crear no fue ya creada   
if ($this->verificar_nomina($nomina,$tipo_nomina,$link))
	{   
	mysql_query("BEGIN",$link);//empezar transaccion
	
	//if ($this->copiar_historial($nomina,$link))//copiar de la tabla nomina a historial nomina y vaciar nomina
		//{
		while ($funcionarios=mysql_fetch_array($result))
			{$contador++; //asignar constantes
			$ced=$funcionarios["cedula"];		   
			   //solo se van a asignar los conceptos como incidencias en la nomina		 
			$asignaciones=0;
			$deducciones=0;
				 //buscar todos los conceptos del funcionario Q SEAN TIPO CREDITO
			$result4=mysql_query("select c.cod,c.formula,c.tipo,c.descripcion from integrantes_conceptos as ic inner join conceptos as c on ic.cod_concepto=c.cod where ic.cedula='$ced' and c.tipo='CREDITO'",$link);
			while($conceptos=mysql_fetch_array($result4))//insertar conceptos DE TIPO CREDITO a la nomina
				{
				//evaluar concepto//si el concepto es especifico (ej:bono de antiguedad 0001)
				if ($conceptos["cod"]=="0001")
					$valor=$this->evaluar_bono_antiguedad($funcionarios,$conceptos,$link);			
				else//si el concepto es general lo evalua	 			  		   	   	
					$valor=$this->evaluar_concepto($funcionarios,$conceptos,$link);
						//insertar la incidencia
				$asignaciones=$asignaciones+$valor;
				if (!$this->insertar_incidencia_nomina($nomina["cod"],$funcionarios["cedula"],$conceptos["cod"],$valor,$conceptos["tipo"],$conceptos["descripcion"],$tipo_nomina,$link)) 
					{
					mysql_query("ROLLBACK",$link);//devolver todas las modificaciones de las tablas
					$error="Ocurrio un error al insertar una constante: " .mysql_error();
					abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
					return false;
					}				
				}//while credito	
			$this->insertar_incidencia_nomina($nomina["cod"],$funcionarios["cedula"],'7001',$asignaciones,'ASIGNACION','Total Asignaciones',$tipo_nomina,$link);//insertar el total asignacion		
										
	///	 TIPO DEBITO 		
			$result5=mysql_query("select c.cod,c.formula,c.tipo,c.descripcion from integrantes_conceptos as ic inner join conceptos as c on ic.cod_concepto=c.cod where ic.cedula='$ced' and c.tipo='DEBITO'",$link);
			while($conceptos=mysql_fetch_array($result5))//insertar conceptos DE TIPO DEBITO a la nomina
				{
	// si el concepto es vivienda y habitat o RISLR se debe calcular con el total de las asignaciones
					if (($conceptos["cod"]=="0005")||($conceptos["cod"]=="9001"))
						$valor=$this->evaluar_concepto_con_asignaciones($funcionarios,$conceptos,$asignaciones,$link);
					else	  		
						$valor=$this->evaluar_concepto($funcionarios,$conceptos,$link);
				$deducciones=$deducciones+$valor;
						//insertar la incidencia
				if (!$this->insertar_incidencia_nomina($nomina["cod"],$funcionarios["cedula"],$conceptos["cod"],$valor,$conceptos["tipo"],$conceptos["descripcion"],$tipo_nomina,$link)) 
					{
					$error="Ocurrio un error al insertar un concepto: " .mysql_error();
					mysql_query("ROLLBACK",$link);//devolver todas las modificaciones de las tablas
					abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
					return false;
					}
				}//while tipo debito		
			$this->insertar_incidencia_nomina($nomina["cod"],$funcionarios["cedula"],'7002',$deducciones,'DEDUCCION','Total Deducciones',$tipo_nomina,$link);//total deduccion
			$this->insertar_incidencia_nomina($nomina["cod"],$funcionarios["cedula"],'7003',$asignaciones-$deducciones,'NETO','Total Neto',$tipo_nomina,$link);//total general neto			
			mysql_query("COMMIT",$link);//aplicar todas las modificaciones de las tablas   	
			}//while funcionarios
		/*}//IF COPIAR A HISTORIAL
	else
		{
		$error="Ocurrio un error al crear la tabla historial nomina" .mysql_error();
		mysql_query("ROLLBACK",$link);//devolver todas las modificaciones de las tablas
		abrir_popup("mensaje.php?texto=$error&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
		return false;
		}	*/
		
		return true;
	}//if verificar nomina
else
	{
	abrir_popup("mensaje.php?texto=Nómina Repetida, configure la nomina&imagen=error.gif","top=200 ,left=500 ,width=300, height=150, scrollbars=no, menubar=no, location=no, resizable=no");
	}
}   
 	
}//miclase		
/////////////consulta para buscar los q salgan con algun concepto que no tenga constante
/*select distinct cedula from integrantes_conceptos where cod_concepto='0008' and cedula not in (select distinct cedula from integrantes_constantes where cod_constantes='0005')*/
?>