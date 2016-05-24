<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class settings extends Admin_Controller
{

    //--------------------------------------------------------------------

    private $module_config = array();

    public function __construct()
    {
        parent::__construct();

        $this->module_config = module_config(basename(dirname(__DIR__)));
//        dump($this->module_config['module_permission_name']);
//        dump($this->module_config['module_name']);
        $this->auth->restrict("{$this->module_config['module_permission_name']}.Settings.View");
        $this->load->model('user_management_model', null, true);
        $this->lang->load('user_management');

        Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
        Assets::add_js('jquery-ui-1.8.13.min.js');
        Assets::add_css('jquery-ui-timepicker.css');
        Assets::add_js('jquery-ui-timepicker-addon.js');
        Template::set_block('sub_nav', 'settings/_sub_nav');
        Template::set('module_config', $this->module_config);
    }

    //--------------------------------------------------------------------


    /*
      Method: index()

      Displays a list of form data.
     */
    public function index()
    {
        $result = $this->user_management_model->read($this->input->post());

        if ($this->input->is_ajax_request()) {
            Template::set("ajax", TRUE);
            Template::set('req_data', (isset($result['data']) && !empty($result['data'])) ? $result['data'] : "");
        }
        Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '');
        Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '');
        Assets::add_js('grid.js');
        Assets::add_module_js("{$this->module_config['module_name']}", "user_management.js");
        Template::set('toolbar_title', "{$this->module_config['module_title']}");
        Template::render();
    }

    //--------------------------------------------------------------------


    /*
      Method: create()

      Creates a User Management object.
     */
    /* public function create() {
      $this->auth->restrict('User_Management.Settings.Create');

      if ($this->input->post('save')) {
      if ($insert_id = $this->save_user_management()) {
      // Log the activity
      $this->activity_model->log_activity($this->current_user->id, lang('user_management_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'user_management');

      Template::set_message(lang('user_management_create_success'), 'success');
      Template::redirect(SITE_AREA . '/settings/user_management');
      } else {
      Template::set_message(lang('user_management_create_failure') . $this->user_management_model->error, 'error');
      }
      }
      Assets::add_module_js('user_management', 'user_management.js');

      Template::set('toolbar_title', lang('user_management_create') . ' User Management');
      Template::render();
      } */

    //--------------------------------------------------------------------


    public function create()
    {
        $this->auth->restrict('Bonfire.Users.Add');
        $this->load->model('roles/role_model');
        $this->load->config('address');
        $this->load->helper('address');
        $this->load->helper('date');


        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');
        Template::set('meta_fields', $meta_fields);

        if ($this->input->post('submit')) {
            if ($id = $this->save_user('insert', NULL, $meta_fields)) {

                $meta_data = array();
                foreach ($meta_fields as $field) {
                    if (!isset($field['admin_only']) || $field['admin_only'] === FALSE || (isset($field['admin_only']) && $field['admin_only'] === TRUE && isset($this->current_user) && $this->current_user->role_id == 1)) {
                        $meta_data[$field['name']] = $this->input->post($field['name']);
                    }
                }

                // now add the meta is there is meta data
                $this->user_model->save_meta_for($id, $meta_data);

                $user = $this->user_model->find($id);
                $log_name = (isset($user->display_name) && !empty($user->display_name)) ? $user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $user->username : $user->email);
                $this->activity_model->log_activity($this->current_user->id, lang('us_log_create') . ' ' . $user->role_name . ': ' . $log_name, 'users');

                Template::set_message(lang('us_user_created_success'), 'success');
                Template::redirect(SITE_AREA . "/settings/{$this->module_config['module_name']}");
            }
        }

        $settings = $this->settings_lib->find_all();
        if ($settings['auth.password_show_labels'] == 1) {
            Assets::add_module_js('users', 'password_strength.js');
            Assets::add_module_js('users', 'jquery.strength.js');
            Assets::add_js($this->load->view('users_js', array('settings' => $settings), true), 'inline');
        }
        Template::set('roles', $this->role_model->select('role_id, role_name, default')->where('deleted', 0)->find_all());
        Template::set('languages', unserialize($this->settings_lib->item('site.languages')));

        Template::set('toolbar_title', lang('us_create_user'));
        Template::set_view('settings/user_form');
        Template::render();
    }

