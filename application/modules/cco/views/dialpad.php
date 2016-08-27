<?php //testdata($this->session->userdata("caller_data")); ?>
<div id="cco_wrapper">
    <div class="cco_header">

        <?php
        $phone_no = $this->session->userdata('phone_no');
        $caller_status = $this->session->userdata('caller_status');
        ?>

        <?php
        if($caller_status == 'FALSE'){
        ?>

        <div class="left_details pull-left">
            <div class="blk_list">
                <a href="javascript:void(0);">
                    <span class="phone_number"><?php echo $phone_no; ?></span>
                </a>
                |
                <a class="unknown_customer_role" attr-role-data="11" href="javascript:void(0);">
                    <span  class="farmer_data">Farmer</span>
                </a>
                |
                <a class="unknown_customer_role" attr-role-data="10" href="javascript:void(0);">
                    <span class="retailer_data">Retailer</span>
                </a>
                |
                <a class="unknown_customer_role" attr-role-data="9" href="javascript:void(0);">
                    <span class="distributor_data">Distributor</span>
                </a>

            </div>
        </div>

        <?php } ?>

        <div class="left_details pull-right">
            <div class="blk_list">
                <a href="#">


                    <img src="<?php echo Template::theme_url('images/blacklist_icon.png'); ?>" alt="" style="vertical-align: middle;">
                    <span><a href="javascript:void(0);" onclick="block_phone_number(<?php echo $phone_no; ?>);">Add To Blacklist</a></span>
                </a>
                <div class="clearfix"></div>
            </div>
            <div class="time_space">
                <img src="<?php echo Template::theme_url('images/watch_icon.png'); ?>" alt="" style="vertical-align: middle;"> <span>2 : 30 : 05</span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="content_in">
        <div class="col-md-12 count-height">
            <div class="row" style="padding-top: 15px; padding-bottom: 15px;">
                <div class="col-md-3 resp-sidebar" style="z-index: 10;">
                    <div class="left-side-details">
                        <div class="up-detail-box">

                            <?php

                            $customer_id = (isset($sidebar_selected_customer_data[0]["id"]) && !empty($sidebar_selected_customer_data[0]["id"])) ? $sidebar_selected_customer_data[0]["id"] : NULL;

                            //echo $customer_id;die;

                                    $customer_name = (isset($sidebar_selected_customer_data[0]["display_name"]) && !empty($sidebar_selected_customer_data[0]["display_name"])) ? $sidebar_selected_customer_data[0]["display_name"] : "";


                                    $customer_code = (isset($sidebar_selected_customer_data[0]["user_code"]) && !empty($sidebar_selected_customer_data[0]["user_code"])) ? $sidebar_selected_customer_data[0]["user_code"] : "";

                                    $customer_email = (isset($sidebar_selected_customer_data[0]["email"]) && !empty($sidebar_selected_customer_data[0]["email"]) ? $sidebar_selected_customer_data[0]["email"] : "") ;



                            if($caller_status == 'FALSE'){
                                $customer_primary_mobile_no = $phone_no;
                            }
                            else {
                                $customer_primary_mobile_no = (isset($sidebar_selected_customer_data[0]["primary_mobile_no"]) && !empty($sidebar_selected_customer_data[0]["primary_mobile_no"])) ? $sidebar_selected_customer_data[0]["primary_mobile_no"] : "";
                            }

                                    $customer_secondary_mobile_no = (isset($sidebar_selected_customer_data[0]["secondary_mobile_no"]) && !empty($sidebar_selected_customer_data[0]["secondary_mobile_no"])) ? $sidebar_selected_customer_data[0]["secondary_mobile_no"] : "";

                                    $customer_landline_no = (isset($sidebar_selected_customer_data[0]["landline_no"]) && !empty($sidebar_selected_customer_data[0]["landline_no"]))? $sidebar_selected_customer_data[0]["landline_no"]:"";


                                    $customer_gender = (isset($sidebar_selected_customer_data[0]["gender"]) && !empty($sidebar_selected_customer_data[0]["gender"]))? $sidebar_selected_customer_data[0]["gender"]:"";

                                    $customer_level1 = (isset($sidebar_selected_customer_data[0]["level1"]) && !empty($sidebar_selected_customer_data[0]["level1"])) ? $sidebar_selected_customer_data[0]["level1"] :"";


                                    $customer_level2 = (isset($sidebar_selected_customer_data[0]["level2"]) && !empty($sidebar_selected_customer_data[0]["level2"]))? $sidebar_selected_customer_data[0]["level2"]: "";


                                    $customer_level3 = (isset($sidebar_selected_customer_data[0]["level3"]) && !empty($sidebar_selected_customer_data[0]["level3"]))? $sidebar_selected_customer_data[0]["level3"]:"";


                                    $customer_desigination_name = (isset($sidebar_selected_customer_data[0]["desigination_country_name"]) && !empty($sidebar_selected_customer_data[0]["desigination_country_name"]))? $sidebar_selected_customer_data[0]["desigination_country_name"] : "";

                            ?>

                            <ul class="in-up-details-list">
                                <li><a href="#"><i class="employee_name_ii"></i>Employee Name</a></li>
                                <li><a href="#"><i class="employee_name_ii"></i>Employee Code</a></li>
                                <li><a href="#"><i class="designation_ii"></i>Designation</a></li>
                                <li><a href="#"><i class="gender_ii"></i>Gender</a></li>
                                <li><a href="#"><i class="primary_mobile_no_ii"></i>Primary Mobile No.</a></li>
                                <li><a href="#"><i class="primary_mobile_no_ii"></i>Other Contact No.</a></li>
                                <li><a href="#"><i class="fixed_line_no_ii"></i>Fixed Line No.</a></li>
                             <!--   <li><a href="#"><i class="country_ii"></i>Country</a></li>
                                <li><a href="#"><i class="country_ii"></i>State</a></li>-->
                                <li><a href="#"><i class="country_ii"></i>City</a></li>
                                <li><a href="#"><i class="country_ii"></i>Provience 2</a></li>
                                <li><a href="#"><i class="country_ii"></i>Provience 1</a></li>
                                <li><a href="#"><i class="email_ii"></i>Email Address</a></li>
                               <!-- <li><a href="#"><i class="user_ii"></i>Ashvin Upadala</a></li>
                                <li><a href="#"><i class="primary_mobile_no_ii"></i>Wrong Number</a></li>
                                <li><a href="#"><i></i>KTP No.</a></li>-->
                            </ul>
                        </div>
                        <div class="inside-detail-box">
                            <ul class="in-up-details-list">
                                <li><a href="#"><i class="employee_name_ii"></i><?php echo $customer_name; ?></a></li>
                                <li><a href="#"><i class="employee_name_ii"></i><?php echo $customer_code; ?></a></li>
                                <li><a href="#"><i class="designation_ii"></i><?php echo $customer_desigination_name; ?></a></li>
                                <li><a href="#"><i class="gender_ii"></i><?php echo $customer_gender; ?></a></li>
                                <li><a href="#"><i class="primary_mobile_no_ii"></i><?php echo $customer_primary_mobile_no; ?></a></li>
                                <li><a href="#"><i class="primary_mobile_no_ii"></i><?php echo $customer_secondary_mobile_no; ?></a></li>
                                <li><a href="#"><i class="fixed_line_no_ii"></i><?php echo $customer_landline_no; ?></a></li>
                             <!--   <li><a href="#"><i class="country_ii"></i>India</a></li>
                                <li><a href="#"><i class="country_ii"></i>Gujarat</a></li>-->

                                <li><a href="#"><i class="country_ii"></i><?php echo $customer_level3; ?></a></li>
                                <li><a href="#"><i class="country_ii"></i><?php echo $customer_level2; ?></a></li>
                                <li><a href="#"><i class="country_ii"></i><?php echo $customer_level1; ?></a></li>
                                <li><a href="#"><i class="email_ii"></i><?php echo $customer_email; ?></a></li>

                              <!--  <li><a href="#"><i class="user_ii"></i>Sachin Dholu</a></li>
                                <li><a href="#"><i class="primary_mobile_no_ii"></i>Wrong Number</a></li>
                                <li><a href="#"><i></i>12345678910</a></li> -->
                            </ul>
                            <a href="#" class="open_sld">
                                <img src="<?php echo Template::theme_url('images/open_icon.png'); ?>" style="vertical-align: middle;" alt="" class="hid-open-arrow">
                                <img src="<?php echo Template::theme_url('images/close_icon.png'); ?>" style="vertical-align: middle;" alt="" class="show-open-arrow">
                            </a>
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>


                <div class="col-md-9">
                    <div class="row">
                        <div class="company_details_form">
                            <form name="upper_dialpad" id="upper_dialpad">


                                <div class="col-md-4 col-sm-4 com_form">
                                    <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="" value="<?php echo $customer_id; ?>" />
                                    <div class="form-group">
                                        <label for="Campaign">Campaign</label>
                                        <div class="inln_fld_top">
                                            <select class="selectpicker" id="campaign_id" name="campaign_id">
                                                <option >Campaign Name</option>
                                                <?php
                                                if (isset($campagaine_data) && !empty($campagaine_data) && $campagaine_data != 0) {
                                                    foreach ($campagaine_data as $k => $campagainedata) {
                                                        ?>
                                                        <option value="<?php echo $campagainedata['campaign_id']; ?>" <?php if(($selected_campagain_data !="" && $selected_campagain_data == $campagainedata['campaign_id']) ){ echo 'selected="selected"'; } ?>><?php echo $campagainedata['campaign_name']; ?></option>
                                                    <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <label id="Campaign-" class="error" for="Campaign"></label>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4 com_form">
                                    <div class="form-group">
                                        <label for="Activity">Activity</label>
                                        <div class="inln_fld_top">
                                        <select class="selectpicker" id="activity_id" name="activity_id">
                                            <option >Activity Name</option>
                                            <?php
                                            if (isset($activity_data) && !empty($activity_data) && $activity_data != 0) {
                                                foreach ($activity_data as $k => $activitydata) {
                                                    ?>
                                                    <option value="<?php echo $activitydata['activity_planning_id']; ?>" <?php //if(($selected_campagain_data !="" && $selected_campagain_data == $activitydata['campaign_id']) ){ echo 'selected="selected"'; } ?>><?php echo $activitydata['activity_type_country_name']."::".$activitydata['execution_date']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                       </div>
                                        <div class="clearfix"></div>
                                        <label id="Activity-" class="error" for="Activity"></label>
                                    </div>
                                </div>
                                  <?php $call_status= $call_status_data[0]['called_status'];
                                        $remarks= $call_status_data[0]['remarks'];
                                        $comments= $call_status_data[0]['comments'];
                                  ?>
                                <div class="col-md-4 col-sm-4 com_form">
                                    <div class="form-group">
                                        <label for="Status">Call Status</label>
                                        <select class="selectpicker" name="call_status" id="call_status" >
                                            <option value="0" <?php if(($call_status !="" && $call_status == 0) ){ echo 'selected="selected"'; } ?>>Pending</option>
                                            <option value="1" <?php if(($call_status !="" && $call_status == 1) ){ echo 'selected="selected"'; } ?>>Satisfactory</option>
                                            <option value="2" <?php if(($call_status !="" && $call_status == 2) ){ echo 'selected="selected"'; } ?>>Attended</option>
                                            <option value="3" <?php if(($call_status !="" && $call_status == 3) ){ echo 'selected="selected"'; } ?>>Call After Some time</option>
                                            <option value="4" <?php if(($call_status !="" && $call_status == 4) ){ echo 'selected="selected"'; } ?>>Family Person</option>
                                            <option value="5" <?php if(($call_status !="" && $call_status == 5) ){ echo 'selected="selected"'; } ?>>Wrong Number</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 com_form">
                                    <div class="form-group">
                                        <label for="Crop Stage">Crop Stage</label>
                                        <input type="text" class="form-control" name="Crop Stage" id="Crop Stage" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6 com_form">
                                    <div class="form-group">
                                        <label for="Comments">Comments</label>
                                        <textarea class="form-control" rows="3" name="comments" id="comments" placeholder="" ><?php echo $remarks; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 com_form">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" name="remarks" id="remarks" placeholder="Remarks" ><?php echo $comments; ?></textarea>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12 text-right" style="margin-bottom: 15px;">
                                    <div class="save_btn">
                                        <button type="submit" class="btn btn-primary">Save</button>

                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>

                        <div class="main-actv-details-form">
                            <?php if (!$this->input->is_ajax_request()) { ?>
                                <div class="col-md-12" id="dialpad_middle_contailner">

                                </div>
                            <?php } ?>
<!--
                            <div class="col-md-12" id="detail_data">

                            </div>-->
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>


                <div class="col-md-12 footer_info">
                    <ul>
                        <li style="border-left: none;"><a href="javascript:void(0);" onclick="get_customer_schemes_data(<?php echo $customer_id; ?>);">Schemes</a></li>
                        <li class="active"><a href="javascript:void(0);" onclick = "get_call_history_detail_data(<?php echo $customer_id; ?>,<?php echo $phone_no; ?>);">Call History</a></li>
                        <li><a href="#">Chat History</a></li>
                        <?php if($this->session->userdata("activity_type") == 'planned_activity'){

                            ?>
                            <li class="disable"><a href="javascript:void(0);" onclick = "get_planned_activity_detail_data(<?php echo $customer_id; ?>,<?php echo $selected_campagain_data ;?>);">Activity Details</a></li>
                       <?php  }
                        elseif($this->session->userdata("activity_type") == 'executed_activity') { ?>
                            <li class="disable"><a href="javascript:void(0);" onclick = "get_executed_activity_detail_data(<?php echo $customer_id; ?>,<?php echo $selected_campagain_data ;?>);">Activity Details</a></li>
                       <?php } else{ ?>
                            <li class="disable"><a href="javascript:void(0);" onclick = "get_activity_detail_data(<?php echo $customer_id; ?>);">Activity Details</a></li>
                       <?php }?>

                        <li><a href="javascript:void(0);" onclick = "get_diseases_detail_data(<?php echo $customer_id; ?>);">Diseases Details</a></li>
                        <li><a href="javascript:void(0);" onclick = "get_product_detail_data(<?php echo $customer_id; ?>);">Product Details</a></li>

                        <li><a href="javascript:void(0);" onclick = "get_questions_detail_data(<?php echo $customer_id; ?>);">Questions</a></li>
                        <?php

                        $caller_data = $this->session->userdata("caller_data");
                       // testdata($caller_data[0]['role_id']);
                        if(isset($caller_data[0]['role_id']) && !empty($caller_data[0]['role_id']) && $caller_data[0]['role_id'] == 8) { ?>
                            <li style="border-left: none; border-bottom: none;"><a href="javascript:void(0);" onclick = "get_employee_order_status_data(<?php echo $customer_id; ?>,<?php echo $caller_data[0]['role_id']; ?>);">Order Status</a></li>
                        <?php }else{ ?>
                            <li style="border-left: none; border-bottom: none;"><a href="javascript:void(0);" onclick = "get_order_status_data(<?php echo $customer_id; ?>,null);">Order Status</a></li>
                        <?php } ?>


                        <li style="border-bottom: none;"><a href="javascript:void(0);" onclick = "get_complaint_detail_data(<?php echo $customer_id; ?>);">Complaints</a></li>
                        <li style="border-bottom: none;"><a href="#">Order Tracking</a></li>
                        <li style="border-bottom: none;"><a href="javascript:void(0);" onclick = "get_order_place_data(<?php echo $customer_id; ?>);">Order Place</a></li>
                        <li style="border-bottom: none;"><a href="javascript:void(0);" onclick="get_customer_feedback_data(<?php echo $customer_id; ?>);">Feedback</a></li>
                        <li style="border-bottom: none;"><a href="#">E Invoice /E Statement</a></li>
                        <li style="border-bottom: none;"><a href="#">Script</a></li>
                        <div class="clearfix"></div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12 footer_menu">
            <ul>
                <li><a href="javascript:void(0);" onclick="get_general_detail_data(<?php echo $customer_id; ?>);">Personal</a></li>
                <li><a href="javascript:void(0);" onclick = "get_education_detail_data(<?php echo $customer_id; ?>);">Education Detail</a></li>
                <li><a href="javascript:void(0);" onclick="get_social_detail_data(<?php echo $customer_id; ?>);">Social Connection</a></li>
                <li><a href="javascript:void(0);" onclick = "get_financial_detail_data(<?php echo $customer_id; ?>);">Financial Details</a></li>
                <li><a href="javascript:void(0);" onclick = "get_retailer_view_data(<?php echo $customer_id; ?>);" >Retailers</a></li>
                <li><a href="javascript:void(0);" onclick = "get_farming_view_data(<?php echo $customer_id; ?>);">Crop</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="javascript:void(0);" onclick = "get_customer_business_view_data(<?php echo $customer_id; ?>);">Business Details</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="right_slide">
    <ul>
        <li><a href="#"><span class="btn_name">Recrding</span> <i class="recrding_ii" aria-hidden="true"></i></a></li>
        <li><a href="#" id="transfer_popup"><span class="btn_name">Transfer</span> <i class="transfer_ii" aria-hidden="true"></i></a></li>
        <li><a href="#"><span class="btn_name">Hold</span> <i class="hold_ii" aria-hidden="true"></i></a></li>
        <li><a href="#"><span class="btn_name">Conferance</span> <i class="conferance_ii" aria-hidden="true"></i></a></li>

        <li><a href="#"><span class="btn_name">End Call</span> <i class="end_call_ii" aria-hidden="true"></i></a></li>
        <li class="active"><a href="#"><span class="btn_name mute-nl">Mute</span> <span class="btn_name spkr-p">Speaker</span> <i class="mute_ii" aria-hidden="true"></i></a></li>
        <li><a href="#"><span class="btn_name">LoudSpeaker</span> <i class="loudspeaker_ii" aria-hidden="true"></i></a></li>
        <li><a href="#"><span class="btn_name">Total Calls - 100</span> <i class="total_calls_ii" aria-hidden="true"></i></a></li>
        <li><a href="#" id="reminder_popup"><span class="btn_name">Reminder - 3</span> <i class="reminder_ii" aria-hidden="true"></i></a></li>
        <li><a href="#"><span class="btn_name">Campaign<br>Phasewise call</span> <i class="phasewise_call_ii" aria-hidden="true"></i></a></li>
    </ul>
</div>

<div class="chat-box">
    <div class="chat-header">
        <h5>CHAT <span>2</span></h5>
        <div class="clearfix"></div>
    </div>
    <div class="chat-content"></div>
    <div class="clearfix"></div>
</div>
<div id="success_file_popup"></div>
<div id="popup_container" class="modal fade tr_modal" role="dialog"></div>

<script type="text/javascript">

    $(document).on('click', 'div#searched_data .eye_i', function (e) {

        e.preventDefault();
        //alert("INNN");

        var customer_id = $("input#customer_id").val();
        var id = $(this).attr('prdid');

        $('div#searched_data').find('tr.bg_focus').removeClass();
        $(this).parents("tr").addClass("bg_focus");

        //var radio_checked = $('input[name=radio1]:checked').val();
        // var login_customer_type = $("input#login_customer_type" ).val();
        // currentpage = $("input.page_function" ).val();

        $.ajax({
            type: 'POST',
            url: site_url+'cco/get_order_data_details',
            data: {orderid: id},
            success: function(resp){
                $("div#detail_data").empty();
                $("#detail_data").html(resp);

                $("input#customer_id").val(customer_id);
            }
        });

        return false;
    });

   // $("div#detail_data .rotate_data").remove();
   // $("div#detail_data .title").remove();

    $("input#search_by_otn").on("keyup",function(){

        var search_data = $(this).val();

        var customer_id = $("input#customer_id").val();

        get_order_status_data(customer_id,search_data);

    });

    //get_order_status_data(customer_id)

</script>