<table width="849" border="1">
<?php
include("miclase.php");
$link=conectarse("nomina");
$cod=$_GET['cod'];
if ($cod!='')
{
 $query="SELECT p.nombres, p.apellidos,p.cedula, ic.monto FROM nomina.integrantes i inner join organizacion.personas p on i.cedula=p.cedula inner join nomina.integrantes_constantes ic on ic.cedula=i.cedula where ic.cod_constantes ='$cod'"; 
$result = mysql_query($query, $link);
$k=0;?>
    <tr>
      <td width="275"><strong>Nombres</strong></td>
      <td width="241"><strong>Apellidos</strong></td>
      <td width="110"><strong>Cedula</strong></td>
      <td width="95"><strong>Monto</strong></td>
      <td width="94"><strong>Acción
        <input type="hidden" name="codigo" id="codigo" value="<?php echo $cod; ?>">
      </strong></td>
  </tr>
    <?php while($datos = mysql_fetch_array($result))
{
$id2[$k]=$datos['cedula'];
?>
    <tr>
      <td><?php echo $datos['nombres'];?></td>
      <td><?php echo $datos['apellidos'];?></td>
      <td align="center"><?php echo $datos['cedula'];?></td>
      <td><label>
        <input  name="cedula[<?php echo $datos['cedula'];?>]" type="text" id="cedula[<?php echo $datos['cedula'];?>]" style="text-align:right" value="<?php echo $datos['monto'];?>" size="15" />
      </label></td>
      <td><a href="includes/borrar_integrantes_constantes.php?id=<?php echo $datos['cedula'];?>&cod=<?php echo $cod;?>&pag=<?php echo '2';?>">Quitar</a></td>
    </tr>
       <?php }}?> 
</table>