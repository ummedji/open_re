<?php
$attributes = array('class' => '', 'id' => 'invoice_confirmation','name'=>'invoice_confirmation');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>
<?php if (!$this->input->is_ajax_request()) { ?>
    <div class="col-md-12">
        <div class="top_form">
            <div class="row">
                <div class="col-md-12 tp_form">
                    <div class="row">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Month</label>
                                <input type="text" class="form-control" name="invoice_month" id="invoice_month" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>PO No.</label>
                                <input type="text" class="form-control" name="po_no" id="po_no" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="invoice_date">Invoice No.</label>
                                <input type="text" class="form-control" name="invoice_no" id="invoice_no" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-2 text-center save_btn">
                            <label style="display: block;">&nbsp;</label>
                            <button type="submit" class="btn btn-primary gren_btn">Execute</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 tp_form">

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
<?php }?>
<?php

if ($this->input->is_ajax_request()) {
    echo theme_view('common/middle');
}
?>
<div id="middle_container_received" class="middle_container_received">

</div>
<div id="product_table_container_invoice">

</div>
<?php echo form_close(); ?>