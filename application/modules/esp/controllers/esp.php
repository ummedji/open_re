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
    
    public function get_user_level_data(){
        
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
    
    public function get_pbg_sku_data(){
        
        $pbgid = $_POST["pbgid"];
        $from_month = $_POST["frommonth"];
        $to_month = $_POST["tomonth"];
        
        $businesscode = $_POST["businesscode"];
        
        $pbg_sku_data = $this->esp_model->get_pbg_sku_data($pbgid);
        $month_data = $this->get_monthly_data($from_month,$to_month);
        
        $assumption_data = $this->esp_model->get_assumption_data();
        
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
                            
                            $lock_data = "<a href='javascript:void(0);' class='lock_data' />Lock</a>";
                            
                            $html .= '<th colspan="2">'.$month.'-'.$year.'&nbsp;&nbsp;'.$lock_data.'</th>';
                        }
                       
                   $html .= '</tr>';
                   $html .= '<tr>';
                   $html .= '<th>';
                   $html .= 'PBG';
                   $html .= '</th>';
             foreach($month_data as $monthkey => $monthvalue){
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
                    
                    if($employee_month_product_forecast_data != 0){
                        
                        $forecast_qty = $employee_month_product_forecast_data[0]['forecast_quantity'];
                        $forecast_value = $employee_month_product_forecast_data[0]['forecast_value'];
                        
                        $forecast_id = $employee_month_product_forecast_data[0]['forecast_id'];
                        
                        
                    }
                    
                    $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_qty.'" /></td>';
                    
                    $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_value.'" readonly /></td>';
                    
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

            }
           
            $k = 1;
            
             for($a = 1; $a<=3; $a++){
                
                $html .= '<tr>';
                $html .= '<td></td>';
                 
                $j = 1;
                 
                    foreach($month_data as $monthkey => $monthvalue){
                       
                        
                        $html .= '<td><div class="col-md-3 col-sm-3 tp_form">
	<div class="form-group">';
                        $html .= '<select class="selectpicker" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption'.$j.'[]" >
                        
                        <option value= "">Select Assumption</option>';

                       
                        
                        if(isset($assumption_month[$monthvalue][$a-1]) && !empty($assumption_month[$monthvalue][$a-1])){
                            $assumptiondata = $assumption_month[$monthvalue][$a-1];
      
                            }
                        else{
                            $assumptiondata = "";
                        }
                        
                      //  echo $assumptiondata; die;
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
                        
                        
                        if(isset($probablity_month[$monthvalue][$a-1]) && !empty($probablity_month[$monthvalue][$a-1])){
                            $probablitydata = $probablity_month[$monthvalue][$a-1];
                        }
                        else{
                            $probablitydata = "";
                        }
                        
                        $html .= '</div>
</div></td><td><input type="text" name="probablity'.$j.'[]" value="'.$probablitydata.'" /></td>';
                        
                        $j++;
                        
                    }
          
                $html .= '</tr>';
                    $k++;
                 
            }
            
            
            $html .= '</tbody>';
       $html .= '</table>';
           
            
            $html2 .= '<div class="col-md-12 table_bottom text-center">
                <input type="hidden" id="forecast_id" name="forecast_id" value="'.$forecast_id.'" />
                <div class="row">
                    <div class="save_btn">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="submit" class="btn btn-primary" id="freeze_data">Submit</button>
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
      //  testdata($_POST);
        $forecast_data = $this->esp_model->add_forecast_data();
        
    }
    
    public function get_business_code(){
        
        $business_data = $this->esp_model->get_business_code(NULL);
        echo $business_data;
        die;
    }
    
    public function update_forecast_freeze_status(){
        
        $user = $this->auth->user();
        $forecast_id = $_POST["forecastid"];
        $freeze_data = $this->esp_model->update_forecast_freeze_status_data($user->id,$forecast_id);
        
        echo $freeze_data;
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