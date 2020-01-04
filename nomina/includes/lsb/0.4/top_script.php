<?php

    /*
        LSB demo script.
        
        Just for demonstration purposes, it is suposed to use 
        your script's current db connection.
     */

    openDB(	'192.168.50.2',    // server
            'administracion',        // database name
            'capepo',        // db username
            'capepo'         // db password
          ); 

    function openDB( $dbserver_name, $database_name, $dbserver_username, $dbserver_password) {
    
        $resp=0;
        
    	$link = @mysql_connect($dbserver_name, $dbserver_username, $dbserver_password);
    	if($link!=false) {
      		$resp = @mysql_select_db($database_name);
      		if ($resp != false) {
      			$resp=0;
      		}
      		else {
        		$resp = -1;
      		}
    	}
    	else {
      		$resp = -2;
    	}
        if( $resp!=0 ) {
            if( isset($link) )
                unset($link);
        }
        return( $resp );
    }   // end function openDB ----------------------------------


?>