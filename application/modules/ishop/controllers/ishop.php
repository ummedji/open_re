

<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Ishop controller
 */
class Ishop extends Front_Controller
{
	protected $permissionCreate = 'Ishop.Ishop.Create';
	protected $permissionDelete = 'Ishop.Ishop.Delete';
	protected $permissionEdit = 'Ishop.Ishop.Edit';
	protected $permissionView = 'Ishop.Ishop.View';

	/**
	 * Constructor
	 *
	 * @return void
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->library('users/auth');
		$this->load->helper('application');
		$this->load->library('Template');
		$this->load->library('Assets');
		$this->lang->load('application');
		$this->load->library('events');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->lang->load('ishop');
		$this->load->model('ishop_model');
		Assets::add_module_js('ishop', 'primary_sales.js');
		Assets::add_module_js('ishop', 'secondary_sales.js');
		Assets::add_module_js('ishop', 'secondary_sales_view.js');
		Assets::add_module_js('ishop', 'physical_stock.js');
		Assets::add_module_js('ishop', 'primary_sales_view.js');
		Assets::add_module_js('ishop', 'rol.js');

		$this->set_current_user();
	}

	/**
	 * Display a list of ishop data.
	 *
	 * @return void
	 */
	public function index()
	{
		$user = $this->auth->user();
		$distributor = $this->ishop_model->get_distributor_by_user_id($user->country_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);
		//var_dump($distributor);die;
		Template::set('distributor', $distributor);
		Template::set('product_sku', $product_sku);
		Template::set_view('ishop/index');
		Template::render();
	}

	/**
	 * @ Function Name        : primary_sales_details
	 * @ Function Params    :
	 * @ Function Purpose    : Insert Primary Sales Details
	 * @ Function Return    :
	 * */

	public function primary_sales_details()
	{
		$user_id = $this->session->userdata('user_id');
		$this->ishop_model->add_primary_sales_details($user_id);
		Template::set_message('Insert Data successful', 'success');
		redirect('ishop/index');
	}

	/**
	 * @ Function Name        : primary_sales_view_details
	 * @ Function Params    :
	 * @ Function Purpose    : Return list of distributor
	 * @ Function Return    : Array
	 * */

	public function primary_sales_view_details()
	{
		$user = $this->auth->user();
		$distributor = $this->ishop_model->get_distributor_by_user_id($user->country_id);
		Template::set('distributor', $distributor);
		Template::set_view('ishop/primary_sales');
		Template::render();
	}

	/**
	 * @ Function Name        : primary_sales_details_view
	 * @ Function Params    :
	 * @ Function Purpose    : View list of invoice no,Invoice Date,Distributor Code,Distributor Name,PO No.,
	 * Order Tracking No.,Dispatch Amount
	 * @ Function Return    : Array
	 * */

	public function primary_sales_details_view()
	{
		//	$user_id = $this->session->userdata('user_id');
		$form_date = (isset($_POST['form_date']) ? $_POST['form_date'] : '');
		$to_date = (isset($_POST['to_date']) ? $_POST['to_date'] : '');
		$by_distributor = (isset($_POST['by_distributor']) ? $_POST['by_distributor'] : '');
		$by_invoice_no = (isset($_POST['by_invoice_no']) ? $_POST['by_invoice_no'] : '');

		$primary_sales_details = $this->ishop_model->get_primary_details_view($form_date, $to_date, $by_distributor, $by_invoice_no);
		Template::set('table', $primary_sales_details);
		Template::set_view('ishop/primary_sales');
		Template::render();
	}



	/*---------------------------------------------------------------------------------------------------------------*/

	/**
	 * @ Function Name        : set_rol()
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */

	public function set_rol()
	{

		$user = $this->auth->user();
		//$customer_type_id=$this->ishop_model->get_customer_type_id_by_user_id($user->country_id);
		$customer_type_id = 3;
		$provience = $this->ishop_model->get_provience_by_customer_type($customer_type_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);
		//var_dump($customer_type_id);
		Template::set('provience', $provience);
		Template::set('customer_type_id', $customer_type_id);
		Template::set('product_sku', $product_sku);
		Template::set_view('ishop/rol');
		Template::render();
	}

	/**
	 * @ Function Name        : get_distributor_by_provience()
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */

	public function get_distributor_by_provience()
	{
		$provience_id = $_POST['pro_id'];
		$distributor = $this->ishop_model->get_distributor_by_provience_id($provience_id);
		//testdata($distributor);
		if (isset($distributor) && !empty($distributor)) {
			echo json_encode($distributor);
		}
		exit;
	}

	/**
	 * @ Function Name        : add_rol_details()
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */

