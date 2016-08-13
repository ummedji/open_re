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
        $logined_user_type = $user->role_id;
        $logined_user_id = $user->id;
        $logined_user_countryid = $user->country_id;

        $farmer_role = 11;

        $campagain_data = $this->cco_model->campagain_data($farmer_role,$logined_user_countryid);

        Template::set('campagaine_data', $campagain_data);
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

    public function get_customer_general_detail_data()
    {
        $customer_id = $_POST["customerid"];

        $get_personal_general_data = $this->cco_model->get_personal_general_data($customer_id);

        Template::set('personal_general_data', $get_personal_general_data);

      //  $this->load->view('cco/dialpad_popup_views/general_details');

        Template::set_view("cco/dialpad_general_details");
        // Template::set_block('sidebar', 'blog_sidebar');
        Template::render();
    }

    public function get_customer_family_detail_data()
    {
        $customer_id = $_POST["customerid"];

        $get_personal_family_data = $this->cco_model->get_personal_family_data($customer_id);

        Template::set('personal_family_data', $get_personal_family_data);
        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad_family_details");
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
        Template::set('education_qualification_data', $get_education_qualification_data);

        Template::set('customer_id', $customer_id);

        Template::set_view("cco/dialpad_eductaion_details");
        Template::render();

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

    public function get_campagain_allocated_data()
    {
        $campagainid = $_POST["campagainid"];
        $campagain_customer_data = $this->cco_model->get_campagain_allocated_customer_data($campagainid);

        Template::set('campagain_customer_data', $campagain_customer_data);

        Template::set_view("cco/campagain_customer_data");
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






    public function activity()
    {
        Template::render();
    }


}