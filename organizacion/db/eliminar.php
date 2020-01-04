<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Paúl González y Rosanny Yáñez
  Descripción General:  Este archivo elimina los datos de la base de datos de acuerdo a los parámetros que se brindan
  		Modificado el: 	22/08/2008 por Pedro E. Arrioja M. - Se modificaron los nombres de las bases para que funcione mejor con intranet y se
					 	eliminó código de otras secciones, por lo que el switch quedó con solo una opción, queda pendiente de optimación.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
include ("../../db/conexion.php");
$link=conectarse("gestion");
switch ($_GET['elimina'])
{
  case '2':
    elimina_direccion($link);
    break;
}

//Completa
function elimina_direccion($link)
{
  // se busca el codigo del plan estratégico de la dirección
  if ($res=mysql_query("SELECT codigo 
  						FROM gestion.gestion_planes_estrategicos_direcciones 
						where cod_direccion=$_GET[seleccionado]",$link) or die(mysql_error())) 
    {
      $row=mysql_fetch_array($res);
      $codigo_plan_estrategico=$row["codigo"];
	  // si hay codigo del plan estratégico ahora se busca el codigo de los objetivos estratégicos de ese plan
  	  if ( $codigo_plan_estrategico <> "")
	    { 
	       $res3=mysql_query("SELECT codigo 
	  					 FROM gestion.gestion_obj_estrategicos_direcciones 
						 where cod_plan_e_dir=$codigo_plan_estrategico",$link)or die(mysql_error()); 
  	       $row3=mysql_fetch_array($res3);
  	       $codigo_objetivo_estrategico=$row3["codigo"];
		 }; // del select del objetivo estratégico
	}; // del select del plan estratégico


  // se busca un plan operativo de la direccion
  if ($res2=mysql_query("SELECT codigo 
  						 FROM gestion.gestion_planes_operativos 
						 where cod_direccion=$_GET[seleccionado]",$link) or die(mysql_error()))
  { 
    $row2=mysql_fetch_array($res2);
    $codigo_plan_operativo=$row2["codigo"];
	// si tiene plan operativo se buscan los objetivos operativos del plan
	if ( $codigo_plan_operativo <> "")
	  { 
        $res4=mysql_query("SELECT codigo 
						   FROM gestion.gestion_obj_operativos 
						   where cod_plan_o_dir=$codigo_plan_operativo",$link)or die(mysql_error());
	  
        $row4=mysql_fetch_array($res4);
        $codigo_objetivo_operativo=$row4["codigo"];
	  }	
  }; // del select del codigo del plan operativo


  $sql="DELETE FROM organizacion.direcciones where codigo=$_GET[seleccionado]";
  $result=mysql_query($sql,$link) or die(mysql_error());
  
  $sql1="DELETE FROM gestion.gestion_planes_estrategicos_direcciones where cod_direccion=$_GET[seleccionado]";
  $result1=mysql_query($sql1,$link) or die(mysql_error());
  
  if ( $codigo_plan_estrategico <> "")
	    { 
		  $sql2="DELETE FROM gestion.gestion_obj_estrategicos_direcciones where cod_plan_e_dir=$codigo_plan_estrategico";
  		  $result2=mysql_query($sql2,$link) or die(mysql_error());
  		  $sql3="DELETE FROM gestion.gestion_plan_e_org_dir where cod_plan_e_dir=$codigo_plan_estrategico";
  		  $result3=mysql_query($sql3,$link) or die(mysql_error());
  		  $sql4="DELETE FROM gestion.gestion_plan_e_o_dir where cod_plan_e_dir=$codigo_plan_estrategico";
  		  $result4=mysql_query($sql4,$link) or die(mysql_error());
		};
		
  if ( $codigo_plan_operativo <> "")
	    { 	
		  $sql6="DELETE FROM gestion.gestion_obj_operativos where cod_plan_o_dir=$codigo_plan_operativo";
  		  $result6=mysql_query($sql6,$link) or die(mysql_error());
		};
	
  if ( $codigo_objetivo_estrategico <> "")
	    { 	
		  $sql7="DELETE FROM gestion.gestion_obje_org_dir where cod_obj_e_dir=$codigo_objetivo_estrategico";
  		  $result7=mysql_query($sql7,$link) or die(mysql_error());
  		  $sql8="DELETE FROM gestion.gestion_obj_operativos_actividades where cod_obj_operativo=$codigo_objetivo_operativo";
 		  $result8=mysql_query($sql8,$link) or die(mysql_error());	
		};
		
  $sql5="DELETE FROM gestion.gestion_planes_operativos where cod_direccion=$_GET[seleccionado]";
  $result5=mysql_query($sql5,$link) or die(mysql_error());


if (($result) || ($result1) || ($result2) || ($result3) || ($result4) || ($result5)|| ($result6)|| ($result7)|| ($result8)) echo "La Direcci&oacute;n fue eliminada";
}

//mysql_close($link);
?>