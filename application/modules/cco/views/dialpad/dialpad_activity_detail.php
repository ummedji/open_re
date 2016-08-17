<div class="actv-details-form">

    <h5 style="margin: 0px 0 20px 0;">Activity Details</h5>
    <div class="back_details">

        <?php
         $attributes = array('class' => '', 'id' => 'view_activity_details','name'=>'view_activity_details', 'autocomplete'=>'off');
         echo form_open('',$attributes);
        ?>

        <div class="row">
            <div class="col-md-11" id="activity_detail_data">
                <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />

                <div class="row cco-form-fl">
                    <div class="col-md-3 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Level 3">Level 3</label>
                            <select class="form-control" name="geo_level_3" id="geo_level_3">
                                <option value="">Select Geo Level 3</option>
                                <?php if (isset($geo_level) && !empty($geo_level)) { ?>
                                    <?php foreach($geo_level as $k=>$gl) { ?>
                                        <option value="<?php echo $gl['geo_level_id3']; ?>"><?php echo$gl['political_geography_name'];?></option>

                                    <?php }
                                }?>
                            </select>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Level 2">Level 2</label>
                            <!-- <input type="text" class="form-control" name="geo_level_2" id="geo_level_2" placeholder="" value="<?php //echo $level2; ?>" /> -->

                            <select class="form-control" name="geo_level_2" id="geo_level_2">

                            </select>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 tp_form">
                        <div class="form-group">
                            <label for="Level 1">Level 1</label>

                            <select class="form-control" name="geo_level_1" id="geo_level_1">

                            </select>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 tp_form">
                        <div class="inl_button save_btn">
                            <button id="view_activity_calender" type="submit" class="btn btn-primary gren_btn">Execute</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo form_close(); ?>
        <div class="clearfix"></div>


        <div class="calendar_space">
            <div id="calendar">

            </div>
            <div class="clearfix"></div>
        </div>
        <!--<div>
            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                <thead class="cf">
                <tr>
                    <th>Activity Name<span class="rts_bordet"></span></th>
                    <th>Employee Name<span class="rts_bordet"></span></th>
                    <th class="numeric">Mobile No.<span class="rts_bordet"></span></th>
                    <th class="numeric">Crops<span class="rts_bordet"></span></th>
                    <th class="numeric">Products<span class="rts_bordet"></span></th>
                    <th class="numeric">Disease<span class="rts_bordet"></span></th>
                    <th class="numeric">Attendee<span class="rts_bordet"></span></th>
                    <th class="numeric">Geography<span class="rts_bordet"></span></th>
                    <th class="numeric">Address<span class="rts_bordet"></span></th>
                </tr>
                </thead>
                <tbody class="dialpad_main_screen">

                <?php
/*                if(!empty($activity_customer_data))
                {
                    testdata($activity_customer_data);
                    foreach($activity_customer_data as $key=>$activity_data)
                    {
                        */?>
                        <tr>
                            <td data-title="Activity Name"><?php /*echo $activity_data["activity_type_country_name"]; */?></td>
                            <td data-title="Employee Name"><?php /*echo $activity_data["display_name"]; */?></td>
                            <td data-title="Mobile No."><?php /*echo $activity_data["primary_mobile_no"]; */?></td>
                            <?php /**/?>
                            <td data-title="Crops"><?php /*echo $activity_data["primary_mobile_no"]; */?></td>
                            <td data-title="Products"><?php /*echo $activity_data["level_2"]; */?></td>
                            <td data-title="Disease"><?php /*echo $activity_data["level_3"]; */?></td>
                            <td data-title="Attendee"><?php /*echo $activity_data["level_4"]; */?></td>
                            <td data-title="Geography"><?php /*echo $activity_data["activity_planning_time"]; */?></td>
                            <td data-title="Geography"><?php /*echo $activity_data["proposed_attandence_count"]; */?></td>
                        </tr>
                        <?php
/*                    }
                }
                else{
                    */?>
                    <h1 align="center" class="on_data">No Data Available</h1>
                    <?php
/*                }
                */?>
                </tbody>
            </table>
        </div>-->
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<script type="text/javascript">

$(document).on('click','#view_activity_calender',function(){

   var param = $("#view_activity_details").serializeArray();

    var d = new Date();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();

    var cur_month = month+'-'+year;

    $.ajax({
        type: 'POST',
        url: site_url + "cco/getActivityDetailByMonth",
        data: {param : param,cur_month : cur_month},
        success: function (resp) {
            $('#calendar').html(resp);
            return false;
        }
    });
    return false;
});

    function getActivityCalenderData(cur_month){

        var param = $("#view_activity_details").serializeArray();
        $.ajax({
            type: 'POST',
            url: site_url + "cco/getActivityDetailByMonth",
            data: {param : param,cur_month : cur_month},
            success: function (resp) {
                $('#calendar').html(resp);
                return false;
            }
        });

    }

$(document).on('click','.activity_date',function(){

    var cur_date = $(this).attr('rel');
    var param = $("#view_activity_details").serializeArray();

    $.ajax({
        type: 'POST',
        url: site_url + "cco/getActivityDetailByDate",
        data: {cur_date:cur_date,param:param},
        success: function (resp) {

            return false;
        }
    });
});


</script>