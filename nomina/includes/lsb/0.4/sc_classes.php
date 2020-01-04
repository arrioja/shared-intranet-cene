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
    /*----------------------------------------------------------------------------
        Helper class
    ----------------------------------------------------------------------------*/  
    class sc_form_elements {
        var $select_prompt_key = 0;
        var $select_prompt_text = 'Please Select';
        var $select_add_prompt_row = TRUE;
        
        var $group_pre_group = '';
        var $group_post_group = '';
        var $group_pre_input = '';
        var $group_post_input = '<br />';

        var $group_wrap_every = 0;  // 0 for no wrap
        var $group_pre_wrap = '';
        var $group_post_wrap = '<br />';
                
        function _getRecords($query) {
            $rows = array();
            $result = mysql_query($query);
            if($result != false ) {
                if( mysql_num_rows($result)!=0 ) {
                    while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
                        $rows[] = $line;
                    }
                }
            }
            return( $rows );
        }   // end function _getRecords ---------------------------------------

        function _make_radio_input($name,$add_id,$key,$text,$selected,$extra = "") {
            $line ='<label>';
            $line .= '<input type="radio" name="'.$name.'" ';
            if( $add_id ) {
                $id = $name.'_'.$key;
                $line .= ' id="'.$id.'" ';
            }
            $line .= ' value="'.$key.'" ';
            if( $extra!='' )
                $line .= ' '.$extra.' ';
            if( $this->_is_key_selected($key,$selected) ) 
                $line .= ' CHECKED ';
            $line .= ' >';
            $line .=$text;
            $line .='</label>';
            return($line);
        }   // end function _make_radio_input ---------------------------------
        
        function _make_checkbox_input($name,$add_id,$key,$text,$selected,$extra = "") {
            $line ='<label>';
            $line .= '<input type="checkbox" name="'.$name.'" ';
            if( $add_id ) {
                $id = $name.'_'.$key;
                $line .= ' id="'.$id.'" ';
            }
            $line .= ' value="'.$key.'" ';
            if( $extra!='' )
                $line .= ' '.$extra.' ';
            if( $this->_is_key_selected($key,$selected) ) 
                $line .= ' CHECKED ';
            $line .= ' >';
            $line .=$text;
            $line .='</label>';
            return($line);
        }   // end function _make_checkbox_input ------------------------------

        function _is_key_selected($key, $selected) {
            $out = FALSE;
            $selection = explode(',',$selected);
            if (in_array($key, $selection)) 
                $out=TRUE;
            return($out);
        }   // end function _is_key_selected ----------------------------------
        
        function _add_input_group($type,$list, $selected, $name, $add_id=FALSE, $extra = "") {
            echo $this->group_pre_group."\n";
            $wrap_item = 1;
            $is_wrap_open = FALSE;
            foreach($list as $key => $text) {
                if($this->group_wrap_every>0 && $wrap_item == 1) {
                    echo $this->group_pre_wrap."\n";
                    $is_wrap_open = TRUE;
                }
                $line = $this->group_pre_input;
                switch($type) {
                    case 'checkbox':
                        $line .= $this->_make_checkbox_input($name,$add_id,$key,$text,$selected,$extra);
                        break;
                    case 'radio':
                        $line .= $this->_make_radio_input($name,$add_id,$key,$text,$selected,$extra);
                        break;
                    default:
                        $line .= '&nbsp;';
                }
                $line .= $this->group_post_input;
                echo $line."\n";
                if($this->group_wrap_every>0 && $wrap_item==$this->group_wrap_every && $is_wrap_open ) {
                    echo $this->group_post_wrap."\n";
                    $is_wrap_open=FALSE;
                    $wrap_item=0;
                }
                $wrap_item++;
            }
            if($this->group_wrap_every>0 && $is_wrap_open ) {
                for($i=$wrap_item;$i<=$this->group_wrap_every;$i++) {
                $line = $this->group_pre_input;
                $line .= '&nbsp;';
                $line .= $this->group_post_input;
                echo $line."\n";
                }
                echo $this->group_post_wrap."\n";
            }
            echo $this->group_post_group."\n";            
        }   // end function add_input_group -----------------------------------
        
        function get_list_from_db($table, $key_fld, $text_fld, $order_fld='') {
            $cmd = "SELECT $key_fld, $text_fld FROM $table ";
            if( $order_fld!='' )
                $cmd .= " ORDER BY $order_fld";
            $rows = $this->_getRecords($cmd);
            $list = array();
            if( count($rows)!=0 ) {
                foreach($rows as $row) {
                    $list[$row[0]] = $row[1];
                }
            }
            return($list);
        }   // end function get_list_from_db -----------------------------------

        function add_select_box($list, $selected, $name, $id, 
                                $extra = "", $multiple=FALSE, $size=1) {
            // MULTIPLE (allow multiple selections) 
            // SIZE=Number (number of visible options) 
            $line = '<select name="'.$name.'" ';
            if( $id=='' )
                $line .= ' id="'.$name.'" ';
            else 
                $line .= ' id="'.$id.'" ';
            if( $extra!='' )
                $line .= ' '.$extra.' ';
            if( $multiple )
                $line .= ' MULTIPLE ';
            if( $size>1 )
                $line .= ' size='.$size.' ';            
            $line .= ' >';
            echo $line."\n";
            if( $this->select_add_prompt_row && $size<2 ) {
                $line = '<option value="'.urlencode($this->select_prompt_key).'" ';
                $line .= '>'.$this->select_prompt_text.'</option>';
                echo $line."\n";                
            }
            foreach($list as $key => $text) {
                $line = '<option value="'.urlencode($key).'" ';
                if( $this->_is_key_selected($key,$selected) ) 
                    $line .= ' SELECTED ';
                $line .= '>'.$text.'</option>';
                echo $line."\n";
            }
            echo '</select>'."\n";
        }   // end function add_select_box -------------------------------------
        
        function add_radio_group($list, $selected, $name, $add_id=FALSE, $extra = "") {
            $this->_add_input_group('radio',$list, $selected, $name, $add_id, $extra);
        }   // end function add_radio_group ------------------------------------

        function add_checkbox_group($list, $selected, $name, $add_id=FALSE, $extra = "") {
            $this->_add_input_group('checkbox',$list, $selected, $name, $add_id, $extra);
        }   // end function add_radio_group ------------------------------------
        
    }   // end class sc_form_elements ------------------------------------------
    
    
  /*----------------------------------------------------------------------------
    Linked Select Boxes main class
    ----------------------------------------------------------------------------*/  
    class sc_ajax_select_boxes {
        var $php_ajax_handler = 'sc_select_ajax_handler.php';
        
        var $select_prompt_key = 0;
        var $select_prompt_text = 'Please Select';
        var $select_add_prompt_row = TRUE;
        var $select_wait_text = 'Please wait';
        var $select_empty_text = '(None)';
        var $select_not_found_text = '(Not found)';
        
        var $select_boxes = array(); 
        var $select_box_links = array(); 
        
        var $xml_encoding = 'ISO-8859-1';

        var $group_pre_group = '';
        var $group_post_group = '';
        var $group_pre_input = '';
        var $group_post_input = '<br />';

        var $group_wrap_every = 0;  // 0 for no wrap
        var $group_pre_wrap = '';
        var $group_post_wrap = '<br />';
        
        /* 
            DB helper functions 
         */
        function _getRecords($query) {
            $rows = array();
            $result = mysql_query($query);
            if($result != false ) {
                if( mysql_num_rows($result)!=0 ) {
                    while ($line = mysql_fetch_array($result, MYSQL_NUM)) {
                        $rows[] = $line;
                    }
                }
            }
            return( $rows );
        }   // end function _getRecords ---------------------------------------

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
        
        function get_list_from_db($table, $key_fld, $text_fld, $order_fld='', 
                                  $link_field="", $link_field_value="",
                                  $extra_where="") {
            $b_where_word_added=FALSE;                        
            $cmd = "SELECT $key_fld, $text_fld FROM $table ";
            if( (!empty($link_field)) && (!empty($link_field_value)) ) {
                $b_where_word_added = TRUE;
                $cmd .= " WHERE $link_field= ";
                if( is_string($link_field_value) )
                    $cmd .="'$link_field_value' ";
                else
                    $cmd .="$link_field_value ";
            }
            if( !empty($extra_where ) ) {
                if( $b_where_word_added ) 
                    $cmd .= " AND ";
                else
                    $cmd .= " WHERE ";
                $cmd .= " $extra_where ";
            }
            if( $order_fld!='' )
                $cmd .= " ORDER BY $order_fld";

            $rows = $this->_getRecords($cmd);
            $list = array();
            if( count($rows)!=0 ) {
                foreach($rows as $row) {
                    $list[$row[0]] = $row[1];
                }
            }

            return($list);
        }   // end function get_list_from_db -----------------------------------

        // public method that adds a select box (wrapper for _add_box)
        
        function add_select_box($table_name, $key_field, $text_field, 
                                $order_field, $selected, 
                                $name, $id, $extra = "", $extra_where = "",
                                $select_prompt_text='Please Select'
                               ) {
            $this->_add_box('select',
                                $table_name, $key_field, $text_field, 
                                $order_field, $selected, 
                                $name, $id, $extra, $extra_where,
                                $select_prompt_text
                               );                                
        }   // end function add_select_box -------------------------------------

        // public method that adds radio group (wrapper for _add_box) 
        
        function add_radio_box( $table_name, $key_field, $text_field, 
                                $order_field, $selected, 
                                $name, $id, $extra = "", $extra_where = "",
                                $select_prompt_text='Please Select'
                               ) {
            $this->_add_box('radio',
                                $table_name, $key_field, $text_field, 
                                $order_field, $selected, 
                                $name, $id, $extra, $extra_where,
                                $select_prompt_text
                               );
        }   // end function add_select_box -------------------------------------

        
        function _add_box($box_type,
                                $table_name, $key_field, $text_field, 
                                $order_field, $selected, 
                                $name, $id, $extra = "", $extra_where = "",
                                $select_prompt_text='Please Select'
                               ) {
                                    
            if( !array_key_exists($name, $this->select_boxes) ) {
                $this->select_boxes[$name] = array(
                                        'box_type' => $box_type,
                                        'table_name' => $table_name,
                                        'key_field' => $key_field,
                                        'text_field' => $text_field,
                                        'order_field' => $order_field,
                                        'selected' => $selected,
                                        'id' => $id,
                                        'extra' => $extra,
                                        'extra_where' => $extra_where,
                                        'select_prompt_text' => $select_prompt_text
                                        );
                return(TRUE);
            }
            else {
                return(FALSE);
            }
        }   // end function add_select_box ------------------------------------
        
        // public method that adds box link definition
        function link_select_boxes($parent_box, $child_box, $link_field="", $link_field_selected="") {
            if( array_key_exists($parent_box, $this->select_boxes) &&
                array_key_exists($child_box, $this->select_boxes)) {
                $new_item = array( 
                                                    'parent' => $parent_box,
                                                    'child' => $child_box,
                                                    'link_field' => $link_field,
                                                    'link_field_selected' => $link_field_selected
                                                  );
                $this->select_box_links[] = $new_item;
                $this->select_boxes[$parent_box]['selected']=$link_field_selected;
                return(TRUE);
            }
            else {
                return(FALSE);
            }
        }   // end function link_select_boxes ---------------------------------
        
        function _is_select_parent($box_name) {
            $out=FALSE;
            foreach($this->select_box_links as $link ) {
                if( $link['parent']==$box_name ) {
                    $out=TRUE;
                    break;
                }
            }
            return($out);
        }

        function _get_select_childs($box_name) {
            $out=array();
            foreach($this->select_box_links as $link ) {
                if( $link['parent']==$box_name ) {
                    $out[]=$link;
                }
            }
            return($out);
        }

        function _is_select_child($box_name) {
            $out=FALSE;
            foreach($this->select_box_links as $link ) {
                if( $link['child']==$box_name ) {
                    $out=TRUE;
                    break;
                }
            }
            return($out);
        }

        function _get_select_parent($box_name) {
            $out=FALSE;
            foreach($this->select_box_links as $link ) {
                if( $link['child']==$box_name ) {
                    $out=$link;
                }
            }
            return($out);
        }
        
        function show_select_box($box_name) {
            if( array_key_exists($box_name, $this->select_boxes) ) {
                $sc_form_elements = new sc_form_elements();
                $sc_form_elements->group_pre_group = $this->group_pre_group;
                $sc_form_elements->group_post_group = $this->group_post_group;
                $sc_form_elements->group_pre_input = $this->group_pre_input;
                $sc_form_elements->group_post_input = $this->group_post_input;
                $sc_form_elements->group_wrap_every = $this->group_wrap_every;
                $sc_form_elements->group_pre_wrap = $this->group_pre_wrap;
                $sc_form_elements->group_post_wrap = $this->group_post_wrap;

                $link_field='';
                $link_field_selected='';
                $extra = $this->select_boxes[$box_name]['extra'];
                $sc_form_elements->select_prompt_text=$this->select_boxes[$box_name]['select_prompt_text'];
                if( $this->_is_select_parent($box_name) ) {
                    $childs = $this->_get_select_childs($box_name);
                    
                }
                $is_child = $this->_is_select_child($box_name);
                if( $is_child ) {
                    $parent = $this->_get_select_parent($box_name);
                    if( $parent ) {
                        $link_field=$parent['link_field'];
                        $link_field_selected=$parent['link_field_selected'];                        
                    }
                }
                if( $is_child && empty($link_field_selected) ) {
                    $list = array();
                }
                else {
                    $list = $this->get_list_from_db(
                                                    $this->select_boxes[$box_name]['table_name'],
                                                    $this->select_boxes[$box_name]['key_field'],
                                                    $this->select_boxes[$box_name]['text_field'],
                                                    $this->select_boxes[$box_name]['order_field'],
                                                    $link_field,$link_field_selected,
                                                    $this->select_boxes[$box_name]['extra_where']);
                }
                if( $this->select_boxes[$box_name]['box_type']=='select' ) {
                    if( $this->_is_select_parent($box_name) )
                        $extra .= ' onchange="get_'.$box_name.'_childs_sub_items();" ';
                    $sc_form_elements->add_select_box($list, 
                                                      $this->select_boxes[$box_name]['selected'],
                                                      $box_name,
                                                      $this->select_boxes[$box_name]['id'],
                                                      $extra);
                }
                else {                                                  
                    echo '<input type="hidden" name="'.$box_name.'" id="'.$this->select_boxes[$box_name]['id'].'" value="'.$this->select_boxes[$box_name]['selected'].'" />'."\n";
                    echo '<div id="'.$this->select_boxes[$box_name]['id'].'_container">'."\n";
                    echo $this->select_boxes[$box_name]['select_prompt_text'].'<br />'."\n";
                    if( $this->_is_select_parent($box_name) )
                        $extra .= ' onclick="set_'.$box_name.'_selected_value(this.value);" ';
                    $sc_form_elements->add_radio_group($list, 
                                                        $this->select_boxes[$box_name]['selected'],
                                                        $box_name.'_opt', 
                                                        FALSE, 
                                                        $extra);
                }
                echo '</div>'."\n";               
                echo '<br />'."\n";
            }
        }   // end function show_select_box -----------------------------------
        
        function place_onchange_event($box_name, $only_set_radio_value=TRUE) {
            $childs = $this->_get_select_childs($box_name);
            echo '<script language="javascript">'."\n";
     
            echo 'function get_'. $box_name.'_childs_sub_items() {'."\n";
            foreach($childs as  $child_name => $child_props ) {
                echo "    sc_get_sub_items('".$this->select_boxes[$box_name]['id']."', '".$this->select_boxes[$child_props['child']]['id'] ."');"."\n";
            }
            echo '}'."\n";
            foreach($childs as  $child_name => $child_props ) { 
                ?>
                function sc_show_response_items_<?php echo $this->select_boxes[$child_props['child']]['id']; ?>(originalRequest) {
                    var sel_id = '<?php echo $this->select_boxes[$child_props['child']]['id']; ?>';
                    sc_show_response_items(sel_id, originalRequest);
                }
                <?php
            }    
            
            if( $this->select_boxes[$box_name]['box_type']=='radio' ) {
                ?>
                function set_<?php echo $box_name?>_selected_value(new_value) {
                    var o = $('<?php echo $this->select_boxes[$box_name]['id'] ?>');
                    o.value=new_value;
                    get_<?php echo $box_name; ?>_childs_sub_items();
                }
                <?php
            }
            echo '</script>'."\n";
        }
        
        function place_onchange_control_func() {
            echo '<script language="javascript">'."\n";
             ?>
                function sc_get_sub_items(parent_id, child_id){
                    var s = $F(parent_id);
                    var url = '<?php echo $this->php_ajax_handler; ?>';
                    var pars = 'linkval=' + s;
                    sc_clean_linked_select(parent_id);
                    var sSelect_text = '<?php echo $this->select_prompt_text; ?>';
                    var c = $(child_id);
                    if( c!=null ) {
                        <?php
                            echo "\n";
                            echo "var onCompleteCallBack = null;"."\n";
                            foreach($this->select_box_links as  $link_id => $link_props ) {
                                echo "if( child_id=='".$this->select_boxes[$link_props['child']]['id']."' ) {"."\n";
                                echo "   onCompleteCallBack = sc_show_response_items_".$this->select_boxes[$link_props['child']]['id'].";"."\n";
                                echo "   pars += '&table=".$this->select_boxes[$link_props['child']]['table_name']."';"."\n";
                                echo "   pars += '&key=".$this->select_boxes[$link_props['child']]['key_field']."';"."\n";
                                echo "   pars += '&text=".$this->select_boxes[$link_props['child']]['text_field']."';"."\n";
                                echo "   pars += '&order=".$this->select_boxes[$link_props['child']]['order_field']."';"."\n";
                                echo "   pars += '&extra_where=".addslashes($this->select_boxes[$link_props['child']]['extra_where'])."';"."\n";
                                echo "   pars += '&select_prompt_text=".$this->select_boxes[$link_props['child']]['select_prompt_text']."';"."\n";
                                echo "   pars += '&linkfld=".$link_props['link_field']."';"."\n";
                                echo "   pars += '&xml_encoding=".$this->xml_encoding."';"."\n";
                                echo "   sSelect_text = '".$this->select_boxes[$link_props['child']]['select_prompt_text']."';"."\n";
                                echo "} "."\n";
                            }
                        ?>
                        var is_select_box = 1;
                        if( c.options ) 
                            is_select_box = 1;
                        else
                            is_select_box = 0;

                        if( is_select_box==1 ) {
                            for( i=c.options.length-1; i>=0; i--) {
                        		c.options[i]=null;
                        	}
                        	
                            var opt = document.createElement("option");
                            if( s=='0' ) {
                                try {
                                    opt.text = sSelect_text;
                                    opt.value = '0';
                                    c.add(opt, null);
                                }
                                // IE needs special handling
                                catch(ex){
                                    opt.text = sSelect_text;
                                    opt.value = '0';
                                    c.add(opt);
                                }
                                return;
                            }
                
                            try {
                                opt.text = '<?php echo $this->select_wait_text; ?>';
                                opt.value = '0';
                                c.add(opt, null);
                            }
                            // IE needs special handling
                            catch(ex){
                                opt.text = '<?php echo $this->select_wait_text; ?>';
                                opt.value = '0';
                                c.add(opt);
                            }
                        }
                        else {
                            var oDiv = $(child_id+'_container');
                            if( oDiv!=null ) {
                                oDiv.innerHTML = '<?php echo $this->select_wait_text; ?>';
                            }
                        }
                        <?php
                            if( count($this->select_box_links)!=0 ) {
                                echo "if (onCompleteCallBack == null) {"."\n";
                                echo "   return(false); "."\n";
                                echo "} "."\n";
                            }
                        ?>
                        var myAjax = new Ajax.Request( url, { method: 'POST', parameters: pars, onComplete: onCompleteCallBack });
                    }
                }
                
                
                function sc_clean_linked_select(sel_id) {
                    var childs =null;
                    
                    <?php $this->_get_select_js_clean_relations(); ?>
                    if( childs!=null ) {    
                        
                        for(i=0;i<childs.length;i++) {
                            var c = $(childs[i]);
                            if( c!=null ) {
                                var is_select_box = 1;
                                if( c.options ) 
                                    is_select_box = 1;
                                else
                                    is_select_box = 0;
        
                                if( is_select_box==1 ) {
                                    for( k=c.options.length-1; k>=0; k--) {
                                		c.options[k]=null;
                                	}
                                	
                                    var opt = document.createElement("option");
                                    opt.text = sSelect_text[i];
                                    opt.value = 0;
                                    try {
                                        c.add(opt, null);
                                    }
                                    // IE needs special handling
                                    catch(ex){
                                        c.add(opt);
                                    }
                                }
                                else {
                                    var oDiv = $(childs[i]+'_container');
                                    if( oDiv!=null ) {
                                        oDiv.innerHTML = sSelect_text[i];
                                    }
                                }
                            }
                        }                    
                    }
                }
                </script>

                <?php 
            }
        
            /*-----------------------------------------------------------------
              returns childs and child childs
              ----------------------------------------------------------------*/
            function _get_select_relatives($box_name, &$rels, &$sel_texts) {
                foreach($this->select_box_links as $link ) {
                    if( $link['parent']==$box_name ) {
                        $rels[]=$this->select_boxes[$link['child']]['id'];
                        $sel_texts[]=$this->select_boxes[$link['child']]['select_prompt_text'];
                        $this->_get_select_relatives($link['child'], $rels, $sel_texts);
                    }
                }
            }   // end function -----------------------------------------------
            
            function _get_select_js_clean_relations() {
                foreach($this->select_boxes as  $box_name => $box_props ) {
                    $out = array();
                    $sel_texts = array();
                    $this->_get_select_relatives($box_name, $out,$sel_texts);
                    if( count($out)!=0 ) {
                        echo "if( sel_id == '{$this->select_boxes[$box_name]['id']}' ) {"."\n";
                        echo "    childs = ['".implode("','",$out)."'];"."\n";
                        echo "    sSelect_text = ['".implode("','",$sel_texts)."'];"."\n";
                        echo " } \n";
                    }
                }
            }
            
            function place_show_items_response() {
                ?>
                <script language="javascript">   
                function sc_show_response_items(sel_id, originalRequest) {
                    var group_pre_group = '<?php echo $this->group_pre_group; ?>';
                    var group_post_group = '<?php echo $this->group_post_group; ?>';
                    var group_pre_input = '<?php echo $this->group_pre_input; ?>';
                    var group_post_input = '<?php echo $this->group_post_input; ?>';
                    var group_wrap_every = <?php echo $this->group_wrap_every; ?>;
                    var group_pre_wrap = '<?php echo $this->group_pre_wrap; ?>';
                    var group_post_wrap = '<?php echo $this->group_post_wrap; ?>';

                    var c = $(sel_id);
                    if( c!=null ) {
                        var is_select_box = 1;
                        if( c.options ) 
                            is_select_box = 1;
                        else
                            is_select_box = 0;

                        if( is_select_box==1 ) {
                            for( i=c.options.length-1; i>=0; i--) {
                        		c.options[i]=null;
                        	}                 
                        }
                        else {
                            var oDiv = $(sel_id+'_container');
                            oDiv.innerHTML = '';
                        }
                        
                        var tagRecords = originalRequest.responseXML.getElementsByTagName("record");
                        if( is_select_box==1 ) {
                            for(i=0; i<tagRecords.length; i++) {
                                var record = tagRecords[i];
                                var sValue = record.getElementsByTagName("id")[0].firstChild.nodeValue;
                                var sText = record.getElementsByTagName("item")[0].firstChild.nodeValue;
                                if( is_select_box==1 ) {
                                    var opt = document.createElement("option");
                                    try {
                                        opt.text = sText;
                                        opt.value = sValue;
                                        c.add(opt, null);
                                    }
                                    // IE needs special handling
                                    catch(ex){
                                        opt.text = sText;
                                        opt.value = sValue;
                                        c.add(opt);
                                    }
                                }
                            }
                        }
                        else {
                            var newHTML = '';
                            if( tagRecords.length>0 ) {
                                var record = tagRecords[0];
                                var sValue = record.getElementsByTagName("id")[0].firstChild.nodeValue;
                                var sText = record.getElementsByTagName("item")[0].firstChild.nodeValue;
                                newHTML += sText+'<br />';
                            }
                            newHTML += group_pre_group;
                            wrap_item = 1;
                            is_wrap_open = false;

                            for(i=1; i<tagRecords.length; i++) {
                                var record = tagRecords[i];
                                var sValue = record.getElementsByTagName("id")[0].firstChild.nodeValue;
                                var sText = record.getElementsByTagName("item")[0].firstChild.nodeValue;

                                if(group_wrap_every>0 && wrap_item == 1) {
                                    newHTML += group_pre_wrap;
                                    is_wrap_open = true;
                                }
                                line = group_pre_input;
                                line += '<label><input type="radio" name="'+c.name+'_opt" value="'+sValue+'" onclick="set_'+c.name+'_selected_value(this.value);" />'+sText+'</label>';
                                line += group_post_input;
                                newHTML += line;
                                if(group_wrap_every>0 && wrap_item==group_wrap_every && is_wrap_open ) {
                                    newHTML += group_post_wrap;
                                    is_wrap_open=false;
                                    wrap_item=0;
                                }
                                wrap_item++;
                            }
                            if(group_wrap_every>0 && is_wrap_open ) {
                                for(i=wrap_item;i<=group_wrap_every;i++) {
                                line = group_pre_input;
                                line += '&nbsp;';
                                line += group_post_input;
                                newHTML += line;
                                }
                                newHTML += group_post_wrap;
                            }
                            newHTML += group_post_group; 
                            oDiv.innerHTML = newHTML;
                        }
                    }
                }
            
                </script>
            <?php
        }

        function place_jscripts() {
            foreach($this->select_boxes as  $box_name => $box_props ) {
                if( $this->_is_select_parent($box_name) ) {
                    $this->place_onchange_event($box_name);
                }
                else {
                    $this->place_onchange_event($box_name,false);
                }
            }
            $this->place_onchange_control_func();
            $this->place_show_items_response();
        }   // end function place_jscripts ------------------------------------
        
        
        /* =====================================================================
           Ajax handler methods
           ===================================================================== */ 

        function ajax_get_records($table, $key_fld, $text_fld, $order_fld='', 
                                      $link_field="", $link_field_value="",
                                      $extra_where="") {
            if( $link_field_value!='0' && $link_field_value!='' ) {
                return( $this->get_list_from_db($table, $key_fld, $text_fld, $order_fld, 
                                          $link_field, $link_field_value,
                                          $extra_where) );
            }
            else {
                return( array() );
            }
        }   // end function ajax_get_records -----------------------------------
        
        function ajax_output_xml($rows, $select_prompt_text, $encoding='ISO-8859-1') {
            
            header("Content-Type: text/xml");//
            print'<?xml version="1.0" encoding="'.$encoding.'" standalone="yes"?>';
            print '<response>';
            print '<record>';
            print '<id>0</id>';
            print '<item>'.$select_prompt_text.'</item>';
            print '</record>';
            if( count($rows)!=0 ) {
                foreach($rows as $key => $text) {
                    print '<record>';
                    print '<id>'.urlencode($key).'</id>';
                    print '<item>'.addslashes(htmlspecialchars($text)).'</item>';
                    print '</record>';
                }
            }
            print '</response>';
            exit;
            
        }   // end function ajax_output_xml ------------------------------------
        
        function ajax_output_xml_for_none($encoding='ISO-8859-1') {
            header("Content-Type: text/xml");
            print'<?xml version="1.0" encoding="'.$encoding.'" standalone="yes"?>';
            print '<response>';
            print '<record>';
            print '<id>0</id>';
            print '<item>None</item>';
            print '</record>';
            print '</response>';
            exit;
        }   // end function ajax_output_xml ------------------------------------
        
    }   // end class sc_ajax_select_boxes --------------------------------------

?>