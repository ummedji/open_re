<?php $segment2 = $this->uri->segment(2); ?>
<?php if (!$this->input->is_ajax_request()) {
?>
<?php
$attributes = array('class' => '', 'id' => 'distributor_compititor_view','name'=>'distributor_compititor_view');
echo form_open('ecp/distributor_compititor_details_view',$attributes);
?>
<div class="col-md-12 full-height">
    <div class="row">
        <div class="col-md-12">
            <div class="top_form">
                <div class="row">
                    <div class="col-md-12 text-center sub_nave">
                        <div class="inn_sub_nave">
                            <ul>
                                <li class="<?php echo ($segment2=='retailer_compititor_analysis' || $segment2=='retailer_compititor_product' || $segment2=='retailer_compititor_view') ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/retailer_compititor_analysis')?>">Retailer</a></li>
                                <li class="<?php echo ($segment2=='distributor_compititor_analysis' || $segment2=='distributor_compititor_product' || $segment2=='distributor_compititor_view' ) ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/distributor_compititor_analysis')?>">Distributor</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center sub_nave_sub">
                        <div class="inn_sub_nave">
                            <ul>
                                <li class="<?php echo ($segment2=='distributor_compititor_analysis') ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/distributor_compititor_analysis') ?>">Total</a></li>
                                <li class="<?php echo ($segment2=='distributor_compititor_product') ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/distributor_compititor_product') ?>">Product</a></li>
                                <li class="<?php echo ($segment2=='distributor_compititor_view') ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/distributor_compititor_view') ?>">View</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center radio_space">
                        <div class="radio">
                            <input class="analysis_type"  type="radio" name="radio" id="total" value="total" checked>
                            <label for="radio1">Total</label>
                        </div>
                        <div class="radio">
                            <input class="analysis_type" type="radio" name="radio" id="product" value="product">
                            <label for="radio2">Product</label>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12 text-center tp_form inline-parent">
                        <div class="row">
                            <div class="form-group">
                                <label for="from_month">From Month<span style="color: red">*</span></label>
                                <div class="inln_fld_top">
                                    <input type="text" class="form-control" name="from_month" id="from_month" placeholder="">
                                    <div class="clearfix"></div>
                                    <label id="from_month-error" class="error" for="from_month"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="to_month">To Month<span style="color: red">*</span></label>
                                <div class="inln_fld_top">
                                    <input type="text" class="form-control" name="to_month" id="to_month" placeholder="">
                                    <div class="clearfix"></div>
                                    <label id="to_month-error" class="error" for="to_month"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="save_button">
                                    <div class="row">
                                        <div class="col-md-3 save_btn">
                                            <button type="submit" id ="execute_request" class="btn btn-primary">Execute</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>


    <input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $current_user->role_id; ?>" />
    <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $current_user->id; ?>" />
    <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo  $current_user->country_id; ?>" />
    <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />

    <?php echo form_close();
    ?>
    <div class="clearfix"></div>
<?php }?>


<?php
if ($this->input->is_ajax_request()) {
    echo theme_view('common/middle');
}
?>
<?php
$attributes = array('class' => '', 'id' => 'distributor_compititor_view_data','name'=>'distributor_compititor_view_data');
echo form_open('',$attributes); ?>
<?php if (!$this->input->is_ajax_request()) {
    ?>
    <div id="middle_container" class="distributor_view_cont">

    </div>
<?php  } ?>
<?php echo form_close(); ?>
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

