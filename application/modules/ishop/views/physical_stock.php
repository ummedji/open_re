<?php
$attributes = array('class' => '', 'id' => 'add_physical_stock','name'=>'add_physical_stock');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>
<!--------------------------------------Filter1-------------------------------------------------->
<?php if (!$this->input->is_ajax_request()) { ?>
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
                            <li><a href="<?php echo base_url('/ishop/ishop_sales') ?>">Sales</a></li>
                            <li class="active"><a href="<?php echo base_url('/ishop/physical_stock') ?>">Physical Stock</a></li>
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
                        <div class="col-md-3 col-sm-6 tp_form">
                            <div class="form-group">
                                <label>Month</label>
                                <input type="text" class="form-control" name="stock_month" id="stock_month" placeholder="">
                                <div class="cal_icon" style="position: absolute; right: 23px; bottom: 16px; top: auto;">
                                    <a href="#">
                                        <i class="fa fa-calendar" aria-hidden="true">
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="retailer_checked" id="retailer_checked" >
                            <div class="col-md-3 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Geo Level 3</label>
                                    <select class="selectpicker" name="geo_level" id="geo_level">
                                        <option>Select Geo Location</option>
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
                                    <label>Geo Level 2</label>
                                    <select class="selectpicker" name="geo_level_1" id="geo_level_1">
                                        <option>Select Geo Location</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Retailer Name</label>
                                    <select class="selectpicker" name="fo_retailer_id" id="retailer_phystok">
                                        <option value="0">Select Retailer</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="distributor_checked" id="distributor_checked" style="display:none;">

                            <div class="col-md-3 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Geo Level</label>
                                    <select class="selectpicker distributor_geo_level " id="distributor_geo_level" name="distributor_geo_level" data-live-search="true">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 tp_form">

                                <div class="form-group">
                                    <label>Distributor Name</label>
                                    <select class="selectpicker" id="distributor_phystok" name="distributor_phystok" data-live-search="true">
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>

                <?php
            }
            else{
                ?>

                    <!--<div class="col-md-2 col-md-offset-4 text-center tp_form">-->
                    <div class="col-md-4 col-md-offset-4 tp_form text-center_form" >
                        <div class="form-group">
                            <label>Month</label>
                            <input type="text" class="form-control" name="stock_month" id="stock_month" placeholder="">
                            <div class="cal_icon">
                                <a href="#">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>

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
                        <label>Product Sku</label>
                        <select class="selectpicker" name="phy_prod_sku" id="phy_prod_sku" data-live-search="true">
                            <option value="0">Product Name</option>
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
                        <label>Unit</label>
                        <select class="selectpicker" name="sec_sel_unit" id="sec_sel_unit">
                            <option value="0">Units</option>
                            <option value="box">Box</option>
                            <option value="packages">Packages</option>
                            <option value="kg/ltr">Kg/Ltr</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Quantity</label>
                        <input type="text" class="form-control" name="phy_qty" id="phy_qty" placeholder="">
                    </div>
                    <div class="wieght_sp toggle_wieght_sp">Kg/Ltr</div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php }?>
<!--------------------------------------Table-------------------------------------------------->
<div class="phy_stock_container">
<?php
echo theme_view('common/middle');
?>
</div>

<!--------------------------------------Save & Upload Data-------------------------------------------------->
<?php echo form_close(); ?>
<div class="clearfix"></div>