	public function add_rol_details()
	{
		$user_id = $this->session->userdata('user_id');
		$this->ishop_model->add_rol_detail($user_id);

		Template::set_message('Insert Data successful', 'success');
		redirect('ishop/set_rol');
	}

	public function secondary_sales_details()
	{
		$user = $this->auth->user();
		$retailer = $this->ishop_model->get_retailer_by_distributor_id($user->id, $user->country_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);

		Template::set('retailer', $retailer);
		Template::set('product_sku', $product_sku);
		Template::set_view('ishop/secondary_sales');
		Template::render();
	}

	public function add_secondary_sales_details()
	{
		$user_id = $this->session->userdata('user_id');
		$this->ishop_model->add_secondary_sales_details_data($user_id);
		Template::set_message('Insert Data successful', 'success');
		redirect('ishop/secondary_sales_details');
	}

	public function secondary_sales_details_view()
	{
		$user = $this->auth->user();
		$retailer = $this->ishop_model->get_retailer_by_distributor_id($user->id, $user->country_id);
		Template::set('retailer', $retailer);
		Template::set_view('ishop/secondary_sales_view');
		Template::render();
	}

	public function secondary_sales_view_details()
	{
		//testdata($_POST);
		$form_date = (isset($_POST['form_date']) ? $_POST['form_date'] : '');
		$to_date = (isset($_POST['to_date']) ? $_POST['to_date'] : '');
		$by_retailer = (isset($_POST['by_retailer']) ? $_POST['by_retailer'] : '');
		$by_invoice_no = (isset($_POST['by_invoice_no']) ? $_POST['by_invoice_no'] : '');

		$secondary_sales_details = $this->ishop_model->secondary_sales_details_data_view($form_date, $to_date, $by_retailer, $by_invoice_no);

		Template::set('table', $secondary_sales_details);
		Template::set_view('ishop/secondary_sales_view');
		Template::render();
	}

	public function secondary_sales_product_details_view()
	{
		$secondary_sales_id = (isset($_POST['id']) ? $_POST['id'] : '');
		if (isset($secondary_sales_id) && !empty($secondary_sales_id)) {
			$secondary_sales_details = $this->ishop_model->secondary_sales_product_details_view_by_id($secondary_sales_id);
			Template::set('table', $secondary_sales_details);
		}
		Template::set_view('ishop/primary_sales');
		Template::render();
	}


	public function physical_stock()
	{
		$user = $this->auth->user();
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);

