<?php
$attributes = array('class' => '', 'id' => 'add_company_current_stock','name'=>'add_company_current_stock');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('ishop/company_current_stock',$attributes); ?>
<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
                <div class="col-md-12 text-center tp_form inline-parent">
                    <div class="form-group">
                        <label>Date<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="current_date" id="current_date" placeholder="" autocomplete="off" >
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 tp_form">
                    <div class="form-group fulle_wd">
                            <label style="display: block;">Product Sku<span style="color: red">*</span></label>
                            <select class="selectpicker" name="product_sku" id="sales_prod_sku" data-live-search="true">
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
                </div>
                <div class="col-md-4 col-sm-4 tp_form">
                    <div class="form-group">
                        <label for="intransist_qty">Intransist Qty.<span style="color: red">*</span></label>
                        <input type="text" class="form-control allownumericwithdecimal" name="intransist_qty" id="intransist_qty" placeholder="">
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 tp_form">
                    <div class="form-group">
                        <label for="unrusticted_qty">Unrusticted Qty.<span style="color: red">*</span></label>
                        <input type="text" class="form-control allownumericwithdecimal" name="unrusticted_qty" id="unrusticted_qty" placeholder="">
                    </div>
                </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
                <div class="row">
                    <div class="col-md-2_ tp_form">
                        <div class="form-group">
                            <label for="batch">Batch<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="batch" id="batch" placeholder="">
                        </div>
                        <div class="wieght_sp toggle_wieght_sp"></div>
                    </div>
                    <div class="col-md-3_ tp_form">
                        <div class="form-group">
                            <label for="batch_mfg_date">Batch Mfg.Date<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="batch_mfg_date" id="batch_mfg_date" placeholder="" autocomplete="off" >
                        </div>
                    </div>
                    <div class="col-md-3_ tp_form">
                        <div class="form-group">
                            <label for="batch_expiry_date">Batch Expiry Date<span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="batch_expiry_date" id="batch_expiry_date" placeholder="" autocomplete="off" >
                        </div>
                    </div>
                    <div class="svn_btn"><button type="submit" class="btn btn-primary gren_btn">Save</button></div>
                </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php } ?>
<?php echo form_close(); ?>

<?php $attributes = array('class' => '', 'id' => 'update_current_stock','name'=>'update_current_stock');
echo form_open('',$attributes); ?>
<div id="middle_container" class="current_stock_container">
<?php
    echo theme_view('common/middle');
?>
</div>
<?php echo form_close(); ?>

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

<div class="clearfix"></div>
<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12 table_bottom">
    
    <div class="row">
        <div class="col-md-3 save_btn"></div>
      <!--  <div class="col-md-3 save_btn"><button type="button" class="btn btn-primary">Save</button></div> -->
     <?php 
         $attributes = array('class' => '', 'id' => 'upload_current_stock_data','name'=>'upload_current_stock_data');
         echo form_open_multipart('',$attributes);
     ?>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-1 upload_text">Upload: </div>
                <div class="col-md-3 upload_file_space">
                    <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Browse <input type="file" name="upload_file_data" id="upload_file_data" />
                    </span> 
                </span>
                       <input type="text" class="form-control" readonly> 
                    </div>
                    <label id="upload_file_data-error" class="error" for="upload_file_data"></label>
                    <div class="clearfix"></div>
                </div>

                <div class="col-md-8 chech_data"><button type="submit" class="btn btn-default">Check Data</button> <a id="distributor_xl" href="javascript:void(0);" onclick='window.open("<?php echo base_url('assets/uploads/Uploads/company_current_stock/companycurrentstock_data.xlsx'); ?>","_blank" );' class="btn btn-default">Download Templates</a> </div>
                
                <?php echo form_close(); ?>
                
            <!--</div>-->
        </div>
    </div>
</div>
<?php } ?>