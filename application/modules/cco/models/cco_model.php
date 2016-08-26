<?php defined('BASEPATH') || exit('No direct script access allowed');

class Cco_model extends BF_Model
{

    public function __construct()
    {

        parent::__construct();
        $config=array();
        $this->load->library("CH_Grid_generator", $config, "grid");
    }

    public function level_data($campagain_id,$leveldata)
    {
        $campagain_data = $this->get_campagain_loc_data($campagain_id);

        $final_array = array();
        $global_head_user = array();
        if(!empty($campagain_data) && $campagain_data != 0)
        {
            foreach($campagain_data as $key => $camp_data)
            {
                $campaign_location_id = $camp_data["campaign_location_id"];
                $final_array[] = $this->recursive_location_data($campaign_location_id, $global_head_user, $flag = 1, $leveldata);
            }
        }

       return $final_array;
    }

    public function level_data_for_unkown($leveldata,$country_id)
    {

        $sql = ' SELECT bmpgd2.political_geo_id,bmpgd2.political_geography_name FROM bf_master_political_geography_details as bmpgd ';

        $sql .= ' LEFT JOIN bf_master_political_geography_details as bmpgd1 ON bmpgd1.political_geo_id = bmpgd.parent_geo_id ';
        $sql .= ' LEFT JOIN bf_master_political_geography_details as bmpgd2 ON bmpgd2.political_geo_id = bmpgd1.parent_geo_id ';

        $sql .= ' LEFT JOIN bf_master_political_geography_level_country as bmpglc ON bmpglc.level_id = bmpgd.geo_level_id ';

        $sql .= ' WHERE bmpgd.geo_level_id = "'.$leveldata.'" AND bmpglc.country_id = "'.$country_id.'" GROUP BY bmpgd2.political_geo_id';

        $geo_data = $this->db->query($sql);
        $geo_location_data = $geo_data->result_array();

        if (isset($geo_location_data) && !empty($geo_location_data)) {
            return $geo_location_data;
        } else {
            return 0;
        }

    }

    public function get_campagain_phasedata($campagain_id)
    {
        $this->db->select("bccp.phase_id,bccp.phase_name,bccp.script");
        $this->db->from("bf_cco_campaign_phase as bccp");
        $this->db->where("bccp.campaign_id",$campagain_id);

        $campagain_phase_data = $this->db->get()->result_array();

        return $campagain_phase_data;
    }

    public function get_campagain_phase_question_data($phaseid,$campagain_id)
    {

        $user = $this->auth->user();

        $this->db->select("*");
        $this->db->from("bf_cco_campaign_phase_questions as bccpq");
        $this->db->join("bf_questions_master as bqm","bqm.question_id = bccp.question_id");

        $this->db->where("bccpq.country_id",$user->country_id);
        $this->db->where("bccpq.phase_id",$phaseid);
        $this->db->where("bccpq.campagain_or_activity_id",$campagain_id);
        $this->db->where("bccpq.task_type",'campaign');

        $campagain_phase_question_data = $this->db->get()->result_array();

        return $campagain_phase_question_data;
    }

    public function get_child_data($political_geo_id)
    {
        $this->db->select("*");
        $this->db->from("bf_master_political_geography_details");
        $this->db->where("parent_geo_id",$political_geo_id);

        $geo_location_data = $this->db->get()->result_array();

        if (isset($geo_location_data) && !empty($geo_location_data)) {
            return $geo_location_data;
        } else {
            return 0;
        }
    }

    public function get_geo_level_data($political_geo_id,$level,$selectedtype=NULL)
    {
        if($selectedtype == NULL)
        {
            $user_role = 11;
        }
        elseif($selectedtype == "retailer")
        {
            $user_role = 10;
        }
        elseif($selectedtype == "distributor")
        {
            $user_role = 9;
        }


        $geo_query = "SELECT bmpg.political_geo_id, bmpg.political_geography_name,
        SUM(IF(ISNULL(bmucd.user_id),0,1)) AS tot_count,
        SUM(IF(ISNULL(bccac.customer_id),0,1)) AS tot_allocated,
        (SUM(IF(ISNULL(bmucd.user_id),0,1)) - SUM(IF(ISNULL(bccac.customer_id),0,1))) AS tot_not_allocated
        FROM `bf_master_political_geography_details` AS bmpg
        LEFT JOIN `bf_master_user_contact_details` AS bmucd ON (bmucd.geo_level_id".$level." = bmpg.political_geo_id)
        LEFT JOIN `bf_cco_campaign_allocation_customers` AS bccac ON (bccac.customer_id = bmucd.user_id)
        LEFT JOIN `bf_users` AS bu ON (bu.id = bmucd.user_id AND bu.`role_id` = $user_role AND bu.deleted= 0)
        WHERE bmpg.parent_geo_id = $political_geo_id
        GROUP BY bmpg.political_geo_id
        ORDER BY bmpg.political_geography_name, bmpg.political_geo_id";

        $geo_data = $this->db->query($geo_query);
        $geo_location_data = $geo_data->result_array();

        if (isset($geo_location_data) && !empty($geo_location_data)) {
            return $geo_location_data;
        } else {
            return 0;
        }
    }

    /**
     * @param $campaign_location_id
     * @param $global_head_user
     */
    public function recursive_location_data($campaign_location_id,&$global_head_user,$flag,$leveldata)
    {
        //GET LOCATION PARENT AND LEVEL DATA

        $location_level_data = $this->get_location_data($campaign_location_id);

        if(isset($location_level_data) && $location_level_data != 0)
        {
            $geo_level_data = $location_level_data[0]["geo_level_id"];
            $parent_level_data = $location_level_data[0]["parent_geo_id"];

            //GET ALL DATA FOR THAT PARENT FOR THAT LEVEL

            $all_location_level_data = $this->get_all_location_data($geo_level_data,$parent_level_data);

            if($flag <= $leveldata)
            {
                if (!empty($all_location_level_data) && $all_location_level_data != 0)
                {
                    $global_head_user = $all_location_level_data;
                    $flag = $flag + 1;
                    return $this->recursive_location_data($parent_level_data, $global_head_user, $flag,$leveldata);
                    //testdata($d);
                } else {
                    return $global_head_user;
                }
            }
            else{
                return $global_head_user;
            }

        }
        else{
            return $global_head_user;
        }
    }

    public function get_campagain_loc_data($campagain_id)
    {
        $this->db->select("*");
        $this->db->from("bf_cco_campaign_location");
        $this->db->where("campaign_id",$campagain_id);

        $campagain_data = $this->db->get()->result_array();

        if (isset($campagain_data) && !empty($campagain_data)) {
            return $campagain_data;
        } else {
            return 0;
        }
    }

    public function get_location_data($campaign_location_id)
    {
        $this->db->select("*");
        $this->db->from("bf_master_political_geography_details");
        $this->db->where("political_geo_id",$campaign_location_id);

        $geo_location_data = $this->db->get()->result_array();

        if (isset($geo_location_data) && !empty($geo_location_data)) {
            return $geo_location_data;
        } else {
            return 0;
        }
    }

    public function get_all_location_data($geo_level_data,$parent_level_data)
    {
        $this->db->select("*");
        $this->db->from("bf_master_political_geography_details");
        $this->db->where("geo_level_id",$geo_level_data);
        $this->db->where("parent_geo_id",$parent_level_data);

        $all_geo_location_data = $this->db->get()->result_array();

        if (isset($all_geo_location_data) && !empty($all_geo_location_data)) {
            return $all_geo_location_data;
        } else {
            return 0;
        }
    }

    public function campagain_data($role = null,$country_id)
    {
        $this->db->select("*");
        $this->db->from("bf_cco_campaign");
        if($role != null) {
            $this->db->where("customer_type", $role);
        }
        $this->db->where("country_id",$country_id);
        $this->db->where("deleted","0");
        $this->db->where("status","1");

        $campagain_data = $this->db->get()->result_array();

        if (isset($campagain_data) && !empty($campagain_data)) {
            return $campagain_data;
        } else {
            return 0;
        }
    }
    public function call_status_data($campagain_id,$customer_id)
    {
        $this->db->select("*");
        $this->db->from("bf_cco_campaign_allocation_customers");
        $this->db->where("campaign_id", $campagain_id);
        $this->db->where("customer_id",$customer_id);

        $call_status_data = $this->db->get()->result_array();

        if (isset($call_status_data) && !empty($call_status_data)) {
            return $call_status_data;
        } else {
            return 0;
        }
    }

    public function get_farmer_count($geoid,$level,$selectedtype=NULL)
    {
        if($level == 3)
        {
            $where = " AND bmucd.geo_level_id3 = ".$geoid;
            $where1 = "  bmucd.geo_level_id3 = ".$geoid;
        }
        elseif($level == 2)
        {
            $where = " AND bmucd.geo_level_id2 = ".$geoid;
            $where1 = "  bmucd.geo_level_id2 = ".$geoid;
        }
        elseif($level == 1)
        {
            $where = " AND bmucd.geo_level_id1 = ".$geoid;
            $where1 = "  bmucd.geo_level_id1 = ".$geoid;
        }

        if($selectedtype == NULL)
        {
            $user_role = 11;
        }
        elseif($selectedtype == "retailer")
        {
            $user_role = 10;
        }
        elseif($selectedtype == "distributor")
        {
            $user_role = 9;
        }

        $sql = 'SELECT count(*) as row_count FROM `bf_users` as bu JOIN bf_master_user_contact_details as bmucd on bmucd.user_id = bu.id WHERE bu.`role_id` ='.$user_role.' AND bu.deleted= 0 '.$where;

       // echo $sql;

        $info = $this->db->query($sql);
        // For Pagination
        $farmer_data = $info->result_array();

        if(!empty($farmer_data)) {

            $sql2 = 'SELECT count(*) as row_count FROM `bf_cco_campaign_allocation_customers` as bccac JOIN bf_master_user_contact_details as bmucd on bmucd.user_id = bccac.customer_id WHERE '.$where1;

            $info2 = $this->db->query($sql2);
            // For Pagination
            $allocated_customer_data = $info2->result_array();

            if(!empty($allocated_customer_data)){
               $allocated_row_count = $allocated_customer_data[0]["row_count"];
            }
            else{
                $allocated_row_count = 0;
            }

            $pending_count = $farmer_data[0]["row_count"] - $allocated_row_count;

            $final_data["total_count"] =  $farmer_data[0]["row_count"];
            $final_data["pending_count"] = $pending_count;

            return $final_data;
        }
        else
        {
            return 0;
        }
    }

    //GET UNALLOCATED FARMER COUNT

    public function get_unallocated_farmer_count($geoid,$level)
    {
        if($level == 3)
        {
            $where = " AND bmucd.geo_level_id3 = ".$geoid;
        }
        elseif($level == 2)
        {
            $where = " AND bmucd.geo_level_id2 = ".$geoid;
        }
        elseif($level == 1)
        {
            $where = " AND bmucd.geo_level_id1 = ".$geoid;
        }

        $sql = 'SELECT count(*) as row_count FROM `bf_users` as bu
                JOIN bf_master_user_contact_details as bmucd on bmucd.user_id = bu.id
                JOIN bf_cco_campaign_allocation_customers as bccac on bccac.customer_id = bu.id AND

                WHERE bu.`role_id` = 11 AND bu.deleted= 0 '.$where;

        $info = $this->db->query($sql);
        // For Pagination
        $farmer_data = $info->result_array();

        if(!empty($farmer_data)) {
            return $farmer_data[0]["row_count"];
        }
        else
        {
            return 0;
        }
    }

    public function get_all_cco_data($country_id)
    {
        $this->db->select('id,display_name');
        $this->db->from('users');
        $this->db->where('country_id',$country_id);
        $this->db->where('role_id','19');
        $this->db->where('active','1');
        $this->db->where('deleted','0');
        $cco_data = $this->db->get()->result_array();

        if(isset($cco_data ) && !empty($cco_data )){
            return $cco_data;
        }
        else{
            return array();
        }
    }

    public function geo_farmer_data($geo_data,$selected_type=null)
    {

        if($selected_type == null){
            $user_role = 11;
            $user_role2 = "";
        }
        elseif($selected_type == "retailer"){
            $user_role = 10;
            $user_role2 = "";
        }
        elseif($selected_type == "distributor"){
            $user_role = 9;
            $user_role2 = "";
        }
        elseif($selected_type == "employee"){
            $user_role = 7;
            $user_role2 = 8;
        }

        $sql = 'SELECT bu.id FROM `bf_users` as bu JOIN bf_master_user_contact_details as bmucd on bmucd.user_id = bu.id WHERE ';

        $sql .= ' bu.`role_id` = '.$user_role ;

        if($user_role2 != "")
        {
            $sql .= ' OR bu.`role_id` = '.$user_role2 ;
        }

        $sql .= ' AND bu.deleted= 0 AND bmucd.geo_level_id1 = '.$geo_data;

        $info = $this->db->query($sql);
        // For Pagination
        $farmer_data = $info->result_array();

        if(!empty($farmer_data)) {
            return $farmer_data;
        }
        else
        {
            return 0;
        }
    }

    public function geo_employee_data($geo_data,$selected_type=null,$page)
    {
        if($selected_type == null){
            $user_role = 11;
            $user_role2 = "";
        }
        elseif($selected_type == "retailer"){
            $user_role = 10;
            $user_role2 = "";
        }
        elseif($selected_type == "distributor"){
            $user_role = 9;
            $user_role2 = "";
        }
        elseif($selected_type == "employee"){
            $user_role = 7;
            $user_role2 = 8;
        }

        $sql = 'SELECT
                bu.user_code,bu.display_name,bmucd.primary_mobile_no,bmucd.secondary_mobile_no,bmucd.landline_no,
                mpgd3.political_geography_name as level_3,mpgd2.political_geography_name as level_2,mpgd1.political_geography_name as level_1
                FROM `bf_users` as bu

                JOIN bf_master_user_contact_details as bmucd on bmucd.user_id = bu.id
                LEFT JOIN bf_master_political_geography_details AS mpgd3 ON mpgd3.political_geo_id = bmucd.geo_level_id3
                LEFT JOIN bf_master_political_geography_details AS mpgd2 ON mpgd2.political_geo_id = bmucd.geo_level_id2
                LEFT JOIN bf_master_political_geography_details AS mpgd1 ON mpgd1.political_geo_id = bmucd.geo_level_id1

                WHERE ';

        $sql .= ' bu.`role_id` = '.$user_role ;

        if($user_role2 != "")
        {
            $sql .= ' OR bu.`role_id` = '.$user_role2 ;
        }



        $sql .= ' AND bu.deleted= 0 AND bmucd.geo_level_id1 = '.$geo_data.' ';

        //echo $sql;

        $employee_data = $this->grid->get_result_res($sql);

        if (isset($employee_data['result']) && !empty($employee_data['result'])) {

            $employee['head'] = array('Sr No.', '','Employee Code','Employee Name','Level 3','Level 2','Level 1','Designation','Reporting Person','Primary Number','Secondary Number','Landline No.');

            $employee['count'] = count($employee['head']);

            if ($page != null || $page != "") {
                $i = (($page * 10) - 9);
            } else {
                $i = 1;
            }

            foreach ($employee_data['result'] as $rm) {

               /* if ($local_date != null) {
                    $date3 = strtotime($rm['created_on']);
                    $created_date = date($local_date, $date3);

                } else {
                    $created_date = $rm['created_on'];
                }
                */

               $primary_no = '<a href="javascript: void(0);" rel="'.$rm["primary_mobile_no"].'"  class="primary_no">'.$rm["primary_mobile_no"].'</a>';

                $employee['row'][] = array($i,'',$rm["user_code"],$rm['display_name'],$rm['level_3'],$rm['level_2'],$rm['level_1'],'','',$primary_no,$rm['secondary_mobile_no'],$rm['landline_no']);
                $i++;
            }


            //$feedback['action'] = 'is_action';
           // $feedback['delete'] = 'is_delete';
            //$feedback['edit'] = 'is_edit';
            $employee['pagination'] = $employee_data['pagination'];

            return $employee;
        }
        else {
            return false;
        }

        //$info = $this->db->query($sql);
        // For Pagination
        //$employee_data = $info->result_array();

        //if(!empty($employee_data)) {
        //    return $employee_data;
        //}
        //else
        //{
        //   return 0;
        //}
    }

    public function add_customer_allocation_data($farmer_id,$campagain_data,$cco_data,$geo_data)
    {
        $user= $this->auth->user();
        $logined_user_type = $user->role_id;
        $logined_user_id = $user->id;
        $logined_user_countryid = $user->country_id;

        $data_array = array(
            'campaign_id' => $campagain_data,
            'cco_id' => $cco_data,
            'geo_level_1' => $geo_data,
            'created_by_user' => $logined_user_id,
            'created_on' => date("Y-m-d h:i:s")
        );

        $check_data = $this->check_cco_campagain_data($cco_data,$campagain_data,$geo_data);

        if($check_data == 0)
        {
            $customer_count = 0;
            $data_array["customer_count"] = $customer_count;

            $this->db->insert("bf_cco_campaign_allocation", $data_array);
            $allocation_id = $this->db->insert_id();

        }
        else
        {

            $allocation_id = $check_data[0]["allocation_id"];
            if($check_data[0]["customer_count"] == NULL || $check_data[0]["customer_count"] == ""){
                $customer_count = 0;
            }
            else
            {
                $customer_count = $check_data[0]["customer_count"];
            }
        }

        $new_customer_count = $customer_count+1;

        $sub_data_array = array(
            'campaign_id' => $campagain_data,
            'allocation_id' => $allocation_id,
            'cco_id' => $cco_data,
            'allocated_date' => date("Y-m-d"),
            'customer_id' => $farmer_id,
            'created_by_user' => $logined_user_id,
            'created_on' => date("Y-m-d h:i:s")
        );

        $this->db->insert("bf_cco_campaign_allocation_customers",$sub_data_array);

        if($this->db->affected_rows() > 0){

            $update_array = array('customer_count' => $new_customer_count);
            $this->db->where('allocation_id',$allocation_id);
            $this->db->update("bf_cco_campaign_allocation",$update_array);

            return 1;
        }
        else{
            return 0;
        }

    }

    /*-----------------------------------------------------------------------------------------*/

