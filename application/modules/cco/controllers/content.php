<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Cco.Content.Create';
    protected $permissionDelete = 'Cco.Content.Delete';
    protected $permissionEdit   = 'Cco.Content.Edit';
    protected $permissionView   = 'Cco.Content.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
        $this->auth->restrict($this->permissionView);
        $this->lang->load('cco');
		
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('cco', 'cco.js');
	}

	/**
	 * Display a list of CCO data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        
        
    Template::set('toolbar_title', lang('cco_manage'));

		Template::render();
	}
    
    /**
	 * Create a CCO object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict($this->permissionCreate);
        

		Template::set('toolbar_title', lang('cco_action_create'));

		Template::render();
	}
	/**
	 * Allows editing of CCO data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		if (empty($id)) {
			Template::set_message(lang('cco_invalid_id'), 'error');

			redirect(SITE_AREA . '/content/cco');
		}
        
        
        

		Template::set('toolbar_title', lang('cco_edit_heading'));
		Template::render();
	}
}