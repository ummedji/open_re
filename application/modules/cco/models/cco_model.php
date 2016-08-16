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
/*
        $final_array = array();
        if(!empty($global_head_user))
        {
            foreach($global_head_user as $key => $location_data)
            {
                $inner_array = array();

                $political_geo_id = $location_data["political_geo_id"];
                $geo_level_id = $location_data["geo_level_id"];
                $parent_geo_id = $location_data["parent_geo_id"];
                $political_geography_name = $location_data["political_geography_name"];

                $inner_array["political_geo_id"] = $political_geo_id;
                $inner_array["political_geography_name"] = $political_geography_name;

                $inner_array["middle_data"] = array();

                //GET ALL CHILD DATA

                $middle_child_data = $this->get_child_data($political_geo_id);

                if(!empty($middle_child_data))
                {
                    foreach ($middle_child_data as $key1 => $middlechilddata)
                    {

                        $middle_inner_array = array();

                        $middle_political_geo_id = $middlechilddata["political_geo_id"];
                        $middle_geo_level_id = $middlechilddata["geo_level_id"];
                        $middle_parent_geo_id = $middlechilddata["parent_geo_id"];
                        $middle_political_geography_name = $middlechilddata["political_geography_name"];

                        $middle_inner_array["middle_political_geo_id"] = $middle_political_geo_id;
                        $middle_inner_array["middle_political_geography_name"] = $middle_political_geography_name;

                        $inner_array["middle_data"][$middle_political_geo_id] = $middle_inner_array;

                        $lowest_child_data = $this->get_child_data($middle_political_geo_id);

                        if(!empty($lowest_child_data))
                        {
                            foreach($lowest_child_data as $key2 => $lowestchilddata)
                            {
                                $lowest_data_array = array();

                                $lowest_political_geo_id = $lowestchilddata["political_geo_id"];
                                $lowest_geo_level_id = $lowestchilddata["geo_level_id"];
                                $lowest_parent_geo_id = $lowestchilddata["parent_geo_id"];
                                $lowest_political_geography_name = $lowestchilddata["political_geography_name"];

                                $lowest_data_array["lowest_political_geo_id"] = $lowest_political_geo_id;
                                $lowest_data_array["lowest_political_geography_name"] = $lowest_political_geography_name;

                                $inner_array["middle_data"][$middle_political_geo_id]["lowest_data"][] = $lowest_data_array;
                            }
                        }
                    }
                }
                $final_array[] = $inner_array;
            }
        }
        */

       // testdata($final_array);
       // echo json_encode($final_data);
      //  die;
       return $final_array;

       // testdata($global_head_user);

      //  return $campagain_data;

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
        }
        elseif($selected_type == "retailer"){
            $user_role = 10;
        }
        elseif($selected_type == "distributor"){
            $user_role = 9;
        }

        $sql = 'SELECT bu.id FROM `bf_users` as bu JOIN bf_master_user_contact_details as bmucd on bmucd.user_id = bu.id WHERE bu.`role_id` = '.$user_role.' AND bu.deleted= 0 AND bmucd.geo_level_id1 = '.$geo_data;

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
        $this->db->select('bus.user_code,display_name,eap.activity_planning_time,eap.proposed_attandence_count,eamc   .activity_type_country_name,caa.called_status,mpgd2.political_geography_name as level_2,mpgd3.political_geography_name as level_3,mpgd4.political_geography_name as level_4,mdc.desigination_country_name,mucd.primary_mobile_no');
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
        $this->db->select("bu.id,bu.email,bu.display_name,bu.user_code,bu.country_id,
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
        $this->db->select("bu.id,bu.email,bu.display_name,
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

        if(isset($user_data ) && !empty($user_data ))
        {
            return $user_data;
        }
        else
        {
            return 0;
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

    public function add_update_complaint_data()
    {
        if(!empty($_POST)) {
            $customer_id = $_POST["customer_id"];
            $user = $this->auth->user();
            $logined_user_id = $user->id;
            $update_array = array();

            $feedback_update_array = array(
                'complaint_id' => $_POST["complaint_id"],
                'complaint_number' => $_POST["complaint_number"],
                'complaint_status' => $_POST["complaint_status"],
                'complaint_type_id' => $_POST["complaint_type"],
                'complaint_entry_date' => $_POST["complaint_entry_date"],
                'complaint_due_date' => $_POST["complaint_due_date"],
                'complaint_subject' => $_POST["complaint_subject"],
                'remarks' => $_POST["remarks"],
                'complaint_data' => $_POST["complaint_data"],
                'assigned_to_id' => $_POST["assigned_to_id"],
                'escalation_date_1' => $_POST["escalation_date_1"],
                'escalation_date_2' => $_POST["escalation_date_2"],
                'escalation_date_3' => $_POST["escalation_date_3"],
                'created_by_user' => $logined_user_id,
                'modified_by_user' => $logined_user_id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_on' => date('Y-m-d H:i:s')
            );
            if($_POST['complaint_edit_id'] == "") {
                //INSERT
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
                if ($_POST['comments'] != "" && $_POST['remarks'] != "") {
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

        //testdata($disease_detail_data);
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

        return $retailer_data;
    }

    public function customer_relation_retailer_data($customer_id,$user_role)
    {
        $user = $this->auth->user();

        $this->db->select("*");
        $this->db->from("bf_master_customer_to_customer_mapping as bmctcm");
        $this->db->join("bf_users as bu","bu.id = bmctcm.to_customer_id");
        $this->db->where("bmctcm.from_customer_id",$customer_id);
        $this->db->where("bu.role_id",$user_role);
        $this->db->where("bmctcm.deleted",0);
        $this->db->where("bmctcm.status",1);

        $customer_relation_retailer_data = $this->db->get()->result_array();

        return $customer_relation_retailer_data;
    }

    public function add_update_general_data()
    {

        $customer_id = $_POST["customer_id"];

        $update_array = array();

        $user_update_array = array(
            'email' => $_POST["email_id"],
            'display_name' => $_POST["customer_name"]
        );

        $this->db->where("id",$customer_id);
        $this->db->update("bf_users",$user_update_array);

        if($this->db->affected_rows() > 0){
            $update_array[] = 1;
        }

        $contact_update_array = array(
            'user_id' => $customer_id,
            'primary_mobile_no' => $_POST["primary_mobile_no"],
            'secondary_mobile_no' => $_POST["secondary_mobile_no"],
            'landline_no' => $_POST["secondary_mobile_no"],
            'address' => $_POST["address"],
            'geo_level_id3' => $_POST["geo_level_3"],
            'geo_level_id2' => $_POST["geo_level_2"],
            'geo_level_id1' => $_POST["geo_level_1"],
            'pincode' => $_POST["pincode"]
        );

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
            'first_name' => $_POST["first_name"],
            'last_name' => $_POST["last_name"],
            'gender' => $_POST["gender"],
            'dob' => $_POST["dob"],
            'introduction_year' => $_POST["introduction_year"]
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
            'passport_no' => $_POST["passport_no"],
            'ktp_no' => $_POST["ktp_no"],
            'aadhaar_card_no' => $_POST["adhar_card_no"]
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
            return 1;
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
                    'from_customer_id' => $customer_id,
                    'to_customer_id' => $retailer_data
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

    public function get_order_data($customer_id,$page_number,$scroll_status)
    {
        $item_per_page = 10;
        $page_number = filter_var($page_number, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw HTTP error if page number is not valid
        if(!is_numeric($page_number)){
            header('HTTP/1.1 500 Invalid page number!');
            exit();
        }

//get current starting point of records
        $position = (($page_number-1) * $item_per_page);

        $sql = "SELECT
        bio.customer_id_to,bu1.display_name as order_taken_name,bu.display_name,bio.order_date,bio.estimated_delivery_date,bio.order_tracking_no,bio.read_status
        FROM `bf_ishop_orders` as bio
        JOIN `bf_users` as bu ON `bu`.`id` = `bio`.`customer_id_to`
        JOIN `bf_users` as bu1 ON `bu1`.`id` = `bio`.`order_taken_by_id`
        WHERE `bio`.`customer_id_from` = '".$customer_id."' ORDER BY `bio`.`order_id` DESC  LIMIT $position, $item_per_page";

        $order_info = $this->db->query($sql);

        $order_data = $order_info->result_array();

        if($scroll_status != null)
        {
            $html = "";
                    if(!empty($default_order_data))
                    {
                        $i = 1;

                        foreach($default_order_data as $key => $order_data)
                        {
                            $html .= "<tr>";
                            $html .= "<td>11</td>";
                            $html .= "<td>".$order_data['order_date']."</td>";
                            $html .= "<td>".$order_data['order_tracking_no']."</td>";
                            $html .= "<td>".$order_data['display_name']."</td>";
                            $html .= "<td>".$order_data['estimated_delivery_date']."</td>";
                            $html .= "<td>".$order_data['order_taken_name']."</td>";

                                if($order_data['read_status'] == 0)
                                {
                                    $read_status = "Unread";
                                }
                                else
                                {
                                    $read_status = "Read";
                                }

                            $html .= "<td>".$read_status."</td>";
                            $html .= "</tr>";

                            $i++;
                        }
                    }
            echo $html;
            die;
        }
        else
        {
            return $order_data;
        }
    }

}