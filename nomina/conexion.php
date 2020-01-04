<?php
function conectar()
{
	mysql_connect("localhost", "root", "ncc1701");
	mysql_select_db("administracion");
}

function desconectar()
{
	mysql_close();
}
?>