    <html>
        <head>
            <title>Salix.gr - Linked selected boxes demo page</title>
            <META NAME="author" CONTENT="Panos Kyriakakis">
            <meta name="description" lang="en" content="Demo page. Linked selected boxes that load items from database using AJAX">
            <meta name="keywords" lang="en" content="Demo page, Linked selected boxes, Content management, Components and tools to manage content, AJAX, Interact with the Web server without page reloading">
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <META name="verify-v1" content="2CKKXxDtxsHjE7TjmXjWJSzMj5xqXOvTrnZ27goGJSE=" />
            <META name="robots" content="follow,index" />
        </head>
        <body>
        <script src="prototype.js" type="text/javascript"></script>
        <h2><a href="http://www.salix.gr/ajax_linked_selectboxes">Salix.gr - Ajax Linked Select boxes Demo</a></h2>
        <?php
        
    	include("top_script.php");    
        include("sc_classes.php");
        
        $sc_ajax_select_boxes = new sc_ajax_select_boxes();     
        $sc_ajax_select_boxes->xml_encoding='ISO-8859-1';   // use this property if you need other encoding than latin
        $sc_ajax_select_boxes->add_select_box('sc_page_types','page_type','type_descr','page_type','','sel1','sel_id_1','');
        $sc_ajax_select_boxes->add_select_box('sc_page_types_sub','sub_type','type_descr','sub_type','st21','sel2','sel_id_2','');
        $sc_ajax_select_boxes->add_select_box('sc_page_types_sub_sub','sub_type','type_descr','sub_type','st22','sel3','sel_id_3','');
        $sc_ajax_select_boxes->add_select_box('sc_page_types_sub_sub','sub_type','type_descr','sub_type','st22','sel4','sel_id_4','');
        $sc_ajax_select_boxes->link_select_boxes('sel1','sel2', 'page_type','t2');
        $sc_ajax_select_boxes->link_select_boxes('sel2','sel3', 'page_type','st22');
        $sc_ajax_select_boxes->link_select_boxes('sel3','sel4', 'page_type','st22');
        $sc_ajax_select_boxes->place_jscripts();
        $sc_ajax_select_boxes->show_select_box('sel1');
        $sc_ajax_select_boxes->show_select_box('sel2');
        $sc_ajax_select_boxes->show_select_box('sel3');
        $sc_ajax_select_boxes->show_select_box('sel4');
        ?>
        </body>
    </html>