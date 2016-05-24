<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends BF_Model
{

    protected $table_name = "banner";
    protected $key = "id";
    protected $soft_deletes = false;
    protected $date_format = "datetime";
    protected $set_created = false;
    protected $set_modified = false;
    protected $status_field = "status";
    protected $position_field = "position";
    protected $skip_validation = true;

    public function __construct()
    {
        parent::__construct();
        $config = array(
            "table" => $this->table_name,
            "key" => $this->key,
            "status_field" => $this->status_field, "position_field" => $this->position_field,
            "order" => array(
                "sortby" => $this->position_field,
                "order" => "ASC",
            )
        );
        $this->load->library("CH_Grid_generator", $config, "grid");
    }

    public function read($req_data)
    {
        $order = array(
            "sortby"=>$this->table_name.".".$this->key,
            "order"=>"DESC"
        );
        $this->grid->initialize(array(
            "req_data" => $req_data,
            "order"=>$order
        ));
        return $this->grid->get_result();
    }

    public function get_max_position($status = "")
    {
        $this->db->select(array("MAX(" . $this->position_field . ") AS max_position"));
        if ($status == 'active') {
            $this->db->where($this->status_field, 1);
        } else if ($status == 'inactive') {
            $this->db->where($this->status_field, 0);
        }
        $query = $this->db->get($this->table_name);

        $arrayOfMaxPosition = array_shift($query->result_array());
        if (!empty($arrayOfMaxPosition['max_position'])) {
            return $arrayOfMaxPosition['max_position'];
        } else {
            return FALSE;
        }
    }

    public function get_min_position($status = "")
    {
        $this->db->select(array("MIN(" . $this->position_field . ") AS min_position"));
        if ($status == 'active') {
            $this->db->where($this->status_field, 1);
        } else if ($status == 'inactive') {
            $this->db->where($this->status_field, 0);
        }
        $query = $this->db->get($this->table_name);

        $arrayOfMinPosition = array_shift($query->result_array());
        if (!empty($arrayOfMinPosition['min_position'])) {
            return $arrayOfMinPosition['min_position'];
        } else {
            return FALSE;
        }
    }

}
