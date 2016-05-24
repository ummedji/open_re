<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Menu.Settings.View');
		$this->load->model('menu_model', null, true);
		$this->lang->load('menu');
		
		Template::set_block('sub_nav', 'settings/_sub_nav');
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{
        $result = $this->menu_model->read($this->input->post());
        
        if ($this->input->is_ajax_request()) {
            Template::set("ajax", TRUE);
            Template::set('req_data', (isset($result['data']) && !empty($result['data'])) ? $result['data'] : "" );
        }            $maxPosition = $this->menu_model->get_max_position($this->input->post('category'));
            $minPosition = $this->menu_model->get_min_position($this->input->post('category'));
            
            
            Template::set("max_position", (isset($maxPosition) && !empty($maxPosition)) ? $maxPosition : 0 );
            Template::set("min_position", (isset($minPosition) && !empty($minPosition)) ? $minPosition : 0 );
                Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '' );
                Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '' );
		Assets::add_js('grid.js');
		Template::set('toolbar_title', 'Manage Menu');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a Menu object.
	*/
	public function create()
	{
		$this->auth->restrict('Menu.Settings.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_menu())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('menu_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'menu');

				Template::set_message(lang('menu_create_success'), 'success');
				Template::redirect(SITE_AREA .'/settings/menu');
			}
			else
			{
				Template::set_message(lang('menu_create_failure') . $this->menu_model->error, 'error');
			}
		}
		Assets::add_module_js('menu', 'menu.js');

		Template::set('toolbar_title', lang('menu_create') . ' Menu');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of Menu data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('menu_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/menu');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Menu.Settings.Edit');

			if ($this->save_menu('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('menu_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'menu');

				Template::set_message(lang('menu_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('menu_edit_failure') . $this->menu_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Menu.Settings.Delete');

			if ($this->menu_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('menu_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'menu');

				Template::set_message(lang('menu_delete_success'), 'success');

				redirect(SITE_AREA .'/settings/menu');
			} else
			{
				Template::set_message(lang('menu_delete_failure') . $this->menu_model->error, 'error');
			}
		}
		Template::set('menu', $this->menu_model->find($id));
		Assets::add_module_js('menu', 'menu.js');

		Template::set('toolbar_title', lang('menu_edit') . ' Menu');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_menu()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_menu($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('title','Title','required|trim|xss_clean|max_length[255]');
		$this->form_validation->set_rules('alias','Alias','required|trim|xss_clean|max_length[255]');
		$this->form_validation->set_rules('link','Link','required|trim|xss_clean|max_length[255]');
		$this->form_validation->set_rules('parent_id','Parent','trim|xss_clean|integer|max_length[11]');
		$this->form_validation->set_rules('navigation_id','Navigation','max_length[11]');
		$this->form_validation->set_rules('window','Target Window','max_length[1]');
		$this->form_validation->set_rules('image_name','Image','trim|max_length[255]');
		$this->form_validation->set_rules('access_role_id','Access','required|max_length[11]');
		$this->form_validation->set_rules('meta_title','Meta title','trim|xss_clean|max_length[255]');
		$this->form_validation->set_rules('meta_keyword','Meta Keyword','trim|xss_clean|max_length[255]');
		$this->form_validation->set_rules('meta_description','Meta Description','trim');
		$this->form_validation->set_rules('status','Status', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['title']        = $this->input->post('title');
		$data['alias']        = $this->input->post('alias');
		$data['link']        = $this->input->post('link');
		$data['parent_id']        = $this->input->post('parent_id');
		$data['navigation_id']        = $this->input->post('navigation_id');
		$data['window']        = $this->input->post('window');
		$data['image_name']        = $this->input->post('image_name');
		$data['access_role_id']        = $this->input->post('access_role_id');
		$data['meta_title']        = $this->input->post('meta_title');
		$data['meta_keyword']        = $this->input->post('meta_keyword');
		$data['meta_description']        = $this->input->post('meta_description');
		$data['status']        = $this->input->post('status');

		if ($type == 'insert')
		{
                        
                        $this->db->select_max("position");
$query = $this->db->get("menu");
$pos = array_shift($query->result());
$data["position"] = $pos->position + 1;
                        
			$id = $this->menu_model->insert($data);

			if (is_numeric($id))
			{
				$return = $id;
			} else
			{
				$return = FALSE;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->menu_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}