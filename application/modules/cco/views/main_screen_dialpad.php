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
                <img src="<?php echo Template::theme_url('images/watch_icon.png'); ?>" alt="" style="vertical-align: middle;"> <span>2 : 30 : 05</span>
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
                                <li class="<?php echo ($this->uri->segment(1)=='cco' && $this->uri->segment(2)=='farmer_dialpad') ? 'active' :'' ;?>"><a href="<?php echo base_url('/cco/farmer_dialpad') ?>">Farmers</a></li>
                                <li class=""><a href="#">Channel Partners</a></li>
                                <li><a href="#">Activity</a></li>
                                <li class=""><a href="#">Employee</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="emty-height"></div>
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
                                            <option value="<?php echo $campagainedata['campaign_id']; ?>"><?php echo $campagainedata['campaign_name']; ?></option>
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
                                <input type="text" class="form-control input-lg" placeholder="Search Farmer by Name" />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="button"><i class="glyphicon glyphicon-search"></i></button>
                               </span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="green-box">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><img src="<?php echo Template::theme_url('images/call-icon.svg'); ?>" alt=""></label>
                            <input type="text" class="form-control" name="Campaign" id="Campaign" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><img src="<?php echo Template::theme_url('images/call-icon.svg'); ?>" alt=""></label>
                            <input type="text" class="form-control" name="Campaign" id="Campaign" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label><img src="<?php echo Template::theme_url('images/call-icon.svg'); ?>" alt=""></label>
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
        <li><a href="#"><span class="btn_name">Recrding</span> <i class="missed-call_ii" aria-hidden="true"></i></a></li>
        <li><a href="#"><span class="btn_name">Total Calls</span> <i class="total_calls_ii" aria-hidden="true"></i></a></li>
        <li class="active"><a href="#"><span class="btn_name">Pending Calls</span> <i class="pending_calls_ii" aria-hidden="true"></i></a></li>
        <li><a href="#"><span class="btn_name">General Reminders</span> <i class="general_reminders_ii" aria-hidden="true"></i></a></li>
        <li><a href="#"><span class="btn_name">Break</span> <i class="break_ii" aria-hidden="true"></i></a></li>
        <li><a href="#"><span class="btn_name">Campaign Details</span> <i class="campaign_details_ii" aria-hidden="true"></i></a></li>
        <li><a href="#"><span class="btn_name">Call Bargin</span> <i class="call_bargin_ii" aria-hidden="true"></i></a></li>
    </ul>
</div>
<button type="button" class="btn btn-default campaign-details-btn"  data-toggle="modal" data-target="#myModal2">Campaign<br>Details</button>

<div class="chat-box">
    <div class="chat-header">
        <h5>CHAT <span>2</span></h5>
        <div class="clearfix"></div>
    </div>
    <div class="chat-content"></div>
    <div class="clearfix"></div>
</div>
<?php } ?>
<?php $this->load->view('campaign_details_popup'); ?>

