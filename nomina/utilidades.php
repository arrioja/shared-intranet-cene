<?php 

	function abrir_popup($url,$parametros)
	{
	?><script language="JavaScript">
	window.open("<?echo $url;?>","","<?echo $parametros;?>")
	</script><?php
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
	 
	function dias_entre_fechas($fecha1,$fecha2)
	{	// Separo los datos de fechamayor y fechamenor
	    list($dia1,$mes1,$ano1) = explode("/",$fecha1); 
	    list($dia2,$mes2,$ano2) = explode("/",$fecha2);	
		//calculo timestam de las dos fechas
		$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
		$timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2);		
		//resto a una fecha la otra
		$segundos_diferencia = $timestamp1 - $timestamp2;		
		//convierto segundos en días
		$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);		
		//obtengo el valor absoulto de los días (quito el posible signo negativo si me mandan las fechas menor y mayor invertidas)
		$dias_diferencia = abs($dias_diferencia);
		//quito los decimales a los días de diferencia
		$dias_diferencia = intval($dias_diferencia);			
		return $dias_diferencia;
	} 	 
	
	function suma_dias($fecha, $ndias)
	{
		list($dia, $mes, $anio) = split("/", $fecha);
		$nueva = mktime(0, 0, 0, $mes, $dia, $anio) + $ndias * 24 * 60 * 60;
		$nuevafecha = date("d/m/Y", $nueva);
		return($nuevafecha);
	}


	function es_feriado($fecha, $link2)
	{ /* ésta función puede devolver uno de los siguientes valores:   
	    0: si es laborable (ni feriado ni fin de semana
	    1: si es feriado en dia de semana (no cae en fin de semana)
		2: si es fin de semana no feriado
		3: si es fin de semana feriado
 	  */
	 $tipo_feriado=0;
	 $contador=0; $elementos=0; $esferiado=false;
	  // antes de calcular las fechas se carga en un arreglo los datos de dias festivos de la base de datos
      $consulta_feriados=mysql_query("select * from asistencias_dias_no_laborables order by ano,mes,dia",$link2) or die(mysql_error());
	  while($feriado[]=mysql_fetch_array($consulta_feriados)){$elementos++;}; 
	  list($dia, $mes, $anio) = split("/", $fecha);
	  while (($contador <= $elementos-1) && ($esferiado==false))
		  {
		    if ((($feriado[$contador]['dia'] == $dia) && ($feriado[$contador]['mes'] == $mes)) && (($feriado[$contador]['ano'] == $anio) || ($feriado[$contador]['ano'] == 'XXXX'))) { $esferiado=true; $tipo_feriado=1;}
		    $contador++;
		  }
	  
	  if ($esferiado == false) 
	    {
          if ((date("D", mktime(0, 0, 0, $mes, $dia, $anio)) == 'Sat' || date("D", mktime(0, 0, 0, $mes, $dia, $anio)) == 'Sun'))
		    {$esferiado=true; $tipo_feriado=2;}	  
	    }
		
	  if ($esferiado == true) 
	    {
          if ((date("D", mktime(0, 0, 0, $mes, $dia, $anio)) == 'Sat' || date("D", mktime(0, 0, 0, $mes, $dia, $anio)) == 'Sun'))
		    {$tipo_feriado=3;}		  
	    }			
		
	return $tipo_feriado;
	}



	function suma_dias_habiles($fecha, $dias, $link)
	{ $primera_corrida=true;
		while ($dias!=0) 
		{ 
		  if ($primera_corrida == false) {$fecha = suma_dias($fecha, 1);}
		  $primera_corrida = false;
		  if (es_feriado($fecha,$link) == 0) { $dias--; }	  
	    }
	return $fecha;
	}


/*	function suma_dias_habiles($fecha, $dias, $link)
	{ $elementos=0; $num_feriados=0; $primera_corrida=true;
	  // antes de calcular las fechas se carga en un arreglo los datos de dias festivos de la base de datos
      $consulta_feriados=mysql_query("select * from asistencias_dias_no_laborables order by ano,mes,dia",$link) or die(mysql_error());
	  while($feriado[]=mysql_fetch_array($consulta_feriados)){$elementos++;}; 
      // $resultado=mysql_fetch_array($consulta);
		while ($dias!=0) 
		{ $es_feriado='no';
		  $contador=0;
		  if ($primera_corrida == false) {$fecha = suma_dias($fecha, 1);}
		  $primera_corrida = false;
		  list($dia, $mes, $anio) = split("/", $fecha);
		  // busco los feriados en el arreglo, compruemo que dia, mes y año sean iguales o sea igual para el año "todos", 
		  //representado por "XXXX";
		  while (($contador <= $elementos-1) && ($es_feriado=='no'))
		  {
		    if ((($feriado[$contador]['dia'] == $dia) && ($feriado[$contador]['mes'] == $mes)) && (($feriado[$contador]['ano'] == $anio) || ($feriado[$contador]['ano'] == 'XXXX'))) { $es_feriado='si'; $num_feriados++;}
		    $contador++;
		  }
		  echo $dia."/".$mes."/".$anio." - ".date("D", mktime(0, 0, 0, $mes, $dia, $anio));
		  if ((date("D", mktime(0, 0, 0, $mes, $dia, $anio)) != 'Sat' && date("D", mktime(0, 0, 0, $mes, $dia, $anio)) != 'Sun') && ($es_feriado=='no'))
		  {$dias--;}
		  
	    }
	return $fecha;
	}*/



// la siguiente función hace en escencia lo mismo que suma dias habiles, pero con el agregado de que devuelve el numero de dias feriados (de acuerdo con nuestra base de datos) que existe desde la fecha dada y x dias feriados hacia adelante
	function cuenta_feriados($fecha, $dias, $link)
	{  $primera_corrida=true; $cuentaferiados=0;
		while ($dias!=0) 
		{ 
		  if ($primera_corrida == false) {$fecha = suma_dias($fecha, 1);}
		  $primera_corrida = false;
		  if (es_feriado($fecha,$link) == 1) { $cuentaferiados++; } else { if (es_feriado($fecha,$link) == 0) { $dias--; }}	  
	    }
	return $cuentaferiados;
	}
	
	
	
?>
