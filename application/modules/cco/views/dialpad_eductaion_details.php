<div class="actv-details-form">

    <h5>Education Details</h5>
    <div class="back_details">

        <?php
        $attributes = array('class' => '', 'id' => 'dialpad_education_info','name'=>'dialpad_education_info', 'autocomplete'=>'off');
        echo form_open('cco/add_update_education_info',$attributes);
        ?>

        <div class="row">

            <div class="col-md-11" id="education_detail_data">
                Family Info </hr>

                <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />

                <?php

                if(!empty($personal_education_data)){

                foreach($personal_education_data as $key=>$education_data){
                ?>
                    <div class="rotate_data">

                        <div class="row">

                            <div class="col-md-4 col-sm-6 com_form">
                                <div class="form-group">
                                    <label for="Degree/Qualification">Degree/Qualification</label>

                                    <select class="form-control" placeholder="" name="qualification[]">
                                        <option value="">Select Qualification</option>
                                        <option <?php //echo $male_selected; ?> value="Male">Male</option>
                                        <option <?php //echo $female_selected; ?> value="Female">Female</option>
                                    </select>

                                    <input type="text" class="form-control" name="[]" id="qualification" placeholder="" value="<?php echo $family_data["relative_name"]; ?>" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 com_form">
                                <div class="form-group">
                                    <label for="Relation">Relation</label>
                                    <input type="text" class="form-control" name="relation[]" id="relation" placeholder="" value="<?php echo $family_data["relative_relation"]; ?>" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 com_form">
                                <div class="form-group">
                                    <label for="Mobile No.">Mobile No.</label>
                                    <input type="text" class="form-control" name="contact_no[]" id="contact_no" placeholder="" value="<?php echo $family_data["mobile_no"]; ?>"/>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-6 com_form">
                                <div class="form-group">
                                    <label for="Gender">Gender</label>

                                    <?php

                                   // echo $customer_gender;
                                    $male_selected = "";
                                    $female_selected = "";

                                    $customer_gender = $family_data["gender"];

                                    if($customer_gender == "Male"){
                                        $male_selected = "selected = 'selected'";
                                    }
                                    elseif($customer_gender == "Female"){
                                        $female_selected = "selected = 'selected'";
                                    }
                                    ?>

                                    <select class="form-control" placeholder="" name="gender[]">
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
                                    <input type="text" class="form-control dob" name="dob[]" id="dob" placeholder="" value="<?php echo $family_data["relative_dob"]; ?>"/>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 com_form">
                                <div class="form-group">
                                    <label for="Email Id">Email Id</label>
                                    <input type="text" class="form-control" name="email_id[]" id="email_id" placeholder="" value="<?php echo $family_data["email_id"]; ?>" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-6 com_form">
                                <div class="form-group">
                                    <label for="Dependent">Dependent</label>

                                    <?php

                                    $no_selected = "";
                                    $yes_selected = "";

                                    $customer_dependent = $family_data["dependent"];

                                    if($customer_dependent == "0"){
                                        $no_selected = "selected = 'selected'";
                                    }
                                    elseif($customer_gender == "Female"){
                                        $yes_selected = "selected = 'selected'";
                                    }
                                    ?>

                                    <select class="form-control" placeholder="" name="dependent[]">
                                        <option <?php echo $no_selected; ?> value="0">No</option>
                                        <option <?php echo $yes_selected; ?> value="1">Yes</option>
                                    </select>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                <?php }
                }
                ?>

            </div>

            <div class="col-md-11">
                <button type="button" class="btn btn-default back_details-button add_more">More</button>
            </div>

        </div>

        <div class="clearfix"></div>
        <div class="col-md-1 col-md-1-n">
            <label class="space_llb">&nbsp;</label>
            <button type="submit" class="btn btn-default back_details-button">Save</button>
        </div>

        <?php form_close(); ?>

    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<script type="text/javascript">
    $("button.add_more").on('click',function(){

        var html = '';

        html += '<div class="rotate_data">';

        html += '<div class="row">';

        html += '<div class="col-md-4 col-sm-6 com_form">';
        html += '<div class="form-group">';
        html += '<label for="Relative Name">Relative Name</label>';

        html += '<input type="hidden" class="form-control" name="relative_id[]" id="relative_id" placeholder="" value="" />';

        html += '<input type="text" class="form-control" name="relative_name[]" id="relative_name" placeholder="" value="" />';
        html += '<div class="clearfix"></div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4 col-sm-6 com_form">';
        html += '<div class="form-group">';
        html += '<label for="Relation">Relation</label>';
        html += '<input type="text" class="form-control" name="relation[]" id="relation" placeholder="" value="" />';
        html += '<div class="clearfix"></div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4 col-sm-6 com_form">';
        html += '<div class="form-group">';
        html += '<label for="Mobile No.">Mobile No.</label>';
        html += '<input type="text" class="form-control" name="contact_no[]" id="contact_no" placeholder="" value=""/>';
        html += '<div class="clearfix"></div>';
        html += '</div>';
        html += '</div>';

        html += '</div>';
        html += '<div class="row">';
        html += '<div class="col-md-4 col-sm-6 com_form">';
        html += '<div class="form-group">';
        html += '<label for="Gender">Gender</label>';
        html += '<select class="form-control" placeholder="" name="gender[]">';
        html += '<option value="">Select Gender</option>';
        html += '<option value="Male">Male</option>';
        html += '<option value="Female">Female</option>';
        html += '</select>';
        html += '<div class="clearfix"></div>';

        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4 col-sm-6 com_form">';
        html += '<div class="form-group">';
        html += '<label for="Date Of Birth">Date Of Birth</label>';
        html += '<input type="text" class="form-control dob" name="dob[]" id="dob" placeholder="" value=""/>';
        html += '<div class="clearfix"></div>';

        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4 col-sm-6 com_form">';
        html += '<div class="form-group">';
        html += '<label for="Email Id">Email Id</label>';
        html += '<input type="text" class="form-control" name="email_id[]" id="email_id" placeholder="" value="" />';
        html += '<div class="clearfix"></div>';
        html += '</div>';
        html += '</div>';

        html += '</div>';
        html += '<div class="row">';
        html += '<div class="col-md-4 col-sm-6 com_form">';
        html += '<div class="form-group">';
        html += '<label for="Dependent">Dependent</label>';
        html += '<select class="form-control" placeholder="" name="dependent[]">';
        html += '<option value="0">No</option>';
        html += '<option value="1">Yes</option>';
        html += '</select>';

        html += '<div class="clearfix"></div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $("div.rotate_data:last").after(html);

    });
</script>