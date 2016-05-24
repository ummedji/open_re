<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class content extends Admin_Controller
{

    //--------------------------------------------------------------------


    public function __construct()
    {
        parent::__construct();

        $this->auth->restrict('Banner.Content.View');
        $this->load->model('banner_model', null, true);
        $this->lang->load('banner');

       // Assets::add_js(Template::theme_url('js/editors/ckeditor/ckeditor.js'));
        Template::set_block('sub_nav', 'content/_sub_nav');
    }

    //--------------------------------------------------------------------


    /*
      Method: index()

      Displays a list of form data.
     */
    public function index()
    {
        $result = $this->banner_model->read($this->input->post());

        if ($this->input->is_ajax_request()) {
            Template::set("ajax", TRUE);
            Template::set('req_data', (isset($result['data']) && !empty($result['data'])) ? $result['data'] : "");
        }
        $maxPosition = $this->banner_model->get_max_position($this->input->post('category'));
        $minPosition = $this->banner_model->get_min_position($this->input->post('category'));


        Template::set("max_position", (isset($maxPosition) && !empty($maxPosition)) ? $maxPosition : 0);
        Template::set("min_position", (isset($minPosition) && !empty($minPosition)) ? $minPosition : 0);
        Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '');
        Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '');
        Assets::add_js('grid.js');
        Template::set('toolbar_title', 'Manage Banner');
        Template::render();
    }

    //--------------------------------------------------------------------


    /*
      Method: create()

      Creates a Banner object.
     */
    public function create()
    {
        $this->auth->restrict('Banner.Content.Create');

        if ($this->input->post('save')) {
            if ($insert_id = $this->save_banner()) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('banner_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'banner');

                Template::set_message(lang('banner_create_success'), 'success');
                Template::redirect(SITE_AREA . '/content/banner');
            } else {
                Template::set_message(lang('banner_create_failure') . $this->banner_model->error, 'error');
            }
        }
        Assets::add_module_js('banner', 'banner.js');
        Assets::add_module_css('banner', 'errormessage.css');


        Template::set('toolbar_title', lang('banner_create') . ' Banner');
        Template::render();
    }

    //--------------------------------------------------------------------


    /*
      Method: edit()

      Allows editing of Banner data.
     */
    public function edit()
    {
        $id = $this->uri->segment(5);

        if (empty($id)) {
            Template::set_message(lang('banner_invalid_id'), 'error');
            redirect(SITE_AREA . '/content/banner');
        }

        if (isset($_POST['save'])) {
            $this->auth->restrict('Banner.Content.Edit');

            if ($this->save_banner('update', $id)) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('banner_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'banner');

                Template::set_message(lang('banner_edit_success'), 'success');
            } else {
                Template::set_message(lang('banner_edit_failure') . $this->banner_model->error, 'error');
            }
        } else if (isset($_POST['delete'])) {
            $this->auth->restrict('Banner.Content.Delete');

            if ($this->banner_model->delete($id)) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('banner_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'banner');

                Template::set_message(lang('banner_delete_success'), 'success');

                redirect(SITE_AREA . '/content/banner');
            } else {
                Template::set_message(lang('banner_delete_failure') . $this->banner_model->error, 'error');
            }
        }
        Template::set('banner', $this->banner_model->find($id));
        Assets::add_module_js('banner', 'banner.js');
        Assets::add_module_css('banner', 'errormessage.css');

        Template::set('toolbar_title', lang('banner_edit') . ' Banner');
        Template::render();
    }

    //--------------------------------------------------------------------
    //--------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------

    /*
      Method: save_banner()

      Does the actual validation and saving of form data.

      Parameters:
      $type	- Either "insert" or "update"
      $id		- The ID of the record to update. Not needed for inserts.

      Returns:
      An INT id for successful inserts. If updating, returns TRUE on success.
      Otherwise, returns FALSE.
     */
    private function save_banner($type = 'insert', $id = 0)
    {
        $return = '';
        if ($type == 'update') {
            $_POST['id'] = $id;
        }


        $this->form_validation->set_rules('description', 'Description', 'required');
        //$this->form_validation->set_rules('image','Image','required|max_length[200]');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() === FALSE) {
            return FALSE;
        }

        // make sure we only pass in the fields we want

        $data = array();
        $data['description'] = $this->input->post('description');
        // $data['image'] = $this->input->post('image');
        $data['status'] = $this->input->post('status');

        if ($type == 'insert') {

            $this->db->select_max("position");
            $query = $this->db->get("banner");
            $pos = array_shift($query->result());
            $data["position"] = $pos->position + 1;
            $bannerimage = $this->bannerimageUpload();

            if (!empty($bannerimage)) {
                if (!empty($bannerimage['file_name'])) {
                    $data['image'] = $bannerimage['file_name'];
                    $id = $this->banner_model->insert($data);
                } else {
                    $message = $bannerimage['error'];
                    Template::set('message', $message);
                }
            }

            if (is_numeric($id)) {
                $return = $id;
            } else {
                $return = FALSE;
            }
        } else if ($type == 'update') {

            $bannerimage = $this->bannerimageUpload();

            if (!empty($bannerimage)) {
                if (!empty($bannerimage['file_name'])) {
                    $data['image'] = $bannerimage['file_name'];
                    $query = $this->db->get_where('banner', array('id' => $id));
                    $result = array_shift($query->result());
                    $originalPath = FCPATH . "assets/uploads/banner/original/" . $result->image;
                    $resizePath = FCPATH . "assets/uploads/banner/" . $result->image;

                    array_map("unlink", glob($originalPath));
                    array_map("unlink", glob($resizePath));

                    $return = $this->banner_model->update($id, $data);
                } else {
                    $message = $bannerimage['error'];
                    Template::set('message', $message);
                }
            } else {
                $return = $this->banner_model->update($id, $data);
            }
        }

        return $return;
    }

    //--------------------------------------------------------------------

    public function bannerimageUpload()
    {

        $config['upload_path'] = FCPATH . 'assets/uploads/banner/original';//file upload path
        $config['allowed_types'] = 'gif|jpg|png|jpeg';//file type allowed
        $config['file_name'] = $_POST['image']['name'];
        //not overwrite image for below code
        $config['overwrite'] = FALSE;
        $config['max_size'] = '6000';//max file size for upload

        $this->load->library('upload', $config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }

        if (!empty($_POST['image']['name']) && $_POST['image']['error'] != 4) {

            if (!$this->upload->do_upload('image')) {

                $error = array('error' => $this->upload->display_errors());

                return $error;
            } else {
                $upload_data = $this->upload->data();

                $config["image_library"] = "gd2";
                $config["source_image"] = $upload_data["full_path"];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                //image resize and upload in below path
                $config['new_image'] = FCPATH . 'assets/uploads/banner/' . $upload_data['file_name'];
                $config['quality'] = "100%";
                //Here Set Width and height for image resize
                $config['width'] = 400;
                $config['height'] = 300;
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