<?php
echo Template::message();
$attributes = array('class' => '', 'id' => 'rol_limit','name'=>'rol_limit');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
                <div class="col-md-12 text-center radio_space">
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
                    <div class="clearfix"></div>
                </div>



            <!--------------------------------------Distributor------------------------------------------>
            <div class="col-md-12 distributore_form od_approval">
                <div class="row">
                    <div class="retailer_check_rol" id="retailer_check_rol" >
                         <div class="col-md-3 col-sm-6 tp_form">
                    <div class="form-group">
                        <label>Geo Level 3</label>
                        <select class="selectpicker" id="geo_level_rol">
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
                                <select class="selectpicker" id="geo_level_1">
                                    <option>Select Geo Location</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 tp_form">
                            <div class="form-group">
                                <label>Retailer Name</label>
                                <select class="selectpicker" name="fo_retailer_id" id="retailer_rol">
                                    <option value="0">Select Retailer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--------------------------------------End Retailer------------------------------------------>
                     <div class="distributor_check_rol" id="distributor_check_rol" style="display:none;">
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
                                <select class="selectpicker" id="distributor_rol" name="distributor_rol" data-live-search="true">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--------------------------------------Distributor------------------------------------------>
        </div>
    </div>
    <input class="login_customer_role" type="hidden" name="login_customer_role" id="login_customer_role" value="<?php echo $current_user->role_id; ?>" />
    <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $current_user->id; ?>" />
    <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $current_user->country_id; ?>" />

    <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />

    <div class="clearfix"></div>
</div>

<!--------------------------------------Start Filter------------------------------------------>
<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
            <div class="row">
                <div class="col-md-4_ tp_form">
                    <div class="form-group">
                        <label>Product SKU Name</label>
                        <select class="selectpicker" id="prod_sku" data-live-search="true" >
                            <option value="0">Product Name</option>
                            <?php
                            if(isset($product_sku) && !empty($product_sku))
                            {
                                foreach($product_sku as $k=> $prd_sku)
                                {
                                    ?>
                                    <option value="<?php echo $prd_sku['product_sku_country_id']; ?>" attr-name="<?php echo $prd_sku['product_sku_name']; ?>" attr-code="<?php echo $prd_sku['product_sku_code']; ?>" attr-pbg="<?php echo $prd_sku['product_type_label_name'] ?>"><?php echo $prd_sku['product_sku_name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4_ tp_form">
                    <div class="form-group">
                        <label>Units</label>
                        <select class="selectpicker" id="unit_id">
                            <option value="0">Units</option>
                            <option value="box">Box</option>
                            <option value="packages">Packages</option>
                            <option value="kg/ltr">Kg/Ltr</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="po_qty">ROL Quantity</label>
                        <input type="text" class="form-control" id="rol_qty" placeholder="">
                    </div>
                </div>
                <div class="plus_btn"><a href="javascript:void(0);" onclick="add_rol_row();"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!--------------------------------------End Filter------------------------------------------>

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
                <tr id="rol_head">
                    <th>Sr. No. <span class="rts_bordet"></span></th>
                    <th class="numeric">Action <span class="rts_bordet"></span></th>
                    <th>Distributor Code <span class="rts_bordet"></span></th>
                    <th class="numeric">Distributor Name <span class="rts_bordet"></span></th>
                    <th class="numeric">PBG <span class="rts_bordet"></span></th>
                    <th class="numeric">Product SKU Name <span class="rts_bordet"></span></th>
                    <th class="numeric">Units <span class="rts_bordet"></span></th>
                    <th class="numeric">ROL Quantity <span class="wl_sp">(Kg/Ltr)</span> <span class="rts_bordet"></span></th>
                    <th class="numeric">ROL Qty Kg/Ltr <div class="wl_sp">(Kg/Ltr)</div> <span class="rts_bordet"></span></th>
                </tr>
             <!--   <tr id="rol_dist" ></tr>
                <tr id="rol_ret" ></tr>-->
                </thead>
                <tbody id="rol_list">
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

