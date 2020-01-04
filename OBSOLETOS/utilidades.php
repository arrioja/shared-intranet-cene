<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Este archivo brinda soporte para los demás en varias funciones que son de utilidad en el cálculo de fechas, 
  						conversión de fechas en formato normal a formato mysql, verificacion de dias habiles, etc.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						03/09/2008 por Pedro E. Arrioja M. - Se convierten los datos de dia, mes y anio esperados por la función maketime 
						           a enteros para evitar el warning del navegador.
					    24/09/2008 por Pedro E. Arrioja M. - Se añade la función obtener horario vigente mediante la cual se puede conocer
								   cual es el horario que se encuentra vigente dependiendo de la fecha dada.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
	function solo_nombre_arch($url)
	{
      $break = Explode('/', $url);
      $pfile = $break[count($break) - 1]; 
	  return $pfile;
	}

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
		$mes1=intval($mes1);
		$dia1=intval($dia1);
		$ano1=intval($ano1);
		$mes2=intval($mes2);
		$dia2=intval($dia2);
		$ano2=intval($ano2);		
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
		$mes=intval($mes);
		$dia=intval($dia);
		$ano=intval($ano);
		$nueva = mktime(0, 0, 0, $mes, $dia, $anio) + $ndias * 24 * 60 * 60;
		$nuevafecha = date("d/m/Y", $nueva);
		return $nuevafecha;
	}




 function obtener_horario_vigente($fecha, $link321)
	{ // esta función obtiene el horario que se encuentra vigente dado una fecha.
	  // la fecha suministrada debe venir en formato mysql
      $consulta_horario_especial=mysql_query("select * 
	  										  from asistencias.opciones 
	  										  where ((vigencia_desde <= '$fecha') and (vigencia_hasta >= '$fecha') 
											        and (status = 2))",$link321) or die(mysql_error());											
	  if (mysql_num_rows($consulta_horario_especial) > 0) 
	    {
		  $horario_esp=mysql_fetch_array($consulta_horario_especial);
		} // del if status 2
	  else
	    {
		  $consulta_horario_especial=mysql_query("select * 
												  from asistencias.opciones 
												  where ((vigencia_desde <= '$fecha') and (vigencia_hasta >= '$fecha') 
														and (status = 1))",$link321) or die(mysql_error());
		  if (mysql_num_rows($consulta_horario_especial) > 0) 
			{
			  $horario_esp=mysql_fetch_array($consulta_horario_especial);
			} // del if status 1
		} //del else del if status=2
		//mysql_close($link321);
		return $horario_esp;
	}

  function obtener_horarios($link323)
	{ // esta función obtiene el horario que se encuentra vigente dado una fecha.
	  // la fecha suministrada debe venir en formato mysql
      $consulta_horario_especial=mysql_query("select * 
	  										  from asistencias.opciones",$link323) or die(mysql_error());											
	  if (mysql_num_rows($consulta_horario_especial) > 0) 
	    {
          while($horario_retorno[]=mysql_fetch_array($consulta_horario_especial)) 
	        {
	         // para perder tiempo y poder cumplir el ciclo;
			 $variable_de_desperdicio=$variable_de_desperdicio+1;
	        };		
		} // del if status 2
	  else
	    {
		  $horario_retorno=0;
		} //del else del if status=2
		//mysql_close($link321);
		return $horario_retorno;
		break;
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
      $consulta_feriados=mysql_query("select * from organizacion.dias_no_laborables order by ano,mes,dia",$link2) or die(mysql_error());
	  while($feriado[]=mysql_fetch_array($consulta_feriados)){$elementos++;}; 
	  list($dia, $mes, $anio) = split("/", $fecha);
	  	$mes=intval($mes);
		$dia=intval($dia);
		$anio=intval($anio);
	  while (($contador <= $elementos-1) && ($esferiado==false))
		  {
		    if ((($feriado[$contador]['dia'] == $dia) && ($feriado[$contador]['mes'] == $mes)) && (($feriado[$contador]['ano'] == $anio) || ($feriado[$contador]['ano'] == 'XXXX'))) { $esferiado=true; $tipo_feriado=1; $descrip=$feriado[$contador]['descripcion'];}
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
	//mysql_close($link2);
	switch ($tipo_feriado)
	  {  // si es laborable, retorno solo diciendo que es laborable "0"
	     case 0: return $tipo_feriado;
		 		 break;
		 // si es feriado en dia de semana retorno la señal además de la descripcion del laborable
		 case 1: return array($tipo_feriado,$descrip);
		 		 break;
		 // si es fin de semana simplemente retorno el valor 2
		 case 2: return $tipo_feriado;
		 		 break;
		 // si es feriado en fin de semana retorno el valor 3 pq no me interesa la descripción si cae fin de semana		 
		 case 3: return $tipo_feriado;
		 		 break;
	  }
	}



	function es_dia($fecha,$lu,$ma,$mi,$ju,$vi)
	{ /* ésta función sólo comprueba que la fecha corresponda con alguno de los días de la semana marcados para comparar, es realmente útil
	     en la comprobación de los permisos recurrentes de los reportes de asistencias; p.e. 05/05/2008,1,0,1,0,1 da como resultado true porque se
		 consulta la fecha (Lunes) y si cae lunes, miercoles o viernes, la función se evalua cierta si la fecha cae en alguno de los dias de la semana 
		 marcados con 1*/	 
	 $resultado=false;
	 list($dia, $mes, $anio) = split("/", $fecha);
	 $mes=intval($mes);
	 $dia=intval($dia);
	 $anio=intval($anio);
	 if ((date("D", mktime(0, 0, 0, $mes, $dia, $anio)) == 'Mon') && ($lu==1))
	   {$resultado=true;}
	 else
	   {
	     if ((date("D", mktime(0, 0, 0, $mes, $dia, $anio)) == 'Tue') && ($ma==1))
	       {$resultado=true;}
		 else
		   {
             if ((date("D", mktime(0, 0, 0, $mes, $dia, $anio)) == 'Wed') && ($mi==1))
	           {$resultado=true;}
		     else
		       {
                 if ((date("D", mktime(0, 0, 0, $mes, $dia, $anio)) == 'Thu') && ($ju==1))
	               {$resultado=true;}
		         else
		           {
                     if ((date("D", mktime(0, 0, 0, $mes, $dia, $anio)) == 'Fri') && ($vi==1))
	                   {$resultado=true;}		   		   		   
		           } // del else del jueves		   		   
		       }// del else del miércoles		   
		   } // del else del martes
	   }// del else del lunes	 
	return $resultado;
	}

// ojo, esta funcion esta duplicada
 	function suma_dias_habiles_array($fecha, $dias, $link)
	{ $primera_corrida=true;
		while ($dias!=0) 
		{ 
		  if ($primera_corrida == false) {$fecha = suma_dias($fecha, 1);}
		  $primera_corrida = false;
		  $result_es_feriado = es_feriado($fecha,$link); 
		  if (!(is_array($result_es_feriado)))
		    { // se comprueba que no es arreglo para evitar problemas de tipo de variable a la hora de comparar.
		      if ( $result_es_feriado == 0) { $dias--; }	 
			} 
	    }
	//mysql_close($link);
	return $fecha;
	} 

 	function suma_dias_habiles($fecha, $dias, $link)
	{ $primera_corrida=true;
		while ($dias!=0) 
		{ 
		  if ($primera_corrida == false) {$fecha = suma_dias($fecha, 1);}
		  $primera_corrida = false;
		  $result_es_feriado = es_feriado($fecha,$link); 
		  if (!(is_array($result_es_feriado)))
		    { // se comprueba que no es arreglo para evitar problemas de tipo de variable a la hora de comparar.
		      if ( $result_es_feriado == 0) { $dias--; }	 
			} 
	    }
	//mysql_close($link);
	return $fecha;
	} 

// Esta funcion devuelve el numero de dias que deben ser descontados de las vacaciones si las mismas son 
// solicitadas durante la vigencia de un horario especial
/*
LA ORIGINAL:
 function calcula_dias_restados($fechamy,$diasX,$linkX)
  { // la nombre fechamy para acordarme que esta en formato mysql
    $cuenta_dias_recorridos=1;
	$cuenta_dias_descuento=0;
	$horariosX=obtener_horarios($linkX);
	while ($diasX!=0) 
	{ 
	  $horarioX=obtener_horario_vigente($fechamy,$linkX);
	  if ($horarioX['dias_a_contar'] > 0) 
	    { 
		  if ($cuenta_dias_recorridos == $horarioX['dias_a_contar'])
		    {
		      $cuenta_dias_recorridos=1;
		      $cuenta_dias_descuento++;
			}
		  else
		    {
			  $cuenta_dias_recorridos++;
			}
	    }
	  else // del if dias a contar = 0
	    { // devuelvo los dias recorridos a cero porque si cae aqui estamos leyendo un horario normal, por lo tanto no hay nada especial
		  $cuenta_dias_recorridos=1;
		} 
	  $fechamy=cambiaf_a_mysql(suma_dias_habiles(cambiaf_a_normal($fechamy), 2, $linkX));
	  $diasX--;  
	}
	return $cuenta_dias_descuento;
  } */

 function calcula_dias_restados21221($fechamy,$diasX,$linkX)
  { // la nombre fechamy para acordarme que esta en formato mysql
    $cuenta_dias_recorridos=1;
	$cuenta_dias_descuento=0;
	$horariosX=obtener_horarios($linkX);
	while ($diasX!=0) 
	{ 
	  $xcont=0;
	  $ya='no';
	  while (($xcont< count($horariosX)) and ($ya !='si'))
	   {
	    if (($horariosX[$xcont]['vigencia_desde'] <= '$fechamy') and ($horariosX[$xcont]['vigencia_hasta'] >= '$fechamy') 
		     and ($horariosX[$xcont]['status'] = 2))
		  {
		    $ya='si';
		  }
	    else
		  {
		    $xcont++;
		  }
	   } // del while xcount
	  if ($ya == 'no')
	    { $xcont=0; 
		  while (($xcont< count($horariosX)) and ($ya !='si'))
	        {
	           if (($horariosX[$xcont]['vigencia_desde'] <= '$fecha') and ($horariosX[$xcont]['vigencia_hasta'] >= '$fecha') 
		           and ($horariosX[$xcont]['status'] = 1))
		         {
		           $ya='si';
		         }
	           else
		         {
		           $xcont++;
		         }
			}
		} // del ya = no
		  
	  if ($ya == 'si')
	    {		  
		  if ($horariosX[$xcont]['dias_a_contar'] > 0) 
			{ 
			  if ($cuenta_dias_recorridos == $horariosX[$xcont]['dias_a_contar'])
				{
				  $cuenta_dias_recorridos=1;
				  $cuenta_dias_descuento++;
				}
			  else
				{
				  $cuenta_dias_recorridos++;
				}
			}
		  else // del if dias a contar = 0
			{ // devuelvo los dias recorridos a cero porque si cae aqui estamos leyendo un horario normal, por lo tanto no hay nada especial
			  $cuenta_dias_recorridos=1;
			} 
		  $fechamy=cambiaf_a_mysql(suma_dias_habiles(cambiaf_a_normal($fechamy), 2, $linkX));
		  $diasX--;  
	    } // del if ya == si
	} // del while dias
	return $cuenta_dias_descuento;
  }
  
 
 
 // la siguiente función hace en escencia lo mismo que suma dias habiles, pero con el agregado de que devuelve el numero de dias feriados (de acuerdo con nuestra base de datos) que existe desde la fecha dada y x dias feriados hacia adelante
	function cuenta_feriados($fecha, $dias, $link)
	{  $primera_corrida=true; $cuentaferiados=0;
		while ($dias!=0) 
		{ 
		  if ($primera_corrida == false) {$fecha = suma_dias($fecha, 1);}
		  $primera_corrida = false;
		  $fer='99'; // para tener un valor inicial para comparar si la función no trae resultado
		  $desfer='XX'; // igual que el anterior
		   if ((list($fer,$desfer) = es_feriado($fecha,$link)) && ($fer==1))		  
		  //if (es_feriado($fecha,$link) == 1) 
		  { $cuentaferiados++; } else { if (es_feriado($fecha,$link) == 0) { $dias--; }}	  
	    }
	//mysql_close($link);
	return $cuentaferiados;
	}
	


function descuento_especial_de_dias($restar,$cedula_restar,$link999)
{
 while ($restar > 0)
   {   
     $consulta_vac=mysql_query("select * 
 						        from asistencias.vacaciones as v  
						        where((v.cedula='$cedula_restar') and 
							          (v.pendientes>'0')) 
						        order by v.pendientes",$link999) or die(mysql_error());
	 $result_descuento=mysql_fetch_array($consulta_vac);	// se toma el primero
	 $periodo_a_restar=$result_descuento['periodo']; // para saber el periodo que se esta tomando para restar
	 if ($result_descuento['pendientes'] >= $restar)
	   { // si se puede descontar todos los dias se descuentan los dias del primer periodo que se haya seleccionado.	
		 $valor_a_restar = $restar;
		 $restar = 0;
	   }
	 else
	   { // si no se pueden descontar todos los dias, se descuentan los que se puedan y se deja correr el ciclo.	
		 $valor_a_restar = $result_descuento['pendientes'];
		 $restar=$restar-$valor_a_restar;
	   }
	   // ejecuto la consulta para restar los dias que se haya decidido restar del periodo seleccionado. 
	   mysql_query("update asistencias.vacaciones set pendientes=pendientes-'$valor_a_restar', disfrutados=disfrutados+'$valor_a_restar',  
		 		    restados=restados+'$valor_a_restar' 
	                where cedula='$cedula_restar' and periodo='$periodo_a_restar'",$link999)or die(mysql_error());	   
   } // del while			  
} // de la función.

	
	
?>
