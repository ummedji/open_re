<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Navigation_model extends BF_Model {

    protected $table_name = "navigation";
    protected $key = "id";
    protected $soft_deletes = false;
    protected $date_format = "datetime";
    protected $set_created = true;
    protected $set_modified = true;
    protected $created_field = "created_on";
    protected $modified_field = "modified_on";
    protected $status_field = "status";
    
    const POSITION = "position";

    public function __construct() {
        parent::__construct();
        $config = array(
            "table" => $this->table_name,
            "status_field" => $this->status_field,
        );
        $this->load->library("CH_Grid_generator", $config, "grid");
    }

    public function read($req_data) {
        $this->grid->initialize(array(
            "req_data" => $req_data
        ));
        return $this->grid->get_result();
    }
    
    public function get_navigation_by_alias($navigation){
        if (!empty($navigation)) {
            $this->db->select("*");
            $this->db->from($this->table_name);
            $this->db->where(self::POSITION, $navigation);
            $this->db->limit(1);
            $query = $this->db->get();
            
            if($query->num_rows() > 0){
                return $query->row();
            }
        }
        return FALSE;
    }

}
