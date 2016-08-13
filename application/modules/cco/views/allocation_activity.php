<?php if(!$this->input->is_ajax_request()){ ?>
    <?php
    $attributes = array('class' => '', 'id' =>'allocation_activity','name'=>'allocation_activity', 'autocomplete'=>'off');
    echo form_open('',$attributes);
    ?>
    <div class="col-md-12">
        <div class="top_form">
            <div class="row">
                <div class="col-md-12 text-center sub_nave">
                    <div class="inn_sub_nave">
                        <ul>
                            <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='allocation') ? 'active' :'' ;?>"><a href="<?php echo base_url('cco/allocation') ?>">Farmers</a></li>
                            <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='channel_partner_allocation') ? 'active' :'' ;?>"><a href="<?php echo base_url('cco/channel_partner_allocation') ?>">Channel Partners</a></li>
                            <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='allocation_activity') ? 'active' :'' ;?>"><a href="<?php echo base_url('cco/allocation_activity') ?>">Activity</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="col-md-12 text-center radio_space">
                    <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="radio1" value="planned_activity" checked="checked" />
                        <label for="radio1">Planned Activities</label>
                    </div>
                    <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="radio2" value="executed_activity" />
                        <label for="radio2">Executed Activities</label>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="col-md-12 col-md-offset-0 distributore_form">
                    <div class="row">
                        <div class="col-md-3 col-sm-8 tp_form">
                            <div class="form-group">
                                <label>Type Of Activity<span style="color: red">*</span></label>
                                <select class="selectpicker" name="activity_type" id="activity_type" title="" data-live-search="true">
                                    <option value="">Select Activity Type</option>

                                    <?php
                                    if(isset($activity_type) && !empty($activity_type)) {
                                        foreach($activity_type as $k =>$val){ ?>
                                        <option value="<?php echo $val['activity_type_country_id'] ?>"><?php echo $val['activity_type_country_name'] ?></option>
                                        <?php }
                                     } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-8 tp_form">
                            <div class="form-group">
                                <label>From Date<span style="color: red">*</span></label>
                                <input type="text" name="from_date" value=""  id="from_date" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-8 tp_form">
                            <div class="form-group">
                                <label>To Date<span style="color: red">*</span></label>
                                <input type="text" name="to_date" value=""  id="to_date" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-2 save_btn">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary gren_btn" style="padding: 0 !important;">Execute</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
<?php } ?>

<?php
if ($this->input->is_ajax_request()) {
    echo theme_view('common/middle');
}
?>
<?php if(!$this->input->is_ajax_request()){ ?>

    <?php
    $attributes = array('class' => '', 'id' =>'add_cco_activity','name'=>'add_cco_activity', 'autocomplete'=>'off');
    echo form_open('',$attributes);
    ?>

    <div id="middle_container" class="activity_data">

    </div>

    <div class="col-md-12 ad_mr_top">
        <div class="row">
            <label>CCO Name</label>
            <select id="cco_data" class="cco_data selectpicker" name="cco_data">
                <option value="">Select CCO</option>

                <?php
                if(!empty($cco_data)) {
                    foreach ($cco_data as $c_key => $ccodata) { ?>

                        <option value="<?php echo $ccodata["id"]; ?>"><?php echo $ccodata["display_name"]; ?></option>
                        <?php  }
                    } ?>
            </select>
            <button title="Save" type="submit" class="btn btn-primary save_btn">Save</button>
        </div>
    </div>
    <?php echo form_close(); ?>


    <div id="middle_container" class="cco_details">

    </div>

    <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 10px;">
        <div class="save_button">
            <div class="row">
                <div class="delete_button" style="display: none">
                    <div class="col-md-3 save_btn">
                        <button type="button" id ='cancel_data' class="btn btn-primary" style="background-color: red">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
