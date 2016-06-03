<?php
$attributes = array('class' => '', 'id' => 'order_place','name'=>'order_place');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>
<!--------------------------------------Filter1-------------------------------------------------->

<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            
            <div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="active"><a href="<?php echo base_url('/ishop/order_place') ?>">Order Place</a></li>
                        <li><a href="<?php echo base_url('/ishop/order_status') ?>">Order Status</a></li>
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
                            <label>Geo L1</label>
                            <select class="selectpicker" class="distributor_geo_level_1_data" id="distributor_geo_level_1_data" name="geo_level_1_data" data-live-search="true">
                                <option value="0">Select Geo Level</option>
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
                                <label>Distributor Name</label>
                                <select class="selectpicker" id="distributor_distributor_id" name="distributor_id" data-live-search="true">
                                   <!-- <option value="0">Select Distributor Name</option> -->
                                    <?php
                                  /*  if(isset($distributor) && !empty($distributor))
                                    {
                                        foreach($distributor as $key=>$val_distributor)
                                        {
                                            ?>
                                            <option value="<?php echo $val_distributor['id']; ?>"><?php echo $val_distributor['display_name']; ?></option>
                                            <?php
                                        }
                                    }*/
                                    ?> 
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1 distributore_form retailer_data" style="display:none;">
                <div class="row">
                    
                     <div class="col-md-3 col-sm-6 tp_form">

                             <div class="form-group">
                                <label>Geo L2</label>
                                <select class="selectpicker retailer_geo_level_1_data"  id="retailer_geo_level_1_data" name="geo_level_1_data" data-live-search="true">

                                </select>

                            </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6 tp_form">
                    
                        <div class="form-group">
                            <label>Geo L1</label>
                            <select class="selectpicker retailer_geo_level_2_data" id="retailer_geo_level_2_data" name="geo_level_1_data" data-live-search="true">

                            </select>
                    
                        </div>
                    </div>
                
                    
                    <div class="col-md-3 col-sm-4 tp_form">
                        <div class="form-group">
                                <label>Retailer Name</label>
                                <select class="selectpicker" id="retailer_id" name="retailer_id" data-live-search="true" onchange="get_distributors('retailer')">
                                 <!--   <option value="0">Select Retailer Name</option> -->
                                    <?php
                                   /* if(isset($retailer) && !empty($retailer))
                                    {
                                        foreach($retailer as $key=>$val_retailer)
                                        {
                                            ?>
                                            <option value="<?php echo $val_retailer['id']; ?>"><?php echo $val_retailer['display_name']; ?></option>
                                            <?php
                                        }
                                    }*/
                                    ?>
                                </select>
                            </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-4 tp_form">
                        <div class="form-group">
                                <label>Distributor Name</label>
                                <select class="selectpicker" id="retailer_distributor_id" name="distributor_id" data-live-search="true">
                                    
                                </select>
                            </div>
                    </div>
                </div>
            </div>
            
        <?php }
        else if($login_customer_type == 9){
        ?>
            
            <div class="col-md-6 text-center radio_space">
                <div class="col-md-6 col-sm-6 tp_form">
                    <div class="form-group">
                        <label for="invoice_date">PO NO.</label>
                        <input type="text" name="po_no" class="form-control" id="po_no" placeholder="">
                    </div>
                </div>
                    
                <div class="clearfix"></div>
            </div>
            
        <?php }else if($login_customer_type == 10){ ?>
            
            
            <div class="col-md-12 distributor_data" style="margin-top: 10px;">
                    <div class="row">

                        <div class="col-md-12 text-center tp_form">
                            <div class="form-group">
                                <div class="form-group">
                                <label>Distributor Name</label>
                                <select class="selectpicker" id="retailer_distributor_id" name="distributor_id" data-live-search="true">
                                    <option value="0">Select Distributor Name</option>
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
                        <input class="select_customer_type" type="radio" name="radio1" id="radio1" value="farmer" checked="checked"/>
                        <label for="radio1">Farmer</label>
                    </div>
                    
                     <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="radio1" value="retailer" />
                        <label for="radio1">Retailer</label>
                    </div>
                    
                    <div class="radio">
                        <input class="select_customer_type" type="radio" name="radio1" id="radio2" value="distributor" />
                        <label for="radio2">Distributor</label>
                    </div>
                   
                    <div class="clearfix"></div>
                </div>
            
            <div class="farmer_checked" id="farmer_checked">
            <div class="col-md-12 text-center tp_form inline-parent">
                <div class="form-group">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" name="order_date" class="order_date form-control" id="order_date_datepicker" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Geo L2</label>
                    <select class="selectpicker geo_level_1_data" id="geo_level_1_data" name="geo_level_1_data" data-live-search="true">
                        <option value="0">Select Geo Level</option>
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
                <div class="form-group">
                    <label>Geo L1</label>
                    <select class="selectpicker geo_level_2_data" class="" id="geo_level_2_data" name="geo_level_1_data" data-live-search="true">
                        <!--  <option value="0">Select Geo Level</option> -->
                        <?php
                        /*   if(isset($geo_level_data) && !empty($geo_level_data))
                             {
                                 foreach($geo_level_data as $key=>$val_geo_level_data)
                                 {
                                     ?>
                                     <option value="<?php echo $val_geo_level_data['political_geo_id']; ?>"><?php echo $val_geo_level_data['political_geography_name']; ?></option>
                                     <?php
                                 }
                             } */
                        ?>
                    </select>

                </div>
            </div>
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>Farmer Name</label>
                        <select class="selectpicker" id="farmer_data" name="farmer_data" data-live-search="true">

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" name="mobile_num" class="mobile_num form-control" id="mobile_num" />
                    </div>
                    <div class="form-group">
                        <label>Retailer Name</label>
                        <select class="selectpicker" id="retailer_data" name="retailer_data" data-live-search="true" >

                        </select>

                    </div>
                </div>

            
            </div>
            
            <div class="retailer_checked" id="retailer_checked" style="display:none;">
                
                <div class="col-md-12 tp_form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group fulle_wd">
                                <label>Geo L3</label>
                                <select class="selectpicker retailer_geo_level_1_data" id="retailer_geo_level_1_data" name="geo_level_1_data" data-live-search="true">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group fulle_wd">
                                <label>Geo L2</label>
                                <select class="selectpicker retailer_geo_level_2_data" id="retailer_geo_level_2_data" name="geo_level_1_data" data-live-search="true">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group fulle_wd">
                                <label>Retailer Name</label>
                                <select class="selectpicker" id="retailer_data" name="retailer_data" data-live-search="true" >
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group fulle_wd">
                                <label>Distributor Name</label>
                                <select class="selectpicker" id="distributor_data" name="distributor_data" data-live-search="true">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="distributor_checked" id="distributor_checked" style="display:none;">
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>Geo L2</label>
                        <select class="selectpicker distributor_geo_level_1_data" id="distributor_geo_level_1_data" name="geo_level_1_data" data-live-search="true">
                            <!--  <option value="0">Select Geo Level</option> -->
                            <?php
                            /*   if(isset($geo_level_data) && !empty($geo_level_data))
                               {
                                   foreach($geo_level_data as $key=>$val_geo_level_data)
                                   {
                                       ?>
                                       <option value="<?php echo $val_geo_level_data['political_geo_id']; ?>"><?php echo $val_geo_level_data['political_geography_name']; ?></option>
                                       <?php
                                   }
                               } */
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Geo L1</label>
                        <select class="selectpicker distributor_geo_level_2_data"  id="distributor_geo_level_2_data" name="geo_level_1_data" data-live-search="true">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Distributor Name</label>
                        <select class="selectpicker" id="fo_distributor_data" name="distributor_data" data-live-search="true">
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
                <div class="col-md-4_ tp_form">
                    <div class="form-group">
                        <label>Product Sku Name</label>
                        <select class="selectpicker" id="prod_sku" data-live-search="true">
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
                        <label for="invoice_date">Units</label>
                        <!-- <input type="text" class="form-control" id="unit" placeholder=""> -->

                        <select class="selectpicker" id="units" data-live-search="true">
                            <option value="0">Select Unit</option>
                            <option value="box">Box</option>
                            <option value="packages">Packages</option>
                            <option value="kg/ltr">Kg/Ltr</option>
                        </select>

                    </div>

                </div>
                <div class="col-md-3_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Quantity</label>
                        <input type="text" class="form-control" id="quantity" placeholder="">
                    </div>

                </div>
                <div class="plus_btn"><a href="javascript:void(0);" onclick="order_place_add_row();"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
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
                    <th class="numeric">Remove <span class="rts_bordet"></span></th>
                    <th>Product SKU Code <span class="rts_bordet"></span></th>
                    <th class="numeric">Product SKU Name <span class="rts_bordet"></span></th>
                    <th class="numeric">Units <span class="rts_bordet"></span></th>
                    <th class="numeric">Quantity <span class="rts_bordet"></span></th>
                    <th class="numeric">Qty <div class="wl_sp">(Kg/Ltr)</div> <span class="rts_bordet"></span></th>
                    
                  <!--  <th class="numeric">Edit <span class="rts_bordet"></span></th> -->
                   
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