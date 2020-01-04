<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  Este archivo brinda soporte para los dem�s en varias funciones que son de utilidad en el c�lculo de fechas, 
  						conversi�n de fechas en formato normal a formato mysql, verificacion de dias habiles, etc.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						03/09/2008 por Pedro E. Arrioja M. - Se convierten los datos de dia, mes y anio esperados por la funci�n maketime 
						           a enteros para evitar el warning del navegador.
					    24/09/2008 por Pedro E. Arrioja M. - Se a�ade la funci�n obtener horario vigente mediante la cual se puede conocer
								   cual es el horario que se encuentra vigente dependiendo de la fecha dada.
  			  Versi�n: 	0.1b
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
/* ******************************************************************************/
    function cambiaf_a_mysql($fecha)
    {
    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
    return $lafecha; 
    }
/* ******************************************************************************/
    function cambiaf_a_normal($fecha)
    {
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
	 } 

/* ******************************************************************************/
	function dias_entre_fechas($fecha1,$fecha2)
	{	// Separo los datos de fechamayor y fechamenor
	    list($dia1,$mes1,$ano1) = explode("/",$fecha1); 
	    list($dia2,$mes2,$ano2) = explode("/",$fecha2);	
		//calculo timestam de las dos fechas
		$mes1=intval($mes1);
		$dia1=intval($dia1);
		$ano1=intval($ano1);
		$mes2=intval($mes2);
		$dia2=intval($dia2);
		$ano2=intval($ano2);		
		$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
		$timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2);
		
		//resto a una fecha la otra
		$segundos_diferencia = $timestamp1 - $timestamp2;		
		//convierto segundos en d�as
		$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);		
		//obtengo el valor absoulto de los d�as (quito el posible signo negativo si me mandan las fechas menor y mayor invertidas)
		$dias_diferencia = abs($dias_diferencia);
		//quito los decimales a los d�as de diferencia
		$dias_diferencia = intval($dias_diferencia);			
		return $dias_diferencia;
	} 	 

/* ******************************************************************************/
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

/* ******************************************************************************/
    function obtener_horario_vigente($fecha, $link321)
	{ // esta funci�n obtiene el horario que se encuentra vigente dado una fecha.
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

/*   function obtener_horarios($link323)
	{ // esta funci�n obtiene el horario que se encuentra vigente dado una fecha.
	  // la fecha suministrada debe venir en formato mysql
      $consulta_horario_especial=mysql_query("select * 
	  										  from asistencias.opciones",$link323) or die(mysql_error());											
	  if (mysql_num_rows($consulta_horario_especial) > 0) 
	    {
          while($horario_retorno[]=mysql_fetch_array($consulta_horario_especial)) 
	        {
	         // para poder cumplir el ciclo;
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
	} */

/*******************************************************************************/
	function es_feriado($fecha, $link2)
	{ /* �sta funci�n puede devolver uno de los siguientes valores:   
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
		 // si es feriado en dia de semana retorno la se�al adem�s de la descripcion del laborable
		 case 1: return array($tipo_feriado,$descrip);
		 		 break;
		 // si es fin de semana simplemente retorno el valor 2
		 case 2: return $tipo_feriado;
		 		 break;
		 // si es feriado en fin de semana retorno el valor 3 pq no me interesa la descripci�n si cae fin de semana		 
		 case 3: return $tipo_feriado;
		 		 break;
	  }
	}

	function es_dia($fecha,$lu,$ma,$mi,$ju,$vi)
	{ /* �sta funci�n s�lo comprueba que la fecha corresponda con alguno de los d�as de la semana marcados para comparar, es realmente �til
	     en la comprobaci�n de los permisos recurrentes de los reportes de asistencias; p.e. 05/05/2008,1,0,1,0,1 da como resultado true porque se
		 consulta la fecha (Lunes) y si cae lunes, miercoles o viernes, la funci�n se evalua cierta si la fecha cae en alguno de los dias de la semana 
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
		       }// del else del mi�rcoles		   
		   } // del else del martes
	   }// del else del lunes	 
	return $resultado;
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













 // la siguiente funci�n hace en escencia lo mismo que suma dias habiles, pero con el agregado de que devuelve el numero de dias feriados (de acuerdo con nuestra base de datos) que existe desde la fecha dada y x dias feriados hacia adelante
	function cuenta_feriados($fecha, $dias, $link)
	{  $primera_corrida=true; $cuentaferiados=0;
		while ($dias!=0) 
		{ 
		  if ($primera_corrida == false) {$fecha = suma_dias($fecha, 1);}
		  $primera_corrida = false;
		  $fer='99'; // para tener un valor inicial para comparar si la funci�n no trae resultado
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
} // de la funci�n.
	
?>
