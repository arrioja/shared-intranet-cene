<?php
	function solo_nombre_arch($url)
	{
      $break = Explode('/', $url);
      $pfile = $break[count($break) - 1]; 
	  return $pfile;
	}
function conectarse($base)
{
  if (!($link=mysql_connect("localhost","root","ncc1701")))
  {
     echo "Error conectando a la base de datos.";
     exit();
  }

  if (!mysql_select_db($base,$link))
  {
     echo "Error seleccionando la base de datos.";
     exit();
  }
  return $link;
}

function conectarse2()
{
	if (!($link=mysql_connect("localhost","root","ncc1701")))
	{
		//echo "Error conectando a la base de datos.";
		exit();
	}
	if (!mysql_select_db("escuela",$link))
	{
		//echo "Error seleccionando la base de datos.";
		exit();
	}
	return $link;
}

function conectarse3()
{
	if (!($link=mysql_connect("192.168.50.2","root","ncc1701")))
	{
		//echo "Error conectando a la base de datos.";
		exit();
	}
	if (!mysql_select_db("administracion",$link))
	{
		//echo "Error seleccionando la base de datos.";
		exit();
	}
	return $link;
}

function conectarse_persistente()
{
	if (!($link=mysql_pconnect("localhost","root","ncc1701")))
	{
		return false;
		exit();
	}
	if (!mysql_select_db("nomina",$link))
	{   return false;
		exit();
	}
	return $link;
}
function desconectar()
{
	mysql_close();
}

function verif_real($valor,$signo=3)
{
    if($signo==1)
        $patron = "/^[0-9]+(.[0-9]{1,2}|[0-9]*)$/";
    elseif($signo==2)
        $patron = "/^-[0-9]+(.[0-9]{1,2}|[0-9]*)$/";
    else
        $patron = "/^-?[0-9]+(.[0-9]{1,2}|[0-9]*)$/";
        
    if(!preg_match($patron,$valor))
        return true;
    else
        return false;
}


	function abrir_popup($url,$parametros)
	{
	?><script language="JavaScript">
	window.open("<?echo $url;?>","","<?echo $parametros;?>")
	</script><?
	}

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
	 
function mysql_evaluate_array($query) 
	{
   $result = mysql_query($query);
   $values = array();
   for ($i=0; $i<mysql_num_rows($result); ++$i)
       array_push($values, mysql_result($result,$i));
   return $values;
}

function comprobar_variable($var,$link)
	{
	$result= mysql_query("select abreviatura from constantes",$link);
	if (mysql_fetch_array($result))
		{return true;}
	else
		{return false;}	
	}
	
function asignaciones($ced, $link)
{	//ojo falta el codigo de la nomina actual
	$result=mysql_query("select * from nomina where cedula=$ced and tipo='Credito'");
	$total=0;
	while ($asig=mysql_fetch_array($result))
		{
		$total=$total+$asig["monto_incidencia"];
		}
   mysql_free_result($result);
   return($total);		
}

function deducciones($ced, $link)
{	//ojo falta el codigo de la nomina actual
	$result=mysql_query("select * from nomina where cedula=$ced and tipo='Debito'");
	$total=0;
	while ($asig=mysql_fetch_array($result))
		{
		$total=$total+$asig["monto_incidencia"];
		}
   mysql_free_result($result);
   return($total);		
}

function verificar_usuario($login,$password,$link)
{
	$result=mysql_query("select * from usuarios where login='$login'");
	$usuario=mysql_fetch_array($result);
	
	if ($password==$usuario['password'])
		{
		   mysql_free_result($result);
		return true;
		}
	else
	{   mysql_free_result($result);
		return false;
	}			
}
function buscar_usuario($login,$link)
{
	$result=mysql_query("select * from usuarios where login='$login'");
	$usuario=mysql_fetch_array($result);
	mysql_free_result($result);
	return $usuario;			
}

function anos_servicio($f_ingreso,$f_actual)
{
//fecha final de la nomina actual
$fecha_fin=explode("-",$f_actual);
$dia=$fecha_fin[2];
$mes=$fecha_fin[1];
$ano=$fecha_fin[0];
//fecha de nacimiento
$fecha=explode("/", $f_ingreso);
$dia_ingreso=$fecha[0];
$mes_ingreso=$fecha[1];
$ano_ingreso=$fecha[2];
//si el mes es el mismo pero el dia inferior aun no ha cumplido años, le quitaremos un año al actual
if (($mes_ingreso == $mes) && ($dia_ingreso > $dia)) {
$ano=($ano-1); }
//si el mes es superior al actual tampoco habra cumplido años, por eso le quitamos un año al actual
if ($mes_ingreso > $mes) {
$ano=($ano-1);}
//ya no habria mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
$anos_servicio=($ano-$ano_ingreso);
return($anos_servicio);
}

function cambiar_BsF($monto_BsF)
	{
	return(intval($monto_BsF/10+0.9)/100);//formula para redondear consistente con la regla de redondeo publicada por el BCV.
	}
	
function generar_fila_archivo($cuenta,$monto,$cont)//genera la fila que se inserta en el archivo de texto a enviar al banco	
	{$monto=str_replace(".","",$monto);
	while (strlen($monto)<20)//completar los 20 ceros
		{
		$monto='0'.$monto;
		}
	$fila="\nc/$cuenta/$cont/$monto";
	return ($fila);
	}	
	
function comprobar_concepto($concepto,$cedula,$link)//ojooooo ****** revisar
	{
	$result=mysql_query("select c.abreviatura from integrantes_constantes ic inner join constantes c on ic.cod_constantes=c.cod where ic.cedula=$cedula" ,$link);//todas las abreviaturas del funcionario
	preg_match('/^\s*([a-z]\w*)\s*\(\s*([a-z]\w*(?:\s*,\s*[a-z]\w*)*)\s*\)\s*=\s*(.+)$/', $concepto['formula'], $matches);//divide la ecuacion 
	$args = explode(",", preg_replace("/\s+/", "", $matches[2]));//aqui tengo los argumentos (variables)
	$si=false;//booleano para saber si lo encontro o no
	foreach ($args as $arg)
	{
		while   ($constante=mysql_fetch_array($result))
		{
			if($arg==$constante['abreviatura'])
			$si=true;
		}
	mysql_data_seek($result,0);
	}	
	return $si;
	}
	
?>