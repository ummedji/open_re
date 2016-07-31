<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Cco controller
 */
class Cco extends Front_Controller
{
    protected $permissionCreate = 'Cco.Cco.Create';
    protected $permissionDelete = 'Cco.Cco.Delete';
    protected $permissionEdit   = 'Cco.Cco.Edit';
    protected $permissionView   = 'Cco.Cco.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
        $this->lang->load('cco');
		
        

		Assets::add_module_js('cco', 'cco.js');
	}

	/**
	 * Display a list of CCO data.
	 *
	 * @return void
	 */
	public function index()
	{
        
        
        
        
        

		Template::render();
	}
    
}