<?php
$segment_data = $this->uri->segment(2);
?>
<?php if (!$this->input->is_ajax_request()) { ?>
    <div id="cco_wrapper">
        <div class="cco_header">
            <div class="left_details pull-right">
                <!--<div class="blk_list">
                    <a href="#">
                        <img src="images/blacklist_icon.png" alt="" style="vertical-align: middle;">
                        <span>Add To Blacklist</span>
                    </a>
                    <div class="clearfix"></div>
                </div>-->
                <div class="time_space">
                    <img src="<?php echo Template::theme_url('images/watch_icon.png'); ?>" alt=""
                         style="vertical-align: middle;"> <span>2 : 30 : 05</span>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="content_in">
            <div class="col-md-12 count-height">
                <div class="row" style="padding-top: 15px; padding-bottom: 15px;">
                    <div class="white-box">
                        <div class="col-md-12 text-center sub_nave">
                            <div class="inn_sub_nave">
                                <ul>
                                    <li class="<?php echo ($this->uri->segment(1) == 'cco' && $this->uri->segment(2) == 'farmer_dialpad') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url('cco/farmer_dialpad') ?>">Farmers</a></li>
                                    <li class="<?php echo ($this->uri->segment(1) == 'cco' && $this->uri->segment(2) == 'farmer_dialpad') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url('cco/channel_partner_dialpad') ?>">Channel
                                            Partners</a></li>
                                    <li class="<?php echo ($this->uri->segment(1) == 'cco' && $this->uri->segment(2) == 'activity_dialpad') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url('cco/activity_dialpad') ?>">Activity</a></li>
                                    <li class="<?php echo ($this->uri->segment(1) == 'cco' && $this->uri->segment(2) == 'employee_dialpad') ? 'active' : ''; ?>">
                                        <a href="<?php echo base_url('cco/employee_dialpad') ?>">Employee</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="emty-height"></div>
                        <?php if ($this->uri->segment(2) == 'farmer_dialpad') { ?>

                            <div class="col-md-12 text-center tp_form inline-parent sbde-parent">
                                <div class="form-group">
                                    <label>Campaign</label>

                                    <div class="inln_fld_top">
                                        <select class="selectpicker" id="Campaign" name="Campaign">
                                            <option value="">Campaign Name</option>
                                            <?php
                                            if (isset($campagaine_data) && !empty($campagaine_data) && $campagaine_data != 0) {
                                                foreach ($campagaine_data as $k => $campagainedata) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $campagainedata['campaign_id']; ?>"><?php echo $campagainedata['campaign_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </select>

                                        <div class="clearfix"></div>
                                        <label id="Campaign-" class="error" for="Campaign"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Call Mode</label>

                                    <div class="inln_fld_top">
                                        <select class="selectpicker" id="Call Mode" name="Call Mode">
                                            <option value="">Call Mode</option>
                                            <option value="Manual">Manual</option>
                                            <option value="Auto">Auto</option>
                                        </select>

                                        <div class="clearfix"></div>
                                        <label id="to_date-error" class="error" for="Call Mode"></label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="custom-search-input">
                                    <div class="input-group col-md-12">
                                        <input type="text" class="form-control input-lg"
                                               placeholder="Search Farmer by Name"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="button"><i
                                            class="glyphicon glyphicon-search"></i></button>
                               </span>
                                    </div>
                                </div>
                            </div>

                        <?php } elseif ($this->uri->segment(2) == 'activity_dialpad') { ?>

                            <div class="col-md-12 text-center tp_form inline-parent sbde-parent">
                                <div class="form-group">
                                    <label>Activity</label>

                                    <div class="inln_fld_top">
                                        <select class="selectpicker" id="activity_type" name="activity_type">
                                            <option value="">Select Activity Type</option>
                                            <option value="planned_activity">Planned Activity</option>
                                            <option value="executed_activity">Executed Activity</option>
                                        </select>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Call Mode</label>

                                    <div class="inln_fld_top">
                                        <select class="selectpicker" id="Call Mode" name="Call Mode">
                                            <option value="">Call Mode</option>
                                            <option value="Manual">Manual</option>
                                            <option value="Auto">Auto</option>
                                        </select>

                                        <div class="clearfix"></div>
                                        <label id="to_date-error" class="error" for="Call Mode"></label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        <?php } elseif ($this->uri->segment(2) == 'channel_partner_dialpad') { ?>

                            <div class="col-md-12 text-center tp_form inline-parent sbde-parent">
                                <div class="form-group">
                                    <label>Channel Partner</label>

                                    <div class="inln_fld_top">
                                        <select class="selectpicker" id="channel_partner" name="channel_partner">
                                            <option value="">Select Channel Partner</option>
                                            <?php

                                            if ($channel_partner_data != 0 || !empty($channel_partner_data)) {
                                                foreach ($channel_partner_data as $data_key => $ch_prtner_data) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $ch_prtner_data["role_id"]; ?>"><?php echo $ch_prtner_data["customer_type_name"]; ?></option>

                                                    <?php
                                                }
                                            } ?>
                                        </select>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Call Mode</label>

                                    <div class="inln_fld_top">
                                        <select class="selectpicker" id="Call Mode" name="Call Mode">
                                            <option value="">Call Mode</option>
                                            <option value="Manual">Manual</option>
                                            <option value="Auto">Auto</option>
                                        </select>

                                        <div class="clearfix"></div>
                                        <label id="to_date-error" class="error" for="Call Mode"></label>
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                      <label>Call Mode</label>
                                    <div class="inln_fld_top">

                                        <input type="text" name="search_by_contact_no" class="form-control" id="search_by_contact_no"
                                               placeholder="Search Distributor By Contact No."/>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>-->
                                <div id="custom-search-input">
                                    <div class="input-group col-md-12">
                                        <input type="text" name="search_by_contact_no" id="search_by_contact_no" class="form-control input-lg"
                                               placeholder="Search Distributor By Contact No."/>
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="button"><i
                                            class="glyphicon glyphicon-search"></i></button>
                               </span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 text-center tp_form inline-parent sbde-parent" style="margin-top: 15px;">
                                <div class="form-group">
                                    <label>Campaign</label>
                                    <select class="selectpicker" id="Campaign" name="Campaign">

                                        <?php
                                        if (isset($campagaine_data) && !empty($campagaine_data) && $campagaine_data != 0) {
                                            foreach ($campagaine_data as $k => $campagainedata) {
                                                ?>
                                                <option
                                                    value="<?php echo $campagainedata['campaign_id']; ?>"><?php echo $campagainedata['campaign_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                    <div class="clearfix"></div>
                                    <label id="Campaign-" class="error" for="Campaign"></label>

                                </div>
                            </div>

                        <?php } elseif ($this->uri->segment(2) == 'employee_dialpad') { ?>

                            <div class="col-md-12 text-center tp_form inline-parent sbde-parent main_level_data">
                                <div class="form-group location_level_data">
                                    <label>Level 6</label>

                                    <div class="inln_fld_top">
                                        <select attr-level="6" class="selectpicker level_data" id="level_6_data"
                                                name="level_6_data">
                                            <option value="">Select Location</option>
                                            <?php

                                            if ($higest_level_data != 0 || !empty($higest_level_data)) {
                                                foreach ($higest_level_data as $data_key => $level_data) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $level_data["political_geo_id"]; ?>"><?php echo $level_data["political_geography_name"]; ?></option>

                                                    <?php
                                                }
                                            } ?>
                                        </select>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Call Mode</label>

                                    <div class="inln_fld_top">
                                        <select class="selectpicker" id="Call_Mode" name="Call_Mode">
                                            <option value="">Call Mode</option>
                                            <option value="Manual">Manual</option>
                                            <option value="Auto">Auto</option>
                                        </select>

                                        <div class="clearfix"></div>
                                        <label id="to_date-error" class="error" for="Call Mode"></label>
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                      <label>Call Mode</label>
                                    <div class="inln_fld_top">

                                        <input type="text" name="search_by_contact_no" class="form-control" id="search_by_contact_no"
                                               placeholder="Search Employee By Contact No."/>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>-->
                                <div id="custom-search-input">
                                    <div class="input-group col-md-12">
                                        <input type="text" name="search_by_contact_no" id="search_by_contact_no" class="form-control input-lg"
                                               placeholder="Search Distributor By Contact No."/>
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="button"><i
                                            class="glyphicon glyphicon-search"></i></button>
                               </span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>

                        <?php } ?>

                        <div class="clearfix"></div>
                    </div>
                    <div class="green-box">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><img src="<?php echo Template::theme_url('images/call-icon.svg'); ?>"
                                            alt=""></label>
                                <input type="text" class="form-control" name="Campaign" id="Campaign" placeholder="">

                                <input type="hidden" class="form-control" name="selected_action" id="selected_action"
                                       placeholder="" value="<?php echo $this->uri->segment(2); ?>"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><img src="<?php echo Template::theme_url('images/call-icon.svg'); ?>"
                                            alt=""></label>
                                <input type="text" class="form-control" name="Campaign" id="Campaign" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label><img src="<?php echo Template::theme_url('images/call-icon.svg'); ?>"
                                            alt=""></label>
                                <input type="text" class="form-control" name="Campaign" id="Campaign" placeholder="">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div id="customer_data">

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!--  <div class="col-md-12 footer_menu">
                  <ul>
                      <li><a href="#">Personal</a></li>
                      <li><a href="#">Education Detail</a></li>
                      <li><a href="#">Social Connection</a></li>
                      <li><a href="#">Financial Details</a></li>
                      <li><a href="#">Retailers</a></li>
                      <li><a href="#">Crop</a></li>
                      <li><a href="#">Products</a></li>
                      <li><a href="#">Business Details</a></li>
                  </ul>
              </div> -->
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="right_slide emly_right_slide">
        <ul>
            <li><a href="#"><span class="btn_name">Recrding</span> <i class="missed-call_ii" aria-hidden="true"></i></a>
            </li>
            <li><a href="#"><span class="btn_name">Total Calls</span> <i class="total_calls_ii" aria-hidden="true"></i></a>
            </li>
            <li class="active"><a href="#"><span class="btn_name">Pending Calls</span> <i class="pending_calls_ii"
                                                                                          aria-hidden="true"></i></a>
            </li>
            <li><a href="#" id="gen_reminder_popup"><span class="btn_name">General Reminders</span> <i class="general_reminders_ii"
                                                                               aria-hidden="true"></i></a></li>
            <li class="btn_call"><a href="#"><span class="btn_name">Dial Call</span> <i class="end_call_ii"
                                                                                        aria-hidden="true"></i></a></li>
            <li><a href="#"><span class="btn_name">Break</span> <i class="break_ii" aria-hidden="true"></i></a></li>
            <li><a href="#"><span class="btn_name">Campaign Details</span> <i class="campaign_details_ii"
                                                                              aria-hidden="true"></i></a></li>
            <li><a href="javascript:void(0);" onclick="get_missedcall_data();"><span
                        class="btn_name">Missed Calls</span> <i class="call_bargin_ii" aria-hidden="true"></i></a></li>
            <li><a href="javascript:void(0);" onclick="add_bargin_data();" data-toggle="modal"
                   data-target="#bargin_Modal"><span class="btn_name">Call Bargin</span> <i class="call_bargin_ii"
                                                                                            aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>
    <button type="button" class="btn btn-default campaign-details-btn" data-toggle="modal" data-target="#myModal2">
        Campaign<br>Details
    </button>

    <div class="chat-box">
        <div class="chat-header">
            <h5>CHAT <span>2</span></h5>

            <div class="clearfix"></div>
        </div>
        <div class="chat-content"></div>
        <div class="clearfix"></div>
    </div>

    <!-- Modal -->
    <div id="missedcall_Modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Missed Calls</h4>
                </div>
                <div class="modal-body">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <div id="popup_container" class="modal fade tr_modal" role="dialog"></div>

<?php } ?>
<?php $this->load->view('campaign_details_popup'); ?>
<?php $this->load->view('missedcall_popup'); ?>
<?php $this->load->view('calling_popup'); ?>
<?php $this->load->view('bargin_popup'); ?>
