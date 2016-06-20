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
        
        $this->db->select("bu.id,bu.display_name");
        $this->db->from("bf_master_employee_reporting_person as bmerp");
        $this->db->join("bf_users as bu",'bu.id = bmerp.user_id');
        $this->db->where("bmerp.reporting_user_id",$userid);
        $this->db->where("bmerp.to_date",NULL);
        $user_level_data = $this->db->get()->result_array();
        
        if(isset($user_level_data) && !empty($user_level_data)) {
            return $user_level_data;
        } else{
            return 0;
        }
    }
    
    public function get_pbg_data($user_country){
        
        $this->db->select('bmptnc.product_country_id,bmptnc.product_country_name');
        $this->db->from("bf_master_product_type_name_country as bmptnc");
        $this->db->join("bf_master_product_type_name_regional as bmptnr","bmptnr.product_regional_id = bmptnc.product_regional_id");
        
        $this->db->join("bf_master_product_type_label_country as bmptlc","bmptlc.product_type_label_country_id = bmptnr.product_type_label_regional_id ");
        
        $this->db->where("bmptnc.country_id",$user_country);
        $this->db->where("bmptlc.PBG",1);
        $pbg_data = $this->db->get()->result_array();
        
        if(isset($pbg_data) && !empty($pbg_data)) {
            return $pbg_data;
        } else{
            return 0;
        }
        
    }
    
    public function get_pbg_sku_data($pbgid){
        
        $this->db->select('bmpsc.product_sku_name,bmpsc.product_sku_country_id');
        $this->db->from("bf_master_product_sku_country as bmpsc");
        
        $this->db->or_where("bmpsc.product_regional_id1",$pbgid);
        $this->db->or_where("bmpsc.product_regional_id2",$pbgid);
        $this->db->or_where("bmpsc.product_regional_id3",$pbgid);
        $this->db->or_where("bmpsc.product_regional_id4",$pbgid);
        $this->db->or_where("bmpsc.product_regional_id5",$pbgid);
        $this->db->or_where("bmpsc.product_regional_id6",$pbgid);
        
        $pbg_sku_data = $this->db->get()->result_array();
        
        if(isset($pbg_sku_data) && !empty($pbg_sku_data)) {
            return $pbg_sku_data;
        } else{
            return 0;
        }
    }
    
    public function add_forecast_data(){
        
        if(isset($_POST) && !empty($_POST)){
            
            testdata($_POST);
            
            if(!isset($_POST['employee_data']))
            {
                $forecast_user_id = $_POST['login_user_id'];
            }
            else{
                $forecast_user_id = $_POST['employee_data'];
            }
            
            $businss_data = $this->get_business_code($forecast_user_id);
            
            $user_business_code = $businss_data;
            
            $pbg_id = $_POST['pbg_data'];
            $created_user_id = $_POST['login_user_id'];
            
            $data = array( 
                'pbg_id'	= >  $pbg_id, 
                'created_by_user'= > $created_user_id, 
                'business_code'	= >  $user_business_code,
                'modified_by_user'	= >  $_POST['login_user_id'],
                'created_on'	= >  date("Y-m-d h:i:s")
            );
            $this-> db->insert('bf_esp_forecast', $data);
            
            
        }
        
    }
    
    public function get_business_code($forecast_user_id){
        
        $sql = "SELECT bussiness_code FROM `bf_users` where id='".$forecast_user_id."'";
        
        $business_code_data = $this->db->query($sql)->result_array();
        
        if(isset($business_code_data) && !empty($business_code_data)){
            return $business_code_data[0]['bussiness_code'];
        }else{
            return 0;
        }      
        
    }
    
    public function get_forecast_data($product_sku_id,$month_data){
        
        $sql = "SELECT `bmp`.`price` FROM `bf_master_price` as bmp ";
        
        $sql .= " WHERE `bmp`.`product_sku_country_id` =  '".$product_sku_id."' ";
        $sql .= " AND `bmp`.`price_type` =  'forecast' ";
        $sql .= " AND ('".$month_data."' BETWEEN from_date AND to_date)";
        
        $master_forecast_data = $this->db->query($sql)->result_array();
        
        if(isset($master_forecast_data) && !empty($master_forecast_data)) {
            return $master_forecast_data[0]['price'];
        } else{
            return 0;
        }
        
    }
    
    public function get_assumption_data(){
        
        $sql = "SELECT assumption_id,assumption_name from bf_master_assumptions";
        
        $master_assumption_data = $this->db->query($sql)->result_array();
        
        if(isset($master_assumption_data) && !empty($master_assumption_data)) {
            return $master_assumption_data;
        } else{
            return 0;
        }         
    }
    
}