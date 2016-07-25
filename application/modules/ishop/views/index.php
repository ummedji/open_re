<?php
//testdata(base_url());
$attributes = array('class' => '', 'id' => 'primary_sales','name'=>'primary_sales');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>
<!--------------------------------------Filter1-------------------------------------------------->
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center tp_form">
                <div class="form-group">
                    <label>Distributor Name<span style="color: red">*</span></label>
                    <select class="selectpicker" id="customer_id" name="customer_id" data-live-search="true">
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
            <div class="col-md-3 col-sm-6 tp_form">
                <div class="form-group">
                    <label for="invoice_no">Invoice No.<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="invoice_no" id="invoice_no" placeholder="">
                    <label id="invoice_no_error" class="errors" for="invoice_no"></label>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 tp_form">
                <div class="form-group">
                    <label for="invoice_date">Invoice Date<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="invoice_date" id="invoice_date" placeholder="" autocomplete="off" >
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
            <div class="row">
                <div class="col-md-4_ tp_form">
                    <div class="form-group">
                        <label>Product Sku<span style="color: red">*</span></label>
                        <select class="selectpicker" id="prod_sku" name="prod_sku" data-live-search="true">
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
                    <label id="prod_sku-error" class="error" for="prod_sku"></label>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">PO Qty.</label>
                        <input type="text" class="form-control allownumericwithdecimal" id="po_qty" name="po_qty" placeholder="">
                    </div>
                    <div class="wieght_sp toggle_wieght_sp">Kg/Ltr</div>
                    <label id="po_qty-error" class="error" for="po_qty"></label>
                </div>
                <div class="col-md-3_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Dispatched Qty.<span style="color: red">*</span></label>
                        <input type="text" class="form-control allownumericwithdecimal" id="dispatched_qty" name="dispatched_qty" placeholder="">
                    </div>
                    <div class="wieght_sp toggle_wieght_sp">Kg/Ltr</div>
                    <label id="dispatched_qty-error" class="error" for="dispatched_qty"></label>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Amount<span style="color: red">*</span></label>
                        <input type="text" class="form-control allownumericwithdecimal" id="amt" name="amt" placeholder="">
                    </div>
                    <label id="amt-error" class="error" for="amt"></label>
                </div>
                <div class="plus_btn"><a href="javascript: void(0);" id="add_row"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
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
                    <th>Sr. No. <span class="rts_bordet"></span></th>
                    <th class="numeric">Action <span class="rts_bordet"></span></th>
                    <th>Product SKU Code <span class="rts_bordet"></span></th>
                    <th class="numeric">Product SKU Name <span class="rts_bordet"></span></th>
                    <th class="numeric">PO Qty <span class="wl_sp">(Kg/Ltr)</span> <span class="rts_bordet"></span></th>
                    <th class="numeric">Dispatched Qty <div class="wl_sp">(Kg/Ltr)</div> <span class="rts_bordet"></span></th>
                    <th class="numeric">Amount <span class="rts_bordet"></span></th>
                </tr>
                </thead>
                <tbody id="primary_sls">
                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<!--------------------------------------Save & Upload Data-------------------------------------------------->
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


<div class="col-md-12 table_bottom">

    <div class="row">
        <!--  <div class="col-md-3 save_btn"><button type="button" class="btn btn-primary">Save</button></div> -->
        <?php
        $attributes = array('class' => '', 'id' => 'upload_primarysales_data','name'=>'upload_primarysales_data');
        echo form_open_multipart('',$attributes);
        ?>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 save_btn"></div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-1 upload_text">Upload: </div>
                        <div class="col-md-3 upload_file_space">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file fileUpload">
                                      Browse <input type="file" class="upload" name="upload_file_data" id="upload_file_data" multiple="multiple"/>
                                    </span>
                                </span>
                                <input type="text" id="filename" class="form-control">
                            </div>
                            <label id="upload_file_data-error" class="error" for="upload_file_data"></label>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-8 chech_data"><button type="submit" class="btn btn-default">Check Data</button> <a id="distributor_xl" href="javascript:void(0);" onclick='window.open("<?php echo base_url('assets/uploads/Uploads/primary_sales/primarysales_data.xlsx'); ?>","_blank" );' class="btn btn-default">Download Templates</a> </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