		$default_retailer_role = 10;
		$retailer_geo_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$default_retailer_role);


		//testdata($retailer_geo_data);

		Template::set('geo_data', $retailer_geo_data);
		Template::set('product_sku', $product_sku);
		Template::set('current_user', $user);
		Template::set_view('ishop/physical_stock');
		Template::render();
	}

	public function add_physical_stock_details()
	{
		$user_id = $this->session->userdata('user_id');
		$this->ishop_model->add_physical_stock_detail($user_id);

		Template::set_message('Insert Data successful', 'success');
		redirect('ishop/physical_stock');
	}

	public function ishop_sales()
	{
		Template::set_view('ishop/ishop_sales');
		Template::render();
	}



	/*---------------------------------------------------------------------------------------------------------------*/
	/**
	 * @ Function Name		: primary_sales_product_details_view
	 * @ Function Params	:
	 * @ Function Purpose 	: View list of Product details
	 * @ Function Return 	: Array
	 * */

	public function primary_sales_product_details_view()
	{
		$primary_sales_id = (isset($_POST['id']) ? $_POST['id'] : '');
		if(isset($primary_sales_id) && !empty($primary_sales_id))
		{
			$primary_sales_details= $this->ishop_model->primary_sales_product_details_view_by_id($primary_sales_id);
			Template::set('table',$primary_sales_details);
		}
		Template::set_view('ishop/primary_sales');
		Template::render();
	}
        
        /**
	 * @ Function Name	: order_place
	 * @ Function Params	:
	 * @ Function Purpose 	: View for placing order
	 * @ Function Return 	: 
	 * */
        
        public function order_place(){
            
            Assets::add_module_js('ishop', 'order_place.js');
            
            $user= $this->auth->user();
            
            $distributor= $this->ishop_model->get_distributor_by_user_id($user->country_id);
            
            $retailer= $this->ishop_model->get_retailer_by_user_id($user->country_id); 
            
            $product_sku= $this->ishop_model->get_product_sku_by_user_id($user->country_id);
            
            $logined_user_type = $user->role_id;
            $logined_user_id = $user->id;
            $logined_user_countryid = $user->country_id;
            
            //FOR FO
            
            $default_farmer_type = 11;
            
            $get_geo_level_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$default_farmer_type);
            
            
            
            
		  //var_dump($distributor);die;
            Template::set('login_customer_type',$logined_user_type);
            Template::set('login_customer_id',$logined_user_id);
            Template::set('login_customer_countryid',$logined_user_countryid);
            
            Template::set('distributor',$distributor);
            Template::set('retailer',$retailer);
            Template::set('product_sku',$product_sku);
            
            
            Template::set('geo_level_data',$get_geo_level_data);
            
            Template::set_view('ishop/order_place');
            Template::render();
            
        }
        
        /**
	 * @ Function Name	: get_quantity_conversion_data
	 * @ Function Params	:
	 * @ Function Purpose 	: for getting added quantity conversion value for order placed
	 * @ Function Return 	: 
	 * */
        
        public function get_quantity_conversion_data() {
           
           $skuid = $_POST['skuid'];
           $quantity_data = $_POST['quantity_data'];
           $unit_data = $_POST['unit'];
           
           $conversion_data= $this->ishop_model->get_product_conversion_data($skuid,$quantity_data,$unit_data);
           echo $conversion_data;
           die;
           
        }
        
        /**
        * @ Function Name	: get_distributor_data
        * @ Function Params	: 
        * @ Function Purpose 	: For getting distributor as per selected retailer
        * @ Function Return 	: json
        * */
        
        public function get_distributor_data(){
            
            $user= $this->auth->user();
            $retailer_id = $_POST['retailerid'];
            
            $distributor= $this->ishop_model->get_distributor_by_retailer($user->country_id,$retailer_id);
            
            echo $distributor;
            die;
        }
        
        /**
        * @ Function Name	: order_place_details
        * @ Function Params	: 
        * @ Function Purpose 	: For adding order data to databse table order
        * @ Function Return 	: json
        * */
        
        public function order_place_details(){
            
            $user_id = $this->session->userdata('user_id');
            $order_data = $this->ishop_model->add_order_place_details($user_id);
           // echo $order_data;die;
            
            Template::set_message('Your order has been placed. Please note your Order No: '.$order_data,'success');
            redirect('ishop/order_place');
            
        }
        
        public function get_user_by_geo_data(){
            
            $selected_geo_id = $_POST['selected_geo_id'];
            $login_user_country_id = $_POST['country_id'];
            $checked_data = $_POST['checked_data'];
           // echo $selected_geo_id."===".$login_user_country_id."===".$checked_data;die;
            $user_data = $this->ishop_model->get_user_for_geo_data($selected_geo_id,$login_user_country_id,$checked_data);
          //  testdata($user_data);
            echo $user_data;
            die;
            
        }
        
        public function get_retailer_by_customer_data(){
            
            $selected_user_id = $_POST['user_id'];
            $radio_checkedtype = $_POST['checkedtype'];
            $logincustomerrole = $_POST['logincustomerrole'];
            
            $retailer_user_data = $this->ishop_model->get_retailer_for_customer_data($selected_user_id,$radio_checkedtype,$logincustomerrole);
            
            echo $retailer_user_data;
            die;
            
        }
        
        public function get_geo_fo_userdata(){
           
            $selected_user_id = $_POST['user_id']; // login user id
            $user_country = $_POST['user_country'];
            $login_customer_type = $_POST['login_customer_type']; //FO or HO or DISTRIBUTOR or RETAILER
            $customer_type_selected = $_POST['customer_type_selected']; // SELECTED CHECKBOX Retailer, Farmer, Distributor
            
            if($customer_type_selected == "farmer"){
                
                $default_farmer_type = 11;
                
            }
            else if($customer_type_selected == "retailer"){
                
                 $default_farmer_type = 10;
                
            }
            else if($customer_type_selected == "distributor"){
                
                 $default_farmer_type = 9;
                
            }
            
            $get_geo_level_data = $this->ishop_model->get_employee_geo_data($selected_user_id,$user_country,$default_farmer_type);
          //  var_dump($get_geo_level_data);die;
            echo json_encode($get_geo_level_data);
            
            die;
            
        }
        
        public function get_lowergeo_from_uppergeo_data() {
            
            $selected_user_id = $_POST['user_id']; // login user id
            $user_country = $_POST['user_country'];
            $login_customer_type = $_POST['login_customer_type']; //FO or HO or DISTRIBUTOR or RETAILER
            $parent_geo_id = $_POST['parent_geo_id']; // SELECTED CHECKBOX Retailer, Farmer, Distributor
            $checkedtype = $_POST['checkedtype']; 
            //echo $selected_user_id."===".$user_country."===".$login_customer_type."===".$parent_geo_id;
            
            $get_geo_level_data = $this->ishop_model->get_employee_geo_data($selected_user_id,$user_country,$login_customer_type,$parent_geo_id,$checkedtype);
            
            echo json_encode($get_geo_level_data);
            
            //die;
            
            die;
            
        }
        
    
}