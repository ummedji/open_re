<?php
//testdata($personal_general_data);

$customer_id = (isset($personal_general_data[0]["id"]) && !empty($personal_general_data[0]["id"]))? $personal_general_data[0]["id"] : "";

$customer_name = (isset($personal_general_data[0]["display_name"]) && !empty($personal_general_data[0]["display_name"]))? $personal_general_data[0]["display_name"] : "";

$customer_email = (isset($personal_general_data[0]["email"]) && !empty($personal_general_data[0]["email"]))? $personal_general_data[0]["email"] : "";

$customer_primary_mobile_no = (isset($personal_general_data[0]["primary_mobile_no"]) && !empty($personal_general_data[0]["primary_mobile_no"]))? $personal_general_data[0]["primary_mobile_no"] : "";

$customer_secondary_mobile_no = (isset($personal_general_data[0]["secondary_mobile_no"]) && !empty($personal_general_data[0]["secondary_mobile_no"]))? $personal_general_data[0]["secondary_mobile_no"] : "";

$customer_landline_no = (isset($personal_general_data[0]["landline_no"]) && !empty($personal_general_data[0]["landline_no"]))? $personal_general_data[0]["landline_no"] : "";

$customer_house_no = (isset($personal_general_data[0]["house_no"]) && !empty($personal_general_data[0]["house_no"]))? $personal_general_data[0]["house_no"] : "";

$customer_address = (isset($personal_general_data[0]["address"]) && !empty($personal_general_data[0]["address"]))? $personal_general_data[0]["address"] : "";

$customer_landmark = (isset($personal_general_data[0]["landmark"]) && !empty($personal_general_data[0]["landmark"]))? $personal_general_data[0]["landmark"] : "";

$customer_pincode = (isset($personal_general_data[0]["pincode"]) && !empty($personal_general_data[0]["pincode"]))? $personal_general_data[0]["pincode"] : "";

$level1 = (isset($personal_general_data[0]["level1"]) && !empty($personal_general_data[0]["level1"]))? $personal_general_data[0]["level1"] : "";

$level2 = (isset($personal_general_data[0]["level2"]) && !empty($personal_general_data[0]["level2"]))? $personal_general_data[0]["level2"] : "";

$level3 = (isset($personal_general_data[0]["level3"]) && !empty($personal_general_data[0]["level3"]))? $personal_general_data[0]["level3"] : "";

$level1_id = (isset($personal_general_data[0]["level1_id"]) && !empty($personal_general_data[0]["level1_id"]))? $personal_general_data[0]["level1_id"] : "";

$level2_id = (isset($personal_general_data[0]["level2_id"]) && !empty($personal_general_data[0]["level2_id"]))? $personal_general_data[0]["level2_id"] : "";

$level3_id = (isset($personal_general_data[0]["level3_id"]) && !empty($personal_general_data[0]["level3_id"]))? $personal_general_data[0]["level3_id"] : "";

$customer_first_name = (isset($personal_general_data[0]["first_name"]) && !empty($personal_general_data[0]["first_name"]))? $personal_general_data[0]["first_name"] : "";

$customer_last_name = (isset($personal_general_data[0]["last_name"]) && !empty($personal_general_data[0]["last_name"]))? $personal_general_data[0]["last_name"] : "";

$customer_gender = (isset($personal_general_data[0]["gender"]) && !empty($personal_general_data[0]["gender"]))? $personal_general_data[0]["gender"] : "";

$customer_dob = (isset($personal_general_data[0]["dob"]) && !empty($personal_general_data[0]["dob"]))? $personal_general_data[0]["dob"] : "";

$customer_introduction_year = (isset($personal_general_data[0]["introduction_year"]) && !empty($personal_general_data[0]["introduction_year"]))? $personal_general_data[0]["introduction_year"] : "";

$customer_passport_no = (isset($personal_general_data[0]["passport_no"]) && !empty($personal_general_data[0]["passport_no"]))? $personal_general_data[0]["passport_no"] : "";

$customer_ktp_no = (isset($personal_general_data[0]["ktp_no"]) && !empty($personal_general_data[0]["ktp_no"]))? $personal_general_data[0]["ktp_no"] : "";

$customer_aadhaar_card_no = (isset($personal_general_data[0]["aadhaar_card_no"]) && !empty($personal_general_data[0]["aadhaar_card_no"]))? $personal_general_data[0]["aadhaar_card_no"] : "";


//$addres_data = $customer_house_no."\r\n".$customer_address."\r\n".$customer_landmark."\r\n".$level1."\r\n".$level2."\r\n".$level3."\r\n".$customer_pincode;

?>

<div class="text-center sub_nave">
    <div class="inn_sub_nave">
        <ul>
            <li class=""><a class="personal_info" href="javascript:void(0);" onclick="get_general_detail_data(<?php echo $customer_id; ?>);" >General</a></li>
            <li class=""><a class="family_info" href="javascript:void(0);" onclick="get_family_detail_data(<?php echo $customer_id; ?>);" >Family</a></li>
        </ul>
    </div>
</div>

<div class="clearfix"></div>


