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

    public function get_sku_data($sku_code){

        $this->db->select('bmpsc.product_sku_country_id');
        $this->db->from("bf_master_product_sku_country as bmpsc");

        $this->db->join("bf_master_product_sku_regional as bmpsr","bmpsr.product_sku_id = bmpsc.product_sku_id","LEFT");
        $this->db->where("bmpsr.product_sku_code",$sku_code);

        $pbg_sku_data = $this->db->get()->result_array();

        if(isset($pbg_sku_data) && !empty($pbg_sku_data)) {
            return $pbg_sku_data[0]["product_sku_country_id"];
        } else{
            return 0;
        }

    }

    public function get_pbg_detail_data($pbg,$country_id){


        $this->db->select('bmptnc.product_country_id');
        $this->db->from("bf_master_product_type_name_country as bmptnc");

      //  $this->db->join("bf_master_product_sku_regional as bmpsr","bmpsr.product_sku_id = bmpsc.product_sku_id","LEFT");
        $this->db->where("bmptnc.product_country_name",$pbg);
        $this->db->where("bmptnc.country_id",$country_id);

        $pbg_data = $this->db->get()->result_array();

        if(isset($pbg_data) && !empty($pbg_data)) {
            return $pbg_data[0]["product_country_id"];
        } else{
            return 0;
        }
    }

    
    public function get_pbg_sku_data($pbgid){
        
        $this->db->select('bmpsc.product_sku_name,bmpsc.product_sku_country_id,bmpsr.product_sku_code');
        $this->db->from("bf_master_product_sku_country as bmpsc");
        
		$this->db->join("bf_master_product_sku_regional as bmpsr","bmpsr.product_sku_id = bmpsc.product_sku_id","LEFT");
		
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
        		
        $forecast_qty = ($forecast_qty == '' || empty($forecast_qty)) ? 0 : $forecast_qty;
		$forecast_value = ($forecast_value == '' || empty($forecast_value)) ? 0 : $forecast_value;
        
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
        
      
	  //	echo "UPDATE";
      //  print_r($assumption_data);
	//	print_r($probablity_data);
		
	//	echo "</br>";
	  
        $asumption = explode("~",$assumption_data);
        $probablity = explode("~",$probablity_data);
		
		$asumption[0] = ($asumption[0] == '' || empty($asumption[0])) ? 0 : $asumption[0];
		$asumption[1] = ($asumption[1] == '' || empty($asumption[1])) ? 0 : $asumption[1];
		$asumption[2] = ($asumption[2] == '' || empty($asumption[2])) ? 0 : $asumption[2];
		
		$probablity[0] = ($probablity[0] == '' || empty($probablity[0])) ? 0 : $probablity[0];
		$probablity[1] = ($probablity[1] == '' || empty($probablity[1])) ? 0 : $probablity[1];
		$probablity[2] = ($probablity[2] == '' || empty($probablity[2])) ? 0 : $probablity[2];
		
	   
        $data = array( 
            'forecast_id'	=>  $forecast_insert_id, 
            'assumption1_id'=>  $asumption[0], 
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
        
		$forecast_qty = ($forecast_qty == '' || empty($forecast_qty)) ? 0 : $forecast_qty;
		$forecast_value = ($forecast_value == '' || empty($forecast_value)) ? 0 : $forecast_value;
        
		
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
        
		
		//echo $forecast_assumption_id."===UPDATE";
       // print_r($assumption_data);
		//print_r($probablity_data);
		///echo $forecast_assumption_id;
		//echo "</br>";
		//exit;
		
        $asumption = explode("~",$assumption_data);
        $probablity = explode("~",$probablity_data);
       
	   
	    $asumption[0] = ($asumption[0] == '' || empty($asumption[0])) ? 0 : $asumption[0];
		$asumption[1] = ($asumption[1] == '' || empty($asumption[1])) ? 0 : $asumption[1];
		$asumption[2] = ($asumption[2] == '' || empty($asumption[2])) ? 0 : $asumption[2];
		
		$probablity[0] = ($probablity[0] == '' || empty($probablity[0])) ? 0 : $probablity[0];
		$probablity[1] = ($probablity[1] == '' || empty($probablity[1])) ? 0 : $probablity[1];
		$probablity[2] = ($probablity[2] == '' || empty($probablity[2])) ? 0 : $probablity[2];
	   
	   
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
		
		//echo $this->db->last_query();
        
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

    public function get_user_data_from_bussinesscode($businesscode){

        $this->db->select("bu.id,bu.display_name");
      //  $this->db->from("bf_master_employee_reporting_person as bmerp");
        $this->db->from("bf_users as bu");
        $this->db->where("bu.bussiness_code",$businesscode);

        $user_data = $this->db->get()->result_array();

        if(isset($user_data) && !empty($user_data)) {
            return $user_data;
        } else{
            return 0;
        }

    }

    public function get_employee_product_forecast_data($businesscode,$pbg_id,$bussiness_user_id){

        $this->db->select('*');
        $this->db->from("bf_esp_forecast as bef");

        $this->db->join("bf_esp_forecast_product_details as befpd","befpd.forecast_id = bef.forecast_id");

        $this->db->where("bef.business_code",$businesscode);
        $this->db->where("bef.pbg_id",$pbg_id);
        $this->db->where("bef.created_by_user",$bussiness_user_id);
       // $this->db->where("befpd.forecast_month",$monthvalue);

        $forecast_data = $this->db->get()->result_array();

        if(isset($forecast_data) && !empty($forecast_data)) {
            return $forecast_data;
        } else{
            return 0;
        }

    }

    public function get_month_assumption_forecast_data($forecast_id,$monthvalue){
        
        $this->db->select('befa.*,bma1.assumption_name as assumption1,bma2.assumption_name as assumption2,bma3.assumption_name as assumption3');
        $this->db->from("bf_esp_forecast_assumption as befa");
        
		$this->db->join("bf_master_assumptions as bma1","bma1.assumption_id = befa.assumption1_id");
		$this->db->join("bf_master_assumptions as bma2","bma2.assumption_id = befa.assumption2_id");
		$this->db->join("bf_master_assumptions as bma3","bma3.assumption_id = befa.assumption3_id");
		
        $this->db->where("befa.forecast_id",$forecast_id);
        $this->db->where("befa.month_data",$monthvalue);
       
        $forecast_assumption_data = $this->db->get()->result_array();
        
        if(isset($forecast_assumption_data) && !empty($forecast_assumption_data)) {
            return $forecast_assumption_data;
        } else{
            return 0;
        } 
    }
    
    public function get_month_assumption_forecast_lock_data($forecast_id,$login_user_id,$monthvalue){
        
        $this->db->select('*');
      //  $this->db->from("bf_esp_forecast_product_details as befpd");
        
        $this->db->from("bf_forecast_lock_status_history as befpd");
        
        $this->db->where("befpd.forecast_id",$forecast_id);
        $this->db->where("befpd.lock_by_id",$login_user_id);
        $this->db->where("befpd.month_data",$monthvalue);
       
        $forecast_lock_data = $this->db->get()->result_array();
        
        if(isset($forecast_lock_data) && !empty($forecast_lock_data)) {
            return $forecast_lock_data;
        } else{
            return 0;
        } 
        
    }
    
    public function update_forecast_freeze_status_data($user_id,$forecast_id,$text_data,$freeze_date_data){
        
        if($text_data == "Freeze"){
            $freeze_status = 1;
        }
        else{
            $freeze_status = 0;
        }
        
       // $data = array(
       //     'freeze_status'	=>$freeze_status,
       //     'freeze_by_id' =>$user_id
       // );
        
        $data = array(
            'submit_status'	=>$freeze_status,
            'submit_by_id' =>$user_id,
            'submit_date' => date("Y-m-d")
        );
            
        $this->db->where('forecast_id', $forecast_id);
        $this->db->where('forecast_month', $freeze_date_data);
        $this->db->update('bf_esp_forecast_product_details' ,$data);
        
        $update_res = $this->db->affected_rows();
        
        if($this->db->affected_rows() > 0){
            
            $this->db->select('*');
            $this->db->from("bf_forecast_freeze_status_history as bffsh");

            $this->db->where("bffsh.forecast_id",$forecast_id);
            $this->db->where("bffsh.freeze_by_id",$user_id);
            $this->db->where("bffsh.month_data",$freeze_date_data);

            $freeze_data = $this->db->get()->result_array();
            
            if(empty($freeze_data)){
                
                //INSERT TO FREEZE HISTORY TABLE
                
                $freeze_data = array( 
                    'forecast_id'	=> $forecast_id, 
                    'freeze_by_id'  => $user_id,
                    'month_data'  => $freeze_date_data,
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
            
            $update_res = 1;
            return $update_res;
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
    
    public function get_employee_month_product_forecast_lock_data($login_user_id,$check_lock_forecast_id,$monthvalue){
        
        $this->db->select('*');
        $this->db->from("bf_forecast_lock_status_history as bflsh");
        
        $this->db->where("bflsh.forecast_id",$check_lock_forecast_id);
        $this->db->where("bflsh.lock_by_id",$login_user_id);
        $this->db->where("bflsh.month_data",$monthvalue);
        
        $forecast_lock_history_data = $this->db->get()->result_array();
        return $forecast_lock_history_data;
        
    }
    
    
    public function get_forecast_freeze_status($forecast_id,$login_user_id,$monthvalue){
        
        $this->db->select('*');
        $this->db->from("bf_forecast_freeze_status_history as bffsh");
        
        $this->db->join("bf_esp_forecast as bef","bef.forecast_id = bffsh.forecast_id");
        
        $this->db->where("bffsh.forecast_id",$forecast_id);
        $this->db->where("bffsh.month_data",$monthvalue);
        $this->db->where("bffsh.freeze_by_id",$login_user_id);
        
        $forecast_data = $this->db->get()->result_array();
        
    //    echo $this->db->last_query();
       // die;
        
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
    
    public function forecast_freeze_status_history($forecast_id,$monthvalue,$login_userid){
        
        $this->db->select('*');
        $this->db->from("bf_forecast_freeze_status_history as bffsh");
        
        $this->db->where("bffsh.forecast_id",$forecast_id);
        $this->db->where("bffsh.freeze_by_id",$login_userid);
        $this->db->where("bffsh.month_data",$monthvalue);
        
        $forecast_data = $this->db->get()->result_array();
        
        $forecast_array = array();
        
        if(!empty($forecast_data)){
            $forecast_array["forecast_id"] = $forecast_data[0]['forecast_id'];
          //  $forecast_array["created_by_user"] = $forecast_data[0]['created_by_user'];
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
        
       // echo $this->db->last_query();
       // die;
        
        if(isset($user_level_data) && !empty($user_level_data)) {
            return $user_level_data[0]['reporting_user_id'];
        } else{
            return 0;
        }
        
    }
    
    public function get_higher_level_employee_for_loginuser($login_user_id,$global_head_user=NULL){
        
       // $user_array = array();
        
        $u_data = $this->get_freeze_user_parent_data($login_user_id);
        if($u_data != 0){
           
            $login_user_id = $u_data;
           return $this->get_higher_level_employee_for_loginuser($login_user_id);
        }else{
            //echo $login_user_id;
            
            $global_head_user = $login_user_id;
            return  $global_head_user;
           
        }

    }
    
    public function get_senior_lock_status_data($login_user_parent_data,$monthvalue,$forecast_id){
        
        $this->db->select("*");
        $this->db->from("bf_forecast_lock_status_history as bflsh");
        
        $this->db->where("bflsh.forecast_id",$forecast_id);
        $this->db->where("bflsh.month_data",$monthvalue);
        $this->db->where("bflsh.lock_by_id",$login_user_parent_data);
        
        $user_lock_data = $this->db->get()->result_array();
        
       // echo $this->db->last_query();
        
       
        
        if(isset($user_lock_data) && !empty($user_lock_data)) {
            // dumpme($user_lock_data);
            return $user_lock_data;
        } else{
            //echo "INNN";
            return "0";
        }
        
        
    }

    public function get_budget_senior_lock_status_data($login_user_parent_data,$monthvalue,$budget_id){

        $this->db->select("*");
        $this->db->from("bf_budget_lock_status_history as bblsh");

        $this->db->where("bblsh.budget_id",$budget_id);
        $this->db->where("bblsh.month_data",$monthvalue);
        $this->db->where("bblsh.lock_by_id",$login_user_parent_data);

        $user_lock_data = $this->db->get()->result_array();

        // echo $this->db->last_query();



        if(isset($user_lock_data) && !empty($user_lock_data)) {
            // dumpme($user_lock_data);
            return $user_lock_data;
        } else{
            //echo "INNN";
            return "0";
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
    
	public function insert_forecast_product_details_history($forecast_insert_id,$businss_data,$pbg_id,$product_id,$month_data,$forecast_qty,$forecast_value,$update_status){
		
		$forecast_qty = ($forecast_qty == '' || empty($forecast_qty)) ? 0 : $forecast_qty;
		$forecast_value = ($forecast_value == '' || empty($forecast_value)) ? 0 : $forecast_value;
        
		
		$data = array( 
            'forecast_id'	=>  $forecast_insert_id, 
            'business_code'=> $businss_data, 
            'pbg_id'=> $pbg_id,
            'sku_id'	=>  $product_id,
            'month_data'	=>  $month_data,
            'forecast_qty'	=>  $forecast_qty,
            'forecast_value'	=>  $forecast_value,
            'update_status'	=>  $update_status
        );
        $this-> db->insert('bf_forecast_product_detail_history', $data);
		
	}
	
	public function insert_forecast_assumption_data_history($forecast_insert_id,$assumption_data,$probablity_data,$month_data,$history_update_status){
		
		$asumption = explode("~",$assumption_data);
        $probablity = explode("~",$probablity_data);
       
	    $asumption[0] = ($asumption[0] == '' || empty($asumption[0])) ? 0 : $asumption[0];
		$asumption[1] = ($asumption[1] == '' || empty($asumption[1])) ? 0 : $asumption[1];
		$asumption[2] = ($asumption[2] == '' || empty($asumption[2])) ? 0 : $asumption[2];
		
		$probablity[0] = ($probablity[0] == '' || empty($probablity[0])) ? 0 : $probablity[0];
		$probablity[1] = ($probablity[1] == '' || empty($probablity[1])) ? 0 : $probablity[1];
		$probablity[2] = ($probablity[2] == '' || empty($probablity[2])) ? 0 : $probablity[2];
	   
        $data = array( 
            'forecast_id'	=>  $forecast_insert_id, 
            'assumption1_id'=> $asumption[0], 
            'assumption2_id'=>  $asumption[1],
            'assumption3_id'=>  $asumption[2],
            'probablity1'	=>  $probablity[0],
            'probablity2'	=>  $probablity[1],
            'probablity3'	=>  $probablity[2],
            'month_data'	=>  $month_data,
            'update_status'	=>  $history_update_status,
        );
        $this-> db->insert('bf_forecast_assumption_history', $data);
        
		
	}
	
	public function get_user_impact_data($login_bussiness_code,$monthdata){
		
		/* //FOR PRODUCT SKU WISE
		
		$this->db->select('befa.forecast_assumption_id, bmpsr.product_sku_code, bmpsc.product_sku_name, bma1.assumption1_name as assumption1_name, bma2.assumption_name as assumption2_name, bma3.assumption_name as assumption3_name, befa.probability1, befa.probability2, befa.probability3, befa.impact1, befa.impact2, befa.impact3' );
		$this->db->from('bf_esp_forecast_product_details as befpd');
		
		$this->db->join("bf_esp_forecast_assumption as befa","befa.forecast_id = befpd.forecast_id AND befa.month_data = befpd.forecast_month");
		
		$this->db->join(" bf_master_assumptions as bma1","bma1.assumption_id = befa.assumption1_id");
		$this->db->join(" bf_master_assumptions as bma2","bma2.assumption_id = befa.assumption2_id");
		$this->db->join(" bf_master_assumptions as bma3","bma3.assumption_id = befa.assumption3_id");
		
		$this->db->join("bf_master_product_sku_country as bmpsc","bmpsc.product_sku_country_id = befpd.product_sku_id");
		
		$this->db->join("bf_master_product_sku_regional as bmpsr","bmpsr.product_sku_id = bmpsc.product_sku_id");
		
		
		$this->db->where("business_code",$login_bussiness_code);
		$this->db->where("forecast_month",$monthdata);
		
		*/
		
		//FOR PBG WISE
		
		$this->db->select('befa.forecast_assumption_id, bmptnc.product_country_name, bma1.assumption_name as assumption1_name, bma2.assumption_name as assumption2_name, bma3.assumption_name as assumption3_name, befa.probability1, befa.probability2, befa.probability3, befa.impact1, befa.impact2, befa.impact3');
		$this->db->from('bf_esp_forecast as bef');
		
		$this->db->join("bf_esp_forecast_assumption as befa","befa.forecast_id = bef.forecast_id");
		
		$this->db->join("bf_master_assumptions as bma1","bma1.assumption_id = befa.assumption1_id");
		$this->db->join("bf_master_assumptions as bma2","bma2.assumption_id = befa.assumption2_id");
		$this->db->join("bf_master_assumptions as bma3","bma3.assumption_id = befa.assumption3_id");
		
		$this->db->join("bf_master_product_type_name_country as bmptnc","bmptnc.product_country_id = bef.pbg_id");
		
		$this->db->where("bef.business_code",$login_bussiness_code);
		$this->db->where("befa.month_data",$monthdata);
		
		
		$impact_data = $this->db->get()->result_array();
		
		if(isset($impact_data) && !empty($impact_data)) {
            return $impact_data;
        } else{
            return 0;
        }
		
	}

	public function add_impact_entry($assumption_data,$webservice_flag){
		
		//testdata($assumption_data);
		
		if($webservice_flag == 0){
			
			if(!empty($assumption_data['assumption_id'])){

                $data_array = array();

				foreach($assumption_data['assumption_id'] as $assumption_key => $impact_data){
					
					//$impact1 = $assumption_data['impact1'][$assumption_key];
					//$impact2 = $assumption_data['impact2'][$assumption_key];
					//$impact3 = $assumption_data['impact3'][$assumption_key];
					
					$impact1 = ($assumption_data['impact1'][$assumption_key] == '') ? 0 : $assumption_data['impact1'][$assumption_key];
					$impact2 = ($assumption_data['impact2'][$assumption_key] == '') ? 0 : $assumption_data['impact2'][$assumption_key];
					$impact3 = ($assumption_data['impact3'][$assumption_key] == '') ? 0 : $assumption_data['impact3'][$assumption_key];
					
					$data = array(
			            'impact1' => $impact1,
			            'impact2' => $impact2,
			            'impact3' => $impact3
			        );
			            
			        $this->db->where('forecast_assumption_id', $impact_data);
			        $this->db->update('bf_esp_forecast_assumption' ,$data);
			        
			        if($this->db->affected_rows() > 0){
                        $data_array[] =  1;
			        }
					else{
                        $data_array[] = 0;
					}
			        
				}

                if(in_array(1,$data_array)){
                    return 1;
                }
                else{
                    return 0;
                }

				
			}
			else{
				return 0;
			}
			
		}
		else{
			
			//INSERT / UPDATE DATA FROM WEBSERVICE
			
			if(!empty($assumption_data['data'])){
                $data_array = array();
				foreach($assumption_data['data'] as $assumption_key => $impact_data){
					
					//$impact1 = $impact_data['impact1'];
					//$impact2 = $impact_data['impact2'];
					//$impact3 = $impact_data['impact3'];
					
					
					$impact1 = ($impact_data['impact1'] == '') ? 0 : $impact_data['impact1'];
					$impact2 = ($impact_data['impact2'] == '') ? 0 : $impact_data['impact2'];
					$impact3 = ($impact_data['impact3'] == '') ? 0 : $impact_data['impact3'];
					
					
					$data = array(
			            'impact1' => $impact1,
			            'impact2' => $impact2,
			            'impact3' => $impact3
			        );
			            
			        $this->db->where('forecast_assumption_id', $impact_data["forecast_assumption_id"]);
			        $this->db->update('bf_esp_forecast_assumption' ,$data);
			        
					//echo $this->db->last_query();
					//echo "</br>";
					
			      /*  if($this->db->affected_rows() > 0){
			        	return 1;
			        }
					else{
						return 0;
					}
					
					*/

                    if($this->db->affected_rows() > 0){
                        $data_array[] =  1;
                    }
                    else
                    {
                        $data_array[] = 0;
                    }
			        
				}

                if(in_array(1,$data_array)){
                    return 1;
                }
                else{
                    return 0;
                }


			}
			else{
				return 0;
				
			}
			
			
		}
		
	}
	
	public function get_employee_month_product_budget_data($businesscode,$product_sku_country_id,$monthvalue){
        
        $this->db->select('*');
        $this->db->from("bf_esp_budget as beb");
        
        $this->db->join("bf_esp_budget_product_details as bebpd","bebpd.budget_id = beb.budget_id");
        
        $this->db->where("beb.business_code",$businesscode);
        $this->db->where("bebpd.business_code",$businesscode);
        $this->db->where("bebpd.product_sku_id",$product_sku_country_id);
        $this->db->where("bebpd.budget_month",$monthvalue);
        
        $budget_data = $this->db->get()->result_array();
        
        if(isset($budget_data) && !empty($budget_data)) {
            return $budget_data;
        } else{
            return 0;
        }
        
    }
	
	public function get_budget_freeze_status($budget_id,$user_data){
        
        $this->db->select('*');
        $this->db->from("bf_budget_freeze_status_history as bbfsh");
        
        $this->db->where("bbfsh.budget_id",$budget_id);
        $this->db->where("bbfsh.freeze_by_id",$user_data);
        
        $budget_data = $this->db->get()->result_array();
        
        $budget_array = array();
        
        if(!empty($budget_data)){
            $budget_array["budget_id"] = $budget_data[0]['budget_id'];
          //  $budget_array["created_by_user"] = $budget_data[0]['created_by_user'];
            $budget_array["freeze_status"] = $budget_data[0]['freeze_status'];
            $budget_array["freeze_user_id"] = $budget_data[0]['freeze_by_id'];
        }
        if(isset($budget_array) && !empty($budget_array)) {
            return $budget_array;
        } else{
            return 0;
        }
        
    }
	
	public function get_budget_freeze_history_user_status_data($login_user_id,$budget_id){
        
        $this->db->select('*');
        $this->db->from("bf_budget_freeze_status_history as bbfsh");
        
        $this->db->where("bbfsh.budget_id",$budget_id);
        $this->db->where("bbfsh.freeze_by_id",$login_user_id);
        
        $budget_freeze_history_data = $this->db->get()->result_array();
        return $budget_freeze_history_data;
    }
	
	public function check_budget_data($pbg_id,$user_business_code,$month_data){
        
        $this->db->select('*');
        $this->db->from("bf_esp_budget as beb");
        
        $this->db->join("bf_esp_budget_product_details as bebpd","bebpd.budget_id = beb.budget_id");
        
        $this->db->where("beb.pbg_id",$pbg_id);
        $this->db->where("beb.business_code",$user_business_code);
        $this->db->where("bebpd.budget_month",$month_data);
       
        $budget_data = $this->db->get()->result_array();
        
        if(isset($budget_data) && !empty($budget_data)) {
            return $budget_data;
        } else{
            return 0;
        } 
        
    }
	
	public function update_budget_data($budget_id,$created_user_id){
        
        $data = array(
            'modified_by_user'	=>$created_user_id
        );
            
        $this->db->where('budget_id', $budget_id);
        $this->db->update('bf_esp_budget' ,$data);
      
    }
	
	public function insert_budget_data($pbg_id,$created_user_id,$user_business_code,$login_user_id){
        
        $data = array( 
            'pbg_id'	=>  $pbg_id, 
            'created_by_user'=> $created_user_id, 
            'business_code'	=>  $user_business_code,
            'modified_by_user'	=>  $login_user_id,
            'created_on'	=>  date("Y-m-d h:i:s")
        );
        $this-> db->insert('bf_esp_budget', $data);
        
        return $budget_insert_id = $this->db->insert_id();
        
    }
	
	public function get_budget_product_details($businss_data,$product_id,$month_data){
        
        $this->db->select('*');
        $this->db->from("bf_esp_budget_product_details as bebpd");

       // $this->db->where("befpd.forecast_id",$old_forecast_id);
        $this->db->where("bebpd.business_code",$businss_data);
        $this->db->where("bebpd.budget_month",$month_data);
        $this->db->where("bebpd.product_sku_id",$product_id);

        $budget_product_data = $this->db->get()->result_array();

        if(isset($budget_product_data) && !empty($budget_product_data)) {
            return $budget_product_data;
        } else{
            return 0;
        } 
    }
	
	public function update_budget_product_details($budget_product_id,$budget_qty,$budget_value){
        
		//echo $budget_product_id."====".$budget_qty."====".$budget_value;
		
		$budget_qty = ($budget_qty == '' || empty($budget_qty)) ? 0 : $budget_qty;
		$budget_value = ($budget_value == '' || empty($budget_value)) ? 0 : $budget_value;
		
        $data = array(
            'budget_quantity'	=>$budget_qty,
            'budget_value'	=>$budget_value
        );
            
        $this->db->where('budget_product_id', $budget_product_id);
        $this->db->update('bf_esp_budget_product_details' ,$data);        
    }
	
	public function insert_budget_product_details($budget_insert_id,$businss_data,$product_id,$month_data,$budget_qty,$budget_value){
        
		$budget_qty = ($budget_qty == '' || empty($budget_qty)) ? 0 : $budget_qty;
		$budget_value = ($budget_value == '' || empty($budget_value)) ? 0 : $budget_value;
		
		
        $data = array( 
            'budget_id'	=>  $budget_insert_id, 
            'business_code'=> $businss_data, 
            'product_sku_id'	=>  $product_id,
            'budget_month'	=>  $month_data,
            'budget_quantity'	=>  $budget_qty,
            'budget_value'	=>  $budget_value,
            'created_on'	=>  date("Y-m-d h:i:s")
        );
        $this-> db->insert('bf_esp_budget_product_details', $data);
        
    }
	
	    
    public function update_budget_freeze_status_data($user_id,$budget_id,$text_data){
        
		//echo $user_id."-".$budget_id."-".$text_data;
		//die;
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
            
        $this->db->where('budget_id', $budget_id);
        $this->db->update('esp_budget' ,$data);
        
        if($this->db->affected_rows() > 0){
        	
            $this->db->select('*');
            $this->db->from("budget_freeze_status_history");

            $this->db->where("budget_id",$budget_id);
            $this->db->where("freeze_by_id",$user_id);

            $freeze_data = $this->db->get()->result_array();
            
            if(empty($freeze_data)){
                
                //INSERT TO FREEZE HISTORY TABLE
                
                $freeze_data = array( 
                    'budget_id'	=> $budget_id, 
                    'freeze_by_id'  => $user_id, 
                    'freeze_status'	=>  1
                );
                $this-> db->insert('bf_budget_freeze_status_history', $freeze_data);
                
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
                $this->db->update('bf_budget_freeze_status_history' ,$update_history_data);
                
            }
            
            return 1;
        }
        else{
        	
			
            return 0;
        }
        
    }
    
	public function get_budget_data($product_sku_id,$month_data){
        
        $sql = "SELECT `bmp`.`price` FROM `bf_master_price` as bmp ";
        
        $sql .= " WHERE `bmp`.`product_sku_country_id` =  '".$product_sku_id."' ";
        $sql .= " AND `bmp`.`price_type` =  'budget' ";
        $sql .= " AND ('".$month_data."' BETWEEN from_date AND to_date)";
        
        $master_budget_data = $this->db->query($sql)->result_array();
        
        if(isset($master_budget_data) && !empty($master_budget_data)) {
            return $master_budget_data[0]['price'];
        } else{
            return 0;
        }
        
    }

	 public function update_budget_lock_status_data($user_id,$budget_id,$monthval,$text_data){
        
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
            
        $this->db->where('budget_id', $budget_id);
        $this->db->where('budget_month', $monthval);
        
        $this->db->update('bf_esp_budget_product_details' ,$data);
        
        if($this->db->affected_rows() > 0){
            
            $this->db->select('*');
            $this->db->from("bf_budget_lock_status_history as bblsh");

            $this->db->where("bblsh.budget_id",$budget_id);
            $this->db->where("bblsh.month_data",$monthval);
            $this->db->where("bblsh.lock_by_id",$user_id);

            $lock_data = $this->db->get()->result_array();
            
            if(empty($lock_data)){
                
                //INSERT TO LOCK HISTORY TABLE
                
                $lock_data = array( 
                    'budget_id'	=> $budget_id, 
                    'month_data'  => $monthval, 
                    'lock_status'	=>  1,
                    'lock_by_id'	=>  $user_id
                );
                $this-> db->insert('bf_budget_lock_status_history', $lock_data);
                
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
                $this->db->update('bf_budget_lock_status_history' ,$update_history_data);
                
            }

            return 1;
        }
        else{
            return 0;
        }
        
    }

	public function get_employee_month_product_budget_lock_data($login_user_id,$check_lock_budget_id,$monthvalue){
        
        $this->db->select('*');
        $this->db->from("bf_budget_lock_status_history as bblsh");
        
        $this->db->where("bblsh.budget_id",$check_lock_budget_id);
        $this->db->where("bblsh.lock_by_id",$login_user_id);
        $this->db->where("bblsh.month_data",$monthvalue);
        
        $budget_lock_history_data = $this->db->get()->result_array();
        return $budget_lock_history_data;
        
    }
	
	public function get_role_degination_data($user_role_id){
		
		$this->db->select('bmdre.regional_level');
        $this->db->from("bf_master_designation_role as bmdr");
		
		$this->db->join("bf_master_designation_country as bmdc","bmdc.desigination_country_id = bmdr.desigination_id");
        
		$this->db->join("bf_master_designation_regional as bmdre","bmdre.desigination_regional_id = bmdc.desigination_regional_id");
		
        $this->db->where("bmdr.role_id",$user_role_id);
        
        $role_degigination_data = $this->db->get()->result_array();
		
		if(!empty($role_degigination_data)){
				
			$leveldata = explode("L",$role_degigination_data[0]['regional_level']);
			$leveldata = $leveldata[1];
			
		}
		else{
			$leveldata = 1;
		}
        return $leveldata;
		
	}
	
	public function get_user_selected_level_data($userid,$level){
		
		
		$sql = 'SELECT count(*) as tot, group_concat(`bu`.`id`) as level_users FROM (`bf_master_employee_reporting_person` as bmerp) JOIN `bf_users` as bu ON `bu`.`id` = `bmerp`.`user_id` WHERE `bmerp`.`reporting_user_id` IN ('.$userid.') AND `bmerp`.`to_date` IS NULL';
		
		$data = $this->db->query($sql)->row_array();
       
        return $data;
     
	}
	
	public function get_forecast_user_data($level_users,$month_data){
		
		$user_data = explode(",",$level_users);
		
		$forecast_freeze_count = 0;
		
		foreach($user_data as $key => $userid){
					
			$freeze_data = $this->db->query("SELECT * from bf_forecast_freeze_status_history as bffsh JOIN bf_forecast_product_detail_history as bfpdh ON bfpdh.forecast_id = bffsh.forecast_id where bffsh.freeze_by_id = '".$userid."' AND bffsh.freeze_status=1 AND bfpdh.month_data='".$month_data."' ")->row_array();
			
			if(!empty($freeze_data)){
				$forecast_freeze_count = $forecast_freeze_count+1;
			}
			
		}
		
		return $forecast_freeze_count;
	}
	
	public function get_update_user_data($level_users,$month_data){
					
		$user_data = explode(",",$level_users);
		
		$forecast_update_count = 0;
		
		foreach($user_data as $key => $userid){
				
			$update_data = $this->db->query("SELECT * from bf_forecast_lock_status_history as bflsh JOIN bf_forecast_product_detail_history as bfpdh ON bfpdh.forecast_id = bflsh.forecast_id where bflsh.lock_by_id = '".$userid."' AND bflsh.lock_status=1 AND bfpdh.month_data='".$month_data."' ")->row_array();
			
			if(!empty($update_data)){
				$forecast_update_count = $forecast_update_count+1;
			}
			
		}
		
		return $forecast_update_count;	
	}
	
	public function get_update_user_detail_data($level_users,$month_data){
					
		$user_data = explode(",",$level_users);
		
		
		
		$final_array = array();
		
		foreach($user_data as $key => $userid){
				
			$user_detail_data = $this->db->query("SELECT display_name from bf_users where id = '".$userid."'")->row_array();

           // dumpme($user_detail_data);

            if(!empty($user_detail_data)){
                $user_name = $user_detail_data["display_name"];
            }
            else{
                $user_name = "";
            }

			
			$forecast_update_status = "";
			
			$update_data = $this->db->query("SELECT * from bf_forecast_lock_status_history as bflsh JOIN bf_forecast_product_detail_history as bfpdh ON bfpdh.forecast_id = bflsh.forecast_id where bflsh.lock_by_id = '".$userid."' AND bflsh.lock_status=1 AND bfpdh.month_data='".$month_data."' ")->row_array();
			
			if(!empty($update_data)){
				$forecast_update_status = "Yes";
			}
			
			$final_array[] = $user_name."|||".$forecast_update_status;
			
		}
		
		return $final_array;	
	}
    
    public function senior_budget_lock_status($user_id,$budget_id,$from_month)
    {
        $this->db->select("*");
        $this->db->from("bf_budget_lock_status_history as bblsh");
        $this->db->where("budget_id",$budget_id);
        $this->db->where("month_data",$from_month);
        $this->db->where("lock_by_id",$user_id);
        
        $budget_lock_data = $this->db->get()->result_array();
        
       // echo $this->db->last_query();die;
        
        if(isset($budget_lock_data) && !empty($budget_lock_data)) {
            return $budget_lock_data;
        } else{
            return 0;
        }
        
    }
    
    public function senior_forecast_lock_status($user_id,$forecast_id,$from_month)
    {
        $this->db->select("*");
        $this->db->from("bf_forecast_lock_status_history as bflsh");
        $this->db->where("forecast_id",$forecast_id);
        $this->db->where("month_data",$from_month);
        $this->db->where("lock_by_id",$user_id);
        
        $forecast_lock_data = $this->db->get()->result_array();
        
       // echo $this->db->last_query();die;
        
        if(isset($forecast_lock_data) && !empty($forecast_lock_data)) {
            return $forecast_lock_data;
        } else{
            return 0;
        }
        
    }
    
    
    public function get_employee_for_loginuser($login_user_id,&$global_head_user)
    {

        $u_data = $this->get_user_parent_data($login_user_id);

        if ($u_data != 0) {
            $global_head_user[] = $u_data[0]['reporting_user_id'];
            $login_user_id = $u_data[0]['reporting_user_id'];
            return $this->get_employee_for_loginuser($login_user_id,$global_head_user);
        } else {
          //  $global_head_user[] = $login_user_id;
            return $global_head_user;
        }

    }

    public function get_user_parent_data($freeze_user_id)
    {
        $this->db->select("bmerp.reporting_user_id");
        $this->db->from("bf_master_employee_reporting_person as bmerp");
        $this->db->join("bf_users as bu", 'bu.id = bmerp.reporting_user_id');
        $this->db->where("bmerp.user_id", $freeze_user_id);
        $this->db->where("bmerp.to_date", NULL);
        $user_level_data = $this->db->get()->result_array();

        if (isset($user_level_data) && !empty($user_level_data)) {
            return $user_level_data;
        } else {
            return 0;
        }

    }
    
	

	
}