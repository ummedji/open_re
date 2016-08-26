<?php
//testdata($personal_general_data);

$customer_id = (isset($get_customer_business_data[0]["id"]) && !empty($get_customer_business_data[0]["id"]))? $get_customer_business_data[0]["id"] : "";

$customer_name = (isset($get_customer_business_data[0]["display_name"]) && !empty($get_customer_business_data[0]["display_name"]))? $get_customer_business_data[0]["display_name"] : "";

$customer_email = (isset($get_customer_business_data[0]["email"]) && !empty($get_customer_business_data[0]["email"]))? $get_customer_business_data[0]["email"] : "";

$level1 = (isset($get_customer_business_data[0]["level1"]) && !empty($get_customer_business_data[0]["level1"]))? $get_customer_business_data[0]["level1"] : "";

$level2 = (isset($get_customer_business_data[0]["level2"]) && !empty($get_customer_business_data[0]["level2"]))? $get_customer_business_data[0]["level2"] : "";

$level3 = (isset($get_customer_business_data[0]["level3"]) && !empty($get_customer_business_data[0]["level3"]))? $get_customer_business_data[0]["level3"] : "";

$level1_id = (isset($get_customer_business_data[0]["level1_id"]) && !empty($get_customer_business_data[0]["level1_id"]))? $get_customer_business_data[0]["level1_id"] : "";

$level2_id = (isset($get_customer_business_data[0]["level2_id"]) && !empty($get_customer_business_data[0]["level2_id"]))? $get_customer_business_data[0]["level2_id"] : "";

$level3_id = (isset($get_customer_business_data[0]["level3_id"]) && !empty($get_customer_business_data[0]["level3_id"]))? $get_customer_business_data[0]["level3_id"] : "";


$house_no = (isset($get_customer_business_data[0]["house_no"]) && !empty($get_customer_business_data[0]["house_no"]))? $get_customer_business_data[0]["house_no"] : "";

$address = (isset($get_customer_business_data[0]["address"]) && !empty($get_customer_business_data[0]["address"]))? $get_customer_business_data[0]["address"] : "";

$landmark = (isset($get_customer_business_data[0]["landmark"]) && !empty($get_customer_business_data[0]["landmark"]))? $get_customer_business_data[0]["landmark"] : "";

$farm_level3_id = (isset($get_customer_business_data[0]["farm_level3"]) && !empty($get_customer_business_data[0]["farm_level3"]))? $get_customer_business_data[0]["farm_level3"] : "";

$farm_level2_id = (isset($get_customer_business_data[0]["farm_level2"]) && !empty($get_customer_business_data[0]["farm_level2"]))? $get_customer_business_data[0]["farm_level2"] : "";

$farm_level1_id = (isset($get_customer_business_data[0]["farm_level1"]) && !empty($get_customer_business_data[0]["farm_level1"]))? $get_customer_business_data[0]["farm_level1"] : "";


$pincode = (isset($get_customer_business_data[0]["pincode"]) && !empty($get_customer_business_data[0]["pincode"]))? $get_customer_business_data[0]["pincode"] : "";

$latitude = (isset($get_customer_business_data[0]["latitude"]) && !empty($get_customer_business_data[0]["latitude"]))? $get_customer_business_data[0]["latitude"] : "";

$longitude = (isset($get_customer_business_data[0]["longitude"]) && !empty($get_customer_business_data[0]["longitude"]))? $get_customer_business_data[0]["longitude"] : "";

$daily_counter = (isset($get_customer_business_data[0]["avg_daily_counter"]) && !empty($get_customer_business_data[0]["avg_daily_counter"]))? $get_customer_business_data[0]["avg_daily_counter"] : "";

$daily_footfalls = (isset($get_customer_business_data[0]["avg_daily_footfalls"]) && !empty($get_customer_business_data[0]["avg_daily_footfalls"]))? $get_customer_business_data[0]["avg_daily_footfalls"] : "";

$all_crop_html = "";
$selected_data = "";

$all_crop_html1 = "";

if(!empty($all_crop_data) && $all_crop_data != 0)
{
    foreach($all_crop_data as $crop_key => $crop_data)
    {
        $all_crop_html1 .= '<option '.$selected_data.' value="'.$crop_data["crop_country_id"].'">'. $crop_data["crop_name"].'</option>';
    }
}

?>



<div class="clearfix"></div>


