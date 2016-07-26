<?php
$attributes = array('class' => '', 'id' => 'add_forecast','name'=>'add_forecast');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('esp/add_forecast',$attributes); ?>
<!--------------------------------------Filter1-------------------------------------------------->
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
        	
        	<div class="col-md-12 text-center sub_nave">
                <div class="inn_sub_nave">
                    <ul>
                        <li class="<?php echo ($this->uri->segment(1)=='esp' && $this->uri->segment(2)=='') ? 'active' :'' ;?>"><a href="<?php echo base_url('/esp') ?>">Plan</a></li>
                        <li class="<?php echo ($this->uri->segment(1)=='esp' && $this->uri->segment(2)=='forecast_status') ? 'active' :'' ;?>"><a href="<?php echo base_url('/esp/forecast_status') ?>">Status</a></li>
                        
                        <li class="<?php echo ($this->uri->segment(1)=='esp' && $this->uri->segment(2)=='impact_entry') ? 'active' :'' ;?>"><a href="<?php echo base_url('/esp/impact_entry') ?>">Impact Entry</a></li>
                        
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        	
            
             <input class="login_user_role" type="hidden" name="login_user_role" id="login_user_role" value="<?php echo $current_user->role_id; ?>" /> 
            <input class="login_user_id" type="hidden" name="login_user_id" id="login_user_id" value="<?php echo $current_user->id; ?>" /> 
            <input class="login_user_countryid" type="hidden" name="login_user_countryid" id="login_user_countryid" value="<?php echo $current_user->country_id; ?>" /> 


            <div class="col-md-12 text-center tp_form inline-parent" style="margin-top: 20px;">
                <div class="form-group">
                    <label for="From Month">From Month<span style="color: red">*</span></label>
                    <div class="inln_fld_top">
                        <input type="text" class="form-control" name="from_month" id="from_month" placeholder="">
                        <div class="clearfix"></div>
                        <label id="invoice_no_error" class="error" for="invoice_no"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="To Month">To Month<span style="color: red">*</span></label>
                    <div class="inln_fld_top">
                        <input type="text" class="form-control" name="to_month" id="to_month" placeholder="">
                        <div class="clearfix"></div>
                        <label id="to_month-error" class="error" for="to_month"></label>
                    </div>
                </div>
                <div class="inl_button save_btn">
                    <button type="button" id="exeute" href="javascript:void(0);" class="btn btn-primary gren_btn">Execute</button>
                </div>
            </div>
            
            
            <div class="clearfix"></div>
    
            <div class="col-md-12 text-center tp_form inline-parent" id="user_level_data">
                <!--MULTIPLE LEVEL DROPDOWNS--->
                
                
                
            </div>

            <div class="clearfix"></div>
            
            <div class="col-md-12 text-center tp_form inline-parent" id="pbg_data">
                
            </div>
            
            
        </div>
    </div>
    <div class="clearfix"></div>
   
</div>
<!--------------------------------------Filter2-------------------------------------------------->

<div class="col-md-12">
    <div class="row">
        <div class="middle_form">
         <!--   <div class="row" id="middle_filter">
                
               
            </div> -->
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!--------------------------------------Table-------------------------------------------------->
<div class="col-md-12">
    <div class="row">
        <div class="forecast_data" id="no-more-tables">
            
        </div>
        
    </div>
</div>

<!--------------------------------------Save & Upload Data-------------------------------------------------->
<div class="save_button" style="display: none">
    <div class="col-md-12 table_bottom">
        <div class="row">
           
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<div class="clearfix"></div>

<div class="col-md-12 table_bottom">

    <div class="row">
        <div class="col-md-3 save_btn"></div>
        <?php
        $attributes = array('class' => '', 'id' => 'upload_esp_forecast_data','name'=>'upload_esp_forecast_data');
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
                	<a id="download_forecast_data_xl" href="<?php echo base_url('/esp/generate_forecast_xl_data') ?>"  class="btn btn-default">Download Templates</a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
