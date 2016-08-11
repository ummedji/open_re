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

    public function campagain_data($role)
    {
        $this->db->select("*");
        $this->db->from("bf_cco_campaign");
        $this->db->where("customer_type",$role);
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
        $this->db->select("*");
        $this->db->from("bf_cco_campaign_allocation as bcca");
        $this->db->join("bf_cco_campaign_allocation_customers as bccac","bccac.allocation_id = bcca.allocation_id");
        $this->db->join("bf_users as bu","bu.id = bccac.customer_id");

        $this->db->where('bcca.campaign_id',$campagainid);
        $this->db->where('bcca.status','1');
        $this->db->where('bcca.deleted','0');

        $allocated_campagain_data = $this->db->get()->result_array();

        testdata($allocated_campagain_data);

        if(isset($allocated_campagain_data ) && !empty($allocated_campagain_data )){
            return $allocated_campagain_data;
        }
        else{
            return array();
        }


    }




	
}