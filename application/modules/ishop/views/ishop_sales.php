<div class="col-md-12 full-height">
    <div class="row">
        <div class="col-md-12">
            <div class="top_form">
                <div class="row">
                    <div class="col-md-12 text-center sub_nave">
                        <div class="inn_sub_nave">
                            <ul>
                                <li class="active"><a href="<?php echo base_url('/ishop/ishop_sales') ?>">Sales</a></li>
                                <li><a href="<?php echo base_url('/ishop/physical_stock') ?>">Physical Stock</a></li>
                                <li><a href="#">View</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                        <div class="col-md-12 text-center radio_space">
                            <div class="radio">
                                <input type="radio" name="radio1" id="radio1" value="option2">
                                <label for="radio1">Retailer</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="radio1" id="radio2" value="option2">
                                <label for="radio2">Distributor</label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-8 col-md-offset-2 distributore_form">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 tp_form">
                                    <div class="form-group">
                                        <label>Month</label>
                                        <select class="selectpicker">
                                            <option>Select Month</option>
                                            <option>January</option>
                                            <option>February</option>
                                            <option>March</option>
                                            <option>April</option>
                                            <option>May</option>
                                            <option>June</option>
                                            <option>July</option>
                                            <option>August</option>
                                            <option>September</option>
                                            <option>October</option>
                                            <option>November</option>
                                            <option>December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 tp_form">
                                    <div class="form-group">
                                        <label>Geo L1</label>
                                        <select class="selectpicker">
                                            <option>Geo L1</option>
                                            <option>Geo L1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 tp_form">
                                    <div class="form-group">
                                        <label>Distributor Name</label>
                                        <select class="selectpicker">
                                            <option>Select Distributor Name</option>
                                            <option>Distributor Name</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="middle_form">
                    <form class="row">
                        <div class="col-md-4_ tp_form">
                            <div class="form-group">
                                <label>Product SKU Name</label>
                                <select class="selectpicker">
                                    <option>Product Name</option>
                                    <option>Distributor Name</option>
                                    <option>Distributor Name</option>
                                    <option>Distributor Name</option>
                                    <option>Distributor Name</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2_ tp_form">
                            <div class="form-group">
                                <label for="po_qty">Qty.</label>
                                <input type="text" class="form-control" id="po_qty" placeholder="">
                            </div>
                        </div>
                        <div class="plus_btn"><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
                    </form>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="zoom_space">
                    <ul>
                        <li><a href="#"><img src="images/list_icon.png" alt=""></a></li>
                        <li><a href="#"><img src="images/zooming_icon.png" alt=""></a></li>
                    </ul>
                </div>
                <div id="no-more-tables">
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
        <div class="col-md-12 table_bottom">
            <div class="row">
                <div class="col-md-3 save_btn"><button type="button" class="btn btn-primary">Save</button></div>
                <div class="col-md-9">
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
                </div>
            </div>
        </div>
    </div>
</div>