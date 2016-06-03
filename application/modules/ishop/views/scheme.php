<?php
$attributes = array('class' => '', 'id' => 'add_schemes','name'=>'add_schemes');
echo form_open('',$attributes); ?>

<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="active"><a href="<?php echo base_url('/ishop/set_schemes') ?>">Allocation</a></li>
                        <li><a href="<?php echo base_url('/ishop/schemes_view') ?>">View</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2 distributore_form">
                <div class="row">
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" class="form-control" name="cur_year" id="cur_year" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label>Geo Level 3</label>
                            <select class="selectpicker" name="region" id="geo_level_rol">
                                <option value="0">Select Geo Location</option>
                               <!-- <?php
/*                                if(isset($geo_data) && !empty($geo_data))
                                {
                                    foreach($geo_data as $k=> $geo_val)
                                    {
                                        */?>
                                        <option value="<?php /*echo $geo_val['business_geo_id']; */?>" attr-name="<?php /*echo $geo_val['business_georaphy_name']; */?>"><?php /*echo $geo_val['business_georaphy_name']; */?></option>
                                        --><?php
/*                                    }
                                }
                                */?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label>Geo Level 2</label>
                            <select class="selectpicker" name="territory" id="geo_level_1">
                                <option value="0">Select Geo Location</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input class="login_customer_role" type="hidden" name="login_customer_role" id="login_customer_role" value="<?php echo $current_user->role_id; ?>" />
    <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $current_user->id; ?>" />
    <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $current_user->country_id; ?>" />

    <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />
    <div class="clearfix"></div>
</div>

<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
            <div class="row">
                <div class="col-md-4_ tp_form">
                    <div class="form-group">
                        <label>Retailer Name</label>
                        <select class="selectpicker" name="fo_retailer_id" id="retailer_scheme">
                            <option value="0">Select Retailer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4_ tp_form">
                    <div class="form-group">
                        <label>Schemes</label>
                        <select class="selectpicker" name="schemes" id="schemes">
                            <option>Select Schemes</option>
                            <?php
                            if(isset($schemes) && !empty($schemes))
                            {
                                foreach($schemes as $k=> $schemes_val)
                                {
                                    ?>
                                    <option value="<?php echo $schemes_val['scheme_id']; ?>" attr-name="<?php echo $schemes_val['scheme_name']; ?>"><?php echo $schemes_val['scheme_name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php }?>
<?php
if ($this->input->is_ajax_request()) {
    echo theme_view('common/middle');
}
?>
<div id="scheme_middle_container" class="scheme_middle_container">
</div>

<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12 table_bottom">
    <div class="row">
        <div class="col-md-3 save_btn">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>
<?php }?>

<?php echo form_close(); ?>
