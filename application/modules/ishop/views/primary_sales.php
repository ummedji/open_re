<?php if (!$this->input->is_ajax_request()) { ?>
<?php
$attributes = array('class' => '', 'id' => 'primary_sales_view','name'=>'primary_sales_view', 'autocomplete'=>'off');
echo form_open('ishop/primary_sales_details_view',$attributes); ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>From Date<span style="color: red">*</span></label>
                        <div class="inln_fld_top">
                            <input type="text" class="form-control" name="form_date" id="form_date" placeholder="" autocomplete="off" >
                            <div class="clearfix"></div>
                            <label id="form_date-error" class="error" for="form_date"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>To Date<span style="color: red">*</span></label>
                        <div class="inln_fld_top">
                            <input type="text" class="form-control" name="to_date" id="to_date" placeholder="" autocomplete="off" >
                            <div class="clearfix"></div>
                            <label id="to_date-error" class="error" for="to_date"></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-5 col-sm-6 tp_form">
                            <div class="form-group fulle_wd">
                                <label for="invoice_no">Search By Distributor</label>
                                <select class="selectpicker" name="by_distributor" id="by_distributor" data-live-search="true">
                                    <option value="0">Select Distributor Name</option>
                                    <?php
                                    if(isset($distributor) && !empty($distributor))
                                    {
                                        foreach($distributor as $key=>$val_distributor)
                                        {
                                            ?>
                                            <option value="<?php echo $val_distributor['id']; ?>"><?php echo $val_distributor['display_name']; ?></option>
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
                            <button type="submit" name="execute" value="execute" class="btn btn-primary gren_btn">Execute</button>
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
<?php if (!$this->input->is_ajax_request()) {
    ?>
    <?php
    $attributes = array('class' => '', 'id' => 'primary_sales_view_data','name'=>'primary_sales_view_data');
    echo form_open('',$attributes);
    ?>
        <div id="middle_container" class="primary_cont">

        </div>

        <div id="middle_container_product" class="primary_products">

        </div>

    <?php echo form_close(); ?>
<?php
}?>


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

