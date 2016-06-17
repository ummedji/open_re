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
    
}