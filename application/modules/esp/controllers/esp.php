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
        
	}

	/**
	 * Display a list of ESP data.
	 *
	 * @return void
	 */
	public function index()
	{
		Assets::add_module_js('esp', 'esp.js');
		
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
                        $html .= '<select class="employee_data selectpicker"  id="employee_data" name="employee_data" data-live-search="true">';
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
                    $html .= '<select class="pbg_data selectpicker"  id="pbg_data" name="pbg_data" data-live-search="true">';
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
    
    
    public function get_pbg_sku_data($webservice_data=null){
        		
        	
        if($webservice_data == NULL){
        	
			//IF NOT WEBSERVICE
			
	        $user = $this->auth->user();
	        $login_user_id = $user->id;
	        
	        $pbgid = $_POST["pbgid"];
	        $from_month = $_POST["frommonth"];
	        $to_month = $_POST["tomonth"];
	        
	        $businesscode = $_POST["businesscode"];
		}
		else{
			
			//IF WEBSERVICE
			
			$login_user_id = $webservice_data['login_user_id'];
	        
	        $pbgid = $webservice_data['pbg_id'];
	        $from_month = $webservice_data['from_month'];
	        $to_month = $webservice_data['to_month'];
	        
	        $businesscode = $webservice_data['business_code'];
			
			//testdata($webservice_data);
			
		}
		
		
        $pbg_sku_data = $this->esp_model->get_pbg_sku_data($pbgid);
        $month_data = $this->get_monthly_data($from_month,$to_month);
        
        $assumption_data = $this->esp_model->get_assumption_data();
        
        $lock_show_data = $this->get_user_level_data($login_user_id);
        
        $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);
        
        $html = "";
        $html1 = "";
        $html2 = "";
		
		$webservice_final_array = array();
        
        if($pbg_sku_data != 0){
            
            $html .= '<table class="col-md-12 table-bordered table-striped table-condensed cf">';
                $html .= '<thead>';
                    $html .= '<tr style="border-bottom: solid 1px #b1b1b1;">';
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
                                    
                                        $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;' rel='".$monthvalue."' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true'></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Lock' /></a></div>";
                                    }
                                    else{
                                        $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;' rel='".$monthvalue."' href='javascript:void(0);' class='lock_data' ><i class='fa fa-unlock-alt' aria-hidden='true''></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Unlock' /></a></div>";
                                    } 
                            
                                }
                            }
                            else{
                                $lock_data = "";
                            }
                            
                            $html .= '<th colspan="2"><span class="rts_bordet"></span>'.$month.'-'.$year.'&nbsp;&nbsp;'.$lock_data.'</th>';
							
                        }
                       
                   $html .= '</tr>';
                   $html .= '<tr>';
                   $html .= '<th><span class="rts_bordet"></span>';
                   $html .= 'PBG';
                   $html .= '</th>';
             foreach($month_data as $monthkey => $monthvalue)
             {
                $html .= '<th><span class="rts_bordet"></span>';
                $html .= 'Forecast Qty';
                $html .= '</th>';
                $html .= '<th><span class="rts_bordet"></span>';
                $html .= 'Forecast Value';
                $html .= '</th>';
             }
                $html .= '<th><span class="rts_bordet"></span>';
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

					if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
						$data_inner_array = array();
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
                                
                                
                               // echo "1";
                                
                                //check login user equal to freezed user if equal than make data visible and editable else not for login user
                                
                                $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_qty.'"  '.$editable.' /></td>';
                    
                                $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_value.'" readonly /></td>';
                                
                              if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){ 
									$data_inner_array["forecast_qty"] = $forecast_qty;
									$data_inner_array["forecast_value"] = $forecast_value;
							  }
								
								
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
                                    
									
								  if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){ 
										$data_inner_array["forecast_qty"] = $forecast_qty;
										$data_inner_array["forecast_value"] = $forecast_value;
								  }
									
                                }
                                elseif($login_user_id == $forecast_freeze_data['created_by_user']){
                                    
                                    //GET LOCK STATUS
                                    
                                   // echo "3";
                                    
                                    if($lock_status == 1){
                                        $editable = "readonly";
                                    }
                                    else{
                                        $editable = "";
                                    }
                                    
                                    $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_qty.'" '.$editable.'  /></td>';
                    
                                     $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_value.'" readonly /></td>';
                                    
									
									if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){ 
											$data_inner_array["forecast_qty"] = $forecast_qty;
											$data_inner_array["forecast_value"] = $forecast_value;
									 }
									
                                }
                                else{
                                    
                                    //SHOW FREEZED DATA BUT READONLY
                                    
                                   // echo "4";
                                    
                                     $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value=""  /></td>';
                    
                                    $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
                                    
									
								  if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){ 
										$data_inner_array["forecast_qty"] = "";
										$data_inner_array["forecast_value"] = "";
								  }
									
                                }
                            }
                            else{
                                
                                //NOT SHOW FREEZED DATA
                                
                               // echo "5";
                                    
                                    $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="" /></td>';
                    
                                    $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
                                
                                
								  if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){ 
										$data_inner_array["forecast_qty"] = "";
										$data_inner_array["forecast_value"] = "";
								  }
								
                              }
                                
                           }
                            
                        }
                        else{
                            
                            if($login_user_id == $forecast_freeze_data['freeze_user_id']){
                                
                              //  echo "6";
                                
                                $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_qty.'" /></td>';
                    
                                $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_value.'" readonly /></td>';
                                
								if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){ 
									$data_inner_array["forecast_qty"] = $forecast_qty;
									$data_inner_array["forecast_value"] = $forecast_value;
							    }
								
                            }
                            elseif($login_user_id == $forecast_freeze_data['created_by_user']){
                                
                               // echo "7";
                                
                                $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_qty.'" /></td>';
                    
                                $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_value.'" readonly /></td>';
                                
								
								if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){ 
									$data_inner_array["forecast_qty"] = $forecast_qty;
									$data_inner_array["forecast_value"] = $forecast_value;
							    }
								
                            }
                            else{
                                
                               // echo "8";
                                //NOT SHOW FREEZED DATA
                                    
                                    $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="" /></td>';
                    
                                    $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
                                
								
								if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){ 
									$data_inner_array["forecast_qty"] = "";
									$data_inner_array["forecast_value"] = "";
							    }
								
                            }
                        }
                        
						
						if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
							
							//$data_inner_array = array();
							
							//$data_inner_array["forecastid"] = $forecast_id;
							
							$data_inner_array["productid"] = $skuvalue['product_sku_country_id'];
							$data_inner_array["productname"] = $skuvalue['product_sku_name'];
							//$data_inner_array["forecast_qty"] = $forecast_qty;
							//$data_inner_array["forecast_value"] = $forecast_value;
							
							$webservice_final_array[$monthvalue]["monthname"] = $monthvalue;
							$webservice_final_array[$monthvalue]['productdata'][] = $data_inner_array;
							if($lock_status == ""){
								$lock_status = 0;
							}
							$webservice_final_array[$monthvalue]["lock_status"] = $lock_status;
						
						}
						
						
                    }
                    else{
                        
                       // echo "9";
                        
                         $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="" /></td>';
                    
                        $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
						
						
						if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
							
							$data_inner_array = array();
							
							//$data_inner_array["forecastid"] = $forecast_id;
							
							$data_inner_array["productid"] = $skuvalue['product_sku_country_id'];
							$data_inner_array["productname"] = $skuvalue['product_sku_name'];
							$data_inner_array["forecast_qty"] = $forecast_qty;
							$data_inner_array["forecast_value"] = $forecast_value;
							
							$webservice_final_array[$monthvalue]["monthname"] = $monthvalue;
							$webservice_final_array[$monthvalue]['productdata'][] = $data_inner_array;
							$webservice_final_array[$monthvalue]["lock_status"] = 0;
						
						}
            
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

					if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
						
						if(isset($month_assumption_forecast_data[0]["assumption1_id"]) && $month_assumption_forecast_data[0]["assumption1_id"] != ""){
							$assumption1_id = $month_assumption_forecast_data[0]["assumption1_id"];
						}else{
							$assumption1_id = "";
						}
						
						if(isset($month_assumption_forecast_data[0]["assumption2_id"]) && $month_assumption_forecast_data[0]["assumption2_id"] != ""){
							$assumption2_id = $month_assumption_forecast_data[0]["assumption2_id"];
						}else{
							$assumption2_id = "";
						}
												
						if(isset($month_assumption_forecast_data[0]["assumption3_id"]) && $month_assumption_forecast_data[0]["assumption3_id"] != ""){
							$assumption3_id = $month_assumption_forecast_data[0]["assumption3_id"];
						}else{
							$assumption3_id = "";
						}
						
						
						if(isset($month_assumption_forecast_data[0]["probability1"]) && $month_assumption_forecast_data[0]["probability1"] != ""){
							$probability1 = $month_assumption_forecast_data[0]["probability1"];
						}else{
							$probability1 = "";
						}
						
						if(isset($month_assumption_forecast_data[0]["probability2"]) && $month_assumption_forecast_data[0]["probability2"] != ""){
							$probability2 = $month_assumption_forecast_data[0]["probability2"];
						}else{
							$probability2 = "";
						}
						
						if(isset($month_assumption_forecast_data[0]["probability3"]) && $month_assumption_forecast_data[0]["probability3"] != ""){
							$probability3 = $month_assumption_forecast_data[0]["$probability3"];
						}else{
							$probability3 = "";
						}
						
	                    $assumption_month[$cur_month] = array($assumption1_id,$assumption2_id,$assumption3_id);
	
	                    $probablity_month[$cur_month] = array($probability1,$probability2,$probability3);
						
						
					}else{
	                    $assumption_month[$cur_month] = array($month_assumption_forecast_data[0]["assumption1_id"],$month_assumption_forecast_data[0]["assumption2_id"],$month_assumption_forecast_data[0]["assumption3_id"]);
	
	                    $probablity_month[$cur_month] = array($month_assumption_forecast_data[0]["probability1"],$month_assumption_forecast_data[0]["probability2"],$month_assumption_forecast_data[0]["probability3"]);
					}

                }
                else
                {
                	
					if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
						
						if(isset($month_assumption_forecast_data[0]["assumption1_id"]) && $month_assumption_forecast_data[0]["assumption1_id"] != ""){
							$assumption1_id = $month_assumption_forecast_data[0]["assumption1_id"];
						}else{
							$assumption1_id = "";
						}
						
						if(isset($month_assumption_forecast_data[0]["assumption2_id"]) && $month_assumption_forecast_data[0]["assumption2_id"] != ""){
							$assumption2_id = $month_assumption_forecast_data[0]["assumption2_id"];
						}else{
							$assumption2_id = "";
						}
												
						if(isset($month_assumption_forecast_data[0]["assumption3_id"]) && $month_assumption_forecast_data[0]["assumption3_id"] != ""){
							$assumption3_id = $month_assumption_forecast_data[0]["assumption3_id"];
						}else{
							$assumption3_id = "";
						}
						
						
						if(isset($month_assumption_forecast_data[0]["probability1"]) && $month_assumption_forecast_data[0]["probability1"] != ""){
							$probability1 = $month_assumption_forecast_data[0]["probability1"];
						}else{
							$probability1 = "";
						}
						
						if(isset($month_assumption_forecast_data[0]["probability2"]) && $month_assumption_forecast_data[0]["probability2"] != ""){
							$probability2 = $month_assumption_forecast_data[0]["probability2"];
						}else{
							$probability2 = "";
						}
						
						if(isset($month_assumption_forecast_data[0]["probability3"]) && $month_assumption_forecast_data[0]["probability3"] != ""){
							$probability3 = $month_assumption_forecast_data[0]["$probability3"];
						}else{
							$probability3 = "";
						}
						
	                    $assumption_month[$monthvalue] = array($assumption1_id,$assumption2_id,$assumption3_id);
	
	                    $probablity_month[$monthvalue] = array($probability1,$probability2,$probability3);
						
						
					}else{
					
                    	$assumption_month[$monthvalue] = array();
                    	$probablity_month[$monthvalue] = array();
					}
                }
                
                $month_assumption_forecast_lock_data = $this->esp_model->get_month_assumption_forecast_lock_data($forecast_id,$monthvalue);
                
                if($month_assumption_forecast_lock_data != 0){
                    $lock_status_array[$monthvalue] = $month_assumption_forecast_lock_data[0]["lock_status"];
                }
                else{
                    $lock_status_array[$monthvalue] = "";
                }
                
				
				
				if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
							
					$data_assumption_inner_array = array();
					
					
					$webservice_final_array[$monthvalue]['assumptiondata'] = $assumption_month[$monthvalue];
					$webservice_final_array[$monthvalue]['probablitydata'] = $probablity_month[$monthvalue];
					
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
                                
                                
                                
                                
                                $html .= '<div class="tp_form">
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
                                    
                                        $html .= '<div class="tp_form">
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
                                    
                                        $html .= '<div class="tp_form">
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
                                    
                                            $html .= '<div class="tp_form">
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
                                   
                                        $html .= '<div class="tp_form">
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
                                
                                $html .= '<div class="tp_form">
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
                                
                                $html .= '<div class="tp_form">
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
                            else{
                                
                                //NOT SHOW FREEZED DATA
                                    
                                
                                        $html .= '<div class="tp_form">
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
                        
                                $html .= '<div class="tp_form">
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
			$freeze_status = 0;
            if($login_user_parent_data != 0){
                
                $freeze_history_user_status_data = $this->esp_model->get_freeze_history_user_status_data($login_user_id,$forecast_id);
                
                if(!empty($freeze_history_user_status_data) && isset($freeze_history_user_status_data[0]['freeze_status'])){
                    
                
                    if($freeze_history_user_status_data[0]['freeze_status'] == 0){
                    
						$freeze_status = 0;
                        $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary" id="freeze_data">Freeze</button></div>';
                    }
                    else{
                    	$freeze_status = 1;
                        $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary" id="freeze_data">Unfreeze</button></div>';
                    }
                    
                }
                else{
                    $freeze_status = 0;
                    $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary" id="freeze_data">Freeze</button></div>';
                    
                }
            }

			if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
				
				//testdata($webservice_final_array);
				
				$final_array = array();
				
				$final_array["forecast_data"] = array_values($webservice_final_array);
				$final_array["forecast_id"] = $forecast_id;
				$final_array["freeze_status"] = $freeze_status;
				
				return $final_array;
				//die;
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
    
    public function get_forecast_value_data($webservice_data = NULL){
        
		if($webservice_data != NULL && (isset($webservice_data['webservice']) && !empty($webservice_data['webservice']))){
	        	
			$product_sku_id = $webservice_data["product_sku_id"];
	        $month_data = $webservice_data['month_data'];
	        $forecastdata = $webservice_data['forecastdata'];
			
		}
		else{
			 $relattrval = $_POST['relattrval'];
	        
	        $forecast_data = explode("_",$relattrval);
	        
	        $product_sku_id = $forecast_data[1];
	        $month_data = $forecast_data[2];
			
			$forecastdata = $_POST['forecastdata'];
		}
        
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

							$history_status_data = 1;
							
							//ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE
							
							 $this->esp_model->insert_forecast_product_details_history($old_forecast_id,$businss_data,$pbg_id,$product_id,$month_data,$forecast_qty,$forecast_value,$history_status_data);
							

                        }else{

                            $this->esp_model->insert_forecast_product_details($forecast_insert_id,$businss_data,$product_id,$month_data,$forecast_qty,$forecast_value);
							
							$history_status_data = 0;
							
							//ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE
							
							 $this->esp_model->insert_forecast_product_details_history($forecast_insert_id,$businss_data,$pbg_id,$product_id,$month_data,$forecast_qty,$forecast_value,$history_status_data);
							
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
							
							$history_update_status = 1;
							
							//ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE
							
							 $this->esp_model->insert_forecast_assumption_data_history($old_forecast_id,$assumption_data,$probablity_data,$month_data,$history_update_status);

                        }else{ 

                           $this->esp_model->insert_forecast_assumption_probablity_data($forecast_insert_id,$assumption_data,$probablity_data,$month_data);
                           
						   $history_update_status = 0;
						   
						   //ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE
							
							 $this->esp_model->insert_forecast_assumption_data_history($forecast_insert_id,$assumption_data,$probablity_data,$month_data,$history_update_status);
						   
                        }
						
                    }

                }
                
            }
            
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
    
	public function impact_entry(){
		
		Assets::add_module_js('esp', 'impact_entry.js');
		
		$user = $this->auth->user();
        Template::set('current_user', $user);
		Template::render();
		
	}
	
	public function get_forecast_impact_data(){
		
		
		$monthdata = $_POST['selectedmonth']."-01"; 
		
		$user = $this->auth->user();
		$login_bussiness_code = $user->bussiness_code;
		
		$impact_data = $this->esp_model->get_user_impact_data($login_bussiness_code,$monthdata);
		
		//testdata($impact_data);
		
		$html = "";
        
		if($impact_data != 0){
			
			//CREATE HTML FOR DATA
			
           
			$html .= '<table class="col-md-12 table-bordered table-striped table-condensed cf">';
				$html .= '<thead>';
					$html .= '<tr>';
						//$html .= '<th>Product SKU Code</th>';
						//$html .= '<th>Product SKU Name</th>';
						$html .= '<th>PBG Name</th>';
						$html .= '<th>Assumption 1</th>';
						$html .= '<th>Probability 1</th>';
						$html .= '<th>Impact 1</th>';
						$html .= '<th>Assumption 2</th>';
						$html .= '<th>Probability 2</th>';
						$html .= '<th>Impact 2</th>';
						$html .= '<th>Assumption 3</th>';
						$html .= '<th>Probability 3</th>';
						$html .= '<th>Impact 3</th>';
					$html .= '</tr>';
				$html .= '</thead>';
				$html .= '<tbody>';
				
					foreach($impact_data as $impact_key=>$impact_value){
				
						$html .= '<tr>';
							
							$html .= '<td><input type="hidden" name="assumption_id[]" value="'.$impact_value['forecast_assumption_id'].'" />'.$impact_value['product_country_name'].'</td>';
							
						//	$html .= '<td>'.$impact_value['product_sku_name'].'</td>';
							
							$html .= '<td>'.$impact_value['assumption1_name'].'</td>';
							$html .= '<td>'.$impact_value['probability1'].'</td>';
							$html .= '<td><input type="text" name="impact1[]" value="'.$impact_value['impact1'].'" /></td>';
							
							$html .= '<td>'.$impact_value['assumption2_name'].'</td>';
							$html .= '<td>'.$impact_value['probability2'].'</td>';
							$html .= '<td><input type="text" name="impact2[]" value="'.$impact_value['impact2'].'" /></td>';
							
							$html .= '<td>'.$impact_value['assumption3_name'].'</td>';
							$html .= '<td>'.$impact_value['probability3'].'</td>';
							$html .= '<td><input type="text" name="impact3[]" value="'.$impact_value['impact3'].'" /></td>';
							
						$html .= '</tr>';
					
					}
					
				$html .= '</tbody>';
			$html .= '</table>';
			
			
			$html .= '<div class="col-md-12 table_bottom text-center">
                <div class="row">
                    <div class="save_btn">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>';
			
						
		}
		else{
			
			//CREATE NO DATA FOUND HTML

			$html .= '<div><h4>No Data Found.</h4></div>';
						
		}
		
		echo $html;
		die;
		
	}

	public function add_impact_entry(){
	
	//testdata($_POST);
	
	$impact_data = $this->esp_model->add_impact_entry($_POST);
	echo $impact_data;
	die;
}
	
	public function budget(){
		
		Assets::add_module_js('esp', 'esp_budget.js');
		
		$user = $this->auth->user();
							
		/*
		$lock_show_data = $this->get_user_level_data($user->id);
		
		if($lock_show_data != 0){
		
			$lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;' rel='".$monthvalue."' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true'></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Lock' /></a></div>";
			}
		else
		{
			$lock_data = "";
	                                
		}
	
	*/
		
		
        Template::set('current_user', $user);
		Template::render();
		
	}

	public function show_budget_lock(){
		
		$user = $this->auth->user();
        $login_user_id = $user->id;
        
        $pbgid = $_POST["pbgid"];
        $from_month = $_POST["frommonth"];
        $to_month = $_POST["tomonth"];
		
		$selected_year = date("Y",strtotime($from_month));
		
        $businesscode = $_POST["businesscode"];
        
        $pbg_sku_data = $this->esp_model->get_pbg_sku_data($pbgid);
        $month_data = $this->get_monthly_data($from_month,$to_month);
        
        $lock_show_data = $this->get_user_level_data($login_user_id);
        
        
		if($lock_show_data != 0){
		
			foreach($month_data as $monthkey => $monthvalue){
				foreach($pbg_sku_data as $skukey => $skuvalue){
					
					 $employee_month_product_budget_data1 = $this->esp_model->get_employee_month_product_budget_data($businesscode,$skuvalue['product_sku_country_id'],$monthvalue);
			
					 $lock_status = 0;
					 $lock_by_id = "";
					 $check_lock_budget_id = "";
			
					if($employee_month_product_budget_data1 != 0){
			
						$check_lock_budget_id = $employee_month_product_budget_data1[0]['budget_id'];
			
					   $budget_lock_history_data =  $this->esp_model->get_employee_month_product_budget_lock_data($login_user_id,$check_lock_budget_id,$monthvalue);
						if(!empty($budget_lock_history_data)){
							$lock_status = $budget_lock_history_data[0]['lock_status'];
						}
					
					}
						
					if($lock_status == 0){
						
							$lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;' rel='".$selected_year."' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true'></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Lock' /></a></div>";
						}
						else{
							$lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;' rel='".$selected_year."' href='javascript:void(0);' class='lock_data' ><i class='fa fa-unlock-alt' aria-hidden='true''></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Unlock' /></a></div>";
						} 
			
				}
			}
			
			
		}
		else
		{
			$lock_data = "";
	                                
		}
		
		echo $lock_data;
		die;
		
	}
	

	public function get_pbg_sku_budget_data(){
        
        $user = $this->auth->user();
        $login_user_id = $user->id;
        
        $pbgid = $_POST["pbgid"];
        $from_month = $_POST["frommonth"];
        $to_month = $_POST["tomonth"];
        
        $businesscode = $_POST["businesscode"];
        
        $pbg_sku_data = $this->esp_model->get_pbg_sku_data($pbgid);
        $month_data = $this->get_monthly_data($from_month,$to_month);
        
        //$assumption_data = $this->esp_model->get_assumption_data();
        
       // $lock_show_data = $this->get_user_level_data($login_user_id);
        
                
        $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);
        
        $html = "";
        $html1 = "";
        $html2 = "";
        
        if($pbg_sku_data != 0){
            
            $html .= '<table class="col-md-12 table-bordered table-striped table-condensed cf">';
                $html .= '<thead>';
                    $html .= '<tr style="border-bottom: solid 1px #b1b1b1;">';
                        $html .= '<th></th>';
                        foreach($month_data as $monthkey => $monthvalue){
                            
                            $time=strtotime($monthvalue);
                            $month=date("F",$time);
                            $year=date("Y",$time);
                            
                            /*if($lock_show_data != 0){
                                
                                foreach($pbg_sku_data as $skukey => $skuvalue){
                                    
                                 $employee_month_product_budget_data1 = $this->esp_model->get_employee_month_product_budget_data($businesscode,$skuvalue['product_sku_country_id'],$monthvalue);
                    
                                 $lock_status = 0;
                                 $lock_by_id = "";
                                 $check_lock_forecast_id = "";
                            
                                }
                            }
                            else{
                                $lock_data = "";
                            }
							
							*/
                            
                            $html .= '<th colspan="2"><span class="rts_bordet"></span>'.$month.'-'.$year.'&nbsp;&nbsp;</th>';
                        }
                       
                   $html .= '</tr>';
                   $html .= '<tr>';
                   $html .= '<th><span class="rts_bordet"></span>';
                   $html .= 'PBG';
                   $html .= '</th>';
             foreach($month_data as $monthkey => $monthvalue)
             {
             	$html .= '<input type="hidden" name="month_data[]" value="'.$monthvalue.'" />';
             	
                $html .= '<th><span class="rts_bordet"></span>';
                $html .= 'Budget Qty';
                $html .= '</th>';
                $html .= '<th><span class="rts_bordet"></span>';
                $html .= 'Budget Value';
                $html .= '</th>';
             }
                $html .= '<th><span class="rts_bordet"></span>';
                $html .= 'Yearly';
                $html .= '</th>';
                $html .= '</tr>';
                $html .= '</thead>';
           $html .= '<tbody>';
            $i = 1;
            
            $budget_id = "";
            
            foreach($pbg_sku_data as $skukey => $skuvalue){
              $html .= '<tr>';
              $html .= '<td><input type="hidden" name="product_sku_id[]" value="'.$skuvalue['product_sku_country_id'].'" />'.$skuvalue['product_sku_name'].'</td>';
                
                $l = 1;
                
                foreach($month_data as $monthkey => $monthvalue){
                    
                    
                    $employee_month_product_budget_data = $this->esp_model->get_employee_month_product_budget_data($businesscode,$skuvalue['product_sku_country_id'],$monthvalue);
                    
                    $budget_qty = "";
                    $budget_value = "";
                    
                     $lock_status = "";
                     $lock_by_id = "";
                    
                //    echo "<pre>";
                //    print_r($employee_month_product_forecast_data);
                    
                    if($employee_month_product_budget_data != 0){
                        
                        $budget_qty = $employee_month_product_budget_data[0]['budget_quantity'];
                        $budget_value = $employee_month_product_budget_data[0]['budget_value'];
                        
                        
                        $lock_status = $employee_month_product_budget_data[0]['lock_status'];
                        $lock_by_id = $employee_month_product_budget_data[0]['lock_by_id'];
                        
                        $budget_id = $employee_month_product_budget_data[0]['budget_id'];
                        
                        
                    }
                    
                    //CHECK DATA FREEZED OR NOT
                    
                    $budget_freeze_data = $this->esp_model->get_budget_freeze_status($budget_id);
                    
                    if($budget_freeze_data != 0)
                    {
                        //If data Freezed
                        
                        if($budget_freeze_data['freeze_status'] == 1){
                            //DATA FREEZED
                            
                            if($login_user_id == $budget_freeze_data['freeze_user_id']){
                                
                                
                                
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
                                
                                
                               // echo "1";
                                
                                //check login user equal to freezed user if equal than make data visible and editable else not for login user
                                
                                $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="budget_qty" id="budget_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="budget_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$budget_qty.'"  '.$editable.' /></td>';
                    
                                $html .= '<td><input id="budget_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="budget_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$budget_value.'" readonly /></td>';
                                
                                
                            }else{
                                
                                
                            $freeze_user_parent_data = $this->esp_model->get_freeze_user_parent_data($budget_freeze_data['freeze_user_id']);
                            
                            if($freeze_user_parent_data != 0){
                                
                              //  echo $login_user_id ."==". $freeze_user_parent_data;
                                
                                if($login_user_id == $freeze_user_parent_data){
                                    
                                    //If login user is parent of freezed user than he will able to see the forecast data entered by juinor else not
                                    
                                    //SHOW FREEZEED DATA
                                    
                                  //  echo "2";
                                    
                                    
                                     $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="budget_qty" id="budget_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="budget_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$budget_qty.'" /></td>';
                    
                                     $html .= '<td><input id="budget_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="budget_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$budget_value.'" readonly /></td>';
                                    
                                }
                                elseif($login_user_id == $budget_freeze_data['created_by_user']){
                                    
                                    //GET LOCK STATUS
                                    
                                   // echo "3";
                                    
                                    if($lock_status == 1){
                                        $editable = "readonly";
                                    }
                                    else{
                                        $editable = "";
                                    }
                                    
                                    $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="budget_qty" id="budget_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="budget_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$budget_qty.'" '.$editable.'  /></td>';
                    
                                     $html .= '<td><input id="budget_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="budget_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$budget_value.'" readonly /></td>';
                                    
                                }
                                else{
                                    
                                    //SHOW FREEZED DATA BUT READONLY
                                    
                                   // echo "4";
                                    
                                     $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="budget_qty" id="budget_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="budget_qty['.$skuvalue['product_sku_country_id'].'][]" value=""  /></td>';
                    
                                    $html .= '<td><input id="budget_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="budget_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
                                    
                                }
                            }
                            else{
                                
                                //NOT SHOW FREEZED DATA
                                
                               // echo "5";
                                    
                                    $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="budget_qty" id="budget_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="budget_qty['.$skuvalue['product_sku_country_id'].'][]" value="" /></td>';
                    
                                    $html .= '<td><input id="budget_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="budget_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
                                
                              }
                                
                           }
                            
                        }
                        else{
                            
                            if($login_user_id == $budget_freeze_data['freeze_user_id']){
                                
                              //  echo "6";
                                
                                $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="budget_qty" id="budget_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="budget_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$budget_qty.'" /></td>';
                    
                                $html .= '<td><input id="budget_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="budget_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$budget_value.'" readonly /></td>';
                                
                            }
                            elseif($login_user_id == $budget_freeze_data['created_by_user']){
                                
                               // echo "7";
                                
                                $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="budget_qty" id="budget_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="budget_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$budget_qty.'" /></td>';
                    
                                $html .= '<td><input id="budget_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="budget_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$budget_value.'" readonly /></td>';
                                
                            }
                            else{
                                
                               // echo "8";
                                //NOT SHOW FREEZED DATA
                                    
                                    $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="budget_qty" id="budget_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="budget_qty['.$skuvalue['product_sku_country_id'].'][]" value="" /></td>';
                    
                                    $html .= '<td><input id="budget_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="budget_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
                                
                            }
                        }
                    }
                    else{
                        
                       // echo "9";
                        
                         $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="budget_qty" id="budget_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="budget_qty['.$skuvalue['product_sku_country_id'].'][]" value="" /></td>';
                    
                        $html .= '<td><input id="budget_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="budget_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';
                                    
                    }
                        
                    $l++;
                    
                }
               $html .= '<td></td>';
               $html .= '</tr>';
                
            }
            
            $html .= '</tbody>';
       $html .= '</table>';
           
            $freeze_button = "";
            if($login_user_parent_data != 0){
                
                $freeze_history_user_status_data = $this->esp_model->get_budget_freeze_history_user_status_data($login_user_id,$budget_id);
                
                if(!empty($freeze_history_user_status_data) && isset($freeze_history_user_status_data[0]['freeze_status'])){
                    
                
                    if($freeze_history_user_status_data[0]['freeze_status'] == 0){
                    
                        $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary" id="freeze_data">Freeze</button></div>';
                    }
                    else{
                        $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary" id="freeze_data">Unfreeze</button></div>';
                    }
                    
                }
                else{
                    
                    $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary" id="freeze_data">Freeze</button></div>';
                    
                }
            }
            
            $html2 .= '<div class="col-md-12 table_bottom text-center">
                <input type="hidden" id="budget_id" name="budget_id" value="'.$budget_id.'" />
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


	public function add_budget(){
       // testdata($_POST);
      //  $forecast_data = $this->esp_model->add_forecast_data();
        
        if(isset($_POST) && !empty($_POST)){
            
         //   testdata($_POST);
            
            if(!isset($_POST['employee_data']))
            {
                $budget_user_id = $_POST['login_user_id'];
            }
            else{
                $budget_user_id = $_POST['employee_data'];
            }
            
            $businss_data = $this->esp_model->get_business_code($budget_user_id);
            
            $user_business_code = $businss_data;
            
            $pbg_id = $_POST['pbg_data'];
            $created_user_id = $_POST['login_user_id'];
            
            
            //CHECK FOR EMMPLOYEE AND PBG RECORD ALREADY EXIST
            
            
            $final_array = array();

            $i = 1;
            
            $budget_insert_id = '';

            if(!empty($_POST['month_data'])){
                foreach($_POST['month_data'] as $month_key=>$month_value){
            
                    $check_record_exist = $this->esp_model->check_budget_data($pbg_id,$user_business_code,$month_value);
                    
                    if($check_record_exist != 0){
                        
                        //UPDATE 
                        
                        $old_budget_id = $check_record_exist[0]['budget_id'];
                        
                        //UPDATE MAIN TABLE RECORD
                        
                        $update_status = $this->esp_model->update_budget_data($old_budget_id,$created_user_id);
                        
                    }else{
                    
                        //INSERT
                        if($budget_insert_id == ""){
                                $budget_insert_id = $this->esp_model->insert_budget_data($pbg_id,$created_user_id,$user_business_code,$_POST['login_user_id']);
                        }
                        
                    }
                    
                    foreach($_POST['product_sku_id'] as $pkey=>$product_data){

                        $initial_array_budgetqty = $_POST['budget_qty'][$product_data][$month_key];

                        $initial_array_budgetvalue = $_POST['budget_value'][$product_data][$month_key];

                        $final_array[$month_value]['productid'][$product_data]['budget_qty'] = $initial_array_budgetqty;

                        $final_array[$month_value]['productid'][$product_data]['budget_value'] = $initial_array_budgetvalue;

                    }

                     $i++;
                }
            }
             
           // testdata($final_array);
            
            if(!empty($final_array)){
                foreach($final_array as $key_data => $data){
                    
                    $old_budget_id = "";
                    
                    $month_data = $key_data;
                    
                    foreach($data["productid"] as $product_id => $product_data){
                        
                        $budget_qty = $product_data["budget_qty"];
                        $budget_value = $product_data["budget_value"];
                        
                        $get_product_old_data = $this->esp_model->get_budget_product_details($businss_data,$product_id,$month_data);
                        
                        if($get_product_old_data != 0){

                            //UPDATE MAIN TABLE RECORD
                            
                            $budget_product_id = $get_product_old_data[0]['budget_product_id'];
                            $old_budget_id = $get_product_old_data[0]['budget_id'];

                            $update_status = $this->esp_model->update_budget_product_details($budget_product_id,$budget_qty,$budget_value);

							//$history_status_data = 1;
							
							//ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE
							
						//	 $this->esp_model->insert_forecast_product_details_history($old_forecast_id,$businss_data,$pbg_id,$product_id,$month_data,$forecast_qty,$forecast_value,$history_status_data);
							

                        }else{

                            $this->esp_model->insert_budget_product_details($budget_insert_id,$businss_data,$product_id,$month_data,$budget_qty,$budget_value);
							
							//$history_status_data = 0;
							
							//ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE
							
						//	 $this->esp_model->insert_forecast_product_details_history($forecast_insert_id,$businss_data,$pbg_id,$product_id,$month_data,$forecast_qty,$forecast_value,$history_status_data);
							
                        }
					   
                    }

                }
                
            }
            
        }
        
        redirect('esp/budget');
        
    }

	public function update_budget_freeze_status(){
        
        $user = $this->auth->user();
        $budget_id = $_POST["budgetid"];
        $text_data = $_POST["textdata"];
        $freeze_data = $this->esp_model->update_budget_freeze_status_data($user->id,$budget_id,$text_data);
        
        echo $freeze_data;
        die;
        
    }
	
	public function get_budget_value_data(){
        
        $relattrval = $_POST['relattrval'];
        
        $budget_data = explode("_",$relattrval);
        
        $product_sku_id = $budget_data[1];
        $month_data = $budget_data[2];
        
        $budgetdata = $_POST['budgetdata'];
        
        $budget_value = $this->esp_model->get_budget_data($product_sku_id,$month_data);
        
        $final_budget_value  = $budgetdata*$budget_value;
        
        echo $final_budget_value;
        die;
        
    }
    
    public function set_budget_lock_data(){
        
        $user = $this->auth->user();
		
        $budget_id = $_POST["budgetid"];
        $yearval = $_POST["yearval"];
        $text_data = $_POST["textdata"];
		
		for($i=1;$i<=12;$i++){
				
				if($i<= 9){
					$i = "0".$i;
				}
				$monthval = $yearval."-".$i."-01";
				$lock_data = $this->esp_model->update_budget_lock_status_data($user->id,$budget_id,$monthval,$text_data);
		
		}
        
        echo $lock_data;
        die;
        
    }
   
   
    public function forecast_status(){
    	
		Assets::add_module_js('esp', 'esp_budget.js');

		$user = $this->auth->user();
		
		$role_degigination_data = $this->esp_model->get_role_degination_data($user->role_id);
		
		$final_array = array();
		
		$test_array = array();
		
		
		$html = "";

		$year = date("Y"); // change this to another year
		$row=0; // to set the number of rows and columns in yearly calendar 
		$html .= "<table class='main' style='width:50%;float:left;'>"; // Outer table 
		
		for($m=1;$m<=12;$m++)
		{
			$month =date($m);  // Month 
			
			$l = $m;
			
			if($l <= 9){
				$l = "0".$l;
			}
			
			$month_data = $year."-".$l."-01";
			
			$dateObject = DateTime::createFromFormat('!m', $m);
			$monthName = $dateObject->format('F'); // Month name to display at top
			
			$no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);//calculate number of days in a month
			
			$j= date('w',mktime(0,0,0,$month,1,$year)); // This will calculate the week day of the first day of the month
			
			if(($row % 3)== 0)
			{
				$html .= "</tr><tr>";
			}
			
			$html .= "<td><table class='inner_main' ><td colspan='2' align=center><input type='hidden' name='month_data' value='".$month_data."' id='month_data'/> $monthName $year </td></tr>";
			 
			if($role_degigination_data != 1){
				
				$level_user_id = $user->id;
				
				$html .= "<form id='user_data_form' name='user_data_form'>";
				
				//echo $role_degigination_data;
				
				
				
				for($n=1;$n<$role_degigination_data;$n++){
				
					$level = $n;
				
					$levle_data = $this->esp_model->get_user_selected_level_data($level_user_id,$level);
					
					$level_user_id = $levle_data['level_users']; 
					
					$users_forecast_freeze_count_data = $this->esp_model->get_forecast_user_data($levle_data['level_users'],$month_data);
					
					$users_forecast_update_count_data = $this->esp_model->get_update_user_data($levle_data['level_users'],$month_data);
					
					
					$html.= "<tr>";
						$html.= "<td>".$users_forecast_update_count_data."</td><td>
						
						<input type='hidden' name='user_level_data_".$n."' value='".$levle_data['level_users']."' id='user_level_data_".$n."'/>
						
						
						
						".$users_forecast_freeze_count_data."/".$levle_data['tot']."</td>";
					$html .= "</tr>";
				
				
				}
				
				$html .= "</form>";
				
				//die;
			}
			 
			
			$html .= "</tr></table></td>";
			
			$row=$row+1;
			
		} // end of for loop for 12 months
		
		$html .= "</table>";
		
		Template::set('current_user', $user);
		Template::set('calender_data', $html);
		
		Template::render();
		
    }

	public function show_month_user_level_data(){
		
		//testdata($_POST["userlevel_formdata"]);
		
		$month_data = $_POST["monthval"];
		
		$html = "";
		
		$no_of_level = count($_POST["userlevel_formdata"]);
		
		if(!empty($_POST["userlevel_formdata"])){
			
			$html .= "<table id='table_user_data' style='width:50%;float:left;'><thead><tr>";
			
			$level_data_array = array();
			
			foreach($_POST["userlevel_formdata"] as $user_data_key => $user_level_data){
				
				$level_data = $user_level_data["name"];
				$level_array  = explode("_",$level_data);
				$level_data = $level_array["3"];
				$level_data_array[] = $level_data;
				
			}
			
			$level_data_array = array_reverse($level_data_array);
			
			foreach($level_data_array as$l_key=>$l_data){
				$html .= "<th>Level ".$l_data."</th>";
			}
			
			$html .= "</tr></thead><tbody>";
			
			$data_array = array();
			
			$max_count = 0;
			
			foreach($_POST["userlevel_formdata"] as $user_data_key1 => $user_level_data1){
				
				$level_data = $user_level_data1["name"];
				
				$level_array  = explode("_",$level_data);
				
				$level_data = $level_array["3"];
				
				$level_user_data = $user_level_data1["value"];
				
				$users_forecast_update_status_data = $this->esp_model->get_update_user_detail_data($level_user_data,$month_data);
				
				if($users_forecast_update_status_data > $max_count)
				{
					$max_count = count($users_forecast_update_status_data);
				}
				
				$data_array[$level_data] = $users_forecast_update_status_data;
				
			}
			
		//	dumpme($data_array);
			
			for($i=0;$i<$max_count;$i++)
			{
				$html .= '<tr>';
				for($j=0;$j<count($data_array);$j++)
				{
					
					
					if(isset($data_array[$j+1][$i])){
						$row_data = explode("|||",$data_array[$j+1][$i]);
						if($row_data[1] != ""){
							$row_data = $row_data[0]."  "."<b>&#8226;</b>";
						}
						else{
							$row_data = $row_data[0];
						}
					}
					else{
						$row_data = "";
					}
					
					$html .= '<td>'.$row_data.'</td>';
					
				}
				$html .= '</tr>';
			}
			
			
			$html .= "</tbody></tbody>";
			
		}
		
		echo $html;
		die;
		
	}


	
}