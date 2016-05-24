<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class content extends Admin_Controller {

    //--------------------------------------------------------------------


    public function __construct() {
        parent::__construct();

        $this->auth->restrict('Social_Media.Content.View');
        $this->load->model('social_media_model', null, true);
        $this->lang->load('social_media');

        Template::set_block('sub_nav', 'content/_sub_nav');
    }

    //--------------------------------------------------------------------



    /*
      Method: index()

      Displays a list of form data.
     */
    public function index() {
        $result = $this->social_media_model->read($this->input->post());

        if ($this->input->is_ajax_request()) {
            Template::set("ajax", TRUE);
            Template::set('req_data', (isset($result['data']) && !empty($result['data'])) ? $result['data'] : "" );
        } $maxPosition = $this->social_media_model->get_max_position($this->input->post('category'));
        $minPosition = $this->social_media_model->get_min_position($this->input->post('category'));


        Template::set("max_position", (isset($maxPosition) && !empty($maxPosition)) ? $maxPosition : 0 );
        Template::set("min_position", (isset($minPosition) && !empty($minPosition)) ? $minPosition : 0 );
        Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : '' );
        Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : '' );
        Assets::add_js('grid.js');
        Template::set('toolbar_title', 'Manage Social Media');
        Template::render();
    }

    //--------------------------------------------------------------------



    /*
      Method: create()

      Creates a Social Media object.
     */
    public function create() {
        $this->auth->restrict('Social_Media.Content.Create');

        if ($this->input->post('save')) {
            if ($insert_id = $this->save_social_media()) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('social_media_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'social_media');

                Template::set_message(lang('social_media_create_success'), 'success');
                Template::redirect(SITE_AREA . '/content/social_media');
            } else {
                Template::set_message(lang('social_media_create_failure') . $this->social_media_model->error, 'error');
            }
        }
        Assets::add_module_js('social_media', 'social_media.js');

        Template::set('toolbar_title', lang('social_media_create') . ' Social Media');
        Template::render();
    }

    //--------------------------------------------------------------------



    /*
      Method: edit()

      Allows editing of Social Media data.
     */
    public function edit() {
        $id = $this->uri->segment(5);

        if (empty($id)) {
            Template::set_message(lang('social_media_invalid_id'), 'error');
            redirect(SITE_AREA . '/content/social_media');
        }

        if (isset($_POST['save'])) {
            $this->auth->restrict('Social_Media.Content.Edit');

            if ($this->save_social_media('update', $id)) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('social_media_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'social_media');

                Template::set_message(lang('social_media_edit_success'), 'success');
            } else {
                Template::set_message(lang('social_media_edit_failure') . $this->social_media_model->error, 'error');
            }
        } else if (isset($_POST['delete'])) {
            $this->auth->restrict('Social_Media.Content.Delete');

            if ($this->social_media_model->delete($id)) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('social_media_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'social_media');

                Template::set_message(lang('social_media_delete_success'), 'success');

                redirect(SITE_AREA . '/content/social_media');
            } else {
                Template::set_message(lang('social_media_delete_failure') . $this->social_media_model->error, 'error');
            }
        }
        Template::set('social_media', $this->social_media_model->find($id));
        Assets::add_module_js('social_media', 'social_media.js');

        Template::set('toolbar_title', lang('social_media_edit') . ' Social Media');
        Template::render();
    }

    //--------------------------------------------------------------------
    //--------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------

    /*
      Method: save_social_media()

      Does the actual validation and saving of form data.

      Parameters:
      $type	- Either "insert" or "update"
      $id		- The ID of the record to update. Not needed for inserts.

      Returns:
      An INT id for successful inserts. If updating, returns TRUE on success.
      Otherwise, returns FALSE.
     */
    private function save_social_media($type = 'insert', $id = 0) {

        $return = '';
        if ($type == 'update') {
            $_POST['id'] = $id;
        }


        $this->form_validation->set_rules('label', 'Label', 'required|max_length[100]');
        $this->form_validation->set_rules('link', 'Link', 'required|max_length[255]');
        //$this->form_validation->set_rules('image','Image','required|max_length[200]');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() === FALSE) {
            return FALSE;
        }

        // make sure we only pass in the fields we want

        $data = array();
        $data['label'] = $this->input->post('label');
        $data['link'] = $this->input->post('link');
        //$data['image']        = $this->input->post('image');
        $data['status'] = $this->input->post('status');

        if ($type == 'insert') {

            $this->db->select_max("position");
            $query = $this->db->get("social_media");
            $pos = array_shift($query->result());
            $data["position"] = $pos->position + 1;

            $imagedata = $this->socialmediaImage();
            if (!empty($imagedata['upload_data']['file_name'])) {
                $data['image'] = $imagedata['upload_data']['file_name'];
                $id = $this->social_media_model->insert($data);
            } else {
                //$errormessage=  array_shift($imagedata);  
                //  Template::set('$message',$errormessage);
                $message = array_shift($imagedata);
                Template::set('check', $message);
                //  return FALSE;
            }
            //var_dump($imagedata);
            // die;


            if (is_numeric($id)) {
                $return = $id;
            } else {
                $return = FALSE;
            }
        } else if ($type == 'update') {

            $query = $this->db->get_where('social_media', array('id' => $id));
            $result = array_shift($query->result());


            $imagedata = $this->socialmediaImage();
            // var_dump($imagedata);die;
            if (!empty($imagedata)) {

                if (!empty($imagedata['upload_data']['file_name'])) {
                    $data['image'] = $imagedata['upload_data']['file_name'];
                    $return = $this->social_media_model->update($id, $data);
                     $path = FCPATH . "assets/uploads/socialmedia/" . $result->image;
                    array_map("unlink", glob($path));
                   
                    // unlink($path);
                } else {
                    $message = array_shift($imagedata);
                    Template::set('check', $message);
                }
            } else {
                $return = $this->social_media_model->update($id, $data);
            }
        }

        return $return;
    }

    //--------------------------------------------------------------------
    public function socialmediaImage() {
        $config['upload_path'] = FCPATH . 'assets/uploads/socialmedia';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '6000';
        $config['max_width'] = '27';
        $config['max_width'] = '27';
        $config['overwrite'] = FALSE;
        //   var_dump($this->input->post('image'));die;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library('upload', $config);

        if ($_POST['image']['name'] != '' && $_POST['image']['error'] != 4) {
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                return $error;
            } else {
                $data = array('upload_data' => $this->upload->data());
                return $data;
            }
        }
    }

}