<?php if (!$this->input->is_ajax_request()) { ?>
    <div class="col-md-12">
        <div class="top_form">
            <?php
            $attributes = array('class' => '', 'id' => 'invoice_confirmation','name'=>'invoice_confirmation');
            //echo form_open($this->uri->uri_string(),$attributes);
            echo form_open('',$attributes); ?>

            <div class="row">
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>Month</label>
                        <input type="text" class="form-control" name="invoice_month" id="form_date" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>PO No.</label>
                        <input type="text" class="form-control" name="po_no" id="po_no" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="invoice_date">Invoice No.</label>
                        <input type="text" class="form-control" name="invoice_no" id="invoice_no" placeholder="">
                    </div>
                    <div class="col-md-3 save_btn" style="float: right;">
                        <button type="submit" class="btn btn-primary">Execute</button>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 tp_form">

                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="clearfix"></div>
    </div>
<?php }?>
<?php

if ($this->input->is_ajax_request()) {
    echo theme_view('common/middle');
}
?>
<div id="middle_container_secondary" class="secondary_cont">

</div>
<div id="product_table_container_secondary">

</div>