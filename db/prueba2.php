<?php 

$fi=$_POST['archi'];

echo $fi;
// In PHP 4.1.0 or later, $_FILES should be used instead of $HTTP_POST_FILES.
if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
    copy($_FILES['archivo']['tmp_name'], "archivos_subidos/file");
} else {
    echo "Possible file upload attack. Filename: " . $_FILES['archivo']['name'];
}
/* ...or... */
//move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "/place/to/put/uploaded/file");





//$archivo=$_FILES['arch'];


//echo $_FILES['userfile'];

/*if($file = fopen($archivo2, 'r')){
                    echo "<center><table border = 0>";
                    while(!feof($file)){
                        $linea = fgets($file);
                            echo "<tr><td>$linea</td></tr>";
                    }
                    echo "</table></center>";
                    fclose($file);
                }
                else{
                    echo "<br><b>Archivo no encontrado</b>";
                }
*/

?>
