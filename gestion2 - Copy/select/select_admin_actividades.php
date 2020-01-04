<?php
	include ("../conexion/conectar.php");
   $result=mysql_query("SELECT * FROM gestion_actividades WHERE cod_plan_operativo=$_GET[seleccionado]");
   mysql_close($link);

   // Comienzo a imprimir el select
   echo "<select class='combo' id='select_3' name='actividad'>";
   echo "<option value='0'>Elige....</option>";
   while($row=mysql_fetch_row($result))
   {
      // Paso a HTML acentos y ñ para su correcta visualizacion
      $row[2]=htmlentities($row[2]);
      // Imprimo las opciones del select
	  $cad=$row[1];
	  if (strlen($row[1])>80)
	  {
	  $cad=substr($row[1],0,80);
	  $cad=$cad.'...';
	  }
      echo "<option value='".$row[0]."'> ".$row[0]. "-" .$cad."</option>";
   }         
   echo "</select>";
?>