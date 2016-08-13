<?php
$select_qualification_html = "";
$selected_data = "";

$select_qualification_html1 = "";

if(!empty($education_qualification_data) && $education_qualification_data != 0)
{
    foreach($education_qualification_data as $qual_key => $qualification_data)
    {
        $select_qualification_html1 .= '<option '.$selected_data.' value="'.$qualification_data["qualification_id"].'">'. $qualification_data["qualification_name"].'</option>';
    }
}

?>

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
              //  testdata($personal_education_data);
                if(!empty($personal_education_data)){

                foreach($personal_education_data as $key=>$education_data){


                ?>
                    <div class="rotate_data">

                        <div class="row">

                            <div class="col-md-4 col-sm-6 com_form">
                                <div class="form-group">
                                    <label for="Degree/Qualification">Degree/Qualification</label>

                                    <input type="hidden" class="form-control" name="education_data_id[]" id="education_data_id" placeholder="" value="<?php echo $education_data["education_detail_id"]; ?>" />

                                    <select rel="<?php echo $education_data['edu_specialization_id']; ?>" class="form-control qualification" placeholder="" name="qualification[]" >
                                        <option value="" >Select Qualification</option>

                                        <?php

                                        if(!empty($education_qualification_data) && $education_qualification_data != 0)
                                        {
                                            foreach($education_qualification_data as $qual_key => $qualification_data)
                                            {

                                                if($education_data["qualification_id"] == $qualification_data["qualification_id"]){
                                                    $selected_data = "selected = 'selected'";
                                                }
                                                else{
                                                    $selected_data = "";
                                                }

                                                $select_qualification_html .= '<option '.$selected_data.' value="'.$qualification_data["qualification_id"].'">'. $qualification_data["qualification_name"].'</option>';
                                            }
                                        }

                                        ?>
                                        <?php echo $select_qualification_html; ?>

                                    </select>

                                    <div class="clearfix"></div>
                                </div>

                                <div class="form-group">
                                    <label for="Gender">Specialization</label>



                                    <select class="form-control specialization" placeholder="" name="specialization[]">

                                    </select>
                                    <div class="clearfix"></div>

                                </div>

                                <div class="form-group">
                                    <label for="Institute/University">Institute/University</label>
                                    <input class="form-control"  type="text" name="university[]" value="<?php echo $education_data['instiute']; ?>"/>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="form-group">
                                    <label for="Year">Year</label>
                                    <input class="form-control year_data" id="year_data"  type="text" name="year_data[]" value="<?php echo date("Y",strtotime($education_data['year'])); ?>"/>
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
        html += '<label for="Degree/Qualification">Degree/Qualification</label>';

        html += '<input type="hidden" class="form-control" name="education_data_id[]" id="education_data_id" placeholder="" value="" />';

        html += '<select class="form-control qualification" placeholder="" name="qualification[]">';
        html += '<option value="">Select Qualification</option>';

        html += '<?php echo $select_qualification_html1; ?>';

        html += '</select>';

        html += '<div class="clearfix"></div>';
        html += '</div>';

        html += '<div class="form-group">';
        html += '<label for="Gender">Specialization</label>';

        html += '<select class="form-control specialization" placeholder="" name="specialization[]">';

        html += '</select>';

        html += '<div class="clearfix"></div>';

        html += '</div>';

        html += '<div class="form-group">';
        html += '<label for="Institute/University">Institute/University</label>';
        html += '<input class="form-control"  type="text" name="university[]" value=""/>';
        html += '<div class="clearfix"></div>';
        html += '</div>';

        html += '<div class="form-group">';
        html += '<label for="Year">Year</label>';
        html += '<input class="form-control year_data" id="year_data"  type="text" name="year_data[]" value=""/>';
        html += '<div class="clearfix"></div>';
        html += '</div>';

        html += '</div>';
        html += '</div>';
        html += '</div>';

        $("div.rotate_data:last").after(html);

    });

    setTimeout(function(){

        $( ".qualification" ).each(function( index ) {

            var parent_html  = $(this);
            var qualification_id = $(this).val();
            var spec_id = $(this).attr("rel");

            get_qualification_specilization_data(qualification_id,parent_html,spec_id);

        });

    }, 2000);


</script>