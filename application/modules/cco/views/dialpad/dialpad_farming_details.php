<?php
//testdata($personal_general_data);

$customer_id = (isset($customer_farming_data[0]["id"]) && !empty($customer_farming_data[0]["id"]))? $customer_farming_data[0]["id"] : "";

$customer_name = (isset($customer_farming_data[0]["display_name"]) && !empty($customer_farming_data[0]["display_name"]))? $customer_farming_data[0]["display_name"] : "";

$customer_email = (isset($customer_farming_data[0]["email"]) && !empty($customer_farming_data[0]["email"]))? $customer_farming_data[0]["email"] : "";

$level1 = (isset($customer_farming_data[0]["level1"]) && !empty($customer_farming_data[0]["level1"]))? $customer_farming_data[0]["level1"] : "";

$level2 = (isset($customer_farming_data[0]["level2"]) && !empty($customer_farming_data[0]["level2"]))? $customer_farming_data[0]["level2"] : "";

$level3 = (isset($customer_farming_data[0]["level3"]) && !empty($customer_farming_data[0]["level3"]))? $customer_farming_data[0]["level3"] : "";

$level1_id = (isset($customer_farming_data[0]["level1_id"]) && !empty($customer_farming_data[0]["level1_id"]))? $customer_farming_data[0]["level1_id"] : "";

$level2_id = (isset($customer_farming_data[0]["level2_id"]) && !empty($customer_farming_data[0]["level2_id"]))? $customer_farming_data[0]["level2_id"] : "";

$level3_id = (isset($customer_farming_data[0]["level3_id"]) && !empty($customer_farming_data[0]["level3_id"]))? $customer_farming_data[0]["level3_id"] : "";

?>



<div class="clearfix"></div>


<div class="actv-details-form">

    <h5 style=" margin-bottom: 30px;">Farming Details</h5>
    <div class="back_details">

        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_farming_info','name'=>'dialpad_farming_info', 'autocomplete'=>'off');
        echo form_open('cco/add_update_crop_farming_info',$attributes);
        ?>

        <div class="row">
            <div class="col-md-12">
                <hr><h6 class="gn-info-tl">General Info</h6>
                <div class="row cco-form-fl">

                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="House No">House No</label>

                            <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />

                            <input type="text" class="form-control" name="house_no" id="house_no" placeholder="" value="<?php // echo $customer_name; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Address">Address</label>

                            <textarea id="address"  style="height: 72px!important;" name="address"><?php //echo $customer_first_name; ?></textarea>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Landmark">Landmark</label>
                            <input type="text" class="form-control" name="landmark" id="landmark" placeholder="" value="<?php //echo $customer_last_name; ?>"/>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="row cco-form-fl">
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Level 3">Level 3</label>

                            <select class="form-control" name="geo_level_3" id="geo_level_3">

                            </select>

                          <!---  <input type="text"   placeholder="" value="<?php //echo $level3; ?>" /> -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Level 2">Level 2</label>
                           <!-- <input type="text" class="form-control" name="geo_level_2" id="geo_level_2" placeholder="" value="<?php //echo $level2; ?>" /> -->

                            <select class="form-control" name="geo_level_2" id="geo_level_2">

                            </select>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Level 1">Level 1</label>

                            <select class="form-control" name="geo_level_1" id="geo_level_1">

                            </select>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="clearfix"></div>
        <div class="col-md-12 text-right">
            <div class="row save_btn">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

        <?php form_close(); ?>

    </div>

    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<script type="text/javascript">
    var selceted_level_3 =  '<?php echo $level3_id; ?>';
    var selceted_level_2 =  '<?php echo $level2_id; ?>';
    var selceted_level_1 =  '<?php echo $level1_id; ?>';

        setTimeout(function(){
            $("select#geo_level_3").val(selceted_level_3);

            var parent_html = "";
            var parent_geo_id = selceted_level_3;
            var level_data = 2;
            var num_count = 2;

            get_row_geo_data(parent_html,parent_geo_id,level_data,num_count,true);

            var parent_html = "";
            var parent_geo_id = selceted_level_2;
            var level_data = 1;
            var num_count = 1;

            get_row_geo_data(parent_html,parent_geo_id,level_data,num_count,true);

            $("select#geo_level_2").val(selceted_level_2);
        }, 1000);

        setTimeout(function(){
            $("select#geo_level_2").val(selceted_level_2);
            $("select#geo_level_1").val(selceted_level_1);
        }, 2000);

</script>