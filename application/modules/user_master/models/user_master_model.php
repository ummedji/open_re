<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_master_model extends BF_Model {

    protected $table_name = "users";
    protected $key = "id";
    protected $soft_deletes = false;
    protected $date_format = "datetime";
    protected $set_created = true;
    protected $set_modified = false;
    protected $created_field = "created_on";
    protected $status_field = "active";
    protected $deleted_field = "deleted";
    protected $banned_field = "banned";

    public function __construct() {
        parent::__construct();
        $role_table = $this->db->dbprefix("roles");

//        dump($module_config);
//        dump(basename(dirname(__DIR__)));
        $module_config = module_config(basename(dirname(__DIR__)));
        
        $role = $module_config['role'];
        $where = array();
        //get role by name...
        if (!empty($role)) {
            $this->load->model("roles/role_model", "rmm");
            $r = $this->rmm->find_by("role_name", $role);
            if ($r) {
                $where["{$this->table_name}.role_id"] = $r->role_id;
            }
        }

        $config = array(
            "table" => $this->table_name,
            "status_field" => $this->status_field,
            "deleted_field" => $this->deleted_field,
            "banned_field" => $this->banned_field,
            "action" => array(
                "toggleStatus" => "_toggle_status",
                "delete" => "_delete_user",
                "deleteSelected" => "_delete_selected_user",
                "activateUser" => "_activate_user",
                "deactivateUser" => "_deactivate_user",
                "banUser" => "_ban_user",
                "restoreUser" => "_restore_user",
                "purgeUser" => "_delete",
            ),
            "select" => array(
                "{$this->table_name}.*",
                "{$role_table}.role_id",
                "{$role_table}.role_name"
            ),
            "where" => $where,
            "join" => array(
                "{$role_table}" => array(
                    "condition" => "{$role_table}.role_id = {$this->table_name}.role_id",
                    "type" => "left"
                )
            )
        );
        $this->load->library("EX_CH_Grid_generator", $config, "grid");
    }

    public function read($req_data) {

        $where = array();

        if ($req_data['category'] != "deleted") {
            $where["{$this->table_name}.{$this->deleted_field} !="] = 1;
        }
        $order = array(
            "sortby"=>$this->table_name.".id",
            "order"=>"DESC"
        );
        $this->grid->initialize(array(
            "req_data" => $req_data,
            "where" => array_merge($this->grid->where, $where),
            "order" => $order
        ));
        return $this->grid->get_result();
    }

}
