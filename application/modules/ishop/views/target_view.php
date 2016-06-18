<?php
$attributes = array('class' => '', 'id' => 'target_view','name'=>'target_view');
echo form_open('',$attributes);
?>
<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
                <div class="col-md-4 col-sm-4 tp_form">
                    <div class="form-group">
                        <div class="form-group">
                            <label>From Month<span style="color: red">*</span></label>
                            <input type="text" name="from_month_data" id="from_month_data" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 tp_form">
                    <div class="form-group">
                        <div class="form-group">
                            <label>To Month<span style="color: red">*</span></label>
                            <input type="text" name="to_month_data" id="to_month_data" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="col-md-3 save_btn">
                    <button type="submit" class="btn btn-primary">Execute</button>
                </div>
            <div class="clearfix"></div>

            <input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $current_user->role_id; ?>" />
            <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $current_user->id; ?>" />
            <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $current_user->country_id; ?>" />
            <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />
            <?php echo form_close(); ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php }?>
<?php echo form_close(); ?>

<?php
if ($this->input->is_ajax_request())
{
    echo theme_view('common/middle');
}

if (!$this->input->is_ajax_request()) {?>
<div id="middle_container" class="target_view_container">

</div>
<?php }?>
