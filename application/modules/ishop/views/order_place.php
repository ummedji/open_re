<?php
$attributes = array('class' => '', 'id' => 'order_place','name'=>'order_place', 'autocomplete'=>'off');
echo form_open('',$attributes); ?>
<!--------------------------------------Filter1-------------------------------------------------->

<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_place') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_place') ?>">Order Place</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='ishop' && $this->uri->segment(2)=='order_status') ? 'active' :'' ;?>"><a href="<?php echo base_url('/ishop/order_status') ?>">Order Status</a></li>
                        <?php 
                        if($login_customer_type == 9 || $login_customer_type == 10){
                        ?>
                            <li><a href="<?php echo base_url('/ishop/po_acknowledgement') ?>">PO Acknowledgment</a></li>
                        <?php } ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            <?php 
                if($login_customer_type == 7){
            ?>
            <div class="col-md-12 text-center radio_space">
                    <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="radio2" value="distributor" checked="checked" />
                        <label for="radio2">Distributor</label>
                    </div>
                    <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="radio1" value="retailer" />
                        <label for="radio1">Retailer</label>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            
                <div class="col-md-6 col-md-offset-3 distributore_form distributor_data">
                    <div class="row">
                        
                        <div class="col-md-6 col-sm-6 tp_form">
                    
                            <div class="form-group">
                            <label>Geo L1<span style="color: red">*</span></label>
                            <select class="selectpicker distributor_geo_level_1_data" id="distributor_geo_level_1_data" name="geo_level_1_data" data-live-search="true" required>
                                <option value="">Select Geo Level</option>
                                <?php
                                if(isset($geo_level_data) && !empty($geo_level_data))
                                {
                                    foreach($geo_level_data as $key=>$val_geo_level_data)
                                    {
                                        ?>
                                        <option value="<?php echo $val_geo_level_data['political_geo_id']; ?>"><?php echo $val_geo_level_data['political_geography_name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                    </div>
                        
                        <div class="col-md-6 col-sm-6 tp_form">
                            <div class="form-group">
                                <div class="form-group">
                                <label>Distributor Name<span style="color: red">*</span></label>
                                <select class="selectpicker" id="distributor_distributor_id" name="distributor_id" data-live-search="true" required>
                                    <option value="">Select Distributor</option>
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1 distributore_form retailer_data_checked" style="display:none;">
                <div class="row">
                    
                     <div class="col-md-3 col-sm-6 tp_form">

                             <div class="form-group">
                                <label>Geo L2<span style="color: red">*</span></label>
                                <select class="selectpicker retailer_geo_level_1_data"  id="retailer_geo_level_1_data" name="retailer_geo_level_1_data" data-live-search="true" required>

                                </select>

                            </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6 tp_form">
                    
                        <div class="form-group">
                            <label>Geo L1<span style="color: red">*</span></label>
                            <select class="selectpicker retailer_geo_level_2_data" id="retailer_geo_level_2_data" name="retailer_geo_level_2_data" data-live-search="true" required>

                            </select>
                    
                        </div>
                    </div>
                
                    
                    <div class="col-md-3 col-sm-4 tp_form">
                        <div class="form-group">
                                <label>Retailer Name<span style="color: red">*</span></label>
                                <select class="selectpicker" id="retailer_id" name="retailer_id" data-live-search="true" onchange="get_distributors('retailer')" required>
                                </select>
                            </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-4 tp_form">
                        <div class="form-group">
                                <label>Distributor Name<span style="color: red">*</span></label>
                                <select class="selectpicker" id="retailer_distributor_id" name="retailer_distributor_id" data-live-search="true" required>
                                    
                                </select>
                            </div>
                    </div>
                </div>
            </div>
            
        <?php }
        else if($login_customer_type == 9){
        ?>
            
            <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 15px;">
                <!--<div class="col-md-6 col-sm-6 tp_form">-->
                    <div class="form-group">
                        <label for="invoice_date">PO NO.</label>
                        <input type="text" name="po_no" class="form-control" id="po_no" placeholder="">
                    </div>
                <!--</div>-->
                    
                <div class="clearfix"></div>
            </div>
            
        <?php }else if($login_customer_type == 10){ ?>
            
            
            <div class="col-md-12 distributor_data" style="margin-top: 10px;">
                    <div class="row">

                        <div class="col-md-12 text-center tp_form">
                            <div class="form-group">
                                <div class="form-group">
                                <label>Distributor Name<span style="color: red">*</span></label>
                                <select class="selectpicker" id="retailer_distributor_id" name="distributor_id" data-live-search="true" required>
                                    <option value="">Select Distributor Name</option>
                                    <?php
                                    if(isset($distributor) && !empty($distributor))
                                    {
                                        foreach($distributor as $key=>$val_distributor)
                                        {
                                            ?>
                                            <option value="<?php echo $val_distributor['id']; ?>"><?php echo $val_distributor['display_name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php } ?>
            
            
            <?php 
                if($login_customer_type == 8){
            ?>
                <div class="col-md-12 text-center radio_space">
                    
                     <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="farmer" value="farmer" checked="checked"/>
                        <label for="farmer">Farmer</label>
                    </div>
                    
                     <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="retailer" value="retailer" />
                        <label for="retailer">Retailer</label>
                    </div>
                    
                    <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="distributor" value="distributor" />
                        <label for="distributor">Distributor</label>
                    </div>
                   
                    <div class="clearfix"></div>
                </div>
            
            <div class="farmer_checked" id="farmer_checked">
            <div class="col-md-12 text-center tp_form inline-parent">
                <div class="form-group">
                    <div class="form-group">
                        <label>Date<span style="color: red">*</span></label>
                        <div class="inln_fld_top text-left">
                            <input type="text" name="order_date" class="order_date form-control" id="order_date"  required/>
                            <div class="clearfix"></div>
                            <label id="order_date-error" class="error" for="order_date"></label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Geo L2<span style="color: red">*</span></label>
                    <div class="inln_fld_top text-left">
                        <select class="selectpicker geo_level_1_data" id="farmer_geo_level_1_data" name="farmer_geo_level_1_data" data-live-search="true" required>
                            <option value="">Select Geo Level</option>
                            <?php
                            if(isset($geo_level_data) && !empty($geo_level_data))
                            {
                                foreach($geo_level_data as $key=>$val_geo_level_data)
                                {
                                    ?>
                                    <option value="<?php echo $val_geo_level_data['political_geo_id']; ?>"><?php echo $val_geo_level_data['political_geography_name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <div class="clearfix"></div>
                        <label id="farmer_geo_level_1_data-error" class="error" for="farmer_geo_level_1_data"></label>
                    </div>

                </div>
                <div class="form-group">
                    <label>Geo L1<span style="color: red">*</span></label>
                    <div class="inln_fld_top text-left">
                        <select class="selectpicker geo_level_2_data" class="" id="farmer_geo_level_2_data" name="farmer_geo_level_2_data" data-live-search="true" required >

                        </select>
                        <div class="clearfix"></div>
                        <label id="farmer_geo_level_2_data-error" class="error" for="farmer_geo_level_2_data"></label>
                    </div>


                </div>
            </div>
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>Farmer Name<span style="color: red">*</span></label>
                        <div class="inln_fld_top text-left">
                            <select class="selectpicker" id="farmer_data" name="farmer_data" data-live-search="true" required>

                            </select>
                            <div class="clearfix"></div>
                            <label id="farmer_data-error" class="error" for="farmer_data"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" name="mobile_num" class="mobile_num form-control" id="mobile_num" />
                    </div>
                    <div class="form-group">
                        <label>Retailer Name<span style="color: red">*</span></label>
                        <div class="inln_fld_top text-left">
                            <select class="selectpicker retailer_data" id="farmer_retailer_data" name="farmer_retailer_data" data-live-search="true" required >

                            </select>
                            <div class="clearfix"></div>
                            <label id="farmer_retailer_data-error" class="error" for="farmer_retailer_data"></label>
                        </div>

                    </div>
                </div>

            
            </div>
            
            <div class="retailer_checked " id="retailer_checked" style="display:none;">
                
                <div class="col-md-12 tp_form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group fulle_wd">
                                <label>Geo L3<span style="color: red">*</span></label>
                                <select class="selectpicker retailer_geo_level_1_data" id="retailer_geo_level_1_data" name="geo_level_1_data" data-live-search="true" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group fulle_wd">
                                <label>Geo L2<span style="color: red">*</span></label>
                                <select class="selectpicker retailer_geo_level_2_data" id="retailer_geo_level_2_data" name="geo_level_2_data" data-live-search="true" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group fulle_wd">
                                <label>Retailer Name<span style="color: red">*</span></label>
                                <select class="selectpicker retailer_data" id="retailer_data" name="fo_retailer_data" data-live-search="true" required >
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group fulle_wd">
                                <label>Distributor Name<span style="color: red">*</span></label>
                                <select class="selectpicker" id="distributor_data" name="distributor_data" data-live-search="true" required >
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="distributor_checked" id="distributor_checked" style="display:none;">
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>Geo L2<span style="color: red">*</span></label>
                        <select class="selectpicker distributor_geo_level_1_data" id="distributor_geo_level_1_data" name="distributor_geo_level_1_data" data-live-search="true" required >
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Geo L1<span style="color: red">*</span></label>
                        <select class="selectpicker distributor_geo_level_2_data"  id="distributor_geo_level_2_data" name="distributor_geo_level_2_data" data-live-search="true" required >
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Distributor Name<span style="color: red">*</span></label>
                        <select class="selectpicker" id="fo_distributor_data" name="fo_distributor_data" data-live-search="true" required >
                        </select>
                    </div>
                </div>
            </div>
            
            
            <?php } ?>
            
            
            
            <input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $login_customer_type; ?>" /> 
            <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $login_customer_id; ?>" /> 
            <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $login_customer_countryid; ?>" /> 
            
            <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" /> 
            
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<!--------------------------------------Filter2-------------------------------------------------->
<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
            <div class="row">
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label>Product Sku Name<span style="color: red">*</span></label>
                        <div class="inln_fld">
                            <select class="selectpicker lva" id="prod_sku" data-live-search="true" name="prod_sku" required>
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
                            <div class="clearfix"></div>
                            <label id="prod_sku-error" class="error" for="prod_sku"></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Units<span style="color: red">*</span></label>
                        <div class="inln_fld">
                            <select class="selectpicker lva" id="units" data-live-search="true" name="units" required>
                                <option value="">Select Unit</option>
                                <option value="box">Box</option>
                                <option value="packages">Packages</option>
                                <option value="kg/ltr">Kg/Ltr</option>
                            </select>
                            <div class="clearfix"></div>
                            <label id="units-error" class="error" for="units"></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Quantity<span style="color: red">*</span></label>
                        <div class="inln_fld">
                           <input type="text" class="form-control allownumericwithdecimal lva" name="quantity" id="quantity" placeholder="" required>
                            <div class="clearfix"></div>
                            <label id="quantity-error" class="error" for="quantity"></label>
                        </div>
                    </div>

                </div>
                <div class="plus_btn"><a title="Add Product" href="javascript:void(0);" id="order_place_add_row"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--------------------------------------Table-------------------------------------------------->
<div class="col-md-12 ad_mr_top">
    <div class="row">

        <div class="zoom_space">
            <ul>
                <li><a href="javascript: void(0);"><img src="<?php echo Template::theme_url('images/list_icon.png'); ?>" alt=""></a></li>
                <li><a href="javascript: void(0);" class="zoom_in_btn"><img src="<?php echo Template::theme_url('images/zooming_icon.png'); ?>" class="show_tb_arrow" alt=""></a></li>
                <li class="zoom_out_btn"><a href="javascript: void(0);" ><img src="<?php echo Template::theme_url('images/zooming_icon_.png'); ?>" class="hide_tb_arrow_" alt=""></a></li>
            </ul>
        </div>
        
        <div id="no-more-tables">
            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                <thead class="cf">
                <tr>
                    <th class="first_th">Sr. No. <span class="rts_bordet"></span></th>
                    <th class="numeric">Remove <span class="rts_bordet"></span></th>
                    <th>Product SKU Code <span class="rts_bordet"></span></th>
                    <th class="numeric">Product SKU Name <span class="rts_bordet"></span></th>
                    <th class="numeric">Units <span class="rts_bordet"></span></th>
                    <th class="numeric">Quantity <span class="rts_bordet"></span></th>
                    <th class="numeric">Qty <div class="wl_sp">(Kg/Ltr)</div> <span class="rts_bordet"></span></th>
                </tr>
                </thead>
                <tbody id="order_place_data">
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
            <button title="Save Order" type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<div class="clearfix"></div>