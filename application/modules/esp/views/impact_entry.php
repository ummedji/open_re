<?php

$attributes = array('class' => '', 'id' => 'impact_entry','name'=>'impact_entry');
//echo form_open($this->uri->uri_string(),$attributes);
echo form_open('esp/add_impact_entry',$attributes); ?>
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
            
            <div class="col-md-3 col-sm-6 tp_form">
                <div class="form-group">
                    <label for="From Month">From Month<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="from_month" id="from_month" placeholder="">
                   
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 tp_form">
                <div class="form-group">
                    <a id="view_impact_entry" href="javascript:void(0);" class="btn btn-default">View</a>
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
                
                
               
               
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!--------------------------------------Table-------------------------------------------------->
<div class="col-md-12">
    <div class="row">
        <div class="impact_entry_data" id="no-more-tables">
            
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