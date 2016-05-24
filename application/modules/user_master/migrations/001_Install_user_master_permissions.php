<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Migration_Install_user_master_permissions extends Migration {

    // permissions to migrate
    private $permission_values = array();
    private $module_config = array();
    /* private $permission_values = array(
      array('name' => 'User_Management.Content.View', 'description' => '', 'status' => 'active',),
      array('name' => 'User_Management.Content.Create', 'description' => '', 'status' => 'active',),
      array('name' => 'User_Management.Content.Edit', 'description' => '', 'status' => 'active',),
      array('name' => 'User_Management.Content.Delete', 'description' => '', 'status' => 'active',),
      array('name' => 'User_Management.Settings.View', 'description' => '', 'status' => 'active',),
      array('name' => 'User_Management.Settings.Create', 'description' => '', 'status' => 'active',),
      array('name' => 'User_Management.Settings.Edit', 'description' => '', 'status' => 'active',),
      array('name' => 'User_Management.Settings.Delete', 'description' => '', 'status' => 'active',),
      ); */

    public function __construct() {

        $this->module_config = module_config(basename(dirname(__DIR__)));
        $permissions = array(
            array('name' => "{$this->module_config['module_permission_name']}.Siteusers.View", 'description' => '', 'status' => 'active',),
            array('name' => "{$this->module_config['module_permission_name']}.Siteusers.Create", 'description' => '', 'status' => 'active',),
            array('name' => "{$this->module_config['module_permission_name']}.Siteusers.Edit", 'description' => '', 'status' => 'active',),
            array('name' => "{$this->module_config['module_permission_name']}.Siteusers.Delete", 'description' => '', 'status' => 'active',),
        );
        $this->permission_values = $permissions;
    }

    //--------------------------------------------------------------------

    public function up() {
        $prefix = $this->db->dbprefix;

        // permissions
        foreach ($this->permission_values as $permission_value) {
            $permissions_data = $permission_value;
            $this->db->insert("permissions", $permissions_data);
            $role_permissions_data = array('role_id' => '1', 'permission_id' => $this->db->insert_id(),);
            $this->db->insert("role_permissions", $role_permissions_data);
        }
    }

    //--------------------------------------------------------------------

    public function down() {
        $prefix = $this->db->dbprefix;

        // permissions
        foreach ($this->permission_values as $permission_value) {
            $query = $this->db->select('permission_id')->get_where("permissions", array('name' => $permission_value['name'],));
            foreach ($query->result_array() as $row) {
                $permission_id = $row['permission_id'];
                $this->db->delete("role_permissions", array('permission_id' => $permission_id));
            }
            $this->db->delete("permissions", array('name' => $permission_value['name']));
        }
    }

    //--------------------------------------------------------------------
}
