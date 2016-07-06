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
        $this->db->where('country_id',$country_id );
        $this->db->where('status','1');
        $this->db->where('deleted','0');
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

    public function add_material_request_detail($user_id,$country_id)
    {
        $request_date = $this->input->post("material_request_date");

        $req_date = str_replace('/', '-', $request_date);
        $material_request_date =  date('Y-m-d', strtotime($req_date));
        $promotional_country_id = $this->input->post("promotional_country_id");
        $quantity = $this->input->post("quantity");
        $remark = $this->input->post("remark");

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
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    /**
     * @ Function Name        : get_all_materials_by_country_id
     * @ Function Params    : $country_id
     * @ Function Purpose    : Return list of requested materials
     * @ Function Return    : Array
     * */

    public function get_all_materials_by_country_id($country_id,$page = null,$local_date = null)
    {
        $sql = 'SELECT emr.material_request_id,emr.material_request_date,mpmc.promotional_material_country_name,emr.quantity,bu.display_name as emp,emr.material_request_status,emr.recived_status,emr.disptched_date,buu.display_name as updated_user,emr.modified_on ';
        $sql .= 'FROM bf_ecp_material_request AS emr ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = emr.employee_id) ';
        $sql .= 'JOIN bf_users AS buu ON (buu.id = emr.modified_by_user) ';
        $sql .= 'JOIN bf_master_promotional_material_country AS mpmc ON (mpmc.promotional_country_id = emr.promotional_country_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND emr.country_id ="' . $country_id . '" ';
        $sql .= 'ORDER BY emr.material_request_id DESC ';
        $requested_material = $this->grid->get_result_res($sql);

        if (isset($requested_material['result']) && !empty($requested_material['result'])) {
            $material['head'] = array('Sr. No.', 'Action', 'Date', 'Mr.Id', 'Material', 'Quantity', 'Employee Name', 'Status', 'Received','Last Update','Last Updated By','Dispatch Date');
            $material['count'] = count($material['head']);
            if ($page != null || $page != "") {
                $i = $page * 10 - 9;
            } else {
                $i = 1;
            }

            foreach ($requested_material['result'] as $rm) {

                if($local_date != null)
                {
                    $date3 = strtotime($rm['material_request_date']);
                    $request_date = date($local_date,$date3);

                    if($rm['disptched_date'] !=null){
                        $date1 = strtotime($rm['disptched_date']);
                        $disptched_date = date($local_date,$date1);
                    }
                    else{
                        $disptched_date =  '';
                    }
                    $date2 = strtotime($rm['modified_on']);
                    $modified_on_date = date($local_date,$date2);

                }
                else{
                    $request_date = $rm['material_request_date'];
                    $disptched_date = $rm['disptched_date'];
                    $modified_on_date = $rm['modified_on'];
                }

                if($rm['material_request_status'] == 0){
                    $material_request_status = 'Pending';
                    $material['delete_disabled'][] = 0;
                }
                elseif($rm['material_request_status'] == 1){
                    $material_request_status = 'Approve';
                    $material['delete_disabled'][] = 1;
                }else{
                    $material_request_status = 'Reject';
                    $material['delete_disabled'][] = 1;
                }

                if($rm['material_request_status'] == 1){

                    if ($rm['recived_status'] == '0') {
                        $received_status = '<select name="received_status" class="received_status" id="received_status" ><option value="0">Pending</option><option  value="1">Confirm</option></select>
                    <input type="hidden" id="mr_id" class="mr_id" name="mr_id" value="' . $rm['material_request_id'] . '">';
                    } else {
                        $received_status = 'Confirm';
                    }
                }
                else{
                    if ($rm['recived_status'] == '0') {
                        $received_status = 'Pending';
                    } else {
                        $received_status = 'Confirm';
                    }
                }

                $material['row'][] = array($i, $rm['material_request_id'],$request_date ,$rm['material_request_id'] , $rm['promotional_material_country_name'], $rm['quantity'],$rm['emp'],$material_request_status,$received_status,$modified_on_date,$rm['updated_user'],$disptched_date);
                $i++;
            }
            $material['eye'] = '';
            $material['action'] = 'is_action';
            $material['edit'] = '';
            $material['delete_dis'] = 'is_delete';
            $material['pagination'] = $requested_material['pagination'];
            return $material;
        }
        else{
            return false;
        }
    }

    public function update_material_request_detail($user_id,$mr_id,$status)
    {
        $update_material = array(
            'recived_status' => $status,
            'modified_by_user' => $user_id,
            'modified_on' => date('Y-m-d H:i:s')
        );

        $this->db->where('material_request_id', $mr_id);
        $this->db->update('ecp_material_request', $update_material);
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function get_all_employee_by_country_id($country_id)
    {
        $this->db->select('display_name,id,bussiness_code');
        $this->db->from('users');
        $this->db->where('country_id',$country_id );
        $this->db->where('active','1');
        $this->db->where('role_id','8');
        $employee = $this->db->get()->result_array();
        if (isset($employee) && !empty($employee)) {
            return $employee;
        } else {
            return false;
        }
    }

    public function get_all_materials_request_details_view($from_date, $to_date, $status_id, $employee_id,$page,$local_date,$country_id)
    {
        $sql = 'SELECT emr.material_request_id,emr.material_request_date,mpmc.promotional_material_country_name,emr.quantity,bu.display_name as emp,bu.user_code,emr.material_request_status,emr.recived_status,emr.disptched_date,emr.disptched_qty,emr.remark,emr.executor_remark ';
        $sql .= 'FROM bf_ecp_material_request AS emr ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = emr.employee_id) ';
        $sql .= 'JOIN bf_users AS buu ON (buu.id = emr.modified_by_user) ';
        $sql .= 'JOIN bf_master_promotional_material_country AS mpmc ON (mpmc.promotional_country_id = emr.promotional_country_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND emr.country_id ="' . $country_id . '" ';
        if(isset($from_date) && !empty($from_date) && isset($to_date) && !empty($to_date)){
            $sql .= ' AND emr.material_request_date BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $to_date . '"' . ' ';
        }
        $sql .= 'AND emr.material_request_status ="' . $status_id . '" ';

        if(isset($employee_id) && !empty($employee_id)){
            $sql .= 'AND emr.employee_id ="' . $employee_id . '" ';
        }
        $sql .= 'AND emr.country_id ="' . $country_id . '" ';
        $sql .= 'ORDER BY emr.material_request_id DESC ';
        $requested_material = $this->grid->get_result_res($sql);

        if (isset($requested_material['result']) && !empty($requested_material['result'])) {
            $material['head'] = array('Sr. No.', 'Action', 'Mr.Id','Employee Code','Employee Name','Requested Date','Requested Material', 'Requested Quantity','Dispatched Date','Dispatched Quantity','Remark', 'Status', 'Received Status','Executor Remark',);
            $material['count'] = count($material['head']);
            if ($page != null || $page != "") {
                $i = $page * 10 - 9;
            } else {
                $i = 1;
            }

            foreach ($requested_material['result'] as $rm) {

                if($local_date != null)
                {
                    $date3 = strtotime($rm['material_request_date']);
                    $request_date = date($local_date,$date3);

                    if($rm['disptched_date'] !=null){
                        $date1 = strtotime($rm['disptched_date']);
                        $disptched_date = date($local_date,$date1);
                    }
                    else{
                        $disptched_date =  '';
                    }

                }
                else{
                    $request_date = $rm['material_request_date'];
                    $disptched_date = $rm['disptched_date'];
                }

                /*material_request_status*/
                if($rm['material_request_status'] == 0){
                    $material['delete_disabled'][] = 0;
                }
                elseif($rm['material_request_status'] == 1){
                    $material['delete_disabled'][] = 1;
                }else{
                    $material['delete_disabled'][] = 1;
                }
                /*material_request_status*/

                if($rm['recived_status'] == 0){
                    $received_status='Pending';
                }
                else{
                    $received_status='Confirm';
                }


                    if ($rm['material_request_status'] == '0') {
                        $request_status = '<select name="request_status" class="request_status" id="request_status" ><option value="0">Pending</option><option  value="1">Approve</option><option  value="1">Reject</option></select>
                    <input type="hidden" id="mr_id" class="mr_id" name="mr_id" value="' . $rm['material_request_id'] . '">';
                    }
                    elseif($rm['material_request_status'] == '1') {
                        $request_status = 'Approve';
                    }
                    else{
                        $request_status = 'Reject';
                    }

                $remark ='<textarea name="remarks" id="remarks" readonly>'.$rm["remark"].'</textarea>';
                if($rm['material_request_status'] == '0'){
                    $executor_remark ='<textarea name="executor_remarks" id="executor_remark">'.$rm["executor_remark"].'</textarea>';
                    $disptched_quantity = '<input type="text" id="disptched_quantity" name="disptched_quantity">';
                }
                else{
                    $executor_remark ='<textarea name="executor_remark" id="executor_remark" readonly>'.$rm["executor_remark"].'</textarea>';
                    $disptched_quantity = $rm['disptched_qty'];
                }


                $material['row'][] = array($i, $rm['material_request_id'],$rm['material_request_id'],$rm['user_code'],$rm['emp'],$request_date , $rm['promotional_material_country_name'], $rm['quantity'],$disptched_date,$disptched_quantity,$remark,$request_status,$received_status,$executor_remark);
                $i++;
            }
            $material['eye'] = '';
            $material['action'] = 'is_action';
            $material['edit'] = '';
            $material['delete_dis'] = 'is_delete';
            $material['pagination'] = $requested_material['pagination'];

            return $material;
        }
        else{
            return false;
        }
    }


    public function update_materials_detail($user_id)
    {
        $disptched_quantity = $this->input->post("disptched_quantity");
        $request_status = $this->input->post("request_status");
        $mr_id = $this->input->post("mr_id");
        $executor_remarks = $this->input->post("executor_remarks");
        $disptched_date = date('Y-m-d');

        $update_material_details = array(
            'disptched_qty' => $disptched_quantity,
            'material_request_status' => $request_status,
            'executor_remark' => $executor_remarks,
            'disptched_date' => $disptched_date,
            'modified_by_user' => $user_id,
            'modified_on' => date('Y-m-d H:i:s')
        );

        $this->db->where('material_request_id', $mr_id);
        $this->db->update('ecp_material_request', $update_material_details);
        if($this->db->affected_rows() > 0){
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
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }


}