<?php
$attributes = array('class' => '', 'id' => 'add_company_current_stock','name'=>'add_company_current_stock');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>

<div class="col-md-12">
    <div class="top_form">
        <div class="row">
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control" name="current_date" id="current_date" placeholder="">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 tp_form">
                    <div class="form-group">
                            <label style="display: block;">Product Sku</label>
                            <select class="selectpicker" name="product_sku" id="sales_prod_sku" data-live-search="true">
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
                <div class="col-md-4 col-sm-6 tp_form">
                    <div class="form-group">
                        <label for="intransist_qty">Intransist Qty.</label>
                        <input type="text" class="form-control" name="intransist_qty" id="intransist_qty" placeholder="">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 tp_form">
                    <div class="form-group">
                        <label for="unrusticted_qty">Unrusticted Qty.</label>
                        <input type="text" class="form-control" name="unrusticted_qty" id="unrusticted_qty" placeholder="">
                    </div>
                </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="batch">Batch</label>
                        <input type="text" class="form-control" name="batch" id="batch" placeholder="">
                    </div>
                    <div class="wieght_sp toggle_wieght_sp"></div>
                </div>
                <div class="col-md-3_ tp_form">
                    <div class="form-group">
                        <label for="batch_expiry_date">Batch Expiry Date</label>
                        <input type="text" class="form-control" name="batch_expiry_date" id="batch_expiry_date" placeholder="">
                    </div>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="batch_mfg_date">Batch Mfg.Date</label>
                        <input type="text" class="form-control" name="batch_mfg_date" id="batch_mfg_date" placeholder="">
                    </div>
                </div>
            <div class="col-md-3 save_btn"><button type="submit" style="background-color: #fff;color: #00612f;" class="btn btn-primary">Save</button></div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php
    echo theme_view('common/middle');
?>
<!--<div class="col-md-12 table_bottom">
    <div class="row">
        <div class="col-md-3 save_btn"><button type="button" class="btn btn-primary">Save</button></div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-1 upload_text">Upload: </div>
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
                <div class="col-md-8 chech_data"><button type="button" class="btn btn-default">Check Data</button> <button type="button" class="btn btn-default">Download Templates</button></div>
            </div>
        </div>
    </div>
</div>-->
<?php echo form_close(); ?>