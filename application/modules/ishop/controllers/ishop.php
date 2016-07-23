<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Ishop controller
 */
class Ishop extends Front_Controller
{
	protected $permissionCreate = 'Ishop.Ishop.Create';
	protected $permissionDelete = 'Ishop.Ishop.Delete';
	protected $permissionEdit   = 'Ishop.Ishop.Edit';
	protected $permissionView   = 'Ishop.Ishop.View';
	/**
	 * Constructor
	 *
	 * @return void
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->library('users/auth');
        $web_service = @$_POST['flag'];
        if (empty($web_service) && !isset($web_service) && $web_service == null && $web_service != "web_service") {
            $this->auth->restrict($this->permissionView);
        }
		$this->load->helper('application');
		$this->load->library('Template');
		$this->load->library('Assets');
		$this->lang->load('application');
		$this->load->library('events');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->lang->load('ishop');
		$this->load->model('ishop_model');

		$this->set_current_user();
	}

	/**
	 * Display a list of ishop data.
	 *
	 * @return void
	 */
	public function index()
	{


		Assets::add_module_js('ishop', 'primary_sales.js');
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
		$user = $this->auth->user();
		$insert=$this->ishop_model->add_primary_sales_details($user->id,$user->country_id);
		echo $insert;
		die;
	}

	public function check_duplicate_data_primary_sales()
	{
		$customer_id = $this->input->post("customer_id");
		$invoice_no = $this->input->post("invoice_no");

		 $check= $this->ishop_model->check_duplicate_data_for_primary_sales($customer_id,$invoice_no);
		 echo $check;
		 die;
	}

	public function get_data_primary_sales_by_invoice()
	{
		$invoice_no = $this->input->post("invoice_no");
		$customer_id = $this->input->post("customer_id");

		$check= $this->ishop_model->get_data_primary_sales_by_invoice_no($invoice_no,$customer_id);
		echo json_encode($check);
		die;
	}

	public function get_data_primary_sales_product_by_invoice()
	{
		$primary_sales_id = $this->input->post("primary_sales_id");
		$check= $this->ishop_model->get_data_primary_sales_product_by_invoice($primary_sales_id);

		$html='';
		if(isset($check) && !empty($check))
		{
			$i=1;
			foreach($check as $k=>$val)
			{
				$html .="<tr>";
				$html .="<td data-title='Sr. No.' class='numeric'>";
				$html .="<input class='input_remove_border'  type='text' value=".$i." readonly/>";
				$html .="</td>";
				$html .="<td  data-title='Action' class='numeric'>";
				$html .="<div class='delete_i primary_sls' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>";
				$html .="</td>";
				$html .="<td data-title='Product SKU Code' class='numeric'>";
				$html .="<input class='input_remove_border' type='text' value=".$val['product_sku_code']." readonly>";
				$html .="</td>";
				$html .="<td data-title='Product SKU Name'>";
				$html .="<input class='input_remove_border' type='text' value=".$val['product_sku_name']." readonly>";
				$html .="<input type='hidden' name='product_sku_id[]' value=".$val['product_sku_id'].">";
				$html .="</td>";
				$html .="<td data-title='PO Qty'>";
				$html .="<input type='text' class='allownumericwithdecimal' name='quantity[]' value=".$val['quantity'].">";
				$html .="</td>";
				$html .="<td data-title='Dispatched Qty'>";
				$html .="<input type='text' class='allownumericwithdecimal' name='dispatched_quantity[]' value=".$val['dispatched_quantity'].">";
				$html .="</td>";
				$html .="<td data-title='Amount'>";
				$html .="<input type='text' class='allownumericwithdecimal' name='amount[]' value=".$val['amount'].">";
				$html .="</td>";
				$html .="</tr>";
				$i++;
			}
		}
		echo $html;
		die;
	}
	/**
	 * @ Function Name        : primary_sales_view_details
	 * @ Function Params    :
	 * @ Function Purpose    : Return list of distributor
	 * @ Function Return    : Array
	 * */

	public function primary_sales_view_details()
	{
		Assets::add_module_js('ishop', 'primary_sales_view.js');
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
		$user = $this->auth->user();

		$form_date = (isset($_POST['form_date']) ? $_POST['form_date'] : '');
		$to_date = (isset($_POST['to_date']) ? $_POST['to_date'] : '');
		$by_distributor = (isset($_POST['by_distributor']) ? $_POST['by_distributor'] : '');
		$by_invoice_no = (isset($_POST['by_invoice_no']) ? $_POST['by_invoice_no'] : '');

		$page = (isset($_POST['page']) ? $_POST['page'] : '');



		$primary_sales_details = $this->ishop_model->get_primary_details_view($form_date, $to_date, $by_distributor, $by_invoice_no,null,$page,$user->local_date);

		Template::set('td', $primary_sales_details['count']);
		Template::set('pagination', (isset($primary_sales_details['pagination']) && !empty($primary_sales_details['pagination'])) ? $primary_sales_details['pagination'] : '' );

		//testdata($primary_sales_details);

		Template::set('table', $primary_sales_details);
		Template::set_view('ishop/primary_sales');
		Template::render();
	}


	public function update_sales_details()
	{
		$user = $this->auth->user();
		$update_sales_details = $this->ishop_model->update_sales_detail($user->id,$user->country_id);
		echo $update_sales_details;
		die;
	}

	public function delete_sales_details()
	{
		$sales_id = isset($_POST['sales_id']) ? $_POST['sales_id'] : '';
		$this->ishop_model->delete_sales_detail($sales_id);
		redirect('ishop/primary_sales_view_details');
	}
	public function delete_sales_product_details()
	{
		$product_sales_id = isset($_POST['product_sales_id']) ? $_POST['product_sales_id'] : '';
		$this->ishop_model->delete_sales_product_detail($product_sales_id);
		redirect('ishop/primary_sales_view_details');
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
		Assets::add_module_js('ishop', 'rol.js');
		$user = $this->auth->user();
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);
		$default_retailer_role = 10;

		$action_data = $this->uri->segment(2);

