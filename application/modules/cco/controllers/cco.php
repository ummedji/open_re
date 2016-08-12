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
       // $this->load->model('ishop/ishop_model');
      //  $this->load->model('esp/esp_model');

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

        $user= $this->auth->user();
        $logined_user_type = $user->role_id;
        $logined_user_id = $user->id;
        $logined_user_countryid = $user->country_id;

        $farmer_role = 11;

        $campagain_data = $this->cco_model->campagain_data($farmer_role);

        Template::set('campagaine_data',$campagain_data);
        Template::set_view("cco/main_screen_dialpad");
        Template::render();
    }

    public function dialpad()
    {
        Assets::add_module_js('cco', 'cco_dialpad.js');

        $customer_id = $this->session->userdata("customer_id");

        $get_sidebar_selected_customer_data = $this->cco_model->get_dialed_customer_data($customer_id);

        Template::set('sidebar_selected_customer_data',$get_sidebar_selected_customer_data);
        Template::set_view("cco/dialpad");
        Template::render();
    }

    public function get_customer_general_detail_data()
    {
        $customer_id = $_POST["customerid"];

        $get_personal_general_data = $this->cco_model->get_personal_general_data($customer_id);

        Template::set('get_personal_general_data',$get_personal_general_data);

        Template::set_view("cco/dialpad_popup_views/general_details");
        Template::render();
    }

    public function get_campagain_allocated_data()
    {
        $campagainid = $_POST["campagainid"];
        $campagain_customer_data = $this->cco_model->get_campagain_allocated_customer_data($campagainid);

        Template::set('campagain_customer_data',$campagain_customer_data);

        Template::set_view("cco/campagain_customer_data");
        Template::render();
    }

    public function set_customer_data()
    {
        $this->load->library('session');

        $customerid = $_POST["customerid"];
        $campagain_id = $_POST["campagainid"];
        $user= $this->auth->user();
        $logined_user_type = $user->role_id;
        $logined_user_id = $user->id;
        $logined_user_countryid = $user->country_id;

        $this->session->set_userdata(array(
            'user_id'       => $logined_user_id,
            'country_id'    => $logined_user_countryid,
            'customer_id'      => $customerid,
            'campagain_id'  => $campagain_id
        ));

    }

    public function allocation()
    {
        Assets::add_module_js('cco', 'cco.js');

        $user= $this->auth->user();
        $logined_user_type = $user->role_id;
        $logined_user_id = $user->id;
        $logined_user_countryid = $user->country_id;

        $farmer_role = 11;

        $campagain_data = $this->cco_model->campagain_data($farmer_role);
       // testdata($get_level_data);

      //  $campagain_id = 1;
        $get_cco_data = $this->cco_model->get_all_cco_data($logined_user_countryid);


        Template::set('campagaine_data',$campagain_data);
        Template::set('cco_data',$get_cco_data);
        Template::render();
    }

    public function get_campagain_grid_data()
    {
        $campagain_id = $_POST["campagainid"];

        $pag = (isset($_POST['page']) ? $_POST['page'] : '');
        if($pag > 0)
        {
            $page = $pag;
        }
        else{
            $page = 1;
        }

        $get_farmer_allocation_data = $this->cco_model->get_all_farmer_allocation_data($campagain_id,11,$page);

        // testdata($get_farmer_allocation_data);
        Template::set('table', $get_farmer_allocation_data);

        Template::set('td', $get_farmer_allocation_data['count']);
        Template::set('pagination', (isset($get_farmer_allocation_data['pagination']) && !empty($get_farmer_allocation_data['pagination'])) ? $get_farmer_allocation_data['pagination'] : '' );

        Template::set_view("cco/allocation");
        Template::render();
        //die;
    }

    public function get_level_data()
    {
        $campagainid = $_POST["campagainid"];
        $leveldata = $_POST["leveldata"];
       // $leveldata = 1;
        $get_level_data = $this->cco_model->level_data($campagainid,$leveldata);

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
        $selectedtype = isset($_POST["selectedtype"])? $_POST["selectedtype"]: NULL ;

        $farmer_data_count = $this->cco_model->get_farmer_count($geoid,$level,$selectedtype);

        if($farmer_data_count != 0)
        {
            echo json_encode($farmer_data_count);
        }
        else
        {
            echo 0;
        }
        die;

    }

    public function add_allocation()
    {

        $campagain_data = $_POST["campagain_data"];
        $level_1 = $_POST["level_1"];
        $cco_data = $_POST["cco_data"];

        $selected_type = isset($_POST["selected_type"])? $_POST["selected_type"]: NULL;

        $final_array = array();

        if(!empty($campagain_data) && !empty($level_1) && !empty($cco_data))
        {

            foreach($level_1 as $key => $geo_data)
            {
                $geo_farmer_data = $this->cco_model->geo_farmer_data($geo_data,$selected_type);
                //testdata($geo_farmer_data);
                if($geo_farmer_data != 0)
                {
                    foreach($geo_farmer_data as $f_key => $farmerdata)
                    {
                        $farmer_id = $farmerdata["id"];

                        //CHECK FARMER ALREADY ALLOCATED TO SOME CCO FOR SAME CAMPAGAIN

                        $check_allocation_data = $this->cco_model->check_customer_allocation_data($farmer_id,$campagain_data);
                        if($check_allocation_data == 0)
                        {
                            //ASSIGIN CCO, CAMPAGAIN TO FARMERS
                            $data = $this->cco_model->add_customer_allocation_data($farmer_id,$campagain_data,$cco_data,$geo_data);
                            $final_array[] = $data;
                        }
                    }
                }
            }
        }

        if(in_array(1,$final_array))
        {
            return 1;
        }
        else{
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

        $user= $this->auth->user();
        $logined_user_type = $user->role_id;
        $logined_user_id = $user->id;
        $logined_user_countryid = $user->country_id;

        $user_role = 10;
        $campagain_data = $this->cco_model->campagain_data($user_role);
        // testdata($get_level_data);

        //  $campagain_id = 1;
        $get_cco_data = $this->cco_model->get_all_cco_data($logined_user_countryid);


        Template::set('campagaine_data',$campagain_data);
        Template::set('cco_data',$get_cco_data);
        Template::render();
    }

    public function get_channel_campagain_data()
    {
        $user_role = $_POST["roledata"];
        $campagain_data = $this->cco_model->campagain_data($user_role);

        if($campagain_data != 0)
        {
           echo json_encode($campagain_data);
        }
        else
        {
            echo 0;
        }
        die;
    }


    public function activity()
    {
        Template::render();
    }



}