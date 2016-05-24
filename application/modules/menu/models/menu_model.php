<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_model extends BF_Model
{

    protected $table_name = "menu";
    protected $key = "id";
    protected $soft_deletes = false;
    protected $date_format = "datetime";
    protected $set_created = false;
    protected $set_modified = false;
    protected $status_field = "status";
    protected $position_field = "position";
    //fields
    public $title = "title";
    public $parent_id = "parent_id";

    //constant...
    const ID = "id";
    const NAVIGATION_ID = "navigation_id";
    const PARENT_ID = "parent_id";

    public function __construct()
    {
        parent::__construct();
        $config = array(
            "table" => $this->table_name,
            "status_field" => $this->status_field,
            "position_field" => $this->position_field,
            "select" => array(
                $this->table_name . ".*",
                "navigation.title AS nav_title"
//                "mm.title AS parent_title",
//                "nv.title AS nav_title"
            ),
            "join" => array(
                "navigation" => array(
                    "condition" => "navigation.id = menu.navigation_id",
                    "type" => "left"
                ),
            ),
            "order" => array(
                "sortby" => $this->table_name . "." . $this->position_field,
                "order" => "ASC",
            )
        );
        $this->load->library("CH_Grid_generator", $config, "grid");
    }

    public function read($req_data)
    {
        $this->grid->initialize(array(
            "req_data" => $req_data
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

    public function find_menu_by_id($id)
    {
        if (!empty($id)) {
            $this->db->select("*");
            $this->db->from($this->table_name);
            $this->db->where(self::ID, $id);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row();
            }
        }

        return FALSE;
    }

    public function set_null_for($id, array $data)
    {
        if (!empty($data) && is_array($data) && !empty($id)) {
            return $this->db->update($this->table_name, $data, array(self::ID => $id));
        }

        return FALSE;
    }

    public function get_links_for_type($type, $selected = "")
    {
        $data = FALSE;
        if (!empty($type)) {
            switch ($type) {

                case 'cats':
                    //get all active categories...
                    $this->load->model("category/category_model", "cmm");
                    $cat_map = $this->cmm->find_all_category();
                    $tmp = array();
                    if ($cat_map) {
                        foreach ($cat_map as $cat) {
                            $tmp[$cat->category_title] = base_url('category/' . $cat->category_slug);
                        }
                    }
                    $data = $this->create_links_dropdown($tmp, $selected);
                    break;

                case 'page':
                    //get all active pages...
                    $this->load->model("pages/pages_model");
                    $pages_map = $this->pages_model->find_all();
                    $tmp = array();
                    if ($pages_map) {
                        foreach ($pages_map as $page) {
                            $tmp[$page->page_title] = base_url('pages/' . $page->page_slug);
                        }
                    }
                    $data = $this->create_links_dropdown($tmp, $selected);
                    break;

                case 'mod':
                    $modules = module_list(TRUE);
                    $tmp = array();
                    foreach ($modules as $key => $value) {
                        if (module_controller_exists($value, $value)) {
                            $tmp[$value] = base_url($value);
                        }
                    }
                    $data = $this->create_links_dropdown($tmp, $selected);
                    break;
            }
        }
        return $data;
    }

    public function create_links_dropdown($data, $selected)
    {
        $output = "";
        if (!empty($data)) {
            $output .= "<select class='form-control input-medium' name='link'>";
            foreach ($data as $key => $value) {
                $set = "";
                if ($selected == $value) {
                    $set = "selected='selected'";
                }
                $output .= "<option value='{$value}' {$set}>{$key}</option>";
            }
            $output .= "</select>";
            return $output;
        }
        return FALSE;
    }

    public function get_navigation($navigation)
    {
        if (!empty($navigation)) {
            //load navigation model...
            $this->load->model("navigation/navigation_model", "nmm");
            $navigation = $this->nmm->get_navigation_by_alias($navigation);
            if ($navigation) {
                $parent_menus = $this->find_navigation_parent_menus($navigation->id);
                $menu_map = array();

                if ($parent_menus) {
                    foreach ($parent_menus as $menu) {
                        $childs = $this->menu($menu);
                        $tmp_array = array($this->key => $menu->{$this->key}, "title" => $menu->{$this->title}, "menu_obj" => $menu, "childs" => $childs);
                        $menu_map[] = $tmp_array;
                    }
                }

                return $menu_map;
            }
        }

        return FALSE;
    }

    private function menu($menu)
    {
        $map = array();
        if ($this->has_child_menu($menu->{$this->key})) {
            //has child category...
            $child_menu = $this->get_all_active_child_menu($menu->{$this->key});
            if (is_array($child_menu)) {
                foreach ($child_menu as $menu2) {
                    $map[] = array($this->key => $menu2->{$this->key}, "title" => $menu2->{$this->title}, "menu_obj" => $menu2, "childs" => $this->menu($menu2));
                }
            }
        } else {
            //no child category...
            return FALSE;
        }
        return $map;
    }

    public function has_child_menu($id)
    {
        $no = $this->count_by($this->parent_id, $id);
        if (empty($no)) {
            return FALSE;
        }
        return TRUE;
    }

    public function get_all_active_child_menu($id, $flag = FALSE)
    {
        $this->db->where($this->parent_id, $id);
        $this->db->where($this->status_field, 1);
        $this->db->order_by($this->title, "ASC");

        if ($flag == FALSE) {
            return $this->find_all(0);
        } else {
            return $this->find_all(1);
        }
    }

    public function find_navigation_parent_menus($navigation_id)
    {
        if (!empty($navigation_id)) {
            $this->db->select("*");
            $this->db->from($this->table_name);
            $this->db->where(self::NAVIGATION_ID, $navigation_id);
            $this->db->where(self::PARENT_ID, 0);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }
        return FALSE;
    }

    function get_recursive_menu($menu)
    {
        $output = "";
        if (isset($menu["childs"]) && is_array($menu['childs'])) {

            $output .= "<li><span>{$menu[$this->title]}</span>";
            $output .= "<ul>";
            foreach ($menu["childs"] as $menu2) {
                $output .= $this->get_recursive_menu($menu2);
            }
            $output .= "</li></ul>";
        } else {
            $target = ($menu['menu_obj']->window=='1' ? "_blank" : "_self");
            $output .= "<li><span><a href='".$menu['menu_obj']->link."' target='{$target}'>{$menu[$this->title]}</a></span></li>";
        }
        return $output;
    }

}
