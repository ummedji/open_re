<?php

class EX_CH_Grid_generator extends CH_Grid_generator {

    protected $deleted_field = "deleted";
    protected $banned_field = "banned";

    public function __construct(array $config) {
        parent::__construct($config);
    }

    protected function _delete_user() {
        if (isset($this->req_data) && $this->_validate($this->req_data)) {
            if (isset($this->req_data['delete_id']) && !empty($this->req_data['delete_id'])) {

                $update = array(
                    $this->deleted_field => 1,
//                    $this->status_field => 0
                );
                $where = array(
                    $this->key => $this->req_data['delete_id']
                );

                /*if ($this->CI->db->update($this->table, $update, $where)) {
                    return "success";
                } else {
                    return "fail";
                }*/

                $this->CI->db->where('user_id', $this->req_data['delete_id']);
                $this->CI->db->delete('bf_user_meta');

                if ($this->CI->db->delete($this->table,$where)) {
                    return "success";
                } else {
                    return "fail";
                }

            }
        }
    }

    protected function _delete_selected_user() {
        if (isset($this->req_data) && $this->_validate($this->req_data)) {
            if (isset($this->req_data['checked']) && !empty($this->req_data['checked'])) {
                $i = 0;
                foreach ($this->req_data['checked'] as $value) {

                    $update = array(
                        $this->deleted_field => 1,
//                        $this->status_field => 0
                    );
                    $where = array(
                        $this->key => $value
                    );

                    $this->CI->db->where('user_id', $value);
                    $this->CI->db->delete('bf_user_meta');

                    if ($this->CI->db->delete($this->table,$where)) {
                        $i++;
                    }
                    /*if ($this->CI->db->update($this->table, $update, $where)) {
                        $i++;
                    }*/
                }
                if ($i === count($this->req_data['checked'])) {
//                    return "{$i} rows successfully deleted";
                    return "success";
                } else {
                    return "fail";
                }
            } else {
                return "fail";
            }
        }
    }

    protected function _activate_user() {
        if (isset($this->req_data) && $this->_validate($this->req_data)) {
            if (isset($this->req_data['checked']) && !empty($this->req_data['checked'])) {
                $i = 0;
                foreach ($this->req_data['checked'] as $value) {

                    $update = array(
                        $this->status_field => 1,
                    );
                    $where = array(
                        $this->key => $value
                    );

                    if ($this->CI->db->update($this->table, $update, $where)) {
                        $i++;
                    }
                }
                if ($i === count($this->req_data['checked'])) {
//                    return "{$i} rows successfully deleted";
                    return "success";
                } else {
                    return "fail";
                }
            } else {
                return "fail";
            }
        }
    }

    protected function _deactivate_user() {
        if (isset($this->req_data) && $this->_validate($this->req_data)) {
            if (isset($this->req_data['checked']) && !empty($this->req_data['checked'])) {
                $i = 0;
                foreach ($this->req_data['checked'] as $value) {

                    $update = array(
                        $this->status_field => 0,
                    );
                    $where = array(
                        $this->key => $value
                    );

                    if ($this->CI->db->update($this->table, $update, $where)) {
                        $i++;
                    }
                }
                if ($i === count($this->req_data['checked'])) {
//                    return "{$i} rows successfully deleted";
                    return "success";
                } else {
                    return "fail";
                }
            } else {
                return "fail";
            }
        }
    }

    protected function _ban_user() {
        if (isset($this->req_data) && $this->_validate($this->req_data)) {
            if (isset($this->req_data['checked']) && !empty($this->req_data['checked'])) {
                $i = 0;
                foreach ($this->req_data['checked'] as $value) {

                    $update = array(
                        $this->banned_field => 1,
                    );
                    $where = array(
                        $this->key => $value
                    );

                    if ($this->CI->db->update($this->table, $update, $where)) {
                        $i++;
                    }
                }
                if ($i === count($this->req_data['checked'])) {
//                    return "{$i} rows successfully deleted";
                    return "success";
                } else {
                    return "fail";
                }
            } else {
                return "fail";
            }
        }
    }

    protected function _restore_user() {
        if (isset($this->req_data) && $this->_validate($this->req_data)) {
            if (isset($this->req_data['delete_id']) && !empty($this->req_data['delete_id'])) {

                $update = array(
                    $this->deleted_field => 0,
//                    $this->status_field => 0
                );
                $where = array(
                    $this->key => $this->req_data['delete_id']
                );

                if ($this->CI->db->update($this->table, $update, $where)) {
                    return "success";
                } else {
                    return "fail";
                }
            }
        }
    }

}