    public function add_cco_allocation_activity_details($user_id,$country_id)
    {

        $check = $this->input->post("check");
        $cco_data = $this->input->post("cco_data");
        $activity_type = $this->input->post("activity_type");

        if((isset($check) && !empty($check)) && (isset($cco_data) && !empty($cco_data))){

            foreach($check as $k => $val)
            {
                $add_allocation_activity = array(
                    'activity_id' => $val,
                    'cco_id' => $cco_data,
                    'activity_type' => $activity_type,
                    'country_id' => $country_id,
                    'created_by_user' => $user_id,
                    'modified_by_user' => $user_id,
                    'created_on' => date('Y-m-d H:i:s'),
                    'modified_on' => date('Y-m-d H:i:s')
                );
                $this->db->insert('cco_activity_allocation', $add_allocation_activity);


                $update_activity= array(
                    'is_cco' => '1'
                );

                $this->db->where('activity_planning_id',$val);
                $this->db->update("ecp_activity_planning",$update_activity);
            }
        }

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }

    }

    public function get_activity_details_by_type($user_id,$country_id,$activity_type,$page=null,$local_date=null,$csv=null)
    {
        //$sql = 'SELECT * ';
        $sql = 'SELECT caa.activity_allocation_id,bu.display_name,bus.display_name as emp_name,mpgd2.political_geography_name as geo_level_2,mpgd3.political_geography_name as geo_level_3,mpgd4.political_geography_name as geo_level_4,eamc.activity_type_country_name,eap.activity_planning_time,eap.execution_time ';
        $sql .= 'FROM bf_cco_activity_allocation AS caa ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = caa.cco_id) ';
        $sql .= 'JOIN bf_ecp_activity_planning AS eap ON (eap.activity_planning_id = caa.activity_id) ';
        $sql .= 'JOIN bf_users AS bus ON (bus.id = eap.employee_id) ';
        $sql .= 'JOIN bf_ecp_activity_master_country AS eamc ON (eamc.activity_type_country_id = eap.activity_type_id) ';
        $sql .= 'JOIN bf_master_political_geography_details AS mpgd2 ON (mpgd2.political_geo_id = eap.geo_level_id_2) ';
        $sql .= 'JOIN bf_master_political_geography_details as mpgd3 ON (mpgd3.political_geo_id = eap.geo_level_id_3) ';
        $sql .= 'LEFT JOIN bf_master_political_geography_details as mpgd4 ON (mpgd4.political_geo_id = eap.geo_level_id_4) ';

        $sql .= 'WHERE 1 ';
        $sql .= ' AND caa.country_id ="' . $country_id . '" ';
        $sql .= ' AND caa.activity_type = "'. $activity_type . '" ';
        $sql .= ' ORDER BY caa.activity_allocation_id  DESC ';

        if(isset($csv) && !empty($csv) && $csv =='csv')
        {
            $activity_approval = $this->grid->get_result_res($sql,true,$page);
        }
        else{
            $activity_approval = $this->grid->get_result_res($sql);
        }



        if (isset($activity_approval['result']) && !empty($activity_approval['result'])) {

            if($activity_type == 'planned_activity'){

                if(isset($csv) && !empty($csv) && $csv =='csv')
                {
                    $activity['head'] = array('Sr. No.','CCO Name', 'FC Name','Geo Level 3','Geo Level 2','Geo Level 1' , 'Activity Type', 'Activity Date');

                    $i = 1;

                    foreach ($activity_approval['result'] as $rm) {

                        if ($local_date != null) {
                            $date3 = strtotime($rm['activity_planning_time']);
                            $activity_date = date($local_date .' g:i A', $date3);

                        } else {
                            $activity_date = $rm['activity_planning_time'];
                        }



                        $activity['row'][] = array($i, $rm['display_name'], $rm['emp_name'],$rm['geo_level_2'],$rm['geo_level_3'],$rm['geo_level_4'],$rm['activity_type_country_name'],$activity_date);
                        $i++;
                    }
                }
                else{
                    $activity['head'] = array('Sr. No.', 'Select','CCO Name', 'FC Name','Geo Level 3','Geo Level 2','Geo Level 1' , 'Activity Type', 'Activity Date');

                    $activity['count'] = count($activity['head']);

                    if ($page != null || $page != "") {
                        $i = (($page * 10) - 9);
                    } else {
                        $i = 1;
                    }

                    foreach ($activity_approval['result'] as $rm) {

                        if ($local_date != null) {
                            $date3 = strtotime($rm['activity_planning_time']);
                            $activity_date = date($local_date .' g:i A', $date3);

                        } else {
                            $activity_date = $rm['activity_planning_time'];
                        }



                        $activity['row'][] = array($i, $rm['activity_allocation_id'], $rm['display_name'], $rm['emp_name'],$rm['geo_level_2'],$rm['geo_level_3'],$rm['geo_level_4'],$rm['activity_type_country_name'],$activity_date);
                        $i++;
                    }
                }

            }
            else{

                if(isset($csv) && !empty($csv) && $csv =='csv')
                {
                    $activity['head'] = array('Sr. No.','CCO Name', 'FC Name','Geo Level 3','Geo Level 2','Geo Level 1' , 'Activity Type', 'Activity Date');

                    $i = 1;

                    foreach ($activity_approval['result'] as $rm) {

                        if ($local_date != null) {
                            $date3 = strtotime($rm['execution_time']);
                            $activity_date = date($local_date .' g:i A', $date3);

                        } else {
                            $activity_date = $rm['execution_time'];
                        }

                        $activity['row'][] = array($i, $rm['display_name'], $rm['emp_name'],$rm['geo_level_2'],$rm['geo_level_3'],$rm['geo_level_4'],$rm['activity_type_country_name'],$activity_date);
                        $i++;
                    }
                }

                else{
                    $activity['head'] = array('Sr. No.', 'Select','CCO Name', 'FC Name','Geo Level 3','Geo Level 2','Geo Level 1' , 'Activity Type', 'Activity Date');

                    $activity['count'] = count($activity['head']);

                    if ($page != null || $page != "") {
                        $i = (($page * 10) - 9);
                    } else {
                        $i = 1;
                    }

                    foreach ($activity_approval['result'] as $rm) {

                        if ($local_date != null) {
                            $date3 = strtotime($rm['execution_time']);
                            $activity_date = date($local_date .' g:i A', $date3);

                        } else {
                            $activity_date = $rm['execution_time'];
                        }

                        $activity['row'][] = array($i, $rm['activity_allocation_id'], $rm['display_name'], $rm['emp_name'],$rm['geo_level_2'],$rm['geo_level_3'],$rm['geo_level_4'],$rm['activity_type_country_name'],$activity_date);
                        $i++;
                    }
                }

            }

            if(!isset($csv) && empty($csv) && $csv !='csv')
            {
                $activity['is_not_checkbox'] = 'is_checkbox';
                $activity['action'] = '';
                $activity['delete'] = '';
                $activity['pagination'] = $activity_approval['pagination'];
            }

            return $activity;
        } else {
            return false;
        }

    }


    public function delete_activity_allocations($allocation_id)
    {
        foreach($allocation_id as $K => $vl)
        {
            $activity_id = $this->get_activity_id_by_allocation_id($vl);

            $update_activity= array(
                'is_cco' => '0'
            );

            $this->db->where('activity_planning_id',$activity_id['activity_id']);
            $this->db->update("ecp_activity_planning",$update_activity);

            $this->db->where('activity_allocation_id', $vl);
            $this->db->delete('cco_activity_allocation');
        }

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_activity_id_by_allocation_id($allocation_id)
    {
        $this->db->select('activity_id');
        $this->db->from('bf_cco_activity_allocation');
        $this->db->where('activity_allocation_id',$allocation_id);
        $activity_id = $this->db->get()->row_array();

        if(isset($activity_id) && !empty($activity_id))
        {
            return $activity_id;
        }
    }

    public function get_all_campaign_data($user_id,$role_id,$country_id)
    {
        $this->db->select('cc.campaign_id,cc.campaign_name');
        $this->db->from('cco_campaign_allocation as cca');
        $this->db->join('cco_campaign as cc','cc.campaign_id = cca.campaign_id');
        if($role_id == '18')
        {
            $this->db->where('cc.country_id',$country_id);
        }
        else{
            $this->db->where('cca.cco_id',$user_id);
            $this->db->where('cc.country_id',$country_id);
        }

        $campaign = $this->db->get()->result_array();

        if(isset($campaign) && !empty($campaign))
        {
            return $campaign;
        }
    }

    public function get_all_campaign_details($user_id,$role_id,$country_id)
    {
        //$this->db->select('*');
        $this->db->select('cc.campaign_id,cc.campaign_name,cc.campaign_purpose,ccp.phase_id,ccp.phase_name,ccp.start_date,ccp.end_date,ccp.phase_purpose,sum(ccd.is_call_done) as total_call,cca.customer_count');
        $this->db->from('cco_campaign as cc');
        $this->db->join('cco_campaign_phase as ccp','ccp.campaign_id = cc.campaign_id','LEFT');
        $this->db->join('cco_call_details as ccd','ccd.phase_id = ccp.phase_id','LEFT');
        $this->db->join('cco_campaign_allocation as cca','cca.campaign_id = cc.campaign_id','LEFT');

        if($role_id == '18')
        {
            $this->db->where('cc.country_id',$country_id);
        }
        else{
            $this->db->where('cca.cco_id',$user_id);
            $this->db->where('cc.country_id',$country_id);
        }

        $this->db->where('cc.deleted','0');
        $this->db->where('cc.status','1');
        $this->db->group_by('ccp.phase_id');
        $this->db->order_by('cc.campaign_id','ASC');

        $campaign = $this->db->get()->result_array();

        $final_array=array();
        if(isset($campaign) && !empty($campaign))
        {

            foreach($campaign as $k =>$val)
            {
                $inner_array = array();
                $final_array[$val['campaign_id']]['campaign'] = $val['campaign_name'];
                $final_array[$val['campaign_id']]['campaign_id'] = $val['campaign_id'];


                $inner_array["phase_name"] = isset($val['phase_name']) && !empty($val['phase_name']) ? $val['phase_name'] : '';
                $inner_array["start_date"] = isset($val['start_date']) && !empty($val['start_date']) ? $val['start_date'] : '';
                $inner_array["end_date"] = isset($val['end_date']) && !empty($val['end_date']) ? $val['end_date'] : '';
                $inner_array["campaign_purpose"] = isset($val['campaign_purpose']) && !empty($val['campaign_purpose']) ? $val['campaign_purpose'] : '';
                $inner_array["total_call"] = isset($val['total_call']) && !empty($val['total_call']) ? $val['total_call'] : '0';
                $inner_array["customer_count"] = isset($val['customer_count']) && !empty($val['customer_count']) ? $val['customer_count'] : '0';

                $final_array[$val['campaign_id']]['phase'][] = $inner_array;

            }

        }
        return $final_array;
    }

    public function getAllPhaseDetailByCampaignId($campaign_id,$user_id,$role_id,$country_id)
    {
        $this->db->select('ccp.phase_name,ccp.avg_call_duration,sum(ccd.is_call_done) as total_call,cca.customer_count,ccp.end_date,ccp.phase_status');
        $this->db->from('cco_campaign_phase as ccp');
        $this->db->join('cco_call_details as ccd','ccd.phase_id = ccp.phase_id','LEFT');
        $this->db->join('cco_campaign_allocation as cca','cca.campaign_id = ccp.campaign_id','LEFT');
        $this->db->where('ccp.campaign_id',$campaign_id);

        if($role_id == '19')
        {
            $this->db->where('cca.cco_id',$user_id);
        }
        
        $this->db->group_by('ccp.phase_id');
        $this->db->order_by('ccp.phase_id','ASC');

        $phase_details = $this->db->get()->result_array();

        if(isset($phase_details) && !empty($phase_details))
        {
            return $phase_details;
        }
    }

    public function get_activity_type_allocated_customer_data($user_id,$role_id,$country_id,$activity_type)
    {
        $this->db->select('eap.activity_planning_id,bus.user_code,display_name,eap.activity_planning_time,eap.proposed_attandence_count,eamc   .activity_type_country_name,caa.called_status,mpgd2.political_geography_name as level_2,mpgd3.political_geography_name as level_3,mpgd4.political_geography_name as level_4,mdc.desigination_country_name,mucd.primary_mobile_no');
       // $this->db->select('*');
        $this->db->from('cco_activity_allocation as caa');
        $this->db->join('ecp_activity_planning as eap','eap.activity_planning_id = caa.activity_id');
        $this->db->join('users as bus','bus.id = eap.employee_id');
        $this->db->join('ecp_activity_master_country AS eamc','eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->join('master_political_geography_details AS mpgd2','mpgd2.political_geo_id = eap.geo_level_id_2');
        $this->db->join('master_political_geography_details as mpgd3','mpgd3.political_geo_id = eap.geo_level_id_3');
        $this->db->join('master_political_geography_details as mpgd4','mpgd4.political_geo_id = eap.geo_level_id_4','left');
        $this->db->join('master_designation_role as mdr','mdr.user_id = eap.employee_id');
        $this->db->join('master_designation_country as mdc','mdc.desigination_country_id = mdr.desigination_id');
        $this->db->join('master_user_contact_details as mucd','mucd.user_id = eap.employee_id');
        $this->db->where('caa.activity_type',$activity_type);
        $this->db->where('caa.country_id',$country_id);

        if($role_id == '19')
        {
            $this->db->where('cca.cco_id',$user_id);
        }

        //$this->db->group_by('ccp.phase_id');
        $this->db->order_by('eap.activity_planning_time','ASC');


        $activity_details = $this->db->get()->result_array();
       // testdata($activity_details);
        if(isset($activity_details) && !empty($activity_details))
        {
            return $activity_details;
        }
    }

    public function get_executed_activity_allocated_customer_data($user_id,$role_id,$country_id,$activity_type)
    {
        $this->db->select('eap.activity_planning_id,bus.user_code,display_name,eamc.activity_type_country_name,caa.called_status,mpgd2.political_geography_name as level_2,mpgd3.political_geography_name as level_3,mpgd4.political_geography_name as level_4,mdc.desigination_country_name,eap.execution_time');
        // $this->db->select('*');
        $this->db->from('cco_activity_allocation as caa');
        $this->db->join('ecp_activity_planning as eap','eap.activity_planning_id = caa.activity_id');
        $this->db->join('users as bus','bus.id = eap.employee_id');
        $this->db->join('ecp_activity_master_country AS eamc','eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->join('master_political_geography_details AS mpgd2','mpgd2.political_geo_id = eap.geo_level_id_2');
        $this->db->join('master_political_geography_details as mpgd3','mpgd3.political_geo_id = eap.geo_level_id_3');
        $this->db->join('master_political_geography_details as mpgd4','mpgd4.political_geo_id = eap.geo_level_id_4','left');
        $this->db->join('master_designation_role as mdr','mdr.user_id = eap.employee_id');
        $this->db->join('master_designation_country as mdc','mdc.desigination_country_id = mdr.desigination_id');
        $this->db->join('master_user_contact_details as mucd','mucd.user_id = eap.employee_id');

        $this->db->join('ecp_activity_planning_key_customer_details as eapkcd','eapkcd.activity_planning_id = eap.activity_planning_id','left');
        $this->db->join('ecp_activity_planning_attendees_details as eapad','eapad.activity_planning_id = eap.activity_planning_id','left');



        $this->db->where('caa.activity_type',$activity_type);
        $this->db->where('caa.country_id',$country_id);

        if($role_id == '19')
        {
            $this->db->where('cca.cco_id',$user_id);
        }

        //$this->db->group_by('ccp.phase_id');
        $this->db->order_by('eap.execution_time','ASC');


        $activity_details = $this->db->get()->result_array();
        $final_array = array();
        if(isset($activity_details) && !empty($activity_details))
        {
            foreach($activity_details as $val)
            {
                $final_array[$val['activity_planning_id']]['activity_details'] = $val;
                //$final_array['kc'] = $this->get_count_key_customer($val['activity_planning_id']);
                //$final_array['ad'] = $this->get_count_customer($val['activity_planning_id']);
                $kc = $this->get_count_key_customer($val['activity_planning_id']);
                $ad = $this->get_count_customer($val['activity_planning_id']);

                $final_array[$val['activity_planning_id']]['customer_count'] = ($kc + $ad);
            }
            return $final_array;
        }
    }

    public function get_customer_details_by_id($id)
    {
        $this->db-> select('eap.activity_planning_id,eap.execution_time,eamc.activity_type_country_name');
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('ecp_activity_master_country AS eamc','eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->where('activity_planning_id',$id);
        $activity_details = $this->db->get()->row_array();
        $activity_details['key_customer'] = $this->get_key_customer($id);
        $activity_details['ad'] = $this->get_customer($id);
       if(!empty($activity_details))
       {
           return $activity_details;
       }
    }

    public function get_key_customer($id){
        //$this->db->select('*');
        $this->db->select('eapkcd.mobile_no,mupd.first_name,mupd.first_name,mupd.middle_name,mupd.last_name,mupd.call_name,mucd.primary_mobile_no,mucd.secondary_mobile_no,mucd.landline_no,mucd.pincode,mpgd2.political_geography_name as level_2,mpgd3.political_geography_name as level_3,mpgd4.political_geography_name as level_4');
        $this->db->from('ecp_activity_planning_key_customer_details as eapkcd');
        $this->db->join('users AS bu','bu.id = eapkcd.customer_id');
        $this->db->join('master_user_contact_details AS mucd','mucd.user_id = eapkcd.customer_id','left');
        $this->db->join('master_user_personal_details AS mupd','mupd.user_id = eapkcd.customer_id','left');
        $this->db->join('master_political_geography_details AS mpgd2','mpgd2.political_geo_id = mucd.geo_level_id3','left');
        $this->db->join('master_political_geography_details as mpgd3','mpgd3.political_geo_id = mucd.geo_level_id2','left');
        $this->db->join('master_political_geography_details as mpgd4','mpgd4.political_geo_id = mucd.geo_level_id1','left');
        $this->db->where('activity_planning_id',$id);
        $key_customer_details = $this->db->get()->result_array();

        if(isset($key_customer_details) && !empty($key_customer_details))
        {
            return $key_customer_details;
        }
        else{
            return array();
        }
    }

    public function get_customer($id){
        $this->db->select('*');
        $this->db->from('ecp_activity_planning_attendees_details as eapad');
        $this->db->where('activity_planning_id',$id);
        $customer_details = $this->db->get()->result_array();

        if(isset($customer_details) && !empty($customer_details))
        {
            return $customer_details;
        }
        else{
            return array();
        }
    }

    public function get_count_key_customer($activity_planning_id)
    {
        $this->db->select('*');
        $this->db->from('ecp_activity_planning_key_customer_details as eapkcd');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $query = $this->db->get();
        $rowcount = $query->num_rows();

        if(isset($rowcount) && !empty($rowcount))
        {
            return $rowcount;
        }
        else{
            return 0;
        }
    }

    public function get_count_customer($activity_planning_id)
    {
        $this->db->select('*');
        $this->db->from('ecp_activity_planning_attendees_details as eapad');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $query = $this->db->get();
        $rowcount = $query->num_rows();

        if(isset($rowcount) && !empty($rowcount))
        {
            return $rowcount;
        }
        else{
            return 0;
        }
    }

    public function get_geo_by_customer_id($customer_id)
    {
        $this->db->select('mucd.geo_level_id3,mpgd.political_geography_name');
        $this->db->from('master_user_contact_details as mucd');
        $this->db->join('master_political_geography_details AS mpgd','mpgd.political_geo_id = mucd.geo_level_id3');
        $this->db->where('mucd.user_id',$customer_id);
        $geo = $this->db->get()->result_array();
        if(isset($geo) && !empty($geo))
        {
            return $geo;
        }
        else{
            return '';
        }

    }

    public function all_activity_view_details($user_id,$country_id,$geo_level_2,$geo_level_3,$geo_level_4,$cur_month)
    {
        $this->db->select('activity_planning_date');
        $this->db->from('ecp_activity_planning as eap');
        $this->db->where('eap.country_id', $country_id);
        $this->db->where('eap.geo_level_id_2', $geo_level_2);
        $this->db->where('eap.geo_level_id_3', $geo_level_3);
        $this->db->where('eap.geo_level_id_4', $geo_level_4);
        $this->db->where('eap.status','2');
        $this->db->where('DATE_FORMAT(eap.activity_planning_time,"%c-%Y")',$cur_month);
        $this->db->order_by('eap.activity_planning_time','ASC');
        $activity_details = $this->db->get()->result_array();

        if (isset($activity_details) && !empty($activity_details)) {
            return $activity_details;
        } else {
            return false;
        }
    }

    public function all_activity_view_details_by_date($user_id,$country_id,$cur_date,$geo_level_2,$geo_level_3,$geo_level_4){

        $this->db->select('eap.activity_planning_id,eamc.activity_type_country_name,mucd.primary_mobile_no,bus.display_name,eap.proposed_attandence_count,eap.location,mpgd.political_geography_name');
       // $this->db->select('*');
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('users as bus','bus.id = eap.employee_id');
        $this->db->join('master_user_contact_details as mucd','mucd.user_id = eap.employee_id');
        $this->db->join('ecp_activity_master_country AS eamc','eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->join('master_political_geography_details AS mpgd','mpgd.political_geo_id = eap.geo_level_id');
        $this->db->where('eap.country_id', $country_id);
        $this->db->where('eap.geo_level_id_2', $geo_level_2);
        $this->db->where('eap.geo_level_id_3', $geo_level_3);
        $this->db->where('eap.geo_level_id_4', $geo_level_4);
        $this->db->where('eap.status','2');
        $this->db->where('DATE_FORMAT(eap.activity_planning_time,"%Y-%c-%d")',$cur_date);
        $this->db->order_by('eap.activity_planning_time','ASC');
        $activity_details = $this->db->get()->result_array();

        $final_array =array();
        foreach($activity_details as $k => $ad)
        {
            $activity["activity_data"] = $ad;
            $activity['crop'] = $this->getCropDetails($ad['activity_planning_id']);
            $activity['products'] = $this->getProductDetails($ad['activity_planning_id']);
            $activity['diseases'] = $this->getDiseasesDetails($ad['activity_planning_id']);
            $activity['join_visit'] = $this->getJointVisitEnployee($ad['activity_planning_id']);

            $final_array[] = $activity;
        }

        if (isset($final_array) && !empty($final_array)) {
            return $final_array;
        } else {
            return false;
        }

    }

    public function getCropDetails($activity_planning_id)
    {
        $this->db->select('eapcd.crop_id,mcc.crop_name');
        $this->db->from('ecp_activity_planning_crop_details as eapcd');
        $this->db->join('master_crop_country as mcc','mcc.crop_country_id = eapcd.crop_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $Crop= $this->db->get()->result_array();
        if(isset($Crop) && !empty($Crop))
        {
            return $Crop;
        }
        else{
            return array();
        }
    }

    public function getProductDetails($activity_planning_id){
        $this->db->select('eappd.product_sku_id,mpsc.product_sku_name');
        $this->db->from('ecp_activity_planning_product_details as eappd');
        $this->db->join('master_product_sku_country as mpsc','mpsc.product_sku_country_id = eappd.product_sku_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $Product= $this->db->get()->result_array();
        if(isset($Product) && !empty($Product))
        {
            return $Product;
        }
        else{
            return array();
        }
    }

    public function getDiseasesDetails($activity_planning_id){
        $this->db->select('eapdd.diseases_id,mdc.disease_name');
        $this->db->from('ecp_activity_planning_diseases_details as eapdd');
        $this->db->join('master_disease_country as mdc','mdc.disease_country_id = eapdd.diseases_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $Diseases= $this->db->get()->result_array();
        if(isset($Diseases) && !empty($Diseases))
        {
            return $Diseases;
        }
        else{
            return array();
        }
    }

    public function getJointVisitEnployee($activity_planning_id){

        $this->db->select('eapjvd.joint_visit_details_id,eapjvd.employee_id,v_emp.display_name');
        $this->db->from('ecp_activity_planning_joint_visit_details as eapjvd');
        $this->db->join('users as v_emp','v_emp.id = eapjvd.employee_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $VisitEnployee= $this->db->get()->result_array();
        if(isset($VisitEnployee) && !empty($VisitEnployee))
        {
            return $VisitEnployee;
        }
        else{
            return array();
        }
    }

    public function get_planned_activity_details_data($customer_id,$activity_planning_id)
    {
        $this->db->select('eap.activity_planning_id,eap.activity_planning_date,eap.activity_planning_time,eap.execution_date,eap.execution_time,eap.meeting_duration,eap.activity_type_id,eap.geo_level_id_2,eap.geo_level_id_3,eap.geo_level_id_4,eap.location,eap.proposed_attandence_count,eap.point_discussion,eap.alert,eap.size_of_plot,eap.spray_volume,eap.amount,eap.rating,eap.activity_note,eap.employee_id,amc.activity_type_code,amc.activity_type_country_name,mpgd2.political_geography_name as geo_level_name_2,,mpgd3.political_geography_name as geo_level_name_3,mpgd4.political_geography_name as geo_level_name_4,eap.status,eap.submit_status');
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('ecp_activity_master_country as amc','amc.activity_type_country_id = eap.activity_type_id','left');
        $this->db->join('master_political_geography_details as mpgd2','mpgd2.political_geo_id = eap.geo_level_id_2','left');
        $this->db->join('master_political_geography_details as mpgd3','mpgd3.political_geo_id = eap.geo_level_id_3','left');
        $this->db->join('master_political_geography_details as mpgd4','mpgd4.political_geo_id = eap.geo_level_id_4','left');
        $this->db->where('eap.activity_planning_id',$activity_planning_id);
        $activity = $this->db->get()->row_array();

        $activity['crop'] = $this->getCropDetails($activity_planning_id);
        $activity['products'] = $this->getProductDetails($activity_planning_id);
        $activity['diseases'] = $this->getDiseasesDetails($activity_planning_id);
        if($activity['activity_type_code'] == 'RMP003' ||$activity['activity_type_code'] == 'RVP004')
        {
            $activity['key_retailer'] = $this->getKeyRetailerDetails($activity_planning_id);
        }
        else{
            $activity['key_farmer'] = $this->getKeyFarmerDetails($activity_planning_id);
        }
        $activity['digital_library'] = $this->getDigitalLibraryDetails($activity_planning_id);
        $activity['join_visit'] = $this->getJointVisitEnployee($activity_planning_id);
        $activity['products_sample'] = $this->getProductsSample($activity_planning_id);
        $activity['products_request'] = $this->getProductsRequest($activity_planning_id);
        $activity['material_request'] = $this->getMaterialRequest($activity_planning_id);
        $activity['customer'] = $this->getAllCustomer($activity_planning_id);
        $activity['image_gallery'] = $this->getAllUploadFiles($activity_planning_id);
        if(!empty($activity))

            return $activity;

        else
            return array();
    }

    public function getAllUploadFiles($activity_planning_id)
    {
        $this->db->select('files_name');
        $this->db->from('ecp_activity_planning_upload_details as eapud');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $file = $this->db->get()->result_array();

        if(isset($file) && !empty($file))
        {
            $final_arry = array();
            foreach($file as $k=> $vl)
            {
                $final_arry[] = base_url('assets/uploads/activity_gallery/'.$vl['files_name']);
            }
            return $final_arry;
        }
        else{
            return array();
        }
    }

    public function getAllCustomer($activity_planning_id)
    {
        $this->db->select('customer_name,mobile_no');
        $this->db->from('ecp_activity_planning_attendees_details as eapad');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $attendees = $this->db->get()->result_array();
        if(isset($attendees) && !empty($attendees))
        {
            return $attendees;
        }
        else{
            return array();
        }
    }

    public function getKeyFarmerDetails($activity_planning_id){

        $this->db->select('eapkcd.customer_id,buf.display_name,eapkcd.mobile_no');
        $this->db->from('ecp_activity_planning_key_customer_details as eapkcd');
        $this->db->join('users as buf','buf.id = eapkcd.customer_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $KeyFarmer = $this->db->get()->result_array();
        if(isset($KeyFarmer) && !empty($KeyFarmer))
        {
            return $KeyFarmer;
        }
        else{
            return array();
        }
    }

    public function getKeyRetailerDetails($activity_planning_id){
        $this->db->select('eapkcd.customer_id,buf.display_name,eapkcd.mobile_no');
        $this->db->from('ecp_activity_planning_key_customer_details as eapkcd');
        $this->db->join('users as buf','buf.id = eapkcd.customer_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $KeyRetailer = $this->db->get()->result_array();
        if(isset($KeyRetailer) && !empty($KeyRetailer))
        {
            return $KeyRetailer;
        }
        else{
            return array();
        }
    }

    public function getDigitalLibraryDetails($activity_planning_id){

        $this->db->select('eapdld.digital_library_id,edlm.library_name');
        $this->db->from('ecp_activity_planning_digital_library_details as eapdld');
        $this->db->join('ecp_digital_library_master as edlm','edlm.digital_library_id = eapdld.digital_library_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $DigitalLibrary = $this->db->get()->result_array();
        if(isset($DigitalLibrary) && !empty($DigitalLibrary))
        {
            return $DigitalLibrary;
        }
        else{
            return array();
        }
    }

    public function getProductsSample($activity_planning_id){
        $this->db->select('eappsd.product_sku_id,mpsc.product_sku_name,eappsd.quantity');
        $this->db->from('ecp_activity_planning_promo_sample_details as eappsd');
        $this->db->join('master_product_sku_country as mpsc','mpsc.product_sku_country_id = eappsd.product_sku_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $ProductsSample = $this->db->get()->result_array();
        if(isset($ProductsSample) && !empty($ProductsSample))
        {
            return $ProductsSample;
        }
        else{
            return array();
        }

    }

    public function getProductsRequest($activity_planning_id){

        $this->db->select('eaprpd.product_sku_id,mpsc.product_sku_name,eaprpd.quantity');
        $this->db->from('ecp_activity_planning_required_product_details as eaprpd');
        $this->db->join('master_product_sku_country as mpsc','mpsc.product_sku_country_id = eaprpd.product_sku_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $ProductsRequest = $this->db->get()->result_array();
        if(isset($ProductsRequest) && !empty($ProductsRequest))
        {
            return $ProductsRequest;
        }
        else{
            return array();
        }
    }

    public function getMaterialRequest($activity_planning_id){

        $this->db->select('eaprmd.material_id,mpmc.promotional_material_country_name,eaprmd.quantity');
        $this->db->from('ecp_activity_planning_required_material_details as eaprmd');
        $this->db->join('master_promotional_material_country as mpmc','mpmc.promotional_country_id= eaprmd.material_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $MaterialRequest= $this->db->get()->result_array();
        if(isset($MaterialRequest) && !empty($MaterialRequest))
        {
            return $MaterialRequest;
        }
        else{
            return array();
        }
    }

    public function get_all_work_allocation($country_id)
    {
        $cco_work_array = array();

        /* Get Campaign Work */
		$sql = "SELECT id as cco_id, display_name AS cco_name, COUNT(*)AS tot_campaign, SUM(customer_count) AS tot_c_customer,
                        SUM(total_call) AS tot_c_call, SUM(pending_call) AS tot_c_pending_call FROM (
                        SELECT bu.id,bu.display_name,bc.campaign_id,bc.campaign_name, bca.customer_count,
                        (bca.customer_count*bc.no_phase) AS `total_call`,
                        ((bca.customer_count*bc.no_phase) - (SELECT COUNT(*) AS tot FROM bf_cco_call_details AS bccd
                         WHERE bccd.ca_id = bca.campaign_id AND bccd.ca_type = 'campaign'
                        )) AS `pending_call`
                        FROM bf_users AS bu
                        JOIN bf_cco_campaign_allocation AS bca ON (bca.cco_id = bu.id)
                        JOIN bf_cco_campaign AS bc ON (bc.campaign_id = bca.campaign_id)
                        WHERE bu.country_id = $country_id
                        AND (bu.role_id = 19 AND bu.deleted = 0 AND bu.active = 1)
                        AND (bca.deleted = 0 AND bca.status = 1)
                        ORDER BY bu.display_name ASC
                        ) AS campaign_table GROUP BY id
                    ";

        $campaign_sql = $this->db->query($sql);
        $campaign_data = $campaign_sql->result_array();

        foreach ($campaign_data as $campaign)
        {
            $campaign['tot_activity'] = 0;
            $campaign['tot_a_customer'] = 0;
            $campaign['tot_a_call'] = 0;
            $campaign['tot_a_pending_call'] = 0;
            $campaign['tot_pending_call'] = $campaign['tot_c_pending_call']+$campaign['tot_a_pending_call'];
            $cco_work_array[$campaign['cco_id']] = $campaign;
        }

        /* Get Activity Work */
        $sql1 = "SELECT id as cco_id, display_name AS cco_name, COUNT(*) AS tot_activity, SUM(ec_count) AS tot_a_customer, SUM(ec_count) AS tot_a_call,SUM(pending_call) AS tot_a_pending_call
                        FROM (
                        SELECT bu.id, bu.display_name, bca.ec_count,
                        (bca.ec_count - (SELECT COUNT(*) AS tot FROM bf_cco_call_details AS bccd
                         WHERE bccd.ca_id = bca.activity_allocation_id AND bccd.ca_type = 'activity'
                        )) AS pending_call
                        FROM bf_users AS bu
                        JOIN bf_cco_activity_allocation AS bca ON (bca.cco_id = bu.id)

                        WHERE bu.country_id = $country_id
                        AND (bu.role_id = 19 AND bu.deleted = 0 AND bu.active = 1)
                        AND (bca.deleted = 0 AND bca.status = 1)
                        ORDER BY bu.display_name ASC
                        )  AS activity_table GROUP BY id";

        $activity_sql = $this->db->query($sql1);
        $activity_data = $activity_sql->result_array();

        foreach ($activity_data as $activity)
        {
            if(!isset($cco_work_array[$activity['cco_id']]))
            {
                $campaign = array();
                $campaign['cco_id'] = $activity['cco_id'];
                $campaign['cco_name'] = $activity['cco_name'];
                $campaign['tot_campaign'] = 0;
                $campaign['tot_c_customer'] = 0;
                $campaign['tot_c_call'] = 0;
                $campaign['tot_c_pending_call'] = 0;

                $cco_work_array[$activity['cco_id']] = $campaign;
            }

            $activity['tot_pending_call'] = $cco_work_array[$activity['cco_id']]['tot_c_pending_call']+$activity['tot_a_pending_call'];
            $cco_work_array[$activity['cco_id']] = array_merge($cco_work_array[$activity['cco_id']],$activity);
        }

        $cco_work_allocation = array_values($cco_work_array);
        return $cco_work_allocation;
    }

    public function get_all_work_allocation_to_cco($cco_id)
    {
        $cco_work_array = array();

        /* Get Campaign Work */
        $sql = "SELECT bc.campaign_id,bc.campaign_name,bca.allocation_id, bca.customer_count,'campaign' AS allocation_type,
                (bca.customer_count*bc.no_phase) AS `tot_c_call`,
                ((bca.customer_count*bc.no_phase) - (SELECT COUNT(*) AS tot FROM bf_cco_call_details AS bccd
                WHERE bccd.ca_id = bca.campaign_id AND bccd.ca_type = 'campaign'
                )) AS `tot_c_pending_call`
                FROM bf_users AS bu
                JOIN bf_cco_campaign_allocation AS bca ON (bca.cco_id = bu.id)
                JOIN bf_cco_campaign AS bc ON (bc.campaign_id = bca.campaign_id)
                WHERE (bu.id = ".$cco_id." AND bu.deleted = 0 AND bu.active = 1)
                AND (bca.deleted = 0 AND bca.status = 1)
                AND  UNIX_TIMESTAMP(NOW()) <= UNIX_TIMESTAMP(bc.end_date)
                ORDER BY bu.display_name ASC";
       // echo $sql; die;
        $campaign_sql = $this->db->query($sql);
        $campaign_data = $campaign_sql->result_array();

        foreach ($campaign_data as $campaign)
        {
            $campaign['activity_id'] = 0;
            $campaign['activity_allocation_id'] = 0;
            $campaign['activity_name'] ='-';
            $campaign['tot_a_call'] = 0;
            $campaign['tot_a_pending_call'] = 0;
            $campaign['tot_a_customer'] = 0;
            $campaign['tot_pending_call'] = $campaign['tot_c_pending_call']+$campaign['tot_a_pending_call'];
           // $campaign['type_data'] = $campaign['allocation_type'];
            $cco_work_array[] = $campaign;
        }

        /* Get Activity Work */
        $sql1 = "SELECT beap.activity_planning_id as activity_id,bemc.activity_type_country_name as activity_name,bca.activity_allocation_id,bca.ec_count AS tot_a_call,'activity' AS allocation_type,
                (bca.ec_count - (SELECT COUNT(*) AS tot FROM bf_cco_call_details AS bccd
                WHERE bccd.ca_id = bca.activity_allocation_id AND bccd.ca_type = 'activity'
                )) AS tot_a_pending_call
                FROM bf_users AS bu
                JOIN bf_cco_activity_allocation AS bca ON (bca.cco_id = bu.id)
                JOIN bf_ecp_activity_planning AS beap ON (beap.activity_planning_id = bca.activity_id)
                JOIN bf_ecp_activity_master_country AS bemc ON (bemc.activity_type_id = beap.activity_type_id)
                WHERE (bu.id = ".$cco_id." AND bu.deleted = 0 AND bu.active = 1)
                AND (bca.deleted = 0 AND bca.status = 1)
                ORDER BY bu.display_name ASC";

        $activity_sql = $this->db->query($sql1);
        $activity_data = $activity_sql->result_array();

        foreach ($activity_data as $activity)
        {
            $campaign = array();
            $campaign['campaign_id'] = 0;
            $campaign['allocation_id'] = 0;
            $campaign['campaign_name'] = '-';
            $campaign['customer_count'] = 0;
            $campaign['tot_c_call'] = 0;
            $campaign['tot_c_pending_call'] = 0;
            $activity['tot_a_customer'] = $activity['tot_a_call'];
            $activity['tot_pending_call'] = $campaign['tot_c_pending_call']+$activity['tot_a_pending_call'];
           // $campaign['allocation_type'] = $activity['allocation_type'];
            $cco_work_array[] = array_merge($campaign,$activity);
        }

        return $cco_work_array;
    }

    public function get_cco_work_allocation($country_id,$cco_id)
    {
        $cco_work_array = array();

        /* Get Campaign Work */
        $sql = "SELECT id as cco_id, display_name AS cco_name, COUNT(*)AS tot_campaign, SUM(customer_count) AS tot_c_customer,
                        SUM(total_call) AS tot_c_call, SUM(pending_call) AS tot_c_pending_call FROM (
                        SELECT bu.id,bu.display_name,bc.campaign_id,bc.campaign_name, bca.customer_count,
                        (bca.customer_count*bc.no_phase) AS `total_call`,
                        ((bca.customer_count*bc.no_phase) - (SELECT COUNT(*) AS tot FROM bf_cco_call_details AS bccd
                         WHERE bccd.ca_id = bca.campaign_id AND bccd.ca_type = 'campaign'
                        )) AS `pending_call`
                        FROM bf_users AS bu
                        JOIN bf_cco_campaign_allocation AS bca ON (bca.cco_id = bu.id)
                        JOIN bf_cco_campaign AS bc ON (bc.campaign_id = bca.campaign_id)
                        WHERE bu.country_id = $country_id
                        AND bca.cco_id != ".$cco_id."
                        AND (bu.role_id = 19 AND bu.deleted = 0 AND bu.active = 1)
                        AND (bca.deleted = 0 AND bca.status = 1)
                        ORDER BY bu.display_name ASC
                        ) AS campaign_table GROUP BY id
                    ";

        $campaign_sql = $this->db->query($sql);
        $campaign_data = $campaign_sql->result_array();

        foreach ($campaign_data as $campaign)
        {
            $campaign['tot_activity'] = 0;
            $campaign['tot_a_customer'] = 0;
            $campaign['tot_a_call'] = 0;
            $campaign['tot_a_pending_call'] = 0;
            $campaign['tot_pending_call'] = $campaign['tot_c_pending_call']+$campaign['tot_a_pending_call'];
            $cco_work_array[$campaign['cco_id']] = $campaign;
        }

        /* Get Activity Work */
        $sql1 = "SELECT id as cco_id, display_name AS cco_name, COUNT(*) AS tot_activity, SUM(ec_count) AS tot_a_customer, SUM(ec_count) AS tot_a_call,SUM(pending_call) AS tot_a_pending_call
                        FROM (
                        SELECT bu.id, bu.display_name, bca.ec_count,
                        (bca.ec_count - (SELECT COUNT(*) AS tot FROM bf_cco_call_details AS bccd
                         WHERE bccd.ca_id = bca.activity_allocation_id AND bccd.ca_type = 'activity'
                        )) AS pending_call
                        FROM bf_users AS bu
                        JOIN bf_cco_activity_allocation AS bca ON (bca.cco_id = bu.id)

                        WHERE bu.country_id = $country_id
                        AND bca.cco_id != ".$cco_id."
                        AND (bu.role_id = 19 AND bu.deleted = 0 AND bu.active = 1)
                        AND (bca.deleted = 0 AND bca.status = 1)
                        ORDER BY bu.display_name ASC
                        )  AS activity_table GROUP BY id";

        $activity_sql = $this->db->query($sql1);
        $activity_data = $activity_sql->result_array();

        foreach ($activity_data as $activity)
        {
            if(!isset($cco_work_array[$activity['cco_id']]))
            {
                $campaign = array();
                $campaign['cco_id'] = $activity['cco_id'];
                $campaign['cco_name'] = $activity['cco_name'];
                $campaign['tot_campaign'] = 0;
                $campaign['tot_c_customer'] = 0;
                $campaign['tot_c_call'] = 0;
                $campaign['tot_c_pending_call'] = 0;
                $cco_work_array[$activity['cco_id']] = $campaign;
            }

            $activity['tot_pending_call'] = $cco_work_array[$activity['cco_id']]['tot_c_pending_call']+$activity['tot_a_pending_call'];
            $cco_work_array[$activity['cco_id']] = array_merge($cco_work_array[$activity['cco_id']],$activity);
        }

        $cco_work_allocation = array_values($cco_work_array);
        return $cco_work_allocation;
    }

    public function add_work_transfer_data_allocation($user_id,$country_id)
    {
        $cco_data = $this->input->post("cco_data");
        $allocation_id = $this->input->post("allocation_id");
        $allocation_type = $this->input->post("allocation_type");
        $cco_id = $this->input->post("cco_id");
        $update_array= array();
        if((isset($allocation_id) && !empty($allocation_id)) && (isset($allocation_type) && !empty($allocation_type))){

            foreach($allocation_id as $k => $val)
            {
                $cco_transfer_work = array(
                    'allocation_id' => $val,
                    'alocation_type' => $allocation_type[$k],
                    'old_cco_id' => $cco_data,
                    'new_cco_id' => $cco_id,
                    'country_id' => $country_id,
                    'created_by_user' => $user_id,
                    'modified_by_user' => $user_id,
                    'created_on' => date('Y-m-d H:i:s'),
                    'modified_on' => date('Y-m-d H:i:s')
                );



                $this->db->insert('cco_transfer_work', $cco_transfer_work);
                if ($this->db->affected_rows() > 0) {
                    $update_array[]=1;

                }


                if(trim(strtolower($allocation_type[$k])) == 'campaign')
                {
                    $update_campaign= array(
                        'transfer_status' => '1',
                        'cco_id' => $cco_id
                    );

                    $this->db->where('allocation_id',$val);
                    $this->db->update("cco_campaign_allocation",$update_campaign);
                    if ($this->db->affected_rows() > 0) {
                        $update_array[]=1;

                    }
                }
                else{
                    $update_activity= array(
                        'transfer_status' => '1',
                        'cco_id' => $cco_id
                    );
                   // echo "Act";
                   // dumpme($update_activity);

                    $this->db->where('activity_allocation_id',$val);
                    $this->db->update("cco_activity_allocation",$update_activity);
                    if ($this->db->affected_rows() > 0) {
                        $update_array[]=1;

                    }
                }
            }
        }

        if(in_array(1,$update_array))
        {
            return 1;
        }
        else{
            return 0;
        }

    }

    public function get_all_transfer_cco_data($country_id,$local_date = null,$page=null){


        $sql = 'SELECT * from ( ';

        $sql .= ' SELECT bu.display_name as old_cco_name,bus.display_name as new_cco_name,ctw.created_on,bcc.campaign_name as dataname,bcc.no_phase ';

        $sql .= 'FROM bf_cco_transfer_work AS ctw ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = ctw.old_cco_id) ';
        $sql .= 'JOIN bf_users AS bus ON (bus.id = ctw.new_cco_id) ';
        $sql .= 'JOIN bf_cco_campaign_allocation AS cca ON (cca.allocation_id = ctw.allocation_id) ';
        $sql .= 'JOIN bf_cco_campaign AS bcc ON (bcc.campaign_id = cca.campaign_id) ';

        $sql .= 'WHERE 1 ';
        $sql .= ' AND ctw.alocation_type ="campaign" ';
        $sql .= ' AND ctw.country_id ="' . $country_id . '" ';

        $sql .= ' UNION ';

        $sql .= 'SELECT bu.display_name as old_cco_name,bus.display_name as new_cco_name,ctw.created_on,eamc.activity_type_country_name AS dataname,0 AS no_phase ';

        $sql .= 'FROM bf_cco_transfer_work AS ctw ';
         $sql .= 'JOIN bf_users AS bu ON (bu.id = ctw.old_cco_id) ';
        $sql .= 'JOIN bf_users AS bus ON (bus.id = ctw.new_cco_id) ';
         $sql .= 'JOIN bf_cco_activity_allocation AS caa ON (caa.activity_allocation_id = ctw.allocation_id) ';
         $sql .= 'JOIN bf_ecp_activity_planning as eap ON (eap.activity_planning_id = caa.activity_id) ';
         $sql .= 'JOIN bf_ecp_activity_master_country as eamc ON (eamc.activity_type_country_id = eap.activity_type_id) ';

        $sql .= 'WHERE 1 ';
        $sql .= ' AND ctw.alocation_type ="activity" ';
        $sql .= ' AND ctw.country_id ="' . $country_id . '" ';

        $sql .= ' ) a
        order by a.created_on DESC ';


        $transfer_data = $this->grid->get_result_res($sql);

        //testdata($transfer_data);
        if (isset($transfer_data['result']) && !empty($transfer_data['result'])) {


            $transfer['head'] = array('Sr. No.', 'Campaign Name/ Activity Name','Total Phase', 'From CCO','To CCO','Transfer Date');

            $transfer['count'] = count($transfer['head']);

            if ($page != null || $page != "") {
                $i = (($page * 10) - 9);
            } else {
                $i = 1;
            }

            foreach ($transfer_data['result'] as $rm) {

                if ($local_date != null) {
                    $date3 = strtotime($rm['created_on']);
                    $created_on = date($local_date .' g:i A', $date3);

                } else {
                    $created_on = $rm['created_on'];
                }

                $transfer['row'][] = array($i, $rm['dataname'],$rm['no_phase'], $rm['old_cco_name'], $rm['new_cco_name'],$created_on);
                        $i++;
            }


            $transfer['action'] = '';
            $transfer['delete'] = '';
            $transfer['pagination'] = $transfer_data['pagination'];

            return $transfer;
        }
        else {
            return false;
        }
    }


    public function get_employee_order_data($loginusertype, $user_country_id, $radio_checked, $loginuserid, $customer_id=null, $from_date=null, $todate = null, $order_tracking_no = null, $order_po_no = null, $page = null, $page_function = null, $order_status = null, $web_service = null,$local_date=null)
    {
        $sql = ' SELECT SQL_CALC_FOUND_ROWS bio.order_id,bio.customer_id_from,bio.customer_id_to,bio.order_taken_by_id,bio.order_date,bio.PO_no,bio.order_tracking_no,bio.estimated_delivery_date,bio.total_amount,bio.order_status,bio.read_status, f_bu.role_id,f_bu.user_code as f_u_code, bicl.credit_limit,bu.display_name,f_bu.display_name as f_dn,t_bu.display_name as t_dn,bio.created_on ';

        $sql .= ' FROM bf_ishop_orders as bio ';
        $sql .= ' LEFT JOIN bf_users AS bu ON (bu.id = bio.order_taken_by_id) ';
        $sql .= ' LEFT JOIN bf_users as f_bu ON (f_bu.id = bio.customer_id_from) ';
        $sql .= ' LEFT JOIN bf_users as t_bu ON (t_bu.id = bio.customer_id_to) ';
        $sql .= ' LEFT JOIN bf_ishop_credit_limit as bicl ON (bicl.customer_id = bio.customer_id_from) ';
        $sql .= 'WHERE 1 ';

        if (isset($page_function) && !empty($page_function)) {
            $action_data = $page_function;
        } else {
            $action_data = $this->uri->segment(2);
        }
        if ($action_data != "order_approval") {
            if ($order_tracking_no != null) {
                $sql .= ' AND bio.order_tracking_no =' . '"' . $order_tracking_no . '"' . ' ';
                $sql .= ' AND f_bu.role_id = 11  ';
            } else {
                if ($action_data != "po_acknowledgement") {
                    $sql .= ' AND bio.order_date BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $todate . '"' . ' ';
                }
                if ($action_data == "po_acknowledgement") {
                    $sql .= ' AND bio.order_taken_by_id !=' . $customer_id . ' ';
                    $sql .= ' AND bio.order_status = 4 ';
                }
                $sql .= ' AND bio.customer_id_from =' . $customer_id . ' ';
            }

        }

        if ($action_data == "get_order_status_data" || $action_data == "order_status") {
            $subsql = ' AND bu.role_id="' . $loginusertype . '" ';
        } else {
            $subsql = '';
        }

        $sql .= ' AND bio.country_id = "' . $user_country_id . '" ' . $subsql . ' ORDER BY bio.created_on DESC ';

        // echo $action_data."</br>";

        //  echo $sql;
        // die;

        $orderdata = $this->grid->get_result_res($sql);

        if (isset($orderdata['result']) && !empty($orderdata['result'])) {

            if ($loginusertype == 8) {
                //FOR FO
                if ($radio_checked == "farmer") {

                    $order_view['head'] = array('Sr. No.', 'Farmer Name', 'Retailer Name', 'Order Tracking No.', 'Entered By', 'Read');
                    $order_view['count'] = count($order_view['head']);
                } elseif ($radio_checked == "retailer") {

                    $order_view['head'] = array('Sr. No.', 'Retailer Code', 'Retailer Name', 'Distributor Name', 'Order Date', 'PO NO', 'Order Tracking No.', 'EDD', 'Amount', 'Entered By', 'Status');
                    $order_view['count'] = count($order_view['head']);
                } elseif ($radio_checked == "distributor") {

                    $order_view['head'] = array('Sr. No.', 'Distributor Code', 'Distributor Name', 'Order Date', 'PO NO', 'Order Tracking No.', 'EDD', 'Amount', 'Entered By', 'Status');
                    $order_view['count'] = count($order_view['head']);
                }

                if ($page != null || $page != "") {
                    $i = (($page * 10) - 9);
                } else {
                    $i = 1;
                }

                foreach ($orderdata['result'] as $od) {

                    if ($od['order_status'] == 0) {
                        $order_status = "Pending";
                    } elseif ($od['order_status'] == 1) {
                        $order_status = "Dispatched";
                    } elseif ($od['order_status'] == 2) {
                        $order_status = "";
                    } elseif ($od['order_status'] == 3) {
                        $order_status = "Rejected";
                    } elseif ($od['order_status'] == 4) {
                        $order_status = "Un Acknowledge";
                    }


                    $otn = '<div class="eye_i" prdid ="' . $od['order_id'] . '"><a href="javascript:void(0);">' . $od['order_tracking_no'] . '</a></div>';


                    if ($radio_checked == "farmer") {

                        if ($od['read_status'] == 0) {
                            $read_status = "Unread";
                        } else {
                            $read_status = "Read";
                        }

                        $order_view['row'][] = array($i, $od['f_dn'] , $od['t_dn'], $otn, $od['display_name'], $read_status);

                    } elseif ($radio_checked == "retailer") {

                        if ($od['order_status'] == 4) {
                            $read_status = "Un Acknowledge";
                        } else {
                            $read_status = "Acknowledge";
                        }
                        if($local_date != null){
                            $date = strtotime($od['order_date']);
                            $order_date = date($local_date,$date);

                            $time= strtotime($od['created_on']);
                            $t= date('g:i a',$time);

                            $order_datetime = $order_date.' '.$t;
                        }
                        else{
                            $order_datetime = $od['order_date'];
                        }

                        $order_view['row'][] = array($i, $od['f_u_code'], $od['f_dn'], $od['t_dn'], $order_datetime, $od["PO_no"], $otn, $od["estimated_delivery_date"], $od["total_amount"], $od['display_name'], $read_status);

                    } elseif ($radio_checked == "distributor") {
                        if($local_date != null){
                            $date = strtotime($od['order_date']);
                            $order_date = date($local_date,$date);

                            $time= strtotime($od['created_on']);
                            $t= date('g:i a',$time);

                            $order_datetime = $order_date.' '.$t;

                            if(!empty($od["estimated_delivery_date"]))
                            {
                                $date1 = strtotime($od["estimated_delivery_date"]);
                                $estimated_date =  date($local_date,$date1);
                            }
                            else{

                                $estimated_date = '';
                            }


                        }
                        else{
                            $order_datetime = $od['order_date'];
                            $estimated_date = $od["estimated_delivery_date"] ;
                        }
                        $order_view['row'][] = array($i, $od['f_u_code'], $od['f_dn'], $order_datetime, $od["PO_no"], $otn, $estimated_date, $od["total_amount"], $od['display_name'], $order_status);
                    }
                    $i++;
                }
                $order_view['eye'] = '';
            }

            $order_view['pagination'] = $orderdata['pagination'];
            return $order_view;
        }
        else{
            return false;
        }
    }


    public function order_status_product_details_view_by_id($order_id, $radiochecked, $logincustomertype, $action_data = null)
    {

        $sql = 'SELECT bipo.product_order_id as id,bipo.product_order_id,psr.product_sku_code,psc.product_sku_name, bipo.quantity_kg_ltr,bipo.quantity,bipo.unit,bipo.amount,bipo.dispatched_quantity,psr.product_sku_id,bio.order_status ';

        $sql .= ' FROM bf_ishop_product_order as bipo ';
        $sql .= ' JOIN bf_ishop_orders as bio ON (bio.order_id = bipo.order_id) ';
        $sql .= '  JOIN bf_master_product_sku_country as psc ON (psc.product_sku_country_id = bipo.product_sku_id) ';
        $sql .= '  JOIN bf_master_product_sku_regional as psr ON (psr.product_sku_id = psc.product_sku_id) ';
        $sql .= ' WHERE 1 ';
        $sql .= ' AND bipo.order_id =' . $order_id . ' ';


        $order_detail = $this->grid->get_result_res($sql);

        if (isset($order_detail['result']) && !empty($order_detail['result'])) {
            $product_view=array();
                if ($logincustomertype == 8) {
                    if ($radiochecked == "farmer") {
                        $product_view['head'] = array('Sr. No.', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr');
                        $product_view['count'] = count($product_view['head']);
                    } elseif ($radiochecked == "retailer") {
                        $product_view['head'] = array('Sr. No.', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr', 'Amount', 'Approved Quantity');
                        $product_view['count'] = count($product_view['head']);
                    } elseif ($radiochecked == "distributor") {
                        $product_view['head'] = array('Sr. No.', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr', 'Amount', 'Approved Quantity');
                        $product_view['count'] = count($product_view['head']);
                    }

                    $order_id_data = '<input type="hidden" name="order_id" value="' . $order_id . '">';

                    $i = 1;
                    $k = 0;
                    foreach ($order_detail['result'] as $od) {

                        if($od['unit'] == 'kg/ltr')
                        {
                            $unit = 'Kg/Ltr';
                        }
                        elseif($od['unit'] == 'box')
                        {
                            $unit = 'Box';
                        }
                        elseif($od['unit'] == 'packages')
                        {
                            $unit = 'Packages';
                        }
                        else{
                            $unit = '';
                        }

                        if ($radiochecked == "farmer") {

                            $product_view['row'][] = array($i, $od['product_sku_code'], $od['product_sku_name'], $unit, $od['quantity'], $od['quantity_kg_ltr']);

                        } elseif ($radiochecked == "retailer") {

                            $qty_kg_ltr = '<input id="qty_kg_ltr_' . $od["product_order_id"] . '" type="hidden" name="quantity_kg_ltr['.$k.']" value="' . $od['quantity_kg_ltr'] . '">';

                            $product_order_id = $order_id_data.'<input type="hidden" name="order_product_id['.$k.']" value="' . $od["product_order_id"] . '">';
                            $product_sku_data = '<input id="sku_' . $od["product_order_id"] . '" name="product_sku_id" type="hidden" value="' . $od['product_sku_id'] . '" />';
                            $unit_data = $product_order_id . $product_sku_data . '<div class="unit_' . $od["product_order_id"] . '"><span class="unit">' . $unit . '</span></div>';
                            $qty_data = '<div class="qty_' . $od["product_order_id"] . '"><span class="qty">' . $od['quantity'] . '</span></div>';
                            $quantity_kg_ltr = $qty_kg_ltr . '<div class="quantity_kg_ltr_' . $od["product_order_id"] . '"><span class="quantity_kg_ltr">' . $od['quantity_kg_ltr'] . '</span></div>';
                            $amount = '<div class="amount_' . $od["product_order_id"] . '"><span class="amount">' . $od['amount'] . '</span></div>';

                            $dispatched_quantity = '<div class="dispatched_quantity_' . $od["product_order_id"] . '"><span class="dispatched_quantity">' . $od['dispatched_quantity'] . '</span></div>';

                            $product_view['row'][] = array($i, $od['product_sku_code'], $od['product_sku_name'], $unit_data, $qty_data, $quantity_kg_ltr, $amount, $dispatched_quantity);



                        }
                        elseif ($radiochecked == "distributor") {
                            $qty_kg_ltr = '<input id="qty_kg_ltr_' . $od["product_order_id"] . '" type="hidden" name="quantity_kg_ltr['.$k.']" value="' . $od['quantity_kg_ltr'] . '">';
                            $product_order_id = $order_id_data.'<input type="hidden" name="order_product_id['.$k.']" value="' . $od["product_order_id"] . '">';

                            $product_sku_data = '<input id="sku_' . $od["product_order_id"] . '" name="product_sku_id" type="hidden" value="' . $od['product_sku_id'] . '" />';
                            $unit_data = $product_order_id . $product_sku_data . '<div class="unit_' . $od["product_order_id"] . '"><span class="unit">' . $unit . '</span></div>';
                            $qty_data = '<div class="qty_' . $od["product_order_id"] . '"><span class="qty">' . $od['quantity'] . '</span></div>';
                            $quantity_kg_ltr = $qty_kg_ltr . '<div class="quantity_kg_ltr_' . $od["product_order_id"] . '"><span class="quantity_kg_ltr">' . $od['quantity_kg_ltr'] . '</span></div>';
                            $amount = '<div class="amount_' . $od["product_order_id"] . '"><span class="amount">' . $od['amount'] . '</span></div>';

                            $dispatched_quantity = '<div class="dispatched_quantity_' . $od["product_order_id"] . '"><span class="dispatched_quantity">' . $od['dispatched_quantity'] . '</span></div>';
                            $product_view['row'][] = array($i, $od['product_sku_code'], $od['product_sku_name'], $unit_data, $qty_data, $quantity_kg_ltr, $amount, $dispatched_quantity);

                        }
                        $i++;
                        $k++;
                    }
                    $product_view['eye'] = '';

                }
                return $product_view;
            }
            else{
                return false;
            }


    }


    public function get_cco_data($country_id,$user_id,$role_id)
    {
        $this->db->select('id,display_name');
        $this->db->from('users');
        $this->db->where('country_id',$country_id);
        if($role_id != '18'){
            $this->db->where('id !=',$user_id);
        }
        $this->db->where('role_id','19');
        $this->db->where('active','1');
        $this->db->where('deleted','0');
        $cco_data = $this->db->get()->result_array();

        if(isset($cco_data) && !empty($cco_data)){
            return $cco_data;
        }
        else{
            return array();
        }

    }

    public function get_designation_data($country_id)
    {
        $this->db->select('desigination_country_id,desigination_country_name');
        $this->db->from('master_designation_country');
        $this->db->where('country_id',$country_id);
        $this->db->where('status','1');
        $this->db->where('deleted','0');
        $designation = $this->db->get()->result_array();

        if(isset($designation ) && !empty($designation )){
            return $designation;
        }
        else{
            return array();
        }

    }

    public function get_employee_data($country_id,$designation_id)
    {
        $this->db->select('id,display_name');
        $this->db->from('users as bu');
        $this->db->join('master_designation_role as mdr','mdr.user_id = bu.id');
        $this->db->where('bu.country_id',$country_id);
        $this->db->where('mdr.desigination_id',$designation_id);
        $this->db->where('bu.active','1');
        $this->db->where('bu.deleted','0');
        $employee = $this->db->get()->result_array();

        if(isset($employee ) && !empty($employee )){
            return $employee;
        }
        else{
            return array();
        }

    }

    public function add_cco_transfer_call($user_id,$country_id)
    {

        $mob_num = $this->input->post("mob_num");
        $cco_id = $this->input->post("cco_id");

        $cco_transfer_call = array(
            'number' => $mob_num,
            'cco_to_id' => $cco_id,
            'cco_id' => $user_id,
            'transfer_type' => 'cco_transfer',
            'call_date' => date('Y-m-d H:i:s'),
            'country_id' => $country_id,
            'created_by_user' => $user_id,
            'created_on' => date('Y-m-d H:i:s'),
            'modified_by_user' => $user_id,
            'modified_on' => date('Y-m-d H:i:s')
        );

        $this->db->insert('cco_calltransfer', $cco_transfer_call);

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }

    }

    public function add_emp_transfer_call($user_id,$country_id)
    {
        $mob_num = $this->input->post("mob_num");
        $employee_name = $this->input->post("employee_name");

        $cco_transfer_call = array(
            'number' => $mob_num,
            'cco_to_id' => $employee_name,
            'cco_id' => $user_id,
            'transfer_type' => 'emp_transfer',
            'call_date' => date('Y-m-d H:i:s'),
            'country_id' => $country_id,
            'created_by_user' => $user_id,
            'created_on' => date('Y-m-d H:i:s'),
            'modified_by_user' => $user_id,
            'modified_on' => date('Y-m-d H:i:s')
        );

        $this->db->insert('cco_calltransfer', $cco_transfer_call);

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }

    }


    public function get_call_history_details_data($country_id,$user_id,$customer_id,$phone_no,$local_date=null,$page=null)
    {
        $sql = 'SELECT * ';
        $sql .= 'FROM bf_cco_call_details AS ccd ';
     //   $sql .= 'JOIN bf_users AS bu ON (bu.id = ips.customer_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND ccd.customer_id =' . $customer_id . ' ';
        $sql .= 'AND ccd.cco_id =' . $user_id . ' ';
        $sql .= 'AND ccd.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY ccd.call_id DESC ';


        $history_details = $this->grid->get_result_res($sql);

        if (isset($history_details['result']) && !empty($history_details['result'])) {
            $history['head'] = array('Sr. No.', 'Date', 'Time', 'Duration', 'Order Status', 'Complaint Id', 'Complaint Subject', 'Order Tracking No.', 'Feedback','Campaign/Phase Associated With','Comments');
            $history['count'] = count($history['head']);


            if ($page != null || $page != "") {
                $i = (($page * 10) - 9);
            } else {
                $i = 1;
            }

            foreach ($history_details['result'] as $ps) {

                    if($local_date != null)
                    {
                        $date = strtotime($ps['created_on']);
                        $c_date = date($local_date,$date);

                    }
                    else{
                        $c_date = $ps['invoice_date'];
                    }

                $date = strtotime($ps['created_on']);
                $c_time = date('H:i:s',$date);

                $history['row'][] = array($i,$c_date, $c_time, $ps['call_duration'], '-', '-', '-', '-',$ps['feedback'],'-','-');
                    $i++;
                }

            $history['pagination'] = $history_details['pagination'];
                return $history;
            }
            else{
                return false;
            }

    }




    /*-----------------------------------------------------------------------------------------*/

    public function check_cco_campagain_data($cco_data,$campagain_data,$geo_data)
    {
        $sql = 'SELECT * FROM `bf_cco_campaign_allocation` as bcca
                WHERE bcca.`cco_id` = '.$cco_data.' AND bcca.campaign_id= '.$campagain_data.' AND bcca.geo_level_1= '.$geo_data;

        $info = $this->db->query($sql);
        // For Pagination
        $camp_data = $info->result_array();

        if(!empty($camp_data))
        {
            return $camp_data;
        }
        else
        {
            return 0;
        }

    }

    /**
     * @param $farmer_id
     * @param $campagain_data
     * @return int
     */
    public function check_customer_allocation_data($farmer_id,$campagain_data)
    {
        $sql = 'SELECT * FROM `bf_cco_campaign_allocation_customers` as bccac
                WHERE bccac.`customer_id` = '.$farmer_id.' AND bccac.campaign_id= '.$campagain_data;

        $info = $this->db->query($sql);
        // For Pagination
        $farmer_data = $info->result_array();

        if(!empty($farmer_data))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function get_all_farmer_allocation_data($campagain_id,$role_id,$page)
    {

       /* $this->db->select("bcca.allocation_id,bcca.campaign_id,bcc.campaign_name,bu.display_name,bcca.geo_level_1,bmpgd.political_geography_name,bcca.customer_count");
        $this->db->from("bf_cco_campaign_allocation as bcca");

        $this->db->join("bf_cco_campaign as bcc", "bcc.campaign_id = bcca.campaign_id");
        $this->db->join("bf_users as bu", "bu.id = bcca.cco_id");

        $this->db->join("bf_master_political_geography_details as bmpgd", "bmpgd.political_geo_id = bcca.geo_level_1");
        $this->db->where("bcca.deleted", 0);
        $this->db->where("bcca.status", 1);

        $data = $this->db->get()->result_array();

        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return 0;
        }
        */


        //$sql =' SELECT * ';

        // $sql = ' SELECT mpgd.political_geography_name,it.ishop_target_id,bu.user_code,bu.display_name,mpsc.product_sku_name,it.quantity ';
        $sql = ' SELECT SQL_CALC_FOUND_ROWS bcca.allocation_id as allocation_id,bcca.campaign_id,bcc.campaign_name,bu.display_name,bcca.geo_level_1,bmpgd.political_geography_name as level1,bcca.customer_count, bmpgd1.political_geography_name as level2,bmpgd2.political_geography_name as level3 ';
        $sql .= ' FROM bf_cco_campaign_allocation as bcca ';
        $sql .= ' JOIN bf_cco_campaign as bcc ON (bcc.campaign_id = bcca.campaign_id) ';
        $sql .= ' JOIN bf_users as bu ON (bu.id = bcca.cco_id) ';
        $sql .= ' JOIN bf_master_political_geography_details as bmpgd ON (bmpgd.political_geo_id = bcca.geo_level_1) ';

        $sql .= ' JOIN bf_master_political_geography_details as bmpgd1 ON (bmpgd1.political_geo_id = bmpgd.parent_geo_id) ';

        $sql .= ' JOIN bf_master_political_geography_details as bmpgd2 ON (bmpgd2.political_geo_id = bmpgd1.parent_geo_id) ';

       // $sql .= ''

        $sql .= 'WHERE 1 ';
        $sql .= ' AND bcca.deleted =0 ';
        $sql .= ' AND bcca.status =1 ';
        $sql .= ' AND bcca.campaign_id ="'.$campagain_id.'" ';

        $sql .= 'ORDER BY bcca.allocation_id DESC ';

//echo $sql;die;
        $allocation_data = $this->grid->get_result_res($sql);


        if (isset($allocation_data['result']) && !empty($allocation_data['result'])) {

            $allocation['head'] = array('Sr. No.', 'Action','Campagain Name', 'Geo Level 3', 'Geo Level 2', 'Geo Level 1', 'CCO Name','No. Of Farmers');

            $allocation['count'] = count($allocation['head']);

            if ($page != null || $page != "") {

                $i = (($page * 10) - 9);

            } else {
                $i = 1;
            }
            foreach ($allocation_data['result'] as $rd) {

                $allocation['row'][] = array($i, $rd['allocation_id'],$rd['campaign_name'],$rd['level3'], $rd['level2'], $rd['level1'], $rd['display_name'], $rd['customer_count']);
                $i++;
            }
            $allocation['pagination'] = $allocation_data['pagination'];
            $allocation['action'] = 'is_action';
            $allocation['edit'] = '';
            $allocation['delete'] = 'is_delete';
               //testdata($allocation);
            return $allocation;
        } else {
            return false;
        }

    }

    public function delete_allocation($allocation_id)
    {
        $this ->db->where('allocation_id', $allocation_id);
        $this->db->delete("bf_cco_campaign_allocation_customers");

        $this ->db->where('allocation_id', $allocation_id);
        $this->db->delete("bf_cco_campaign_allocation");

        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }

    }

    public function get_campagain_allocated_customer_data($campagainid)
    {
        $this->db->select("bccac.customer_id,bmupd.call_name,bmupd.first_name,bmupd.last_name,bmupd.land_size,
                           bmucd.primary_mobile_no,bmucd.secondary_mobile_no,bmucd.landline_no,
                           bmucd.pincode,
                           bccac.remarks,bccac.comments,
                           bmpgd1.political_geography_name as level1,
                           bmpgd2.political_geography_name as level2,
                           bmpgd3.political_geography_name as level3
                         ");

        $this->db->from("bf_cco_campaign_allocation as bcca");
        $this->db->join("bf_cco_campaign_allocation_customers as bccac","bccac.allocation_id = bcca.allocation_id",'LEFT');

        $this->db->join("bf_master_user_personal_details as bmupd","bmupd.user_id = bccac.customer_id",'LEFT');
        $this->db->join("bf_master_user_contact_details as bmucd","bmucd.user_id = bccac.customer_id",'LEFT');

        $this->db->join("bf_master_political_geography_details as bmpgd1","bmpgd1.political_geo_id = bmucd.geo_level_id1");
        $this->db->join("bf_master_political_geography_details as bmpgd2","bmpgd2.political_geo_id = bmucd.geo_level_id2");
        $this->db->join("bf_master_political_geography_details as bmpgd3","bmpgd3.political_geo_id = bmucd.geo_level_id3");

        $this->db->where('bcca.campaign_id',$campagainid);
        $this->db->where('bcca.status','1');
        $this->db->where('bcca.deleted','0');

        $allocated_campagain_data = $this->db->get()->result_array();

        //testdata($allocated_campagain_data);

        if(isset($allocated_campagain_data ) && !empty($allocated_campagain_data )){
            return $allocated_campagain_data;
        }
        else{
            return array();
        }
    }

    public function get_dialed_customer_data($phone_no)
    {
        $this->db->select("bu.id,bu.role_id,bu.email,bu.display_name,bu.user_code,bu.country_id,
                           bmucd.primary_mobile_no,bmucd.secondary_mobile_no,bmucd.landline_no,
                           bmupd.gender,
                           bmpgd1.political_geography_name as level1,
                           bmpgd2.political_geography_name as level2,
                           bmpgd3.political_geography_name as level3,
                           bmdc.desigination_country_name
                           ");
        $this->db->from("bf_users as bu");

        $this->db->join("bf_master_user_contact_details as bmucd","bmucd.user_id = bu.id","LEFT");
        $this->db->join("bf_master_user_personal_details as bmupd","bmupd.user_id = bu.id","LEFT");

        $this->db->join("bf_master_employee_current_profile as bmecp","bmecp.user_id = bu.id","LEFT");

        $this->db->join("bf_master_designation_country as bmdc","bmdc.desigination_country_id = bmecp.desigination_id AND bmdc.country_id = bu.country_id","LEFT");

        $this->db->join("bf_master_political_geography_details as bmpgd1","bmpgd1.political_geo_id = bmucd.geo_level_id1","LEFT");
        $this->db->join("bf_master_political_geography_details as bmpgd2","bmpgd2.political_geo_id = bmucd.geo_level_id2","LEFT");
        $this->db->join("bf_master_political_geography_details as bmpgd3","bmpgd3.political_geo_id = bmucd.geo_level_id3","LEFT");

        $this->db->where('bmucd.primary_mobile_no',$phone_no);

        $user_data = $this->db->get()->result_array();
        if(isset($user_data ) && !empty($user_data ))
        {
            return $user_data;
        }
        else
        {
            return array();
        }
    }

    public function get_personal_general_data($customer_id)
    {
        $this->db->select("bu.id,bu.role_id,bu.email,bu.display_name,
                           bmucd.primary_mobile_no,bmucd.secondary_mobile_no,bmucd.landline_no,bmucd.house_no,bmucd.address,bmucd.landmark,bmucd.pincode,
                           bmpgd1.political_geography_name as level1,bmpgd2.political_geography_name as level2,bmpgd3.political_geography_name as level3,

                           bmpgd1.political_geo_id as level1_id,bmpgd2.political_geo_id as level2_id,bmpgd3.political_geo_id as level3_id,

                           bmupd.first_name,bmupd.last_name,bmupd.gender,bmupd.dob,bmupd.introduction_year,
                           bmusd.passport_no,bmusd.ktp_no,bmusd.aadhaar_card_no
                         ");

        $this->db->from("bf_users as bu");

        $this->db->join("bf_master_user_contact_details as bmucd","bmucd.user_id = bu.id","LEFT");
        $this->db->join("bf_master_user_personal_details as bmupd","bmupd.user_id = bu.id","LEFT");

        $this->db->join("bf_master_user_statutory_details as bmusd","bmusd.user_id = bu.id","LEFT");

        $this->db->join("bf_master_political_geography_details as bmpgd1","bmpgd1.political_geo_id = bmucd.geo_level_id1","LEFT");
        $this->db->join("bf_master_political_geography_details as bmpgd2","bmpgd2.political_geo_id = bmucd.geo_level_id2","LEFT");
        $this->db->join("bf_master_political_geography_details as bmpgd3","bmpgd3.political_geo_id = bmucd.geo_level_id3","LEFT");

        $this->db->where('bu.id',$customer_id);

        $user_data = $this->db->get()->result_array();

      //  dumpme($user_data);

        if(isset($user_data ) && !empty($user_data ))
        {
            return $user_data;
        }
        else
        {
            return 0;
        }

    }

    public function get_business_geo_data_to_retailer($customer_id)
    {
        $this->db->select('mbgd.business_geo_id,mbgd.business_georaphy_name');
        $this->db->from('master_user_contact_details as mucd');
        $this->db->join('master_business_political_geo_mapping as mbpgm', 'mbpgm.polotical_geo_id = mucd.geo_level_id1');
        $this->db->join('master_business_geography_details as mbgd','mbgd.business_geo_id = mbpgm.business_geo_id');
        $this->db->where('mucd.user_id', $customer_id);
      //  $this->db->where('bu.country_id', $country_id);
       // $this->db->order_by('bu.display_name');
       // $this->db->group_by('bu.id');
        $data = $this->db->get()->row_array();
         //echo $this->db->last_query();
         //testdata($data);
        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return false;
        }
    }


    public function get_personal_family_data($customer_id)
    {
        $this->db->select("*");
        $this->db->from("bf_master_user_family_details as bmufd");
        $this->db->where('bmufd.user_id',$customer_id);

        $user_family_data = $this->db->get()->result_array();

        if(isset($user_family_data ) && !empty($user_family_data ))
        {
            return $user_family_data;
        }
        else
        {
            return 0;
        }
    }

    public function get_personal_education_data($customer_id)
    {
        $this->db->select("*");
        $this->db->from("bf_master_user_educational_details as bmued");
        $this->db->where('bmued.user_id',$customer_id);

        $user_education_data = $this->db->get()->result_array();

        if(isset($user_education_data ) && !empty($user_education_data ))
        {
            return $user_education_data;
        }
        else
        {
            return 0;
        }
    }

    public function get_education_qualification_data($country_id)
    {
        $this->db->select("bmq.qualification_id,bmq.qualification_name");
        $this->db->from("bf_master_qualification as bmq");
        $this->db->where("bmq.country_id",$country_id);
        $this->db->where("bmq.deleted",0);
        $this->db->where("bmq.status",1);

        $qualification_data = $this->db->get()->result_array();

        if(isset($qualification_data ) && !empty($qualification_data ))
        {
            return $qualification_data;
        }
        else
        {
            return 0;
        }
    }

    public function get_customer_social_data($customer_id)
    {
        $this->db->select("bmusad.*");
        $this->db->from("bf_master_user_social_account_details as bmusad");
        $this->db->where("bmusad.user_id",$customer_id);

        $social_data = $this->db->get()->result_array();

        return $social_data;

    }

    public function get_complaint_data($customer_id,$page = null,$local_date=null,$country_id,$complaint_type_id)
    {


        //$sql = ' SELECT  bccd.created_by_user ';
       $sql = ' SELECT bccd.complaint_number, bccd.complaint_id,bmcd.complaint_subject,bccd.complaint_entry_date,bccd.complaint_due_date,bu.display_name,bccd.created_by_user,bccd.complaint_status,bu1.display_name as dis_name';
        $sql .= ' FROM bf_cco_complaint_details as bccd ';
        $sql .= ' JOIN bf_users as bu ON (bu.id = bccd.assigned_to_id) ';
        $sql .= ' JOIN bf_users as bu1 ON (bu1.id = bccd.created_by_user) ';
        $sql .= ' JOIN bf_master_customer_type_country as bmctc ON (bmctc.customer_type_id = bu.user_type_id AND bmctc.country_id = bu.country_id) ';
        $sql .= ' JOIN bf_master_complaint_detail as bmcd ON (bmcd.complaint_id = bccd.complaint_subject) ';

        $sql .= 'WHERE 1 ';
        $sql .= ' AND bccd.deleted =0 ';
        $sql .= ' AND bccd.status =1 ';
        $sql .= ' AND bccd.complaint_type_id ="'.$complaint_type_id.'" ';

       // $sql .= 'ORDER BY bcca.allocation_id DESC ';
    //testdata($sql);
        $complaint_data = $this->grid->get_result_res($sql);
      // testdata($complaint_data);


        if (isset($complaint_data['result']) && !empty($complaint_data['result'])) {

            $complaint['head'] = array('Sr. No.', 'Action','Complaint Number','Complaint Subject','Complaint Entry Date', 'Complaint Due Date','Responsible Person','Entered By','Status Of Complaint');

            $complaint['count'] = count($complaint['head']);

                    if ($page != null || $page != "") {
                        $i = (($page * 10) - 9);
                    } else {
                        $i = 1;
                    }

                    foreach ($complaint_data['result'] as $rm) {

                       /* if ($local_date != null) {
                            $date3 = strtotime($rm['created_on']);
                            $created_date = date($local_date, $date3);

                        } else {
                            $created_date = $rm['created_on'];
                        }*/
                        if($rm['complaint_status'] == '0'){
                            $complaint_status='Pending';
                        }
                        if($rm['complaint_status'] == '1'){
                            $complaint_status='In Progress';
                        }
                        if($rm['complaint_status'] == '2'){
                            $complaint_status='Resolved';
                        }
                        if($rm['complaint_status'] == '3'){
                            $complaint_status='Reopen';
                        }

                        $complaint['row'][] = array($i,$rm['complaint_id'],$rm['complaint_number'],$rm['complaint_subject'],$rm['complaint_entry_date'],$rm['complaint_due_date'],$rm['display_name'],$rm['dis_name'],$complaint_status);
                        $i++;
                    }


            $complaint['action'] = 'is_action';
            $complaint['delete'] = 'is_delete';
            $complaint['edit'] = 'is_edit';
            $complaint['pagination'] = $complaint_data['pagination'];

            return $complaint;
        }
        else {
            return false;
        }

    }

    public function get_feedback_data($customer_id,$page = null,$local_date=null,$country_id)
    {


      //  $sql = ' SELECT  * ';
        $sql = ' SELECT  bcf.feedback_subject,bcf.feedback_description,bcf.feedback_id,bcf.created_on,bu.display_name,bmctc.customer_type_name,bu1.display_name as entered_by_user ';
        $sql .= ' FROM bf_cco_feedback as bcf ';
        $sql .= ' JOIN bf_users as bu ON (bu.id = bcf.customer_id) ';
        $sql .= ' JOIN bf_users as bu1 ON (bu1.id = bcf.created_by_user) ';
        $sql .= ' JOIN bf_master_customer_type_country as bmctc ON (bmctc.customer_type_id = bu.user_type_id AND bmctc.country_id = bu.country_id) ';

        $sql .= 'WHERE 1 ';
        $sql .= ' AND bcf.deleted =0 ';
        $sql .= ' AND bcf.status =1 ';
        $sql .= ' AND bcf.customer_id ="'.$customer_id.'" ';

       // $sql .= 'ORDER BY bcca.allocation_id DESC ';

        $feedback_data = $this->grid->get_result_res($sql);

        if (isset($feedback_data['result']) && !empty($feedback_data['result'])) {

            $feedback['head'] = array('Sr. No.', 'Action','Date','Customer Type', 'Subject','Discription','Entered By');

            $feedback['count'] = count($feedback['head']);

                    if ($page != null || $page != "") {
                        $i = (($page * 10) - 9);
                    } else {
                        $i = 1;
                    }

                    foreach ($feedback_data['result'] as $rm) {

                        if ($local_date != null) {
                            $date3 = strtotime($rm['created_on']);
                            $created_date = date($local_date, $date3);

                        } else {
                            $created_date = $rm['created_on'];
                        }

                        $feedback['row'][] = array($i, $rm['feedback_id'], $created_date,$rm['customer_type_name'],$rm['feedback_subject'],$rm['feedback_description'],$rm['entered_by_user']);
                        $i++;
                    }


            $feedback['action'] = 'is_action';
            $feedback['delete'] = 'is_delete';
            $feedback['edit'] = 'is_edit';
            $feedback['pagination'] = $feedback_data['pagination'];

            return $feedback;
        }
        else {
            return false;
        }

    }

    public function get_missedcall_data($page = null,$local_date=null)
    {

        $sql = ' SELECT  bcm.*,bu.display_name,bu.role_id ';
        $sql .= ' FROM bf_cco_missedcall as bcm ';
        $sql .= ' LEFT JOIN bf_users as bu ON (bu.id = bcm.customer_id) ';
        $sql .= 'WHERE 1 ';

        $missedcall_data = $this->grid->get_result_res($sql);

        if (isset($missedcall_data['result']) && !empty($missedcall_data['result'])) {

            $missedcall['head'] = array('Sr No.','Name','Mob. Number','Date','Time','Caller Type');

            $missedcall['count'] = count($missedcall['head']);

            if ($page != null || $page != "") {
                $i = (($page * 10) - 9);
            } else {
                $i = 1;
            }


            foreach ($missedcall_data['result'] as $rm) {

                if(isset($rm['missedcall_date']) && !empty($rm['missedcall_date'])){
                $dateandtime = explode(" ",$rm['missedcall_date']);
                    $date=$dateandtime[0];
                    $time=$dateandtime[1];
                }else{
                    $date="";
                    $time="";
                }

                if(isset($rm['role_id']) && !empty($rm['role_id']) ){
                    if($rm['role_id']=='9') { $customer_type='Distributor'; }
                    if($rm['role_id']=='10'){ $customer_type='Retailer';    }
                    if($rm['role_id']=='11'){ $customer_type='Farmer';      }
                }else{
                    $customer_type="";

                }

                if(isset($rm['display_name']) && !empty($rm['display_name']) ){
                    $display_name=$rm['display_name'];
                }else{
                    $display_name="";

                }

                $missedcall['row'][] = array($i,$display_name,$rm['number'],$date,$time,$customer_type);
                $i++;
            }

            $missedcall['pagination'] = $missedcall_data['pagination'];
           // testdata($feedback);
            return $missedcall;
        }
        else {
            return false;
        }

    }
    public function get_cco_data_bargin($country_id,$logged_in_user)
    {
        $this->db->select('id,display_name');
        $this->db->from('users');
        $this->db->where('country_id',$country_id);
        $this->db->where('id !=',$logged_in_user);
        $this->db->where_in('role_id',array(19,18));
        $this->db->where('active','1');
        $this->db->where('deleted','0');
        $cco_data = $this->db->get()->result_array();

        if(isset($cco_data ) && !empty($cco_data )){
            return $cco_data;
        }
        else{
            return array();
        }
    }

    public function get_user_data($customer_id)
    {
        $this->db->select("*");
        $this->db->from("bf_users as bu");
        $this->db->join("bf_master_user_contact_details as bmucd","bmucd.user_id = bu.id");

        $this->db->where('bu.id',$customer_id);

        $user_data = $this->db->get()->result_array();


        return $user_data;
    }

    public function get_feedback_data_edit($feedback_id)
    {
        $this->db->select("*");
        $this->db->from("bf_cco_feedback as bcf");
        $this->db->where('bcf.feedback_id',$feedback_id);
        $user_feedback_data_edit = $this->db->get()->row_array();
        return $user_feedback_data_edit;

    }

    public function get_complaint_data_edit($complaint_id)
    {
        $this->db->select("bccd.complaint_id,bccd.designation_id,bccd.assigned_to_id,bccd.remarks,bccd.complaint_data,bccd.complaint_type_id,bccd.complaint_number, bccd.complaint_id,bccd.complaint_subject,bccd.complaint_entry_date,bccd.complaint_due_date,bccd.escalation_date_1,bccd.escalation_date_2,bccd.escalation_date_3,bu.display_name,bccd.created_by_user,bccd.complaint_status,bu1.display_name as dis_name");
        $this->db->from("bf_cco_complaint_details as bccd");
        $this->db->join("bf_users as bu","bu.id = bccd.assigned_to_id");
        $this->db->join("bf_users as bu1","bu1.id = bccd.created_by_user");
        $this->db->join("bf_master_complaint_detail as bmcd","bmcd.complaint_id = bccd.complaint_subject");
        $this->db->where('bccd.complaint_id',$complaint_id);
        $user_complaint_data_edit = $this->db->get()->row_array();
        return $user_complaint_data_edit;

    }

    public function block_phone_number($phone_no)
    {
        if(!empty($_POST)) {
            $phone_no = $_POST["phone_no"];
            $user = $this->auth->user();
            $logined_user_id = $user->id;
            $update_array = array();

            $block_array = array(
                'phone_number' => $phone_no,
                'created_by_user' => $logined_user_id,
                'modified_by_user' => $logined_user_id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_on' => date('Y-m-d H:i:s')
            );
            $this->db->select("bccbu.phone_number");
            $this->db->from("bf_cco_blacklist_users as bccbu");
            $this->db->where('bccbu.phone_number',$phone_no);
            $already_block_data = $this->db->get()->row_array();
            if(empty($already_block_data)){

                if ($_POST['phone_no'] != "") {
                    $result = $this->db->insert("bf_cco_blacklist_users", $block_array);
                    if ($this->db->affected_rows() > 0) {
                        $update_array[] = 1;
                    }
                }
            }
            else
            {
                $update_array[] = 0;
            }
        }

        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function add_update_feedback_data()
{
    if(!empty($_POST)) {
        $customer_id = $_POST["customer_id"];
        $user = $this->auth->user();
        $logined_user_id = $user->id;
        $update_array = array();

        $feedback_update_array = array(
            'customer_id' => $customer_id,
            'feedback_subject' => $_POST["subject"],
            'feedback_description' => $_POST["description"],
            'cco_id' => $logined_user_id,
            'created_by_user' => $logined_user_id,
            'modified_by_user' => $logined_user_id,
            'created_on' => date('Y-m-d H:i:s'),
            'modified_on' => date('Y-m-d H:i:s')
        );
        if($_POST['feedback_edit_id'] == "") {
            if ($_POST['subject'] != "" && $_POST['description'] != ""){
                $result = $this->db->insert("bf_cco_feedback", $feedback_update_array);
                if ($this->db->affected_rows() > 0) {
                    $update_array[] = 1;
                }
            }
        }
        else
        {
            //UPDATE
            if ($_POST['subject'] != "" && $_POST['description'] != "") {
                $this->db->where("feedback_id", $_POST['feedback_edit_id']);
                $this->db->update("bf_cco_feedback", $feedback_update_array);

                if ($this->db->affected_rows() > 0) {
                    $update_array[] = 1;
                }
            }

        }
    }
    if(in_array(1,$update_array))
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

    public function add_update_upper_dialpad_info()
    {
        if(!empty($_POST)) {
            $customer_id = $_POST["customer_id"];
            $campaign_id=$_POST["campaign_id"];
            $user = $this->auth->user();
            $logined_user_id = $user->id;
            $update_array = array();

            $feedback_update_array = array(

                'called_status' => $_POST["call_status"],
                'remarks' => $_POST["remarks"],
                'comments' => $_POST["comments"],
            );
            if ($_POST['remarks'] != "" && $_POST['comments'] != "") {
                $this->db->where("campaign_id", $_POST['campaign_id']);
                $this->db->where("customer_id", $_POST['customer_id']);
                $this->db->update("bf_cco_campaign_allocation_customers", $feedback_update_array);

                if ($this->db->affected_rows() > 0) {
                    $update_array[] = 1;
                }
            }

        }
        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function add_update_bargin_info($cco_id,$phone_no)
    {
        if(!empty($_POST)) {

            $user = $this->auth->user();
            $logined_user_id = $user->id;
            $update_array = array();

            $bargin_update_array = array(

                'assigned_cco_id' =>$cco_id,
                'phone_no' => $phone_no,
                'assigned_by_cco_id' => $logined_user_id,
                'created_by' => $logined_user_id,
                'created_on' => date('Y-m-d H:i:s'),

            );

                if ($cco_id != "" && $phone_no != ""){
                    $result = $this->db->insert("bf_cco_call_braging", $bargin_update_array);

                    if ($this->db->affected_rows() > 0) {
                        $update_array[] = 1;
                    }
                }


        }
        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function add_update_complaint_data()
    {
        if(!empty($_POST)) {
            $customer_id = $_POST["customer_id"];
            $user = $this->auth->user();
            $logined_user_id = $user->id;
            $update_array = array();

            if(isset($_POST["updated_due_date"]) && !empty($_POST["updated_due_date"]))
            {
                $_POST["Complaint_due_date"] = $_POST["updated_due_date"];
                $_POST["complaint_date1"]= $_POST["updated_due_date"];
            }

            $complaint_update_array = array(

                'customer_id' => $_POST["customer_id"],
                'complaint_number' => $_POST["complaint_id"],
                'complaint_status' => $_POST["complaint_status"],
                'complaint_type_id' => $_POST["complaint_type"],
                'complaint_entry_date' => $_POST["complaint_entry_date"],
                'complaint_due_date' => $_POST["Complaint_due_date"],
                'complaint_subject' => $_POST["complaint_subject"],
                'remarks' => $_POST["remarks"],
                'complaint_data' => $_POST["complaint_data"],
                'assigned_to_id' => $_POST["person_name"],
                'escalation_date_1' => $_POST["complaint_date1"],
                'escalation_date_2' => $_POST["complaint_date2"],
                'escalation_date_3' => $_POST["complaint_date3"],
                'designation_id'=>$_POST["designstion"],
                'created_by_user' => $logined_user_id,
                'modified_by_user' => $logined_user_id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_on' => date('Y-m-d H:i:s')
            );
            if($_POST['complaint_edit_id'] == "") {
                //INSERT
                if ($_POST['remarks'] != "" && $_POST['complaint_data'] != ""){
                    $result = $this->db->insert("bf_cco_complaint_details", $complaint_update_array);
                    if ($this->db->affected_rows() > 0) {
                        $update_array[] = 1;
                    }
                }
            }
            else
            {
                //UPDATE
                if ($_POST['remarks'] != "" && $_POST['complaint_data'] != "") {
                    $this->db->where("complaint_id", $_POST['complaint_edit_id']);
                    $this->db->update("bf_cco_complaint_details", $complaint_update_array);

                    if ($this->db->affected_rows() > 0) {
                        $update_array[] = 1;
                    }
                }

            }
        }
        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function delete_feedback($feedback_id)
    {
        $this ->db->where('feedback_id',$feedback_id);
        $this->db->delete("bf_cco_feedback");

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete_complaint($complaint_id)
    {
        $this ->db->where('complaint_id',$complaint_id);
        $this->db->delete("bf_cco_complaint_details");

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_customer_complaint_unique($six_digit_id)
    {
        $this->db->select("*");
        $this->db->from("bf_cco_complaint_details as bccd");
        $this->db->where('bccd.complaint_number',$six_digit_id);
        $user_customer_complaint_unique_id = $this->db->get()->result_array();
        return $user_customer_complaint_unique_id;

    }

    public function get_customer_complaint_type()
    {
        $user = $this->auth->user();

        $this->db->select("bmct.*");
        $this->db->from("bf_master_complaint_type as bmct");

        $this ->db->where('bmct.country_id',$user->country_id);
        $this->db->where('bmct.status',1);
        $this->db->where('bmct.deleted',0);
        $this->db->order_by('bmct.complaint_type_name','asc');
        $user_customer_complaint_type = $this->db->get()->result_array();
        return $user_customer_complaint_type;

    }

    public function get_complaint_sub_from_complaint_type($complaint_type_id)
    {
        $user = $this->auth->user();

        $this->db->select("bmcd.complaint_subject,bmcd.complaint_id");
        $this->db->from("bf_master_complaint_detail as bmcd");

        $this ->db->where('bmcd.complaint_type_id',$complaint_type_id);
        $this->db->where('bmcd.status',1);
        $this->db->where('bmcd.deleted',0);
        $this->db->order_by('bmcd.complaint_subject','asc');
        $user_customer_complaint_subject = $this->db->get()->result_array();
        return $user_customer_complaint_subject;

    }

    public function get_person_data_from_desigination($desigination_country_id)
    {
        $user = $this->auth->user();

        $this->db->select("bmdr.*,bu.*");
        $this->db->from("bf_master_designation_role as bmdr");
        $this->db->join("bf_users as bu","bu.id = bmdr.user_id",'left');
        $this->db->where('bmdr.desigination_id',$desigination_country_id);
        $this->db->where('bmdr.status',1);
        $this->db->where('bmdr.deleted',0);
        $this->db->order_by('bu.display_name','asc');
        $user_person_data = $this->db->get()->result_array();
         //echo $this->db->last_query();die;
        return $user_person_data;

    }

    public function get_complaint_date_from_complaint_sub($complaint_subject_id)
    {
        $user = $this->auth->user();

        $this->db->select("bmcd.complaint_subject,bmcd.complaint_id,
        bmcd.reminder1_days,bmcd.reminder2_days,bmcd.reminder3_days
        ");

        $this->db->from("bf_master_complaint_detail as bmcd");

        $this ->db->where('bmcd.complaint_id',$complaint_subject_id);
        $this->db->where('bmcd.status',1);
        $this->db->where('bmcd.deleted',0);
        $this->db->order_by('bmcd.complaint_subject','asc');
        $user_customer_complaint_subject = $this->db->get()->row_array();

       // echo $this->db->last_query();die;

        return $user_customer_complaint_subject;

    }

    public function get_all_higest_level_data($country_id)
    {
        $sql = "SELECT
        bmpglr.political_geography_level_id,
        bmpglc.political_geography_countrylevel_id,
        bmpgd.political_geo_id,
        bmpgd.political_geography_name

        FROM `bf_master_political_geography_level_regional` as bmpglr

        JOIN bf_master_political_geography_level_country as bmpglc ON bmpglc.level_id = bmpglr.political_geography_level_id

        JOIN bf_master_political_geography_details as bmpgd ON bmpgd.geo_level_id = bmpglc.political_geography_countrylevel_id

        WHERE bmpglr.level = 'L6'

        AND bmpglc.country_id = $country_id";

        $level_info = $this->db->query($sql);

        $level_data = $level_info->result_array();

        return $level_data;
    }

    public function get_complaint_responsible_desigination_data($complaint_subject_id)
    {
        $sql = "SELECT bmdc.desigination_country_id,bmdc.desigination_country_name FROM `bf_master_complaint_detail` as bmcd
        JOIN bf_master_designation_country as bmdc ON bmdc.desigination_country_id = FIND_IN_SET(bmdc.desigination_country_id,bmcd.reminder1_desigination_id)
        WHERE
        bmcd.complaint_id = '".$complaint_subject_id."'
        AND
        bmcd.status =1
        AND
        bmcd.deleted = 0";

        $designation_info = $this->db->query($sql);

        $designation_detail_data = $designation_info->result_array();

        //testdata($sql);
        return $designation_detail_data;

    }

    public function get_electronic_data()
    {
        $this->db->select("bme.*");
        $this->db->from("bf_master_electonic as bme");
        $this->db->where("bme.deleted",0);
        $this->db->where("bme.status",1);

        $electronic_data = $this->db->get()->result_array();

        return $electronic_data;
    }

    public function get_vehicles_data()
    {
        $this->db->select("bmv.*");
        $this->db->from("bf_master_vehicles as bmv");
        $this->db->where("bmv.deleted",0);
        $this->db->where("bmv.status",1);

        $vehicles_data = $this->db->get()->result_array();

        return $vehicles_data;
    }

    public function get_customer_financial_electronic_data($customer_id)
    {
        $this->db->select("bmufed.*,bme.*");
        $this->db->from("bf_master_user_financial_electronic_details as bmufed");
        $this->db->join("bf_master_electonic as bme","bme.electonic_id = bmufed.electronic_owned_id");
        $this->db->where("bmufed.user_id",$customer_id);

        $financial_electronic_data = $this->db->get()->result_array();

        return $financial_electronic_data;
    }

    public function get_customer_financial_vehicles_data($customer_id)
    {
        $this->db->select("bmufvd.*,bmv.*");
        $this->db->from("bf_master_user_financial_vehicles_details as bmufvd");
        $this->db->join("bf_master_vehicles as bmv","bmv.vehicle_id = bmufvd.vehicles_owned_id");
        $this->db->where("bmufvd.user_id",$customer_id);

        $financial_vehicles_data = $this->db->get()->result_array();

        return $financial_vehicles_data;
    }

    public function get_customer_pa_income_data($customer_id)
    {
        $this->db->select("bmupd.*");
        $this->db->from("bf_master_user_personal_details as bmupd");
        $this->db->where("bmupd.user_id",$customer_id);

        $pa_income_data = $this->db->get()->result_array();

        return $pa_income_data;
    }

    public function get_qualification_specialization_data($qualification_id)
    {
        $this->db->select("bmes.edu_specialization_id,bmes.edu_specialization_name");
        $this->db->from("bf_master_education_specialization as bmes");
        $this->db->where("bmes.qualification_id",$qualification_id);
        $this->db->where("bmes.deleted",0);
        $this->db->where("bmes.status",1);

        $spec_data = $this->db->get()->result_array();

        return $spec_data;

    }

    public function get_customer_location_retailer_data($customer_id,$user_role,$customer_level_2)
    {
        $user = $this->auth->user();

        $customer_relation_retailer_data = $this->customer_relation_retailer_data($customer_id,$user_role);
        $ignore_retailer_data = array();

        if(!empty($customer_relation_retailer_data))
        {
            foreach($customer_relation_retailer_data as $key => $retailer_data)
            {
                $ignore_retailer_data[] = $retailer_data["id"];
            }
        }

        $this->db->select("*");
        $this->db->from("bf_users as bu");
        $this->db->join("bf_master_user_contact_details as bmucd","bmucd.user_id = bu.id");
        $this->db->where("bu.role_id",$user_role);
        $this->db->where("bmucd.geo_level_id1",$customer_level_2);
        $this->db->where("bu.country_id",$user->country_id);

        if(!empty($ignore_retailer_data))
        {
            $this->db->where_not_in('bu.id', $ignore_retailer_data);
        }

        $this->db->where("bu.deleted",0);
        $this->db->where("bu.active",1);

        $retailer_data = $this->db->get()->result_array();

      //  echo $this->db->last_query();

        return $retailer_data;
    }

    public function customer_relation_retailer_data($customer_id,$user_role)
    {
        $user = $this->auth->user();

      /*  $this->db->select("*");
        $this->db->from("bf_master_customer_to_customer_mapping as bmctcm");
        $this->db->join("bf_users as bu","bu.id = bmctcm.to_customer_id");
        $this->db->where("bmctcm.from_customer_id",$customer_id);
        $this->db->where("bu.role_id",$user_role);
        $this->db->where("bmctcm.deleted",0);
        $this->db->where("bmctcm.status",1);
*/

        $this->db->select("*");
        $this->db->from("bf_master_customer_to_customer_mapping as bmctcm");
        $this->db->join("bf_users as bu","bu.id = bmctcm.from_customer_id");
        $this->db->where("bmctcm.to_customer_id",$customer_id);
        $this->db->where("bu.role_id",$user_role);
        $this->db->where("bmctcm.deleted",0);
        $this->db->where("bmctcm.status",1);

        $customer_relation_retailer_data = $this->db->get()->result_array();

      //  echo $this->db->last_query();
        //die;

        return $customer_relation_retailer_data;
    }

    public function add_update_general_data()
    {

        //$customer_id = $_POST["customer_id"];

        $customer_id = (isset($_POST["customerid"]) && !empty($_POST["customerid"])) ? $_POST["customerid"] : "";

        $update_array = array();

        $user_update_array = array(
            'email' => (isset($_POST["email_id"]) && !empty($_POST["email_id"]))?$_POST["email_id"] :NULL,
            'display_name' => (isset($_POST["customer_name"]) && !empty($_POST["customer_name"]))?$_POST["customer_name"] :NULL
        );

        if ($customer_id != "")
        {
            $this->db->where("id", $customer_id);
            $this->db->update("bf_users", $user_update_array);
        }
        else
        {

            $user_update_array["role_id"] = (isset($_POST["role_id"]) && !empty($_POST["role_id"]))?$_POST["role_id"] :4;

            $this->db->insert("bf_users", $user_update_array);
            $customer_id = $this->db->insert_id();
        }

        if($this->db->affected_rows() > 0){
            $update_array[] = 1;
        }

        $contact_update_array = array(
            'user_id' => $customer_id,
            'primary_mobile_no' => (isset($_POST["primary_mobile_no"]) && !empty($_POST["primary_mobile_no"]))?$_POST["primary_mobile_no"]:NULL,
            'secondary_mobile_no' => (isset($_POST["secondary_mobile_no"]) && !empty($_POST["secondary_mobile_no"]))?$_POST["secondary_mobile_no"]:NULL,
            'landline_no' => (isset($_POST["fixed_line_no"]) && !empty($_POST["fixed_line_no"]))?$_POST["fixed_line_no"]:NULL,
            'address' => (isset($_POST["address"]) && !empty($_POST["address"]))?$_POST["address"]:NULL,
            'pincode' =>(isset($_POST["pincode"]) && !empty($_POST["pincode"]))?$_POST["pincode"]:NULL
        );

        if((isset($_POST["geo_level_3"]) && !empty($_POST["geo_level_3"])))
        {
            $contact_update_array["geo_level_id3"] = $_POST["geo_level_3"];
        }
        if((isset($_POST["geo_level_2"]) && !empty($_POST["geo_level_2"])))
        {
            $contact_update_array["geo_level_id2"] = $_POST["geo_level_2"];
        }
        if((isset($_POST["geo_level_1"]) && !empty($_POST["geo_level_1"])))
        {
            $contact_update_array["geo_level_id1"] = $_POST["geo_level_1"];
        }


        //CHECK CONTACT DETAIL IN TABLE FOR USER

        $this->db->select("*");
        $this->db->from("bf_master_user_contact_details as bmucd");
        $this->db->where("bmucd.user_id",$customer_id);
        $user_contact_data = $this->db->get()->result_array();

        if(empty($user_contact_data))
        {
            $this->db->insert("bf_master_user_contact_details",$contact_update_array);
            if($this->db->affected_rows() > 0){
                $update_array[] = 1;
            }
        }
        else
        {
            $this->db->where("user_id",$customer_id);
            $this->db->update("bf_master_user_contact_details",$contact_update_array);
            if($this->db->affected_rows() > 0){
                $update_array[] = 1;
            }
        }

        $personal_update_array = array(
            'user_id' => $customer_id,
            'first_name' => (isset($_POST["first_name"]) && !empty($_POST["first_name"]))?$_POST["first_name"]:NULL,
            'last_name' => (isset($_POST["last_name"]) && !empty($_POST["last_name"]))?$_POST["last_name"]:NULL,
            'gender' => (isset($_POST["gender"]) && !empty($_POST["gender"]))?$_POST["gender"]:NULL,
            'dob' => (isset($_POST["dob"]) && !empty($_POST["dob"]))?$_POST["dob"]:NULL,
            'introduction_year' => (isset($_POST["introduction_year"]) && !empty($_POST["introduction_year"]))?$_POST["introduction_year"]:NULL
        );

        //CHECK PERSONAL DETAIL IN TABLE FOR USER

        $this->db->select("*");
        $this->db->from("bf_master_user_personal_details as bmupd");
        $this->db->where("bmupd.user_id",$customer_id);
        $user_personal_data = $this->db->get()->result_array();

        if(empty($user_personal_data))
        {
            $this->db->insert("bf_master_user_personal_details",$personal_update_array);
            if($this->db->affected_rows() > 0){
                $update_array[] = 1;
            }
        }
        else
        {
            $this->db->where("user_id",$customer_id);
            $this->db->update("bf_master_user_personal_details",$personal_update_array);
            if($this->db->affected_rows() > 0){
                $update_array[] = 1;
            }
        }


        $statutory_update_array = array(
            'user_id' => $customer_id,
            'passport_no' => (isset($_POST["passport_no"]) && !empty($_POST["passport_no"]))?$_POST["passport_no"]:NULL,
            'ktp_no' => (isset($_POST["ktp_no"]) && !empty($_POST["ktp_no"]))?$_POST["ktp_no"]:NULL,
            'aadhaar_card_no' => (isset($_POST["adhar_card_no"]) && !empty($_POST["adhar_card_no"]))?$_POST["adhar_card_no"]:NULL
        );

        //CHECK SATUTARY DETAIL IN TABLE FOR USER

        $this->db->select("*");
        $this->db->from("bf_master_user_statutory_details as bmusd");
        $this->db->where("bmusd.user_id",$customer_id);
        $user_satutary_data = $this->db->get()->result_array();

        if(empty($user_satutary_data))
        {
            $this->db->insert("bf_master_user_statutory_details",$statutory_update_array);
            if($this->db->affected_rows() > 0){
                $update_array[] = 1;
            }
        }
        else
        {
            $this->db->where("user_id",$customer_id);
            $this->db->update("bf_master_user_statutory_details",$statutory_update_array);
            if($this->db->affected_rows() > 0){
                $update_array[] = 1;
            }
        }

        if(in_array(1,$update_array))
        {

            $caller_data = $this->session->userdata('caller_data');

            if(!empty($caller_data))
            {
                return 1;
            }
            else
            {
                return 2;
            }
        }
        else
        {
            return 0;
        }
    }

    public function add_update_family_data()
    {
        $update_array = array();
        if(!empty($_POST["relative_id"]))
        {
            $customer_id = $_POST['customer_id'];

            foreach($_POST["relative_id"] as $key=> $relative_id)
            {

                $data_array = array(
                    'user_id'=> $customer_id,
                    'relative_name'=> $_POST['relative_name'][$key],
                    'relative_relation'=> $_POST['relation'][$key],
                    'relative_dob'=> $_POST['dob'][$key],
                    'gender'=> $_POST['gender'][$key],
                    'dependent'=> $_POST['dependent'][$key],
                    'mobile_no'=> $_POST['contact_no'][$key],
                    'email_id'=> $_POST['email_id'][$key]
                );

                if($relative_id != "")
                {
                    //UPDATE QUERY

                    $this->db->where("family_detail_id", $relative_id);
                    $this->db->update("bf_master_user_family_details", $data_array);

                    if($this->db->affected_rows() > 0) {
                        $update_array[] = 1;
                    }

                }
                else
                {
                    //INSERT QUERY
                    if($_POST['relative_name'][$key] != "" && $_POST['relation'][$key] && $_POST['email_id'][$key] != "") {
                        $this->db->insert("bf_master_user_family_details", $data_array);
                    }

                    if($this->db->affected_rows() > 0) {
                        $update_array[] = 1;
                    }

                }

            }
        }

        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function add_update_education_data()
    {

        //testdata($_POST);

        $update_array = array();
        if(!empty($_POST["education_data_id"]))
        {
            $customer_id = $_POST['customer_id'];

            foreach($_POST["education_data_id"] as $key=> $education_data_id)
            {

                $data_array = array(
                    'user_id'=> $customer_id,
                    'qualification_id'=> $_POST['qualification'][$key],
                    'edu_specialization_id'=> $_POST['specialization'][$key],
                    'instiute'=> $_POST['university'][$key]
                );

                if($education_data_id != "")
                {
                    //UPDATE QUERY

                    $data_array["year"] = $_POST['year_data'][$key]."-01-01";

                    $this->db->where("education_detail_id", $education_data_id);
                    $this->db->update("bf_master_user_educational_details", $data_array);

                    if($this->db->affected_rows() > 0) {
                        $update_array[] = 1;
                    }

                }
                else
                {

                    $data_array["year"] = $_POST['year_data'][$key]."-01-01";

                    //INSERT QUERY
                    if($_POST['qualification'][$key] != "") {
                        $this->db->insert("bf_master_user_educational_details", $data_array);
                    }

                    if($this->db->affected_rows() > 0) {
                        $update_array[] = 1;
                    }

                }

            }
        }

        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }


    }

    public function add_update_social_data()
    {
        $update_array = array();

        if(!empty($_POST))
        {
            $data_array = array(
                'user_id' => $_POST["customer_id"],
                'facebook_account' => $_POST["fb_account"],
                'gmail_plus_account' => $_POST["mail_account"],
                'linkedin_account' => $_POST["linkedin_account"],
                'twt_account' => $_POST["twitter_account"]
            );

            if($_POST['social_id'] == "")
            {
                //INSERT
                $this->db->insert("bf_master_user_social_account_details", $data_array);
                if($this->db->affected_rows() > 0) {
                    $update_array[] = 1;
                }
            }
            else
            {
                //UPDATE
                $this->db->where("social_id", $_POST['social_id']);
                $this->db->update("bf_master_user_social_account_details", $data_array);

                if($this->db->affected_rows() > 0) {
                    $update_array[] = 1;
                }

            }
        }

        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }

    public function add_update_financial_detail_data()
    {
        $update_array = array();

        $customer_id = $_POST["customer_id"];

        if(!empty($_POST)) {

            if (trim($_POST["average_pa_income"]) != "")
            {
                $this->db->select("bmupd.*");
                $this->db->from("bf_master_user_personal_details as bmupd");
                $this->db->where("bmupd.user_id", $customer_id);
                $user_personal_data = $this->db->get()->result_array();

                if (!empty($user_personal_data)) {

                    $pa_income_array = array(
                        'average_pa_income' => $_POST["average_pa_income"]
                    );

                    //UPDATE
                    $this->db->where("user_id", $customer_id);
                    $this->db->update("bf_master_user_personal_details", $pa_income_array);

                    if ($this->db->affected_rows() > 0) {
                        $update_array[] = 1;
                    }
                } else {

                    $pa_income_array = array(
                        'user_id' => $customer_id,
                        'average_pa_income' => $_POST["average_pa_income"]
                    );

                    //INSERT
                    $this->db->insert("bf_master_user_personal_details", $pa_income_array);

                    if ($this->db->affected_rows() > 0) {
                        $update_array[] = 1;
                    }
                }

            }


            $this->db->where('user_id', $customer_id);
            $this->db->delete('bf_master_user_financial_electronic_details');

            foreach($_POST["electronic_owned"] as $ele_key => $electronic_data)
            {
                $electronic_data_array = array(
                    'user_id' => $customer_id,
                    'electronic_owned_id' => $electronic_data
                );
                //INSERT
                $this->db->insert("bf_master_user_financial_electronic_details", $electronic_data_array);

                if($this->db->affected_rows() > 0) {
                    $update_array[] = 1;
                }

            }

            $this->db->where('user_id', $customer_id);
            $this->db->delete('bf_master_user_financial_vehicles_details');

            foreach($_POST["vehicles_owned"] as $veh_key => $vehicles_data)
            {

                $vehicle_data_array = array(
                    'user_id' => $customer_id,
                    'vehicles_owned_id' => $vehicles_data
                );

                //INSERT
                $this->db->insert("bf_master_user_financial_vehicles_details", $vehicle_data_array);

                if($this->db->affected_rows() > 0) {
                    $update_array[] = 1;
                }
            }
        }

        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function add_update_retailer_detail_data()
    {
        $update_array = array();
        $customer_id = $_POST["customer_id"];

        if(!empty($_POST["retailer_data"]))
        {
            foreach ($_POST["retailer_data"] as $ret_key => $retailer_data)
            {

                $retailer_data_array = array(
                    'from_customer_id' => $retailer_data,
                    'to_customer_id' => $customer_id
                );

                //INSERT
                $this->db->insert("bf_master_customer_to_customer_mapping", $retailer_data_array);

                if ($this->db->affected_rows() > 0) {
                    $update_array[] = 1;
                }
            }
        }

        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function delete_customer_retailer_relation_data()
    {
        $update_array = array();

        $this->db->where('CtoC_mapping_id', $_POST["relation_id"]);
        $this->db->delete('bf_master_customer_to_customer_mapping');

        if ($this->db->affected_rows() > 0) {
            $update_array[] = 1;
        }

        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function get_customer_farming_data($customer_id)
    {
        $this->db->select("bu.id,bu.email,bu.display_name,
                           bmpgd1.political_geography_name as level1,bmpgd2.political_geography_name as level2,bmpgd3.political_geography_name as level3,
                           bmpgd1.political_geo_id as level1_id,bmpgd2.political_geo_id as level2_id,bmpgd3.political_geo_id as level3_id,
                           bmcfd.house_no,bmcfd.address,bmcfd.landmark,bmcfd.geo_level_id1 as farm_level1,bmcfd.geo_level_id2  as farm_level2,bmcfd.geo_level_id3  as farm_level3,bmcfd.pincode,bmcfd.latitude,bmcfd.longitude
                         ");

        $this->db->from("bf_users as bu");

        $this->db->join("bf_master_user_contact_details as bmucd","bmucd.user_id = bu.id","LEFT");

        $this->db->join("bf_master_political_geography_details as bmpgd1","bmpgd1.political_geo_id = bmucd.geo_level_id1","LEFT");
        $this->db->join("bf_master_political_geography_details as bmpgd2","bmpgd2.political_geo_id = bmucd.geo_level_id2","LEFT");
        $this->db->join("bf_master_political_geography_details as bmpgd3","bmpgd3.political_geo_id = bmucd.geo_level_id3","LEFT");

        $this->db->join("bf_master_customer_farming_details as bmcfd","bmcfd.user_id = bu.id","LEFT");

        $this->db->where('bu.id',$customer_id);

        $farm_user_data = $this->db->get()->result_array();
        //testdata($farm_user_data);
        if(isset($farm_user_data ) && !empty($farm_user_data ))
        {
            return $farm_user_data;
        }
        else
        {
            return 0;
        }

    }

    public function get_customer_business_data($customer_id)
    {
        $this->db->select("bu.id,bu.email,bu.display_name,
                           bmpgd1.political_geography_name as level1,bmpgd2.political_geography_name as level2,bmpgd3.political_geography_name as level3,
                           bmpgd1.political_geo_id as level1_id,bmpgd2.political_geo_id as level2_id,bmpgd3.political_geo_id as level3_id,
                           bmcfd.house_no,bmcfd.address,bmcfd.landmark,bmcfd.geo_level_id1 as farm_level1,bmcfd.geo_level_id2  as farm_level2,bmcfd.geo_level_id3  as farm_level3,bmcfd.pincode,bmcfd.latitude,bmcfd.longitude,bmcfd.avg_daily_counter,bmcfd.avg_daily_footfalls
                         ");

        $this->db->from("bf_users as bu");

        $this->db->join("bf_master_user_contact_details as bmucd","bmucd.user_id = bu.id","LEFT");

        $this->db->join("bf_master_political_geography_details as bmpgd1","bmpgd1.political_geo_id = bmucd.geo_level_id1","LEFT");
        $this->db->join("bf_master_political_geography_details as bmpgd2","bmpgd2.political_geo_id = bmucd.geo_level_id2","LEFT");
        $this->db->join("bf_master_political_geography_details as bmpgd3","bmpgd3.political_geo_id = bmucd.geo_level_id3","LEFT");

        $this->db->join("bf_master_customer_business_details as bmcfd","bmcfd.user_id = bu.id","LEFT");

        $this->db->where('bu.id',$customer_id);

        $farm_user_data = $this->db->get()->result_array();
        //testdata($farm_user_data);
        if(isset($farm_user_data ) && !empty($farm_user_data ))
        {
            return $farm_user_data;
        }
        else
        {
            return 0;
        }

    }

    public function get_all_crop_data($customer_id)
    {
        $user = $this->auth->user();

        $customer_crop = $this->customer_crop_data($customer_id);
        $ignore_crop_data = array();

        if(!empty($customer_crop))
        {
            foreach($customer_crop as $key => $crop_data)
            {
                $ignore_crop_data[] = $crop_data["crop_id"];
            }
        }


        $this->db->select("crop_country_id,crop_name");
        $this->db->from("bf_master_crop_country");

        if(!empty($ignore_crop_data))
        {
            $this->db->where_not_in('crop_country_id', $ignore_crop_data);
        }

        $this->db->where("country_id",$user->country_id);
        $this->db->where("deleted",0);
        $this->db->where("status",1);

        $crop_data = $this->db->get()->result_array();
        return $crop_data;
    }

    public function customer_crop_data($customer_id)
    {
        $this->db->select("*");
        $this->db->from("bf_master_customer_crop_details as bmccd");

        $this->db->join("bf_master_crop_country as bmcc","bmcc.crop_country_id = bmccd.crop_id");

        $this->db->where("user_id",$customer_id);

        $allocated_crop_data = $this->db->get()->result_array();
        return $allocated_crop_data;
    }

    public function add_update_farming_crop_detail_data()
    {
        $update_array = array();
        $customer_id = $_POST["customer_id"];
       // testdata($_POST);

        $this->db->select("*");
        $this->db->from("bf_master_customer_farming_details");
        $this->db->where("user_id",$customer_id);
        $farming_data = $this->db->get()->result_array();

        $data_array = array(
            'user_id' => $_POST["customer_id"],
            'house_no' => $_POST["house_no"],
            'address' => $_POST["address"],
            'landmark' => $_POST["landmark"],
            'geo_level_id1' => $_POST["geo_level_1"],
            'geo_level_id2' => $_POST["geo_level_2"],
            'geo_level_id3' => $_POST["geo_level_3"],
            'pincode' => $_POST["pincode"],
            'latitude' => $_POST["latitude"],
            'longitude' => $_POST["longitude"]
        );

        if(empty($farming_data))
        {

            //INSERT FARMING DATA

            $this->db->insert("bf_master_customer_farming_details",$data_array);

            if ($this->db->affected_rows() > 0) {
                $update_array[] = 1;
            }
        }
        else
        {
            //UPDATE DATA

            $customer_framing_detail_id = $farming_data[0]["customer_framing_detail_id"];

            $this->db->where("customer_framing_detail_id",$customer_framing_detail_id);
            $this->db->update("bf_master_customer_farming_details",$data_array);

            if ($this->db->affected_rows() > 0) {
                $update_array[] = 1;
            }
        }

        if(!empty($_POST["crop_name"]))
        {
            foreach($_POST["crop_name"] as $key => $crop_id)
            {

                $yiled_data = isset($_POST["yield_contribution"][$key]) ? $_POST["yield_contribution"][$key] : "";

                if($crop_id != "" && $yiled_data != "")
                {
                    $crop_data_array = array(
                        'user_id' => $customer_id,
                        'crop_id' => $crop_id,
                        'yeild_HA' => $yiled_data
                    );

                    //INSERT CROP DATA

                    $this->db->insert("bf_master_customer_crop_details",$crop_data_array);

                    if ($this->db->affected_rows() > 0) {
                        $update_array[] = 1;
                    }

                }

            }
        }

        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }

    public function add_update_business_detail_data()
    {
        $update_array = array();
        $customer_id = $_POST["customer_id"];
        // testdata($_POST);

        $this->db->select("*");
        $this->db->from("bf_master_customer_business_details");
        $this->db->where("user_id",$customer_id);
        $business_data = $this->db->get()->result_array();

        $data_array = array(

            'user_id' => $_POST["customer_id"],
            'avg_daily_counter' => $_POST["daily_counter"],
            'avg_daily_footfalls' => $_POST["daily_footfalls"],
            'house_no' => $_POST["house_no"],
            'address' => $_POST["address"],
            'landmark' => $_POST["landmark"],
            'geo_level_id1' => $_POST["geo_level_1"],
            'geo_level_id2' => $_POST["geo_level_2"],
            'geo_level_id3' => $_POST["geo_level_3"],
            'pincode' => $_POST["pincode"],
            'latitude' => $_POST["latitude"],
            'longitude' => $_POST["longitude"]
        );

        if(empty($business_data))
        {

            //INSERT FARMING DATA

            $this->db->insert("bf_master_customer_business_details",$data_array);

            if ($this->db->affected_rows() > 0) {
                $update_array[] = 1;
            }
        }
        else
        {
            //UPDATE DATA

            $customer_business_detail_id = $business_data[0]["customer_business_id"];

            $this->db->where("customer_business_id",$customer_business_detail_id);
            $this->db->update("bf_master_customer_business_details",$data_array);

            if ($this->db->affected_rows() > 0) {
                $update_array[] = 1;
            }
        }

        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }

    public function get_search_disease_detail($search_data,$customer_id)
    {
        $user = $this->auth->user();

        //GET CUSTOMER 2nd LEVEL DATA
        $user_data = $this->get_user_data($customer_id);

        //GET ALL LOCATIONS WHO HAVING THAT LEVEL AS PARENT

        $geo_level_id2 = (isset($user_data[0]["geo_level_id2"]) && !empty($user_data[0]["geo_level_id2"])) ? $user_data[0]["geo_level_id2"] : "";

        $all_child_geo_data_array = array();

        $child_str = "";

        if ($geo_level_id2 != "") {
            $all_child_geo_data = $this->get_child_data($geo_level_id2);
            if (!empty($all_child_geo_data) && $all_child_geo_data != 0) {
                foreach ($all_child_geo_data as $key => $geo_data) {
                    $all_child_geo_data_array[] = $geo_data["political_geo_id"];
                }

                $child_str = implode(",", $all_child_geo_data_array);
            }
        }
        //   testdata($all_child_geo_data_array);


        $sql = "SELECT

    bmdc.disease_name,
    bmcds.symptoms_country_name,
    bmpsc.product_sku_name,
    bmcc.crop_name ";

    if ($child_str != "") {

        $sql .= " ,beapdd.activity_planning_id,
        beap.employee_id,
        beap.activity_planning_time,
        bmucd.primary_mobile_no,
        beamc.activity_type_country_name,
        bu.display_name ";
    }

    $sql .= " FROM `bf_master_disease_country` as bmdc

    LEFT JOIN bf_disease_symptoms_mapping as bdsm ON bdsm.country_disease_id = bmdc.disease_country_id

    LEFT JOIN bf_master_country_disease_symptoms as bmcds ON bmcds.country_symptoms_id = bdsm.country_symptom_id

    LEFT JOIN bf_master_disease_crop_product_mapping as bmdcp ON bmdcp.disease_id = bmdc.disease_country_id

    LEFT JOIN bf_master_crop_country as bmcc ON  bmcc.crop_country_id = bmdcp.crop_id

    LEFT JOIN bf_master_product_sku_country as bmpsc ON  bmpsc.product_sku_country_id = bmdcp.product_sku_id ";


    if ($child_str != "")
    {
        $sql .= " LEFT JOIN bf_ecp_activity_planning_diseases_details as beapdd ON beapdd.diseases_id = bmdc.disease_country_id

        LEFT JOIN bf_ecp_activity_planning as beap ON beap.activity_planning_id = beapdd.activity_planning_id

        LEFT JOIN bf_ecp_activity_master_country as beamc ON beamc.activity_type_country_id = beap.activity_type_id

        LEFT JOIN bf_users as bu ON bu.id = beap.employee_id

        LEFT JOIN bf_master_user_contact_details as bmucd ON bmucd.user_id = bu.id ";
    }

    $sql .= "  WHERE 1

    AND bmdc.disease_name LIKE '%".$search_data."%' ";

     if($child_str != "")
     {
         $sql .= " AND
        (
            beap.geo_level_id_2 IN (" . $child_str . ")
            OR
            beap.geo_level_id_3  IN (" . $child_str . ")
            OR
            beap.geo_level_id_4  IN (" . $child_str . ")
        )
        AND beap.status = 2 ";

     }

    $sql .= " AND bmdc.country_id =  ".$user->country_id."
    AND bmdc.deleted = 0
    AND bmdc.status = 1 ";

    $disease_info = $this->db->query($sql);

    $disease_detail_data = $disease_info->result_array();

        //testdata($disease_detail_data);
        return $disease_detail_data;

    }


   public function get_search_product_detail($search_data,$customer_id)
   {
       $user = $this->auth->user();

       //GET CUSTOMER 2nd LEVEL DATA
       $user_data = $this->get_user_data($customer_id);

       //GET ALL LOCATIONS WHO HAVING THAT LEVEL AS PARENT
       $geo_level_id2 = (isset($user_data[0]["geo_level_id2"]) && !empty($user_data[0]["geo_level_id2"])) ? $user_data[0]["geo_level_id2"] : "";

       $all_child_geo_data_array = array();

       $child_str = "";

       if ($geo_level_id2 != "")
       {
           $all_child_geo_data = $this->get_child_data($geo_level_id2);
           if (!empty($all_child_geo_data) && $all_child_geo_data != 0)
           {
               foreach ($all_child_geo_data as $key => $geo_data)
               {
                   $all_child_geo_data_array[] = $geo_data["political_geo_id"];
               }
               $child_str = implode(",", $all_child_geo_data_array);
           }
       }

       $sql = "SELECT
       bmdc.disease_name,
       bmcds.symptoms_country_name,
       bmpsc.product_sku_name,
       bmcc.crop_name ";

       if ($child_str != "")
       {
           $sql .= " ,beap.activity_planning_id,
           beap.employee_id,
           beap.activity_planning_time,
           bmucd.primary_mobile_no,
           beamc.activity_type_country_name,
           bu.display_name ";
       }

       $sql .= " FROM `bf_master_product_sku_country` as bmpsc

       LEFT JOIN bf_master_disease_crop_product_mapping as bmdcp ON bmdcp.product_sku_id = bmpsc.product_sku_country_id

       LEFT JOIN `bf_master_disease_country` as bmdc ON bmdc.disease_country_id = bmdcp.disease_id

       LEFT JOIN bf_disease_symptoms_mapping as bdsm ON bdsm.country_disease_id = bmdcp.disease_id

       LEFT JOIN bf_master_country_disease_symptoms as bmcds ON bmcds.country_symptoms_id = bdsm.country_symptom_id

       LEFT JOIN bf_master_crop_country as bmcc ON  bmcc.crop_country_id = bmdcp.crop_id
       ";

       if($child_str != "")
       {
           $sql .= " LEFT JOIN bf_ecp_activity_planning_product_details as beappd ON beappd.product_sku_id = bmpsc.product_sku_country_id

           LEFT JOIN bf_ecp_activity_planning as beap ON beap.activity_planning_id = beappd.activity_planning_id

           LEFT JOIN bf_ecp_activity_master_country as beamc ON beamc.activity_type_country_id = beap.activity_type_id

           LEFT JOIN bf_users as bu ON bu.id = beap.employee_id

           LEFT JOIN bf_master_user_contact_details as bmucd ON bmucd.user_id = bu.id ";
       }

       $sql .= "  WHERE 1
       AND bmpsc.product_sku_name LIKE '%".$search_data."%' ";

       if($child_str != "")
       {
           $sql .= " AND
            (
                beap.geo_level_id_2 IN (" . $child_str . ")
                OR
                beap.geo_level_id_3  IN (" . $child_str . ")
                OR
                beap.geo_level_id_4  IN (" . $child_str . ")
            )
                AND beap.status = 2 ";
       }

       $sql .= " AND bmpsc.country_id =  ".$user->country_id."
       AND bmpsc.deleted = 0
       AND bmpsc.status = 1 ";

       $product_info = $this->db->query($sql);

       $product_detail_data = $product_info->result_array();

       //testdata($disease_detail_data);
       return $product_detail_data;

   }

    public function get_order_data($customer_id,$page=null,$search_data)
    {
        $this->db->select("bu.role_id");
        $this->db->from("bf_users as bu");
        $this->db->where("bu.id",$customer_id);
        $user_role_data = $this->db->get()->result_array();

       // if(!empty($user_role_data))
       // {
       //     $user_role_data
       // }

        $sql = "SELECT SQL_CALC_FOUND_ROWS bio.order_id,
        bio.customer_id_to,bu1.display_name as order_taken_name,bu.display_name,bio.order_date,bio.estimated_delivery_date,bio.order_tracking_no,bio.read_status
        FROM `bf_ishop_orders` as bio
        JOIN `bf_users` as bu ON `bu`.`id` = `bio`.`customer_id_to`
        JOIN `bf_users` as bu1 ON `bu1`.`id` = `bio`.`order_taken_by_id`
        WHERE `bio`.`customer_id_from` = '".$customer_id."' ";

        if($search_data != null)
        {
            $sql .= " AND `bio`.`order_tracking_no` LIKE '%".$search_data."%' ";
        }

        $sql .= " ORDER BY `bio`.`order_id` DESC ";

        //$order_info = $this->db->query($sql);

        $orderdata = $this->grid->get_result_res($sql);

        //testdata($orderdata);

        if (isset($orderdata['result']) && !empty($orderdata['result'])) {


            if($user_role_data[0]["role_id"] == 9)
            {
                $user_header_title = "";

                $order_view['head'] = array('Sr. No.', 'Action', 'Order Date', 'Order Tracking No.','EDD', 'Entered By', 'Read (Y/N)');

            }
            elseif($user_role_data[0]["role_id"] == 10)
            {
                $user_header_title = "Distributor Name";

                $order_view['head'] = array('Sr. No.', 'Action', 'Order Date', 'Order Tracking No.',$user_header_title,'EDD', 'Entered By', 'Read (Y/N)');
            }
            elseif($user_role_data[0]["role_id"] == 11)
            {
                $user_header_title = "Retailer Name";

                $order_view['head'] = array('Sr. No.', 'Action', 'Order Date', 'Order Tracking No.',$user_header_title,'EDD', 'Entered By', 'Read (Y/N)');
            }


            $order_view['count'] = count($order_view['head']);

            if ($page != null || $page != "") {
                $i = (($page * 10) - 9);
            } else {
                $i = 1;
            }

            foreach ($orderdata['result'] as $od)
            {

                if($od['read_status'] == 0)
                {
                    $read_status = "Unread";
                }
                else
                {
                    $read_status = "Read";
                }


                if($user_role_data[0]["role_id"] == 9)
                {
                    //$user_header_title = "";

                    $order_view['row'][] = array($i, $od['order_id'], $od['order_date'], $od['order_tracking_no'], $od['estimated_delivery_date'], $od['order_taken_name'],$read_status);

                }
                elseif($user_role_data[0]["role_id"] == 10)
                {
                    //$user_header_title = "Distributor Name";

                    $order_view['row'][] = array($i, $od['order_id'], $od['order_date'], $od['order_tracking_no'], $od['display_name'], $od['estimated_delivery_date'], $od['order_taken_name'],$read_status);
                }
                elseif($user_role_data[0]["role_id"] == 11)
                {
                   // $user_header_title = "Retailer Name";

                    $order_view['row'][] = array($i, $od['order_id'], $od['order_date'], $od['order_tracking_no'], $od['display_name'], $od['estimated_delivery_date'], $od['order_taken_name'],$read_status);
                }




                $i++;
            }

            $order_view['pagination'] = $orderdata['pagination'];
            $order_view['action'] = 'is_action';
            $order_view['eye'] = 'is_eye';
            $order_view['delete'] = 'is_delete';

            return $order_view;
        }
        else{
            return false;
        }
    }

    public function order_status_product_details($order_id)
    {

        $sql = 'SELECT bipo.product_order_id as id,bipo.product_order_id,bipo.order_id,psr.product_sku_code,psc.product_sku_name, bipo.quantity_kg_ltr,bipo.quantity,bipo.unit,bipo.amount,bipo.dispatched_quantity,psr.product_sku_id,bio.order_status ';

        $sql .= ' FROM bf_ishop_product_order as bipo ';
        $sql .= ' JOIN bf_ishop_orders as bio ON (bio.order_id = bipo.order_id) ';
        $sql .= '  JOIN bf_master_product_sku_country as psc ON (psc.product_sku_country_id = bipo.product_sku_id) ';
        $sql .= '  JOIN bf_master_product_sku_regional as psr ON (psr.product_sku_id = psc.product_sku_id) ';

        $sql .= ' WHERE 1 ';

        $sql .= ' AND bipo.order_id =' . $order_id . ' ';

        $order_detail = $this->grid->get_result_res($sql);

        //testdata($order_detail);

        $product_view=array();
        if (isset($order_detail['result']) && !empty($order_detail['result']))
        {

            $product_view['head'] = array('Sr. No.', 'Action', 'Product SKU Code', 'Product SKU Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr');
            $product_view['count'] = count($product_view['head']);

            $i =1;
            foreach ($order_detail['result'] as $od)
            {

                if($od['unit'] == 'kg/ltr')
                {
                    $unit = 'Kg/Ltr';
                }
                elseif($od['unit'] == 'box')
                {
                    $unit = 'Box';
                }
                elseif($od['unit'] == 'packages')
                {
                    $unit = 'Packages';
                }
                else{
                    $unit = '';
                }

                $order_id_data = '<input type="hidden" name="order_product_id[]" value="'.$od['product_order_id'].'" /><input class="product_sku_data" type="hidden" name="product_sku_id[]" value="'.$od['product_sku_id'].'" /><input class="order_id_data" type="hidden" name="order_id" value="'.$order_id.'" />';

                $unit_data = $order_id_data.'<div class="unit_data"><input readonly class="unitdata" name="units[]" value="'.$unit.'" /></div>';

                $quantity_data = '<div class="quantity_data"><input readonly class="quantitydata" type="text" name="quantity[]" value="'.$od['quantity'].'"/></div>';

                $quantity_kg_ltr_data = '<div class="qty_kg_ltr_data"><input readonly type="text" class="qty_kg_ltrdata" name="quantity_kg_ltr[]" value="'.$od['quantity_kg_ltr'].'"/></div>';

                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'],$unit_data,$quantity_data,$quantity_kg_ltr_data);

                $i++;
            }

            $product_view['action'] = 'is_action';
            $product_view['edit'] = 'is_edit';

            return $product_view;

        }
        else
        {
            return false;
        }
    }

    public function get_customer_retailer_data($customer_id)
    {
        $this->db->select("bu.id,bu.display_name");
        $this->db->from("bf_users as bu");
        $this->db->join("bf_master_customer_to_customer_mapping as bmctcm","bmctcm.from_customer_id = bu.id","left");
        $this->db->where("bmctcm.to_customer_id",$customer_id);

        $this->db->where("bu.deleted",0);
        $this->db->where("bu.active",1);

        $retailer_data = $this->db->get()->result_array();
        return $retailer_data;
    }


    public function add_cco_order_place_details($user_id, $user_country_id)
    {

        $from_customer_id = $this->input->post("customer_id");
        $to_customer_id = isset($_POST["retailer_data"]) ? $_POST["retailer_data"] : 0;

        $customer_id_from = $from_customer_id;
        $customer_id_to = $to_customer_id;
        $order_taken_by_id = $user_id;

        $order_date = date("Y-m-d");

        $action_data = $this->session->userdata("action_data");
        $selected_type_data = $this->session->userdata("activity_type");

        $caller_data = $this->session->userdata("caller_data");

        if(isset($caller_data[0]["role_id"]) && $caller_data[0]["role_id"] == 11)
        {
            $order_status = 0;
        }
        elseif(isset($caller_data[0]["role_id"]) && $caller_data[0]["role_id"] == 10)
        {
            $order_status = 4;
        }
        elseif(isset($caller_data[0]["role_id"]) && $caller_data[0]["role_id"] == 9)
        {
            $order_status = 4;
        }

        $po_no = NULL;

        $units = $this->input->post("units");
        $product_sku_id = $this->input->post("product_sku_id");
        $quantity = $this->input->post("quantity");
        $Qty = $this->input->post("Qty");

        $rand_type = 'otn';
        $table = 'bf_ishop_orders';

        $rand_data = $this->get_random_no($rand_type, $table);


        $order_place_data = array(
            'customer_id_from' => $customer_id_from,
            'customer_id_to' => $customer_id_to,
            'order_taken_by_id' => $order_taken_by_id,
            'order_date' => $order_date,
            'order_tracking_no' => $rand_data,
            'PO_no' => $po_no,
            'order_status' => $order_status,
            'country_id' => $user_country_id,
            'created_by_user' => $user_id,
            'status' => '1',
            'created_on' => date('Y-m-d H:i:s')
        );
        //testdata($order_place_data);

        $update_array = array();

        if ($this->db->insert('bf_ishop_orders', $order_place_data)) {
            $insert_id = $this->db->insert_id();

            $update_array[] = 1;
        }

        $order_id = $insert_id;
        $total = 0;
        foreach ($product_sku_id as $key => $prd_sku) {

            $amt = $this->get_product_price_by_product($prd_sku,'ishop');
            $amt= $amt * $Qty[$key];
            $order_data = array(
                'order_id' => $order_id,
                'product_sku_id' => $prd_sku,
                'quantity' => $quantity[$key],
                'unit' => $units[$key],
                'quantity_kg_ltr' => $Qty[$key],
                'amount' => $amt,
            );

            $total = $total + $amt;

            $this->db->insert('bf_ishop_product_order', $order_data);

            if($this->db->affected_rows() > 0) {
                $update_array[] = 1;
            }
        }

        $total_array= array(
            'total_amount' =>$total,
        );

        $this->db->where('order_id',$order_id);
        $this->db->update('ishop_orders',$total_array);

        if($this->db->affected_rows() > 0) {
            $update_array[] = 1;
        }

        if(in_array(1,$update_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }

    public function get_product_price_by_product($prd_sku,$price_type)
    {
        $this->db->select('*');
        $this->db->from('master_price');
        $this->db->where('price_type',$price_type);
        $this->db->where('product_sku_country_id',$prd_sku);
        $price = $this->db->get()->row_array();

        if(isset($price) && !empty($price)){
            //  testdata($price['price']);
            return $price['price'];
        }

    }

    public function get_random_no($rand_type, $table)
    {

        if ($rand_type == 'otn') {
            $random_no = 'O' . mt_rand(100000, 999999);
        } elseif ($rand_type == 'etn') {
            $random_no = 'E' . mt_rand(100000, 999999);
        }

        $check_data = $this->check_unique_random_data($rand_type, $table, $random_no);
        if ($check_data == 1) {
            $this->get_random_no($rand_type, $table);
        } else {
            return $random_no;
        }

    }

    public function check_unique_random_data($rand_type, $table, $random_no)
    {

        $this->db->select('*');
        $this->db->from($table);

        if (($table == 'bf_ishop_orders') && $rand_type == 'otn') {
            $this->db->where('order_tracking_no', $random_no);
        } elseif ($table == 'ishop_secondary_sales' && $rand_type == 'etn') {
            $this->db->where('etn_no', $random_no);
        }

        $rand_data = $this->db->get()->result_array();
        if (isset($rand_data) && !empty($rand_data)) {
            return 1;
        } else {
            return 0;
        }

    }

    public function get_channel_partner_data($user_id,$user_role_id,$user_country_id)
    {
        $this->db->select("*");
        $this->db->from("bf_master_customer_type_country as bmctc");
        $this->db->join("bf_master_role_to_customer_type_mapping as bmrtctm","bmrtctm.customer_type_regional_id = bmctc.customer_type_id");

        $this->db->where("bmctc.country_id",$user_country_id);
        $this->db->where("bmrtctm.role_id !=",11);

        $partner_data = $this->db->get()->result_array();
        if (isset($partner_data) && !empty($partner_data)) {
            return $partner_data;
        } else {
            return 0;
        }
    }

    /* CCO :: REMINDER */

    public function get_reminder()
    {
        $user = $this->auth->user();

        /*$this->db->select("*");
        $this->db->from("cco_reminder");
        $this->db->where("created_by_user",$user->id);
        $this->db->order_by("reminder_id","DESC");*/

        $sql = "SELECT * FROM bf_cco_reminder where created_by_user = ".$user->id." order by reminder_id DESC ";
        $reminder_data = $this->grid->get_result_res($sql);

        if (isset($reminder_data) && !empty($reminder_data)) {
            return $reminder_data;
        } else {
            return array();
        }
    }

    public function save_reminder()
    {
        $user= $this->auth->user();

        //$reminder_type =
        $reminder_date = str_replace('/', '-', $this->input->post('reminder_date'));
        $reminder_time = strtotime($reminder_date.' '.$this->input->post('reminder_time'));

        $data = array(  'reminder_id'=>0,
            'reminder_call_id'=>0,
            'reminder_type'=>$this->input->post('reminder_type'),
            'reminder_datetime'=>date("Y-m-d H:i:s",$reminder_time),
            'reminder_title'=>$this->input->post('reminder_title'),
            'reminder_remarks'=>$this->input->post('reminder_remarks'),
            'created_by_user'=>$user->id,
            'modified_by_user'=>$user->id,
            'created_on'=>date("Y-m-d H:i:s"),
            'modified_on'=>date("Y-m-d H:i:s")
        );

        $this->db->insert('cco_reminder',$data);
    }

    public function delete_reminder()
    {
        if(isset($_POST['reminder_id']))
        {
            $reminder_id = $_POST['reminder_id'];
            if(is_array($reminder_id) && count($reminder_id)>0)
            {
                $sql = 'DELETE FROM bf_cco_reminder WHERE reminder_id in ('.implode(',',$reminder_id).')';
                $this->db->query($sql);
            }
        }
    }
    /* CCO :: REMINDER */


}