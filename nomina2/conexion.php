<?php
function conectar()
{
	mysql_connect("192.168.50.2", "capepo", "capepo");
	mysql_select_db("administracion");
}

function desconectar()
{
	mysql_close();
}
?>