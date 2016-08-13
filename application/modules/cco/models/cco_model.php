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

    public function campagain_data($role,$country_id)
    {
        $this->db->select("*");
        $this->db->from("bf_cco_campaign");
        $this->db->where("customer_type",$role);
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

    public function get_activity_details_by_type($user_id,$country_id,$activity_type,$page=null,$local_date=null)
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

        $activity_approval = $this->grid->get_result_res($sql);

        if (isset($activity_approval['result']) && !empty($activity_approval['result'])) {

            if($activity_type == 'planned_activity'){
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

            $activity['is_not_checkbox'] = 'is_checkbox';
            $activity['action'] = '';
            $activity['delete'] = '';
            $activity['pagination'] = $activity_approval['pagination'];
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




	
}