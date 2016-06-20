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
        
        $pbg_sku_data = $this->esp_model->get_pbg_sku_data($pbgid);
        $month_data = $this->get_monthly_data($from_month,$to_month);
        
      //  testdata($pbg_sku_data);
        
        $html = "";
        $html1 = "";
        $html2 = "";
        
        if($pbg_sku_data != 0){
            
            $html .= '<table>';
                $html .= '<thead>';
                    $html .= '<tr>';
                        $html .= '<th></th>';
                        foreach($month_data as $monthkey => $monthvalue){
                            
                            $time=strtotime($monthvalue);
                            $month=date("F",$time);
                            $year=date("Y",$time);
                            
                            $html .= '<th colspan="2">'.$month.'-'.$year.'</th>';
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
            foreach($pbg_sku_data as $skukey => $skuvalue){
              $html .= '<tr>';
              $html .= '<td><input type="hidden" name="product_sku_id[]" value="'.$skuvalue['product_sku_country_id'].'" />'.$skuvalue['product_sku_name'].'</td>';
                
                $l = 1;
                
                foreach($month_data as $monthkey => $monthvalue){
                    $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" /></td>';
                    
                    $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]"  readonly /></td>';
                    
                    $l++;
                    
                }
               $html .= '<td></td>';
               $html .= '</tr>';
            }
           
            $html1 .= '</tbody>';
       $html1 .= '</table>';
            
            $html1 .= '<table>';
            $html1 .= '<thead>';
            $html1 .= '<tr>';
                $html1 .= '<th>';
                   $html1 .= '<td></td>';
                   foreach($month_data as $monthkey => $monthvalue){
                         $html1 .= '<td>Assumption</td><td>Probability</td>';
                   }
            
                $html1 .= '</th>';
            $html1 .= '</tr>';
            $html1 .= '</thead>';
            
            $html1 .= '<tbody>';
             $k = 1;
            foreach($month_data as $monthkey => $monthvalue){
                $html1 .= '<tr>';
                $html1 .= '<td><input type="hidden" name="month_data[]" value="'.$monthvalue.'" /></td><td></td>';
                $j = 1;
                    foreach($month_data as $monthkey => $monthvalue){
                        $html1 .= '<td><input type="text" name="assumption'.$j.'[]" /></td><td><input type="text" name="probablity'.$j.'[]" /></td>';
                        $j++;
                    }
                $html1 .= '</tr>';
                    $k++;
            }
            $html1 .= '</tbody>';
            $html1 .= '</table>';
            
            $html2 .= '<div class="col-md-12 table_bottom text-center">
                <div class="row">
                    <div class="save_btn">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>';
                
            
        }
        
        echo $html.$html1.$html2;
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
        testdata($_POST);
   //     $forecast_data = $this->esp_model->add_forecast_data();
        
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