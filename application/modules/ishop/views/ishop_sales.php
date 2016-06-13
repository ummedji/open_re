<?php

$attributes = array('class' => '', 'id' => 'add_ishop_sales','name'=>'add_ishop_sales');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>
<!--------------------------------------Filter1-------------------------------------------------->
<div class="col-md-12 od_approval">
    <div class="top_form">
        <div class="row">
            <?php
            // testdata($current_user->role_id);
            if($current_user->role_id == 8)
            {
                ?>
                <div class="col-md-12 text-center sub_nave">
                    <div class="inn_sub_nave">
                        <ul>
                            <li class="active"><a href="<?php echo base_url('/ishop/ishop_sales') ?>">Sales</a></li>
                            <li><a href="<?php echo base_url('/ishop/physical_stock') ?>">Physical Stock</a></li>
                            <li><a href="<?php echo base_url('/ishop/sales_view') ?>">View</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-12 text-center radio_space">
                    <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="retailer" value="retailer" checked>
                        <label for="radio1">Retailer</label>
                    </div>
                    <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="distributor" value="distributor">
                        <label for="radio2">Distributor</label>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 distributore_form od_approval">
                    <div class="row">
                        <div class="retailer_checked_sales fl_calender_i" id="retailer_checked_sales" >
                            <div class="col-md-3 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Month<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="stock_month" id="stock_month" placeholder="">
                                    <div class="cal_icon" style="position: absolute; right: 23px; bottom: 16px; top: auto;">
                                        <a href="#">
                                            <i class="fa fa-calendar" aria-hidden="true">
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Geo Level 3<span style="color: red">*</span></label>
                                    <select class="selectpicker" name="geo_level_0" id="geo_level_0">
                                        <option value="">Select Geo Location</option>
                                        <?php
                                        if(isset($geo_data) && !empty($geo_data))
                                        {
                                            foreach($geo_data as $k=> $geo_val)
                                            {
                                                ?>
                                                <option value="<?php echo $geo_val['political_geo_id']; ?>" attr-name="<?php echo $geo_val['political_geography_name']; ?>"><?php echo $geo_val['political_geography_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Geo Level 2<span style="color: red">*</span></label>
                                    <select class="selectpicker" name="geo_level_1" id="geo_level_1">
                                        <option value="">Select Geo Location</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Retailer Name<span style="color: red">*</span></label>
                                    <select class="selectpicker" name="fo_retailer_id" id="retailer_sales">
                                        <option value="">Select Retailer</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="distributor_checked_sales" id="distributor_checked_sales" style="display:none;">
                            <div class="col-md-10 col-md-offset-1 tp_form">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 tp_form">
                                        <div class="form-group">
                                            <label>Geo Level<span style="color: red">*</span></label>
                                            <select class="selectpicker distributor_geo_level " id="distributor_geo_level" name="distributor_geo_level" data-live-search="true">
                                                <option value="">Select Geo Level</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-6 tp_form">
                                        <div class="form-group">
                                            <label>Distributor Name<span style="color: red">*</span></label>
                                            <select class="selectpicker" id="distributor_sales" name="distributor_sales" data-live-search="true">
                                                <option value="">Select Distributor</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-6 tp_form">
                                        <div class="form-group">
                                            <label>Retailer Name<span style="color: red">*</span></label>
                                            <select class="selectpicker" id="retailer_id" name="retailer_id" data-live-search="true">
                                                <option value="">Select Retailer</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 tp_form">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 tp_form">
                                        <div class="form-group">
                                            <label for="invoice_no">Invoice No.<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="invoice_no" id="invoice_no" placeholder="" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 tp_form">
                                        <div class="form-group">
                                            <label for="invoice_date">Invoice Date<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="invoice_date" id="invoice_date" placeholder="" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 tp_form">
                                        <div class="form-group">
                                            <label for="order_traking_no">Order Tracking No.</label>
                                            <input type="text" class="form-control" name="order_tracking_no" id="order_traking_no" placeholder="" style="width: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 tp_form">
                                        <div class="form-group">
                                            <label for="po_no">PO No.</label>
                                            <input type="text" class="form-control" name="PO_no" id="po_no" placeholder="" style="width: 100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
                <?php
            }
            ?>
        </div>
    </div>

    <input class="login_customer_role" type="hidden" name="login_customer_role" id="login_customer_role" value="<?php echo $current_user->role_id; ?>" />
    <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $current_user->id; ?>" />
    <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $current_user->country_id; ?>" />

    <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />

    <div class="clearfix"></div>
</div>
<!--------------------------------------Filter2-------------------------------------------------->
<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
            <div class="row">
                <div class="col-md-4_ tp_form">
                    <div class="form-group">
                        <label>Product Sku<span style="color: red">*</span></label>
                        <select class="selectpicker" name="sales_prod_sku" id="sales_prod_sku" data-live-search="true">
                            <option value="">Product Name</option>
                            <?php
                            if(isset($product_sku) && !empty($product_sku))
                            {
                                foreach($product_sku as $k=> $prd_sku)
                                {
                                    ?>
                                    <option value="<?php echo $prd_sku['product_sku_country_id']; ?>" attr-name="<?php echo $prd_sku['product_sku_name']; ?>" attr-code="<?php echo $prd_sku['product_sku_code']; ?>"><?php echo $prd_sku['product_sku_name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label>Unit<span style="color: red">*</span></label>
                        <select class="selectpicker" name="sec_sel_unit" id="sec_sel_unit">
                            <option value="">Units</option>
                            <option value="box">Box</option>
                            <option value="packages">Packages</option>
                            <option value="kg/ltr">Kg/Ltr</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Quantity<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="sales_qty" id="sales_qty" placeholder="">
                    </div>
                    <div class="wieght_sp toggle_wieght_sp">Kg/Ltr</div>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Amount<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="amt" id="amt" placeholder="">
                    </div>
                </div>
                <div class="plus_btn"><a href="#" id="add_sales_stock_row"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--------------------------------------Table-------------------------------------------------->
<div class="col-md-12">
    <div class="row">
        <div class="zoom_space">
            <ul>
                <li><a href="#"><img src="<?php echo Template::theme_url('images/list_icon.png'); ?>" alt=""></a></li>
                <li><a href="#"><img src="<?php echo Template::theme_url('images/zooming_icon.png'); ?>" alt=""></a></li>
            </ul>
        </div>
        <div id="no-more-tables">
            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                <thead class="cf">
                <tr>
                    <th>Sr. No. <span class="rts_bordet"></span></th>
                    <th class="numeric">Action</th>
                   <!-- <th>Month Year <span class="rts_bordet"></span></th>-->
                    <th>Product SKU Code <span class="rts_bordet"></span></th>
                    <th class="numeric">Product SKU Name <span class="rts_bordet"></span></th>
                    <th>Unit <span class="rts_bordet"></span></th>
                    <th class="numeric">Quantity <span class="rts_bordet"></span></th>
                    <th class="numeric">Qty Kg/Ltr<div class="wl_sp">(Kg/Ltr)</div> <span class="rts_bordet"></span></th>
                    <th class="numeric">Amount <span class="rts_bordet"></span></th>
                </tr>
                </thead>
                <tbody id="sales_stock">
                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<!--------------------------------------Save & Upload Data-------------------------------------------------->
<div class="col-md-12 table_bottom">
    <div class="row">
        <div class="col-md-3 save_btn">
            <!--  <div><input type="submit" class="btn btn-primary" value="Save" /></div>-->
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        <!--<div class="col-md-9">
            <div class="row">
                <div class="col-md-3 upload_file_space">
                    <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-primary btn-file">
                                            Browse <input type="file" multiple>
                                        </span>
                                    </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-9 chech_data"><button type="button" class="btn btn-default">Check Data</button> <button type="button" class="btn btn-default">Download Templates</button></div>
            </div>
        </div>-->
    </div>
</div>
<?php echo form_close(); ?>
<div class="clearfix"></div>


<div class="col-md-12 table_bottom upload_sales_data" style="display: none">

    <div class="row">
        <div class="col-md-3 save_btn"></div>
      <!--  <div class="col-md-3 save_btn"><button type="button" class="btn btn-primary">Save</button></div> -->
     <?php
         $attributes = array('class' => '', 'id' => 'upload_secondary_sales_data','name'=>'upload_secondary_sales_data');
         echo form_open_multipart('',$attributes);
     ?>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-1 upload_text">Upload: </div>
                <div class="col-md-3 upload_file_space">
                    <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Browse <input type="file" name="upload_file_data" id="upload_file_data" />
                    </span>
                </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <?php
                   if($_SERVER['SERVER_NAME'] == "localhost"){
                       $folder = "open_re/trunk";
                   }
                   elseif($_SERVER['SERVER_NAME'] == "webcluesglobal.com"){
                       $folder = "qa/re";
                   }

                ?>
                    <div class="col-md-8 chech_data">

                        <button type="submit" class="btn btn-default">Check Data</button>
                  <?php  if($current_user->role_id == 8){ ?>

                                <a id="distributor_xl" href="javascript:void(0);" onclick='window.open("http://<?php echo $_SERVER['SERVER_NAME']; ?>/<?php echo $folder; ?>/public/assets/uploads/Uploads/secondary_sales/secondarysales_data.xlsx","_blank" );' class="btn btn-default distributor_xl">Download Templates</a>

                        <?php }elseif($current_user->role_id == 9){ ?>

                                     <a id="distributor_xl" href="javascript:void(0);" onclick='window.open("http://<?php echo $_SERVER['SERVER_NAME']; ?>/<?php echo $folder; ?>/public/assets/uploads/Uploads/secondary_sales/secondarysales_distributor.xlsx","_blank" );' class="btn btn-default distributor_xl">Download Templates</a>

                        <?php } ?>



                    </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>