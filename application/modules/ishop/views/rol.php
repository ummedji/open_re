<?php
echo Template::message();
$attributes = array('class' => '', 'id' => 'rol_limit','name'=>'rol_limit');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
                <div class="col-md-12 text-center radio_space">
                  <!--  --><?php /*if(strtolower($customer_type_id['ctr_ctn'])=='distributor') { */?>
                        <div class="radio">
                            <input class="sel_customer_type" type="radio" name="radio1" id="dist_radio1" attr-type="<?php /*echo $customer_type_id['customer_type_country_id'] */?>" value="distributor" checked>
                            <label for="radio1">Distributor </label>
                        </div>
                     <!--   --><?php
/*                    }
                    elseif(strtolower($customer_type_id['ctr_ctn'])=='retailer'){
                        */?>
                        <div class="radio">
                            <input class="sel_customer_type" type="radio" name="radio1" id="reta_radio2" attr-type="<?php /*echo $customer_type_id['customer_type_country_id'] */?>" value="retailer">
                            <label for="radio2">Retailer</label>
                        </div>
                      <!--  --><?php
/*                    }
                    */?>
                    <div class="clearfix"></div>
                </div>

            <!--------------------------------------Distributor------------------------------------------>
                <div class="col-md-6 col-md-offset-3 distributore_form distributor_radio">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 tp_form">
                            <div class="form-group">
                                <label>Provience Name</label>
                                <select class="selectpicker" id="pro_id"  data-live-search="true">
                                    <option value="0">Provience Name</option>
                                    <?php
                                    if(isset($provience) && !empty($provience))
                                    {
                                        foreach($provience as $key=>$val_provience)
                                        {
                                            ?>
                                            <option value="<?php echo $val_provience['political_geo_id']; ?>"><?php echo $val_provience['political_geography_name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 tp_form">
                            <div class="form-group">
                                <label>Distributor Name</label>
                                <select class="selectpicker" name="distributor_name" id ='distr_id'>
                                  <!--  <option>Select Distributor Name</option>
                                    <option>Distributor Name</option>-->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <!--------------------------------------End Distributor------------------------------------------>

            <!--------------------------------------Start Retailer------------------------------------------>

               <div class="col-md-10 col-md-offset-1 distributore_form retailer_radio">
                <div class="row">
                    <div class="col-md-4 col-sm-4 tp_form">
                        <div class="form-group">
                            <label>Provience Name</label>
                            <select class="selectpicker" id="pro_id"  data-live-search="true">
                                <option value="0">Provience Name</option>
                                <?php
                               if(isset($provience) && !empty($provience))
                                {
                                    foreach($provience as $key=>$val_provience)
                                    {
                                        ?>
                                        <option value="<?php echo $val_provience['political_geo_id']; ?>"><?php echo $val_provience['political_geography_name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 tp_form">
                        <div class="form-group">
                            <label>Kabupaten Name</label>
                            <select class="selectpicker" id="pro_id"  data-live-search="true">
                                <option value="0">Kabupaten Name</option>
                                <?php
                                if(isset($provience) && !empty($provience))
                                {
                                    foreach($provience as $key=>$val_provience)
                                    {
                                        ?>
                                        <option value="<?php echo $val_provience['political_geo_id']; ?>"><?php echo $val_provience['political_geography_name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 tp_form">
                        <div class="form-group">
                            <label>Retailer Name</label>
                            <select class="selectpicker" id =''>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------------End Retailer------------------------------------------>
        </div>
    </div>
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
                    <th class="numeric">Action <span class="rts_bordet"></span></th>
                    <th>Distributor Code <span class="rts_bordet"></span></th>
                    <th class="numeric">Distributor Name <span class="rts_bordet"></span></th>
                    <th class="numeric">PBG <span class="rts_bordet"></span></th>
                    <th class="numeric">Product SKU Name <span class="rts_bordet"></span></th>
                    <th class="numeric">Units <span class="rts_bordet"></span></th>
                    <th class="numeric">ROL Quantity <span class="wl_sp">(Kg/Ltr)</span> <span class="rts_bordet"></span></th>
                    <th class="numeric">ROL Qty Kg/Ltr <div class="wl_sp">(Kg/Ltr)</div> <span class="rts_bordet"></span></th>
                </tr>
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

