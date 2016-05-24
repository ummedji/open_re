<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Category_regional_master controller
 */
class Category_regional_master extends Front_Controller
{
    protected $permissionCreate = 'Category_regional_master.Category_regional_master.Create';
    protected $permissionDelete = 'Category_regional_master.Category_regional_master.Delete';
    protected $permissionEdit   = 'Category_regional_master.Category_regional_master.Edit';
    protected $permissionView   = 'Category_regional_master.Category_regional_master.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('category_regional_master/category_regional_master_model');
        $this->lang->load('category_regional_master');
		
        

		Assets::add_module_js('category_regional_master', 'category_regional_master.js');
	}

	/**
	 * Display a list of Category Regional Master data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        

        // Don't display soft-deleted records
        $this->category_regional_master_model->where($this->category_regional_master_model->get_deleted_field(), 0);
		$records = $this->category_regional_master_model->find_all();

		Template::set('records', $records);
        Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '' );
        Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '' );
		Assets::add_js('grid.js');
        

		Template::render();
	}
    
}