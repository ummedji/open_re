<?php defined('BASEPATH') || exit('No direct script access allowed');

class Ishop_model extends BF_Model
{

    public function __construct()
    {

        parent::__construct();
        $config = array();
        $this->load->library("CH_Grid_generator", $config, "grid");
    }

    /**
     * @ Function Name        : get_distributor_by_user_id
     * @ Function Params    : $country_id
     * @ Function Purpose    : Return list of distributor
     * @ Function Return    : Array
     * */

    public function get_distributor_by_user_id($country_id)
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('type', 'customer');
        $this->db->where('role_id', '9');
        $this->db->where('country_id', $country_id);
        $distributor = $this->db->get()->result_array();
        if (isset($distributor) && !empty($distributor)) {
            return $distributor;
        } else {
            return false;
        }
    }

    /**
     * @ Function Name        : get_product_sku_by_user_id
     * @ Function Params    : $country_id
     * @ Function Purpose    : Return list of products
     * @ Function Return    : Array
     * */

    /*  Set in product modules*/
    public function get_product_sku_by_user_id($country_id)
    {
        $this->db->select('psc.product_sku_country_id,psc.product_sku_name,psr.product_sku_code,ptlc.product_type_label_name');
        $this->db->from('master_product_sku_country as psc');
        $this->db->join('master_product_sku_regional as psr', 'psr.product_sku_id = psc.product_sku_id');
        $this->db->join('master_product_type_label_regional as ptlr', 'ptlr.product_type_label_regional_id = psc.PBG');
        $this->db->join('master_product_type_label_country as ptlc', 'ptlc.product_type_label_country_id = ptlr.product_type_label_regional_id');
        $this->db->where('ptlc.country_id', $country_id);
        $product_sku = $this->db->get()->result_array();
        //testdata($product_sku);
        if (isset($product_sku) && !empty($product_sku)) {
            return $product_sku;
        } else {
            return false;
        }
    }

    public function check_invoice_data($invoice_no,$user_data =null)
    {
        $this->db->select('*');
        $this->db->from('ishop_primary_sales');
        $this->db->where('invoice_no', $invoice_no);
        if($user_data != null){
            $this->db->where('customer_id !=', $user_data);
        }
        $invoice_data = $this->db->get()->result_array();
        if (isset($invoice_data) && !empty($invoice_data)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function check_otn_data($otn)
    {
        $this->db->select('*');
        $this->db->from('ishop_primary_sales');
        $this->db->where('order_tracking_no', $otn);
        $otn = $this->db->get()->result_array();
        if (isset($otn) && !empty($otn)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function check_duplicate_data_for_primary_sales($customer_id, $invoice_no)
    {
        $this->db->select('*');
        $this->db->from('ishop_primary_sales');
        $this->db->where('invoice_no', $invoice_no);
        $this->db->where_not_in('customer_id', $customer_id);
        $check = $this->db->get()->result_array();
       // testdata($check);
        if (isset($check) && !empty($check)) {
            return 1;
        } else {
            $this->db->select('*');
            $this->db->from('ishop_primary_sales');
            $this->db->where('invoice_no', $invoice_no);
            $this->db->where('customer_id', $customer_id);
            $data = $this->db->get()->row_array();
          //  testdata($data);
            if(isset($data) && !empty($data))
            {
                return 2;
            }
            else{
                return 0;
            }
        }
    }

    public function get_data_primary_sales_by_invoice_no($invoice_no,$customer_id)
    {
        $this->db->select('primary_sales_id,customer_id,PO_no,order_tracking_no,invoice_no,invoice_date,total_amount,invoice_recived_status');
        $this->db->from('ishop_primary_sales');
        $this->db->where('invoice_no', $invoice_no);
        if(isset($customer_id) && !empty($customer_id)){
            $this->db->where('customer_id', $customer_id);
        }
        $data = $this->db->get()->row_array();

        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return false;
        }

    }

    public function get_data_primary_sales_product_by_invoice($primary_sales_id)
    {
        $this->db->select('psr.product_sku_code,psc.product_sku_name,ipsp.dispatched_quantity,ipsp.quantity,ipsp.amount,ipsp.product_sku_id');
        $this->db->from('ishop_primary_sales_product as ipsp');
        $this->db->join('master_product_sku_country as psc', 'psc.product_sku_id = ipsp.product_sku_id');
        $this->db->join('master_product_sku_regional as psr', 'psr.product_sku_id = psc.product_sku_id');
        $this->db->where('primary_sales_id', $primary_sales_id);
        $data = $this->db->get()->result_array();
        // testdata($data);
        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * @ Function Name        : get_product_sku_by_user_id
     * @ Function Params    :
     * @ Function Purpose    : Return list of products
     * @ Function Return    : Array
     * */

    public function add_primary_sales_details($user_id, $country_id, $web_service = null, $xl_data = null, $xl_flag = null)
    {
        if ($xl_flag == null) {
            $invoice_no = $this->input->post("invoice_no");
            $invoice_date = $this->input->post("invoice_date");
            $order_tracking_no = $this->input->post("order_tracking_no");
            $PO_no = $this->input->post("PO_no");

            if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
                $customer_id = $this->input->post("distributor_id");
                $product_sku_id = explode(',', $this->input->post("product_sku_id"));
                $quantity = explode(',', $this->input->post("quantity"));
                $dispatched_quantity = explode(',', $this->input->post("dispatched_quantity"));
                $amount = explode(',', $this->input->post("amount"));
            } else {
                $customer_id = $this->input->post("customer_id");
                $product_sku_id = $this->input->post("product_sku_id");
                $quantity = $this->input->post("quantity");
                $dispatched_quantity = $this->input->post("dispatched_quantity");
                $amount = $this->input->post("amount");
            }


            $total_amount = array_sum($amount);

            $validat = $this->check_valid_primary_sales_data($invoice_no, $order_tracking_no, $PO_no);

            if ($validat == 0) {
                $primary_sales_data = array(
                    'customer_id' => (isset($customer_id) && !empty($customer_id)) ? $customer_id : '',
                    'invoice_no' => (isset($invoice_no) && !empty($invoice_no)) ? $invoice_no : '',
                    'invoice_date' => (isset($invoice_date) && !empty($invoice_date)) ? $invoice_date : '',
                    'order_tracking_no' => (isset($order_tracking_no) && !empty($order_tracking_no)) ? $order_tracking_no : '',
                    'PO_no' => (isset($PO_no) && !empty($PO_no)) ? $PO_no : '',
                    'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '',
                    'invoice_recived_status' => '0',
                    'created_by_user' => $user_id,
                    'country_id' => $country_id,
                    'status' => '1',
                    'created_on' => date('Y-m-d H:i:s')
                );

                if ($this->db->insert('bf_ishop_primary_sales', $primary_sales_data)) {
                    $insert_id = $this->db->insert_id();
                }


                $primary_sales_id = $insert_id;

                foreach ($product_sku_id as $key => $prd_sku) {
                    $qty = (isset($quantity[$key]) && !empty($quantity[$key])) ? $quantity[$key] : '0';
                    $primary_sales_product_data = array(

                        'primary_sales_id' => $primary_sales_id,
                        'product_sku_id' => $prd_sku,
                        'quantity' => $qty,
                        'dispatched_quantity' => $dispatched_quantity[$key],
                        'amount' => $amount[$key],
                    );
                    $this->db->insert('bf_ishop_primary_sales_product', $primary_sales_product_data);
                }
            } else {

                $primary_sales_update_data = array(
                    'customer_id' => (isset($customer_id) && !empty($customer_id)) ? $customer_id : '',
                    'invoice_no' => (isset($invoice_no) && !empty($invoice_no)) ? $invoice_no : '',
                    'invoice_date' => (isset($invoice_date) && !empty($invoice_date)) ? $invoice_date : '',
                    'order_tracking_no' => (isset($order_tracking_no) && !empty($order_tracking_no)) ? $order_tracking_no : '',
                    'PO_no' => (isset($PO_no) && !empty($PO_no)) ? $PO_no : '',
                    'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '0',
                    'invoice_recived_status' => '0',
                    'modified_by_user' => $user_id,
                    'country_id' => $country_id,
                    'status' => '1',
                    'modified_on' => date('Y-m-d H:i:s')
                );
                $this->db->where('primary_sales_id', $validat[0]['primary_sales_id']);
                $this->db->update('bf_ishop_primary_sales', $primary_sales_update_data);

                $this->db->where('primary_sales_id', $validat[0]['primary_sales_id']);
                $this->db->delete('bf_ishop_primary_sales_product');

                foreach ($product_sku_id as $key => $prd_sku) {
                    $qty = (isset($quantity[$key]) && !empty($quantity[$key])) ? $quantity[$key] : '0';
                    $primary_sales_product_data = array(

                        'primary_sales_id' => $validat[0]['primary_sales_id'],
                        'product_sku_id' => $prd_sku,
                        'quantity' => $qty,
                        'dispatched_quantity' => $dispatched_quantity[$key],
                        'amount' => $amount[$key],
                    );
                    $this->db->insert('bf_ishop_primary_sales_product', $primary_sales_product_data);
                }
            }
        } else {
            if ($xl_data != "") {
                foreach ($xl_data as $key => $value) {

                    $customer_id = $value[0];
                    $invoice_no = $value[1];
                    $invoice_date = $value[2];
                    $order_tracking_no = $value[3];
                    $PO_no = $value[4];

                    $product_sku_id = $value[5];
                    $quantity = $value[6];
                    $dispatched_quantity = $value[7];
                    $amount = $value[8];

                    //IF INVOIVE , OTN, PO data already exist or make them to insert only single time
                    $validat = $this->check_valid_primary_sales_data($invoice_no, $order_tracking_no, $PO_no);

                    if ($validat == 0) {
                        //  echo 'in';die;
                        $total_amount = $amount;
                        $primary_sales_data = array(
                            'customer_id' => (isset($customer_id) && !empty($customer_id)) ? $customer_id : '',
                            'invoice_no' => (isset($invoice_no) && !empty($invoice_no)) ? $invoice_no : '',
                            'invoice_date' => (isset($invoice_date) && !empty($invoice_date)) ? $invoice_date : '',
                            'order_tracking_no' => (isset($order_tracking_no) && !empty($order_tracking_no)) ? $order_tracking_no : '',
                            'PO_no' => (isset($PO_no) && !empty($PO_no)) ? $PO_no : '',
                            'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '',
                            'invoice_recived_status' => '0',
                            'created_by_user' => $user_id,
                            'country_id' => $country_id,
                            'status' => '1',
                            'created_on' => date('Y-m-d H:i:s')
                        );

                        if ($this->db->insert('ishop_primary_sales', $primary_sales_data)) {
                            $insert_id = $this->db->insert_id();
                        }

                        $primary_sales_id = $insert_id;

                        $qty = (isset($quantity) && !empty($quantity)) ? $quantity : '0';
                        $primary_sales_product_data = array(

                            'primary_sales_id' => $primary_sales_id,
                            'product_sku_id' => $product_sku_id,
                            'quantity' => $qty,
                            'dispatched_quantity' => $dispatched_quantity,
                            'amount' => $amount,
                        );
                        $this->db->insert('ishop_primary_sales_product', $primary_sales_product_data);


                    } else {
                        // echo 'sachin';die;
                        $total_amount = $validat[0]['total_amount'] + $amount;
                        $qty = (isset($quantity) && !empty($quantity)) ? $quantity : '0';
                        $primary_sales_product_data = array(

                            'primary_sales_id' => $validat[0]['primary_sales_id'],
                            'product_sku_id' => $product_sku_id,
                            'quantity' => $qty,
                            'dispatched_quantity' => $dispatched_quantity,
                            'amount' => $amount,
                        );

                        $this->db->insert('ishop_primary_sales_product', $primary_sales_product_data);

                        $update_amt = array(
                            'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '0',
                        );
                        $this->db->where('primary_sales_id', $validat[0]['primary_sales_id']);
                        $this->db->update('ishop_primary_sales', $update_amt);
                    }
                }
            }

        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function check_valid_primary_sales_data($invoice_no, $order_tracking_no, $PO_no)
    {
        $this->db->select('primary_sales_id,total_amount');
        $this->db->from('ishop_primary_sales');
        $this->db->where('invoice_no', $invoice_no);
        $this->db->where('order_tracking_no', $order_tracking_no);
        $this->db->where('PO_no', $PO_no);
        $primary_sales = $this->db->get()->result_array();
        if (isset($primary_sales) && !empty($primary_sales)) {
            return $primary_sales;
        } else {
            return 0;
        }
    }

    /**
     * @ Function Name        : get_primary_details_view
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function get_primary_details_view($form_date, $to_date, $by_distributor, $by_invoice_no, $web_service = null, $page = null,$local_date = null)
    {
        $sql = 'SELECT SQL_CALC_FOUND_ROWS ips.primary_sales_id as id, ips.invoice_no,ips.invoice_date,bu.user_code,bu.display_name,ips.PO_no,ips.order_tracking_no,ips.total_amount,ips.primary_sales_id ';
        $sql .= 'FROM bf_ishop_primary_sales AS ips ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = ips.customer_id) ';
        $sql .= 'WHERE 1 ';
        if (isset($by_distributor) && !empty($by_distributor) && $by_distributor != 0) {
            $sql .= 'AND ips.customer_id =' . $by_distributor . ' ';
        }
        if (isset($by_invoice_no) && !empty($by_invoice_no)) {
            $sql .= 'AND ips.invoice_no ="' . $by_invoice_no . '" ';
        }
        if ((isset($form_date) && !empty($form_date)) && (isset($to_date) && !empty($to_date))) {
            $sql .= 'AND ips.invoice_date BETWEEN ' . '"' . $form_date . '"' . ' AND ' . '"' . $to_date . '"' . ' ';
        }
        $sql .= 'ORDER BY ips.primary_sales_id DESC ';


        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page * $limit - $limit;
            $sql .= ' LIMIT ' . $offset . "," . $limit;
            $info = $this->db->query($sql);
            // For Pagination
            $primary_sales_detail = $info->result_array();
            return $primary_sales_detail;
        } else {
            $primary_sales = $this->grid->get_result_res($sql);

            if (isset($primary_sales['result']) && !empty($primary_sales['result'])) {
                $primary['head'] = array('Sr. No.', 'Action', 'Invoice No', 'Invoice Date', 'Distributor Code', 'Distributor Name', 'PO No.', 'Order Tracking No.', 'Dispatch Amount');
                $primary['count'] = count($primary['head']);


                if ($page != null || $page != "") {

                    $i = (($page * 10) - 9);

                } else {
                    $i = 1;
                }

                foreach ($primary_sales['result'] as $ps) {

                    $invoice_no = '<div class="invoice_no_' . $ps["primary_sales_id"] . '"><span class="invoice_no">' . $ps['invoice_no'] . '</span></div>';
                    //  $invoice_date = '<div class="invoice_date_'.$ps["primary_sales_id"].'"><span class="invoice_date">'.$ps['invoice_date'].'</span></div>';
                    $po_no = '<div class="po_no_' . $ps["primary_sales_id"] . '"><span class="po_no">' . $ps['PO_no'] . '</span></div>';
                    $order_tracking_no = '<div class="order_tracking_no_' . $ps["primary_sales_id"] . '"><span class="order_tracking_no">' . $ps['order_tracking_no'] . '</span></div>';


                    if($local_date != null)
                    {
                        $date = strtotime($ps['invoice_date']);
                        $invoice_date = date($local_date,$date);
                    }
                    else{
                        $invoice_date = $ps['invoice_date'];
                    }

                    $primary['row'][] = array($i, $ps['primary_sales_id'], $invoice_no, $invoice_date, $ps['user_code'], $ps['display_name'], $po_no, $order_tracking_no, $ps['total_amount']);
                    $i++;
                }
                $primary['eye'] = 1;
                $primary['action'] = 'is_action';
                $primary['edit'] = 'is_edit';
                $primary['delete'] = 'is_delete';
                $primary['pagination'] = $primary_sales['pagination'];
                return $primary;
            }
            else{
                return false;
            }
        }
    }

    /**
     * @ Function Name        : primary_sales_product_details_view_by_id
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function primary_sales_product_details_view_by_id($primary_sales_id, $web_service = null,$csv=null)
    {
        $sql = 'SELECT ipsp.primary_sales_product_id AS id,ipsp.primary_sales_product_id,psr.product_sku_code,psc.product_sku_name,ipsp.quantity,ipsp.dispatched_quantity,ipsp.amount ';
        $sql .= 'FROM bf_ishop_primary_sales_product AS ipsp ';
        $sql .= 'JOIN bf_master_product_sku_country AS psc ON (psc.product_sku_country_id = ipsp.product_sku_id) ';
        $sql .= 'JOIN bf_master_product_sku_regional AS psr ON (psr.product_sku_id = psc.product_sku_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND ipsp.primary_sales_id =' . $primary_sales_id . ' ';
        $sql .= 'ORDER BY ipsp.primary_sales_product_id DESC ';
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $info = $this->db->query($sql);
            $primary_sales_product_detail = $info->result_array();
            return $primary_sales_product_detail;
        } else {
            $product_view=array();
            $product_detail = $this->grid->get_result_res($sql);
            if (isset($product_detail['result']) && !empty($product_detail['result']))
            {
                $product_view['head'] = array('Sr. No.', 'Action', 'Product SKU Code', 'Product SKU Name', 'PO Qty. Kg/Ltr', 'Dispatched Qty. Kg/Ltr', 'Amount');
                // $product_view['count'] = count($product_view['head']);
                $i = 1;
                foreach ($product_detail['result'] as $pd) {

                    if($csv == 'csv')
                    {
                        $product_view['row'][] = array($i, $pd['primary_sales_product_id'], $pd['product_sku_code'], $pd['product_sku_name'], $pd['quantity'], $pd['dispatched_quantity'], $pd['amount']);
                    }
                    else{
                        $qty_data = '<div class="qty_' . $pd["primary_sales_product_id"] . '"><span class="qty">' . $pd['quantity'] . '</span></div>';
                        $dispatched_quantity = '<div class="dispatched_quantity_' . $pd["primary_sales_product_id"] . '"><span class="dispatched_quantity">' . $pd['dispatched_quantity'] . '</span></div>';
                        $amount = '<div class="amount_' . $pd["primary_sales_product_id"] . '"><input  type="hidden"  name="amount[]" value="' . $pd['amount'] . '"/><span class="amount">' . $pd['amount'] . '</span></div>';
                        $product_view['row'][] = array($i, $pd['primary_sales_product_id'], $pd['product_sku_code'], $pd['product_sku_name'], $qty_data, $dispatched_quantity, $amount);
                    }
                    $i++;
                }
                $product_view['eye'] = '';
                $product_view['action'] = 'is_action';
                $product_view['edit'] = 'is_edit';
                $product_view['delete'] = 'is_delete';
                return $product_view;
            }
            else{
                return false;
            }
        }
    }

    public function update_sales_detail($user_id, $country_id, $web_service = null)
    {

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $primary_sales_id = explode(',', $this->input->post("primary_sales_detail"));
            //$invoice_no = explode(',', $this->input->post("invoice_no"));
            $PO_no = explode(',', $this->input->post("PO_no"));
            $order_tracking_no = explode(',', $this->input->post("order_tracking_no"));
            $primary_sales_product_id = explode(',', $this->input->post("primary_sales_product_detail"));
            $quantity = explode(',', $this->input->post("quantity"));
            $dispatched_quantity = explode(',', $this->input->post("dispatched_quantity"));
            $amount = explode(',', $this->input->post("amount"));
        } else {
            $primary_sales_id = $this->input->post("primary_sales_detail");
           // $invoice_no = $this->input->post("invoice_no");
            $PO_no = $this->input->post("PO_no");
            $order_tracking_no = $this->input->post("order_tracking_no");
            $primary_sales_product_id = $this->input->post("primary_sales_product_detail");
            $quantity = $this->input->post("quantity");
            $dispatched_quantity = $this->input->post("dispatched_quantity");
            $amount = $this->input->post("amount");
        }
        if(!empty($amount)){
            $total_amt = array_sum($amount);
        }

        if (isset($primary_sales_product_id) && !empty($primary_sales_product_id)) {
            foreach ($primary_sales_product_id as $k => $pspi) {
                $primary_sales_product_update = array(
                    'quantity' => (isset($quantity[$k]) && !empty($quantity[$k])) ? $quantity[$k] : 0,
                    'dispatched_quantity' => (isset($dispatched_quantity[$k]) && !empty($dispatched_quantity[$k])) ? $dispatched_quantity[$k] : 0,
                    'amount' => (isset($amount[$k]) && !empty($amount[$k])) ? $amount[$k] : 0,
                );

                $this->db->where('primary_sales_product_id', $primary_sales_product_id[$k]);
                $this->db->update('ishop_primary_sales_product', $primary_sales_product_update);
            }
            $primary_sales = $this->get_sales_id_by_sales_product_id($primary_sales_product_id);

            $primary_sales_update_by_product = array(
                'total_amount' => (isset($total_amt) && !empty($total_amt)) ? $total_amt : 0,
                'modified_by_user' => $user_id,
                'modified_on' => date('Y-m-d H:i:s')
            );

            $this->db->where('primary_sales_id', $primary_sales[0]['primary_sales_id']);
            $this->db->update('ishop_primary_sales', $primary_sales_update_by_product);

        }

        if (isset($primary_sales_id) && !empty($primary_sales_id)) {
            foreach ($primary_sales_id as $key => $psi) {
                $primary_sales_update = array(
                    //'invoice_no' => $invoice_no[$key],
                    'PO_no' => (isset($PO_no[$key]) && !empty($PO_no[$key])) ? $PO_no[$key] : '',
                    'order_tracking_no' => (isset($order_tracking_no[$key]) && !empty($order_tracking_no[$key])) ? $order_tracking_no[$key] : '',
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );

                $this->db->where('primary_sales_id', $primary_sales_id[$key]);
                $this->db->update('ishop_primary_sales', $primary_sales_update);
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }


    public function get_sales_id_by_sales_product_id($primary_sales_product_id)
    {
        $this->db->select('primary_sales_id');
        $this->db->from('ishop_primary_sales_product');
        $this->db->where('primary_sales_product_id', $primary_sales_product_id[0]);
        $sales_id = $this->db->get()->result_array();
        //testdata($sales_id);
        if (isset($sales_id) && !empty($sales_id)) {
            return $sales_id;
        }
    }

    public function delete_sales_detail($sales_id)
    {
        $this->db->where('primary_sales_id', $sales_id);
        $id = $this->db->delete('ishop_primary_sales');
        return $id;

    }

    public function delete_sales_product_detail($product_sales_id)
    {


        $this->db->select('*');
        $this->db->from('ishop_primary_sales_product');
        $this->db->where('primary_sales_product_id', $product_sales_id);

        $primary_sales_detail = $this->db->get()->result_array();

        $amount_data = $primary_sales_detail[0]["amount"];

        $primary_sales_id = $primary_sales_detail[0]["primary_sales_id"];

        $this->db->select('*');
        $this->db->from('ishop_primary_sales');
        $this->db->where('primary_sales_id', $primary_sales_id);

        $ishop_primary_sales = $this->db->get()->result_array();
        $primary_sales_amount = $ishop_primary_sales[0]["total_amount"];

        $final_amount = $primary_sales_amount - $amount_data;

        $update_data = array(
            'total_amount' => $final_amount
        );

        $this->db->where('primary_sales_id', $primary_sales_id);
        $this->db->update('ishop_primary_sales', $update_data);

        $this->db->where('primary_sales_product_id', $product_sales_id);
        $id = $this->db->delete('ishop_primary_sales_product');
        return $id;

    }
    /*--------------------------------------------------------------------------------------------------------------------*/

    /**
     * @ Function Name        : get_provience_by_customer_type
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function get_provience_by_customer_type($customer_type_id)
    {
        $this->db->select('geo_id');
        $this->db->from('master_customer_type_to_geo_mapping');
        $this->db->where('cusomer_type_id', $customer_type_id);
        $this->db->where('status', 1);
        $geo_id = $this->db->get()->row_array();

        if (isset($geo_id) && !empty($geo_id)) {
            $this->db->select('political_geo_id,political_geography_name');
            $this->db->from('master_political_geography_details');
            $this->db->where('geo_level_id', $geo_id['geo_id']);
            $this->db->where('status', 1);
            $provience = $this->db->get()->result_array();
            //testdata($provience);
            if (isset($provience) && !empty($provience)) {
                return $provience;
            }
        } else {
            return false;
        }

    }


    /**
     * @ Function Name        : get_distributor_by_provience_id
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function get_distributor_by_provience_id($provience_id)
    {
        $this->db->select('bu.id,bu.display_name,bu.user_code');
        $this->db->from('users as bu');
        $this->db->join('master_user_contact_details as ucd', 'ucd.user_id = bu.id');
        if (isset($provience_id) && !empty($provience_id) && $provience_id != '0') {
            $this->db->where('ucd.geo_level_id1', $provience_id);
        }
        $this->db->where('bu.active', 1);
        $distributor = $this->db->get()->result_array();
        //  testdata($distributor);
        return $distributor;
    }

    /**
     * @ Function Name        : add_rol_detail
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function add_rol_detail($user_id, $country_id, $xl_data = null, $xl_flag = null)
    {

        if ($xl_flag == null) {
            $prod_sku = $this->input->post("prod_sku");
            $unit = $this->input->post("unit");
            $rol_qty = $this->input->post("rol_qty");

            $retailer_id = $this->input->post("fo_retailer_id");
            $distributor_id = $this->input->post("distributor_rol");

            $qty_kgl = $this->get_product_conversion_data($prod_sku, $rol_qty, $unit);

            $login_customer_role = $this->input->post("login_customer_role");

            if (isset($retailer_id) && !empty($retailer_id) && $retailer_id != '0') {
                $cust_id = $retailer_id;
            } elseif (isset($distributor_id) && !empty($distributor_id) && $distributor_id != '0') {
                $cust_id = $distributor_id;
            } else {
                $cust_id = $user_id;
            }
            $product = $this->check_products_rol_stock($prod_sku, $unit, $cust_id);

            if (isset($product) && !empty($product) && $product != 0) {
                if ($login_customer_role == 7) {
                    if (isset($retailer_id) && !empty($retailer_id) && $retailer_id != '0') {
                        $customers_id = $retailer_id;
                    } elseif (isset($distributor_id) && !empty($distributor_id) && $distributor_id != '0') {
                        $customers_id = $distributor_id;
                    }
                    $rol_update_data = array(
                        'customer_id' => $customers_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'modified_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'modified_on' => date('Y-m-d H:i:s')
                    );

                }
                if ($login_customer_role == 9) {
                    $rol_update_data = array(
                        'customer_id' => $user_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'modified_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'modified_on' => date('Y-m-d H:i:s')
                    );

                }
                if ($login_customer_role == 10) {
                    $rol_update_data = array(
                        'customer_id' => $user_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'modified_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'modified_on' => date('Y-m-d H:i:s')
                    );
                }

                $this->db->where('rol_id', $product[0]['rol_id']);
                $id = $this->db->update('ishop_rol', $rol_update_data);
            } else {
                if ($login_customer_role == 7) {
                    if (isset($retailer_id) && !empty($retailer_id) && $retailer_id != '0') {
                        $customers_id = $retailer_id;
                    } elseif (isset($distributor_id) && !empty($distributor_id) && $distributor_id != '0') {
                        $customers_id = $distributor_id;
                    }
                    $rol_data = array(
                        'customer_id' => $customers_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'created_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'created_on' => date('Y-m-d H:i:s')
                    );

                }
                if ($login_customer_role == 9) {
                    $rol_data = array(
                        'customer_id' => $user_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'created_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'created_on' => date('Y-m-d H:i:s')
                    );

                }
                if ($login_customer_role == 10) {
                    $rol_data = array(
                        'customer_id' => $user_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'created_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'created_on' => date('Y-m-d H:i:s')
                    );
                }
                $id = $this->db->insert('ishop_rol', $rol_data);
            }
            return $id;
        } else {


            if ($xl_data != null) {

                foreach ($xl_data as $key => $value) {

                    $user = $this->auth->user();
                    $login_customer_role = $user->role_id;

                    if ($login_customer_role == 7) {
                        $cust_id = $value[0];
                        $prod_sku = $value[1];
                        $unit = $value[2];
                        $rol_qty = $value[3];
                    } elseif ($login_customer_role == 9 || $login_customer_role == 10) {
                        $cust_id = $user_id;
                        $prod_sku = $value[0];
                        $unit = $value[1];
                        $rol_qty = $value[2];
                    }

                    $qty_kgl = $this->get_product_conversion_data($prod_sku, $rol_qty, $unit);

                    //NEED TO BE DYNAMIC

                    $product = $this->check_products_rol_stock($prod_sku, $unit, $cust_id);

                    if (isset($product) && !empty($product) && $product != 0) {
                        if ($login_customer_role == 7) {

                            $customers_id = $cust_id;

                            $rol_update_data = array(
                                'customer_id' => $customers_id,
                                'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                                'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                                'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                                'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                                'modified_by_user' => $user_id,
                                'country_id' => $country_id,
                                'status' => '1',
                                'modified_on' => date('Y-m-d H:i:s')
                            );

                        }
                        if ($login_customer_role == 9) {
                            $rol_update_data = array(
                                'customer_id' => $user_id,
                                'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                                'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                                'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                                'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                                'modified_by_user' => $user_id,
                                'country_id' => $country_id,
                                'status' => '1',
                                'modified_on' => date('Y-m-d H:i:s')
                            );

                        }
                        if ($login_customer_role == 10) {
                            $rol_update_data = array(
                                'customer_id' => $user_id,
                                'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                                'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                                'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                                'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                                'modified_by_user' => $user_id,
                                'country_id' => $country_id,
                                'status' => '1',
                                'modified_on' => date('Y-m-d H:i:s')
                            );
                        }

                        $this->db->where('rol_id', $product[0]['rol_id']);
                        $this->db->update('ishop_rol', $rol_update_data);
                    } else {
                        if ($login_customer_role == 7) {
                            $customers_id = $cust_id;

                            $rol_data = array(
                                'customer_id' => $customers_id,
                                'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                                'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                                'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                                'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                                'created_by_user' => $user_id,
                                'country_id' => $country_id,
                                'status' => '1',
                                'created_on' => date('Y-m-d H:i:s')
                            );

                        }
                        if ($login_customer_role == 9) {
                            $rol_data = array(
                                'customer_id' => $user_id,
                                'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                                'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                                'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                                'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                                'created_by_user' => $user_id,
                                'country_id' => $country_id,
                                'status' => '1',
                                'created_on' => date('Y-m-d H:i:s')
                            );

                        }
                        if ($login_customer_role == 10) {
                            $rol_data = array(
                                'customer_id' => $user_id,
                                'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                                'units' => (isset($unit) && !empty($unit)) ? $unit : '',
                                'rol_quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                                'rol_quantity_Kg_Ltr' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                                'created_by_user' => $user_id,
                                'country_id' => $country_id,
                                'status' => '1',
                                'created_on' => date('Y-m-d H:i:s')
                            );
                        }
                        $this->db->insert('ishop_rol', $rol_data);
                    }


                }

            }

        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }

    }


    public function check_products_rol_stock($prod_sku, $unit, $cust_id)
    {
        $this->db->select('product_sku_id,rol_id');
        $this->db->from('ishop_rol');
        $this->db->where('product_sku_id', $prod_sku);
        $this->db->where('units', $unit);
        $this->db->where('customer_id', $cust_id);
        $data = $this->db->get()->result_array();
        // testdata($data);
        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return 0;
        }
    }


    public function get_all_rol_by_user($user_id, $country_id, $logined_user_role, $checked_type = null, $web_service = null, $page = null)
    {
        $sql ='SELECT SQL_CALC_FOUND_ROWS ir.rol_id as id,ir.rol_id,bu.user_code,bu.display_name,mptnc.product_country_name,ir.product_sku_id,mpsc.product_sku_name,ir.units,ir.rol_quantity,ir.rol_quantity_Kg_Ltr ';
        $sql .= 'FROM bf_ishop_rol AS ir ';
        $sql .= 'JOIN bf_users AS bu  ON (bu.id = ir.customer_id) ';
        $sql .= 'JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_id = ir.product_sku_id) ';
        $sql .= 'JOIN bf_master_product_type_name_country AS mptnc ON (mptnc.product_country_id = mpsc.PBG) ';
        $sql .= 'WHERE 1 ';
        if ($checked_type == "retailer") {
            $sql .= ' AND bu.role_id =10 ';
        }
        if ($checked_type == "distributor") {
            $sql .= ' AND bu.role_id =9 ';
        }
        if ($logined_user_role == 10 || $logined_user_role == 9) {
            $sql .= 'AND ir.customer_id =' . $user_id . ' ';
        }

        //   $sql .= 'AND ir.created_by_user ='.$user_id.' ';
        $sql .= 'AND ir.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY ir.rol_id DESC ';

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page*$limit-$limit;
            $sql .= ' LIMIT '.$offset.",".$limit;
            $info = $this->db->query($sql);
            // For Pagination

            $rol_detail = $info->result_array();
            return $rol_detail;
        } else {
            $rol_details = $this->grid->get_result_res($sql);

            if (isset($rol_details['result']) && !empty($rol_details['result'])) {
                if ($logined_user_role == 9 || $logined_user_role == 10) {
                    $rol['head'] = array('Sr. No.', 'Action', 'PBG', 'Product SKU Name', 'Units', 'ROL Quantity', 'ROL Qty Kg/Ltr');

                    if ($page != null || $page != "") {

                        $i = (($page * 10) - 9);

                    } else {
                        $i = 1;
                    }

                    $rol['count'] = count($rol['head']);
                    foreach ($rol_details['result'] as $rd) {
                        if($rd['units']=='packages')
                        {
                            $unit ='Packages';
                        }
                        elseif($rd['units']=='box')
                        {
                            $unit ='Box';
                        }
                        else{
                            $unit ='Kg/Ltr';
                        }

                        $product_sku_id = '<div class="prd_' . $rd["rol_id"] . '"><span class="prd_sku" style="display:none;" >' . $rd['product_sku_id'] . '</span></div>';
                        $units = $product_sku_id . '<div class="units_' . $rd["rol_id"] . '"><span class="units">' . $unit . '</span></div>';
                        $rol_quantity = '<div class="rol_quantity_' . $rd["rol_id"] . '"><span class="rol_quantity">' . $rd['rol_quantity'] . '</span></div>';
                        $rol_quantity_kg_ltr = '<div class="rol_quantity_kg_ltr_' . $rd["rol_id"] . '"><span class="rol_quantity_kg_ltr">' . $rd['rol_quantity_Kg_Ltr'] . '</span></div>';

                        $rol['row'][] = array($i, $rd['rol_id'], $rd['product_country_name'], $rd['product_sku_name'], $units, $rol_quantity, $rol_quantity_kg_ltr);
                        $i++;
                    }
                } else {
                    if ($checked_type == 'retailer') {
                        $rol['head'] = array('Sr. No.', 'Action', 'Retailer Code', 'Retailer Name', 'PBG', 'Product SKU Name', 'Units', 'ROL Quantity', 'ROL Qty Kg/Ltr');
                        $rol['count'] = count($rol['head']);
                    } else {
                        $rol['head'] = array('Sr. No.', 'Action', 'Distributor Code', 'Distributor Name', 'PBG', 'Product SKU Name', 'Units', 'ROL Quantity', 'ROL Qty Kg/Ltr');
                        $rol['count'] = count($rol['head']);
                    }

                    if ($page != null || $page != "") {

                        $i = (($page * 10) - 9);

                    } else {
                        $i = 1;
                    }
                    foreach ($rol_details['result'] as $rd) {
                        if($rd['units']=='packages')
                        {
                            $unit ='Packages';
                        }
                        elseif($rd['units']=='box')
                        {
                            $unit ='Box';
                        }
                        else{
                            $unit ='Kg/Ltr';
                        }
                        $product_sku_id = '<div class="prd_' . $rd["rol_id"] . '"><span class="prd_sku" style="display:none;">' . $rd['product_sku_id'] . '</span></div>';
                        $units = $product_sku_id . '<div class="units_' . $rd["rol_id"] . '"><span class="units">' . $unit . '</span></div>';

                        $rol_quantity_kg_ltr = '<div class="rol_quantity_kg_ltr_' . $rd["rol_id"] . '"><span class="rol_quantity_kg_ltr">' . $rd['rol_quantity_Kg_Ltr'] . '</span></div>';

                        $rol_quantity = '<div class="rol_quantity_' . $rd["rol_id"] . '"><span class="rol_quantity">' . $rd['rol_quantity'] . '</span></div>';

                        $rol['row'][] = array($i, $rd['rol_id'], $rd['user_code'], $rd['display_name'], $rd['product_country_name'], $rd['product_sku_name'], $units, $rol_quantity, $rol_quantity_kg_ltr);
                        $i++;
                    }
                }
                $rol['pagination'] = $rol_details['pagination'];
                $rol['action'] = 'is_action';
                $rol['edit'] = 'is_edit';
                $rol['delete'] = 'is_delete';
                return $rol;
            }
            else{
                return false;
            }
        }
    }


    public function update_rol_limit_detail($user_id, $country_id, $web_service = null)
    {
       /* testdata($_POST);*/
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $rol_id = explode(',', $this->input->post("rol_id"));
            $units = explode(',', $this->input->post("units"));
            $quantity = explode(',', $this->input->post("quantity"));
            $rol_qty_kg_ltr = explode(',', $this->input->post("rol_quantity_kg_ltr"));
        } else {
            $rol_id = $this->input->post("rol_id");
            $units = $this->input->post("units");
            $quantity = $this->input->post("quantity");
            $rol_qty_kg_ltr = $this->input->post("rol_quantity_kg_ltr");
        }

        if (isset($rol_id) && !empty($rol_id)) {
            foreach ($rol_id as $k => $ri) {
                $rol_update = array(
                    'rol_quantity' => (isset($quantity[$k]) && !empty($quantity[$k])) ? $quantity[$k] : '0',
                    'units' => (isset($units[$k]) && !empty($units[$k])) ? $units[$k] : '',
                    'rol_quantity_Kg_Ltr' => (isset($rol_qty_kg_ltr[$k]) && !empty($rol_qty_kg_ltr[$k])) ? $rol_qty_kg_ltr[$k] : '',
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );

                $this->db->where('rol_id', $rol_id[$k]);
                $id = $this->db->update('ishop_rol', $rol_update);
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function delete_rol_limit_detail($rol_id)
    {
        $this->db->where('rol_id', $rol_id);
        $this->db->delete('ishop_rol');
        if($this->db->affected_rows() > 0){
            return 1;
        }
    }


    /**
     * @ Function Name        : get_customer_type_id_by_user_id
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function get_customer_type_id_by_user_id($country_id)
    {
        $this->db->select('ctc.customer_type_country_id,ctc.customer_type_name as ctc_ctn,ctr.customer_type_name as ctr_ctn');
        //$this ->db->select('*');
        $this->db->from('master_customer_type_country as ctc');

        $this->db->join('master_customer_type_regional as ctr', 'ctr.customer_type_id=ctc.customer_type_id');

        $this->db->where('ctc.country_id', $country_id);
        $this->db->where('ctc.status', 1);
        $this->db->where('ctc.deleted', 0);
        $distributor = $this->db->get()->result_array();
        //testdata($distributor);
        return $distributor;
    }


    /**
     * @ Function Name        : get_retailer_by_distributor_id
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function get_retailer_by_distributor_id($id, $country_id)
    {
        $this->db->select('*');
        $this->db->from('master_customer_to_customer_mapping as mctcm');
        $this->db->join('users as bu', 'bu.id =mctcm.to_customer_id');
        $this->db->where('mctcm.from_customer_id', $id);
        $this->db->where('bu.type', 'customer');
        $this->db->where('bu.role_id', '10');
        $this->db->where('bu.active', '1');
        $this->db->where('bu.country_id', $country_id);
        $retailer = $this->db->get()->result_array();

        if (isset($retailer) && !empty($retailer)) {
            return $retailer;
        } else {
            return false;
        }
    }

    /**
     * @ Function Name        : add_secondary_sales_details_data
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function add_secondary_sales_details_data($user_id, $country_id, $xl_data = null, $xl_flag = null, $web_service = null)
    {
        if ($xl_flag == null) {
            $customer_id = $this->input->post("customer_id");
            $invoice_no = $this->input->post("invoice_no");
            $invoice_date = $this->input->post("invoice_date");
            $order_tracking_no = $this->input->post("order_tracking_no");
            $PO_no = $this->input->post("PO_no");

            if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
                $product_sku_id = explode(',', $this->input->post("product_sku_id"));
                $quantity = explode(',', $this->input->post("quantity"));
                $units = explode(',', $this->input->post("units"));
                $qty_kgl = explode(',', $this->input->post("qty_kgl"));
                $amount = explode(',', $this->input->post("amount"));
            } else {
                $product_sku_id = $this->input->post("product_sku_id");
                $dispatched_quantity = $this->input->post("dis_quantity");
                $quantity = $this->input->post("quantity");
                $units = $this->input->post("units");
                $qty_kgl = $this->input->post("qty_kgl");
                $amount = $this->input->post("amount");
            }
            $total_amount = array_sum($amount);

            $rand_type = 'etn';
            $table = 'ishop_secondary_sales';

            $rand_data = $this->get_random_no($rand_type, $table);

            $validat = $this->check_valid_secondary_sales_data($invoice_no, $order_tracking_no, $PO_no);

            if($validat == 0){
                $secondary_sales_data = array(
                    'customer_id_to' => (isset($customer_id) && !empty($customer_id)) ? $customer_id : '',
                    'customer_id_from' => $user_id,
                    'invoice_no' => (isset($invoice_no) && !empty($invoice_no)) ? $invoice_no : '',
                    'invoice_date' => (isset($invoice_date) && !empty($invoice_date)) ? $invoice_date : '',
                    'order_tracking_no' => (isset($order_tracking_no) && !empty($order_tracking_no)) ? $order_tracking_no : '',
                    'PO_no' => (isset($PO_no) && !empty($PO_no)) ? $PO_no : '',
                    'etn_no' => $rand_data,
                    'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '',
                    'invoice_recived_status' => '0',
                    'country_id' => $country_id,
                    'created_by_user' => $user_id,
                    'status' => '1',
                    'created_on' => date('Y-m-d H:i:s')
                );

                if ($this->db->insert('ishop_secondary_sales', $secondary_sales_data)) {
                    $insert_id = $this->db->insert_id();
                }

                $secondary_sales_id = $insert_id;
                foreach ($product_sku_id as $key => $prd_sku) {
                    $secondary_sales_product_data = array(

                        'secondary_sales_id' => $secondary_sales_id,
                        'product_sku_id' => $prd_sku,
                        'quantity' => $quantity[$key],
                        'amount' => $amount[$key],
                        'unit' => $units[$key],
                        'qty_kgl' => $qty_kgl[$key],
                        'customer_id' => $customer_id,
                    );
                    $this->db->insert('ishop_secondary_sales_product', $secondary_sales_product_data);
                }
            }
            else{
                $secondary_sales_data = array(
                    'customer_id_to' => (isset($customer_id) && !empty($customer_id)) ? $customer_id : '',
                    'customer_id_from' => $user_id,
                    'invoice_no' => (isset($invoice_no) && !empty($invoice_no)) ? $invoice_no : '',
                    'invoice_date' => (isset($invoice_date) && !empty($invoice_date)) ? $invoice_date : '',
                    'order_tracking_no' => (isset($order_tracking_no) && !empty($order_tracking_no)) ? $order_tracking_no : '',
                    'PO_no' => (isset($PO_no) && !empty($PO_no)) ? $PO_no : '',
                    'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '',
                    'invoice_recived_status' => '0',
                    'country_id' => $country_id,
                    'modified_by_user' => $user_id,
                    'status' => '1',
                    'modified_on' => date('Y-m-d H:i:s')
                );

                $this->db->where('secondary_sales_id', $validat[0]['secondary_sales_id']);
                $this->db->update('bf_ishop_secondary_sales', $secondary_sales_data);

                $this->db->where('secondary_sales_id', $validat[0]['secondary_sales_id']);
                $this->db->delete('bf_ishop_secondary_sales_product');


                foreach ($product_sku_id as $key => $prd_sku) {
                    $secondary_sales_product_data = array(

                        'secondary_sales_id' => $validat[0]['secondary_sales_id'],
                        'product_sku_id' => $prd_sku,
                        'quantity' => $quantity[$key],
                        'amount' => $amount[$key],
                        'unit' => $units[$key],
                        'qty_kgl' => $qty_kgl[$key],
                        'customer_id' => $customer_id,
                    );
                    $this->db->insert('ishop_secondary_sales_product', $secondary_sales_product_data);
                }
            }
        }
        else
        {
            if ($xl_data != '') {
                foreach ($xl_data as $key => $value) {

                    //testdata($value);
                    $customer_from = $user_id;
                    $customer_to = $value[0];
                    $invoice_no = $value[1];
                    $invoice_date = $value[2];
                    $PO_no = $value[3];
                    $order_tracking_no = $value[4];


                    $product_sku_id = $value[5];
                    $units = $value[6];
                    $quantity = $value[7];
                    $amount = $value[8];

                    $qty_kgl = $this->get_product_conversion_data($product_sku_id, $quantity, $units);
                    // testdata($qty_kgl);
                    $validat = $this->check_valid_secondary_sales_data($invoice_no, $order_tracking_no, $PO_no);

                    $rand_type = 'etn';
                    $table = 'ishop_secondary_sales';

                    $rand_data = $this->get_random_no($rand_type, $table);

                    if ($validat == 0) {

                        $total_amount = $amount;

                        $secondary_sales_data = array(
                            'customer_id_to' => (isset($customer_to) && !empty($customer_to)) ? $customer_to : '',
                            'customer_id_from' => (isset($customer_from) && !empty($customer_from)) ? $customer_from : '',
                            'invoice_no' => (isset($invoice_no) && !empty($invoice_no)) ? $invoice_no : '',
                            'invoice_date' => (isset($invoice_date) && !empty($invoice_date)) ? $invoice_date : '',
                            'order_tracking_no' => (isset($order_tracking_no) && !empty($order_tracking_no)) ? $order_tracking_no : '',
                            'PO_no' => (isset($PO_no) && !empty($PO_no)) ? $PO_no : '',
                            'etn_no' => $rand_data,
                            'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '',
                            'invoice_recived_status' => '0',
                            'country_id' => $country_id,
                            'created_by_user' => $user_id,
                            'status' => '1',
                            'created_on' => date('Y-m-d H:i:s')
                        );

                        if ($this->db->insert('ishop_secondary_sales', $secondary_sales_data)) {
                            $insert_id = $this->db->insert_id();
                        }

                        $secondary_sales_id = $insert_id;

                        $secondary_sales_product_data = array(

                            'secondary_sales_id' => $secondary_sales_id,
                            'product_sku_id' => $product_sku_id,
                            'quantity' => $quantity,
                            'amount' => $amount,
                            'unit' => $units,
                            'qty_kgl' => $qty_kgl,
                            'customer_id' => $customer_to,
                        );
                        // testdata($secondary_sales_product_data);
                        $this->db->insert('ishop_secondary_sales_product', $secondary_sales_product_data);

                    } else {

                        $total_amount = $validat[0]['total_amount'] + $amount;

                        $secondary_sales_product_data = array(

                            'secondary_sales_id' => $validat[0]['secondary_sales_id'],
                            'product_sku_id' => $product_sku_id,
                            'quantity' => $quantity,
                            'amount' => $amount,
                            'unit' => $units,
                            'qty_kgl' => $qty_kgl,
                            'customer_id' => $customer_to,
                        );
                        // testdata($secondary_sales_product_data);
                        $this->db->insert('ishop_secondary_sales_product', $secondary_sales_product_data);

                        $update_amt = array(
                            'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '0',
                        );
                        $this->db->where('secondary_sales_id', $validat[0]['secondary_sales_id']);
                        $this->db->update('ishop_secondary_sales', $update_amt);
                    }

                }
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }


    public function check_duplicate_data_for_secondary_sales($customer_id, $invoice_no,$login_id)
    {
        $this->db->select('*');
        $this->db->from('ishop_secondary_sales');
        $this->db->where('invoice_no', $invoice_no);
        $this->db->where_not_in('customer_id_to', $customer_id);
        $this->db->where('customer_id_from', $login_id);
        $check = $this->db->get()->row_array();
        if (isset($check) && !empty($check)) {
            return 1;
        } else {
            $this->db->select('*');
            $this->db->from('ishop_secondary_sales');
            $this->db->where('customer_id_to', $customer_id);
            $data = $this->db->get()->row_array();
            if(isset($data) && !empty($data)){
                return 2;
            }
            else{
                return 0;
            }

        }
    }

    public function get_data_secondary_sales_by_invoice_no($invoice_no,$login_id,$customer_id)
    {
        $this->db->select('secondary_sales_id,etn_no,customer_id_from,customer_id_to,PO_no,order_tracking_no,invoice_no,invoice_date,total_amount,invoice_recived_status');
        $this->db->from('ishop_secondary_sales');
        $this->db->where('invoice_no', $invoice_no);
        $this->db->where('customer_id_from', $login_id);
        if(isset($customer_id) && !empty($customer_id))
        {
            $this->db->where('customer_id_to', $customer_id);
        }
        $data = $this->db->get()->row_array();

        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return false;
        }

    }

    public function get_data_secondary_sales_product_by_invoice($secondary_sales_id)
    {
        $this->db->select('issp.secondary_sales_id,issp.product_sku_id,issp.quantity,issp.amount,issp.unit,issp.qty_kgl,psc.product_sku_name,psr.product_sku_code,bu.display_name');
        $this->db->from('ishop_secondary_sales_product as issp');
        $this->db->join('ishop_secondary_sales as iss', 'iss.secondary_sales_id = issp.secondary_sales_id');
        $this->db->join('master_product_sku_country as psc', 'psc.product_sku_id = issp.product_sku_id');
        $this->db->join('master_product_sku_regional as psr', 'psr.product_sku_id = psc.product_sku_id');
        $this->db->join('users as bu', 'bu.id = iss.customer_id_to');
        $this->db->where('issp.secondary_sales_id', $secondary_sales_id);
        $data = $this->db->get()->result_array();
        // testdata($data);
        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * @ Function Name        : secondary_sales_details_data_view
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function secondary_sales_details_data_view($form_date, $to_date, $by_retailer, $by_invoice_no, $user_id, $country_id, $sales_view = null, $from_month = null, $to_month = null, $geo_level = null, $distributor_id = null, $page = null, $web_service = null,$local_date=null)
    {
        $sql = 'SELECT SQL_CALC_FOUND_ROWS iss.secondary_sales_id as id,bu1.display_name as entry_by,iss.etn_no,iss.created_on,iss.invoice_no,iss.invoice_date,bu.user_code,bu.display_name,iss.PO_no,iss.order_tracking_no,iss.total_amount,iss.secondary_sales_id ';
        $sql .= 'FROM bf_ishop_secondary_sales AS iss ';
        $sql .= 'JOIN bf_users AS bu  ON (bu.id = iss.customer_id_to) ';
        $sql .= 'JOIN bf_users AS bu1 ON (bu1.id = iss.created_by_user) ';
        $sql .= 'WHERE 1 ';
        if (isset($by_retailer) && !empty($by_retailer) && $by_retailer != 0) {
            $sql .= 'AND iss.customer_id_to =' . $by_retailer . ' ';
        }
        if (isset($by_invoice_no) && !empty($by_invoice_no)) {
            $sql .= 'AND iss.invoice_no ='.'"' . $by_invoice_no .'"'.' ';
        }
        if ((isset($form_date) && !empty($form_date) && (isset($to_date) && !empty($to_date)))) {
            $sql .= 'AND iss.invoice_date BETWEEN ' . '"' . $form_date . '"' . ' AND ' . '"' . $to_date . '"' . ' ';
        }
        if (isset($sales_view) && !empty($sales_view) && $sales_view = 'sales_view') {
            if ((isset($from_month) && !empty($from_month)) && (isset($to_month) && !empty($to_month))) {
                $sql .= 'AND DATE_FORMAT(iss.invoice_date,"%Y-%m") BETWEEN ' . '"' . $from_month . '"' . ' AND ' . '"' . $to_month . '"' . ' ';
            }
            if ((isset($geo_level) && !empty($geo_level)) || (isset($distributor_id) && !empty($distributor_id))) {
                $sql .= 'AND iss.customer_id_from =' . $distributor_id . ' ';
            }
        }

        $sql .= 'AND iss.created_by_user =' . $user_id . ' ';
        $sql .= 'AND iss.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY iss.secondary_sales_id DESC ';

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page * $limit - $limit;
            $sql .= ' LIMIT ' . $offset . "," . $limit;
            $info = $this->db->query($sql);
            // For Pagination
            $secondary_sales_product_detail = $info->result_array();
            return $secondary_sales_product_detail;

        } else {
            $secondary_sales = $this->grid->get_result_res($sql);

            if (isset($secondary_sales['result']) && !empty($secondary_sales['result'])) {
                $secondary['head'] = array('Sr. No.', 'Action', 'Entry By', 'Entry Date', 'ETN', 'Invoice No', 'Invoice Date', 'Retailer Code', 'Retailer Name', 'PO No.', 'Order Tracking No.', 'Dispatch Amount');
                $secondary['count'] = count($secondary['head']);
                if ($page != null || $page != "") {

                    $i = (($page * 10) - 9);

                } else {
                    $i = 1;
                }

                foreach ($secondary_sales['result'] as $ss) {
                    $invoice_no = '<div class="invoice_no_' . $ss["secondary_sales_id"] . '"><span class="invoice_no">' . $ss['invoice_no'] . '</span></div>';
                    $invoice_date = '<div class="invoice_date_' . $ss["secondary_sales_id"] . '"><span class="invoice_date">' . $ss['invoice_date'] . '</span></div>';

                    $PO_no = '<div class="PO_no_' . $ss["secondary_sales_id"] . '"><span class="PO_no">' . $ss['PO_no'] . '</span></div>';

                    $order_tracking_no = '<div class="order_tracking_no_' . $ss["secondary_sales_id"] . '"><span class="order_tracking_no">' . $ss['order_tracking_no'] . '</span></div>';

                    if($local_date != null){
                        $created = strtotime($ss['created_on']);
                        $created_date = date($local_date, $created);

                        $invoice = strtotime($ss['invoice_date']);
                        $invoices_date = date($local_date, $invoice);

                    }
                    else{
                        $created_date =  $ss['created_on'];
                        $invoices_date = $invoice_date;
                    }

                    $secondary['row'][] = array($i, $ss['secondary_sales_id'], $ss['entry_by'],$created_date, $ss['etn_no'], $invoice_no, $invoices_date, $ss['user_code'], $ss['display_name'], $PO_no, $order_tracking_no, $ss['total_amount']);
                    $i++;
                }
                $secondary['eye'] = 1;
                $secondary['action'] = 'is_action';
                $secondary['edit'] = 'is_edit';
                $secondary['delete'] = 'is_delete';
                $secondary['pagination'] = $secondary_sales['pagination'];

                return $secondary;
            }
            else{
                return false;
            }
        }
    }

    /**
     * @ Function Name        : secondary_sales_product_details_view_by_id
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function secondary_sales_product_details_view_by_id($secondary_sales_id, $web_service = null,$csv=null)
    {
        $sql = 'SELECT issp.secondary_sales_product_id as id,issp.secondary_sales_product_id,psr.product_sku_code,psc.product_sku_name,issp.quantity,issp.amount,issp.unit,issp.qty_kgl, issp.product_sku_id ';
        $sql .= 'FROM bf_ishop_secondary_sales_product AS issp ';
        $sql .= 'JOIN bf_master_product_sku_country AS psc ON (psc.product_sku_country_id = issp.product_sku_id) ';
        $sql .= 'JOIN bf_master_product_sku_regional AS psr ON (psr.product_sku_id = psc.product_sku_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND issp.secondary_sales_id =' . $secondary_sales_id . ' ';
        $sql .= 'ORDER BY issp.secondary_sales_product_id DESC ';

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $info = $this->db->query($sql);
            $secondary_sales_product_detail = $info->result_array();
            return $secondary_sales_product_detail;
        } else {
            $product_detail = $this->grid->get_result_res($sql);
            // var_dump($product_detail);die;

            if (isset($product_detail['result']) && !empty($product_detail['result'])) {
                $product_view['head'] = array('Sr. No.', 'Action', 'Product SKU Code', 'Product SKU Name', 'Qty.', 'Unit', 'Qty Kg/Ltr', 'Amount');
                $product_view['count'] = count($product_view['head']);
                $i = 1;

                $secondary_id_data = '<input type="hidden" name="secondary_sales_id" value="' . $secondary_sales_id . '">';

                foreach ($product_detail['result'] as $pd) {
                    if($csv == 'csv')
                    {
                        $product_view['row'][] = array($i, $pd['secondary_sales_product_id'], $pd['product_sku_code'], $pd['product_sku_name'], $pd['quantity'], $pd['unit'], $pd['qty_kgl'], $pd['amount']);
                    }
                    else{
                        $product_sku_id = $secondary_id_data . '<div class="prd_' . $pd["secondary_sales_product_id"] . '"><span class="prd_sku" style="display:none;" >' . $pd['product_sku_id'] . '</span></div>';
                        $units = $product_sku_id . '<div class="units_' . $pd["secondary_sales_product_id"] . '"><span class="units">' . $pd['unit'] . '</span></div>';
                        $quantity = '<div class="quantity_' . $pd["secondary_sales_product_id"] . '"><span class="quantity">' . $pd['quantity'] . '</span></div>';

                        $amount = '<div class="amount_' . $pd["secondary_sales_product_id"] . '"><input  type="hidden"  name="amount[]" value="' . $pd['amount'] . '"/><span class="amount">' . $pd['amount'] . '</span></div>';
                        $qty_kgl = '<div class="rol_quantity_kg_ltr_' . $pd["secondary_sales_product_id"] . '"><span class="rol_quantity_kg_ltr">' . $pd['qty_kgl'] . '</span></div>';

                        $product_view['row'][] = array($i, $pd['secondary_sales_product_id'], $pd['product_sku_code'], $pd['product_sku_name'], $quantity, $units, $qty_kgl, $amount);
                    }

                    $i++;
                }
                $product_view['eye'] = '';
                $product_view['action'] = 'is_action';
                $product_view['edit'] = 'is_edit';
                $product_view['delete'] = 'is_delete';
                $product_view['pagination'] = $product_detail['pagination'];
                return $product_view;
            }
            else{
                return false;
            }
        }
    }


    public function update_secondary_sales_detail($user_id, $country_id, $web_service = null)
    {

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $secondary_sales_id = explode(',', $this->input->post("secondary_sales_detail"));
           // $invoice_no = explode(',', $this->input->post("invoice_no"));
            $PO_no = explode(',', $this->input->post("PO_no"));
            $order_tracking_no = explode(',', $this->input->post("order_tracking_no"));
            $secondary_sales_product_id = explode(',', $this->input->post("secondary_sales_product"));
            $quantity = explode(',', $this->input->post("quantity"));
            $units = explode(',', $this->input->post("units"));
            $qty_kgl = explode(',', $this->input->post("qty_kgl"));
            $amount = explode(',', $this->input->post("amount"));
        } else {
            $secondary_sales_id = $this->input->post("secondary_sales_detail");
           // $invoice_no = $this->input->post("invoice_no");
            $PO_no = $this->input->post("PO_no");
            $order_tracking_no = $this->input->post("order_tracking_no");
            $secondary_sales_product_id = $this->input->post("secondary_sales_product");
            $quantity = $this->input->post("quantity");
            $units = $this->input->post("units");
            $qty_kgl = $this->input->post("qty_kgl");
            $amount = $this->input->post("amount");
        }
      //  $total_amt = array_sum($amount);

        if (isset($secondary_sales_product_id) && !empty($secondary_sales_product_id)) {
            foreach ($secondary_sales_product_id as $k => $pspi) {
                $secondary_sales_product_update = array(
                    'quantity' => $quantity[$k],
                    'unit' => $units[$k],
                    'qty_kgl' => $qty_kgl[$k],
                    'amount' => $amount[$k],
                );

                $this->db->where('secondary_sales_product_id', $secondary_sales_product_id[$k]);
                $this->db->update('ishop_secondary_sales_product', $secondary_sales_product_update);
            }
            $secondary_sales = $this->get_sales_id_by_secondary_sales_product_id($secondary_sales_product_id);
            if(!empty($amount)){
                $total_amt = array_sum($amount);
            }
          //  $total_amt = array_sum($amount);
            $secondary_sales_update_by_product = array(
                'total_amount' => $total_amt,
                'modified_by_user' => $user_id,
                'modified_on' => date('Y-m-d H:i:s')
            );

            $this->db->where('secondary_sales_id', $secondary_sales[0]['secondary_sales_id']);
            $this->db->update('ishop_secondary_sales', $secondary_sales_update_by_product);

        }

        if (isset($secondary_sales_id) && !empty($secondary_sales_id)) {
            //testdata($secondary_sales_id);
            foreach ($secondary_sales_id as $key => $psi) {
                $PO_n = isset($PO_no[$key]) ? $PO_no[$key] : '';
              //  $invoice_n = isset($invoice_no[$key]) ? $invoice_no[$key] : '';
                $order_tracking_n = isset($order_tracking_no[$key]) ? $order_tracking_no[$key] : '';

                $secondary__sales_update = array(
                   // 'invoice_no' => $invoice_n,
                    'PO_no' =>$PO_n,
                    'order_tracking_no' => $order_tracking_n,
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );

                $this->db->where('secondary_sales_id', $secondary_sales_id[$key]);
                $this->db->update('ishop_secondary_sales', $secondary__sales_update);
            }
        }
      //  testdata($this->db->affected_rows());
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function get_sales_id_by_secondary_sales_product_id($secondary_sales_product_id)
    {
        $this->db->select('secondary_sales_id');
        $this->db->from('ishop_secondary_sales_product');
        $this->db->where('secondary_sales_product_id', $secondary_sales_product_id[0]);
        $sales_id = $this->db->get()->result_array();
        //testdata($sales_id);
        if (isset($sales_id) && !empty($sales_id)) {
            return $sales_id;
        }
    }

    public function delete_secondary_sales_detail($secondary_sales_id)
    {
        $this->db->where('secondary_sales_id', $secondary_sales_id);
        $this->db->delete('ishop_secondary_sales');
        if($this->db->affected_rows() > 0){
            return 1;
        }

    }

    public function delete_secondary_sales_product_detail($secondary_product_sales_id)
    {
        //testdata($secondary_product_sales_id);
        $this->db->select('*');
        $this->db->from('ishop_secondary_sales_product');
        $this->db->where('secondary_sales_product_id', $secondary_product_sales_id);

        $secondary_sales_detail = $this->db->get()->result_array();
        //testdata($secondary_sales_detail);
        $amount_data = $secondary_sales_detail[0]["amount"];

        $secondary_sales_id = $secondary_sales_detail[0]["secondary_sales_id"];

        $this->db->select('*');
        $this->db->from('ishop_secondary_sales');
        $this->db->where('secondary_sales_id', $secondary_sales_id);

        $ishop_secondary_sales = $this->db->get()->result_array();
        $secondary_sales_amount = $ishop_secondary_sales[0]["total_amount"];

        $final_amount = $secondary_sales_amount - $amount_data;

        $update_data = array(
            'total_amount' => $final_amount
        );

        $this->db->where('secondary_sales_id', $secondary_sales_id);
        $this->db->update('ishop_secondary_sales', $update_data);

        $this->db->where('secondary_sales_product_id', $secondary_product_sales_id);
        $this->db->delete('ishop_secondary_sales_product');

        if($this->db->affected_rows() > 0){
            return 1;
        }
    }


    public function get_all_physical_stock_by_user($user_id, $country_id, $role_id, $checked_type = null, $page = null, $web_service = null,$stock_month=null,$local_date = null)
    {
        $sql = 'SELECT SQL_CALC_FOUND_ROWS bu.display_name,ips.created_on,ips.stock_id,ips.stock_month,ips.quantity,ips.unit,ips.product_sku_id,ips.qty_kgl,mpsc.product_sku_name,mpsr.product_sku_code ';
        $sql .= 'FROM bf_ishop_physical_stock AS ips ';
        $sql .= 'LEFT JOIN bf_users AS bu  ON (bu.id = ips.modified_by_user) ';
        $sql .= 'LEFT JOIN bf_users AS bu1  ON (bu1.id = ips.customer_id) ';
        $sql .= 'JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_id = ips.product_sku_id) ';
        $sql .= 'JOIN bf_master_product_sku_regional AS mpsr ON (mpsr.product_sku_id = mpsc.product_sku_id) ';
        $sql .= 'WHERE 1 ';

        //   $sql .= 'AND ips.created_by_user ='.$user_id.' ';
        if ($checked_type == "retailer") {
            $sql .= ' AND bu1.role_id =10 ';
        }
        if ($checked_type == "distributor") {
            $sql .= ' AND bu1.role_id =9 ';
        }
        if ($role_id == 10 || $role_id == 9) {
            $sql .= 'AND ips.customer_id =' . $user_id . ' ';
        }
        if($stock_month != null){
            $sql .= 'AND DATE_FORMAT(ips.stock_month,"%Y-%m") ="'.$stock_month  . '" ';
        }
        $sql .= 'AND ips.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY ips.stock_id DESC ';

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page*$limit-$limit;
            $sql .= ' LIMIT '.$offset.",".$limit;
            $info = $this->db->query($sql);
            // For Pagination
            $phy_detail = $info->result_array();
            return $phy_detail;
        } else {

            //echo $sql;die;


            $pyh_stock_details = $this->grid->get_result_res($sql);

            //echo $user_id."==".$country_id."==".$role_id."==".$checked_type; die;

            if (isset($pyh_stock_details['result']) && !empty($pyh_stock_details['result'])) {
                if ($role_id == 10 || ($role_id == 8 && $checked_type == 'retailer')) {
                    //echo "aaaaa";die;
                    $pyh_stock['head'] = array('Sr. No.', 'Action', 'Month Year', 'Product SKU Code', 'Product SKU Name', 'Quantity', 'Units', 'Qty Kg/Ltr');
                    $pyh_stock['count'] = count($pyh_stock['head']);

                    if ($page != null || $page != "") {

                        $i = (($page * 10) - 9);

                    } else {
                        $i = 1;
                    }

                    foreach ($pyh_stock_details['result'] as $rd) {

                        $product_sku_id = '<div class="prd_' . $rd["stock_id"] . '"><span class="prd_sku" style="display:none;" >' . $rd['product_sku_id'] . '</span></div>';
                        $units = $product_sku_id . '<div class="units_' . $rd["stock_id"] . '"><span class="units">' . $rd['unit'] . '</span></div>';
                        $quantity = '<div class="rol_quantity_' . $rd["stock_id"] . '"><span class="rol_quantity">' . $rd['quantity'] . '</span></div>';
                        $quantity_kg_ltr = '<div class="rol_quantity_kg_ltr_' . $rd["stock_id"] . '"><span class="rol_quantity_kg_ltr">' . $rd['qty_kgl'] . '</span></div>';

                        $month = strtotime($rd['stock_month']);
                        $month = date('F - Y', $month);
                        $pyh_stock['row'][] = array($i, $rd['stock_id'], $month, $rd['product_sku_code'], $rd['product_sku_name'], $quantity, $units, $quantity_kg_ltr);
                        $i++;
                    }
                } elseif ($role_id == 9 || ($role_id == 8 && $checked_type == 'distributor')) {

                    $pyh_stock['head'] = array('Sr. No.', 'Action', 'Month Year', 'Latest Updated By', 'Entry Date', 'Product SKU Code', 'Product SKU Name', 'Quantity', 'Units', 'Qty Kg/Ltr');
                    $pyh_stock['count'] = count($pyh_stock['head']);

                    if ($page != null || $page != "") {

                        $i = (($page * 10) - 9);

                    } else {
                        $i = 1;
                    }

                    foreach ($pyh_stock_details['result'] as $rd) {
                        $product_sku_id = '<div class="prd_' . $rd["stock_id"] . '"><span class="prd_sku" style="display:none;" >' . $rd['product_sku_id'] . '</span></div>';
                        $units = $product_sku_id . '<div class="units_' . $rd["stock_id"] . '"><span class="units">' . $rd['unit'] . '</span></div>';
                        $quantity = '<div class="rol_quantity_' . $rd["stock_id"] . '"><span class="rol_quantity">' . $rd['quantity'] . '</span></div>';
                        $quantity_kg_ltr = '<div class="rol_quantity_kg_ltr_' . $rd["stock_id"] . '"><span class="rol_quantity_kg_ltr">' . $rd['qty_kgl'] . '</span></div>';


                        $month = strtotime($rd['stock_month']);
                        $month = date('F - Y', $month);

                        if($local_date != null){
                            $created = strtotime($rd['created_on']);
                            $created_date = date($local_date, $created);
                        }
                        else{
                            $created_date =  $rd['created_on'];
                        }

                        $pyh_stock['row'][] = array($i, $rd['stock_id'], $month, $rd['display_name'], $created_date, $rd['product_sku_code'], $rd['product_sku_name'], $quantity, $units, $quantity_kg_ltr);
                        $i++;
                    }
                }
                $pyh_stock['action'] = 'is_action';
                $pyh_stock['edit'] = 'is_edit';
                $pyh_stock['delete'] = 'is_delete';
                $pyh_stock['pagination'] = $pyh_stock_details['pagination'];
                return $pyh_stock;
            }
            else{
                return false;
            }

        }
    }


    /**
     * @ Function Name        : add_physical_stock_detail
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */


    public function add_physical_stock_detail($user_id, $country_id, $user_role = null, $xl_data = null, $xl_flag = null)
    {
        if ($xl_flag == null) {

            $stock_month = $this->input->post("stock_month");
            $prod_sku = $this->input->post("phy_prod_sku");
            $unit = $this->input->post("sec_sel_unit");
            $rol_qty = $this->input->post("phy_qty");
            $retailer_id = $this->input->post("fo_retailer_id");
            $distributor_id = $this->input->post("distributor_phystok");

            $qty_kgl = $this->get_product_conversion_data($prod_sku, $rol_qty, $unit);

            $login_customer_role = $this->input->post("login_customer_role");

            if (isset($retailer_id) && !empty($retailer_id) && $retailer_id != '') {
                $cust_id = $retailer_id;
            } elseif (isset($distributor_id) && !empty($distributor_id) && $distributor_id != '') {
                $cust_id = $distributor_id;
            } else {
                $cust_id = $user_id;
            }

            $product = $this->check_products_phy_stock($stock_month, $prod_sku, $unit, $cust_id);

            if (isset($product) && !empty($product) && $product != 0) {
                if ($login_customer_role == 8) {
                    if (isset($retailer_id) && !empty($retailer_id) && $retailer_id != '') {
                        $customers_id = $retailer_id;
                    } elseif (isset($distributor_id) && !empty($distributor_id) && $distributor_id != '') {
                        $customers_id = $distributor_id;
                    }
                    $physical_stock_update_data = array(
                        'stock_month' => $stock_month . '-01',
                        'customer_id' => $customers_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'unit' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'qty_kgl' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'modified_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'modified_on' => date('Y-m-d H:i:s')
                    );

                }
                if ($login_customer_role == 9) {

                    $physical_stock_update_data = array(
                        'stock_month' => $stock_month . '-01',
                        'customer_id' => $user_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'unit' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'qty_kgl' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'modified_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'modified_on' => date('Y-m-d H:i:s')
                    );
                }
                if ($login_customer_role == 10) {
                    $physical_stock_update_data = array(
                        'stock_month' => $stock_month . '-01',
                        'customer_id' => $user_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'unit' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'qty_kgl' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'modified_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'modified_on' => date('Y-m-d H:i:s')
                    );
                }
                $this->db->where('stock_id', $product[0]['stock_id']);

                $id = $this->db->update('ishop_physical_stock', $physical_stock_update_data);
            } else {
                if ($login_customer_role == 8) {
                    if (isset($retailer_id) && !empty($retailer_id) && $retailer_id != '0') {
                        $customers_id = $retailer_id;
                    } elseif (isset($distributor_id) && !empty($distributor_id) && $distributor_id != '0') {
                        $customers_id = $distributor_id;
                    }

                    $physical_stock_data = array(
                        'stock_month' => $stock_month . '-01',
                        'customer_id' => $customers_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'unit' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'qty_kgl' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'created_by_user' => $user_id,
                        'modified_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'created_on' => date('Y-m-d H:i:s'),
                        'modified_on' => date('Y-m-d H:i:s'),
                    );

                }
                if ($login_customer_role == 9) {

                    $physical_stock_data = array(
                        'stock_month' => $stock_month . '-01',
                        'customer_id' => $user_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'unit' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'qty_kgl' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'created_by_user' => $user_id,
                        'modified_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'created_on' => date('Y-m-d H:i:s'),
                        'modified_on' => date('Y-m-d H:i:s'),
                    );
                }
                if ($login_customer_role == 10) {
                    $physical_stock_data = array(
                        'stock_month' => $stock_month . '-01',
                        'customer_id' => $user_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'unit' => (isset($unit) && !empty($unit)) ? $unit : '',
                        'quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                        'qty_kgl' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                        'created_by_user' => $user_id,
                        'modified_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'created_on' => date('Y-m-d H:i:s'),
                        'modified_on' => date('Y-m-d H:i:s'),
                    );
                }

                $id = $this->db->insert('ishop_physical_stock', $physical_stock_data);
            }
            return $id;
        } else {
            if ($xl_data != '' || $xl_data != null) {
                foreach ($xl_data as $key => $value) {
                    $stock_month = $value[0];
                    $prod_sku = $value[1];
                    $qty = $value[2];
                    $unit = $value[3];

                    $stock_month = strtotime($stock_month);
                    $stock_month = date('Y-m', $stock_month);

                    $qty_kgl = $this->get_product_conversion_data($prod_sku, $qty, $unit);

                    $login_customer_role = $user_role;
                    $cust_id = $user_id;

                    $product = $this->check_products_phy_stock($stock_month, $prod_sku, $unit, $cust_id);

                    if (isset($product) && !empty($product) && $product != 0) {
                        if ($login_customer_role == 9) {

                            $physical_stock_update_data = array(
                                'stock_month' => $stock_month . '-01',
                                'customer_id' => $user_id,
                                'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                                'unit' => (isset($unit) && !empty($unit)) ? $unit : '',
                                'quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                                'qty_kgl' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                                'modified_by_user' => $user_id,
                                'country_id' => $country_id,
                                'status' => '1',
                                'modified_on' => date('Y-m-d H:i:s')
                            );
                        }
                        if ($login_customer_role == 10) {
                            $physical_stock_update_data = array(
                                'stock_month' => $stock_month . '-01',
                                'customer_id' => $user_id,
                                'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                                'unit' => (isset($unit) && !empty($unit)) ? $unit : '',
                                'quantity' => (isset($rol_qty) && !empty($rol_qty)) ? $rol_qty : '',
                                'qty_kgl' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                                'modified_by_user' => $user_id,
                                'country_id' => $country_id,
                                'status' => '1',
                                'modified_on' => date('Y-m-d H:i:s')
                            );
                        }
                        $this->db->where('stock_id', $product[0]['stock_id']);
                        $this->db->update('ishop_physical_stock', $physical_stock_update_data);
                    } else {
                        if ($login_customer_role == 9) {

                            $physical_stock_data = array(
                                'stock_month' => $stock_month . '-01',
                                'customer_id' => $user_id,
                                'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                                'unit' => (isset($unit) && !empty($unit)) ? $unit : '',
                                'quantity' => (isset($qty) && !empty($qty)) ? $qty : '',
                                'qty_kgl' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                                'created_by_user' => $user_id,
                                'modified_by_user' => $user_id,
                                'country_id' => $country_id,
                                'status' => '1',
                                'created_on' => date('Y-m-d H:i:s'),
                                'modified_on' => date('Y-m-d H:i:s'),
                            );
                        }
                        if ($login_customer_role == 10) {
                            $physical_stock_data = array(
                                'stock_month' => $stock_month . '-01',
                                'customer_id' => $user_id,
                                'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                                'unit' => (isset($unit) && !empty($unit)) ? $unit : '',
                                'quantity' => (isset($qty) && !empty($qty)) ? $qty : '',
                                'qty_kgl' => (isset($qty_kgl) && !empty($qty_kgl)) ? $qty_kgl : '',
                                'created_by_user' => $user_id,
                                'modified_by_user' => $user_id,
                                'country_id' => $country_id,
                                'status' => '1',
                                'created_on' => date('Y-m-d H:i:s'),
                                'modified_on' => date('Y-m-d H:i:s'),
                            );
                        }

                        $this->db->insert('ishop_physical_stock', $physical_stock_data);
                    }
                }
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function check_products_phy_stock($stock_month, $product_sku_id, $unit, $cust_id)
    {
        $this->db->select('product_sku_id,stock_id');
        $this->db->from('ishop_physical_stock');
        $this->db->where('product_sku_id', $product_sku_id);
        $this->db->where('DATE_FORMAT(stock_month,"%Y-%m")', $stock_month);
        $this->db->where('unit', $unit);
        $this->db->where('customer_id', $cust_id);
        $data = $this->db->get()->result_array();

        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return 0;
        }
    }

    public function update_physical_stock_detail($user_id, $country_id, $web_service = null)
    {
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $stock_id = explode(',', $this->input->post("stock_id"));
            $units = explode(',', $this->input->post("units"));
            $quantity = explode(',', $this->input->post("quantity"));
            $qty_kg_ltr = explode(',', $this->input->post("rol_quantity_kg_ltr"));
        } else {
            $stock_id = $this->input->post("stock_id");
            $units = $this->input->post("units");
            $quantity = $this->input->post("quantity");
            $qty_kg_ltr = $this->input->post("rol_quantity_kg_ltr");
        }

        if (isset($stock_id) && !empty($stock_id)) {
            foreach ($stock_id as $k => $Si) {
                $stock_update = array(
                    'quantity' => $quantity[$k],
                    'unit' => $units[$k],
                    'qty_kgl' => $qty_kg_ltr[$k],
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );

                $this->db->where('stock_id', $stock_id[$k]);
                $id = $this->db->update('ishop_physical_stock', $stock_update);
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function delete_physical_stock_details($stock_id)
    {
        $this->db->where('stock_id', $stock_id);
        $this->db->delete('ishop_physical_stock');
        if($this->db->affected_rows() > 0){
            return 1;
        }
    }


    /**
     * @ Function Name        : add_ishop_sales_detail
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function add_ishop_sales_detail($user_id, $country_id, $xl_data = null, $xl_flag = null,$web_service = null)
    {
        if ($xl_flag == null) {

            $radio_data = $this->input->post("radio1");
            $stock_month = $this->input->post("stock_month");
            $customer_id = $this->input->post("fo_retailer_id");
            $invoice_no = $this->input->post("invoice_no");
            $invoice_date = date("Y-m-d", strtotime($this->input->post("invoice_date")));
            $otn = $this->input->post("order_tracking_no");
            $PO_no = $this->input->post("PO_no");
            if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
                $product_sku_id = explode(',', $this->input->post("product_sku_id"));
                $quantity = explode(',', $this->input->post("quantity"));
                $units = explode(',', $this->input->post("units"));
                $qty_kgl = explode(',', $this->input->post("qty_kgl"));
                $amount = explode(',', $this->input->post("amount"));
            }
            else{
                $product_sku_id = $this->input->post("product_sku_id");
                $units = $this->input->post("units");
                $quantity = $this->input->post("quantity");
                $qty_kgl = $this->input->post("qty_kgl");
                $amount = $this->input->post("amount");
            }

            $distributor_sales = $this->input->post("distributor_sales");
            $retailer_id = $this->input->post("retailer_id");


            $total_amount = array_sum($amount);




            if ($radio_data == 'retailer') {
                $tertiary_sales = array(

                    'customer_id' => $customer_id,
                    'sales_month' => $stock_month . '-01',
                    'total_amount' => $total_amount,
                    'created_by_user' => $user_id,
                    'country_id' => $country_id,
                    'status' => '1',
                    'created_on' => date('Y-m-d H:i:s'),
                );
                //  testdata($tertiary_sales);
                if ($this->db->insert('ishop_tertiary_sales', $tertiary_sales)) {
                    $insert_id = $this->db->insert_id();
                }

                $tertiary_sales_id = $insert_id;
                foreach ($product_sku_id as $key => $prd_sku) {
                    $tertiary_sales_product_data = array(

                        'tertiary_sales_id' => $tertiary_sales_id,
                        'product_sku_id' => $prd_sku,
                        'quantity' => $quantity[$key],
                        'amount' => $amount[$key],
                        'unit' => $units[$key],
                        'qty_kgl' => $qty_kgl[$key],
                    );
                    $this->db->insert('ishop_tertiary_sales_products', $tertiary_sales_product_data);
                }
                return 1;

            } elseif ($radio_data == 'distributor') {

                $rand_type = 'etn';
                $table = 'ishop_secondary_sales';

                $rand_data = $this->get_random_no($rand_type, $table);

                $validat = $this->check_valid_secondary_sales_data($invoice_no, $otn, $PO_no);

                if($validat == 0){

                    $secondary_sales_data = array(
                        'customer_id_to' => (isset($retailer_id) && !empty($retailer_id)) ? $retailer_id : '',
                        'customer_id_from' => (isset($distributor_sales) && !empty($distributor_sales)) ? $distributor_sales : '',
                        'invoice_no' => (isset($invoice_no) && !empty($invoice_no)) ? $invoice_no : '',
                        'invoice_date' => (isset($invoice_date) && !empty($invoice_date)) ? $invoice_date : '',
                        'order_tracking_no' => (isset($otn) && !empty($otn)) ? $otn : '',
                        'PO_no' => (isset($PO_no) && !empty($PO_no)) ? $PO_no : '',
                        'etn_no' => $rand_data,
                        'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '',
                        'invoice_recived_status' => '0',
                        'created_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'created_on' => date('Y-m-d H:i:s')
                    );
                    if ($this->db->insert('ishop_secondary_sales', $secondary_sales_data)) {
                        $insert_id = $this->db->insert_id();
                    }

                    $secondary_sales_id = $insert_id;
                    foreach ($product_sku_id as $key => $prd_sku) {
                        $secondary_sales_product_data = array(

                            'secondary_sales_id' => $secondary_sales_id,
                            'product_sku_id' => $prd_sku,
                            'quantity' => $quantity[$key],
                            'amount' => $amount[$key],
                            'unit' => $units[$key],
                            'qty_kgl' => $qty_kgl[$key],
                            'customer_id' => $retailer_id,

                        );
                        $this->db->insert('ishop_secondary_sales_product', $secondary_sales_product_data);
                    }
                }
                else{
                    $secondary_sales_data = array(
                        'customer_id_to' => (isset($retailer_id) && !empty($retailer_id)) ? $retailer_id : '',
                        'customer_id_from' => (isset($distributor_sales) && !empty($distributor_sales)) ? $distributor_sales : '',
                        'invoice_no' => (isset($invoice_no) && !empty($invoice_no)) ? $invoice_no : '',
                        'invoice_date' => (isset($invoice_date) && !empty($invoice_date)) ? $invoice_date : '',
                        'order_tracking_no' => (isset($otn) && !empty($otn)) ? $otn : '',
                        'PO_no' => (isset($PO_no) && !empty($PO_no)) ? $PO_no : '',
                        'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '',
                        'invoice_recived_status' => '0',
                        'country_id' => $country_id,
                        'modified_by_user' => $user_id,
                        'status' => '1',
                        'modified_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('secondary_sales_id', $validat[0]['secondary_sales_id']);
                    $this->db->update('bf_ishop_secondary_sales', $secondary_sales_data);

                    $this->db->where('secondary_sales_id', $validat[0]['secondary_sales_id']);
                    $this->db->delete('bf_ishop_secondary_sales_product');


                    foreach ($product_sku_id as $key => $prd_sku) {
                        $secondary_sales_product_data = array(
                            'secondary_sales_id' => $validat[0]['secondary_sales_id'],
                            'product_sku_id' => $prd_sku,
                            'quantity' => $quantity[$key],
                            'amount' => $amount[$key],
                            'unit' => $units[$key],
                            'qty_kgl' => $qty_kgl[$key],
                            'customer_id' => $retailer_id,
                        );
                        $this->db->insert('ishop_secondary_sales_product', $secondary_sales_product_data);
                    }
                }
            }
        } else {
            if ($xl_data != '') {
                foreach ($xl_data as $key => $value) {

                    //testdata($value);
                    $customer_from = $value[0];
                    $customer_to = $value[1];
                    $invoice_no = $value[2];
                    $invoice_date = $value[3];
                    $PO_no = $value[4];
                    $order_tracking_no = $value[5];


                    $product_sku_id = $value[6];
                    $units = $value[7];
                    $quantity = $value[8];
                    $amount = $value[9];

                    $qty_kgl = $this->get_product_conversion_data($product_sku_id, $quantity, $units);
                    // testdata($qty_kgl);
                    $validat = $this->check_valid_secondary_sales_data($invoice_no, $order_tracking_no, $PO_no);
                    if ($validat == 0) {

                        $total_amount = $amount;

                        $secondary_sales_data = array(
                            'customer_id_to' => (isset($customer_to) && !empty($customer_to)) ? $customer_to : '',
                            'customer_id_from' => (isset($customer_from) && !empty($customer_from)) ? $customer_from : '',
                            'invoice_no' => (isset($invoice_no) && !empty($invoice_no)) ? $invoice_no : '',
                            'invoice_date' => (isset($invoice_date) && !empty($invoice_date)) ? $invoice_date : '',
                            'order_tracking_no' => (isset($order_tracking_no) && !empty($order_tracking_no)) ? $order_tracking_no : '',
                            'PO_no' => (isset($PO_no) && !empty($PO_no)) ? $PO_no : '',
                            'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '',
                            'invoice_recived_status' => '0',
                            'country_id' => $country_id,
                            'created_by_user' => $user_id,
                            'status' => '1',
                            'created_on' => date('Y-m-d H:i:s')
                        );

                        if ($this->db->insert('ishop_secondary_sales', $secondary_sales_data)) {
                            $insert_id = $this->db->insert_id();
                        }

                        $secondary_sales_id = $insert_id;

                        $secondary_sales_product_data = array(

                            'secondary_sales_id' => $secondary_sales_id,
                            'product_sku_id' => $product_sku_id,
                            'quantity' => $quantity,
                            'amount' => $amount,
                            'unit' => $units,
                            'qty_kgl' => $qty_kgl,
                            'customer_id' => $customer_to,
                        );
                        // testdata($secondary_sales_product_data);
                        $this->db->insert('ishop_secondary_sales_product', $secondary_sales_product_data);

                    } else {

                        $total_amount = $validat[0]['total_amount'] + $amount;

                        $secondary_sales_product_data = array(

                            'secondary_sales_id' => $validat[0]['secondary_sales_id'],
                            'product_sku_id' => $product_sku_id,
                            'quantity' => $quantity,
                            'amount' => $amount,
                            'unit' => $units,
                            'qty_kgl' => $qty_kgl,
                            'customer_id' => $customer_to,
                        );
                        // testdata($secondary_sales_product_data);
                        $this->db->insert('ishop_secondary_sales_product', $secondary_sales_product_data);

                        $update_amt = array(
                            'total_amount' => (isset($total_amount) && !empty($total_amount)) ? $total_amount : '0',
                        );
                        $this->db->where('secondary_sales_id', $validat[0]['secondary_sales_id']);
                        $this->db->update('ishop_secondary_sales', $update_amt);
                    }

                }
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function check_valid_secondary_sales_data($invoice_no, $order_tracking_no, $PO_no)
    {
        $this->db->select('secondary_sales_id,total_amount');
        $this->db->from('ishop_secondary_sales');
        $this->db->where('invoice_no', $invoice_no);
        $this->db->where('order_tracking_no', $order_tracking_no);
        $this->db->where('PO_no', $PO_no);
        $secondary_sales = $this->db->get()->result_array();
        // testdata($secondary_sales);
        if (isset($secondary_sales) && !empty($secondary_sales)) {
            return $secondary_sales;
        } else {
            return 0;
        }
    }


    public function view_ishop_sales_detail_by_retailer($user_id, $country_id, $from_month, $to_month, $geo_level_0, $geo_level_1, $retailer_id, $page = null,$web_service = null,$local_date=null)
    {
        $sql = 'SELECT itsp.tertiary_sales_id,itsp.sales_month,bu.user_code,bu.display_name ';
        $sql .= 'FROM bf_ishop_tertiary_sales AS itsp ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = itsp.customer_id) ';
        $sql .= 'WHERE 1 ';
        if ((isset($from_month) && !empty($from_month)) && (isset($to_month) && !empty($to_month))) {
            $sql .= 'AND DATE_FORMAT(itsp.sales_month,"%Y-%m") BETWEEN ' . '"' . $from_month . '"' . ' AND ' . '"' . $to_month . '"' . ' ';
        }
        if ((isset($geo_level_0) && !empty($geo_level_0)) && (isset($geo_level_1) && !empty($geo_level_1)) && (isset($retailer_id) && !empty($retailer_id))) {
            $sql .= 'AND  itsp.customer_id =' . $retailer_id . ' ';
        }
        $sql .= 'AND itsp.created_by_user =' . $user_id . ' ';
        $sql .= 'AND itsp.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY itsp.tertiary_sales_id DESC ';

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $info = $this->db->query($sql);
            $sales_detail = $info->result_array();
            return $sales_detail;
        } else {
            $sales_detail = $this->grid->get_result_res($sql);

            if (isset($sales_detail['result']) && !empty($sales_detail['result'])) {
                $sales_view['head'] = array('Sr. No.', 'Action', 'Month', 'Retailer Code', 'Retailer Name');

                if ($page != null || $page != "") {

                    $i = (($page * 10) - 9);

                } else {
                    $i = 1;
                }

                $sales_view['count'] = count($sales_view['head']);
                foreach ($sales_detail['result'] as $sd) {
                    $month = strtotime($sd['sales_month']);
                    $month = date('F - Y', $month);
                    $sales_view['row'][] = array($i, $sd['tertiary_sales_id'], $month, $sd['user_code'], $sd['display_name']);
                    $i++;
                }
                $sales_view['eye'] = 'is_action';
                $sales_view['action'] = 'is_action';
                $sales_view['edit'] = '';
                $sales_view['delete'] = 'is_delete';
                $sales_view['pagination'] = $sales_detail['pagination'];
                return $sales_view;
            } else {
                return false;
            }
        }
    }


    public function tertiary_sales_product_details_view_by_id($tertiary_sales_id,$web_service = null,$csv=null)
    {
        $sql = 'SELECT itsp.tertiary_sales_product_id,mpsr.product_sku_code,itsp.product_sku_id,mpsc.product_sku_name,itsp.unit,itsp.quantity,itsp.qty_kgl ';
        $sql .= 'FROM bf_ishop_tertiary_sales_products AS itsp ';
        $sql .= 'JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_country_id = itsp.product_sku_id) ';
        $sql .= 'JOIN bf_master_product_sku_regional AS mpsr ON (mpsr.product_sku_id = mpsc.product_sku_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND itsp.tertiary_sales_id =' . $tertiary_sales_id . ' ';
        $sql .= 'ORDER BY itsp.tertiary_sales_product_id DESC ';

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $info = $this->db->query($sql);
            $sales_detail = $info->result_array();
            return $sales_detail;
        } else {
            $sales_detail = $this->grid->get_result_res($sql);

            if (isset($sales_detail['result']) && !empty($sales_detail['result'])) {
                $sales_view['head'] = array('Sr. No.', 'Action', 'Product SKU Code', 'Product SKU Name', 'Unit', 'Qty.', 'Qty. Kg/Ltr');
                $sales_view['count'] = count($sales_view['head']);
                $i = 1;

                foreach ($sales_detail['result'] as $sd) {
                    if($csv=='csv')
                    {
                        $sales_view['row'][] = array($i, $sd['tertiary_sales_product_id'], $sd['product_sku_code'], $sd['product_sku_name'], $sd['unit'], $sd['quantity'] , $sd['qty_kgl'] );
                    }
                    else{
                        $product_sku_id = '<div class="prd_' . $sd["tertiary_sales_product_id"] . '"><span class="prd_sku" style="display:none;" >' . $sd['product_sku_id'] . '</span></div>';
                        $units = $product_sku_id . '<div class="units_' . $sd["tertiary_sales_product_id"] . '"><span class="units">' . $sd['unit'] . '</span></div>';
                        $quantity = '<div class="quantity_' . $sd["tertiary_sales_product_id"] . '"><span class="quantity">' . $sd['quantity'] . '</span></div>';
                        $quantity_kg_ltr = '<div class="rol_quantity_kg_ltr_' . $sd["tertiary_sales_product_id"] . '"><span class="rol_quantity_kg_ltr">' . $sd['qty_kgl'] . '</span></div>';


                        $sales_view['row'][] = array($i, $sd['tertiary_sales_product_id'], $sd['product_sku_code'], $sd['product_sku_name'], $units, $quantity, $quantity_kg_ltr);
                    }

                    $i++;
                }
                $sales_view['eye'] = '';
                $sales_view['action'] = 'is_action';
                $sales_view['edit'] = 'is_edit';
                $sales_view['delete'] = 'is_delete';
                //$sales_view['pagination'] = $sales_detail['pagination'];
                return $sales_view;
            } else {
                return false;
            }
        }
    }

    public function update_ishop_sales_detail($user_id, $country_id,$web_service = null)
    {
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {

            $checked_type = $this->input->post("radio1");
            $secondary_sales_id = explode(',', $this->input->post("secondary_sales_detail"));
            $invoice_no = explode(',', $this->input->post("invoice_no"));
            $PO_no = explode(',', $this->input->post("PO_no"));
            $order_tracking_no = explode(',', $this->input->post("order_tracking_no"));
            $secondary_sales_product_id = explode(',', $this->input->post("secondary_sales_product"));
            $quantity = explode(',', $this->input->post("quantity"));
            $units = explode(',', $this->input->post("units"));
            $qty_kgl = explode(',', $this->input->post("qty_kgl"));
            $amount = explode(',', $this->input->post("amount"));
        } else {
            $secondary_sales_id = $this->input->post("secondary_sales_detail");
            $invoice_no = $this->input->post("invoice_no");
            $PO_no = $this->input->post("PO_no");
            $order_tracking_no = $this->input->post("order_tracking_no");
            $secondary_sales_product_id = $this->input->post("secondary_sales_product");
            $quantity = $this->input->post("quantity");
            $units = $this->input->post("units");
            $qty_kgl = $this->input->post("qty_kgl");
            $amount = $this->input->post("amount");
            $checked_type = $this->input->post("checked_type");
        }

        if ($checked_type == 'distributor') {

            if(!empty($amount)){
                $total_amt = array_sum($amount);
            }
           // $total_amt = array_sum($amount);

            if (isset($secondary_sales_product_id) && !empty($secondary_sales_product_id)) {
                foreach ($secondary_sales_product_id as $k => $pspi) {
                    $secondary_sales_product_update = array(
                        'quantity' => $quantity[$k],
                        'unit' => $units[$k],
                        'qty_kgl' => $qty_kgl[$k],
                        'amount' => $amount[$k],
                    );

                    $this->db->where('secondary_sales_product_id', $secondary_sales_product_id[$k]);
                    $this->db->update('ishop_secondary_sales_product', $secondary_sales_product_update);
                }
                $secondary_sales = $this->get_sales_id_by_secondary_sales_product_id($secondary_sales_product_id);

                $secondary_sales_update_by_product = array(
                    'total_amount' => $total_amt,
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );

                $this->db->where('secondary_sales_id', $secondary_sales[0]['secondary_sales_id']);
                $this->db->update('ishop_secondary_sales', $secondary_sales_update_by_product);
            }

            if (isset($secondary_sales_id) && !empty($secondary_sales_id)) {
                foreach ($secondary_sales_id as $key => $psi) {
                    $secondary_sales_update = array(
                        'invoice_no' => $invoice_no[$key],
                        'PO_no' => $PO_no[$key],
                        'order_tracking_no' => $order_tracking_no[$key],
                        'modified_by_user' => $user_id,
                        'modified_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('secondary_sales_id', $secondary_sales_id[$key]);
                    $this->db->update('ishop_secondary_sales', $secondary_sales_update);
                }
            }


        } else {
            if (isset($secondary_sales_product_id) && !empty($secondary_sales_product_id)) {
                foreach ($secondary_sales_product_id as $k => $pspi) {
                    $tertiary_sales_product_update = array(
                        'quantity' => $quantity[$k],
                        'unit' => $units[$k],
                        'qty_kgl' => $qty_kgl[$k],
                    );

                    $this->db->where('tertiary_sales_product_id', $secondary_sales_product_id[$k]);
                    $this->db->update('ishop_tertiary_sales_products', $tertiary_sales_product_update);
                }
                $tertiary_sales = $this->get_sales_id_by_tertiary_sales_product_id($secondary_sales_product_id);

                $secondary_sales_update_by_product = array(
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );

                $this->db->where('tertiary_sales_id', $tertiary_sales[0]['tertiary_sales_id']);
                $this->db->update('ishop_tertiary_sales', $secondary_sales_update_by_product);
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function get_sales_id_by_tertiary_sales_product_id($tertiary_sales_product_id)
    {
        $this->db->select('tertiary_sales_id');
        $this->db->from('ishop_tertiary_sales_products');
        $this->db->where('tertiary_sales_product_id', $tertiary_sales_product_id[0]);
        $sales_id = $this->db->get()->result_array();
        //testdata($sales_id);
        if (isset($sales_id) && !empty($sales_id)) {
            return $sales_id;
        }
    }


    public function delete_ishop_sales_detail($sales_id, $checked_type)
    {
        if ($checked_type == 'distributor') {
            $this->delete_secondary_sales_detail($sales_id);

        } else {
            $this->db->where('tertiary_sales_id', $sales_id);
            $this->db->delete('ishop_tertiary_sales');
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
    }

    public function delete_ishop_sales_product_detail($product_sales_id, $checked_type)
    {
        if ($checked_type == 'distributor') {
            $this->delete_secondary_sales_product_detail($product_sales_id);

        } else {

            $this->db->where('tertiary_sales_product_id', $product_sales_id);
            $this->db->delete('ishop_tertiary_sales_products');
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
    }


    /**
     * @ Function Name        : add_company_current_stock_detail
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function add_company_current_stock_detail($user_id, $country_id, $xl_data = null, $xl_flag = null)
    {
        if ($xl_flag == null) {
            $date = $this->input->post("current_date");
            $product_sku_id = $this->input->post("product_sku");
            $intrum_quantity = $this->input->post("intransist_qty");
            $unrestricted_quantity = $this->input->post("unrusticted_qty");
            $batch = $this->input->post("batch");
            $batch_exp_date = $this->input->post("batch_expiry_date");
            $batch_mfg_date = $this->input->post("batch_mfg_date");


            $product = $this->check_products($product_sku_id);

            if ($product == 0) {
                $current_stock = array(
                    'date' => $date,
                    'product_sku_id' => $product_sku_id,
                    'intrum_quantity' => $intrum_quantity,
                    'unrestricted_quantity' => $unrestricted_quantity,
                    'batch' => $batch,
                    'batch_exp_date' => $batch_exp_date,
                    'batch_mfg_date' => $batch_mfg_date,
                    'country_id' => $country_id,
                    'created_by_user' => $user_id,
                    'modified_by_user' => '0',
                    'status' => '1',
                    'created_on' => date('Y-m-d H:i:s'),

                );
                if ($this->db->insert('ishop_company_current_stock', $current_stock)) {
                    $insert_id = $this->db->insert_id();
                }
                $current_stock_log = array(
                    'date' => $date,
                    'stock_id' => $insert_id,
                    'product_sku_id' => $product_sku_id,
                    'intransit_quantity' => $intrum_quantity,
                    'unrestricted_quantity' => $unrestricted_quantity,
                    'batch' => $batch,
                    'batch_exp_date' => $batch_exp_date,
                    'batch_mfg_date' => $batch_mfg_date,
                    'country_id' => $country_id,
                    'created_by_user' => $user_id,
                    'modified_by_user' => '0',
                    'log_date' => date('Y-m-d H:i:s'),
                    'status' => '1',
                    'created_on' => date('Y-m-d H:i:s'),
                );
                // testdata($current_stock_log);
                $id = $this->db->insert('ishop_company_current_stock_log', $current_stock_log);
            } else {
                // update
                $current_update_stock = array(
                    'date' => $date,
                    'product_sku_id' => $product_sku_id,
                    'intrum_quantity' => $intrum_quantity,
                    'unrestricted_quantity' => $unrestricted_quantity,
                    'batch' => $batch,
                    'batch_exp_date' => $batch_exp_date,
                    'batch_mfg_date' => $batch_mfg_date,
                    'country_id' => $country_id,
                    'modified_by_user' => $user_id,
                    'status' => '1',
                    'modified_on' => date('Y-m-d H:i:s'),

                );

                $this->db->where('product_sku_id', $product[0]['product_sku_id']);
                $this->db->update('ishop_company_current_stock', $current_update_stock);

                $current_stock_log = array(
                    'date' => $date,
                    'stock_id' => $product[0]['stock_id'],
                    'product_sku_id' => $product_sku_id,
                    'intransit_quantity' => $intrum_quantity,
                    'unrestricted_quantity' => $unrestricted_quantity,
                    'batch' => $batch,
                    'batch_exp_date' => $batch_exp_date,
                    'batch_mfg_date' => $batch_mfg_date,
                    'country_id' => $country_id,
                    'created_by_user' => $user_id,
                    'modified_by_user' => $user_id,
                    'log_date' => date('Y-m-d H:i:s'),
                    'status' => '1',
                    'created_on' => date('Y-m-d H:i:s'),
                );
                $id = $this->db->insert('ishop_company_current_stock_log', $current_stock_log);
            }
            return $id;
        } else {

            if ($xl_data != null) {
                foreach ($xl_data as $key => $value) {

                    $product_sku_id = $value[0];
                    $batch = $value[1];
                    $unrestricted_quantity = $value[2];
                    $intrum_quantity = $value[3];
                    $batch_exp_date = $value[4];
                    $batch_mfg_date = $value[5];
                    $date = $value[6];


                    $product = $this->check_products($product_sku_id);

                    if ($product == 0) {
                        $current_stock = array(
                            'date' => $date,
                            'product_sku_id' => $product_sku_id,
                            'intrum_quantity' => $intrum_quantity,
                            'unrestricted_quantity' => $unrestricted_quantity,
                            'batch' => $batch,
                            'batch_exp_date' => $batch_exp_date,
                            'batch_mfg_date' => $batch_mfg_date,
                            'country_id' => $country_id,
                            'created_by_user' => $user_id,
                            'modified_by_user' => '0',
                            'status' => '1',
                            'created_on' => date('Y-m-d H:i:s'),

                        );
                        if ($this->db->insert('ishop_company_current_stock', $current_stock)) {
                            $insert_id = $this->db->insert_id();
                        }
                        $current_stock_log = array(
                            'date' => $date,
                            'stock_id' => $insert_id,
                            'product_sku_id' => $product_sku_id,
                            'intransit_quantity' => $intrum_quantity,
                            'unrestricted_quantity' => $unrestricted_quantity,
                            'batch' => $batch,
                            'batch_exp_date' => $batch_exp_date,
                            'batch_mfg_date' => $batch_mfg_date,
                            'country_id' => $country_id,
                            'created_by_user' => $user_id,
                            'modified_by_user' => '0',
                            'log_date' => date('Y-m-d H:i:s'),
                            'status' => '1',
                            'created_on' => date('Y-m-d H:i:s'),
                        );
                        // testdata($current_stock_log);
                        $this->db->insert('ishop_company_current_stock_log', $current_stock_log);
                    } else {
                        // update
                        $current_update_stock = array(
                            'date' => $date,
                            'product_sku_id' => $product_sku_id,
                            'intrum_quantity' => $intrum_quantity,
                            'unrestricted_quantity' => $unrestricted_quantity,
                            'batch' => $batch,
                            'batch_exp_date' => $batch_exp_date,
                            'batch_mfg_date' => $batch_mfg_date,
                            'country_id' => $country_id,
                            'modified_by_user' => $user_id,
                            'status' => '1',
                            'modified_on' => date('Y-m-d H:i:s'),

                        );

                        $this->db->where('product_sku_id', $product[0]['product_sku_id']);
                        $this->db->update('ishop_company_current_stock', $current_update_stock);

                        $current_stock_log = array(
                            'date' => $date,
                            'stock_id' => $product[0]['stock_id'],
                            'product_sku_id' => $product_sku_id,
                            'intransit_quantity' => $intrum_quantity,
                            'unrestricted_quantity' => $unrestricted_quantity,
                            'batch' => $batch,
                            'batch_exp_date' => $batch_exp_date,
                            'batch_mfg_date' => $batch_mfg_date,
                            'country_id' => $country_id,
                            'created_by_user' => $user_id,
                            'modified_by_user' => '0',
                            'log_date' => date('Y-m-d H:i:s'),
                            'status' => '1',
                            'created_on' => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('ishop_company_current_stock_log', $current_stock_log);
                    }
                }
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }


    public function update_current_stock_details($user_id, $country_id, $web_service = null)
    {
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $product_sku_id = explode(',', $this->input->get_post("product_sku_id"));
            /*$cur_date = explode(',',$this->input->get_post("cur_date"));*/
            $stock_id = explode(',', $this->input->get_post("stock_id"));
            $int_qty = explode(',', $this->input->get_post("int_qty"));
            $unrtd_qty = explode(',', $this->input->get_post("unrtd_qty"));
            $batch = explode(',', $this->input->get_post("batch"));
            $batch_exp_date = explode(',', $this->input->get_post("batch_exp_date"));
            $batch_mfg_date = explode(',', $this->input->get_post("batch_mfg_date"));
        } else {
            $product_sku_id = $this->input->post("product_sku_id");
            /*$cur_date = $this->input->post("cur_date");*/
            $stock_id = $this->input->post("stock_id");
            $int_qty = $this->input->post("int_qty");
            $unrtd_qty = $this->input->post("unrtd_qty");
            $batch = $this->input->post("batch");

            $batch_exp_date = $this->input->post("batch_exp_date");
            $batch_mfg_date = $this->input->post("batch_mfg_date");
        }


        if (isset($stock_id) && !empty($stock_id)) {
            foreach ($stock_id as $k => $si) {

                $exp_date = str_replace('/', '-', $batch_exp_date[$k]);
                $batch_exp_date = date('Y-m-d', strtotime($exp_date));

                $mfg_date = str_replace('/', '-', $batch_mfg_date[$k]);
                $batch_mfg_date = date('Y-m-d', strtotime($mfg_date));

                $stock_update = array(
                    'intrum_quantity' => $int_qty[$k],
                    'unrestricted_quantity' => $unrtd_qty[$k],
                    'batch' => $batch[$k],
                    'batch_exp_date' =>$batch_exp_date,
                    'batch_mfg_date' => $batch_mfg_date,
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );

                $this->db->where('stock_id', $stock_id[$k]);
                $this->db->update('ishop_company_current_stock', $stock_update);


                $stock_add = array(
                    'stock_id' => $stock_id[$k],
                    'product_sku_id' => $product_sku_id[$k],
                    /*'date'=>$cur_date[$k],*/
                    'intransit_quantity' => $int_qty[$k],
                    'unrestricted_quantity' => $unrtd_qty[$k],
                    'batch' => $batch[$k],
                    'batch_exp_date' => $batch_exp_date,
                    'batch_mfg_date' => $batch_mfg_date,
                    'country_id' => $country_id,
                    'created_by_user' => $user_id,
                    'created_on' => date('Y-m-d H:i:s'),
                    'modified_by_user' => $user_id,
                    'modified_on' => date('Y-m-d H:i:s'),
                    'log_date' => date('Y-m-d H:i:s'),
                    'status' => '1',
                );

                $id = $this->db->insert('ishop_company_current_stock_log', $stock_add);

                if($this->db->affected_rows() > 0){
                    return 1;
                }
                else{
                    return 0;
                }
            }
        }

    }

    public function delete_current_stock_detail($stock_id)
    {

        $this->db->where('stock_id', $stock_id);
        $this->db->delete('ishop_company_current_stock');
        if($this->db->affected_rows() > 0){
            return 1;
        }
    }

    /**
     * @ Function Name        : check_products
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function check_products($product_sku_id)
    {
        $this->db->select('product_sku_id,stock_id');
        $this->db->from('ishop_company_current_stock');
        $this->db->where('product_sku_id', $product_sku_id);
        $data = $this->db->get()->result_array();
        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return 0;
        }
    }

    /**
     * @ Function Name        : get_all_company_current_stock
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function get_all_company_current_stock($country_id, $web_service = null, $page = null,$local_date= null)
    {

        //$sql = 'SELECT iccs.stock_id AS id,iccs.stock_id,iccs.date,iccs.product_sku_id,iccs.intrum_quantity,iccs.unrestricted_quantity,iccs.batch,iccs.batch_exp_date,iccs.batch_mfg_date,iccs.country_id,psc.product_sku_name ';

        $sql ='SELECT SQL_CALC_FOUND_ROWS iccs.stock_id AS id,iccs.stock_id,iccs.date,iccs.product_sku_id,iccs.intrum_quantity,iccs.unrestricted_quantity,iccs.batch,iccs.batch_exp_date,iccs.batch_mfg_date,iccs.country_id,psc.product_sku_name ';
        $sql .= 'FROM bf_ishop_company_current_stock AS iccs ';
        $sql .= 'JOIN bf_master_product_sku_country AS psc ON (psc.product_sku_country_id = iccs.product_sku_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND iccs.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY stock_id DESC ';


        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page*$limit-$limit;
            $sql .= ' LIMIT '.$offset.",".$limit;
            $info = $this->db->query($sql);
            // For Pagination
            $stock = $info->result_array();
            return $stock;
        } else {
            $stock_detail = $this->grid->get_result_res($sql);

            if (isset($stock_detail['result']) && !empty($stock_detail['result'])) {
                $stock_view['head'] = array('Sr. No.', 'Action', 'Date', 'Product SKU Name', 'Intransist Qty.', 'Unrusticted Qty.', 'Batch', 'Batch Expiry Date', 'Batch Mfg. Date');
                $stock_view['count'] = count($stock_view['head']);

                if ($page != null || $page != "") {

                    $i = (($page * 10) - 9);

                } else {
                    $i = 1;
                }
                foreach ($stock_detail['result'] as $sd) {
                    $product_sku_id = '<div class="product_sku_id_' . $sd["stock_id"] . '"><span class="product_sku_id" style="display:none">' . $sd['product_sku_id'] . '</span></div>';

                    if($local_date != null)
                    {
                        $date = strtotime($sd['date']);
                        $c_date = date($local_date,$date);

                        $date1 = strtotime($sd['batch_exp_date']);
                        $exp_date = date($local_date,$date1);

                        $date2 = strtotime($sd['batch_mfg_date']);
                        $mfg_date = date($local_date,$date2);

                    }
                    else{
                        $c_date = $sd['date'];
                        $exp_date = $sd['batch_exp_date'];
                        $mfg_date = $sd['batch_mfg_date'];
                    }

                    
                    $intrumquantity = isset($sd['intrum_quantity']) ?  $sd['intrum_quantity']:"";
                    
                    $date = '<div class="date_' . $sd["stock_id"] . '"><span class="date" style="display:none">' . $c_date . '</span></div>';

                    $intrum_quantity = $product_sku_id . '<div class="int_qty_' . $sd["stock_id"] . '"><span class="int_qty">' . $intrumquantity. '</span></div>';
                    $unrestricted_quantity = $date . '<div class="unrtd_qty_' . $sd["stock_id"] . '"><span class="unrtd_qty">' . $sd['unrestricted_quantity'] . '</span></div>';

                    $batch = '<div class="batch_' . $sd["stock_id"] . '"><span class="batch">' . $sd['batch'] . '</span></div>';

                    $batch_exp_date = '<div class="batch_exp_date_' . $sd["stock_id"] . '"><span class="batch_exp_date">' . $exp_date . '</span></div>';

                    $batch_mfg_date = '<div class="batch_mfg_date_' . $sd["stock_id"] . '"><span class="batch_mfg_date">' . $mfg_date . '</span></div>';

                    $stock_view['row'][] = array($i, $sd['stock_id'], $c_date, $sd['product_sku_name'], $intrum_quantity, $unrestricted_quantity, $batch, $batch_exp_date, $batch_mfg_date);
                    $i++;
                }
                $stock_view['eye'] = '';
                $stock_view['action'] = 'is_action';
                $stock_view['no_margin'] = 'is_margin';
                $stock_view['edit'] = 'is_edit';
                $stock_view['delete'] = 'is_delete';
                $stock_view['pagination'] = $stock_detail['pagination'];
                return $stock_view;
            }
            else{
                return false;
            }
        }
    }

    /**
     * @ Function Name        : add_user_credit_limit_datail
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function add_user_credit_limit_datail($user_id, $country_id, $xl_data = null, $xl_flag = null)
    {
        // testdata($_POST);
        if ($xl_flag == null) {
            $dist_limit = $this->input->post("dist_limit");
            $credit_limit = $this->input->post("credit_limit");
            $curr_outstanding = $this->input->post("curr_outstanding");
            $curr_date = $this->input->post("curr_date");

            $distributor = $this->check_distributor($dist_limit);

            // testdata($distributor);
            if ($distributor == 0) {
                $credit_limits = array(
                    'customer_id' => $dist_limit,
                    'credit_limit' => $credit_limit,
                    'current_outstanding_limit' => $curr_outstanding,
                    'date' => $curr_date,
                    'country_id' => $country_id,
                    'created_by_user' => $user_id,
                    'modified_by_user' => '0',
                    'status' => '1',
                    'created_on' => date('Y-m-d H:i:s'),

                );
                if ($this->db->insert('ishop_credit_limit', $credit_limits)) {
                    $insert_id = $this->db->insert_id();
                }
                $credit_limits_log = array(
                    'credit_limit_id' => $insert_id,
                    'customer_id' => $dist_limit,
                    'credit_limit' => $credit_limit,
                    'current_outstanding_limit' => $curr_outstanding,
                    'date' => $curr_date,
                    'country_id' => $country_id,
                    'created_by_user' => $user_id,
                    'modified_by_user' => '0',
                    'log_date' => date('Y-m-d H:i:s'),
                    'status' => '1',
                    'created_on' => date('Y-m-d H:i:s'),
                );
                // testdata($current_stock_log);
                $id = $this->db->insert('ishop_credit_limit_log', $credit_limits_log);
            } else {
                // update
                $credit_update_limits = array(
                    'customer_id' => $dist_limit,
                    'credit_limit' => $credit_limit,
                    'current_outstanding_limit' => $curr_outstanding,
                    'date' => $curr_date,
                    'country_id' => $country_id,
                    'modified_by_user' => $user_id,
                    'status' => '1',
                    'modified_on' => date('Y-m-d H:i:s'),

                );

                $this->db->where('customer_id', $distributor[0]['customer_id']);
                $this->db->update('ishop_credit_limit', $credit_update_limits);

                $credit_limits_log = array(
                    'credit_limit_id' => $distributor[0]['credit_limit_id'],
                    'customer_id' => $dist_limit,
                    'credit_limit' => $credit_limit,
                    'current_outstanding_limit' => $curr_outstanding,
                    'date' => $curr_date,
                    'country_id' => $country_id,
                    'created_by_user' => $user_id,
                    'modified_by_user' => '0',
                    'log_date' => date('Y-m-d H:i:s'),
                    'status' => '1',
                    'created_on' => date('Y-m-d H:i:s'),
                );
                $id = $this->db->insert('ishop_credit_limit_log', $credit_limits_log);
            }
            return $id;

        } else {

            if ($xl_data != null) {

                foreach ($xl_data as $key => $value) {

                    $dist_limit = $value[0];
                    $credit_limit = $value[1];
                    $curr_outstanding = $value[2];
                    $curr_date = $value[3];

                    $distributor = $this->check_distributor($dist_limit);

                    // testdata($distributor);
                    if ($distributor == 0) {
                        $credit_limits = array(
                            'customer_id' => $dist_limit,
                            'credit_limit' => $credit_limit,
                            'current_outstanding_limit' => $curr_outstanding,
                            'date' => $curr_date,
                            'country_id' => $country_id,
                            'created_by_user' => $user_id,
                            'modified_by_user' => '0',
                            'status' => '1',
                            'created_on' => date('Y-m-d H:i:s'),

                        );
                        if ($this->db->insert('ishop_credit_limit', $credit_limits)) {
                            $insert_id = $this->db->insert_id();
                        }
                        $credit_limits_log = array(
                            'credit_limit_id' => $insert_id,
                            'customer_id' => $dist_limit,
                            'credit_limit' => $credit_limit,
                            'current_outstanding_limit' => $curr_outstanding,
                            'date' => $curr_date,
                            'country_id' => $country_id,
                            'created_by_user' => $user_id,
                            'modified_by_user' => '0',
                            'log_date' => date('Y-m-d H:i:s'),
                            'status' => '1',
                            'created_on' => date('Y-m-d H:i:s'),
                        );
                        // testdata($current_stock_log);
                        $this->db->insert('ishop_credit_limit_log', $credit_limits_log);
                    } else {
                        // update
                        $credit_update_limits = array(
                            'customer_id' => $dist_limit,
                            'credit_limit' => $credit_limit,
                            'current_outstanding_limit' => $curr_outstanding,
                            'date' => $curr_date,
                            'country_id' => $country_id,
                            'modified_by_user' => $user_id,
                            'status' => '1',
                            'modified_on' => date('Y-m-d H:i:s'),

                        );

                        $this->db->where('customer_id', $distributor[0]['customer_id']);
                        $this->db->update('ishop_credit_limit', $credit_update_limits);

                        $credit_limits_log = array(
                            'credit_limit_id' => $distributor[0]['credit_limit_id'],
                            'customer_id' => $dist_limit,
                            'credit_limit' => $credit_limit,
                            'current_outstanding_limit' => $curr_outstanding,
                            'date' => $curr_date,
                            'country_id' => $country_id,
                            'created_by_user' => $user_id,
                            'modified_by_user' => '0',
                            'log_date' => date('Y-m-d H:i:s'),
                            'status' => '1',
                            'created_on' => date('Y-m-d H:i:s'),
                        );
                        $this->db->insert('ishop_credit_limit_log', $credit_limits_log);
                    }
                }
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }

    }

    /**
     * @ Function Name        : check_distributor
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function check_distributor($dist_limit)
    {
        $this->db->select('credit_limit_id,customer_id');
        $this->db->from('ishop_credit_limit');
        $this->db->where('customer_id', $dist_limit);
        $data = $this->db->get()->result_array();
        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return 0;
        }
    }

    /**
     * @ Function Name        : check_products
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */


    public function get_all_distributors_credit_limit($country_id, $web_service = null, $page = null,$local_date = null)
    {
       // $sql = 'SELECT icl.credit_limit_id as id,bu.display_name,icl.credit_limit,icl.current_outstanding_limit,icl.date ';
        $sql ='SELECT SQL_CALC_FOUND_ROWS icl.credit_limit_id as id,bu.display_name,icl.credit_limit,icl.current_outstanding_limit,icl.date ';
        $sql .= 'FROM bf_ishop_credit_limit AS icl ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = icl.customer_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND icl.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY credit_limit_id DESC ';


        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page*$limit-$limit;
            $sql .= ' LIMIT '.$offset.",".$limit;
            $info = $this->db->query($sql);
            // For Pagination
            $limit = $info->result_array();
            return $limit;
        } else {
            $credit_limit_detail = $this->grid->get_result_res($sql);
            // testdata($credit_limit_detail);

            if (isset($credit_limit_detail['result']) && !empty($credit_limit_detail['result'])) {
                $credit_limit_view['head'] = array('Sr. No.', 'Distributor', 'Credit Limit', 'Current Outstanding', 'Date');

                $credit_limit_view['count'] = count($credit_limit_view['head']);

                if ($page != null || $page != "") {
                    $i = (($page * 10) - 9);
                } else {
                    $i = 1;
                }

                foreach ($credit_limit_detail['result'] as $cld) {
                    if($local_date != null)
                    {
                       $date = strtotime($cld['date']);
                        $crd_date = date($local_date,$date);
                    }
                    else{
                        $crd_date = $cld['date'];
                    }

                    $credit_limit_view['row'][] = array($i, $cld['display_name'], $cld['credit_limit'], $cld['current_outstanding_limit'],$crd_date);
                    $i++;
                }
                $credit_limit_view['eye'] = '';
                $credit_limit_view['action'] = '';
                $credit_limit_view['no_margin'] = '';
                $credit_limit_view['no_margin'] = 'is_margin';
                $credit_limit_view['pagination'] = $credit_limit_detail['pagination'];
                return $credit_limit_view;
            }
            else{
                return false;
            }
        }
    }

    /**
     * @ Function Name        : get_all_schemes
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function get_all_schemes($country_id)
    {
        $this->db->select('*');
        $this->db->from('bf_master_scheme');
        $this->db->where('country_id', $country_id);
        $this->db->where('status', '1');
        $this->db->where('DATE_FORMAT(year,"%Y")', date('Y'));
        $data = $this->db->get()->result_array();
        //testdata($data);
        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return false;
        }
    }


    public function check_scheme_alocated_retailer($scheme_id,$retailer_id,$selected_year,$country_id)
    {
        $this->db->select('slab_id');
        $this->db->from('ishop_scheme_allocation');
        $this->db->where("DATE_FORMAT(year,'%Y')",$selected_year);
        $this->db->where('customer_id',$retailer_id);
        $this->db->where('scheme_id',$scheme_id);
        $this->db->where('country_id',$country_id);
        $data = $this->db->get()->row_array();
        // echo $this->db->last_query();
         @$slab=$data['slab_id'];
        return $slab;
    }

    /**
     * @ Function Name        : get_slab_by_selected_scheme_id
     * @ Function Params    :
     * @ Function Purpose    :
     * @ Function Return    : Array
     * */

    public function get_slab_by_selected_scheme_id($scheme_id, $web_service = null,$slab_id=null)
    {
        $sql = 'SELECT mss.slab_id as id,mss.slab_id,mss.slab_no,psc.product_sku_name,mss.1point,mss.value_per_kg,mss.value_per_point,mss.target,mss.target_point,mss.target_value ';
        $sql .= 'FROM bf_master_scheme_slab AS mss ';
        $sql .= 'JOIN bf_master_product_sku_country AS psc ON (psc.product_sku_country_id = mss.product_sku_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND mss.scheme_id =' . $scheme_id . ' ';
        $sql .= 'ORDER BY slab_id DESC ';
        $info = $this->db->query($sql);
        $limit = $info->result_array();

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            return $limit;
        } else {
            $slab_detail = array('result' => $limit);

            if (isset($slab_detail['result']) && !empty($slab_detail['result'])) {
                $slab_view['head'] = array('Sr. No.', 'Select', 'Slab No.', 'Product SKU Name', '1 point:?kg/ltr', 'Value Per Kg. per Ltr', 'Value Per Point', 'Target Kg/Ltr', 'Target Points', 'Programme Value');
                $i = 1;

                foreach ($slab_detail['result'] as $sd) {
                    if(isset($slab_id) && !empty($slab_id) && ($sd['slab_id'] == $slab_id ))
                    {
                        $slab_view['radio_checked'][] =$slab_id;
                    }
                    else{

                        $slab_view['radio_checked'][] ='';
                    }
                    $slab_view['row'][] = array($i, $sd['slab_id'], $sd['slab_no'], $sd['product_sku_name'], $sd['1point'], $sd['value_per_kg'], $sd['value_per_point'], $sd['target'], $sd['target_point'], $sd['target_value']);
                    $i++;
                }
                $slab_view['eye'] = '';
                $slab_view['action'] = 'is_action';
                $slab_view['radio'] = 'is_radio';
                $slab_view['no_margin'] = '';
                $slab_view['no_margin'] = 'is_margin';
                return $slab_view;
            }
            else{
                return false;
            }
        }
    }

    public function get_schemes_by_selected_year($selected_cur_year, $country_id)
    {
        $this->db->select('scheme_id as id,scheme_id,scheme_code,scheme_name,year,country_id,status');
        $this->db->from('bf_master_scheme');
        $this->db->where('country_id', $country_id);
        $this->db->where('status', '1');
        $this->db->where('DATE_FORMAT(year,"%Y")', $selected_cur_year);
        $data = $this->db->get()->result_array();
        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return 0;
        }
    }

    public function check_schemes_detail($user_id,$country_id)
    {
        $cur_year = $this->input->post("cur_year");
        $customer_id = $this->input->post("fo_retailer_id");
        $scheme_id = $this->input->post("schemes");
        $this->db->select('allocation_id');
        $this->db->from('ishop_scheme_allocation');
        $this->db->where("DATE_FORMAT(year,'%Y')",$cur_year);
        $this->db->where('customer_id',$customer_id);
        $this->db->where('scheme_id',$scheme_id);
        $this->db->where('country_id',$country_id);
        $data = $this->db->get()->row_array();
        if (empty($data)) {
            return 1;
        } else {
            return $data;
        }
    }

    public function add_schemes_detail($user_id, $country_id)
    {

        $cur_year = $this->input->post("cur_year");
        $customer_id = $this->input->post("fo_retailer_id");
        $schemes = $this->input->post("schemes");
        $scheme_slab = $this->input->post("radio_scheme_slab");
        $region = $this->input->post("region");
        $territory = $this->input->post("territory");

        $schemes_list = array(
            'year' => $cur_year . '-01-01',
            'scheme_id' => $schemes,
            'slab_id' => $scheme_slab,
            'customer_id' => $customer_id,
            'country_id' => $country_id,
            'geo_id2' => $region,
            'geo_id1' => $territory,
            'created_by_user' => $user_id,
            'status' => '1',
            'created_on' => date('Y-m-d H:i:s')

        );
        //   testdata($schemes_list);
        $this->db->insert('ishop_scheme_allocation', $schemes_list);
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }

    }

    public function update_schemes_detail($user_id, $country_id)
    {
        $cur_year = $this->input->post("cur_year");
        $customer_id = $this->input->post("fo_retailer_id");
        $schemes = $this->input->post("schemes");
        $scheme_slab = $this->input->post("radio_scheme_slab");
        $region = $this->input->post("region");
        $territory = $this->input->post("territory");
        $allocation_id = $this->input->post("allocation_id");

        $schemes_list = array(
            'year' => $cur_year . '-01-01',
            'scheme_id' => $schemes,
            'slab_id' => $scheme_slab,
            'customer_id' => $customer_id,
            'country_id' => $country_id,
            'geo_id2' => $region,
            'geo_id1' => $territory,
            'modified_by_user' => $user_id,
            'status' => '1',
            'modified_on' => date('Y-m-d H:i:s')

        );
        $this->db->where('allocation_id',$allocation_id);
        $this->db->update('ishop_scheme_allocation', $schemes_list);
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }

    }


    public function view_schemes_detail($user_id, $country_id, $year, $region = null, $territory = null, $login_user, $retailer = null, $page = null, $web_service = null)
    {

       /* $sql = 'SELECT isa.allocation_id as id,isa.allocation_id,bmbgd.business_georaphy_name as business_georaphy_name_parent,bmbgd1.business_georaphy_code,bmbgd1.business_georaphy_name,bu.display_name,bu.user_code,ms.scheme_code,ms.scheme_name,mpsc.product_sku_name,mss.slab_no,mss.1point,mss.value_per_kg ';
        if ($login_user == 8) {*/

        $sql ='SELECT SQL_CALC_FOUND_ROWS isa.allocation_id as id,isa.allocation_id,bmbgd.business_georaphy_name as business_georaphy_name_parent,bmbgd1.business_georaphy_code,bmbgd1.business_georaphy_name,bu.display_name,bu.user_code,ms.scheme_code,ms.scheme_name,mpsc.product_sku_name,mss.slab_no,mss.1point,mss.value_per_kg ';
        if($login_user== 8)
        {
            $sql .= ' ,SUM(isp.quantity) as qty ';
        }
        $sql .= 'FROM bf_ishop_scheme_allocation AS isa ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = isa.customer_id) ';
        $sql .= 'JOIN bf_master_scheme AS ms ON (ms.scheme_id = isa.scheme_id) ';
        $sql .= 'JOIN bf_master_scheme_slab AS mss ON (mss.slab_id = isa.slab_id) ';
        $sql .= 'JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_country_id = mss.product_sku_id) ';
        $sql .= 'LEFT JOIN bf_master_business_geography_details AS bmbgd ON (bmbgd.business_geo_id = isa.geo_id2) ';
        $sql .= 'LEFT JOIN bf_master_business_geography_details AS bmbgd1 ON (bmbgd1.business_geo_id = isa.geo_id1) ';
        if ($login_user == 8) {
            $sql .= 'LEFT JOIN bf_ishop_secondary_sales_product AS isp ON (isp.customer_id = isa.customer_id AND isp.product_sku_id = mss.product_sku_id) ';
        }

        $sql .= 'WHERE 1 ';
        if (isset($year) && !empty($year)) {
            $sql .= "AND DATE_FORMAT(isa.year,'%Y') =" . "'" . $year . "'" . " ";
        }
        if (isset($region) && !empty($region) && $region != 0) {
            $sql .= 'AND geo_id2 =' . $region . ' ';
        }
        if (isset($territory) && !empty($territory) && $territory != 0) {
            $sql .= 'AND geo_id1 =' . $territory . ' ';
        }


        if ($login_user == 10) {
            $sql .= 'AND isa.customer_id =' . $user_id . ' ';
        }
        $sql .= 'AND mpsc.status = "1" ';
        //$sql .= 'AND isa.country_id ='.$country_id;
        if ($login_user == 8) {
            if (isset($retailer) && !empty($retailer) && $retailer != 0) {
                $sql .= ' AND isa.customer_id =' . $retailer . ' ';
            }
            $sql .= ' GROUP BY isa.allocation_id ';
        }
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page*$limit-$limit;
            $sql .= ' LIMIT '.$offset.",".$limit;
            $info = $this->db->query($sql);
            // For Pagination
            $limit = $info->result_array();
            return $limit;
            // testdata($scheme_allocation);
        } else {
            // echo $sql;die;
            /*  $info = $this->db->query($sql);
              $limit = $info->result_array();
              $scheme_allocation = array('result'=>$limit);*/
            // testdata($scheme_allocation);
            $scheme_allocation = $this->grid->get_result_res($sql);
            if (isset($scheme_allocation['result']) && !empty($scheme_allocation['result'])) {
                $scheme_allocation_view = array();

                if ($login_user == 7) {
                    $scheme_allocation_view['count'] = '14';
                    if ($page != null || $page != "") {
                        $i = (($page * 10) - 9);
                    } else {
                        $i = 1;
                    }

                    foreach ($scheme_allocation['result'] as $sd) {
                        $scheme_allocation_view['row'][] = array($i, $sd['allocation_id'], $sd['business_georaphy_name_parent'], $sd['business_georaphy_code'], $sd['business_georaphy_name'], $sd['user_code'], $sd['display_name'], $sd['scheme_code'], $sd['scheme_name'], $sd['product_sku_name'], $sd['slab_no'], $sd['1point'], $sd['value_per_kg']);
                        $i++;
                    }
                } elseif ($login_user == 8) {

                    $scheme_allocation_view['head'] = array('Sr. No.', 'Retailer Name', 'Retailer Code', 'Scheme Code', 'Scheme Name', 'Product SKU Name', 'Slab No.', '1 pt = ? Kg per Ltr', 'Actual Sales');
                    $scheme_allocation_view['count'] = count($scheme_allocation_view['head']);
                    if ($page != null || $page != "") {
                        $i = (($page * 10) - 9);
                    } else {
                        $i = 1;
                    }
                    foreach ($scheme_allocation['result'] as $sd) {
                        if (isset($sd['qty']) && !empty($sd['qty'])) {
                            $qty = $sd['qty'];
                        } else {
                            $qty = '0';
                        }
                        $scheme_allocation_view['row'][] = array($i, $sd['display_name'], $sd['user_code'], $sd['scheme_code'], $sd['scheme_name'], $sd['product_sku_name'], $sd['slab_no'], $sd['1point'], $qty);
                        $i++;
                    }
                    $scheme_allocation_view['eye'] = '';
                    $scheme_allocation_view['action'] = '';
                    $scheme_allocation_view['no_margin'] = '';
                } elseif ($login_user == 10) {

                    $scheme_allocation_view['head'] = array('Sr. No.', 'Scheme Code', 'Scheme Name', 'Product SKU Name', 'Slab No.', '1 pt = ? Kg per Ltr');
                    $scheme_allocation_view['count'] = count($scheme_allocation_view['head']);
                    if ($page != null || $page != "") {
                        $i = (($page * 10) - 9);
                    } else {
                        $i = 1;
                    }
                    foreach ($scheme_allocation['result'] as $sd) {
                        $scheme_allocation_view['row'][] = array($i, $sd['scheme_code'], $sd['scheme_name'], $sd['product_sku_name'], $sd['slab_no'], $sd['1point']);
                        $i++;
                    }
                    $scheme_allocation_view['eye'] = '';
                    $scheme_allocation_view['action'] = '';
                    $scheme_allocation_view['no_margin'] = '';

                }

                $scheme_allocation_view['pagination'] = $scheme_allocation['pagination'];

                return $scheme_allocation_view;
            }
            else{
                return false;
            }
        }
    }

    public function get_business_geo_data($user_id, $country_id, $role, $parent_id = null, $year = null, $login_user_type)
    {
        //var_dump($year) ;
        $selected_data = "bmbgd.business_geo_id,bmbgd.business_georaphy_name,bmbgd.business_georaphy_code ";
        $sql = "";

        //echo $role;

        if ($login_user_type == 7) {

            if ($parent_id == null) {

                $selected_data = " bmbgd.parent_geo_id ";

                $sql .= " SELECT bmbgd_p.business_geo_id,bmbgd_p.business_georaphy_name,bmbgd_p.business_georaphy_code ";
                $sql .= "FROM bf_master_business_geography_details as bmbgd_p WHERE bmbgd_p.business_geo_id IN ( ";
            }
        }

        $sql .= "SELECT " . $selected_data . " as bmbgd_parent_geo_id ";
        $sql .= " FROM (`bf_users` as bu) ";
        $sql .= " JOIN `bf_master_user_contact_details` as bmucd ON `bmucd`.`user_id` = `bu`.`id`  ";
        if ($login_user_type == 8) {
            $sql .= " JOIN `bf_master_employe_to_customer` as bmetc ON `bmetc`.`customer_id` = `bu`.`id`  ";
        }
        $sql .= " JOIN `bf_master_business_political_geo_mapping` as bmbpgm ON `bmbpgm`.`polotical_geo_id` = `bmucd`.`geo_level_id1` ";

        $sql .= " JOIN `bf_master_business_geography_details` as bmbgd ON `bmbgd`.`business_geo_id` = `bmbpgm`.`business_geo_id` ";

        $sql .= " WHERE 1 ";
        $sql .= " AND bu.country_id= " . $country_id . " ";
        $sql .= " AND bu.type= 'Customer' ";
        $sql .= " AND bu.deleted= 0 ";
        $sql .= " AND bu.role_id= " . $role . " ";
        if ($login_user_type == 8) {
            $sql .= " AND bmetc.employee_id =" . $user_id . " ";
        }
        if ($login_user_type == 7) {
            if ($parent_id == null) {

                if (isset($year) && !empty($year) && $year != null) {
                    $sql .= " AND DATE_FORMAT(bmbgd_p.year,'%Y') = " . $year . " ";
                }
            }
        }

        if ($parent_id != null) {
            $sql .= " AND bmbgd.parent_geo_id= " . $parent_id . " ";

        }


        $sql .= " GROUP BY bmbgd.business_georaphy_name ";
        $sql .= " ORDER BY bmbgd.business_georaphy_name ";

        if ($login_user_type == 7) {
            if ($parent_id == null) {
                $sql .= " ) ";
            }
        }

        //  echo $sql;die;

        $info = $this->db->query($sql);
        $geo_id = $info->result_array();
        // testdata($geo_id);
        if (isset($geo_id) && !empty($geo_id)) {
            return $geo_id;
        } else {
            return false;
        }
    }

    public function get_business_geo_data_to_retailer($selected_geo_id, $country_id)
    {
        $this->db->select('bu.id,bu.display_name');
        $this->db->from('master_business_political_geo_mapping as mbpgm');
        $this->db->join('master_user_contact_details as mucd', 'mucd.geo_level_id1 = mbpgm.polotical_geo_id');
        $this->db->join('users as bu', 'bu.id = mucd.user_id');
        $this->db->where('mbpgm.business_geo_id', $selected_geo_id);
        $this->db->where('bu.country_id', $country_id);
        $this->db->order_by('bu.display_name');
        $this->db->group_by('bu.id');
        $data = $this->db->get()->result_array();
        // echo $this->db->last_query();
        // testdata($data);
        if (isset($data) && !empty($data)) {
            return $data;
        } else {
            return false;
        }
    }


    public function delete_schemes_by_id($cs)
    {
        $this->db->where_in('allocation_id', $cs);
        $this->db->delete('bf_ishop_scheme_allocation');
        if($this->db->affected_rows() > 0){
            return 1;
        }
    }

    public function invoice_confirmation_received_by_distributor($invoice_month, $po_no, $invoice_no, $user_id, $country_id, $page = null,$web_service=null)
    {
        $sql = 'SELECT  SQL_CALC_FOUND_ROWS * ';
        $sql .= ' FROM bf_ishop_primary_sales AS ips ';
        $sql .= 'WHERE 1 ';

        if (isset($invoice_month) && !empty($invoice_month) && $invoice_month != '') {
            $sql .= 'AND DATE_FORMAT(ips.invoice_date,"%Y-%m") =' . "'" . $invoice_month . "'" . ' ';
        }
        if (isset($po_no) && !empty($po_no) && $po_no != '') {
            $sql .= 'AND ips.PO_no =' ."'" . $po_no ."'". ' ';
        }
        if (isset($invoice_no) && !empty($invoice_no) && $invoice_no != '') {
            $sql .= 'AND ips.invoice_no =' ."'" . $invoice_no ."'". ' ';
        }
        $sql .= " AND ips.country_id= " . $country_id . " ";
        $sql .= " AND ips.customer_id= " . $user_id . " ";
        $sql .= " AND ips.invoice_recived_status= 0 ";
        $sql .= " AND ips.status = 1 ";


        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {

            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page*$limit-$limit;
            $sql .= ' LIMIT '.$offset.",".$limit;
            $info = $this->db->query($sql);
            // For Pagination

            $invoice_confirmation = $info->result_array();
            return $invoice_confirmation;
        } else {
            $invoice_confirmation = $this->grid->get_result_res($sql);
            // testdata($invoice_confirmation);

            if (isset($invoice_confirmation['result']) && !empty($invoice_confirmation['result'])) {
                if ($page != null || $page != "") {

                    $i = (($page * 10) - 9);

                } else {
                    $i = 1;
                }

                $invoice_confirmation_view['head'] = array('Sr. No.', 'View', 'PO No.', 'OTN', 'Invoice No.', 'Invoice Value', 'Received');
                $invoice_confirmation_view['count'] = count($invoice_confirmation_view['head']);
                foreach ($invoice_confirmation['result'] as $ic) {
                    if ($ic['invoice_recived_status'] == '0') {
                        $received_status = '<select name="received_status" class="received_status" id="received_status" ><option value="0">Pending</option><option  value="1">Confirm</option></select>
                                        <input type="hidden" id="sales_id" class="sales_id" name="sales_id" value="' . $ic['primary_sales_id'] . '">';
                    } else {
                        $received_status = 'Confirm';
                    }
                    $invoice_confirmation_view['row'][] = array($i, $ic['primary_sales_id'], $ic['PO_no'], $ic['order_tracking_no'], $ic['invoice_no'], $ic['total_amount'], $received_status);
                    $i++;
                }
                $invoice_confirmation_view['eye'] = 'eye';
                $invoice_confirmation_view['action'] = 'is_action';
                $invoice_confirmation_view['radio'] = '';
                $invoice_confirmation_view['no_margin'] = '';
                $invoice_confirmation_view['pagination'] = $invoice_confirmation['pagination'];
                return $invoice_confirmation_view;

            }
            else{
                return false;
            }

        }


    }

    public function update_invoice_confirmation_received_by_distributor($sales_id, $user_id, $country_id)
    {

        $primary_sales = array(
            'invoice_recived_status' => '1',
            'modified_by_user' => $user_id,
            'modified_on' => date('Y-m-d H:i:s')
        );

        $this->db->where('primary_sales_id', $sales_id);
        $this->db->update('ishop_primary_sales', $primary_sales);
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function invoice_sales_product_details($sales_id,$web_service=null)
    {
        $sql = 'SELECT ipsp.primary_sales_product_id as id,mpsr.product_sku_code,mpsc.product_sku_name,ipsp.quantity,ipsp.dispatched_quantity,ipsp.amount ';
        $sql .= 'FROM bf_ishop_primary_sales_product AS ipsp ';
        $sql .= 'JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_country_id = ipsp.product_sku_id) ';
        $sql .= 'JOIN bf_master_product_sku_regional AS mpsr ON (mpsr.product_sku_id = mpsc.product_sku_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND ipsp.primary_sales_id=' . $sales_id . ' ';
        $info = $this->db->query($sql);
        $limit = $info->result_array();

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            return $limit;
        } else {
            $invoice_product = array('result' => $limit);

            if (isset($invoice_product['result']) && !empty($invoice_product['result'])) {
                $i = 1;
                $invoice_product_view['head'] = array('Sr. No.', 'SKU Code', 'SKU Name', 'PO Qty', 'Dispatched Qty', 'Amount');

                foreach ($invoice_product['result'] as $ip) {
                    $invoice_product_view['row'][] = array($i, $ip['product_sku_code'], $ip['product_sku_name'], $ip['quantity'], $ip['dispatched_quantity'], $ip['amount']);
                    $i++;
                }
                $invoice_product_view['eye'] = '';
                $invoice_product_view['action'] = '';
                $invoice_product_view['radio'] = '';
                $invoice_product_view['no_margin'] = '';
                // $product_view['pagination'] = $report_details['pagination'];
                return $invoice_product_view;

            }
            else{
                return false;
            }
        }
    }



    /*--------------------------------------------------------------------------------------------------------------------*/

    /**
     * @ Function Name        : get_product_conversion_data
     * @ Function Params    : product sku id , quantity to be calculated , unit data on basis of whiuch calculation need to be done
     * @ Function Purpose    : Return converted quantity value
     * @ Function Return    : value
     * */

    public function get_product_conversion_data($skuid, $quantity_data, $unit_data)
    {

        $this->db->select('*');
        $this->db->from('bf_master_conversation as conv');
        $this->db->where('product_sku_id', $skuid);
        $product_conversion_data = $this->db->get()->result_array();

        $result = "";

        if (!empty($product_conversion_data)) {

            if ($unit_data == "box") {
                $box_conversion_data = $product_conversion_data[0]["box_conversion_factor"];
                $result = $quantity_data * $box_conversion_data;

            } else if ($unit_data == "packages") {
                $package_conversion_data = $product_conversion_data[0]["sku_convesion_factor"];
                $result = $quantity_data * $package_conversion_data;

            } else {
                $result = $quantity_data;
            }
        }
        return $result;

    }

    /**
     * @ Function Name        : get_retailer_by_user_id
     * @ Function Params    : $country_id
     * @ Function Purpose    : Return list of retailers of specific country
     * @ Function Return    : Array
     * */

    public function get_retailer_by_user_id($country_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('type', 'customer');
        $this->db->where('role_id', '10');
        $this->db->where('country_id', $country_id);
        $retailer = $this->db->get()->result_array();
        if (isset($retailer) && !empty($retailer)) {
            return $retailer;
        } else {
            return false;
        }
    }

    /**
     * @ Function Name        : get_distributor_by_retailer
     * @ Function Params    : country_id, retailer_id
     * @ Function Purpose    : Return list of distributors for specific retailers
     * @ Function Return    : Array
     * */

    public function get_distributor_by_retailer($country_id, $retailer_id,$web_service=null)
    {

        $this->db->select('*');
        $this->db->from('users as u');
        $this->db->join('bf_master_customer_to_customer_mapping as c_to_c', 'c_to_c.from_customer_id = u.id');
        $this->db->where('u.type', 'customer');
        $this->db->where('c_to_c.to_customer_id', $retailer_id);
        $this->db->where('u.role_id', '9');
        $this->db->where('u.deleted', '0');
        $this->db->where('u.country_id', $country_id);

        $retailer_distributer_data = $this->db->get()->result_array();
        if (isset($retailer_distributer_data) && !empty($retailer_distributer_data)) {
            if($web_service=='web_service'){
                return $retailer_distributer_data;
            }
            return json_encode($retailer_distributer_data);
        } else {
            return 0;
        }

    }

    /**
     * @ Function Name        : add_order_place_details
     * @ Function Params    : Login user id = user_id
     * @ Function Purpose    : Add order to database table orders
     * @ Function Return    : Array
     * */

    public function add_order_place_details($user_id, $user_country_id, $web_service = null)
    {
        if ($this->input->post("login_customer_type") == 9) {

            /*
             * IF LOGIN USER IS DISTRIBUTOR
             */
            $customer_id_from = $user_id;
            $customer_id_to = 0;
            $order_taken_by_id = $user_id;

            $order_status = 0;

            $po_no = $this->input->post("po_no");

            $order_date = date("Y-m-d");

        } else if ($this->input->post("login_customer_type") == 10) {

            /*
             * IF LOGIN USER IS RETAILER
             */

            $distributor_id = $this->input->post("distributor_id");

            $customer_id_from = $user_id;
            $customer_id_to = $distributor_id;
            $order_taken_by_id = $user_id;

            $order_status = 0;

            $po_no = NULL;

            $order_date = date("Y-m-d");

        } else if ($this->input->post("login_customer_type") == 8) {

            /*
             * IF LOGIN USER IS FEILD OFFICER
             */
            if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
                if ($this->input->post("radio1") == "farmer") {

                    $customer_id_from = $this->input->post("farmer_id");
                    $customer_id_to = $this->input->post("retailer_id");
                    $order_taken_by_id = $user_id;
                    $order_date = date("Y-m-d", strtotime($this->input->post("order_date")));

                } elseif ($this->input->post("radio1") == "retailer") {

                    $customer_id_to = $this->input->post("distributor_id");
                    $customer_id_from = $this->input->post("retailer_id");
                    $order_taken_by_id = $user_id;
                    $order_date = date("Y-m-d");

                } elseif ($this->input->post("radio1") == "distributor") {

                    $customer_id_from = $this->input->post("distributor_id");
                    $customer_id_to = 0;
                    $order_taken_by_id = $user_id;
                    $order_date = date("Y-m-d");

                }
            }
            else{
                if ($this->input->post("radio1") == "farmer") {

                    $farmer_id = $this->input->post("farmer_data");
                    $retailer_id = $this->input->post("farmer_retailer_data");

                    $customer_id_from = $farmer_id;
                    $customer_id_to = $retailer_id;
                    $order_taken_by_id = $user_id;

                    $order_date = date("Y-m-d", strtotime($this->input->post("order_date")));

                } elseif ($this->input->post("radio1") == "retailer") {

                    $distributor_id = $this->input->post("distributor_data");
                    $retailer_id = $this->input->post("fo_retailer_data");

                    $customer_id_from = $retailer_id;
                    $customer_id_to = $distributor_id;
                    $order_taken_by_id = $user_id;

                    $order_date = date("Y-m-d");

                } elseif ($this->input->post("radio1") == "distributor") {
                    $distributor_id = $this->input->post("fo_distributor_data");

                    $customer_id_from = $distributor_id;
                    $customer_id_to = 0;
                    $order_taken_by_id = $user_id;

                    $order_date = date("Y-m-d");

                }
            }
            $order_status = 4;
            $po_no = NULL;

        } else {

            /*
             * IF LOGIN USER IS HO
             */

            //    testdata($_POST);
            if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
                $distributor_id = (isset($_POST["distributor_id"])) ? $_POST["distributor_id"] : 0;
                $retailer_id = (isset($_POST["retailer_id"])) ? $_POST["retailer_id"] : 0;
            }else{
                
                if ($this->input->post("radio1") != "distributor") {
                    $distributor_id = (isset($_POST["retailer_distributor_id"])) ? $_POST["retailer_distributor_id"] : 0;
                }
                else{
                    $distributor_id = (isset($_POST["distributor_id"])) ? $_POST["distributor_id"] : 0;
                }
                
                
                $retailer_id = (isset($_POST["retailer_id"])) ? $_POST["retailer_id"] : 0;
            }


            if ($retailer_id == 0) {
                $customer_id_from = $distributor_id;
                $customer_id_to = 0;
                $order_taken_by_id = $user_id;
            } else {
                $customer_id_from = $retailer_id;
                $customer_id_to = $distributor_id;
                $order_taken_by_id = $user_id;
            }

            $order_status = 4;
            $po_no = NULL;
            $order_date = date("Y-m-d");

        }

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $units = explode(',', $this->input->post("units"));
            $product_sku_id = explode(',', $this->input->post("product_sku_id"));
            $quantity = explode(',', $this->input->post("quantity"));
            $Qty = explode(',', $this->input->post("Qty"));
        } else {
            $units = $this->input->post("units");
            $product_sku_id = $this->input->post("product_sku_id");
            $quantity = $this->input->post("quantity");
            $Qty = $this->input->post("Qty");
        }
        $rand_type = 'otn';
        $table = 'bf_ishop_orders';

        $rand_data = $this->get_random_no($rand_type, $table);


        $order_place_data = array(
            'customer_id_from' => $customer_id_from,
            'customer_id_to' => $customer_id_to,
            'order_taken_by_id' => $order_taken_by_id,
            'order_date' => $order_date,
            'order_tracking_no' => $rand_data,
            'PO_no' => $po_no,
            'order_status' => $order_status,
            'country_id' => $user_country_id,
            'created_by_user' => $user_id,
            'status' => '1',
            'created_on' => date('Y-m-d H:i:s')
        );
          //testdata($order_place_data);

        if ($this->db->insert('bf_ishop_orders', $order_place_data)) {
            $insert_id = $this->db->insert_id();
        }

        $order_id = $insert_id;
        $total = 0;
        foreach ($product_sku_id as $key => $prd_sku) {

            $amt = $this->get_product_price_by_product($prd_sku,'ishop');
            $amt= $amt * $Qty[$key];
            $order_data = array(
                'order_id' => $order_id,
                'product_sku_id' => $prd_sku,
                'quantity' => $quantity[$key],
                'unit' => $units[$key],
                'quantity_kg_ltr' => $Qty[$key],
                'amount' => $amt,
            );

            $total = $total + $amt;

            $this->db->insert('bf_ishop_product_order', $order_data);
        }

        $total_array= array(
            'total_amount' =>$total,
        );

        $this->db->where('order_id',$order_id);
        $this->db->update('ishop_orders',$total_array);

        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }


    public function get_product_price_by_product($prd_sku,$price_type)
    {
            $this->db->select('*');
            $this->db->from('master_price');
            $this->db->where('price_type',$price_type);
            $this->db->where('product_sku_country_id',$prd_sku);
            $price = $this->db->get()->row_array();

            if(isset($price) && !empty($price)){
              //  testdata($price['price']);
                return $price['price'];
            }

    }

    public function get_random_no($rand_type, $table)
    {

        if ($rand_type == 'otn') {
            $random_no = 'O' . mt_rand(100000, 999999);
        } elseif ($rand_type == 'etn') {
            $random_no = 'E' . mt_rand(100000, 999999);
        }

        $check_data = $this->check_unique_random_data($rand_type, $table, $random_no);
        if ($check_data == 1) {
            $this->get_random_no($rand_type, $table);
        } else {
            return $random_no;
        }

    }

    public function check_unique_random_data($rand_type, $table, $random_no)
    {

        $this->db->select('*');
        $this->db->from($table);

        if (($table == 'bf_ishop_orders') && $rand_type == 'otn') {
            $this->db->where('order_tracking_no', $random_no);
        } elseif ($table == 'ishop_secondary_sales' && $rand_type == 'etn') {
            $this->db->where('etn_no', $random_no);
        }

        $rand_data = $this->db->get()->result_array();
        if (isset($rand_data) && !empty($rand_data)) {
            return 1;
        } else {
            return 0;
        }

    }


    /**
     * @ Function Name        : get_employee_geo_data
     * @ Function Params    : user id, countryid, customertype
     * @ Function Purpose    : For getting employee geo data
     * @ Function Return    : Array
     * */

    public function get_employee_geo_data($user_id, $country_id, $customer_type, $parent_geo_id = null, $radio_checked = null, $action_data = null, $mobileno = null)
    {
        //  var_dump($radio_checked);
        $main_query_start = "";
        $main_query_end = "";
        $select_data = " bmpgd.political_geo_id, bmpgd.political_geography_name ";
        $sub_query = "";


        //$action_data =  $this->uri->segment(2);

        //   echo $user_id."===".$country_id."===".$customer_type."===".$parent_geo_id."===".$radio_checked."===".$action_data;
        //  die;
        //  testdata($action_data);

        // if($customer_type == 7){

        //  }

        if ($customer_type == 8) {


            if (($action_data == "order_place" || $action_data == "order_status" || (($action_data == "physical_stock" && $radio_checked != 9) || ($action_data == "ishop_sales" && $radio_checked != 9) || ($action_data == "sales_view" && $radio_checked != 9))) && $parent_geo_id == null) {
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
            if ($mobileno != null) {
                $where3 = " `bmucd`.`primary_mobile_no` = '" . $mobileno . "' AND ";
            }


        } elseif ($customer_type == 7) {


            if (($radio_checked == 10 && (($action_data == "order_place" || $action_data == "order_status" || $action_data == 'set_schemes' || $action_data == 'schemes_view' || $action_data == 'target' || $action_data == 'budget') || ($action_data == "set_rol" && $radio_checked != 9)) && $parent_geo_id == null)) {
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
            $subquery1 = $main_query_start . " SELECT  " . $select_data . " FROM (`bf_master_employe_to_customer` as etc)
                       JOIN `bf_users` as bu ON `bu`.`id` = `etc`.`customer_id` ";

            $where1 = " `etc`.`employee_id` = " . $user_id;
            $where2 = " AND YEAR(etc.year) = '" . date("Y") . "' AND ";

            $where3 = "";

            if ($mobileno != null) {
                $where3 = "AND `bmucd`.`primary_mobile_no` = '" . $mobileno;
            }

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

        // echo $this->db->last_query();
//die;
        return $geo_loc_data;

    }


    public function get_employee_geo_data_for_copy_popup($user_country, $login_customer_type, $default_type, $url_data)
    {

        $query1 = "SELECT bmpgd.political_geo_id, bmpgd.political_geography_name FROM `bf_users` as bu 

JOIN `bf_master_user_contact_details` as bmucd ON `bmucd`.`user_id` = `bu`.`id` 
JOIN `bf_master_political_geography_details` as bmpgd ON `bmpgd`.`political_geo_id` = `bmucd`.`geo_level_id1`

WHERE `bu`.`role_id` = " . $default_type . " AND `bu`.`type` = 'Customer' AND `bu`.`deleted` = '0' AND `bu`.`country_id` = '" . $user_country . "' GROUP BY `bmpgd`.`political_geography_name`";

        $query = $this->db->query($query1);

        $geo_loc_data = $query->result_array();

        // echo $this->db->last_query();
//die;
        return $geo_loc_data;
    }

    /**
     * @ Function Name        : get_user_for_geo_data
     * @ Function Params    : selected geo id, country id
     * @ Function Purpose    : For getting user for selected geo location for FO
     * @ Function Return    : Json
     * */

    public function get_user_for_geo_data($selected_geo_id, $country_id, $checked_data, $mobile_no = null)
    {

        if ($checked_data == "farmer") {

            $selected_type = 11;

        } else if ($checked_data == "retailer") {

            $selected_type = 10;

        } else if ($checked_data == "distributor") {

            $selected_type = 9;

        }

        $this->db->select('bu.id,bu.display_name,bmupd.first_name,bmupd.middle_name,bmupd.last_name,bmucd.geo_level_id1,bu.user_code');
        $this->db->from('bf_users as bu');

        $this->db->join('bf_master_user_contact_details as bmucd', 'bmucd.user_id = bu.id'); // GET GEO FROM HERE FOR CUSTOMER USER
        $this->db->join('bf_master_user_personal_details as bmupd', 'bmupd.user_id = bu.id'); // FOR GETTING USER NAME AND OTHER DATA

        $this->db->where('bmucd.geo_level_id1', $selected_geo_id);

        $this->db->where('bu.role_id', $selected_type); // FOR GETTING USER (FARMERS = 11) OF SPECFIC GEO

        if ($mobile_no != null) {
            $this->db->where('bmucd.primary_mobile_no', $mobile_no); // FOR GETTING FARMER OF SPECIFIC MOBILE NUMBER
        }

        $this->db->where('bu.type', 'Customer');
        $this->db->where('bu.deleted', '0');
        $this->db->where('bu.country_id', $country_id); //FOR GETTING USER OF SPECFIC COUNTRY
        //   $this->db->where('bu.deleted','0');

        $geo_user_data = $this->db->get()->result_array();

        //echo $this->db->last_query();
        // die;
        if (isset($geo_user_data) && !empty($geo_user_data)) {
            return json_encode($geo_user_data);
        } else {
            return 0;
        }

    }


    /**
     * @ Function Name        : get_retailer_for_customer_data
     * @ Function Params    : selected user id
     * @ Function Purpose    : For getting retailers for selected users (i.e FARMER) FO
     * @ Function Return    : Json
     * */

    function get_retailer_for_customer_data($selected_user_id, $radio_checkedtype, $logincustomerrole)
    {

        if ($radio_checkedtype == "farmer") {

            $role_data = 10;  // If farmer check box checked than to get retailer (role id 10) data

        } elseif ($radio_checkedtype == "retailer") {

            $role_data = 9;

        }

      //  $this->db->select('bu.id,bmupd.first_name,bmupd.middle_name,bmupd.last_name');
        $this->db->select('bu.id,bu.display_name');
        $this->db->from('bf_master_customer_to_customer_mapping as bmctcm');

        $this->db->join('bf_users as bu', 'bu.id = bmctcm.from_customer_id');
        $this->db->join('bf_master_user_personal_details as bmupd', 'bmupd.user_id = bu.id'); // FOR GETTING USER NAME AND OTHER DATA

        $this->db->where('bmctcm.to_customer_id', $selected_user_id);

        $this->db->where('bu.role_id', $role_data); // FOR GETTING USER (RETAILERS = 10) OF SPECIFICE FARMER
        $this->db->where('bu.type', 'Customer');
        $this->db->where('bu.deleted', '0');

        $retailer_user_data = $this->db->get()->result_array();

        if (isset($retailer_user_data) && !empty($retailer_user_data)) {
            return json_encode($retailer_user_data);
        } else {
            return 0;
        }


    }

    /**
     * @ Function Name        : get_prespective_order
     * @ Function Params    : from date, to date, login userid , login usertype(role id)
     * @ Function Purpose    : For getting retailers for selected users (i.e FARMER) FO
     * @ Function Return    : Json
     * */

    public function get_prespective_order($from_date, $todate, $loginusertype, $loginuserid, $page = null, $web_service = null,$local_date = null)
    {

        $sql = 'SELECT SQL_CALC_FOUND_ROWS  bio.order_id,bio.customer_id_from,bio.customer_id_to,bio.order_taken_by_id,bio.order_date,bio.PO_no,bio.order_tracking_no,bio.read_status,bio.created_on, bmupd.first_name as from_fname,bmupd.middle_name as from_mname,bmupd.last_name as from_lname, bmucd.primary_mobile_no, bmucd.address ,bmupd1.first_name as ot_from_fname1,bmupd1.middle_name as ot_from_mname1,bmupd1.last_name as ot_from_lname1,bu.display_name as bu_dn,u.display_name as b_dn ';
        $sql .= ' FROM bf_ishop_orders as bio ';
        $sql .= ' LEFT JOIN bf_users AS bu ON (bu.id = bio.customer_id_from) ';
        $sql .= ' LEFT JOIN bf_master_user_personal_details as bmupd ON (bmupd.user_id = bu.id) ';
        $sql .= ' LEFT JOIN bf_master_user_contact_details as bmucd ON (bmucd.user_id = bu.id) ';

        $sql .= ' LEFT JOIN bf_users as u ON (u.id = bio.order_taken_by_id) ';
        $sql .= ' LEFT JOIN bf_master_user_personal_details as bmupd1 ON (bmupd1.user_id = u.id) ';

        $sql .= 'WHERE 1 ';

        $sql .= 'AND bio.order_date BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $todate . '"' . ' ';

        $sql .= 'AND bio.customer_id_to =' . $loginuserid . ' ';

        $sql .= 'ORDER BY order_date DESC ';

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {

            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page * $limit - $limit;
            $sql .= ' LIMIT ' . $offset . "," . $limit;
            $info = $this->db->query($sql);
            // For Pagination

            $prespective_order_data = $info->result_array();
            return $prespective_order_data;
        } else {
            $prespective_order = $this->grid->get_result_res($sql);
            if (isset($prespective_order['result']) && !empty($prespective_order['result'])) {

                if ($loginusertype == 9) {
                    $head_data = "Retailer Name";
                } else {
                    $head_data = "Farmer Name";
                }

                $prespective['head'] = array('Sr. No.', 'Entered By', 'PO No', 'OTN', 'Date Of Entry', $head_data, 'Address', 'Mobile No.', 'Read');
                $prespective['count'] = count($prespective['head']);
                if ($page != null || $page != "") {

                    $i = (($page * 10) - 9);

                } else {
                    $i = 1;
                }

                foreach ($prespective_order['result'] as $po) {
                    if ($po['read_status'] == 0) {
                        $read_status = "<a class='read_" . $po['order_id'] . "' href='javascript:void(0);' onclick = 'mark_as_read(" . $po['order_id'] . ");' >Mark as Read</a>";
                    } else {
                        $read_status = "Read";
                    }

                    $otn = '<div class="eye_i" prdid ="' . $po['order_id'] . '"><a href="javascript:void(0);">' . $po['order_tracking_no'] . '</a></div>';
                    if($local_date != null)
                    {
                      $date = strtotime($po['order_date']);
                        $doe = date($local_date,$date);
                    }
                    else{
                        $doe = $po['order_date'];
                    }

                    $prespective['row'][] = array($i, $po['b_dn'], $po['PO_no'], $otn, $doe, $po['bu_dn'], $po['address'], $po['primary_mobile_no'], $read_status);
                    $i++;
                }
                $prespective['eye'] = "";
                $prespective['pagination'] = $prespective_order['pagination'];
                return $prespective;
            }
            else{
                return false;
            }
        }

    }

    /**
     * @ Function Name        : order_product_details_view_by_id
     * @ Function Params    : order id
     * @ Function Purpose    : For getting order detailed data by order id
     * @ Function Return    : array
     * */

    public function order_product_details_view_by_id($order_id,$web_service=null,$csv=null)
    {

        $sql = 'SELECT bipo.product_order_id,psr.product_sku_code,psc.product_sku_name, bipo.quantity_kg_ltr,bipo.quantity,bipo.unit ';
        $sql .= ' FROM bf_ishop_product_order as bipo ';

        $sql .= ' LEFT JOIN bf_master_product_sku_country as psc ON (psc.product_sku_country_id = bipo.product_sku_id) ';
        $sql .= ' LEFT JOIN bf_master_product_sku_regional as psr ON (psr.product_sku_id = psc.product_sku_id) ';

        $sql .= 'WHERE 1 ';

        $sql .= 'AND bipo.order_id =' . $order_id . ' ';

        //$sql .= 'ORDER BY order_date DESC ';
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $info = $this->db->query($sql);
            $order_detail = $info->result_array();
            return $order_detail;

        } else {

            $order_detail = $this->grid->get_result_res($sql);


            //  $order_detail = array('result'=>$prespective_order_details);

            if (isset($order_detail['result']) && !empty($order_detail['result'])) {
                $product_view['head'] = array('Sr. No.', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr');

                // $product_view['count'] = count($product_view['head']);
                $i = 1;
                foreach ($order_detail['result'] as $od) {
                    $product_view['row'][] = array($i, $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'], $od['quantity_kg_ltr']);
                    $i++;
                }
                $product_view['eye'] = '';
                //  $product_view['pagination'] = $order_detail['pagination'];
                return $product_view;
            } else {
                return false;
            }
        }
    }

    /**
     * @ Function Name        : order_mark_as_read
     * @ Function Params    : order id
     * @ Function Purpose    : For maring order as read
     * @ Function Return    : array
     * */

    public function order_mark_as_read($orderid)
    {

        $read_array = array('read_status' => 1);
        // $this->db->where('order_id', $orderid);
        //  $this->db->update('bf_ishop_orders', $read_array); 

        $this->db->update('bf_ishop_orders', $read_array, array('order_id' => $orderid));

        return $this->db->affected_rows();
    }

    /**
     * @ Function Name        : order_mark_as_unread
     * @ Function Params    : order id
     * @ Function Purpose    : For marking order as unread
     * @ Function Return    : array
     * */

    public function order_mark_as_unread($orderid)
    {

        $unread_array = array('read_status' => 0);
        //$this->db->where('order_id', $orderid);
        // $this->db->update('bf_ishop_orders', $unread_array); 

        $this->db->update('bf_ishop_orders', $unread_array, array('order_id' => $orderid));

        return $this->db->affected_rows();
    }

    /*
     * GET ORDER FOR ORDER STATUS
     */

    /**
     * @ Function Name        : get_order_data
     * @ Function Params    : login user type, radio checked(farmer, retailer, distributor) login user id, from date , to date, otn no
     * @ Function Purpose    : For getting order data
     * @ Function Return    : array
     * */

    public function get_order_data($loginusertype, $user_country_id, $radio_checked, $loginuserid, $customer_id=null, $from_date=null, $todate = null, $order_tracking_no = null, $order_po_no = null, $page = null, $page_function = null, $order_status = null, $web_service = null,$local_date=null)
    {

        //$sql = 'SELECT bio.order_id,bio.customer_id_from,bio.customer_id_to,bio.order_taken_by_id,bio.order_date,bio.PO_no,bio.order_tracking_no,bio.estimated_delivery_date,bio.total_amount,bio.order_status,bio.read_status, bmupd.first_name as ot_fname,bmupd.middle_name as ot_mname,bmupd.last_name as ot_lname,t_bmupd.first_name as to_fname,t_bmupd.middle_name as to_mname,t_bmupd.last_name as to_lname,f_bmupd.first_name as fr_fname,f_bmupd.middle_name as fr_mname,f_bmupd.last_name as fr_lname,f_bu.role_id,f_bu.user_code as f_u_code, bicl.credit_limit ';

        $sql =' SELECT SQL_CALC_FOUND_ROWS bio.order_id,bio.customer_id_from,bio.customer_id_to,bio.order_taken_by_id,bio.order_date,bio.PO_no,bio.order_tracking_no,bio.estimated_delivery_date,bio.total_amount,bio.order_status,bio.read_status, f_bu.role_id,f_bu.user_code as f_u_code, bicl.credit_limit,bu.display_name,f_bu.display_name as f_dn,t_bu.display_name as t_dn,bio.created_on ';

        $sql .= ' FROM bf_ishop_orders as bio ';
        $sql .= ' LEFT JOIN bf_users AS bu ON (bu.id = bio.order_taken_by_id) ';
        $sql .= ' LEFT JOIN bf_users as f_bu ON (f_bu.id = bio.customer_id_from) ';
        $sql .= ' LEFT JOIN bf_users as t_bu ON (t_bu.id = bio.customer_id_to) ';
        $sql .= ' LEFT JOIN bf_ishop_credit_limit as bicl ON (bicl.customer_id = bio.customer_id_from) ';
        $sql .= 'WHERE 1 ';

        if (isset($page_function) && !empty($page_function)) {
            $action_data = $page_function;
        } else {
            $action_data = $this->uri->segment(2);
        }
        if ($action_data != "order_approval") {
            if ($order_tracking_no != null ) {
                $sql .= ' AND bio.order_tracking_no =' .'"'. $order_tracking_no .'"'. ' ';
                $sql .= ' AND f_bu.role_id = 11  ';
            } else {
                if ($action_data != "po_acknowledgement") {
                    $sql .= ' AND bio.order_date BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $todate . '"' . ' ';
                }
                if ($action_data == "po_acknowledgement") {
                    $sql .= ' AND bio.order_taken_by_id !=' . $customer_id . ' ';
                    $sql .= ' AND bio.order_status = 4 ';
                }
                $sql .= ' AND bio.customer_id_from =' . $customer_id . ' ';
            }

        } else if ($action_data == "order_approval") {
            if (isset($order_status) && !empty($order_status)) {
                $sub_action_data = $order_status;
            } else {
                $sub_action_data = $_POST["renderdata"];
            }

            $sql .= ' AND bio.order_date BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $todate . '"' . ' ';
           // $sql .= ' AND bio.order_taken_by_id =' . $customer_id . ' ';
            $sql .= ' AND f_bu.role_id = 9 ';

            if ($order_tracking_no != null) {
                $sql .= ' AND bio.order_tracking_no ="' . $order_tracking_no . '" ';
            }
            if ($order_po_no != null) {
                $sql .= ' AND bio.PO_no ="' . $order_po_no . '" ';
            }
            if ($sub_action_data == "dispatched") {
                $sql .= ' AND bio.order_status = 1 ';
            } elseif ($sub_action_data == "pending") {
                $sql .= ' AND bio.order_status = 0 ';
            } elseif ($sub_action_data == "reject") {
                $sql .= ' AND bio.order_status = 3 ';
            }
                $sql .= ' AND bio.order_status != 4 ';

        }

        if($loginusertype == '9')
        {
            $subsql = ' AND  f_bu.role_id ="'.$loginusertype.'" ';

        }
        elseif($loginusertype == '10')
        {
            $subsql = ' AND  f_bu.role_id = "'.$loginusertype.'" ';
        }
        elseif($action_data == "get_order_status_data")
        {
           $subsql = ' AND bu.role_id="'.$loginusertype.'" ';
        }
        else
        {
            $subsql = '';
        }

        $sql .= ' AND bio.country_id = "' . $user_country_id . '" '.$subsql.' ORDER BY bio.created_on DESC ';
        
       // echo $action_data."</br>";
        
      //  echo $sql;
       // die;
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {

            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page*$limit-$limit;
            $sql .= ' LIMIT '.$offset.",".$limit;
            $info = $this->db->query($sql);

            $order_data = $info->result_array();
          //  testdata($order_data);
            return $order_data;

        } else {


            $orderdata = $this->grid->get_result_res($sql);

            if (isset($orderdata['result']) && !empty($orderdata['result'])) {

                if ($loginusertype == 7) {
                    //FOR HO
                    if ($action_data == "order_approval") {

                        $order_view['head'] = array('', 'Sr. No.', 'Distributor Code', 'Distributor Name', 'PO No.', 'Order Tracking No.', 'Credit Limit', 'Amount', 'Status');
                        $order_view['count'] = count($order_view['head']);
                        if ($page != null || $page != "") {
                            $i = (($page * 10) - 9);
                        } else {
                            $i = 1;
                        }

                        foreach ($orderdata['result'] as $od) {

                            if ($od['order_status'] == 0) {
                                $order_status = "Pending";
                            } elseif ($od['order_status'] == 1) {
                                $order_status = "Dispatched";
                            } elseif ($od['order_status'] == 3) {
                                $order_status = "Rejected";
                            } elseif ($od['order_status'] == 4) {
                                $order_status = "OP_Ackno";
                            }

                            $order_data = '<input type="hidden" name="order_data[]" value="' . $od['order_id'] . '" /><input id="check_data_' . $od['order_id'] . '" type="hidden" name="change_order_status[]" class="change_order_status" value="0"/>';

                            $otn = '<div class="eye_i" prdid ="' . $od['order_id'] . '"><a href="javascript:void(0);">' . $od['order_tracking_no'] . '</a></div>';

                            $checkbox = $order_data . '<input id="order_status_' . $od['order_id'] . '" type="checkbox" name="change_order_status1[]" class="order_status" />';

                            $order_view['row'][] = array($checkbox, $i, $od['f_u_code'],$od['f_dn'] , $od['PO_no'], $otn, $od['credit_limit'], $od['total_amount'], $order_status);
                            $i++;
                        }
                        $order_view['eye'] = '';

                    } else
                    {
                        if($radio_checked == "retailer"){
                            $order_view['head'] = array('Sr. No.', 'Remove','Distributor Name', 'Order Date', 'PO No.', 'Order Tracking No.', 'EDD', 'Amount', 'Entered By', 'Status');
                            $order_view['count'] = count($order_view['head']);
                            if ($page != null || $page != "") {
                                $i = (($page * 10) - 9);
                            } else {
                                $i = 1;
                            }

                            foreach ($orderdata['result'] as $od) {

                                if ($od['read_status'] == 0) {
                                    $order_status = "Unread";
                                } elseif ($od['read_status'] == 1) {
                                    $order_status = "Read";
                                }


                                $otn = '<div class="eye_i" prdid ="' . $od['order_id'] . '"><a href="javascript:void(0);">' . $od['order_tracking_no'] . '</a></div>';
                                if($local_date != null){
                                    $date = strtotime($od['order_date']);
                                    $order_date = date($local_date,$date);

                                    $time= strtotime($od['created_on']);
                                    $t= date('g:i a',$time);

                                    $order_datetime = $order_date.' '.$t;
                                }
                                else{
                                    $order_datetime = $od['order_date'];
                                }
                                $order_view['row'][] = array($i, $od['order_id'],$od['t_dn'],$order_datetime, $od['PO_no'], $otn, $od['estimated_delivery_date'], $od['total_amount'], $od['display_name'], $order_status);
                                $i++;


                                if ($od['order_status'] == 4) {
                                    $order_view['delete'][] = '';
                                } else {
                                    $order_view['delete'][] = 'is_idelete';
                                }
                            }
                            $order_view['eye'] = '';
                        }
                        else{

                            $order_view['head'] = array('Sr. No.', 'Remove', 'Order Date', 'PO No.', 'Order Tracking No.', 'EDD', 'Amount', 'Entered By', 'Status');
                            $order_view['count'] = count($order_view['head']);
                            if ($page != null || $page != "") {
                                $i = (($page * 10) - 9);
                            } else {
                                $i = 1;
                            }

                            foreach ($orderdata['result'] as $od) {

                                if ($od['order_status'] == 0) {
                                    $order_status = "Pending";
                                } elseif ($od['order_status'] == 1) {
                                    $order_status = "Dispatched";
                                } elseif ($od['order_status'] == 3) {
                                    $order_status = "Rejected";
                                } elseif ($od['order_status'] == 4) {
                                    $order_status = "OP_Ackno";
                                }

                                $otn = '<div class="eye_i" prdid ="' . $od['order_id'] . '"><a href="javascript:void(0);">' . $od['order_tracking_no'] . '</a></div>';
                                if($local_date != null){
                                    $date = strtotime($od['order_date']);
                                    $order_date = date($local_date,$date);

                                    $time= strtotime($od['created_on']);
                                    $t= date('g:i a',$time);

                                    $order_datetime = $order_date.' '.$t;

                                    if(!empty($od["estimated_delivery_date"]))
                                    {
                                        $date1 = strtotime($od["estimated_delivery_date"]);
                                        $estimated_date =  date($local_date,$date1);
                                    }
                                    else{
                                        $estimated_date='';
                                    }

                                }
                                else{
                                    $order_datetime = $od['order_date'];
                                    $estimated_date =$od["estimated_delivery_date"];

                                }
                                $order_view['row'][] = array($i, $od['order_id'],$order_datetime, $od['PO_no'], $otn, $estimated_date, $od['total_amount'], $od['display_name'], $order_status);
                                $i++;


                                if ($od['order_status'] == 4) {
                                    $order_view['delete'][] = '';
                                } else {
                                    $order_view['delete'][] = 'is_idelete';
                                }


                            }
                            $order_view['eye'] = '';


                        }
                    }
                } else if ($loginusertype == 8) {
                    //FOR FO
                    if ($radio_checked == "farmer") {

                        $order_view['head'] = array('Sr. No.', '', 'Farmer Name', 'Retailer Name', 'Order Tracking No.', 'Entered By', 'Read');
                        $order_view['count'] = count($order_view['head']);
                    } elseif ($radio_checked == "retailer") {

                        $order_view['head'] = array('Sr. No.', 'Action', 'Retailer Code', 'Retailer Name', 'Distributor Name', 'Order Date', 'PO NO.', 'Order Tracking No.', 'EDD', 'Amount', 'Entered By', 'Status');
                        $order_view['count'] = count($order_view['head']);
                    } elseif ($radio_checked == "distributor") {

                        $order_view['head'] = array('Sr. No.', 'Action', 'Distributor Code', 'Distributor Name', 'Order Date', 'PO NO.', 'Order Tracking No.', 'EDD', 'Amount', 'Entered By', 'Status');
                        $order_view['count'] = count($order_view['head']);
                    }

                    $i = 1;

                    foreach ($orderdata['result'] as $od) {

                       /* if ($od['read_status'] == 0) {
                            $read_status = "<a class='read_" . $od['order_id'] . "' href='javascript:void(0);' onclick = 'mark_as_read(" . $od['order_id'] . ");' >Mark as Read</a>";
                        } else {
                            $read_status = "<a class='unread_" . $od['order_id'] . "'  href='javascript:void(0);'  onclick = 'mark_as_unread(" . $od['order_id'] . ");'>Mark as Unread</a>";
                        }*/


                        if ($od['order_status'] == 0) {
                            $order_status = "Pending";
                        } elseif ($od['order_status'] == 1) {
                            $order_status = "Dispatched";
                        } elseif ($od['order_status'] == 2) {
                            $order_status = "";
                        } elseif ($od['order_status'] == 3) {
                            $order_status = "Rejected";
                        } elseif ($od['order_status'] == 4) {
                            $order_status = "OP_Ackno";
                        }


                        $otn = '<div class="eye_i" prdid ="' . $od['order_id'] . '"><a href="javascript:void(0);">' . $od['order_tracking_no'] . '</a></div>';


                        if ($radio_checked == "farmer") {

                            if ($od['read_status'] == 0) {
                                $read_status = "Unread";
                            } else {
                                $read_status = "Read";
                            }

                            $order_view['row'][] = array($i, "", $od['f_dn'] , $od['t_dn'], $otn, $od['display_name'], $read_status);

                        } elseif ($radio_checked == "retailer") {
                            if ($od['read_status'] == 0) {
                                $read_status = "Unread";
                            } else {
                                $read_status = "Read";
                            }
                            if($local_date != null){
                                $date = strtotime($od['order_date']);
                                $order_date = date($local_date,$date);

                                $time= strtotime($od['created_on']);
                                $t= date('g:i a',$time);

                                $order_datetime = $order_date.' '.$t;
                            }
                            else{
                                $order_datetime = $od['order_date'];
                            }

                            $order_view['row'][] = array($i, $od['order_id'], '', $od['f_dn'], $od['t_dn'], $order_datetime, $od["PO_no"], $otn, $od["estimated_delivery_date"], $od["total_amount"], $od['display_name'], $read_status);

                        } elseif ($radio_checked == "distributor") {
                            if($local_date != null){
                                $date = strtotime($od['order_date']);
                                $order_date = date($local_date,$date);

                                $time= strtotime($od['created_on']);
                                $t= date('g:i a',$time);

                                $order_datetime = $order_date.' '.$t;

                                if(!empty($od["estimated_delivery_date"]))
                                {
                                    $date1 = strtotime($od["estimated_delivery_date"]);
                                    $estimated_date =  date($local_date,$date1);
                                }
                                else{

                                    $estimated_date = '';
                                }


                            }
                            else{
                                $order_datetime = $od['order_date'];
                                $estimated_date = $od["estimated_delivery_date"] ;
                            }
                            $order_view['row'][] = array($i, $od['order_id'], '', $od['f_dn'], $order_datetime, $od["PO_no"], $otn, $estimated_date, $od["total_amount"], $od['display_name'], $order_status);
                        }
                        $i++;
                    }
                    $order_view['eye'] = '';


                } else if ($loginusertype == 9) {

                    //FOR DISTRIBUTOR

                    $action_data = $this->uri->segment(2);

                    if ($action_data != "po_acknowledgement") {

                        $order_view['head'] = array('Sr. No.', '', 'Order Date', 'PO No.', 'Order Tracking No.', 'EDD', 'Amount', 'Entered By', 'Status');
                        $order_view['count'] = count($order_view['head']);

                        //testdata($page);
                        if ($page != null || $page != "") {
                            $i = (($page * 10) - 9);
                        } else {
                            $i = 1;
                        }


                        foreach ($orderdata['result'] as $od) {

                            if ($od['order_status'] == 0) {
                                $order_status = "Pending";
                            } elseif ($od['order_status'] == 1) {
                                $order_status = "Dispatched";
                            } elseif ($od['order_status'] == 2) {
                                $order_status = "";
                            } elseif ($od['order_status'] == 3) {
                                $order_status = "Rejected";
                            } elseif ($od['order_status'] == 4) {
                                $order_status = "OP_Ackno";
                            }

                            $otn = '<div prdid ="' . $od['order_id'] . '"><a data-toggle="modal" onclick="show_po_popup(' . trim($od['order_id']) . ',' ."'".trim($od['PO_no'])."'". ');"  class="set_pono" href="javascript:void(0);">' . $od['order_tracking_no'] . '</a></div>';

                            $po_no = '<div class="eye_i" prdid ="' . $od['order_id'] . '"><a href="javascript: void(0);">' . $od['PO_no'] . '</a></div>';

                            if($local_date != null){
                                $date = strtotime($od['order_date']);
                                $order_date = date($local_date,$date);

                                $time= strtotime($od['created_on']);
                                $t= date('g:i a',$time);

                                $order_datetime = $order_date.' '.$t;

                                if(!empty($od["estimated_delivery_date"]))
                                {
                                    $date1 = strtotime($od["estimated_delivery_date"]);
                                    $estimated_date =  date($local_date,$date1);
                                }
                                else{
                                    $estimated_date = '';
                                }
                            }
                            else{
                                $order_datetime = $od['order_date'];
                                $estimated_date = $od["estimated_delivery_date"] ;
                            }
                            $order_view['row'][] = array($i, '', $order_datetime, $po_no, $otn, $estimated_date, $od['total_amount'], $od['display_name'], $order_status);
                            $i++;
                        }
                        $order_view['eye'] = '';
                    } else {

                        //FOR PO ACKNOWLEDGEMENT PAGE LAYOUT CREATED HERE

                        $order_view['head'] = array('Sr. No.', 'Action', 'Order Date', 'Order Tracking No.', 'Entered By', 'Enter PO No.');
                        $order_view['count'] = count($order_view['head']);
                        if ($page != null || $page != "") {
                            $i = (($page * 10) - 9);
                        } else {
                            $i = 1;
                        }

                        foreach ($orderdata['result'] as $od) {


                            $otn = '<div class="eye_i" prdid ="' . $od['order_id'] . '"><a href="javascript: void(0);">' . $od['order_tracking_no'] . '</a></div>';

                            $po_no = '<div  prdid ="' . $od['order_id'] . '"><input type="hidden" name="order_data[]" value="' . $od['order_id'] . '" /><input type="text" name="po_no[]" value="' . $od['PO_no'] . '" /></div>';
                            if($local_date != null){
                                $date = strtotime($od['order_date']);
                                $order_date = date($local_date,$date);

                                $time= strtotime($od['created_on']);
                                $t= date('g:i a',$time);

                                $order_datetime = $order_date.' '.$t;
                            }
                            else{
                                $order_datetime = $od['order_date'];
                            }
                            $order_view['row'][] = array($i, $od['order_id'],$order_datetime, $otn, $od['display_name'], $po_no);
                            $i++;
                        }
                        $order_view['eye'] = '';
                    }

                } else if ($loginusertype == 10)
                {
                    //FOR RETAILER
                    $action_data = $this->uri->segment(2);
                    if ($action_data != "po_acknowledgement") {

                        $order_view['head'] = array('Sr. No.', '', 'Distributor Name', 'Order Date', 'PO No.', 'Order Tracking No.', 'EDD', 'Amount', 'Entered By', 'Status');
                        $order_view['count'] = count($order_view['head']);
                        if ($page != null || $page != "") {
                            $i = (($page * 10) - 9);
                        } else {
                            $i = 1;
                        }

                        foreach ($orderdata['result'] as $od) {

                            if ($od['read_status'] == 0) {
                                $order_status = "Unread";
                            } elseif ($od['read_status'] == 1) {
                                $order_status = "Read";
                            }


                            $otn = '<div prdid ="' . $od['order_id'] . '"><a class="set_pono" onClick="show_po_popup(' . trim($od['order_id']) . ','."'".trim($od['PO_no'])."'".');" href="javascript:void(0);">' . $od['order_tracking_no'] . '</a></div>';

                            $po_no = '<div class="eye_i" prdid ="' . $od['order_id'] . '"><a href="javascript: void(0);">' . $od['PO_no'] . '</a></div>';
                            if($local_date != null){
                                $date = strtotime($od['order_date']);
                                $order_date = date($local_date,$date);

                                $time= strtotime($od['created_on']);
                                $t= date('g:i a',$time);

                                $order_datetime = $order_date.' '.$t;

                                if($od["estimated_delivery_date"]){
                                    $date1 = strtotime($od["estimated_delivery_date"]);
                                    $estimated_date =  date($local_date,$date1);
                                }
                                else{
                                    $estimated_date = '';
                                }

                            }
                            else{
                                $order_datetime = $od['order_date'];
                                if($od["estimated_delivery_date"]){
                                    $estimated_date = $od["estimated_delivery_date"] ;
                                }
                                else{
                                    $estimated_date = '' ;
                                }

                            }
                            $order_view['row'][] = array($i, '', $od['t_dn'],$order_datetime, $po_no, $otn,$estimated_date, $od['total_amount'], $od['display_name'], $order_status);
                            $i++;
                        }
                        $order_view['eye'] = '';

                    } else {

                        //FOR PO ACKNOWLEDGEMENT PAGE LAYOUT CREATED HERE

                        $order_view['head'] = array('Sr. No.', 'Action', 'Order Date', 'Order Tracking No.', 'Distributor', 'Entered By', 'Enter PO No.');
                        $order_view['count'] = count($order_view['head']);
                        if ($page != null || $page != "") {
                            $i = (($page * 10) - 9);
                        } else {
                            $i = 1;
                        }

                        foreach ($orderdata['result'] as $od) {


                            $otn = '<div class="eye_i" prdid ="' . $od['order_id'] . '"><a href="javascript: void(0);">' . $od['order_tracking_no'] . '</a></div>';

                            $po_no = '<div  prdid ="' . $od['order_id'] . '"><input type="hidden" name="order_data[]" value="' . $od['order_id'] . '" /><input type="text" name="po_no[]" value="' . $od['PO_no'] . '" /></div>';

                            if($local_date != null){
                                $date = strtotime($od['order_date']);
                                $order_date = date($local_date,$date);

                                $time= strtotime($od['created_on']);
                                $t= date('g:i a',$time);

                                $order_datetime = $order_date.' '.$t;
                            }
                            else{
                                $order_datetime = $od['order_date'];
                            }
                            $order_view['row'][] = array($i, $od['order_id'],$order_datetime, $otn, $od['f_dn'], $od['display_name'], $po_no);
                            $i++;
                        }
                        $order_view['eye'] = '';
                    }
                }


                $order_view['pagination'] = $orderdata['pagination'];
                return $order_view;
            }
            else{
                return false;
            }
        }
    }


    public function get_all_pending_data($user_id,$country_id)
    {
        $this->db->select('*');
        $this->db->from('ishop_orders as io');
        $this->db->join('users as f_bu','f_bu.id = io.customer_id_from ');
        $this->db->where('f_bu.role_id','9');
        $this->db->where('io.country_id',$country_id);
        $this->db->where('order_status','0');
      //  $query = $this->db->get()->result_array();
        $query = $this->db->get();
       // testdata($query);
        $pending_order = $query->num_rows();
        return $pending_order;
    }

    /**
     * @ Function Name        : order_status_product_details_view_by_id
     * @ Function Params    : login user type, radio checked(farmer, retailer, distributor), page url, order id
     * @ Function Purpose    : For getting order status detailed data
     * @ Function Return    : array
     * */


    public function order_status_product_details_view_by_id($order_id, $radiochecked, $logincustomertype, $action_data = null, $web_service = null,$csv=null)
    {

        $sql = 'SELECT bipo.product_order_id as id,bipo.product_order_id,psr.product_sku_code,psc.product_sku_name, bipo.quantity_kg_ltr,bipo.quantity,bipo.unit,bipo.amount,bipo.dispatched_quantity,psr.product_sku_id ';


       if($action_data == 'order_approval'){
           $sql .= ' , biccs.intrum_quantity  ';
       }
        $sql .= ' FROM bf_ishop_product_order as bipo ';
        $sql .= '  JOIN bf_master_product_sku_country as psc ON (psc.product_sku_country_id = bipo.product_sku_id) ';
        $sql .= '  JOIN bf_master_product_sku_regional as psr ON (psr.product_sku_id = psc.product_sku_id) ';

        if($action_data=='order_approval'){
            $sql .= ' JOIN bf_ishop_company_current_stock as biccs ON (biccs.product_sku_id = psr.product_sku_id) ';
        }

        $sql .= ' WHERE 1 ';

        $sql .= ' AND bipo.order_id =' . $order_id . ' ';

    //   echo $sql;
//die;

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $info = $this->db->query($sql);
            $order_detail = $info->result_array();
            return $order_detail;
        } else {
            $order_detail = $this->grid->get_result_res($sql);

            if (isset($order_detail['result']) && !empty($order_detail['result'])) {
                $product_view=array();
                if ($logincustomertype == 7) {

                    if ($radiochecked == "distributor") {
                        $product_view['head'] = array('Sr. No.', 'Action', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr', 'Amount', 'Approved Quantity');
                        $product_view['count'] = count($product_view['head']);
                    }
                    elseif ($action_data == "order_approval") {
                        $product_view['head'] = array('Sr. No.', '', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr', 'Amount', 'Current Stock', 'Dispatched Quantity');
                        $product_view['count'] = count($product_view['head']);
                    }
                    else {
                        $product_view['head'] = array('Sr. No.', 'Action', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr', 'Amount');
                        $product_view['count'] = count($product_view['head']);
                    }

                    $order_id_data = '<input type="hidden" name="order_id" value="' . $order_id . '">';

                    $i = 1;
                    $k = 0;
                    foreach ($order_detail['result'] as $od) {

                        if($csv == 'csv')
                        {
                            //testdata('in');
                            if ($radiochecked == "distributor") {

                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'],  $od['quantity_kg_ltr'],  $od['amount'], $od['dispatched_quantity'] );

                            }
                            elseif ($action_data == "order_approval") {

                                $intrum_qty = isset($od['intrum_quantity']) ? $od['intrum_quantity']:"";

                                $product_view['row'][] = array($i, '', $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'], $od['quantity_kg_ltr'],  $od['amount'], $intrum_qty, $od['dispatched_quantity'] );

                            }
                            else {

                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'],  $od['quantity_kg_ltr'],  $od['amount']);

                            }
                        }
                        else {
                            $qty_kg_ltr = '<input id="qty_kg_ltr_' . $od["product_order_id"] . '" type="hidden" name="quantity_kg_ltr['.$k.']" value="' . $od['quantity_kg_ltr'] . '">';


                            $product_order_id = $order_id_data . '<input type="hidden" name="order_product_id['.$k.']" value="' . $od["product_order_id"] . '">';


                            $product_sku_data = '<input id="sku_' . $od["product_order_id"] . '" name="product_sku_id" type="hidden" value="' . $od['product_sku_id'] . '" />';
                            $unit_data = $product_order_id . $product_sku_data . '<div class="unit_' . $od["product_order_id"] . '"><span class="unit">' . $od['unit'] . '</span></div>';
                            $qty_data = '<div class="qty_' . $od["product_order_id"] . '"><span class="qty">' . $od['quantity'] . '</span></div>';
                            $quantity_kg_ltr = $qty_kg_ltr . '<div class="quantity_kg_ltr_' . $od["product_order_id"] . '"><span class="quantity_kg_ltr">' . $od['quantity_kg_ltr'] . '</span></div>';
                            $amount = '<div class="amount_' . $od["product_order_id"] . '"><input type="hidden" class="amount_data" name="amount['.$k.']" value="' . $od['amount'] . '" /><span class="amount">' . $od['amount'] . '</span></div>';


                        if ($action_data == "order_approval")
                            {
                                $dub_dispatched_data = '<input type="text" name="dispatched_quantity['.$k.']" class="dispatched_quantity" value="' . $od['dispatched_quantity'] . '" />';
                            } else {
                                $dub_dispatched_data = '<span class="dispatched_quantity">' . $od['dispatched_quantity'] . '</span>';
                        }

                            $dispatched_quantity = '<div class="dispatched_quantity_' . $od["product_order_id"] . '">' . $dub_dispatched_data . '</div>';



                            if ($radiochecked == "distributor") {

                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'], $unit_data, $qty_data, $quantity_kg_ltr, $amount, $dispatched_quantity);

                            } elseif ($action_data == "order_approval") {
                                //      echo "ddsdsd";die;
                                $intrum_qty = isset($od['intrum_quantity']) ? $od['intrum_quantity']:"";

                                $product_view['row'][] = array($i, '', $od['product_sku_code'], $od['product_sku_name'], $unit_data, $qty_data, $quantity_kg_ltr, $amount, $intrum_qty, $dispatched_quantity);


                            } else {

                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'], $unit_data, $qty_data, $quantity_kg_ltr, $amount);

                            }
                        }
                        $i++;
                        $k++;
                    }
                    $product_view['eye'] = '';


                }
                elseif ($logincustomertype == 8) {


                    if ($radiochecked == "farmer") {
                        $product_view['head'] = array('Sr. No.', "", 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr');
                        $product_view['count'] = count($product_view['head']);
                    } elseif ($radiochecked == "retailer") {
                        $product_view['head'] = array('Sr. No.', 'Action', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr', 'Amount', 'Approved Quantity');
                        $product_view['count'] = count($product_view['head']);
                    } elseif ($radiochecked == "distributor") {
                        $product_view['head'] = array('Sr. No.', 'Action', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr', 'Amount', 'Approved Quantity');
                        $product_view['count'] = count($product_view['head']);
                    }


                    $order_id_data = '<input type="hidden" name="order_id" value="' . $order_id . '">';

                    $i = 1;
                    $k = 0;
                    foreach ($order_detail['result'] as $od) {

                        if ($radiochecked == "farmer") {

                            $product_view['row'][] = array($i, "", $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'], $od['quantity_kg_ltr']);

                        } elseif ($radiochecked == "retailer") {

                            if($csv == 'csv')
                            {

                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'],  $od['unit'], $od['quantity'] , $od['quantity_kg_ltr'] , $od['amount'], $od['dispatched_quantity'] );
                            }
                            else
                            {
                                $qty_kg_ltr = '<input id="qty_kg_ltr_' . $od["product_order_id"] . '" type="hidden" name="quantity_kg_ltr['.$k.']" value="' . $od['quantity_kg_ltr'] . '">';


                                $product_order_id = $order_id_data.'<input type="hidden" name="order_product_id['.$k.']" value="' . $od["product_order_id"] . '">';


                                $product_sku_data = '<input id="sku_' . $od["product_order_id"] . '" name="product_sku_id" type="hidden" value="' . $od['product_sku_id'] . '" />';
                                $unit_data = $product_order_id . $product_sku_data . '<div class="unit_' . $od["product_order_id"] . '"><span class="unit">' . $od['unit'] . '</span></div>';
                                $qty_data = '<div class="qty_' . $od["product_order_id"] . '"><span class="qty">' . $od['quantity'] . '</span></div>';
                                $quantity_kg_ltr = $qty_kg_ltr . '<div class="quantity_kg_ltr_' . $od["product_order_id"] . '"><span class="quantity_kg_ltr">' . $od['quantity_kg_ltr'] . '</span></div>';
                                $amount = '<div class="amount_' . $od["product_order_id"] . '"><span class="amount">' . $od['amount'] . '</span></div>';

                                $dispatched_quantity = '<div class="dispatched_quantity_' . $od["product_order_id"] . '"><span class="dispatched_quantity">' . $od['dispatched_quantity'] . '</span></div>';


                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'], $unit_data, $qty_data, $quantity_kg_ltr, $amount, $dispatched_quantity);
                            }


                        } elseif ($radiochecked == "distributor") {
                            if($csv == 'csv')
                            {
                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'] , $od['quantity_kg_ltr'], $od['amount'], $od['dispatched_quantity']);
                            }
                            else
                            {
                                $qty_kg_ltr = '<input id="qty_kg_ltr_' . $od["product_order_id"] . '" type="hidden" name="quantity_kg_ltr['.$k.']" value="' . $od['quantity_kg_ltr'] . '">';

                                $product_order_id = $order_id_data.'<input type="hidden" name="order_product_id['.$k.']" value="' . $od["product_order_id"] . '">';


                                $product_sku_data = '<input id="sku_' . $od["product_order_id"] . '" name="product_sku_id" type="hidden" value="' . $od['product_sku_id'] . '" />';
                                $unit_data = $product_order_id . $product_sku_data . '<div class="unit_' . $od["product_order_id"] . '"><span class="unit">' . $od['unit'] . '</span></div>';
                                $qty_data = '<div class="qty_' . $od["product_order_id"] . '"><span class="qty">' . $od['quantity'] . '</span></div>';
                                $quantity_kg_ltr = $qty_kg_ltr . '<div class="quantity_kg_ltr_' . $od["product_order_id"] . '"><span class="quantity_kg_ltr">' . $od['quantity_kg_ltr'] . '</span></div>';
                                $amount = '<div class="amount_' . $od["product_order_id"] . '"><span class="amount">' . $od['amount'] . '</span></div>';

                                $dispatched_quantity = '<div class="dispatched_quantity_' . $od["product_order_id"] . '"><span class="dispatched_quantity">' . $od['dispatched_quantity'] . '</span></div>';


                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'], $unit_data, $qty_data, $quantity_kg_ltr, $amount, $dispatched_quantity);
                            }

                        }
                        $i++;
                        $k++;
                    }
                    $product_view['eye'] = '';

                }
                elseif ($logincustomertype == 9) {

                    if ($action_data == "po_acknowledgement") {

                        $order_id_data = '<input type="hidden" name="order_id" value="' . $order_id . '" />';

                        $product_view['head'] = array('Sr. No.', 'Action', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr');
                        $product_view['count'] = count($product_view['head']);
                        $i = 1;
                        $k = 0;
                        foreach ($order_detail['result'] as $od) {

                            if($csv == 'csv')
                            {
                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'] , $od['quantity_kg_ltr']);
                            }
                            else
                            {
                                $qty_kg_ltr = '<input id="qty_kg_ltr_' . $od["product_order_id"] . '" type="hidden" name="quantity_kg_ltr['.$k.']" value="' . $od['quantity_kg_ltr'] . '">';

                                $product_order_id = $order_id_data.'<input type="hidden" name="order_product_id['.$k.']" value="' . $od["product_order_id"] . '">';


                                $product_sku_data = '<input id="sku_' . $od["product_order_id"] . '" name="product_sku_id" type="hidden" value="' . $od['product_sku_id'] . '" />';
                                $unit_data = $product_order_id . $product_sku_data . '<div class="unit_' . $od["product_order_id"] . '"><span class="unit">' . $od['unit'] . '</span></div>';
                                $qty_data = '<div class="qty_' . $od["product_order_id"] . '"><span class="qty">' . $od['quantity'] . '</span></div>';
                                $quantity_kg_ltr = $qty_kg_ltr . '<div class="quantity_kg_ltr_' . $od["product_order_id"] . '"><span class="quantity_kg_ltr">' . $od['quantity_kg_ltr'] . '</span></div>';


                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'], $unit_data, $qty_data, $quantity_kg_ltr);
                            }

                            $i++;
                            $k++;
                        }
                        $product_view['eye'] = '';


                    } else {


                        $product_view['head'] = array('Sr. No.', '', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr', 'Amount', 'Approved Quantity');
                        $product_view['count'] = count($product_view['head']);
                        $i = 1;
                        foreach ($order_detail['result'] as $od) {

                            $product_view['row'][] = array($i, '', $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'], $od['quantity_kg_ltr'], $od['amount'], $od['dispatched_quantity']);

                            $i++;
                        }
                        $product_view['eye'] = '';

                    }


                }
                elseif ($logincustomertype == 10) {


                    if ($action_data == "po_acknowledgement") {

                        $order_id_data = '<input type="hidden" name="order_id" value="' . $order_id . '" />';

                        $product_view['head'] = array('Sr. No.', 'Action', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr');
                        $product_view['count'] = count($product_view['head']);
                        $i = 1;
                        $k = 0;
                        foreach ($order_detail['result'] as $od) {

                            if($csv == 'csv')
                            {
                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'] , $od['quantity_kg_ltr']);
                            }
                            else{
                                $qty_kg_ltr = '<input id="qty_kg_ltr_' . $od["product_order_id"] . '" type="hidden" name="quantity_kg_ltr['.$k.']" value="' . $od['quantity_kg_ltr'] . '">';

                                $product_order_id = $order_id_data.'<input type="hidden" name="order_product_id['.$k.']" value="' . $od["product_order_id"] . '">';


                                $product_sku_data = '<input id="sku_' . $od["product_order_id"] . '" name="product_sku_id" type="hidden" value="' . $od['product_sku_id'] . '" />';
                                $unit_data = $product_order_id . $product_sku_data . '<div class="unit_' . $od["product_order_id"] . '"><span class="unit">' . $od['unit'] . '</span></div>';
                                $qty_data = '<div class="qty_' . $od["product_order_id"] . '"><span class="qty">' . $od['quantity'] . '</span></div>';
                                $quantity_kg_ltr = $qty_kg_ltr . '<div class="quantity_kg_ltr_' . $od["product_order_id"] . '"><span class="quantity_kg_ltr">' . $od['quantity_kg_ltr'] . '</span></div>';


                                $product_view['row'][] = array($i, $od['product_order_id'], $od['product_sku_code'], $od['product_sku_name'], $unit_data, $qty_data, $quantity_kg_ltr);
                            }

                            $i++;
                            $k++;
                        }
                        $product_view['eye'] = '';


                    } else {

                        $product_view['head'] = array('Sr. No.', '', 'Product Code', 'Product Name', 'Unit', 'Quantity', 'Qty. Kg/Ltr', 'Amount');
                        $product_view['count'] = count($product_view['head']);
                        $i = 1;
                        foreach ($order_detail['result'] as $od) {

                            $product_view['row'][] = array($i, '', $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'], $od['quantity_kg_ltr'], $od['amount']);

                            $i++;
                        }
                        $product_view['eye'] = '';
                    }

                }
                /*testdata($product_view);*/
                return $product_view;
            }
            else{
                return false;
            }
        }

    }


    public function update_po_data($orderid, $po_numdata,$web_service=null)
    {

        $update_data = array(
            'PO_no' => $po_numdata,
            'modified_on' => date("Y-m-d h:i:s")
        );

        $this->db->where('order_id', $orderid);
        $this->db->update('bf_ishop_orders', $update_data);
        if($web_service=='web_service')
        {
            if($this->db->affected_rows() > 0){
                return 1;
            }
            else{
                return 0;
            }

        }
        else{
            echo $this->db->affected_rows();
            die;
        }


    }

    public function check_po_data($po_numdata)
    {

        $this->db->select('*');
        $this->db->from('bf_ishop_orders');
        $this->db->where('PO_no', $po_numdata);

        $po_check_data = $this->db->get()->result_array();

        if (isset($po_check_data) && !empty($po_check_data)) {
            return 0;
        } else {
            return 1;
        }

    }


    /**
     * @ Function Name        : update_order_detail_data
     * @ Function Params    : detail_data
     * @ Function Purpose    : For updating order detailed data
     * @ Function Return    : array
     * */

    public function update_order_detail_data($detail_data, $web_service = null)
    {


       // testdata($_POST);
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $detail_data["order_product_id"] = explode(',', $detail_data["order_product_id"]);
            $detail_data["dispatched_quantity"] = explode(',', $detail_data["dispatched_quantity"]);
            $detail_data["units"] = explode(',', @$detail_data["units"]);
            $detail_data["quantity"] = explode(',', @$detail_data["quantity"]);
            $detail_data["quantity_kg_ltr"] = explode(',', @$detail_data["quantity_kg_ltr"]);
            $detail_data["amount"] = explode(',', @$detail_data["amount"]);
        }

        $final_array = array();

        if (!empty($detail_data["order_product_id"])) {

            $total_amount = 0;

            foreach ($detail_data["order_product_id"] as $key => $order_product_id) {

                $update_array = array();

                if (isset($detail_data["units"]) && !empty($detail_data["units"])) {
                    if (isset($detail_data["units"][$key]) && $detail_data["units"][$key] != "") {
                        $unit_data = $detail_data["units"][$key];

                        $update_array["unit"] = $unit_data;

                    }
                }

                if (isset($detail_data["quantity"]) && !empty($detail_data["quantity"])) {
                    if (isset($detail_data["quantity"][$key]) && $detail_data["quantity"][$key] != "") {
                        $quantity_data = $detail_data["quantity"][$key];

                        $update_array["quantity"] = $quantity_data;

                    }
                }

                if (isset($detail_data["quantity_kg_ltr"]) && !empty($detail_data["quantity_kg_ltr"])) {
                    if (isset($detail_data["quantity_kg_ltr"][$key]) && $detail_data["quantity_kg_ltr"][$key] != "") {
                        $quantity_kg_ltr_data = $detail_data["quantity_kg_ltr"][$key];

                        $update_array["quantity_kg_ltr"] = $quantity_kg_ltr_data;

                    }
                }

                if (isset($detail_data["amount"]) && !empty($detail_data["amount"])) {
                    if (isset($detail_data["amount"][$key]) && $detail_data["amount"][$key] != "") {
                        $amount_data = $detail_data["amount"][$key];

                        $update_array["amount"] = $amount_data;

                        $total_amount = $total_amount + $amount_data;

                    }
                }

                if (isset($detail_data["dispatched_quantity"]) && !empty($detail_data["dispatched_quantity"])) {
                    if (isset($detail_data["dispatched_quantity"][$key]) && $detail_data["dispatched_quantity"][$key] != "") {
                        $dispatched_quantity_data = $detail_data["dispatched_quantity"][$key];

                        $update_array["dispatched_quantity"] = $dispatched_quantity_data;

                    }
                }

                $this->db->where('product_order_id', $order_product_id);
                $this->db->update('bf_ishop_product_order', $update_array);

                if($this->db->affected_rows() > 0){
                    $final_array[] = 1;
                }

                $amount_data = array(
                    'total_amount' => $total_amount
                );

                $id = $this->db->update('bf_ishop_orders', $amount_data, array('order_id' => $detail_data["order_id"]));

            }

        }

        //testdata($final_array);

        if(in_array(1,$final_array)){
            $res = 1;
        }
        else{
            $res = 0;
        }

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            return $res;
        }
        else{
            echo $res;
            die;
        }

    }

    /**
     * @ Function Name        : delete_order_detail_data
     * @ Function Params    : order product id
     * @ Function Purpose    : For deleting order detailed data
     * @ Function Return    : array
     * */


    public function delete_order_detail_data($order_product_id)
    {

        $this->db->select('*');
        $this->db->from('bf_ishop_product_order');
        $this->db->where('product_order_id', $order_product_id);

        $order_detail_data = $this->db->get()->result_array();

        $amount_data = $order_detail_data[0]["amount"];

        $order_id = $order_detail_data[0]["order_id"];

        $this->db->select('*');
        $this->db->from('bf_ishop_orders');
        $this->db->where('order_id', $order_id);

        $order_data = $this->db->get()->result_array();
        $order_amount_data = $order_data[0]["total_amount"];

        $final_amount = $order_amount_data - $amount_data;

        $update_data = array(
            'total_amount' => $final_amount
        );

        $this->db->where('order_id', $order_id);
        $this->db->update('bf_ishop_orders', $update_data);

        $this->db->delete('bf_ishop_product_order', array('product_order_id' => $order_product_id));
        if($this->db->affected_rows() > 0){
            return 1;
        }
    }

    /**
     * @ Function Name        : delete_order_data
     * @ Function Params    : order id
     * @ Function Purpose    : For deleting order data
     * @ Function Return    : array
     * */

    public function delete_order_data($order_id)
    {

        $this->db->delete('bf_ishop_product_order', array('order_id' => $order_id));
        $this->db->delete('bf_ishop_orders', array('order_id' => $order_id));
        if($this->db->affected_rows() > 0){
            return 1;
        }

    }

    /**
     * @ Function Name        : update_order_data
     * @ Function Params    : order data
     * @ Function Purpose    : For updating order data
     * @ Function Return    :
     * */


    public function update_order_data($orderdata, $web_service = null)
    {
        if (!empty($orderdata)) {

            if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
                $orderdata["order_data"] = explode(',', $orderdata["order_data"]);
                if(isset($orderdata["change_order_status"])){
                    $orderdata["change_order_status"] = explode(',', $orderdata["change_order_status"]);
                }


                if(isset($orderdata["confirm_ack"])){
                    $orderdata["confirm_ack"]= explode(',',$orderdata["confirm_ack"]);
                }
                if(isset($orderdata["po_no"])){
                    $orderdata["po_no"]= explode(',',$orderdata["po_no"]);
                }
            }


            $return = array();

            foreach ($orderdata["order_data"] as $key => $value) {


                $update_array = array();

                if (isset($orderdata["confirm_ack"][$key]) && $orderdata["confirm_ack"][$key] == 1) {
                    $status = 0;
                    $update_array["order_status"] = $status;
                }

                if (isset($orderdata["po_no"][$key]) && $orderdata["po_no"][$key] != "") {
                    $update_array["PO_no"] = $orderdata["po_no"][$key];
                }

                if (isset($orderdata["change_order_status"][$key]) && $orderdata["change_order_status"][$key] != 0) {

                    if ($orderdata["selected_action"] == "dispatch") {
                        $orer_status = 1;
                    } elseif ($orderdata["selected_action"] == "pending") {
                        $orer_status = 0;
                    } elseif ($orderdata["selected_action"] == "reject") {
                        $orer_status = 3;
                    }

                    $update_array["order_status"] = $orer_status;
                }

                //   echo "<pre>";
                //  print_r($update_array);

                if (!empty($update_array)) {
                    $this->db->where('order_id', $value);
                    $id = $this->db->update('bf_ishop_orders', $update_array);


                    if($this->db->affected_rows() > 0){
                        $return[]=1;
                    }

                }
            }
        }

        if(in_array(1,$return)){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function get_user_data($id)
    {

        $this->db->select('*');
        $this->db->from('bf_users');
        $this->db->where('id', $id);

        $distributor_data = $this->db->get()->result_array();

        if (isset($distributor_data) && !empty($distributor_data)) {
            return $distributor_data;
        } else {
            return false;
        }

    }

    public function check_target_data($product_sku_id, $month_data, $customer_id)
    {

        $this->db->select('*');
        $this->db->from('bf_ishop_target');

        $this->db->where('month_data', $month_data);
        $this->db->where('customer_id', $customer_id);
        $this->db->where('product_sku_id', $product_sku_id);

        $target_data = $this->db->get()->result_array();

        //  echo "<pre>";print_r($target_data);die;

        if (isset($target_data) && !empty($target_data)) {
            return $target_data[0]["ishop_target_id"];
        } else {
            return 0;
        }

    }

    public function add_target_data($target_data, $user_id, $web_service = null, $country_id = null, $role_id = null)
    {
       // testdata($target_data);
        
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            
            if(isset($target_data) && !empty($target_data)) 
            {
                
                // foreach ($target_data as $key => $value) {

                    // dumpme($value)

                    $target_array = array();

                    $target_array["month_data"] = $target_data["month"]."-01";
                    $target_array["customer_id"] = $target_data["customer_id"];
                    $target_array["product_sku_id"] = $target_data["prod_sku"];
                    $target_array["quantity"] = $target_data["quantity"];

                    $target_array["created_on"] = date("Y-m-d h:i:s");
                    $target_array["created_by_user"] = $user_id;

                     
                    $check_already_data = $this->check_target_data($target_data["prod_sku"], $target_data["month"]."-01", $target_data["customer_id"]);
                     
                    if ($check_already_data == 0) {
                       $id = $this->db->insert('bf_ishop_target', $target_array);
                    } else {
                        $target_update_data = array(
                            'month_data' => $target_data["month"]."-01",
                            'customer_id' => $target_data["customer_id"],
                            'product_sku_id' => $target_data["prod_sku"],
                            'quantity' => $target_data["quantity"],
                            'modified_by_user' => $user_id,
                            'country_id' => $country_id,
                            'status' => '1',
                            'modified_on' => date('Y-m-d H:i:s')
                        );

                        $this->db->where('ishop_target_id', $check_already_data);
                        $id = $this->db->update('bf_ishop_target', $target_update_data);

                    }
                    
              //  }
                
                
            }
            
        }
        else{
            
            if ($role_id == 8) {
                    $target_data['radio1'] = 'distributor';
                }
                if ($target_data['radio1'] == 'distributor') {
                    $month_data = $target_data["month_data"] . "-01";
                    $customers_id = isset($target_data['distributor_distributor_id']) ? $target_data['distributor_distributor_id'] : '';
                } elseif ($target_data['radio1'] == 'retailer') {
                    $month_data = $target_data["ret_month_data"] . "-01";
                    $customers_id = $target_data['retailer_id'];
                }
                
                $prod_sku = $target_data['prod_sku'];
                $quantity = $target_data['quantity'];
                
                 $target = array(
                    'month_data' => $month_data,
                    'customer_id' => (isset($customers_id) && !empty($customers_id)) ? $customers_id : '',
                    'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                    'quantity' => (isset($quantity) && !empty($quantity)) ? $quantity : '',
                    'created_by_user' => $user_id,
                    'country_id' => $country_id,
                    'status' => '1',
                    'created_on' => date('Y-m-d H:i:s')
                );

                $check_already_data = $this->check_target_data($prod_sku, $month_data, $customers_id);
                if ($check_already_data == 0) {
                    $this->db->insert('ishop_target', $target);
                } else {
                    $target_update_data = array(
                        'month_data' => $month_data,
                        'customer_id' => $customers_id,
                        'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                        'quantity' => (isset($quantity) && !empty($quantity)) ? $quantity : '',
                        'modified_by_user' => $user_id,
                        'country_id' => $country_id,
                        'status' => '1',
                        'modified_on' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('ishop_target_id', $check_already_data);
                    $id = $this->db->update('bf_ishop_target', $target_update_data);

                }
            }
            
        
        
        
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }

    }

    public function get_target_details($user_id, $country_id, $checked_type = null, $page = null, $web_service = null)
    {
        //$sql =' SELECT * ';

       // $sql = ' SELECT mpgd.political_geography_name,it.ishop_target_id,bu.user_code,bu.display_name,mpsc.product_sku_name,it.quantity ';
        $sql =' SELECT SQL_CALC_FOUND_ROWS it.ishop_target_id as id,mpgd.political_geography_name,it.ishop_target_id,bu.user_code,bu.display_name,mpsc.product_sku_name,it.quantity ';
        $sql .= ' FROM bf_ishop_target AS it ';
        $sql .= ' JOIN bf_users AS bu  ON (bu.id = it.customer_id) ';
        $sql .= ' JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_id = it.product_sku_id) ';
        $sql .= ' JOIN bf_master_user_contact_details AS mucd ON (mucd.user_id = bu.id) ';
        $sql .= ' JOIN bf_master_political_geography_details AS mpgd ON (mpgd.political_geo_id = mucd.geo_level_id1) ';
        $sql .= 'WHERE 1 ';
        if ($checked_type == "retailer") {
            $sql .= ' AND bu.role_id =10 ';
        }
        if ($checked_type == "distributor") {
            $sql .= ' AND bu.role_id =9 ';
        }
        $sql .= 'AND it.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY it.ishop_target_id DESC ';


        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {

            // For Pagination
            $limit = 10;
            $pagenum = $this->input->get_post('page');
            $page = !empty($pagenum) ? $pagenum : 1;
            $offset = $page*$limit-$limit;
            $sql .= ' LIMIT '.$offset.",".$limit;
            $info = $this->db->query($sql);
            // For Pagination

            $target_details = $info->result_array();
            return $target_details;
        } else {
            $target_details = $this->grid->get_result_res($sql);
            //testdata($target_details);

            if (isset($target_details['result']) && !empty($target_details['result'])) {
                if ($checked_type == 'retailer') {
                    $target['head'] = array('Sr. No.', 'Action', 'Geo', 'Retailer Code', 'Retailer Name', 'Product SKU Name', 'Quantity');
                    $target['count'] = count($target['head']);
                } else {
                    $target['head'] = array('Sr. No.', 'Action', 'Geo', 'Distributor Code', 'Distributor Name', 'Product SKU Name', 'Quantity');
                    $target['count'] = count($target['head']);
                }

                if ($page != null || $page != "") {

                    $i = (($page * 10) - 9);

                } else {
                    $i = 1;
                }
                foreach ($target_details['result'] as $rd) {
                    $quantity = '<div class="quantity_' . $rd["ishop_target_id"] . '"><span class="quantity">' . $rd['quantity'] . '</span></div>';

                    $target['row'][] = array($i, $rd['ishop_target_id'], $rd['political_geography_name'], $rd['user_code'], $rd['display_name'], $rd['product_sku_name'], $quantity,);
                    $i++;
                }
                $target['pagination'] = $target_details['pagination'];
                $target['action'] = 'is_action';
                $target['edit'] = 'is_edit';
                $target['delete'] = 'is_delete';
                //   testdata($target);
                return $target;
            }
            else{
                return false;
            }

        }
    }


    public function update_target_detail($user_id, $country_id, $web_service = null)
    {
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $target_id = explode(',', $this->input->post("target_id"));
            $quantity = explode(',', $this->input->post("quantity"));
        } else {
            $target_id = $this->input->post("target_id");
            $quantity = $this->input->post("quantity");
        }

        if (isset($target_id) && !empty($target_id)) {
            foreach ($target_id as $k => $ti) {
                $target_updates = array(
                    'quantity' => $quantity[$k],
                    'modified_by_user' => $user_id,
                    'country_id' => $country_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );

                $this->db->where('ishop_target_id', $target_id[$k]);
                $this->db->update('ishop_target', $target_updates);
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function delete_target_detail($target_id)
    {
        $this->db->where('ishop_target_id', $target_id);
        $this->db->delete('ishop_target');
        if($this->db->affected_rows() > 0){
            return 1;
        }
    }

    public function get_target_monthly_data($data, $web_service=null,$page = null)
    {
        if(isset($web_service) && !empty($web_service) && $web_service=='web_service'){
            $from_date = $data['from_month_data'] . "-01";
            $to_date = $data['to_month_data'] . "-01";
            $login_user_id = $data['user_id'];
        }
        else{
            $from_date = $data['from_month_data'] . "-01";
            $to_date = $data['to_month_data'] . "-01";
            $login_user_id = $data['login_customer_id'];
        }

        $sql = ' SELECT * ';
        $sql .= ' FROM bf_ishop_target as bit ';
        $sql .= ' JOIN bf_master_product_sku_country as bmpsc ON (bmpsc.product_sku_country_id = bit.product_sku_id) ';
        $sql .= ' JOIN bf_master_product_sku_regional as bmpsr ON (bmpsr.product_sku_id = bmpsc.product_sku_id) ';

        $sql .= 'WHERE 1 ';
        $sql .= ' AND month_data BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $to_date . '"' . ' ';
        $sql .= ' AND customer_id =' . $login_user_id . ' ';
        $target_data = $this->grid->get_result_res($sql);

        $from_date = $data['from_month_data'] . "-01";
        $to_date = $data['to_month_data'] . "-01";


        $date1 = $from_date;
        $date2 = $to_date;
        $month_output = array();
        $time = strtotime($from_date);
        $last = date('Y-m', strtotime($to_date));

        do {
            $month = date('Y-m', $time);
            $total = date('t', $time);

            $month_output[$month . "-01"] = "";

            $time = strtotime('+1 month', $time);
        } while ($month != $last);


        $final_array = array();

        //  dumpme($target_data);

        if (isset($target_data['result']) && !empty($target_data['result'])) {
            $final_array = array();
            foreach ($target_data['result'] as $key => $data) {
                foreach ($month_output as $k => $val) {
                    if (!isset($final_array[$data['product_sku_id'] . "-" . $data['product_sku_code'] . "-" . $data['product_sku_name']][$k])) {
                        $final_array[$data['product_sku_id'] . "-" . $data['product_sku_code'] . "-" . $data['product_sku_name']][$k] = "";
                    }

                    if ($data['month_data'] == $k) {
                        $final_array[$data['product_sku_id'] . "-" . $data['product_sku_code'] . "-" . $data['product_sku_name']][$k] = $data['quantity'];
                    }
                }
            }
            // $final_array['pagination'] = $target_data['pagination'];
            //  $final_array['page'] = $page;

        }
        //testdata($final_array);
        if (isset($final_array) && !empty($final_array)) {

            return $final_array;
        } else {
            return 0;
        }

    }

    public function get_monthly_data($data,$web_service=null)
    {

     if(isset($web_service) && !empty($web_service) && $web_service=='web_service'){
            $from_date = $data['from_month_data'] . "-01";
            $to_date = $data['to_month_data'] . "-01";
        }
        else{
            $from_date = $data['from_month_data'] . "-01";
            $to_date = $data['to_month_data'] . "-01";
        }

        $date1 = $from_date;
        $date2 = $to_date;
        $month_output = array();
        $time = strtotime($from_date);
        $last = date('Y-m', strtotime($to_date));

        do {
            $month = date('Y-m', $time);
            $total = date('t', $time);

            /* $output[] = array(
                    'month' => $month,
                    'total' => $total,
                );*/

            $month_output[] = $month . "-01";

            $time = strtotime('+1 month', $time);
        } while ($month != $last);

        return $month_output;
    }

    public function get_budget_details($user_id, $country_id, $checked_type = null, $page = null, $web_service = null)
    {
        // $sql =' SELECT * ';
        $sql = ' SELECT mpgd.political_geography_name,ib.ishop_budget_id,bu.user_code,bu.display_name,mpsc.product_sku_name,ib.quantity ';
        $sql .= ' FROM bf_ishop_budget AS ib ';
        $sql .= ' JOIN bf_users AS bu  ON (bu.id = ib.customer_id) ';
        $sql .= ' JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_id = ib.product_sku_id) ';
        $sql .= ' JOIN bf_master_user_contact_details AS mucd ON (mucd.user_id = bu.id) ';
        $sql .= ' JOIN bf_master_political_geography_details AS mpgd ON (mpgd.political_geo_id = mucd.geo_level_id1) ';
        $sql .= 'WHERE 1 ';
        if ($checked_type == "retailer") {
            $sql .= ' AND bu.role_id =10 ';
        }
        if ($checked_type == "distributor") {
            $sql .= ' AND bu.role_id =9 ';
        }
        $sql .= 'AND ib.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY ib.ishop_budget_id     DESC ';


        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $info = $this->db->query($sql);
            $budget_details = $info->result_array();
            return $budget_details;
        } else {
            $budget_details = $this->grid->get_result_res($sql);
            // testdata($budget_details);
            if (isset($budget_details['result']) && !empty($budget_details['result'])) {
                if ($checked_type == 'retailer') {
                    $budget['head'] = array('Sr. No.', 'Action', 'Geo', 'Retailer Code', 'Retailer Name', 'Product SKU Name', 'Quantity');
                    $budget['count'] = count($budget['head']);
                } else {
                    $budget['head'] = array('Sr. No.', 'Action', 'Geo', 'Distributor Code', 'Distributor Name', 'Product SKU Name', 'Quantity');
                    $budget['count'] = count($budget['head']);
                }

                if ($page != null || $page != "") {

                    $i = (($page * 10) - 9);
                } else {
                    $i = 1;
                }
                foreach ($budget_details['result'] as $rd) {
                    $quantity = '<div class="quantity_' . $rd["ishop_budget_id"] . '"><span class="quantity">' . $rd['quantity'] . '</span></div>';

                    $budget['row'][] = array($i, $rd['ishop_budget_id'], $rd['political_geography_name'], $rd['user_code'], $rd['display_name'], $rd['product_sku_name'], $quantity,);
                    $i++;
                }
                $budget['pagination'] = $budget_details['pagination'];
                $budget['action'] = 'is_action';
                $budget['edit'] = 'is_edit';
                $budget['delete'] = 'is_delete';
                // testdata($budget);
                return $budget;
            }
            else{
                return false;
            }
        }
    }

    public function add_budget_data($budget_data, $user_id, $web_service = null, $country_id = null)
    {
        // testdata($budget_data);
        if (isset($budget_data) && !empty($budget_data)) {
            //testdata($target_data);
            if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
                $month_data = $budget_data["month"] . "-01";
                $customers_id = $budget_data['customer_id'];
            } else {
                if ($budget_data['radio1'] == 'distributor') {
                    $month_data = $budget_data["month_data"] . "-01";
                    $customers_id = isset($budget_data['distributor_distributor_id']) ? $budget_data['distributor_distributor_id'] : '';
                } elseif ($budget_data['radio1'] == 'retailer') {
                    $month_data = $budget_data["ret_month_data"] . "-01";
                    $customers_id = $budget_data['retailer_id'];
                }
            }
            $prod_sku = $budget_data['prod_sku'];
            $quantity = $budget_data['quantity'];

            $budget = array(
                'month_data' => $month_data,
                'customer_id' => (isset($customers_id) && !empty($customers_id)) ? $customers_id : '',
                'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                'quantity' => (isset($quantity) && !empty($quantity)) ? $quantity : '',
                'created_by_user' => $user_id,
                'country_id' => $country_id,
                'status' => '1',
                'created_on' => date('Y-m-d H:i:s')
            );

            $check_already_data = $this->check_budget_data($prod_sku, $month_data, $customers_id);
            // testdata($check_already_data);
            if ($check_already_data == 0) {
                $id = $this->db->insert('ishop_budget', $budget);
            } else {
                $budget_update_data = array(
                    'month_data' => $month_data,
                    'customer_id' => $customers_id,
                    'product_sku_id' => (isset($prod_sku) && !empty($prod_sku)) ? $prod_sku : '',
                    'quantity' => (isset($quantity) && !empty($quantity)) ? $quantity : '',
                    'modified_by_user' => $user_id,
                    'country_id' => $country_id,
                    'status' => '1',
                    'modified_on' => date('Y-m-d H:i:s')
                );

                $this->db->where('ishop_budget_id', $check_already_data);
                $id = $this->db->update('ishop_budget', $budget_update_data);
            }
            return $id;
        } else {

            //INSERT USING FILE UPLOAD

            foreach ($budget_data as $key => $value) {

                $budget_array = array();

                $budget_array["month_data"] = $value[0];
                $budget_array["customer_id"] = $value[1];
                $budget_array["product_sku_id"] = $value[2];
                $budget_array["quantity"] = $value[3];

                $budget_array["created_on"] = date("Y-m-d h:i:s");
                $budget_array["created_by_user"] = $user_id;

                $this->db->insert('bf_ishop_budget', $budget_array);
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function update_budget_detail($user_id, $country_id, $web_service = null)
    {
        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $budget_id = explode(',', $this->input->post("budget_id"));
            $quantity = explode(',', $this->input->post("quantity"));
        } else {
            $budget_id = $this->input->post("budget_id");
            $quantity = $this->input->post("quantity");
        }

        if (isset($budget_id) && !empty($budget_id)) {
            foreach ($budget_id as $k => $ti) {
                $budget_updates = array(
                    'quantity' => $quantity[$k],
                    'modified_by_user' => $user_id,
                    'country_id' => $country_id,
                    'modified_on' => date('Y-m-d H:i:s')
                );

                $this->db->where('ishop_budget_id', $budget_id[$k]);
                $id = $this->db->update('ishop_budget', $budget_updates);
            }
        }
        if($this->db->affected_rows() > 0){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function delete_budget_detail($budget_id)
    {
        $this->db->where('ishop_budget_id', $budget_id);
        $this->db->delete('ishop_budget');
        if($this->db->affected_rows() > 0){
            return 1;
        }
    }

    public function check_budget_data($product_sku_id, $month_data, $customer_id)
    {

        $this->db->select('*');
        $this->db->from('bf_ishop_budget');

        $this->db->where('month_data', $month_data);
        $this->db->where('customer_id', $customer_id);
        $this->db->where('product_sku_id', $product_sku_id);

        $budget_data = $this->db->get()->result_array();

        //  echo "<pre>";print_r($target_data);die;

        if (isset($budget_data) && !empty($budget_data)) {
            return $budget_data[0]["ishop_budget_id"];
        } else {
            return 0;
        }

    }

    //FOR CHECK USER EXIST IN DB OR NOT ON THE BASIS OF "USER CODE" FOR UPLOAD DOCS

    public function check_user_data($distributor_code, $distributor_name)
    {
        $this->db->select('*');
        $this->db->from('bf_users');
        $this->db->where('user_code', $distributor_code);
        $this->db->where('display_name', $distributor_name);

        $distributor_data = $this->db->get()->result_array();

        if (isset($distributor_data) && !empty($distributor_data)) {
            return $distributor_data[0]["id"];
        } else {
            return 0;
        }
    }

    //FOR CHECK PRODUCT EXIST IN DB OR NOT ON THE BASIS OF "PRODUCT CODE" FOR UPLOAD DOCS

    public function check_product_data($product_code, $product_name)
    {

        $this->db->select('bmpsc.product_sku_country_id');
        $this->db->from('bf_master_product_sku_regional as bmpsr');

        $this->db->join('bf_master_product_sku_country as bmpsc', 'bmpsc.product_sku_id = bmpsr.product_sku_id');

        $this->db->where('bmpsr.product_sku_code', $product_code);
        $this->db->where('bmpsc.product_sku_name', $product_name);

        $product_data = $this->db->get()->result_array();

        if (isset($product_data) && !empty($product_data)) {
            return $product_data[0]["product_sku_country_id"];
        } else {
            return 0;
        }

    }

    public function copy_data($copy_data, $userid, $web_service)
    {

        if (!empty($web_service) && isset($web_service) && $web_service != null && $web_service == "web_service") {
            $copy_data['checkbox_popup_month_data'] = explode(',', $copy_data['checkbox_popup_month_data']);
        }

        //GET FROM USER DATA FOR SELECTED USER AND MONTH

        $from_user_id = $copy_data['from_customer_data'];
        $from_date_data = $copy_data['from_year_data'] . "-" . $copy_data['radio_from_popup_month_data'] . "-01";

        if ($copy_data['popup_page'] == "target") {
            $table = 'bf_ishop_target';
            $ishop_data_id = 'ishop_target_id';
        }

        if ($copy_data['popup_page'] == "budget") {
            $table = 'bf_ishop_budget';
            $ishop_data_id = 'ishop_budget_id';
        }

        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('customer_id', $from_user_id);
        $this->db->where('month_data', $from_date_data);

        $from_data = $this->db->get()->result_array();

        //testdata($from_target_data);

        if (isset($from_data) && !empty($from_data)) {

            foreach ($copy_data['checkbox_popup_month_data'] as $key => $month_data) {

                $to_date_data = $copy_data['to_year_data'] . "-" . $month_data . "-01";
                $to_user_id = $copy_data['to_customer_data'];

                foreach ($from_data as $from_key => $fromdata) {

                    $target_id = $fromdata[$ishop_data_id];
                    $month_data = $fromdata["month_data"];
                    $customer_id = $fromdata["customer_id"];
                    $product_sku_id = $fromdata["product_sku_id"];
                    $quantity = $fromdata["quantity"];
                    $created_by_user = $fromdata["created_by_user"];


                    $this->db->select('*');
                    $this->db->from($table);

                    $this->db->where('month_data', $to_date_data);
                    $this->db->where('customer_id', $to_user_id);
                    $this->db->where('product_sku_id', $product_sku_id);

                    $check_data = $this->db->get()->result_array();

                    if (!empty($check_data)) {
                        //UPDATE

                        $update_data = array(
                            'month_data' => $to_date_data,
                            'customer_id' => $to_user_id,
                            'product_sku_id' => $product_sku_id,
                            'quantity' => $quantity,
                            'modified_by_user' => $userid,
                            'modified_on' => date("Y-m-d h:i:s")
                        );

                        $this->db->where($ishop_data_id, $check_data[0][$ishop_data_id]);
                        $this->db->update($table, $update_data);

                    } else {
                        //INSERT

                        $insert_data = array(
                            'month_data' => $to_date_data,
                            'customer_id' => $to_user_id,
                            'product_sku_id' => $product_sku_id,
                            'quantity' => $quantity,
                            'created_by_user' => $userid,
                            'created_on' => date("Y-m-d h:i:s")
                        );

                        $this->db->insert($table, $insert_data);
                    }


                }

            }
            return 1;

        } else {
            return 0;
        }

    }

    function check_distributor_retailer_mapping_data($user_distributor_data, $user_retailer_data)
    {

        $this->db->select('*');
        $this->db->from('bf_master_customer_to_customer_mapping');
        $this->db->where('from_customer_id', $user_distributor_data);
        $this->db->where('to_customer_id', $user_retailer_data);

        $this->db->where('status', 1);
        $this->db->where('deleted', 0);

        $mapping_data = $this->db->get()->result_array();

        if (isset($mapping_data) && !empty($mapping_data)) {
            return 1;
        } else {
            return 0;
        }

    }

    function check_secondary_invoice_data($invoice_no)
    {

        $this->db->select('*');
        $this->db->from('bf_ishop_secondary_sales');
        $this->db->where('invoice_no', $invoice_no);

        $invoice_data = $this->db->get()->result_array();

        if (isset($invoice_data) && !empty($invoice_data)) {
            return 1;
        } else {
            return 0;
        }

    }

    public function check_secondary_otn_data($otn)
    {
        $this->db->select('*');
        $this->db->from('ishop_secondary_sales');
        $this->db->where('order_tracking_no', $otn);

        $otn = $this->db->get()->result_array();

        if (isset($otn) && !empty($otn)) {
            return 1;
        } else {
            return 0;
        }
    }

    function check_secondary_invoice_date_data($invoice_no, $invoice_date)
    {

        $this->db->select('*');
        $this->db->from('bf_ishop_secondary_sales');
        $this->db->where('invoice_no', $invoice_no);
        $this->db->where('invoice_date', $invoice_date);

        $invoice_date_data = $this->db->get()->result_array();

        if (isset($invoice_date_data) && !empty($invoice_date_data)) {
            return 1;
        } else {
            return 0;
        }

    }

    function check_secondary_invoice_retailer_data($invoice_no, $user_retailer_data,$user_id)
    {
        $this->db->select('*');
        $this->db->from('bf_ishop_secondary_sales');
        $this->db->where('invoice_no', $invoice_no);
        $this->db->where('customer_id_to !=', $user_retailer_data);
        $this->db->where('customer_id_from', $user_id);

        $invoice_retailer_data = $this->db->get()->result_array();

        if (isset($invoice_retailer_data) && !empty($invoice_retailer_data)) {
            return 1;
        } else {
            return 0;
        }


    }

    public function check_product_data_exist($month, $product_data, $user_id, $unit)
    {
        $month = strtotime($month);
        $month = date('Y-m', $month);

        $this->db->select('*');
        $this->db->from('ishop_physical_stock');
        $this->db->where('DATE_FORMAT(stock_month,"%Y-%m")', $month);
        $this->db->where('product_sku_id', $product_data);
        $this->db->where('customer_id', $user_id);
        $this->db->where('unit', $unit);
        $phy_data = $this->db->get()->result_array();
        if (isset($phy_data) && !empty($phy_data)) {
            return 1;
        } else {
            return 0;
        }

    }


    public function get_primary_details_view_for_report($form_date, $to_date, $by_distributor, $by_invoice_no, $web_service = null, $page = null,$local_date = null)
    {
        $sql = 'SELECT SQL_CALC_FOUND_ROWS ips.invoice_no,ips.invoice_date,bu.user_code,bu.display_name,ips.PO_no,ips.order_tracking_no,ips.primary_sales_id ';
        $sql .= 'FROM bf_ishop_primary_sales AS ips ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = ips.customer_id) ';
        $sql .= 'WHERE 1 ';
        if (isset($by_distributor) && !empty($by_distributor) && $by_distributor != 0) {
            $sql .= 'AND ips.customer_id =' . $by_distributor . ' ';
        }
        if (isset($by_invoice_no) && !empty($by_invoice_no)) {
            $sql .= 'AND ips.invoice_no ="' . $by_invoice_no . '" ';
        }
        if ((isset($form_date) && !empty($form_date)) && (isset($to_date) && !empty($to_date))) {
            $sql .= 'AND ips.invoice_date BETWEEN ' . '"' . $form_date . '"' . ' AND ' . '"' . $to_date . '"' . ' ';
        }
        $sql .= 'ORDER BY ips.primary_sales_id DESC ';

            $primary_sales = $this->grid->get_result_res($sql,true,$page);

        $detail_data["row"] = array();
       // testdata($primary_sales);

        $final_array = array();

            if (isset($primary_sales['result']) && !empty($primary_sales['result'])) {

                foreach($primary_sales['result'] as $k => $val)
                {


                   $detail_data = $this->primary_sales_product_details_view_by_id($val['primary_sales_id'],null,'csv');

                    if(!empty($detail_data["row"])) {
                        foreach ($detail_data["row"] as $d_key => $product_data) {
                            $inner_array = array();

                            $inner_array = $val;
                            $inner_array["product_sku_code"] = isset($product_data[2]) ? $product_data[2] : '0';
                            $inner_array["product_sku_name"] = isset($product_data[3]) ? $product_data[3] : '0';
                            $inner_array["quantity"] = isset($product_data[4]) ? $product_data[4] : '0';
                            $inner_array["amount"] = isset($product_data[6]) ? $product_data[6] : '0';

                            $final_array[] = $inner_array;
                        }
                    }
                    else{
                        $inner_array = array();

                        $inner_array = $val;
                        $inner_array["product_sku_code"] =  '0';
                        $inner_array["product_sku_name"] = '0';
                        $inner_array["quantity"] = '0';
                        $inner_array["amount"] =  '0';


                        $final_array[] = $inner_array;
                    }
                }



                $primary['head'] = array('Sr. No.', 'Invoice No', 'Invoice Date', 'Distributor Code', 'Distributor Name', 'PO No.', 'Order Tracking No.','Product SKU Code','Product SKU Name','Quantity','Amount');

                $i = 1;

                foreach ($final_array as $ps) {
                    if($local_date != null)
                    {
                        $date = strtotime($ps['invoice_date']);
                        $invoice_date = date($local_date,$date);
                    }
                    else{
                        $invoice_date = $ps['invoice_date'];
                    }

                    $primary['row'][] = array($i,$ps['invoice_no'], $invoice_date, $ps['user_code'], $ps['display_name'],$ps['PO_no'] ,$ps['order_tracking_no'] , $ps['product_sku_code'],$ps['product_sku_name'],$ps['quantity'],$ps['amount']);
                    $i++;
                }
               // testdata($primary);
                return $primary;
            }
            else{
                return false;
            }
    }


    public function get_all_rol_view_for_report($user_id, $country_id, $logined_user_role, $checked_type = null,$page = null)
    {
        $sql ='SELECT SQL_CALC_FOUND_ROWS bu.user_code,bu.display_name,mptnc.product_country_name,ir.product_sku_id,mpsc.product_sku_name,ir.units,ir.rol_quantity,ir.rol_quantity_Kg_Ltr ';
        $sql .= 'FROM bf_ishop_rol AS ir ';
        $sql .= 'JOIN bf_users AS bu  ON (bu.id = ir.customer_id) ';
        $sql .= 'JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_id = ir.product_sku_id) ';
        $sql .= 'JOIN bf_master_product_type_name_country AS mptnc ON (mptnc.product_country_id = mpsc.PBG) ';
        $sql .= 'WHERE 1 ';
        if ($checked_type == "retailer") {
            $sql .= ' AND bu.role_id =10 ';
        }
        if ($checked_type == "distributor") {
            $sql .= ' AND bu.role_id =9 ';
        }
        if ($logined_user_role == 10 || $logined_user_role == 9) {
            $sql .= 'AND ir.customer_id =' . $user_id . ' ';
        }

        $sql .= 'AND ir.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY ir.rol_id DESC ';

        $rol_details = $this->grid->get_result_res($sql,true,$page);


        if (isset($rol_details['result']) && !empty($rol_details['result'])) {

                if ($logined_user_role == 9 || $logined_user_role == 10) {
                    $rol['head'] = array('Sr. No.', 'PBG', 'Product SKU Name', 'Units', 'ROL Quantity', 'ROL Qty Kg/Ltr');
                    $i = 1;

                    foreach ($rol_details['result'] as $rd) {

                        $rol['row'][] = array($i, $rd['product_country_name'], $rd['product_sku_name'], $rd['units'] , $rd['rol_quantity'] , $rd['rol_quantity_Kg_Ltr']);
                        $i++;
                    }
                }
                else
                {
                   // testdata($rol_details['result']);
                    if ($checked_type == 'retailer') {
                        $rol['head'] = array('Sr. No.', 'Retailer Code', 'Retailer Name', 'PBG', 'Product SKU Name', 'Units', 'ROL Quantity', 'ROL Qty Kg/Ltr');
                    }
                    else
                    {
                        $rol['head'] = array('Sr. No.', 'Distributor Code', 'Distributor Name', 'PBG', 'Product SKU Name', 'Units', 'ROL Quantity', 'ROL Qty Kg/Ltr');
                    }

                    $i = 1;

                    foreach ($rol_details['result'] as $rd) {

                        $rol['row'][] = array($i, $rd['user_code'], $rd['display_name'], $rd['product_country_name'], $rd['product_sku_name'], $rd['units'], $rd['rol_quantity_Kg_Ltr'], $rd['rol_quantity']);
                        $i++;
                    }
                }
                return $rol;

            }
            else{
                return false;
            }

    }


    public function company_current_stock_for_report($country_id, $page = null,$local_date= null)
    {
        $sql ='SELECT SQL_CALC_FOUND_ROWS iccs.date,iccs.product_sku_id,iccs.intrum_quantity,iccs.unrestricted_quantity,iccs.batch,iccs.batch_exp_date,iccs.batch_mfg_date,iccs.country_id,psc.product_sku_name ';
        $sql .= 'FROM bf_ishop_company_current_stock AS iccs ';
        $sql .= 'JOIN bf_master_product_sku_country AS psc ON (psc.product_sku_country_id = iccs.product_sku_id) ';
        $sql .= 'WHERE 1 ';
        $sql .= 'AND iccs.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY stock_id DESC ';

        $stock_detail = $this->grid->get_result_res($sql,true,$page);

        if (isset($stock_detail['result']) && !empty($stock_detail['result'])) {
                $stock_view['head'] = array('Sr. No.', 'Date', 'Product SKU Name', 'Intransist Qty.', 'Unrusticted Qty.', 'Batch', 'Batch Expiry Date', 'Batch Mfg. Date');

            $i = 1;

            foreach ($stock_detail['result'] as $sd) {

                    if($local_date != null)
                    {
                        $date = strtotime($sd['date']);
                        $c_date = date($local_date,$date);

                        $date1 = strtotime($sd['batch_exp_date']);
                        $exp_date = date($local_date,$date1);

                        $date2 = strtotime($sd['batch_mfg_date']);
                        $mfg_date = date($local_date,$date2);

                    }
                    else{
                        $c_date = $sd['date'];
                        $exp_date = $sd['batch_exp_date'];
                        $mfg_date = $sd['batch_mfg_date'];
                    }


                    $intrumquantity = isset($sd['intrum_quantity']) ?  $sd['intrum_quantity']:"";

                    $stock_view['row'][] = array($i, $c_date, $sd['product_sku_name'], $intrumquantity, $sd['unrestricted_quantity'], $sd['batch'], $exp_date, $mfg_date);
                    $i++;
                }

                return $stock_view;
        }
        else{
            return false;
        }

    }


    public function get_secondary_details_view_for_report($form_date, $to_date, $by_retailer, $by_invoice_no, $user_id, $country_id, $sales_view = null, $from_month = null, $to_month = null, $geo_level = null, $distributor_id = null, $page = null,$web_service=null,$local_date=null)
    {

        $sql = 'SELECT iss.secondary_sales_id as id,bu1.display_name as entry_by,iss.etn_no,iss.created_on,iss.invoice_no,iss.invoice_date,bu.user_code,bu.display_name,iss.PO_no,iss.order_tracking_no,iss.total_amount,iss.secondary_sales_id ';
        $sql .= 'FROM bf_ishop_secondary_sales AS iss ';
        $sql .= 'JOIN bf_users AS bu  ON (bu.id = iss.customer_id_to) ';
        $sql .= 'JOIN bf_users AS bu1 ON (bu1.id = iss.created_by_user) ';
        $sql .= 'WHERE 1 ';
        if (isset($by_retailer) && !empty($by_retailer) && $by_retailer != 0) {
            $sql .= 'AND iss.customer_id_to =' . $by_retailer . ' ';
        }
        if (isset($by_invoice_no) && !empty($by_invoice_no)) {
            $sql .= 'AND iss.invoice_no =' . $by_invoice_no . ' ';
        }
        if ((isset($form_date) && !empty($form_date) && (isset($to_date) && !empty($to_date)))) {
            $sql .= 'AND iss.invoice_date BETWEEN ' . '"' . $form_date . '"' . ' AND ' . '"' . $to_date . '"' . ' ';
        }
        if (isset($sales_view) && !empty($sales_view) && $sales_view = 'sales_view') {
            if ((isset($from_month) && !empty($from_month)) && (isset($to_month) && !empty($to_month))) {
                $sql .= 'AND DATE_FORMAT(iss.invoice_date,"%Y-%m") BETWEEN ' . '"' . $from_month . '"' . ' AND ' . '"' . $to_month . '"' . ' ';
            }
            if ((isset($geo_level) && !empty($geo_level)) || (isset($distributor_id) && !empty($distributor_id))) {
                $sql .= 'AND iss.customer_id_from =' . $distributor_id . ' ';
            }
        }

        $sql .= 'AND iss.created_by_user =' . $user_id . ' ';
        $sql .= 'AND iss.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY iss.secondary_sales_id DESC ';

        $secondary_sales = $this->grid->get_result_res($sql,true,$page);

        //testdata($secondary_sales);

        $detail_data["row"] = array();
        // testdata($primary_sales);

        $final_array = array();

        if (isset($secondary_sales['result']) && !empty($secondary_sales['result'])) {

            foreach($secondary_sales['result'] as $k => $val)
            {

                $detail_data = $this->secondary_sales_product_details_view_by_id($val['secondary_sales_id'],null,'csv');

                if(!empty($detail_data["row"])) {
                    foreach ($detail_data["row"] as $d_key => $product_data) {
                        $inner_array = array();

                        $inner_array = $val;
                        $inner_array["product_sku_code"] = isset($product_data[2]) ? $product_data[2] : '0';
                        $inner_array["product_sku_name"] = isset($product_data[3]) ? $product_data[3] : '0';
                        $inner_array["quantity"] = isset($product_data[4]) ? $product_data[4] : '0';
                        $inner_array["unit"] = isset($product_data[5]) ? $product_data[5] : '0';
                        $inner_array["qty_kgl"] = isset($product_data[6]) ? $product_data[6] : '0';
                        $inner_array["amount"] = isset($product_data[7]) ? $product_data[7] : '0';

                        $final_array[] = $inner_array;
                    }
                }
                else{
                    $inner_array = array();

                    $inner_array = $val;
                    $inner_array["product_sku_code"] =  '';
                    $inner_array["product_sku_name"] = '';
                    $inner_array["unit"] = '';
                    $inner_array["quantity"] = '0';
                    $inner_array["qty_kgl"] = '0';
                    $inner_array["amount"] = '0';

                    $final_array[] = $inner_array;
                }
            }

           $secondary['head'] = array('Sr. No.','Entry By','Entry Date','ETN' ,'Invoice No', 'Invoice Date', 'Retailer Code', 'Retailer Name', 'PO No.', 'Order Tracking No.','Product SKU Code','Product SKU Name','Quantity','Unit','Quantity KG/Ltr','Amount');

            $i = 1;


            foreach ($final_array as $ps) {

                if($local_date != null)
                {
                    $date = strtotime($ps['created_on']);
                    $entry_date = date($local_date,$date);

                    $date1 = strtotime($ps['invoice_date']);
                    $invoice_date = date($local_date,$date1);


                }
                else{
                    $entry_date = $ps['created_on'];
                    $invoice_date = $ps['invoice_date'];
                }

                $secondary['row'][] = array($i,$ps['entry_by'], $entry_date, $ps['etn_no'], $ps['invoice_no'],$invoice_date,$ps['user_code'] ,$ps['display_name'] , $ps['PO_no'],$ps['order_tracking_no'],$ps['product_sku_code'],$ps['product_sku_name'],$ps['quantity'],$ps['unit'],$ps['qty_kgl'],$ps['amount']);
                $i++;
            }

            return $secondary;
        }
        else{
            return false;
        }
    }



    public function physical_stock_by_for_report($user_id, $country_id, $role_id, $checked_type = null, $page = null, $web_service = null,$stock_month=null,$local_date = null)
    {
        $sql = 'SELECT  bu.display_name,ips.created_on,ips.stock_id,ips.stock_month,ips.quantity,ips.unit,ips.product_sku_id,ips.qty_kgl,mpsc.product_sku_name,mpsr.product_sku_code ';
        $sql .= 'FROM bf_ishop_physical_stock AS ips ';
        $sql .= 'LEFT JOIN bf_users AS bu  ON (bu.id = ips.modified_by_user) ';
        $sql .= 'LEFT JOIN bf_users AS bu1  ON (bu1.id = ips.customer_id) ';
        $sql .= 'JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_id = ips.product_sku_id) ';
        $sql .= 'JOIN bf_master_product_sku_regional AS mpsr ON (mpsr.product_sku_id = mpsc.product_sku_id) ';
        $sql .= 'WHERE 1 ';

        if ($checked_type == "retailer") {
            $sql .= ' AND bu1.role_id =10 ';
        }
        if ($checked_type == "distributor") {
            $sql .= ' AND bu1.role_id =9 ';
        }
        if ($role_id == 10 || $role_id == 9) {
            $sql .= 'AND ips.customer_id =' . $user_id . ' ';
        }
        if($stock_month != null){
            $sql .= 'AND DATE_FORMAT(ips.stock_month,"%Y-%m") ="'.$stock_month  . '" ';
        }
        $sql .= 'AND ips.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY ips.stock_id DESC ';

        $pyh_stock_details = $this->grid->get_result_res($sql,true,$page);

        if (isset($pyh_stock_details['result']) && !empty($pyh_stock_details['result'])) {
            $pyh_stock= array();
            if ($role_id == 10 || ($role_id == 8 && $checked_type == 'retailer')) {

                $pyh_stock['head'] = array('Sr. No.', 'Month Year', 'Product SKU Code', 'Product SKU Name', 'Quantity', 'Units', 'Qty Kg/Ltr');
                $i = 1;
                foreach ($pyh_stock_details['result'] as $rd) {
                    $month = strtotime($rd['stock_month']);
                    $month = date('F - Y', $month);
                    $pyh_stock['row'][] = array($i, $month, $rd['product_sku_code'], $rd['product_sku_name'],  $rd['quantity'], $rd['unit'], $rd['qty_kgl']);
                    $i++;
                }
            } elseif ($role_id == 9 || ($role_id == 8 && $checked_type == 'distributor')) {

                $pyh_stock['head'] = array('Sr. No.', 'Month Year', 'Latest Updated By', 'Entry Date', 'Product SKU Code', 'Product SKU Name', 'Quantity', 'Units', 'Qty Kg/Ltr');
                $i = 1;

                foreach ($pyh_stock_details['result'] as $rd) {
                    $month = strtotime($rd['stock_month']);
                    $month = date('F - Y', $month);

                    if($local_date != null){
                        $created = strtotime($rd['created_on']);
                        $created_date = date($local_date, $created);
                    }
                    else{
                        $created_date =  $rd['created_on'];
                    }

                    $pyh_stock['row'][] = array($i, $month, $rd['display_name'], $created_date, $rd['product_sku_code'], $rd['product_sku_name'], $rd['quantity'], $rd['unit'], $rd['qty_kgl']);
                    $i++;
                }
            }

            return $pyh_stock;
        }
        else{
            return false;
        }


    }


    public function invoice_confirm_for_report($invoice_month, $po_no, $invoice_no, $user_id, $country_id, $page = null,$web_service=null)
    {
        $sql = 'SELECT * ';
        $sql .= ' FROM bf_ishop_primary_sales AS ips ';
        $sql .= 'WHERE 1 ';

        if (isset($invoice_month) && !empty($invoice_month) && $invoice_month != '') {
            $sql .= 'AND DATE_FORMAT(ips.invoice_date,"%Y-%m") =' . "'" . $invoice_month . "'" . ' ';
        }
        if (isset($po_no) && !empty($po_no) && $po_no != '') {
            $sql .= 'AND ips.PO_no =' . $po_no . ' ';
        }
        if (isset($invoice_no) && !empty($invoice_no) && $invoice_no != '') {
            $sql .= 'AND ips.invoice_no =' . $invoice_no . ' ';
        }
        $sql .= " AND ips.country_id= " . $country_id . " ";
        $sql .= " AND ips.customer_id= " . $user_id . " ";
        $sql .= " AND ips.invoice_recived_status = 0 ";
        $sql .= " AND ips.status = 1 ";

        $invoice_confirmation = $this->grid->get_result_res($sql,true,$page);

        if (isset($invoice_confirmation['result']) && !empty($invoice_confirmation['result'])) {

            $i = 1;

            $invoice_confirmation_view['head'] = array('Sr. No.', 'PO No.', 'OTN', 'Invoice No.', 'Invoice Value', 'Received');

            foreach ($invoice_confirmation['result'] as $ic) {

                if ($ic['invoice_recived_status'] == '0') {
                    $received_status = 'Pending';
                } else {
                    $received_status = 'Confirm';
                }
                $invoice_confirmation_view['row'][] = array($i, $ic['PO_no'], $ic['order_tracking_no'], $ic['invoice_no'], $ic['total_amount'], $received_status);
                $i++;
            }
            return $invoice_confirmation_view;

        }
        else{
            return false;
        }

    }


    public function view_sales_detail_by_retailer_report($user_id, $country_id, $from_month, $to_month, $geo_level_0, $geo_level_1, $retailer_id, $page = null,$web_service = null,$local_date=null)
    {
        $sql = 'SELECT itsp.tertiary_sales_id,itsp.sales_month,bu.user_code,bu.display_name ';
        $sql .= 'FROM bf_ishop_tertiary_sales AS itsp ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = itsp.customer_id) ';
        $sql .= 'WHERE 1 ';
        if ((isset($from_month) && !empty($from_month)) && (isset($to_month) && !empty($to_month))) {
            $sql .= 'AND DATE_FORMAT(itsp.sales_month,"%Y-%m") BETWEEN ' . '"' . $from_month . '"' . ' AND ' . '"' . $to_month . '"' . ' ';
        }
        if ((isset($geo_level_0) && !empty($geo_level_0)) && (isset($geo_level_1) && !empty($geo_level_1)) && (isset($retailer_id) && !empty($retailer_id))) {
            $sql .= 'AND  itsp.customer_id =' . $retailer_id . ' ';
        }
        $sql .= 'AND itsp.created_by_user =' . $user_id . ' ';
        $sql .= 'AND itsp.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY itsp.tertiary_sales_id DESC ';


        $sales_detail = $this->grid->get_result_res($sql,true,$page);

        if (isset($sales_detail['result']) && !empty($sales_detail['result'])) {

            foreach($sales_detail['result'] as $k => $val)
            {

                $detail_data = $this->tertiary_sales_product_details_view_by_id($val['tertiary_sales_id'],null,'csv');

                if(!empty($detail_data["row"])) {
                    foreach ($detail_data["row"] as $d_key => $product_data) {
                        $inner_array = array();

                        $inner_array = $val;
                        $inner_array["product_sku_code"] = isset($product_data[2]) ? $product_data[2] : '0';
                        $inner_array["product_sku_name"] = isset($product_data[3]) ? $product_data[3] : '0';
                        $inner_array["unit"] = isset($product_data[5]) ? $product_data[4] : '0';
                        $inner_array["quantity"] = isset($product_data[4]) ? $product_data[5] : '0';
                        $inner_array["qty_kgl"] = isset($product_data[6]) ? $product_data[6] : '0';


                        $final_array[] = $inner_array;
                    }
                }
                else{
                    $inner_array = array();

                    $inner_array = $val;
                    $inner_array["product_sku_code"] =  '0';
                    $inner_array["product_sku_name"] = '0';
                    $inner_array["qty_kgl"] = '0';
                    $inner_array["quantity"]='0';
                    $inner_array["unit"] = '';


                    $final_array[] = $inner_array;
                }
            }


            $sales_view['head'] = array('Sr. No.', 'Month', 'Retailer Code', 'Retailer Name','Product SKU Code','Product SKU Name','Unit','Quantity','Quantity Kg/Ltr');

            $i = 1;

            foreach ($final_array as $sd) {
                $month = strtotime($sd['sales_month']);
                $month = date('F - Y', $month);
                $sales_view['row'][] = array($i, $month, $sd['user_code'], $sd['display_name'],$sd['product_sku_code'],$sd['product_sku_name'],$sd['unit'],$sd['quantity'],$sd['qty_kgl']);
                $i++;
            }

            return $sales_view;
        } else {
            return false;
        }

    }


    public function view_schemes_detail_report($user_id, $country_id, $year, $region = null, $territory = null, $login_user, $retailer = null, $page = null, $web_service = null)
    {

        $sql ='SELECT isa.allocation_id,bmbgd.business_georaphy_name as business_georaphy_name_parent,bmbgd1.business_georaphy_code,bmbgd1.business_georaphy_name,bu.display_name,bu.user_code,ms.scheme_code,ms.scheme_name,mpsc.product_sku_name,mss.slab_no,mss.1point,mss.value_per_kg ';
        if($login_user== 8)
        {
            $sql .= ' ,SUM(isp.quantity) as qty ';
        }
        $sql .= 'FROM bf_ishop_scheme_allocation AS isa ';
        $sql .= 'JOIN bf_users AS bu ON (bu.id = isa.customer_id) ';
        $sql .= 'JOIN bf_master_scheme AS ms ON (ms.scheme_id = isa.scheme_id) ';
        $sql .= 'JOIN bf_master_scheme_slab AS mss ON (mss.slab_id = isa.slab_id) ';
        $sql .= 'JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_country_id = mss.product_sku_id) ';
        $sql .= 'LEFT JOIN bf_master_business_geography_details AS bmbgd ON (bmbgd.business_geo_id = isa.geo_id2) ';
        $sql .= 'LEFT JOIN bf_master_business_geography_details AS bmbgd1 ON (bmbgd1.business_geo_id = isa.geo_id1) ';
        if ($login_user == 8) {
            $sql .= 'LEFT JOIN bf_ishop_secondary_sales_product AS isp ON (isp.customer_id = isa.customer_id AND isp.product_sku_id = mss.product_sku_id) ';
        }

        $sql .= 'WHERE 1 ';
        if (isset($year) && !empty($year)) {
            $sql .= "AND DATE_FORMAT(isa.year,'%Y') =" . "'" . $year . "'" . " ";
        }
        if (isset($region) && !empty($region) && $region != 0) {
            $sql .= 'AND geo_id2 =' . $region . ' ';
        }
        if (isset($territory) && !empty($territory) && $territory != 0) {
            $sql .= 'AND geo_id1 =' . $territory . ' ';
        }


        if ($login_user == 10) {
            $sql .= 'AND isa.customer_id =' . $user_id . ' ';
        }
        $sql .= 'AND mpsc.status = "1" ';
        //$sql .= 'AND isa.country_id ='.$country_id;
        if ($login_user == 8) {
            if (isset($retailer) && !empty($retailer) && $retailer != 0) {
                $sql .= ' AND isa.customer_id =' . $retailer . ' ';
            }
            $sql .= ' GROUP BY isa.allocation_id ';
        }

        $scheme_allocation = $this->grid->get_result_res($sql,true,$page);

        if (isset($scheme_allocation['result']) && !empty($scheme_allocation['result'])) {
            $scheme_allocation_view = array();

            if ($login_user == 7) {

                $i = 1;

                foreach ($scheme_allocation['result'] as $sd) {

                    $scheme_allocation_view['head'] =array('Sr. No.','Region','Territory Code','Territory Name','Retailer Code','Retailer Name','Scheme Code','Scheme Name','Product SKU Name','Slab No.','1 point:?kg/ltr','Value Per Kg/Ltr');
                    $scheme_allocation_view['row'][] = array($i, $sd['business_georaphy_name_parent'], $sd['business_georaphy_code'], $sd['business_georaphy_name'], $sd['user_code'], $sd['display_name'], $sd['scheme_code'], $sd['scheme_name'], $sd['product_sku_name'], $sd['slab_no'], $sd['1point'], $sd['value_per_kg']);
                    $i++;
                }
            } elseif ($login_user == 8) {

                $scheme_allocation_view['head'] = array('Sr. No.', 'Retailer Name', 'Retailer Code', 'Scheme Code', 'Scheme Name', 'Product SKU Name', 'Slab No.', '1 pt = ? Kg per Ltr', 'Actual Sales');
                $i = 1;
                foreach ($scheme_allocation['result'] as $sd) {
                    if (isset($sd['qty']) && !empty($sd['qty'])) {
                        $qty = $sd['qty'];
                    } else {
                        $qty = '0';
                    }
                    $scheme_allocation_view['row'][] = array($i, $sd['display_name'], $sd['user_code'], $sd['scheme_code'], $sd['scheme_name'], $sd['product_sku_name'], $sd['slab_no'], $sd['1point'], $qty);
                    $i++;
                }

            } elseif ($login_user == 10) {

                $scheme_allocation_view['head'] = array('Sr. No.', 'Scheme Code', 'Scheme Name', 'Product SKU Name', 'Slab No.', '1 pt = ? Kg per Ltr');
                $scheme_allocation_view['count'] = count($scheme_allocation_view['head']);

                $i = 1;

                foreach ($scheme_allocation['result'] as $sd) {
                    $scheme_allocation_view['row'][] = array($i, $sd['scheme_code'], $sd['scheme_name'], $sd['product_sku_name'], $sd['slab_no'], $sd['1point']);
                    $i++;
                }

            }

            return $scheme_allocation_view;
        }
        else{
            return false;
        }

    }


    public function target_details_report($user_id, $country_id, $checked_type = null, $page = null, $web_service = null)
    {
        $sql =' SELECT  it.ishop_target_id,mpgd.political_geography_name,it.ishop_target_id,bu.user_code,bu.display_name,mpsc.product_sku_name,it.quantity ';
        $sql .= ' FROM bf_ishop_target AS it ';
        $sql .= ' JOIN bf_users AS bu  ON (bu.id = it.customer_id) ';
        $sql .= ' JOIN bf_master_product_sku_country AS mpsc ON (mpsc.product_sku_id = it.product_sku_id) ';
        $sql .= ' JOIN bf_master_user_contact_details AS mucd ON (mucd.user_id = bu.id) ';
        $sql .= ' JOIN bf_master_political_geography_details AS mpgd ON (mpgd.political_geo_id = mucd.geo_level_id1) ';
        $sql .= 'WHERE 1 ';
        if ($checked_type == "retailer") {
            $sql .= ' AND bu.role_id =10 ';
        }
        if ($checked_type == "distributor") {
            $sql .= ' AND bu.role_id =9 ';
        }
        $sql .= 'AND it.country_id =' . $country_id . ' ';
        $sql .= 'ORDER BY it.ishop_target_id DESC ';

        $target_details = $this->grid->get_result_res($sql,true,$page);


        if (isset($target_details['result']) && !empty($target_details['result'])) {
            if ($checked_type == 'retailer') {
                $target['head'] = array('Sr. No.', 'Action', 'Geo', 'Retailer Code', 'Retailer Name', 'Product SKU Name', 'Quantity');

            } else {
                $target['head'] = array('Sr. No.', 'Action', 'Geo', 'Distributor Code', 'Distributor Name', 'Product SKU Name', 'Quantity');

            }

            $i = 1;

            foreach ($target_details['result'] as $rd) {

                $target['row'][] = array($i, $rd['ishop_target_id'], $rd['political_geography_name'], $rd['user_code'], $rd['display_name'], $rd['product_sku_name'], $rd['quantity']);
                $i++;
            }
            return $target;
        }
        else{
            return false;
        }
    }


    public function prespective_order_details_report($from_date, $todate, $loginusertype, $loginuserid, $page = null, $web_service = null,$local_date = null)
    {

        $sql = 'SELECT  bio.order_id,bio.customer_id_from,bio.customer_id_to,bio.order_taken_by_id,bio.order_date,bio.PO_no,bio.order_tracking_no,bio.read_status,bio.created_on, bmupd.first_name as from_fname,bmupd.middle_name as from_mname,bmupd.last_name as from_lname, bmucd.primary_mobile_no, bmucd.address ,bmupd1.first_name as ot_from_fname1,bmupd1.middle_name as ot_from_mname1,bmupd1.last_name as ot_from_lname1,bu.display_name as bu_dn,u.display_name as b_dn ';

        $sql .= ' FROM bf_ishop_orders as bio ';
        $sql .= ' LEFT JOIN bf_users AS bu ON (bu.id = bio.customer_id_from) ';
        $sql .= ' LEFT JOIN bf_master_user_personal_details as bmupd ON (bmupd.user_id = bu.id) ';
        $sql .= ' LEFT JOIN bf_master_user_contact_details as bmucd ON (bmucd.user_id = bu.id) ';

        $sql .= ' LEFT JOIN bf_users as u ON (u.id = bio.order_taken_by_id) ';
        $sql .= ' LEFT JOIN bf_master_user_personal_details as bmupd1 ON (bmupd1.user_id = u.id) ';

        $sql .= 'WHERE 1 ';

        $sql .= 'AND bio.order_date BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $todate . '"' . ' ';

        $sql .= ' AND bio.customer_id_to =' . $loginuserid . ' ';

        $sql .= 'ORDER BY order_date DESC ';


        $prespective_order = $this->grid->get_result_res($sql,true,$page);


        if (isset($prespective_order['result']) && !empty($prespective_order['result'])) {

            $final_array=array();
            foreach($prespective_order['result'] as $k => $val)
            {

                $detail_data = $this->order_product_details_view_by_id($val['order_id'],null,'csv');

                if(!empty($detail_data["row"])) {
                    foreach ($detail_data["row"] as $d_key => $product_data) {
                        $inner_array = array();

                        $inner_array = $val;
                        $inner_array["product_sku_code"] = isset($product_data[1]) ? $product_data[1] : '';
                        $inner_array["product_sku_name"] = isset($product_data[2]) ? $product_data[2] : '';
                        $inner_array["unit"] = isset($product_data[3]) ? $product_data[3] : '';
                        $inner_array["quantity"] = isset($product_data[4]) ? $product_data[4] : '0';
                        $inner_array["qty_kgl"] = isset($product_data[5]) ? $product_data[5] : '0';


                        $final_array[] = $inner_array;
                    }
                }
                else{
                    $inner_array = array();

                    $inner_array = $val;
                    $inner_array["product_sku_code"] =  '';
                    $inner_array["product_sku_name"] = '';
                    $inner_array["qty_kgl"] = '0';
                    $inner_array["quantity"]='0';
                    $inner_array["unit"] = '';

                    $final_array[] = $inner_array;
                }
            }




            if ($loginusertype == 9) {
                $head_data = "Retailer Name";
            } else {
                $head_data = "Farmer Name";
            }

            $prespective['head'] = array('Sr. No.', 'Entered By', 'PO No', 'OTN', 'Date Of Entry', $head_data ,'Product Code','Product Name','Unit','Quantity','Qty. Kg/Ltr','Address', 'Mobile No.', 'Read');

            $i = 1;

            foreach ($final_array as $po) {
                if ($po['read_status'] == 0) {
                    $read_status = "Unread";
                } else {
                    $read_status = "Read";
                }

                if($local_date != null)
                {
                    $date = strtotime($po['order_date']);
                    $doe = date($local_date,$date);
                }
                else{
                    $doe = $po['order_date'];
                }

                $prespective['row'][] = array($i, $po['b_dn'], $po['PO_no'], $po['order_tracking_no'], $doe, $po['bu_dn'],$po['product_sku_code'],$po['product_sku_name'],$po['unit'],$po['quantity'],$po['qty_kgl'], $po['address'], $po['primary_mobile_no'], $read_status);
                $i++;
            }

            return $prespective;
        }
        else{
            return false;
        }
    }


    public function order_details_report($loginusertype, $user_country_id, $radio_checked, $loginuserid, $customer_id=null, $from_date=null, $todate = null, $order_tracking_no = null, $order_po_no = null, $page = null, $page_function = null, $order_status = null, $web_service = null,$local_date=null)
    {
        $sql =' SELECT bio.order_id,bio.customer_id_from,bio.customer_id_to,bio.order_taken_by_id,bio.order_date,bio.PO_no,bio.order_tracking_no,bio.estimated_delivery_date,bio.total_amount,bio.order_status,bio.read_status, f_bu.role_id,f_bu.user_code as f_u_code, bicl.credit_limit,bu.display_name,f_bu.display_name as f_dn,f_bu.user_code as f_uc,t_bu.display_name as t_dn,bio.created_on ';

        $sql .= ' FROM bf_ishop_orders as bio ';
        $sql .= ' LEFT JOIN bf_users AS bu ON (bu.id = bio.order_taken_by_id) ';
        $sql .= ' LEFT JOIN bf_users as f_bu ON (f_bu.id = bio.customer_id_from) ';
        $sql .= ' LEFT JOIN bf_users as t_bu ON (t_bu.id = bio.customer_id_to) ';
        $sql .= ' LEFT JOIN bf_ishop_credit_limit as bicl ON (bicl.customer_id = bio.customer_id_from) ';
        $sql .= 'WHERE 1 ';

        if (isset($page_function) && !empty($page_function)) {
            $action_data = $page_function;
        } else {
            $action_data = $this->uri->segment(2);
        }
        if ($action_data != "order_approval") {
            if ($order_tracking_no != null ) {
                $sql .= ' AND bio.order_tracking_no =' .'"'. $order_tracking_no .'"'. ' ';
                $sql .= ' AND f_bu.role_id = 11  ';
            } else {
                if ($action_data != "po_acknowledgement") {
                    $sql .= ' AND bio.order_date BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $todate . '"' . ' ';
                }
                if ($action_data == "po_acknowledgement") {
                    $sql .= ' AND bio.order_taken_by_id !=' . $customer_id . ' ';
                    $sql .= ' AND bio.order_status = 4 ';
                }
                $sql .= ' AND bio.customer_id_from =' . $customer_id . ' ';
            }

        } else if ($action_data == "order_approval") {
            if (isset($order_status) && !empty($order_status)) {
                $sub_action_data = $order_status;
            } else {
                $sub_action_data = $_GET["renderdata"];
            }

            $sql .= ' AND bio.order_date BETWEEN ' . '"' . $from_date . '"' . ' AND ' . '"' . $todate . '"' . ' ';
            $sql .= ' AND f_bu.role_id = 9 ';

            if ($order_tracking_no != null) {
                $sql .= ' AND bio.order_tracking_no ="' . $order_tracking_no . '" ';
            }
            if ($order_po_no != null) {
                $sql .= ' AND bio.PO_no ="' . $order_po_no . '" ';
            }
            if ($sub_action_data == "dispatched") {
                $sql .= ' AND bio.order_status = 1 ';
            }
            elseif ($sub_action_data == "pending") {
                $sql .= ' AND bio.order_status = 0 ';
            }
            elseif ($sub_action_data == "reject") {
                $sql .= ' AND bio.order_status = 3 ';
            }
            $sql .= ' AND bio.order_status != 4 ';

        }

        if($action_data == "order_status")
        {
            $subsql = ' AND bu.role_id="'.$loginusertype.'" ';
        }
        else
        {
            $subsql = ' ';
        }

        $sql .= ' AND bio.country_id = "' . $user_country_id . '" '.$subsql.' ORDER BY bio.created_on DESC ';

        $orderdata = $this->grid->get_result_res($sql,true,$page);

       // testdata($orderdata);
        if (isset($orderdata['result']) && !empty($orderdata['result'])) {

            $order_view=array();

            if ($loginusertype == 7) {
                //FOR HO
                if ($action_data == "order_approval") {

                    $final_array=array();
                    foreach($orderdata['result'] as $k => $val)
                    {
                        $detail_data = $this->order_status_product_details_view_by_id($val['order_id'],$radio_checked,$loginusertype,$page_function,null,'csv');

                        if(!empty($detail_data["row"])) {
                            foreach ($detail_data["row"] as $d_key => $product_data) {
                                $inner_array = array();

                                $inner_array = $val;
                                $inner_array["product_sku_code"] = isset($product_data[2]) ? $product_data[2] : '';
                                $inner_array["product_sku_name"] = isset($product_data[3]) ? $product_data[3] : '';
                                $inner_array["unit"] = isset($product_data[4]) ? $product_data[4] : '';
                                $inner_array["quantity"] = isset($product_data[5]) ? $product_data[5] : '0';
                                $inner_array["qty_kgl"] = isset($product_data[6]) ? $product_data[6] : '0';
                                $inner_array["amount"] = isset($product_data[7]) ? $product_data[7] : '0';
                                $inner_array["current_stock"] = isset($product_data[8]) ? $product_data[8] : '0';
                                $inner_array["dispatched_quantity"] = isset($product_data[9]) ? $product_data[9] : '0';

                                $final_array[] = $inner_array;
                            }
                        }
                        else{
                            $inner_array = array();

                            $inner_array = $val;
                            $inner_array["product_sku_code"] =  '';
                            $inner_array["product_sku_name"] = '';
                            $inner_array["qty_kgl"] = '0';
                            $inner_array["quantity"]='0';
                            $inner_array["unit"] = '';
                            $inner_array["amount"] = '0';
                            $inner_array["current_stock"] = '0';
                            $inner_array["dispatched_quantity"] = '0';

                            $final_array[] = $inner_array;
                        }
                    }
                    //testdata($final_array );



                    $order_view['head'] = array('Sr. No.', 'Distributor Code', 'Distributor Name', 'PO No.', 'Order Tracking No.','Product SKU Code','Product SKU Name','Unit','Quantity','Qty. kg/ltr', 'Amount','Current Stock','Dispatched Quantity', 'Credit Limit', 'Status');

                    $i = 1;

                    foreach ($final_array as $od) {

                        if ($od['order_status'] == 0) {
                            $order_status = "Pending";
                        }
                        elseif ($od['order_status'] == 1) {
                            $order_status = "Dispatched";
                        }
                        elseif ($od['order_status'] == 3) {
                            $order_status = "Rejected";
                        }
                        elseif ($od['order_status'] == 4) {
                            $order_status = "OP_Ackno";
                        }

                        $order_view['row'][] = array($i, $od['f_u_code'],$od['f_dn'] , $od['PO_no'], $od['order_tracking_no'],$od['product_sku_code'],$od['product_sku_name'],$od['unit'],$od['quantity'],$od['qty_kgl'],$od['amount'],$od['current_stock'],$od['dispatched_quantity'], $od['credit_limit'], $order_status);

                        $i++;
                    }

                }
                else {

                    $final_array=array();
                    foreach($orderdata['result'] as $k => $val)
                    {
                        $detail_data = $this->order_status_product_details_view_by_id($val['order_id'],$radio_checked,$loginusertype,$page_function,null,'csv');

                        if(!empty($detail_data["row"])) {
                            foreach ($detail_data["row"] as $d_key => $product_data) {
                                $inner_array = array();

                                $inner_array = $val;
                                $inner_array["product_sku_code"] = isset($product_data[2]) ? $product_data[2] : '';
                                $inner_array["product_sku_name"] = isset($product_data[3]) ? $product_data[3] : '';
                                $inner_array["unit"] = isset($product_data[4]) ? $product_data[4] : '';
                                $inner_array["quantity"] = isset($product_data[5]) ? $product_data[5] : '0';
                                $inner_array["qty_kgl"] = isset($product_data[6]) ? $product_data[6] : '0';
                                $inner_array["Amount"] = isset($product_data[7]) ? $product_data[7] : '0';
                                $inner_array["Approved Quantity"] = isset($product_data[8]) ? $product_data[8] : '0';

                                $final_array[] = $inner_array;
                            }
                        }
                        else{
                            $inner_array = array();

                            $inner_array = $val;
                            $inner_array["product_sku_code"] =  '';
                            $inner_array["product_sku_name"] = '';
                            $inner_array["qty_kgl"] = '0';
                            $inner_array["quantity"]='0';
                            $inner_array["unit"] = '';
                            $inner_array["Amount"] = '0';
                            $inner_array["Approved Quantity"] = '0';


                            $final_array[] = $inner_array;
                        }
                    }
                   // testdata($final_array );

                    if($radio_checked == "retailer"){

                        $order_view['head'] = array('Sr. No.','Distributor Name', 'Order Date', 'PO No.', 'Order Tracking No.', 'EDD','Product SKU Code','Product SKU Name','Unit','Quantity','Qty. kg/ltr', 'Amount', 'Entered By', 'Status');

                        $i = 1;

                        foreach ($final_array as $od) {

                            if ($od['read_status'] == 0) {
                                $order_status = "Unread";
                            } elseif ($od['read_status'] == 1) {
                                $order_status = "Read";
                            }

                            if($local_date != null){
                                $date = strtotime($od['order_date']);
                                $order_date = date($local_date,$date);

                                $time= strtotime($od['created_on']);
                                $t= date('g:i a',$time);

                                $order_datetime = $order_date.' '.$t;
                            }
                            else{
                                $order_datetime = $od['order_date'];
                            }

                            $order_view['row'][] = array($i,$od['t_dn'],$order_datetime, $od['PO_no'], $od['order_tracking_no'], $od['estimated_delivery_date'], $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'], $od['qty_kgl'], $od['Amount'], $od['display_name'], $order_status);
                            $i++;
                        }
                    }
                    else{

                        $order_view['head'] = array('Sr. No.', 'Order Date', 'PO No.', 'Order Tracking No.', 'EDD','Product SKU Code ','Product SKU Name','Unit','Quantity','Qty.kg/ltr','Amount', 'Approved Quantity','Entered By', 'Status');

                        $i = 1;

                        foreach ($final_array as $od) {

                            if ($od['order_status'] == 0) {
                                $order_status = "Pending";
                            }
                            elseif ($od['order_status'] == 1) {
                                $order_status = "Dispatched";
                            }
                            elseif ($od['order_status'] == 3) {
                                $order_status = "Rejected";
                            }
                            elseif ($od['order_status'] == 4) {
                                $order_status = "OP_Ackno";
                            }

                            if($local_date != null){
                                $date = strtotime($od['order_date']);
                                $order_date = date($local_date,$date);

                                $time= strtotime($od['created_on']);
                                $t= date('g:i a',$time);

                                $order_datetime = $order_date.' '.$t;

                                if(!empty($od["estimated_delivery_date"]))
                                {
                                    $date1 = strtotime($od["estimated_delivery_date"]);
                                    $estimated_date =  date($local_date,$date1);
                                }
                                else{
                                    $estimated_date='';
                                }
                            }
                            else{
                                $order_datetime = $od['order_date'];
                                $estimated_date =$od["estimated_delivery_date"];

                            }

                            $order_view['row'][] = array($i,$order_datetime, $od['PO_no'], $od['order_tracking_no'], $estimated_date, $od['product_sku_code'],$od['product_sku_name'],$od['unit'],$od['quantity'],$od['qty_kgl'],$od['Amount'],$od['Approved Quantity'], $od['display_name'], $order_status);
                            $i++;

                        }
                    }
                }
            }
            else if ($loginusertype == 8) {
                //FOR FO

                $final_array=array();
                foreach($orderdata['result'] as $k => $val)
                {

                    $detail_data = $this->order_status_product_details_view_by_id($val['order_id'],$radio_checked,$loginusertype,$page_function,null,'csv');


                    if(!empty($detail_data["row"])) {
                        foreach ($detail_data["row"] as $d_key => $product_data) {
                            $inner_array = array();

                            $inner_array = $val;
                            $inner_array["product_sku_code"] = isset($product_data[2]) ? $product_data[2] : '';
                            $inner_array["product_sku_name"] = isset($product_data[3]) ? $product_data[3] : '';
                            $inner_array["unit"] = isset($product_data[4]) ? $product_data[4] : '';
                            $inner_array["quantity"] = isset($product_data[5]) ? $product_data[5] : '0';
                            $inner_array["qty_kgl"] = isset($product_data[6]) ? $product_data[6] : '0';
                            $inner_array["amount"] = isset($product_data[7]) ? $product_data[7] : '0';
                            $inner_array["approved_quantity"] = isset($product_data[8]) ? $product_data[8] : '0';

                            $final_array[] = $inner_array;
                        }
                    }
                    else{
                        $inner_array = array();

                        $inner_array = $val;
                        $inner_array["product_sku_code"] =  '';
                        $inner_array["product_sku_name"] = '';
                        $inner_array["qty_kgl"] = '0';
                        $inner_array["quantity"]='0';
                        $inner_array["unit"] = '';
                        $inner_array["amount"] = '0';
                        $inner_array["approved_quantity"] = '0';


                        $final_array[] = $inner_array;
                    }
                }
               // testdata($final_array );


                if ($radio_checked == "farmer") {

                    $order_view['head'] = array('Sr. No.', 'Farmer Name', 'Retailer Name', 'Order Tracking No.','Product SKU Code','Product SKU Name','Unit','Quantity','Qty.kg/ltr', 'Entered By', 'Read');
                } elseif ($radio_checked == "retailer") {

                    $order_view['head'] = array('Sr. No.', 'Retailer Code', 'Retailer Name', 'Distributor Name', 'Order Date', 'PO NO.', 'Order Tracking No.', 'EDD','Product SKU Code','Product SKU Name','Unit','Quantity','Qty.kg/ltr', 'Amount','Approved Quantity', 'Entered By', 'Status');

                } elseif ($radio_checked == "distributor") {

                    $order_view['head'] = array('Sr. No.', 'Distributor Code', 'Distributor Name', 'Order Date', 'PO NO.', 'Order Tracking No.', 'EDD','Product SKU Code','Product SKU Name','Unit','Quantity','Qty.kg/ltr', 'Amount','Approved Quantity', 'Entered By', 'Status');

                }

                $i = 1;

                foreach ($final_array as $od) {

                    if ($od['order_status'] == 0) {
                        $order_status = "Pending";
                    }
                    elseif ($od['order_status'] == 1) {
                        $order_status = "Dispatched";
                    }
                    elseif ($od['order_status'] == 2) {
                        $order_status = "";
                    }
                    elseif ($od['order_status'] == 3) {
                        $order_status = "Rejected";
                    }
                    elseif ($od['order_status'] == 4) {
                        $order_status = "OP_Ackno";
                    }

                    if ($radio_checked == "farmer")
                    {

                        if ($od['read_status'] == 0) {
                            $read_status = "Unread";
                        } else {
                            $read_status = "Read";
                        }

                        $order_view['row'][] = array($i, $od['f_dn'] , $od['t_dn'], $od['order_tracking_no'], $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'], $od['qty_kgl'],$od['display_name'], $read_status);

                    }
                    elseif ($radio_checked == "retailer") {
                        if ($od['read_status'] == 0) {
                            $read_status = "Unread";
                        }
                        else {
                            $read_status = "Read";
                        }
                        if($local_date != null){
                            $date = strtotime($od['order_date']);
                            $order_date = date($local_date,$date);

                            $time= strtotime($od['created_on']);
                            $t= date('g:i a',$time);

                            $order_datetime = $order_date.' '.$t;
                        }
                        else{
                            $order_datetime = $od['order_date'];
                        }

                        $order_view['row'][] = array($i, $od['f_uc'],$od['f_dn'], $od['t_dn'], $order_datetime, $od["PO_no"], $od['order_tracking_no'], $od["estimated_delivery_date"], $od["product_sku_code"], $od["product_sku_name"], $od["unit"], $od["quantity"], $od["qty_kgl"], $od["amount"], $od["approved_quantity"], $od['display_name'], $read_status);

                    }
                    elseif ($radio_checked == "distributor") {
                        if($local_date != null){
                            $date = strtotime($od['order_date']);
                            $order_date = date($local_date,$date);

                            $time= strtotime($od['created_on']);
                            $t= date('g:i a',$time);

                            $order_datetime = $order_date.' '.$t;

                            if(!empty($od["estimated_delivery_date"]))
                            {
                                $date1 = strtotime($od["estimated_delivery_date"]);
                                $estimated_date =  date($local_date,$date1);
                            }
                            else{

                                $estimated_date = '';
                            }

                        }
                        else{
                            $order_datetime = $od['order_date'];
                            $estimated_date = $od["estimated_delivery_date"] ;
                        }

                        $order_view['row'][] = array($i,  $od['f_uc'],$od['f_dn'], $order_datetime, $od["PO_no"], $od['order_tracking_no'], $estimated_date, $od["product_sku_code"], $od["product_sku_name"], $od["unit"], $od["quantity"], $od["qty_kgl"], $od["amount"], $od["approved_quantity"], $od['display_name'], $order_status);
                    }
                    $i++;
                }


            }
            else if ($loginusertype == 9) {

                //FOR DISTRIBUTOR
                $final_array=array();

                foreach($orderdata['result'] as $k => $val)
                {

                    $detail_data = $this->order_status_product_details_view_by_id($val['order_id'],$radio_checked,$loginusertype,$page_function,null,'csv');

                    if(!empty($detail_data["row"])) {
                        foreach ($detail_data["row"] as $d_key => $product_data) {
                            $inner_array = array();

                            $inner_array = $val;
                            $inner_array["product_sku_code"] = isset($product_data[2]) ? $product_data[2] : '';
                            $inner_array["product_sku_name"] = isset($product_data[3]) ? $product_data[3] : '';
                            $inner_array["unit"] = isset($product_data[4]) ? $product_data[4] : '';
                            $inner_array["quantity"] = isset($product_data[5]) ? $product_data[5] : '0';
                            $inner_array["qty_kgl"] = isset($product_data[6]) ? $product_data[6] : '0';
                            $inner_array["amount"] = isset($product_data[7]) ? $product_data[7] : '0';
                            $inner_array["approved_quantity"] = isset($product_data[8]) ? $product_data[8] : '0';
                            $final_array[] = $inner_array;
                        }
                    }
                    else{
                        $inner_array = array();

                        $inner_array = $val;
                        $inner_array["product_sku_code"] =  '';
                        $inner_array["product_sku_name"] = '';
                        $inner_array["qty_kgl"] = '0';
                        $inner_array["quantity"]='0';
                        $inner_array["unit"] = '';
                        $inner_array["amount"] = '0';
                        $inner_array["approved_quantity"] = '0';

                        $final_array[] = $inner_array;
                    }
                }
               //testdata($final_array );
                if ($action_data != "po_acknowledgement") {

                    $order_view['head'] = array('Sr. No.', 'Order Date', 'PO No.', 'Order Tracking No.', 'EDD','Product SKU Code ','Product SKU Name','Unit','Quantity','Qty.kg/ltr','Amount', 'Approved Quantity', 'Entered By', 'Status');
                    $i = 1;

                    foreach ($final_array as $od) {

                        if ($od['order_status'] == 0) {
                            $order_status = "Pending";
                        } elseif ($od['order_status'] == 1) {
                            $order_status = "Dispatched";
                        } elseif ($od['order_status'] == 2) {
                            $order_status = "";
                        } elseif ($od['order_status'] == 3) {
                            $order_status = "Rejected";
                        } elseif ($od['order_status'] == 4) {
                            $order_status = "OP_Ackno";
                        }


                        if($local_date != null){
                            $date = strtotime($od['order_date']);
                            $order_date = date($local_date,$date);

                            $time= strtotime($od['created_on']);
                            $t= date('g:i a',$time);

                            $order_datetime = $order_date.' '.$t;

                            if(!empty($od["estimated_delivery_date"]))
                            {
                                $date1 = strtotime($od["estimated_delivery_date"]);
                                $estimated_date =  date($local_date,$date1);
                            }
                            else{
                                $estimated_date = '';
                            }
                        }
                        else{
                            $order_datetime = $od['order_date'];
                            $estimated_date = $od["estimated_delivery_date"] ;
                        }
                        $order_view['row'][] = array($i, $order_datetime, $od['PO_no'] , $od['order_tracking_no'] , $estimated_date,$od['product_sku_code'],$od['product_sku_name'],$od['unit'],$od['quantity'],$od['qty_kgl'],$od['amount'],$od['approved_quantity'], $od['display_name'], $order_status);
                        $i++;
                    }

                } else {


                    //FOR PO ACKNOWLEDGEMENT PAGE LAYOUT CREATED HERE

                    $order_view['head'] = array('Sr. No.', 'Order Date', 'Order Tracking No.','Product SKU Code ','Product SKU Name','Unit','Quantity','Qty.kg/ltr', 'Entered By', 'Enter PO No.');

                    $i = 1;

                    foreach ($final_array as $od) {

                        if($local_date != null){
                            $date = strtotime($od['order_date']);
                            $order_date = date($local_date,$date);

                            $time= strtotime($od['created_on']);
                            $t= date('g:i a',$time);

                            $order_datetime = $order_date.' '.$t;
                        }
                        else{
                            $order_datetime = $od['order_date'];
                        }
                        $order_view['row'][] = array($i,$order_datetime, $od['order_tracking_no'],$od['product_sku_code'],$od['product_sku_name'],$od['unit'],$od['quantity'],$od['qty_kgl'], $od['display_name'], $od['PO_no']);
                        $i++;
                    }
                }

            }
            else if ($loginusertype == 10) {

                //FOR RETAILER

                $final_array=array();
                foreach($orderdata['result'] as $k => $val)
                {
                    $detail_data = $this->order_status_product_details_view_by_id($val['order_id'],$radio_checked,$loginusertype,$page_function,null,'csv');

                    if(!empty($detail_data["row"])) {
                        foreach ($detail_data["row"] as $d_key => $product_data) {
                            $inner_array = array();

                            $inner_array = $val;
                            $inner_array["product_sku_code"] = isset($product_data[2]) ? $product_data[2] : '';
                            $inner_array["product_sku_name"] = isset($product_data[3]) ? $product_data[3] : '';
                            $inner_array["unit"] = isset($product_data[4]) ? $product_data[4] : '';
                            $inner_array["quantity"] = isset($product_data[5]) ? $product_data[5] : '0';
                            $inner_array["qty_kgl"] = isset($product_data[6]) ? $product_data[6] : '0';
                            $inner_array["amount"] = isset($product_data[7]) ? $product_data[7] : '0';
                            $final_array[] = $inner_array;
                        }
                    }
                    else{
                        $inner_array = array();

                        $inner_array = $val;
                        $inner_array["product_sku_code"] =  '';
                        $inner_array["product_sku_name"] = '';
                        $inner_array["qty_kgl"] = '0';
                        $inner_array["quantity"]='0';
                        $inner_array["unit"] = '';
                        $inner_array["amount"] = '0';

                        $final_array[] = $inner_array;
                    }
                }
                 //testdata($final_array );

                if ($action_data != "po_acknowledgement") {

                    $order_view['head'] = array('Sr. No.', 'Distributor Name', 'Order Date', 'PO No.', 'Order Tracking No.', 'EDD','Product SKU Code','Product SKU Name','Unit','Quantity','Qty. kg/ltr','Amount', 'Entered By', 'Status');

                    $i = 1;

                    foreach ($final_array as $od) {

                        if ($od['read_status'] == 0) {
                            $order_status = "Unread";
                        } elseif ($od['read_status'] == 1) {
                            $order_status = "Read";
                        }

                        if($local_date != null){
                            $date = strtotime($od['order_date']);
                            $order_date = date($local_date,$date);

                            $time= strtotime($od['created_on']);
                            $t= date('g:i a',$time);

                            $order_datetime = $order_date.' '.$t;

                            $date1 = strtotime($od["estimated_delivery_date"]);
                            $estimated_date =  date($local_date,$date1);

                        }
                        else{
                            $order_datetime = $od['order_date'];
                            $estimated_date = $od["estimated_delivery_date"] ;
                        }
                        $order_view['row'][] = array($i, $od['t_dn'],$order_datetime, $od['PO_no'] , $od['order_tracking_no'],$estimated_date, $od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'], $od['qty_kgl'], $od['amount'], $od['display_name'], $order_status);
                        $i++;
                    }

                }
                else {

                    $order_view['head'] = array('Sr. No.', 'Order Date', 'Order Tracking No.', 'Distributor','Product SKU Code','Product SKU Name','Unit','Quantity','Qty. kg/ltr', 'Entered By', 'Enter PO No.');
                    $i = 1;

                    foreach ($final_array as $od) {

                        if($local_date != null){
                            $date = strtotime($od['order_date']);
                            $order_date = date($local_date,$date);

                            $time= strtotime($od['created_on']);
                            $t= date('g:i a',$time);

                            $order_datetime = $order_date.' '.$t;
                        }
                        else{
                            $order_datetime = $od['order_date'];
                        }
                        $order_view['row'][] = array($i,$order_datetime, $od['order_tracking_no'], $od['f_dn'],$od['product_sku_code'], $od['product_sku_name'], $od['unit'], $od['quantity'], $od['qty_kgl'],  $od['display_name'], $od['PO_no']);
                        $i++;
                    }
                }
            }
         //  testdata($order_view);
            return $order_view;
        }
        else{
            return false;
        }

    }

}