<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class menu extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('menu_model', null, true);
		$this->lang->load('menu');
		
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{

		$records = $this->menu_model->find_all();
                dump($this->menu_model->get_navigation("header"));
		Template::set('records', $records);
                
                echo $this->navigation("header");
                
		Template::render();
	}
        
	//--------------------------------------------------------------------

        /*
         * Widget navigation...
         */
        
        public function navigation($navigation){
            if(!empty($navigation)){
                $menu_map = $this->menu_model->get_navigation($navigation);
                $output = "";
                if($menu_map){
                    foreach ($menu_map as $menu) {
                        $output .= $this->menu_model->get_recursive_menu($menu);
                    }
                    return $output;
                }
                
                return FALSE;
            }
        }

}