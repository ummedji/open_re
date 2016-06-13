<?php
$attributes = array('class' => '', 'id' => 'view_schemes','name'=>'view_schemes');
echo form_open('',$attributes); ?>
<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <?php if($current_user->role_id == 7){
                ?>
                <div class="col-md-12 text-center sub_nave">
                    <div class="inn_sub_nave">
                        <ul>
                            <li><a href="<?php echo base_url('/ishop/set_schemes') ?>">Allocation</a></li>
                            <li class="active"><a href="<?php echo base_url('/ishop/schemes_view') ?>">View</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="col-md-12 text-center tp_form inline-parent distributore_form" style="margin-top: 15px;">
                <div class="row">
                   <!-- <div class="col-md-4 col-sm-6 tp_form">-->
                        <div class="form-group">
                            <label>Year<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="year" id="year" placeholder="">
                        </div>
                    <!--</div>-->
                    <?php if($current_user->role_id == 7){
                        ?>
                        <!--<div class="col-md-4 col-sm-6 tp_form">-->
                            <div class="form-group">
                                <label>Geo Level 3</label>
                                <select class="selectpicker" name="region" id="geo_level_scheme">
                                    <option value="0">Select Geo Location</option>
                                </select>
                            </div>
                        <!--</div>-->
                        <!--<div class="col-md-4 col-sm-6 tp_form">-->
                            <div class="form-group">
                                <label>Geo Level 2</label>
                                <select class="selectpicker" name="territory" id="geo_level_1">
                                    <option value="0">Select Geo Location</option>
                                </select>
                            </div>
                        <!--</div>-->
                    <?php
                    }

                    elseif($current_user->role_id == 8)
                    {
                        ?>
                        <!--<div class="col-md-4 col-sm-6 tp_form">-->
                            <div class="form-group">
                                <label>Geo Level 2<span style="color: red">*</span></label>
                                <select class="selectpicker" name="territory" id="geo_level_1">
                                    <option value="">Select Geo Location</option>
                                    <?php
                                    if(isset($geo_data) && !empty($geo_data))
                                    {
                                        foreach($geo_data as $k=> $geo_val)
                                        {
                                            ?>
                                        <option value="<?php echo $geo_val['business_geo_id']; ?>" attr-name="<?php echo $geo_val['business_georaphy_name']; ?>"><?php echo $geo_val['business_georaphy_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        <!--</div>-->
                       <!-- <div class="col-md-4 col-sm-6 tp_form">-->
                            <div class="form-group">
                                <label>Retailer Name</label>
                                <select class="selectpicker" name="fo_retailer_id" id="retailer_scheme">
                                    <option value="0">Select Retailer</option>
                                </select>
                            </div>
                       <!-- </div-->
                    <?php
                    }

                    ?>

                    <!--<div class="col-md-4 col-sm-6 tp_form">-->
                        <div class="form-group">
                            <!--<div class="row">-->
                                <div class="inl_button save_btn">
                                    <button type="submit" class="btn btn-primary gren_btn">Save</button>
                                </div>
                            </div>
                        </div>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
    <input class="login_customer_role" type="hidden" name="login_customer_role" id="login_customer_role" value="<?php echo $current_user->role_id; ?>" />
    <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $current_user->id; ?>" />
    <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $current_user->country_id; ?>" />

    <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />
    <?php echo form_close(); ?>
    <div class="clearfix"></div>
</div>
<?php }?>
<?php
if ($this->input->is_ajax_request()) {
    echo theme_view('common/middle');
}
?>
<div id="scheme_view_middle_container" class="scheme_view_middle_container">

</div>