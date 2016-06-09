<?php if (!$this->input->is_ajax_request()) { ?>
    <div class="col-md-12">
        <div class="top_form">
            <?php
            $attributes = array('class' => '', 'id' => 'secondary_sales_view','name'=>'secondary_sales_view');
            //echo form_open($this->uri->uri_string(),$attributes);
            echo form_open('',$attributes); ?>

            <div class="row">
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>From Date</label>
                        <input type="text" class="form-control" name="form_date" id="form_date" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>TO Date</label>
                        <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-5 col-sm-6 tp_form">
                            <div class="form-group fulle_wd">
                                <label for="invoice_no">Search By Retailer</label><br>
                                <select class="selectpicker" name="by_retailer" id="by_distributor" data-live-search="true">
                                    <option value="0">Select Retailer Name</option>
                                    <?php
                                    if(isset($retailer) && !empty($retailer))
                                    {
                                        foreach($retailer as $key=>$val_retailer)
                                        {
                                            ?>
                                            <option value="<?php echo $val_retailer['id']; ?>"><?php echo $val_retailer['display_name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-6 tp_form">
                            <div class="form-group">
                                <label for="invoice_date">Search By Invoice No.</label>
                                <input type="text" class="form-control" name="by_invoice_no" id="by_invoice_no" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-2 save_btn">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary gren_btn" style="padding: 0 !important;">Execute</button>
                        </div>
                    </div>
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

<?php
if (!$this->input->is_ajax_request()) {
    $attributes = array('class' => '', 'id' => 'secondary_sales_view_data','name'=>'secondary_sales_view_data');
    echo form_open('',$attributes); ?>
    <div id="middle_container_secondary" class="secondary_cont">

    </div>
    <div id="product_table_container_secondary" class="secondary_product">

    </div>
    <?php echo form_close(); ?>
<?php
}
?>
<?php
if (!$this->input->is_ajax_request()) {
    ?>
    <div class="check_save_btn" id="check_save_btn" style="display:none;">
        <div class="col-md-2 save_btn">
            <label>&nbsp;</label>
            <button type="submit" name="save" id="check_save" class="btn btn-primary gren_btn" style="margin-bottom: 50px">Save</button>
        </div>
    </div>
    <?php
}
?>



