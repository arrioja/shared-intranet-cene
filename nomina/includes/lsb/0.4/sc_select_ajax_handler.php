<?php
// sc_classes.php v0.4

// Copyright (c) 2006,7 Panos Kyriakakis (http://www.salix.gr)
// 
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//   

    include("sc_classes.php"); // <----- fix this to point to correct location
    
    
    $link_field_value = $_REQUEST['linkval'];
    $table = $_REQUEST['table'];
    $key = $_REQUEST['key'];
    $text = $_REQUEST['text'];
    $order = $_REQUEST['order'];
    $extra_where = stripslashes($_REQUEST['extra_where']);
    $select_prompt_text = $_REQUEST['select_prompt_text'];
    $linkfld = $_REQUEST['linkfld'];
    $xml_encoding = $_REQUEST['xml_encoding'];
    $sc_ajax_select_boxes = new sc_ajax_select_boxes();
    $sc_ajax_select_boxes->openDB(	'localhost', // server
	                                'salix', // database name
	                                'capepo', // db username
	                                'capepo' // db password
	                              ); 

    $rows = $sc_ajax_select_boxes->ajax_get_records($table, $key, $text, $order, 
                                            $linkfld, $link_field_value,
                                            $extra_where);
    if( count($rows)!=0 || $link_field_value=='0' )
        $sc_ajax_select_boxes->ajax_output_xml($rows, $select_prompt_text, $xml_encoding);
    else
        $sc_ajax_select_boxes->ajax_output_xml_for_none($xml_encoding);
    
?>