<div class="actv-details-form">



    <h5>Personal Details</h5>
    <div class="back_details">

        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_general_info','name'=>'dialpad_general_info', 'autocomplete'=>'off');
        echo form_open('cco/add_update_general_info',$attributes);
        ?>

        <div class="row">
            <div class="col-md-11">
                General Info </hr>
                <div class="row">

                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Farmer Name">Farmer Name</label>

                            <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />

                            <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="" value="<?php echo $customer_name; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="First Name">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="" value="<?php echo $customer_first_name; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Last Name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="" value="<?php echo $customer_last_name; ?>"/>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Gender">Gender</label>

                            <?php

                            echo $customer_gender;
                                $male_selected = "";
                                $female_selected = "";
                                if($customer_gender == "Male"){
                                    $male_selected = "selected = 'selected'";
                                }
                                elseif($customer_gender == "Female"){
                                    $female_selected = "selected = 'selected'";
                                }
                            ?>

                            <select class="form-control" placeholder="" name="gender">
                                <option value="">Select Gender</option>
                                <option <?php echo $male_selected; ?> value="Male">Male</option>
                                <option <?php echo $female_selected; ?> value="Female">Female</option>
                            </select>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Date Of Birth">Date Of Birth</label>
                            <input type="text" class="form-control dob" name="dob" id="dob" placeholder="" value="<?php echo $customer_dob; ?>"/>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Email Id">Email Id</label>
                            <input type="text" class="form-control" name="email_id" id="email_id" placeholder="" value="<?php echo $customer_email; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Primary Mobile No.">Primary Mobile No.</label>
                            <input type="text" class="form-control" name="primary_mobile_no" id="primary_mobile_no" placeholder="" value="<?php echo $customer_primary_mobile_no; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Other Contact No.">Other Contact No.</label>
                            <input type="text" class="form-control" name="secondary_mobile_no" id="secondary_mobile_no" placeholder="" value="<?php echo $customer_secondary_mobile_no; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Fixed Line No.">Fixed Line No.</label>
                            <input type="text" class="form-control" name="fixed_line_no" id="fixed_line_no" placeholder="" value="<?php echo $customer_landline_no; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="KTP No.">KTP No.</label>
                            <input type="text" class="form-control" name="ktp_no" id="ktp_no" placeholder="" value="<?php echo $customer_ktp_no; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Introduction Year">Introduction Year</label>
                            <input type="text" class="form-control" name="introduction_year" id="introduction_year" placeholder="" value="<?php echo $customer_introduction_year; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Pincode">Pincode</label>
                            <input type="text" class="form-control" name="pincode" id="pincode" placeholder="" value="<?php echo $customer_pincode; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Level 3">Level 3</label>

                            <select class="form-control" name="geo_level_3" id="geo_level_3">

                            </select>

                          <!---  <input type="text"   placeholder="" value="<?php //echo $level3; ?>" /> -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Level 2">Level 2</label>
                           <!-- <input type="text" class="form-control" name="geo_level_2" id="geo_level_2" placeholder="" value="<?php //echo $level2; ?>" /> -->

                            <select class="form-control" name="geo_level_2" id="geo_level_2">

                            </select>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Level 1">Level 1</label>

                            <select class="form-control" name="geo_level_1" id="geo_level_1">

                            </select>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Adhar Card No.">Adhar Card No.</label>
                            <input type="text" class="form-control" name="adhar_card_no" id="adhar_card_no" placeholder="" value="<?php echo $customer_aadhaar_card_no; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Passport No.">Passport No.</label>
                            <input type="text" class="form-control" name="passport_no" id="passport_no" placeholder="" value="<?php echo $customer_passport_no; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Activity Name">Lisence No.</label>
                            <input type="text" class="form-control" name="lisence_no" id="lisence_no" placeholder="" value="<?php echo ""; ?>" />
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Address">Address</label>
                            <textarea class="form-control" style="height: 72px!important;" name="address" id="address" placeholder=""><?php echo $customer_address; ?></textarea>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    </div>
            </div>

        </div>

        <div class="clearfix"></div>
        <div class="col-md-1 col-md-1-n">
            <label class="space_llb">&nbsp;</label>
            <button type="submit" class="btn btn-default back_details-button">Save</button>
        </div>

        <?php form_close(); ?>

    </div>

    <!--

    <div class="pers-details-form">
        <div class="row">
            <div class="col-md-4 cl_space">calendar here...</div>
            <div class="col-md-8 auto_form_scroll">
                <div class="row">
                    <div class="col-md-6 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Activity Name">Activity Name</label>
                            <input type="text" class="form-control" name="Activity Name" id="Activity Name" placeholder="">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="EMP Name">EMP Name</label>
                            <input type="text" class="form-control" name="EMP Name" id="EMP Name" placeholder="">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Mobile No.">Mobile No.</label>
                            <input type="text" class="form-control" name="Mobile No." id="Mobile No." placeholder="">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Crops">Crops</label>
                            <select class="selectpicker" id="Crops" name="Crops">
                                <option value="">Multiple</option>
                                <option value="">Crops1</option>
                            </select>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Products">Products</label>
                            <select class="selectpicker" id="Products" name="Crops">
                                <option value="">Multiple</option>
                                <option value="">Products1</option>
                            </select>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Diseases">Diseases</label>
                            <select class="selectpicker" id="Diseases" name="Crops">
                                <option value="">Multiple</option>
                                <option value="">Diseases1</option>
                            </select>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Key Attandee">Key Attandee</label>
                            <input type="text" class="form-control" name="Key Attandee" id="Key Attandee" placeholder="">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 com_form">
                        <div class="form-group">
                            <label for="Geography">Geography</label>
                            <input type="text" class="form-control" name="Geography" id="Geography" placeholder="">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-12 com_form">
                        <div class="form-group">
                            <label for="Address" class="mx-wd-cont">Address</label>
                            <textarea class="form-control" aria-controls="" rows="3" name="Address" id="Address" placeholder=""></textarea>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    -->

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