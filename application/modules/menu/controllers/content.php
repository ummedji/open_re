<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class content extends Admin_Controller
{

    //--------------------------------------------------------------------

    public $module_config = array();

    public function __construct()
    {
        parent::__construct();

        //load module specific stuff...
        $this->auth->restrict('Menu.Content.View');
        $this->load->model('menu_model', null, true);
        $this->module_config = module_config('menu');
        $this->lang->load('menu');

        //load upload helper...
        $this->load->helper("upload_file");
        //load upload library...
        $this->load->library('upload');

        Template::set_block('sub_nav', 'content/_sub_nav');
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
            Template::set('req_data', (isset($result['data']) && !empty($result['data'])) ? $result['data'] : "");
        }

        $maxPosition = $this->menu_model->get_max_position($this->input->post('category'));
        $minPosition = $this->menu_model->get_min_position($this->input->post('category'));


        Template::set("max_position", (isset($maxPosition) && !empty($maxPosition)) ? $maxPosition : 0);
        Template::set("min_position", (isset($minPosition) && !empty($minPosition)) ? $minPosition : 0);
        Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '');
        Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '');
        Template::set('toolbar_title', 'Manage Menu');
        Assets::add_js('grid.js');
        Template::render();
    }

    //--------------------------------------------------------------------


    /*
      Method: create()

      Creates a Menu object.
     */
    public function create()
    {
        $this->auth->restrict('Menu.Content.Create');

        if ($this->input->post('save')) {
            if ($insert_id = $this->save_menu()) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('menu_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'menu');

                Template::set_message(lang('menu_create_success'), 'success');
                Template::redirect(SITE_AREA . '/content/menu');
            } else {
                Template::set_message(lang('menu_create_failure') . $this->menu_model->error, 'error');
            }
        }
        Assets::add_module_js('menu', 'menu.js');

        //set all menus for parent menus...
        Template::set("parent_menus", $this->menu_model->find_all_by("status", "1"));

        //set all navigation bars...
        //load navigation model...
        $this->load->model("navigation/navigation_model", "rm");
        Template::set("nav_bars", $this->rm->find_all_by("status", "1"));

        //set all access roles...
        //load role model...
        $this->load->model("roles/role_model", "nm");
        $roles = $this->nm->find_all(1);
        $new_role = new stdClass();
        $new_role->role_id = 0;
        $new_role->role_name = "All";
        Template::set("roles", array_merge(array($new_role), $roles));

        if ($this->input->post()) {
            $link_type = $this->input->post("link_type");
            $selection = $this->input->post("link");
            $links = "";
            if ($link_type != 'other') {
                $links = $this->menu_model->get_links_for_type($link_type, $selection);
            }
            Template::set("links", $links);
            Template::set("link_type", $link_type);
//            dump($links);
        }

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

        if (empty($id)) {
            Template::set_message(lang('menu_invalid_id'), 'error');
            redirect(SITE_AREA . '/content/menu');
        }

        if (isset($_POST['save'])) {
            $this->auth->restrict('Menu.Content.Edit');

            if ($this->save_menu('update', $id)) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('menu_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'menu');

                Template::set_message(lang('menu_edit_success'), 'success');
            } else {
                Template::set_message(lang('menu_edit_failure') . $this->menu_model->error, 'error');
            }
        } else if (isset($_POST['delete'])) {
            $this->auth->restrict('Menu.Content.Delete');

            if ($this->menu_model->delete($id)) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('menu_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'menu');

                Template::set_message(lang('menu_delete_success'), 'success');

                redirect(SITE_AREA . '/content/menu');
            } else {
                Template::set_message(lang('menu_delete_failure') . $this->menu_model->error, 'error');
            }
        }

        $menu = $this->menu_model->find($id);

        Template::set('menu', $menu);
        Assets::add_module_js('menu', 'menu.js');

        //set all menus for parent menus...
        Template::set("parent_menus", $this->menu_model->find_all_by("status", "1"));

        //set all navigation bars...
        //load navigation model...
        $this->load->model("navigation/navigation_model", "rm");
        Template::set("nav_bars", $this->rm->find_all_by("status", "1"));

        //set all access roles...
        //load role model...
        $this->load->model("roles/role_model", "nm");
        $roles = $this->nm->find_all(1);
        $new_role = new stdClass();
        $new_role->role_id = 0;
        $new_role->role_name = "All";
        Template::set("roles", array_merge(array($new_role), $roles));

        Template::set('module_config', $this->module_config);

        //get links according to link_type...

        $link_type = $menu->link_type;
        $selection = $menu->link;
        if ($this->input->post()) {
            $link_type = $this->input->post("link_type");
            $selection = $this->input->post("link");
        }

        if ($link_type != 'other') {
            $links = $this->menu_model->get_links_for_type($link_type, $selection);
            Template::set("links", $links);
        }

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
    private function save_menu($type = 'insert', $id = 0)
    {

        $data = array();

        if ($type == 'update') {
            $_POST['id'] = $id;
        }

//        echo "<br/><br/><br/><br/><br/>";
//                var_dump($_FILES);


        $this->form_validation->set_rules('title', 'Title', 'required|trim|xss_clean|max_length[255]');
        $this->form_validation->set_rules('alias', 'Alias', 'required|trim|xss_clean|max_length[255]');
        $this->form_validation->set_rules('link', 'Link', 'required|trim|xss_clean|max_length[255]');
        $this->form_validation->set_rules('link_type', 'Link Type', 'required|trim|xss_clean|max_length[255]');
        $this->form_validation->set_rules('parent_id', 'Parent', 'trim|xss_clean|integer|max_length[11]');
        $this->form_validation->set_rules('navigation_id', 'Navigation', 'required|max_length[11]');
        $this->form_validation->set_rules('window', 'Target Window', 'required|max_length[1]');
        $this->form_validation->set_rules('access_role_id', 'Access', 'required|callback_access_check');
        $this->form_validation->set_rules('meta_title', 'Meta title', 'trim|xss_clean|max_length[255]');
        $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'trim|xss_clean|max_length[255]');
        $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($_FILES["image_name"]['error'] != 4) {
            $this->form_validation->set_rules('image_name', 'Image', 'callback_req_image');
        }

        if ($this->form_validation->run() === FALSE) {
            return FALSE;
        }

        $delete_image = FALSE;

        //save image file...
        $image_config = $this->module_config['menu_image_file_config'];
        if ($_FILES["image_name"]['error'] != 4) {
            $upload_data = uploadFile('image_name', $image_config);
            if ($upload_data === FALSE) {
                return FALSE;
            }
            $data['image_name'] = $upload_data['file_name'];
            $delete_image = TRUE;
        }

        // make sure we only pass in the fields we want

        $data['title'] = $this->input->post('title');
        $data['alias'] = $this->input->post('alias');
        $data['link'] = $this->input->post('link');
        $data['link_type'] = $this->input->post('link_type');
        $data['parent_id'] = $this->input->post('parent_id');
        $data['navigation_id'] = $this->input->post('navigation_id');
        $data['window'] = $this->input->post('window');
        $data['access_role_id'] = serialize($this->input->post('access_role_id'));
        $data['meta_title'] = $this->input->post('meta_title');
        $data['meta_keyword'] = $this->input->post('meta_keyword');
        $data['meta_description'] = $this->input->post('meta_description');
        $data['status'] = $this->input->post('status');

        if ($type == 'insert') {

            $this->db->select_max("position");
            $query = $this->db->get("menu");
            $pos = array_shift($query->result());
            $data["position"] = $pos->position + 1;

            $id = $this->menu_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            } else {
                $return = FALSE;
            }
        } else if ($type == 'update') {
            $result = $this->menu_model->update($id, $data);
            if ($result) {

                //delete old category file from filesystem...
                $image_to_delete = $this->input->post("image_to_delete");
                if (!empty($image_to_delete) && $delete_image) {
                    delete_file($this->module_config['menu_image_path'] . DIRECTORY_SEPARATOR . $image_to_delete);
                }
            }
            $return = $result;
        }

        return $return;
    }

    public function access_check()
    {
        $access_ids = $this->input->post("access_role_id");
        if ($access_ids) {
            if (!(count($access_ids) > 0)) {
                $this->form_validation->set_message("access_check", "Please specify access role of menu.");
                return FALSE;
            }
            return TRUE;
        }
    }

    public function req_image($str)
    {

        if ($this->input->post("image_name")) {
            if (is_array($str)) {
                $image_config = $this->module_config['menu_image_file_config'];

                $allowed_types = array("image/png", "image/jpg", "image/jpeg", "image/gif");
                $message = check_file($str, $allowed_types, $image_config['max_size']);
                if ($message === TRUE) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('req_image', $message);
                    return FALSE;
                }
            }
        }
        return FALSE;
    }

    public function delete()
    {
        if ($this->input->is_ajax_request()) {

            $id = $this->input->post("id");
            $type = $this->input->post("type");
            $data = array();
            $path = "";

            //find category by id...
            $menu = $this->menu_model->find_menu_by_id($id);

            if ($type == "image") {
                $data["image_name"] = "";
                $path = $this->module_config['menu_image_path'] . DIRECTORY_SEPARATOR . $menu->image_name;
            }

            if ($this->menu_model->set_null_for($id, $data)) {
                if (!empty($path)) {
                    if (delete_file($path)) {
                        $msg = "{$type} successfully deleted";
                        $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => 'success', 'msg' => $msg, 'id' => $id)));
                    }
                }
            }
        } else {
            show_404();
        }
    }

    public function get_links()
    {
        if ($this->input->is_ajax_request()) {
//            var_dump($this->input->post());
            $response = array();
            $type = $this->input->post("link_type");
            $data = $this->menu_model->get_links_for_type($type);
            if ($data) {
                $response['status'] = "success";
                $response['data'] = $data;
                $response['type'] = $type;
                $response['msg'] = "Successfull";
            } else {
                $response['status'] = "success";
                $response['data'] = $data;
                $response['msg'] = "No Links found for {$type}.";
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        }
    }

    //--------------------------------------------------------------------
}
