<div class="col-md-12 full-height">
    <div class="row">
        <div class="col-md-12 text-center plng_sub_nave">
            <div class="inn_sub_nave">
                <ul>
                    <li class="active"><a href="#">Planning</a></li>
                    <li><a href="#">Approvel</a></li>
                    <li><a href="#">Execution</a></li>
                    <li><a href="#">Unplanned</a></li>
                    <li><a href="#">View</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="top_form planning_parent">
                <div class="row">
                    <div class="col-md-12">
                        <div class="default_box_white">
                            <div class="col-md-12 text-center tp_form inline-parent">
                                <div class="form-group">
                                    <label>Select Date<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="to_date" id="to_date" placeholder="" readonly="">
                                </div>

                                <div class="form-group">
                                    <label>Time</label>
                                    <!--<input  type="text" class="form-control input-append" data-format="hh:mm" id="timepicker1"  />-->
                                    <div class="bootstrap-timepicker bootstrap-timepicker-as">
                                        <input id="timepicker1" type="text" class="input-group-time form-control input-append">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="default_box_white">
                            <div class="col-md-12 tp_form mr_bot_group">
                                <div class="row form-group">
                                    <div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Select Activity Type</label></div>
                                    <div class="col-md-8 col-sm-8 cont_size_select mrg_bottom_30" >
                                        <select class="selectpicker" id="activity_type_id" name="activity_type_id" data-live-search="true">
                                            <option>Select Activity Type</option>
                                            <?php
                                            if(isset($activity_type) && !empty($activity_type)) {
                                                foreach ($activity_type as $key => $val) {
                                                    ?>
                                                    <option value="<?php echo $val['activity_type_country_id']; ?>" role="<?php echo $val['activity_type_code']; ?>"><?php echo $val['activity_type_country_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-3 col-sm-3 first_lb mrg_bottom_30"><label>Geo2</label></div>
                                    <div class="col-md-2 col-sm-8 cont_size_select mrg_bottom_30">
                                        <select class="selectpicker">
                                            <option>Select Cont</option>
                                            <option>Select1</option>
                                            <option>Select2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 col-sm-3 first_lb"><label>Geo3</label></div>
                                    <div class="col-md-2 col-sm-8 cont_size_select">
                                        <select class="selectpicker">
                                            <option>Select Cont</option>
                                            <option>Select1</option>
                                            <option>Select2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 col-sm-3 first_lb"><label>Geo4</label></div>
                                    <div class="col-md-2 col-sm-8 cont_size_select">
                                        <select class="selectpicker">
                                            <option>Select Cont</option>
                                            <option>Select1</option>
                                            <option>Select2</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-3 col-sm-3 first_lb"><label>Address</label></div>
                                    <div class="col-md-8 col-sm-8">
                                        <textarea class="form-control" rows="4" name="address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="default_box_grey">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5 tp_form inline-parent corp_text corp_text_align">
                                        <div class="form-group" style="margin-bottom: 0px;">
                                            <label>Corp</label>
                                            <select class="selectpicker"  multiple>
                                                <option>Select Cont</option>
                                                <option>Select1</option>
                                                <option>Select2</option>
                                            </select>
                                            <div class="plus_btn"><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">dsfdsf</div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="default_box_grey">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5 tp_form inline-parent corp_text corp_text_align">
                                        <div class="form-group" style="margin-bottom: 0px;">
                                            <label>Products</label>
                                            <select class="selectpicker"  multiple>
                                                <option>Select Cont</option>
                                                <option>Select1</option>
                                                <option>Select2</option>
                                            </select>
                                            <div class="plus_btn"><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">dsfdsf</div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="default_box_grey">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5 tp_form inline-parent corp_text corp_text_align">
                                        <div class="form-group" style="margin-bottom: 0px;">
                                            <label>Diseases</label>
                                            <select class="selectpicker"  multiple>
                                                <option>Select Cont</option>
                                                <option>Select1</option>
                                                <option>Select2</option>
                                            </select>
                                            <div class="plus_btn"><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">dsfdsf</div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="default_box_white">
                            <div class="col-md-12 plng_title"><h5>Key Farmer Details</h5></div>
                            <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                            <label>Key Farmer</label>
                                            <select class="selectpicker"  multiple>
                                                <option>Select Cont</option>
                                                <option>Select1</option>
                                                <option>Select2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 corp_text mrg_top_30">
                                        <div class="form-group frm_details text-center">
                                            <label>Mobile No.</label>
                                            <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                                            <div class="plus_btn"><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-md-offset-2" style="display: none;">
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                        <tr>
                                            <th style="padding: 4px 0;">
                                                Key Farmer
                                                <span class="rts_bordet"></span>
                                            </th>
                                            <th style="padding: 4px 0;">Mobile No.</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tbl_body_row">
                                        <tr>
                                            <td data-title="Sr. No.">xyz</td>
                                            <td data-title="Action" class="numeric">8140729034</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="default_box_grey">
                            <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label>Enter Praposed Attandaces Count</label>&nbsp;
                                    <input type="text" class="form-control" name="text" placeholder="" style="width: 80px;">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                        <div class="default_box_white">
                            <div class="col-md-12 plng_title"><h5>Demonstration</h5></div>
                            <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                            <label>Size Of Plot</label>
                                            <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 corp_text mrg_top_30">
                                        <div class="form-group frm_details text-center">
                                            <label>Spray Volume</label>
                                            <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-md-offset-2" style="display: none;">
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                        <tr>
                                            <th style="padding: 4px 0;">
                                                Size Of Plot
                                                <span class="rts_bordet"></span>
                                            </th>
                                            <th style="padding: 4px 0;">Spray Volume</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tbl_body_row">
                                        <tr>
                                            <td data-title="Sr. No.">xyz</td>
                                            <td data-title="Action" class="numeric">xyz</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="default_box_white">
                            <div class="col-md-12 plng_title"><h5>Discussion Point</h5></div>
                            <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                            <label>Point Of Discussion</label>
                                            <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 corp_text mrg_top_30">
                                        <div class="form-group frm_details text-center">
                                            <label>Set Alert </label>
                                            <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                                            <div class="plus_btn"><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-md-offset-2" style="display: none;">
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                        <tr>
                                            <th style="padding: 4px 0;">
                                                Point Of Discussion
                                                <span class="rts_bordet"></span>
                                            </th>
                                            <th style="padding: 4px 0;">Set Alert</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tbl_body_row">
                                        <tr>
                                            <td data-title="Sr. No.">xyz</td>
                                            <td data-title="Action" class="numeric">xyz</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                        <div class="default_box_white">
                            <div class="col-md-12 plng_title"><h5>Products Sample</h5></div>
                            <div class="col-md-10 col-md-offset-1 text-center tp_form inline-parent">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group frm_details text-center" style="margin-bottom: 0px;">
                                            <label>Products Sample</label>
                                            <select class="selectpicker"  multiple>
                                                <option>Select Cont</option>
                                                <option>Select1</option>
                                                <option>Select2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 corp_text mrg_top_30">
                                        <div class="form-group frm_details text-center">
                                            <label>Qty.</label>
                                            <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                                            <div class="plus_btn"><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-md-offset-2" style="display: none;">
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                        <tr>
                                            <th style="padding: 4px 0;">
                                                Products Sample
                                                <span class="rts_bordet"></span>
                                            </th>
                                            <th style="padding: 4px 0;">Qty.</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tbl_body_row">
                                        <tr>
                                            <td data-title="Sr. No.">xyz</td>
                                            <td data-title="Action" class="numeric">8140729034</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="material_request">
                            <h6>Material Request</h6>
                            <div class="material_request_inn">
                                <table class="request_table tp_form">
                                    <thead>
                                    <tr>
                                        <th>
                                            <h6>Product</h6>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <select class="selectpicker">
                                                    <option>Select Name</option>
                                                    <option>Select Name</option>
                                                    <option>Select Name</option>
                                                </select>
                                            </div>
                                            <div class="form-group corp_text text-center">
                                                <label>Qty.</label>
                                                <input type="text" class="form-control" name="qty" placeholder="" style="width: 80px;">
                                                <div class="plus_btn"  style="margin-top: -3px;"><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                                            </div>
                                        </th>
                                        <th>
                                            <h6>Promo Materials</h6>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <select class="selectpicker">
                                                    <option>Select Name</option>
                                                    <option>Select Name</option>
                                                    <option>Select Name</option>
                                                </select>
                                            </div>
                                            <div class="form-group corp_text text-center">
                                                <label>Qty.</label>
                                                <input type="text" class="form-control" name="qty" placeholder="" style="width: 80px;">
                                                <div class="plus_btn"  style="margin-top: -3px;"><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="product_name">Product Name <span>xyz</span></div>
                                            <div class="qty_space">Qty.<span>100</span></div>
                                        </td>
                                        <td>
                                            <div class="product_name">Product Name <span>xyz</span></div>
                                            <div class="qty_space">Qty.<span>100</span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product_name">Product Name <span>xyz</span></div>
                                            <div class="qty_space">Qty.<span>100</span></div>
                                        </td>
                                        <td>
                                            <div class="product_name">Product Name <span>xyz</span></div>
                                            <div class="qty_space">Qty.<span>100</span></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product_name">Product Name <span>xyz</span></div>
                                            <div class="qty_space">Qty.<span>100</span></div>
                                        </td>
                                        <td>
                                            <div class="product_name">Product Name <span>xyz</span></div>
                                            <div class="qty_space">Qty.<span>100</span></div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="default_box_grey">
                            <div class="col-md-12 tp_form inline-parent">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <label>Visual Aid</label>
                                    <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="default_box_grey">
                            <div class="col-md-12 tp_form inline-parent">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <label>Joint Visit</label>
                                    <input type="text" class="form-control" name="to_date" id="to_date" placeholder="">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 table_bottom pln_table_bottom">
                <div class="row">
                    <div class="save_btn">
                        <button type="button" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-primary">Cancel</button>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="col-md-3 right_planning">
            <div class="top_form planning_parent" style="padding: 10px 5px 10px 5px;">
                <div class="panel act_panel with-nav-tabs panel-default">
                    <div class="panel-heading">
                        <ul class="activity_list">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Incomplete Entry</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Approved</a></li>
                            <li><a href="#tab3default" data-toggle="tab">Rejected</a></li>
                            <li><a href="#tab4default" data-toggle="tab">Pending</a>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1default">
                                <div class="calendar_space">
                                    Calendar Here
                                    <div class="clearfix"></div>
                                </div>
                                <div class="add_new_space text-right save_btn">
                                    <button type="button" class="btn btn-primary">Add New</button>
                                </div>
                                <div id="accordion" class="as_accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <ul class="acc_list">
                                                <li>
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        1 <img src="<?php echo Template::theme_url('images/list_arrow.png')?>" alt="" style="vertical-align: middle;">
                                                    </a>
                                                </li>
                                                <li>Activity Name 1</li>
                                                <li>2:38 PM</li>
                                                <li>Geo 3</li>
                                                <li>Geo 4</li>
                                            </ul>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <ul class="acc_list">
                                                <li>
                                                    &nbsp;
                                                </li>
                                                <li>Activity Name 1</li>
                                                <li>2:38 PM</li>
                                                <li>Geo 3</li>
                                                <li>Geo 4</li>
                                            </ul>
                                            <ul class="acc_list">
                                                <li>
                                                    &nbsp;
                                                </li>
                                                <li>Activity Name 1</li>
                                                <li>2:38 PM</li>
                                                <li>Geo 3</li>
                                                <li>Geo 4</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <ul class="acc_list">
                                                <li>
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                                        2 <img src="<?php echo Template::theme_url('images/list_arrow.png')?>" alt="" style="vertical-align: middle;">
                                                    </a>
                                                </li>
                                                <li>Activity Name 1</li>
                                                <li>2:38 PM</li>
                                                <li>Geo 3</li>
                                                <li>Geo 4</li>
                                            </ul>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <ul class="acc_list">
                                                <li>
                                                    &nbsp;
                                                </li>
                                                <li>Activity Name 1</li>
                                                <li>2:38 PM</li>
                                                <li>Geo 3</li>
                                                <li>Geo 4</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="tab-pane fade" id="tab2default">Default 2</div>
                            <div class="tab-pane fade" id="tab3default">Default 3</div>
                            <div class="tab-pane fade" id="tab4default">Default 4</div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
</div>