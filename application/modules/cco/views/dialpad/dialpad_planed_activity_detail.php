<?php // testdata($activity_details) ; ?>
<div class="actv-details-form">
    <div class="col-md-12 text-center plng_sub_nave_cco">
        <div class="inn_sub_nave">
            <ul>
                <li class="active"><a data-toggle="tab" href="#home">Activity Entry</a></li>
                <li class=""><a data-toggle="tab" href="#menu1">During Entry</a></li>
                <li class=""><a data-toggle="tab" href="#menu2">Promo Material & Samples</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="tab-content dialpad-plnd-content">
        <div id="home" class="tab-pane fade in active">
            <div class="default_box_white">
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <?php if(isset($current_user->local_date) && !empty($current_user->local_date)){
                            $date = strtotime($activity_details['activity_planning_date']);
                            $planning_date = date($current_user->local_date,$date);
                        }
                        else{
                            $planning_date = $activity_details['activity_planning_date'];
                        }
                        ?>

                        <label>Select Date<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="planning_date" id="planning_date"
                               value="<?php echo $planning_date ?>"
                               placeholder="" readonly>
                    </div>
                    <?php

                    $time = explode(' ', $activity_details['activity_planning_time']);
                    $plan_time = date('h:i A', strtotime($time[1]));

                    ?>

                    <div class="form-group">
                        <label>Time<span style="color: red">*</span></label>
                        <!--<input  type="text" class="form-control input-append" data-format="hh:mm" id="timepicker1"  />-->
                        <div class="bootstrap-timepicker bootstrap-timepicker-as">
                            <input id="planning_time" name="planning_time" type="text"
                                   value="<?php echo $plan_time; ?>"
                                   class="input-group-time form-control input-append" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="default_box_white">
                    <div class="col-md-12 tp_form mr_bot_group">
                        <div class="row form-group">
                            <div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Select Activity Type<span
                                        style="color: red">*</span></label></div>
                            <?php if (isset($activity_details['activity_type_id']) && !empty($activity_details['activity_type_id'])) {
                                ?>
                                <div class="col-md-4 col-sm-8 cont_size_select mrg_bottom_30">

                                    <input type="text" class="form-control" name="activity_type_id" id="activity_type_id" value="<?php echo $activity_details['activity_type_country_name'] ?>" readonly>
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

                            <!--GEO  Dropdown-->
                            <div class="row form-group" id="geo">

                                <?php
                                if (isset($activity_details['geo_level_id_2']) && !empty($activity_details['geo_level_id_2'])) {
                                    ?>
                                    <div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Geo2<span style="color: red">*</span></label></div>
                                    <div class="col-md-2 col-sm-8 cont_size_select mrg_bottom_30">
                                        <input type="text" class="form-control"  name="geo_level_2" id="geo_level_2" value="<?php echo $activity_details['geo_level_name_2'] ?>" readonly>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php if (isset($activity_details['geo_level_id_3']) && !empty($activity_details['geo_level_id_3'])) {
                                    ?>
                                    <div class="col-md-1 col-sm-3 first_lb"><label>Geo3<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-2 col-sm-8 cont_size_select">
                                        <input type="text" class="form-control"  name="geo_level_3" id="geo_level_3" value="<?php echo $activity_details['geo_level_name_3'] ?>" readonly>
                                    </div>
                                    <?php
                                }
                                ?>

                                <?php if (isset($activity_details['geo_level_id_4']) && !empty($activity_details['geo_level_id_4'])) {
                                    ?>
                                    <div class="col-md-1 col-sm-3 first_lb"><label>Geo4<span style="color: red">*</span></label>
                                    </div>
                                    <div class="col-md-2 col-sm-8 cont_size_select">
                                        <input type="text" class="form-control" name="geo_level_4" id="geo_level_4" value="<?php echo $activity_details['geo_level_name_4'] ?>" readonly>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                            <!--GEO  Dropdown-->
                            <?php if (isset($activity_details['location']) && !empty($activity_details['location'])) {
                                ?>
                                <div class="row form-group">
                                    <div class="col-md-3 col-sm-3 first_lb"><label>Address<span
                                                style="color: red">*</span></label></div>
                                    <div class="col-md-8 col-sm-8">
                                        <textarea class="form-control" rows="4" name="activity_address"
                                                  id="activity_address"><?php echo $activity_details['location'] ?></textarea>
                                    </div>

                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
            </div>

            <!--Demonstration  Detail-->
            <?php if ($activity_details['activity_type_code'] == 'DP005' || $activity_details['activity_type_code'] == 'FDP006') { ?>
                <div class="default_box_white">
                    <div class="col-md-12 plng_title"><h5>Demonstration</h5></div>
                    <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                    <label>Size Of Plot</label>
                                    <input type="text" class="form-control" name="size_of_plot"
                                           id="size_of_plot"
                                           value="<?php echo(isset($activity_details['size_of_plot']) && !empty($activity_details['size_of_plot'])) ? $activity_details['size_of_plot'] : 0  ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6 corp_text mrg_top_30">
                                <div class="form-group frm_details text-center">
                                    <label>Spray Volume</label>
                                    <input type="text" class="form-control" name="spray_volume" id="spray_volume" value="<?php echo(isset($activity_details['spray_volume']) && !empty($activity_details['spray_volume'])) ? $activity_details['spray_volume'] : 0 ?>" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php } ?>


            <!--Demonstration  Detail-->

            <div class="clearfix"></div>
        </div>
        <div id="menu1" class="tab-pane fade">

            <div class="default_box_grey">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5 tp_form inline-parent corp_text corp_text_align">
                            <div class="form-group" style="margin-bottom: 0px;">
                                <label>Corp<span style="color: red">*</span></label>
                                <select name="crop[]" id="crop" data-live-search="true" multiple title="Select Corp" disabled>
                                    <?php
                                    if (isset($crop_details) && !empty($crop_details)) {
                                        $activity_crop_details = array();
                                        foreach ($activity_details['crop'] as $ak => $adl) {
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
                                <select  name="product_sku[]" id="product_sku" data-live-search="true" multiple title="Select Product" disabled>
                                    <?php
                                    if (isset($product_sku) && !empty($product_sku)) {
                                        $activity_product_sku = array();
                                        foreach ($activity_details['products'] as $ak => $adl) {
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
                                <select name="diseases[]" id="diseases" data-live-search="true" multiple title="Select Diseases" disabled>
                                    <?php
                                    if (isset($diseases_details) && !empty($diseases_details)) {
                                        $activity_diseases_details = array();
                                        foreach ($activity_details['diseases'] as $ak => $add) {
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


            <?php if (isset($activity_details['key_farmer']) && !empty($activity_details['key_farmer'])) { ?>
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
                                <?php if (isset($activity_details['key_farmer']) && !empty($activity_details['key_farmer'])) {
                                    foreach ($activity_details['key_farmer'] as $kf => $vf) {
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


            <?php if (isset($activity_details['key_retailer']) && !empty($activity_details['key_retailer'])) { ?>
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
                                <?php if (isset($activity_details['key_retailer']) && !empty($activity_details['key_farmer'])) {
                                    foreach ($activity_details['key_retailer'] as $kf => $vf) {
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

            <?php if (isset($activity_details['proposed_attandence_count']) && !empty($activity_details['proposed_attandence_count'])) {
                ?>
                <div class="default_box_grey">
                    <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label>Enter Praposed Attandances Count</label>&nbsp;
                            <input type="text" class="form-control" name="attandence_count"
                                   id="attandence_count"
                                   value="<?php echo $activity_details['proposed_attandence_count'] ?>"
                                   placeholder="" style="width: 80px;" readonly>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
            }
            ?>

            <div class="default_box_white">
                <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                <label>Digital Library</label>
                                <select name="digital_id[]" id="digital_id"
                                        data-live-search="true" multiple disabled>
                                    <?php
                                    if (isset($digitalLibrary) && !empty($digitalLibrary)) {
                                        $activity_digital_library = array();
                                        foreach ($activity_details['digital_library'] as $ak => $adl) {
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
                                <input type="hidden" name="digital_id[]" id="digital_id" value="<?php echo json_encode($activity_details['digital_library']); ?>">
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
                               <!-- <select name="joint_id[]" id="joint_id"
                                        data-live-search="true" multiple disabled>
                                    <?php
/*                                    if (isset($employee_visit) && !empty($employee_visit)) {
                                        $activity_visit_data = array();
                                        foreach ($activity_details['join_visit'] as $ak => $av) {
                                            $activity_visit_data[] = $av['employee_id'];
                                        }
                                        foreach ($employee_visit as $key => $val) {
                                            */?>
                                            <option <?php /*if (in_array($val['id'], $activity_visit_data)) {
                                                echo "selected";
                                            } */?> value="<?php /*echo $val['id']; */?>"
                                                 attr-name="<?php /*echo $val['display_name']; */?>"><?php /*echo $val['display_name']; */?></option>
                                            <?php
/*                                        }
                                    }
                                    */?>
                                </select>-->
                                <?php
                                $visit_data = '';
                                if (isset($activity_details['join_visit']) && !empty($activity_details['join_visit'])) {
                                    $activity_visit_data = array();
                                    foreach ($activity_details['join_visit'] as $ak => $av) {
                                        $activity_visit_data[] = $av['display_name'];
                                    }
                                    $visit_data = implode(',',$activity_visit_data);
                                }
                                ?>
                                <textarea class="form-control" rows="4" name="activity_address" id="activity_address" readonly><?php echo $visit_data ?></textarea>

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
                                       value="<?php echo(!empty($activity_details['point_discussion']) ? $activity_details['point_discussion'] : ''); ?>"
                                       id="pod" placeholder="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 corp_text mrg_top_30">
                            <div class="form-group frm_details text-center">
                                <label>Set Alert </label>
                                        <textarea class="form-control" rows="3"
                                                  name="set_alert" readonly><?php echo(!empty($activity_details['alert']) ? $activity_details['alert'] : ''); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="clearfix"></div>
        </div>
        <div id="menu2" class="tab-pane fade">
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
                            if (isset($activity_details['products_sample']) && !empty($activity_details['products_sample'])) {
                                foreach ($activity_details['products_sample'] as $k => $v) {
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
                                            if (isset($activity_details['products_request']) && !empty($activity_view['products_request'])) {
                                                foreach ($activity_details['products_request'] as $k => $vpr) {
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
                                            if (isset($activity_details['material_request']) && !empty($activity_view['products_request'])) {
                                                foreach ($activity_details['material_request'] as $k => $vmr) {
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
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

