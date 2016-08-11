<?php if (isset($activity_planning) && !empty($activity_planning)) { ?>
    <div class="col-md-9">
        <div class="top_form planning_parent">
            <div class="row">
                <div class="col-md-12">
                    <div class="default_box_white">
                        <div class="col-md-12 text-center tp_form inline-parent">
                            <div class="form-group">
                                <?php if(isset($current_user->local_date) && !empty($current_user->local_date)){
                                     $date = strtotime($activity_planning['activity_planning_date']);
                                    $planning_date = date($current_user->local_date,$date);
                                }
                                else{
                                    $planning_date = $activity_planning['activity_planning_date'];
                                }
                                ?>

                                <label>Select Date<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="planning_date" id="planning_date"
                                       value="<?php echo $planning_date ?>"
                                       placeholder="">
                            </div>
                            <?php

                            $time = explode(' ', $activity_planning['activity_planning_time']);
                            $plan_time = date('h:i A', strtotime($time[1]));

                            ?>

                            <div class="form-group">
                                <label>Time<span style="color: red">*</span></label>
                                <!--<input  type="text" class="form-control input-append" data-format="hh:mm" id="timepicker1"  />-->
                                <div class="bootstrap-timepicker bootstrap-timepicker-as">
                                    <input id="planning_time" name="planning_time" type="text"
                                           value="<?php echo $plan_time; ?>"
                                           class="input-group-time form-control input-append">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                    <div class="default_box_white">
                        <div class="col-md-12 tp_form mr_bot_group">
                            <div class="row form-group">
                                <div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Select Activity Type<span
                                            style="color: red">*</span></label></div>
                                <?php if (isset($activity_planning['activity_type_id']) && !empty($activity_planning['activity_type_id'])) {
                                    ?>
                                    <div class="col-md-4 col-sm-8 cont_size_select mrg_bottom_30">
                                        <select class="selectpicker" id="activity_type_id" name="activity_type_id"
                                                data-live-search="true" disabled>
                                            <option value="">Select Activity Type</option>
                                            <?php
                                            if (isset($activity_type) && !empty($activity_type)) {
                                                foreach ($activity_type as $key => $val) {
                                                    ?>
                                                    <option <?php if ($val['activity_type_country_id'] == $activity_planning["activity_type_id"]) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $val['activity_type_country_id']; ?>"
                                                         code="<?php echo $val['activity_type_code']; ?>"><?php echo $val['activity_type_country_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="activity_type_id" id="activity_type_id" value="<?php echo $activity_planning["activity_type_id"] ?>">
                                    </div>
                                    <?php
                                }
                                ?>
                                <!--Demonstration Dropdown-->
                                <?php
                                /*if(isset($activity_planning["activity_type_id"]) && !empty($activity_planning["activity_type_id"]))
                                {
                                    */ ?><!--
                                            <div class="col-md-2 col-sm-3 first_lb"><label>Demonstration</label></div>
                                            <div class="col-md-2 col-sm-8 cont_size_select">
                                                <select class="selectpicker" name="demo_id" id="demo_id" data-live-search="true">
                                                    <option value="">Select Demonstration</option>
                                                </select>
                                            </div>
                                        --><?php
                                /*                                        }*/
                                ?>
                                <!--Demonstration Dropdown-->
                            </div>


                            <!--GEO  Dropdown-->
                            <div class="row form-group" id="geo">

                               <?php
                               if (isset($activity_planning['geo_level_id_2']) && !empty($activity_planning['geo_level_id_2'])) {
                                    ?>
                                    <div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Geo2<span style="color: red">*</span></label></div>
                                    <div class="col-md-2 col-sm-8 cont_size_select mrg_bottom_30">
                                        <select class="selectpicker" data-live-search="true" name="geo_level_2"
                                                id="geo_level_2">
                                            <option value="">Select Geo 2</option>
                                            <?php
                                            if (isset($geo_level_2) && !empty($geo_level_2)) {

                                                foreach ($geo_level_2 as $k => $val_g2) {
                                                    ?>
                                                    <option <?php if ($val_g2['political_geo_id'] == $activity_planning["geo_level_id_2"]) { echo "selected"; } ?> value="<?php echo $val_g2['political_geo_id'] ?>"><?php echo $val_g2['political_geography_name'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <?php
                                }
                               ?>
                                <?php if (isset($activity_planning['geo_level_id_3']) && !empty($activity_planning['geo_level_id_3'])) {
                                    ?>
                                    <div class="col-md-1 col-sm-3 first_lb"><label>Geo3<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-2 col-sm-8 cont_size_select">
                                        <select class="selectpicker" data-live-search="true" name="geo_level_3"
                                                id="geo_level_3">
                                            <option value="">Select Geo 3</option>
                                            <?php
                                            if (isset($geo_level_3) && !empty($geo_level_3)) {

                                                foreach ($geo_level_3 as $k => $val_g3) {
                                                    ?>
                                                    <option <?php if ($val_g3['political_geo_id'] == $activity_planning["geo_level_id_3"]) { echo "selected"; } ?> value="<?php echo $val_g3['political_geo_id'] ?>"><?php echo $val_g3['political_geography_name'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?php
                                }
                                ?>

                                <?php if (isset($activity_planning['geo_level_id_4']) && !empty($activity_planning['geo_level_id_4'])) {
                                    ?>
                                    <div class="col-md-1 col-sm-3 first_lb"><label>Geo4<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-2 col-sm-8 cont_size_select">
                                        <select class="selectpicker" data-live-search="true" name="geo_level_4"
                                                id="geo_level_4">
                                            <option value="">Select Geo 4</option>
                                            <?php
                                            if (isset($geo_level_4) && !empty($geo_level_4)) {

                                                foreach ($geo_level_4 as $k => $val_g4) {
                                                    ?>
                                                    <option <?php if ($val_g4['political_geo_id'] == $activity_planning["geo_level_id_4"]) { echo "selected"; } ?>
                                                        value="<?php echo $val_g4['political_geo_id'] ?>">
                                                        <?php echo $val_g4['political_geography_name'] ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                            <!--GEO  Dropdown-->
                            <?php if (isset($activity_planning['location']) && !empty($activity_planning['location'])) {
                                ?>
                                <div class="row form-group">
                                    <div class="col-md-3 col-sm-3 first_lb"><label>Address<span
                                                style="color: red">*</span></label></div>
                                    <div class="col-md-8 col-sm-8">
                                        <textarea class="form-control" rows="4" name="activity_address"
                                                  id="activity_address"><?php echo $activity_planning['location'] ?></textarea>
                                    </div>

                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!--Demonstration  Detail-->
                    <?php if ($activity_planning['activity_type_code'] == 'DP005' || $activity_planning['activity_type_code'] == 'FDP006') { ?>
                            <div class="default_box_white">
                                <div class="col-md-12 plng_title"><h5>Demonstration</h5></div>
                                <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                                <label>Size Of Plot</label>
                                                <input type="text" class="form-control" name="size_of_plot"
                                                       id="size_of_plot"
                                                       value="<?php echo(isset($activity_planning['size_of_plot']) && !empty($activity_planning['size_of_plot'])) ? $activity_planning['size_of_plot'] : 0  ?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 corp_text mrg_top_30">
                                            <div class="form-group frm_details text-center">
                                                <label>Spray Volume</label>
                                                <input type="text" class="form-control" name="spray_volume" id="spray_volume" value="<?php echo(isset($activity_planning['spray_volume']) && !empty($activity_planning['spray_volume'])) ? $activity_planning['spray_volume'] : 0 ?>" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php } ?>


                    <!--Demonstration  Detail-->

                    <div class="default_box_grey">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-5 tp_form inline-parent corp_text corp_text_align">
                                    <div class="form-group" style="margin-bottom: 0px;">
                                        <label>Corp<span style="color: red">*</span></label>
                                        <select class="selectpicker" name="crop[]" id="crop" data-live-search="true" multiple title="Select Corp">
                                            <?php
                                            if (isset($crop_details) && !empty($crop_details)) {
                                                $activity_crop_details = array();
                                                foreach ($activity_planning['crop'] as $ak => $adl) {
                                                    $activity_crop_details[] = $adl['crop_id'];
                                                }

                                                foreach ($crop_details as $k => $cd) {
                                                    ?>
                                                    <option <?php if (in_array($cd['crop_country_id'], $activity_crop_details)) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $cd['crop_country_id'] ?>">
                                                        <?php echo $cd['crop_name'] ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="default_box_grey">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-5 tp_form inline-parent corp_text corp_text_align">
                                    <div class="form-group" style="margin-bottom: 0px;">
                                        <label>Products<span style="color: red">*</span></label>
                                        <select class="selectpicker" name="product_sku[]" id="product_sku" data-live-search="true" multiple title="Select Product">
                                            <?php
                                            if (isset($product_sku) && !empty($product_sku)) {
                                                $activity_product_sku = array();
                                                foreach ($activity_planning['products'] as $ak => $adl) {
                                                    $activity_product_sku[] = $adl['product_sku_id'];
                                                }

                                                foreach ($product_sku as $k => $ps) {
                                                    ?>
                                                    <option <?php if (in_array($ps['product_sku_country_id'], $activity_product_sku)) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $ps['product_sku_country_id'] ?>">
                                                        <?php echo $ps['product_sku_name'] ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="default_box_grey">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-5 tp_form inline-parent corp_text corp_text_align">
                                    <div class="form-group" style="margin-bottom: 0px;">
                                        <label>Diseases<span style="color: red">*</span></label>
                                        <select class="selectpicker" name="diseases[]" id="diseases" data-live-search="true" multiple title="Select Diseases">
                                            <?php
                                            if (isset($diseases_details) && !empty($diseases_details)) {
                                                $activity_diseases_details = array();
                                                foreach ($activity_planning['diseases'] as $ak => $add) {
                                                    $activity_diseases_details[] = $add['diseases_id'];
                                                }

                                                foreach ($diseases_details as $k => $dd) {
                                                    ?>
                                                    <option <?php if (in_array($dd['disease_country_id'], $activity_diseases_details)) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $dd['disease_country_id'] ?>">
                                                        <?php echo $dd['disease_name'] ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                    <?php if (isset($activity_planning['key_farmer']) && !empty($activity_planning['key_farmer'])) { ?>
                        <div class="default_box_white">
                            <div class="col-md-12 plng_title"><h5>Key Farmer Details</h5></div>
                            <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                            <label>Key Farmer</label>
                                            <select class="selectpicker" name="farmer_id" id="farmer_id"
                                                    data-live-search="true">
                                                <option value="">Select Farmer</option>
                                                <?php
                                                foreach ($key_farmer as $KK => $vkf) {
                                                    ?>
                                                    <option value="<?php echo $vkf['id']; ?>"
                                                            attr-name="<?php echo $vkf['display_name']; ?>"><?php echo $vkf['display_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 corp_text mrg_top_30">
                                        <div class="form-group frm_details text-center">
                                            <label>Mobile No.</label>
                                            <input type="text" class="form-control" name="farmer_no" id="farmer_no"
                                                   placeholder="">
                                            <div class="plus_btn"><a href="javascript: void(0);" id="add_farmer"><i
                                                        class="fa fa-plus" aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-md-offset-2">
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                        <tr>
                                            <th style="padding: 4px 0;">Key Farmer<span class="rts_bordet"></span></th>
                                            <th style="padding: 4px 0;">Mobile No.<span class="rts_bordet"></th>
                                            <th style="padding: 4px 0;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="farmer_detail" class="tbl_body_row">
                                        <?php if (isset($activity_planning['key_farmer']) && !empty($activity_planning['key_farmer'])) {
                                            foreach ($activity_planning['key_farmer'] as $kf => $vf) {
                                                ?>
                                                <tr>
                                                    <td data-title='Key Farmer'>
                                                        <input class='input_remove_border' type='text'
                                                               value='<?php echo $vf['display_name'] ?> ' readonly/>
                                                        <input type='hidden' name='farmers[]'
                                                               value='<?php echo $vf['customer_id'] ?>'/>
                                                    </td>
                                                    <td data-title='Mobile No.'>
                                                        <input type='text' class='input_remove_border'
                                                               name='farmer_num[]'
                                                               value='<?php echo $vf['mobile_no'] ?>' readonly/>
                                                    </td>
                                                    <td data-title='Action' class='numeric'>
                                                        <div class='delete_i farmer_detail' attr-dele=''><a href='#'><i
                                                                    class='fa fa-trash-o' aria-hidden='true'></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php } ?>

                    <?php if (isset($activity_planning['key_retailer']) && !empty($activity_planning['key_retailer'])) { ?>
                        <div class="default_box_white">
                            <div class="col-md-12 plng_title"><h5>Key Retailer Details</h5></div>
                            <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                            <label>Key Retailer</label>
                                            <select class="selectpicker" name="farmer_id" id="farmer_id"
                                                    data-live-search="true">
                                                <option value="">Select Farmer</option>
                                                <?php
                                                foreach ($key_retailer as $K => $vkr) {
                                                    ?>
                                                    <option value="<?php echo $vkr['id']; ?>"
                                                            attr-name="<?php echo $vkr['display_name']; ?>"><?php echo $vkf['display_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 corp_text mrg_top_30">
                                        <div class="form-group frm_details text-center">
                                            <label>Mobile No.</label>
                                            <input type="text" class="form-control" name="farmer_no" id="farmer_no"
                                                   placeholder="">

                                            <div class="plus_btn"><a href="javascript: void(0);" id="add_retailer"><i
                                                        class="fa fa-plus" aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-md-offset-2">
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                        <tr>
                                            <th style="padding: 4px 0;">Key Retailer<span class="rts_bordet"></span></th>
                                            <th style="padding: 4px 0;">Mobile No.<span class="rts_bordet"></th>
                                            <th style="padding: 4px 0;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="farmer_detail" class="tbl_body_row">
                                        <?php if (isset($activity_planning['key_retailer']) && !empty($activity_planning['key_farmer'])) {
                                            foreach ($activity_planning['key_retailer'] as $kf => $vf) {
                                                ?>
                                                <tr>
                                                    <td data-title='Key Retailer'>
                                                        <input class='input_remove_border' type='text'
                                                               value='<?php echo $vf['display_name'] ?> ' readonly/>
                                                        <input type='hidden' name='farmers[]'
                                                               value='<?php echo $vf['customer_id'] ?>'/>
                                                    </td>
                                                    <td data-title='Mobile No.'>
                                                        <input type='text' class='input_remove_border'
                                                               name='farmer_num[]'
                                                               value='<?php echo $vf['mobile_no'] ?>' readonly/>
                                                    </td>
                                                    <td data-title='Action' class='numeric'>
                                                        <div class='delete_i farmer_detail' attr-dele=''><a href='#'><i
                                                                    class='fa fa-trash-o' aria-hidden='true'></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php } ?>


                    <!--att_count  Detail-->
                    <?php if (isset($activity_planning['proposed_attandence_count']) && !empty($activity_planning['proposed_attandence_count'])) {
                        ?>
                        <div class="default_box_grey">
                            <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label>Enter Praposed Attandances Count</label>&nbsp;
                                    <input type="text" class="form-control" name="attandence_count"
                                           id="attandence_count"
                                           value="<?php echo $activity_planning['proposed_attandence_count'] ?>"
                                           placeholder="" style="width: 80px;">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php
                    }
                    ?>


                    <!--att_count  Detail-->

                        <div class="default_box_white">
                            <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                            <label>Digital Library</label>
                                            <select class="selectpicker" name="digital_id[]" id="digital_id"
                                                    data-live-search="true" multiple title="Select Digital Library">
                                                <?php
                                                if (isset($digitalLibrary) && !empty($digitalLibrary)) {
                                                    $activity_digital_library = array();
                                                    foreach ($activity_planning['digital_library'] as $ak => $adl) {
                                                        $activity_digital_library[] = $adl['digital_library_id'];
                                                    }

                                                    foreach ($digitalLibrary as $k => $dL) {
                                                        ?>
                                                        <option <?php if (in_array($dL['digital_library_id'], $activity_digital_library)) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $dL['digital_library_id'] ?>">
                                                            <?php echo $dL['library_name'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                    <div class="default_box_white">
                        <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                        <label>Joint Visit</label>
                                        <select class="selectpicker" name="joint_id[]" id="joint_id"
                                                data-live-search="true" multiple title="Select Joint Visit">
                                            <?php
                                            if (isset($employee_visit) && !empty($employee_visit)) {
                                                $activity_visit_data = array();
                                                foreach ($activity_planning['join_visit'] as $ak => $av) {
                                                    $activity_visit_data[] = $av['employee_id'];
                                                }
                                                foreach ($employee_visit as $key => $val) {
                                                    ?>
                                                    <option <?php if (in_array($val['id'], $activity_visit_data)) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $val['id']; ?>"
                                                         attr-name="<?php echo $val['display_name']; ?>"><?php echo $val['display_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                    <div class="default_box_white">
                        <div class="col-md-12 plng_title"><h5>Discussion Point</h5></div>
                        <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                        <label>Point Of Discussion</label>
                                        <input type="text" class="form-control" name="pod"
                                               value="<?php echo(isset($activity_planning['point_discussion']) ? $activity_planning['point_discussion'] : ''); ?>"
                                               id="pod" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 corp_text mrg_top_30">
                                    <div class="form-group frm_details text-center">
                                        <label>Set Alert </label>
                                        <textarea class="form-control" rows="3"
                                                  name="set_alert"><?php echo(isset($activity_planning['alert']) ? $activity_planning['alert'] : ''); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                    <div class="default_box_white">
                        <div class="col-md-12 plng_title"><h5>Products Sample</h5></div>
                        <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                        <label>Products</label>
                                        <select class="selectpicker" name="product_sample_id" id="product_sample_id"
                                                data-live-search="true">
                                            <option value="">Select Product</option>
                                            <?php
                                            if (isset($product_sku) && !empty($product_sku)) {
                                                foreach ($product_sku as $key => $val) {
                                                    ?>
                                                    <option value="<?php echo $val['product_sku_country_id']; ?>"
                                                            attr-name="<?php echo $val['product_sku_name']; ?>"><?php echo $val['product_sku_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 corp_text mrg_top_30">
                                    <div class="form-group frm_details text-center">
                                        <label>Qty.</label>
                                        <input type="text" class="form-control allownumericwithdecimal" name="qty" id="qty" placeholder="">

                                        <div class="plus_btn"><a href="javascript: void(0);" id="add_product"><i
                                                    class="fa fa-plus" aria-hidden="true"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            <div id="no-more-tables">
                                <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                    <thead class="cf">
                                    <tr>
                                        <th style="padding: 4px 0;">
                                            Products Sample
                                            <span class="rts_bordet"></span>
                                        </th>
                                        <th style="padding: 4px 0;">Qty.<span class="rts_bordet"></span></th>
                                        <th style="padding: 4px 0;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="product_detail" class="tbl_body_row">
                                    <?php
                                    if (isset($activity_planning['products_sample']) && !empty($activity_planning['products_sample'])) {
                                        foreach ($activity_planning['products_sample'] as $k => $v) {
                                            ?>
                                            <tr>
                                                <td data-title='Products'>
                                                    <input class='input_remove_border' type='text'
                                                           value='<?php echo $v['product_sku_name'] ?>' readonly/>
                                                    <input type='hidden' name='product_samples[]'
                                                           value='<?php echo $v['product_sku_id'] ?>'/>
                                                </td>

                                                <td data-title='Qty.'>
                                                    <input type='text'
                                                           class='input_remove_border allownumericwithdecimal'
                                                           name='product_samples_qty[]'
                                                           value='<?php echo $v['quantity'] ?>' readonly/>
                                                </td>
                                                <td data-title='Action' class='numeric'>
                                                    <div class='delete_i product_detail' attr-dele=''><a href='#'><i
                                                                class='fa fa-trash-o' aria-hidden='true'></i></a></div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                    </tbody>

                                </table>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="material_request">
                        <h6>Material Request</h6>

                        <div class="material_request_inn">
                            <table class="request_table tp_form">
                                <thead>
                                <tr>
                                    <th>
                                        <h6>Product</h6>

                                        <div class="form-group">
                                            <label>Products</label>
                                            <select class="selectpicker" name="product_material_id"
                                                    id="product_material_id" data-live-search="true">
                                                <option value="">Select Product</option>
                                                <?php
                                                if (isset($product_sku) && !empty($product_sku)) {
                                                    foreach ($product_sku as $key => $val) {
                                                        ?>
                                                        <option value="<?php echo $val['product_sku_country_id']; ?>"
                                                                attr-name="<?php echo $val['product_sku_name']; ?>"><?php echo $val['product_sku_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group corp_text text-center">
                                            <label>Qty.</label>
                                            <input type="text" class="form-control allownumericwithdecimal" name="qty_material"
                                                   id="qty_material" placeholder="" style="width: 80px;">

                                            <div class="plus_btn" style="margin-top: -3px;"><a
                                                    href="javascript: void(0);" id="add_product_material"><i
                                                        class="fa fa-plus" aria-hidden="true"></i></a></div>
                                        </div>
                                    </th>
                                    <th>
                                        <h6>Promo Materials</h6>

                                        <div class="form-group">
                                            <label>Materials</label>
                                            <select class="selectpicker" name="material_id" id="material_id"
                                                    data-live-search="true">
                                                <option value="">Select Materials</option>
                                                <?php
                                                if (isset($materials) && !empty($materials)) {
                                                    foreach ($materials as $key => $val) {
                                                        ?>
                                                        <option value="<?php echo $val['promotional_country_id']; ?>"
                                                                attr-name="<?php echo $val['promotional_material_country_name']; ?>"><?php echo $val['promotional_material_country_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group corp_text text-center">
                                            <label>Qty.</label>
                                            <input type="text" class="form-control allownumericwithdecimal" name="m_qty" id="m_qty"
                                                   placeholder="" style="width: 80px;">

                                            <div class="plus_btn" style="margin-top: -3px;"><a
                                                    href="javascript: void(0);" id="add_material"><i class="fa fa-plus"
                                                                                                     aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="col-md-10 col-md-offset-1">
                                            <div id="no-more-tables">
                                                <table
                                                    class="col-md-12 table-bordered table-striped table-condensed cf">
                                                    <thead class="cf">
                                                    <tr>
                                                        <th style="padding: 4px 0;">
                                                            Products
                                                            <span class="rts_bordet"></span>
                                                        </th>
                                                        <th style="padding: 4px 0;">Qty.<span class="rts_bordet"></span>
                                                        </th>
                                                        <th style="padding: 4px 0;">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="product_material_detail" class="tbl_body_row">
                                                    <?php
                                                    if (isset($activity_planning['products_request']) && !empty($activity_planning['products_request'])) {
                                                        foreach ($activity_planning['products_request'] as $k => $vpr) {
                                                            ?>
                                                            <tr>
                                                                <td data-title='Products'>
                                                                    <input class='input_remove_border' type='text'
                                                                           value='<?php echo $vpr['product_sku_name'] ?>'
                                                                           readonly/>
                                                                    <input type='hidden' name='product_materials[]'
                                                                           value='<?php echo $vpr['product_sku_id'] ?>'/>
                                                                </td>
                                                                <td data-title='Qty.'>
                                                                    <input type='text'
                                                                           class='input_remove_border allownumericwithdecimal'
                                                                           name='product_materials_qty[]'
                                                                           value='<?php echo $vpr['quantity'] ?>'
                                                                           readonly/>
                                                                </td>
                                                                <td data-title='Action' class='numeric'>
                                                                    <div class='delete_i product_material_detail'
                                                                         attr-dele=''><a href='#'><i
                                                                                class='fa fa-trash-o'
                                                                                aria-hidden='true'></i></a></div>
                                                                </td>
                                                            </tr>
                                                            <?php

                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-10 col-md-offset-1">
                                            <div id="no-more-tables">
                                                <table
                                                    class="col-md-12 table-bordered table-striped table-condensed cf">
                                                    <thead class="cf">
                                                    <tr>
                                                        <th style="padding: 4px 0;">
                                                            Materials
                                                            <span class="rts_bordet"></span>
                                                        </th>
                                                        <th style="padding: 4px 0;">Qty.<span class="rts_bordet"></span>
                                                        </th>
                                                        <th style="padding: 4px 0;">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="material_detail" class="tbl_body_row">
                                                    <?php
                                                    if (isset($activity_planning['material_request']) && !empty($activity_planning['products_request'])) {
                                                        foreach ($activity_planning['material_request'] as $k => $vmr) {
                                                            ?>
                                                            <tr>
                                                                <td data-title='Materials'>
                                                                    <input class='input_remove_border' type='text'
                                                                           value='<?php echo $vmr['promotional_material_country_name']; ?>'
                                                                           readonly/>
                                                                    <input type='hidden' name='materials[]'
                                                                           value='<?php echo $vmr['material_id']; ?>'/>
                                                                </td>
                                                                <td data-title='Qty.'>
                                                                    <input type='text' class='input_remove_border'
                                                                           name='materials_qty[]'
                                                                           value='<?php echo $vmr['quantity']; ?>'
                                                                           readonly/>
                                                                </td>
                                                                <td data-title='Action' class='numeric'>
                                                                    <div class='delete_i material_detail' attr-dele=''>
                                                                        <a href='#'><i class='fa fa-trash-o'
                                                                                       aria-hidden='true'></i></a></div>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input class="activity_planning_id" type="hidden" name="inserted_activity_planning_id" id="activity_planning_id"
               value="<?php echo $activity_planning['activity_planning_id']; ?>"/>
        <input class="current_user_id" type="hidden" name="current_user_id" id="current_user_id"
               value="<?php echo $current_user->id; ?>"/>
        <input class="current_role_id" type="hidden" name="current_role_id" id="current_role_id"
               value="<?php echo $current_user->role_id; ?>"/>
        <input class="current_country_id" type="hidden" name="current_country_id" id="current_country_id"
               value="<?php echo $current_user->country_id; ?>"/>
        <input class="current_local_date" type="hidden" name="current_local_date" id="current_local_date"
               value="<?php echo $current_user->local_date; ?>"/>
        <input class="status" type="hidden" name="status" id="status" value="<?php echo $activity_planning['status'];?>" />
        <input class="submit_status" type="hidden" name="submit_status" id="submit_status" value="<?php echo $activity_planning['submit_status'];?>" />


        <div class="col-md-12 table_bottom pln_table_bottom">
            <div class="row">
                <div class="save_btn">
                    <button type="button" class="btn btn-primary" name='update_planning' id="check_update">Update
                    </button>
                    <button type="button" class="btn btn-primary" id="check_cancel">Cancel</button>
                    <button type="button" class="btn btn-primary" id="check_submit">Submit</button>
                    <button type="button" class="btn btn-primary" id="check_save_as_new">Save As New</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
<?php }?>