//end create()


    /*
      Method: edit()

      Allows editing of User Management data.
     */

    /* public function edit() {
      $id = $this->uri->segment(5);

      if (empty($id)) {
      Template::set_message(lang('user_management_invalid_id'), 'error');
      redirect(SITE_AREA . '/settings/user_management');
      }

      if (isset($_POST['save'])) {
      $this->auth->restrict('User_Management.Settings.Edit');

      if ($this->save_user_management('update', $id)) {
      // Log the activity
      $this->activity_model->log_activity($this->current_user->id, lang('user_management_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'user_management');

      Template::set_message(lang('user_management_edit_success'), 'success');
      } else {
      Template::set_message(lang('user_management_edit_failure') . $this->user_management_model->error, 'error');
      }
      } else if (isset($_POST['delete'])) {
      $this->auth->restrict('User_Management.Settings.Delete');

      if ($this->user_management_model->delete($id)) {
      // Log the activity
      $this->activity_model->log_activity($this->current_user->id, lang('user_management_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'user_management');

      Template::set_message(lang('user_management_delete_success'), 'success');

      redirect(SITE_AREA . '/settings/user_management');
      } else {
      Template::set_message(lang('user_management_delete_failure') . $this->user_management_model->error, 'error');
      }
      }
      Template::set('user_management', $this->user_management_model->find($id));
      Assets::add_module_js('user_management', 'user_management.js');

      Template::set('toolbar_title', lang('user_management_edit') . ' User Management');
      Template::render();
      } */

    public function edit($user_id = '')
    {
        $this->load->model('roles/role_model');
        $this->load->config('address');
        $this->load->helper('address');
        $this->load->helper('date');

        // if there is no id passed in edit the current user
        // this is so we don't have to pass the user id in the url for editing the current users profile
        if (empty($user_id)) {
            $user_id = $this->current_user->id;
        }

        if (empty($user_id)) {
            Template::set_message(lang('us_empty_id'), 'error');
            redirect(SITE_AREA . "/settings/{$this->module_config['module_name']}");
        }

        if ($user_id != $this->current_user->id) {
            $this->auth->restrict('Bonfire.Users.Manage');
        }


        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');
        Template::set('meta_fields', $meta_fields);

        $user = $this->user_model->find_user_and_meta($user_id);

        if ($this->input->post('submit')) {
            if ($this->save_user('update', $user_id, $meta_fields, $user->role_name)) {

                $meta_data = array();
                foreach ($meta_fields as $field) {
                    if (!isset($field['admin_only']) || $field['admin_only'] === FALSE || (isset($field['admin_only']) && $field['admin_only'] === TRUE && isset($this->current_user) && $this->current_user->role_id == 1)) {
                        $meta_data[$field['name']] = $this->input->post($field['name']);
                    }
                }

                // now add the meta is there is meta data
                $this->user_model->save_meta_for($user_id, $meta_data);


                $user = $this->user_model->find_user_and_meta($user_id);
                $log_name = (isset($user->display_name) && !empty($user->display_name)) ? $user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $user->username : $user->email);
                $this->activity_model->log_activity($this->current_user->id, lang('us_log_edit') . ': ' . $log_name, 'users');

                Template::set_message(lang('us_user_update_success'), 'success');

                // redirect back to the edit page to make sure that a users password change
                // forces a login check
                Template::redirect($this->uri->uri_string());
            }
        }

        if (isset($user)) {
            Template::set('roles', $this->role_model->select('role_id, role_name, default')->where('deleted', 0)->find_all());
            Template::set('user', $user);
            Template::set('languages', unserialize($this->settings_lib->item('site.languages')));
        } else {
            Template::set_message(sprintf(lang('us_unauthorized'), $user->role_name), 'error');
            redirect(SITE_AREA . "/settings/{$this->module_config['module_name']}");
        }

        $settings = $this->settings_lib->find_all();
        if ($settings['auth.password_show_labels'] == 1) {
            Assets::add_module_js('users', 'password_strength.js');
            Assets::add_module_js('users', 'jquery.strength.js');
            Assets::add_js($this->load->view('users_js', array('settings' => $settings), true), 'inline');
        }

        Template::set('toolbar_title', lang('us_edit_user'));

        Template::set_view('settings/user_form');

        Template::render();
    }

