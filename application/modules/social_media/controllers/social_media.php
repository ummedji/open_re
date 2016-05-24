<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class social_media extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('social_media_model', null, true);
		$this->lang->load('social_media');
		
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{

		//$records = $this->social_media_model->find_all();
                $records=$this->social_media_model->where('status','1')->find_all();
		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------




}