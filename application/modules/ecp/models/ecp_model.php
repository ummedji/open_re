<?php defined('BASEPATH') || exit('No direct script access allowed');

class Ecp_model extends BF_Model
{
    public function __construct()
    {
        parent::__construct();
        $config = array();
        $this->load->library("CH_Grid_generator", $config, "grid");
    }

    /**
     * @ Function Name        : get_materials_by_country_id
     * @ Function Params    : $country_id
     * @ Function Purpose    : Return list of materials
     * @ Function Return    : Array
     * */

    public function get_materials_by_country_id($country_id)
    {
        $this->db->select('promotional_country_id,promotional_material_country_name,promotional_material_country_code');
        $this->db->from('master_promotional_material_country');
        $this->db->where('country_id', $country_id);
        $this->db->where('status', '1');
        $this->db->where('deleted', '0');
        $materials = $this->db->get()->result_array();
        if (isset($materials) && !empty($materials)) {
            return $materials;
        } else {
            return false;
        }
    }

    /**
     * @ Function Name       : add_material_request_detail
     * @ Function Params     : $user_id,$country_id
     * @ Function Purpose    :
     * @ Function Return     : Array
     * */

    public function add_material_request_detail($user_id, $country_id, $web_service = null)
    {
        if (!empty($web_service) && $web_service == 'web_service') {
            $request_date = $this->input->post("request_date");

            $req_date = str_replace('/', '-', $request_date);
            $material_request_date = date('Y-m-d', strtotime($req_date));
            $promotional_country_id = $this->input->post("promotional_id");
            $quantity = $this->input->post("quantity");
            $remark = $this->input->post("remark");
        } else {
            $request_date = $this->input->post("material_request_date");

            $req_date = str_replace('/', '-', $request_date);
            $material_request_date = date('Y-m-d', strtotime($req_date));
            $promotional_country_id = $this->input->post("promotional_country_id");
            $quantity = $this->input->post("quantity");
            $remark = $this->input->post("remark");
        }


        $add_materials = array(
            'material_request_date' => $material_request_date,
            'promotional_country_id' => $promotional_country_id,
            'employee_id' => $user_id,
            'quantity' => $quantity,
            'remark' => $remark,
            'country_id' => $country_id,
            'material_request_status' => '0',
            'recived_status' => '0',
            'status' => '1',
            'created_by_user' => $user_id,
            'modified_by_user' => $user_id,
            'created_on' => date('Y-m-d H:i:s'),
            'modified_on' => date('Y-m-d H:i:s')
        );
        $this->db->insert('bf_ecp_material_request', $add_materials);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }


    public function get_all_designation_by_country($country_id)
    {
        $this->db->select('mdc.desigination_country_id,mdc.desigination_country_name');
        $this->db->from('master_designation_country as mdc');
        $this->db->where('mdc.country_id', $country_id);
        $this->db->where('mdc.status', '1');
        $this->db->where('mdc.deleted', '0');
        $this->db->order_by('desigination_country_name', 'ASC');
        $designation = $this->db->get()->result_array();
        if (isset($designation) && !empty($designation)) {
            return $designation;
        } else {
            return false;
        }
    }

    public function get_employee_by_role_id($designation_id, $country_id)
    {
        $this->db->select('bu.id,bu.display_name');
        $this->db->from('master_designation_role as mdr');
        $this->db->join('users as bu','bu.id = mdr.user_id');
        $this->db->where('mdr.desigination_id',$designation_id);
        $this->db->where('bu.country_id', $country_id);
        $this->db->where('bu.type', 'Employee');
        $this->db->where('bu.active', '1');
        $this->db->where('bu.deleted', '0');
        $this->db->order_by('bu.display_name', 'ASC');
        $employees = $this->db->get()->result_array();
        if (isset($employees) && !empty($employees)) {
            return $employees;
        } else {
            return false;
        }
    }

    /**
     * @ Function Name        : get_all_materials_by_country_id
     * @ Function Params    : $country_id
     * @ Function Purpose    : Return list of requested materials
     * @ Function Return    : Array
     * */

    public function get_all_materials_by_country_id($country_id, $page = null, $local_date = null, $web_service = null)
    {
        $sql = 'SELECT SQL_CALC_FOUND_ROWS emr.material_request_id,emr.material_request_date,mpmc.promotional_material_country_name,emr.quantity,bu.display_name as emp,emr.material_request_status,emr.recived_status,emr.disptched_date,buu.display_name as updated_user,emr.modified_on ';
        $sql .= 'FROM bf_ecp_material_request AS emr ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = emr.employee_id) ';
        $sql .= 'JOIN bf_users AS buu ON (buu.id = emr.modified_by_user) ';
        $sql .= 'JOIN bf_master_promotional_material_country AS mpmc ON (mpmc.promotional_country_id = emr.promotional_country_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND emr.country_id ="' . $country_id . '" ';
        $sql .= 'ORDER BY emr.material_request_id DESC ';

        if (!empty($web_service) && $web_service == 'web_service') {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page * $limit - $limit;
            $sql .= ' LIMIT ' . $offset . "," . $limit;
            $info = $this->db->query($sql);
            //echo $this->db->last_query();
            // For Pagination
            $material = $info->result_array();
            return $material;
        } else {
            $requested_material = $this->grid->get_result_res($sql);

            if (isset($requested_material['result']) && !empty($requested_material['result'])) {
                $material['head'] = array('Sr. No.', 'Action', 'Date', 'Mr.Id', 'Material', 'Quantity', 'Employee Name', 'Status', 'Received', 'Last Update', 'Last Updated By', 'Dispatch Date');
                $material['count'] = count($material['head']);
                if ($page != null || $page != "") {
                    $i = (($page * 10) - 9);
                } else {
                    $i = 1;
                }

                foreach ($requested_material['result'] as $rm) {

                    if ($local_date != null) {
                        $date3 = strtotime($rm['material_request_date']);
                        $request_date = date($local_date, $date3);

                        if ($rm['disptched_date'] != null) {
                            $date1 = strtotime($rm['disptched_date']);
                            $disptched_date = date($local_date, $date1);
                        } else {
                            $disptched_date = '';
                        }
                        $date2 = strtotime($rm['modified_on']);
                        $modified_on_date = date($local_date, $date2);

                    } else {
                        $request_date = $rm['material_request_date'];
                        $disptched_date = $rm['disptched_date'];
                        $modified_on_date = $rm['modified_on'];
                    }

                    if ($rm['material_request_status'] == 0) {
                        $material_request_status = 'Pending';
                        $material['delete_disabled'][] = 0;
                    } elseif ($rm['material_request_status'] == 1) {
                        $material_request_status = 'Approve';
                        $material['delete_disabled'][] = 1;
                    } else {
                        $material_request_status = 'Reject';
                        $material['delete_disabled'][] = 1;
                    }

                    if ($rm['material_request_status'] == 1) {

                        if ($rm['recived_status'] == '0') {
                            $received_status = '<select name="received_status" class="received_status" id="received_status" ><option value="0">Pending</option><option  value="1">Confirm</option></select>
                    <input type="hidden" id="mr_id" class="mr_id" name="mr_id" value="' . $rm['material_request_id'] . '">';
                        } else {
                            $received_status = 'Confirm';
                        }
                    } else {
                        if ($rm['recived_status'] == '0') {
                            $received_status = 'Pending';
                        } else {
                            $received_status = 'Confirm';
                        }
                    }

                    $material['row'][] = array($i, $rm['material_request_id'], $request_date, $rm['material_request_id'], $rm['promotional_material_country_name'], $rm['quantity'], $rm['emp'], $material_request_status, $received_status, $modified_on_date, $rm['updated_user'], $disptched_date);
                    $i++;
                }
                $material['eye'] = '';
                $material['action'] = 'is_action';
                $material['edit'] = '';
                $material['delete_dis'] = 'is_delete';
                $material['pagination'] = $requested_material['pagination'];
                // testdata($material);
                return $material;
            } else {
                return false;
            }
        }

    }

