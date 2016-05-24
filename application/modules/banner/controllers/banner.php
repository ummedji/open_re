<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class banner extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('banner_model', null, true);
		$this->lang->load('banner');
		
			Assets::add_js(Template::theme_url('js/editors/ckeditor/ckeditor.js'));
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{

		//$records = $this->banner_model->find_all();
                $records = $this->banner_model->where('status',1)->find_all();
        
		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------




}