		$logined_user_role = $user->role_id;
		$retailer_geo_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_role,null,$default_retailer_role,$action_data);

		if($logined_user_role== 7){
			$checked_type = (isset($_POST['checked_type']) && !empty($_POST['checked_type']) ) ? $_POST['checked_type'] :'retailer';

		}
		else{
			$checked_type=null;
		}

		$page = (isset($_POST['page']) ? $_POST['page'] : '');
		$rol= $this->ishop_model->get_all_rol_by_user($user->id,$user->country_id,$logined_user_role,$checked_type,null,$page);

		Template::set('td', $rol['count']);
		Template::set('pagination', (isset($rol['pagination']) && !empty($rol['pagination'])) ? $rol['pagination'] : '' );

		Template::set('table', $rol);
		//testdata($retailer_geo_data);
		Template::set('geo_data', $retailer_geo_data);
		Template::set('current_user', $user);
		Template::set('product_sku', $product_sku);
		Template::set_view('ishop/rol');
		Template::render();
	}


	public function update_rol_limit_details()
	{
		$user = $this->auth->user();
		$update = $this->ishop_model->update_rol_limit_detail($user->id,$user->country_id);
		echo $update;
		die;
	}

	public function delete_rol_details()
	{
		$rol_id = isset($_POST['rol_id']) ? $_POST['rol_id'] : '';
		$this->ishop_model->delete_rol_limit_detail($rol_id);
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
		$user = $this->auth->user();
		$add = $this->ishop_model->add_rol_detail($user->id,$user->country_id);
		echo $add;
		die;
	}

	/**
	 * @ Function Name        : secondary_sales_details
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */

	public function secondary_sales_details()
	{
		Assets::add_module_js('ishop', 'secondary_sales.js');
		$user = $this->auth->user();
		$retailer = $this->ishop_model->get_retailer_by_distributor_id($user->id, $user->country_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);

		Template::set('current_user', $user);
		Template::set('retailer', $retailer);
		Template::set('product_sku', $product_sku);
		Template::set_view('ishop/secondary_sales');
		Template::render();
	}

	public function check_duplicate_data_secondary_sales()
	{
		//testdata($_POST);
		$customer_id = $this->input->post("customer_id");
		$invoice_no = $this->input->post("invoice_no");
		$login_id = $this->input->post("login_id");

		$check= $this->ishop_model->check_duplicate_data_for_secondary_sales($customer_id,$invoice_no,$login_id);
		echo $check;
		die;
	}

	public function get_data_secondary_sales_by_invoice()
	{
		$invoice_no = $this->input->post("invoice_no");
		$login_id = $this->input->post("login_id");
		$customer_id = $this->input->post("customer_id");

		$check= $this->ishop_model->get_data_secondary_sales_by_invoice_no($invoice_no,$login_id,$customer_id);
		echo json_encode($check);
		die;
	}

	public function get_data_secondary_sales_product_by_invoice()
	{
		$secondary_sales_id = $this->input->post("secondary_sales_id");
		$check= $this->ishop_model->get_data_secondary_sales_product_by_invoice($secondary_sales_id);
		//testdata($check);
		$html='';
		if(isset($check) && !empty($check))
		{
			$i=1;
			foreach($check as $k=>$val)
			{
				$html .="<tr id=".$i.">";
				$html .="<td data-title='Sr. No.' class='numeric'>";
				$html .="<input class='input_remove_border'  type='text' value=".$i." readonly/>";
				$html .="</td>";
				$html .="<td  data-title='Action' class='numeric'>";
				$html .="<div class='delete_i secondary_sal' attr-dele=''><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a></div>";
				$html .="</td>";
				$html .="<td data-title='Retailer Name' class='numeric'>";
				$html .="<input class='input_remove_border'  type='text' value=".$val['display_name']." readonly/>";
				$html .="</td>";
				$html .="<td data-title='Product SKU Code' class='numeric'>";
				$html .="<input class='input_remove_border' type='text' value=".$val['product_sku_code']." readonly>";
				$html .="</td>";
				$html .="<td data-title='Product SKU Name'>";
				$html .="<input class='input_remove_border' type='text' value=".$val['product_sku_name']." readonly>";
				$html .="<input type='hidden' class='sku_".$i."' name='product_sku_id[]' value=".$val['product_sku_id'].">";
				$html .="</td>";
				$html .="<td data-title=' Qty'>";
				$html .="<input type='text' class='quantity_data numeric allownumericwithdecimal' name='quantity[]' value=".$val['quantity'].">";
				$html .="</td>";
				$html .="<td data-title='Units'>";

				$box_select = "";
				$packages_select = "";
				$kg_per_ltr_select = "";
				if($val["unit"] == 'box'){
					$box_select = "selected='selected'";
				}
				if($val["unit"] == 'packages'){
					$packages_select = "selected='selected'";
				}
				if($val["unit"] == 'kg/ltr'){
					$kg_per_ltr_select = "selected='selected'";
				}

				$html .="<select name='units[]' class='select_unitdata' id='unit_id' >";
				$html .="<option ".$box_select." value='box'>Box</option>";
				$html .="<option ".$packages_select."  value='packages'>Packages</option>";
				$html .="<option ".$kg_per_ltr_select."  value='kg/ltr'>Kg/Ltr</option>";
				$html .="</select>";


				$html .="</td>";
				$html .="<td data-title='Amount'>";
				$html .="<input type='text' name='amount[]' class='allownumericwithdecimal' value=".$val['amount'].">";
				$html .="</td>";
				$html .="<td data-title='Qty Kg/Ltr'>";
				$html .="<input class='input_remove_border qty_".$i."' type='text' name='qty_kgl[]' value=".$val['qty_kgl']." readonly>";
				$html .="</td>";
				$html .="</tr>";

				$i++;
			}
		}
		echo $html;
		die;
	}

	/**
	 * @ Function Name        : add_secondary_sales_details
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */

	public function add_secondary_sales_details()
	{
		$user = $this->auth->user();
		$add = $this->ishop_model->add_secondary_sales_details_data($user->id, $user->country_id);
		echo $add;
		die;
	}

	/**
	 * @ Function Name        : secondary_sales_details_view
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */

	public function secondary_sales_details_view()
	{

		Assets::add_module_js('ishop', 'secondary_sales_view.js');

		$user = $this->auth->user();
		$retailer = $this->ishop_model->get_retailer_by_distributor_id($user->id, $user->country_id);
		Template::set('retailer', $retailer);
		Template::set_view('ishop/secondary_sales_view');
		Template::render();
	}

	/**
	 * @ Function Name        : secondary_sales_view_details
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */

	public function secondary_sales_view_details()
	{
		//testdata($_POST);
		$user = $this->auth->user();
		$form_date = (isset($_POST['form_date']) ? $_POST['form_date'] : '');
		$to_date = (isset($_POST['to_date']) ? $_POST['to_date'] : '');
		$by_retailer = (isset($_POST['by_retailer']) ? $_POST['by_retailer'] : '');
		$by_invoice_no = (isset($_POST['by_invoice_no']) ? $_POST['by_invoice_no'] : '');

		$page = (isset($_POST['page']) ? $_POST['page'] : '');

		$secondary_sales_details = $this->ishop_model->secondary_sales_details_data_view($form_date, $to_date, $by_retailer, $by_invoice_no,$user->id,$user->country_id,$sales_view=null,null,null,null,null,$page,null,$user->local_date);

		Template::set('td', $secondary_sales_details['count']);
		Template::set('pagination', (isset($secondary_sales_details['pagination']) && !empty($secondary_sales_details['pagination'])) ? $secondary_sales_details['pagination'] : '' );

		Template::set('table', $secondary_sales_details);
		Template::set_view('ishop/secondary_sales_view');
		Template::render();
	}

	/**
	 * @ Function Name        : secondary_sales_product_details_view
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */

	public function secondary_sales_product_details_view()
	{
		$secondary_sales_id = (isset($_POST['id']) ? $_POST['id'] : '');
		if (isset($secondary_sales_id) && !empty($secondary_sales_id)) {
			$secondary_sales_details = $this->ishop_model->secondary_sales_product_details_view_by_id($secondary_sales_id);

			Template::set('td', $secondary_sales_details['count']);
			Template::set('pagination', (isset($secondary_sales_details['pagination']) && !empty($secondary_sales_details['pagination'])) ? $secondary_sales_details['pagination'] : '' );

			Template::set('table', $secondary_sales_details);
		}
		Template::set_view('ishop/secondary_sales_view');
		Template::render();
	}

	public function update_secondary_sales_details()
	{
		$user = $this->auth->user();
		$update =$this->ishop_model->update_secondary_sales_detail($user->id,$user->country_id);
		echo $update;
		die;
	}

	public function delete_secondary_sales_details()
	{
		$secondary_sales_id = isset($_POST['secondary_sales_id']) ? $_POST['secondary_sales_id'] : '';
		$this->ishop_model->delete_secondary_sales_detail($secondary_sales_id);
		redirect('ishop/secondary_sales_view_details');
	}

	public function delete_secondary_sales_product_details()
	{
		$secondary_product_sales_id = isset($_POST['secondary_product_sales_id']) ? $_POST['secondary_product_sales_id'] : '';
		$this->ishop_model->delete_secondary_sales_product_detail($secondary_product_sales_id);
		redirect('ishop/secondary_sales_view_details');
	}

	/**
	 * @ Function Name        : physical_stock
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */


	public function physical_stock()
	{
		Assets::add_module_js('ishop', 'physical_stock.js');
		$user = $this->auth->user();
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);

		$default_retailer_role = 10;

		$action_data = $this->uri->segment(2);

		$logined_user_role = $user->role_id;
		$retailer_geo_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_role,null,$default_retailer_role,$action_data);

		if($logined_user_role== 8){
			$checked_type = (isset($_POST['checked_type']) && !empty($_POST['checked_type']) ) ? $_POST['checked_type'] :'retailer';
		}
		else{
			$checked_type=null;
		}
		//$checked_type= $_POST['checked_type'];
		$page = (isset($_POST['page']) ? $_POST['page'] : '');

		$stock_month = (isset($_POST['stock_month']) ? $_POST['stock_month'] : '');
		$physical_stock= $this->ishop_model->get_all_physical_stock_by_user($user->id,$user->country_id,$user->role_id,$checked_type,$page,null,$stock_month,$user->local_date);

		Template::set('td', $physical_stock['count']);
		Template::set('pagination', (isset($physical_stock['pagination']) && !empty($physical_stock['pagination'])) ? $physical_stock['pagination'] : '' );

		Template::set('table', $physical_stock);
		Template::set('geo_data', $retailer_geo_data);
		Template::set('product_sku', $product_sku);
		Template::set('current_user', $user);
		Template::set_view('ishop/physical_stock');
		Template::render();
	}

	/**
	 * @ Function Name        : add_physical_stock_details
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */

	public function add_physical_stock_details()
	{
		$user = $this->auth->user();
		$add = $this->ishop_model->add_physical_stock_detail($user->id,$user->country_id);
		echo $add;
		die;
	}


	public function update_physical_stock_details()
	{
		$user = $this->auth->user();
		$update = $this->ishop_model->update_physical_stock_detail($user->id,$user->country_id);
		echo $update;
		die;
	}


	public function delete_physical_stock_details()
	{
		$stock_id = isset($_POST['stock_id']) ? $_POST['stock_id'] : '';
		$this->ishop_model->delete_physical_stock_details($stock_id);
	}


	/**
	 * @ Function Name        : invoice_received_confirmation
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */

	public function invoice_received_confirmation()
	{
		Assets::add_module_js('ishop', 'invoice_confirmation.js');

		Template::set_view('ishop/invoice_received_confirmation');
		Template::render();
	}


	public function invoice_confirmation_received()
	{
		$user = $this->auth->user();
		$invoice_month = (isset($_POST['invoice_month']) ? $_POST['invoice_month'] : '');
		$po_no = (isset($_POST['po_no']) ? $_POST['po_no'] : '');
		$invoice_no = (isset($_POST['invoice_no']) ? $_POST['invoice_no'] : '');
		$page = (isset($_POST['page']) ? $_POST['page'] : '');

		$invoice_receved = $this->ishop_model->invoice_confirmation_received_by_distributor($invoice_month,$po_no,$invoice_no,$user->id,$user->country_id,$page);

		Template::set('td', $invoice_receved['count']);
		Template::set('pagination', (isset($invoice_receved['pagination']) && !empty($invoice_receved['pagination'])) ? $invoice_receved['pagination'] : '' );

		Template::set('table',$invoice_receved);
		Template::set_view('ishop/invoice_received_confirmation');
		Template::render();
	}

	public function update_invoice_confirmation_received()
	{
		//testdata($_POST['sales']);
		$user = $this->auth->user();
		$sales_id=  (isset($_POST['sales']) ? $_POST['sales'] : '');
		$update = $this->ishop_model->update_invoice_confirmation_received_by_distributor($sales_id,$user->id,$user->country_id);
		echo $update;
		die;
	}

	public function invoice_sales_product_details_view()
	{
		$user = $this->auth->user();
		$sales_id = (isset($_POST['id']) ? $_POST['id'] : '');

		$invoice_product = $this->ishop_model->invoice_sales_product_details($sales_id);
		Template::set('table',$invoice_product);
		Template::set_view('ishop/invoice_received_confirmation');
		Template::render();
	}

	/**
	 * @ Function Name        : ishop_sales
	 * @ Function Params    :
	 * @ Function Purpose    :
	 * @ Function Return    :
	 * */


	public function ishop_sales()
	{
		Assets::add_module_js('ishop', 'ishop_sales.js');
		$user = $this->auth->user();
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);

		$default_retailer_role = 10;

		$action_data = $this->uri->segment(2);

		$logined_user_role = $user->role_id;
		$retailer_geo_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_role,null,$default_retailer_role,$action_data);


		Template::set('geo_data', $retailer_geo_data);
		Template::set('product_sku', $product_sku);
		Template::set('current_user', $user);
		Template::set_view('ishop/ishop_sales');
		Template::render();
	}

	/**
	 * @ Function Name      : get_retailers_by_distributor
	 * @ Function Params    :
	 * @ Function Purpose   :
	 * @ Function Return    :
	 * */

	public function get_retailers_by_distributor()
	{

		$distributor_id = $_POST['distributor_id'];
		$country_id = $_POST['country'];
		$retailers= $this->ishop_model->get_retailer_by_distributor_id($distributor_id,$country_id);
		//testdata($retailers);
		echo json_encode($retailers);;
		die;
	}

	/**
	 * @ Function Name      : add_ishop_sales_details
	 * @ Function Params    :
	 * @ Function Purpose   :
	 * @ Function Return    :
	 * */

	public function add_ishop_sales_details()
	{
		$user = $this->auth->user();
		$user_id = $this->session->userdata('user_id');

		$add = $this->ishop_model->add_ishop_sales_detail($user->id,$user->country_id);
		echo $add;
		die;
	}


	public function sales_view()
	{
		Assets::add_module_js('ishop', 'sales_view.js');
		$user = $this->auth->user();
		$default_retailer_role = 10;

		$action_data = $this->uri->segment(2);

		$logined_user_role = $user->role_id;
		$retailer_geo_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_role,null,$default_retailer_role,$action_data);


		Template::set('geo_data', $retailer_geo_data);
		Template::set('current_user', $user);
		Template::set_view('ishop/sales_view');
		Template::render();
	}

	public function view_ishop_sales_details()
	{
		$user = $this->auth->user();
		$check_redio = (isset($_POST['radio1']) ? $_POST['radio1'] : '');
		$page = (isset($_POST['page']) ? $_POST['page'] : '');

		if($check_redio == 'retailer')
		{
			$from_month = (isset($_POST['from_month']) ? $_POST['from_month'] : '');
			$to_month = (isset($_POST['to_month']) ? $_POST['to_month'] : '');
			$geo_level_0 = (isset($_POST['geo_level_0']) ? $_POST['geo_level_0'] : '');
			$geo_level_1 = (isset($_POST['geo_level_1']) ? $_POST['geo_level_1'] : '');
			$retailer_id = (isset($_POST['fo_retailer_id']) ? $_POST['fo_retailer_id'] : '');
			$tertiary = $this->ishop_model-> view_ishop_sales_detail_by_retailer($user->id,$user->country_id,$from_month,$to_month,$geo_level_0,$geo_level_1,$retailer_id,$page,null,$user->local_date);
			Template::set('table', $tertiary);
			Template::set('td', $tertiary['count']);
			Template::set('pagination', (isset($tertiary['pagination']) && !empty($tertiary['pagination'])) ? $tertiary['pagination'] : '' );

		}
		elseif($check_redio == 'distributor')
		{
			$from_month = (isset($_POST['from_month']) ? $_POST['from_month'] : '');
			$to_month = (isset($_POST['to_month']) ? $_POST['to_month'] : '');
			$geo_level = (isset($_POST['distributor_geo_level']) ? $_POST['distributor_geo_level'] : '');
			$distributor_id = (isset($_POST['distributor_sales']) ? $_POST['distributor_sales'] : '');
			$invoice_no = (isset($_POST['invoice_no']) ? $_POST['invoice_no'] : '');
			$secondary = $this->ishop_model->secondary_sales_details_data_view($form_date=null,$to_date=null,$by_retailer=null,$invoice_no,$user->id,$user->country_id,'sales_view',$from_month,$to_month,$geo_level,$distributor_id,$page,null,$user->local_date);

			Template::set('table', $secondary);
			Template::set('td', $secondary['count']);
			Template::set('pagination', (isset($secondary['pagination']) && !empty($secondary['pagination'])) ? $secondary['pagination'] : '' );

		}

		Template::set_view('ishop/sales_view');
		Template::render();
	}


	public function sales_product_details_view()
	{

		$sales_id = (isset($_POST['id']) ? $_POST['id'] : '');
		$checkedtype = (isset($_POST['checkedtype']) ? $_POST['checkedtype'] : '');

		if ($checkedtype == "retailer") {

			$tertiary_sales_details = $this->ishop_model->tertiary_sales_product_details_view_by_id($sales_id);

			Template::set('td', $tertiary_sales_details['count']);
			Template::set('pagination', (isset($tertiary_sales_details['pagination']) && !empty($tertiary_sales_details['pagination'])) ? $tertiary_sales_details['pagination'] : '' );
			Template::set('table', $tertiary_sales_details);
		}
		else{
			$secondary_sales_details = $this->ishop_model->secondary_sales_product_details_view_by_id($sales_id);

			Template::set('td', $secondary_sales_details['count']);
			Template::set('pagination', (isset($secondary_sales_details['pagination']) && !empty($secondary_sales_details['pagination'])) ? $secondary_sales_details['pagination'] : '' );
			Template::set('table', $secondary_sales_details);
		}
		Template::set_view('ishop/sales_view');
		Template::render();
	}


	public function update_ishop_sales_details()
	{
		//testdata($_POST);
		$user = $this->auth->user();
		$sales = $this->ishop_model->update_ishop_sales_detail($user->id,$user->country_id);
		echo $sales;
		die;
	}


	public function delete_ishop_sales_details()
	{
		$sales_id = isset($_POST['secondary_sales_id']) ? $_POST['secondary_sales_id'] : '';
		$checked_type = isset($_POST['checked_type']) ? $_POST['checked_type'] : '';
		$this->ishop_model->delete_ishop_sales_detail($sales_id,$checked_type);

	}

	public function delete_ishop_sales_product_details()
	{
		//testdata($_POST);
		$product_sales_id = isset($_POST['secondary_product_sales_id']) ? $_POST['secondary_product_sales_id'] : '';
		$checked_type = isset($_POST['checked_type']) ? $_POST['checked_type'] : '';
		$this->ishop_model->delete_ishop_sales_product_detail($product_sales_id,$checked_type);
	}

	/**
	 * @ Function Name      : company_current_stock
	 * @ Function Params    :
	 * @ Function Purpose   :
	 * @ Function Return    :
	 * */

	public function company_current_stock()
	{
		Assets::add_module_js('ishop', 'current_stock.js');

		$user = $this->auth->user();

		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);
		$page = (isset($_POST['page']) ? $_POST['page'] : '');
		$current_stock= $this->ishop_model->get_all_company_current_stock($user->country_id,null,$page,$user->local_date);

		Template::set('td', $current_stock['count']);
		Template::set('pagination', (isset($current_stock['pagination']) && !empty($current_stock['pagination'])) ? $current_stock['pagination'] : '' );

		Template::set('table', $current_stock);
		Template::set('product_sku', $product_sku);
		Template::set('current_user', $user);
		Template::set_view('ishop/current_stock');
		Template::render();
	}

	/**
	 * @ Function Name      : add_company_current_stock_details
	 * @ Function Params    :
	 * @ Function Purpose   :
	 * @ Function Return    :
	 * */

	public function add_company_current_stock_details()
	{
		$user = $this->auth->user();
		$user_id = $this->session->userdata('user_id');
		$add = $this->ishop_model->add_company_current_stock_detail($user_id,$user->country_id);
		echo $add;
		die;
	}


	public function update_current_stock_details()
	{
		$user = $this->auth->user();
		$add = $this->ishop_model->update_current_stock_details($user->id,$user->country_id);
		echo $add;
		die;

	}
	public function delete_current_stock_details()
	{
		$stock_id = isset($_POST['stock_id']) ? $_POST['stock_id'] : '';
		$this->ishop_model->delete_current_stock_detail($stock_id);
		redirect('ishop/company_current_stock');
	}

	/**
	 * @ Function Name      : credit_limit
	 * @ Function Params    :
	 * @ Function Purpose   :
	 * @ Function Return    :
	 * */

	public function credit_limit()
	{
		Assets::add_module_js('ishop', 'credit_limit.js');

		$user = $this->auth->user();
		$distributor = $this->ishop_model->get_distributor_by_user_id($user->country_id);

		$page = (isset($_POST['page']) ? $_POST['page'] : '');

		$credit_limit= $this->ishop_model->get_all_distributors_credit_limit($user->country_id,null,$page,$user->local_date);

		Template::set('td', $credit_limit['count']);
		Template::set('pagination', (isset($credit_limit['pagination']) && !empty($credit_limit['pagination'])) ? $credit_limit['pagination'] : '' );

		Template::set('table', $credit_limit);
		Template::set('distributor', $distributor);
		Template::set('current_user', $user);
		Template::set_view('ishop/credit_limit');
		Template::render();
	}

	/**
	 * @ Function Name      : add_user_credit_limit_datails
	 * @ Function Params    :
	 * @ Function Purpose   :
	 * @ Function Return    :
	 * */

	public function add_user_credit_limit_datails()
	{
		$user = $this->auth->user();
		$user_id = $this->session->userdata('user_id');
		$add = $this->ishop_model->add_user_credit_limit_datail($user_id,$user->country_id);
		echo $add;
		die;
	}

	public function set_schemes()
	{
		Assets::add_module_js('ishop', 'scheme.js');
		$user = $this->auth->user();
		$default_retailer_role = 10;
		$parent_id = null;
		$logined_user_role = $user->role_id;

		$retailer_geo_data = $this->ishop_model->get_business_geo_data($user->id,$user->country_id,$default_retailer_role,$parent_id,$year=null,$logined_user_role);
		//testdata($retailer_geo_data);
		$schemes = $this->ishop_model->get_all_schemes($user->country_id);

		Template::set('geo_data', $retailer_geo_data);
		Template::set('schemes', $schemes);

		Template::set('current_user', $user);
		Template::set_view('ishop/scheme');
		Template::render();
	}

	public function get_lower_business_geo_data()
	{
		$user = $this->auth->user();
		$login_user_type = $user->role_id;
		$user_id=$_POST['user_id'];
		$country_id=$_POST['country_id'];
		$role=$_POST['role'];
		$parent_geo_id=$_POST['parent_geo_id'];
		$retailer_geo_data = $this->ishop_model->get_business_geo_data($user_id,$country_id,$role,$parent_geo_id,$year=null,$login_user_type);
		echo json_encode($retailer_geo_data);
		die;
	}

	public function get_user_by_business_geo_data()
	{
		$selected_geo_id=$_POST['selected_geo_id'];
		$country_id=$_POST['country_id'];
		$retailer = $this->ishop_model->get_business_geo_data_to_retailer($selected_geo_id,$country_id);
		echo json_encode($retailer);;
		die;
	}


	public function get_slab_by_selected_schemes()
	{
		$scheme_id = $_POST['selected_schemes'];
		$retailer_id = $_POST['selected_retailer'];
		$selected_year = $_POST['selected_year'];
		$user = $this->auth->user();

		$get_scheme= $this->ishop_model->check_scheme_alocated_retailer($scheme_id,$retailer_id,$selected_year,$user->country_id);

		if(isset($get_scheme) && !empty($get_scheme) && $get_scheme!='')
		{

			$get_slabs= $this->ishop_model->get_slab_by_selected_scheme_id($scheme_id,null,$get_scheme);
		}
		else{
			$get_slabs= $this->ishop_model->get_slab_by_selected_scheme_id($scheme_id,null);
		}
		Template::set('table',$get_slabs);
		Template::set_view('ishop/scheme');
		Template::render();
	}


	public function check_schemes_details()
	{
		$user = $this->auth->user();
		$user_id = $this->session->userdata('user_id');
		$allocation_id = $this->ishop_model->check_schemes_detail($user_id,$user->country_id);
		echo json_encode($allocation_id);
		die;
	}

	public function add_schemes_details()
	{
		$user = $this->auth->user();
		$user_id = $this->session->userdata('user_id');
		$add = $this->ishop_model->add_schemes_detail($user_id,$user->country_id);
		echo $add;
		die;
	}

	public function update_schemes_details()
	{
		$user = $this->auth->user();
		$user_id = $this->session->userdata('user_id');
		$add = $this->ishop_model->update_schemes_detail($user_id,$user->country_id);
		echo $add;
		die;
	}


	public function get_schemes_by_selected_cur_year()
	{
		//$selected_cur_year =  $_POST['selected_cur_year'].'-01-01';
		$selected_cur_year =  $_POST['selected_cur_year'];
		$country_id =  $_POST['country_id'];
		$schemes=$this->ishop_model->get_schemes_by_selected_year($selected_cur_year,$country_id);
		echo json_encode($schemes);;
		die;
	}

	public function schemes_view()
	{
		Assets::add_module_js('ishop', 'scheme_view.js');
		$user = $this->auth->user();
		$login_user_type= $user->role_id;

		$default_retailer_role = 10;
		$parent_id = null;

		$retailer_geo_data = $this->ishop_model->get_business_geo_data($user->id,$user->country_id,$default_retailer_role,$parent_id,$year=null,$login_user_type);

		Template::set('geo_data', $retailer_geo_data);
		Template::set('current_user', $user);
		Template::set_view('ishop/scheme_view');
		Template::render();
	}

	public function view_schemes_details()
	{
		$user = $this->auth->user();
		$user_id = $this->session->userdata('user_id');
		$login_user_role=$user->role_id;
		$year = $this->input->post("year");
		$region = $this->input->post("region");
		$territory = $this->input->post("territory");
		$retailer = $this->input->post("fo_retailer_id");
		$page = (isset($_POST['page']) ? $_POST['page'] : '');

		$scheme_view=$this->ishop_model->view_schemes_detail($user_id,$user->country_id,$year,$region,$territory,$login_user_role,$retailer,$page);
	//	testdata($scheme_view);

		if($login_user_role==7){
			Template::set('scheme_table',$scheme_view);
		}
		else{
			Template::set('table',$scheme_view);
		}
		Template::set('td', $scheme_view['count']);
		Template::set('pagination', (isset($scheme_view['pagination']) && !empty($scheme_view['pagination'])) ? $scheme_view['pagination'] : '' );

		Template::set_view('ishop/scheme_view');
		Template::render();
		//testdata($scheme_view);
	}
	public function delete_schemes()
	{
		$checked_schemes = $this->input->post("checked_schemes");

		$param = $this->input->post("param");
		$year = $param[0]['value'];
		$region = $param[1]['value'];
		$territory = $param[2]['value'];

		$user = $this->auth->user();
		$user_id = $this->session->userdata('user_id');
		$this->ishop_model->delete_schemes_by_id($checked_schemes);

		$page = (isset($_POST['page']) ? $_POST['page'] : '');
		$scheme_view=$this->ishop_model->view_schemes_detail($user_id,$user->country_id,$year,$region,$territory,$user->role_id,null,$page);
		Template::set('td', $scheme_view['count']);
		Template::set('pagination', (isset($scheme_view['pagination']) && !empty($scheme_view['pagination'])) ? $scheme_view['pagination'] : '' );

		Template::set('scheme_table',$scheme_view);
		Template::set_view('ishop/scheme_view');
		Template::render();
	}

	public function get_region_by_selected_cur_year()
	{
		$year =  $_POST['selected_cur_year'];
		//testdata($year);
		$user = $this->auth->user();
		$login_user_type = $user->role_id;
		$default_retailer_role=10;
		$parent_id=null;
		$business_geo_data = $this->ishop_model->get_business_geo_data($user->id,$user->country_id,$default_retailer_role,$parent_id,$year,$login_user_type);
		echo json_encode($business_geo_data);;
		die;
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
            
            $get_geo_level_data = "";
            $action_data = $this->uri->segment(2);
            //DEFAULT SELECTED RADIO BUTTON FOR DIFFERENT USER ROLES
            
            if($logined_user_type == 7){
                //FOR HO
                $default_type_selected = 9;
                
                $get_geo_level_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_type,null,$default_type_selected,$action_data);
            }
            elseif($logined_user_type == 8){
                //FOR FO
                $default_type_selected = 11;
                $get_geo_level_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_type,null,$default_type_selected,$action_data);
            
                
            }
            elseif($logined_user_type == 9){
                //FOR DISTRIBUTOR
                $default_type_selected = null; 
            }
            elseif($logined_user_type == 10){
                //FOR RETAILER
                $default_type_selected = null; 
            }

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

            $user= $this->auth->user();
            $user_country_id = $user->country_id;
            $order_data = $this->ishop_model->add_order_place_details($user_id,$user_country_id);

			echo $order_data;
			die;
            
        }
        
        /**
        * @ Function Name	: get_user_by_geo_data
        * @ Function Params	: 
        * @ Function Purpose 	: For getting user data on the base of selected GEO data
        * @ Function Return 	: json
        * */
        
        public function get_user_by_geo_data(){
            $selected_geo_id = $_POST['selected_geo_id'];
            $login_user_country_id = $_POST['country_id'];
            $checked_data = $_POST['checked_data'];
            
            $mobile_num = null;
            if(isset($_POST['moblie_num'])){
                
                $mobile_num = $_POST['moblie_num'];
                
            }

            $user_data = $this->ishop_model->get_user_for_geo_data($selected_geo_id,$login_user_country_id,$checked_data,$mobile_num);
            echo $user_data;
            die;
            
        }

        /**
        * @ Function Name	: get_retailer_by_customer_data
        * @ Function Params	: 
        * @ Function Purpose 	: For getting retailer data on the base of selected customer (farmer) data
        * @ Function Return 	: json
        * */
        
        public function get_retailer_by_customer_data(){
            
            $selected_user_id = $_POST['user_id'];
            $radio_checkedtype = $_POST['checkedtype'];
            $logincustomerrole = $_POST['logincustomerrole'];
            
            $retailer_user_data = $this->ishop_model->get_retailer_for_customer_data($selected_user_id,$radio_checkedtype,$logincustomerrole);
            
            echo $retailer_user_data;
            die;
            
        }
        
        /**
        * @ Function Name	: get_geo_fo_userdata
        * @ Function Params	: 
        * @ Function Purpose 	: For getting geo data for loged in user on page hit first time //ONLY FOR FO user
        * @ Function Return 	: json
        * */
        
        public function get_geo_fo_userdata(){
           
            $selected_user_id = $_POST['user_id']; // login user id
            $user_country = $_POST['user_country'];
            $login_customer_type = $_POST['login_customer_type']; //FO or HO or DISTRIBUTOR or RETAILER
            $customer_type_selected = $_POST['customer_type_selected']; // SELECTED CHECKBOX Retailer, Farmer, Distributor
            
            $url_data = $_POST['urlsegment'];
            
            if($customer_type_selected == "farmer"){
                $default_type = 11;
            }
            else if($customer_type_selected == "retailer"){
                 $default_type = 10;
            }
            else if($customer_type_selected == "distributor"){
                 $default_type = 9;
            }
            
            $get_geo_level_data = $this->ishop_model->get_employee_geo_data($selected_user_id,$user_country,$login_customer_type,null,$default_type,$url_data);
            echo json_encode($get_geo_level_data);
            die;
            
        }
        
        public function get_copy_popup_geo_data(){
            
         //   $selected_user_id = $_POST['user_id']; // login user id
            $user_country = $_POST['user_country'];
            $login_customer_type = $_POST['login_customer_type']; //FO or HO or DISTRIBUTOR or RETAILER
            $customer_type_selected = $_POST['customer_type_selected']; // SELECTED CHECKBOX Retailer, Farmer, Distributor
            
            $url_data = $_POST['urlsegment'];
            
            if($customer_type_selected == "farmer"){
                
                $default_type = 11;
                
            }
            else if($customer_type_selected == "retailer"){
                
                 $default_type = 10;
                
            }
            else if($customer_type_selected == "distributor"){
                
                 $default_type = 9;
                
            }
            
            $get_geo_level_data = $this->ishop_model->get_employee_geo_data_for_copy_popup($user_country,$login_customer_type,$default_type,$url_data);
          //  var_dump($get_geo_level_data);die;
            echo json_encode($get_geo_level_data);
            
            die;
            
        }
        
        /**
        * @ Function Name	: get_lowergeo_from_uppergeo_data
        * @ Function Params	: 
        * @ Function Purpose 	: For getting child geo data for selected parent geo
        * @ Function Return 	: json
        * */
        
        public function get_lowergeo_from_uppergeo_data() {
            
            $selected_user_id = $_POST['user_id']; // login user id
            $user_country = $_POST['user_country'];
            $login_customer_type = $_POST['login_customer_type']; //FO or HO or DISTRIBUTOR or RETAILER
            $parent_geo_id = $_POST['parent_geo_id']; // SELECTED CHECKBOX Retailer, Farmer, Distributor
            $checkedtype = $_POST['checkedtype']; 
            
            
            if($checkedtype == "farmer"){
                $default_type = 11;
            }
            else if($checkedtype == "retailer"){
                 $default_type = 10;
                
            }
            else if($checkedtype == "distributor"){
                 $default_type = 9;
                
            }

            $url_data = $_POST['urlsegment'];
            $radio_selected_data = $_POST['checkedtype'];
           // echo $url_data;
            //echo $selected_user_id."===".$user_country."===".$login_customer_type."===".$parent_geo_id;
            
            $get_geo_level_data = $this->ishop_model->get_employee_geo_data($selected_user_id,$user_country,$login_customer_type,$parent_geo_id,$default_type,$url_data);
            
            echo json_encode($get_geo_level_data);
            die;
            
        }
        
        /**
        * @ Function Name	: get_lower_geo_by_parent_geo_formobile_data
        * @ Function Params	: 
        * @ Function Purpose 	: For getting child geo data for selected parent geo on entering mobile number for FO, Farmer selected (radio button)
        * @ Function Return 	: json
        * */
        
        public function get_lower_geo_by_parent_geo_formobile_data() {
            
            $selected_user_id = $_POST['user_id']; // login user id
            $user_country = $_POST['user_country'];
            $login_customer_type = $_POST['login_customer_type']; //FO or HO or DISTRIBUTOR or RETAILER
            $parent_geo_id = $_POST['parent_geo_id']; // SELECTED CHECKBOX Retailer, Farmer, Distributor
            $checkedtype = $_POST['checkedtype']; 
            
            
            if($checkedtype == "farmer"){
                
                $default_type = 11;
                
            }
            else if($checkedtype == "retailer"){
                
                 $default_type = 10;
                
            }
            else if($checkedtype == "distributor"){
                
                 $default_type = 9;
                
            }
            
            
            $url_data = $_POST['urlsegment'];
            $radio_selected_data = $_POST['checkedtype']; 
            $mobileno = $_POST['moblie_num'];
           // echo $url_data;
            
            //echo $selected_user_id."===".$user_country."===".$login_customer_type."===".$parent_geo_id;
            
            $get_geo_level_data = $this->ishop_model->get_employee_geo_data($selected_user_id,$user_country,$login_customer_type,$parent_geo_id,$default_type,$url_data,$mobileno);
            
            echo json_encode($get_geo_level_data);
            
            //die;
            
            die;
            
        }
        
        /**
        * @ Function Name	: get_data_from_mobile_num
        * @ Function Params	: 
        * @ Function Purpose 	: For getting parent geo data on entering mobile number for FO, Farmer selected (radio button)
        * @ Function Return 	: json
        * */
        
        
        public function get_data_from_mobile_num() {
            
            $mobileno = $_POST['mobileno'];
            $selected_user_id = $_POST['loginuserid']; 
            $login_customer_type = $_POST['loginusertype']; 
             
            $user_country = $_POST['user_country'];
            $url_data = $_POST['urlsegment'];
            
            $default_type = 11;
             
           $parent_geo_id = "";
            
         //   $get_geo_level_data = $this->ishop_model->get_mobile_user_geo_data($loginuserid,$user_country,$loginusertype,$default_type,$url_data,$mobileno,$parent_geo_id);
           
            $get_geo_level_data = $this->ishop_model->get_employee_geo_data($selected_user_id,$user_country,$login_customer_type,$parent_geo_id,$default_type,$url_data,$mobileno);
           
            echo json_encode($get_geo_level_data);
            die;
            
        }
        
        
        /*
         * PRESPECTIVE ORDER
         */
        
        /**
        * @ Function Name	: prespective_order
        * @ Function Params	: 
        * @ Function Purpose 	: For getting prescriptive orders (HOME screen)
        * @ Function Return 	: 
        * */
        
        public function prespective_order() {
            
            Assets::add_module_js('ishop', 'prespective_order.js');
            
            $user = $this->auth->user();
		
            $logined_user_type = $user->role_id;
            $logined_user_id = $user->id;
            $logined_user_countryid = $user->country_id;
            
            Template::set('login_customer_type',$logined_user_type);
            Template::set('login_customer_id',$logined_user_id);
            Template::set('login_customer_countryid',$logined_user_countryid);
            
            Template::set_view('ishop/prespective_order');
            Template::render();
        }
        
        /**
        * @ Function Name	: get_prespective_order
        * @ Function Params	: 
        * @ Function Purpose 	: For getting prescriptive orders
        * @ Function Return 	: 
        * */
        
        public function get_prespective_order() {

			//var_dump($_POST);
            $from_date = $_POST["form_date"];
            $todate = $_POST["to_date"];
            $loginusertype = $_POST["login_customer_type"];
            $loginuserid = $_POST["login_customer_id"];
			$page = (isset($_POST['page']) ? $_POST['page'] : '');

			$user = $this->auth->user();

            $prespective_order = $this->ishop_model->get_prespective_order($from_date,$todate,$loginusertype,$loginuserid,$page,null,$user->local_date);
            

		
            $logined_user_type = $user->role_id;
            $logined_user_id = $user->id;
            $logined_user_countryid = $user->country_id;
            
            Template::set('login_customer_type',$logined_user_type);
            Template::set('login_customer_id',$logined_user_id);
            Template::set('login_customer_countryid',$logined_user_countryid);
            
            Template::set('prespective_order_data', $prespective_order);

			Template::set('td', $prespective_order['count']);
			Template::set('pagination', (isset($prespective_order['pagination']) && !empty($prespective_order['pagination'])) ? $prespective_order['pagination'] : '' );


			Template::set_view('ishop/prespective_order');
            Template::render();
            
        }
        
        /**
        * @ Function Name	: get_prespective_order_details
        * @ Function Params	: 
        * @ Function Purpose 	: For getting prescriptive orders details on click of specific order
        * @ Function Return 	: 
        * */
        
        public function get_prespective_order_details()
	{
		$order_id = (isset($_POST['id']) ? $_POST['id'] : '');
		if(isset($order_id) && !empty($order_id))
		{
			$order_details= $this->ishop_model->order_product_details_view_by_id($order_id);

			Template::set('prespective_order_data',$order_details);

		//	Template::set('td', $order_details['count']);
			//Template::set('pagination', (isset($order_details['pagination']) && !empty($order_details['pagination'])) ? $order_details['pagination'] : '' );

		}
		Template::set_view('ishop/prespective_order');
		Template::render();
	}
        
        /**
        * @ Function Name	: mark_order_as_read
        * @ Function Params	: 
        * @ Function Purpose 	: For updateing order status as read
        * @ Function Return 	: 
        * */
        
        public function mark_order_as_read() {
            $order_id = (isset($_POST['orderid']) ? $_POST['orderid'] : '');
            $mark_read = $this->ishop_model->order_mark_as_read($order_id);
            echo $mark_read;
            die;
        }
        
        /**
        * @ Function Name	: mark_order_as_unread
        * @ Function Params	: 
        * @ Function Purpose 	: For updateing order status as unread
        * @ Function Return 	: 
        * */
        
        
        public function mark_order_as_unread() {
            
            $order_id = (isset($_POST['orderid']) ? $_POST['orderid'] : '');
            $mark_unread = $this->ishop_model->order_mark_as_unread($order_id);
            echo $mark_unread;
            die;
        }
        
        
        /*
         * ORDER STATUS
         */
        
         /**
        * @ Function Name	: order_status
        * @ Function Params	: 
        * @ Function Purpose 	: For getting order status data (HOME SCREEN)
        * @ Function Return 	: 
        * */
        
        public function order_status() {
            
            Assets::add_module_js('ishop', 'order_place.js');
            Assets::add_module_js('ishop', 'order_status.js');
            
            $user= $this->auth->user();
            
            $distributor= $this->ishop_model->get_distributor_by_user_id($user->country_id);
            
            $retailer= $this->ishop_model->get_retailer_by_user_id($user->country_id); 
            
            $product_sku= $this->ishop_model->get_product_sku_by_user_id($user->country_id);
            
            $logined_user_type = $user->role_id;
            $logined_user_id = $user->id;
            $logined_user_countryid = $user->country_id;
            
            $get_geo_level_data = "";
            $action_data = $this->uri->segment(2);

            
            //DEFAULT SELECTED RADIO BUTTON FOR DIFFERENT USER ROLES
            
            if($logined_user_type == 7){
                
                //FOR HO
                $default_type_selected = 9;
                
                $get_geo_level_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_type,null,$default_type_selected,$action_data);
            
                
            }
            elseif($logined_user_type == 8){
            
                //FOR FO
                $default_type_selected = 11; 
                
                $get_geo_level_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_type,null,$default_type_selected,$action_data);
            
                
            }
            elseif($logined_user_type == 9){
            
                //FOR DISTRIBUTOR
                $default_type_selected = null; 
            }
            elseif($logined_user_type == 10){
            
                //FOR RETAILER
                $default_type_selected = null; 
            }
           
          //  echo "<pre>";
          //  print_r($get_geo_level_data);
          //  die;
            
		  //var_dump($distributor);die;
            Template::set('login_customer_type',$logined_user_type);
            Template::set('login_customer_id',$logined_user_id);
            Template::set('login_customer_countryid',$logined_user_countryid);
            
            Template::set('distributor',$distributor);
            Template::set('retailer',$retailer);
            Template::set('product_sku',$product_sku);
            
            
            Template::set('geo_level_data',$get_geo_level_data);
            
            Template::set_view('ishop/order_status');
            Template::render();
            
        }
        
         /**
        * @ Function Name	: get_order_status_data
        * @ Function Params	: 
        * @ Function Purpose 	: For getting order status data
        * @ Function Return 	: 
        * */
        
        public function get_order_status_data() {
            
            
            Assets::add_module_js('ishop', 'order_place.js');
            Assets::add_module_js('ishop', 'order_status.js');
            
            $user= $this->auth->user();
            
            $distributor= $this->ishop_model->get_distributor_by_user_id($user->country_id);
            
            $retailer= $this->ishop_model->get_retailer_by_user_id($user->country_id); 
            
            $product_sku= $this->ishop_model->get_product_sku_by_user_id($user->country_id);
            
            $logined_user_type = $user->role_id;
            $logined_user_id = $user->id;
            $logined_user_countryid = $user->country_id;
            
            $get_geo_level_data = "";
            $action_data = $this->uri->segment(2);
            
            //DEFAULT SELECTED RADIO BUTTON FOR DIFFERENT USER ROLES
            
            if($logined_user_type == 7){
                
                //FOR HO
                $default_type_selected = 9;
                
                $get_geo_level_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_type,null,$default_type_selected,$action_data);
            
                
            }
            elseif($logined_user_type == 8){
            
                //FOR FO
                $default_type_selected = 11; 
                
                $get_geo_level_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_type,null,$default_type_selected,$action_data);
            
                
            }
            elseif($logined_user_type == 9){
            
                //FOR DISTRIBUTOR
                $default_type_selected = null; 
            }
            elseif($logined_user_type == 10){
            
                //FOR RETAILER
                $default_type_selected = null; 
            }
           
            /*
             *  GETTING POST FROM DATA HERE
             */

			$page = (isset($_POST['page']) ? $_POST['page'] : '');
         $loginusertype = $_POST["login_customer_type"];

         if($loginusertype == 7){
            
            //FOR HO
            $radio_checked = $_POST["radio1"];
            
            if($radio_checked == "distributor"){
                
                $from_date = $_POST["form_date"];
                $todate = $_POST["to_date"];

                $loginuserid = $_POST["login_customer_id"];


                $geo_level_1_data = $_POST["dis_distributor_geo_level_1_data"];
                $distributor_id = $_POST["distributor_id"];
                $page_function = $_POST["page_function"];

                $order_data = $this->ishop_model->get_order_data($loginusertype,$logined_user_countryid,$radio_checked,$loginuserid,$distributor_id,$from_date,$todate,null,null,$page,null,null,null,$user->local_date);
                
                
                
         }
         elseif($radio_checked == "retailer"){
             
                $from_date = $_POST["form_date"];
                $todate = $_POST["to_date"];

                $loginuserid = $_POST["login_customer_id"];

                $customer_id = $_POST["retailer_id"];
                $page_function = $_POST["page_function"];

                $order_data = $this->ishop_model->get_order_data($loginusertype,$logined_user_countryid,$radio_checked,$loginuserid,$customer_id,$from_date,$todate,null,null,$page,null,null,null,$user->local_date);
                
                
         }
            
            
            
        }
        else if($loginusertype == 8){
            
            //FOR FO
            
              $radio_checked = $_POST["radio1"];
              
            if($radio_checked == "farmer"){
                
                $from_date = $_POST["form_date"];
                $todate = $_POST["to_date"];

                $loginuserid = $_POST["login_customer_id"];


                $geo_level_1_data = $_POST["geo_level_1_data"];
                
                $farmer_data = "";
                
                $order_tracking_no = $_POST["order_tracking_no"];
                
                $order_tracking_no = (isset($_POST['order_tracking_no']) ? $_POST['order_tracking_no'] : '');
                
                   
                $farmer_data =  (isset($_POST['farmer_data']) ? $_POST['farmer_data'] : '');
                  //  $farmer_data = $_POST["farmer_data"];
                
                $page_function = $_POST["page_function"];
                
                
                $order_data = $this->ishop_model->get_order_data($loginusertype,$logined_user_countryid,$radio_checked,$loginuserid,$farmer_data,$from_date,$todate,$order_tracking_no,null,$page,null,null,null,$user->local_date);
                
                
                
         }elseif($radio_checked == "distributor"){
                
                $from_date = $_POST["form_date"];
                $todate = $_POST["to_date"];

                $loginuserid = $_POST["login_customer_id"];


                $geo_level_1_data = $_POST["geo_level_1_data"];
                $distributor_id = $_POST["distributor_data"];
                $page_function = $_POST["page_function"];

                $order_data = $this->ishop_model->get_order_data($loginusertype,$logined_user_countryid,$radio_checked,$loginuserid,$distributor_id,$from_date,$todate,null,null,$page,null,null,null,$user->local_date);
                
                
                
         }
         elseif($radio_checked == "retailer"){
             
                $from_date = $_POST["form_date"];
                $todate = $_POST["to_date"];

                $loginuserid = $_POST["login_customer_id"];

                $customer_id = $_POST["retailer_data"];
                $page_function = $_POST["page_function"];

                $order_data = $this->ishop_model->get_order_data($loginusertype,$logined_user_countryid,$radio_checked,$loginuserid,$customer_id,$from_date,$todate,null,null,$page,null,null,null,$user->local_date);
                
                //echo "<pre>";
                //print_r($order_data);
                
             //die;
         }
            
            
        }
        else if($loginusertype == 9){
            
            //FOR DISTRIBUTOR
           
             $from_date = $_POST["form_date"];
             $todate = $_POST["to_date"];

            $loginuserid = $_POST["login_customer_id"];
            $radio_checked = "";
            $customer_id = $loginuserid;
            
            $order_data = $this->ishop_model->get_order_data($loginusertype,$logined_user_countryid,$radio_checked,$loginuserid,$customer_id,$from_date,$todate,null,null,$page,null,null,null,$user->local_date);
            
        }
        else if($loginusertype == 10){

            //FOR RETAILER
            
             $from_date = $_POST["form_date"];
             $todate = $_POST["to_date"];

            $loginuserid = $_POST["login_customer_id"];
            $radio_checked = "";
            $customer_id = $loginuserid;
            
            $order_data = $this->ishop_model->get_order_data($loginusertype,$logined_user_countryid,$radio_checked,$loginuserid,$customer_id,$from_date,$todate,null,null,$page,null,null,null,$user->local_date);
            
            
        }

			Template::set('order_table', $order_data);

			Template::set('td', $order_data['count']);
			Template::set('pagination', (isset($order_data['pagination']) && !empty($order_data['pagination'])) ? $order_data['pagination'] : '' );

			Template::set('login_customer_type',$logined_user_type);
            Template::set('login_customer_id',$logined_user_id);
            Template::set('login_customer_countryid',$logined_user_countryid);
            
            Template::set('distributor',$distributor);
            Template::set('retailer',$retailer);
            Template::set('product_sku',$product_sku);
            
            Template::set('geo_level_data',$get_geo_level_data);
            
            Template::set_view('ishop/order_status');
            Template::render();
            
        }
        
        /**
        * @ Function Name	: get_order_status_data_details
        * @ Function Params	: 
        * @ Function Purpose 	: For getting order status data details on click of single data
        * @ Function Return 	: 
        * */
        
        public function get_order_status_data_details() {

                $order_id = (isset($_POST['id']) ? $_POST['id'] : '');
                $radiochecked = (isset($_POST['radiochecked']) ? $_POST['radiochecked'] : '');
                $logincustomertype = $_POST['logincustomertype'];
                
                $action_data = (isset($_POST['segment_data']) ? $_POST['segment_data'] : '');
                $order_details = "";
				if(isset($order_id) && !empty($order_id))
				{
					$order_details= $this->ishop_model->order_status_product_details_view_by_id($order_id,$radiochecked,$logincustomertype,$action_data);
				}
               
           // testdata($order_details);
            
                //echo $action_data;die;
                
                if($action_data == "po_acknowledgement"){

                    Template::set('po_ack_table',$order_details);
                    
                //    Template::set('po_acknowledgement_table',$order_details);
                    
                    Template::set_view('ishop/po_acknowledgement');
                }
                elseif($action_data == "order_approval"){
                    
                    Template::set('order_approval_table',$order_details);

                    Template::set_view('ishop/order_approval');
                }
                else{
                  
                    Template::set('order_table',$order_details);
                    Template::set_view('ishop/order_status');
                }
		//	Template::set('td', $order_details['count']);
			//Template::set('pagination', (isset($order_details['pagination']) && !empty($order_details['pagination'])) ? $order_details['pagination'] : '' );
			Template::render();
            
        }
        
        
       public function update_po_data() {
            
            $orderid = $_POST['orderid'];
            $po_numdata = $_POST['po_numdata'];
            
            $check_po_data = $this->ishop_model->check_po_data($po_numdata);
            if($check_po_data != 0){
                $po_data_status = $this->ishop_model->update_po_data($orderid,$po_numdata);
            }
            else{
                $po_data_status = $check_po_data;
            }
                    
            echo $po_data_status;
            die;
        }
        
        
        /**
        * @ Function Name	: update_order_status_detail_data
        * @ Function Params	: 
        * @ Function Purpose 	: For updating status of order detailed data 
        * @ Function Return 	: 
        * */
        
        public function update_order_status_detail_data() {
            $detail_data = $_POST;
            $detail_update = $this->ishop_model->update_order_detail_data($detail_data);
            echo $detail_update;
            die;
        }
        
        /**
        * @ Function Name	: delete_order_detail_data
        * @ Function Params	: 
        * @ Function Purpose 	: For deleting of order detailed data 
        * @ Function Return 	: 
        * */
        
        public function delete_order_detail_data(){
            
            $order_product_id = $_POST["data_id"];
            $detail_delete = $this->ishop_model->delete_order_detail_data($order_product_id);
            die;
            
        }

        /**
        * @ Function Name	: delete_product_order_data
        * @ Function Params	: 
        * @ Function Purpose 	: For deleting of order data 
        * @ Function Return 	: 
        * */
        
        public function delete_product_order_data(){
            
            $order_id = $_POST["data_id"];
            $detail_delete = $this->ishop_model->delete_order_data($order_id);
            die;
            
        }
        
       
        
        /*
         * PO ACKNOWLEDGEMENT
         */
        
        /**
        * @ Function Name	: po_acknowledgement
        * @ Function Params	: 
        * @ Function Purpose 	: For getting po_acknowledgement order data 
        * @ Function Return 	: 
        * */

        public function po_acknowledgement() {
            Assets::add_module_js('ishop', 'order_place.js');
            Assets::add_module_js('ishop', 'order_status.js');
            Assets::add_module_js('ishop', 'po_acknowledgement.js');
            
            $user= $this->auth->user();
            $logined_user_countryid = $user->country_id;
            $distributor= $this->ishop_model->get_distributor_by_user_id($user->country_id);
            $retailer= $this->ishop_model->get_retailer_by_user_id($user->country_id);
            $product_sku= $this->ishop_model->get_product_sku_by_user_id($user->country_id);
            
            $logined_user_type = $user->role_id;
            $logined_user_id = $user->id;
            $logined_user_countryid = $user->country_id;
            
            $get_geo_level_data = "";
            $action_data = $this->uri->segment(2);

			$per_page = (isset($_POST['per_page']) ? $_POST['per_page'] : '');
			$page = (isset($_POST['page']) ? $_POST['page'] : '');

            if(isset($_POST) && !empty($_POST)){

				$update_order_data = $this->ishop_model->update_order_data($_POST);
				echo $update_order_data;
				die;

            }

             $from_date = "";
             $todate = "";

            $radio_checked = "";
            $customer_id = $logined_user_id;


            $order_data = $this->ishop_model->get_order_data($logined_user_type,$logined_user_countryid,$radio_checked,$logined_user_id,$customer_id,$from_date,$todate,null,null,$page,null,null,null,$user->local_date);
            
            Template::set('po_ack_table', $order_data);
			Template::set('td', $order_data['count']);
			Template::set('pagination', (isset($order_data['pagination']) && !empty($order_data['pagination'])) ? $order_data['pagination'] : '' );
            Template::set('login_customer_type',$logined_user_type);
            Template::set('login_customer_id',$logined_user_id);
            Template::set('login_customer_countryid',$logined_user_countryid);
            Template::set('distributor',$distributor);
            Template::set('retailer',$retailer);
            Template::set('product_sku',$product_sku);
            Template::set('geo_level_data',$get_geo_level_data);
            Template::set_view('ishop/po_acknowledgement');
            Template::render();
            
        }
    
        /**
        * @ Function Name	: update_po_acknowledgement_data
        * @ Function Params	: 
        * @ Function Purpose 	: For updating po_acknowledgement detailed order data 
        * @ Function Return 	: 
        * */
        
        public function update_po_acknowledgement_data(){
            $detail_data = $_POST;
            $detail_update = $this->ishop_model->update_order_detail_data($detail_data);
            redirect("ishop/po_acknowledgement");
            
        }
        
        
        // FOR ORDER APPROVAL
        
        public function order_approval() {
            
            Assets::add_module_js('ishop', 'order_approval.js');
           
            $user= $this->auth->user();
            
            $logined_user_type = $user->role_id;
            $logined_user_id = $user->id;
            $logined_user_countryid = $user->country_id;
            $action_data = $this->uri->segment(2);
            $sub_action_data = $this->uri->segment(3);
            $order_data = "";

			$page = (isset($_POST['page']) ? $_POST['page'] : '');
            if(isset($_POST) && !empty($_POST) && $_POST["form_date"] != "" && $_POST["to_date"] != ""){

                   $from_date = $_POST["form_date"];
				   $todate = $_POST["to_date"];
                   $radio_checked = "";
                   $customer_id = $logined_user_id;

                  $order_data = $this->ishop_model->get_order_data($logined_user_type,$logined_user_countryid,$radio_checked,$logined_user_id,$customer_id,$from_date,$todate,$_POST["by_otn"],$_POST["by_po_no"],$page);
            }

			$pending_count=$this->ishop_model->get_all_pending_data($user->id,$user->country_id);
			//testdata($pending_count);
			Template::set('pending_count',$pending_count);
          //  $order_data = $this->ishop_model->get_order_data($logined_user_type,$radio_checked,$logined_user_id,$customer_id,$from_date,$todate);
            if($order_data != ""){
                Template::set('order_approval_table', $order_data);
				Template::set('td', $order_data['count']);
				Template::set('pagination', (isset($order_data['pagination']) && !empty($order_data['pagination'])) ? $order_data['pagination'] : '' );
			}
            Template::set('login_customer_type',$logined_user_type);
            Template::set('login_customer_id',$logined_user_id);
            Template::set('login_customer_countryid',$logined_user_countryid);
            Template::set_view('ishop/order_approval');
            Template::render();
        }



        public function update_order_approval_detail_data() {
            $detail_data = $_POST;
            $detail_update = $this->ishop_model->update_order_detail_data($detail_data);
            redirect("ishop/order_approval");
        }
        
        public function update_order_approval_status() {
           $detail_data = $_POST;
           $detail_update = $this->ishop_model->update_order_data($detail_data);
			echo $detail_update;
            die;
        }
        
        //TARGET
        
        public function target() {
            Assets::add_module_js('ishop', 'target.js');
            $user= $this->auth->user();
            $product_sku= $this->ishop_model->get_product_sku_by_user_id($user->country_id);
            $logined_user_type = $user->role_id;
            $get_geo_level_data = "";
            $action_data = $this->uri->segment(2);
			$checked_type=null;

			$checked_type = (isset($_POST['checked_type']) && !empty($_POST['checked_type']) ) ? $_POST['checked_type'] :'distributor';
			$default_type_selected = 9;

			$get_geo_level_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_type,null,$default_type_selected,$action_data);
			$page = (isset($_POST['page']) ? $_POST['page'] : '');
			$target_data= $this->ishop_model->get_target_details($user->id,$user->country_id,$checked_type,$page);
			Template::set('td', $target_data['count']);
			Template::set('pagination', (isset($target_data['pagination']) && !empty($target_data['pagination'])) ? $target_data['pagination'] : '' );

			Template::set('table', $target_data);

            Template::set('login_customer_type',$logined_user_type);

            Template::set('current_user',$user);
            Template::set('product_sku',$product_sku);
            Template::set('geo_level_data',$get_geo_level_data);
            
            Template::set_view('ishop/target');
            Template::render();
            
            
        }

		public function update_target_details()
		{
			$user = $this->auth->user();
			$update = $this->ishop_model->update_target_detail($user->id,$user->country_id);
			echo $update;
			die;
		}

		public function add_target_data() {


			$target_data = $_POST;
			$user= $this->auth->user();
			$set_target_data = $this->ishop_model->add_target_data($target_data,$user->id,null,$user->country_id,$user->role_id);
			echo $set_target_data;
			die;
		}
		public function delete_target_details()
		{
			//testdata($_POST);
			$target_id = isset($_POST['target_id']) ? $_POST['target_id'] : '';
			$this->ishop_model->delete_target_detail($target_id);
		}

        public function get_customer_code() {
            
            $id = $_POST["id"];
            $user_data = $this->ishop_model->get_user_data($id);
            if(!empty($user_data)){
             $data = $user_data[0]["user_code"];
            }
            else{
               $data = ""; 
            }
            echo $data;
            die;      
        }
        
        public function check_target_data_status() {
            
            $product_sku_id = $_POST["product_sku_id"];
           // $month_data = explode("/",$_POST["month_data"]);
            $customer_id = $_POST["customer_id"];
            
            $month_data = $_POST["month_data"]."-01";
            
            $target_data = $this->ishop_model->check_target_data($product_sku_id,$month_data,$customer_id);
            echo $target_data;
            die;
        }
        


	public function target_view()
	{
		Assets::add_module_js('ishop', 'target_view.js');
		$user= $this->auth->user();

		Template::set('current_user',$user);
		Template::set_view('ishop/target_view');
		Template::render();
	}

	public function get_target_view()
	{
		$user= $this->auth->user();
		if(isset($_POST) && !empty($_POST)){
		//	testdata($_POST);
			$target_data = $this->ishop_model->get_target_monthly_data($_POST);
			$target_month_data = $this->ishop_model->get_monthly_data($_POST);
			//dumpme($target_month_data);
			//testdata($target_data);
			Template::set('td', 6);
			Template::set('pagination', (isset($target_data['pagination']) && !empty($target_data['pagination'])) ? $target_data['pagination'] : '' );


			Template::set('target_data',$target_data);
			Template::set('month_data',$target_month_data);

		}
		Template::set('current_user',$user);
		Template::set_view('ishop/target_view');
		Template::render();
	}

        
        //BUDGET

	public function budget() {

            Assets::add_module_js('ishop', 'budget.js');
            
            $user= $this->auth->user();

            $product_sku= $this->ishop_model->get_product_sku_by_user_id($user->country_id);
            
            $logined_user_type = $user->role_id;
            $get_geo_level_data = "";
			$action_data = $this->uri->segment(2);
            
            //DEFAULT SELECTED RADIO BUTTON FOR DIFFERENT USER ROLES


			$checked_type=null;

			$checked_type = (isset($_POST['checked_type']) && !empty($_POST['checked_type']) ) ? $_POST['checked_type'] :'distributor';

			$default_type_selected = 9;
			$get_geo_level_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_type,null,$default_type_selected,$action_data);

			$page = (isset($_POST['page']) ? $_POST['page'] : '');
			$budget_data= $this->ishop_model->get_budget_details($user->id,$user->country_id,$checked_type,$page);


			Template::set('td', $budget_data['count']);
			Template::set('pagination', (isset($budget_data['pagination']) && !empty($budget_data['pagination'])) ? $budget_data['pagination'] : '' );

			Template::set('table', $budget_data);

			Template::set('login_customer_type',$logined_user_type);

			Template::set('current_user',$user);
			Template::set('product_sku',$product_sku);
			Template::set('geo_level_data',$get_geo_level_data);

            Template::set_view('ishop/budget');
            Template::render();
            
        }
        
        public function add_budget_data() {

            $budget_data = $_POST;

			$user= $this->auth->user();
            $set_budget_data = $this->ishop_model->add_budget_data($budget_data,$user->id,null,$user->country_id);
			echo $set_budget_data;
			die;

        }

	public function update_budget_details()
	{
		$user = $this->auth->user();
		$update = $this->ishop_model->update_budget_detail($user->id,$user->country_id);
		echo $update;
		die;
	}

	public function delete_budget_details()
	{
		$budget_id = isset($_POST['budget_id']) ? $_POST['budget_id'] : '';
		$this->ishop_model->delete_budget_detail($budget_id);
	}

	public function check_budget_data_status() {
            
            $product_sku_id = $_POST["product_sku_id"];
           // $month_data = explode("/",$_POST["month_data"]);
            $customer_id = $_POST["customer_id"];
            
            $month_data = $_POST["month_data"]."-01";
            
            $budget_data = $this->ishop_model->check_budget_data($product_sku_id,$month_data,$customer_id);
            echo $budget_data;
            die;
        }
        
        //TARGET DATA UPLOAD
        
        public function upload_data() {

            $web_service = @$_POST['flag'];
            if (empty($web_service) && !isset($web_service) && $web_service == null && $web_service != "web_service") {
                $user= $this->auth->user();
                $logined_user_type = $user->role_id;
				$files = $_POST["upload_file_data"];
            }
			else{

				$logined_user_type =$_POST["role_id"];
				$files = $_FILES["upload_file_data"];

			}

            if(isset($files) && !empty($files))
            {
            
                $file = $_POST["upload_file_data"]["tmp_name"];
                
                

                if (empty($web_service) && !isset($web_service) && $web_service == null && $web_service != "web_service") {
                    $filename = explode("_",$_POST["upload_file_data"]["name"]);
                }else{
                    $filename[] = $_POST["file_name"];
                }
                
                $ext = explode(".",$filename[1]);
                
                
                if($ext[1] == "xlsx")
                {
                
                //load the excel library
                $this->load->library('excel');

                //read file from path
                $objPHPExcel = PHPExcel_IOFactory::load($file);

                //get only the Cell Collection
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                
                $arr_data = array();
                //extract to a PHP readable array format
                foreach ($cell_collection as $cell) {

                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

                    if($filename[0] == "target" || $filename[0] == "budget"){
                        
                        if($column == 'A' && $row != 1 && $data_value != ""){

                                $phpexcepDate = $data_value-25569; //to offset to Unix epoch
                                $data_value = strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
                                $data_value = date("Y-m",$data_value); 
                                
                                $data_value = $data_value."-01"; 

                        }
                        
                    }
                    elseif($filename[0] == "companycurrentstock"){
                    
                        if(($column == 'H' && $row != 1 && $data_value != "") || ($column == 'F' && $row != 1 && $data_value != "") || ($column == 'G' && $row != 1 && $data_value != "")){

                                $phpexcepDate = $data_value-25569; //to offset to Unix epoch
                                $data_value = strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
                                $data_value = date("Y-m-d",$data_value); 

                        }
                    }
                    elseif($filename[0] == "creditlimit"){
                        
                        if($column == 'E' && $row != 1 && $data_value != ""){

                                $phpexcepDate = $data_value-25569; //to offset to Unix epoch
                                $data_value = strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
                                $data_value = date("Y-m-d",$data_value); 

                        }
                        
                    }
                    elseif($filename[0] == "secondarysales"){
                        if($user->role_id == 8)
						{
							if($column == 'F' && $row != 1 && $data_value != ""){

								$phpexcepDate = $data_value-25569; //to offset to Unix epoch
								$data_value = strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
								$data_value = date("Y-m-d",$data_value);

							}
						}
						else{
							if($column == 'D' && $row != 1 && $data_value != ""){

								$phpexcepDate = $data_value-25569; //to offset to Unix epoch
								$data_value = strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
								$data_value = date("Y-m-d",$data_value);

							}
						}
                        
                    }
					elseif($filename[0] == "primarysales"){

						if($column == 'D' && $row != 1 && $data_value != ""){

							$phpexcepDate = $data_value-25569; //to offset to Unix epoch
							$data_value = strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
							$data_value = date("Y-m-d",$data_value);

						}

					}
					elseif($filename[0] == "physicalstock"){

						if($column == 'A' && $row != 1 && $data_value != ""){

							$phpexcepDate = $data_value-25569; //to offset to Unix epoch
							$data_value = strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
                            
                            $data_value = date("Y-m",$data_value); 
                            $data_value = $data_value."-01"; 
                            
							//$data_value = date("Y-m-d",$data_value);

						}

					}

                    //header will/should be in row 1 only. of course this can be modified to suit your need.
                    if ($row == 1) {
                        $header[$row][$column] = $data_value;
                    } else {
                        $arr_data[$row][$column] = $data_value;
                    }
                }

                //send the data in an array format
                $data['header'] = $header;
                $data['values'] = $arr_data;

                //testdata($data);
                
                $error_array = array();
                $final_array = array();
                
              //  testdata($data['values']);
                
                $dist_invoice_ret_mapp_data_array = array();
                $dist_invoice_product_mapp_data_array = array();
                $dist_invoice_otn_mapp_data_array = array();
                
                // CHECK DATA IS PRESENT AND VALID
           if(!empty($data['values'])){   
                foreach($data['values'] as $key=>$data){
                   
                   $inner_array = array();
                   
                   /*
                    *  NEED TO CHANGE AS PER EXCEL FILE
                    */
                  if($filename[0] == "target" || $filename[0] == "budget"){
                      
                        if(!isset($data["A"])){
                            $month_data = "";
                        } 
                        else{
                            $month_data = $data["A"];
                        }

                        if(!isset($data["B"])){
                            $distributor_code = "";
                        }
                        else{
                             $distributor_code = $data["B"];
                        }

                        if(!isset($data["C"])){
                             $distributor_name = "";
                        }
                        else{
                             $distributor_name = $data["C"];
                        }

                        if(!isset($data["D"])){
                            $product_code = "";
                        }
                        else{
                            $product_code = $data["D"];
                        }

                        if(!isset($data["E"])){
                            $product_name = "";
                        }
                        else{
                            $product_name = $data["E"];
                        }

                        if(!isset($data["F"])){
                             $quantity = "";
                        }
                        else{
                             $quantity = $data["F"];
                        }


                        if($month_data == "" || $distributor_code == "" || $distributor_name == "" || $product_code == "" || $product_name == "" || $quantity == "")
                        {
                            //CHECK DATA BLANK

                            if(!isset($error_array["error"]["header"])){
                                 $error_array["error"]["header"] = $header;
                            } 

                            $error_array["error"][] = $month_data."~".$distributor_code."~".$distributor_name."~".$product_code."~".$product_name."~".$quantity."~"."Some row data blank";
                        }
                        else
                        {

                            //CHECK PROPER DATA

                            // DISTRIBUTOR AND PRODUCT CHECK

                            $user_data = $this->ishop_model->check_user_data($distributor_code,$distributor_name);
                            $product_data = $this->ishop_model->check_product_data($product_code,$product_name);

                            if($user_data != 0 && $product_data != 0)
                            {
                                //ADD DATA TO DATA ARRAY

                               // $month_data1 = explode("-",$month_data);
                               // $new_month_data = $month_data1[0]."-".$month_data1[1]."-01";

                                     $inner_array[] = $month_data;
                                     $inner_array[] = $user_data;
                                     $inner_array[] = $product_data;
                                  //   $inner_array[] = $product_code;
                                  //   $inner_array[] = $product_name;
                                     $inner_array[] = $quantity;

                                     $final_array["success"][] = $inner_array;
                                
                            }
                            else{

                                if(!isset($error_array["error"]["header"])){
                                     $error_array["error"]["header"] = $header;
                                }
                                
                                if($user_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "User data not matched with DB data";
                                }
                                if($product_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Product data not matched with DB data";
                                }
                                if($user_data == 0 && $product_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "User Data and Product data not matched with DB data";
                                }
                                
                                $error_array["error"][] = $month_data."~".$distributor_code."~".$distributor_name."~".$product_code."~".$product_name."~".$quantity."~".$error_message;
                            }

                        }
                   
                    }
                    elseif($filename[0] == "companycurrentstock")
                    {
                       
                        if(!isset($data["A"])){
                            $product_code = "";
                        }
                        else{
                            $product_code = $data["A"];
                        }

                        if(!isset($data["B"])){
                            $product_name = "";
                        }
                        else{
                            $product_name = $data["B"];
                        }
                        
                        if(!isset($data["C"])){
                            $batch_no = "";
                        } 
                        else{
                            $batch_no = $data["C"];
                        }

                        if(!isset($data["D"])){
                            $Unrestricted_Qty = "";
                        }
                        else{
                             $Unrestricted_Qty = $data["D"];
                        }

                        if(!isset($data["E"])){
                             $In_Transit_Qty = "";
                        }
                        else{
                             $In_Transit_Qty = $data["E"];
                        }

                        if(!isset($data["F"])){
                             $Expiry_Date = "";
                        }
                        else{
                             $Expiry_Date = $data["F"];
                        }
                        
                        if(!isset($data["G"])){
                             $Mfg_Date = "";
                        }
                        else{
                             $Mfg_Date = $data["G"];
                        }
                        
                        if(!isset($data["H"])){
                             $Date_data = "";
                        }
                        else{
                             $Date_data = $data["H"];
                        }
                        
                        
                        if($product_code == "" || $product_name == "" || $batch_no == "" || $Unrestricted_Qty == "" || $In_Transit_Qty == "" || $Expiry_Date == "" || $Mfg_Date == "")
                        {
                            //CHECK DATA BLANK

                            if(!isset($error_array["error"]["header"])){
                                 $error_array["error"]["header"] = $header;
                            }

                            $error_array["error"][] = $product_code."~".$product_name."~".$batch_no."~".$Unrestricted_Qty."~".$In_Transit_Qty."~".$Expiry_Date."~".$Mfg_Date."~".$Date_data."~"."Some row data blank";
                        }
                        else
                        {
                          
                            //CHECK PROPER DATA

                            //PRODUCT CHECK

                            $product_data = $this->ishop_model->check_product_data($product_code,$product_name);

                            if($product_data != 0)
                            {
                                //ADD DATA TO DATA ARRAY

                                if($Date_data == ""){
                                    $Date_data = date("Y-m-d");
                                }
                                else{
                                    $Date_data = $Date_data;
                                }
                                
                                     $inner_array[] = $product_data;
                                     $inner_array[] = $batch_no;
                                     $inner_array[] = $Unrestricted_Qty;
                                     $inner_array[] = $In_Transit_Qty;
                                     $inner_array[] = $Expiry_Date;
                                     $inner_array[] = $Mfg_Date;
                                     $inner_array[] = $Date_data;

                                     $final_array["success"][] = $inner_array;
                                
                            }
                            else{

                                if(!isset($error_array["error"]["header"])){
                                     $error_array["error"]["header"] = $header;
                                }
                                
                                
                                if($product_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Product data not matched with DB data";
                                }
                                
                                $error_array["error"][] = $product_code."~".$product_name."~".$batch_no."~".$Unrestricted_Qty."~".$In_Transit_Qty."~".$Expiry_Date."~".$Mfg_Date."~".$Date_data."~".$error_message;
                            }
                            
                        }
                   }
                   elseif($filename[0] == "creditlimit")
                   {
                       
                        if(!isset($data["A"])){
                            $distributor_code = "";
                        }
                        else{
                            $distributor_code = $data["A"];
                        }

                        if(!isset($data["B"])){
                            $distributor_name = "";
                        }
                        else{
                            $distributor_name = $data["B"];
                        }
                        
                        if(!isset($data["C"])){
                            $credit_limit = "";
                        } 
                        else{
                            $credit_limit = $data["C"];
                        }

                        if(!isset($data["D"])){
                            $current_outstanding = "";
                        }
                        else{
                             $current_outstanding = $data["D"];
                        }

                        if(!isset($data["E"])){
                             $Date_data = "";
                        }
                        else{
                             $Date_data = $data["E"];
                        }

                        
                        if($distributor_code == "" || $distributor_name == "" || $credit_limit == "" || $current_outstanding == "" || $Date_data == "")
                        {
                            //CHECK DATA BLANK

                            if(!isset($error_array["error"]["header"])){
                                 $error_array["error"]["header"] = $header;
                            }

                            $error_array["error"][] = $distributor_code."~".$distributor_name."~".$credit_limit."~".$current_outstanding."~".$Date_data."~"."Some row data blank";
                        }
                        else
                        {
                          
                            //CHECK PROPER DATA

                            //PRODUCT CHECK
                            
                            $user_data = $this->ishop_model->check_user_data($distributor_code,$distributor_name);
                           

                            if($user_data != 0)
                            {
                                //ADD DATA TO DATA ARRAY

                                if($Date_data == ""){
                                    $Date_data = date("Y-m-d");
                                }
                                else{
                                    $Date_data = $Date_data;
                                }
                                
                                     $inner_array[] = $user_data;
                                     $inner_array[] = $credit_limit;
                                     $inner_array[] = $current_outstanding;
                                     $inner_array[] = $Date_data;

                                     $final_array["success"][] = $inner_array;
                                
                            }
                            else{

                                if(!isset($error_array["error"]["header"])){
                                     $error_array["error"]["header"] = $header;
                                }
                                
                                if($user_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "User data not matched with DB data";
                                }
                                
                                $error_array["error"][] = $distributor_code."~".$distributor_name."~".$credit_limit."~".$current_outstanding."~".$Date_data."~".$error_message;
                            }
                            
                        }
                   }
                   elseif($filename[0] == "rol")
                   {
                       
                       
                       if($logined_user_type == 7)
                       {
                           
                           //FOR HO LOGIN
                       
                            if(!isset($data["A"])){
                                $distributor_code = "";
                            }
                            else{
                                $distributor_code = $data["A"];
                            }

                            if(!isset($data["B"])){
                                $distributor_name = "";
                            }
                            else{
                                $distributor_name = $data["B"];
                            }

                            if(!isset($data["C"])){
                                $product_code = "";
                            } 
                            else{
                                $product_code = $data["C"];
                            }

                            if(!isset($data["D"])){
                                $product_name = "";
                            }
                            else{
                                 $product_name = $data["D"];
                            }

                            if(!isset($data["E"])){
                                 $unit_data = "";
                            }
                            else{
                                 $unit_data = $data["E"];
                            }

                            if(!isset($data["F"])){
                                 $rol_quantity_data = "";
                            }
                            else{
                                 $rol_quantity_data = $data["F"];
                            }


                            if($distributor_code == "" || $distributor_name == "" || $product_code == "" || $product_name == "" || $unit_data == "" || $rol_quantity_data == "")
                            {
                                //CHECK DATA BLANK

                                if(!isset($error_array["error"]["header"])){
                                     $error_array["error"]["header"] = $header;
                                }

                                $error_array["error"][] = $distributor_code."~".$distributor_name."~".$product_code."~".$product_name."~".$unit_data."~".$rol_quantity_data."~"."Some row data blank";
                            }
                            else
                            {

                                //CHECK PROPER DATA

                                //PRODUCT CHECK

                                $user_data = $this->ishop_model->check_user_data($distributor_code,$distributor_name);
                                $product_data = $this->ishop_model->check_product_data($product_code,$product_name);

                                if($user_data != 0 && $product_data != 0)
                                {
                                    //ADD DATA TO DATA ARRAY


                                         $inner_array[] = $user_data;
                                         $inner_array[] = $product_data;
                                         $inner_array[] = $unit_data;
                                         $inner_array[] = $rol_quantity_data;

                                         $final_array["success"][] = $inner_array;

                                }
                                else{
                                    if($user_data == 0){
                                        //USER ERROR MESSAGE
                                        $error_message = "Excel User data not matched with DB data";
                                    }
                                    
                                    if($product_data == 0){
                                        //USER ERROR MESSAGE
                                        $error_message = "Product data not matched with DB data";
                                    }
                                    
                                    if($user_data == 0 && $product_data == 0){
                                        //USER ERROR MESSAGE
                                        $error_message = "Excel User or Product data not matched with DB data";
                                    }

                                    if(!isset($error_array["error"]["header"])){
                                         $error_array["error"]["header"] = $header;
                                    }
                                    $error_array["error"][] = $distributor_code."~".$distributor_name."~".$product_code."~".$product_name."~".$unit_data."~".$rol_quantity_data."~".$error_message;
                                }

                            }

                       }elseif($logined_user_type == 9 || $logined_user_type == 10){
                           
                           //FOR DISTRIBUTOR OR RETAILER LOGIN
                           
                            if(!isset($data["A"])){
                                $product_code = "";
                            } 
                            else{
                                $product_code = $data["A"];
                            }

                            if(!isset($data["B"])){
                                $product_name = "";
                            }
                            else{
                                 $product_name = $data["B"];
                            }

                            if(!isset($data["C"])){
                                 $unit_data = "";
                            }
                            else{
                                 $unit_data = $data["C"];
                            }

                            if(!isset($data["D"])){
                                 $rol_quantity_data = "";
                            }
                            else{
                                 $rol_quantity_data = $data["D"];
                            }

                            if($product_code == "" || $product_name == "" || $unit_data == "" || $rol_quantity_data == "")
                            {
                                //CHECK DATA BLANK

                                if(!isset($error_array["error"]["header"])){
                                     $error_array["error"]["header"] = $header;
                                }

                                $error_array["error"][] = $product_code."~".$product_name."~".$unit_data."~".$rol_quantity_data."~"."Some row data blank";
                            }
                            else
                            {

                                //CHECK PROPER DATA

                                //PRODUCT CHECK

                                $product_data = $this->ishop_model->check_product_data($product_code,$product_name);

                                if($product_data != 0)
                                {
                                    //ADD DATA TO DATA ARRAY

                                         $inner_array[] = $product_data;
                                         $inner_array[] = $unit_data;
                                         $inner_array[] = $rol_quantity_data;

                                         $final_array["success"][] = $inner_array;

                                }
                                else{

                                    if(!isset($error_array["error"]["header"])){
                                         $error_array["error"]["header"] = $header;
                                    }
                                    
                                    if($product_data == 0){
                                        //USER ERROR MESSAGE
                                        $error_message = "Product data not matched with DB data";
                                    }
                                    
                                    $error_array["error"][] = $product_code."~".$product_name."~".$unit_data."~".$rol_quantity_data."~".$error_message;
                                }

                            }
                           
                       }
                       
                   }
                    elseif($filename[0] == "primarysales")
				  {

					  if(!isset($data["A"])){
						  $distributor_code = "";
					  }
					  else{
						  $distributor_code = $data["A"];
					  }

					  if(!isset($data["B"])){
						  $distributor_name = "";
					  }
					  else{
						  $distributor_name = $data["B"];
					  }

					  if(!isset($data["C"])){
						  $invoice_no = "";
					  }
					  else{
						  $invoice_no = $data["C"];
					  }

					  if(!isset($data["D"])){
						  $invoice_date = "";
					  }
					  else{
						  $invoice_date = $data["D"];
					  }

					  if(!isset($data["E"])){
						  $otn = "";
					  }
					  else{
						  $otn = $data["E"];
					  }

					  if(!isset($data["F"])){
						  $po_no = "";
					  }
					  else{
						  $po_no = $data["F"];
					  }

					  if(!isset($data["G"])){
						  $product_code = "";
					  }
					  else{
						  $product_code = $data["G"];
					  }
					  if(!isset($data["H"])){
						  $product_name = "";
					  }
					  else{
						  $product_name = $data["H"];
					  }
					  if(!isset($data["I"])){
						  $po_qty = "";
					  }
					  else{
						  $po_qty = $data["I"];
					  }

					  if(!isset($data["J"])){
						  $dispatch_qty = "";
					  }
					  else{
						  $dispatch_qty = $data["J"];
					  }
					  if(!isset($data["K"])){
						  $amt = "";
					  }
					  else{
						  $amt = $data["K"];
					  }

					  if($distributor_code == "" || $distributor_name == "" || $invoice_no == "" || $invoice_date == "" || $otn == "" || $po_no=="" || $product_code =="" || $product_name == "" || $po_qty == "" || $dispatch_qty =="" || $amt=="")
					  {
						  //CHECK DATA BLANK
						  //$error_array["error"] = 'asdasdasa';
						  if(!isset($error_array["error"]["header"])){
							  $error_array["error"]["header"] = $header;
						  }

						  $error_array["error"][] = $distributor_code."~".$distributor_name."~".$invoice_no."~".$invoice_date."~".$otn."~".$po_no."~".$product_code."~".$product_name."~".$po_qty."~".$dispatch_qty."~".$amt."~"."Some row data blank";
					  }
					  else
					  {
						  //CHECK PROPER DATA
						  //PRODUCT CHECK
						  $user_data = $this->ishop_model->check_user_data($distributor_code,$distributor_name);
						  $product_data = $this->ishop_model->check_product_data($product_code,$product_name);

						  if($user_data != 0 && $product_data != 0)
						  {
							  //ADD DATA TO DATA ARRAY
							  $check_invoice_data = $this->ishop_model->check_invoice_data($invoice_no,$user_data);
							//  testdata($check_invoice_data);
							//  $check_otn_data = $this->ishop_model->check_otn_data($otn);

							  if($check_invoice_data == 1)
							  {
								 // $error_array["error"][]='dsfsdfasdfadsfa';
								  $error_message = "";
								  if($check_invoice_data == 1) {
									  $error_message = "Invoice data already exist in DB";
								  }

								  if(!isset($error_array["error"]["header"])){
									  $error_array["error"]["header"] = $header;
								  }

								  $error_array["error"][] = $distributor_code."~".$distributor_name."~".$invoice_no."~".$invoice_date."~".$otn."~".$po_no."~".$product_code."~".$product_name."~".$po_qty."~".$dispatch_qty."~".$amt."~".$error_message;
							  }
							  else{
								  if(!isset($dist_invoice_otn_mapp_data_array[$invoice_no][$otn])){

									  $dist_invoice_otn_mapp_data_array[$invoice_no][$otn] = $user_data;
									  $inner_array[] = $user_data;
									  $inner_array[] = $invoice_no;
									  $inner_array[] = $invoice_date;
									  $inner_array[] = $otn;
									  $inner_array[] = $po_no;
									  $inner_array[] = $product_data;
									  $inner_array[] = $po_qty;
									  $inner_array[] = $dispatch_qty;
									  $inner_array[] = $amt;

									  $final_array["success"][] = $inner_array;


								  }
								  else{
									  if($dist_invoice_otn_mapp_data_array[$invoice_no][$otn] != $user_data){

										  //SAME INVOICE ASSIGNED TO OTHER RETAILER
										  if(!isset($error_array["error"]["header"])){
											  $error_array["error"]["header"] = $header;
										  }
										  $error_array["error"][] = $distributor_code."~".$distributor_name."~".$invoice_no."~".$invoice_date."~".$otn."~".$po_no."~".$product_code."~".$product_name."~".$po_qty."~".$dispatch_qty."~".$amt."~"."Same invoice assigned to other Distributor";

									  }
									  else{
										  $inner_array[] = $user_data;
										  $inner_array[] = $invoice_no;
										  $inner_array[] = $invoice_date;
										  $inner_array[] = $otn;
										  $inner_array[] = $po_no;
										  $inner_array[] = $product_data;
										  $inner_array[] = $po_qty;
										  $inner_array[] = $dispatch_qty;
										  $inner_array[] = $amt;

										  $final_array["success"][] = $inner_array;

									  }
								  }
							  }

						  }
						  else{

							  if(!isset($error_array["error"]["header"])){
								  $error_array["error"]["header"] = $header;
							  }
                              
                                if($user_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Excel User data not matched with DB data";
                                }

                                if($product_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Product data not matched with DB data";
                                }

                                if($user_data == 0 && $product_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "User and Product data not matched with DB data";
                                }
                              
							  $error_array["error"][] = $distributor_code."~".$distributor_name."~".$invoice_no."~".$invoice_date."~".$otn."~".$po_no."~".$product_code."~".$product_name."~".$po_qty."~".$dispatch_qty."~".$amt."~".$error_message;
						  }

					  }
                   }
                   elseif($filename[0] == "secondarysales")
                   {
					   if($logined_user_type == 8)
					   {
						   if(!isset($data["A"])){
							   $distributor_code = "";
						   }
						   else{
							   $distributor_code = $data["A"];
						   }

						   if(!isset($data["B"])){
							   $distributor_name = "";
						   }
						   else{
							   $distributor_name = $data["B"];
						   }

						   if(!isset($data["C"])){
							   $retailer_code = "";
						   }
						   else{
							   $retailer_code = $data["C"];
						   }

						   if(!isset($data["D"])){
							   $retailer_name = "";
						   }
						   else{
							   $retailer_name = $data["D"];
						   }

						   if(!isset($data["E"])){
							   $invoice_no = "";
						   }
						   else{
							   $invoice_no = $data["E"];
						   }

						   if(!isset($data["F"])){
							   $invoice_date = "";
						   }
						   else{
							   $invoice_date = $data["F"];
						   }

						   if(!isset($data["G"])){
							   $po_no = "";
						   }
						   else{
							   $po_no = $data["G"];
						   }

						   if(!isset($data["H"])){
							   $otn = "";
						   }
						   else{
							   $otn = $data["H"];
						   }

						   if(!isset($data["I"])){
							   $product_code = "";
						   }
						   else{
							   $product_code = $data["I"];
						   }

						   if(!isset($data["J"])){
							   $product_name = "";
						   }
						   else{
							   $product_name = $data["J"];
						   }

						   if(!isset($data["K"])){
							   $unit = "";
						   }
						   else{
							   $unit = $data["K"];
						   }

						   if(!isset($data["L"])){
							   $quantity = "";
						   }
						   else{
							   $quantity = $data["L"];
						   }

						   if(!isset($data["M"])){
							   $amount = "";
						   }
						   else{
							   $amount = $data["M"];
						   }


						   if($distributor_code == "" || $distributor_name == "" || $retailer_code == "" || $retailer_name == "" || $invoice_no == "" || $invoice_date == "" || $po_no == "" || $otn == "" || $product_code == "" || $product_name == "" || $unit == "" || $quantity == "" || $amount == "")
						   {
							   //CHECK DATA BLANK
							   if(!isset($error_array["error"]["header"])){
								   $error_array["error"]["header"] = $header;
							   }

							   $error_array["error"][] = $distributor_code."~".$distributor_name."~".$retailer_code."~".$retailer_name."~".$invoice_no."~".$invoice_date."~".$po_no."~".$otn."~".$product_code."~".$product_name."~".$unit."~".$quantity."~".$amount."~"."Some row data blank";
						   }
						   else
						   {
							   //CHECK PROPER DATA
							   //PRODUCT CHECK
							   $user_distributor_data = $this->ishop_model->check_user_data($distributor_code,$distributor_name);
							   $user_retailer_data = $this->ishop_model->check_user_data($retailer_code,$retailer_name);

							   $product_data = $this->ishop_model->check_product_data($product_code,$product_name);

							   if($user_distributor_data != 0 && $product_data != 0 &&  $user_retailer_data != 0)
							   {
								   //CHECK DISTRIBUTOR RETAILER ASSOCATION
								   $distributor_retailer_mapping_data = $this->ishop_model->check_distributor_retailer_mapping_data($user_distributor_data,$user_retailer_data);

								   // $dist_invoice_ret_mapp_data_array[] = $distributor_retailer_mapping_data;
								   //  dumpme($dist_invoice_ret_mapp_data_array);

								   if($distributor_retailer_mapping_data == 1){


									   if(!isset($dist_invoice_ret_mapp_data_array[$user_distributor_data][$invoice_no]) ){

										   $dist_invoice_ret_mapp_data_array[$user_distributor_data][$invoice_no] = $user_retailer_data;

										   if(!isset($dist_invoice_product_mapp_data_array[$user_distributor_data][$invoice_no])){
											   $dist_invoice_product_mapp_data_array[$user_distributor_data][$invoice_no] = array();
										   }

										   $invoice_retailer_data = $this->ishop_model->check_secondary_invoice_retailer_data($invoice_no,$user_retailer_data,$user_distributor_data);

										  	if($invoice_retailer_data == 1){

												$error_message = "Invoice No for Retailer already exist in DB. ";

												if(!isset($error_array["error"]["header"])){
													$error_array["error"]["header"] = $header;
												}
												$error_array["error"][] = $distributor_code."~".$distributor_name."~".$retailer_code."~".$retailer_name."~".$invoice_no."~".$invoice_date."~".$po_no."~".$otn."~".$product_code."~".$product_name."~".$unit."~".$quantity."~".$amount."~".$error_message;

											}
										   else{
											   if(!isset($dist_invoice_product_mapp_data_array[$user_distributor_data][$invoice_no]) && !in_array($product_data,$dist_invoice_product_mapp_data_array[$user_distributor_data][$invoice_no])){

												   $dist_invoice_product_mapp_data_array[$user_distributor_data][$invoice_no][] = $product_data;

												   $inner_array[] = $user_distributor_data;
												   $inner_array[] = $user_retailer_data;
												   $inner_array[] = $invoice_no;
												   $inner_array[] = $invoice_date;
												   $inner_array[] = $po_no;
												   $inner_array[] = $otn;
												   $inner_array[] = $product_data;
												   $inner_array[] = $unit;
												   $inner_array[] = $quantity;
												   $inner_array[] = $amount;

												   $final_array["success"][] = $inner_array;

											   }
											   else{
												   if(in_array($product_data,$dist_invoice_product_mapp_data_array[$user_distributor_data][$invoice_no])){

													   //DUPLICATE DATA IN FILE ERROR

													   if(!isset($error_array["error"]["header"])){
														   $error_array["error"]["header"] = $header;
													   }
													   $error_array["error"][] = $distributor_code."~".$distributor_name."~".$retailer_code."~".$retailer_name."~".$invoice_no."~".$invoice_date."~".$po_no."~".$otn."~".$product_code."~".$product_name."~".$unit."~".$quantity."~".$amount."~"."Excel file having duplicate product data";

												   }
												   else{
													   $dist_invoice_product_mapp_data_array[$user_distributor_data][$invoice_no][] = $product_data;

													   $inner_array[] = $user_distributor_data;
													   $inner_array[] = $user_retailer_data;
													   $inner_array[] = $invoice_no;
													   $inner_array[] = $invoice_date;
													   $inner_array[] = $po_no;
													   $inner_array[] = $otn;
													   $inner_array[] = $product_data;
													   $inner_array[] = $unit;
													   $inner_array[] = $quantity;
													   $inner_array[] = $amount;

													   $final_array["success"][] = $inner_array;
												   }
											   }
										   }

									   }
									   else{
										   if($dist_invoice_ret_mapp_data_array[$user_distributor_data][$invoice_no] == $user_retailer_data){

											   //DUPLICATE DATA IN FILE ERROR

											   if(!isset($error_array["error"]["header"])){
												   $error_array["error"]["header"] = $header;
											   }
											   $error_array["error"][] = $distributor_code."~".$distributor_name."~".$retailer_code."~".$retailer_name."~".$invoice_no."~".$invoice_date."~".$po_no."~".$otn."~".$product_code."~".$product_name."~".$unit."~".$quantity."~".$amount."~"."Excel file having duplicate data";

										   }
										   else{
											   //SAME INVOICE ASSIGNED TO OTHER RETAILER
											   if(!isset($error_array["error"]["header"])){
												   $error_array["error"]["header"] = $header;
											   }
											   $error_array["error"][] = $distributor_code."~".$distributor_name."~".$retailer_code."~".$retailer_name."~".$invoice_no."~".$invoice_date."~".$po_no."~".$otn."~".$product_code."~".$product_name."~".$unit."~".$quantity."~".$amount."~"."Same invoice assigned to other Retailer";
										   }
									   }
								   }
								   else{
									   //DISTRIBUTOR RETAILER MAPPING ERROR
									   if(!isset($error_array["error"]["header"])){
										   $error_array["error"]["header"] = $header;
									   }
									   $error_array["error"][] = $distributor_code."~".$distributor_name."~".$retailer_code."~".$retailer_name."~".$invoice_no."~".$invoice_date."~".$po_no."~".$otn."~".$product_code."~".$product_name."~".$unit."~".$quantity."~".$amount."~"."Distributor and Retailer not correctly mapped.";
								   }
							   }
							   else{

								   if(!isset($error_array["error"]["header"])){
									   $error_array["error"]["header"] = $header;
								   }
                                   
                                   
                                if($user_distributor_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Distributor data not matched with DB data";
                                }
                                   
                                if($user_retailer_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Retailer data not matched with DB data";
                                }
                                   

                                if($product_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Product data not matched with DB data";
                                }

                                if($user_distributor_data == 0 && $user_retailer_data == 0  && $product_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Distributor data and Retailer data and Product data not matched with DB data";
                                }
                                   
                                   
								   $error_array["error"][] = $distributor_code."~".$distributor_name."~".$retailer_code."~".$retailer_name."~".$invoice_no."~".$invoice_date."~".$po_no."~".$otn."~".$product_code."~".$product_name."~".$unit."~".$quantity."~".$amount."~".$error_message;
							   }
						   }
					   }
					   elseif($logined_user_type == 9)
					   {
						   if(!isset($data["A"])){
							   $retailer_code = "";
						   }
						   else{
							   $retailer_code = $data["A"];
						   }

						   if(!isset($data["B"])){
							   $retailer_name = "";
						   }
						   else{
							   $retailer_name = $data["B"];
						   }

						   if(!isset($data["C"])){
							   $invoice_no = "";
						   }
						   else{
							   $invoice_no = $data["C"];
						   }

						   if(!isset($data["D"])){
							   $invoice_date = "";
						   }
						   else{
							   $invoice_date = $data["D"];
						   }

						   if(!isset($data["E"])){
							   $po_no = "";
						   }
						   else{
							   $po_no = $data["E"];
						   }

						   if(!isset($data["F"])){
							   $otn = "";
						   }
						   else{
							   $otn = $data["F"];
						   }

						   if(!isset($data["G"])){
							   $product_code = "";
						   }
						   else{
							   $product_code = $data["G"];
						   }

						   if(!isset($data["H"])){
							   $product_name = "";
						   }
						   else{
							   $product_name = $data["H"];
						   }

						   if(!isset($data["I"])){
							   $unit = "";
						   }
						   else{
							   $unit = $data["I"];
						   }

						   if(!isset($data["J"])){
							   $quantity = "";
						   }
						   else{
							   $quantity = $data["J"];
						   }

						   if(!isset($data["K"])){
							   $amount = "";
						   }
						   else{
							   $amount = $data["K"];
						   }


						   if($retailer_code == "" || $retailer_name == "" || $invoice_no == "" || $invoice_date == "" || $po_no == "" || $otn == "" || $product_code == "" || $product_name == "" || $unit == "" || $quantity == "" || $amount == "")
						   {
							   //CHECK DATA BLANK

							   if(!isset($error_array["error"]["header"])){
								   $error_array["error"]["header"] = $header;
							   }

							   $error_array["error"][] = $retailer_code."~".$retailer_name."~".$invoice_no."~".$invoice_date."~".$po_no."~".$otn."~".$product_code."~".$product_name."~".$unit."~".$quantity."~".$amount."~"."Some row data blank";
						   }
						   else
						   {

							   //CHECK PROPER DATA

							   //PRODUCT CHECK

							  // $user_distributor_data = $this->ishop_model->check_user_data($distributor_code,$distributor_name);
							   $user_retailer_data = $this->ishop_model->check_user_data($retailer_code,$retailer_name);

							   $product_data = $this->ishop_model->check_product_data($product_code,$product_name);



							   if($product_data != 0 &&  $user_retailer_data != 0)
							   {


								   $invoice_retailer_data = $this->ishop_model->check_secondary_invoice_retailer_data($invoice_no, $user_retailer_data, $user->id);
								   if ($invoice_retailer_data == 1) {
										   $error_message = "Invoice data already exist in DB";

										   if (!isset($error_array["error"]["header"])) {
											   $error_array["error"]["header"] = $header;
										   }

										   $error_array["error"][] = $retailer_code . "~" . $retailer_name . "~" . $invoice_no . "~" . $invoice_date . "~" . $po_no . "~" . $otn . "~" . $product_code . "~" . $product_name . "~" . $unit . "~" . $quantity . "~" . $amount . "~" . $error_message;
									   } else {
										   //CHECK DISTRIBUTOR RETAILER ASSOCATION

										   $distributor_retailer_mapping_data = $this->ishop_model->check_distributor_retailer_mapping_data($user->id, $user_retailer_data);

										   // $dist_invoice_ret_mapp_data_array[] = $distributor_retailer_mapping_data;

										   //  dumpme($dist_invoice_ret_mapp_data_array);


										   if ($distributor_retailer_mapping_data == 1) {

											   if (!isset($dist_invoice_ret_mapp_data_array[$user->id][$invoice_no])) {

												   $dist_invoice_ret_mapp_data_array[$user->id][$invoice_no] = $user_retailer_data;


												   if (!isset($dist_invoice_product_mapp_data_array[$user->id][$invoice_no])) {
													   $dist_invoice_product_mapp_data_array[$user->id][$invoice_no] = array();
												   }


												   if (!isset($dist_invoice_product_mapp_data_array[$user->id][$invoice_no]) && !in_array($product_data, $dist_invoice_product_mapp_data_array[$user->id][$invoice_no])) {

													   $dist_invoice_product_mapp_data_array[$user->id][$invoice_no][] = $product_data;


													   $inner_array[] = $user_retailer_data;
													   $inner_array[] = $invoice_no;
													   $inner_array[] = $invoice_date;
													   $inner_array[] = $po_no;
													   $inner_array[] = $otn;
													   $inner_array[] = $product_data;
													   $inner_array[] = $unit;
													   $inner_array[] = $quantity;
													   $inner_array[] = $amount;

													   $final_array["success"][] = $inner_array;

												   } else {

													   if (in_array($product_data, $dist_invoice_product_mapp_data_array[$user->id][$invoice_no])) {

														   //DUPLICATE DATA IN FILE ERROR

														   if (!isset($error_array["error"]["header"])) {
															   $error_array["error"]["header"] = $header;
														   }
														   $error_array["error"][] = $retailer_code . "~" . $retailer_name . "~" . $invoice_no . "~" . $invoice_date . "~" . $po_no . "~" . $otn . "~" . $product_code . "~" . $product_name . "~" . $unit . "~" . $quantity . "~" . $amount . "~" . "Excel file having duplicate product data";
														   //$retailer_code."~".$retailer_name."~".$invoice_no."~".$invoice_date."~".$po_no."~".$otn."~".$product_code."~".$product_name."~".$unit."~".$quantity."~".$amount."~"."Excel file having duplicate data";
													   } else {

														   $dist_invoice_product_mapp_data_array[$user->id][$invoice_no][] = $product_data;

														   $inner_array[] = $user_retailer_data;
														   $inner_array[] = $invoice_no;
														   $inner_array[] = $invoice_date;
														   $inner_array[] = $po_no;
														   $inner_array[] = $otn;
														   $inner_array[] = $product_data;
														   $inner_array[] = $unit;
														   $inner_array[] = $quantity;
														   $inner_array[] = $amount;

														   $final_array["success"][] = $inner_array;

													   }


												   }

											   } else {
												   if ($dist_invoice_ret_mapp_data_array[$user->id][$invoice_no] == $user_retailer_data) {

													   //DUPLICATE DATA IN FILE ERROR

													   if (!isset($error_array["error"]["header"])) {
														   $error_array["error"]["header"] = $header;
													   }
													   $error_array["error"][] = $retailer_code . "~" . $retailer_name . "~" . $invoice_no . "~" . $invoice_date . "~" . $po_no . "~" . $otn . "~" . $product_code . "~" . $product_name . "~" . $unit . "~" . $quantity . "~" . $amount . "~" . "Excel file having duplicate data";

												   } else {

													   //SAME INVOICE ASSIGNED TO OTHER RETAILER

													   if (!isset($error_array["error"]["header"])) {
														   $error_array["error"]["header"] = $header;
													   }
													   $error_array["error"][] = $retailer_code . "~" . $retailer_name . "~" . $invoice_no . "~" . $invoice_date . "~" . $po_no . "~" . $otn . "~" . $product_code . "~" . $product_name . "~" . $unit . "~" . $quantity . "~" . $amount . "~" . "Same invoice assigned to other Retailer";

												   }
											   }

										   } else {

											   //DISTRIBUTOR RETAILER MAPPING ERROR

											   if (!isset($error_array["error"]["header"])) {
												   $error_array["error"]["header"] = $header;
											   }
											   $error_array["error"][] = $retailer_code . "~" . $retailer_name . "~" . $invoice_no . "~" . $invoice_date . "~" . $po_no . "~" . $otn . "~" . $product_code . "~" . $product_name . "~" . $unit . "~" . $quantity . "~" . $amount . "~" . "Distributor and Retailer not correctly mapped.";

										   }


									   }
							   }
							   else{

								   if(!isset($error_array["error"]["header"])){
									   $error_array["error"]["header"] = $header;
								   }
                                   
                                   
                                if($user_retailer_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Retailer data not matched with DB data";
                                }
                                   

                                if($product_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Product data not matched with DB data";
                                }

                                if($user_retailer_data == 0  && $product_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Retailer data and Product data not matched with DB data";
                                }
                                   
                                   
								   $error_array["error"][] = $retailer_code."~".$retailer_name."~".$invoice_no."~".$invoice_date."~".$po_no."~".$otn."~".$product_code."~".$product_name."~".$unit."~".$quantity."~".$amount."~".$error_message;
							   }

						   }
					   }
                   }
				  elseif($filename[0] == "physicalstock")
				  {

					  if(!isset($data["A"])){
						  $month = "";
					  }
					  else{
						  $month = $data["A"];
					  }

					  if(!isset($data["B"])){
						  $product_code = "";
					  }
					  else{
						  $product_code = $data["B"];
					  }
					  if(!isset($data["C"])){
						  $product_name = "";
					  }
					  else{
						  $product_name = $data["C"];
					  }

					  if(!isset($data["D"])){
						  $qty = "";
					  }
					  else{
						  $qty = $data["D"];
					  }
					  if(!isset($data["E"])){
						  $unit = "";
					  }
					  else{
						  $unit = $data["E"];
					  }


					  if($month == "" || $product_code =="" || $product_name == "" || $qty == "" || $unit =="")
					  {
						  //CHECK DATA BLANK

						  if(!isset($error_array["error"]["header"])){
							  $error_array["error"]["header"] = $header;
						  }

						  $error_array["error"][] = $month."~".$product_code."~".$product_name."~".$qty."~".$unit."~"."Some row data blank";
					  }
					  else
					  {

						  //CHECK PROPER DATA

						  //PRODUCT CHECK

						  $product_data = $this->ishop_model->check_product_data($product_code,$product_name);

						//  testdata($product_data);
						  if($product_data != 0)
						  {
							 

								  $inner_array[] = $month;
								  $inner_array[] = $product_data;
								  $inner_array[] = $qty;
								  $inner_array[] = $unit;

								  $final_array["success"][] = $inner_array;


						  }
						  else{
							 
							  if(!isset($error_array["error"]["header"])){
								  $error_array["error"]["header"] = $header;
							  }
                              
                             
                                   

                                if($product_data == 0){
                                    //USER ERROR MESSAGE
                                    $error_message = "Product data not matched with DB data";
                                }

                              
							  $error_array["error"][] = $month."~".$product_code."~".$product_name."~".$qty."~".$unit."~".$error_message;
						  }

					  }
				  }
                   
                }
               
            }
            else{
                $error_array["error"][] = "No data found";
                echo json_encode($error_array); die;
            }
                header('Content-Type: application/json');
                
                
                
                if(empty($error_array)){
                // testdata($final_array);
					if (empty($web_service) && !isset($web_service) && $web_service == null && $web_service != "web_service") {
						echo  json_encode($final_array); die;
					}
					else{
						  return $final_array;
					}

                }
                else{
					if (empty($web_service) && !isset($web_service) && $web_service == null && $web_service != "web_service") {
						echo json_encode($error_array); die;
					}
					else{
						return $error_array;
					}
                }
                
              }
                else{
                    
                    $error_array["error"][] = "Incorrect format. Please upload xlsx format file.";
                    echo json_encode($error_array); die;
                }
                
            }
            else{
                
                $error_array["error"][] = "No file uploaded";
                echo json_encode($error_array); die;
                
            }
            
        }
        
        public function create_data_xl() {
			//testdata($_POST['val']);
            
            if(!empty($_POST['val']))
            {
                $this->load->library('excel');

                $records=array();
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Incorrect Data');
                $k = 1;
                $l = 1;
                $first_data = 'A'.$l;
                $last_data  = "";
				
                if(!isset($_POST['role_id'])){
                    $user= $this->auth->user();
                    $user_role_id = $user->role_id;
                }
                else{
                   $user_role_id = $_POST['role_id'];
                }
                
                foreach($_POST['val']["header"][1] as $key=> $col_data){
                
                    $this->excel->getActiveSheet()->setCellValue($key.$l,$col_data);
                    $last_data = $key.$l;
                    $this->excel->getActiveSheet()->getStyle($key.$l)->getFont()->setSize(12);
                    $this->excel->getActiveSheet()->getStyle($key.$l)->getFont()->setBold(true);
                    $k++; 
                }

                foreach(range($first_data,$last_data) as $columnID){
                    $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
                }

                $data_array = array();
                
                    $m = 2;
                    foreach($_POST['val'] as $key1 => $value)
                    {
                    	
						//dumpme($value);
						
                        if((string)$key1 != 'header') {
                            $row_data = explode("~",$value);
							
							//dumpme($row_data);
							
                            $j = 0;
                            foreach($_POST['val']["header"][1] as $key2=> $col_data){
                
                                if($_POST["dirname"] == "target" || $_POST["dirname"] == "budget"){
                                    if($j == 0 && ($row_data[$j] != "")){
                                        $date_data = explode("-",$row_data[$j]);
                                        $monthName = date("M", mktime(0, 0, 0, $date_data[1], 10));
                                        $row_data[$j] = $monthName."-".$date_data[0];
                                  }
                                }
                                elseif($_POST["dirname"] == "company_current_stock"){
                                    if(($j == 5 || $j == 6 || $j == 7) && ($row_data[$j] != "")){
                                        $date_data = explode("-",$row_data[$j]);
                                        
                                        $monthName = date("M", mktime(0, 0, 0, $date_data[1], 10));
                                        $row_data[$j] = $date_data[2]."-".$monthName."-".$date_data[0];
                                    }
                                }
                                elseif($_POST["dirname"] == "credit_limit"){
                                    if($j == 4 && ($row_data[$j] != "")){
                                        $date_data = explode("-",$row_data[$j]);
                                        
                                        $monthName = date("M", mktime(0, 0, 0, $date_data[1], 10));
                                        $row_data[$j] = $date_data[2]."-".$monthName."-".$date_data[0];
                                    }
                                }
                                elseif($_POST["dirname"] == "primary_sales"){
                                        if($j == 3 && ($row_data[$j] != "")){
                                                $date_data = explode("-",$row_data[$j]);
                                            
                                                $monthName = date("M", mktime(0, 0, 0, $date_data[1], 10));
                                                $row_data[$j] = $date_data[2]."-".$monthName."-".$date_data[0];
                                        }
                                }
                                elseif($_POST["dirname"] == "secondary_sales"){
									
								if($user_role_id == 8){
									
								   if($j == 5 && ($row_data[$j] != "")){
								   	
										//echo "zzzz".$j;die;
									
											$date_data = explode("-",$row_data[$j]);
                                            
                                            $monthName = date("M", mktime(0, 0, 0, $date_data[1], 10));
                                            $row_data[$j] = $date_data[2]."-".$monthName."-".$date_data[0];
								    }
								}
								else
                                {
									if($j == 3 && ($row_data[$j] != "")){
										
										//echo "cccc".$j;die;
										
										$date_data = explode("-",$row_data[$j]);
                                        
                                        $monthName = date("M", mktime(0, 0, 0, $date_data[1], 10));
                                        $row_data[$j] = $date_data[2]."-".$monthName."-".$date_data[0];
									}
								}
                               }
								elseif($_POST["dirname"] == "physical_stock"){
									if($j == 0 && ($row_data[$j] != "")){
										$date_data = explode("-",$row_data[$j]);
                                        
                                        $monthName = date("M", mktime(0, 0, 0, $date_data[1], 10));
                                        $row_data[$j] = $monthName."-".$date_data[0];
									}
								}
                                $this->excel->getActiveSheet()->setCellValue($key2.$m, $row_data[$j]);
                                $j++;
                            }
                        }
                         $m++;
                    }
                $filename='Data_'.strtotime(date('d-m-y h:i:s')).'.xlsx';
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
                //force user to download the Excel file without writing it to server's HD
                
                /*
                 * NEED TO CHANGE AS PER UPLOADED FILE 
                 */

               /*  if($_SERVER['SERVER_NAME'] == "localhost"){
                       $folder = "open_re/trunk";
                   }
                   elseif($_SERVER['SERVER_NAME'] == "webcluesglobal.com"){
                       $folder = "qa/re";
                   }*/


                //if(file_exists($_SERVER['DOCUMENT_ROOT']."/".$folder."/public/assets/uploads/Uploads/".$_POST["dirname"]."/".$filename)){
                if(file_exists(FCPATH."assets/uploads/Uploads/".$_POST["dirname"]."/".$filename)){

                    unlink(FCPATH."assets/uploads/Uploads/".$_POST["dirname"]."/".$filename);
                    
                }
                
                $objWriter->save(FCPATH."assets/uploads/Uploads/".$_POST["dirname"]."/".$filename);

                $web_service = @$_POST['flag'];
                if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {

                    $result['status'] = true;
                    $result['message'] = 'Retrieved Successfully.';
                    $result['data'] = base_url()."assets/uploads/Uploads/".$_POST["dirname"]."/".$filename;
                    echo json_encode($result);
                }
                else
                {
                    echo $filename;
                }
                
                //$objWriter->save('php://output');
                exit();
            }
            
        }
        
        public function add_xl_data() {

            $user= $this->auth->user();
            
            $user_id = $user->id;
            $country_id = $user->country_id;
            
            
            if($_POST["dirname"] == "target"){
                $target_data = $this->ishop_model->add_target_data($_POST["val"],$user_id,'web_service',$country_id);
            }
            elseif($_POST["dirname"] == "budget"){
                $budget_data = $this->ishop_model->add_budget_data($_POST["val"]);
            }
            elseif($_POST["dirname"] == "company_current_stock"){
                
                $current_stock_data = $this->ishop_model->add_company_current_stock_detail($user_id,$country_id,$_POST["val"],'excel');
            }
            elseif($_POST["dirname"] == "credit_limit"){
                
                $credit_limit_data = $this->ishop_model->add_user_credit_limit_datail($user_id,$country_id,$_POST["val"],'excel');
            }
            elseif($_POST["dirname"] == "rol"){
                
                $credit_limit_data = $this->ishop_model->add_rol_detail($user_id,$country_id,$_POST["val"],'excel');
            }
			elseif($_POST["dirname"] == "primary_sales"){

				$primary_sales = $this->ishop_model->add_primary_sales_details($user_id,$country_id,$web_service = null,$_POST["val"],'excel');
			}
			elseif($_POST["dirname"] == "secondary_sales"){
				if($user->role_id ==8)
				{
					$primary_sales = $this->ishop_model->add_ishop_sales_detail($user_id,$country_id,$_POST["val"],'excel');
				}
				else{
					$primary_sales = $this->ishop_model->add_secondary_sales_details_data($user_id,$country_id,$_POST["val"],'excel');
				}

			}
			elseif($_POST["dirname"] == "physical_stock"){

				$primary_sales = $this->ishop_model->add_physical_stock_detail($user_id,$country_id,$user->role_id,$_POST["val"],'excel');
			}
            
            
        }
        
        
        public function copy_data(){
            $user= $this->auth->user();
             $copy_data = $this->ishop_model->copy_data($_POST,$user->id);
            echo $copy_data;
           
            die;
        }




		/*-----------------------Report Download--------------------------------------*/

	public function primary_sales_details_csv_report()
	{
		$this->load->library('excel');
		$user = $this->auth->user();

		$form_date = (isset($_GET['form_date']) ? $_GET['form_date'] : '');
		$to_date = (isset($_GET['to_date']) ? $_GET['to_date'] : '');
		$by_distributor = (isset($_GET['by_distributor']) ? $_GET['by_distributor'] : '');
		$by_invoice_no = (isset($_GET['by_invoice_no']) ? $_GET['by_invoice_no'] : '');

		$page = (isset($_GET['page']) ? $_GET['page'] : '');

		$primary_sales_details = $this->ishop_model->get_primary_details_view_for_report($form_date, $to_date, $by_distributor, $by_invoice_no,null,$page,$user->local_date);

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Primary Sales');

		if(!empty($primary_sales_details) && isset($primary_sales_details))
		{
			$this->excel->getActiveSheet()->setCellValue('A1',$primary_sales_details['head'][0]);
			$this->excel->getActiveSheet()->setCellValue('B1',$primary_sales_details['head'][1]);
			$this->excel->getActiveSheet()->setCellValue('C1',$primary_sales_details['head'][2]);
			$this->excel->getActiveSheet()->setCellValue('D1',$primary_sales_details['head'][3]);
			$this->excel->getActiveSheet()->setCellValue('E1',$primary_sales_details['head'][4]);
			$this->excel->getActiveSheet()->setCellValue('F1',$primary_sales_details['head'][5]);
			$this->excel->getActiveSheet()->setCellValue('G1',$primary_sales_details['head'][6]);
			$this->excel->getActiveSheet()->setCellValue('H1',$primary_sales_details['head'][7]);
			$this->excel->getActiveSheet()->setCellValue('I1',$primary_sales_details['head'][8]);
			$this->excel->getActiveSheet()->setCellValue('J1',$primary_sales_details['head'][9]);
			$this->excel->getActiveSheet()->setCellValue('K1',$primary_sales_details['head'][10]);
		}

		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(12);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);

		foreach(range('A1','K1') as $columnID) {
			$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		if(!empty($primary_sales_details))
		{
			foreach($primary_sales_details['row'] as $k=>$row)
			{
				$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
				$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
				$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
				$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
				$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
				$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
				$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
				$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
				$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
				$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
				$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
			}
		}

		$filename='primary_sales_'.date('d-m-y').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();

	}


	public function rol_details_csv_report()
	{

		$this->load->library('excel');

		//$user = $this->auth->user();

		$checked_type = (isset($_GET['checked_type']) ? $_GET['checked_type'] : '');
		$role_id = (isset($_GET['login_customer_role']) ? $_GET['login_customer_role'] : '');
		$user_id = (isset($_GET['login_customer_id']) ? $_GET['login_customer_id'] : '');
		$country_id = (isset($_GET['login_customer_countryid']) ? $_GET['login_customer_countryid'] : '');

		$page = (isset($_GET['page']) ? $_GET['page'] : '');

		$rol= $this->ishop_model->get_all_rol_view_for_report($user_id,$country_id ,$role_id,$checked_type,$page);


		$this->excel->setActiveSheetIndex(0);

		if($role_id == '9' || $role_id == '10')
		{
			if($role_id == '9')
			{
				$this->excel->getActiveSheet()->setTitle('Distributor ROL');
			}
			else{
				$this->excel->getActiveSheet()->setTitle('Retailer ROL');
			}


			if(!empty($rol) && isset($rol))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$rol['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$rol['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$rol['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$rol['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$rol['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$rol['head'][5]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);

			foreach(range('A1','F1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($rol))
			{
				foreach($rol['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
				}
			}

			$filename='rol_'.date('d-m-y').'.xlsx';
		}
		else{

			if($checked_type == 'distributor')
			{
				$this->excel->getActiveSheet()->setTitle('Distributor ROL');
			}
			else{
				$this->excel->getActiveSheet()->setTitle('Retailer ROL');
			}

			if(!empty($rol) && isset($rol))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$rol['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$rol['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$rol['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$rol['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$rol['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$rol['head'][5]);
				$this->excel->getActiveSheet()->setCellValue('G1',$rol['head'][6]);
				$this->excel->getActiveSheet()->setCellValue('H1',$rol['head'][7]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);

			foreach(range('A1','H1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($rol))
			{
				foreach($rol['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
					$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
					$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
				}
			}


			$filename='rol_'.date('d-m-y').'.xlsx';
		}


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();

	}



	public function current_stock_details_csv_report()
	{
		$this->load->library('excel');
		$user = $this->auth->user();

		$page = (isset($_GET['page']) ? $_GET['page'] : '');

		$current_stock= $this->ishop_model->company_current_stock_for_report($user->country_id,$page,$user->local_date);

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Company Current Stock');

		if(!empty($current_stock) && isset($current_stock))
		{
			$this->excel->getActiveSheet()->setCellValue('A1',$current_stock['head'][0]);
			$this->excel->getActiveSheet()->setCellValue('B1',$current_stock['head'][1]);
			$this->excel->getActiveSheet()->setCellValue('C1',$current_stock['head'][2]);
			$this->excel->getActiveSheet()->setCellValue('D1',$current_stock['head'][3]);
			$this->excel->getActiveSheet()->setCellValue('E1',$current_stock['head'][4]);
			$this->excel->getActiveSheet()->setCellValue('F1',$current_stock['head'][5]);
			$this->excel->getActiveSheet()->setCellValue('G1',$current_stock['head'][6]);
			$this->excel->getActiveSheet()->setCellValue('H1',$current_stock['head'][7]);
		}

		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setSize(12);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);

		foreach(range('A1','H1') as $columnID) {
			$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		if(!empty($current_stock))
		{
			foreach($current_stock['row'] as $k=>$row)
			{
				$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
				$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
				$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
				$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
				$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
				$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
				$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
				$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
			}
		}

		$filename='company_current_stock_'.date('d-m-y').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();

	}



	public function secondary_sales_details_csv_report()
	{
		$this->load->library('excel');
		$user = $this->auth->user();

		$form_date = (isset($_GET['form_date']) ? $_GET['form_date'] : '');
		$to_date = (isset($_GET['to_date']) ? $_GET['to_date'] : '');
		$by_retailer = (isset($_GET['by_retailer']) ? $_GET['by_retailer'] : '');
		$by_invoice_no = (isset($_GET['by_invoice_no']) ? $_GET['by_invoice_no'] : '');

		$page = (isset($_GET['page']) ? $_GET['page'] : '');

		$secondary_sales_details = $this->ishop_model->get_secondary_details_view_for_report($form_date, $to_date, $by_retailer, $by_invoice_no,$user->id,$user->country_id,$sales_view=null,null,null,null,null,$page,null,$user->local_date);

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Secondary Sales');

		if(!empty($secondary_sales_details) && isset($secondary_sales_details))
		{
			$this->excel->getActiveSheet()->setCellValue('A1',$secondary_sales_details['head'][0]);
			$this->excel->getActiveSheet()->setCellValue('B1',$secondary_sales_details['head'][1]);
			$this->excel->getActiveSheet()->setCellValue('C1',$secondary_sales_details['head'][2]);
			$this->excel->getActiveSheet()->setCellValue('D1',$secondary_sales_details['head'][3]);
			$this->excel->getActiveSheet()->setCellValue('E1',$secondary_sales_details['head'][4]);
			$this->excel->getActiveSheet()->setCellValue('F1',$secondary_sales_details['head'][5]);
			$this->excel->getActiveSheet()->setCellValue('G1',$secondary_sales_details['head'][6]);
			$this->excel->getActiveSheet()->setCellValue('H1',$secondary_sales_details['head'][7]);
			$this->excel->getActiveSheet()->setCellValue('I1',$secondary_sales_details['head'][8]);
			$this->excel->getActiveSheet()->setCellValue('J1',$secondary_sales_details['head'][9]);
			$this->excel->getActiveSheet()->setCellValue('K1',$secondary_sales_details['head'][10]);
			$this->excel->getActiveSheet()->setCellValue('L1',$secondary_sales_details['head'][11]);
			$this->excel->getActiveSheet()->setCellValue('M1',$secondary_sales_details['head'][12]);
			$this->excel->getActiveSheet()->setCellValue('N1',$secondary_sales_details['head'][13]);
			$this->excel->getActiveSheet()->setCellValue('O1',$secondary_sales_details['head'][14]);
			$this->excel->getActiveSheet()->setCellValue('P1',$secondary_sales_details['head'][15]);
		}

		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1:P1')->getFont()->setSize(12);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1:P1')->getFont()->setBold(true);

		foreach(range('A1','P1') as $columnID) {
			$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		if(!empty($secondary_sales_details))
		{
			foreach($secondary_sales_details['row'] as $k=>$row)
			{
				$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
				$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
				$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
				$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
				$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
				$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
				$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
				$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
				$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
				$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
				$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
				$this->excel->getActiveSheet()->setCellValue('L'.($k+2), $row['11']);
				$this->excel->getActiveSheet()->setCellValue('M'.($k+2), $row['12']);
				$this->excel->getActiveSheet()->setCellValue('N'.($k+2), $row['13']);
				$this->excel->getActiveSheet()->setCellValue('O'.($k+2), $row['14']);
				$this->excel->getActiveSheet()->setCellValue('P'.($k+2), $row['15']);
			}
		}

		$filename='secondary_sales_'.date('d-m-y').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();
	}



	public function physical_stock_details_csv_report()
	{
		$this->load->library('excel');

		$user = $this->auth->user();

		$logined_user_role = $user->role_id;

		if($logined_user_role== 8){
			$checked_type = (isset($_GET['checked_type']) && !empty($_GET['checked_type']) ) ? $_GET['checked_type'] :'retailer';
		}
		else{
			$checked_type=null;
		}
		//$checked_type= $_POST['checked_type'];
		$page = (isset($_GET['page']) ? $_GET['page'] : '');

		$stock_month = (isset($_GET['stock_month']) ? $_GET['stock_month'] : '');

		$physical_stock= $this->ishop_model->physical_stock_by_for_report($user->id,$user->country_id,$logined_user_role,$checked_type,$page,null,$stock_month,$user->local_date);


		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Physical Stock');

		if ($logined_user_role == 10 || ($logined_user_role == 8 && $checked_type == 'retailer'))
		{
			if(!empty($physical_stock) && isset($physical_stock))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$physical_stock['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$physical_stock['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$physical_stock['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$physical_stock['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$physical_stock['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$physical_stock['head'][5]);
				$this->excel->getActiveSheet()->setCellValue('G1',$physical_stock['head'][6]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);

			foreach(range('A1','G1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($physical_stock))
			{
				foreach($physical_stock['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
					$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
				}
			}

		}
		elseif ($logined_user_role == 9 || ($logined_user_role == 8 && $checked_type == 'distributor'))
		{
			if(!empty($physical_stock) && isset($physical_stock))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$physical_stock['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$physical_stock['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$physical_stock['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$physical_stock['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$physical_stock['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$physical_stock['head'][5]);
				$this->excel->getActiveSheet()->setCellValue('G1',$physical_stock['head'][6]);
				$this->excel->getActiveSheet()->setCellValue('H1',$physical_stock['head'][7]);
				$this->excel->getActiveSheet()->setCellValue('I1',$physical_stock['head'][8]);

			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);

			foreach(range('A1','I1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($physical_stock))
			{
				foreach($physical_stock['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
					$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
					$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
					$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
				}
			}

		}

		$filename='physical_stock_'.date('d-m-y').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();

	}



	public function invoice_confirm_details_csv_report()
	{
		$this->load->library('excel');
		$user = $this->auth->user();

		$invoice_month = (isset($_GET['invoice_month']) ? $_GET['invoice_month'] : '');
		$po_no = (isset($_GET['po_no']) ? $_GET['po_no'] : '');
		$invoice_no = (isset($_GET['invoice_no']) ? $_GET['invoice_no'] : '');


		$page = (isset($_GET['page']) ? $_GET['page'] : '');

		$invoice_received = $this->ishop_model->invoice_confirm_for_report($invoice_month,$po_no,$invoice_no,$user->id,$user->country_id,$page);

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Invoice Received Confirmation');

		if(!empty($invoice_received) && isset($invoice_received))
		{
			$this->excel->getActiveSheet()->setCellValue('A1',$invoice_received['head'][0]);
			$this->excel->getActiveSheet()->setCellValue('B1',$invoice_received['head'][1]);
			$this->excel->getActiveSheet()->setCellValue('C1',$invoice_received['head'][2]);
			$this->excel->getActiveSheet()->setCellValue('D1',$invoice_received['head'][3]);
			$this->excel->getActiveSheet()->setCellValue('E1',$invoice_received['head'][4]);
			$this->excel->getActiveSheet()->setCellValue('F1',$invoice_received['head'][5]);
		}

		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setSize(12);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);

		foreach(range('A1','F1') as $columnID) {
			$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		if(!empty($invoice_received))
		{
			foreach($invoice_received['row'] as $k=>$row)
			{
				$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
				$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
				$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
				$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
				$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
				$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
			}
		}

		$filename='invoice_received_confirmation_'.date('d-m-y').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();

	}


	public function sales_view_details_csv_report()
	{
		$this->load->library('excel');
		$user = $this->auth->user();

		$check_redio = (isset($_GET['radio1']) ? $_GET['radio1'] : '');
		$page = (isset($_GET['page']) ? $_GET['page'] : '');

		if($check_redio == 'retailer')
		{
			$from_month = (isset($_GET['from_month']) ? $_GET['from_month'] : '');
			$to_month = (isset($_GET['to_month']) ? $_GET['to_month'] : '');
			$geo_level_0 = (isset($_GET['geo_level_0']) ? $_GET['geo_level_0'] : '');
			$geo_level_1 = (isset($_GET['geo_level_1']) ? $_GET['geo_level_1'] : '');
			$retailer_id = (isset($_GET['fo_retailer_id']) ? $_GET['fo_retailer_id'] : '');

			$tertiary = $this->ishop_model-> view_sales_detail_by_retailer_report($user->id,$user->country_id,$from_month,$to_month,$geo_level_0,$geo_level_1,$retailer_id,$page,null,$user->local_date);

			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Tertiary Sales');

			if(!empty($tertiary) && isset($tertiary))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$tertiary['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$tertiary['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$tertiary['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$tertiary['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$tertiary['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$tertiary['head'][5]);
				$this->excel->getActiveSheet()->setCellValue('G1',$tertiary['head'][6]);
				$this->excel->getActiveSheet()->setCellValue('H1',$tertiary['head'][7]);
				$this->excel->getActiveSheet()->setCellValue('I1',$tertiary['head'][8]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);

			foreach(range('A1','I1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($tertiary))
			{
				foreach($tertiary['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
					$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
					$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
					$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
				}
			}

			$filename='tertiary_sales_'.date('d-m-y').'.xlsx';

		}
		elseif($check_redio == 'distributor')
		{
			$from_month = (isset($_GET['from_month']) ? $_GET['from_month'] : '');
			$to_month = (isset($_GET['to_month']) ? $_GET['to_month'] : '');
			$geo_level = (isset($_GET['distributor_geo_level']) ? $_GET['distributor_geo_level'] : '');
			$distributor_id = (isset($_GET['distributor_sales']) ? $_GET['distributor_sales'] : '');
			$invoice_no = (isset($_GET['invoice_no']) ? $_GET['invoice_no'] : '');
			$secondary = $this->ishop_model->get_secondary_details_view_for_report($form_date=null,$to_date=null,$by_retailer=null,$invoice_no,$user->id,$user->country_id,'sales_view',$from_month,$to_month,$geo_level,$distributor_id,$page,null,$user->local_date);

			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Secondary Sales');

			if(!empty($secondary) && isset($secondary))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$secondary['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$secondary['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$secondary['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$secondary['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$secondary['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$secondary['head'][5]);
				$this->excel->getActiveSheet()->setCellValue('G1',$secondary['head'][6]);
				$this->excel->getActiveSheet()->setCellValue('H1',$secondary['head'][7]);
				$this->excel->getActiveSheet()->setCellValue('I1',$secondary['head'][8]);
				$this->excel->getActiveSheet()->setCellValue('J1',$secondary['head'][9]);
				$this->excel->getActiveSheet()->setCellValue('K1',$secondary['head'][10]);
				$this->excel->getActiveSheet()->setCellValue('L1',$secondary['head'][11]);
				$this->excel->getActiveSheet()->setCellValue('M1',$secondary['head'][12]);
				$this->excel->getActiveSheet()->setCellValue('N1',$secondary['head'][13]);
				$this->excel->getActiveSheet()->setCellValue('O1',$secondary['head'][14]);
				$this->excel->getActiveSheet()->setCellValue('P1',$secondary['head'][15]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:P1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:P1')->getFont()->setBold(true);

			foreach(range('A1','P1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($secondary))
			{
				foreach($secondary['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
					$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
					$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
					$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
					$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
					$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
					$this->excel->getActiveSheet()->setCellValue('L'.($k+2), $row['11']);
					$this->excel->getActiveSheet()->setCellValue('M'.($k+2), $row['12']);
					$this->excel->getActiveSheet()->setCellValue('N'.($k+2), $row['13']);
					$this->excel->getActiveSheet()->setCellValue('O'.($k+2), $row['14']);
					$this->excel->getActiveSheet()->setCellValue('P'.($k+2), $row['15']);
				}
			}

			$filename='secondary_sales_'.date('d-m-y').'.xlsx';

		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();

	}


	public function schemes_view_details_csv_report()
	{

		$this->load->library('excel');
		$user = $this->auth->user();

		$year = (isset($_GET['year']) ? $_GET['year'] : '');
		$region = (isset($_GET['region']) ? $_GET['region'] : '');
		$territory = (isset($_GET['territory']) ? $_GET['territory'] : '');
		$retailer= (isset($_GET['fo_retailer_id']) ? $_GET['fo_retailer_id'] : '');

		$page = (isset($_GET['page']) ? $_GET['page'] : '');

		$scheme_view=$this->ishop_model->view_schemes_detail_report($user->id,$user->country_id,$year,$region,$territory,$user->role_id,$retailer,$page);

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Schemes');

		if($user->role_id == 7)
		{
			if(!empty($scheme_view) && isset($scheme_view))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$scheme_view['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$scheme_view['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$scheme_view['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$scheme_view['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$scheme_view['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$scheme_view['head'][5]);
				$this->excel->getActiveSheet()->setCellValue('G1',$scheme_view['head'][6]);
				$this->excel->getActiveSheet()->setCellValue('H1',$scheme_view['head'][7]);
				$this->excel->getActiveSheet()->setCellValue('I1',$scheme_view['head'][8]);
				$this->excel->getActiveSheet()->setCellValue('J1',$scheme_view['head'][9]);
				$this->excel->getActiveSheet()->setCellValue('K1',$scheme_view['head'][10]);
				$this->excel->getActiveSheet()->setCellValue('L1',$scheme_view['head'][11]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);

			foreach(range('A1','L1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($scheme_view))
			{
				foreach($scheme_view['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
					$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
					$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
					$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
					$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
					$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
					$this->excel->getActiveSheet()->setCellValue('L'.($k+2), $row['11']);
				}
			}
		}
		if($user->role_id == 8)
		{
			if(!empty($scheme_view) && isset($scheme_view))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$scheme_view['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$scheme_view['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$scheme_view['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$scheme_view['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$scheme_view['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$scheme_view['head'][5]);
				$this->excel->getActiveSheet()->setCellValue('G1',$scheme_view['head'][6]);
				$this->excel->getActiveSheet()->setCellValue('H1',$scheme_view['head'][7]);
				$this->excel->getActiveSheet()->setCellValue('I1',$scheme_view['head'][8]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);

			foreach(range('A1','I1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($scheme_view))
			{
				foreach($scheme_view['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
					$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
					$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
					$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
				}
			}
		}
		if($user->role_id == 10)
		{
			if(!empty($scheme_view) && isset($scheme_view))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$scheme_view['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$scheme_view['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$scheme_view['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$scheme_view['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$scheme_view['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$scheme_view['head'][5]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);

			foreach(range('A1','F1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($scheme_view))
			{
				foreach($scheme_view['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
				}
			}
		}



		$filename='schemes_'.date('d-m-y').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();


	}

	public function target_details_csv_report()
	{

		$this->load->library('excel');
		$user = $this->auth->user();

		if($user->role_id == 7){
			$checked_type = (isset($_GET['radio1']) && !empty($_GET['radio1']) ) ? $_GET['radio1'] :'retailer';
		}
		else{
			$checked_type=null;
		}

		$page = (isset($_GET['page']) ? $_GET['page'] : '');

		$target_data= $this->ishop_model->target_details_report($user->id,$user->country_id,$checked_type,$page);

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Target');

		if(!empty($target_data) && isset($target_data))
		{
			$this->excel->getActiveSheet()->setCellValue('A1',$target_data['head'][0]);
			$this->excel->getActiveSheet()->setCellValue('B1',$target_data['head'][1]);
			$this->excel->getActiveSheet()->setCellValue('C1',$target_data['head'][2]);
			$this->excel->getActiveSheet()->setCellValue('D1',$target_data['head'][3]);
			$this->excel->getActiveSheet()->setCellValue('E1',$target_data['head'][4]);
			$this->excel->getActiveSheet()->setCellValue('F1',$target_data['head'][5]);
			$this->excel->getActiveSheet()->setCellValue('G1',$target_data['head'][6]);
		}

		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setSize(12);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);

		foreach(range('A1','G1') as $columnID) {
			$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		if(!empty($invoice_received))
		{
			foreach($invoice_received['row'] as $k=>$row)
			{
				$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
				$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
				$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
				$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
				$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
				$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
				$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
			}
		}

		$filename='target_'.date('d-m-y').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();
	}



	public function prespective_order_details_csv_report()
	{

		$this->load->library('excel');

		$user = $this->auth->user();

		$from_date = (isset($_GET['form_date']) ? $_GET['form_date'] : '');
		$todate = (isset($_GET['to_date']) ? $_GET['to_date'] : '');

		$page = (isset($_GET['page']) ? $_GET['page'] : '');

		$prespective_order = $this->ishop_model->prespective_order_details_report($from_date,$todate,$user->role_id,$user->id,$page,null,$user->local_date);


		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Prespective Order');

		if(!empty($prespective_order) && isset($prespective_order))
		{
			$this->excel->getActiveSheet()->setCellValue('A1',$prespective_order['head'][0]);
			$this->excel->getActiveSheet()->setCellValue('B1',$prespective_order['head'][1]);
			$this->excel->getActiveSheet()->setCellValue('C1',$prespective_order['head'][2]);
			$this->excel->getActiveSheet()->setCellValue('D1',$prespective_order['head'][3]);
			$this->excel->getActiveSheet()->setCellValue('E1',$prespective_order['head'][4]);
			$this->excel->getActiveSheet()->setCellValue('F1',$prespective_order['head'][5]);
			$this->excel->getActiveSheet()->setCellValue('G1',$prespective_order['head'][6]);
			$this->excel->getActiveSheet()->setCellValue('H1',$prespective_order['head'][7]);
			$this->excel->getActiveSheet()->setCellValue('I1',$prespective_order['head'][8]);
			$this->excel->getActiveSheet()->setCellValue('J1',$prespective_order['head'][9]);
			$this->excel->getActiveSheet()->setCellValue('K1',$prespective_order['head'][10]);
			$this->excel->getActiveSheet()->setCellValue('L1',$prespective_order['head'][11]);
			$this->excel->getActiveSheet()->setCellValue('M1',$prespective_order['head'][12]);
			$this->excel->getActiveSheet()->setCellValue('N1',$prespective_order['head'][13]);
		}

		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setSize(12);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);

		foreach(range('A1','N1') as $columnID) {
			$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		if(!empty($prespective_order))
		{
			foreach($prespective_order['row'] as $k=>$row)
			{
				$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
				$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
				$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
				$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
				$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
				$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
				$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
				$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
				$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
				$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
				$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
				$this->excel->getActiveSheet()->setCellValue('L'.($k+2), $row['11']);
				$this->excel->getActiveSheet()->setCellValue('M'.($k+2), $row['12']);
				$this->excel->getActiveSheet()->setCellValue('N'.($k+2), $row['13']);
			}
		}

		$filename='prespective_order_'.date('d-m-y').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();

	}


	public function order_details_csv_report()
	{
		$this->load->library('excel');
		//testdata($_GET);
		$user = $this->auth->user();

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Order Status');

		if($user->role_id == 7) {
			$radio_checked = (isset($_GET['radio1']) && !empty($_GET['radio1'])) ? $_GET['radio1'] : 'distributor';

			if ($radio_checked == 'distributor')
			{
				$customer_id = (isset($_GET['distributor_id']) ? $_GET['distributor_id'] : '');
			}
			else{
				$customer_id = (isset($_GET['retailer_id']) ? $_GET['retailer_id'] : '');
			}

			$from_date = (isset($_GET['form_date']) ? $_GET['form_date'] : '');
			$todate = (isset($_GET['to_date']) ? $_GET['to_date'] : '');

			$page_function = (isset($_GET['page_function']) ? $_GET['page_function'] : '');

			$page = (isset($_GET['page']) ? $_GET['page'] : '');

			$order_data = $this->ishop_model->order_details_report($user->role_id,$user->country_id,$radio_checked,$user->id,$customer_id,$from_date,$todate,null,null,$page,$page_function,null,null,$user->local_date);


			if($radio_checked == 'distributor')
			{
				if(!empty($order_data) && isset($order_data))
				{
					$this->excel->getActiveSheet()->setCellValue('A1',$order_data['head'][0]);
					$this->excel->getActiveSheet()->setCellValue('B1',$order_data['head'][1]);
					$this->excel->getActiveSheet()->setCellValue('C1',$order_data['head'][2]);
					$this->excel->getActiveSheet()->setCellValue('D1',$order_data['head'][3]);
					$this->excel->getActiveSheet()->setCellValue('E1',$order_data['head'][4]);
					$this->excel->getActiveSheet()->setCellValue('F1',$order_data['head'][5]);
					$this->excel->getActiveSheet()->setCellValue('G1',$order_data['head'][6]);
					$this->excel->getActiveSheet()->setCellValue('H1',$order_data['head'][7]);
					$this->excel->getActiveSheet()->setCellValue('I1',$order_data['head'][8]);
					$this->excel->getActiveSheet()->setCellValue('J1',$order_data['head'][9]);
					$this->excel->getActiveSheet()->setCellValue('K1',$order_data['head'][10]);
					$this->excel->getActiveSheet()->setCellValue('L1',$order_data['head'][11]);
					$this->excel->getActiveSheet()->setCellValue('M1',$order_data['head'][12]);
					$this->excel->getActiveSheet()->setCellValue('N1',$order_data['head'][13]);
				}

				//change the font size
				$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setSize(12);
				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);

				foreach(range('A1','N1') as $columnID) {
					$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
				}

				if(!empty($order_data))
				{
					foreach($order_data['row'] as $k=>$row)
					{
						$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
						$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
						$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
						$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
						$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
						$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
						$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
						$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
						$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
						$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
						$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
						$this->excel->getActiveSheet()->setCellValue('L'.($k+2), $row['11']);
						$this->excel->getActiveSheet()->setCellValue('M'.($k+2), $row['12']);
						$this->excel->getActiveSheet()->setCellValue('N'.($k+2), $row['13']);
					}
				}

			}
			else{
				if(!empty($order_data) && isset($order_data))
				{
					$this->excel->getActiveSheet()->setCellValue('A1',$order_data['head'][0]);
					$this->excel->getActiveSheet()->setCellValue('B1',$order_data['head'][1]);
					$this->excel->getActiveSheet()->setCellValue('C1',$order_data['head'][2]);
					$this->excel->getActiveSheet()->setCellValue('D1',$order_data['head'][3]);
					$this->excel->getActiveSheet()->setCellValue('E1',$order_data['head'][4]);
					$this->excel->getActiveSheet()->setCellValue('F1',$order_data['head'][5]);
					$this->excel->getActiveSheet()->setCellValue('G1',$order_data['head'][6]);
					$this->excel->getActiveSheet()->setCellValue('H1',$order_data['head'][7]);
					$this->excel->getActiveSheet()->setCellValue('I1',$order_data['head'][8]);
					$this->excel->getActiveSheet()->setCellValue('J1',$order_data['head'][9]);
					$this->excel->getActiveSheet()->setCellValue('K1',$order_data['head'][10]);
					$this->excel->getActiveSheet()->setCellValue('L1',$order_data['head'][11]);
					$this->excel->getActiveSheet()->setCellValue('M1',$order_data['head'][12]);
					$this->excel->getActiveSheet()->setCellValue('N1',$order_data['head'][13]);
				}

				//change the font size
				$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setSize(12);
				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);

				foreach(range('A1','N1') as $columnID) {
					$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
				}

				if(!empty($order_data))
				{
					foreach($order_data['row'] as $k=>$row)
					{
						$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
						$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
						$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
						$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
						$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
						$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
						$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
						$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
						$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
						$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
						$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
						$this->excel->getActiveSheet()->setCellValue('L'.($k+2), $row['11']);
						$this->excel->getActiveSheet()->setCellValue('M'.($k+2), $row['12']);
						$this->excel->getActiveSheet()->setCellValue('N'.($k+2), $row['13']);
					}
				}
			}
		}
		if($user->role_id == 8)
		{
			$radio_checked = (isset($_GET['radio1']) && !empty($_GET['radio1'])) ? $_GET['radio1'] : 'farmer';

			if ($radio_checked == 'farmer')
			{
				$customer_id = (isset($_GET['farmer_data']) ? $_GET['farmer_data'] : '');
			}
			if($radio_checked == 'retailer')
			{
				$customer_id = (isset($_GET['retailer_data']) ? $_GET['retailer_data'] : '');
			}
			if($radio_checked == 'distributor')
			{
				$customer_id = (isset($_GET['distributor_data']) ? $_GET['distributor_data'] : '');
			}

			$order_tracking_no = (isset($_GET['order_tracking_no']) ? $_GET['order_tracking_no'] : null);
			$from_date = (isset($_GET['form_date']) ? $_GET['form_date'] : '');
			$todate = (isset($_GET['to_date']) ? $_GET['to_date'] : '');

			$page = (isset($_GET['page']) ? $_GET['page'] : '');

			$page_function = (isset($_GET['page_function']) ? $_GET['page_function'] : '');

			$order_data = $this->ishop_model->order_details_report($user->role_id,$user->country_id,$radio_checked,$user->id,$customer_id,$from_date,$todate,$order_tracking_no,null,$page,$page_function,null,null,$user->local_date);

			if($radio_checked == 'farmer')
			{
				if(!empty($order_data) && isset($order_data))
				{
					$this->excel->getActiveSheet()->setCellValue('A1',$order_data['head'][0]);
					$this->excel->getActiveSheet()->setCellValue('B1',$order_data['head'][1]);
					$this->excel->getActiveSheet()->setCellValue('C1',$order_data['head'][2]);
					$this->excel->getActiveSheet()->setCellValue('D1',$order_data['head'][3]);
					$this->excel->getActiveSheet()->setCellValue('E1',$order_data['head'][4]);
					$this->excel->getActiveSheet()->setCellValue('F1',$order_data['head'][5]);
					$this->excel->getActiveSheet()->setCellValue('G1',$order_data['head'][6]);
					$this->excel->getActiveSheet()->setCellValue('H1',$order_data['head'][7]);
					$this->excel->getActiveSheet()->setCellValue('I1',$order_data['head'][8]);
					$this->excel->getActiveSheet()->setCellValue('J1',$order_data['head'][9]);
					$this->excel->getActiveSheet()->setCellValue('K1',$order_data['head'][10]);
				}

				//change the font size
				$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(12);
				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);

				foreach(range('A1','N1') as $columnID) {
					$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
				}

				if(!empty($order_data))
				{
					foreach($order_data['row'] as $k=>$row)
					{
						$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
						$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
						$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
						$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
						$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
						$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
						$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
						$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
						$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
						$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
						$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
					}
				}

			}
			if($radio_checked == 'retailer')
			{
				if(!empty($order_data) && isset($order_data))
				{
					$this->excel->getActiveSheet()->setCellValue('A1',$order_data['head'][0]);
					$this->excel->getActiveSheet()->setCellValue('B1',$order_data['head'][1]);
					$this->excel->getActiveSheet()->setCellValue('C1',$order_data['head'][2]);
					$this->excel->getActiveSheet()->setCellValue('D1',$order_data['head'][3]);
					$this->excel->getActiveSheet()->setCellValue('E1',$order_data['head'][4]);
					$this->excel->getActiveSheet()->setCellValue('F1',$order_data['head'][5]);
					$this->excel->getActiveSheet()->setCellValue('G1',$order_data['head'][6]);
					$this->excel->getActiveSheet()->setCellValue('H1',$order_data['head'][7]);
					$this->excel->getActiveSheet()->setCellValue('I1',$order_data['head'][8]);
					$this->excel->getActiveSheet()->setCellValue('J1',$order_data['head'][9]);
					$this->excel->getActiveSheet()->setCellValue('K1',$order_data['head'][10]);
					$this->excel->getActiveSheet()->setCellValue('L1',$order_data['head'][11]);
					$this->excel->getActiveSheet()->setCellValue('M1',$order_data['head'][12]);
					$this->excel->getActiveSheet()->setCellValue('N1',$order_data['head'][13]);
					$this->excel->getActiveSheet()->setCellValue('O1',$order_data['head'][14]);
					$this->excel->getActiveSheet()->setCellValue('P1',$order_data['head'][15]);
					$this->excel->getActiveSheet()->setCellValue('Q1',$order_data['head'][16]);
				}

				//change the font size
				$this->excel->getActiveSheet()->getStyle('A1:Q1')->getFont()->setSize(12);
				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1:Q1')->getFont()->setBold(true);

				foreach(range('A1','Q1') as $columnID) {
					$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
				}

				if(!empty($order_data))
				{
					foreach($order_data['row'] as $k=>$row)
					{
						$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
						$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
						$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
						$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
						$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
						$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
						$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
						$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
						$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
						$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
						$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
						$this->excel->getActiveSheet()->setCellValue('L'.($k+2), $row['11']);
						$this->excel->getActiveSheet()->setCellValue('M'.($k+2), $row['12']);
						$this->excel->getActiveSheet()->setCellValue('N'.($k+2), $row['13']);
						$this->excel->getActiveSheet()->setCellValue('O'.($k+2), $row['14']);
						$this->excel->getActiveSheet()->setCellValue('P'.($k+2), $row['15']);
						$this->excel->getActiveSheet()->setCellValue('Q'.($k+2), $row['16']);
					}
				}
			}
			if($radio_checked == 'distributor')
			{
				if(!empty($order_data) && isset($order_data))
				{
					$this->excel->getActiveSheet()->setCellValue('A1',$order_data['head'][0]);
					$this->excel->getActiveSheet()->setCellValue('B1',$order_data['head'][1]);
					$this->excel->getActiveSheet()->setCellValue('C1',$order_data['head'][2]);
					$this->excel->getActiveSheet()->setCellValue('D1',$order_data['head'][3]);
					$this->excel->getActiveSheet()->setCellValue('E1',$order_data['head'][4]);
					$this->excel->getActiveSheet()->setCellValue('F1',$order_data['head'][5]);
					$this->excel->getActiveSheet()->setCellValue('G1',$order_data['head'][6]);
					$this->excel->getActiveSheet()->setCellValue('H1',$order_data['head'][7]);
					$this->excel->getActiveSheet()->setCellValue('I1',$order_data['head'][8]);
					$this->excel->getActiveSheet()->setCellValue('J1',$order_data['head'][9]);
					$this->excel->getActiveSheet()->setCellValue('K1',$order_data['head'][10]);
					$this->excel->getActiveSheet()->setCellValue('L1',$order_data['head'][11]);
					$this->excel->getActiveSheet()->setCellValue('M1',$order_data['head'][12]);
					$this->excel->getActiveSheet()->setCellValue('N1',$order_data['head'][13]);
					$this->excel->getActiveSheet()->setCellValue('O1',$order_data['head'][14]);
					$this->excel->getActiveSheet()->setCellValue('P1',$order_data['head'][15]);
				}

				//change the font size
				$this->excel->getActiveSheet()->getStyle('A1:P1')->getFont()->setSize(12);
				//make the font become bold
				$this->excel->getActiveSheet()->getStyle('A1:P1')->getFont()->setBold(true);

				foreach(range('A1','P1') as $columnID) {
					$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
				}

				if(!empty($order_data))
				{
					foreach($order_data['row'] as $k=>$row)
					{
						$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
						$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
						$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
						$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
						$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
						$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
						$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
						$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
						$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
						$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
						$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
						$this->excel->getActiveSheet()->setCellValue('L'.($k+2), $row['11']);
						$this->excel->getActiveSheet()->setCellValue('M'.($k+2), $row['12']);
						$this->excel->getActiveSheet()->setCellValue('N'.($k+2), $row['13']);
						$this->excel->getActiveSheet()->setCellValue('O'.($k+2), $row['14']);
						$this->excel->getActiveSheet()->setCellValue('P'.($k+2), $row['15']);
					}
				}
			}



		}
		if($user->role_id == 9)
		{
			$from_date = (isset($_GET['form_date']) ? $_GET['form_date'] : '');
			$todate = (isset($_GET['to_date']) ? $_GET['to_date'] : '');

			$page_function = (isset($_GET['page_function']) ? $_GET['page_function'] : '');

			$page = (isset($_GET['page']) ? $_GET['page'] : '');
			$customer_id=$user->id;

			$order_data = $this->ishop_model->order_details_report($user->role_id,$user->country_id,null,$user->id,$customer_id,$from_date,$todate,null,null,$page,$page_function,null,null,$user->local_date);

			if(!empty($order_data) && isset($order_data))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$order_data['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$order_data['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$order_data['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$order_data['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$order_data['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$order_data['head'][5]);
				$this->excel->getActiveSheet()->setCellValue('G1',$order_data['head'][6]);
				$this->excel->getActiveSheet()->setCellValue('H1',$order_data['head'][7]);
				$this->excel->getActiveSheet()->setCellValue('I1',$order_data['head'][8]);
				$this->excel->getActiveSheet()->setCellValue('J1',$order_data['head'][9]);
				$this->excel->getActiveSheet()->setCellValue('K1',$order_data['head'][10]);
				$this->excel->getActiveSheet()->setCellValue('L1',$order_data['head'][11]);
				$this->excel->getActiveSheet()->setCellValue('M1',$order_data['head'][12]);
				$this->excel->getActiveSheet()->setCellValue('N1',$order_data['head'][13]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);

			foreach(range('A1','N1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($order_data))
			{
				foreach($order_data['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
					$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
					$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
					$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
					$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
					$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
					$this->excel->getActiveSheet()->setCellValue('L'.($k+2), $row['11']);
					$this->excel->getActiveSheet()->setCellValue('M'.($k+2), $row['12']);
					$this->excel->getActiveSheet()->setCellValue('N'.($k+2), $row['13']);
				}
			}

		}
		if($user->role_id == 10)
		{
			$from_date = (isset($_GET['form_date']) ? $_GET['form_date'] : '');
			$todate = (isset($_GET['to_date']) ? $_GET['to_date'] : '');

			$page_function = (isset($_GET['page_function']) ? $_GET['page_function'] : '');

			$page = (isset($_GET['page']) ? $_GET['page'] : '');
			$customer_id=$user->id;

			$order_data = $this->ishop_model->order_details_report($user->role_id,$user->country_id,null,$user->id,$customer_id,$from_date,$todate,null,null,$page,$page_function,null,null,$user->local_date);

			if(!empty($order_data) && isset($order_data))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$order_data['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$order_data['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$order_data['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$order_data['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$order_data['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$order_data['head'][5]);
				$this->excel->getActiveSheet()->setCellValue('G1',$order_data['head'][6]);
				$this->excel->getActiveSheet()->setCellValue('H1',$order_data['head'][7]);
				$this->excel->getActiveSheet()->setCellValue('I1',$order_data['head'][8]);
				$this->excel->getActiveSheet()->setCellValue('J1',$order_data['head'][9]);
				$this->excel->getActiveSheet()->setCellValue('K1',$order_data['head'][10]);
				$this->excel->getActiveSheet()->setCellValue('L1',$order_data['head'][11]);
				$this->excel->getActiveSheet()->setCellValue('M1',$order_data['head'][12]);
				$this->excel->getActiveSheet()->setCellValue('N1',$order_data['head'][13]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);

			foreach(range('A1','N1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($order_data))
			{
				foreach($order_data['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
					$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
					$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
					$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
					$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
					$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
					$this->excel->getActiveSheet()->setCellValue('L'.($k+2), $row['11']);
					$this->excel->getActiveSheet()->setCellValue('M'.($k+2), $row['12']);
					$this->excel->getActiveSheet()->setCellValue('N'.($k+2), $row['13']);
				}
			}

		}

		$filename='order_status_'.date('d-m-y').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();

	}

	public function po_acknowledgement_details_csv_report()
	{
		$this->load->library('excel');
		$user = $this->auth->user();

		$page_function = (isset($_GET['page_function']) ? $_GET['page_function'] : '');
		$page = (isset($_GET['page']) ? $_GET['page'] : '');
		$customer_id=$user->id;

		$order_data = $this->ishop_model->order_details_report($user->role_id,$user->country_id,null,$user->id,$customer_id,$from_date=null,$todate=null,null,null,$page,$page_function,null,null,$user->local_date);


		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('PO Acknowledgement');

		if($user->role_id == 9)
		{
			if(!empty($order_data) && isset($order_data))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$order_data['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$order_data['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$order_data['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$order_data['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$order_data['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$order_data['head'][5]);
				$this->excel->getActiveSheet()->setCellValue('G1',$order_data['head'][6]);
				$this->excel->getActiveSheet()->setCellValue('H1',$order_data['head'][7]);
				$this->excel->getActiveSheet()->setCellValue('I1',$order_data['head'][8]);
				$this->excel->getActiveSheet()->setCellValue('J1',$order_data['head'][9]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:J1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);

			foreach(range('A1','J1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($order_data))
			{
				foreach($order_data['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
					$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
					$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
					$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
					$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
				}
			}
		}
		else{
			if(!empty($order_data) && isset($order_data))
			{
				$this->excel->getActiveSheet()->setCellValue('A1',$order_data['head'][0]);
				$this->excel->getActiveSheet()->setCellValue('B1',$order_data['head'][1]);
				$this->excel->getActiveSheet()->setCellValue('C1',$order_data['head'][2]);
				$this->excel->getActiveSheet()->setCellValue('D1',$order_data['head'][3]);
				$this->excel->getActiveSheet()->setCellValue('E1',$order_data['head'][4]);
				$this->excel->getActiveSheet()->setCellValue('F1',$order_data['head'][5]);
				$this->excel->getActiveSheet()->setCellValue('G1',$order_data['head'][6]);
				$this->excel->getActiveSheet()->setCellValue('H1',$order_data['head'][7]);
				$this->excel->getActiveSheet()->setCellValue('I1',$order_data['head'][8]);
				$this->excel->getActiveSheet()->setCellValue('J1',$order_data['head'][9]);
				$this->excel->getActiveSheet()->setCellValue('K1',$order_data['head'][10]);
			}

			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(12);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);

			foreach(range('A1','K1') as $columnID) {
				$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}

			if(!empty($order_data))
			{
				foreach($order_data['row'] as $k=>$row)
				{
					$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
					$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
					$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
					$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
					$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
					$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
					$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
					$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
					$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
					$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
					$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
				}
			}

		}



		$filename='po_acknowledgement_'.date('d-m-y').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();

	}

	public function order_approval_details_csv_report(){
		$this->load->library('excel');
		$user = $this->auth->user();


		$from_date = (isset($_GET['form_date']) ? $_GET['form_date'] : '');
		$todate = (isset($_GET['to_date']) ? $_GET['to_date'] : '');
		$by_otn = (isset($_GET['by_po_no']) ? $_GET['by_po_no'] : '');
		$by_po_no = (isset($_GET['by_otn']) ? $_GET['by_otn'] : '');

		$page_function = (isset($_GET['page_function']) ? $_GET['page_function'] : '');
		$page = (isset($_GET['page']) ? $_GET['page'] : '');
		$customer_id = $user->id;

		$order_data = $this->ishop_model->order_details_report($user->role_id,$user->country_id,null,$user->id,$customer_id,$from_date,$todate,$by_otn,$by_po_no,$page,$page_function,null,null,$user->local_date);

		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Order Approval');


		if(!empty($order_data) && isset($order_data))
		{
			$this->excel->getActiveSheet()->setCellValue('A1',$order_data['head'][0]);
			$this->excel->getActiveSheet()->setCellValue('B1',$order_data['head'][1]);
			$this->excel->getActiveSheet()->setCellValue('C1',$order_data['head'][2]);
			$this->excel->getActiveSheet()->setCellValue('D1',$order_data['head'][3]);
			$this->excel->getActiveSheet()->setCellValue('E1',$order_data['head'][4]);
			$this->excel->getActiveSheet()->setCellValue('F1',$order_data['head'][5]);
			$this->excel->getActiveSheet()->setCellValue('G1',$order_data['head'][6]);
			$this->excel->getActiveSheet()->setCellValue('H1',$order_data['head'][7]);
			$this->excel->getActiveSheet()->setCellValue('I1',$order_data['head'][8]);
			$this->excel->getActiveSheet()->setCellValue('J1',$order_data['head'][9]);
			$this->excel->getActiveSheet()->setCellValue('K1',$order_data['head'][10]);
			$this->excel->getActiveSheet()->setCellValue('L1',$order_data['head'][11]);
			$this->excel->getActiveSheet()->setCellValue('M1',$order_data['head'][12]);
			$this->excel->getActiveSheet()->setCellValue('N1',$order_data['head'][13]);
			$this->excel->getActiveSheet()->setCellValue('O1',$order_data['head'][14]);
		}

		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setSize(12);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);

		foreach(range('A1','O1') as $columnID) {
			$this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		if(!empty($order_data))
		{
			foreach($order_data['row'] as $k=>$row)
			{
				$this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
				$this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
				$this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
				$this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
				$this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
				$this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
				$this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
				$this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
				$this->excel->getActiveSheet()->setCellValue('I'.($k+2), $row['8']);
				$this->excel->getActiveSheet()->setCellValue('J'.($k+2), $row['9']);
				$this->excel->getActiveSheet()->setCellValue('K'.($k+2), $row['10']);
				$this->excel->getActiveSheet()->setCellValue('L'.($k+2), $row['11']);
				$this->excel->getActiveSheet()->setCellValue('M'.($k+2), $row['12']);
				$this->excel->getActiveSheet()->setCellValue('N'.($k+2), $row['13']);
				$this->excel->getActiveSheet()->setCellValue('O'.($k+2), $row['14']);
			}
		}


		$filename='order_approval_'.date('d-m-y').'.xlsx';
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		exit();
	}

	/*-----------------------Report Download--------------------------------------*/
        
        
}