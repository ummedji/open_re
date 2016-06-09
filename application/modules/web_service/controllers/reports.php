<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Reports controller
 */
class Reports extends Admin_Controller
{
    protected $permissionCreate = 'Web_services.Reports.Create';
    protected $permissionDelete = 'Web_services.Reports.Delete';
    protected $permissionEdit   = 'Web_services.Reports.Edit';
    protected $permissionView   = 'Web_services.Reports.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
        $this->auth->restrict($this->permissionView);
        $this->lang->load('web_services');
		
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
		Template::set_block('sub_nav', 'reports/_sub_nav');

		Assets::add_module_js('web_services', 'web_services.js');
	}

	/**
	 * Display a list of Web Services data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        
        
    Template::set('toolbar_title', lang('web_services_manage'));

		Template::render();
	}
    
}