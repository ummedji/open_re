<?php
$attributes = array('class' => '', 'id' => 'add_user_credit_limit','name'=>'add_user_credit_limit');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('',$attributes); ?>
<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
            <div class="col-md-12 text-center tp_form">
                <div class="form-group">
                    <label>Distributor Name<span style="color: red">*</span></label>
                    <select class="selectpicker" name="dist_limit" id="dist_limit">
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
                            <label for="credit_limit">Credit Limit<span style="color: red">*</span></label>
                            <div class="inln_fld">
                                <input type="text" class="form-control allownumericwithdecimal" name="credit_limit" id="credit_limit" placeholder="">
                                <div class="clearfix"></div>
                                <label id="credit_limit-error" class="error" for="credit_limit"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3_ tp_form">
                        <div class="form-group">
                            <label for="invoice_date">Current Outstanding<span style="color: red">*</span></label>
                            <div class="inln_fld">
                                <input type="text" class="form-control allownumericwithdecimal" name="curr_outstanding" id="curr_outstanding" placeholder="">
                                <div class="clearfix"></div>
                                <label id="curr_outstanding-error" class="error" for="curr_outstanding"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2_ tp_form">
                        <div class="form-group">
                            <label for="curr_date">Date<span style="color: red">*</span></label>
                            <div class="inln_fld">
                                <input type="text" class="form-control" name="curr_date" id="curr_date" placeholder="">
                                <div class="clearfix"></div>
                                <label id="curr_date-error" class="error" for="curr_date"></label>
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
<?php } ?>
<div id="middle_container">
    <?php
    echo theme_view('common/middle');
    ?>
</div>

<?php echo form_close(); ?>

<div class="clearfix"></div>

<?php if (!$this->input->is_ajax_request()) { ?>
<div class="col-md-12 table_bottom">
    
    <div class="row">
        <div class="col-md-3 save_btn"></div>
      <!--  <div class="col-md-3 save_btn"><button type="button" class="btn btn-primary">Save</button></div> -->
     <?php 
         $attributes = array('class' => '', 'id' => 'upload_credit_limit_data','name'=>'upload_credit_limit_data');
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

                <div class="col-md-8 chech_data"><button type="submit" class="btn btn-default">Check Data</button>
                    <a id="distributor_xl" href="javascript:void(0);" onclick='window.open("<?php echo base_url('assets/uploads/Uploads/credit_limit/creditlimit_data.xlsx'); ?>","_blank" );' class="btn btn-default">Download Templates</a> </div>
                
                <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php } ?>