//end edit()
    //--------------------------------------------------------------------
    //--------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------

    /*
      Method: save_user_management()

      Does the actual validation and saving of form data.

      Parameters:
      $type	- Either "insert" or "update"
      $id		- The ID of the record to update. Not needed for inserts.

      Returns:
      An INT id for successful inserts. If updating, returns TRUE on success.
      Otherwise, returns FALSE.
     */
    /* private function save_user_management($type = 'insert', $id = 0) {
      if ($type == 'update') {
      $_POST['id'] = $id;
      }


      $this->form_validation->set_rules('role_id', 'role_id', 'required|trim|max_length[255]');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|max_length[120]');
      $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[30]');
      $this->form_validation->set_rules('password_hash', 'password_hash', 'trim|max_length[40]');
      $this->form_validation->set_rules('reset_hash', 'reset_hash', 'trim|max_length[40]');
      $this->form_validation->set_rules('salt', 'salt', 'trim|max_length[7]');
      $this->form_validation->set_rules('last_login', 'last_login', 'trim');
      $this->form_validation->set_rules('last_ip', 'last_ip', 'max_length[40]');
      $this->form_validation->set_rules('deleted', 'deleted', 'required|trim|max_length[1]');
      $this->form_validation->set_rules('banned', 'banned', 'required|trim|max_length[1]');
      $this->form_validation->set_rules('ban_message', 'ban_message', 'trim|max_length[255]');
      $this->form_validation->set_rules('reset_by', 'reset_by', 'max_length[10]');
      $this->form_validation->set_rules('display_name', 'display_name', 'max_length[255]');
      $this->form_validation->set_rules('display_name_changed', 'display_name_changed', '');
      $this->form_validation->set_rules('timezone', 'timezone', 'required|max_length[4]');
      $this->form_validation->set_rules('language', 'language', 'max_length[20]');
      $this->form_validation->set_rules('activate_hash', 'activate_hash', 'max_length[40]');
      $this->form_validation->set_rules('active', 'Status', 'required');

      if ($this->form_validation->run() === FALSE) {
      return FALSE;
      }

      // make sure we only pass in the fields we want

      $data = array();
      $data['role_id'] = $this->input->post('role_id');
      $data['email'] = $this->input->post('email');
      $data['username'] = $this->input->post('username');
      $data['password_hash'] = $this->input->post('password_hash');
      $data['reset_hash'] = $this->input->post('reset_hash');
      $data['salt'] = $this->input->post('salt');
      $data['last_login'] = $this->input->post('last_login') ? $this->input->post('last_login') : '0000-00-00 00:00:00';
      $data['last_ip'] = $this->input->post('last_ip');
      $data['deleted'] = $this->input->post('deleted');
      $data['banned'] = $this->input->post('banned');
      $data['ban_message'] = $this->input->post('ban_message');
      $data['reset_by'] = $this->input->post('reset_by');
      $data['display_name'] = $this->input->post('display_name');
      $data['display_name_changed'] = $this->input->post('display_name_changed') ? $this->input->post('display_name_changed') : '0000-00-00';
      $data['timezone'] = $this->input->post('timezone');
      $data['language'] = $this->input->post('language');
      $data['activate_hash'] = $this->input->post('activate_hash');
      $data['active'] = $this->input->post('active');

      if ($type == 'insert') {



      $id = $this->user_management_model->insert($data);

      if (is_numeric($id)) {
      $return = $id;
      } else {
      $return = FALSE;
      }
      } else if ($type == 'update') {
      $return = $this->user_management_model->update($id, $data);
      }

      return $return;
      } */

    private function save_user($type = 'insert', $id = 0, $meta_fields = array(), $cur_role_name = '')
    {

        if ($type == 'insert') {
            $this->form_validation->set_rules('email', lang('bf_email'), 'required|trim|unique[users.email]|valid_email|max_length[120]|xss_clean');
            $this->form_validation->set_rules('password', lang('bf_password'), 'required|trim|strip_tags|min_length[8]|max_length[120]|valid_password|xss_clean');
            $this->form_validation->set_rules('pass_confirm', lang('bf_password_confirm'), 'required|trim|strip_tags|matches[password]|xss_clean');
        } else {
            $_POST['id'] = $id;
            $this->form_validation->set_rules('email', lang('bf_email'), 'required|trim|unique[users.email,users.id]|valid_email|max_length[120]|xss_clean');
            $this->form_validation->set_rules('password', lang('bf_password'), 'trim|strip_tags|min_length[8]|max_length[120]|valid_password|matches[pass_confirm]|xss_clean');
            $this->form_validation->set_rules('pass_confirm', lang('bf_password_confirm'), 'trim|strip_tags|xss_clean');
        }

        $use_usernames = $this->settings_lib->item('auth.use_usernames');

        if ($use_usernames) {
            $extra_unique_rule = $type == 'update' ? ',users.id' : '';

            $this->form_validation->set_rules('username', lang('bf_username'), 'required|trim|strip_tags|max_length[30]|unique[users.username' . $extra_unique_rule . ']|xss_clean');
        }

        $this->form_validation->set_rules('display_name', lang('bf_display_name'), 'trim|strip_tags|max_length[255]|xss_clean');

        $this->form_validation->set_rules('language', lang('bf_language'), 'required|trim|strip_tags|xss_clean');
        $this->form_validation->set_rules('timezones', lang('bf_timezone'), 'required|trim|strip_tags|max_length[4]|xss_clean');

        if (has_permission('Bonfire.Roles.Manage') && has_permission('Permissions.' . $cur_role_name . '.Manage')) {
            $this->form_validation->set_rules('role_id', lang('us_role'), 'required|trim|strip_tags|max_length[2]|is_numeric|xss_clean');
        }

        $meta_data = array();

        foreach ($meta_fields as $field) {
            if (!isset($field['admin_only']) || $field['admin_only'] === FALSE || (isset($field['admin_only']) && $field['admin_only'] === TRUE && isset($this->current_user) && $this->current_user->role_id == 1)) {
                $this->form_validation->set_rules($field['name'], $field['label'], $field['rules']);

                $meta_data[$field['name']] = $this->input->post($field['name']);
            }
        }

        if ($this->form_validation->run($this) === FALSE) {
            return FALSE;
        }

        // Compile our core user elements to save.
        $data = array(
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'language' => $this->input->post('language'),
            'timezone' => $this->input->post('timezones'),
        );

        if ($this->input->post('password')) {
            $data['password'] = $this->input->post('password');
        }

        if ($this->input->post('role_id')) {
            $data['role_id'] = $this->input->post('role_id');
        }

        if ($this->input->post('restore')) {
            $data['deleted'] = 0;
        }

        if ($this->input->post('unban')) {
            $data['banned'] = 0;
        }

        if ($this->input->post('display_name')) {
            $data['display_name'] = $this->input->post('display_name');
        }

        // Activation
        if ($this->input->post('activate')) {
            $data['active'] = 1;
        } else if ($this->input->post('deactivate')) {
            $data['active'] = 0;
        }

        if ($type == 'insert') {
            $activation_method = $this->settings_lib->item('auth.user_activation_method');

            // No activation method
            if ($activation_method == 0) {
                // Activate the user automatically
                $data['active'] = 1;
            }

            $return = $this->user_model->insert($data);
        } else { // Update
            $return = $this->user_model->update($id, $data);
        }

        // Any modules needing to save data?
        Events::trigger('save_user', $this->input->post());

        return $return;
    }

//end save_user()
    //--------------------------------------------------------------------
}
