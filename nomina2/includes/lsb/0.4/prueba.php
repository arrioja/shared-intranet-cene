  <html>
        <head>
            <title>Salix.gr - Linked selected boxes demo page</title>
            <META NAME="author" CONTENT="Panos Kyriakakis">
            <meta name="description" lang="en" content="Demo page. Linked selected boxes that load items from database using AJAX">
            <meta name="keywords" lang="en" content="Demo page, Linked selected boxes, Content management, Components and tools to manage content, AJAX, Interact with the Web server without page reloading">
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <META name="verify-v1" content="2CKKXxDtxsHjE7TjmXjWJSzMj5xqXOvTrnZ27goGJSE=" />
            <META name="robots" content="follow,index" />
            <link href="http://www.salix.gr/forAll.css" rel="stylesheet" type="text/css"></link>
        </head>
        <body>
        <script src="prototype.js" type="text/javascript"></script>
        <h2><a href="http://www.salix.gr/ajax_linked_selectboxes">Salix.gr - Ajax Linked Select boxes Demo 7</a></h2>
        <p>
        Usage of radio buttons. All data are on the same table. 
        </p> 
        <p>
        Items for first (parent) select box parent_id=0.
        Using the new parameter to set an extra field in where clause parent items are filtered.
        </p>
        
        <?php
        
    	include("top_script.php");    
        include("sc_classes.php");
        
        $sc_ajax_select_boxes = new sc_ajax_select_boxes();     
        $sc_ajax_select_boxes->add_select_box('lsd_demo_2','rec_id','descr','rec_id',2,'sel1','sel_id_1','', 'parent_id=0');
        $sc_ajax_select_boxes->add_radio_box('lsd_demo_2','rec_id','descr','rec_id',10,'sel2','sel_id_2','');
        $sc_ajax_select_boxes->add_radio_box('lsd_demo_2','rec_id','descr','rec_id',43,'sel3','sel_id_3','');
        $sc_ajax_select_boxes->link_select_boxes('sel1','sel2', 'parent_id',2);
        $sc_ajax_select_boxes->link_select_boxes('sel2','sel3', 'parent_id',10);
        $sc_ajax_select_boxes->place_jscripts();
        ?>
        <form name="main" method="POST" action="example_2_posted.php">
            <?php
            $sc_ajax_select_boxes->show_select_box('sel1');
            $sc_ajax_select_boxes->show_select_box('sel2');
            $sc_ajax_select_boxes->show_select_box('sel3');
            ?>
            <input type="submit" value="POST" />
        </form>
        
        <br />
        <br />
        <pre>
            <?php
        	include("top_script.php");    
            include("sc_classes.php");
            
            $sc_ajax_select_boxes = new sc_ajax_select_boxes();     
            $sc_ajax_select_boxes->add_select_box('lsd_demo_2','rec_id','descr','rec_id',2,'sel1','sel_id_1','', 'parent_id=0');
            $sc_ajax_select_boxes->add_radio_box('lsd_demo_2','rec_id','descr','rec_id',10,'sel2','sel_id_2','');
            $sc_ajax_select_boxes->add_radio_box('lsd_demo_2','rec_id','descr','rec_id',43,'sel3','sel_id_3','');
            $sc_ajax_select_boxes->link_select_boxes('sel1','sel2', 'parent_id',2);
            $sc_ajax_select_boxes->link_select_boxes('sel2','sel3', 'parent_id',10);
            $sc_ajax_select_boxes->place_jscripts();
            ?>
            &lt?form name="main" method="POST" action="example_2_posted.php">
                &lt?php
                $sc_ajax_select_boxes->show_select_box('sel1');
                $sc_ajax_select_boxes->show_select_box('sel2');
                $sc_ajax_select_boxes->show_select_box('sel3');
                ?>
                &ltinput type="submit" value="POST" />
            &lt/form>

        </pre>

        </body>
    </html>