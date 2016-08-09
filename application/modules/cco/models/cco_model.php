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
        $campagain_data = $this->get_campagain_data($campagain_id);

        $final_data = "";

        if(!empty($campagain_data) && $campagain_data != 0)
        {
            $campaign_location_id = $campagain_data[0]["campaign_location_id"];
            $global_head_user = array();
            $final_data = $this->recursive_location_data($campaign_location_id,$global_head_user,$flag = 1,$leveldata);
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

       // echo json_encode($final_data);
      //  die;
       return $final_data;

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

    public function get_campagain_data($campagain_id)
    {
        $this->db->select("*");
        $this->db->from("bf_cco_campaign");
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

    public function campagain_data()
    {
        $this->db->select("*");
        $this->db->from("bf_cco_campaign");
        $this->db->where("deleted","0");
        $this->db->where("status","1");

        $campagain_data = $this->db->get()->result_array();

        if (isset($campagain_data) && !empty($campagain_data)) {
            return $campagain_data;
        } else {
            return 0;
        }
    }
	
}