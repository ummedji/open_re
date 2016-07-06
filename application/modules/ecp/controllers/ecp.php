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
}