<?php
//var_dump($table);die;
   /* if(isset($filter))
    {
        echo theme_view('common/filter');
    }*/
    if(isset($table))
    {
        $action_segment = $this->uri->segment(2);
        
        if($action_segment == "get_order_status_data" || $action_segment == "get_order_status_data_details"){
             echo theme_view('common/order_status_table');
        }
        elseif($action_segment == "po_acknowledgement"){
            echo theme_view('common/po_acknowledgement_table');
        }
        else{
            echo theme_view('common/table');
        }
    }
?>