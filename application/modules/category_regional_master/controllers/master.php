<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Master controller
 */
class Master extends Admin_Controller
{
    protected $permissionCreate = 'Category_regional_master.Master.Create';
    protected $permissionDelete = 'Category_regional_master.Master.Delete';
    protected $permissionEdit   = 'Category_regional_master.Master.Edit';
    protected $permissionView   = 'Category_regional_master.Master.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
        $this->auth->restrict($this->permissionView);
		$this->load->model('category_regional_master/category_regional_master_model');
        $this->lang->load('category_regional_master');
		
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('category_regional_master', 'category_regional_master.js');
	}

	/**
	 * Display a list of Category Regional Master data.
	 *
	 * @return void
	 */
	public function index()
	{
                $result = $this->category_regional_master_model->read($this->input->post());
        if ($this->input->is_ajax_request()) {
            Template::set("ajax", TRUE);
            Template::set('req_data', (isset($result['data']) && !empty($result['data'])) ? $result['data'] : "" );
        }
        
        
        
		$records = $this->category_regional_master_model->find_all();

		Template::set('records', $records);
        Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '' );
        Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '' );
		Assets::add_js('grid.js');
        
    Template::set('toolbar_title', lang('category_regional_master_manage'));

		Template::render();
	}
    
    /**
	 * Create a Category Regional Master object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict($this->permissionCreate);
        
		if (isset($_POST['save'])) {
			if ($insert_id = $this->save_category_regional_master()) {
				log_activity($this->auth->user_id(), lang('category_regional_master_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'category_regional_master');
				Template::set_message(lang('category_regional_master_create_success'), 'success');

				redirect(SITE_AREA . '/master/category_regional_master');
			}

            // Not validation error
			if ( ! empty($this->category_regional_master_model->error)) {
				Template::set_message(lang('category_regional_master_create_failure') . $this->category_regional_master_model->error, 'error');
            }
		}

		Template::set('toolbar_title', lang('category_regional_master_action_create'));

		Template::render();
	}
	/**
	 * Allows editing of Category Regional Master data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		if (empty($id)) {
			Template::set_message(lang('category_regional_master_invalid_id'), 'error');

			redirect(SITE_AREA . '/master/category_regional_master');
		}
        
		if (isset($_POST['save'])) {
			$this->auth->restrict($this->permissionEdit);

			if ($this->save_category_regional_master('update', $id)) {
				log_activity($this->auth->user_id(), lang('category_regional_master_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'category_regional_master');
				Template::set_message(lang('category_regional_master_edit_success'), 'success');
				redirect(SITE_AREA . '/master/category_regional_master');
			}

            // Not validation error
            if ( ! empty($this->category_regional_master_model->error)) {
                Template::set_message(lang('category_regional_master_edit_failure') . $this->category_regional_master_model->error, 'error');
			}
		}
        
		elseif (isset($_POST['delete'])) {
			$this->auth->restrict($this->permissionDelete);

			if ($this->category_regional_master_model->delete($id)) {
				log_activity($this->auth->user_id(), lang('category_regional_master_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'category_regional_master');
				Template::set_message(lang('category_regional_master_delete_success'), 'success');

				redirect(SITE_AREA . '/master/category_regional_master');
			}

            Template::set_message(lang('category_regional_master_delete_failure') . $this->category_regional_master_model->error, 'error');
		}
        
        Template::set('category_regional_master', $this->category_regional_master_model->find($id));

		Template::set('toolbar_title', lang('category_regional_master_edit_heading'));
		Template::render();
	}

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/**
	 * Save the data.
	 *
	 * @param string $type Either 'insert' or 'update'.
	 * @param int	 $id	The ID of the record to update, ignored on inserts.
	 *
	 * @return bool|int An int ID for successful inserts, true for successful
     * updates, else false.
	 */
	private function save_category_regional_master($type = 'insert', $id = 0)
	{
		if ($type == 'update') {
			$_POST['category_id'] = $id;
		}

        // Validate the data
        $this->form_validation->set_rules($this->category_regional_master_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

		// Make sure we only pass in the fields we want
		
		$data = $this->category_regional_master_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        
		$data['status']        = $this->input->post('status');

        $return = false;
		if ($type == 'insert') {
		    
			$id = $this->category_regional_master_model->insert($data);

			if (is_numeric($id)) {
				$return = $id;
			}
		} elseif ($type == 'update') {
			$return = $this->category_regional_master_model->update($id, $data);
		}

		return $return;
	}
}