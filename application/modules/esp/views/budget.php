<?php
$attributes = array('class' => '', 'id' => 'add_budget','name'=>'add_budget');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('esp/add_budget',$attributes); ?>
<!--------------------------------------Filter1-------------------------------------------------->
<div class="col-md-12">
    <div class="top_form">
        <div class="row">
        	            
             <input class="login_user_role" type="hidden" name="login_user_role" id="login_user_role" value="<?php echo $current_user->role_id; ?>" /> 
            <input class="login_user_id" type="hidden" name="login_user_id" id="login_user_id" value="<?php echo $current_user->id; ?>" /> 
            <input class="login_user_countryid" type="hidden" name="login_user_countryid" id="login_user_countryid" value="<?php echo $current_user->country_id; ?>" /> 
            
            <div class="col-md-3 col-sm-6 tp_form">
                <div class="form-group">
                    <label for="year">Year<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="year_data" id="year_data" placeholder="" />
                    <label id="invoice_no_error" class="error" for="invoice_no"></label>
                </div>
                
                <div class="form-group" id="lock_area">
                <!--	<a rel="" href="javascript:void(0);" id="lock_data"><i class="fa fa-lock" aria-hidden="true"></i></a>
                	<input type="hidden" name="lock_status" id="lock_status_data" class="lock_status_data" value="Lock" /> -->
                </div>
            </div>
            
          <!--  <div class="col-md-3 col-sm-6 tp_form">
                <div class="form-group">
                    <button id="exeute" href="javascript:void(0);" class="btn btn-default">Execute</button>
                </div>
            </div> -->
            
            
            <div class="clearfix"></div>
    
            <div class="col-md-4_ tp_form" id="user_level_data">            
                <!--MULTIPLE LEVEL DROPDOWNS--->
                
                
                
            </div>

            <div class="clearfix"></div>
            
            <div class="col-md-2_ tp_form" id="pbg_data">
                
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
                
                
               
               
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!--------------------------------------Table-------------------------------------------------->
<div class="col-md-12">
    <div class="row">
        <div class="budget_data" id="no-more-tables">
            
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