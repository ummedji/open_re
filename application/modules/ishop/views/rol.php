<?php
$attributes = array('class' => '', 'id' => 'rol_limit','name'=>'rol_limit');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>
<?php if (!$this->input->is_ajax_request()) { ?>
    <div class="col-md-12">
        <?php if($current_user->role_id == '7'){
            ?>
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
                                <div class="col-md-4 col-sm-6 tp_form">
                                    <div class="form-group">
                                        <label>Geo Level 3</label>
                                        <select class="selectpicker" name="geo_level_rol" id="geo_level_rol">
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
                                <div class="col-md-4 col-sm-6 tp_form">
                                    <div class="form-group">
                                        <label>Geo Level 2</label>
                                        <select class="selectpicker" name="geo_level_1" id="geo_level_1">
                                            <option>Select Geo Location</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 tp_form">
                                    <div class="form-group">
                                        <label>Retailer Name</label>
                                        <select class="selectpicker" name="fo_retailer_id" id="retailer_rol">
                                            <option value="0">Select Retailer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--------------------------------------End Retailer------------------------------------------>
                            <div class="col-md-8 col-md-offset-2">
                                <div class="row">
                                    <div class="distributor_check_rol" id="distributor_check_rol" style="display:none;">
                                        <div class="col-md-6 col-sm-6 tp_form">
                                            <div class="form-group">
                                                <label>Geo Level</label>
                                                <select class="selectpicker distributor_geo_level " id="distributor_geo_level" name="distributor_geo_level" data-live-search="true">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 tp_form">

                                            <div class="form-group">
                                                <label>Distributor Name</label>
                                                <select class="selectpicker" id="distributor_rol" name="distributor_rol" data-live-search="true">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------------------------------------Distributor------------------------------------------>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php
        }
        ?>
    </div>
    <input class="login_customer_role" type="hidden" name="login_customer_role" id="login_customer_role" value="<?php echo $current_user->role_id; ?>" />
    <input class="login_customer_id" type="hidden" name="login_customer_id" id="login_customer_id" value="<?php echo $current_user->id; ?>" />
    <input class="login_customer_countryid" type="hidden" name="login_customer_countryid" id="login_customer_countryid" value="<?php echo $current_user->country_id; ?>" />

    <input class="page_function" type="hidden" name="page_function" id="" value="<?php echo $this->uri->segment(2); ?>" />



    <!--------------------------------------Start Filter------------------------------------------>
    <div class="col-md-12">
        <div class="row">
            <div class="middle_form">
                <div class="row">
                    <div class="col-md-4_ tp_form">
                        <div class="form-group">
                            <label>Product SKU Name</label>
                            <select class="selectpicker" name="prod_sku" id="prod_sku" data-live-search="true" >
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
                            <select class="selectpicker" name="unit" id="unit_id">
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
                            <input type="text" class="form-control" name="rol_qty" id="rol_qty" placeholder="">
                        </div>
                    </div>
                    <div class="svn_btn"><button type="submit" class="btn btn-primary gren_btn">Save</button></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php echo form_close(); ?>
<?php }?>
<!--------------------------------------End Filter------------------------------------------>

<!--------------------------------------Table-------------------------------------------------->
<?php $attributes = array('class' => '', 'id' => 'update_rol_limit','name'=>'update_rol_limit');
echo form_open('',$attributes); ?>

<div class="rol_container">
    <?php
    echo theme_view('common/middle');
    ?>
</div>

<?php echo form_close(); ?>
<!--------------------------------------Save & Upload Data-------------------------------------------------->
<div class="clearfix"></div>
<?php
if (!$this->input->is_ajax_request()) {
    ?>
    <div class="check_save_btn" id="check_save_btn" style="display:none;">
        <div class="col-md-2 save_btn">
            <label>&nbsp;</label>
            <button type="submit" name="save" id="check_save" class="btn btn-primary gren_btn" style="margin-bottom: 50px">Save</button>
        </div>
    </div>
    <?php
}
?>

