<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class newsletter extends Front_Controller
{
	// --------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('newsletter_model', null, true);
		$this->lang->load('newsletter');
        $this->load->library('MCAPI'); // mail chimp
	}
	// --------------------------------------------------------------------
	/*
	Method: index()
	Displays a list of form data.
	*/
	public function index()
	{
		Assets::add_module_js('newsletter', 'newsletter.js');
		if ($this->input->post('newsletter'))
		{
			$data = array();
			$data['firstName'] = $this->input->post('firstname') ? $this->input->post('firstname') : '';
			$data['lastName'] = $this->input->post('lastname') ? $this->input->post('lastname') : '';
			$data['emailID'] = $this->input->post('email');
			$data['subscribeDate'] = CurrentMysqlDateTime();
                        
                        $this->form_validation->set_rules('email', 'lang:bf_email', 'required|trim|valid_email|max_length[120]|unique[newsletter.emailID,newsletter.id]|xss_clean');
                        
                    //$email = $this->newsletter_model->find_by('emailID', $data['emailID']);
                    if ($this->form_validation->run($this) === FALSE) {
                         Template::set_message('Email ID Already Exists Please use different Email ID.', 'error');
                         Template::render();
                    }else{

                            // Original:  $id = $this->Newsletter_subscription_model->insert($data);
                            $id = $this->newsletter_model->insert($data);
                            if ($id)
                            {
                                    Template::set_message('Successfully Subscribe For Newsletter');
                                    Template::render();
                            }
                    }									
		}
		else
		{

			$email = $this->input->post('newsletter_emailID');
			Template::set('email', $email);
		}
		Template::render();
		//        $records = $this->newsletter_model->find_all();
		//        Template::set('records', $records);
		//        Template::render();
	}
	// --------------------------------------------------------------------
        
        public function add_news_letter()
	{
            if($this->input->is_ajax_request()){
                
                    if ($this->input->post('newsletter_emailID'))
                    {
                        $data = array();
                        $data['firstName'] = $this->input->post('firstname') ? $this->input->post('firstname') : '';
			$data['lastName'] = $this->input->post('lastname') ? $this->input->post('lastname') : '';
                        $data['emailID'] = $this->input->post('newsletter_emailID');
			$data['subscribeDate'] = CurrentMysqlDateTime();
                        
                        $this->form_validation->set_rules('newsletter_emailID', 'lang:bf_email', 'required|trim|valid_email|max_length[120]|unique[newsletter.emailID,newsletter.id]|xss_clean');
                        $message = array();
                         if ($this->form_validation->run($this) === FALSE) {
                                $message['error'] = 'Email ID Already Exists Please use different Email ID.';
                            }else{

                                    // Original:  $id = $this->Newsletter_subscription_model->insert($data);
                                    $id = $this->newsletter_model->insert($data);
                                    if ($id)
                                    {
                                            $this->mcapi->listSubscribe($this->newsletter_model->ns_listId,$data['emailID']);
                                            $message['success'] = 'Successfully Subscribe For Newsletter';                                         
                                    }
                            }
                            
                        echo json_encode($message);
                        die;
                    }
            }
        }
        
}