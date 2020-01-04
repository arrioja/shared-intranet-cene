<?php     

/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Este archivo captura un numero por el url y busca su correspondiente archivo en imgs/graf y lo elimina para evitar 
  						que el servidor se llene de imagenes temporales de graficos.
  		Modificado el: 	03/09/2008 por Pedro E. Arrioja M. - Creación.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/

    $num=$_GET['num'];
    if (file_exists("../imgs/graf/".$num."_01.png")){ unlink("../imgs/graf/".$num."_01.png");} 
	if (file_exists("../imgs/graf/".$num."_02.png")){ unlink("../imgs/graf/".$num."_02.png");} 
?>
