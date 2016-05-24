<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class content extends Admin_Controller
{

    //--------------------------------------------------------------------

    public $module_config = array();

    public function __construct()
    {
        parent::__construct();

        //load module specific stuff...
        $this->auth->restrict('Category.Content.View');
        $this->load->model('category_model', null, true);
        $this->module_config = module_config('category');
        $this->lang->load('category');

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
        $result = $this->category_model->read($this->input->post());

        if ($this->input->is_ajax_request()) {
            Template::set("ajax", TRUE);
            Template::set('req_data', (isset($result['data']) && !empty($result['data'])) ? $result['data'] : "");
        }

        Assets::add_js('grid.js');

        Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '');
        Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '');
        Template::set('toolbar_title', 'Manage Category');
        Template::set('module_config', $this->module_config);
        Template::set_view("category/content/index");
        Template::render();
    }

    //--------------------------------------------------------------------


    /*
      Method: create()

      Creates a Category object.
     */
    public function create()
    {
        $this->auth->restrict('Category.Content.Create');

        if ($this->input->post('save')) {
            if ($insert_id = $this->save_category()) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('category_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'category');

                Template::set_message(lang('category_create_success'), 'success');
                Template::redirect(SITE_AREA . '/content/category');
            } else {
                Template::set_message(lang('category_create_failure') . $this->category_model->error, 'error');
            }
        }
        Assets::add_module_js('category', 'category.js');

        Template::set('toolbar_title', lang('category_create') . ' Category');
        Template::set('categories', $this->category_model->find_all_category());
        Template::render();
    }

    //--------------------------------------------------------------------


    /*
      Method: edit()

      Allows editing of Category data.
     */
    public function edit()
    {
        $id = $this->uri->segment(5);

        if (empty($id)) {
            Template::set_message(lang('category_invalid_id'), 'error');
            redirect(SITE_AREA . '/content/category');
        }

        if (isset($_POST['save'])) {
            $this->auth->restrict('Category.Content.Edit');

            if ($this->save_category('update', $id)) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('category_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'category');

                Template::set_message(lang('category_edit_success'), 'success');
            } else {
                Template::set_message(lang('category_edit_failure') . $this->category_model->error, 'error');
            }
        } else if (isset($_POST['delete'])) {
            $this->auth->restrict('Category.Content.Delete');

            if ($this->category_model->delete($id)) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('category_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'category');

                Template::set_message(lang('category_delete_success'), 'success');

                redirect(SITE_AREA . '/content/category');
            } else {
                Template::set_message(lang('category_delete_failure') . $this->category_model->error, 'error');
            }
        }
        Template::set('category', $this->category_model->find($id));
        Assets::add_module_js('category', 'category.js');

        Template::set('toolbar_title', lang('category_edit') . ' Category');
        Template::set('module_config', $this->module_config);
        Template::set('categories', $this->category_model->find_all_category());
        Template::render();
    }

    //--------------------------------------------------------------------
    //--------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------

    /*
      Method: save_category()

      Does the actual validation and saving of form data.

      Parameters:
      $type	- Either "insert" or "update"
      $id		- The ID of the record to update. Not needed for inserts.

      Returns:
      An INT id for successful inserts. If updating, returns TRUE on success.
      Otherwise, returns FALSE.
     */
    private function save_category($type = 'insert', $id = 0)
    {

        $data = array();

        if ($type == 'update') {
            $_POST['ID'] = $id;
        }


        $this->form_validation->set_rules('category_title', 'Category Title', 'required|trim|xss_clean|max_length[255]');
        $this->form_validation->set_rules('category_slug', 'Category Slug', 'required|trim|xss_clean|max_length[255]');
        $this->form_validation->set_rules('category_description', 'Category Description', 'trim|xss_clean');
        $this->form_validation->set_rules('category_status', 'Status', 'required|trim|xss_clean|is_numeric|max_length[1]');
        $this->form_validation->set_rules('category_parent_id', 'Category Parent', 'required|trim|xss_clean|max_length[11]');

        if ($_FILES["category_image"]['error'] != 4) {
            $this->form_validation->set_rules('category_image', 'Image', 'callback_req_image');
        }

        if ($_FILES["category_banner"]['error'] != 4) {
            $this->form_validation->set_rules('category_banner', 'Image', 'callback_req_banner');
        }

        if ($_FILES["category_video"]['error'] != 4) {
            $this->form_validation->set_rules('category_video', 'Video', 'callback_req_video');
        }

        if ($this->form_validation->run($this) === FALSE) {
            return FALSE;
        }

        //define upload path...

        $delete_image = FALSE;
        $delete_banner = FALSE;
        $delete_video = FALSE;

        //save image file...
        $image_config = $this->module_config['category_image_file_config'];
        if ($_FILES["category_image"]['error'] != 4) {
            $upload_data = uploadFile('category_image', $image_config);
            if ($upload_data === FALSE) {
                return FALSE;
            }
            $data['category_image'] = $upload_data['file_name'];
            $delete_image = TRUE;
        }

        //save video file...
        $video_config = $this->module_config['category_video_file_config'];
        if ($_FILES["category_video"]['error'] != 4) {
            $upload_data = uploadFile('category_video', $video_config);
            if ($upload_data === FALSE) {
                return FALSE;
            }
            $data['category_video'] = $upload_data['file_name'];
            $delete_video = TRUE;
        }

        //Save Banner Category
        $banner_config = $this->module_config['category_banner_file_config'];
        if ($_FILES["category_banner"]['error'] != 4) {
            $upload_data = uploadFile('category_banner', $banner_config);
            if ($upload_data === FALSE) {
                return FALSE;
            }
            $data['category_banner'] = $upload_data['file_name'];
            $delete_banner = TRUE;
        }


        // make sure we only pass in the fields we want
        $data['category_title'] = $this->input->post('category_title');
        $data['category_slug'] = $this->input->post('category_slug');
        $data['category_description'] = $this->input->post('category_description');
        $data['category_status'] = $this->input->post('category_status');
        $data['category_parent_id'] = $this->input->post('category_parent_id');

        if ($type == 'insert') {
            $id = $this->category_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            } else {
                $return = FALSE;
            }
        } else if ($type == 'update') {
            $result = $this->category_model->update($id, $data);
            if ($result) {
                //delete old category file from filesystem...
                $image_to_delete = $this->input->post("image_to_delete");
                if (!empty($image_to_delete) && $delete_image) {
                    delete_file($this->module_config['category_image_path'] . DIRECTORY_SEPARATOR . $image_to_delete);
                }

                //delete old video file from filesystem...
                $video_to_delete = $this->input->post("video_to_delete");
                if (!empty($video_to_delete) && $delete_video) {
                    delete_file($this->module_config['category_video_path'] . DIRECTORY_SEPARATOR . $video_to_delete);
                }

                //delete old category banner file From Filesystem...
                $banner_to_delete = $this->input->post("banner_to_delete");
                if (!empty($banner_to_delete) && $delete_banner) {
                    delete_file($this->module_config['category_banner_path'] . DIRECTORY_SEPARATOR . $banner_to_delete);
                }
            }
            $return = $result;
        }

        return $return;
    }

    public function req_image($str)
    {

        if ($this->input->post("category_image")) {
            if (is_array($str)) {
                $image_config = $this->module_config['category_image_file_config'];

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

    public function req_banner($str)
    {
        if ($this->input->post("category_image")) {
            if (is_array($str)) {
                $banner_config = $this->module_config['category_banner_file_config'];

                $allowed_types = array("image/png", "image/jpg", "image/jpeg", "image/gif");
                $message = check_file($str, $allowed_types, $banner_config['max_size']);
                if ($message === TRUE) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('req_banner', $message);
                    return FALSE;
                }
            }
        }
        return FALSE;
    }

    public function req_video($str)
    {

        if ($this->input->post("category_banner")) {
            if (is_array($str)) {
                $allowed_types = array("video/mp4", "application/x-shockwave-flash");
                $video_config = $this->module_config['category_video_file_config'];

                $message = check_file($str, $allowed_types, $video_config['max_size']);
                if ($message === TRUE) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('req_video', $message);
                    return FALSE;
                }
            }
        }
        return FALSE;
    }

    public function download_file($file_name, $type, $file_type)
    {
        if (!empty($file_name) && !empty($type) && !empty($file_type)) {
            //load helper...
            $this->load->helper('download');
            $path = "";

            if ($file_type == "image") {
                $path = $this->module_config['category_image_path'] . DIRECTORY_SEPARATOR . $file_name;
            } elseif ($file_type == "video") {
                $path = $this->module_config['category_video_path'] . DIRECTORY_SEPARATOR . $file_name;
            }

            download_file($file_name, $path);
        } else {
            show_404();
        }
    }

    public function delete()
    {
        if ($this->input->is_ajax_request()) {

            $id = $this->input->post("id");
            $type = $this->input->post("type");
            $data = array();
            $path = "";
var_dump($id);
            //find category by id...
            $category = $this->category_model->find_category_by_id($id);

            if ($type == "image") {
                $data["category_image"] = "";
                $path = $this->module_config['category_image_path'] . DIRECTORY_SEPARATOR . $category->category_image;
            } else if ($type == "video") {
                $data["category_video"] = "";
                $path = $this->module_config['category_video_path'] . DIRECTORY_SEPARATOR . $category->category_video;
            } else if ($type == 'banner') {
                $data["category_banner"] = "";
                $path = $this->module_config['category_banner_path'] . DIRECTORY_SEPARATOR . $category->category_banner;
            }

            if ($this->category_model->set_null_for($id, $data)) {
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

    //--------------------------------------------------------------------
}
