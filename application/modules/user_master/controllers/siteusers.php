<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class siteusers extends Admin_Controller
{
    private $module_config = array();

    public function __construct()
    {
        parent::__construct();
        $this->module_config = module_config(basename(dirname(__DIR__)));
        $this->auth->restrict("{$this->module_config['module_permission_name']}.Siteusers.View");
        $this->load->model('user_master_model', null, true);
        $this->lang->load('user_master');
        $this->load->library('excel');
        /*
        Assets::add_css('jquery-ui-timepicker.css');
        Assets::add_js('jquery-ui-timepicker-addon.js');*/

        Assets::add_module_js('user_master', 'user_master.js');
        Template::set_block('sub_nav', 'siteusers/_sub_nav');
        Template::set('module_config', $this->module_config);
    }

    public function index()
    {
        $result = $this->user_master_model->read($this->input->post());
        if ($this->input->is_ajax_request()) {
            Template::set("ajax", TRUE);
            Template::set('req_data', (isset($result['data']) && !empty($result['data'])) ? $result['data'] : "");
        }
        if($this->input->post('btn_export'))
        {
            $result = $this->user_master_model->read($this->input->post());
            $records=array();
            $records = (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '';

            $this->excel->setActiveSheetIndex(0);
            //name the worksheet
            $this->excel->getActiveSheet()->setTitle('Users');
            $this->excel->getActiveSheet()->setCellValue('A1','Sr. No.');
            $this->excel->getActiveSheet()->setCellValue('B1','ID');
            $this->excel->getActiveSheet()->setCellValue('C1','Display Name');
            $this->excel->getActiveSheet()->setCellValue('D1','Email');
            $this->excel->getActiveSheet()->setCellValue('E1','Country');
            $this->excel->getActiveSheet()->setCellValue('F1','State');
            $this->excel->getActiveSheet()->setCellValue('G1','Date Of Birth');
            $this->excel->getActiveSheet()->setCellValue('H1','Contact No');
            $this->excel->getActiveSheet()->setCellValue('I1','Profile Image');
            $this->excel->getActiveSheet()->setCellValue('J1','Created');
            $this->excel->getActiveSheet()->setCellValue('K1','Status');
            
            $this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(12);
            $this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);

            foreach(range('A1','K1') as $columnID) {
                $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            }

            if(!empty($records))
            {
                foreach($records as $key => $value)
                {
                    $user = $this->user_model->find_user_and_meta($value->id);
                    $this->excel->getActiveSheet()->setCellValue('A'.($key+2), $key+1);
                    $this->excel->getActiveSheet()->setCellValue('B'.($key+2), $user->id);
                    $this->excel->getActiveSheet()->setCellValue('C'.($key+2), $user->display_name);
                    $this->excel->getActiveSheet()->setCellValue('D'.($key+2), $user->email);
                    $this->excel->getActiveSheet()->setCellValue('E'.($key+2), (isset($user->country))?$user->country:'');
                    $this->excel->getActiveSheet()->setCellValue('F'.($key+2), (isset($user->state))?$user->state:'');
                    $this->excel->getActiveSheet()->setCellValue('G'.($key+2), (isset($user->birth_date))?show_formatted_date($user->birth_date,'d-m-Y'):'');
                    $this->excel->getActiveSheet()->setCellValue('H'.($key+2), $user->contact);
                    $this->excel->getActiveSheet()->setCellValue('I'.($key+2), $user->pro_pic);
                    $this->excel->getActiveSheet()->setCellValue('J'.($key+2), show_formatted_date($user->created_on,'d-m-Y'));
                    $this->excel->getActiveSheet()->setCellValue('K'.($key+2), ($user->active==1)?'Active':'Inactive');
                }
            }
            //exit;
            $filename='Users_'.date('d-m-y').'.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache

            //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
            //if you want to save it as .XLSX Excel 2007 format
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
            //force user to download the Excel file without writing it to server's HD
            $objWriter->save('php://output');
            exit();
        }
        Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '');
        Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '');
        Assets::add_js('grid.js');
        Assets::add_module_js("{$this->module_config['module_name']}", "user_master.js");
        Template::set('toolbar_title', "{$this->module_config['module_title']}");
        Template::render();
    }

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

                if(!empty($_POST['pro_pic']['name']))
                {
                    $userimage = $this->userimageUpload();
                    if (!empty($userimage)) {
                        if (!empty($userimage['file_name'])) {
                            $_POST['pro_pic'] = $userimage['file_name'];
                        }
                        else
                        {
                            $message = $userimage['error'];
                            Template::set('message', $message);
                        }
                    }
                    else
                    {
                        $_POST['pro_pic'] = '';
                    }
                }else {
                    $_POST['pro_pic']='';
                }
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
                Template::redirect(SITE_AREA . "/siteusers/{$this->module_config['module_name']}");
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
        Template::set_view('siteusers/user_form');
        Template::render();
    }

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
            redirect(SITE_AREA . "/siteusers/{$this->module_config['module_name']}");
        }

        if ($user_id != $this->current_user->id) {
            $this->auth->restrict('Bonfire.Users.Manage');
        }

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');
        Template::set('meta_fields', $meta_fields);

        $user = $this->user_model->find_user_and_meta($user_id);

        if ($this->input->post('submit')) {
            if(!empty($_POST['pro_pic']['name']))
            {
                $userimage = $this->userimageUpload();
                if (!empty($userimage)) {
                    if (!empty($userimage['file_name'])) {
                        $_POST['pro_pic'] = $userimage['file_name'];
                        //$query = $this->db->get_where('user_master', array('id' => $id));

                        //$result = array_shift($query->result());

                        if(isset($_POST['pro_pic_old']) && trim($_POST['pro_pic_old'])!='' && !is_null($_POST['pro_pic_old']))
                        {
                            $originalPath = FCPATH . "assets/uploads/user_images/original/" . $_POST['pro_pic_old'];
                            $resizePath = FCPATH . "assets/uploads/user_images/" . $_POST['pro_pic_old'];
                            array_map("unlink", glob($originalPath));
                            array_map("unlink", glob($resizePath));
                        }
                    }
                    else
                    {
                        $message = $userimage['error'];
                        Template::set('message', $message);
                    }
                }
            }

            if ($this->save_user('update', $user_id, $meta_fields, $user->role_name)) {
                //testdata('herer');
                $meta_data = array();
                foreach ($meta_fields as $field) {
                    if (!isset($field['admin_only']) || $field['admin_only'] === FALSE || (isset($field['admin_only']) && $field['admin_only'] === TRUE && isset($this->current_user) && $this->current_user->role_id == 1)) {
                        if($field['name']=='pro_pic' && (isset($_POST['pro_pic']['name']) && $_POST['pro_pic']['name']==''))
                        {

                        }else{
                            $meta_data[$field['name']] = $this->input->post($field['name']);
                        }
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
            //testdata($user);
            Template::set('languages', unserialize($this->settings_lib->item('site.languages')));
        } else {
            Template::set_message(sprintf(lang('us_unauthorized'), $user->role_name), 'error');
            redirect(SITE_AREA . "/siteusers/{$this->module_config['module_name']}");
        }

        $settings = $this->settings_lib->find_all();
        if ($settings['auth.password_show_labels'] == 1) {
            Assets::add_module_js('users', 'password_strength.js');
            Assets::add_module_js('users', 'jquery.strength.js');
            Assets::add_js($this->load->view('users_js', array('settings' => $settings), true), 'inline');
        }

        Template::set('toolbar_title', lang('us_edit_user'));

        Template::set_view('siteusers/user_form');

        Template::render();
    }


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

            //$this->form_validation->set_rules('username', lang('bf_username'), 'required|trim|strip_tags|max_length[30]|unique[users.username' . $extra_unique_rule . ']|xss_clean');
        }

        $this->form_validation->set_rules('display_name', lang('bf_display_name'), 'trim|strip_tags|max_length[255]|xss_clean');

        //$this->form_validation->set_rules('language', lang('bf_language'), 'required|trim|strip_tags|xss_clean');
       // $this->form_validation->set_rules('timezones', lang('bf_timezone'), 'required|trim|strip_tags|max_length[4]|xss_clean');

        if (has_permission('Bonfire.Roles.Manage') && has_permission('Permissions.' . $cur_role_name . '.Manage')) {
            //dumpme('here');
            $this->form_validation->set_rules('role_id', lang('us_role'), 'trim|strip_tags|max_length[2]|is_numeric|xss_clean');
        }

        $meta_data = array();

        foreach ($meta_fields as $field) {
            if (!isset($field['admin_only']) || $field['admin_only'] === FALSE || (isset($field['admin_only']) && $field['admin_only'] === TRUE && isset($this->current_user) && $this->current_user->role_id == 1)) {
                $this->form_validation->set_rules($field['name'], $field['label'], $field['rules']);

                $meta_data[$field['name']] = $this->input->post($field['name']);
            }
        }

        if ($this->form_validation->run($this) === FALSE) {
            //dumpme('here1');
            return FALSE;
        }

        // Compile our core user elements to save.
        $data = array(
            'email' => $this->input->post('email'),
            //'username' => $this->input->post('username'),
            //'language' => $this->input->post('language'),
            //'timezone' => $this->input->post('timezones'),
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
    public function userimageUpload()
    {
        $config['upload_path'] = FCPATH . 'assets/uploads/user_images/original';//file upload path
        $config['allowed_types'] = 'gif|jpg|png|jpeg';//file type allowed
        $config['file_name'] = $_POST['pro_pic']['name'];
        //not overwrite image for below code
        $config['overwrite'] = FALSE;
        $config['max_size'] = '1024';//max file size for upload

        $this->load->library('upload', $config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        if (!empty($_POST['pro_pic']['name']) && $_POST['pro_pic']['error'] != 4) {

            if (!$this->upload->do_upload('pro_pic')) {
                $error = array('error' => $this->upload->display_errors());
                return $error;
            }
            else
            {
                $upload_data = $this->upload->data();

                $config["image_library"] = "gd2";
                $config["source_image"] = $upload_data["full_path"];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                //image resize and upload in below path
                $config['new_image'] = FCPATH . 'assets/uploads/user_images/' . $upload_data['file_name'];
                $config['quality'] = "100%";
                //Here Set Width and height for image resize
                /*$config['width'] = 200;
                $config['height'] = 150;*/
                $this->load->library('image_lib');
                $this->image_lib->initialize($config);
                //Resize image
                if (!$this->image_lib->resize()) {
                    //If error, redirect to an error page
                    redirect("errorhandler");
                }
                return $upload_data;
            }
        }
    }
}
