<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Cco controller
 */
class Cco extends Front_Controller
{
    protected $permissionCreate = 'Cco.Cco.Create';
    protected $permissionDelete = 'Cco.Cco.Delete';
    protected $permissionEdit = 'Cco.Cco.Edit';
    protected $permissionView = 'Cco.Cco.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('users/auth');
        //$this->auth->restrict($this->permissionView);
        $this->load->helper('application');
        $this->load->library('Template');
        $this->load->library('Assets');
        $this->lang->load('application');
        $this->load->library('events');
        $this->load->library('form_validation');

        $this->load->library('session');

        $this->load->helper('form');


        $this->load->model('cco/cco_model');
        $this->load->model('ecp/ecp_model');
        $this->load->model('ishop/ishop_model');

        $this->set_current_user();
        $this->lang->load('cco');

    }

    /**
     * Display a list of CCO data.
     *
     * @return void
     */
    public function index()
    {
        Template::render();
    }

    public function farmer_dialpad()
    {
        Assets::add_module_js('cco', 'cco_dialpad.js');

        $user = $this->auth->user();
        $farmer_role = 11;

        $campagain_data = $this->cco_model->campagain_data($farmer_role,$user->country_id);

        $cco_campaign_data = $this->cco_model->get_all_campaign_data($user->id,$user->role_id,$user->country_id);

        $campaign_details =  $this->cco_model->get_all_campaign_details($user->id,$user->role_id,$user->country_id);


        Template::set('cco_campaign_data', $cco_campaign_data);
        Template::set('campagaine_data', $campagain_data);
        Template::set('campaign_details', $campaign_details);

        Template::set_view("cco/main_screen_dialpad");
        Template::render();
    }


    public function activity_dialpad()
    {
        Assets::add_module_js('cco', 'cco_dialpad.js');

        $user = $this->auth->user();

        $cco_campaign_data = $this->cco_model->get_all_campaign_data($user->id,$user->role_id,$user->country_id);

        $campaign_details =  $this->cco_model->get_all_campaign_details($user->id,$user->role_id,$user->country_id);

        Template::set('cco_campaign_data', $cco_campaign_data);
        Template::set('campaign_details', $campaign_details);
        Template::set_view("cco/main_screen_dialpad");
        Template::render();
    }

    public function employee_dialpad()
    {
        Assets::add_module_js('cco', 'cco_dialpad.js');

        $user = $this->auth->user();

        //COUNTRY DATA
        $higest_level_data = $this->cco_model->get_all_higest_level_data($user->country_id);

      //  $campaign_details =  $this->cco_model->get_all_campaign_details($user->id,$user->role_id,$user->country_id);

        Template::set('higest_level_data', $higest_level_data);
       // Template::set('campaign_details', $campaign_details);
        Template::set_view("cco/main_screen_dialpad");
        Template::render();
    }

    public function getAllPhaseDetailsByCampaignId()
    {
        $user=$this->auth->user();
        $campaign_id = $_POST["campaign_id"];

        $PhaseDetails = $this->cco_model->getAllPhaseDetailByCampaignId($campaign_id,$user->id,$user->role_id,$user->country_id);
        Template::set('phase_detail', $PhaseDetails);
        Template::set_view("cco/main_screen_dialpad");
        Template::render();

    }

    public function dialpad()
    {
        Assets::add_module_js('cco', 'cco_dialpad.js');

        $phone_no = $this->session->userdata("phone_no");
        $campagain_id = $this->session->userdata("campagain_id");

        $customer_id= (isset($this->session->userdata['caller_data']['0']['id']) && !empty($this->session->userdata['caller_data']['0']['id']))? $this->session->userdata['caller_data']['0']['id'] : "";

        $role_id= (isset($this->session->userdata['caller_data']['0']['role_id']) && !empty($this->session->userdata['caller_data']['0']['role_id'])) ?$this->session->userdata['caller_data']['0']['role_id'] :"";
        $user = $this->auth->user();

        $caller_status = $this->session->userdata("caller_status");

       // testdata($caller_status);


        $campagain_data = $this->cco_model->campagain_data($role_id,$user->country_id);

        $activity_data = $this->cco_model->activity_data($customer_id,$user->country_id);


        $call_status_data = $this->cco_model->call_status_data($campagain_id,$customer_id);
       // testdata($call_status_data);

        $get_sidebar_selected_customer_data = $this->cco_model->get_dialed_customer_data($phone_no);

        Template::set('sidebar_selected_customer_data', $get_sidebar_selected_customer_data);
        Template::set('selected_campagain_data', $campagain_id);
        Template::set('campagaine_data', $campagain_data);

        Template::set('activity_data', $activity_data);

        Template::set('call_status_data', $call_status_data);

        //testdata($cco_data);
        Template::set_view("cco/dialpad");
        Template::render();
    }

    public function get_customer_feedback_data_edit()
    {   $user=$this->auth->user();
        /*$logged_in_user=$user->display_name;*/
        $feedback_id = $_POST["feedback_id"];
        $feedback_data = $this->cco_model->get_feedback_data_edit($feedback_id);
        echo json_encode($feedback_data);
        die;
    }
    public function get_cco_data()
    {   $user=$this->auth->user();
        $logged_in_user=$user->id;

        $cco_data_for = $this->cco_model->get_cco_data_bargin($user->country_id,$logged_in_user);
        Template::set('logged_in_user', $logged_in_user);
        Template::set_view("cco/bargin_popup");
        Template::render();

        echo json_encode($cco_data_for);
        die;


    }

    public function get_customer_complaint_data_edit()
    {   $user=$this->auth->user();
        /*$logged_in_user=$user->display_name;*/
        $complaint_id = $_POST["complaint_id"];

        $complaint_data = $this->cco_model->get_complaint_data_edit($complaint_id);
        echo json_encode($complaint_data);
        die;
    }
    public function get_customer_business_view_data()
    {

        //$customer_id = $_POST["customerid"];
        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";

        $get_customer_business_data = array();
        if($customer_id != "") {
            $get_customer_business_data = $this->cco_model->get_customer_business_data($customer_id);
        }
        //$get_all_crop_data = $this->cco_model->get_all_crop_data($customer_id);

        //$get_allocated_crop_data = $this->cco_model->customer_crop_data($customer_id);

        Template::set('get_customer_business_data', $get_customer_business_data);
        //Template::set('all_crop_data', $get_all_crop_data);
        //Template::set('allocated_crop_data', $get_allocated_crop_data);

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_business_details");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();

    }

    public function get_customer_feedback_data()
    {   $user=$this->auth->user();
        /*$logged_in_user=$user->display_name;*/

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";

        //$customer_id = $_POST["customerid"];
        $page = (isset($_POST["page"]) && !empty($_POST["page"])) ? $_POST["page"] : '';

        $get_user_data = array();
        $feedback_data = array();
        $feedback_data_count = 0;

        if($customer_id != "") {
            $get_user_data = $this->cco_model->get_user_data($customer_id);
            $feedback_data = $this->cco_model->get_feedback_data($customer_id, $page, $user->local_date, $user->country_id);

            $feedback_data_count = $feedback_data['count'];

        }
     //   testdata($feedback_data);
        Template::set('get_user_data', $get_user_data);
        Template::set('customer_id', $customer_id);
        //Template::set('get_feedback_data', $get_feedback_data);

        Template::set('table', $feedback_data);

        Template::set('td', $feedback_data_count);
        Template::set('pagination', (isset($feedback_data['pagination']) && !empty($feedback_data['pagination'])) ? $feedback_data['pagination'] : '' );

        Template::set_view("cco/dialpad/dialpad_feedback_details");
        Template::render();
    }
    public function get_missedcall_data()
    {
        $user=$this->auth->user();

        $page = (isset($_POST["page"]) && !empty($_POST["page"])) ? $_POST["page"] : '';

        $missedcall_data = $this->cco_model->get_missedcall_data($page,$user->local_date);

        Template::set('table', $missedcall_data);

        Template::set('td', $missedcall_data['count']);
        Template::set('pagination', (isset($missedcall_data['pagination']) && !empty($missedcall_data['pagination'])) ? $missedcall_data['pagination'] : '' );

        Template::set_view("cco/missedcall_popup");
        Template::render();
    }

    public function get_customer_schemes_data()
    {

        $user = $this->auth->user();
        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        //$customer_id = $_POST["customerid"];
        $get_business_geo_data_to_retailer = $this->cco_model->get_business_geo_data_to_retailer($customer_id);
        $login_user_type= $user->role_id;
        $default_retailer_role = 10;
        $parent_id = null;

        $retailer_geo_data = $this->ishop_model->get_business_geo_data($user->id,$user->country_id,$default_retailer_role,$parent_id,$year=null,$login_user_type);

        Template::set('geo_data', $retailer_geo_data);
        Template::set('get_business_geo_data_to_retailer', $get_business_geo_data_to_retailer);
        Template::set('current_user', $user);
        Template::set('customer_id', $customer_id);
        Template::set_view('cco/dialpad/dialpad_scheme_view');
        Template::render();


    }
    public function view_schemes_details()
    {
        $user = $this->auth->user();
        $customer_id = $_POST["customer_id"];
        $get_business_geo_data_to_retailer = $this->cco_model->get_business_geo_data_to_retailer($customer_id);
        $user_id = $this->session->userdata('user_id');
        $login_user_role=8;
        $year = $this->input->post("year");
        $region = $this->input->post("region");
        $territory = $this->input->post("territory");
        $retailer = $this->input->post("fo_retailer_id");
        $pag = (isset($_POST['page']) ? $_POST['page'] : '');
        if($pag > 0)
        {
            $page = $pag;
        }
        else{
            $page = 1;
        }

        $scheme_view=$this->ishop_model->view_schemes_detail($user_id,$user->country_id,$year,$region,$territory,$login_user_role,$retailer,$page);
        //	testdata($scheme_view);
        Template::set('get_business_geo_data_to_retailer', $get_business_geo_data_to_retailer);
        Template::set('table',$scheme_view);
        Template::set('customer_id', $customer_id);
        Template::set('td', $scheme_view['count']);
        Template::set('pagination', (isset($scheme_view['pagination']) && !empty($scheme_view['pagination'])) ? $scheme_view['pagination'] : '' );

       // Template::set_view('cco/dialpad/dialpad_scheme_view');
        Template::set_view('common/middle');
        Template::render();
        //testdata($scheme_view);
    }

    public function get_customer_complaint_data_from_type_id()
    {   $user=$this->auth->user();
        /*$logged_in_user=$user->display_name;*/
        $customer_id = $_POST["customer_id"];
        $complaint_type_id = $_POST["complaint_type_id"];
        $page = (isset($_POST["page"]) && !empty($_POST["page"])) ? $_POST["page"] : '';

        $get_user_data = $this->cco_model->get_user_data($customer_id);

        $complaint_data = $this->cco_model->get_complaint_data($customer_id,$page,$user->local_date,$user->country_id,$complaint_type_id);

        //   testdata($feedback_data);
        Template::set('get_user_data', $get_user_data);
        Template::set('customer_id', $customer_id);
        //Template::set('get_feedback_data', $get_feedback_data);

        Template::set('table', $complaint_data);

        Template::set('td', $complaint_data['count']);
        Template::set('pagination', (isset($complaint_data['pagination']) && !empty($complaint_data['pagination'])) ? $complaint_data['pagination'] : '' );

        Template::set('grid_data', $complaint_data['count']);

        //Template::set_view("cco/dialpad/dialpad_complaint_view");
        Template::set_view('common/middle');

        Template::render();
    }

    public function add_update_feedback_view_info()
    {

        $feedback_update_data = $this->cco_model->add_update_feedback_data();
        echo $feedback_update_data;
        die;
    }
    public function add_update_bargin_info()
    {
        $cco_id=$_POST["cco_id"];
        $phone_no=$_POST["phone_no"];
        $bargin_info = $this->cco_model->add_update_bargin_info($cco_id,$phone_no);
        echo $bargin_info;
        die;
    }
    public function add_update_upper_dialpad_info()
    {

        $feedback_update_data = $this->cco_model->add_update_upper_dialpad_info();
        echo $feedback_update_data;
        die;
    }
    public function add_update_complaint_view_info()
    {

        $feedback_update_data = $this->cco_model->add_update_complaint_data();
        echo $feedback_update_data;
        die;
    }
    public function block_phone_number()
    {
        $phone_no = $_POST["phone_no"];
        $block_phone_number = $this->cco_model->block_phone_number($phone_no);
        echo $block_phone_number;
        die;
    }
    public function delete_feedback_data()
    {
        $feedback_id = $_POST["feedback_id"];
        $data = $this->cco_model->delete_feedback($feedback_id);
        echo $data;
        die;
    }
    public function delete_complaint_data()
    {
        $complaint_id = $_POST["complaint_id"];
        $data = $this->cco_model->delete_complaint($complaint_id);
        echo $data;
        die;
    }

    public function get_complaint_sub_from_complaint_type()
    {   $user=$this->auth->user();
        /*$logged_in_user=$user->display_name;*/
        $complaint_type_id = $_POST["complaint_type_id"];
        $complaint_sub_data = $this->cco_model->get_complaint_sub_from_complaint_type($complaint_type_id);
        echo json_encode($complaint_sub_data);
        die;
    }

    public function get_person_data_from_desigination()
    {   $user=$this->auth->user();
        /*$logged_in_user=$user->display_name;*/
        $desigination_country_id = $_POST["desigination_country_id"];
        $person_data = $this->cco_model->get_person_data_from_desigination($desigination_country_id);
        echo json_encode($person_data);
        die;
    }

    public function get_complaint_date_from_complaint_sub()
    {   $user=$this->auth->user();
        /*$logged_in_user=$user->display_name;*/
        $complaint_subject_id = $_POST["complaint_subject_id"];
        $complaint_due_date_data = $this->cco_model->get_complaint_date_from_complaint_sub($complaint_subject_id);

        $due_date=$complaint_due_date_data['reminder1_days'];
        $due_date2=$complaint_due_date_data['reminder2_days'];
        $due_date3=$complaint_due_date_data['reminder3_days'];
      //  $other_desigination_person1_id=$complaint_due_date_data['other_desigination_person1_id'];
     //   $reminder1_other_desigination_id=$complaint_due_date_data['reminder1_other_desigination_id'];
     //   $reminder1_desigination_id=$complaint_due_date_data['reminder1_desigination_id'];

        $Complaint_due_date=date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + $due_date, date('Y')));
        $Complaint_due_date2=date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + $due_date2, date('Y')));
        $Complaint_due_date3=date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + $due_date3, date('Y')));
        //$combine_array=array_push($complaint_due_date_data,$Complaint_due_date);
        $combine_array = array_merge($complaint_due_date_data, array('complaint_due_date' => $Complaint_due_date,'complaint_due_date2' => $Complaint_due_date2,'complaint_due_date3' => $Complaint_due_date3));
        echo json_encode($combine_array);
        die;
    }

    public function get_complaint_responsible_designation()
    {
        $complaint_subject_id = $_POST["complaint_subject_id"];

        $complaint_responsible_person_data = $this->cco_model->get_complaint_responsible_desigination_data($complaint_subject_id);
        if(!empty($complaint_responsible_person_data))
        {
            $res = json_encode($complaint_responsible_person_data);
        }
        else
        {
            $res = "";
        }
        echo $res;
        die;
    }

    public function get_customer_general_detail_data()
    {


        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";

        //$customer_id = ;

        if($customer_id != "") {
            $get_personal_general_data = $this->cco_model->get_personal_general_data($customer_id);
        }
        else
        {
            $get_personal_general_data = array();
        }

        Template::set('personal_general_data', $get_personal_general_data);

      //  $this->load->view('cco/dialpad_popup_views/general_details');

        Template::set_view("cco/dialpad/dialpad_general_details");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();
    }

    public function get_customer_family_detail_data()
    {
        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";

        if($customer_id != "")
        {
            $get_personal_family_data = $this->cco_model->get_personal_family_data($customer_id);
        }
        else
        {
            $get_personal_family_data = array();
        }

        Template::set('personal_family_data', $get_personal_family_data);
        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_family_details");
        Template::render();
    }

    public function get_customer_education_detail_data()
    {
        $user = $this->auth->user();

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
       // $customer_id = $_POST["customerid"];
if($customer_id != "") {
    $get_personal_education_data = $this->cco_model->get_personal_education_data($customer_id);
}
        else{
            $get_personal_education_data = array();
        }

        $get_education_qualification_data = $this->cco_model->get_education_qualification_data($user->country_id);
     //   testdata($get_education_qualification_data);

        Template::set('personal_education_data', $get_personal_education_data);
        //$education_data["qualification_id"]
        Template::set('education_qualification_data', $get_education_qualification_data);

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_eductaion_details");
        Template::render();

    }

    public function get_customer_social_detail_data()
    {
        $user = $this->auth->user();

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        // $customer_id = $_POST["customerid"];
        if($customer_id != "") {

            $get_social_data = $this->cco_model->get_customer_social_data($customer_id);
        }
        else
        {
            $get_social_data = array();
        }
        Template::set('social_data', $get_social_data);

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_social_details");
        Template::render();
    }

    public function get_customer_complaint_detail_data()
    {
        $user = $this->auth->user();

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        // $customer_id = $_POST["customerid"];
        if($customer_id != "") {

            $get_customer_complaint_data = $this->cco_model->get_customer_social_data($customer_id);
        }else{
            $get_customer_complaint_data = array();
        }

            $random_complaint_no = $this->get_complaint_no();

        $get_customer_complaint_type= $this->cco_model->get_customer_complaint_type();
        //testdata($get_customer_complaint_type);
        Template::set('unique_id', $random_complaint_no);
        Template::set('customer_id', $customer_id);
        Template::set('get_customer_complaint_type', $get_customer_complaint_type);
        Template::set_view("cco/dialpad/dialpad_complaint_details");
        Template::render();

    }

    public function get_customer_complaint_view_data()
    {
        $user = $this->auth->user();

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        // $customer_id = $_POST["customerid"];

        // $get_social_data = $this->cco_model->get_customer_social_data($customer_id);
        $get_customer_complaint_type= $this->cco_model->get_customer_complaint_type();
        Template::set('get_customer_complaint_type', $get_customer_complaint_type);
        // Template::set('social_data', $get_social_data);

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_complaint_view");
        Template::render();
    }

    public function get_complaint_no()
    {
        $six_digit_random_number = mt_rand(100000, 999999);
        $get_complaint_unique_id = $this->cco_model->get_customer_complaint_unique($six_digit_random_number);
        $ccnt = count($get_complaint_unique_id);

        if($ccnt > 0){
            $this->get_complaint_no();
        }
        else{
            return $six_digit_random_number;
        }
    }

    public  function get_customer_financial_detail_data()
    {
        $user = $this->auth->user();

     //   $customer_id = $_POST["customerid"];

        $get_all_electronic_data = $this->cco_model->get_electronic_data();
        $get_all_vehicles_data = $this->cco_model->get_vehicles_data();

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        // $customer_id = $_POST["customerid"];
        if($customer_id != "")
        {

            $get_customer_pa_income = $this->cco_model->get_customer_pa_income_data($customer_id);

            $get_financial_electronic_data = $this->cco_model->get_customer_financial_electronic_data($customer_id);
            $get_financial_vechiles_data = $this->cco_model->get_customer_financial_vehicles_data($customer_id);

        }
        else
        {
            $get_customer_pa_income = array();
            $get_financial_electronic_data = array();
            $get_financial_vechiles_data = array();
        }

        //dumpme($get_financial_electronic_data);
        //testdata($get_financial_vechiles_data);

        Template::set('financial_electronic_data', $get_financial_electronic_data);
        Template::set('financial_vechiles_data', $get_financial_vechiles_data);

        Template::set('all_electronic_data', $get_all_electronic_data);
        Template::set('all_vechiles_data', $get_all_vehicles_data);

        Template::set('customer_pa_income', $get_customer_pa_income);

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_financial_view");
        Template::render();
    }

    public function get_customer_retailer_view_data()
    {
        $user = $this->auth->user();

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        // $customer_id = $_POST["customerid"];
        if($customer_id != "") {

            $get_user_data = $this->cco_model->get_user_data($customer_id);
        }
        else
        {
            $get_user_data = array();
        }

        $caller_data = $this->session->userdata("caller_data");

        if(isset($caller_data[0]["role_id"]) && $caller_data[0]["role_id"] == 11)
        {
            $user_role = 10;
        }
        elseif(isset($caller_data[0]["role_id"]) && $caller_data[0]["role_id"] == 10)
        {
            $user_role = 9;
        }
        elseif(isset($caller_data[0]["role_id"]) && $caller_data[0]["role_id"] == 9)
        {
            $user_role = 10;
        }

        $customer_level_2 = (isset($get_user_data[0]["geo_level_id2"]) && !empty($get_user_data[0]["geo_level_id2"]))? $get_user_data[0]["geo_level_id2"] : "";

        if($customer_level_2 != "")
        {
            //$user_role = 10;
            $get_retailer_data = $this->cco_model->get_customer_location_retailer_data($customer_id,$user_role,$customer_level_2);
        }
        else
        {
            $get_retailer_data = "";
        }

        if($customer_id != "") {

            $get_customer_retailer_relation_data = $this->cco_model->customer_relation_retailer_data($customer_id, $user_role);
        }
        else
        {
            $get_customer_retailer_relation_data = array();
        }

        Template::set('customer_relation_retailer_data', $get_customer_retailer_relation_data);

        Template::set('customer_retailer_data', $get_retailer_data);

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_retailer_details");
        Template::render();
    }

    public function get_customer_farming_view_data()
    {

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        // $customer_id = $_POST["customerid"];
        if($customer_id != "") {

            $get_customer_farming_data = $this->cco_model->get_customer_farming_data($customer_id);

            $get_all_crop_data = $this->cco_model->get_all_crop_data($customer_id);

            $get_allocated_crop_data = $this->cco_model->customer_crop_data($customer_id);
        }
        else
        {
            $get_customer_farming_data = array();
            $get_all_crop_data = array();
            $get_allocated_crop_data = array();
        }
        Template::set('customer_farming_data', $get_customer_farming_data);
        Template::set('all_crop_data', $get_all_crop_data);
        Template::set('allocated_crop_data', $get_allocated_crop_data);

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_farming_details");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();

    }

    public function get_activity_detail_view_data()
    {
        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        // $customer_id = $_POST["customerid"];
        if($customer_id != "") {
            $geo_level = $this->cco_model->get_geo_by_customer_id($customer_id);
        }
        else
        {
            $geo_level = array();
        }

        Template::set('geo_level', $geo_level);
        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_activity_detail");
        Template::render();
    }

    public function get_planned_activity_detail_data()
    {

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";

        $activity_id = (isset($_POST["activity_id"]) && !empty($_POST["activity_id"]))? $_POST["activity_id"] : "";

      //  $customer_id = $_POST["customerid"];
      //  $activity_id = $_POST["activity_id"];
        $user = $this->auth->user();

        $activity_details = array();
        $digitalLibrary = array();

        if($customer_id != "" && $activity_id != "")
        {
            $activity_details = $this->cco_model->get_planned_activity_details_data($customer_id, $activity_id);

            $digitalLibrary = $this->ecp_model->getDigitalLibraryDataByCountry($activity_details['activity_type_id'], $user->country_id);
        }

        $crop_details = $this->ecp_model->crop_details_by_country_id($user->country_id);
        $product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);
        $diseases_details = $this->ecp_model->get_diseases_by_user_id($user->country_id);

        $global_head_user = array();
        $global_jr_user = array();

        $sr_employee_visit = array();
        $jr_employee_visit = array();

        if($customer_id != "") {

            $sr_employee_visit = $this->ecp_model->get_employee_for_loginuser($customer_id, $global_head_user);
            $jr_employee_visit = $this->ecp_model->get_jr_employee_for_loginuser($customer_id, $global_jr_user);
        }


        $employee_visit = array_merge($sr_employee_visit,$jr_employee_visit) ;

        Template::set('activity_details', $activity_details);
        Template::set('customer_id', $customer_id);
        Template::set('digitalLibrary', $digitalLibrary);
        Template::set('crop_details', $crop_details);
        Template::set('product_sku', $product_sku);
        Template::set('diseases_details', $diseases_details);
        Template::set('employee_visit', $employee_visit);

        Template::set_view("cco/dialpad/dialpad_planed_activity_detail");
        Template::render();
    }

    public function get_executed_activity_detail_data()
    {
        $user = $this->auth->user();

      //  $customer_id = $_POST["customerid"];
      //  $activity_id = $_POST["activity_id"];

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        $activity_id = (isset($_POST["activity_id"]) && !empty($_POST["activity_id"]))? $_POST["activity_id"] : "";

        $activity_details = array();
        $digitalLibrary = array();

        if($customer_id != "" && $activity_id != "") {
            $activity_details = $this->cco_model->get_planned_activity_details_data($customer_id, $activity_id);

            $digitalLibrary = $this->ecp_model->getDigitalLibraryDataByCountry($activity_details['activity_type_id'], $user->country_id);
        }


        $crop_details = $this->ecp_model->crop_details_by_country_id($user->country_id);
        $product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);
        $diseases_details = $this->ecp_model->get_diseases_by_user_id($user->country_id);

        $global_head_user = array();
        $global_jr_user = array();

        $sr_employee_visit = array();
        $jr_employee_visit = array();

        if($customer_id != "")
        {
            $sr_employee_visit = $this->ecp_model->get_employee_for_loginuser($customer_id, $global_head_user);
            $jr_employee_visit = $this->ecp_model->get_jr_employee_for_loginuser($customer_id, $global_jr_user);
        }

        $employee_visit = array_merge($sr_employee_visit,$jr_employee_visit) ;

        Template::set('activity_details', $activity_details);
        Template::set('customer_id', $customer_id);
        Template::set('digitalLibrary', $digitalLibrary);
        Template::set('crop_details', $crop_details);
        Template::set('product_sku', $product_sku);
        Template::set('diseases_details', $diseases_details);
        Template::set('employee_visit', $employee_visit);

        Template::set_view("cco/dialpad/dialpad_executed_activity_detail");
        Template::render();
    }

    public function activity_planning_sidebar_calender($activity_details=array(),$action=''){

        // make it dynamically
        $act_status = array('i','p','a','r','e','c');

        $activity_by_date = array();
        if(!empty($activity_details) && count($activity_details)  > 0){
            foreach($activity_details as $act)
            {
                if(isset($act['execution_date']) && !empty($act['execution_date']))
                {
                    $act_date = $act['execution_date'];
                } else {
                    $act_date = $act['activity_planning_date'];
                }

                if(!isset($activity_by_date[$act_date]))
                {
                    $activity_by_date[$act_date] = array();
                }
            }
        }

        $user = $this->auth->user();

// Get current year, month and day
        list($iNowYear, $iNowMonth, $iNowDay) = explode('-', date('Y-m-d'));

// Get current year and month depending on possible GET parameters
        if (isset($_REQUEST['cur_month'])) {
            list($iMonth, $iYear) = explode('-', $_REQUEST['cur_month']);
            $iMonth = (int)$iMonth;
            $iYear = (int)$iYear;
        } else {
            list($iMonth, $iYear) = explode('-', date('n-Y'));
        }

// Get name and number of days of specified month
        $iTimestamp = mktime(0, 0, 0, $iMonth, $iNowDay, $iYear);
        list($sMonthName, $iDaysInMonth) = explode('-', date('F-t', $iTimestamp));

// Get previous year and month
        $iPrevYear = $iYear;
        $iPrevMonth = $iMonth - 1;
        if ($iPrevMonth <= 0) {
            $iPrevYear--;
            $iPrevMonth = 12; // set to December
        }

// Get next year and month
        $iNextYear = $iYear;
        $iNextMonth = $iMonth + 1;
        if ($iNextMonth > 12) {
            $iNextYear++;
            $iNextMonth = 1;
        }

// Get number of days of previous month
        $iPrevDaysInMonth = (int)date('t', mktime(0, 0, 0, $iPrevMonth, $iNowDay, $iPrevYear));

// Get numeric representation of the day of the week of the first day of specified (current) month
        $iFirstDayDow = (int)date('w', mktime(0, 0, 0, $iMonth, 1, $iYear));

// On what day the previous month begins
        $iPrevShowFrom = $iPrevDaysInMonth - $iFirstDayDow + 1;

// If previous month
        $bPreviousMonth = ($iFirstDayDow > 0);

// Initial day
        $iCurrentDay = ($bPreviousMonth) ? $iPrevShowFrom : 1;

        $bNextMonth = false;
        $sCalTblRows = '';

// Generate rows for the calendar
        for ($i = 0; $i < 6; $i++) { // 6-weeks range
            $sCalTblRows .= '<tr>';
            for ($j = 0; $j < 7; $j++) { // 7 days a week

                $clr = array('i','a','r','p');

                $sClass = '';
                if ($iNowYear == $iYear && $iNowMonth == $iMonth && $iNowDay == $iCurrentDay && !$bPreviousMonth && !$bNextMonth) {
                    $sClass = 'today';
                } elseif (!$bPreviousMonth && !$bNextMonth) {


                    if(($iCurrentDay > date("d") && $iMonth >= date("n")) || ($iMonth > date("n"))){
                        $sClass = 'current';
                    }
                    else
                    {
                        $sClass = 'prev';
                    }

                }
                $dYear = $iYear;
                $dMonth = $iMonth;
                if($bPreviousMonth==1){
                    $dMonth--;
                } else if($bNextMonth==1){
                    if($iMonth==12){
                        $dMonth = 1;
                        $dYear++;
                    } else {
                        $dMonth++;
                    }
                }


                $activity_date = strtotime($dYear.'-'.$dMonth.'-'.$iCurrentDay);
                $date = $dYear.'-'.$dMonth.'-'.$iCurrentDay;

                if($activity_date < strtotime(date('Y-m-d')))
                {
                    $style = "pointer-events: none;opacity: 0.7;";
                }
                else
                {
                    $style = "";
                }
                $act_class = "";
                if(!empty($activity_details) && !empty($action))
                {
                    /*if($action == 'activity_planning')
                    {*/
                    if(count($activity_by_date)>0)
                    {
                        foreach($activity_by_date as $k => $ld)
                        {
                            if($activity_date == strtotime($k))
                            {
                                $act_class = " act_date ".@implode(" ",$ld);
                            }
                        }
                    }

                    /*}*/
                }

                $actClass = array_rand($clr,1);

                $sCalTblRows .= '<td class="'.$sClass.'" style="'.$style.'" ><a class="activity_date act_'.$clr[$actClass].$act_class.'" rel="'.$date.'"  href="javascript: void(0)">'.$iCurrentDay.'</a></td>';

                // Next day
                $iCurrentDay++;
                if ($bPreviousMonth && $iCurrentDay > $iPrevDaysInMonth) {
                    $bPreviousMonth = false;
                    $iCurrentDay = 1;
                }
                if (!$bPreviousMonth && !$bNextMonth && $iCurrentDay > $iDaysInMonth) {
                    $bNextMonth = true;
                    $iCurrentDay = 1;
                }
            }
            $sCalTblRows .= '</tr>';
        }

// Prepare replacement keys and generate the calendar
        $aKeys = array(
            '__prev_month__' => "{$iPrevMonth}-{$iPrevYear}",
            '__next_month__' => "{$iNextMonth}-{$iNextYear}",
            '__cal_caption__' => $sMonthName . ', ' . $iYear,
            '__cal_rows__' => $sCalTblRows,
        );
//$sCalendarItself = strtr(file_get_contents('calendar.html'), $aKeys);
        $sCalendarItself = '';

        $sCalendarItself .= '<div class="navigation">';
        $sCalendarItself .= '<a class="prev" href="javascript: void(0);" onclick="getActivityCalenderData(\''.$aKeys["__prev_month__"].'\');"></a> ';
        $sCalendarItself .= '<div class="title" >'.$aKeys['__cal_caption__'].'</div>';
        $sCalendarItself .= '<a class="next" href="javascript: void(0);" onclick="getActivityCalenderData(\''.$aKeys["__next_month__"].'\');"></a>';
        $sCalendarItself .= '</div><table>
    <tr>
        <th class="weekday">Sun</th>
        <th class="weekday">Mon</th>
        <th class="weekday">Tue</th>
        <th class="weekday">Wed</th>
        <th class="weekday">Thu</th>
        <th class="weekday">Fri</th>
        <th class="weekday">Sat</th>
    </tr>';

        $sCalendarItself .= $aKeys["__cal_rows__"];
        $sCalendarItself .= '</table>';

     /*   if ($this->input->is_ajax_request()) {*/
		echo $sCalendarItself;
		die;

       /* }
        else{
            return $sCalendarItself;
        }*/
    }

    public function getActivityDetailByMonth()
    {
        $user = $this->auth->user();

       // testdata($_POST);
        $geo_level_2 = !empty($_POST['param'][1]['value']) ? $_POST['param'][1]['value'] : '0';
        $geo_level_3 = !empty($_POST['param'][2]['value']) ? $_POST['param'][2]['value'] : '0';
        $geo_level_4 = !empty($_POST['param'][3]['value']) ? $_POST['param'][3]['value'] : '0';
        $cur_month = !empty($_POST['cur_month']) ? $_POST['cur_month'] : '';


        $activity_detail = $this->cco_model->all_activity_view_details($user->id,$user->country_id,$geo_level_2,$geo_level_3,$geo_level_4,$cur_month);

        $action ='activity_planning';

        $cal_data = $this->activity_planning_sidebar_calender($activity_detail,$action);
        return $cal_data;
    }

    public function getActivityDetailByDate()
    {
        $user = $this->auth->user();

        $geo_level_2 = !empty($_POST['param'][1]['value']) ? $_POST['param'][1]['value'] : '0';
        $geo_level_3 = !empty($_POST['param'][2]['value']) ? $_POST['param'][2]['value'] : '0';
        $geo_level_4 = !empty($_POST['param'][3]['value']) ? $_POST['param'][3]['value'] : '0';

        $cur_date = !empty($_POST['cur_date']) ? $_POST['cur_date'] : '';


        $activity_detail = $this->cco_model->all_activity_view_details_by_date($user->id,$user->country_id,$cur_date,$geo_level_2,$geo_level_3,$geo_level_4);
      //  testdata($activity_detail);

        Template::set("activity_customer_data",$activity_detail);
        Template::set_view("cco/dialpad/activity_detail_data");
        Template::render();

    }

    public function get_diseases_detail_view_data()
    {
        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
       // $customer_id = $_POST["customerid"];

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_disease_details");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();
    }

    public function get_diseases_detail_data()
    {
        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        $search_data = (isset($_POST["searchdata"]) && !empty($_POST["searchdata"]))? $_POST["searchdata"] : "";

      //  $search_data = $_POST["searchdata"];
      //  $customerid = $_POST["customerid"];

        $searched_data = $this->cco_model->get_search_disease_detail($search_data,$customer_id);

        Template::set('searched_data', $searched_data);
        Template::set('search_type', 'disease');

        Template::set_view("cco/dialpad/table_layout");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();

    }

    public function get_product_detail_view_data()
    {
        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
       // $customer_id = $_POST["customerid"];

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_product_details");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();
    }

    public function get_product_detail_data()
    {
        //$search_data = $_POST["searchdata"];
        //$customerid = $_POST["customerid"];

        $customerid = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        $search_data = (isset($_POST["searchdata"]) && !empty($_POST["searchdata"]))? $_POST["searchdata"] : "";

        $searched_data = $this->cco_model->get_search_product_detail($search_data,$customerid);

        Template::set('searched_data', $searched_data);
        Template::set('search_type', 'product');

        Template::set_view("cco/dialpad/table_layout");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();

    }

    public function get_employee_order_status_data()
    {
        $customer_id = $_POST["customerid"];
        $role_id = $_POST["role_id"];

        $user= $this->auth->user();

        $distributor= $this->ishop_model->get_distributor_by_user_id($user->country_id);

        $retailer= $this->ishop_model->get_retailer_by_user_id($user->country_id);

        $product_sku= $this->ishop_model->get_product_sku_by_user_id($user->country_id);

        $logined_user_type = $role_id;
        $logined_user_id = $customer_id;
        $logined_user_countryid = $user->country_id;
        $local_date = $user->local_date;


        $get_geo_level_data = "";
        $action_data = 'order_status';

        if($logined_user_type == 8){

            //FOR FO
            $default_type_selected = 11;

            $get_geo_level_data = $this->ishop_model->get_employee_geo_data($user->id,$user->country_id,$logined_user_type,null,$default_type_selected,$action_data);


        }

        Template::set('login_customer_type',$logined_user_type);
        Template::set('login_customer_id',$logined_user_id);
        Template::set('login_customer_countryid',$logined_user_countryid);
        Template::set('local_date',$local_date);

        Template::set('distributor',$distributor);
        Template::set('retailer',$retailer);
        Template::set('product_sku',$product_sku);


        Template::set('geo_level_data',$get_geo_level_data);

        Template::set_view('cco/employee_order_status');
        Template::render();



    }

    public function get_geo_fo_userdata(){

        $user= $this->auth->user();
        $selected_user_id = $_POST['user_id']; // login user id
        $user_country = $user->country_id;
        $login_customer_type = $_POST['login_customer_type']; //FO or HO or DISTRIBUTOR or RETAILER
        $customer_type_selected = $_POST['customer_type_selected']; // SELECTED CHECKBOX Retailer, Farmer, Distributor

        $url_data = $_POST['urlsegment'];

        if($customer_type_selected == "farmer"){
            $default_type = 11;
        }
        else if($customer_type_selected == "retailer"){
            $default_type = 10;
        }
        else if($customer_type_selected == "distributor"){
            $default_type = 9;
        }

        $get_geo_level_data = $this->ishop_model->get_employee_geo_data($selected_user_id,$user_country,$login_customer_type,null,$default_type,$url_data);
        echo json_encode($get_geo_level_data);
        die;

    }

    public function get_lowergeo_from_uppergeo_data() {

        $selected_user_id = $_POST['user_id']; // login user id
        $user_country = $_POST['user_country'];
        $login_customer_type = $_POST['login_customer_type']; //FO or HO or DISTRIBUTOR or RETAILER
        $parent_geo_id = $_POST['parent_geo_id']; // SELECTED CHECKBOX Retailer, Farmer, Distributor
        $checkedtype = $_POST['checkedtype'];

        $default_type ='';
        if($checkedtype == "farmer"){
            $default_type = 11;
        }
        else if($checkedtype == "retailer"){
            $default_type = 10;

        }
        else if($checkedtype == "distributor"){
            $default_type = 9;

        }
        $url_data = $_POST['urlsegment'];
       // $radio_selected_data = $_POST['checkedtype'];
        // echo $url_data;
        //echo $selected_user_id."===".$user_country."===".$login_customer_type."===".$parent_geo_id;

        $get_geo_level_data = $this->ishop_model->get_employee_geo_data($selected_user_id,$user_country,$login_customer_type,$parent_geo_id,$default_type,$url_data);

        echo json_encode($get_geo_level_data);
        die;

    }

    public function get_user_by_geo_data(){
        $selected_geo_id = $_POST['selected_geo_id'];
        $login_user_country_id = $_POST['country_id'];
        $checked_data = $_POST['checked_data'];

        $mobile_num = null;
        if(isset($_POST['moblie_num'])){

            $mobile_num = $_POST['moblie_num'];

        }

        $user_data = $this->ishop_model->get_user_for_geo_data($selected_geo_id,$login_user_country_id,$checked_data,$mobile_num);
        echo $user_data;
        die;

    }

    public function get_employee_all_order_data() {



        $user= $this->auth->user();

        $local_date = $user->local_date;
        $login_customer_type = 8;
        $login_customer_id =  $_POST["login_customer_id"];
        $login_customer_countryid =  $user->country_id;

        $pag = (isset($_POST['page']) ? $_POST['page'] : '');
        if($pag > 0)
        {
            $page = $pag;
        }
        else{
            $page = 1;
        }

        $loginusertype = 8;
        $order_data = array();

        if($loginusertype == 8){

            //FOR FO

            $radio_checked = $_POST["radio1"];

            if($radio_checked == "farmer"){

                $form_dt = (isset($_POST['form_date']) ? $_POST['form_date'] : '');
                $f_date = str_replace('/', '-', $form_dt);
                $from_date = date('Y-m-d', strtotime($f_date));

                $to_dt = (isset($_POST['to_date']) ? $_POST['to_date'] : '');
                $t_date = str_replace('/', '-', $to_dt);
                $todate = date('Y-m-d', strtotime($t_date));

                $loginuserid = $_POST["login_customer_id"];

                $order_tracking_no = (isset($_POST['order_tracking_no']) ? $_POST['order_tracking_no'] : '');

                $farmer_data =  (isset($_POST['farmer_data']) ? $_POST['farmer_data'] : '');


                $order_data = $this->cco_model->get_employee_order_data($loginusertype,$user->country_id,$radio_checked,$loginuserid,$farmer_data,$from_date,$todate,$order_tracking_no,null,$page,null,null,null,$user->local_date);



            }elseif($radio_checked == "distributor"){

                $form_dt = (isset($_POST['form_date']) ? $_POST['form_date'] : '');
                $f_date = str_replace('/', '-', $form_dt);
                $from_date = date('Y-m-d', strtotime($f_date));

                $to_dt = (isset($_POST['to_date']) ? $_POST['to_date'] : '');
                $t_date = str_replace('/', '-', $to_dt);
                $todate = date('Y-m-d', strtotime($t_date));
                $loginuserid = $_POST["login_customer_id"];


                $geo_level_1_data = $_POST["geo_level_1_data"];
                $distributor_id = $_POST["distributor_data"];
                $page_function = $_POST["page_function"];

                $order_data = $this->cco_model->get_employee_order_data($loginusertype,$user->country_id,$radio_checked,$loginuserid,$distributor_id,$from_date,$todate,null,null,$page,null,null,null,$user->local_date);



            }
            elseif($radio_checked == "retailer"){

                $form_dt = (isset($_POST['form_date']) ? $_POST['form_date'] : '');
                $f_date = str_replace('/', '-', $form_dt);
                $from_date = date('Y-m-d', strtotime($f_date));

                $to_dt = (isset($_POST['to_date']) ? $_POST['to_date'] : '');
                $t_date = str_replace('/', '-', $to_dt);
                $todate = date('Y-m-d', strtotime($t_date));

                $loginuserid = $_POST["login_customer_id"];

                $customer_id = $_POST["retailer_data"];
                $page_function = $_POST["page_function"];

                $order_data = $this->cco_model->get_employee_order_data($loginusertype,$user->country_id,$radio_checked,$loginuserid,$customer_id,$from_date,$todate,null,null,$page,null,null,null,$user->local_date);

                //echo "<pre>";
                //print_r($order_data);

                //die;
            }
        }

        Template::set('table', $order_data);

        Template::set('td', $order_data['count']);
        Template::set('pagination', (isset($order_data['pagination']) && !empty($order_data['pagination'])) ? $order_data['pagination'] : '' );

        Template::set('local_date', $local_date);
        Template::set('login_customer_type', $login_customer_type);
        Template::set('login_customer_id', $login_customer_id);
        Template::set('login_customer_countryid', $login_customer_countryid);

        Template::set_view('cco/employee_order_status');
        Template::render();

    }

    public function get_order_status_data_details() {

        $user= $this->auth->user();

        $order_id = (isset($_POST['id']) ? $_POST['id'] : '');
        $radiochecked = (isset($_POST['radiochecked']) ? $_POST['radiochecked'] : '');
        $logincustomertype = 8;

        $action_data = (isset($_POST['segment_data']) ? $_POST['segment_data'] : '');

        $order_details = "";

        if(isset($order_id) && !empty($order_id))
        {
            $order_details= $this->ishop_model->order_status_product_details_view_by_id($order_id,$radiochecked,$logincustomertype,$action_data);
        }

        $local_date = $user->local_date;
        $login_customer_type = 8;
        $login_customer_id =  $_POST["login_customer_id"];
        $login_customer_countryid =  $user->country_id;

        Template::set('local_date', $local_date);
        Template::set('login_customer_type', $login_customer_type);
        Template::set('login_customer_id', $login_customer_id);
        Template::set('login_customer_countryid', $login_customer_countryid);

        Template::set('table',$order_details);
        Template::set_view('cco/employee_order_status');
        Template::render();

    }



    public function get_customer_order_status_data()
    {

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        $search_data = (isset($_POST["searchdata"]) && !empty($_POST["searchdata"]))? $_POST["searchdata"] : "";


        //$customer_id = $_POST["customerid"];
        //$search_data = $_POST["searchdata"];



    //    $page_number = (isset($_POST["page"]) && !empty($_POST["page"])) ? $_POST["page"]: 1;

    //    $scroll_status = (isset($_POST["scroll_status"]) && !empty($_POST["scroll_status"])) ? $_POST["scroll_status"]: null;

        $pag = (isset($_POST['page']) ? $_POST['page'] : '');

        if($pag > 0)
        {
            $page = $pag;
        }
        else{
            $page = 1;
        }

        $default_order_data = array();

        if($customer_id != "")
        {
            $default_order_data = $this->cco_model->get_order_data($customer_id, $page, $search_data);
        }

        Template::set('customer_id', $customer_id);

        Template::set('table', $default_order_data);

        Template::set('td', $default_order_data['count']);
        Template::set('pagination', (isset($default_order_data['pagination']) && !empty($default_order_data['pagination'])) ? $default_order_data['pagination'] : '' );

      //  Template::set('default_order_data', $default_order_data);
        Template::set_view("cco/dialpad/dialpad_order_status_data");

        Template::render();
    }



    public function get_order_data_details()
    {
        $order_id = $_POST["orderid"];

        $order_details= $this->cco_model->order_status_product_details($order_id);

        Template::set('table',$order_details);
        Template::set_view("cco/dialpad/dialpad_order_status_data");

        Template::render();

    }

    public function delete_product_order_data()
    {
        $order_id = $_POST["data_id"];
        $detail_delete = $this->ishop_model->delete_order_data($order_id);
        die;
    }

    public function update_order_status_detail_data() {
        $detail_data = $_POST;

         //testdata($detail_data);

        $detail_update = $this->ishop_model->update_order_detail_data($detail_data);
        echo $detail_update;
        die;
    }

    public function get_customer_order_place_data()
    {

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
       // $customer_id = $_POST["customerid"];

        $user = $this->auth->user();

        $get_customer_retailer_data = array();
        if($customer_id != "")
        {
            $get_customer_retailer_data = $this->cco_model->get_customer_retailer_data($customer_id);
        }

        $product_sku= $this->ishop_model->get_product_sku_by_user_id($user->country_id);

        Template::set('customer_id', $customer_id);

        Template::set('product_sku', $product_sku);

        Template::set('customer_retailer_data', $get_customer_retailer_data);

        Template::set_view("cco/dialpad/dialpad_order_place_details");

        Template::render();

    }

    public function get_quantity_conversion_data()
    {

        $skuid = $_POST['skuid'];
        $quantity_data = $_POST['quantity_data'];
        $unit_data = $_POST['unit'];

        $conversion_data= $this->ishop_model->get_product_conversion_data($skuid,$quantity_data,$unit_data);
        echo $conversion_data;
        die;

    }

    public function cco_order_place_details(){

        $user_id = $this->session->userdata('user_id');

        $user= $this->auth->user();
        $user_country_id = $user->country_id;
        $order_data = $this->cco_model->add_cco_order_place_details($user->id,$user_country_id);

        echo $order_data;
        die;

    }

    public function view_transfer()
    {
        $user= $this->auth->user();

        $get_cco_data = $this->cco_model->get_cco_data($user->country_id,$user->id,$user->role_id);
        $designation = $this->cco_model->get_designation_data($user->country_id);


        Template::set('current_user', $user);
        Template::set('get_cco_data', $get_cco_data);
        Template::set('designation', $designation);

        Template::set_view("cco/dialpad/add_transfer");
        Template::render();
    }

    public function get_call_history_detail_data()
    {
        $user= $this->auth->user();

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        $phone_no = (isset($_POST["phone_no"]) && !empty($_POST["phone_no"]))? $_POST["phone_no"] : "";


        $pag = (isset($_POST['page']) ? $_POST['page'] : '');
        if ($pag > 0) {
            $page = $pag;
        } else {
            $page = 1;
        }

        $history_detail= $this->cco_model->get_call_history_details_data($user->country_id,$user->id,$customer_id,$phone_no,$user->local_date,$page);



        Template::set('td', $history_detail['count']);
        Template::set('pagination', (isset($history_detail['pagination']) && !empty($history_detail['pagination'])) ? $history_detail['pagination'] : '' );

        Template::set('table', $history_detail);

        Template::set_view("cco/dialpad/call_history");
        Template::render();


    }


    public function get_employee_by_designation()
    {
        $user= $this->auth->user();
        $designation_id = $_POST['designation_id'];
        $employee = $this->cco_model->get_employee_data($user->country_id,$designation_id);
        echo json_encode($employee);
        die;
    }

    public function add_cco_transfer()
    {
        $user= $this->auth->user();
        $add = $this->cco_model->add_cco_transfer_call($user->id,$user->country_id);
        echo json_encode($add);
        die;
    }

    public function add_emp_transfer()
    {
        $user= $this->auth->user();
        $add = $this->cco_model->add_emp_transfer_call($user->id,$user->country_id);
        echo json_encode($add);
        die;
    }


    public function channel_partner_dialpad()
    {
        Assets::add_module_js('cco', 'cco_dialpad.js');

        $user = $this->auth->user();

      //  $cco_campaign_data = $this->cco_model->get_all_campaign_data($user->id,$user->role_id,$user->country_id);

      //  $campaign_details =  $this->cco_model->get_all_campaign_details($user->id,$user->role_id,$user->country_id);

      //  Template::set('cco_campaign_data', $cco_campaign_data);
      //  Template::set('campaign_details', $campaign_details);

        $channel_partner_data = $this->cco_model->get_channel_partner_data($user->id,$user->role_id,$user->country_id);

        Template::set('channel_partner_data', $channel_partner_data);

      //  testdata($channel_partner_data);

        Template::set_view("cco/main_screen_dialpad");
        Template::render();
    }

    public function get_customer_campagain_data()
    {
        $user = $this->auth->user();
        $role_data = $_POST["selected_channel_partner"];
        $campagain_data = $this->cco_model->campagain_data($role_data,$user->country_id);

        if($campagain_data != 0) {
            echo json_encode($campagain_data);
        }
        else
        {
            echo 0;
        }
        die;

    }

    public function add_update_general_info()
    {
        $update_data = $this->cco_model->add_update_general_data();
        echo $update_data;
        die;
    }

    public function add_update_family_info()
    {
        $family_update_data = $this->cco_model->add_update_family_data();
        echo $family_update_data;
        die;
    }

    public function add_update_education_info()
    {
        $education_update_data = $this->cco_model->add_update_education_data();
        echo $education_update_data;
        die;
    }

    public function add_update_social_info()
    {
        $social_update_data = $this->cco_model->add_update_social_data();
        echo $social_update_data;
        die;
    }

    public function add_update_financial_info()
    {
        $financial_update_data = $this->cco_model->add_update_financial_detail_data();
        echo $financial_update_data;
        die;
    }

    public function add_update_retailer_info()
    {
        $retailer_update_data = $this->cco_model->add_update_retailer_detail_data();
        echo $retailer_update_data;
        die;
    }

    public function add_update_crop_farming_info()
    {
        $farmer_crop_update_data = $this->cco_model->add_update_farming_crop_detail_data();
        echo $farmer_crop_update_data;
        die;
    }

    public function add_update_business_info()
    {
        $business_update_data = $this->cco_model->add_update_business_detail_data();
        echo $business_update_data;
        die;
    }

    public function add_update_question_data()
    {
        $question_update_data = $this->cco_model->add_update_question_detail_data();
        echo $question_update_data;
        die;
    }


    public function get_address_lat_long_data()
    {
        $address = $_POST["address_data"];

        $latlong_data = $this->getLatLong($address);
        echo json_encode($latlong_data);
        die;
    }

    public function getLatLong($address)
    {
        if(!empty($address)){
            //Formatted address
            $formattedAddr = str_replace(' ','+',$address);
            //Send request and receive json data by address
          //  $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false');

            $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false');

            $output = json_decode($geocodeFromAddr);

            //Get latitude and longitute from json data
            $data['latitude']  = $output->results[0]->geometry->location->lat;
            $data['longitude'] = $output->results[0]->geometry->location->lng;
            //Return latitude and longitude of the given address
            if(!empty($data)){
                return $data;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function delete_customer_retailer_relation_data()
    {
        $retailer_relation_update_data = $this->cco_model->delete_customer_retailer_relation_data();
        echo $retailer_relation_update_data;
        die;
    }

    public function get_qualification_specialization()
    {
        $qualification_id = $_POST["qualification_id"];
        $spec_data = $this->cco_model->get_qualification_specialization_data($qualification_id);
        echo json_encode($spec_data);
        die;
    }

    public function get_campagain_allocated_data()
    {
        $campagainid = $_POST["campagainid"];

        $selectedpartner = $_POST["selectedpartner"];

        $campagain_customer_data = $this->cco_model->get_campagain_allocated_customer_data($campagainid);

        Template::set('campagain_customer_data', $campagain_customer_data);

        Template::set('selectedpartner', $selectedpartner);

        Template::set_view("cco/campagain_customer_data");
        Template::render();
    }

    public function get_activity_type_allocated_data()
    {
        $user = $user = $this->auth->user();
        $activity_type = $_POST["activity_type"];
        if($activity_type == 'planned_activity'){
            $activity_customer_data = $this->cco_model->get_activity_type_allocated_customer_data($user->id,$user->role_id,$user->country_id,$activity_type);
        }
        else{
            $activity_customer_data = $this->cco_model->get_executed_activity_allocated_customer_data($user->id,$user->role_id,$user->country_id,$activity_type);
           // testdata($activity_customer_data);
        }




        Template::set('activity_customer_data', $activity_customer_data);
        Template::set('current_user', $user);
        Template::set('activity_type', $activity_type);
        Template::set_view("cco/activity_customer_data");

        Template::render();
    }

    public function get_customer_details()
    {
        $user = $user = $this->auth->user();
        $id = $_POST["id"];
        $activity_customer_data = $this->cco_model->get_customer_details_by_id($id);
        Template::set('activity_customer_data', $activity_customer_data);
        Template::set('current_user', $user);
        Template::set_view("cco/activity_customer_sub_data");
        Template::render();
    }

    public function set_customer_data()
    {

        $phoneno = $_POST["phoneno"];
        $campagain_id = (isset($_POST["campagainid"]) && !empty($_POST["campagainid"]))?$_POST["campagainid"] :"";
        $activity_type = (isset($_POST["activity_type"]) && !empty($_POST["activity_type"]))?$_POST["activity_type"] :"";
        $action_data = (isset($_POST["action_data"]) && !empty($_POST["action_data"]))?$_POST["action_data"] :"";

        $get_caller_called_data = $this->cco_model->get_dialed_customer_data($phoneno);

        if(!empty($get_caller_called_data))
        {
            $number_status = 'TRUE';
        }
        else
        {
            $number_status = 'FALSE';
        }

        $user = $this->auth->user();
        $logined_user_type = $user->role_id;
        $logined_user_id = $user->id;
        $logined_user_countryid = $user->country_id;

        $this->session->set_userdata(array(
            'user_id' => $logined_user_id,
            'country_id' => $logined_user_countryid,
            'phone_no' => $phoneno,
            'campagain_id' => $campagain_id,
            'activity_type' => $activity_type,
            'action_data' => $action_data,
            'caller_data' => $get_caller_called_data,
            'caller_status' => $number_status
        ));

    }

    public function allocation()
    {
        Assets::add_module_js('cco', 'cco.js');

        $user = $this->auth->user();
        $logined_user_type = $user->role_id;
        $logined_user_id = $user->id;
        $logined_user_countryid = $user->country_id;

        $farmer_role = 11;

        $campagain_data = $this->cco_model->campagain_data($farmer_role,$logined_user_countryid);
        // testdata($get_level_data);

        //  $campagain_id = 1;
        $get_cco_data = $this->cco_model->get_all_cco_data($logined_user_countryid);


        Template::set('campagaine_data', $campagain_data);
        Template::set('cco_data', $get_cco_data);
        Template::render();
    }

    public function get_campagain_grid_data()
    {
        $campagain_id = $_POST["campagainid"];

        $pag = (isset($_POST['page']) ? $_POST['page'] : '');
        if ($pag > 0) {
            $page = $pag;
        } else {
            $page = 1;
        }

        $get_farmer_allocation_data = $this->cco_model->get_all_farmer_allocation_data($campagain_id, 11, $page);

        // testdata($get_farmer_allocation_data);
        Template::set('table', $get_farmer_allocation_data);

        Template::set('td', $get_farmer_allocation_data['count']);
        Template::set('pagination', (isset($get_farmer_allocation_data['pagination']) && !empty($get_farmer_allocation_data['pagination'])) ? $get_farmer_allocation_data['pagination'] : '');

        Template::set_view("cco/allocation");
        Template::render();
        //die;
    }

    public function get_level_data()
    {
        $campagainid = $_POST["campagainid"];
        $leveldata = $_POST["leveldata"];
        // $leveldata = 1;
        $get_level_data = $this->cco_model->level_data($campagainid, $leveldata);

        echo json_encode($get_level_data);
        die;
        // testdata($get_level_data);

    }

    public function get_questions_detail_view_data()
    {

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"]))? $_POST["customerid"] : "";
        $campagain_id = (isset($_POST["campagain_id"]) && !empty($_POST["campagain_id"]))? $_POST["campagain_id"] : "";
        $campagain_phase_data = $this->cco_model->get_campagain_phasedata($campagain_id);

       // testdata($campagain_phase_data);

        Template::set('campagain_phase_data', $campagain_phase_data);

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_questions_details");
        Template::render();

    }

    public function get_phase_question_data()
    {
        $phaseid = $_POST["phaseid"];
        $campagain_id = $_POST["campagain_id"];

        $customer_id= (isset($this->session->userdata['caller_data']['0']['id']) && !empty($this->session->userdata['caller_data']['0']['id']))? $this->session->userdata['caller_data']['0']['id'] : "";

        $campagain_phase_question_data = $this->cco_model->get_campagain_phase_question_data($phaseid,$campagain_id);

      //  testdata($campagain_phase_question_data);
        $html = "";
        if(!empty($campagain_phase_question_data))
        {
            $i = 1;
            foreach($campagain_phase_question_data as $ques_key => $question_data)
            {

                //GET QUESTION ANSWER
                $question_answer_data = array();
                $customer_anwer = "";

                if($customer_id != "")
                {
                    $question_answer_data = $this->cco_model->get_question_user_answer_data($question_data["question_id"], $customer_id);
                    if(!empty($question_answer_data)) {
                        $customer_anwer = $question_answer_data[0]["customer_answer"];
                    }
                    else{
                        $customer_anwer = "";
                    }
                }


                if($question_data["question_type"] == "text")
                {
                    $html .= '<li>';
                    $html .= '<ul class="fn-ques-ans">';
                    $html .= '<li class="qsh-txt">Q '.$i.'</li>';
                    $html .= '<li style="width: auto;"> '.$question_data["question"].'</li>';
                    $html .= '</ul>';
                    $html .= '<ul class="fn-ques-ans">';
                    $html .= '<li class="qsh-txt">Ans.</li>';
                    $html .= '<li class="ansh-txt"><input type="hidden" name="question_id[]" value="'.$question_data["question_id"].'" /><input class="form-control" name="question_answer['.$question_data["question_id"].']" id="question_answer" placeholder="" type="text" value="'.$customer_anwer.'"></li>';
                    $html .= '</ul>';
                    $html .= '<div class="clearfix"></div>';
                    $html .= '</li>';
                }
                else if($question_data["question_type"] == "radio")
                {

                    $option_data = $this->cco_model->get_question_options($question_data["question_id"]);

                    $html .= '<li>';
                        $html .= '<ul class="fn-ques-ans">';
                            $html .= '<li class="qsh-txt">Q '.$i.'</li>';
                            $html .= '<li style="width: auto;"><input type="hidden" name="question_id[]" value="'.$question_data["question_id"].'" /> '.$question_data["question"].'</li>';
                        $html .= '</ul>';
                        $html .= '<ul class="fn-ques-ans">';
                            $html .= '<li class="qsh-txt">Ans.</li>';
                            $html .= '<li class="ansh-txt">';
                                $html .= '<div class="radio_space">';

                                    if(!empty($option_data))
                                    {
                                        foreach($option_data as $option_key => $option_data)
                                        {
                                            $selected = '';
                                            if($customer_anwer == $option_data)
                                            {
                                                $selected = 'checked="checked"';
                                            }

                                            $html .= '<div class="radio">';
                                            $html .= '<input '.$selected.' class="select_customer_type" name="question_answer['.$question_data["question_id"].']" id="radio_'.$option_data["option_id"].'" value="'.$option_data["option_id"].'" type="radio">';
                                            $html .= '<label for="radio'.$option_data["option_id"].'">'.$option_data["option_data"].'</label>';
                                            $html .= '</div>';
                                        }
                                    }

                                    $html .= '<div class="clearfix"></div>';
                                $html .= '</div>';
                                $html .= '<div class="clearfix"></div>';
                            $html .= '</li>';
                        $html .= '</ul>';
                        $html .= '<div class="clearfix"></div>';
                    $html .= '</li>';
                }
                else if($question_data["question_type"] == "checkbox")
                {
                    $option_data = $this->cco_model->get_question_options($question_data["question_id"]);


                    $html .= '<li>';
                    $html .= '<ul class="fn-ques-ans">';
                    $html .= '<li class="qsh-txt">Q '.$i.'</li>';
                    $html .= '<li style="width: auto;"><input type="hidden" name="question_id[]" value="'.$question_data["question_id"].'" /> '.$question_data["question"].'</li>';
                    $html .= '</ul>';
                    $html .= '<ul class="fn-ques-ans">';
                    $html .= '<li class="qsh-txt">Ans.</li>';
                    $html .= '<li class="ansh-txt">';
                    $html .= '<div class="radio_space">';

                    if(!empty($option_data)){

                        foreach($option_data as $option_key => $option_data)
                        {
                            $selected1 = "";

                            if($customer_anwer != "")
                            {
                                $customer_anwer1 =  explode(",",$customer_anwer);
                            }

                            if(in_array($option_data["option_id"],$customer_anwer1))
                            {
                                $selected1 = 'checked="checked"';
                            }

                            $html .= '<div class="">';
                            $html .= '<input '.$selected1.' class="select_customer_type" name="question_answer['.$question_data["question_id"].'][]" id="checkbox_'.$option_data["option_id"].'" value="'.$option_data["option_id"].'" type="checkbox">';
                            $html .= '<label for="checkbox'.$option_data["option_id"].'">'.$option_data["option_data"].'</label>';
                            $html .= '</div>';
                        }

                    }

                    $html .= '<div class="clearfix"></div>';
                    $html .= '</div>';
                    $html .= '<div class="clearfix"></div>';
                    $html .= '</li>';
                    $html .= '</ul>';
                    $html .= '<div class="clearfix"></div>';
                    $html .= '</li>';

                }
                $i++;
            }
        }

        echo $html;
        die;
    }

    public function get_phase_script_data()
    {
        $phaseid = $_POST["phaseid"];
        $campagain_id = $_POST["campagain_id"];

        $phase_script_data = $this->cco_model->get_phase_script_data($phaseid);

        echo json_encode($phase_script_data);
        die;
    }

    public function get_active_phase_data()
    {
        $campagain_id = $_POST["campagain_id"];

        $phase_active_data = $this->cco_model->get_campagain_active_phase_data($campagain_id);

        echo json_encode($phase_active_data);
        die;
    }

    public function get_level_data_for_unkown_no()
    {

        $leveldata = $_POST["leveldata"];

        $user = $this->auth->user();

        // $leveldata = 1;
        $get_level_data = $this->cco_model->level_data_for_unkown($leveldata,$user->country_id);

        echo json_encode($get_level_data);
        die;
        // testdata($get_level_data);

    }

    public function get_next_level_data()
    {
        $parentgeoid = $_POST["parentgeoid"];

        $get_level_data = $this->cco_model->get_child_data($parentgeoid);

        echo json_encode($get_level_data);
        die;
    }

    public function get_level_employee_data()
    {
        $parentgeoid = $_POST["parentgeoid"];

        $page = (isset($_POST["page"]) && !empty($_POST["page"])) ? $_POST["page"] : '';

        $get_employee_data = $this->cco_model->geo_employee_data($parentgeoid,'employee',$page);

        Template::set('table', $get_employee_data);

        Template::set('td', $get_employee_data['count']);
        Template::set('pagination', (isset($get_employee_data['pagination']) && !empty($get_employee_data['pagination'])) ? $get_employee_data['pagination'] : '' );

        Template::set_view("cco/main_screen_dialpad");
        Template::render();
    }

    public function get_next_level_geo_data()
    {
        $parentgeoid = $_POST["parentgeoid"];
        $level = $_POST["leveldata"];
        $selectedtype = isset($_POST["selectedtype"]) ? $_POST["selectedtype"] : NULL;

        $get_level_data = $this->cco_model->get_geo_level_data($parentgeoid,$level,$selectedtype);

        echo json_encode($get_level_data);
        die;
    }

    public function get_level_farmer_count()
    {
        $geoid = $_POST["geo_id"];
        $level = $_POST["leveldata"];
        $selectedtype = isset($_POST["selectedtype"]) ? $_POST["selectedtype"] : NULL;

        $farmer_data_count = $this->cco_model->get_farmer_count($geoid, $level, $selectedtype);

        if ($farmer_data_count != 0) {
            echo json_encode($farmer_data_count);
        } else {
            echo 0;
        }
        die;

    }

    public function add_allocation()
    {

        $campagain_data = $_POST["campagain_data"];
        $level_1 = $_POST["level_1"];
        $cco_data = $_POST["cco_data"];

        $selected_type = isset($_POST["selected_type"]) ? $_POST["selected_type"] : NULL;

        $final_array = array();

        if (!empty($campagain_data) && !empty($level_1) && !empty($cco_data)) {

            foreach ($level_1 as $key => $geo_data) {
                $geo_farmer_data = $this->cco_model->geo_farmer_data($geo_data, $selected_type);
                //testdata($geo_farmer_data);
                if ($geo_farmer_data != 0) {
                    foreach ($geo_farmer_data as $f_key => $farmerdata) {
                        $farmer_id = $farmerdata["id"];

                        //CHECK FARMER ALREADY ALLOCATED TO SOME CCO FOR SAME CAMPAGAIN

                        $check_allocation_data = $this->cco_model->check_customer_allocation_data($farmer_id, $campagain_data);
                        if ($check_allocation_data == 0) {
                            //ASSIGIN CCO, CAMPAGAIN TO FARMERS
                            $data = $this->cco_model->add_customer_allocation_data($farmer_id, $campagain_data, $cco_data, $geo_data);
                            $final_array[] = $data;
                        }
                    }
                }
            }
        }

        if (in_array(1, $final_array)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete_allocation_data()
    {
        $allocation_id = $_POST["allocation_id"];
        $data = $this->cco_model->delete_allocation($allocation_id);
        echo $data;
        die;
    }

    public function channel_partner_allocation()
    {
        Assets::add_module_js('cco', 'cco_channel_partner.js');

        $user = $this->auth->user();
        $logined_user_type = $user->role_id;
        $logined_user_id = $user->id;
        $logined_user_countryid = $user->country_id;

        $user_role = 10;
        $campagain_data = $this->cco_model->campagain_data($user_role,$logined_user_countryid);
        // testdata($get_level_data);

        //  $campagain_id = 1;
        $get_cco_data = $this->cco_model->get_all_cco_data($logined_user_countryid);


        Template::set('campagaine_data', $campagain_data);
        Template::set('cco_data', $get_cco_data);
        Template::render();
    }

    public function get_channel_campagain_data()
    {

        $user = $this->auth->user();

        $user_role = $_POST["roledata"];
        $campagain_data = $this->cco_model->campagain_data($user_role,$user->country_id);

        if ($campagain_data != 0) {
            echo json_encode($campagain_data);
        } else {
            echo 0;
        }
        die;
    }

    public function allocation_activity()
    {
        Assets::add_module_js('cco','allocation_activity.js');
        $user= $this->auth->user();
        $activity = $this->ecp_model->activity_type_details($user->country_id);

        $cco_data = $this->cco_model->get_all_cco_data($user->country_id);

        Template::set('cco_data', $cco_data);

        Template::set('activity_type',$activity);
        Template::set_view('cco/allocation_activity');
        Template::render();

    }

    public function work_allocation()
    {
        $user= $this->auth->user();
        $work_allocation= $this->cco_model->get_all_work_allocation($user->country_id);

        /*Template::set('table', $activity);

        Template::set('td', $activity['count']);
        Template::set('pagination', (isset($activity['pagination']) && !empty($activity['pagination'])) ? $activity['pagination'] : '' );
        */
        Template::set('work_allocation', $work_allocation);
        Template::set_view("cco/work_allocation_summary");
        Template::render();
    }

    public function allocation_activity_view()
    {
        $user= $this->auth->user();

        $radio_check = (isset($_POST['radio1']) && !empty($_POST['radio1'])) ? $_POST['radio1'] : 'planned_activity';

        $form_dt = ((isset($_POST['from_date']) && !empty($_POST['from_date'])) ? $_POST['from_date'] : '');
        $f_date = str_replace('/', '-', $form_dt);
        $from_date = date('Y-m-d', strtotime($f_date));

        $to_dt = ((isset($_POST['to_date']) && !empty($_POST['to_date'])) ? $_POST['to_date'] : '');
        $t_date = str_replace('/', '-', $to_dt);
        $to_date = date('Y-m-d', strtotime($t_date));

        $activity_type = (isset($_POST['activity_type']) && !empty($_POST['activity_type'])) ? $_POST['activity_type'] : '';
        $page= (isset($_POST['page']) && !empty($_POST['page'])) ? $_POST['page'] : '';
        $activity = $this->ecp_model->get_all_activity_details($radio_check,$from_date,$to_date,$activity_type,$user->country_id,$user->local_date,$page);

       // testdata($activity);
        Template::set('table', $activity);

        Template::set('td', $activity['count']);
        Template::set('pagination', (isset($activity['pagination']) && !empty($activity['pagination'])) ? $activity['pagination'] : '' );

        Template::set_view("cco/allocation_activity");
        Template::render();

    }

    public function add_cco_activity_details()
    {
        //testdata($_POST);
        $user =  $this->auth->user();
        $data = $this->cco_model->add_cco_allocation_activity_details($user->id,$user->country_id);
        echo $data;
        die;
    }

    public function get_activity_by_type()
    {
        $user =  $this->auth->user();

        $activity_type =  (isset($_POST['activity_type']) && !empty($_POST['activity_type'])) ? $_POST['activity_type'] : 'planned_activity';
        $page = (isset($_POST['page']) && !empty($_POST['page'])) ? $_POST['page'] : '';

        $cco_activity = $this->cco_model->get_activity_details_by_type($user->id,$user->country_id,$activity_type,$page,$user->local_date);

        Template::set('table', $cco_activity);

        Template::set('td', $cco_activity['count']);
        Template::set('pagination', (isset($cco_activity['pagination']) && !empty($cco_activity['pagination'])) ? $cco_activity['pagination'] : '' );

            Template::set_view("cco/allocation_activity");
            Template::render();
    }

    public function delete_activity_allocation()
    {
        $allocation_id = $_POST["selected_cco"];
        $data = $this->cco_model->delete_activity_allocations($allocation_id);
        echo $data;
        die;
    }

    public function activity_allocation_details_csv_report()
    {
        $this->load->library('excel');
        $user = $this->auth->user();


        $activity_type = (isset($_GET['activity_type']) ? $_GET['activity_type'] : 'planned_activity');

        $page = (isset($_GET['page']) ? $_GET['page'] : '');

        $cco_activity = $this->cco_model->get_activity_details_by_type($user->id,$user->country_id,$activity_type,$page,$user->local_date,'csv');

        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Activity Allocation');

        if(!empty($cco_activity) && isset($cco_activity))
        {
            $this->excel->getActiveSheet()->setCellValue('A1',$cco_activity['head'][0]);
            $this->excel->getActiveSheet()->setCellValue('B1',$cco_activity['head'][1]);
            $this->excel->getActiveSheet()->setCellValue('C1',$cco_activity['head'][2]);
            $this->excel->getActiveSheet()->setCellValue('D1',$cco_activity['head'][3]);
            $this->excel->getActiveSheet()->setCellValue('E1',$cco_activity['head'][4]);
            $this->excel->getActiveSheet()->setCellValue('F1',$cco_activity['head'][5]);
            $this->excel->getActiveSheet()->setCellValue('G1',$cco_activity['head'][6]);
            $this->excel->getActiveSheet()->setCellValue('H1',$cco_activity['head'][7]);
        }

        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setSize(12);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);

        foreach(range('A1','H1') as $columnID) {
            $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        if(!empty($cco_activity))
        {
            foreach($cco_activity['row'] as $k=>$row)
            {
                $this->excel->getActiveSheet()->setCellValue('A'.($k+2), $row['0']);
                $this->excel->getActiveSheet()->setCellValue('B'.($k+2), $row['1']);
                $this->excel->getActiveSheet()->setCellValue('C'.($k+2), $row['2']);
                $this->excel->getActiveSheet()->setCellValue('D'.($k+2), $row['3']);
                $this->excel->getActiveSheet()->setCellValue('E'.($k+2), $row['4']);
                $this->excel->getActiveSheet()->setCellValue('F'.($k+2), $row['5']);
                $this->excel->getActiveSheet()->setCellValue('G'.($k+2), $row['6']);
                $this->excel->getActiveSheet()->setCellValue('H'.($k+2), $row['7']);
            }
        }

        $filename='activity_allocation_'.date('d-m-y').'.xlsx';
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

    public function work_transfer_allocation()
    {
        Assets::add_module_js('cco','work_transfer.js');
        $user= $this->auth->user();

        $cco_data = $this->cco_model->get_all_cco_data($user->country_id);
        $page = (isset($_POST['page']) ? $_POST['page'] : '');

        $transfer_data = $this->cco_model->get_all_transfer_cco_data($user->country_id,$user->local_date,$page);


        Template::set('table', $transfer_data);

        Template::set('td', $transfer_data['count']);
            Template::set('pagination', (isset($transfer_data['pagination']) && !empty($transfer_data['pagination'])) ? $transfer_data['pagination'] : '' );

        Template::set('cco_data', $cco_data);
        Template::set_view("cco/work_transfer");
        Template::render();
    }

    public function get_allocated_work()
    {
        $cco = $this->input->post('cco');
        $cco_work_data = $this->cco_model->get_all_work_allocation_to_cco($cco);

        Template::set('cco_work_details', $cco_work_data);
        Template::set_view("cco/work_transfer");
        Template::render();

    }

    public function get_cco_allocated_work()
    {
        $user= $this->auth->user();
        $cco_id = $this->input->post('cco_id');
        $cco_work_data = $this->cco_model->get_cco_work_allocation($user->country_id,$cco_id);

        Template::set('cco_work_transfer', $cco_work_data);
        Template::set_view("cco/work_transfer");
        Template::render();
    }

    public function add_work_transfer_data(){
        $user= $this->auth->user();
        $insert = $this->cco_model->add_work_transfer_data_allocation($user->id,$user->country_id);
        echo $insert;
        die;
    }

    public function add_reminder()
    {
        $user= $this->auth->user();

        if(isset($_POST['reminder_type'])){
            if($_POST['reminder_type']=='delete'){
                $this->cco_model->delete_reminder();
            } else {
                $this->cco_model->save_reminder();
            }
            echo 1;
            exit;
        }

        $reminder_detail = $this->cco_model->get_reminder();

        Template::set('pg', $this->input->post('pg'));
        Template::set('current_user', $user);
        Template::set('reminder_data', (isset($reminder_detail['result']) ? $reminder_detail['result'] : array()));
        Template::set('reminder_data_pagination', (isset($reminder_detail['pagination']) ? $reminder_detail['pagination'] : ''));

        Template::set_view("cco/dialpad/add_reminder");
        Template::render();
    }




   /* public function activity()
    {
        Template::render();
    }*/

}