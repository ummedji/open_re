<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Navigation.Settings.View');
		$this->load->model('navigation_model', null, true);
		$this->lang->load('navigation');
		
		Template::set_block('sub_nav', 'settings/_sub_nav');
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{
        $result = $this->navigation_model->read($this->input->post());
        
        if ($this->input->is_ajax_request()) {
            Template::set("ajax", TRUE);
            Template::set('req_data', (isset($result['data']) && !empty($result['data'])) ? $result['data'] : "" );
        }
                Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '' );
                Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '' );
		Assets::add_js('grid.js');
		Template::set('toolbar_title', 'Manage Navigation');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a Navigation object.
	*/
	public function create()
	{
		$this->auth->restrict('Navigation.Settings.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_navigation())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('navigation_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'navigation');

				Template::set_message(lang('navigation_create_success'), 'success');
				Template::redirect(SITE_AREA .'/settings/navigation');
			}
			else
			{
				Template::set_message(lang('navigation_create_failure') . $this->navigation_model->error, 'error');
			}
		}
		Assets::add_module_js('navigation', 'navigation.js');

		Template::set('toolbar_title', lang('navigation_create') . ' Navigation');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of Navigation data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('navigation_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/navigation');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Navigation.Settings.Edit');

			if ($this->save_navigation('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('navigation_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'navigation');

				Template::set_message(lang('navigation_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('navigation_edit_failure') . $this->navigation_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Navigation.Settings.Delete');

			if ($this->navigation_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('navigation_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'navigation');

				Template::set_message(lang('navigation_delete_success'), 'success');

				redirect(SITE_AREA .'/settings/navigation');
			} else
			{
				Template::set_message(lang('navigation_delete_failure') . $this->navigation_model->error, 'error');
			}
		}
		Template::set('navigation', $this->navigation_model->find($id));
		Assets::add_module_js('navigation', 'navigation.js');

		Template::set('toolbar_title', lang('navigation_edit') . ' Navigation');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_navigation()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_navigation($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('title','Title','required|trim|xss_clean|max_length[255]');
		$this->form_validation->set_rules('position','Position','required|trim|xss_clean|max_length[255]');
		$this->form_validation->set_rules('description','Description','trim|max_length[255]');
		$this->form_validation->set_rules('status','Status', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['title']        = $this->input->post('title');
		$data['position']        = $this->input->post('position');
		$data['description']        = $this->input->post('description');
		$data['status']        = $this->input->post('status');

		if ($type == 'insert')
		{
                        
                        
                        
			$id = $this->navigation_model->insert($data);

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
			$return = $this->navigation_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}