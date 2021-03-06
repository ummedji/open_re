<?php
$attributes = array('class' => '', 'id' => 'view_schemes','name'=>'view_schemes', 'autocomplete'=>'off');
echo form_open('ishop/view_schemes_details',$attributes); ?>
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
            $year = date("Y");
            ?>
            <div class="col-md-12 text-center tp_form inline-parent distributore_form" style="margin-top: 15px;">
                <div class="row">
                   <!-- <div class="col-md-4 col-sm-6 tp_form">-->
                        <div class="form-group">
                            <label>Year<span style="color: red">*</span></label>
                            <div class="inln_fld_top">
                                <input type="text" class="form-control" name="year" id="year" placeholder="" value="<?php echo $year ?>" autocomplete="off" >
                                <div class="clearfix"></div>
                                <label id="year-error" class="error" for="year"></label>
                            </div>
                        </div>
                    <!--</div>-->
                    <?php if($current_user->role_id == 7){
                        ?>
                        <!--<div class="col-md-4 col-sm-6 tp_form">-->
                            <div class="form-group">
                                <label>Geo Level 3</label>
                                <select class="selectpicker" name="region" id="geo_level_scheme" data-live-search="true">
                                    <option value="">Select Geo Location</option>
                                </select>
                            </div>
                        <!--</div>-->
                        <!--<div class="col-md-4 col-sm-6 tp_form">-->
                            <div class="form-group">
                                <label>Geo Level 2</label>
                                <select class="selectpicker" name="territory" id="geo_level_1" data-live-search="true">
                                    <option value="">Select Geo Location</option>
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
                                <div class="inln_fld_top text-left">
                                    <select class="selectpicker" name="territory" id="geo_level_1" data-live-search="true" required>
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
                                    <div class="clearfix"></div>
                                    <label id="geo_level_1-error" class="error" for="geo_level_1"></label>
                                </div>
                            </div>
                        <!--</div>-->
                       <!-- <div class="col-md-4 col-sm-6 tp_form">-->
                            <div class="form-group">
                                <label>Retailer Name</label>
                                <select class="selectpicker" name="fo_retailer_id" id="retailer_scheme" data-live-search="true">
                                    <option value="">Select Retailer</option>
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
                                    <button type="submit" id="view_sch" class="btn btn-primary gren_btn">Execute</button>
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
<?php }?>
<?php
if ($this->input->is_ajax_request()) {
    echo theme_view('common/middle');
}
?>
<div id="middle_container" class="scheme_view_middle_container">

</div>
<?php if($current_user->role_id != 8){ ?>
    <script type="text/javascript">

        $( window ).on("load",function() {
            setTimeout(function(){
                $("button#view_sch").trigger("click");
            }, 500);
        });

    </script>
<?php } ?>
