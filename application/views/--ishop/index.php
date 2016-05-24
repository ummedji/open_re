<?php
$attributes = array('class' => '', 'id' => 'primary_sales','name'=>'primary_sales');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open(site_url('ishop/primary_sales_details'),$attributes); ?>
<!--------------------------------------Filter1-------------------------------------------------->
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
                <div class="col-md-12 text-center tp_form">
                    <div class="form-group">
                        <label>Distributor Name</label>
                        <select class="selectpicker" name="" data-live-search="true">
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
                <div class="col-md-3 col-sm-6 tp_form">
                    <div class="form-group">
                        <label for="invoice_no">Invoice No.</label>
                        <input type="text" class="form-control" name="" id="invoice_no" placeholder="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Invoice Date</label>
                        <input type="text" class="form-control" name="" id="invoice_date" placeholder="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 tp_form">
                    <div class="form-group">
                        <label for="order_traking_no">Order Tracking No.</label>
                        <input type="text" class="form-control" name="" id="order_traking_no" placeholder="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 tp_form">
                    <div class="form-group">
                        <label for="po_no">PO No.</label>
                        <input type="text" class="form-control" name="" id="po_no" placeholder="">
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
                        <select class="selectpicker" name="" data-live-search="true">
                            <option>Product Name</option>
                            <?php
                            if(isset($product_sku) && !empty($product_sku))
                            {
                                foreach($product_sku as $k=> $prd_sku)
                                {
                                    ?>
                                    <option value="<?php echo $prd_sku['product_sku_country_id']; ?>"><?php echo $prd_sku['product_sku_name']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">PO Qty.</label>
                        <input type="text" class="form-control" name="" id="po_qty" placeholder="">
                    </div>
                    <div class="wieght_sp toggle_wieght_sp">Kg/Ltr</div>
                </div>
                <div class="col-md-3_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Dispatched Qty.</label>
                        <input type="text" class="form-control" name="" id="dispatched_qty" placeholder="">
                    </div>
                    <div class="wieght_sp toggle_wieght_sp">Kg/Ltr</div>
                </div>
                <div class="col-md-2_ tp_form">
                    <div class="form-group">
                        <label for="invoice_date">Amount</label>
                        <input type="text" class="form-control" name="" id="po_no_1" placeholder="">
                    </div>
                </div>
                <div class="plus_btn"><a href="#" onclick="add_row();"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--------------------------------------Table-------------------------------------------------->
<div class="col-md-12">
    <div class="row">
        <div id="no-more-tables">
            <div class="zoom_space">
                <ul>
                    <li><a href="#"><img src="<?php echo Template::theme_url('images/list_icon.png'); ?>" alt=""></a></li>
                    <li><a href="#"><img src="<?php echo Template::theme_url('images/zooming_icon.png'); ?>" alt=""></a></li>
                </ul>
            </div>
            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                <thead class="cf">
                <tr>
                    <th>Sr. No. <span class="rts_bordet"></span></th>
                    <th>Product SKU Code <span class="rts_bordet"></span></th>
                    <th class="numeric">Product SKU Name <span class="rts_bordet"></span></th>
                    <th class="numeric">PO Qty <span class="wl_sp">(Kg/Ltr)</span> <span class="rts_bordet"></span></th>
                    <th class="numeric">Dispatched Qty <div class="wl_sp">(Kg/Ltr)</div> <span class="rts_bordet"></span></th>
                    <th class="numeric">Amount <span class="rts_bordet"></span></th>
                    <th class="numeric">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td data-title="Sr. No." class="tp_form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="sr_no" placeholder="">
                        </div>
                    </td>
                    <td data-title="Product SKU Code" class="tp_form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="product_code" placeholder="">
                        </div>
                    </td>
                    <td data-title="Product SKU Name" class="numeric tp_form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="product_name" placeholder="">
                        </div>
                    </td>
                    <td data-title="PO Qty" class="numeric tp_form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="pro_qty" placeholder="">
                        </div>
                    </td>
                    <td data-title="Dispatched Qty" class="numeric tp_form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="desp_qty" placeholder="">
                        </div>
                    </td>
                    <td data-title="Amount" class="numeric tp_form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="amount" placeholder="">
                        </div>
                    </td>
                    <td></td>

                </tr>

                <tr>
                    <td data-title="Sr. No." class="numeric">
                        1.
                    </td>
                    <td data-title="Product SKU Code" class="numeric">
                        123456
                    </td>
                    <td data-title="Product SKU Name">
                        Product SKU 1
                    </td>
                    <td data-title="PO Qty">
                        1 Kg.
                    </td>
                    <td data-title="Dispatched Qty">
                        1 Kg.
                    </td>
                    <td data-title="Amount">
                        1 Kg.
                    </td>
                    <td data-title="Action" class="numeric">
                        <div class="edit_i"><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                        <div class="delete_i"><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                    </td>
                </tr>

                <tr>
                    <td data-title="Sr. No." class="numeric">
                        1.
                    </td>
                    <td data-title="Product SKU Code" class="numeric">
                        123456
                    </td>
                    <td data-title="Product SKU Name">
                        Product SKU 1
                    </td>
                    <td data-title="PO Qty">
                        1 Kg.
                    </td>
                    <td data-title="Dispatched Qty">
                        1 Kg.
                    </td>
                    <td data-title="Amount">
                        1 Kg.
                    </td>
                    <td data-title="Action" class="numeric">
                        <div class="edit_i"><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                        <div class="delete_i"><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                    </td>
                </tr>

                <tr>
                    <td data-title="Sr. No." class="numeric">
                        1.
                    </td>
                    <td data-title="Product SKU Code" class="numeric">
                        123456
                    </td>
                    <td data-title="Product SKU Name">
                        Product SKU 1
                    </td>
                    <td data-title="PO Qty">
                        1 Kg.
                    </td>
                    <td data-title="Dispatched Qty">
                        1 Kg.
                    </td>
                    <td data-title="Amount">
                        1 Kg.
                    </td>
                    <td data-title="Action" class="numeric">
                        <div class="edit_i"><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                        <div class="delete_i"><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                    </td>
                </tr>

                <tr>
                    <td data-title="Sr. No." class="numeric">
                        1.
                    </td>
                    <td data-title="Product SKU Code" class="numeric">
                        123456
                    </td>
                    <td data-title="Product SKU Name">
                        Product SKU 1
                    </td>
                    <td data-title="PO Qty">
                        1 Kg.
                    </td>
                    <td data-title="Dispatched Qty">
                        1 Kg.
                    </td>
                    <td data-title="Amount">
                        1 Kg.
                    </td>
                    <td data-title="Action" class="numeric">
                        <div class="edit_i"><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                        <div class="delete_i"><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                    </td>
                </tr>

                <tr>
                    <td data-title="Sr. No." class="numeric">
                        1.
                    </td>
                    <td data-title="Product SKU Code" class="numeric">
                        123456
                    </td>
                    <td data-title="Product SKU Name">
                        Product SKU 1
                    </td>
                    <td data-title="PO Qty">
                        1 Kg.
                    </td>
                    <td data-title="Dispatched Qty">
                        1 Kg.
                    </td>
                    <td data-title="Amount">
                        1 Kg.
                    </td>
                    <td data-title="Action" class="numeric">
                        <div class="edit_i"><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                        <div class="delete_i"><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                    </td>
                </tr>

                <tr>
                    <td data-title="Sr. No." class="numeric">
                        1.
                    </td>
                    <td data-title="Product SKU Code" class="numeric">
                        123456
                    </td>
                    <td data-title="Product SKU Name">
                        Product SKU 1
                    </td>
                    <td data-title="PO Qty">
                        1 Kg.
                    </td>
                    <td data-title="Dispatched Qty">
                        1 Kg.
                    </td>
                    <td data-title="Amount">
                        1 Kg.
                    </td>
                    <td data-title="Action" class="numeric">
                        <div class="edit_i"><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                        <div class="delete_i"><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                    </td>
                </tr>

                <tr>
                    <td data-title="Sr. No." class="numeric">
                        1.
                    </td>
                    <td data-title="Product SKU Code" class="numeric">
                        123456
                    </td>
                    <td data-title="Product SKU Name">
                        Product SKU 1
                    </td>
                    <td data-title="PO Qty">
                        1 Kg.
                    </td>
                    <td data-title="Dispatched Qty">
                        1 Kg.
                    </td>
                    <td data-title="Amount">
                        1 Kg.
                    </td>
                    <td data-title="Action" class="numeric">
                        <div class="edit_i"><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                        <div class="delete_i"><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                    </td>
                </tr>

                <tr>
                    <td data-title="Sr. No." class="numeric">
                        1.
                    </td>
                    <td data-title="Product SKU Code" class="numeric">
                        123456
                    </td>
                    <td data-title="Product SKU Name">
                        Product SKU 1
                    </td>
                    <td data-title="PO Qty">
                        1 Kg.
                    </td>
                    <td data-title="Dispatched Qty">
                        1 Kg.
                    </td>
                    <td data-title="Amount">
                        1 Kg.
                    </td>
                    <td data-title="Action" class="numeric">
                        <div class="edit_i"><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                        <div class="delete_i"><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                    </td>
                </tr>

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
