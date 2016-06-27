<!--<style type="text/css">
table.main {
  width: 300px; 
border: 1px solid black;
	background-color: #9dffff;
}
table.main td {
vertical-align: top;
font-family: verdana,arial, helvetica,  sans-serif;
font-size: 11px;
}
table.main th {
	border-width: 1px 1px 1px 1px;
	padding: 0px 0px 0px 0px;
 background-color: #ccb4cd;
}
table.main a{TEXT-DECORATION: none;}
table,td{ border: 1px solid #ffffff }
</style> -->
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
        <div class="forecast_status_data" id="no-more-tables">
        	
        	<?php echo $calender_data; ?>
            
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

<div class="clearfix"></div>