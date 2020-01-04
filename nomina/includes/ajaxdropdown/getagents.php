<?php
//  
// +------------------------------------------------------------------------+
// | PHP version 5.0 					                                  	|
// +------------------------------------------------------------------------+
// | Description:													      	|
// | Class to populate drop down using AJAX + PHP 	  						|	
// | 																		|	
// +------------------------------------------------------------------------+
// | Author				: Neeraj Thakur <neeraj_th@yahoo.com>   			|
// | Created Date     	: 18-12-2006                  						|
// | Last Modified    	: 18-12-2006                  						|
// | Last Modified By 	: Neeraj Thakur                  					|
// +------------------------------------------------------------------------+


DEFINE ('DB_USER', 'capepo');
DEFINE ('DB_PASSWORD', 'capepo');
DEFINE ('DB_HOST', '192.168.50.2');
DEFINE ('DB_NAME', 'administracion');

class AjaxDropdown
{
	var $table;	
	function AjaxDropdown()
	{		
		// Make the connnection and then select the database.
		$dbc = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) OR die ('Could not connect to MySQL: ' . mysql_error() );
		mysql_select_db (DB_NAME) OR die ('Could not select the database: ' . mysql_error() );
		$this->table = "descripcion_presupuesto";
	}
	
	function dbConnect()
	{
		DEFINE ('LINK', mysql_connect (DB_HOST, DB_USER, DB_PASSWORD));
	}
	
	function getXML($id)
	{
		$this->dbConnect();
		$query = "SELECT distinct partida FROM $this->table where ano = {$id} ORDER BY id asc";
		$result = mysql_db_query (DB_NAME, $query, LINK);
		
		$xml = '<?xml version="1.0" encoding="ISO-8859-1" ?>';
		$xml .= '<categories>';
		while($row = mysql_fetch_array($result))
		{
			$xml .= '<category>';
			$xml .= '<id>'. $row['partida'] .'</id>';
			$xml .= '<fname>'. $row['partida'] .'</fname>';
			$xml .= '</category>';
		}
		$xml .= '</categories>';
		mysql_close();		
		return $xml;
	}	
	
	function getArrayAno($id)
	{
		$this->dbConnect();
		$query = "SELECT distinct ano FROM $this->table ORDER BY ano desc";
		$result = mysql_db_query (DB_NAME, $query, LINK);
		$arr = array();
		while($row = mysql_fetch_object($result))
		{
			$arr[] = $row;
		}
		mysql_close();		
		return $arr;	
	}
}

if ( @$_GET['method'] == 'getXML' )
{
	header("Content-Type: application/xml; charset=UTF-8");
	$obj = new AjaxDropdown();
	echo $obj->getXML(@$_GET['param']);
}
?>