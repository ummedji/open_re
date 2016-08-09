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

        $campagain_data = $this->cco_model->campagain_data();
       // testdata($get_level_data);

      //  $campagain_id = 1;
      //  $get_level_data = $this->cco_model->level_data($campagain_id);

        Template::set('campagaine_data',$campagain_data);
      //  Template::set('highest_geo_level_data',$get_level_data);
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


    public function activity()
    {
        Template::render();
    }



}