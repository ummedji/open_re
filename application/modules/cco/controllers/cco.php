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
        Assets::add_module_js('cco', 'cco.js');
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

    public function dialpad()
    {
        Template::render();
    }

    public function allocation()
    {
        $user= $this->auth->user();
        $logined_user_type = $user->role_id;
        $logined_user_id = $user->id;
        $logined_user_countryid = $user->country_id;

        $campagain_data = $this->cco_model->campagain_data();
       // testdata($get_level_data);

      //  $campagain_id = 1;
        $get_cco_data = $this->cco_model->get_all_cco_data($logined_user_countryid);

        Template::set('campagaine_data',$campagain_data);
        Template::set('cco_data',$get_cco_data);
        Template::render();
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
        $farmer_data_count = $this->cco_model->get_farmer_count($geoid,$level);
        echo $farmer_data_count;
        die;

    }

    public function add_allocation()
    {
        $campagain_data = $_POST["campagain_data"];
        $level_1 = $_POST["level_1"];
        $cco_data = $_POST["cco_data"];

        if(!empty($campagain_data) && !empty($level_1) && !empty($cco_data))
        {

            foreach($level_1 as $key => $geo_data)
            {

                $geo_farmer_data = $this->db->geo_farmer_data($geo_data);


            }

        }

    }

    public function activity()
    {
        Template::render();
    }



}