<div class="actv-details-form">

    <h5 style=" margin-bottom: 30px;">Business Details</h5>
    <div class="back_details">

        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_business_info','name'=>'dialpad_business_info', 'autocomplete'=>'off');
        echo form_open('cco/add_update_crop_farming_info',$attributes);
        ?>

        <div class="row">
            <div class="col-md-12">

                <div class="row cco-form-fl">
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Avg Daily Counter">Avg. Daily Counter</label>
                            <input type="text" class="form-control" name="daily_counter" id="daily_counter" placeholder="" value="<?php echo $daily_counter; ?> " />
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Yield Contribution">Avg. Daily Footfalls</label>
                            <input type="text" class="form-control" name="daily_footfalls" id="daily_footfalls" placeholder="" value="<?php echo $daily_footfalls; ?>" />
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="House No">House No</label>

                            <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />

                            <input type="text" class="form-control" name="house_no" id="house_no" placeholder="" value="<?php  echo $house_no; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Address">Address</label>

                            <textarea id="address"  style="height: 72px!important;" name="address"><?php echo $address; ?></textarea>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Landmark">Landmark</label>
                            <input type="text" class="form-control" name="landmark" id="landmark" placeholder="" value="<?php echo $landmark; ?>"/>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="row cco-form-fl">

                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Pincode">Pincode</label>

                            <input type="text" class="form-control" name="pincode" id="pincode" placeholder="" value="<?php  echo $pincode; ?>" />

                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Latitude">Latitude</label>
                            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="" value="<?php echo $latitude; ?>"/>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Longitude">Longitude</label>
                            <input type="text" class="form-control" name="longitude" id="longitude" placeholder="" value="<?php echo $longitude; ?>"/>
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
                <!--<div class="rotate_data">
                    <div class="row cco-form-fl">
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Crop Name">Crop Name</label>

                            <select class="form-control" name="crop_name[]" id="crop_name">
                                <option value="">Select Crop</option>

                                <?php
/*
                                if(!empty($all_crop_data) && $all_crop_data != 0)
                                {
                                    foreach($all_crop_data as $crop_key => $crop_data)
                                    {
                                        $all_crop_html .= '<option value="'.$crop_data["crop_country_id"].'">'. $crop_data["crop_name"].'</option>';
                                    }
                                }

                                */?>
                                <?php /*echo $all_crop_html; */?>

                            </select>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Yield Contribution">Yield Contribution</label>
                            <input type="text" class="form-control" name="yield_contribution[]" id="yield_contribution" placeholder="" value="" />
                        </div>
                    </div>
                </div>
                </div>-->

                <div class="col-md-12 text-left" style="margin-bottom: 10px;">
                    <div class="row">
                       <!-- <button type="button" style="padding: 5px 30px;" class="btn btn-default back_details-button add_more">More</button>-->
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


    <!--<h6 class="defau-tl">Crops</h6>-->
    <div class="row">

        <div class="col-md-11" id="customer_crop_detail_data">
            <div class="col-md-10 col-md-offset-1 cco-form-fl">
                <div class="row tp_form">
                    <div class="form-group">


                        <?php
                        if(!empty($allocated_crop_data))
                        {

                            foreach($allocated_crop_data as $data_key => $cust_crop_data)
                            {
                                ?>
                                <ul class="corp-list">
                                    <li><label style="margin: 0;"><strong><?php echo $cust_crop_data["crop_name"]; ?></strong></label></li>
                                    <li><label style="margin: 0;"><?php echo $cust_crop_data["yeild_HA"]; ?></label></li>
                                    <li style="text-align: center;">
                                        <div class="delete_i" style="display: inline-block;" prdid ="<?php echo $cust_crop_data["customer_crop_detail_id"];?>">
                                            <a href="javascript: void(0);" style="color: #ff0000;">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            <?php
                            }

                        }
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="clearfix"></div>

<?php
if($farm_level3_id != ""){
    $level3_id = $farm_level3_id;
}
if($farm_level2_id != ""){
    $level2_id = $farm_level2_id;
}
if($farm_level1_id != ""){
    $level1_id = $farm_level1_id;
}
?>

<script type="text/javascript">

    var selceted_level_3 =  '<?php echo $level3_id; ?>';
    var selceted_level_2 =  '<?php echo $level2_id; ?>';
    var selceted_level_1 =  '<?php echo $level1_id; ?>';

    $("button.add_more").on('click',function(){

        var html = '';

        html += '<div class="rotate_data">';

        html += '<div class="row cco-form-fl">';
        html += '<div class="col-md-4 col-sm-6 tp_form">';
        html += '<div class="form-group">';
        html += '<label for="Crop Name">Crop Name</label>';

        html += '<select class="form-control" name="crop_name[]" id="crop_name">';
        html += '<option value="">Select Crop</option>';

        html += '<?php echo $all_crop_html1; ?>';

        html += '</select>';

        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4 col-sm-6 tp_form">';
        html += '<div class="form-group">';
        html += '<label for="Yield Contribution">Yield Contribution</label>';
        html += '<input type="text" class="form-control" name="yield_contribution[]" id="yield_contribution" placeholder="" value="" />';
        html += '</div>';
        html += '</div>';
        html += '</div>'

        html += '</div>';

        $("div.rotate_data:last").after(html);

    });



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

    $("textarea#address").on("focusout",function(){

        var address = $(this).val();

        $.ajax({
            type: 'POST',
            url: site_url + "cco/get_address_lat_long_data",
            data: {address_data: address},
            success: function (resp) {
                var obj = $.parseJSON(resp);
                $("input#latitude").val(obj.latitude);
                $("input#longitude").val(obj.longitude);
                //$("div#dialpad_middle_contailner").html(resp);
                //get_geo_data(campagain_id,3,num_count);
            }
        });

    });
</script>