<?php $segment2 = $this->uri->segment(2); ?>
<?php if (!$this->input->is_ajax_request()) {
    ?>
    <?php
    $attributes = array('class' => '', 'id' => '','name'=>'');
    echo form_open('ecp/',$attributes);
    ?>
    <div class="col-md-12 full-height">
        <div class="row">
            <div class="col-md-12">
                <div class="top_form">
                    <div class="row">
                        <div class="col-md-12 text-center sub_nave">
                            <div class="inn_sub_nave">
                                <ul>
                                    <?php
                                    if($child_user_data['tot'] !=0)
                                    {
                                        ?>
                                        <li><a href="<?php echo base_url('ecp/activity_approval')?>">Approval</a></li>
                                        <li><a href="<?php echo base_url('ecp/')?>">View</a></li>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <li class="active"><a href="<?php echo base_url('ecp/activity_planning')?>">Planning</a></li>
                                        <li><a href="<?php echo base_url('ecp/')?>">Execution</a></li>
                                        <li><a href="<?php echo base_url('ecp/')?>">Unplanned</a></li>
                                        <li><a href="<?php echo base_url('ecp/')?>">View</a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="col-md-4 col-md-offset-4 tp_form text-center_form" >
                            <div class="form-group">
                                <label>Month<span style="color: red">*</span></label>
                                <div class="inln_fld_top text-left">
                                    <input type="text" class="form-control" name="stock_month" id="stock_month" placeholder="" >
                                    <div class="clearfix"></div>
                                    <label id="stock_month-error" class="error" for="stock_month"></label>
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
$attributes = array('class' => '', 'id' => '','name'=>'');
echo form_open('',$attributes); ?>
<?php if (!$this->input->is_ajax_request()) {
    ?>
    <div id="middle_container" class="approval_view_cont">
        <?php
        echo theme_view('common/middle');
        ?>
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
