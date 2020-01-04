
<?php
	include ("../conexion/conectar.php");
   $result=mysql_query("SELECT * FROM gestion_planes_estrategicos WHERE codigo_organizacion=$_GET[seleccionado]");
   mysql_close($link);

   // Comienzo a imprimir el select
   echo "<select class='combo' id='select_3' name='plan_estrategico' onchange='carga_objetivo()'>";
   echo "<option value='0'>Elige....</option>";
   while($row=mysql_fetch_row($result))
   {
      // Paso a HTML acentos y ñ para su correcta visualizacion
      $row[2]=htmlentities($row[2]);
      // Imprimo las opciones del select
      echo "<option value='".$row[1]."'>".$row[2]."</option>";
   }         
   echo "</select>";
?> 
