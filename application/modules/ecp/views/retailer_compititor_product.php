<?php $segment2 = $this->uri->segment(2); ?>
<?php
$attributes = array('class' => '', 'id' => 'retailer_compititor_product','name'=>'retailer_compititor_product');
echo form_open('',$attributes); ?>
<div class="col-md-12 full-height">
    <div class="row">
        <div class="col-md-12">
            <div class="top_form">
                <div class="row">
                    <div class="col-md-12 text-center sub_nave">
                        <div class="inn_sub_nave">
                            <ul>
                                <li class="<?php echo ($segment2=='retailer_compititor_analysis' || $segment2=='retailer_compititor_product' || $segment2=='retailer_compititor_view') ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/retailer_compititor_analysis')?>">Retailer</a></li>
                                <li class="<?php echo ($segment2=='distributor_compititor_analysis' || $segment2=='distributor_compititor_product' || $segment2=='distributor_compititor_view' ) ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/distributor_compititor_analysis')?>">Distributor</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center sub_nave_sub">
                        <div class="inn_sub_nave">
                            <ul>
                                <li class="<?php echo ($segment2=='retailer_compititor_analysis') ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/retailer_compititor_analysis') ?>">Total</a></li>
                                <li class="<?php echo ($segment2=='retailer_compititor_product') ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/retailer_compititor_product') ?>">Product</a></li>
                                <li class="<?php echo ($segment2=='retailer_compititor_view') ? 'active' :'' ;?>"><a href="<?php echo base_url('ecp/retailer_compititor_view') ?>">View</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2 distributore_form">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label for="month_data">Month<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="month_data" id="month_data" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Geo Level<span style="color: red">*</span></label>
                                    <select class="selectpicker" id="geo_id" name="geo_id" data-live-search="true">
                                        <option value="">Geo Level Name</option>
                                        <?php
                                        if(isset($geo_level) && !empty($geo_level))
                                        {
                                            foreach($geo_level as $k=> $val_geo_level)
                                            {
                                                ?>
                                                <option value="<?php echo $val_geo_level['political_geo_id']; ?>"><?php echo $val_geo_level['political_geography_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Retailer Name<span style="color: red">*</span></label>
                                    <select class="selectpicker" id="retailer_id" name="retailer_id" data-live-search="true">
                                        <option value="">Retailer Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 tp_form">
                                <div class="form-group">
                                    <label>Compititors Name<span style="color: red">*</span></label>
                                    <select class="selectpicker" id="compititor_id" name="compititor_id" data-live-search="true">
                                        <option value="">Compititors Name</option>
                                        <?php
                                        if(isset($compititor) && !empty($compititor))
                                        {
                                            foreach($compititor as $k=> $val_compititor)
                                            {
                                                ?>
                                                <option value="<?php echo $val_compititor['compititor_id']; ?>"><?php echo $val_compititor['compititor_name']; ?></option>
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
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<input class="login_customer_type" type="hidden" name="login_customer_type" id="login_customer_type" value="<?php echo $current_user->role_id; ?>" />
<input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $current_user->id; ?>" />
<input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo  $current_user->country_id; ?>" />

<input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />


<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
            <div class="row">
                <div class="col-md-4_ tp_form">
                    <div class="form-group">
                        <label>Our Product<span style="color: red">*</span></label>
                        <select class="selectpicker" id="prod_sku" name="prod_sku" data-live-search="true">
                            <option value="">Product Name</option>
                            <?php
                             if(isset($product_sku) && !empty($product_sku))
                             {
                                 foreach($product_sku as $k=> $prd_sku)
                                 {
                            ?>
                                    <option value="<?php echo $prd_sku['product_sku_country_id'];?>" attr-name="<?php echo $prd_sku['product_sku_name']; ?>" attr-code="<?php echo $prd_sku['product_sku_code']; ?>"><?php echo $prd_sku['product_sku_name']; ?></option>
                                    <?php
                                 }
                             }
                            ?>
                        </select>
                    </div>
                    <label id="prod_sku-error" class="error" for="prod_sku"></label>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Compititor Product<span style="color: red">*</span></label>
                        <input type="text" class="form-control " id="comp_prd" name="comp_prd" placeholder="">
                    </div>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Qty.<span style="color: red">*</span></label>
                        <input type="text" class="form-control allownumericwithdecimal" id="qty" name="qty" placeholder="">
                    </div>
                </div>
                <div class="plus_btn"><a href="#" id="add_row"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

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
                    <th class="numeric">Action <span class="rts_bordet"></span></th>
                    <th class="numeric">Entry Date <span class="rts_bordet"></span></th>
                    <th>Compititor Product Name <span class="rts_bordet"></span></th>
                    <th>Quantity<span class="rts_bordet"></span></th>
                    <th class="numeric">Our Product <span class="rts_bordet"></span></th>
                </tr>
                </thead>
                <tbody id="retailer_comp_prd">
                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="save_button" style="display: none">
    <div class="col-md-12 table_bottom">
        <div class="row">
            <div class="col-md-3 save_btn">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<div class="clearfix"></div>