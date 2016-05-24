<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Master controller
 */
class Master extends Admin_Controller
{
    protected $permissionCreate = 'Customer_type_regional.Master.Create';
    protected $permissionDelete = 'Customer_type_regional.Master.Delete';
    protected $permissionEdit   = 'Customer_type_regional.Master.Edit';
    protected $permissionView   = 'Customer_type_regional.Master.View';

    /**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
        $this->auth->restrict($this->permissionView);
		$this->load->model('customer_type_regional/customer_type_regional_model');
        $this->lang->load('customer_type_regional');
		
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
		Template::set_block('sub_nav', 'master/_sub_nav');

		Assets::add_module_js('customer_type_regional', 'customer_type_regional.js');
	}

	/**
	 * Display a list of Customer Type Regional data.
	 *
	 * @return void
	 */
	public function index()
	{
                $result = $this->customer_type_regional_model->read($this->input->post());
        if ($this->input->is_ajax_request()) {
            Template::set("ajax", TRUE);
            Template::set('req_data', (isset($result['data']) && !empty($result['data'])) ? $result['data'] : "" );
        }
        
        
        
		$records = $this->customer_type_regional_model->find_all();

		Template::set('records', $records);
        Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '' );
        Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '' );
		Assets::add_js('grid.js');
        
    Template::set('toolbar_title', lang('customer_type_regional_manage'));

		Template::render();
	}
    
    /**
	 * Create a Customer Type Regional object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict($this->permissionCreate);
        
		if (isset($_POST['save'])) {
			if ($insert_id = $this->save_customer_type_regional()) {
				log_activity($this->auth->user_id(), lang('customer_type_regional_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'customer_type_regional');
				Template::set_message(lang('customer_type_regional_create_success'), 'success');

				redirect(SITE_AREA . '/master/customer_type_regional');
			}

            // Not validation error
			if ( ! empty($this->customer_type_regional_model->error)) {
				Template::set_message(lang('customer_type_regional_create_failure') . $this->customer_type_regional_model->error, 'error');
            }
		}

		Template::set('toolbar_title', lang('customer_type_regional_action_create'));

		Template::render();
	}
	/**
	 * Allows editing of Customer Type Regional data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);
		if (empty($id)) {
			Template::set_message(lang('customer_type_regional_invalid_id'), 'error');

			redirect(SITE_AREA . '/master/customer_type_regional');
		}
        
		if (isset($_POST['save'])) {
			$this->auth->restrict($this->permissionEdit);

			if ($this->save_customer_type_regional('update', $id)) {
				log_activity($this->auth->user_id(), lang('customer_type_regional_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'customer_type_regional');
				Template::set_message(lang('customer_type_regional_edit_success'), 'success');
				redirect(SITE_AREA . '/master/customer_type_regional');
			}

            // Not validation error
            if ( ! empty($this->customer_type_regional_model->error)) {
                Template::set_message(lang('customer_type_regional_edit_failure') . $this->customer_type_regional_model->error, 'error');
			}
		}
        
		elseif (isset($_POST['delete'])) {
			$this->auth->restrict($this->permissionDelete);

			if ($this->customer_type_regional_model->delete($id)) {
				log_activity($this->auth->user_id(), lang('customer_type_regional_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'customer_type_regional');
				Template::set_message(lang('customer_type_regional_delete_success'), 'success');

				redirect(SITE_AREA . '/master/customer_type_regional');
			}

            Template::set_message(lang('customer_type_regional_delete_failure') . $this->customer_type_regional_model->error, 'error');
		}
        
        Template::set('customer_type_regional', $this->customer_type_regional_model->find($id));

		Template::set('toolbar_title', lang('customer_type_regional_edit_heading'));
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
	private function save_customer_type_regional($type = 'insert', $id = 0)
	{
		if ($type == 'update') {
			$_POST['customer_type_id'] = $id;
		}

        // Validate the data
        $this->form_validation->set_rules($this->customer_type_regional_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

		// Make sure we only pass in the fields we want
		
		$data = $this->customer_type_regional_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        
		$data['status']        = $this->input->post('status');

        $return = false;
		if ($type == 'insert') {
		    
			$id = $this->customer_type_regional_model->insert($data);

			if (is_numeric($id)) {
				$return = $id;
			}
		} elseif ($type == 'update') {
			$return = $this->customer_type_regional_model->update($id, $data);
		}

		return $return;
	}
}