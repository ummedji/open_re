<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_model extends BF_Model
{

    protected $table_name = "category";
    protected $key = "ID";
    protected $soft_deletes = false;
    protected $date_format = "datetime";
    protected $set_created = false;
    protected $set_modified = false;
    protected $status_field = "category_status";

    //database fields...

    const ID = "ID";
    const CATEGORY_TITLE = "category_title";
    const CATEGORY_SLUG = "category_slug";
    const CATEGORY_DESCRIPTION = "category_description";
    const CATEGORY_IMAGE = "category_image";
    const CATEGORY_BANNER = "category_banner";
    const CATEGORY_VIDEO = "category_video";
    const CATEGORY_STATUS = "category_status";
    const CATEGORY_PARENT_ID = "category_parent_id";

    public function __construct()
    {
        parent::__construct();

        $config = array(
            "table" => $this->table_name,
            "key"=> $this->key,
            "status_field" => $this->status_field,
            "order" => array(
                "sortby" => self::CATEGORY_TITLE,
                "order" => "ASC"
            )
        );
        $this->load->library("CH_Grid_generator", $config, "grid");
    }

    public function read($req_data, $exclude_limit = FALSE)
    {
        $initialize = array(
            "req_data" => $req_data
        );
        if ($exclude_limit) {
            $initialize['exclude_limit'] = TRUE;
        }
        $this->grid->initialize($initialize);
        return $this->grid->get_result();
    }

    public function getArrayOfData()
    {
        return $this->grid->arrayOfData;
    }

    public function find_all_parents()
    {
        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where(self::CATEGORY_PARENT_ID, 0);
        $this->db->where(self::CATEGORY_STATUS, 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return FALSE;
    }

    public function find_all_category()
    {
        $this->db->select("*");
        $this->db->from($this->table_name);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
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

    public function find_category_by_id($id)
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

    public function find_category_by_slug($slug)
    {
        if (!empty($slug)) {
            $this->db->select("*");
            $this->db->from($this->table_name);
            $this->db->where(self::CATEGORY_SLUG, $slug);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row();
            }
        }

        return FALSE;
    }

    public function get_category_map()
    {
        $category_map = array();
        $parrent_categories = $this->find_all_parents();
//        var_dump($parrent_categories);
        if ($parrent_categories) {
            foreach ($parrent_categories as $category) {
                $childs = $this->category($category);
                $tmp_array = array("ID" => $category->ID, "title" => $category->category_title, "cat_obj" => $category, "childs" => $childs);
                $category_map[] = $tmp_array;
            }
        }

        return $category_map;
    }

    private function category($category)
    {
        $map = array();
        if ($this->has_child_category($category->ID)) {
            //has child category...
            $child_category = $this->get_all_active_child_category($category->ID);
            if (is_array($child_category)) {
                foreach ($child_category as $category2) {
                    $map[] = array("ID" => $category2->ID, "title" => $category2->category_title, "cat_obj" => $category2, "childs" => $this->category($category2));
                }
            }
        } else {
            //no child category...
            return FALSE;
        }
        return $map;
    }

    //get category in single array(); important function...
    private function category2($category)
    {
        $map = array();
        if ($this->has_child_category($category['ID'])) {
            //has child category...
            $child_category = $this->get_all_active_child_category($category['ID'], TRUE);
            if (is_array($child_category)) {
                foreach ($child_category as $category2) {
                    $map[] = $category['category_slug'];
                    $map = array_merge($map, $this->category2($category2));
                }
            }
        } else {
            $map[] = $category['category_slug'];
        }
        return $map;
    }

    public function has_child_category($id)
    {
        $no = $this->count_by(self::CATEGORY_PARENT_ID, $id);
        if (empty($no)) {
            return FALSE;
        }
        return TRUE;
    }

    public function get_all_active_child_category_count($id)
    {
        $count = $this->db->where(self::CATEGORY_PARENT_ID, $id)
            ->where(self::CATEGORY_STATUS, 1)
            ->order_by(self::CATEGORY_TITLE, "ASC")
            ->count_all_results($this->table_name);
        return $count;
    }

    public function get_all_active_child_category($id, $flag = FALSE)
    {
        $this->db->where(self::CATEGORY_PARENT_ID, $id);
        $this->db->where(self::CATEGORY_STATUS, 1);
        $this->db->order_by(self::CATEGORY_TITLE, "ASC");

        if ($flag == FALSE) {
            return $this->find_all(0);
        } else {
            return $this->find_all(1);
        }
    }

    function get_recursive_category($category, $cats)
    {
        $output = "";
        $check = "";
        if (in_array($category['ID'], $cats)) {
            $check = "checked='true'";
        }
        if (isset($category["childs"]) && is_array($category['childs'])) {

            $output .= "<li><span>{$category['title']}</span>&nbsp;<input type='checkbox' name='category[]'  value='{$category['ID']}' {$check}/>";
            $output .= "<ul>";
            foreach ($category["childs"] as $category2) {
                $output .= $this->get_recursive_category($category2, $cats);
            }
            $output .= "</li></ul>";
        } else {
            $output .= "<li><span>{$category['title']}</span>&nbsp;<input type='checkbox' name='category[]'  value='{$category['ID']}' {$check}/></li>";
        }
        return $output;
    }

    //find category map for the array of categories...
    public function get_category_map_by_categories($categories)
    {
//        var_dump($categories);die;
        if (!empty($categories) && is_array($categories)) {
            $cats = array();
            $cats2 = array();

            //find all categories by slug...
            foreach ($categories as $slug) {
                $cats[] = $slug;
            }
            $this->db->select("*");
            $this->db->from($this->table_name);
            $this->db->where(self::CATEGORY_SLUG . " IN ('" . implode("','", $cats) . "')");
            $this->db->where(self::CATEGORY_STATUS, 1);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $result_categories = $query->result_array();
                foreach ($result_categories as $category) {
                    $tmp = array_unique($this->category2($category));
                    $cats2 = array_merge($cats2, $tmp);
                }
            }
            return $cats2;
        }

        return FALSE;
    }

    public function find_parent_category($id)
    {
        if (!empty($id)) {
            $this->db->select("category_slug, category_title, category_parent_id, ID");
            $this->db->from($this->table_name);
            $this->db->where(array("ID" => $id));
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $result = $query->row();
                if (!empty($result->category_parent_id)) {
                    //means it has a parent. find it.
                    $this->db->select("category_slug, category_title, ID");
                    $this->db->from($this->table_name);
                    $this->db->where(array("ID" => $result->category_parent_id));
                    $query = $this->db->get();

                    if ($query->num_rows() > 0) {
                        return $query->row();
                    }
                } else {
                    //means no parent-category.
                    return $result;
                }
            }
        }
        return FALSE;
    }

}
