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
    
    public function insert_forecast_data($pbg_id,$created_user_id,$user_business_code,$login_user_id){
        
        $data = array( 
                'pbg_id'	=>  $pbg_id, 
                'created_by_user'=> $created_user_id, 
                'business_code'	=>  $user_business_code,
                'modified_by_user'	=>  $login_user_id,
                'created_on'	=>  date("Y-m-d h:i:s")
            );
            $this-> db->insert('bf_esp_forecast', $data);
            
            return $forecast_insert_id = $this->db->insert_id();
        
    }
    
    public function insert_forecast_product_details($forecast_insert_id,$businss_data,$product_id,$month_data,$forecast_qty,$forecast_value){
        
        $data = array( 
            'forecast_id'	=>  $forecast_insert_id, 
            'business_code'=> $businss_data, 
            'product_sku_id'	=>  $product_id,
            'forecast_month'	=>  $month_data,
            'forecast_quantity'	=>  $forecast_qty,
            'forecast_value'	=>  $forecast_value,
            'created_on'	=>  date("Y-m-d h:i:s")
        );
        $this-> db->insert('bf_esp_forecast_product_details', $data);
        
    }
    
    public function insert_forecast_assumption_probablity_data($forecast_insert_id,$assumption_data,$probablity_data,$month_data){
        
        $asumption = explode("~",$assumption_data);
        $probablity = explode("~",$probablity_data);
       
        $data = array( 
            'forecast_id'	=>  $forecast_insert_id, 
            'assumption1_id'=> $asumption[0], 
            'assumption2_id'=>  $asumption[1],
            'assumption3_id'=>  $asumption[2],
            'probability1'	=>  $probablity[0],
            'probability2'	=>  $probablity[1],
            'probability3'	=>  $probablity[2],
            'month_data'	=>  $month_data
        );
        $this-> db->insert('bf_esp_forecast_assumption', $data);
        
    }
    
    public function check_forecast_data($pbg_id,$user_business_code,$month_data){
        
        $this->db->select('*');
        $this->db->from("bf_esp_forecast as bef");
        
        $this->db->join("bf_esp_forecast_product_details as befpd","befpd.forecast_id = bef.forecast_id");
        
        $this->db->where("bef.pbg_id",$pbg_id);
        $this->db->where("bef.business_code",$user_business_code);
        $this->db->where("befpd.forecast_month",$month_data);
       
        $forecast_data = $this->db->get()->result_array();
        
        if(isset($forecast_data) && !empty($forecast_data)) {
            return $forecast_data;
        } else{
            return 0;
        } 
        
    }
    
    public function update_forecast_data($forecast_id,$created_user_id){
        
        $data = array(
            'modified_by_user'	=>$created_user_id
        );
            
        $this->db->where('forecast_id', $forecast_id);
        $this->db->update('bf_esp_forecast' ,$data);
      
    }
    
    public function get_forecast_product_details($businss_data,$product_id,$month_data){
        
        $this->db->select('*');
        $this->db->from("bf_esp_forecast_product_details as befpd");

       // $this->db->where("befpd.forecast_id",$old_forecast_id);
        $this->db->where("befpd.business_code",$businss_data);
        $this->db->where("befpd.forecast_month",$month_data);
        $this->db->where("befpd.product_sku_id",$product_id);

        $forecast_product_data = $this->db->get()->result_array();

        if(isset($forecast_product_data) && !empty($forecast_product_data)) {
            return $forecast_product_data;
        } else{
            return 0;
        } 
    }
    
    public function update_forecast_product_details($forecast_product_id,$forecast_qty,$forecast_value){
        
        $data = array(
            'forecast_quantity'	=>$forecast_qty,
            'forecast_value'	=>$forecast_value
        );
            
        $this->db->where('forecast_product_id', $forecast_product_id);
        $this->db->update('bf_esp_forecast_product_details' ,$data);        
    }
    
    public function get_forecast_assumption_details($old_forecast_id,$month_data){
        
        
        $this->db->select('*');
        $this->db->from("bf_esp_forecast_assumption as befa");

        $this->db->where("befa.forecast_id",$old_forecast_id);
        $this->db->where("befa.month_data",$month_data);

        $forecast_assumption_data = $this->db->get()->result_array();

        if(isset($forecast_assumption_data) && !empty($forecast_assumption_data)) {
            return $forecast_assumption_data;
        } else{
            return 0;
        } 
        
    }
    
    public function update_forecast_assumption_details($forecast_assumption_id,$assumption_data,$probablity_data){
        
        $asumption = explode("~",$assumption_data);
        $probablity = explode("~",$probablity_data);
       
        $data = array( 
            'assumption1_id'=> $asumption[0], 
            'assumption2_id'=>  $asumption[1],
            'assumption3_id'=>  $asumption[2],
            'probability1'	=>  $probablity[0],
            'probability2'	=>  $probablity[1],
            'probability3'	=>  $probablity[2]
        );
            
        $this->db->where('forecast_assumption_id', $forecast_assumption_id);
        $this->db->update('bf_esp_forecast_assumption' ,$data); 
        
    }
    
    
    public function get_business_code($forecast_user_id=NULL){
        
        if($forecast_user_id == NULL){
            $forecast_user_id = $_POST["forecast_user_id"];
        }
        
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
    
    public function get_employee_month_product_forecast_data($businesscode,$product_sku_country_id,$monthvalue){
        
        $this->db->select('*');
        $this->db->from("bf_esp_forecast as bef");
        
        $this->db->join("bf_esp_forecast_product_details as befpd","befpd.forecast_id = bef.forecast_id");
        
        $this->db->where("bef.business_code",$businesscode);
        $this->db->where("befpd.business_code",$businesscode);
        $this->db->where("befpd.product_sku_id",$product_sku_country_id);
        $this->db->where("befpd.forecast_month",$monthvalue);
        
        $forecast_data = $this->db->get()->result_array();
        
        if(isset($forecast_data) && !empty($forecast_data)) {
            return $forecast_data;
        } else{
            return 0;
        }
        
    }
    
    public function get_month_assumption_forecast_data($forecast_id,$monthvalue){
        
        $this->db->select('*');
        $this->db->from("bf_esp_forecast_assumption as befa");
        
        $this->db->where("befa.forecast_id",$forecast_id);
        $this->db->where("befa.month_data",$monthvalue);
       
        $forecast_assumption_data = $this->db->get()->result_array();
        
        if(isset($forecast_assumption_data) && !empty($forecast_assumption_data)) {
            return $forecast_assumption_data;
        } else{
            return 0;
        } 
    }
    
    public function get_month_assumption_forecast_lock_data($forecast_id,$monthvalue){
        
        $this->db->select('*');
        $this->db->from("bf_esp_forecast_product_details as befpd");
        
        $this->db->where("befpd.forecast_id",$forecast_id);
        $this->db->where("befpd.forecast_month",$monthvalue);
       
        $forecast_lock_data = $this->db->get()->result_array();
        
        if(isset($forecast_lock_data) && !empty($forecast_lock_data)) {
            return $forecast_lock_data;
        } else{
            return 0;
        } 
        
    }
    
    public function update_forecast_freeze_status_data($user_id,$forecast_id,$text_data){
        
        if($text_data == "Freeze"){
            $freeze_status = 1;
        }
        else{
            $freeze_status = 0;
        }
        
        $data = array(
            'freeze_status'	=>$freeze_status,
            'freeze_by_id' =>$user_id
        );
            
        $this->db->where('forecast_id', $forecast_id);
        $this->db->update('bf_esp_forecast' ,$data);
        
        if($this->db->affected_rows() > 0){
            
            $this->db->select('*');
            $this->db->from("bf_forecast_freeze_status_history as bffsh");

            $this->db->where("bffsh.forecast_id",$forecast_id);
            $this->db->where("bffsh.freeze_by_id",$user_id);

            $freeze_data = $this->db->get()->result_array();
            
            if(empty($freeze_data)){
                
                //INSERT TO FREEZE HISTORY TABLE
                
                $freeze_data = array( 
                    'forecast_id'	=> $forecast_id, 
                    'freeze_by_id'  => $user_id, 
                    'freeze_status'	=>  1
                );
                $this-> db->insert('bf_forecast_freeze_status_history', $freeze_data);
                
            }
            else{
                
                //UPDATE TO FREEZE HISTORY TABLE
                
                $freeze_history_id = $freeze_data[0]['id'];
                
                if($text_data == "Freeze"){
                    $freeze_status = 1;
                }
                else{
                    $freeze_status = 0;
                }
                
                $update_history_data = array(
                    'freeze_status'	=>$freeze_status,
                    'freeze_by_id' =>$user_id
                );

                $this->db->where('id', $freeze_history_id);
                $this->db->update('bf_forecast_freeze_status_history' ,$update_history_data);
                
                
            }
            
            return 1;
        }
        else{
            return 0;
        }
        
    }
    
    public function get_freeze_history_user_status_data($login_user_id,$forecast_id){
        
        $this->db->select('*');
        $this->db->from("bf_forecast_freeze_status_history as bffsh");
        
        $this->db->where("bffsh.forecast_id",$forecast_id);
        $this->db->where("bffsh.freeze_by_id",$login_user_id);
        
        $forecast_freeze_history_data = $this->db->get()->result_array();
        return $forecast_freeze_history_data;
    }
    
    public function get_forecast_freeze_status($forecast_id){
        
        $this->db->select('*');
        $this->db->from("bf_esp_forecast as bef");
        
        $this->db->where("bef.forecast_id",$forecast_id);
        
        $forecast_data = $this->db->get()->result_array();
        
        $forecast_array = array();
        
        if(!empty($forecast_data)){
            $forecast_array["forecast_id"] = $forecast_data[0]['forecast_id'];
            $forecast_array["created_by_user"] = $forecast_data[0]['created_by_user'];
            $forecast_array["freeze_status"] = $forecast_data[0]['freeze_status'];
            $forecast_array["freeze_user_id"] = $forecast_data[0]['freeze_by_id'];
        }
        if(isset($forecast_array) && !empty($forecast_array)) {
            return $forecast_array;
        } else{
            return 0;
        }
        
    }
    
    public function get_freeze_user_parent_data($freeze_user_id){
        
        
        $this->db->select("bu.id,bu.display_name,bmerp.reporting_user_id");
        $this->db->from("bf_master_employee_reporting_person as bmerp");
        $this->db->join("bf_users as bu",'bu.id = bmerp.user_id');
        $this->db->where("bmerp.user_id",$freeze_user_id);
        $this->db->where("bmerp.to_date",NULL);
        $user_level_data = $this->db->get()->result_array();
        
        if(isset($user_level_data) && !empty($user_level_data)) {
            return $user_level_data[0]['reporting_user_id'];
        } else{
            return 0;
        }
        
    }
    
    public function update_forecast_lock_status_data($user_id,$forecast_id,$monthval,$text_data){
        
        if($text_data == 'Lock'){
            $status = 1;
        }
        else{
            $status = 0;
        }
        
        $data = array(
            'lock_status'	=>$status,
            'lock_by_id' => $user_id
        );
            
        $this->db->where('forecast_id', $forecast_id);
        $this->db->where('forecast_month', $monthval);
        
        $this->db->update('bf_esp_forecast_product_details' ,$data);
        
        if($this->db->affected_rows() > 0){
            
            
            
            $this->db->select('*');
            $this->db->from("bf_forecast_lock_status_history as bflsh");

            $this->db->where("bflsh.forecast_id",$forecast_id);
            $this->db->where("bflsh.month_data",$monthval);
            $this->db->where("bflsh.lock_by_id",$user_id);

            $lock_data = $this->db->get()->result_array();
            
            if(empty($lock_data)){
                
                //INSERT TO LOCK HISTORY TABLE
                
                $lock_data = array( 
                    'forecast_id'	=> $forecast_id, 
                    'month_data'  => $monthval, 
                    'lock_status'	=>  1,
                    'lock_by_id'	=>  $user_id
                );
                $this-> db->insert('bf_forecast_lock_status_history', $lock_data);
                
            }
            else{
                
                //UPDATE TO LOCK HISTORY TABLE
                
                $lock_history_id = $lock_data[0]['id'];
                
                if($text_data == "Lock"){
                    $lock_status = 1;
                }
                else{
                    $lock_status = 0;
                }
                
                $update_history_data = array(
                    'lock_status'	=>$lock_status
                );

                $this->db->where('id', $lock_history_id);
                $this->db->update('bf_forecast_lock_status_history' ,$update_history_data);
                
            }

            return 1;
        }
        else{
            return 0;
        }
        
    }
    
}