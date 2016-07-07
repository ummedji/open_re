<?php defined('BASEPATH') || exit('No direct script access allowed');
class Ecp extends Front_Controller
{
	protected $permissionCreate = 'Ecp.Ecp.Create';
	protected $permissionDelete = 'Ecp.Ecp.Delete';
	protected $permissionEdit = 'Ecp.Ecp.Edit';
	protected $permissionView = 'Ecp.Ecp.View';

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
		$this->lang->load('ecp');

		$this->load->model('ecp_model');
		$this->load->model('ishop/ishop_model');

		$this->set_current_user();
		//Assets::add_module_js('ecp', 'ecp.js');
	}

	/**
	 * Display a list of ECP data.
	 *
	 * @return void
	 */
	public function index()
	{
		Template::set_view('ecp/index');
		Template::render();
	}
	public function material_request()
	{
		Assets::add_module_js('ecp', 'materials_request.js');

		$user = $this->auth->user();
		$materials = $this->ecp_model->get_materials_by_country_id($user->country_id);

		$page = (isset($_POST['page']) ? $_POST['page'] : '');
		//$materials_request = array();
		$materials_request =  $this->ecp_model->get_all_materials_by_country_id($user->country_id,$page,$user->local_date);
		Template::set('td', $materials_request['count']);
		Template::set('pagination', (isset($materials_request['pagination']) && !empty($materials_request['pagination'])) ? $materials_request['pagination'] : '' );
		Template::set('table', $materials_request);

		Template::set('materials', $materials);
		Template::set('current_user', $user);
		Template::set_view('ecp/material_request');
		Template::render();
	}

	public function add_material_request_details()
	{
		$user = $this->auth->user();
		$add = $this->ecp_model->add_material_request_detail($user->id,$user->country_id);
		echo $add;
		die;
	}

	public function update_material_request_details()
	{
		$user = $this->auth->user();
		$status = $_POST['received_status'];
		$mr_id = $_POST['mr_id'];
		$update = $this->ecp_model->update_material_request_detail($user->id,$mr_id,$status);
		echo $update;
		die;
	}

	public function all_material_request()
	{
		Assets::add_module_js('ecp', 'all_material_requests.js');

		$user = $this->auth->user();

		$employee =  $this->ecp_model->get_all_employee_by_country_id($user->country_id);
		Template::set('employee', $employee);
		Template::set('current_user', $user);
		Template::set_view('ecp/all_material_requests');
		Template::render();
	}

	public function all_materials_details_view()
	{
		$user = $this->auth->user();

		$from_date = (isset($_POST['from_date']) ? $_POST['from_date'] : '');
		$to_date = (isset($_POST['to_date']) ? $_POST['to_date'] : '');
		$status_id = (isset($_POST['status_id']) ? $_POST['status_id'] : '');
		$employee_id = (isset($_POST['employee_id']) ? $_POST['employee_id'] : '');

		$page = (isset($_POST['page']) ? $_POST['page'] : '');

		$materials_request_details = $this->ecp_model->get_all_materials_request_details_view($from_date, $to_date, $status_id, $employee_id,$page,$user->local_date,$user->country_id);

		Template::set('td', $materials_request_details['count']);
		Template::set('pagination', (isset($materials_request_details['pagination']) && !empty($materials_request_details['pagination'])) ? $materials_request_details['pagination'] : '' );
		Template::set('table', $materials_request_details);
		Template::set_view('ecp/all_material_requests');
		Template::render();
	}

	public function update_materials_details()
	{
		$user = $this->auth->user();
		$update = $this->ecp_model->update_materials_detail($user->id);
		echo $update;
		die;
	}

	public function delete_material_details()
	{
		$mr_id = (isset($_POST['mr_id']) ? $_POST['mr_id'] : '');
		$delete = $this->ecp_model->delete_material_detail($mr_id);
		echo $delete;
		die;
	}




	public function retailer_compititor_analysis()
	{
		Assets::add_module_js('ecp', 'retailer_compititor.js');

		$user = $this->auth->user();
		$radio_checked='10';

		$geo_level = $this->ecp_model->get_employee_geo_data($user->id, $user->country_id, $user->role_id, $parent_geo_id = null, $action_data = null,$radio_checked);

		$compititor = $this->ecp_model->get_all_copititor_data($user->country_id);

		Template::set('compititor', $compititor);
		Template::set('current_user', $user);
		Template::set('geo_level', $geo_level);
		Template::set_view('ecp/retailer_compititor');
		Template::render();
	}

	public function retailer_compititor_details()
	{
		$user = $this->auth->user();
		$insert=$this->ecp_model->add_retailer_compititor_details($user->id,$user->country_id);
		echo $insert;
		die;
	}

	public function retailer_compititor_product()
	{
		Assets::add_module_js('ecp', 'retailer_compititor_product.js');

		$user = $this->auth->user();
		$radio_checked='10';

		$geo_level = $this->ecp_model->get_employee_geo_data($user->id, $user->country_id, $user->role_id, $parent_geo_id = null, $action_data = null,$radio_checked);

		$compititor = $this->ecp_model->get_all_copititor_data($user->country_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);

		Template::set('product_sku', $product_sku);
		Template::set('compititor', $compititor);
		Template::set('current_user', $user);
		Template::set('geo_level', $geo_level);
		Template::set_view('ecp/retailer_compititor_product');
		Template::render();
	}

	public function retailer_compititor_product_details()
	{
		$user = $this->auth->user();
		$insert=$this->ecp_model->add_retailer_compititor_product_details($user->id,$user->country_id);
		echo $insert;
		die;
	}

	public function retailer_compititor_view()
	{
		Assets::add_module_js('ecp', 'retailer_compititor_view.js');
		Template::set_view('ecp/retailer_compititor_view');
		Template::render();
	}

	public function retailer_compititor_details_view()
	{
		//testdata($_POST);
		$user = $this->auth->user();

		$radio = (isset($_POST['radio']) ? $_POST['radio'] : '');
		$from_month = (isset($_POST['from_month']) ? $_POST['from_month'] : '');
		$to_month = (isset($_POST['to_month']) ? $_POST['to_month'] : '');

		$page = (isset($_POST['page']) ? $_POST['page'] : '');

		if($radio == 'total'){
			$retailer_compititor_details = $this->ecp_model->get_retailer_compititor_details_view($from_month, $to_month,$page,$user->local_date,$user->country_id);
		}
		elseif($radio == 'product'){
			$retailer_compititor_details = $this->ecp_model->get_retailer_compititor_product_details_view($from_month, $to_month,$page,$user->local_date,$user->country_id);
		}


		Template::set('td', $retailer_compititor_details['count']);
		Template::set('pagination', (isset($retailer_compititor_details['pagination']) && !empty($retailer_compititor_details['pagination'])) ? $retailer_compititor_details['pagination'] : '' );
		Template::set('table', $retailer_compititor_details);
		Template::set_view('ecp/retailer_compititor_view');
		Template::render();

	}


	public function distributor_compititor_analysis()
	{
		Assets::add_module_js('ecp', 'distributor_compititor.js');

		$user = $this->auth->user();
		$radio_checked='9';

		$geo_level = $this->ecp_model->get_employee_geo_data($user->id, $user->country_id, $user->role_id, $parent_geo_id = null, $action_data = null,$radio_checked);

		$compititor = $this->ecp_model->get_all_copititor_data($user->country_id);

		Template::set('compititor', $compititor);
		Template::set('current_user', $user);
		Template::set('geo_level', $geo_level);
		Template::set_view('ecp/distributor_compititor');
		Template::render();
	}

	public function distributor_compititor_details()
	{
		$user = $this->auth->user();
		$insert=$this->ecp_model->add_distributor_compititor_details($user->id,$user->country_id);
		echo $insert;
		die;
	}

	public function distributor_compititor_product()
	{
		Assets::add_module_js('ecp', 'distributor_compititor_product.js');

		$user = $this->auth->user();
		$radio_checked='9';

		$geo_level = $this->ecp_model->get_employee_geo_data($user->id, $user->country_id, $user->role_id, $parent_geo_id = null, $action_data = null,$radio_checked);

		$compititor = $this->ecp_model->get_all_copititor_data($user->country_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);

		Template::set('product_sku', $product_sku);
		Template::set('compititor', $compititor);
		Template::set('current_user', $user);
		Template::set('geo_level', $geo_level);
		Template::set_view('ecp/distributor_compititor_product');
		Template::render();
	}

	public function distributor_compititor_product_details()
	{
		$user = $this->auth->user();
		$insert=$this->ecp_model->add_distributor_compititor_product_details($user->id,$user->country_id);
		echo $insert;
		die;
	}

	public function distributor_compititor_view()
	{
		Assets::add_module_js('ecp', 'distributor_compititor_view.js');
		Template::set_view('ecp/distributor_compititor_view');
		Template::render();
	}

	public function distributor_compititor_details_view()
	{
		$user = $this->auth->user();

		$radio = (isset($_POST['radio']) ? $_POST['radio'] : '');
		$from_month = (isset($_POST['from_month']) ? $_POST['from_month'] : '');
		$to_month = (isset($_POST['to_month']) ? $_POST['to_month'] : '');

		$page = (isset($_POST['page']) ? $_POST['page'] : '');

		if($radio == 'total'){
			$distributor_compititor_details = $this->ecp_model->get_distributor_compititor_details_view($from_month, $to_month,$page,$user->local_date,$user->country_id);
		}
		elseif($radio == 'product'){
			$distributor_compititor_details = $this->ecp_model->get_distributor_compititor_product_details_view($from_month, $to_month,$page,$user->local_date,$user->country_id);
		}


		Template::set('td', $distributor_compititor_details['count']);
		Template::set('pagination', (isset($distributor_compititor_details['pagination']) && !empty($distributor_compititor_details['pagination'])) ? $distributor_compititor_details['pagination'] : '' );
		Template::set('table', $distributor_compititor_details);
		Template::set_view('ecp/retailer_compititor_view');
		Template::render();
	}


	public function update_compititor_details()
	{
		$user = $this->auth->user();

		$radio = (isset($_POST['radio_checked']) ? $_POST['radio_checked'] : '');
		if($radio == 'total'){
			echo $update=$this->ecp_model->update_compititor_details();
		}
		elseif($radio == 'product'){
			echo $update=$this->ecp_model->update_compititor_product_details();
		}

		die;
	}

	public function delete_compititor_details()
	{
		//$user = $this->auth->user();

		$radio = (isset($_POST['radio_checked']) ? $_POST['radio_checked'] : '');
		$id = $this->input->post("id");
		if($radio == 'total'){
			echo $update=$this->ecp_model->delete_compititor_details($id);
		}
		elseif($radio == 'product'){

			echo $update=$this->ecp_model->delete_compititor_product_details($id);
		}

		die;
	}



}