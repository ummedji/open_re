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

        $get_sidebar_selected_customer_data = $this->cco_model->get_dialed_customer_data($phone_no);

        Template::set('sidebar_selected_customer_data', $get_sidebar_selected_customer_data);
        Template::set('selected_campagain_data', $campagain_id);

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
    public function get_customer_complaint_data_edit()
    {   $user=$this->auth->user();
        /*$logged_in_user=$user->display_name;*/
        $complaint_id = $_POST["complaint_id"];
        $complaint_data = $this->cco_model->get_complaint_data_edit($complaint_id);
        echo json_encode($complaint_data);
        die;
    }

    public function get_customer_feedback_data()
    {   $user=$this->auth->user();
        /*$logged_in_user=$user->display_name;*/
        $customer_id = $_POST["customerid"];
        $page = (isset($_POST["page"]) && !empty($_POST["page"])) ? $_POST["page"] : '';

        $get_user_data = $this->cco_model->get_user_data($customer_id);

        $feedback_data = $this->cco_model->get_feedback_data($customer_id,$page,$user->local_date,$user->country_id);

     //   testdata($feedback_data);
        Template::set('get_user_data', $get_user_data);
        Template::set('customer_id', $customer_id);
        //Template::set('get_feedback_data', $get_feedback_data);

        Template::set('table', $feedback_data);

        Template::set('td', $feedback_data['count']);
        Template::set('pagination', (isset($feedback_data['pagination']) && !empty($feedback_data['pagination'])) ? $feedback_data['pagination'] : '' );

        Template::set_view("cco/dialpad/dialpad_feedback_details");
        Template::render();
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
    public function add_update_complaint_view_info()
    {

        $feedback_update_data = $this->cco_model->add_update_complaint_data();
        echo $feedback_update_data;
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
        $customer_id = $_POST["customerid"];

        $get_personal_general_data = $this->cco_model->get_personal_general_data($customer_id);

        Template::set('personal_general_data', $get_personal_general_data);

      //  $this->load->view('cco/dialpad_popup_views/general_details');

        Template::set_view("cco/dialpad/dialpad_general_details");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();
    }

    public function get_customer_family_detail_data()
    {
        $customer_id = $_POST["customerid"];

        $get_personal_family_data = $this->cco_model->get_personal_family_data($customer_id);

        Template::set('personal_family_data', $get_personal_family_data);
        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_family_details");
        Template::render();
    }

    public function get_customer_education_detail_data()
    {
        $user = $this->auth->user();

        $customer_id = $_POST["customerid"];

        $get_personal_education_data = $this->cco_model->get_personal_education_data($customer_id);

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

        $customer_id = $_POST["customerid"];

        $get_social_data = $this->cco_model->get_customer_social_data($customer_id);

        Template::set('social_data', $get_social_data);

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_social_details");
        Template::render();
    }

    public function get_customer_complaint_detail_data()
    {
        $user = $this->auth->user();

        $customer_id = $_POST["customerid"];


        $random_complaint_no = $this->get_complaint_no();


        $get_customer_complaint_data= $this->cco_model->get_customer_social_data($customer_id);
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

        $customer_id = $_POST["customerid"];

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

        $customer_id = $_POST["customerid"];

        $get_all_electronic_data = $this->cco_model->get_electronic_data();
        $get_all_vehicles_data = $this->cco_model->get_vehicles_data();

        $get_customer_pa_income = $this->cco_model->get_customer_pa_income_data($customer_id);

        $get_financial_electronic_data = $this->cco_model->get_customer_financial_electronic_data($customer_id);
        $get_financial_vechiles_data = $this->cco_model->get_customer_financial_vehicles_data($customer_id);

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

        $customer_id = $_POST["customerid"];

        $get_user_data = $this->cco_model->get_user_data($customer_id);

        $customer_level_2 = (isset($get_user_data[0]["geo_level_id2"]) && !empty($get_user_data[0]["geo_level_id2"]))? $get_user_data[0]["geo_level_id2"] : "";

        if($customer_level_2 != "")
        {
            $user_role = 10;
            $get_retailer_data = $this->cco_model->get_customer_location_retailer_data($customer_id,$user_role,$customer_level_2);
        }
        else
        {
            $get_retailer_data = "";
        }

        $get_customer_retailer_relation_data = $this->cco_model->customer_relation_retailer_data($customer_id,$user_role);

        Template::set('customer_relation_retailer_data', $get_customer_retailer_relation_data);

        Template::set('customer_retailer_data', $get_retailer_data);

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_retailer_details");
        Template::render();
    }


    public function get_customer_farming_view_data()
    {

        $customer_id = $_POST["customerid"];

        $get_customer_farming_data = $this->cco_model->get_customer_farming_data($customer_id);

        $get_all_crop_data = $this->cco_model->get_all_crop_data($customer_id);

        $get_allocated_crop_data = $this->cco_model->customer_crop_data($customer_id);

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
        $customer_id = $_POST["customerid"];

        $geo_level = $this->cco_model->get_geo_by_customer_id($customer_id);

        Template::set('geo_level', $geo_level);
        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_activity_detail");
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
        $customer_id = $_POST["customerid"];

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_disease_details");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();
    }

    public function get_diseases_detail_data()
    {
        $search_data = $_POST["searchdata"];
        $customerid = $_POST["customerid"];

        $searched_data = $this->cco_model->get_search_disease_detail($search_data,$customerid);

        Template::set('searched_data', $searched_data);
        Template::set('search_type', 'disease');

        Template::set_view("cco/dialpad/table_layout");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();

    }

    public function get_product_detail_view_data()
    {
        $customer_id = $_POST["customerid"];

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad/dialpad_product_details");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();
    }

    public function get_product_detail_data()
    {
        $search_data = $_POST["searchdata"];
        $customerid = $_POST["customerid"];

        $searched_data = $this->cco_model->get_search_product_detail($search_data,$customerid);

        Template::set('searched_data', $searched_data);
        Template::set('search_type', 'product');

        Template::set_view("cco/dialpad/table_layout");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();

    }


    public function get_customer_order_status_data()
    {
        $customer_id = $_POST["customerid"];
        $search_data = $_POST["searchdata"];



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

        $default_order_data = $this->cco_model->get_order_data($customer_id,$page,$search_data);

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

    public function get_customer_order_place_data()
    {
        $customer_id = $_POST["customerid"];

        $user = $this->auth->user();

        $get_customer_retailer_data = $this->cco_model->get_customer_retailer_data($customer_id);
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
        $this->load->library('session');

        $phoneno = $_POST["phoneno"];
        $campagain_id = $_POST["campagainid"];
        $user = $this->auth->user();
        $logined_user_type = $user->role_id;
        $logined_user_id = $user->id;
        $logined_user_countryid = $user->country_id;

        $this->session->set_userdata(array(
            'user_id' => $logined_user_id,
            'country_id' => $logined_user_countryid,
            'phone_no' => $phoneno,
            'campagain_id' => $campagain_id
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

    public function get_next_level_data()
    {
        $parentgeoid = $_POST["parentgeoid"];

        $get_level_data = $this->cco_model->get_child_data($parentgeoid);

        echo json_encode($get_level_data);
        die;
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

        Template::set('cco_data', $cco_data);
        Template::set_view("cco/work_transfer");
        Template::render();
    }






    public function activity()
    {
        Template::render();
    }


}