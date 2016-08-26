<div class="actv-details-form">
    <h5>Schemes</h5>
    <div class="back_details">

        <?php
        $customer_id = (isset($customer_id) && !empty($customer_id))? $customer_id : "";
        ?>

        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_scheme_view_info','name'=>'dialpad_scheme_view_info', 'autocomplete'=>'off');
        echo form_open('cco/get_scheme_view_info',$attributes);
        ?>
        <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />
        <input type="hidden" class="form-control" name="feedback_edit_id" id="scheme_edit_id" placeholder="" value="" />
       <?php $caller_data = $this->session->userdata("caller_data");
        //testdata($caller_data);  ?>
        <div class="row">

            <div class="col-md-12 text-center tp_form inline-parent distributore_form" style="margin-top: 15px;">
                <div class="row">
                    <!-- <div class="col-md-4 col-sm-6 tp_form">-->
                    <div class="form-group">
                        <label>Year<span style="color: red">*</span></label>
                        <div class="inln_fld_top">
                            <input type="text" class="form-control valid year_data" name="year" id="year" placeholder="" value="2016" autocomplete="off" aria-required="true">
                            <div class="clearfix"></div>
                            <label id="year-error" class="error" for="year" style="display: none;"></label>
                        </div>
                    </div>
                    <!--</div>-->
                    <!--<div class="col-md-4 col-sm-6 tp_form">-->
                    <div class="form-group">
                        <label>Geo Level 2<span style="color: red">*</span></label>
                        <div class="inln_fld_top text-left">


                            <input readonly type="text" class="form-controls" name="geo_loc_name" id="geo_loc_name" placeholder="" value="<?php echo $get_business_geo_data_to_retailer['business_georaphy_name']; ?>" autocomplete="off" aria-required="true">

                            <input type= "hidden" name="geo_loc_id" id="geo_loc_id" value="<?php echo $get_business_geo_data_to_retailer['business_geo_id']; ?>">

                            <div class="clearfix"></div>
                            <label id="geo_level_1-error" class="error" for="geo_level_1" style="display: none;"></label>
                        </div>
                    </div>
                    <!--</div>-->
                    <!-- <div class="col-md-4 col-sm-6 tp_form">-->

                    <!-- </div-->

                    <!--<div class="col-md-4 col-sm-6 tp_form">-->
                    <div class="form-group">
                        <!--<div class="row">-->
                        <div class="inl_button save_btn">
                            <button type="submit"  class="btn btn-primary gren_btn">Execute</button>
                        </div>
                    </div>
                </div>
                <!--</div>-->
            </div>


        </div>
        <?php form_close(); ?>

    </div>
    <div class="clearfix"></div>

    <?php
    if ($this->input->is_ajax_request()) {
        echo theme_view('common/middle');
    }
    ?>
    <div id="middle_container" class="scheme_view_middle_container">

    </div>
</div>
<div class="clearfix"></div>

