<?php
//var_dump($table);die;
if (isset($activity)) {
    echo theme_view('common/activity');
}
if (isset($activity_planning)) {
    echo theme_view('common/activity_planning');
}
if (isset($activity_execution)) {
    echo theme_view('common/activity_execution');
}
if (isset($table)) {
    echo theme_view('common/table');
}

if (isset($scheme_table)) {
    echo theme_view('common/scheme_table');
}

if (isset($order_table)) {
    $action_segment = $this->uri->segment(2);

    if ($action_segment == "get_order_status_data" || $action_segment == "get_order_status_data_details") {
        echo theme_view('common/order_status_table');
    }
}

if (isset($po_ack_table)) {

    $action_segment = $this->uri->segment(2);
    //  echo $action_segment;

    if ($action_segment == "po_acknowledgement" || $action_segment == "get_order_status_data_details") {
        echo theme_view('common/po_acknowledgement_table');
    }
}

if (isset($order_approval_table)) {
    $action_segment = $this->uri->segment(2);

    if ($action_segment == "order_approval" || $action_segment == "get_order_status_data_details") {
        echo theme_view('common/order_approval_table');
    }
}

if (isset($target_data)) {
    echo theme_view('common/target_table');
}

if (isset($prespective_order_data)) {
    $action_segment = $this->uri->segment(2);

    if ($action_segment == "get_prespective_order" || $action_segment == "get_prespective_order_details") {
        echo theme_view('common/prespective_order_table');
    }
}


?>