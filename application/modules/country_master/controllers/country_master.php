<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Country_master controller
 */
class Country_master extends Front_Controller
{
    protected $permissionCreate = 'Country_master.Country_master.Create';
    protected $permissionDelete = 'Country_master.Country_master.Delete';
    protected $permissionEdit   = 'Country_master.Country_master.Edit';
    protected $permissionView   = 'Country_master.Country_master.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->auth->restrict($this->permissionView);
        $this->load->model('country_master/country_master_model');
        $this->lang->load('country_master');

        $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");

        Template::set_block('sub_nav', 'master/_sub_nav');

        Assets::add_module_js('country_master', 'country_master.js');
    }

    /**
     * Display a list of Country Master data.
     *
     * @return void
     */
    public function index()
    {
        $result = $this->country_master_model->read($this->input->post());
        if ($this->input->is_ajax_request()) {
            Template::set("ajax", TRUE);
            Template::set('req_data', (isset($result['data']) && !empty($result['data'])) ? $result['data'] : "" );
        }

        $records = $this->country_master_model->find_all();

        Template::set('records', $records);
        Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '' );
        Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '' );
        Assets::add_js('grid.js');

        Template::set('toolbar_title', lang('country_master_manage'));

        Template::render();
    }

    /**
     * Create a Country Master object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);

        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_country_master()) {
                log_activity($this->auth->user_id(), lang('country_master_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'country_master');
                Template::set_message(lang('country_master_create_success'), 'success');

                redirect(site_url(). 'administration/country');
            }

            // Not validation error
            if ( ! empty($this->country_master_model->error)) {
                Template::set_message(lang('country_master_create_failure') . $this->country_master_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('country_master_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Country Master data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(4);
        if (empty($id)) {
            Template::set_message(lang('country_master_invalid_id'), 'error');

            redirect(site_url(). 'administration/country');
        }

        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_country_master('update', $id)) {
                log_activity($this->auth->user_id(), lang('country_master_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'country_master');
                Template::set_message(lang('country_master_edit_success'), 'success');
                redirect(site_url(). 'administration/country');
            }

            // Not validation error
            if ( ! empty($this->country_master_model->error)) {
                Template::set_message(lang('country_master_edit_failure') . $this->country_master_model->error, 'error');
            }
        }

        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->country_master_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('country_master_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'country_master');
                Template::set_message(lang('country_master_delete_success'), 'success');

                redirect(site_url(). 'administration/country');
            }

            Template::set_message(lang('country_master_delete_failure') . $this->country_master_model->error, 'error');
        }

        Template::set('country_master', $this->country_master_model->find($id));

        Template::set('toolbar_title', lang('country_master_edit_heading'));
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
    private function save_country_master($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['counrty_id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->country_master_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want

        $data = $this->country_master_model->prep_data($this->input->post());
        // Additional handling for default values should be added below,
        // or in the model's prep_data() method


        $return = false;
        if ($type == 'insert') {
            $data_insert_country['iso'] = $this->input->post('iso');
            $data_insert_country['name'] = $this->input->post('name');
            $data_insert_country['printable_name'] = $this->input->post('printable_name');
            $data_insert_country['numcode'] = $this->input->post('numcode');
            $data_insert_country['status'] = $this->input->post('status');
            $id = $this->country_master_model->country_insert($data_insert_country);
            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->country_master_model->update($id, $data);
        }

        return $return;
    }
}