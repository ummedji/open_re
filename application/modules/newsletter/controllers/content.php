<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class content extends Admin_Controller {

    //--------------------------------------------------------------------





    public function __construct() {

        parent::__construct();

        $this->auth->restrict('Newsletter.Content.View');

        $this->load->model('newsletter_model', null, true);

        $this->load->model('newsletter_mail_model', null, true);

        $this->load->library('MCAPI'); // mail chimp
        $this->load->helper('cust_datetime');

        $this->lang->load('newsletter');
        Assets::clear_cache();
        Assets::add_module_js('newsletter', 'newsletter.js');
        Assets::add_module_js('newsletter', 'newsletter_ajx.js');
        Assets::add_module_js('newsletter', 'nsltr_pagin.js');

        Assets::add_module_css('newsletter', 'newsletter.css');

        //Assets::add_js('js/ckeditor/ckeditor.js');

        Template::set_block('sub_nav', 'content/_sub_nav');
    }

    //--------------------------------------------------------------------

    public function export_newsletter_subscriber() {
        //  var_dump( $this->session->userdata('pat_filter_where'));die;

        $prefix = $this->db->dbprefix;
        if (stristr($this->session->userdata('pat_filter_where'), 'where')) {

            list($where, $query_limit) = @explode("where", strtolower($this->session->userdata('pat_filter_where')));

            list($limit_remove, $query_limit) = @explode("limit", strtolower($query_limit));

            $query = "SELECT ID,firstName AS `First Name`,lastName AS `Last Name`,emailID AS `Email`,subscribeDate AS `Subscribe Date` FROM " . $prefix . "newsletter WHERE " . $limit_remove;
        } else {
            $query = "SELECT ID,firstName AS `First Name`,lastName AS `Last Name`,emailID AS `Email`,subscribeDate AS `Subscribe Date` FROM " . $prefix . "newsletter ORDER BY ID DESC ";
        }

//  echo $query;exit;

        $q = $this->db->query($query);

        if ($q->num_rows() > 0) {
            $users = $q;
        } else {
            $users = $q;
        }
        //   var_dump($users);die; 

        $this->load->dbutil();
        $delimiter = ",";
        $newline = "\r\n";
        $this->output->set_header('Content-Type: application/force-download');
        $this->output->set_header('Content-Disposition: attachment; filename="NewsletterSubscriber_List.csv"');

        $this->output->set_content_type('text/csv')->set_output($this->dbutil->csv_from_result((object) $users, $delimiter, $newline));
    }

    /*

      Method: index()



      Displays a list of form data.

     */

    public function index() {


        if ($this->input->is_ajax_request()) {

            $output = "";

            $data = $this->newsletter_model->read($this->input->get());

            //Set query in session :chiragprajapati
            $this->session->set_userdata('pat_filter_where', strtolower($this->db->last_query()));
            //var_dump($result);die;

            if ($data !== FALSE) {

                foreach ($data['result'] as $record) {

                    $output .= "<tr>";

                    $output .= "<td><input type=\"checkbox\" name=\"checked[]\" value=\"{$record->ID}\"></td>";

                    $output .= "<td class='text-center'>" . $record->firstName . "</td>";

                    $output .= "<td class='text-center'>" . $record->lastName . "</td>";

                    $output .= "<td class='text-center'>" . $record->emailID . "</td>";
                    $output .= "<td class='text-center'>" . date("m/d/Y H:i", strtotime($record->subscribeDate)) . "</td>";

                    $subscribers = $this->onMailChimp($record->emailID);

                    if(isset($subscribers['success']) && ($subscribers['success']==1)) {
                        $output .= "<td class='text-center'>Yes</td>";
                    }
                    else
                    {
                        $output .= "<td class='text-center'>No</td>";
                    }

                    if(isset($subscribers[data][0][status]) && ($subscribers[data][0][status]=='subscribed')) {
                        $output .= "<td class='text-center'>Yes</td>";
                    }
                    else
                    {
                        $output .= "<td class='text-center'>No</td>";
                    }
                }

                $result = array("result" => $output, "pagination" => $data['pagination'], "data" => $data['data']);

                if (isset($data['message']) && !empty($data['message'])) {

                    $result['message'] = $data['message'];
                }

                echo json_encode($result);
            } else {

                $data = array("data" => $this->newsletter_model->getArrayOfData());

                echo json_encode($data);
            }

            die();
        } else {

            $result = $data = $this->newsletter_model->read($this->input->get());
            //Set query in session :chiragprajapati
            $this->session->set_userdata('pat_filter_where', strtolower($this->db->last_query()));
            //  var_dump($result);die;

            Template::set('records', (isset($result['result']) && !empty($result['result'])) ? $result['result'] : "" );
            Template::set('MCobj',$this);
            Template::set('pagination', (isset($result['pagination']) && !empty($result['pagination'])) ? $result['pagination'] : "" );

            Template::set('toolbar_title', 'Manage Newsletter');

            Template::render();
        }



        // Deleting anything?
//		if (isset($_POST['delete']))
//		{
//			$checked = $this->input->post('checked');
//
//			if (is_array($checked) && count($checked))
//			{
//				$result = FALSE;
//				foreach ($checked as $pid)
//				{
//					$result = $this->newsletter_model->delete($pid);
//				}
//
//				if ($result)
//				{
//					Template::set_message(count($checked) .' '. lang('newsletter_delete_success'), 'success');
//				}
//				else
//				{
//					Template::set_message(lang('newsletter_delete_failure') . $this->newsletter_model->error, 'error');
//				}
//			}
//		}
//
//		$records = $this->newsletter_model->find_all();
//
//		Template::set('records', $records);
//		Template::set('toolbar_title', 'Manage Newsletter');
//		Template::render();
    }

    //--------------------------------------------------------------------

    public function onMailChimp($email_id)
    {
        $result = $this->mcapi->listMemberInfo($this->newsletter_model->ns_listId,$email_id);
        return $result;
    }

    public function addToMailChimp($email_id)
    {
        return $this->mcapi->listSubscribe($this->newsletter_model->ns_listId, $email_id);
    }

    public function show_report()
    {
        $result = $this->mcapi->campaigns();

        Template::set('toolbar_title',' Report');
        Template::set('result', $result);
        Template::set_view('content/show_reports');
        Template::render();
    }

    public function show_campaign_report($cid)
    {
        $result = $this->mcapi->campaignOpenedAIM($cid);
        echo "<pre>";
        print_r($result);
        die;
    }

    public function campaignStats($cid)
    {
        $result = $this->mcapi->campaignStats($cid);
        //echo "<pre>";
        //print_r($result); exit;
        Template::set('toolbar_title',' Statistics');
        Template::set('result', $result);
        Template::set('cid', $cid);
        //Template::set_block('report_nav', 'content/report_nav');
        Template::set_view('content/campaign_stats');
        Template::render();

    }


    public function clickDetail($cid)
    {
        $result = $this->mcapi->campaignClickStats($cid);
        $click_result = array();
        $output = '';
        $output .= '<table  id="data" class="table table-striped" align="center">';
        foreach($result as $key=>$value)
        {

            $output .= '<thead>';
            if(isset($key) && !empty($key))
            {
                $click_result = $this->mcapi->campaignClickDetailAIM($cid,$key);
                //print_r($click_result);
                //var_dump($click_result);
                if (isset($click_result['data']) && is_array($click_result['data']) && count($click_result['data']))
                {
                $output .= '<tr>
                        <th colspan="6">Clicked URL : '.$key.'</th>
                        </tr>';



               //print_r($click_result);

                $output .= '<tr>
                <th>#</th>
                <th>Email</th>
                <th>Click Count</th>
                </tr>';
                $output .= '</thead>';
                $output .= '<tbody>';

                    foreach($click_result as $rdata)
                    {
                        if(count($rdata)>0 && is_array($rdata)){
                            foreach($rdata as $k => $data){
                                $output .= '<tr align="center">
                                <td>'.($k+1).'</td>
                                <td>'.$data[email].'</td>
                                <td>'.$data[clicks].'</td>
                                </tr>';
                            }
                        }
                    }
                }
            }

        }

        $output .= '</tbody>';
        $output .= '</table>';

        echo $output;
        exit;
    }

    public function camp_who_opened($cid)
    {
        $result = $this->mcapi->campaignOpenedAIM($cid);

        // sort array
        usort($result[data], function($a, $b) {
            return $b['open_count'] - $a['open_count'];
        });

        $output = '';
        $output .= '<table  id="data" class="table table-striped" align="center">';
        $output .= '<thead>';
        $output .= '<tr>
                    <th colspan="6">Total Subscribers Who Opened this Campaign : '.$result[total].'</th>
        </tr>';

        $output .= '<tr>
            <th>#</th>
            <th>Email</th>
            <th>Open Count</th>
        </tr>';
        $output .= '</thead>';
        $output .= '<tbody>';
        if (isset($result) && is_array($result) && count($result))
        {
            for($i=0; $i<$result['total'];$i++)
            {
            $data = $result[data][$i];
            //$cid = $data[id];

            $output .= '<tr align="center">
                <td>'.($i+1).'</td>
                <td>'.$data[email].'</td>
                <td>'.$data[open_count].'</td>
            </tr>';

            }
        }
        $output .= '</tbody>';
        $output .= '</table>';

        echo $output;
        exit;
        //echo "<pre>";
        //print_r($result); exit;
        //Template::set('toolbar_title',' Campaign Opened List');
        //Template::set('result', $result);
        //Template::set_view('content/camp_who_opened');
        //Template::render();
    }

    public function CpUnsubscribes($cid)
    {
        $result = $this->mcapi->campaignUnsubscribes($cid);
        //echo "<pre>";
        //print_r($result);
        //exit;

        $output = '';
        $output .= '<table  class="table table-striped" align="center">';
        $output .= '<tr>
            <th>#</th>
            <th>Email</th>
        </tr>';

        if (isset($result) && is_array($result) && count($result))
        {
            for($i=0; $i<$result['total'];$i++)
            {
                $data = $result[data][$i];
                $output .= '<tr align="center">
                <td>'.($i+1).'</td>
                <td>'.$data[email].'</td>
            </tr>';

            }
        }

        $output .= '</table>';

        echo $output;
        exit;
    }

    public function hardBounce($cid)
    {
        $result = $this->mcapi->campaignHardBounces($cid);

        $output = '';
        $output .= '<table  class="table table-striped" align="center">';
        $output .= '<tr>
            <th>#</th>
            <th>Email</th>
        </tr>';

        if (isset($result) && is_array($result) && count($result))
        {
            for($i=0; $i<$result['total'];$i++)
            {
                $data = $result['data'][$i];

                $output .= '<tr align="center">
                <td>'.($i+1).'</td>
                <td>'.$data.'</td>
            </tr>';

            }
        }

        $output .= '</table>';

        echo $output;
        exit;
    }

    public function SoftBounces($cid)
    {

        $result = $this->mcapi->campaignSoftBounces($cid);

        $output = '';
        $output .= '<table  class="table table-striped" align="center">';
        $output .= '<tr>
            <th>#</th>
            <th>Email</th>
        </tr>';

        if (isset($result) && is_array($result) && count($result))
        {
            for($i=0; $i<$result['total'];$i++)
            {
                $data = $result[data][$i];

                $output .= '<tr align="center">
                <td>'.($i+1).'</td>
                <td>'.$data.'</td>

            </tr>';

            }
        }

        $output .= '</table>';

        echo $output;
        exit;
    }

    public function campaignContent($cid)
    {
        $result = $this->mcapi->campaignContent($cid);
        echo $result['html'];
        exit;
    }
//////////////////////////////////////////////////////
    /*

      Method: create()



      Creates a Newsletter object.

     */

    public function create($id = 0) {
        $this->auth->restrict('Newsletter.Content.Create');        
        
        $templates = $this->newsletter_mail_model->getNewsTemplates();
        Template::set('newstemplates',$templates);
        
        if ($this->input->post('sendMail')) {
            $this->newsletter_subscriptionEmail();
            if (isset($this->email_sent)) {
                Template::set_message('Mail successfully sent!', 'success');
                Template::redirect(SITE_AREA . '/content/newsletter');
            }
        }

        if ($this->input->post('save')) {
            $success = false;
            if($this->input->post('newsTemplate') > 0){
                $template_id = $this->input->post('newsTemplate');
                if($this->save_newsletter('update',$template_id)){
                    $success = true;
                    $action = 'edit';
                }
            }else{
                $template_id = $this->input->post('newsTemplate');
                if($insert_id = $this->save_newsletter()){
                    $success = true;
                    $action = 'create';
                }
            }
                
            if ($success) {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('newsletter_act_'.$action.'_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'newsletter');
                Template::set_message(lang('newsletter_'.$action.'_success'), 'success');
                if($action == 'edit'){                   
                    Template::redirect(SITE_AREA . '/content/newsletter/create/'.$template_id);
                }else{
                    Template::redirect(SITE_AREA . '/content/newsletter/create');
                }
                
            } else {

                Template::set_message(lang('newsletter_'.$action.'_failure') . $this->newsletter_model->error, 'error');
            }
        }
        
        Assets::add_module_js('newsletter', 'newsletter.js');
        
        if($id > 0){
            Template::set('news_letter', $this->newsletter_mail_model->find($id));
        }
        $action='create';
        Template::set('toolbar_title', lang('newsletter_'.$action) . ' Newsletter');

        Template::render();
    }

    //--------------------------------------------------------------------







    /*

      Method: edit()



      Allows editing of Newsletter data.

     */

    public function edit() {

        $id = $this->uri->segment(5);



        if (empty($id)) {

            Template::set_message(lang('newsletter_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/newsletter');
        }



        if (isset($_POST['save'])) {

            $this->auth->restrict('Newsletter.Content.Edit');



            if ($this->save_newsletter('update', $id)) {

                // Log the activity

                $this->activity_model->log_activity($this->current_user->id, lang('newsletter_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'newsletter');



                Template::set_message(lang('newsletter_edit_success'), 'success');
            } else {

                Template::set_message(lang('newsletter_edit_failure') . $this->newsletter_model->error, 'error');
            }
        } else if (isset($_POST['delete'])) {

            $this->auth->restrict('Newsletter.Content.Delete');



            if ($this->newsletter_model->delete($id)) {

                // Log the activity

                $this->activity_model->log_activity($this->current_user->id, lang('newsletter_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'newsletter');



                Template::set_message(lang('newsletter_delete_success'), 'success');



                redirect(SITE_AREA . '/content/newsletter');
            } else {

                Template::set_message(lang('newsletter_delete_failure') . $this->newsletter_model->error, 'error');
            }
        }

        Template::set('newsletter', $this->newsletter_model->find($id));

        Assets::add_module_js('newsletter', 'newsletter.js');



        Template::set('toolbar_title', lang('newsletter_edit') . ' Newsletter');

        Template::render();
    }

    //--------------------------------------------------------------------
    //--------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------



    /*

      Method: save_newsletter()



      Does the actual validation and saving of form data.



      Parameters:

      $type	- Either "insert" or "update"

      $id		- The ID of the record to update. Not needed for inserts.



      Returns:

      An INT id for successful inserts. If updating, returns TRUE on success.

      Otherwise, returns FALSE.

     */

    private function save_newsletter($type = 'insert', $id = 0, $arr_id = '') {

        //var_dump($arr_id);die;
        if ($type == 'update') {

            $_POST['ID'] = $id;
        }


        $this->form_validation->set_rules('title', 'Title', 'required|max_length[255]');
        $this->form_validation->set_rules('content', 'Content', 'required');



        if ($this->form_validation->run() === FALSE) {

            return FALSE;
        }



        // make sure we only pass in the fields we want



        $data = array();
        $data['title'] = $this->input->post('title');
        $data['content'] = $this->input->post('content');
        $data['created_on'] = date('Y-m-d H:i:s');

//        var_dump($email_id);
//        var_dump($data);die;

        if ($type == 'insert') {

            //  var_dump($data);die;

            $id = $this->newsletter_mail_model->insert($data);


            if (is_numeric($id)) {

                $return = $id;
            } else {

                $return = FALSE;
            }
        } else if ($type == 'update') {
            
            $return = $this->newsletter_mail_model->update($id, $data);
        }

        /* Sending Mail to selected users */

        return $return;
    }

    public function sendEmail(array $to, $subject, $content, $emailid,$template_id) {

        //var_dump($to);die;
        $data['title'] = $subject;
        $data['content'] = $content;
        $data['created_on'] = date('Y-m-d H:i:s');
        $data['send_subscriber'] = serialize($emailid);
        
        //         var_dump($data);
//         die;
        if($template_id == 0){
            $this->newsletter_mail_model->insert($data);
        }else{
            $this->newsletter_mail_model->update($template_id,$data);
        }
        
        //    $this->load->model('newsletter/newslettermodel')
        //      $id = $this->newsletter_mail_model->insert($data);
//         var_dump($subject);
//         var_dump($content);
//
//         var_dump($emailid);die;
//                        

        $this->load->library('emailer/emailer');

        // var_dump($to);die;
        // $t=  implode(',', $to);
        foreach ($to as $t) {
            $data = array(
                "subject" => $subject,
                "message" => $content,
                "to" => $t
            );

            //  var_dump($data);die;
            $is_send = $this->emailer->send($data);
        }
        if ($is_send) {
            $this->email_sent = TRUE;
        } else {
            $this->email_sent = FALSE;
        }
    }

    public function get_user_roles() {
        if ($this->input->is_ajax_request()) {
            // var_dump('check');die;
            $this->load->model('roles/role_model');
            Template::set('roles', $this->role_model->where('deleted', 0)->find_all());
            Template::render();
        } else {
            Template::redirect('admin');
        }
    }

    public function get_all_users() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('newsletter/newsletter_model');
            if (isset($_GET['keyword'])) {
                // var_dump('aaca');die;
                $keyword = $this->db->escape_like_str($this->input->get('keyword'));
                Template::set('keyword', $keyword);
                Template::set('users', $this->newsletter_model->getUsers(array(
                            $keyword . '%'
                )));
            } else {
                /// var_dump('ca');die;
                Template::set('users', $this->newsletter_model->getUsers(array('%')));
            }
            Template::render();
        } else {
            Template::redirect('admin');
        }
    }

    public function get_subscriber_user() {
        if ($this->input->is_ajax_request()) {
            //var_dump('check');die;
            $this->load->model('newsletter/newsletter_model');
            Template::set('users', $this->newsletter_model->find_all());
            Template::render();
        } else {
            Template::redirect('admin');
        }
    }

    public function newsletter_subscriptionEmail() {

        /* Sending Mail to selected users */
        if ($this->input->post('sendMail')) {
            //   var_dump('adwd');die;
            $title = $this->input->post('title');
            $content = $this->input->post('content');
            $template_id = $this->input->post('newsTemplate');
            $emails = array();

            $key = $this->input->post('sendMailOption');

            // var_dump($key);die;
            switch ($key) {
                case 'ALL':
                    $result = $this->newsletter_model->get_users(array('%'));
                    foreach ($result as $value) {
                        //var_dump($id);die;
                        $emails[] = $value->email;
                        $email_id[] = $value->id;
                    }
                    //  $emails[] = 'chirag.prajapati@keyideasglobal.com   ';
                    //    $email_id[]='1';

                    break;

                case 'SELECTED':
                    if (isset($_POST['selected_emails']) && is_array($_POST['selected_emails']) && !empty($_POST['selected_emails'])) {
                        $arr_id = array();
                        $arr_email = array();
                        foreach ($_POST['selected_emails'] as $value) {
                            list($id, $email) = explode(',', $value);
                            $arr_id[] = $id;
                            $arr_email[$id] = $email;
                        }
                        $emails = $arr_email; //$_POST['selected_emails'];
                        $email_id = $arr_id;
                    }
                    break;

                case 'Subscribed_user':

                    $result = $this->newsletter_model->get_all_subscribedUser();
                    foreach ($result as $value) {
                        $emails[] = $value->emailID;
                        $email_id[] = $value->id;
                    }

                    break;

                default:
                    break;
            }

            if ((!empty($emails) || !empty($email_id)) && (is_array($email_id) && is_array($emails))) {                
                // var_dump($emails);die;
                $this->sendEmail($emails, $title, $content, $email_id,$template_id);
            }
        }
    }
    
    //--------------------------------------------------------------------
    
    
    public function getTemplate(){        
        if($this->input->get('templateId')){
            $template_id = $this->input->get('templateId'); 
            $templateData = $this->newsletter_mail_model->getNewsTemplates($template_id);            
            echo json_encode($templateData);
            die;
        }
    }
}