<?php defined('BASEPATH') || exit('No direct script access allowed');

class Esp_model extends BF_Model
{

    public function __construct()
    {

        parent::__construct();
        $config=array();
        $this->load->library("CH_Grid_generator", $config, "grid");
    }
    
    public function get_user_data($userid){
        
        $this->db->select("*");
        $this->db->from("bf_master_employee_reporting_person");
        $this->db->where("reporting_user_id",$userid);
        $user_level_data = $this->db->get()->result_array();
        
        if(isset($user_level_data) && !empty($user_level_data)) {
            return $user_level_data;
        } else{
            return 0;
        }
        
    }
}