    public function update_material_request_detail($user_id, $mr_id, $status)
    {
        $update_material = array(
            'recived_status' => $status,
            'modified_by_user' => $user_id,
            'modified_on' => date('Y-m-d H:i:s')
        );

        $this->db->where('material_request_id', $mr_id);
        $this->db->update('ecp_material_request', $update_material);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_all_employee_by_country_id($country_id)
    {
        $this->db->select('display_name,id,bussiness_code');
        $this->db->from('users');
        $this->db->where('country_id', $country_id);
        $this->db->where('active', '1');
        $this->db->where('role_id', '8');
        $employee = $this->db->get()->result_array();
        if (isset($employee) && !empty($employee)) {
            return $employee;
        } else {
            return false;
        }
    }

    public function get_all_materials_request_details_view($from_date, $to_date, $status_id, $employee_id, $page, $local_date, $country_id, $web_service = null,$designation_id)
    {

        if((isset($designation_id) && !empty($designation_id)) && empty($employee_id))
        {
            $employee_id = $this->GetAllEmployeeByDesignationId($designation_id);
        }

        $sql = 'SELECT SQL_CALC_FOUND_ROWS emr.material_request_id,emr.material_request_date,mpmc.promotional_material_country_name,emr.quantity,bu.display_name as emp,bu.user_code,emr.material_request_status,emr.recived_status,emr.disptched_date,emr.disptched_qty,emr.remark,emr.executor_remark,mdc.desigination_country_name ';
        $sql .= 'FROM bf_ecp_material_request AS emr ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = emr.employee_id) ';
        $sql .= 'JOIN bf_master_designation_role AS mdr ON (mdr.user_id = bu.id) ';
        $sql .= 'JOIN bf_master_designation_country AS mdc ON (mdc.desigination_country_id = mdr.desigination_id) ';
        $sql .= 'JOIN bf_users AS buu ON (buu.id = emr.modified_by_user) ';
        $sql .= 'JOIN bf_master_promotional_material_country AS mpmc ON (mpmc.promotional_country_id = emr.promotional_country_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND emr.country_id ="' . $country_id . '" ';
        if (isset($from_date) && !empty($from_date) && isset($to_date) && !empty($to_date)) {
            $sql .= ' AND emr.material_request_date BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $to_date . '"' . ' ';
        }
        $sql .= 'AND emr.material_request_status ="' . $status_id . '" ';



        if (isset($employee_id) && !empty($employee_id)) {
            $sql .= 'AND emr.employee_id IN ("' . $employee_id . '") ';
        }
        $sql .= 'AND emr.country_id ="' . $country_id . '" ';
        $sql .= 'ORDER BY emr.material_request_id DESC ';
       
        if (!empty($web_service) && $web_service == 'web_service') {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page * $limit - $limit;
            $sql .= ' LIMIT ' . $offset . "," . $limit;
            $info = $this->db->query($sql);
            // For Pagination
            $requested_material = $info->result_array();
            return $requested_material;
        } else {
            $requested_material = $this->grid->get_result_res($sql);

            if (isset($requested_material['result']) && !empty($requested_material['result'])) {
                $material['head'] = array('Sr. No.', 'Action', 'Mr.Id', 'Employee Code', 'Employee Name', 'Designation', 'Requested Date', 'Requested Material', 'Requested Quantity', 'Dispatched Date', 'Dispatched Quantity', 'Remark', 'Status', 'Received Status', 'Executor Remark',);
                $material['count'] = count($material['head']);
                if ($page != null || $page != "") {
                    $i = (($page * 10) - 9);
                } else {
                    $i = 1;
                }

                foreach ($requested_material['result'] as $rm) {

                    if ($local_date != null) {
                        $date3 = strtotime($rm['material_request_date']);
                        $request_date = date($local_date, $date3);

                        if ($rm['disptched_date'] != null) {
                            $date1 = strtotime($rm['disptched_date']);
                            $disptched_date = date($local_date, $date1);
                        } else {
                            $disptched_date = '';
                        }

                    } else {
                        $request_date = $rm['material_request_date'];
                        $disptched_date = $rm['disptched_date'];
                    }

                    /*material_request_status*/
                    if ($rm['material_request_status'] == 0) {
                        $material['delete_disabled'][] = 0;
                    } elseif ($rm['material_request_status'] == 1) {
                        $material['delete_disabled'][] = 1;
                    } else {
                        $material['delete_disabled'][] = 1;
                    }
                    /*material_request_status*/

                    if ($rm['recived_status'] == 0) {
                        $received_status = 'Pending';
                    } else {
                        $received_status = 'Confirm';
                    }

                    if ($rm['material_request_status'] == '0') {
                        $request_status = '<select name="request_status[]" class="request_status" id="request_status" ><option value="0">Pending</option><option  value="1">Approve</option><option  value="2">Reject</option></select>
                    <input type="hidden" id="mr_id" class="mr_id" name="mr_id[]" value="' . $rm['material_request_id'] . '">';
                    } elseif ($rm['material_request_status'] == '1') {
                        $request_status = 'Approve';
                    } else {
                        $request_status = 'Reject';
                    }

                    $remark = '<textarea name="remarks[]" id="remarks" readonly>' . $rm["remark"] . '</textarea>';
                    if ($rm['material_request_status'] == '0') {
                        $executor_remark = '<textarea name="executor_remarks[]" id="executor_remark">' . $rm["executor_remark"] . '</textarea>';
                        $disptched_quantity = '<input type="text" class="allownumericwithdecimal" id="disptched_quantity" name="disptched_quantity[]">';
                    } else {
                        $executor_remark = '<textarea name="executor_remark" id="executor_remark" readonly>' . $rm["executor_remark"] . '</textarea>';
                        $disptched_quantity = $rm['disptched_qty'];
                    }


                    $material['row'][] = array($i, $rm['material_request_id'], $rm['material_request_id'], $rm['user_code'], $rm['emp'], $rm['desigination_country_name'], $request_date, $rm['promotional_material_country_name'], $rm['quantity'], $disptched_date, $disptched_quantity, $remark, $request_status, $received_status, $executor_remark);
                    $i++;
                }
                $material['eye'] = '';
                $material['action'] = 'is_action';
                $material['edit'] = '';
                $material['delete_dis'] = 'is_delete';
                $material['selected_status'] = $status_id;
                $material['pagination'] = $requested_material['pagination'];

                return $material;
            } else {
                return false;
            }
        }
    }


    public function GetAllEmployeeByDesignationId($designation_id)
    {
        $this->db->select('user_id');
        $this->db->from('bf_master_designation_role');
        $this->db->where('desigination_id', $designation_id);
        $this->db->where('status', '1');
        $this->db->where('deleted', '0');
        $employee = $this->db->get()->result_array();

        if (isset($employee) && !empty($employee)) {
            $emp_id = array();
            foreach($employee as $k=> $val)
            {
                $emp_id[] = $val['user_id'];
            }
            $employee = implode(',',$emp_id);
            return $employee;
        } else {
            return false;
        }

    }

    public function update_materials_detail($user_id, $web_service = null)
    {
        if (isset($web_service) && !empty($web_service) && $web_service == 'web_service') {

            $disptched_quantity = explode(',', $this->input->post("disptched_quantity"));
            $request_status = explode(',', $this->input->post("request_status"));
            $mr_id = explode(',', $this->input->post("mr_id"));
            $executor_remarks = explode(',', $this->input->post("executor_remarks"));
        } else {
            $disptched_quantity = $this->input->post("disptched_quantity");
            $request_status = $this->input->post("request_status");
            $mr_id = $this->input->post("mr_id");
            $executor_remarks = $this->input->post("executor_remarks");
        }
        $disptched_date = date('Y-m-d');

        $update_array= array();

        foreach ($mr_id as $K => $m_id) {
            $disptched_qty = !empty($disptched_quantity[$K]) ? $disptched_quantity[$K] : '0';
            $executor_remark = !empty($executor_remarks[$K]) ? $executor_remarks[$K] : '';

            if($request_status[$K] == '1'){
                $update_material_details = array(
                    'disptched_qty' => $disptched_qty,
                    'material_request_status' => $request_status[$K],
                    'executor_remark' => $executor_remark,
                    'disptched_date' => $disptched_date,
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );
                $this->db->where('material_request_id', $m_id);
                $this->db->update('ecp_material_request', $update_material_details);

                if ($this->db->affected_rows() > 0) {
                    $update_array[]=1;

                }
            }
            elseif($request_status[$K] == '2'){
                $update_material_details = array(
                    'disptched_qty' => $disptched_qty,
                    'material_request_status' => $request_status[$K],
                    'executor_remark' => $executor_remark,
                    'disptched_date' => null,
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );
                $this->db->where('material_request_id', $m_id);
                $this->db->update('ecp_material_request', $update_material_details);

                if ($this->db->affected_rows() > 0) {
                    $update_array[]=1;

                }
            }
          /*  else{
                $update_material_details = array(
                    'disptched_qty' => '0.0',
                    'material_request_status' => $request_status[$K],
                    'executor_remark' => null,
                    'disptched_date' => null,
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );
            }*/

        }
        if(in_array(1,$update_array))
        {
            return 1;
        }
        else{
            return 0;
        }
    }

    public function delete_material_detail($mr_id)
    {
        $this->db->where('material_request_id', $mr_id);
        $this->db->delete('ecp_material_request');
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }


    public function get_employee_geo_data($user_id, $country_id, $customer_type, $parent_geo_id = null, $action_data = null, $radio_checked)
    {
        $main_query_start = "";
        $main_query_end = "";
        $select_data = " bmpgd.political_geo_id, bmpgd.political_geography_name ";
        $sub_query = "";

        if ($customer_type == 7) {
            if (($action_data == "retailer_compititor_analysis" || $action_data == "retailer_compititor_product") && $parent_geo_id == null) {
                $main_query_start = "SELECT `bmpgd2`.`political_geo_id`,`bmpgd2`.`political_geography_name`,
`bmpgd2`.`parent_geo_id` FROM `bf_master_political_geography_details` as bmpgd2
 where `political_geo_id` IN ( ";


                $main_query_end .= " )";

                $select_data = " bmpgd.parent_geo_id ";

                $subquery1 = $main_query_start . " SELECT " . $select_data . " FROM `bf_users` as bu";
                $where1 = " ";
                $where2 = " ";
                $where3 = " ";


            } elseif ($parent_geo_id != null) {

                $customer_type = 10;
                $sub_query = " AND bmpgd.parent_geo_id = $parent_geo_id ";


                $subquery1 = $main_query_start . " SELECT " . $select_data . " FROM `bf_users` as bu";

                $where1 = " ";
                $where2 = " ";
                $where3 = " ";

            } else {

                $subquery1 = " SELECT " . $select_data . " FROM `bf_users` as bu";
                $where1 = " ";
                $where2 = " ";
                $where3 = " ";

            }

        } else {

            if (($action_data == "retailer_compititor_analysis" || $action_data == "retailer_compititor_product") && $parent_geo_id == null) {
                $main_query_start = "SELECT `bmpgd2`.`political_geo_id`,`bmpgd2`.`political_geography_name`,
    `bmpgd2`.`parent_geo_id` FROM `bf_master_political_geography_details` as bmpgd2
     where `political_geo_id` IN ( ";

                $main_query_end .= " )";
                $select_data = " bmpgd.parent_geo_id ";

            }

            if ($parent_geo_id != null) {
                $customer_type = 10;
                $sub_query = " AND bmpgd.parent_geo_id = $parent_geo_id ";

            }
            $subquery1 = $main_query_start . " SELECT  " . $select_data . " FROM (`bf_master_employe_to_customer` as etc)
                        JOIN `bf_users` as bu ON `bu`.`id` = `etc`.`customer_id` ";

            $where1 = " `etc`.`employee_id` = " . $user_id;
            $where2 = " AND YEAR(etc.year) = '" . date("Y") . "' AND ";
            $where3 = "";

        }
        $query1 = $subquery1 . " JOIN `bf_master_user_contact_details` as bmucd ON `bmucd`.`user_id` = `bu`.`id`
        JOIN `bf_master_political_geography_details` as bmpgd ON `bmpgd`.`political_geo_id` = `bmucd`.`geo_level_id1`

        WHERE " . $where1 . " " . $where2 . " " . $where3 . "

        `bu`.`role_id` = " . $radio_checked . "
        AND `bu`.`type` = 'Customer'
        AND `bu`.`deleted` = '0'
        AND `bu`.`country_id` = '" . $country_id . "' " . $sub_query . "
        GROUP BY `bmpgd`.`political_geography_name` " . $main_query_end;

        $query = $this->db->query($query1);
        $geo_loc_data = $query->result_array();
        return $geo_loc_data;

    }


    public function get_all_copititor_data($country_id)
    {
        $this->db->select('compititor_id,compititor_name');
        $this->db->from('bf_ecp_compititor_master');
        $this->db->where('country_id', $country_id);
        $this->db->where('status', '1');
        $this->db->where('deleted', '0');
        $compititor = $this->db->get()->result_array();

        if (isset($compititor) && !empty($compititor)) {
            return $compititor;
        } else {
            return false;
        }
    }


    public function add_retailer_compititor_details($user_id, $country_id, $web_service = null)
    {


        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $month_da = $this->input->post("month_data");
            $retailer_id = $this->input->post("retailer_id");
            $comp_id = explode(',', $this->input->post("comp_id"));
            $amount = explode(',', $this->input->post("amount"));
        } else {
            $month_da = $this->input->post("month_da");
            $retailer_id = $this->input->post("retailer_id");
            $comp_id = $this->input->post("comp_id");
            $amount = $this->input->post("amount");
        }

        $retailer_analysis_data = array(
            'compititor_analysis_month' => $month_da . '-01',
            'coustomer_id' => (isset($retailer_id) && !empty($retailer_id)) ? $retailer_id : '',
            'created_by_user' => $user_id,
            'country_id' => $country_id,
            'status' => '1',
            'created_on' => date('Y-m-d H:i:s')
        );

        if ($this->db->insert('ecp_compititor_analysis_total', $retailer_analysis_data)) {
            $insert_id = $this->db->insert_id();
        }


        $compititor_analysis_total_id = $insert_id;

        foreach ($comp_id as $key => $val_comp_id) {

            $retailer_compititor_data = array(
                'compititor_analysis_total_id' => $compititor_analysis_total_id,
                'compititor_id' => $val_comp_id,
                'amount' => $amount[$key],
            );
            $this->db->insert('ecp_compititor_total_details', $retailer_compititor_data);
        }

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }


    public function add_retailer_compititor_product_details($user_id, $country_id, $web_service = null)
    {
        $month_data = $this->input->post("month_data");
        $compititor_id = $this->input->post("compititor_id");
        $retailer_id = $this->input->post("retailer_id");

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {

            $prod_sku_id = explode(',', $this->input->post("prod_sku_id"));
            $quantity = explode(',', $this->input->post("quantity"));
            $comp_prd_name = explode(',', $this->input->post("comp_prd_name"));
        } else {
            $prod_sku_id = $this->input->post("prod_sku_id");
            $quantity = $this->input->post("quantity");
            $comp_prd_name = $this->input->post("comp_prd_name");
        }

        $retailer_analysis_product_data = array(
            'compititor_analysis_month' => $month_data . '-01',
            'coustomer_id' => (isset($retailer_id) && !empty($retailer_id)) ? $retailer_id : '',
            'compititor_id' => (isset($compititor_id) && !empty($compititor_id)) ? $compititor_id : '',
            'created_by_user' => $user_id,
            'country_id' => $country_id,
            'status' => '1',
            'created_on' => date('Y-m-d H:i:s')
        );

        if ($this->db->insert('ecp_compititor_analysis_product', $retailer_analysis_product_data)) {
            $insert_id = $this->db->insert_id();
        }

        $compititor_analysis_product_id = $insert_id;

        foreach ($prod_sku_id as $key => $prod_sku) {

            $retailer_compititor_prd_data = array(
                'compititor_analysis_product_id' => $compititor_analysis_product_id,
                'product_sku_id' => $prod_sku,
                'compititor_product_name' => $comp_prd_name[$key],
                'quantity' => $quantity[$key],
            );
            $this->db->insert('ecp_compititor_product_details', $retailer_compititor_prd_data);
        }

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }


    public function add_distributor_compititor_details($user_id, $country_id, $web_service = null)
    {
        $month_data = $this->input->post("month_data");
        $distributor_id = $this->input->post("distributor_id");

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $comp_id = explode(',', $this->input->post("comp_id"));
            $amount = explode(',', $this->input->post("amount"));
        } else {
            $comp_id = $this->input->post("comp_id");
            $amount = $this->input->post("amount");
        }

        $distributor_analysis_data = array(
            'compititor_analysis_month' => $month_data . '-01',
            'coustomer_id' => (isset($distributor_id) && !empty($distributor_id)) ? $distributor_id : '',
            'created_by_user' => $user_id,
            'country_id' => $country_id,
            'status' => '1',
            'created_on' => date('Y-m-d H:i:s')
        );

        if ($this->db->insert('ecp_compititor_analysis_total', $distributor_analysis_data)) {
            $insert_id = $this->db->insert_id();
        }

        $compititor_analysis_total_id = $insert_id;

        foreach ($comp_id as $key => $val_comp_id) {

            $distributor_compititor_data = array(
                'compititor_analysis_total_id' => $compititor_analysis_total_id,
                'compititor_id' => $val_comp_id,
                'amount' => $amount[$key],
            );
            $this->db->insert('ecp_compititor_total_details', $distributor_compititor_data);
        }

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function add_distributor_compititor_product_details($user_id, $country_id, $web_service = null)
    {
        $month_data = $this->input->post("month_data");
        $compititor_id = $this->input->post("compititor_id");
        $distributor_id = $this->input->post("distributor_id");

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {

            $prod_sku_id = explode(',', $this->input->post("prod_sku_id"));
            $quantity = explode(',', $this->input->post("quantity"));
            $comp_prd_name = explode(',', $this->input->post("comp_prd_name"));
        } else {
            $prod_sku_id = $this->input->post("prod_sku_id");
            $quantity = $this->input->post("quantity");
            $comp_prd_name = $this->input->post("comp_prd_name");
        }

        $distributor_analysis_product_data = array(
            'compititor_analysis_month' => $month_data . '-01',
            'coustomer_id' => (isset($distributor_id) && !empty($distributor_id)) ? $distributor_id : '',
            'compititor_id' => (isset($compititor_id) && !empty($compititor_id)) ? $compititor_id : '',
            'created_by_user' => $user_id,
            'country_id' => $country_id,
            'status' => '1',
            'created_on' => date('Y-m-d H:i:s')
        );

        if ($this->db->insert('ecp_compititor_analysis_product', $distributor_analysis_product_data)) {
            $insert_id = $this->db->insert_id();
        }

        $compititor_analysis_product_id = $insert_id;

        foreach ($prod_sku_id as $key => $prod_sku) {

            $distributor_compititor_prd_data = array(
                'compititor_analysis_product_id' => $compititor_analysis_product_id,
                'product_sku_id' => $prod_sku,
                'compititor_product_name' => $comp_prd_name[$key],
                'quantity' => $quantity[$key],
            );
            $this->db->insert('ecp_compititor_product_details', $distributor_compititor_prd_data);
        }

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_retailer_compititor_details_view($from_month, $to_month, $page = null, $local_date = null, $country_id, $web_service = null)
    {
        $sql = ' SELECT SQL_CALC_FOUND_ROWS ecat.compititor_analysis_total_id,ectd.compititor_total_details_id,ecat.created_on,ecat.compititor_analysis_month,mpgd.political_geography_name,bu.user_code,bu.display_name,ecm.compititor_name,ectd.amount ';
        $sql .= ' FROM bf_ecp_compititor_analysis_total AS ecat ';
        $sql .= ' JOIN bf_users AS bu ON (bu.id = ecat.coustomer_id) ';
        $sql .= ' JOIN bf_master_user_contact_details AS mucd ON (mucd.user_id = bu.id) ';
        $sql .= ' JOIN bf_master_political_geography_details AS mpgd ON (mpgd.political_geo_id = mucd.geo_level_id1) ';
        $sql .= ' JOIN bf_ecp_compititor_total_details AS ectd ON (ectd.compititor_analysis_total_id = ecat.compititor_analysis_total_id) ';
        $sql .= ' JOIN bf_ecp_compititor_master AS ecm ON (ecm.compititor_id = ectd.compititor_id) ';

        $sql .= 'WHERE 1 ';
        $sql .= 'AND ecat.country_id ="' . $country_id . '" ';
        $sql .= 'AND bu.role_id = 10 ';
        if (isset($from_month) && !empty($from_month) && isset($to_month) && !empty($to_month)) {
            $sql .= ' AND DATE_FORMAT(ecat.compititor_analysis_month,"%Y-%m") BETWEEN ' . '"' . $from_month . '"' . ' AND ' . '"' . $to_month . '"' . ' ';
        }
        $sql .= 'ORDER BY bu.display_name ASC ';

        if (!empty($web_service) && $web_service == 'web_service') {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page * $limit - $limit;
            $sql .= ' LIMIT ' . $offset . "," . $limit;
            $info = $this->db->query($sql);
            // For Pagination
            $retailer_analysis = $info->result_array();
            return $retailer_analysis;
        } else {
            $retailer_analysis = $this->grid->get_result_res($sql);

            if (isset($retailer_analysis['result']) && !empty($retailer_analysis['result'])) {
                $analysis['head'] = array('Sr. No.', 'Action', 'Entry Date', 'Month', 'Geo Level', 'Retailer Code', 'Retailer Name', 'Compititor Name', 'Amount');
                $analysis['count'] = count($analysis['head']);
                if ($page != null || $page != "") {
                    $i = (($page * 10) - 9);
                } else {
                    $i = 1;
                }
                foreach ($retailer_analysis['result'] as $rm) {

                    if ($local_date != null) {
                        $date3 = strtotime($rm['created_on']);
                        $entry_date = date($local_date, $date3);

                    } else {
                        $entry_date = $rm['created_on'];
                    }
                    $month = strtotime($rm['compititor_analysis_month']);
                    $month = date('F - Y', $month);

                    $amount = '<div class="amount_' . $rm["compititor_total_details_id"] . '"><span class="amount">' . $rm['amount'] . '</span></div>';

                    $analysis['row'][] = array($i, $rm['compititor_total_details_id'], $entry_date, $month, $rm['political_geography_name'], $rm['user_code'], $rm['display_name'], $rm['compititor_name'], $amount);
                    $i++;
                }
                $analysis['eye'] = '';
                $analysis['action'] = 'is_action';
                $analysis['edit'] = 'is_edit';
                $analysis['delete'] = 'is_delete';
                $analysis['pagination'] = $retailer_analysis['pagination'];
                return $analysis;
            } else {
                return false;
            }
        }
    }

    public function get_retailer_compititor_product_details_view($from_month, $to_month, $page = null, $local_date = null, $country_id, $web_service = null)
    {
        $sql = ' SELECT SQL_CALC_FOUND_ROWS ecap.compititor_analysis_product_id,ecpd.compititor_product_details_id,ecap.created_on,ecap.compititor_analysis_month,mpgd.political_geography_name,bu.user_code,bu.display_name,ecm.compititor_name,ecpd.compititor_product_name,ecpd.quantity,mpsc.product_sku_name ';
        $sql .= ' FROM bf_ecp_compititor_analysis_product AS ecap ';
        $sql .= ' JOIN bf_users AS bu ON (bu.id = ecap.coustomer_id) ';
        $sql .= ' JOIN bf_master_user_contact_details AS mucd ON (mucd.user_id = bu.id) ';
        $sql .= ' JOIN bf_master_political_geography_details AS mpgd ON (mpgd.political_geo_id = mucd.geo_level_id1) ';

        $sql .= ' JOIN bf_ecp_compititor_product_details AS ecpd ON (ecpd.compititor_analysis_product_id = ecap.compititor_analysis_product_id) ';
        $sql .= ' JOIN bf_ecp_compititor_master AS ecm ON (ecm.compititor_id = ecap.compititor_id) ';
        $sql .= ' JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_id = ecpd.product_sku_id) ';

        $sql .= 'WHERE 1 ';
        $sql .= 'AND ecap.country_id ="' . $country_id . '" ';
        $sql .= 'AND bu.role_id = 10 ';
        if (isset($from_month) && !empty($from_month) && isset($to_month) && !empty($to_month)) {
            $sql .= ' AND DATE_FORMAT(ecap.compititor_analysis_month,"%Y-%m") BETWEEN ' . '"' . $from_month . '"' . ' AND ' . '"' . $to_month . '"' . ' ';
        }
        $sql .= 'ORDER BY bu.display_name ASC ';

        if (!empty($web_service) && $web_service == 'web_service') {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page * $limit - $limit;
            $sql .= ' LIMIT ' . $offset . "," . $limit;
            $info = $this->db->query($sql);
            // For Pagination
            $retailer_analysis = $info->result_array();
            return $retailer_analysis;
        } else {
            $retailer_analysis = $this->grid->get_result_res($sql);

            if (isset($retailer_analysis['result']) && !empty($retailer_analysis['result'])) {
                $analysis['head'] = array('Sr. No.', 'Action', 'Entry Date', 'Month', 'Geo Level', 'Retailer Code', 'Retailer Name', 'Compititor Name', 'Compititor Product Name', 'Quantity', 'Our Product');
                $analysis['count'] = count($analysis['head']);
                if ($page != null || $page != "") {
                    $i = (($page * 10) - 9);
                } else {
                    $i = 1;
                }
                foreach ($retailer_analysis['result'] as $rm) {

                    if ($local_date != null) {
                        $date3 = strtotime($rm['created_on']);
                        $entry_date = date($local_date, $date3);

                    } else {
                        $entry_date = $rm['created_on'];
                    }
                    $month = strtotime($rm['compititor_analysis_month']);
                    $month = date('F - Y', $month);

                    $quantity = '<div class="quantity_' . $rm["compititor_product_details_id"] . '"><span class="quantity">' . $rm['quantity'] . '</span></div>';

                    $analysis['row'][] = array($i, $rm['compititor_product_details_id'], $entry_date, $month, $rm['political_geography_name'], $rm['user_code'], $rm['display_name'], $rm['compititor_name'], $rm['compititor_product_name'], $quantity, $rm['product_sku_name']);
                    $i++;
                }
                $analysis['eye'] = '';
                $analysis['action'] = 'is_action';
                $analysis['edit'] = 'is_edit';
                $analysis['delete'] = 'is_delete';
                $analysis['pagination'] = $retailer_analysis['pagination'];
                return $analysis;
            } else {
                return false;
            }
        }
    }


    public function get_distributor_compititor_details_view($from_month, $to_month, $page = null, $local_date = null, $country_id, $web_service = null)
    {
        $sql = ' SELECT SQL_CALC_FOUND_ROWS ecat.compititor_analysis_total_id,ectd.compititor_total_details_id,ecat.created_on,ecat.compititor_analysis_month,mpgd.political_geography_name,bu.user_code,bu.display_name,ecm.compititor_name,ectd.amount ';
        $sql .= ' FROM bf_ecp_compititor_analysis_total AS ecat ';
        $sql .= ' JOIN bf_users AS bu ON (bu.id = ecat.coustomer_id) ';
        $sql .= ' JOIN bf_master_user_contact_details AS mucd ON (mucd.user_id = bu.id) ';
        $sql .= ' JOIN bf_master_political_geography_details AS mpgd ON (mpgd.political_geo_id = mucd.geo_level_id1) ';
        $sql .= ' JOIN bf_ecp_compititor_total_details AS ectd ON (ectd.compititor_analysis_total_id = ecat.compititor_analysis_total_id) ';
        $sql .= ' JOIN bf_ecp_compititor_master AS ecm ON (ecm.compititor_id = ectd.compititor_id) ';

        $sql .= 'WHERE 1 ';
        $sql .= 'AND ecat.country_id ="' . $country_id . '" ';
        $sql .= 'AND bu.role_id = 9 ';
        if (isset($from_month) && !empty($from_month) && isset($to_month) && !empty($to_month)) {
            $sql .= ' AND DATE_FORMAT(ecat.compititor_analysis_month,"%Y-%m") BETWEEN ' . '"' . $from_month . '"' . ' AND ' . '"' . $to_month . '"' . ' ';
        }
        $sql .= 'ORDER BY bu.display_name ASC ';

        if (!empty($web_service) && $web_service == 'web_service') {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page * $limit - $limit;
            $sql .= ' LIMIT ' . $offset . "," . $limit;
            $info = $this->db->query($sql);
            // For Pagination
            $distributor_analysis = $info->result_array();
            return $distributor_analysis;
        } else {
            $distributor_analysis = $this->grid->get_result_res($sql);

            if (isset($distributor_analysis['result']) && !empty($distributor_analysis['result'])) {
                $analysis['head'] = array('Sr. No.', 'Action', 'Entry Date', 'Month', 'Geo Level', 'Distributor Code', 'Distributor Name', 'Compititor Name', 'Amount');
                $analysis['count'] = count($analysis['head']);
                if ($page != null || $page != "") {
                    $i = (($page * 10) - 9);
                } else {
                    $i = 1;
                }
                foreach ($distributor_analysis['result'] as $rm) {

                    if ($local_date != null) {
                        $date3 = strtotime($rm['created_on']);
                        $entry_date = date($local_date, $date3);

                    } else {
                        $entry_date = $rm['created_on'];
                    }
                    $month = strtotime($rm['compititor_analysis_month']);
                    $month = date('F - Y', $month);

                    $amount = '<div class="amount_' . $rm["compititor_total_details_id"] . '"><span class="amount">' . $rm['amount'] . '</span></div>';

                    $analysis['row'][] = array($i, $rm['compititor_total_details_id'], $entry_date, $month, $rm['political_geography_name'], $rm['user_code'], $rm['display_name'], $rm['compititor_name'], $amount);
                    $i++;
                }
                $analysis['eye'] = '';
                $analysis['action'] = 'is_action';
                $analysis['edit'] = 'is_edit';
                $analysis['delete'] = 'is_delete';
                $analysis['pagination'] = $distributor_analysis['pagination'];
                //testdata($analysis);
                return $analysis;
            } else {
                return false;
            }
        }

    }


    public function get_distributor_compititor_product_details_view($from_month, $to_month, $page = null, $local_date = null, $country_id, $web_service = null)
    {
        $sql = ' SELECT SQL_CALC_FOUND_ROWS ecap.compititor_analysis_product_id,ecpd.compititor_product_details_id,ecap.created_on,ecap.compititor_analysis_month,mpgd.political_geography_name,bu.user_code,bu.display_name,ecm.compititor_name,ecpd.compititor_product_name,ecpd.quantity,mpsc.product_sku_name ';
        $sql .= ' FROM bf_ecp_compititor_analysis_product AS ecap ';
        $sql .= ' JOIN bf_users AS bu ON (bu.id = ecap.coustomer_id) ';
        $sql .= ' JOIN bf_master_user_contact_details AS mucd ON (mucd.user_id = bu.id) ';
        $sql .= ' JOIN bf_master_political_geography_details AS mpgd ON (mpgd.political_geo_id = mucd.geo_level_id1) ';

        $sql .= ' JOIN bf_ecp_compititor_product_details AS ecpd ON (ecpd.compititor_analysis_product_id = ecap.compititor_analysis_product_id) ';
        $sql .= ' JOIN bf_ecp_compititor_master AS ecm ON (ecm.compititor_id = ecap.compititor_id) ';
        $sql .= ' JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_id = ecpd.product_sku_id) ';

        $sql .= 'WHERE 1 ';
        $sql .= 'AND ecap.country_id ="' . $country_id . '" ';
        $sql .= 'AND bu.role_id = 9 ';
        if (isset($from_month) && !empty($from_month) && isset($to_month) && !empty($to_month)) {
            $sql .= ' AND DATE_FORMAT(ecap.compititor_analysis_month,"%Y-%m") BETWEEN ' . '"' . $from_month . '"' . ' AND ' . '"' . $to_month . '"' . ' ';
        }
        $sql .= 'ORDER BY bu.display_name ASC ';
        if (!empty($web_service) && $web_service == 'web_service') {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page * $limit - $limit;
            $sql .= ' LIMIT ' . $offset . "," . $limit;
            $info = $this->db->query($sql);
            // For Pagination
            $distributor_analysis = $info->result_array();
            return $distributor_analysis;
        } else {
            $distributor_analysis = $this->grid->get_result_res($sql);

            if (isset($distributor_analysis['result']) && !empty($distributor_analysis['result'])) {
                $analysis['head'] = array('Sr. No.', 'Action', 'Entry Date', 'Month', 'Geo Level', 'Distributor Code', 'Distributor Name', 'Compititor Name', 'Compititor Product Name', 'Quantity', 'Our Product');
                $analysis['count'] = count($analysis['head']);
                if ($page != null || $page != "") {
                    $i = (($page * 10) - 9);
                } else {
                    $i = 1;
                }
                foreach ($distributor_analysis['result'] as $rm) {

                    if ($local_date != null) {
                        $date3 = strtotime($rm['created_on']);
                        $entry_date = date($local_date, $date3);

                    } else {
                        $entry_date = $rm['created_on'];
                    }
                    $month = strtotime($rm['compititor_analysis_month']);
                    $month = date('F - Y', $month);

                    $quantity = '<div class="quantity_' . $rm["compititor_product_details_id"] . '"><span class="quantity">' . $rm['quantity'] . '</span></div>';

                    $analysis['row'][] = array($i, $rm['compititor_product_details_id'], $entry_date, $month, $rm['political_geography_name'], $rm['user_code'], $rm['display_name'], $rm['compititor_name'], $rm['compititor_product_name'], $quantity, $rm['product_sku_name']);
                    $i++;
                }
                $analysis['eye'] = '';
                $analysis['action'] = 'is_action';
                $analysis['edit'] = 'is_edit';
                $analysis['delete'] = 'is_delete';
                $analysis['pagination'] = $distributor_analysis['pagination'];
                return $analysis;
            } else {
                return false;
            }
        }

    }

    public function update_compititor_details($web_service = null)
    {
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {

            $id = explode(',', $this->input->post("id"));
            $amount = explode(',', $this->input->post("amount"));

        } else {
            $id = $this->input->post("id");
            $amount = $this->input->post("amount");
        }

        $update_array= array();
        foreach ($id as $k => $val_id) {
            $retailer_compititor_update = array(
                'amount' => (isset($amount[$k]) && !empty($amount[$k])) ? $amount[$k] : '0',
            );
           // testdata($retailer_compititor_update);
            $this->db->where('compititor_total_details_id', $val_id);
            $this->db->update('ecp_compititor_total_details', $retailer_compititor_update);
            if ($this->db->affected_rows() > 0) {
                $update_array[]=1;
            }
        }
        if(in_array(1,$update_array))
        {
            return 1;
        }
        else{
            return 0;
        }
    }

    public function update_compititor_product_details($web_service = null)
    {
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {

            $id = explode(',', $this->input->post("id"));
            $quantity = explode(',', $this->input->post("quantity"));

        } else {

            $id = $this->input->post("id");
            $quantity = $this->input->post("quantity");
        }
        $update_array= array();
        foreach ($id as $k => $val_id) {
            $retailer_compititor_product_update = array(
                'quantity' => (isset($quantity[$k]) && !empty($quantity[$k])) ? $quantity[$k] : '0',
            );

            $this->db->where('compititor_product_details_id', $val_id);
            $this->db->update('ecp_compititor_product_details', $retailer_compititor_product_update);
            if ($this->db->affected_rows() > 0) {
                $update_array[]=1;
            }
        }
        if(in_array(1,$update_array))
        {
            return 1;
        }
        else{
            return 0;
        }


    }

    public function delete_compititor_details($id)
    {
        $this->db->select('compititor_analysis_total_id');
        $this->db->from('ecp_compititor_total_details');
        $this->db->where('compititor_total_details_id', $id);
        $compititor_id = $this->db->get()->row_array();
        if (isset($compititor_id) && !empty($compititor_id)) {
            $this->db->select('*');
            $this->db->from('bf_ecp_compititor_total_details');
            $this->db->where('compititor_analysis_total_id', $compititor_id['compititor_analysis_total_id']);
            $query = $this->db->get();
            $rowcount = $query->num_rows();

            if ($rowcount > 1) {
                $this->db->where('compititor_total_details_id', $id);
                $this->db->delete('ecp_compititor_total_details');
            } else {
                $this->db->where('compititor_total_details_id', $id);
                $this->db->delete('ecp_compititor_total_details');

                $this->db->where('compititor_analysis_total_id', $compititor_id['compititor_analysis_total_id']);
                $this->db->delete('ecp_compititor_analysis_total');
            }
        }
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete_compititor_product_details($id)
    {
        $this->db->select('compititor_analysis_product_id');
        $this->db->from('ecp_compititor_product_details');
        $this->db->where('compititor_product_details_id', $id);
        $compititor_id = $this->db->get()->row_array();
        if (isset($compititor_id) && !empty($compititor_id)) {
            $this->db->select('*');
            $this->db->from('ecp_compititor_product_details');
            $this->db->where('compititor_analysis_product_id', $compititor_id['compititor_analysis_product_id']);
            $query = $this->db->get();
            $rowcount = $query->num_rows();

            if ($rowcount > 1) {
                $this->db->where('compititor_product_details_id', $id);
                $this->db->delete('ecp_compititor_product_details');
            } else {
                $this->db->where('compititor_product_details_id', $id);
                $this->db->delete('ecp_compititor_product_details');

                $this->db->where('compititor_analysis_product_id', $compititor_id['compititor_analysis_product_id']);
                $this->db->delete('ecp_compititor_analysis_product');
            }
        }
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function all_reason_noworking_details($country_id)
    {
        $this->db->select('reason_country_id,reason_country_name');
        $this->db->from('ecp_noworking_reason_master_country');
        $this->db->where('country_id', $country_id);
        $this->db->where('status', '1');
        $this->db->where('deleted', '0');
        $reason = $this->db->get()->result_array();
        if (isset($reason) && !empty($reason)) {
            return $reason;
        } else {
            return false;
        }
    }

    public function all_no_working_details($user_id, $country_id, $web_service = null,$cur_month=null)
    {
        if (isset($web_service) && !empty($web_service) && $web_service == 'web_service') {
            $this->db->select('no_working_id,no_working_date,reason_country_id,employee_id,other_reason');
        } else {
            $this->db->select('no_working_date');
        }
        $this->db->from('ecp_no_wokring');
        $this->db->where('country_id', $country_id);
        $this->db->where('employee_id', $user_id);
        if (!isset($web_service) && empty($web_service) && $web_service != 'web_service') {
            $this->db->where('DATE_FORMAT(no_working_date,"%c")', $cur_month);
        }
        $this->db->where('status', '1');
        $no_working_details = $this->db->get()->result_array();

        if (isset($no_working_details) && !empty($no_working_details)) {
            return $no_working_details;
        } else {
            return false;
        }
    }

    public function all_leave_details($user_id, $country_id, $web_service = null,$cur_month=null)
    {
        if (isset($web_service) && !empty($web_service) && $web_service == 'web_service') {
            $this->db->select('leave_id,leave_date,leave_type_country_id,employee_id');
        } else {
            $this->db->select('leave_date');
        }
        $this->db->from('ecp_leave');
        $this->db->where('country_id', $country_id);
        $this->db->where('employee_id', $user_id);
        if (!isset($web_service) && empty($web_service) && $web_service != 'web_service') {
            $this->db->where('DATE_FORMAT(leave_date,"%c")', $cur_month);
        }
        $this->db->where('status', '1');
        $leave_details = $this->db->get()->result_array();

        if (isset($leave_details) && !empty($leave_details)) {
            return $leave_details;
        } else {
            return false;
        }
    }


    public function all_leave_type_details($country_id)
    {
        $this->db->select('leave_type_country_id,short_code');
        $this->db->from('ecp_leave_type_master_country');
        $this->db->where('country_id', $country_id);
        $this->db->where('status', '1');
        $this->db->where('deleted', '0');
        $leave_type = $this->db->get()->result_array();
        if (isset($leave_type) && !empty($leave_type)) {
            return $leave_type;
        } else {
            return false;
        }
    }


    public function add_no_working_details($user_id, $country_id)
    {
        $cur_date = $this->input->post("cur_date");
        $radio = $this->input->post("radio");
        $oth_reason = $this->input->post("oth_reason");

        $date = str_replace('/', '-', $cur_date);
        $no_working_date = date('Y-m-d', strtotime($date));

        $no_work_date = $this->no_working_details($user_id, $country_id, $no_working_date);

        if ($no_work_date == 0) {

            $no_working_details = array(
                'no_working_date' => $no_working_date,
                'reason_country_id' => $radio,
                'employee_id' => $user_id,
                'other_reason' => $oth_reason,
                'country_id' => $country_id,
                'status' => '1',
                'created_by_user' => $user_id,
                'created_on' => date('Y-m-d H:i:s')
            );

            $this->db->insert('ecp_no_wokring', $no_working_details);
        } else {

            $no_working_details = array(

                'no_working_date' => $no_working_date,
                'reason_country_id' => $radio,
                'employee_id' => $user_id,
                'other_reason' => $oth_reason,
                'country_id' => $country_id,
                'status' => '1',
                'modified_by_user' => $user_id,
                'modified_on' => date('Y-m-d H:i:s')
            );
            $this->db->where('no_working_id', $no_work_date['no_working_id']);
            $this->db->update('ecp_no_wokring', $no_working_details);
        }


        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }


    public function no_working_details($user_id, $country_id, $cur_date)
    {
        $this->db->select('*');
        $this->db->from('ecp_no_wokring');
        $this->db->where('employee_id', $user_id);
        $this->db->where('no_working_date', $cur_date);
        $this->db->where('country_id', $country_id);
        $this->db->where('status', '1');
        $user_details = $this->db->get()->row_array();
        if (isset($user_details) && !empty($user_details)) {
            return $user_details;
        } else {
            return 0;
        }
    }

    public function add_leave_details($user_id, $country_id)
    {
        $cur_date = $this->input->post("cur_date");
        $radio = $this->input->post("radio");

        $date = str_replace('/', '-', $cur_date);
        $leave_date = date('Y-m-d', strtotime($date));

        $leave_type = $this->leave_type_details($user_id, $country_id, $leave_date);

        if ($leave_type == 0) {

            $leave_details = array(
                'leave_date' => $leave_date,
                'leave_type_country_id' => $radio,
                'employee_id' => $user_id,
                'country_id' => $country_id,
                'status' => '1',
                'created_by_user' => $user_id,
                'created_on' => date('Y-m-d H:i:s')
            );

            $this->db->insert('ecp_leave', $leave_details);
        } else {

            $leave_details = array(

                'leave_date' => $leave_date,
                'leave_type_country_id' => $radio,
                'employee_id' => $user_id,
                'country_id' => $country_id,
                'status' => '1',
                'modified_by_user' => $user_id,
                'modified_on' => date('Y-m-d H:i:s')
            );
            $this->db->where('leave_id', $leave_type['leave_id']);
            $this->db->update('ecp_leave', $leave_details);
        }


        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function leave_type_details($user_id, $country_id, $leave_date)
    {
        $this->db->select('*');
        $this->db->from('ecp_leave');
        $this->db->where('employee_id', $user_id);
        $this->db->where('leave_date', $leave_date);
        $this->db->where('country_id', $country_id);
        $this->db->where('status', '1');
        $user_details = $this->db->get()->row_array();
        if (isset($user_details) && !empty($user_details)) {
            return $user_details;
        } else {
            return 0;
        }
    }

    public function delete_leave_detail($leave_id)
    {
        $this->db->where('leave_id', $leave_id);
        $this->db->delete('ecp_leave');

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete_no_working_detail($id)
    {
        $this->db->where('no_working_id', $id);
        $this->db->delete('ecp_no_wokring');

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }


    public function activity_type_details($country_id)
    {
        $this->db->select('activity_type_country_id,activity_type_code,activity_type_country_name');
        $this->db->from('bf_ecp_activity_master_country');
        $this->db->where('country_id', $country_id);
        $this->db->where('status', '1');
        $this->db->where('deleted', '0');
        $activity_type = $this->db->get()->result_array();
        // testdata($activity_type);
        if (isset($activity_type) && !empty($activity_type)) {
            return $activity_type;
        } else {
            return 0;
        }
    }

    public function get_customer_type_geo_data($radio_checked, $country_id, $user_id, $parent_id = null, $second_perent = null)
    {

        $sub_query = "";
        if ($radio_checked == 11) {

            if ($parent_id == null) {
                $query2_select = ' `bmpgd2`.`parent_geo_id`  ';
                $select_data = " bmpgd.parent_geo_id ";
            } elseif ($parent_id != null && $second_perent == 'second_perent') {
                $query2_select = ' `bmpgd2`.`political_geo_id`,bmpgd2.political_geography_name  ';
                $select_data = " bmpgd2.political_geo_id";
            } else {
                $query2_select = ' `bmpgd`.`political_geo_id`,bmpgd.political_geography_name  ';
                $select_data = ' `bmpgd`.`political_geo_id`,bmpgd.political_geography_name  ';
            }
        }

        if ($radio_checked == 10) {

            if ($parent_id != null) {
                $query2_select = ' `bmpgd2`.`political_geo_id`,`bmpgd2`.`political_geography_name`,
`bmpgd2`.`parent_geo_id` ';
                $select_data = " bmpgd.political_geo_id, bmpgd.political_geography_name ";
            } else {
                $query2_select = ' `bmpgd2`.`political_geo_id`,`bmpgd2`.`political_geography_name`,
`bmpgd2`.`parent_geo_id` ';
                $select_data = " bmpgd.parent_geo_id ";
            }

        }

        $query1 = 'SELECT `bmpgd3`.`political_geo_id`,`bmpgd3`.`political_geography_name`, `bmpgd3`.`parent_geo_id` FROM  `bf_master_political_geography_details` as bmpgd3 WHERE bmpgd3.political_geo_id IN ( ';

        $query1_end = " ) ";

        $query2 = 'SELECT ' . $query2_select . '  FROM `bf_master_political_geography_details` as bmpgd2
where `political_geo_id` IN ( ';

        $query2_end = " ) ";


        if ($radio_checked == 11) {

            if ($parent_id != null && $second_perent == 'second_perent') {
                $sub_query = " AND bmpgd2.parent_geo_id = $parent_id ";

                $subquery1 = $query2 . " SELECT  " . $select_data . " FROM (`bf_master_employe_to_customer` as etc)
                    JOIN `bf_users` as bu ON `bu`.`id` = `etc`.`customer_id` ";

                $where1 = " `etc`.`employee_id` = " . $user_id;
                $where2 = " AND YEAR(etc.year) = '" . date("Y") . "' AND ";
                $where3 = "";
            } elseif ($parent_id != null && $second_perent == null) {
                $sub_query = " AND bmpgd.parent_geo_id = $parent_id ";
                $subquery1 = " SELECT  " . $select_data . " FROM (`bf_master_employe_to_customer` as etc)
                    JOIN `bf_users` as bu ON `bu`.`id` = `etc`.`customer_id` ";

                $where1 = " `etc`.`employee_id` = " . $user_id;
                $where2 = " AND YEAR(etc.year) = '" . date("Y") . "' AND ";
                $where3 = "";
            } else {
                $subquery1 = $query1 . $query2 . " SELECT  " . $select_data . " FROM (`bf_master_employe_to_customer` as etc)
                    JOIN `bf_users` as bu ON `bu`.`id` = `etc`.`customer_id` ";

                $where1 = " `etc`.`employee_id` = " . $user_id;
                $where2 = " AND YEAR(etc.year) = '" . date("Y") . "' AND ";
                $where3 = "";
            }

        }

        if ($radio_checked == 10) {

            if ($parent_id != null) {
                $subquery1 = " SELECT  " . $select_data . " FROM (`bf_master_employe_to_customer` as etc)
                    JOIN `bf_users` as bu ON `bu`.`id` = `etc`.`customer_id` ";

                $where1 = " `etc`.`employee_id` = " . $user_id;
                $where2 = " AND YEAR(etc.year) = '" . date("Y") . "' AND ";
                $where3 = "";
            } else {
                $subquery1 = $query2 . " SELECT  " . $select_data . " FROM (`bf_master_employe_to_customer` as etc)
                    JOIN `bf_users` as bu ON `bu`.`id` = `etc`.`customer_id` ";

                $where1 = " `etc`.`employee_id` = " . $user_id;
                $where2 = " AND YEAR(etc.year) = '" . date("Y") . "' AND ";
                $where3 = "";
            }

        }

        $query1 = $subquery1 . " JOIN `bf_master_user_contact_details` as bmucd ON `bmucd`.`user_id` = `bu`.`id`
JOIN `bf_master_political_geography_details` as bmpgd ON `bmpgd`.`political_geo_id` = `bmucd`.`geo_level_id1`

WHERE " . $where1 . " " . $where2 . " " . $where3 . "

`bu`.`role_id` = " . $radio_checked . "
AND `bu`.`type` = 'Customer'
AND `bu`.`deleted` = '0'
AND `bu`.`country_id` = '" . $country_id . "' " . $sub_query;

        if ($radio_checked == 11) {
            if ($parent_id != null && $second_perent == 'second_perent') {
                $query1 .= " GROUP BY `bmpgd`.`political_geography_name` " . $query1_end;
            } elseif ($parent_id != null && $second_perent == null) {
                $query1 .= " GROUP BY `bmpgd`.`political_geography_name` ";
            } else {
                $query1 .= " GROUP BY `bmpgd`.`political_geography_name` " . $query1_end . $query2_end;
            }
        }

        if ($radio_checked == 10) {
            if ($parent_id != null && $second_perent == null) {
                $query1 .= " GROUP BY `bmpgd`.`political_geography_name` ";
            }
           /* elseif ($parent_id != null && $second_perent != null) {
                $query1 .= " GROUP BY `bmpgd`.`political_geography_name` ";
            }*/
            else {
                $query1 .= " GROUP BY `bmpgd`.`political_geography_name` " . $query1_end;
            }
        }

        $query = $this->db->query($query1);
        $geo_loc_data = $query->result_array();
        // echo $this->db->last_query();

        return $geo_loc_data;
    }

    public function crop_details_by_country_id($country_id)
    {
        $this->db->select('crop_country_id,crop_name');
        $this->db->from('bf_master_crop_country');
        $this->db->where('country_id', $country_id);
        $this->db->where('status', '1');
        $this->db->where('deleted', '0');
        $crop = $this->db->get()->result_array();
        // testdata($crop);
        if (isset($crop) && !empty($crop)) {
            return $crop;
        } else {
            return 0;
        }
    }

    public function get_diseases_by_user_id($country_id)
    {
        $this->db->select('disease_country_id,disease_name');
        $this->db->from('bf_master_disease_country');
        $this->db->where('country_id', $country_id);
        $this->db->where('status', '1');
        $this->db->where('deleted', '0');
        $disease = $this->db->get()->result_array();
        if (isset($disease) && !empty($disease)) {
            return $disease;
        } else {
            return 0;
        }
    }

    public function get_KeyFarmer_by_user_id($user_id,$country_id)
    {
        $this->db->select('bu.id,bu.display_name,mucd.primary_mobile_no');
        $this->db->from('bf_master_employe_to_customer as metc');
        $this->db->join('users as bu', 'bu.id=metc.customer_id');
        $this->db->join('master_user_contact_details as mucd', 'mucd.user_id = bu.id');
        $this->db->where('bu.country_id', $country_id);
        $this->db->where('employee_id', $user_id);
        $this->db->where('bu.role_id', '11');
        $this->db->where('DATE_FORMAT(metc.year,"%Y")', date('Y'));
        $this->db->where('metc.status', '1');
        $this->db->where('metc.deleted', '0');
        $farmer = $this->db->get()->result_array();

        if (isset($farmer) && !empty($farmer)) {
            return $farmer;
        } else {
            return 0;
        }
    }

    public function get_KeyRetailer_by_user_id($user_id,$country_id)
    {
        $this->db->select('bu.id,bu.display_name,mucd.primary_mobile_no');
        $this->db->from('bf_master_employe_to_customer as metc');
        $this->db->join('users as bu', 'bu.id=metc.customer_id');
        $this->db->join('master_user_contact_details as mucd', 'mucd.user_id = bu.id');
        $this->db->where('bu.country_id', $country_id);
        $this->db->where('employee_id', $user_id);
        $this->db->where('bu.role_id', '10');
        $this->db->where('DATE_FORMAT(metc.year,"%Y")', date('Y'));
        $this->db->where('metc.status', '1');
        $this->db->where('metc.deleted', '0');
        $retailer = $this->db->get()->result_array();
        if (isset($retailer) && !empty($retailer)) {
            return $retailer;
        } else {
            return 0;
        }
    }

    public function get_mobile_number_by_farmer_id($farmer_id)
    {
        $this->db->select('primary_mobile_no');
        $this->db->from('master_user_contact_details as mucd');
        $this->db->where('user_id', $farmer_id);
        $farmer_mo = $this->db->get()->row_array();

        if (isset($farmer_mo) && !empty($farmer_mo)) {
            return $farmer_mo;
        } else {
            return 0;
        }
    }

    public function getDigitalLibraryDataByCountry($activity_type_id, $country_id)
    {
        $this->db->select('digital_library_id,library_name,link');
        $this->db->from('ecp_digital_library_master');
        $this->db->where('activity_type_id', $activity_type_id);
        $this->db->where('country_id', $country_id);
        $digital = $this->db->get()->result_array();
        if (isset($digital) && !empty($digital)) {
            return $digital;
        } else {
            return 0;
        }
    }

    /* Get Junior Data */
    public function get_jr_employee_for_loginuser($login_user_id,&$global_jr_user)
    {
        $u_data = $this->get_user_junior_data($login_user_id);

        if($u_data != 0 && count($u_data)>0)
        {
            foreach($u_data as $ud)
            {
                $global_jr_user[] = $ud;
                $login_user_id = $ud['user_id'];
                $this->get_jr_employee_for_loginuser($login_user_id,$global_jr_user);
            }
            return $global_jr_user;
        }
        else
        {
            return $global_jr_user;
        }

    }

    public function get_user_junior_data($user_id)
    {
        $this->db->select("bu.id,bu.display_name,bmerp.user_id");
        $this->db->from("bf_master_employee_reporting_person as bmerp");
        $this->db->join("bf_users as bu", 'bu.id = bmerp.user_id');
        $this->db->where("bmerp.reporting_user_id", $user_id);
        $this->db->where("bmerp.to_date", NULL);
        $user_level_data = $this->db->get()->result_array();
        /*echo $this->db->last_query();
        echo "<br/>";*/

        if (isset($user_level_data) && !empty($user_level_data)) {
            return $user_level_data;
        } else {
            return 0;
        }
    }
    /* Get Junior Data */


    public function get_employee_for_loginuser($login_user_id,&$global_head_user)
    {

        $u_data = $this->get_user_parent_data($login_user_id);

        if ($u_data != 0) {
            $global_head_user[] = $u_data[0];
            $login_user_id = $u_data[0]['reporting_user_id'];
            return $this->get_employee_for_loginuser($login_user_id,$global_head_user);
        } else {
          //  $global_head_user[] = $login_user_id;
            return $global_head_user;
        }

    }

    public function get_user_parent_data($freeze_user_id)
    {
        $this->db->select("bu.id,bu.display_name,bmerp.reporting_user_id");
        $this->db->from("bf_master_employee_reporting_person as bmerp");
        $this->db->join("bf_users as bu", 'bu.id = bmerp.reporting_user_id');
        $this->db->where("bmerp.user_id", $freeze_user_id);
        $this->db->where("bmerp.to_date", NULL);
        $user_level_data = $this->db->get()->result_array();

        if (isset($user_level_data) && !empty($user_level_data)) {
            return $user_level_data;
        } else {
            return 0;
        }
    }

    public function all_activity_planning_details($user_id, $country_id, $web_service = null,$cur_month=null,$cur_year=null)
    {
        if (isset($web_service) && !empty($web_service) && $web_service == 'web_service') {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id,eap.status');
        } else {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_id,eap.status');
        }
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('ecp_activity_master_country as eamc','eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->join('master_political_geography_details as mpgd','mpgd.political_geo_id = eap.geo_level_id');

        $this->db->where('eap.country_id', $country_id);
        $this->db->where('eap.employee_id', $user_id);

        $this->db->where('eap.status != ','4');
        $this->db->where('eap.status != ','5');

        $this->db->where('DATE_FORMAT(eap.activity_planning_date,"%c")', $cur_month);
        $this->db->where('DATE_FORMAT(eap.activity_planning_date,"%Y")', $cur_year);


        $this->db->order_by('activity_planning_time','ASC');
        $activity_details = $this->db->get()->result_array();

        if (isset($activity_details) && !empty($activity_details)) {
            return $activity_details;
        } else {
            return false;
        }
    }

    public function all_activity_planning($user_id, $country_id, $web_service = null,$cur_month=null,$cur_year=null)
    {
        if (isset($web_service) && !empty($web_service) && $web_service == 'web_service') {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id,eap.status');
        } else {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id,eap.status');
        }
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('ecp_activity_master_country as eamc','eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->join('master_political_geography_details as mpgd','mpgd.political_geo_id = eap.geo_level_id');

        $this->db->where('eap.country_id', $country_id);
        $this->db->where('eap.employee_id', $user_id);

        $this->db->where('eap.status != ','4');
        $this->db->where('eap.status != ','5');

        $this->db->where('DATE_FORMAT(eap.activity_planning_date,"%c")', $cur_month);
        $this->db->where('DATE_FORMAT(eap.activity_planning_date,"%Y")', $cur_year);

        $this->db->order_by('eap.activity_planning_time', 'ASC');

        $activity_details = $this->db->get()->result_array();

       // testdata($activity_details);

        if (isset($activity_details) && !empty($activity_details)) {

            if(isset($web_service) && !empty($web_service) && $web_service == 'web_service')
            {
                $date_array = array();

                foreach ($activity_details as $k => $val)
                {
                    $date_array[$val["activity_planning_date"]][] = $val;
                }

                $date_array = array_values($date_array);

                return $date_array;
            }
            else{
                $date_array = array();

                foreach ($activity_details as $k => $val)
                {
                    $date_array[$val["activity_planning_date"]][] = $val;
                }

                //  testdata($date_array);
                return $date_array;
            }

        } else {
            return false;
        }
    }


    public function all_activity_execution_details($user_id, $country_id, $web_service = null,$cur_month=null,$cur_year=null)
    {
        if (isset($web_service) && !empty($web_service) && $web_service == 'web_service') {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id');
        } else {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_id,eap.status');
           // $this->db->select('*');
        }
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('ecp_activity_master_country as eamc','eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->join('master_political_geography_details as mpgd','mpgd.political_geo_id = eap.geo_level_id');

        $this->db->where('eap.country_id', $country_id);
        $this->db->where('eap.employee_id', $user_id);
        $this->db->where('eap.status','2');

        $this->db->where('DATE_FORMAT(eap.activity_planning_date,"%Y")',$cur_year);
        $this->db->where('DATE_FORMAT(eap.activity_planning_date,"%c")',$cur_month);

        $this->db->order_by('eap.activity_planning_time','ASC');
        $activity_details = $this->db->get()->result_array();
      //  echo $this->db->last_query();

        if (isset($activity_details) && !empty($activity_details)) {
            return $activity_details;
        } else {
            return false;
        }
    }

    public function all_activity_execution($user_id, $country_id, $web_service = null,$cur_month=null,$cur_year=null)
    {
        if (isset($web_service) && !empty($web_service) && $web_service == 'web_service') {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id');
        } else {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id');
        }
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('ecp_activity_master_country as eamc','eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->join('master_political_geography_details as mpgd','mpgd.political_geo_id = eap.geo_level_id');

        $this->db->where('eap.country_id', $country_id);
        $this->db->where('eap.employee_id', $user_id);
        $this->db->where('DATE_FORMAT(eap.activity_planning_date,"%Y-%m-%d") >', date('Y-m-d'));

        $this->db->where('DATE_FORMAT(eap.activity_planning_date,"%c")', $cur_month);
        $this->db->where('DATE_FORMAT(eap.activity_planning_date,"%Y")', $cur_year);

        $this->db->where('eap.status','2');

        $this->db->order_by('eap.activity_planning_time', 'ASC');

        $activity_details = $this->db->get()->result_array();



        if (isset($activity_details) && !empty($activity_details)) {

            if(isset($web_service) && !empty($web_service) && $web_service == 'web_service')
            {
                $date_array = array();

                foreach ($activity_details as $k => $val)
                {
                    $date_array[$val["activity_planning_date"]][] = $val;
                }

                $date_array = array_values($date_array);

                return $date_array;
            }
            else{
                $date_array = array();

                foreach ($activity_details as $k => $val)
                {
                    $date_array[$val["activity_planning_date"]][] = $val;
                }

                //  testdata($date_array);
                return $date_array;
            }

        } else {
            return false;
        }
    }

    public function all_missed_activity($user_id, $country_id, $web_service = null,$cur_month=null,$cur_year=null)
    {
        if (isset($web_service) && !empty($web_service) && $web_service == 'web_service') {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id');
        } else {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id');
        }
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('ecp_activity_master_country as eamc','eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->join('master_political_geography_details as mpgd','mpgd.political_geo_id = eap.geo_level_id');

        $this->db->where('eap.country_id', $country_id);
        $this->db->where('eap.employee_id', $user_id);
        $this->db->where('eap.activity_planning_date <', date('Y-m-d'));
       /* $this->db->where('DATE_FORMAT(eap.activity_planning_date,"%Y") <',  '"'.$cur_year.'"');*/
        $this->db->where('eap.status','2');

        $this->db->order_by('eap.activity_planning_time', 'ASC');

        $activity_details = $this->db->get()->result_array();
        //echo $this->db->last_query();
         //testdata($activity_details);

        if (isset($activity_details) && !empty($activity_details)) {

            if(isset($web_service) && !empty($web_service) && $web_service == 'web_service')
            {
                $date_array = array();

                foreach ($activity_details as $k => $val)
                {
                    $date_array[$val["activity_planning_date"]][] = $val;
                }

                $date_array = array_values($date_array);

                return $date_array;
            }
            else{
                $date_array = array();

                foreach ($activity_details as $k => $val)
                {
                    $date_array[$val["activity_planning_date"]][] = $val;
                }

                //  testdata($date_array);
                return $date_array;
            }

        } else {
            return false;
        }
    }


    public function all_current_activity($user_id, $country_id, $web_service = null,$cur_month=null,$cur_year=null)
    {
        if (isset($web_service) && !empty($web_service) && $web_service == 'web_service') {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id');
        } else {
            $this->db->select('eap.activity_planning_date,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id');
        }
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('ecp_activity_master_country as eamc','eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->join('master_political_geography_details as mpgd','mpgd.political_geo_id = eap.geo_level_id');

        $this->db->where('eap.country_id', $country_id);
        $this->db->where('eap.employee_id', $user_id);
        $this->db->where('eap.activity_planning_date', date('Y-m-d'));
        $this->db->where('eap.status','2');

        $this->db->order_by('eap.activity_planning_time', 'ASC');

        $activity_details = $this->db->get()->result_array();

        if (isset($activity_details) && !empty($activity_details)) {

            if(isset($web_service) && !empty($web_service) && $web_service == 'web_service')
            {
                $date_array = array();

                foreach ($activity_details as $k => $val)
                {
                    $date_array[$val["activity_planning_date"]][] = $val;
                }

                $date_array = array_values($date_array);

                return $date_array;
            }
            else{
                $date_array = array();

                foreach ($activity_details as $k => $val)
                {
                    $date_array[$val["activity_planning_date"]][] = $val;
                }

                //  testdata($date_array);
                return $date_array;
            }

        } else {
            return false;
        }
    }

    public function check_planning_date_in_leaves($user_id, $country_id,$plannin_date)
    {

        $p_date = str_replace('/', '-', $plannin_date);
        $planning_date = date('Y-m-d', strtotime($p_date));

        $this->db->select("*");
        $this->db->from("ecp_leave");
        $this->db->where("employee_id",$user_id);
        $this->db->where("country_id",$country_id);
        $this->db->where("leave_date", $planning_date);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        if ($rowcount > 0) {
            return 1;
        } else {
            $this->db->select("*");
            $this->db->from("ecp_no_wokring");
            $this->db->where("employee_id",$user_id);
            $this->db->where("country_id",$country_id);
            $this->db->where("no_working_date", $planning_date);
            $query = $this->db->get();
            $rowcount = $query->num_rows();

        }
        if ($rowcount > 0) {
            return 1;
        }
        else{
            return 0;
        }
    }


    public function addActivityPlanning($user_id,$country_id,$web_service=null)
    {
        $activity_planning_id = $this->input->post("inserted_activity_planning_id");
        $activity_type_id = $this->input->post("activity_type_id");
        $geo_level_4 = $this->input->post("geo_level_4");
        $geo_level_3 = $this->input->post("geo_level_3");
        $geo_level_2 = $this->input->post("geo_level_2");
        if(isset($geo_level_4) && !empty($geo_level_4))
        {
            $geo_level = $geo_level_4;
        }
        else{
            $geo_level = $geo_level_3;
        }
        $activity_address = $this->input->post("activity_address");
        $pod = $this->input->post("pod");
        $set_alert = $this->input->post("set_alert");
        $attandence_count = $this->input->post("attandence_count");
        $size_of_plot = $this->input->post("size_of_plot");
        $spray_volume = $this->input->post("spray_volume");

        $referenc = $this->input->post("reference_type");
        $status = $this->input->post("status");
        $submit_status = $this->input->post("submit_status");


        if(isset($referenc) && !empty($referenc) )
        {
            if($referenc == 'follow_up')
            {
                $reference_type = '1';
                $submit_status = '0';
                $status = '0';
            }
            else{
                $reference_type = '0';
                (isset($submit_status) && !empty($submit_status)) ? $submit_status : 0;
            }
        }
        else{
            $reference_type = '0';
            (isset($submit_status) && !empty($submit_status)) ? $submit_status : 0;
        }


        if(isset($web_service) && !empty($web_service) && $web_service=='web_service')
        {


            $plan_date = $this->input->post("planning_date");
            $pl_date = str_replace('/', '-', $plan_date);
            $planning_date = date('Y-m-d', strtotime($pl_date));

           // $planning_date = $this->input->post("planning_date");
            $pl_time = $this->input->post("planning_time");
            $date_time= $planning_date.' '.$pl_time;
            $planning_date_time = date('Y-m-d H:i:s', strtotime($date_time));
            $crop =  (trim($this->input->post("crop")) != "" ? explode(',',$this->input->post("crop")) : "");
            $product_sku =  (trim($this->input->post("product_sku")) != "" ? explode(',',$this->input->post("product_sku")) : '');
            $diseases =  (trim($this->input->post("diseases")) != "" ? explode(',',$this->input->post("diseases")) : '');
            $farmers =  (trim($this->input->post("farmers")) != "" ? explode(',',$this->input->post("farmers")) : '');
            $farmer_num =  (trim($this->input->post("farmer_num")) != "" ? explode(',',$this->input->post("farmer_num")) : '');
            $digital_id  =  (trim($this->input->post("digital_id")) != "" ? explode(',',$this->input->post("digital_id")) : '');
            $joint_id  =  (trim($this->input->post("joint_id")) != "" ? explode(',',$this->input->post("joint_id")) : '');
            $product_samples =  (trim($this->input->post("product_samples")) != "" ? explode(',',$this->input->post("product_samples")) : '');
            $product_samples_qty =  (trim($this->input->post("product_samples_qty")) != "" ? explode(',',$this->input->post("product_samples_qty")) : '');
            $product_materials = (trim($this->input->post("product_materials")) != "" ? explode(',',$this->input->post("product_materials")) : '') ;
            $product_materials_qty = (trim($this->input->post("product_materials_qty")) != "" ? explode(',',$this->input->post("product_materials_qty")) : '');
            $materials =  ( trim($this->input->post("materials")) != "" ? explode(',',$this->input->post("materials")) : '');
            $materials_qty =  (trim($this->input->post("materials_qty")) != "" ? explode(',',$this->input->post("materials_qty")) : '');
        }
        else{

            $plan_date = $this->input->post("planning_date");
            $pl_date = str_replace('/', '-', $plan_date);
            $planning_date = date('Y-m-d', strtotime($pl_date));

            $pl_time = $this->input->post("planning_time");
            $date_time= $planning_date.' '.$pl_time;
            $planning_date_time = date('Y-m-d H:i:s', strtotime($date_time));
            $crop = $this->input->post("crop");
            $product_sku = $this->input->post("product_sku");
            $diseases = $this->input->post("diseases");
            $farmers = $this->input->post("farmers");
            $farmer_num = $this->input->post("farmer_num");
            $digital_id  = $this->input->post("digital_id");
            $joint_id  = $this->input->post("joint_id");
            $product_samples = $this->input->post("product_samples");
            $product_samples_qty = $this->input->post("product_samples_qty");
            $product_materials = $this->input->post("product_materials");
            $product_materials_qty = $this->input->post("product_materials_qty");
            $materials = $this->input->post("materials");
            $materials_qty = $this->input->post("materials_qty");
            $amount = $this->input->post("amount");
        }

        if(isset($activity_planning_id) && !empty($activity_planning_id))
        {

            $activity_planning = array(
                'activity_planning_date' => isset($planning_date) ? $planning_date : '',
                'activity_planning_time' => isset($planning_date_time) ? $planning_date_time : '',
                'activity_type_id' => isset($activity_type_id) ? $activity_type_id : '',
                'geo_level_id_2' => (isset($geo_level_2) && !empty($geo_level_2)) ? $geo_level_2 : 0,
                'geo_level_id_3' => (isset($geo_level_3) && !empty($geo_level_3)) ? $geo_level_3 : 0,
                'geo_level_id_4' => (isset($geo_level_4) && !empty($geo_level_4)) ? $geo_level_4 : 0,
                'geo_level_id' => (isset($geo_level) && !empty($geo_level)) ? $geo_level : 0,
                'location' => isset($activity_address) ? $activity_address :''   ,
                'proposed_attandence_count' => (isset($attandence_count) && !empty($attandence_count)) ? $attandence_count : '0',
                'point_discussion' => isset($pod) ? $pod : '',
                'alert' => isset($set_alert) ? $set_alert : '',
                'size_of_plot' => (isset($size_of_plot) && !empty($size_of_plot)) ? $size_of_plot : '0',
                'spray_volume' => (isset($spray_volume) && !empty($spray_volume)) ? $spray_volume : '0',
                'amount' =>  (isset($amount) && !empty($amount)) ? $amount : '0',
               /* 'employee_id' => $user_id,*/
                'country_id' => $country_id,
                'is_planned' => '1',
                'status' => (isset($status) && !empty($status)) ? $status : 0,
                'submit_status' =>  (isset($submit_status) && !empty($submit_status)) ? $submit_status : 0,
                'reference_type' => $reference_type,
                'reference_id' => '0',
                'modified_by_user' => $user_id,
                'modified_on' => date('Y-m-d H:i:s'),

            );
          //  testdata($activity_planning);
            $update_array=array();

            $this->db->where('activity_planning_id',$activity_planning_id);
            $this->db->update('ecp_activity_planning', $activity_planning);


            if ($this->db->affected_rows() > 0) {
                $update_array[]=1;
            }

                if(isset($crop) && !empty($crop)){

                    $this->db->where('activity_planning_id',$activity_planning_id);
                    $this->db->delete('ecp_activity_planning_crop_details');

                    foreach ($crop as $key => $crp) {
                        $corp_detail = array(
                            'activity_planning_id' => $activity_planning_id,
                            'crop_id' => (isset($crp) && !empty($crp))  ? $crp : 0,
                        );

                        $this->db->insert('ecp_activity_planning_crop_details', $corp_detail);

                        if ($this->db->affected_rows() > 0) {
                            $update_array[]=1;
                        }
                    }
                }

                if(isset($product_sku) && !empty($product_sku)){

                    $this->db->where('activity_planning_id',$activity_planning_id);
                    $this->db->delete('ecp_activity_planning_product_details');

                    foreach ($product_sku as $key => $prd_sku) {
                        $product_detail = array(
                            'activity_planning_id' => $activity_planning_id,
                            'product_sku_id' => (isset($prd_sku) && !empty($prd_sku)) ? $prd_sku : 0,
                        );

                        $this->db->insert('ecp_activity_planning_product_details', $product_detail);
                        if ($this->db->affected_rows() > 0) {
                            $update_array[]=1;
                        }
                    }
                }


                if(isset($diseases) && !empty($diseases)){

                    $this->db->where('activity_planning_id',$activity_planning_id);
                    $this->db->delete('ecp_activity_planning_diseases_details');

                    foreach ($diseases as $key => $val) {
                        $diseases_details = array(
                            'activity_planning_id' => $activity_planning_id,
                            'diseases_id' => (isset($val) && !empty($val)) ? $val : 0,
                        );

                        $this->db->insert('ecp_activity_planning_diseases_details', $diseases_details);
                        if ($this->db->affected_rows() > 0) {
                            $update_array[]=1;
                        }
                    }
                }

                if(isset($farmers) && !empty($farmers)){

                    $this->db->where('activity_planning_id',$activity_planning_id);
                    $this->db->delete('ecp_activity_planning_key_customer_details');

                    foreach($farmers as $k => $val_frm)
                    {
                        $key_farmer_details = array(
                            'activity_planning_id' => $activity_planning_id,
                            'customer_id' => (isset($val_frm) && !empty($val_frm)) ? $val_frm : 0,
                            'mobile_no' => isset($farmer_num[$k]) ? $farmer_num[$k] : '',
                        );

                        $this->db->insert('ecp_activity_planning_key_customer_details', $key_farmer_details);
                        if ($this->db->affected_rows() > 0) {
                            $update_array[]=1;
                        }
                    }
                }


                if(isset($digital_id) && !empty($digital_id)){

                    $this->db->where('activity_planning_id',$activity_planning_id);
                    $this->db->delete('ecp_activity_planning_digital_library_details');

                    foreach($digital_id as $k => $val_digital)
                    {

                        $digital_library_details = array(
                            'activity_planning_id' => $activity_planning_id,
                            'digital_library_id' => (isset($val_digital) && !empty($val_digital)) ? $val_digital : 0,
                        );

                        $this->db->insert('ecp_activity_planning_digital_library_details', $digital_library_details);
                        if ($this->db->affected_rows() > 0) {
                            $update_array[]=1;
                        }
                    }
                }


                if(isset($joint_id) && !empty($joint_id)){

                    $this->db->where('activity_planning_id',$activity_planning_id);
                    $this->db->delete('ecp_activity_planning_joint_visit_details');

                    foreach($joint_id as $k =>$val_joint)
                    {
                        $joint_details = array(
                            'activity_planning_id' => $activity_planning_id,
                            'employee_id' =>  (isset($val_joint) && !empty($val_joint)) ? $val_joint : 0,
                        );

                        $this->db->insert('ecp_activity_planning_joint_visit_details', $joint_details);
                        if ($this->db->affected_rows() > 0) {
                            $update_array[]=1;
                        }
                    }

                }


                if(isset($product_samples) && !empty($product_samples)){

                    $this->db->where('activity_planning_id',$activity_planning_id);
                    $this->db->delete('ecp_activity_planning_promo_sample_details');

                    foreach($product_samples as $K=> $val_product)
                    {
                        $product_samples_details = array(
                            'activity_planning_id' => $activity_planning_id,
                            'product_sku_id' => (isset($val_product) && !empty($val_product)) ? $val_product : 0,
                            'quantity' =>(isset($product_samples_qty[$K]) && !empty($product_samples_qty[$K]))? $product_samples_qty[$K] : 0,
                        );

                        $this->db->insert('ecp_activity_planning_promo_sample_details', $product_samples_details);
                        if ($this->db->affected_rows() > 0) {
                            $update_array[]=1;
                        }
                    }
                }


                if(isset($product_materials) && !empty($product_materials)){

                    $this->db->where('activity_planning_id',$activity_planning_id);
                    $this->db->delete('ecp_activity_planning_required_product_details');

                    foreach($product_materials as $K=> $vals)
                    {
                        $product_materials_details = array(
                            'activity_planning_id' => $activity_planning_id,
                            'product_sku_id' => (isset($vals) && !empty($vals)) ? $vals :0,
                            'quantity' => (isset($product_materials_qty[$K]) && !empty($product_materials_qty[$K])) ? $product_materials_qty[$K] : 0,
                        );

                        $this->db->insert('ecp_activity_planning_required_product_details', $product_materials_details);
                        if ($this->db->affected_rows() > 0) {
                            $update_array[]=1;
                        }
                    }


                }

                if(isset($materials) && !empty($materials)){

                    $this->db->where('activity_planning_id',$activity_planning_id);
                    $this->db->delete('ecp_activity_planning_required_material_details');

                    foreach($materials as $K=> $val_materials)
                    {
                        $materials_details = array(
                            'activity_planning_id' => $activity_planning_id,
                            'material_id' => (isset($val_materials) && !empty($val_materials))  ? $val_materials : 0,
                            'quantity' => (isset($materials_qty[$K]) && !empty($materials_qty[$K])) ? $materials_qty[$K] : 0,
                        );

                        $this->db->insert('ecp_activity_planning_required_material_details', $materials_details);
                        if ($this->db->affected_rows() > 0) {
                            $update_array[]=1;
                        }
                    }
                }

            if(in_array(1,$update_array))
            {
                return 1;
            }
            else{
                return 0;
            }
        }
        else{
            $activity_planning = array(
                'activity_planning_date' => isset($planning_date) ? $planning_date : '',
                'activity_planning_time' => isset($planning_date_time) ? $planning_date_time : '',
                'activity_type_id' => isset($activity_type_id) ? $activity_type_id : '',
                'geo_level_id_2' => (isset($geo_level_2) && !empty($geo_level_2)) ? $geo_level_2 : 0,
                'geo_level_id_3' => (isset($geo_level_3) && !empty($geo_level_3)) ? $geo_level_3 : 0,
                'geo_level_id_4' => (isset($geo_level_4) && !empty($geo_level_4)) ? $geo_level_4 : 0,
                'geo_level_id' => (isset($geo_level) && !empty($geo_level)) ? $geo_level : 0,
                'location' => isset($activity_address) ? $activity_address :''   ,
                'proposed_attandence_count' => (isset($attandence_count) && !empty($attandence_count)) ? $attandence_count : '0',
                'point_discussion' => isset($pod) ? $pod : '',
                'alert' => isset($set_alert) ? $set_alert : '',
                'size_of_plot' => (isset($size_of_plot) && !empty($size_of_plot)) ? $size_of_plot : 0,
                'spray_volume' => (isset($spray_volume) && !empty($spray_volume)) ? $spray_volume : 0,
                'amount' => '0',
                'employee_id' => $user_id,
                'country_id' => $country_id,
                'status' => (isset($status) && !empty($status)) ? $status : 0,
                'submit_status' =>  (isset($submit_status) && !empty($submit_status)) ? $submit_status : 0,
                'reference_type' => $reference_type,
                'reference_id' => '0',
                'is_planned' => '1',
                'created_by_user' => $user_id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_on' => date('Y-m-d H:i:s'),

            );

            if ($this->db->insert('ecp_activity_planning', $activity_planning)) {

                $insert_id = $this->db->insert_id();

                if(isset($crop) && !empty($crop)){

                    foreach ($crop as $key => $crp) {
                        $corp_detail = array(
                            'activity_planning_id' => $insert_id,
                            'crop_id' => (isset($crp) && !empty($crp)) ? $crp : 0,
                        );

                        $this->db->insert('ecp_activity_planning_crop_details', $corp_detail);
                    }
                }

                if(isset($product_sku) && !empty($product_sku)){
                    foreach ($product_sku as $key => $prd_sku) {
                        $product_detail = array(
                            'activity_planning_id' => $insert_id,
                            'product_sku_id' => (isset($prd_sku) && !empty($prd_sku)) ? $prd_sku : 0,
                        );

                        $this->db->insert('ecp_activity_planning_product_details', $product_detail);

                    }
                }


                if(isset($diseases) && !empty($diseases)){

                    foreach ($diseases as $key => $val) {
                        $diseases_details = array(
                            'activity_planning_id' => $insert_id,
                            'diseases_id' => (isset($val) && !empty($val)) ? $val : 0,
                        );

                        $this->db->insert('ecp_activity_planning_diseases_details', $diseases_details);

                    }
                }

                if(isset($farmers) && !empty($farmers)){
                    foreach($farmers as $k => $val_frm)
                    {
                        $key_farmer_details = array(
                            'activity_planning_id' => $insert_id,
                            'customer_id' => (isset($val_frm) && !empty($val_frm)) ? $val_frm : 0,
                            'mobile_no' => isset($farmer_num[$k]) ? $farmer_num[$k] : '',
                        );

                        $this->db->insert('ecp_activity_planning_key_customer_details', $key_farmer_details);
                    }
                }


                if(isset($digital_id) && !empty($digital_id)){

                    foreach($digital_id as $k => $val_digital)
                    {

                        $digital_library_details = array(
                            'activity_planning_id' => $insert_id,
                            'digital_library_id' => (isset($val_digital) && !empty($val_digital)) ? $val_digital : 0,
                        );

                        $this->db->insert('ecp_activity_planning_digital_library_details', $digital_library_details);
                    }
                }


                if(isset($joint_id) && !empty($joint_id)){

                    foreach($joint_id as $k =>$val_joint)
                    {
                        $joint_details = array(
                            'activity_planning_id' => $insert_id,
                            'employee_id' =>  (isset($val_joint) && !empty($val_joint)) ? $val_joint : 0,
                        );

                        $this->db->insert('ecp_activity_planning_joint_visit_details', $joint_details);
                    }

                }


                if(isset($product_samples) && !empty($product_samples)){

                    foreach($product_samples as $K=> $val_product)
                    {
                        $product_samples_details = array(
                            'activity_planning_id' => $insert_id,
                            'product_sku_id' => (isset($val_product) && !empty($val_product)) ? $val_product : 0,
                            'quantity' => (isset($product_samples_qty[$K]) && !empty($product_samples_qty[$K])) ? $product_samples_qty[$K] : 0,
                        );

                        $this->db->insert('ecp_activity_planning_promo_sample_details', $product_samples_details);
                    }

                }


                if(isset($product_materials) && !empty($product_materials)){

                    foreach($product_materials as $K=> $vals)
                    {
                        $product_materials_details = array(
                            'activity_planning_id' => $insert_id,
                            'product_sku_id' => (isset($vals) && !empty($vals)) ? $vals : 0,
                            'quantity' => (isset($product_materials_qty[$K]) && !empty($product_materials_qty[$K]))  ? $product_materials_qty[$K] : 0,
                        );

                        $this->db->insert('ecp_activity_planning_required_product_details', $product_materials_details);
                    }
                }

                if(isset($materials) && !empty($materials)){

                    foreach($materials as $K=> $val_materials)
                    {
                        $materials_details = array(
                            'activity_planning_id' => $insert_id,
                            'material_id' => (isset($val_materials) && !empty($val_materials)) ? $val_materials : 0,
                            'quantity' => (isset($materials_qty[$K]) && !empty($materials_qty[$K])) ? $materials_qty[$K] : 0,
                        );

                        $this->db->insert('ecp_activity_planning_required_material_details', $materials_details);
                    }

                }

                return $insert_id;
            }
            else{
                return 0;
            }
        }
    }

    public function submitActivityPlanning($activity_planning_id,$user_id,$country_id)
    {
        $submit_activity = array(
            'status' => '1',
            'submit_status' => '1',
            'submit_date' =>  date('Y-m-d H:i:s'),
            'modified_by_user' => $user_id,
            'modified_on' => date('Y-m-d H:i:s')
        );

        $this->db->where('activity_planning_id',$activity_planning_id);
        $this->db->where('employee_id',$user_id);
        $this->db->where('country_id',$country_id);;
        $this->db->update('ecp_activity_planning', $submit_activity);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getApprovalActivityDetailByMonth($cur_month,$child_user,$id,$country_id,$local_date = null,$page=null,$web_service=null)
    {
       // $sql = 'SELECT * ';
        $sql = 'SELECT eap.activity_planning_id,eap.activity_planning_date,bu.display_name,bu.user_code,mdc.desigination_country_name,eamc.activity_type_country_name,eap.status ';
        $sql .= 'FROM bf_ecp_activity_planning AS eap ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = eap.employee_id) ';
        $sql .= 'JOIN bf_master_designation_role AS mdr ON (mdr.user_id = bu.id) ';
        $sql .= 'JOIN bf_master_designation_country AS mdc ON (mdc.desigination_country_id = mdr.desigination_role_id) ';
        $sql .= 'JOIN bf_ecp_activity_master_country AS eamc ON (eamc.activity_type_country_id = eap.activity_type_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= ' AND eap.employee_id  IN ('. $child_user .')';
        $sql .= ' AND eap.country_id ="' . $country_id . '" ';
        $sql .= ' AND eap.status != 0 ';
        $sql .= ' AND DATE_FORMAT(eap.activity_planning_date,"%Y-%m") ="'. $cur_month . '" ';
        $sql .= 'ORDER BY eap.activity_planning_id  DESC ';

        if (!empty($web_service) && $web_service == 'web_service') {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page * $limit - $limit;
            $sql .= ' LIMIT ' . $offset . "," . $limit;
            $info = $this->db->query($sql);
            // For Pagination
            $material = $info->result_array();
            return $material;
        }
        else
        {
            $activity_approval = $this->grid->get_result_res($sql);
            //testdata($activity_approval);
            if (isset($activity_approval['result']) && !empty($activity_approval['result'])) {

                $activity['head'] = array('Sr. No.', 'Edit', 'Employee Name', 'Employee Code', 'Designation', 'Activity Planned Date', 'Activity Type','Action');

                $activity['count'] = count($activity['head']);
                if ($page != null || $page != "") {
                    $i = (($page * 10) - 9);
                } else {
                    $i = 1;
                }

                foreach ($activity_approval['result'] as $rm) {

                    if ($local_date != null) {
                        $date3 = strtotime($rm['activity_planning_date']);
                        $activity_date = date($local_date, $date3);

                    } else {
                        $activity_date = $rm['activity_planning_date'];
                    }
                    if($rm['status'] == 1)
                    {
                        $approval_status = '<select name="status" class="approval_status" id="approval_status" ><option value="">Select Action</option><option attr-id="'. $rm['activity_planning_id'].'" value="2">Approve</option><option attr-id="'. $rm['activity_planning_id'].'"   value="3">Reject</option></select>';
                        $edit_disabled[] = 0;
                    }
                    else{
                        if($rm['status'] == '2')
                        {
                            $approval_status = 'Approve';
                            $edit_disabled[]= 1;
                        }
                        elseif($rm['status'] == '3'){
                            $approval_status = 'Reject';
                            $edit_disabled[] = 1;
                        }
                        elseif($rm['status'] == '4'){
                            $approval_status = 'Executed';
                            $edit_disabled[]= 1;
                        }
                        else{
                            $approval_status = 'Canceled';
                            $edit_disabled[] = 1;
                        }
                    }


                    $activity['row'][] = array($i, $rm['activity_planning_id'], $rm['display_name'], $rm['user_code'], $rm['desigination_country_name'],$activity_date, $rm['activity_type_country_name'],$approval_status );
                    $i++;
                }
                $activity['eye'] = '';
                $activity['action'] = 'is_action';
                $activity['delete'] = '';
                $activity['edit_disabled'] = $edit_disabled ;
                $activity['pagination'] = $activity_approval['pagination'];

                return $activity;
            } else {
                return false;
            }
        }
    }


    public function changeActivityStatus($status_id,$activity_planning_id,$user_id)
    {
        $approved_activity = array(
            'status' => $status_id,
            'approved_by' => $user_id,
            'approved_date' =>  date('Y-m-d H:i:s'),
            'modified_by_user' => $user_id,
            'modified_on' => date('Y-m-d H:i:s')
        );

        $this->db->where('activity_planning_id',$activity_planning_id);
        $this->db->update('ecp_activity_planning', $approved_activity);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function editViewActivityPlanning($activity_planning_id)
    {
        $this->db->select('eap.activity_planning_id,eap.activity_planning_date,eap.activity_planning_time,eap.execution_date,eap.execution_time,eap.meeting_duration,eap.activity_type_id,eap.geo_level_id_2,eap.geo_level_id_3,eap.geo_level_id_4,eap.location,eap.proposed_attandence_count,eap.point_discussion,eap.alert,eap.size_of_plot,eap.spray_volume,eap.amount,eap.rating,eap.activity_note,eap.employee_id,amc.activity_type_code,amc.activity_type_country_name,mpgd2.political_geography_name as geo_level_name_2,,mpgd3.political_geography_name as geo_level_name_3,mpgd4.political_geography_name as geo_level_name_4,eap.status,eap.submit_status');
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('ecp_activity_master_country as amc','amc.activity_type_country_id = eap.activity_type_id','left');
        $this->db->join('master_political_geography_details as mpgd2','mpgd2.political_geo_id = eap.geo_level_id_2','left');
        $this->db->join('master_political_geography_details as mpgd3','mpgd3.political_geo_id = eap.geo_level_id_3','left');
        $this->db->join('master_political_geography_details as mpgd4','mpgd4.political_geo_id = eap.geo_level_id_4','left');
        $this->db->where('eap.activity_planning_id',$activity_planning_id);
        $activity = $this->db->get()->row_array();

        $activity['crop'] = $this->getCropDetails($activity_planning_id);
        $activity['products'] = $this->getProductDetails($activity_planning_id);
        $activity['diseases'] = $this->getDiseasesDetails($activity_planning_id);
        if($activity['activity_type_code'] == 'RMP003' ||$activity['activity_type_code'] == 'RVP004')
        {
            $activity['key_retailer'] = $this->getKeyRetailerDetails($activity_planning_id);
        }
        else{
            $activity['key_farmer'] = $this->getKeyFarmerDetails($activity_planning_id);
        }
        $activity['digital_library'] = $this->getDigitalLibraryDetails($activity_planning_id);
        $activity['join_visit'] = $this->getJointVisitEnployee($activity_planning_id);
        $activity['products_sample'] = $this->getProductsSample($activity_planning_id);
        $activity['products_request'] = $this->getProductsRequest($activity_planning_id);
        $activity['material_request'] = $this->getMaterialRequest($activity_planning_id);
        $activity['customer'] = $this->getAllCustomer($activity_planning_id);
        $activity['image_gallery'] = $this->getAllUploadFiles($activity_planning_id);
        if(!empty($activity))

            return $activity;

        else
            return array();

    }


    public function getAllUploadFiles($activity_planning_id)
    {
        $this->db->select('files_name');
        $this->db->from('ecp_activity_planning_upload_details as eapud');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $file = $this->db->get()->result_array();

        if(isset($file) && !empty($file))
        {
            $final_arry = array();
            foreach($file as $k=> $vl)
            {
                $final_arry[] = base_url('assets/uploads/activity_gallery/'.$vl['files_name']);
            }
            return $final_arry;
        }
        else{
            return array();
        }
    }

    public function getAllCustomer($activity_planning_id)
    {
        $this->db->select('customer_name,mobile_no');
        $this->db->from('ecp_activity_planning_attendees_details as eapad');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $attendees = $this->db->get()->result_array();
        if(isset($attendees) && !empty($attendees))
        {
            return $attendees;
        }
        else{
            return array();
        }
    }

    public function getCropDetails($activity_planning_id)
    {
        $this->db->select('eapcd.crop_id,mcc.crop_name');
        $this->db->from('ecp_activity_planning_crop_details as eapcd');
        $this->db->join('master_crop_country as mcc','mcc.crop_country_id = eapcd.crop_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $Crop= $this->db->get()->result_array();
        if(isset($Crop) && !empty($Crop))
        {
            return $Crop;
        }
        else{
            return array();
        }
    }

    public function getProductDetails($activity_planning_id){
        $this->db->select('eappd.product_sku_id,mpsc.product_sku_name');
        $this->db->from('ecp_activity_planning_product_details as eappd');
        $this->db->join('master_product_sku_country as mpsc','mpsc.product_sku_country_id = eappd.product_sku_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $Product= $this->db->get()->result_array();
        if(isset($Product) && !empty($Product))
        {
            return $Product;
        }
        else{
            return array();
        }
    }

    public function getDiseasesDetails($activity_planning_id){
        $this->db->select('eapdd.diseases_id,mdc.disease_name');
        $this->db->from('ecp_activity_planning_diseases_details as eapdd');
        $this->db->join('master_disease_country as mdc','mdc.disease_country_id = eapdd.diseases_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $Diseases= $this->db->get()->result_array();
        if(isset($Diseases) && !empty($Diseases))
        {
            return $Diseases;
        }
        else{
            return array();
        }
    }

    public function getKeyFarmerDetails($activity_planning_id){

        $this->db->select('eapkcd.customer_id,buf.display_name,eapkcd.mobile_no');
        $this->db->from('ecp_activity_planning_key_customer_details as eapkcd');
        $this->db->join('users as buf','buf.id = eapkcd.customer_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $KeyFarmer = $this->db->get()->result_array();
        if(isset($KeyFarmer) && !empty($KeyFarmer))
        {
            return $KeyFarmer;
        }
        else{
            return array();
        }
    }

    public function getKeyRetailerDetails($activity_planning_id){
        $this->db->select('eapkcd.customer_id,buf.display_name,eapkcd.mobile_no');
        $this->db->from('ecp_activity_planning_key_customer_details as eapkcd');
        $this->db->join('users as buf','buf.id = eapkcd.customer_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $KeyRetailer = $this->db->get()->result_array();
        if(isset($KeyRetailer) && !empty($KeyRetailer))
        {
            return $KeyRetailer;
        }
        else{
            return array();
        }
    }

    public function getDigitalLibraryDetails($activity_planning_id){

        $this->db->select('eapdld.digital_library_id,edlm.library_name');
        $this->db->from('ecp_activity_planning_digital_library_details as eapdld');
        $this->db->join('ecp_digital_library_master as edlm','edlm.digital_library_id = eapdld.digital_library_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $DigitalLibrary = $this->db->get()->result_array();
        if(isset($DigitalLibrary) && !empty($DigitalLibrary))
        {
            return $DigitalLibrary;
        }
        else{
            return array();
        }
    }

    public function getJointVisitEnployee($activity_planning_id){

        $this->db->select('eapjvd.joint_visit_details_id,eapjvd.employee_id,v_emp.display_name');
        $this->db->from('ecp_activity_planning_joint_visit_details as eapjvd');
        $this->db->join('users as v_emp','v_emp.id = eapjvd.employee_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $VisitEnployee= $this->db->get()->result_array();
        if(isset($VisitEnployee) && !empty($VisitEnployee))
        {
            return $VisitEnployee;
        }
        else{
            return array();
        }
    }

    public function getProductsSample($activity_planning_id){
        $this->db->select('eappsd.product_sku_id,mpsc.product_sku_name,eappsd.quantity');
        $this->db->from('ecp_activity_planning_promo_sample_details as eappsd');
        $this->db->join('master_product_sku_country as mpsc','mpsc.product_sku_country_id = eappsd.product_sku_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $ProductsSample = $this->db->get()->result_array();
        if(isset($ProductsSample) && !empty($ProductsSample))
        {
            return $ProductsSample;
        }
        else{
            return array();
        }

    }

    public function getProductsRequest($activity_planning_id){

        $this->db->select('eaprpd.product_sku_id,mpsc.product_sku_name,eaprpd.quantity');
        $this->db->from('ecp_activity_planning_required_product_details as eaprpd');
        $this->db->join('master_product_sku_country as mpsc','mpsc.product_sku_country_id = eaprpd.product_sku_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $ProductsRequest = $this->db->get()->result_array();
        if(isset($ProductsRequest) && !empty($ProductsRequest))
        {
            return $ProductsRequest;
        }
        else{
            return array();
        }
    }

    public function getMaterialRequest($activity_planning_id){

        $this->db->select('eaprmd.material_id,mpmc.promotional_material_country_name,eaprmd.quantity');
        $this->db->from('ecp_activity_planning_required_material_details as eaprmd');
        $this->db->join('master_promotional_material_country as mpmc','mpmc.promotional_country_id= eaprmd.material_id');
        $this->db->where('activity_planning_id',$activity_planning_id);
        $MaterialRequest= $this->db->get()->result_array();
        if(isset($MaterialRequest) && !empty($MaterialRequest))
        {
            return $MaterialRequest;
        }
        else{
            return array();
        }
    }

    public function get_geo_data($geo_level_id)
    {
       $this->db->select('political_geo_id,political_geography_name');
       $this->db->from('master_political_geography_details');
       $this->db->where('political_geo_id',$geo_level_id);
        $geo= $this->db->get()->row_array();
        if(isset($geo) && !empty($geo))
        {
            return $geo;
        }
        else{
            return 0;
        }
    }

    public function addActivityUnplanned($user_id,$country_id,$web_service = null,$local_date = null)
    {

        $activity_type_id = $this->input->post("activity_type_id");
        $geo_level_4 = $this->input->post("geo_level_4");
        $geo_level_3 = $this->input->post("geo_level_3");
        $geo_level_2 = $this->input->post("geo_level_2");
        if(isset($geo_level_4) && !empty($geo_level_4))
        {
            $geo_level = $geo_level_4;
        }
        else{
            $geo_level = $geo_level_3;
        }
        $activity_address = $this->input->post("activity_address");
        $pod = $this->input->post("pod");
        $set_alert = $this->input->post("set_alert");
        $attandence_count = $this->input->post("attandence_count");
        $size_of_plot = $this->input->post("size_of_plot");
        $spray_volume = $this->input->post("spray_volume");
        $meeting_duration = $this->input->post("meeting_duration");

        if(isset($web_service) && !empty($web_service) && $web_service=='web_service')
        {
            $plan_date = $this->input->post("execution_date");
            $pl_date = str_replace('/', '-', $plan_date);
            $execution_date = date('Y-m-d', strtotime($pl_date));

           // $execution_date = $this->input->post("execution_date");
            $pl_time = $this->input->post("execution_time");

            $date_time= $execution_date.' '.$pl_time;
            $execution_date_time = date('Y-m-d H:i:s', strtotime($date_time));

            $crop = (trim($this->input->post("crop")) != "" ? explode(',',$this->input->post("crop")) : '');
            $product_sku = (trim($this->input->post("product_sku")) != "" ? explode(',',$this->input->post("product_sku")) : '');
            $diseases = ( trim($this->input->post("diseases")) != "" ? explode(',',$this->input->post("diseases")) : '');
            $farmers = (trim($this->input->post("farmers")) != "" ? explode(',',$this->input->post("farmers")) : '');
            $farmer_num = (trim($this->input->post("farmer_num")) != "" ? explode(',', $this->input->post("farmer_num")) : '');
            $digital_id  = (trim($this->input->post("digital_id")) != "" ? explode(',',$this->input->post("digital_id")) : '');;
            $joint_id  = (trim($this->input->post("joint_id")) != "" ? explode(',',$this->input->post("joint_id")) : '');
            $product_samples = (trim($this->input->post("product_samples")) != "" ? explode(',',$this->input->post("product_samples")) : '');
            $product_samples_qty = (trim($this->input->post("product_samples_qty")) != "" ? explode(',',$this->input->post("product_samples_qty")) : '');
            $product_materials = (trim($this->input->post("product_materials")) != "" ? explode(',',$this->input->post("product_materials")) : '' );
            $product_materials_qty =  (trim($this->input->post("product_materials_qty")) != ""  ? explode(',',$this->input->post("product_materials_qty")) : "" );
            $materials = (trim($this->input->post("materials")) != ""  ? explode(',',$this->input->post("materials")) : '');
            $materials_qty = (trim($this->input->post("materials_qty")) != "" ? explode(',',$this->input->post("materials_qty")) : '');
            $customer_no = (trim($this->input->post("customer_no")) != ""  ? explode(',',$this->input->post("customer_no")) : '');
            $customer_name = (trim($this->input->post("customer_name")) != "" ? explode(',', $this->input->post("customer_name")) : '' );
            $activity_note = $this->input->post("activity_note");
            $rating = $this->input->post("rating");
            $amount = $this->input->post("amount");
        }
        else{

            $plan_date = $this->input->post("execution_date");
            $pl_date = str_replace('/', '-', $plan_date);
            $execution_date = date('Y-m-d', strtotime($pl_date));

            $pl_time = $this->input->post("execution_time");
            $date_time= $execution_date.' '.$pl_time;
            $execution_date_time = date('Y-m-d H:i:s', strtotime($date_time));
            $crop = $this->input->post("crop");
            $product_sku = $this->input->post("product_sku");
            $diseases = $this->input->post("diseases");
            $farmers = $this->input->post("farmers");
            $farmer_num = $this->input->post("farmer_num");
            $digital_id  = $this->input->post("digital_id");
            $joint_id  = $this->input->post("joint_id");
            $product_samples = $this->input->post("product_samples");
            $product_samples_qty = $this->input->post("product_samples_qty");
            $product_materials = $this->input->post("product_materials");
            $product_materials_qty = $this->input->post("product_materials_qty");
            $materials = $this->input->post("materials");
            $materials_qty = $this->input->post("materials_qty");
            $customer_no = $this->input->post("customer_no");
            $customer_name = $this->input->post("customer_name");
            $activity_note = $this->input->post("activity_note");
            $rating = $this->input->post("rating");
            $amount = $this->input->post("amount");
        }

        $activity_planning = array(
            'execution_date' => (isset($execution_date) && !empty($execution_date)) ? $execution_date : '',
            'execution_time' => (isset($execution_date_time) && !empty($execution_date_time)) ? $execution_date_time : '',
            'activity_type_id' => (isset($activity_type_id) && !empty($activity_type_id)) ? $activity_type_id : '',
            'meeting_duration' => (isset($meeting_duration) && !empty($meeting_duration)) ? $meeting_duration : '00:00:00',
            'geo_level_id_2' => (isset($geo_level_2) && !empty($geo_level_2)) ? $geo_level_2 : 0,
            'geo_level_id_3' => (isset($geo_level_3) && !empty($geo_level_3)) ? $geo_level_3 : 0,
            'geo_level_id_4' => (isset($geo_level_4) && !empty($geo_level_4))? $geo_level_4 : 0,
            'geo_level_id' => (isset($geo_level) && !empty($geo_level))? $geo_level : 0,
            'location' => (isset($activity_address) && !empty($activity_address)) ? $activity_address :''   ,
            'proposed_attandence_count' => (isset($attandence_count) && !empty($attandence_count))? $attandence_count : 0,
            'point_discussion' => (isset($pod) && !empty($pod))  ? $pod : '',
            'alert' => (isset($set_alert) && !empty($set_alert)) ? $set_alert : '',
            'size_of_plot' => (isset($size_of_plot) && !empty($size_of_plot)) ? $size_of_plot : 0,
            'spray_volume' => (isset($spray_volume) && !empty($spray_volume)) ? $spray_volume : 0,
            'amount' => (isset($amount) && !empty($amount)) ? $amount : 0,
            'rating' => (isset($rating) && !empty($rating)) ? $rating : 0,
            'activity_note' => (isset($activity_note) && !empty($activity_note)) ? $activity_note : '',
            'employee_id' => $user_id,
            'country_id' => $country_id,
            'status' => '4',
            'is_planned' => '0',
            'submit_status' => '1',
            'submit_date' => date('Y-m-d'),
            'reference_type' => '0',
            'reference_id' => '0',
            'created_by_user' => $user_id,
            'created_on' => date('Y-m-d H:i:s'),
            'modified_on' => date('Y-m-d H:i:s'),

        );

        if ($this->db->insert('ecp_activity_planning', $activity_planning)) {

            $insert_id = $this->db->insert_id();

            if(isset($crop) && !empty($crop)){

                foreach ($crop as $key => $crp) {
                    $corp_detail = array(
                        'activity_planning_id' => $insert_id,
                        'crop_id' => isset($crp) ? $crp : '',
                    );

                    $this->db->insert('ecp_activity_planning_crop_details', $corp_detail);
                }
            }

            if(isset($product_sku) && !empty($product_sku)){
                foreach ($product_sku as $key => $prd_sku) {
                    $product_detail = array(
                        'activity_planning_id' => $insert_id,
                        'product_sku_id' => isset($prd_sku) ? $prd_sku : '',
                    );

                    $this->db->insert('ecp_activity_planning_product_details', $product_detail);

                }
            }

            if(isset($diseases) && !empty($diseases)){

                foreach ($diseases as $key => $val) {
                    $diseases_details = array(
                        'activity_planning_id' => $insert_id,
                        'diseases_id' => isset($val) ? $val : '',
                    );

                    $this->db->insert('ecp_activity_planning_diseases_details', $diseases_details);

                }
            }

            if(isset($farmers) && !empty($farmers)){
                foreach($farmers as $k => $val_frm)
                {
                    $key_farmer_details = array(
                        'activity_planning_id' => $insert_id,
                        'customer_id' => isset($val_frm) ? $val_frm : '0',
                        'mobile_no' => isset($farmer_num[$k]) ? $farmer_num[$k] : '',
                    );

                    $this->db->insert('ecp_activity_planning_key_customer_details', $key_farmer_details);
                }
            }

            if(isset($digital_id) && !empty($digital_id)){

                foreach($digital_id as $k => $val_digital)
                {

                    $digital_library_details = array(
                        'activity_planning_id' => $insert_id,
                        'digital_library_id' => isset($val_digital) ? $val_digital : '',
                    );

                    $this->db->insert('ecp_activity_planning_digital_library_details', $digital_library_details);
                }
            }

            if(isset($joint_id) && !empty($joint_id)){

                foreach($joint_id as $k =>$val_joint)
                {
                    $joint_details = array(
                        'activity_planning_id' => $insert_id,
                        'employee_id' => isset($val_joint) ? $val_joint : '',
                    );

                    $this->db->insert('ecp_activity_planning_joint_visit_details', $joint_details);
                }

            }

            if(isset($product_samples) && !empty($product_samples)){

                foreach($product_samples as $K=> $val_product)
                {
                    $product_samples_details = array(
                        'activity_planning_id' => $insert_id,
                        'product_sku_id' => isset($val_product) ? $val_product : '',
                        'quantity' => isset($product_samples_qty[$K]) ? $product_samples_qty[$K] : '',
                    );

                    $this->db->insert('ecp_activity_planning_promo_sample_details', $product_samples_details);
                }

            }

            if(isset($product_materials) && !empty($product_materials)){

                foreach($product_materials as $K=> $vals)
                {
                    $product_materials_details = array(
                        'activity_planning_id' => $insert_id,
                        'product_sku_id' => isset($vals) ? $vals :'',
                        'quantity' => isset($product_materials_qty[$K]) ? $product_materials_qty[$K] : '',
                    );

                    $this->db->insert('ecp_activity_planning_required_product_details', $product_materials_details);
                }

            }

            if(isset($materials) && !empty($materials)){

                foreach($materials as $K=> $val_materials)
                {
                    $materials_details = array(
                        'activity_planning_id' => $insert_id,
                        'material_id' => isset($val_materials) ? $val_materials : '',
                        'quantity' => isset($materials_qty[$K]) ? $materials_qty[$K] : '',
                    );

                    $this->db->insert('ecp_activity_planning_required_material_details', $materials_details);
                }

            }

            if(isset($customer_name) && !empty($customer_name)){

                foreach($customer_name as $K=> $val_customer_name)
                {
                    $customer_details = array(
                        'activity_planning_id' => $insert_id,
                        'customer_name' => isset($val_customer_name) ? $val_customer_name : '',
                        'mobile_no' => isset($customer_no[$K]) ? $customer_no[$K] : '',
                    );

                    $this->db->insert('ecp_activity_planning_attendees_details', $customer_details);
                }

            }
            if($web_service !='web_service'){

                if(isset($_POST['upload_file_data']) && !empty($_POST['upload_file_data'])){
                    $data = $this->do_upload();

                    foreach($data as $K=> $upload_data)
                    {
                        $upload_details = array(
                            'activity_planning_id' => $insert_id,
                            'files_name' => isset($upload_data['name']) ?  $upload_data['name']  : '',
                            'upload_type' => isset($upload_data['type']) ? $upload_data['type'] : '',
                        );

                        $this->db->insert('ecp_activity_planning_upload_details', $upload_details);
                    }
                }
            }

            return $insert_id;
        }
        else{
            return 0;
        }
    }

    public function fileUploadGalleryData($activity_planning_id)
    {
        $data = $this->do_upload();
        foreach($data as $K=> $upload_data)
        {
            $upload_details = array(
                'activity_planning_id' => $activity_planning_id,
                'files_name' => isset($upload_data['name']) ?  $upload_data['name']  : '',
                'upload_type' => isset($upload_data['type']) ? $upload_data['type'] : '',
            );

                $this->db->insert('ecp_activity_planning_upload_details', $upload_details);
        }

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function do_upload(){

        $this->load->library('upload');

        $files = $_FILES;
        $final_array= array();

        $cpt = count($_FILES['upload_file_data']['name']);
        for($i=0; $i<$cpt; $i++)
        {

            $_FILES['upload_file_data']['name']		= $files['upload_file_data']['name'][$i];
            $_FILES['upload_file_data']['type']		= $files['upload_file_data']['type'][$i];
            $_FILES['upload_file_data']['tmp_name']	= $files['upload_file_data']['tmp_name'][$i];
            $_FILES['upload_file_data']['error']	= $files['upload_file_data']['error'][$i];
            $_FILES['upload_file_data']['size']		= $files['upload_file_data']['size'][$i];

            $this->upload->initialize($this->set_upload_options());

            $file_name = array();

            if($uploads_data = $this->upload->do_upload('upload_file_data'))
            {
                $upload_data 	= $this->upload->data();

                $file_name['name'] 	=   $upload_data['file_name'];

                $img = array('image/gif','image/jpg','image/png','image/jpeg');
                $video = array('video/mp4','video/avi');

                if(in_array($upload_data['file_type'],$img))
                {
                    $file_name['type'] 	= 'image';
                }
                elseif(in_array($upload_data['file_type'],$video))
                {
                    $file_name['type'] 	= 'video';
                }

            }
            else
            {
                $file_name[] = $_FILES['upload_file_data']['error'];
            }


            $final_array[] = $file_name;

        }

        return $final_array;

    }
    public function set_upload_options(){
        //  upload an image options
        $config = array();
        $config['upload_path'] = FCPATH . 'assets/uploads/activity_gallery/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|3gp|avi';
        $config['max_size']      = '50000000000000000';
        $config['overwrite']     = FALSE;


        return $config;
    }

    public function addActivityExecution($user_id,$country_id,$local_date = null,$web_service = null){



        if(isset($web_service) && !empty($web_service) && $web_service=='web_service')
        {
            $activity_planning_id = $this->input->post("planning_id");
            $plan_date = $this->input->post("execution_date");
            $pl_date = str_replace('/', '-', $plan_date);
            $execution_date = date('Y-m-d', strtotime($pl_date));

            $pl_time = $this->input->post("execution_time");
            $date_time= $execution_date.' '.$pl_time;
            $execution_date_time = date('Y-m-d H:i:s', strtotime($date_time));
            $meeting_duration = $this->input->post("meeting_duration");
            $customer_no = (trim($this->input->post("customer_no")) != "" ?  explode(',',$this->input->post("customer_no")) : '');
            $customer_name =(trim($this->input->post("customer_name")) != "" ? explode(',', $this->input->post("customer_name")) : '');
            $activity_note = $this->input->post("activity_note");
            $rating = $this->input->post("rating");
            $amount = $this->input->post("amount");
        }
        else{
            $activity_planning_id = $this->input->post("inserted_activity_planning_id");
            $plan_date = $this->input->post("execution_date");
            $pl_date = str_replace('/', '-', $plan_date);
            $execution_date = date('Y-m-d', strtotime($pl_date));

            $pl_time = $this->input->post("execution_time");
            $date_time= $execution_date.' '.$pl_time;
            $execution_date_time = date('Y-m-d H:i:s', strtotime($date_time));
            $meeting_duration = $this->input->post("meeting_duration");
            $customer_no =$this->input->post("customer_no");
            $customer_name =$this->input->post("customer_name");
            $activity_note = $this->input->post("activity_note");
            $rating = $this->input->post("rating");
            $amount = $this->input->post("amount");
        }

        $activity_planning = array(
            'execution_date' => (isset($execution_date) && !empty($execution_date)) ? $execution_date : '',
            'execution_time' => (isset($execution_date_time) && !empty($execution_date_time)) ? $execution_date_time : '',
            'meeting_duration' => (isset($meeting_duration) && !empty($meeting_duration)) ? $meeting_duration : '',
            'amount' => (isset($amount) && !empty($amount)) ? $amount : 0,
            'rating' => (isset($rating) && !empty($rating))  ? $rating : 0,
            'activity_note' => (isset($activity_note) && !empty($activity_note)) ? $activity_note : '',
            'status' => '4',
            'submit_date' => date('Y-m-d'),
            'modified_by_user' => $user_id,
            'modified_on' => date('Y-m-d H:i:s'),

        );

        $update_array=array();

        $this->db->where('activity_planning_id',$activity_planning_id);
        $this->db->update('ecp_activity_planning', $activity_planning);

        if ($this->db->affected_rows() > 0) {
            $update_array[]=1;
        }

        if(isset($customer_name) && !empty($customer_name)){

            foreach($customer_name as $K=> $val_customer_name)
            {
                $customer_details = array(
                    'activity_planning_id' => $activity_planning_id,
                    'customer_name' => (isset($val_customer_name) && !empty($val_customer_name)) ? $val_customer_name : '',
                    'mobile_no' => (isset($customer_no[$K]) && !empty($customer_no[$K])) ? $customer_no[$K] : '',
                );

                $this->db->insert('ecp_activity_planning_attendees_details', $customer_details);
            }

            if ($this->db->affected_rows() > 0) {
                $update_array[]=1;
            }

        }

        if(isset($_POST['upload_file_data']) && !empty($_POST['upload_file_data'])){
            $data = $this->do_upload();

            foreach($data as $K=> $upload_data)
            {
                $upload_details = array(
                    'activity_planning_id' => $activity_planning_id,
                    'files_name' => isset($upload_data['name']) ?  $upload_data['name']  : '',
                    'upload_type' => isset($upload_data['type']) ? $upload_data['type'] : '',
                );

                $this->db->insert('ecp_activity_planning_upload_details', $upload_details);
            }
            if ($this->db->affected_rows() > 0) {
                $update_array[]=1;
            }
        }


        if(isset($update_array) && !empty($update_array))
        {
            return 1;
        }
        else{
            return 0;
        }
    }


    public function all_activity_view_details($user_id, $country_id, $web_service = null,$cur_month=null,$cur_year=null)
    {
        if (isset($web_service) && !empty($web_service) && $web_service == 'web_service') {
            $this->db->select('eap.activity_planning_date,eap.execution_date,eap.execution_time,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id');
        } else {
            $this->db->select('eap.activity_planning_date,eap.execution_date,eap.execution_time,eap.activity_planning_time,eap.activity_planning_id,eap.status');
            // $this->db->select('*');
        }
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('ecp_activity_master_country as eamc','eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->join('master_political_geography_details as mpgd','mpgd.political_geo_id = eap.geo_level_id');

        $this->db->where('eap.country_id', $country_id);
        $this->db->where('eap.employee_id', $user_id);
        //$this->db->where('eap.status','4');

        $cmy = $cur_month . "-" . $cur_year;
        $this->db->where("(DATE_FORMAT(eap.activity_planning_date,'%c-%Y') = '$cmy'
                            OR DATE_FORMAT(eap.execution_date,'%c-%Y') = '$cmy')
                        ");

        $this->db->order_by('eap.activity_planning_time','ASC');
        $activity_details = $this->db->get()->result_array();

       // echo $this->db->last_query();die;

        if (isset($activity_details) && !empty($activity_details)) {
            return $activity_details;
        } else {
            return false;
        }
    }

    public function all_activity_view($user_id, $country_id, $web_service = null,$cur_month=null,$cur_year=null)
    {
        if (isset($web_service) && !empty($web_service) && $web_service == 'web_service') {
            $this->db->select('eap.activity_planning_date,eap.execution_date,eap.execution_time,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id,eap.status');
        } else {
            $this->db->select('eap.activity_planning_date,eap.execution_date,eap.execution_time,eap.activity_planning_time,eamc.activity_type_country_name,mpgd.political_geography_name,eap.activity_planning_id,eap.status');
        }
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('ecp_activity_master_country as eamc', 'eamc.activity_type_country_id = eap.activity_type_id');
        $this->db->join('master_political_geography_details as mpgd', 'mpgd.political_geo_id = eap.geo_level_id');

        $this->db->where('eap.country_id', $country_id);
        $this->db->where('eap.employee_id', $user_id);

        $cmy = $cur_month . "-" . $cur_year;
        $this->db->where("(DATE_FORMAT(eap.activity_planning_date,'%c-%Y') = '$cmy'
                            OR DATE_FORMAT(eap.execution_date,'%c-%Y') = '$cmy')
                        ");

        $this->db->order_by('eap.activity_planning_time', 'ASC');

        $activity_details = $this->db->get()->result_array();


        if (isset($activity_details) && !empty($activity_details))
        {
            $dt_array = array();

            $date_array = array();
            foreach ($activity_details as $k => $val)
            {

                $val_pla_date = date("n-Y",strtotime($val["activity_planning_date"]));
                $val_exe_date = date("n-Y",strtotime($val["execution_date"]));

                if($val_pla_date == $cmy || $val_exe_date == $cmy)
                {
                    $act_date = ((!is_null($val["execution_date"]) && trim($val["execution_date"])!='' && $val_exe_date == $cmy) ? $val["execution_date"] : $val["activity_planning_date"]);
                    if(!isset($dt_array[$act_date]))
                    {
                        $dt_array[$act_date] = array();
                    }
                    $date_array[$act_date][] = $val;
                }
            }
            ksort($date_array);

            if (isset($web_service) && !empty($web_service) && $web_service == 'web_service')
            {
                $date_array = array_values($date_array);

                return $date_array;
            }
            else
            {
                return $date_array;
            }
        }
        else
        {
            return false;
        }
    }

    public function get_demonstration_by_id($user_id,$country_id,$web_service=null,$activity_id=null)
    {
        if(isset($web_service) && !empty($web_service) && $web_service == 'web_service')
        {
            if($activity_id == '6'){
                $sql ='SELECT eap.activity_planning_id,eap.execution_date,eap.execution_time,mpgd.political_geography_name
                FROM bf_ecp_activity_planning as eap
                 JOIN bf_master_political_geography_details AS mpgd ON (mpgd.political_geo_id = eap.geo_level_id)
                 JOIN bf_ecp_activity_master_country AS eamc ON (eamc.activity_type_id = eap.activity_type_id)
                 WHERE eap.employee_id ='.$user_id.'
                 AND eap.country_id ='.$country_id.'
                 AND eamc.activity_type_code = "DP005"
                 AND eap.execution_date <= DATE_SUB(CURDATE(), INTERVAL -2 MONTH)';
                $info = $this->db->query($sql);
                $activity_details = $info->result_array();
                if(isset($activity_details) && !empty($activity_details))
                {
                    return $activity_details;
                }
                else{
                    return array();
                }
            }
            else{
                return array();
            }

        }
        else{
            $sql ='SELECT eap.activity_planning_id,eap.execution_date,eap.execution_time,mpgd.political_geography_name
                FROM bf_ecp_activity_planning as eap
                 JOIN bf_master_political_geography_details AS mpgd ON (mpgd.political_geo_id = eap.geo_level_id)
                 JOIN bf_ecp_activity_master_country AS eamc ON (eamc.activity_type_id = eap.activity_type_id)
                 WHERE eap.employee_id ='.$user_id.'
                 AND eap.country_id ='.$country_id.'
                 AND eamc.activity_type_code = "DP005"
                 AND eap.execution_date <= DATE_SUB(CURDATE(), INTERVAL -2 MONTH)';
            $info = $this->db->query($sql);
            $activity_details = $info->result_array();
            if(isset($activity_details) && !empty($activity_details))
            {
                return $activity_details;
            }
            else{
                return array();
            }
        }

    }

    public function get_details_by_planning_id($id,$user_id,$country_id)
    {
        $this->db->select('eap.geo_level_id_2,eap.geo_level_id_3,eap.geo_level_id_4,eap.location,size_of_plot,eap.spray_volume,mpgd2.political_geography_name as geo_level_2,mpgd3.political_geography_name as geo_level_3,mpgd4.political_geography_name as geo_level_4');
        //$this->db->select('*');
        $this->db->from('ecp_activity_planning as eap');
        $this->db->join('master_political_geography_details as mpgd2','mpgd2.political_geo_id = eap.geo_level_id_2');
        $this->db->join('master_political_geography_details as mpgd3','mpgd3.political_geo_id = eap.geo_level_id_3');
        $this->db->join('master_political_geography_details as mpgd4','mpgd4.political_geo_id = eap.geo_level_id_4');
        $this->db->where('activity_planning_id',$id);
        $this->db->where('employee_id',$user_id);
        $this->db->where('country_id',$country_id);
        $activity_details = $this->db->get()->row_array();
       if(isset($activity_details) && !empty($activity_details))
       {
           return $activity_details;
       }
       else {
           return 0;
        }
    }


    public function update_activity_reson_detail($user_id,$country_id)
    {
      /* if(isset($web_service) && !empty($web_service) && $web_service=='web_service')
        {
            $planning_id = $this->input->post("planning_id");
            $cancle_reson = $this->input->post("cancle_reson");
        }
        else{*/
            $planning_id = $this->input->post("planning_id");
            $cancle_reson = $this->input->post("cancle_reson");
      /*  }*/

        $activity_planning = array(

            'cancle_reson' => (isset($cancle_reson) && !empty($cancle_reson))  ? $cancle_reson : '',
            'status' => '5',
            'modified_by_user' => $user_id,
            'modified_on' => date('Y-m-d H:i:s'),

        );

        $this->db->where('activity_planning_id',$planning_id);
        $this->db->update('ecp_activity_planning', $activity_planning);

        if ($this->db->affected_rows() > 0) {
           return 1;
        }
        else{
            return 0;
        }
    }


    public function rescheduling_activity_detail($user_id,$country_id,$type)
    {
        if($type == 'reschedule'){
            $planning_id = $this->input->post("planning_id");
        }
        else
        {
            $planning_id = $this->input->post("inserted_activity_planning_id");
        }

        $plan_date = $this->input->post("planning_date");
        $pl_date = str_replace('/', '-', $plan_date);
        $planning_date = date('Y-m-d', strtotime($pl_date));

        $pl_time = $this->input->post("planning_time");
        $date_time= $planning_date.' '.$pl_time;
        $planning_time = date('Y-m-d H:i:s', strtotime($date_time));

       $activity_details =  $this->editViewActivityPlanning($planning_id);

        $activity_type_id = $activity_details['activity_type_id'];
        $geo_level_2 = $activity_details['geo_level_id_2'];
        $geo_level_3 = $activity_details['geo_level_id_3'];
        $geo_level_4 = $activity_details['geo_level_id_4'];
        if(!empty($geo_level_4))
        {
            $geo = $activity_details['geo_level_id_4'];
        }
        else{
            $geo = $activity_details['geo_level_id_3'];
        }
        $geo_level = $geo;
        $activity_address = $activity_details['location'];
        $attandence_count = $activity_details['proposed_attandence_count'];
        $pod = $activity_details['point_discussion'];
        $set_alert = $activity_details['alert'];
        $size_of_plot = $activity_details['size_of_plot'];
        $spray_volume = $activity_details['spray_volume'];
        $status = '1';
        $submit_status = '1';
        $activity_planning_id = $activity_details['activity_planning_id'];


        if($type == 'reschedule'){
            $activity_planning = array(
                'activity_planning_date' => isset($planning_date) ? $planning_date : '',
                'activity_planning_time' => isset($planning_time) ? $planning_time : '',
                'activity_type_id' => isset($activity_type_id) ? $activity_type_id : '',
                'geo_level_id_2' => (isset($geo_level_2) && !empty($geo_level_2)) ? $geo_level_2 : 0,
                'geo_level_id_3' => (isset($geo_level_3) && !empty($geo_level_3)) ? $geo_level_3 : 0,
                'geo_level_id_4' => (isset($geo_level_4) && !empty($geo_level_4)) ? $geo_level_4 : 0,
                'geo_level_id' => (isset($geo_level) && !empty($geo_level)) ? $geo_level : 0,
                'location' => isset($activity_address) ? $activity_address :''   ,
                'proposed_attandence_count' => (isset($attandence_count) && !empty($attandence_count)) ? $attandence_count : '0',
                'point_discussion' => isset($pod) ? $pod : '',
                'alert' => isset($set_alert) ? $set_alert : '',
                'size_of_plot' => (isset($size_of_plot) && !empty($size_of_plot)) ? $size_of_plot : 0,
                'spray_volume' => (isset($spray_volume) && !empty($spray_volume)) ? $spray_volume : 0,
                'amount' => '0',
                'employee_id' => $user_id,
                'country_id' => $country_id,
                'status' => (isset($status) && !empty($status)) ? $status : 0,
                'submit_status' =>  (isset($submit_status) && !empty($submit_status)) ? $submit_status : 0,
                'submit_date' =>  date('Y-m-d'),
                'reference_type' => '2',
                'reference_id' => $activity_planning_id,
                'is_planned' => '1',
                'created_by_user' => $user_id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_on' => date('Y-m-d H:i:s'),

            );
        }
        else{
            $activity_planning = array(
                'activity_planning_date' => isset($planning_date) ? $planning_date : '',
                'activity_planning_time' => isset($planning_time) ? $planning_time : '',
                'activity_type_id' => isset($activity_type_id) ? $activity_type_id : '',
                'geo_level_id_2' => (isset($geo_level_2) && !empty($geo_level_2)) ? $geo_level_2 : 0,
                'geo_level_id_3' => (isset($geo_level_3) && !empty($geo_level_3)) ? $geo_level_3 : 0,
                'geo_level_id_4' => (isset($geo_level_4) && !empty($geo_level_4)) ? $geo_level_4 : 0,
                'geo_level_id' => (isset($geo_level) && !empty($geo_level)) ? $geo_level : 0,
                'location' => isset($activity_address) ? $activity_address :''   ,
                'proposed_attandence_count' => (isset($attandence_count) && !empty($attandence_count)) ? $attandence_count : '0',
                'point_discussion' => isset($pod) ? $pod : '',
                'alert' => isset($set_alert) ? $set_alert : '',
                'size_of_plot' => (isset($size_of_plot) && !empty($size_of_plot)) ? $size_of_plot : 0,
                'spray_volume' => (isset($spray_volume) && !empty($spray_volume)) ? $spray_volume : 0,
                'amount' => '0',
                'employee_id' => $user_id,
                'country_id' => $country_id,
                'status' =>  '0',
                'submit_status' =>  '1',
                'submit_date' =>  date('Y-m-d'),
                'reference_type' => '1',
                'reference_id' => $activity_planning_id,
                'is_planned' => '1',
                'created_by_user' => $user_id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_on' => date('Y-m-d H:i:s'),

            );
        }


        $insert_array = array();
        if ($this->db->insert('ecp_activity_planning', $activity_planning)) {

            if ($this->db->affected_rows() > 0) {
                $insert_array[]=1;

            }
            $insert_id = $this->db->insert_id();

            if (isset($activity_details['crop']) && !empty($activity_details['crop'])) {

                foreach ($activity_details['crop'] as $key => $crp) {
                    $corp_detail = array(
                        'activity_planning_id' => $insert_id,
                        'crop_id' => (isset($crp['crop_id']) && !empty($crp['crop_id'])) ? $crp['crop_id'] : 0,
                    );

                    $this->db->insert('ecp_activity_planning_crop_details', $corp_detail);
                    if ($this->db->affected_rows() > 0) {
                        $insert_array[]=1;

                    }
                }


            }

            if (isset($activity_details['products']) && !empty($activity_details['products'])) {
                foreach ($activity_details['products'] as $key => $prd_sku) {
                    $product_detail = array(
                        'activity_planning_id' => $insert_id,
                        'product_sku_id' => (isset($prd_sku['product_sku_id']) && !empty($prd_sku['product_sku_id'])) ? $prd_sku['product_sku_id'] : 0,
                    );

                    $this->db->insert('ecp_activity_planning_product_details', $product_detail);

                    if ($this->db->affected_rows() > 0) {
                        $insert_array[]=1;

                    }
                }
            }


            if (isset($activity_details['diseases']) && !empty($activity_details['diseases'])) {

                foreach ($activity_details['diseases'] as $key => $val) {
                    $diseases_details = array(
                        'activity_planning_id' => $insert_id,
                        'diseases_id' => (isset($val['diseases_id']) && !empty($val['diseases_id'])) ? $val['diseases_id'] : 0,
                    );

                    $this->db->insert('ecp_activity_planning_diseases_details', $diseases_details);

                    if ($this->db->affected_rows() > 0) {
                        $insert_array[]=1;

                    }

                }
            }

            if (isset($activity_details['key_farmer']) && !empty($activity_details['key_farmer'])) {

                foreach ($activity_details['key_farmer'] as $k => $val_frm) {
                    $key_farmer_details = array(
                        'activity_planning_id' => $insert_id,
                        'customer_id' => (isset($val_frm['customer_id']) && !empty($val_frm['customer_id'])) ? $val_frm['customer_id'] : 0,
                        'mobile_no' => (isset($val_frm['mobile_no']) && !empty($val_frm['mobile_no'])) ? $val_frm['mobile_no'] : '',
                    );

                    $this->db->insert('ecp_activity_planning_key_customer_details', $key_farmer_details);

                    if ($this->db->affected_rows() > 0) {
                        $insert_array[]=1;

                    }
                }
            }


            if (isset($activity_details['digital_library']) && !empty($activity_details['digital_library'])) {

                foreach ($activity_details['digital_library'] as $k => $val_digital) {

                    $digital_library_details = array(
                        'activity_planning_id' => $insert_id,
                        'digital_library_id' => (isset($val_digital['digital_library_details_id']) && !empty($val_digital['digital_library_details_id'])) ? $val_digital['digital_library_details_id'] : 0,
                    );

                    $this->db->insert('ecp_activity_planning_digital_library_details', $digital_library_details);

                    if ($this->db->affected_rows() > 0) {
                        $insert_array[]=1;

                    }
                }
            }


            if (isset($activity_details['join_visit']) && !empty($activity_details['join_visit'])) {

                foreach ($activity_details['join_visit'] as $k => $val_joint) {
                    $joint_details = array(
                        'activity_planning_id' => $insert_id,
                        'employee_id' => (isset($val_joint['employee_id']) && !empty($val_joint['employee_id'])) ? $val_joint['employee_id'] : 0,
                    );

                    $this->db->insert('ecp_activity_planning_joint_visit_details', $joint_details);

                    if ($this->db->affected_rows() > 0) {
                        $insert_array[]=1;

                    }
                }

            }


            if (isset($activity_details['products_sample']) && !empty($activity_details['products_sample'])) {

                foreach ($activity_details['products_sample'] as $K => $val_product) {
                    $product_samples_details = array(
                        'activity_planning_id' => $insert_id,
                        'product_sku_id' => (isset($val_product['product_sku_id']) && !empty($val_product['product_sku_id'])) ? $val_product['product_sku_id'] : 0,
                        'quantity' => (isset($val_product['quantity']) && !empty($val_product['quantity'])) ? $val_product['quantity'] : 0,
                    );

                    $this->db->insert('ecp_activity_planning_promo_sample_details', $product_samples_details);

                    if ($this->db->affected_rows() > 0) {
                        $insert_array[]=1;

                    }
                }

            }


            if (isset($activity_details['products_request']) && !empty($activity_details['products_request'])) {

                foreach ($activity_details['products_request'] as $K => $vals) {
                    $product_materials_details = array(
                        'activity_planning_id' => $insert_id,
                        'product_sku_id' => (isset($vals['product_sku_id']) && !empty($vals['product_sku_id'])) ? $vals['product_sku_id'] : 0,
                        'quantity' => (isset($vals['quantity']) && !empty($vals['quantity'])) ? $vals['quantity'] : 0,
                    );

                    $this->db->insert('ecp_activity_planning_required_product_details', $product_materials_details);

                    if ($this->db->affected_rows() > 0) {
                        $insert_array[]=1;

                    }
                }
            }

            if (isset($activity_details['material_request']) && !empty($activity_details['material_request'])) {

                foreach ($activity_details['material_request'] as $K => $val_materials) {
                    $materials_details = array(
                        'activity_planning_id' => $insert_id,
                        'material_id' => (isset($val_materials['material_id']) && !empty($val_materials['material_id'])) ? $val_materials['material_id'] : 0,
                        'quantity' => (isset($val_materials['quantity']) && !empty($val_materials['quantity'])) ? $val_materials['quantity'] : 0,
                    );

                    $this->db->insert('ecp_activity_planning_required_material_details', $materials_details);

                    if ($this->db->affected_rows() > 0) {
                        $insert_array[]=1;
                    }
                }
            }
        }

        if(in_array(1,$insert_array))
        {
            if($type == 'reschedule'){
                $activity_planning = array(
                    //'cancle_reson' => (isset($cancle_reson) && !empty($cancle_reson))  ? $cancle_reson : '',
                    'status' => '5',
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s'),

                );

                $this->db->where('activity_planning_id',$planning_id);
                $this->db->update('ecp_activity_planning', $activity_planning);


                if ($this->db->affected_rows() > 0) {
                    return 1;
                }
                else{
                    return 0;
                }
            }
            else{
                return 1;
            }
        }
        else{
            return 0;
        }
    }


    public function getActivityDateByTypes($user_id,$country_id,$mode,$month)
    {
        /*if($mode == strtolower('all')){

        }*/

        $status = '';
        if($mode == strtolower('incomplete'))
        {
            $status = '0';
        }
        elseif($mode == strtolower('approved'))
        {
            $status = '2';
        }
        elseif($mode == strtolower('rejected'))
        {
            $status = '3';
        }
        elseif($mode == strtolower('pending'))
        {
            $status = '1';
        }


        $this->db->distinct();
        $this->db->select('activity_planning_date');
        $this->db->from('ecp_activity_planning');
        $this->db->where('employee_id',$user_id);
        $this->db->where('country_id',$country_id);
        if(trim($status)!='')
        {
            $this->db->where('status',$status);
        }
        $this->db->where('DATE_FORMAT(activity_planning_date,"%Y-%c")',$month);
        $activity_details = $this->db->get()->result_array();

        if(isset($activity_details) && !empty($activity_details))
        {
            return $activity_details;
        }
        else {
            return 0;
        }
    }





    public function get_all_activity_details($radio_check,$from_date,$to_date,$activity_type,$country_id,$local_date=null,$page=null)
    {
        if($radio_check == 'planned_activity')
        {
            $status = 2;
        }
        else{
            $status = 4;
        }

        $sql = 'SELECT eap.activity_planning_id,eap.activity_planning_time,eap.execution_time,eap.proposed_attandence_count,bu.display_name,bu.user_code,mdc.desigination_country_name,eamc.activity_type_country_name,eamc.activity_type_code,mpgd2.political_geography_name as geo_level_2,mpgd3.political_geography_name as geo_level_3,mpgd4.political_geography_name as geo_level_4 ';

        //count(eapad.activity_planning_id) as attend_count
        $sql .= 'FROM bf_ecp_activity_planning AS eap ';
        $sql .= 'LEFT JOIN bf_users AS bu ON (bu.id = eap.employee_id) ';
        $sql .= 'LEFT JOIN bf_master_designation_role AS mdr ON (mdr.user_id = bu.id) ';
        $sql .= 'LEFT JOIN bf_master_designation_country AS mdc ON (mdc.desigination_country_id = mdr.desigination_role_id) ';
        $sql .= 'LEFT JOIN bf_ecp_activity_master_country AS eamc ON (eamc.activity_type_country_id = eap.activity_type_id) ';
        $sql .= 'LEFT JOIN bf_master_political_geography_details AS mpgd2 ON (mpgd2.political_geo_id = eap.geo_level_id_2) ';
        $sql .= 'LEFT JOIN bf_master_political_geography_details as mpgd3 ON (mpgd3.political_geo_id = eap.geo_level_id_3) ';
        $sql .= 'LEFT JOIN bf_master_political_geography_details as mpgd4 ON (mpgd4.political_geo_id = eap.geo_level_id_4) ';
       // $sql .= 'LEFT JOIN bf_ecp_activity_planning_attendees_details as eapad ON (eapad.activity_planning_id = eap.activity_planning_id) ';

        $sql .= 'WHERE 1 ';
        $sql .= ' AND eap.country_id ="' . $country_id . '" ';
        $sql .= ' AND eap.status = ' . $status . ' ';
        $sql .= ' AND eap.activity_type_id = ' . $activity_type . ' ';
        $sql .= ' AND eap.is_cco = 0';
        if($status == 4)
        {
            $sql .= ' AND eap.execution_date BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $to_date . '"' . ' ';
        }
        else{
            $sql .= ' AND eap.activity_planning_date BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $to_date . '"' . ' ';
        }
        $sql .= ' ORDER BY eap.activity_planning_id  DESC ';

      //  echo $sql;
        $activity_approval = $this->grid->get_result_res($sql);

       // testdata($activity_approval);
        if (isset($activity_approval['result']) && !empty($activity_approval['result'])) {


            if($radio_check == 'planned_activity'){
                $activity['head'] = array('Sr. No.', 'Select', 'Employee Name', 'Designation','Geo Level 3','Geo Level 2','Geo Level 1', 'Activity Planned Date', 'Minimum No. Of Attendances ');

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



                    $activity['row'][] = array($i, $rm['activity_planning_id'], $rm['display_name'], $rm['desigination_country_name'],$rm['geo_level_2'],$rm['geo_level_3'],$rm['geo_level_4'],$activity_date, $rm['proposed_attandence_count'] );
                    $i++;
                }
            }
            else{
                $activity['head'] = array('Sr. No.', 'Select', 'Employee Name', 'Designation','Geo Level 3','Geo Level 2','Geo Level 1', 'Activity Execute Date', 'Minimum No. Of Attendances ');

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



                    $activity['row'][] = array($i, $rm['activity_planning_id'], $rm['display_name'], $rm['desigination_country_name'],$rm['geo_level_2'],$rm['geo_level_3'],$rm['geo_level_4'],$activity_date, $rm['proposed_attandence_count'] );
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


    public function totalPendingActivitys($user_id, $country_id)
    {
       $this->db->select('*');
       $this->db->from('bf_ecp_activity_planning');
       $this->db->where('employee_id',$user_id);
       $this->db->where('country_id',$country_id);
       $this->db->where('status','1');
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    /*public function check_planning_date_by_leave($user_id,$country_id,$leave_date)
    {
        $this->db->select('*');
        $this->db->from('ecp_activity_planning');
        $this->db->where('employee_id',$user_id);
        $this->db->where('country_id',$country_id);
        $this->db->where('activity_planning_date',$leave_date);
        //$this->db->where('status','1');
        $activity_details = $this->db->get()->result_array();
        testdata($activity_details);
    }*/



}
