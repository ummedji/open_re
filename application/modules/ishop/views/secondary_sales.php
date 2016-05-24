<?php
$attributes = array('class' => '', 'id' => 'add_secondary_sales','name'=>'add_secondary_sales');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>
<!--------------------------------------Filter1-------------------------------------------------->
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center tp_form">
                <div class="form-group">
                    <label>Retailer Name</label>
                    <select class="selectpicker" name="customer_id" id="reta_id" data-live-search="true">
                        <option value="0">Select Retailer Name</option>
                        <?php
                        if(isset($retailer) && !empty($retailer))
                        {
                            foreach($retailer as $key=>$val_retailer)
                            {
                                ?>
                                <option value="<?php echo $val_retailer['id']; ?>" attr-retname="<?php echo $val_retailer['display_name']; ?>"><?php echo $val_retailer['display_name']; ?></option>
                            <?php
                           }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 tp_form">
                <div class="form-group">
                    <label for="invoice_no">Invoice No.</label>
                    <input type="text" class="form-control" name="invoice_no" id="invoice_no" placeholder="">
                </div>
            </div>
            <div class="col-md-3 col-sm-6 tp_form">
                <div class="form-group">
                    <label for="invoice_date">Invoice Date</label>
                    <input type="text" class="form-control" name="invoice_date" id="invoice_date" placeholder="">
                </div>
            </div>
            <div class="col-md-3 col-sm-6 tp_form">
                <div class="form-group">
                    <label for="order_traking_no">Order Tracking No.</label>
                    <input type="text" class="form-control" name="order_tracking_no" id="order_traking_no" placeholder="">
                </div>
            </div>
            <div class="col-md-3 col-sm-6 tp_form">
                <div class="form-group">
                    <label for="po_no">PO No.</label>
                    <input type="text" class="form-control" name="PO_no" id="po_no" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!--------------------------------------Filter2-------------------------------------------------->
<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
            <div class="col-md-4_ tp_form">
                <div class="form-group">
                    <label>Product Sku</label>
                    <select class="selectpicker" id="sec_prod_sku" data-live-search="true">
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
                    <select class="selectpicker" id="sec_sel_unit">
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
                    <input type="text" class="form-control" id="sec_qty" placeholder="">
                </div>
                <div class="wieght_sp toggle_wieght_sp">Kg/Ltr</div>
            </div>
            <div class="col-md-2_ tp_form">
                <div class="form-group">
                    <label for="invoice_date">Amount</label>
                    <input type="text" class="form-control" id="sec_amt" placeholder="">
                </div>
            </div>
            <div class="plus_btn"><a href="#" onclick="add_sec_sales_row();"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
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
                    <th>Retailer Name <span class="rts_bordet"></span></th>
                    <th>Product SKU Code <span class="rts_bordet"></span></th>
                    <th class="numeric">Product SKU Name <span class="rts_bordet"></span></th>
                    <th class="numeric">Quantity <span class="wl_sp">(Kg/Ltr)</span> <span class="rts_bordet"></span></th>
                    <th>Unit <span class="rts_bordet"></span></th>
                    <th class="numeric">Amount <span class="rts_bordet"></span></th>
                    <th class="numeric">Qty Kg/Ltr<div class="wl_sp">(Kg/Ltr)</div> <span class="rts_bordet"></span></th>
                </tr>
                </thead>
                <tbody id="secondary_sls">
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
