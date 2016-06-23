<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Esp controller
 */

class Esp extends Front_Controller
{
    protected $permissionCreate = 'Esp.Esp.Create';
    protected $permissionDelete = 'Esp.Esp.Delete';
    protected $permissionEdit   = 'Esp.Esp.Edit';
    protected $permissionView   = 'Esp.Esp.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
        
		$this->load->library('users/auth');
		//$this->auth->restrict($this->permissionView);
		$this->load->helper('application');
		$this->load->library('Template');
		$this->load->library('Assets');
		$this->lang->load('application');
		$this->load->library('events');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->lang->load('esp');
		$this->load->model('esp_model');
		$this->set_current_user();
        

		Assets::add_module_js('esp', 'esp.js');
	}

	/**
	 * Display a list of ESP data.
	 *
	 * @return void
	 */
	public function index()
	{
		$user = $this->auth->user();
        Template::set('current_user', $user);
		Template::render();
	}
    
    public function get_user_level_data($userid=null){
        
        if(isset($_POST["userid"]) && $userid == null){
            $userid = $_POST["userid"];
            
            $user_data = $this->esp_model->get_user_data($userid);
        
            $html = "";

            if($user_data != 0){

                $html .= '<div class="form-group">';
                        $html .= '<label>Level<span style="color: red">*</span></label>';
                        $html .= '<select class="employee_data"  id="employee_data" name="employee_data" data-live-search="true">';
                        $html .= '<option value="">Select Employee</option>';
                        foreach($user_data as $key=>$value){ 
                            $html .= '<option value="'.$value['id'].'">'.$value['display_name'].'</option>';
                        }
                        $html .= '</select>';
                $html .= '</div>';

            }

            echo $html;
            die;
            
        }
        else{
            $userid = $userid;
            
            $user_data = $this->esp_model->get_user_data($userid);
            
            return $user_data;
            
        }
        
    }
    
    public function get_pbg_data(){
        
        $user = $this->auth->user();
        $user_country = $user->country_id;
        
        $pbg_data = $this->esp_model->get_pbg_data($user_country);
        
        $html = "";
        
        if($pbg_data != 0){
            
            $html .= '<div class="form-group">';
                    $html .= '<label>Select PBG <span style="color: red">*</span></label>';
                    $html .= '<select class="pbg_data"  id="pbg_data" name="pbg_data" data-live-search="true">';
                    $html .= '<option value="">Select PBG</option>';
                    foreach($pbg_data as $key=>$value){ 
                        $html .= '<option value="'.$value['product_country_id'].'">'.$value['product_country_name'].'</option>';
                    }
                    $html .= '</select>';
            $html .= '</div>';
            
        }
        
        echo $html;
        die;
        
    }
    
    /*
    * Function Name : get_pbg_sku_data
    * Function Description : Logic For Freeze / Edit / Visiblity of of Forecast data
    *       
    *       check login user equal to freezed user if equal than make data visible and editable else not for   *       login user
    *       If login user is parent of freezed user than he will able to see the forecast data entered by       *       juinor else not        
    */
    
    
    public function get_pbg_sku_data(){
        
        $user = $this->auth->user();
        $login_user_id = $user->id;
        
        $pbgid = $_POST["pbgid"];
        $from_month = $_POST["frommonth"];
        $to_month = $_POST["tomonth"];
        
        $businesscode = $_POST["businesscode"];
        
        $pbg_sku_data = $this->esp_model->get_pbg_sku_data($pbgid);
        $month_data = $this->get_monthly_data($from_month,$to_month);
        
        $assumption_data = $this->esp_model->get_assumption_data();
        
        $lock_show_data = $this->get_user_level_data($login_user_id);
        
                
        $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);
        
        $html = "";
        $html1 = "";
        $html2 = "";
        
        if($pbg_sku_data != 0){
            
            $html .= '<table class="col-md-12 table-bordered table-striped table-condensed cf">';
                $html .= '<thead>';
                    $html .= '<tr>';
                        $html .= '<th></th>';
                        foreach($month_data as $monthkey => $monthvalue){
                            
                            $time=strtotime($monthvalue);
                            $month=date("F",$time);
                            $year=date("Y",$time);
                            
                            if($lock_show_data != 0){
                                
                                foreach($pbg_sku_data as $skukey => $skuvalue){
                                    
                                 $employee_month_product_forecast_data1 = $this->esp_model->get_employee_month_product_forecast_data($businesscode,$skuvalue['product_sku_country_id'],$monthvalue);
                    
                                 $lock_status = 0;
                                 $lock_by_id = "";
                                 $check_lock_forecast_id = "";

                            //    echo "<pre>";
                            //    print_r($employee_month_product_forecast_data);

                                if($employee_month_product_forecast_data1 != 0){

                                   // $lock_status = $employee_month_product_forecast_data1[0]['lock_status'];
                                   // $lock_by_id = $employee_month_product_forecast_data1[0]['lock_by_id'];
                                    $check_lock_forecast_id = $employee_month_product_forecast_data1[0]['forecast_id'];

                                   $forecast_lock_history_data =  $this->esp_model->get_employee_month_product_forecast_lock_data($login_user_id,$check_lock_forecast_id,$monthvalue);
                                    if(!empty($forecast_lock_history_data)){
                                        $lock_status = $forecast_lock_history_data[0]['lock_status'];
                                    }
                                
                                }
                                    
                                if($lock_status == 0){
                                    
                                        $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;' rel='".$monthvalue."' href='javascript:void(0);' class='lock_data' >Lock</a></div>";
                                    }
                                    else{
                                        $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;' rel='".$monthvalue."' href='javascript:void(0);' class='lock_data' >Unlock</a></div>";
                                    } 
                            
                                }
                            }
                            else{
                                $lock_data = "";
                            }
                            
                            $html .= '<th colspan="2">'.$month.'-'.$year.'&nbsp;&nbsp;'.$lock_data.'</th>';
                        }
                       
                   $html .= '</tr>';
                   $html .= '<tr>';
                   $html .= '<th>';
                   $html .= 'PBG';
                   $html .= '</th>';
             foreach($month_data as $monthkey => $monthvalue)
             {
                $html .= '<th>';
                $html .= 'Forecast Qty';
                $html .= '</th>';
                $html .= '<th>';
                $html .= 'Forecast Value';
                $html .= '</th>';
             }
                $html .= '<th>';
                $html .= 'Yearly';
                $html .= '</th>';
                $html .= '</tr>';
                $html .= '</thead>';
           $html .= '<tbody>';
            $i = 1;
            
            $forecast_id = "";
            
            foreach($pbg_sku_data as $skukey => $skuvalue){
              $html .= '<tr>';
              $html .= '<td><input type="hidden" name="product_sku_id[]" value="'.$skuvalue['product_sku_country_id'].'" />'.$skuvalue['product_sku_name'].'</td>';
                
                $l = 1;
                
                foreach($month_data as $monthkey => $monthvalue){
                    
                    
                    $employee_month_product_forecast_data = $this->esp_model->get_employee_month_product_forecast_data($businesscode,$skuvalue['product_sku_country_id'],$monthvalue);
                    
                    $forecast_qty = "";
                    $forecast_value = "";
                    
                     $lock_status = "";
                     $lock_by_id = "";
                    
                //    echo "<pre>";
                //    print_r($employee_month_product_forecast_data);
                    
                    if($employee_month_product_forecast_data != 0){
                        
                        $forecast_qty = $employee_month_product_forecast_data[0]['forecast_quantity'];
                        $forecast_value = $employee_month_product_forecast_data[0]['forecast_value'];
                        
                        
                        $lock_status = $employee_month_product_forecast_data[0]['lock_status'];
                        $lock_by_id = $employee_month_product_forecast_data[0]['lock_by_id'];
                        
                        $forecast_id = $employee_month_product_forecast_data[0]['forecast_id'];
                        
                        
                    }
                    
                    //CHECK DATA FREEZED OR NOT
                    
                    $forecast_freeze_data = $this->esp_model->get_forecast_freeze_status($forecast_id);
                    
                    if($forecast_freeze_data != 0)
                    {
                        //If data Freezed
                        
                        if($forecast_freeze_data['freeze_status'] == 1){
                            //DATA FREEZED
                            
                            if($login_user_id == $forecast_freeze_data['freeze_user_id']){
                                
                                
                                
                                $editable = "";
                                
                                $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);
                                
                                if($login_user_parent_data == $lock_by_id){
                                    
                                    if($lock_status == 1){
                                        $editable = "readonly";
                                    }
                                    else{
                                        $editable = "";
                                    }
                                    
                                }
                                
                                
                             //   echo "1";
                                
                                //check login user equal to freezed user if equal than make data visible and editable else not for login user
                                
                                $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_qty.'"  '.$editable.' /></td>';
                    
                                $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_value.'" readonly /></td>';
                                
                                
                            }else{
                                
                                
                            $freeze_user_parent_data = $this->esp_model->get_freeze_user_parent_data($forecast_freeze_data['freeze_user_id']);
                            
                            if($freeze_user_parent_data != 0){
                                
                              //  echo $login_user_id ."==". $freeze_user_parent_data;
                                
                                if($login_user_id == $freeze_user_parent_data){
                                    
                                    //If login user is parent of freezed user than he will able to see the forecast data entered by juinor else not
                                    
                                    //SHOW FREEZEED DATA
                                    
                                  //  echo "2";
                                    
                                    
                                     $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_qty.'" /></td>';
                    
                                     $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_value.'" readonly /></td>';
                                    
                                }
                                elseif($login_user_id == $forecast_freeze_data['created_by_user']){
                                    
                                    //GET LOCK STATUS
                                    
                                  //  echo "3";
                                    
                                    if($lock_status == 1){
                                        $editable = "readonly";
                                    }
                                    else{
                                        $editable = "";
                                    }
                                    
                                    $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_qty.'" '.$editable.'  /></td>';
                    
                                     $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_value.'" readonly /></td>';
                                    
                                }
                                else{
                                    
                                    //SHOW FREEZED DATA BUT READONLY
                                    
                                  //  echo "4";
                                    
                                     $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="" '.$editable.' /></td>';
                    
                                    $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
                                    
                                }
                            }
                            else{
                                
                                //NOT SHOW FREEZED DATA
                                
                             //   echo "5";
                                    
                                    $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="" /></td>';
                    
                                    $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
                                
                              }
                                
                           }
                            
                        }
                        else{
                            
                            if($login_user_id == $forecast_freeze_data['freeze_user_id']){
                                
                            //    echo "6";
                                
                                $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_qty.'" /></td>';
                    
                                $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_value.'" readonly /></td>';
                                
                            }else{
                                
                                //NOT SHOW FREEZED DATA
                                    
                                    $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="" /></td>';
                    
                                    $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
                                
                            }
                        }
                    }
                    else{
                        
                         $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="" /></td>';
                    
                        $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
                                    
                    }
                        
                    $l++;
                    
                }
               $html .= '<td></td>';
               $html .= '</tr>';
                
            }
            
            $html .= '<tr>';
                $html .= '<th>';
                 //  $html .= '';
                   foreach($month_data as $monthkey => $monthvalue){
                       
                       $html .= '<input type="hidden" name="month_data[]" value="'.$monthvalue.'" />';
                       $html .= '<td>Assumption</td><td>Probability</td>';
                   }
            
                $html .= '</th>';
            $html .= '</tr>';
            
            $assumption_month = array();
            $probablity_month = array();
            
            $lock_status_array = array();
            
            foreach($month_data as $monthkey => $monthvalue){
                     
                $month_assumption_forecast_data = $this->esp_model->get_month_assumption_forecast_data($forecast_id,$monthvalue);
                //testdata($month_assumption_forecast_data);
                
                if($month_assumption_forecast_data != 0)
                {
                    $cur_month = $month_assumption_forecast_data[0]['month_data'];

                    $assumption_month[$cur_month] = array($month_assumption_forecast_data[0]["assumption1_id"],$month_assumption_forecast_data[0]["assumption2_id"],$month_assumption_forecast_data[0]["assumption3_id"]);

                    $probablity_month[$cur_month] = array($month_assumption_forecast_data[0]["probability1"],$month_assumption_forecast_data[0]["probability2"],$month_assumption_forecast_data[0]["probability3"]);

                }
                else
                {
                    $assumption_month[$monthvalue] = array();
                    $probablity_month[$monthvalue] = array();
                }
                
                $month_assumption_forecast_lock_data = $this->esp_model->get_month_assumption_forecast_lock_data($forecast_id,$monthvalue);
                
                if($month_assumption_forecast_lock_data != 0){
                    $lock_status_array[$monthvalue] = $month_assumption_forecast_lock_data[0]["lock_status"];
                }
                else{
                    $lock_status_array[$monthvalue] = "";
                }

            }
           
            $k = 1;
            
             for($a = 1; $a<=3; $a++){
                
                $html .= '<tr>';
                $html .= '<td></td>';
                 
                $j = 1;
                 
                    foreach($month_data as $monthkey => $monthvalue){
                       
                        
                        $html .= '<td>';
                        
                        //FOR GETTING ASSUMPTION DATA
                        
                         if(isset($assumption_month[$monthvalue][$a-1]) && !empty($assumption_month[$monthvalue][$a-1])){
                                $assumptiondata = $assumption_month[$monthvalue][$a-1];

                                }
                            else{
                                $assumptiondata = "";
                            }
                        
                        //FOR GETTING PROBABLITY DATA
                        
                        if(isset($probablity_month[$monthvalue][$a-1]) && !empty($probablity_month[$monthvalue][$a-1])){
                            $probablitydata = $probablity_month[$monthvalue][$a-1];
                        }
                        else{
                            $probablitydata = "";
                        }
                        
                        if($lock_status_array[$monthvalue] == 1){
                            $assumption_editable = "disabled";
                            $probablity_editable = "readonly";
                        }
                        else{
                            $assumption_editable = "";
                            $probablity_editable = "";
                        }
                        
                        
                        //CHECK DATA FREEZED OR NOT
                    
                    $forecast_freeze_data = $this->esp_model->get_forecast_freeze_status($forecast_id);
                    
                    if($forecast_freeze_data != 0)
                    {
                        if($forecast_freeze_data['freeze_status'] == 1){
                            //DATA FREEZED
                            
                            if($login_user_id == $forecast_freeze_data['freeze_user_id']){
                                
                                
                                 $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);
                                
                                if($login_user_parent_data == $lock_by_id){
                                    
                                    if($lock_status_array[$monthvalue] == 1){
                                        $assumption_editable = "disabled";
                                        $probablity_editable = "readonly";
                                    }
                                    else{
                                        $assumption_editable = "";
                                        $probablity_editable = "";
                                    }
                                    
                                }
                                
                                
                                
                                
                                $html .= '<div class="col-md-3 col-sm-3 tp_form">
	<div class="form-group"><select '.$assumption_editable.' class="selectpicker" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption'.$j.'[]" >
                        
                        <option value= "">Select Assumption</option>';
                        foreach($assumption_data as $assumption_key => $assumption)
                        {
                          
                             if($assumption['assumption_id'] == $assumptiondata){
                                 $selected = "selected='selected'";
                             }
                             else
                             {
                                 $selected = "";
                             }
                             
                            $html .= '<option '.$selected.' value= "'.$assumption['assumption_id'].'">'.$assumption['assumption_name'].'</option>';
                        }
                        $html .= '</select>';
                        
                        $html .= '</div>
</div></td><td><input type="text" name="probablity'.$j.'[]" value="'.$probablitydata.'" '.$probablity_editable.' />';
                                
                                
                            }else{
                                
                                
                            $freeze_user_parent_data = $this->esp_model->get_freeze_user_parent_data($forecast_freeze_data['freeze_user_id']);
                            
                            if($freeze_user_parent_data != 0){
                                
                                if($login_user_id  == $freeze_user_parent_data){
                                    
                                    //SHOW FREEZEED DATA
                                    
                                        $html .= '<div class="col-md-3 col-sm-3 tp_form">
                <div class="form-group"><select class="selectpicker" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption'.$j.'[]" >

                                    <option value= "">Select Assumption</option>';
                                    foreach($assumption_data as $assumption_key => $assumption)
                                    {

                                         if($assumption['assumption_id'] == $assumptiondata){
                                             $selected = "selected='selected'";
                                         }
                                         else
                                         {
                                             $selected = "";
                                         }

                                        $html .= '<option '.$selected.' value= "'.$assumption['assumption_id'].'">'.$assumption['assumption_name'].'</option>';
                                    }
                                    $html .= '</select>';

                                    $html .= '</div>
            </div></td><td><input type="text" name="probablity'.$j.'[]" value="'.$probablitydata.'" />';
                                     
                                    
                                }
                                elseif($login_user_id == $forecast_freeze_data['created_by_user']){
                                    
                                    //GET LOCK STATUS
                                    
                                        $html .= '<div class="col-md-3 col-sm-3 tp_form">
                <div class="form-group"><select '.$assumption_editable.' class="selectpicker" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption'.$j.'[]" >

                                    <option value= "">Select Assumption</option>';
                                    foreach($assumption_data as $assumption_key => $assumption)
                                    {

                                         if($assumption['assumption_id'] == $assumptiondata){
                                             $selected = "selected='selected'";
                                         }
                                         else
                                         {
                                             $selected = "";
                                         }

                                        $html .= '<option '.$selected.' value= "'.$assumption['assumption_id'].'">'.$assumption['assumption_name'].'</option>';
                                    }
                                    $html .= '</select>';

                                    $html .= '</div>
            </div></td><td><input type="text" '.$probablity_editable.' name="probablity'.$j.'[]" value="'.$probablitydata.'" />';
                                     
                                    
                                }
                                else{
                                    
                                    //NOT SHOW FREEZED DATA
                                    
                                            $html .= '<div class="col-md-3 col-sm-3 tp_form">
            <div class="form-group"><select class="selectpicker" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption'.$j.'[]" >

                                <option value= "">Select Assumption</option>';
                                foreach($assumption_data as $assumption_key => $assumption)
                                {

                                     if($assumption['assumption_id'] == $assumptiondata){
                                         $selected = "selected='selected'";
                                     }
                                     else
                                     {
                                         $selected = "";
                                     }

                                    $html .= '<option  value= "'.$assumption['assumption_id'].'">'.$assumption['assumption_name'].'</option>';
                                }
                                $html .= '</select>';

                                $html .= '</div>
        </div></td><td><input type="text" name="probablity'.$j.'[]" value="" />'; 
                                    
                                    
                                }
                            }
                            else{
                                
                                //NOT SHOW FREEZED DATA
                                   
                                        $html .= '<div class="col-md-3 col-sm-3 tp_form">
            <div class="form-group"><select class="selectpicker" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption'.$j.'[]" >

                                <option value= "">Select Assumption</option>';
                                foreach($assumption_data as $assumption_key => $assumption)
                                {

                                     if($assumption['assumption_id'] == $assumptiondata){
                                         $selected = "selected='selected'";
                                     }
                                     else
                                     {
                                         $selected = "";
                                     }

                                    $html .= '<option  value= "'.$assumption['assumption_id'].'">'.$assumption['assumption_name'].'</option>';
                                }
                                $html .= '</select>';

                                $html .= '</div>
        </div></td><td><input type="text" name="probablity'.$j.'[]" value="" />';
                                
                                
                            }
                                
                                
                            }
                            
                            
                        }
                        else{
                            
                            
                            if($login_user_id == $forecast_freeze_data['freeze_user_id']){
                                
                                $html .= '<div class="col-md-3 col-sm-3 tp_form">
            <div class="form-group"><select class="selectpicker" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption'.$j.'[]" >

                                <option value= "">Select Assumption</option>';
                                foreach($assumption_data as $assumption_key => $assumption)
                                {

                                     if($assumption['assumption_id'] == $assumptiondata){
                                         $selected = "selected='selected'";
                                     }
                                     else
                                     {
                                         $selected = "";
                                     }

                                    $html .= '<option '.$selected.' value= "'.$assumption['assumption_id'].'">'.$assumption['assumption_name'].'</option>';
                                }
                                $html .= '</select>';

                                $html .= '</div>
        </div></td><td><input type="text" name="probablity'.$j.'[]" value="'.$probablitydata.'" />';
                                
                                
                            }else{
                                
                                //NOT SHOW FREEZED DATA
                                    
                                
                                        $html .= '<div class="col-md-3 col-sm-3 tp_form">
            <div class="form-group"><select class="selectpicker" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption'.$j.'[]" >

                                <option value= "">Select Assumption</option>';
                                foreach($assumption_data as $assumption_key => $assumption)
                                {

                                     if($assumption['assumption_id'] == $assumptiondata){
                                         $selected = "selected='selected'";
                                     }
                                     else
                                     {
                                         $selected = "";
                                     }

                                    $html .= '<option value= "'.$assumption['assumption_id'].'">'.$assumption['assumption_name'].'</option>';
                                }
                                $html .= '</select>';

                                $html .= '</div>
        </div></td><td><input type="text" name="probablity'.$j.'[]" value="" />';
                                
                                
                            }
                        }
                    }
                    else{
                        
                                $html .= '<div class="col-md-3 col-sm-3 tp_form">
        <div class="form-group"><select class="selectpicker" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption'.$j.'[]" >

                            <option value= "">Select Assumption</option>';
                            foreach($assumption_data as $assumption_key => $assumption)
                            {

                                 if($assumption['assumption_id'] == $assumptiondata){
                                     $selected = "selected='selected'";
                                 }
                                 else
                                 {
                                     $selected = "";
                                 }

                                $html .= '<option value= "'.$assumption['assumption_id'].'">'.$assumption['assumption_name'].'</option>';
                            }
                            $html .= '</select>';

                            $html .= '</div>
    </div></td><td><input type="text" name="probablity'.$j.'[]" value="" />';        
                        
                    }
                       
                        
                    $html .= '</td>';
                        
                        
                        $j++;
                        
                    }
          
                $html .= '</tr>';
                    $k++;
                 
            }
            
            
            $html .= '</tbody>';
       $html .= '</table>';
           
            $freeze_button = "";
            if($login_user_parent_data != 0){
                
                $freeze_history_user_status_data = $this->esp_model->get_freeze_history_user_status_data($login_user_id,$forecast_id);
                
                if(!empty($freeze_history_user_status_data) && isset($freeze_history_user_status_data[0]['freeze_status'])){
                    
                
                    if($freeze_history_user_status_data[0]['freeze_status'] == 0){
                    
                        $freeze_button = '<div id="freeze_area"><button type="submit" class="btn btn-primary" id="freeze_data">Freeze</button></div>';
                    }
                    else{
                        $freeze_button = '<div id="freeze_area"><button type="submit" class="btn btn-primary" id="freeze_data">Unfreeze</button></div>';
                    }
                    
                }
                else{
                    
                    $freeze_button = '<div id="freeze_area"><button type="submit" class="btn btn-primary" id="freeze_data">Freeze</button></div>';
                    
                }
            }
            
            $html2 .= '<div class="col-md-12 table_bottom text-center">
                <input type="hidden" id="forecast_id" name="forecast_id" value="'.$forecast_id.'" />
                <div class="row">
                    <div class="save_btn">
                        <button type="submit" class="btn btn-primary">Save</button>
                        '.$freeze_button.'
                    </div>
                </div>
            </div>';
                
            
        }
        
        echo $html.$html2;
        die;
        
    }
    
    public function get_forecast_value_data(){
        
        $relattrval = $_POST['relattrval'];
        
        $forecast_data = explode("_",$relattrval);
        
        $product_sku_id = $forecast_data[1];
        $month_data = $forecast_data[2];
        
        $forecastdata = $_POST['forecastdata'];
        
        $forecase_value = $this->esp_model->get_forecast_data($product_sku_id,$month_data);
        
        $final_forecast_value  = $forecastdata*$forecase_value;
        
        echo $final_forecast_value;
        die;
        
    }
    
    public function add_forecast(){
       // testdata($_POST);
      //  $forecast_data = $this->esp_model->add_forecast_data();
        
        if(isset($_POST) && !empty($_POST)){
            
         //   testdata($_POST);
            
            if(!isset($_POST['employee_data']))
            {
                $forecast_user_id = $_POST['login_user_id'];
            }
            else{
                $forecast_user_id = $_POST['employee_data'];
            }
            
            $businss_data = $this->esp_model->get_business_code($forecast_user_id);
            
            $user_business_code = $businss_data;
            
            $pbg_id = $_POST['pbg_data'];
            $created_user_id = $_POST['login_user_id'];
            
            
            //CHECK FOR EMMPLOYEE AND PBG RECORD ALREADY EXIST
            
            
            $final_array = array();

            $i = 1;
            
            $forecast_insert_id = '';

            if(!empty($_POST['month_data'])){
                foreach($_POST['month_data'] as $month_key=>$month_value){
            
                    $check_record_exist = $this->esp_model->check_forecast_data($pbg_id,$user_business_code,$month_value);
                    
                    if($check_record_exist != 0){
                        
                        //UPDATE 
                        
                        $old_forecast_id = $check_record_exist[0]['forecast_id'];
                        
                        //UPDATE MAIN TABLE RECORD
                        
                        $update_status = $this->esp_model->update_forecast_data($old_forecast_id,$created_user_id);
                        
                    }else{
                    
                        //INSERT
                        if($forecast_insert_id == ""){
                                $forecast_insert_id = $this->esp_model->insert_forecast_data($pbg_id,$created_user_id,$user_business_code,$_POST['login_user_id']);
                        }
                        
                    }
                    
                    foreach($_POST['product_sku_id'] as $pkey=>$product_data){

                        $initial_array_forecastqty = $_POST['forecast_qty'][$product_data][$month_key];

                        $initial_array_forecastvalue = $_POST['forecast_value'][$product_data][$month_key];

                        $final_array[$month_value]['productid'][$product_data]['forecast_qty'] = $initial_array_forecastqty;

                        $final_array[$month_value]['productid'][$product_data]['forecast_value'] = $initial_array_forecastvalue;

                    }

                        if(isset($_POST['assumption'.$i])){
                            $initial_array_assumption = $_POST['assumption'.$i];
                        }
                        else{
                            $initial_array_assumption = array();
                        }
                        $initial_array_probablity = $_POST['probablity'.$i];
                    
                       // if($initial_array_assumption != "")
                    
                        $final_array[$month_value]['assumption'] = $initial_array_assumption;
                        $final_array[$month_value]['probablity'] = $initial_array_probablity;
                    
                    
                     $i++;
                }
            }
             
           // testdata($final_array);
            
            if(!empty($final_array)){
                foreach($final_array as $key_data => $data){
                    
                    $old_forecast_id = "";
                    
                    $month_data = $key_data;
                    
                    foreach($data["productid"] as $product_id => $product_data){
                        
                        $forecast_qty = $product_data["forecast_qty"];
                        $forecast_value = $product_data["forecast_value"];
                        
                        $get_product_old_data = $this->esp_model->get_forecast_product_details($businss_data,$product_id,$month_data);
                        
                        if($get_product_old_data != 0){

                            //UPDATE MAIN TABLE RECORD
                            
                            $forecast_product_id = $get_product_old_data[0]['forecast_product_id'];
                            $old_forecast_id = $get_product_old_data[0]['forecast_id'];

                            $update_status = $this->esp_model->update_forecast_product_details($forecast_product_id,$forecast_qty,$forecast_value);

                        }else{

                            $this->esp_model->insert_forecast_product_details($forecast_insert_id,$businss_data,$product_id,$month_data,$forecast_qty,$forecast_value);

                        }
                        
                    }
                   
                    $assumption_data = "";
                    $probablity_data = "";
                    
                    if(!empty($data["assumption"])){
                        
                        $assumption_data = implode("~",$data["assumption"]);
                        $probablity_data = implode("~",$data["probablity"]);


                       // echo $old_forecast_id."</br>";

                        $get_assumption_old_data = $this->esp_model->get_forecast_assumption_details($old_forecast_id,$month_data);

                        if($get_product_old_data != 0){

                            //UPDATE MAIN TABLE RECORD

                            $forecast_assumption_id = $get_assumption_old_data[0]['forecast_assumption_id'];

                            $update_status = $this->esp_model->update_forecast_assumption_details($forecast_assumption_id,$assumption_data,$probablity_data);

                        }else{ 

                           $this->esp_model->insert_forecast_assumption_probablity_data($forecast_insert_id,$assumption_data,$probablity_data,$month_data);
                        }
                    }

                }
                
            }
            
            echo "<pre>";
            print_r($final_array);
            
            die;
        }
        
        redirect('esp/');
        
    }
    
    public function get_business_code(){
        
        $business_data = $this->esp_model->get_business_code(NULL);
        echo $business_data;
        die;
    }
    
    public function update_forecast_freeze_status(){
        
        $user = $this->auth->user();
        $forecast_id = $_POST["forecastid"];
        $text_data = $_POST["textdata"];
        $freeze_data = $this->esp_model->update_forecast_freeze_status_data($user->id,$forecast_id,$text_data);
        
        echo $freeze_data;
        die;
        
    }
    
    public function set_forecast_lock_data(){
        
        $user = $this->auth->user();
        $forecast_id = $_POST["forecastid"];
        $monthval = $_POST["monthval"];
        
        $text_data = $_POST["textdata"];
        
        $lock_data = $this->esp_model->update_forecast_lock_status_data($user->id,$forecast_id,$monthval,$text_data);
        
        echo $lock_data;
        die;
        
    }
    
    public function get_monthly_data($from_month,$to_month) {
        
            $from_date = $from_month."-01";
            $to_date = $to_month."-01";
        
            $date1  = $from_date;
            $date2  = $to_date;
            $month_output = array();
            $time   = strtotime($from_date);
            $last   = date('Y-m', strtotime($to_date));

            do {
                $month = date('Y-m', $time);
                $total = date('t', $time);

               /* $output[] = array(
                    'month' => $month,
                    'total' => $total,
                );*/

                $month_output[] = $month."-01";
                        
                $time = strtotime('+1 month', $time);
            } while ($month != $last);


            return $month_output;
        
    }
    
}