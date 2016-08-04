<?php if (!$this->input->is_ajax_request()) { ?>
    <?php
    $attributes = array('class' => '', 'id' => 'rol_limit','name'=>'rol_limit', 'autocomplete'=>'off');
//echo form_open($this->uri->uri_string(),$attributes);
    echo form_open('ishop/set_rol',$attributes); ?>
    <div class="col-md-12">
        <?php if($current_user->role_id == '7'){
            ?>
            <div class="top_form">
                <div class="row">
                    <div class="col-md-12 text-center radio_space">
                        <div class="col-md-12 text-center radio_space">
                            <div class="radio">
                                <input class="select_customer_type" type="radio" name="checked_type" id="retailer" value="retailer" checked>
                                <label for="radio1">Retailer</label>
                            </div>
                            <div class="radio">
                                <input class="select_customer_type" type="radio" name="checked_type" id="distributor" value="distributor">
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
                                        <label>Geo Level 3<span style="color: red">*</span></label>
                                        <select class="selectpicker" name="geo_level_rol" id="geo_level_rol" data-live-search="true">
                                            <option value="">Select Geo Location</option>
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
                                        <label>Geo Level 2<span style="color: red">*</span></label>
                                        <select class="selectpicker" name="geo_level_1" id="geo_level_1" data-live-search="true">
                                            <option value="">Select Geo Location</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 tp_form">
                                    <div class="form-group">
                                        <label>Retailer Name<span style="color: red">*</span></label>
                                        <select class="selectpicker" name="fo_retailer_id" id="retailer_rol" data-live-search="true">
                                            <option value="">Select Retailer</option>
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
                                                <label>Geo Level<span style="color: red">*</span></label>
                                                <select class="selectpicker distributor_geo_level " id="distributor_geo_level" name="distributor_geo_level" data-live-search="true">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 tp_form">

                                            <div class="form-group">
                                                <label>Distributor Name<span style="color: red">*</span></label>
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
                            <label>Product SKU Name<span style="color: red">*</span></label>
                            <div class="inln_fld">
                                <select class="selectpicker" name="prod_sku" id="prod_sku" data-live-search="true" >
                                    <option value="">Product Name</option>
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
                                <div class="clearfix"></div>
                                <label id="prod_sku-error" class="error" for="prod_sku"></label>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4_ tp_form">
                        <div class="form-group">
                            <label>Units<span style="color: red">*</span></label>
                            <div class="inln_fld">
                                <select class="selectpicker" name="unit" id="unit_id">
                                    <option value="">Units</option>
                                    <option value="box">Box</option>
                                    <option value="packages">Packages</option>
                                    <option value="kg/ltr">Kg/Ltr</option>
                                </select>
                                <div class="clearfix"></div>
                                <label id="unit_id-error" class="error" for="unit_id"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2_ tp_form">
                        <div class="form-group">
                            <label for="po_qty">ROL Quantity<span style="color: red">*</span></label>
                            <div class="inln_fld">
                                <input type="text" class="form-control allownumericwithdecimal" name="rol_qty" id="rol_qty" placeholder="">
                                <div class="clearfix"></div>
                                <label id="rol_qty-error" class="error" for="rol_qty"></label>
                            </div>
                        </div>
                    </div>
                    <div class="svn_btn"><button type="submit" class="btn btn-primary gren_btn">Save</button></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php }?>
    <?php echo form_close(); ?>

<!--------------------------------------End Filter------------------------------------------>

<!--------------------------------------Table-------------------------------------------------->
<?php if ($this->input->is_ajax_request()) { ?>
<?php
echo theme_view('common/middle');
?>
<?php } ?>


<?php if (!$this->input->is_ajax_request()) { ?>

<?php $attributes = array('class' => '', 'id' => 'update_rol_limit','name'=>'update_rol_limit');
echo form_open('',$attributes); ?>

<div id="middle_container" class="rol_container">
    <?php
    echo theme_view('common/middle');
    ?>
</div>

<?php echo form_close(); ?>

<?php } ?>
<!--------------------------------------Save & Upload Data-------------------------------------------------->
<div class="clearfix"></div>
<?php
if (!$this->input->is_ajax_request()) {
    ?>
    <div class="check_save_btn" id="check_save_btn" style="display:none;">
        <div class="save_btn">
            <label>&nbsp;</label>
            <button type="submit" name="save" id="check_save" class="btn btn-primary" style="margin-bottom: 50px">Save</button>
        </div>
    </div>
    <?php
}
?>

<div class="clearfix"></div>

<?php if (!$this->input->is_ajax_request()) { ?>

<div class="col-md-12 table_bottom">

    <div class="row">
        <div class="col-md-3 save_btn"></div>
      <!--  <div class="col-md-3 save_btn"><button type="button" class="btn btn-primary">Save</button></div> -->
     <?php
         $attributes = array('class' => '', 'id' => 'upload_rol_data','name'=>'upload_rol_data');
         echo form_open_multipart('',$attributes);
     ?>
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
                        <input type="text" id="filename" class="form-control" readonly>
                    </div>
                    <label id="upload_file_data-error" class="error" for="upload_file_data"></label>
                    <div class="clearfix"></div>
                </div>

                    <div class="col-md-8 chech_data">

                        <button type="submit" class="btn btn-default">Check Data</button>
                  <?php  if($current_user->role_id == 7){ ?>

                                <a  id="retailer_xl" href="javascript:void(0);" onclick='window.open("<?php echo base_url('assets/uploads/Uploads/rol/rol_retailer_HO.xlsx'); ?>","_blank" );' class="btn btn-default retailer_xl">Download Templates</a>

                                <a style="display:none;" id="distributor_xl" href="javascript:void(0);" onclick='window.open("<?php echo base_url('assets/uploads/Uploads/rol/rol_distributor_HO.xlsx'); ?>","_blank" );' class="btn btn-default distributor_xl">Download Templates</a>

                        <?php }elseif($current_user->role_id == 9){ ?>

                                     <a id="distributor_xl" href="javascript:void(0);" onclick='window.open("<?php echo base_url('assets/uploads/Uploads/rol/rol_distributor.xlsx'); ?>","_blank" );' class="btn btn-default distributor_xl">Download Templates</a>

                        <?php }elseif($current_user->role_id == 10){ ?>

                                      <a id="retailer_xl" href="javascript:void(0);" onclick='window.open("<?php echo base_url('assets/uploads/Uploads/rol/rol_retailer.xlsx'); ?>","_blank" );' class="btn btn-default retailer_xl">Download Templates</a>
                        <?php } ?>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>

<?php } ?>

