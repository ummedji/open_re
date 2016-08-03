<?php

if (isset($activity_view) && !empty($activity_view)) { ?>
<div class="col-md-9">
    <div class="top_form planning_parent">
        <div class="row">
            <div class="col-md-12">
                <?php if((isset($activity_view['activity_planning_date']) && !empty($activity_view['activity_planning_date'])) || (isset($activity_view['activity_planning_time']) && !empty($activity_view['activity_planning_time']))){ ?>
                    <div class="default_box_white">
                        <div class="col-md-12 text-center tp_form inline-parent">

                            <div class="form-group">
                                <label>Planning Date<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="planning_date" id="planning_date" value="<?php echo
                                (!empty($activity_view['activity_planning_date']) ? $activity_view['activity_planning_date'] : ''); ?>" placeholder="">
                            </div>
                            <?php
                            if(isset($activity_view['activity_planning_time']) && !empty($activity_view['activity_planning_time'])){
                                $time = explode(' ', $activity_view['activity_planning_time']);
                                $plan_time = date('h:i A', strtotime($time[1]));
                            }
                            ?>
                            <div class="form-group">
                                <label>Planning Time<span style="color: red">*</span></label>
                                <div class="inln_fld">
                                    <div class="bootstrap-timepicker bootstrap-timepicker-as">
                                        <input id="planning_time" name="planning_time" type="text" value="<?php echo
                                        (!empty($plan_time) ? $plan_time : ''); ?>" class="input-group-time form-control input-append">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
               <?php } ?>

                <?php if((isset($activity_view['execution_date']) && !empty($activity_view['execution_date'])) && (isset($activity_view['execution_time']) && !empty($activity_view['execution_time']))){ ?>
                    <div class="default_box_white">
                        <div class="col-md-12 text-center tp_form inline-parent">
                            <div class="form-group">
                                <label>Execution Date<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="planning_date" id="planning_date" value="<?php echo
                                (!empty($activity_view['execution_date']) ? $activity_view['execution_date'] : ''); ?>" placeholder="">
                            </div>
                            <?php
                            if(isset($activity_view['execution_time']) && !empty($activity_view['execution_time'])){
                                $time = explode(' ', $activity_view['execution_time']);
                                $plan_time = date('h:i A', strtotime($time[1]));
                            }
                            ?>
                            <div class="form-group">
                                <label>Execution Time<span style="color: red">*</span></label>
                                <div class="inln_fld">
                                    <div class="bootstrap-timepicker bootstrap-timepicker-as">
                                        <input id="planning_time" name="planning_time" type="text" value="<?php echo
                                        (!empty($plan_time) ? $plan_time : ''); ?>" class="input-group-time form-control input-append">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Duration of Meeting<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="meeting_duration"  value="<?php echo (!empty($activity_view['meeting_duration']) ? $activity_view['meeting_duration'] : '');?>" id="meeting_duration" placeholder="">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php } ?>

                <div class="default_box_white">
                    <div class="col-md-12 tp_form mr_bot_group">
                        <div class="row form-group">
                            <div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Select Activity Type<span
                                        style="color: red">*</span></label></div>
                            <?php if (isset($activity_view['activity_type_id']) && !empty($activity_view['activity_type_id'])) {
                                ?>
                                <div class="col-md-4 col-sm-8 cont_size_select mrg_bottom_30">
                                    <select class="selectpicker" id="activity_type_id" name="activity_type_id"
                                            data-live-search="true" disabled>
                                        <option value="">Select Activity Type</option>
                                        <?php
                                        if (isset($activity_type) && !empty($activity_type)) {
                                            foreach ($activity_type as $key => $val) {
                                                ?>
                                                <option <?php if ($val['activity_type_country_id'] == $activity_view["activity_type_id"]) {
                                                    echo "selected";
                                                } ?> value="<?php echo $val['activity_type_country_id']; ?>" code="<?php echo $val['activity_type_code']; ?>"><?php echo $val['activity_type_country_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="activity_type_id" id="activity_type_id" value="<?php echo $activity_view["activity_type_id"] ?>">
                                </div>
                                <?php
                            }
                            ?>
                            <!--Demonstration Dropdown-->
                            <?php  if(isset($activity_view["demo_id"]) && !empty($activity_view["demo_id"])) { ?>
                                            <div class="col-md-2 col-sm-3 first_lb"><label>Demonstration</label></div>
                                            <div class="col-md-2 col-sm-8 cont_size_select">
                                                <select class="selectpicker" name="demo_id" id="demo_id" data-live-search="true" title="Select Demonstration">
                                                </select>
                                            </div>
                                 <?php } ?>
                            <!--Demonstration Dropdown-->
                        </div>


                        <!--GEO  Dropdown-->
                        <div class="row form-group" id="geo">

                            <?php
                            if (isset($activity_view['geo_level_id_2']) && !empty($activity_view['geo_level_id_2'])) { ?>
                                <div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Geo2<span style="color: red">*</span></label></div>
                                <div class="col-md-2 col-sm-8 cont_size_select mrg_bottom_30">
                                    <select class="selectpicker" data-live-search="true" name="geo_level_2" id="geo_level_2" disabled >
                                        <option value="">Select Geo 2</option>
                                        <?php
                                        if (isset($geo_level_2) && !empty($geo_level_2)) {

                                            foreach ($geo_level_2 as $k => $val_g2) {
                                                ?>
                                                <option <?php if ($val_g2['political_geo_id'] == $activity_view["geo_level_id_2"]) { echo "selected"; } ?> value="<?php echo $val_g2['political_geo_id'] ?>"><?php echo $val_g2['political_geography_name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                    <input type="hidden" name="geo_level_2" id="geo_level_2" value="<?php echo $activity_view["geo_level_id_2"] ?>">
                                </div>
                                <?php
                            }
                            ?>
                            <?php if (isset($activity_view['geo_level_id_3']) && !empty($activity_view['geo_level_id_3'])) {
                                ?>
                                <div class="col-md-1 col-sm-3 first_lb"><label>Geo3<span style="color: red">*</span></label>
                                </div>
                                <div class="col-md-2 col-sm-8 cont_size_select">
                                    <select class="selectpicker" data-live-search="true" name="geo_level_3"
                                            id="geo_level_3" disabled>
                                        <option value="">Select Geo 3</option>
                                        <?php
                                        if (isset($geo_level_3) && !empty($geo_level_3)) {

                                            foreach ($geo_level_3 as $k => $val_g3) {
                                                ?>
                                                <option <?php if ($val_g3['political_geo_id'] == $activity_view["geo_level_id_3"]) { echo "selected"; } ?> value="<?php echo $val_g3['political_geo_id'] ?>"><?php echo $val_g3['political_geography_name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="geo_level_3" id="geo_level_3" value="<?php echo $activity_view["geo_level_id_3"]; ?>">
                                </div>

                                <?php
                            }
                            ?>

                            <?php if (isset($activity_view['geo_level_id_4']) && !empty($activity_view['geo_level_id_4'])) {
                                ?>
                                <div class="col-md-1 col-sm-3 first_lb"><label>Geo4<span style="color: red">*</span></label>
                                </div>
                                <div class="col-md-2 col-sm-8 cont_size_select">
                                    <select class="selectpicker" data-live-search="true" name="geo_level_4"
                                            id="geo_level_4" disabled>
                                        <option value="">Select Geo 4</option>
                                        <?php
                                        if (isset($geo_level_4) && !empty($geo_level_4)) {

                                            foreach ($geo_level_4 as $k => $val_g4) {
                                                ?>
                                                <option <?php if ($val_g4['political_geo_id'] == $activity_view["geo_level_id_4"]) { echo "selected"; } ?>
                                                    value="<?php echo $val_g4['political_geo_id'] ?>">
                                                    <?php echo $val_g4['political_geography_name'] ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="geo_level_4" id="geo_level_4" value="<?php echo $activity_view["geo_level_id_4"]; ?>">
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                        <!--GEO  Dropdown-->
                        <?php if (isset($activity_view['location']) && !empty($activity_view['location'])) {
                            ?>
                            <div class="row form-group">
                                <div class="col-md-3 col-sm-3 first_lb"><label>Address<span
                                            style="color: red">*</span></label></div>
                                <div class="col-md-8 col-sm-8">
                                    <textarea class="form-control" rows="4" name="activity_address" id="activity_address" readonly><?php echo $activity_view['location'] ?></textarea>
                                </div>

                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <!--Demonstration  Detail-->
                <?php if ($activity_view['activity_type_code'] == 'DP005' || $activity_view['activity_type_code'] == 'FDP006') {
                    if ((isset($activity_view['size_of_plot']) && !empty($activity_view['size_of_plot'])) || (isset($activity_view['spray_volume']) && !empty($activity_view['spray_volume']))) {
                        ?>
                        <div class="default_box_white">
                            <div class="col-md-12 plng_title"><h5>Demonstration</h5></div>
                            <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                            <label>Size Of Plot</label>
                                            <input type="text" class="form-control" name="size_of_plot" id="size_of_plot" value="<?php echo(!isset($activity_view['size_of_plot']) ? $activity_view['size_of_plot'] : 0) ?>" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 corp_text mrg_top_30">
                                        <div class="form-group frm_details text-center">
                                            <label>Spray Volume</label>
                                            <input type="text" class="form-control" name="spray_volume"
                                                   id="spray_volume"
                                                   value="<?php echo(!isset($activity_view['spray_volume']) ? $activity_view['spray_volume'] : 0) ?>"
                                                   placeholder="" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php
                    }
                } ?>


                <!--Demonstration  Detail-->

                <div class="default_box_grey">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5 tp_form inline-parent corp_text corp_text_align">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <label>Corp<span style="color: red">*</span></label>
                                    <select class="selectpicker" name="crop[]" id="crop" data-live-search="true" multiple disabled >
                                        <option value="">Select Corp</option>
                                        <?php
                                        if (isset($crop_details) && !empty($crop_details)) {
                                            $activity_crop_details = array();
                                            foreach ($activity_view['crop'] as $ak => $adl) {
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
                                    <input type="hidden" name="crop[]" id="crop" value="<?php echo '"'.json_encode($activity_view['crop']).'"'; ?>>
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
                                                <select class="selectpicker" name="product_sku[]" id="product_sku" data-live-search="true" multiple disabled>
                                                    <option value="">Select Product</option>
                                                    <?php
                                                    if (isset($product_sku) && !empty($product_sku)) {
                                                        $activity_product_sku = array();
                                                        foreach ($activity_view['products'] as $ak => $adl) {
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
                                                <input type="hidden" name="product_sku[]" id="product_sku" value="<?php echo json_encode($activity_view['products']); ?>">

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
                                                <select class="selectpicker" name="diseases[]" id="diseases" data-live-search="true" multiple disabled>
                                                    <option value="">Select Diseases</option>

                                                    <?php
                                                    if (isset($diseases_details) && !empty($diseases_details)) {
                                                        $activity_diseases_details = array();
                                                        foreach ($activity_view['diseases'] as $ak => $add) {
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
                                                <input type="hidden" name="diseases[]" id="diseases" value="<?php echo json_encode($activity_view['diseases']); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <?php if (isset($activity_view['key_farmer']) && !empty($activity_view['key_farmer'])) { ?>
                                <div class="default_box_white">
                                    <div class="col-md-12 plng_title"><h5>Key Farmer Details</h5></div>
                                    <div class="col-md-8 col-md-offset-2">
                                        <div id="no-more-tables">
                                            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                                <thead class="cf">
                                                <tr>
                                                    <th style="padding: 4px 0;">Key Farmer<span class="rts_bordet"></span></th>
                                                    <th style="padding: 4px 0;">Mobile No.<span class="rts_bordet"></th>
                                                </tr>
                                                </thead>
                                                <tbody id="farmer_detail" class="tbl_body_row">
                                                <?php if (isset($activity_view['key_farmer']) && !empty($activity_view['key_farmer'])) {
                                                    foreach ($activity_view['key_farmer'] as $kf => $vf) {
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


                            <?php if (isset($activity_view['key_retailer']) && !empty($activity_view['key_retailer'])) { ?>
                                <div class="default_box_white">
                                    <div class="col-md-12 plng_title"><h5>Key Retailer Details</h5></div>
                                    <div class="col-md-8 col-md-offset-2">
                                        <div id="no-more-tables">
                                            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                                <thead class="cf">
                                                <tr>
                                                    <th style="padding: 4px 0;">Key Retailer<span class="rts_bordet"></span></th>
                                                    <th style="padding: 4px 0;">Mobile No.<span class="rts_bordet"></th>
                                                </tr>
                                                </thead>
                                                <tbody id="farmer_detail" class="tbl_body_row">
                                                <?php if (isset($activity_view['key_retailer']) && !empty($activity_view['key_farmer'])) {
                                                    foreach ($activity_view['key_retailer'] as $kf => $vf) {
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

                            <?php if (isset($activity_view['proposed_attandence_count']) && !empty($activity_view['proposed_attandence_count'])) {
                                ?>
                                <div class="default_box_grey">
                                    <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <label>Enter Praposed Attandances Count</label>&nbsp;
                                            <input type="text" class="form-control" name="attandence_count"
                                                   id="attandence_count"
                                                   value="<?php echo $activity_view['proposed_attandence_count'] ?>"
                                                   placeholder="" style="width: 80px;" readonly>
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
                                                        data-live-search="true" multiple disabled>
                                                    <?php
                                                    if (isset($digitalLibrary) && !empty($digitalLibrary)) {
                                                        $activity_digital_library = array();
                                                        foreach ($activity_view['digital_library'] as $ak => $adl) {
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
                                                <input type="hidden" name="digital_id[]" id="digital_id" value="<?php echo json_encode($activity_view['digital_library']); ?>">
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
                                                        data-live-search="true" multiple disabled>
                                                    <?php
                                                    if (isset($employee_visit) && !empty($employee_visit)) {
                                                        $activity_visit_data = array();
                                                        foreach ($activity_view['join_visit'] as $ak => $av) {
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
                                                <input type="hidden" name="joint_id[]" id="joint_id" value="<?php echo json_encode($activity_view['join_visit']); ?>">
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
                                                       value="<?php echo(!empty($activity_view['point_discussion']) ? $activity_view['point_discussion'] : ''); ?>"
                                                       id="pod" placeholder="" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 corp_text mrg_top_30">
                                            <div class="form-group frm_details text-center">
                                                <label>Set Alert </label>
                                        <textarea class="form-control" rows="3"
                                                  name="set_alert" readonly><?php echo(!empty($activity_view['alert']) ? $activity_view['alert'] : ''); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>


                            <div class="default_box_white">
                                <div class="col-md-12 plng_title"><h5>Products Sample</h5></div>
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
                                            </tr>
                                            </thead>
                                            <tbody id="product_detail" class="tbl_body_row">
                                            <?php
                                            if (isset($activity_view['products_sample']) && !empty($activity_view['products_sample'])) {
                                                foreach ($activity_view['products_sample'] as $k => $v) {
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
                                                            </tr>
                                                            </thead>
                                                            <tbody id="product_material_detail" class="tbl_body_row">
                                                            <?php
                                                            if (isset($activity_view['products_request']) && !empty($activity_view['products_request'])) {
                                                                foreach ($activity_view['products_request'] as $k => $vpr) {
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
                                                            </tr>
                                                            </thead>
                                                            <tbody id="material_detail" class="tbl_body_row">
                                                            <?php
                                                            if (isset($activity_view['material_request']) && !empty($activity_view['products_request'])) {
                                                                foreach ($activity_view['material_request'] as $k => $vmr) {
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

                            <div class="default_box_white">
                                <div class="col-md-12 plng_title"><h5>Customer</h5></div>
                                <div class="col-md-8 col-md-offset-2">
                                    <div id="no-more-tables">
                                        <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                            <thead class="cf">
                                            <tr>
                                                <th style="padding: 4px 0;">
                                                    Customer Name
                                                    <span class="rts_bordet"></span>
                                                </th>
                                                <th style="padding: 4px 0;">Mobile No.<span class="rts_bordet"></th>
                                            </tr>
                                            </thead>
                                            <tbody id="customer_detail" class="tbl_body_row">
                                            <?php if (isset($activity_view['customer']) && !empty($activity_view['customer'])) {
                                                                foreach ($activity_view['customer'] as $k => $vmr) {
                                                                    ?>
                                                                    <tr>
                                                                        <td data-title='Customer Name'>
                                                                            <input class='input_remove_border' type='text'
                                                                                   value='<?php echo $vmr['customer_name']; ?>'
                                                                                   readonly/>
                                                                        </td>
                                                                        <td data-title='Mobile No.'>
                                                                            <input type='text' class='input_remove_border'
                                                                                   name='customer[]'
                                                                                   value='<?php echo $vmr['mobile_no']; ?>'
                                                                                   readonly/>
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

                           <!-- <div class="default_box_white">
                                <div class="col-md-12 tp_form inline-parent">
                                    <div class="row">
                                        <div class="col-md-12 new-upld-par">
                                            <div class="plng_title"><h5>Upload Photo/Video</h5></div>
                                            <div class="upload_file_space">
                                                <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <span class="btn btn-primary btn-file fileUpload">
                                                               Browse <input class="upload" type="file" name="upload_file_data" id="upload_file_data" multiple="multiple">
                                                            </span>
                                                       </span>
                                                    <input type="text" id="filename" class="form-control">
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>-->

                            <?php if((isset($activity_view['amount']) && !empty($activity_view['amount'])) || (isset($activity_view['rating']) && !empty($activity_view['rating']))) { ?>

                                <div class="default_box_white">
                                    <div class="col-md-12 plng_title"><h5>Actual Expense</h5></div>
                                    <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                                    <label>Amount</label>
                                                    <input type="text" class="form-control" name="amount" id="amount" value="<?php echo (!empty($activity_view['amount']) ? $activity_view['amount'] : '0')?>" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 corp_text mrg_top_30">
                                                <div class="form-group frm_details text-center">
                                                    <label>Rate Activity</label>
                                                    <div id="activity_rate"></div>
                                                    <input type="hidden" class="form-control" name="rating" id="rating" value="<?php echo (!empty($activity_view['rating']) ? $activity_view['rating'] : '0')?>" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            <?php } ?>


                            <?php if((isset($activity_view['activity_note']) && !empty($activity_view['activity_note']))) { ?>
                            <div class="default_box_white">
                                <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                                <label>Activity Notes</label>
                                                <textarea class="form-control" rows="3" cols="80" name="activity_note"><?php echo $activity_view['amount'];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <input class="activity_planning_id" type="hidden" name="inserted_activity_planning_id" id="activity_planning_id"
                       value="<?php echo $activity_view['activity_planning_id']; ?>"/>
                <input class="current_user_id" type="hidden" name="current_user_id" id="current_user_id"
                       value="<?php echo $current_user->id; ?>"/>
                <input class="current_role_id" type="hidden" name="current_role_id" id="current_role_id"
                       value="<?php echo $current_user->role_id; ?>"/>
                <input class="current_country_id" type="hidden" name="current_country_id" id="current_country_id"
                       value="<?php echo $current_user->country_id; ?>"/>
                <input class="current_local_date" type="hidden" name="current_local_date" id="current_local_date"
                       value="<?php echo $current_user->local_date; ?>"/>
                <input class="status" type="hidden" name="status" id="status" value="<?php echo $activity_view['status'];?>" />
                <input class="submit_status" type="hidden" name="submit_status" id="submit_status" value="<?php echo $activity_view['submit_status'];?>" />


                <div class="col-md-12 table_bottom pln_table_bottom">
                    <div class="row">
                        <div class="save_btn">
                            <button type="button" class="btn btn-primary" id="check_save">Save</button>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php }?>
