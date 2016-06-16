<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Esp.Content.Create';
    protected $permissionDelete = 'Esp.Content.Delete';
    protected $permissionEdit   = 'Esp.Content.Edit';
    protected $permissionView   = 'Esp.Content.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
        $this->auth->restrict($this->permissionView);
        $this->lang->load('esp');
		
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('esp', 'esp.js');
	}

	/**
	 * Display a list of ESP data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        
        
    Template::set('toolbar_title', lang('esp_manage'));

		Template::render();
	}
    
    /**
	 * Create a ESP object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict($this->permissionCreate);
        

		Template::set('toolbar_title', lang('esp_action_create'));

		Template::render();
	}
	/**
	 * Allows editing of ESP data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		if (empty($id)) {
			Template::set_message(lang('esp_invalid_id'), 'error');

			redirect(SITE_AREA . '/content/esp');
		}
        
        
        

		Template::set('toolbar_title', lang('esp_edit_heading'));
		Template::render();
	}
}