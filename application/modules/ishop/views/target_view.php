<?php
$attributes = array('class' => '', 'id' => 'target_view','name'=>'target_view');
echo form_open('',$attributes);
?>
<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="col-md-12 text-center tp_form inline-parent">

                    <div class="form-group">
                        <div class="form-group">
                            <label>From Month<span style="color: red">*</span></label>
                            <input type="text" name="from_month_data" id="from_month_data" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label>To Month<span style="color: red">*</span></label>
                            <input type="text" name="to_month_data" id="to_month_data" class="form-control" />
                        </div>
                    </div>

                <div class="inl_button save_btn">
                    <button type="submit" class="btn btn-primary gren_btn">Execute</button>
                </div>
            <div class="clearfix"></div>

            <input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $current_user->role_id; ?>" />
            <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $current_user->id; ?>" />
            <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $current_user->country_id; ?>" />
            <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />
            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
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
