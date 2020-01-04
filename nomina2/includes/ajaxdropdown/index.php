<html>
<head>
	<script language="JavaScript" src="ajax.js"></script>
	<link href="css.css" rel="stylesheet" type="text/css"/>	
</head>
<body>
<div id="loading"></div>

	<table border=0 cellpadding=0 cellspacing="0" align="center" width="40%">
	<form>		
		<tr><td colspan="2" height="25"></td></tr>		
		<tr><td colspan="2" class="textheading">AJAX Dropdown to Dropdown</td></tr>
		<tr><td colspan="2" height="25"></td></tr>		
		<tr><td class="text" width="50%">Selecione un Año: </td><td>
				<?php
					require_once("getagents.php");
					$obj = new AjaxDropdown();
					//$obj->table ="descripcion_presupuesto";
					$arr = $obj->getArrayAno(0);
					$strRet .= '<option value="0">--Selecione--</option>';
					foreach ( $arr as $row )
					{
						$strRet .= '<option value="'.$row->ano.'">'.$row->ano.'</option>';
					}					
				?>
				<select name="selCat" class="text" onChange="javascript:Ajax.Request('getagents.php?method=getXML&param=',this.value, Ajax.Response);">
					<?php echo $strRet; ?>
				</select>
				</td></tr>
				<tr><td colspan="2" height="5"></td></tr>
				<tr><td class="text">Seleccione una Partida:</td><td>
				<select name="selSubCat" id="selSubCat" class="text"onChange="javascript:Ajax.Request ('getagents.php?method=getXML&param=', this.value, Ajax.Response);">
					<option value="0">--Selecione--</option>
				</select>
				</td></tr>
                
                
                </select>
				</td></tr>
				<tr><td colspan="2" height="5"></td></tr>
				<tr><td class="text">Seleccione una Generica:</td><td>
				<select name="selSubSubCat" id="selSubSubCat" class="text">
					<option value="0">--Selecione--</option>
				</select>
				</td></tr>
	</form>
	</table>
</body>
</html>