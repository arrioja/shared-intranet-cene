<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Se inserta una nueva solicitud de vacaciones por parte de un funcionario y se deja pendiente para su aprobación.
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M.
						11/09/2008 por Pedro E. Arrioja M. - Se añade rastreo.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
  session_start();
  include("../../db/inserta_rastreo.php");
  include("../../db/conexion.php");
  include("../../libs/utilidades.php");
  $link=conectarse("asistencias");
  $cedula=$_POST['cedula'];
  $dias=$_POST['dias'];
  $observaciones=$_POST['observaciones'];
  $total_dias=$_POST['total_dias'];
  $cuenta_vacaciones=$_POST['cuenta_vacaciones'];	
  
// esta es una pequeña estructura ara guardar datos relativos a cada periodo de vacaciones que no se pueden extraer de la tabla pero
// que son necesarios para el calculo final  
  $mas_campos = array(
        "fecha_desde"=>"",
        "dias_disfrute"=>"",
        "dias_feriados"=>"",
        "fecha_inicio"=>"",
        "fecha_fin"=>"",
		"dias_restados"=>0);

  $consulta_vacaciones=mysql_query("select * from asistencias.vacaciones as v
                                    where((v.cedula='$cedula') and 
									(v.pendientes>'0')) 
									order by v.disponible_desde",$link) or die(mysql_error());
  while($datos_periodos[]=mysql_fetch_array($consulta_vacaciones)) 
	{ // para poder añadir los campos que hacen falta para la estructura del arreglo que necesito.
	  $datos_periodos=array_merge($datos_periodos, $mas_campos); 
	};
	
/*	$consulta_referencia=mysql_query("select MAX(referencia) as maximo from asistencias_vacaciones_disfrute",$link) or die(mysql_error());
	$referencia=mysql_fetch_array($consulta_referencia); 
	$ref=$referencia['maximo'];
	if (isset($ref) == false) {$ref = 1;} else {$ref++;}	*/																
   $lineas=0;
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
	background-image: url(../../imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->


<link href="../../css/formularios.css" rel="stylesheet" type="text/css" />
<link href="../../css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
.Estilo2 {font-weight: bold}
-->
</style>
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="../../imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="../../imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="../../imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="../../imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="../../imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="../../imgs/CENE_07.png">      <div align="right">
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
<p>
  <?php
  // Se calculan cuántos dias deben ser descontados al funcionario si esta agarrando las vacaciones en periodo de horario especial
  // (como por ejemplo el navideño) en el cual se le descuentan 1 dia de vacaciones por cada 7 que tome.
  
 function calcula_dias_restados($fechamy,$diasX,$linkX)
  { // la nombre fechamy para acordarme que esta en formato mysql
    $cuenta_dias_recorridos=1;
	$cuenta_dias_descuento=0;
	$horariosX=obtener_horarios($linkX);
	while ($diasX!=0) 
	{ 
	  $xcont=0;
	  $ya='no';
	  while (($xcont< count($horariosX)-1) and ($ya !='si'))
	   {
	    if (($horariosX[$xcont]['vigencia_desde'] <= '$fechamy') and ($horariosX[$xcont]['vigencia_hasta'] >= '$fechamy') 
		     and ($horariosX[$xcont]['status'] = 2))
		  {
		    $ya=si;
		  }
	    else
		  {
		    $xcont++;
		  }
	   } // del while xcount
	  if ($ya == 'no')
	    { $xcont=0; 
		  while (($xcont< count($horariosX)-1) and ($ya !='si'))
	        {
	           if (($horariosX[$xcont]['vigencia_desde'] <= '$fecha') and ($horariosX[$xcont]['vigencia_hasta'] >= '$fecha') 
		           and ($horariosX[$xcont]['status'] = 1))
		         {
		           $ya=si;
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


  
  $dias_restados=calcula_dias_restados(cambiaf_a_mysql($_POST['fecha_desde']),$dias,$link);
  //$dias_restados=0;
  echo "1";
  
    // se comprueba que la fecha seleccionada es desde hoy en adelante y que no quiera iniciar en un fin de semana o en un feriado. 
  //  if ((cambiaf_a_mysql($_POST['fecha_desde']) >= date("Y-m-d")) && (es_feriado($_POST['fecha_desde'],$link) == 0))
  // la siguiente instruccion le falta la comprobacion de fecha actual de la de arriba, pero para poder adelantar mas rapido, se la puse asi 
  // para que funcione normalmente, debo quitar la linea que sigue y descomentar la anterior.
    if (es_feriado($_POST['fecha_desde'],$link) == 0) 
      {  //1001
		$datos_periodos[$lineas]['fecha_desde']=$_POST['fecha_desde'];  // para iniciar las comparaciones
		$error='no';
		while (($dias > 0) && ($error=='no'))
		{//1002 //   si la fecha en la que quiere disfrutar la vac, es mayor que la fecha en la que puede hacerlo, entonces 
		 // se inicia el procedimiento para sumarle los dias 
		   if ($datos_periodos[$lineas]['fecha_desde'] != '') 
			{ //1003
			   if (cambiaf_a_mysql($datos_periodos[$lineas]['fecha_desde']) >= $datos_periodos[$lineas]['disponible_desde'])
			   {  //1004
				   if ($dias <= $datos_periodos[$lineas]['pendientes'])
					 { //1005 // si solicita menos o igual dias de los disponibles en su periodo entonces se suma $dias a los dias laborables 
					   if (($total_dias-$dias) >= ($dias_restados)) // se comprueba que tenga dias para el descuento
				         {//1006
						   $datos_periodos[$lineas]['fecha_inicio']=$datos_periodos[$lineas]['fecha_desde'];
						   $datos_periodos[$lineas]['fecha_fin']=suma_dias_habiles($datos_periodos[$lineas]['fecha_desde'], $dias, $link);
						   $datos_periodos[$lineas]['dias_disfrute']=$dias;	
						   $datos_periodos[$lineas]['dias_feriados']=cuenta_feriados($datos_periodos[$lineas]['fecha_desde'], $dias, $link);
						   $datos_periodos[$lineas]['dias_restados']=$dias_restados;
						   $dias=$dias-$dias;	 
						 } // -1006
					   else // del dias pendientes, si entra en este else, no tiene dias para pagar el descuento aun y cuando pueda hacerlo.
					     {//1007 // si no le quedan dias para descontarle
						   $dias=$dias-$dias; // para romper el ciclo;
						    $error='si';?>	  
						   <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
						   <tr class="encabezado_formularios">
						     <td width="500"><span class="Estilo2 Estilo1 Estilo1">ERROR al procesar sus vacaciones</span></td>
						   </tr>
						   <tr>
						     <td class="datos_formularios"><div align="justify">Est&aacute; solicitando vacaciones durante un
						     horario afectado por condiciones de descuentos de d&iacute;as, y de acuerdo nuestros datos no posee d&iacute;as 
						     suficientes para poder honrar el descuento, 
						     por favor, solicite menos dias de vacaciones para poder procesar su solicitud.<br /> 
						    </div></td>
						   </tr>
						   <tr>
						     <td class="datos_formularios"> <div align="center">
							  <?php echo " Para volver haga click "?> 
							  <a href="../incluir_vacacion_cedula.php">aqui</a> </div></td></tr>
						   </table>    	<p>  <?php
					     }	//-1007						   
					  } // - 1005
				   else // del if ($dias <= $datos_periodos[$lineas]['pendientes'])
					 { // 1008// si los dias superan a los disponibles a los del periodo se suman los disponibles en el periodo.
					   $datos_periodos[$lineas]['fecha_inicio']=$datos_periodos[$lineas]['fecha_desde'];
					   $datos_periodos[$lineas]['fecha_fin']=
								 suma_dias_habiles($datos_periodos[$lineas]['fecha_desde'], $datos_periodos[$lineas]['pendientes'], $link);
					   $datos_periodos[$lineas]['dias_disfrute']=$datos_periodos[$lineas]['pendientes'];	
					   $datos_periodos[$lineas]['dias_feriados']=
								 cuenta_feriados($datos_periodos[$lineas]['fecha_desde'], $datos_periodos[$lineas]['pendientes'], $link);
					   $datos_periodos[$lineas]['dias_restados']=0;
					   // le sumo un dia a la siguiente fecha desde para comprobar porque se supone que si gasto los dias disponibles en 
					   // el periodo que estoy evaluando, hay que iniciar el conteo del próximo periodo desde el dia hábil siguiente.
					   $datos_periodos[$lineas+1]['fecha_desde']=suma_dias_habiles($datos_periodos[$lineas]['fecha_fin'], 2, $link);	
					   $dias=$dias-$datos_periodos[$lineas]['pendientes'];			
					   $lineas++;
					 }//-1008
//				  }
			   }//-1004
			   else
			   { //1009// del if de la fecha desde, si se entra en este else, quiere decir que no se ha 
				 // llegado a la fecha en la cual puede agarrar
				 // vacaciones en este periodo.
				?> 			 
<table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
					<tr class="encabezado_formularios">
					  <td width="500"><span class="Estilo2 Estilo1 Estilo1">ERROR al procesar sus vacaciones</span></td>
					</tr>
					<tr>
					  <td class="datos_formularios"><div align="justify">La fecha desde la cual puede disfrutar de los dias 
                      de vacaciones disponibles en el periodo <?php echo $datos_periodos[$lineas]['periodo']; ?> es a partir 
                      del <?php echo cambiaf_a_normal($datos_periodos[$lineas]['disponible_desde']); ?>, corrija su 
                      solicitud para poder continuar.<br /> 
					  </div></td>
					</tr>
	                 <tr>
					  <td class="datos_formularios"> <div align="center">
						<?php echo " Para volver haga click "?> 
						<a href="../incluir_vacacion_cedula.php">aqui</a> </div></td></tr>
</table>    			 
							 
				   <p>
      <?php			 
				 $error='si';
			   }//-1009
			} //1003 // del si la fecha esta vacia, si esta vacia quiere decir que no se debe hacer nada con ese periodo de vacaciones
		} //1002 // del while
	
		  if ($error == 'no')
		   { 
		
	?>
        </p>
				   <table width="547" border="1" align="center" cellpadding="0" cellspacing="0">
                     <tr>
                       <td colspan="6" class="encabezado_formularios">Se ha registrado su solicitud con los datos siguientes:</td>
                     </tr>
                     <tr>
                       <td width="107" class="encabezado_formularios">Per&iacute;odo</td>
                       <td width="121" class="encabezado_formularios">D&iacute;as</td>
                       <td width="105" class="encabezado_formularios">Desde</td>
                       <td width="107" class="encabezado_formularios">Hasta</td>
                       <td width="95" class="encabezado_formularios">Feriados</td>
                       <td width="95" class="encabezado_formularios">Descuentos</td>
                     </tr>
                     <?php
                for ($ij=0; $ij< $cuenta_vacaciones; $ij++) 
				{
				  if (isset($datos_periodos[$ij]['fecha_inicio'])) 
				  {
				    // para asegurar compatibilidad y evitar errores de interpretación de comillas por parte de los depuradores y 
					// los compiladores, voy a usar variables intermedias.
						$a=$datos_periodos[$ij]['periodo'];
						$b=$datos_periodos[$ij]['dias_disfrute'];
						$c=cambiaf_a_mysql($datos_periodos[$ij]['fecha_inicio']);
						$d=cambiaf_a_mysql($datos_periodos[$ij]['fecha_fin']);
						$e=$datos_periodos[$ij]['dias_feriados'];
						$f=$datos_periodos[$ij]['cedula'];
						$g=$observaciones;	
						$k=$datos_periodos[$ij]['dias_restados'];
						//$h=$ref;			
						if ($insertar=mysql_query("insert into asistencias.vacaciones_disfrute (cedula, dias_disfrute, 
						dias_feriados, dias_restados, fecha_desde, fecha_hasta, periodo, observaciones, estatus) values 
						('$f','$b','$e','$k','$c','$d','$a','$g','0')",$link))
						 {
						   // para ingresar marca de auditoria.  
						   $descripcion='Inserta nueva solicitud de vacaci&oacute;n, Per&iacute;odo:'.$datos_periodos[$ij]['periodo'].', d&iacute;as: '.$datos_periodos[$ij]['dias_disfrute'].' desde: '.$datos_periodos[$ij]['fecha_inicio'].' hasta: '.$datos_periodos[$ij]['fecha_fin'];
						   $ip = $REMOTE_ADDR; 
						   inserta_rastro($_SESSION['login'],$_SESSION['cedula'],'I',$descripcion,$ip);
						 
						   mysql_query("COMMIT");  // para grabar los datos definitivamente y cerrar la transaccion
						   ?>
							 <tr>
							   <td><div align="center"><?php echo $datos_periodos[$ij]['periodo']; ?></div></td>
							   <td><div align="center"><?php echo $datos_periodos[$ij]['dias_disfrute']; ?></div></td>
							   <td><div align="center"><?php echo $datos_periodos[$ij]['fecha_inicio']; ?></div></td>
							   <td><div align="center"><?php echo $datos_periodos[$ij]['fecha_fin']; 
																  $ultima_fecha=$datos_periodos[$ij]['fecha_fin'];?></div></td>
							   <td><div align="center"><?php echo $datos_periodos[$ij]['dias_feriados']; ?></div></td>
                                <td><div align="center"><?php echo $datos_periodos[$ij]['dias_restados']; ?></div></td>
							 </tr>
							<?php
						 }
						  else
						 {
						 ?>                    
							   <tr class="datos_formularios">
							   <td colspan="6" class="datos_formularios"><div align="justify">Es posible que su solicitud 
							   de vacación no se haya guardado correctamente, ya que ccurrió un error al guargar el registro 
							   de las vacaciones correspondiente a los <?php echo $datos_periodos[$ij]['dias_disfrute']; ?> días 
							   del período <?php echo $datos_periodos[$ij]['periodo']; ?>. Antes de cerrar esta ventana notifique 
							   a la Dirección de Sistemas. Error resultante: <?php echo mysql_error(); ?></div></td>
							   </tr>               
					   <?php 
						   mysql_query("ROLLBACK"); // si hay problemas con el comprobante se hace rollback para que no se grabe nada
						  };  				  
				   } // del isset del fechainicio
			    } // del for ?>    
                     <tr class="datos_formularios">
                       <td colspan="6" class="datos_formularios"><div align="justify">De ser aprobada esta solicitud usted deber&aacute; reincorporarse a sus actividades en la Contralor&iacute;a el d&iacute;a: <strong><?php echo suma_dias_habiles($ultima_fecha, 2, $link);?></strong></div></td>
                     </tr>
                     <tr>
                       <td colspan="6" class="datos_formularios"><div align="right"><a href="../incluir_vacacion_cedula.php">Volver</a></div></td>
                     </tr>
                   </table>
<p>
	<?php	
	      } // del if error = no
	  }// de la comprobación de que la fecha es futura
    else
      {	?> 			 
                                         </p>
				   <table width="504" border="1" align="center" cellpadding="0" cellspacing="0">
					<tr class="encabezado_formularios">
					  <td width="500"><span class="Estilo2 Estilo1 Estilo1">ERROR al procesar sus vacaciones</span></td>
					</tr>
					<tr>
					  <td class="datos_formularios"><div align="justify">
					    <p>Con el objeto de evitar inconsistencias en el 
				        c&aacute;lculo de las fechas de reingreso post-vacaciones, es necesario que compruebe lo siguiente:<br />
				        1.- La fecha de inicio
				        seleccionada para el disfrute sea igual o mayor a la fecha actual.<br />
				        2.- Que no ha seleccionado un fin de semana o un d&iacute;a feriado para el inicio de sus vacaciones.<br /> 
				        </p>
					    </div></td>
					</tr>
	                <tr>
					  <td class="datos_formularios"> <div align="center">
						<?php echo " Para volver haga click "?> 
						<a href="../incluir_vacacion_cedula.php">aqui</a> </div></td></tr>
				  </table>    			 						 
				 <?php			 
	
	  } // del else de la comprobación de fecha futura
?>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Monday, 29 September, 2008 11:32 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
