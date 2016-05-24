<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Customer_type_regional controller
 */
class Customer_type_regional extends Front_Controller
{
    protected $permissionCreate = 'Customer_type_regional.Customer_type_regional.Create';
    protected $permissionDelete = 'Customer_type_regional.Customer_type_regional.Delete';
    protected $permissionEdit   = 'Customer_type_regional.Customer_type_regional.Edit';
    protected $permissionView   = 'Customer_type_regional.Customer_type_regional.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('customer_type_regional/customer_type_regional_model');
        $this->lang->load('customer_type_regional');
		
        

		Assets::add_module_js('customer_type_regional', 'customer_type_regional.js');
	}

	/**
	 * Display a list of Customer Type Regional data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        

        // Don't display soft-deleted records
        $this->customer_type_regional_model->where($this->customer_type_regional_model->get_deleted_field(), 0);
		$records = $this->customer_type_regional_model->find_all();

		Template::set('records', $records);
        Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '' );
        Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '' );
		Assets::add_js('grid.js');
        

		Template::render();
	}
    
}