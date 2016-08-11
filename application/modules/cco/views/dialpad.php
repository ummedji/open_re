<?php
$segment_data = $this->uri->segment(2);
?>
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
                <div id="no-more-tables">
                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                            <th><a href="javascript: void(0);">Sr. No.</a>
                                <span class="rts_bordet"></span>
                            </th>
                            <th><a href="javascript: void(0);">Action</a>
                                <span class="rts_bordet"></span>
                            </th>
                            <th><a href="javascript: void(0);">Retailer Code</a>
                                <span class="rts_bordet"></span>
                            </th>
                            <th class="numeric"><a href="javascript: void(0);">Retailer Name</a>
                                <span class="rts_bordet"></span>
                            </th>
                            <th class="numeric"><a href="javascript: void(0);">PBG</a>
                                <span class="rts_bordet"></span>
                            </th>
                            <th class="numeric"><a href="javascript: void(0);">Product SKU Name</a>
                                <span class="rts_bordet"></span>
                            </th>
                            <th class="numeric"><a href="javascript: void(0);">Units</a>
                                <span class="rts_bordet"></span>
                            </th>
                            <th class="numeric"><a href="javascript: void(0);">ROL Quantity</a>
                                <span class="rts_bordet"></span>
                            </th>
                            <th class="numeric">
                                <a href="javascript: void(0);">ROL Qty Kg/Ltr</a>
                                <span class="rts_bordet"></span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="dialpad_main_screen">

                        <tr>
                            <td data-title="Sr. No.">
                                <div>
                                    <a href="javascript: void(0);" attr-prdid="1">1</a>
                                </div>
                            </td>
                            <td data-title="Action" class="numeric">
                                <div class="edit_i" prdid="66"><a href="javascript: void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                                <div class="delete_i" prdid="66"><a href="javascript: void(0);"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                            </td>
                            <td data-title="Retailer Code">
                                0000064                                        </td>
                            <td data-title="Retailer Name">
                                abc11                                        </td>
                            <td data-title="PBG">
                                A                                        </td>
                            <td data-title="Product SKU Name">
                                B3                                        </td>
                            <td data-title="Units">
                                <div class="prd_66"><span class="prd_sku" style="display:none;">3</span></div><div class="units_66"><span class="units">Kg/Ltr</span></div>                                        </td>
                            <td data-title="ROL Quantity">
                                <div class="rol_quantity_66"><span class="rol_quantity">1234.00</span></div>                                        </td>
                            <td data-title="ROL Qty Kg/Ltr">
                                <div class="rol_quantity_kg_ltr_66"><span class="rol_quantity_kg_ltr">1234.00</span></div>                                        </td>
                        </tr>

                        </tbody>
                    </table>
                    <div class="clearfix"></div>
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
<button class="btn btn-default campaign-details-btn">Campaign<br>Details</button>
<div class="chat-box">
    <div class="chat-header">
        <h5>CHAT <span>2</span></h5>
        <div class="clearfix"></div>
    </div>
    <div class="chat-content"></div>
    <div class="clearfix"></div>
</div>