<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Web_service controller
 */
class Web_service extends Front_Controller
{
    protected $permissionCreate = 'Web_service.Web_service.Create';
    protected $permissionDelete = 'Web_service.Web_service.Delete';
    protected $permissionEdit = 'Web_service.Web_service.Edit';
    protected $permissionView = 'Web_service.Web_service.View';

    /**
     * Constructor
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // Load Assets
        Assets::add_module_js('web_service', 'web_service.js');

        // Load Libraries
        $this->load->library('users/auth');
        $this->load->library('form_validation');
        // Load Models
        $this->load->model('users/user_model');
        $this->load->model('ishop/ishop_model');

        $this->load->model('country_master/country_master_model');
		$this->load->model('esp/esp_model');
		$this->load->model('ecp/ecp_model');
        // Load Languages
        $this->lang->load('web_service');
        // Load Others
        /*$check_session = $this->check_active_session();
        if($check_session!==false){
            echo json_encode($check_session);
            exit;
        }*/
    }

    /**
     * Display a list of Web Services data.
     * @return void
     */
    public function index()
    {
        Template::render();
    }

    public function check_active_session()
    {
        $bypass_mothods = array('signin', 'check_licence_no');
        $current_method = $this->router->fetch_method();

        if (!in_array($current_method, $bypass_mothods)) {
            $user_id = $this->input->get_post('user_id');
            $unq_no = $this->input->get_post('unq_no');

            if ((isset($user_id) && trim($user_id) != '') && (isset($unq_no) && trim($unq_no) != '')) {
                $user_info = $this->user_model->get_user_info($user_id);
                if (!empty($user_info) && isset($user_info['unq_no']) && trim($user_info['unq_no']) != '') {
                    if (trim($unq_no) != trim($user_info['unq_no'])) {
                        $result['status'] = 'logout';
                        $result['message'] = 'Due to login from another device you are logged out from current device';
                        $result['data'] = '';
                        return $result;
                    }
                }
            }
        }
        return false;
    }

    public function set_language()
    {
        $default_language = 'english';
        $user_id = $this->input->get_post('user_id');
        if (isset($user_id) && trim($user_id) != '') {
            $user_info = $this->user_model->get_user_info($user_id);
            if (!empty($user_info) && isset($user_info['language']) && trim($user_info['language']) != '') {
                $default_language = trim($user_info['language']);
            }
        }
        $this->session->set_userdata('site_lang', $default_language);
    }

    /**
     * @ Function Name        : getPrimarySalesInvoices
     * @ Function Params    : form_date,to_date,by_distributor,by_invoice_no (POST)
     * @ Function Purpose    : Get Primary Sales Invoice Data
     * */
    public function getPrimarySalesInvoices2()
    {
        $user_id = $this->input->get_post('user_id');
        $form_date = $this->input->get_post('form_date');
        $to_date = $this->input->get_post('to_date');
        $by_distributor = $this->input->get_post('by_distributor');
        $by_invoice_no = $this->input->get_post('by_invoice_no');

        if(isset($user_id))
        {
            $primary_sales_details = $this->ishop_model->get_primary_details_view($form_date, $to_date, $by_distributor, $by_invoice_no,'web_service');
            if(!empty($primary_sales_details))
            {
                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = $primary_sales_details;
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $result['total_rows'] = $total_rows;
                // For Pagination
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getPrimarySalesProductDetails
     * @ Function Params    : primary_sales_id (POST)
     * @ Function Purpose    : Get Primary Sales Product Details Data
     * */
    public function getPrimarySalesProductDetails2()
    {
        $user_id = $this->input->get_post('user_id');
        $primary_sales_id = $this->input->get_post('primary_sales_id');

        if(isset($user_id) && !empty($user_id) && isset($primary_sales_id) && !empty($primary_sales_id))
        {
            $primary_sales_product_details = $this->ishop_model->primary_sales_product_details_view_by_id($primary_sales_id,'web_service');
            if(!empty($primary_sales_product_details))
            {
                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = $primary_sales_product_details;
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }




    /**
     * @ Function Name      : login
     * @ Function Params    : email, password (POST)
     * @ Function Purpose   : User Login
     * */
    public function login()
    {
        $login = $this->input->post('email');
        $password = $this->input->post('password');

        if (trim($login) == '' || trim($password) == '') {
            $result['status'] = false;
            $result['message'] = 'Please Provide Required Data.';
            $result['data'] = '';
        } else {
            if ($info = (isset($login, $password) && true === $this->auth->login($login, $password))) {
                $this->db->select('*');
                $this->db->from('users');
                $this->db->where('email', $login);
                $this->db->where('deleted', 0);
                $this->db->where('banned', 0);
                $this->db->where('active', 1);
                $c_data = $this->db->get();
                $code_data = $c_data->row_array();

                if (!empty($code_data))
                {
                    $data[] = array('user_id' => $code_data['id'],
                                    'display_name' => $code_data['display_name'],
                                    'email' => $code_data['email'],
                                    'color' => $code_data['color'],
                                    'language' => $code_data['language'],
                                    'role_id' => $code_data['role_id'],
                                    'bussinescode' => $code_data['bussiness_code'],
                                    'country_id' => $code_data['country_id']
                                    );

                    $id = $code_data['id'];
                    $user_id = $id;

                    /*GET Contact Number*/
                    /*$this->db->select('*');
                    $this->db->from('bf_user_meta');
                    $this->db->where('user_id', $id);
                    $this->db->where('meta_key', 'contact');
                    $res = $this->db->get()->row_array();
                    $data[0]['contact'] = $res['meta_value'];*/

                    $result['status'] = true;
                    $result['message'] = 'Login Successfully';
                    $result['data'] = $data;
                } else {
                    $result['status'] = false;
                    $result['message'] = 'You have no access!';
                    $result['data'] = '';
                }
            } else {
                $this->db->select('*');
                $this->db->from('users');
                $this->db->where('email', $login);
                $c_data1 = $this->db->get();
                $code_data1 = $c_data1->row_array();
                if (isset($code_data1) && !empty($code_data1)) {
                    if ($code_data1['active'] == 0) {
                        $result['status'] = false;
                        $result['message'] = lang('error_inactive');
                        $result['data'] = '';
                    } else {
                        if (isset($attempt) && $attempt >= 3) {

                            $update_data['active'] = 0;
                            $res = $this->user_model->update($code_data1['id'], $update_data);
                            if ($res == true) {
                                $result['status'] = false;
                                $result['message'] = lang('error_inactive');
                                $result['data'] = '';
                            }

                        } else {
                            $result['status'] = false;
                            $result['message'] = 'E-Mail Or Password Incorrect';
                            $result['data'] = '';
                        }
                    }
                } else {
                    $result['status'] = false;
                    $result['message'] = 'E-Mail Or Password Incorrect';
                    $result['data'] = '';
                }
            }
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : get_global_info
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get all user information by user_id
     * */
    public function get_global_info()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && isset($country_id) && !empty($user_id) && !empty($country_id))
        {
            $distributors = $this->ishop_model->get_distributor_by_user_id($country_id);
            $retailers = $this->ishop_model->get_retailer_by_distributor_id($user_id, $country_id);

            $product_skus = $this->ishop_model->get_product_sku_by_user_id($country_id);
            $materials = $this->ecp_model->get_materials_by_country_id($country_id);
            $compititor = $this->ecp_model->get_all_copititor_data($country_id);
            $reason=$this->ecp_model->all_reason_noworking_details($country_id);
            $leave_type=$this->ecp_model->all_leave_type_details($country_id);

            $dist_array = array();
            if (!empty($distributors)) {
                foreach ($distributors as $distributor) {
                    $dist = array(
                        "id" => $distributor['id'],
                        "display_name" => $distributor['display_name'],
                    );
                    array_push($dist_array, $dist);
                }
            }

            $ret_array = array();
            if (!empty($retailers)) {
                foreach ($retailers as $retailer) {
                    $ret = array(
                        "id" => $retailer['id'],
                        "display_name" => $retailer['display_name'],
                    );
                    array_push($ret_array, $ret);
                }
            }

            $sku_array = array();
            if (!empty($product_skus)) {
                foreach ($product_skus as $product_sku) {
                    $sku = array(
                        "id" => $product_sku['product_sku_country_id'],
                        "product_sku_name" => $product_sku['product_sku_name'],
                        "product_sku_code" => $product_sku['product_sku_code'],
                        "product_type_label_name" => trim($product_sku['product_type_label_name']),
                    );
                    array_push($sku_array, $sku);
                }
            }

            $units = array(
                array("name"=>"Box","value"=>"box"),
                array("name"=>"Packages","value"=>"packages"),
                array("name"=>"Kg/Ltr","value"=>"kg/ltr")
            );

            $status = array(
                array("name"=>"Pending","value"=>"0"),
                array("name"=>"Approved","value"=>"1"),
                array("name"=>"Rejected","value"=>"2")
            );

            $mtl_array = array();
            if (!empty($materials)) {
                foreach ($materials as $material) {
                    $mtl = array(
                        "id" => $material['promotional_country_id'],
                        "material_name" => $material['promotional_material_country_name'],
                        "material_code" => $material['promotional_material_country_code'],
                    );
                    array_push($mtl_array, $mtl);
                }
            }


            $comp_array = array();
            if (!empty($compititor)) {
                foreach ($compititor as $compititors) {
                    $comp = array(
                        "id" => $compititors['compititor_id'],
                        "compititor_name" => $compititors['compititor_name'],
                    );
                    array_push($comp_array, $comp);
                }
            }

            $reason_array = array();
            if (!empty($reason)) {
                foreach ($reason as $reasons) {
                    $reason = array(
                        "id" => $reasons['reason_country_id'],
                        "reason_name" => $reasons['reason_country_name'],
                    );
                    array_push($reason_array, $reason);
                }
            }

            $leave_type_array = array();
            if (!empty($leave_type)) {
                foreach ($leave_type as $leave_types) {
                    $leave_type = array(
                        "id" => $leave_types['leave_type_country_id'],
                        "short_code" => $leave_types['short_code'],
                    );
                    array_push($leave_type_array, $leave_type);
                }
            }


            $data = array("distributors" => $dist_array,"retailers" =>$ret_array, "products_skus" => $sku_array, "units" => $units,"materials" => $mtl_array,"compititor" =>$comp_array,"reasons" => $reason_array,"leave_type" =>$leave_type_array ,"status" =>$status);
        //  testdata($data);
            $result['status'] = true;
            $result['message'] = 'Success';
            $result['data'] = $data;
        }
		elseif(isset($user_id) && !empty($user_id)) {
			
			//FOR GETTING USER LEVEL DATA
			
			$user_data = modules::run('esp/esp/get_user_level_data', $user_id);
			
            if(!empty($user_data))
            {
                $result['status'] = true;
                $result['message'] = 'Successfull';
				$result['data'] = $user_data;
				
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No data found';
				$result['data'] = array();
            }
			
			
		}
		elseif(isset($country_id) && !empty($country_id)) {
			
			//FOR GETTING PBG DATA
			
			$pbg_data = $this->esp_model->get_pbg_data($country_id);
			
            if(!empty($pbg_data))
            {
                $result['status'] = true;
                $result['message'] = 'Successfull';
				$result['data'] = $pbg_data;
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No data found';
				$result['data'] = array();
            }
			
		}
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }




    /* ---------------------------------------------- HO --------------------------------------------------- */

    public function checkInvoiceByCustomerPrimarySales()
    {
        $invoice_no = $this->input->get_post('invoice_no');
        $customer_id = $this->input->get_post('customer_id');

        if(!empty($invoice_no) && !empty($customer_id))
        {
            $check= $this->ishop_model->check_duplicate_data_for_primary_sales($customer_id,$invoice_no);
           // testdata($check);
            if($check == 1)
            {
                $result['status'] = false;
                $result['message'] = "Invoice Number already Assign!";
            }
            elseif($check == 2){
                $checks= $this->ishop_model->get_data_primary_sales_by_invoice_no($invoice_no,$customer_id);
                if(!empty($checks))
                {

                    $final_array = array();

                    $primary_sales_id = $checks['primary_sales_id'];
                    $check1= $this->ishop_model->get_data_primary_sales_product_by_invoice($primary_sales_id);
                    if(!empty($check1))
                    {
                        $checks["details"]=$check1;
                    }
                    else{
                        $checks["details"]=array();
                    }
                    $final_array[] = $checks;

                    $result['status'] = true;
                    $result['message'] = "";
                    $result['data'] = $final_array;
                }
                else{
                    $result['status'] = true;
                    $result['message'] = "";
                }

            }
            else{
                $result['status'] = true;
                $result['message'] = "";
            }
        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function checkInvoicePrimarySales()
    {
        $invoice_no = $this->input->get_post('invoice_no');

        if(!empty($invoice_no))
        {
            $checks= $this->ishop_model->get_data_primary_sales_by_invoice_no($invoice_no,'');

            if(!empty($checks))
            {
                $final_array = array();

                $primary_sales_id = $checks['primary_sales_id'];
                $check1= $this->ishop_model->get_data_primary_sales_product_by_invoice($primary_sales_id);
                if(!empty($check1))
                {
                    $checks["details"]=$check1;
                }
                else{
                    $checks["details"]=array();
                }
                $final_array[] = $checks;

               $result['status'] = true;
               $result['message'] = "";
               $result['data'] = $final_array;
            }
            else{
                $result['status'] = true;
                $result['message'] = "";
            }
        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function checkInvoiceByCustomerSecondarySales()
    {
        $invoice_no = $this->input->get_post('invoice_no');
        $customer_id = $this->input->get_post('customer_id');
        $user_id = $this->input->get_post('user_id');

        if(!empty($invoice_no) && !empty($customer_id) && !empty($user_id))
        {
            $check= $this->ishop_model->check_duplicate_data_for_secondary_sales($customer_id,$invoice_no,$user_id);
            // testdata($check);
            if($check == 1)
            {
                $result['status'] = false;
                $result['message'] = "Invoice Number already Assign!";
            }
            elseif($check == 2){
                $checks=  $this->ishop_model->get_data_secondary_sales_by_invoice_no($invoice_no,$user_id,$customer_id);
                if(!empty($checks))
                {

                    $final_array = array();

                    $secondary_sales_id = $checks['secondary_sales_id'];
                    $check1= $this->ishop_model->get_data_secondary_sales_product_by_invoice($secondary_sales_id);
                    if(!empty($check1))
                    {
                        $checks["details"]=$check1;
                    }
                    else{
                        $checks["details"]=array();
                    }
                    $final_array[] = $checks;

                    $result['status'] = true;
                    $result['message'] = "";
                    $result['data'] = $final_array;

                }
                else{
                    $result['status'] = true;
                    $result['message'] = "";
                }

            }
            else{
                $result['status'] = true;
                $result['message'] = "";
            }
        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function checkInvoiceSecondarySales()
    {
        $invoice_no = $this->input->get_post('invoice_no');
        $user_id = $this->input->get_post('user_id');

        if(!empty($invoice_no) && !empty($user_id))
        {
            $checks=  $this->ishop_model->get_data_secondary_sales_by_invoice_no($invoice_no,$user_id,'');
            if(!empty($checks))
            {

                $final_array = array();

                $secondary_sales_id = $checks['secondary_sales_id'];
                $check1= $this->ishop_model->get_data_secondary_sales_product_by_invoice($secondary_sales_id);
                if(!empty($check1))
                {
                    $checks["details"]=$check1;
                }
                else{
                    $checks["details"]=array();
                }
                $final_array[] = $checks;

                $result['status'] = true;
                $result['message'] = "";
                $result['data'] = $final_array;

            }
            else{
                $result['status'] = true;
                $result['message'] = "";
            }

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }
    /**
     * @ Function Name        : savePrimarySales
     * @ Function Params    : user_id,distributor_id,invoice_no,invoice_date,order_tracking_no,PO_no,product_sku_id,quantity,dispatched_quantity,amount,country_id (POST)
     * @ Function Purpose    : Save Primary Sales Data
     * */
    public function savePrimarySales()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->add_primary_sales_details($user_id,$country_id,'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getPrimarySalesProductDetailsMix
     * @ Function Params    : primary_sales_id (POST)
     * @ Function Purpose    : Get Primary Sales Invoice and Product Details Data
     * */
    public function getPrimarySalesInvoices()
    {
        $user_id = $this->input->get_post('user_id');
        $form_date = $this->input->get_post('form_date');
        $to_date = $this->input->get_post('to_date');
        $by_distributor = $this->input->get_post('by_distributor');
        $by_invoice_no = $this->input->get_post('by_invoice_no');

        if(isset($user_id))
        {
            //$local_date = $this->country_master_model->get_local_date_dy_id($user_id);

            $primary_sales_details = $this->ishop_model->get_primary_details_view($form_date, $to_date, $by_distributor, $by_invoice_no,'web_service');
          //  testdata($primary_sales_details);
            if(!empty($primary_sales_details))
            {
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination

                $final_array = array();
                foreach($primary_sales_details as $k => $psd)
                {
                    $primary_sales_id = $psd['primary_sales_id'];
                    $primary_sales_product_details = $this->ishop_model->primary_sales_product_details_view_by_id($primary_sales_id,'web_service');
                    $psd["details"]=$primary_sales_product_details;
                    $final_array[] = $psd;
                }
                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = $final_array;
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getOrderApproval
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function getOrderApproval()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');

        $form_date = $this->input->get_post('form_date');
        $to_date = $this->input->get_post('to_date');
        $by_otn = $this->input->get_post('by_otn');
        $by_po_no = $this->input->get_post('by_po_no');
        $order_status = $this->input->get_post('order_status'); // dispatched,pending,reject,op_ackno,all
        $page_function = 'order_approval';

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id) && !empty($order_status) && isset($order_status))
        {
            $order_data = $this->ishop_model->get_order_data($role_id,$country_id,null,$user_id,$user_id,$form_date,$to_date,$by_otn,$by_po_no,null,$page_function,$order_status,'web_service');

            $order_array = array();
            if (!empty($order_data)) {

                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination

                foreach ($order_data as $order)
                {
                    if($order['order_status'] == 0)
                    {
                        $order_status = "Pending";
                    }
                    elseif($order['order_status'] == 1)
                    {
                        $order_status = "Dispatched";
                    }
                    elseif($order['order_status'] == 3)
                    {
                        $order_status = "Rejected";
                    }
                    elseif($order['order_status'] == 4)
                    {
                        $order_status = "op_ackno";
                    }

                    $order_details = $this->ishop_model->order_status_product_details_view_by_id($order['order_id'],null,$role_id,$page_function,'web_service');

                    $ord = array(
                        "id" => $order['order_id'],
                        "distributor_code" => $order['f_u_code'],
                        "distributor_name" => $order['f_dn'],
                        "po_no" => $order['PO_no'],
                        "order_tracking_no" => $order['order_tracking_no'],
                        "credit_limit" => $order['credit_limit'],
                        "amount" => $order['total_amount'],
                        "order_status" => $order_status,
                        "details" => !empty($order_details) ? $order_details : array()
                    );
                    array_push($order_array, $ord);
                }
            }


            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = !empty($order_array) ? $order_array : array();
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function get_distributor_by_retailer()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        if(isset($user_id) && isset($country_id) && !empty($user_id) && !empty($country_id))
        {
            $distributors= $this->ishop_model->get_distributor_by_retailer($country_id,$user_id,'web_service');
            $dist_array=array();
            if (!empty($distributors)) {
                foreach ($distributors as $distributor) {

                    $dist = array(
                        "id" => $distributor['id'],
                        "display_name" => $distributor['display_name'],
                    );
                    array_push($dist_array, $dist);
                }
            }
            $data = array("distributors" => $dist_array);
            $result['status'] = true;
            $result['message'] = 'Success';
            $result['data'] = $data;
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function addPONumber(){

        $order_id = $this->input->get_post('order_id');
        $po_numdata = $this->input->get_post('po_data');

        if(isset($order_id) && isset($po_numdata) && !empty($order_id) && !empty($po_numdata))
        {

            $po_data_status = $this->ishop_model->update_po_data($order_id,$po_numdata,'web_service');

            if($po_data_status=='1'){
                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = '';
                $this->do_json($result);
            }
        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
            $this->do_json($result);
        }


    }

    /**
     * @ Function Name        : getOrderStatus
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function getOrderStatus()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');

        $form_date = $this->input->get_post('form_date');
        $to_date = $this->input->get_post('to_date');
        $customer_id = $this->input->get_post('customer_id');
        $order_tracking_no = $this->input->get_post('otn');
        $check_type = $this->input->get_post('check_type');
        $page_function = 'order_status';

        if(isset($check_type) && !empty($check_type)){
            $radio = $check_type;
        }
        else{
            $radio = null;
        }

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id))
        {
            if(isset($order_tracking_no) && !empty($order_tracking_no)){
              //  testdata('in');
                $order_data = $this->ishop_model->get_order_data($role_id,$country_id,$radio,$user_id,null,null,null,$order_tracking_no,null,null,$page_function,null,'web_service');
            }
            else{
                $order_data = $this->ishop_model->get_order_data($role_id,$country_id,$radio,$user_id,$customer_id,$form_date,$to_date,null,null,null,$page_function,null,'web_service');
            }
;
            $order_array = array();
            if (!empty($order_data)) {

                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination


                foreach ($order_data as $order)
                {
                    if($order['order_status'] == 0)
                    {
                        $order_status = "Pending";
                    }
                    elseif($order['order_status'] == 1)
                    {
                        $order_status = "Dispatched";
                    }
                    elseif($order['order_status'] == 3)
                    {
                        $order_status = "Rejected";
                    }
                    elseif($order['order_status'] == 4)
                    {
                        $order_status = "op_ackno";
                    }

                    if($order['read_status']==0)
                    {
                       $read_status='Unread';
                    }
                    else{
                        $read_status='Read';
                    }



                    $order_details = $this->ishop_model->order_status_product_details_view_by_id($order['order_id'],null,$role_id,$page_function,'web_service');

                    if($role_id == 7){
                        if($radio == 'retailer')
                        {
                            $ord = array(
                                "id" => $order['order_id'],
                                "distributor_name" => $order['t_dn'],
                                "entered_by" => $order['display_name'],
                                "po_no" => $order['PO_no'],
                                "order_tracking_no" => $order['order_tracking_no'],
                                "order_date" => $order['order_date'],
                                "edd" => $order['estimated_delivery_date'],
                                "amount" => $order['total_amount'],
                                "order_status" => $read_status,
                                "details" => !empty($order_details) ? $order_details : array()
                            );
                        }
                        if($radio == 'distributor')
                        {
                            $ord = array(
                                "id" => $order['order_id'],
                                "entered_by" => $order['display_name'],
                                "po_no" => $order['PO_no'],
                                "order_tracking_no" => $order['order_tracking_no'],
                                "order_date" => $order['order_date'],
                                "edd" => $order['estimated_delivery_date'],
                                "amount" => $order['total_amount'],
                                "order_status" => $order_status,
                                "details" => !empty($order_details) ? $order_details : array()
                            );
                        }
                    }

                    if($role_id == 8)
                    {
                        if($radio == 'farmer')
                        {
                            $ord = array(
                                "id" => $order['order_id'],
                                "farmer_name" => $order['f_dn'],
                                "retailer_name" => $order['t_dn'],
                                "order_tracking_no" => $order['order_tracking_no'],
                                "entered_by" => $order['display_name'],
                                "read_status" => $read_status,
                                "details" => !empty($order_details) ? $order_details : array()
                            );
                        }
                        if($radio == 'retailer')
                        {
                            $ord = array(
                                "id" => $order['order_id'],
                                "distributor_name" => $order['t_dn'],
                                "entered_by" => $order['display_name'],
                                "po_no" => $order['PO_no'],
                                "order_tracking_no" => $order['order_tracking_no'],
                                "order_date" => $order['order_date'],
                                "edd" => $order['estimated_delivery_date'],
                                "amount" => $order['total_amount'],
                                "order_status" => $read_status,
                                "details" => !empty($order_details) ? $order_details : array()
                            );
                        }
                        if($radio == 'distributor')
                        {
                            $ord = array(
                                "id" => $order['order_id'],
                                "entered_by" => $order['display_name'],
                                "po_no" => $order['PO_no'],
                                "order_tracking_no" => $order['order_tracking_no'],
                                "order_date" => $order['order_date'],
                                "edd" => $order['estimated_delivery_date'],
                                "amount" => $order['total_amount'],
                                "order_status" => $order_status,
                                "details" => !empty($order_details) ? $order_details : array()
                            );
                        }
                    }
                    if($role_id == 9)
                    {
                        $ord = array(
                            "id" => $order['order_id'],
                            "entered_by" => $order['display_name'],
                            "po_no" => $order['PO_no'],
                            "order_tracking_no" => $order['order_tracking_no'],
                            "order_date" => $order['order_date'],
                            "edd" => $order['estimated_delivery_date'],
                            "amount" => $order['total_amount'],
                            "order_status" => $order_status,
                            "details" => !empty($order_details) ? $order_details : array()
                        );
                    }
                    if($role_id == 10)
                    {
                        $ord = array(
                            "id" => $order['order_id'],
                            "distributor_name" => $order['t_dn'],
                            "entered_by" => $order['display_name'],
                            "po_no" => $order['PO_no'],
                            "order_tracking_no" => $order['order_tracking_no'],
                            "order_date" => $order['order_date'],
                            "edd" => $order['estimated_delivery_date'],
                            "amount" => $order['total_amount'],
                            "order_status" => $read_status,
                            "details" => !empty($order_details) ? $order_details : array()
                        );
                    }
                    array_push($order_array, $ord);
                }
            }

            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = !empty($order_array) ? $order_array : array();
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function getPOAcknowledgment()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id) &&( isset($role_id) && !empty($role_id)) )
        {
            $page_function = 'po_acknowledgement';
            $order_data = $this->ishop_model->get_order_data($role_id,$country_id,null,$user_id,$user_id,null,null,null,null,null,$page_function,null,'web_service');
           // testdata($order_data);
            $order_array = array();
            if (!empty($order_data)) {

                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination

                foreach ($order_data as $order)
                {

                    $order_details = $this->ishop_model->order_status_product_details_view_by_id($order['order_id'],null,$role_id,$page_function,'web_service');
                    if($role_id == 9)
                    {
                        $ord = array(
                            "id" => $order['order_id'],
                            "entered_by" => $order['display_name'],
                            "po_no" => $order['PO_no'],
                            "order_tracking_no" => $order['order_tracking_no'],
                            "order_date" => $order['order_date'],
                            "details" => !empty($order_details) ? $order_details : array()
                        );
                    }
                    else{
                        $ord = array(
                            "id" => $order['order_id'],
                            "entered_by" => $order['display_name'],
                            "po_no" => $order['PO_no'],
                            "order_tracking_no" => $order['order_tracking_no'],
                            "distributor"=>$order['t_dn'],
                            "order_date" => $order['order_date'],
                            "details" => !empty($order_details) ? $order_details : array()
                        );
                    }

                    array_push($order_array, $ord);
                }
            }
            //testdata($order_array);
            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = !empty($order_array) ? $order_array : array();
        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function savePOAcknowledgment()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id)) {

            $id= $this->ishop_model->update_order_data($this->input->post(),'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }

   /* public function  savePOAcknowledgmentdetail()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id)) {

            $id= $this->ishop_model->update_order_detail_data($this->input->post(),'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }*/

    /**
     * @ Function Name        : getRol
     * @ Function Params    : user_id,country_id,role_id,radio_type (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function getRol()
    {
        $action_data = 'set_rol';
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        $radio_type = $this->input->get_post('radio_type'); // farmer,retailer,distributor

        if(isset($user_id) && !empty($user_id)
            && isset($country_id) && !empty($country_id)
            && isset($role_id) && !empty($role_id)
            && isset($radio_type) && !empty($radio_type)
        )
        {
            // Role Check
            if($radio_type == "farmer"){
                $default_type = 11;
            }
            else if($radio_type == "retailer"){
                $default_type = 10;
            }
            else if($radio_type == "distributor"){
                $default_type = 9;
            }

            //Get Data
            $final_array = array();
            if($default_type == 10)
            {
                $geolevels3 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,null,$default_type,$action_data);
                if(!empty($geolevels3))
                {
                    foreach($geolevels3 as $k3 => $geolevel3)
                    {
                        $g3 = array(
                            "id"=>$geolevel3['political_geo_id'],
                            "political_geography_name"=>$geolevel3['political_geography_name'],
                        );
                        $final_array[] = $g3; // Add Geo Level 3 Into Final Array
                        $parent_geo_id3 = $geolevel3['political_geo_id'];
                        $geolevels2 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,$parent_geo_id3,$default_type,$action_data);
                        if(!empty($geolevels2))
                        {
                            foreach ($geolevels2 as $k2 => $geolevel2)
                            {
                                $g2 = array(
                                    "id"=>$geolevel2['political_geo_id'],
                                    "political_geography_name"=>$geolevel2['political_geography_name'],
                                );
                                $final_array[$k3]['geolevel2'][] = $g2; // Add Geo Level 2 Into Final Array
                                $parent_geo_id2 = $geolevel2['political_geo_id'];
                                $retailers_names = $this->ishop_model->get_user_for_geo_data($parent_geo_id2, $country_id, $radio_type, null);
                                $retailers_names = json_decode($retailers_names, true);
                                if(!empty($retailers_names))
                                {
                                    foreach ($retailers_names as $k1 => $retailers_name)
                                    {
                                        $final_array[$k3]['geolevel2'][$k2]['retailers'][] = $retailers_name; // Add Geo Level 1 Into Final Array
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else if($default_type == 9)
            {
                $geolevels3 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,null,$default_type,$action_data);
                if(!empty($geolevels3))
                {
                    foreach($geolevels3 as $k3 => $geolevel3)
                    {
                        $g3 = array(
                            "id"=>$geolevel3['political_geo_id'],
                            "political_geography_name"=>$geolevel3['political_geography_name'],
                        );
                        $final_array[] = $g3; // Add Geo Level 3 Into Final Array
                        $parent_geo_id3 = $geolevel3['political_geo_id'];
                        $distibutors_names = $this->ishop_model->get_user_for_geo_data($parent_geo_id3, $country_id, $radio_type, null);
                        $distibutors_names = json_decode($distibutors_names, true);
                        if(!empty($distibutors_names))
                        {
                            foreach ($distibutors_names as $k1 => $distibutors_name)
                            {
                                $final_array[$k3]['distributors'][] = $distibutors_name; // Add Geo Level 1 Into Final Array
                            }
                        }
                    }
                }
            }

            // Get ROL Data
            $rol = $this->ishop_model->get_all_rol_by_user($user_id,$country_id,$role_id,$radio_type,'web_service');

            if(!empty($rol))
            {
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination
            }

            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = array("dp_data"=>$final_array,"rol_data"=>!empty($rol) ? $rol : array());
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function getSlaes()
    {
        $action_data = 'ishop_sales';
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        $radio_type = $this->input->get_post('radio_type'); // farmer,retailer,distributor

        if(isset($user_id) && !empty($user_id)
            && isset($country_id) && !empty($country_id)
            && isset($role_id) && !empty($role_id)
            && isset($radio_type) && !empty($radio_type)
        )
        {
            // Role Check
            if($radio_type == "retailer"){
                $default_type = 10;
            }
            else if($radio_type == "distributor"){
                $default_type = 9;
            }

            //Get Data
            $final_array = array();
            if($default_type == 10)
            {
                $geolevels3 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,null,$default_type,$action_data);
                if(!empty($geolevels3))
                {
                    foreach($geolevels3 as $k3 => $geolevel3)
                    {
                        $g3 = array(
                            "id"=>$geolevel3['political_geo_id'],
                            "political_geography_name"=>$geolevel3['political_geography_name'],
                        );
                        $final_array[] = $g3; // Add Geo Level 3 Into Final Array
                        $parent_geo_id3 = $geolevel3['political_geo_id'];
                        $geolevels2 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,$parent_geo_id3,$default_type,$action_data);
                        if(!empty($geolevels2))
                        {
                            foreach ($geolevels2 as $k2 => $geolevel2)
                            {
                                $g2 = array(
                                    "id"=>$geolevel2['political_geo_id'],
                                    "political_geography_name"=>$geolevel2['political_geography_name'],
                                );
                                $final_array[$k3]['geolevel2'][] = $g2; // Add Geo Level 2 Into Final Array
                                $parent_geo_id2 = $geolevel2['political_geo_id'];
                                $retailers_names = $this->ishop_model->get_user_for_geo_data($parent_geo_id2, $country_id, $radio_type, null);
                                $retailers_names = json_decode($retailers_names, true);
                                if(!empty($retailers_names))
                                {
                                    foreach ($retailers_names as $k1 => $retailers_name)
                                    {
                                        $final_array[$k3]['geolevel2'][$k2]['retailers'][] = $retailers_name; // Add Geo Level 1 Into Final Array
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else if($default_type == 9)
            {
                $geolevels3 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,null,$default_type,$action_data);
                if(!empty($geolevels3))
                {
                    foreach($geolevels3 as $k3 => $geolevel3)
                    {
                        $g3 = array(
                            "id"=>$geolevel3['political_geo_id'],
                            "political_geography_name"=>$geolevel3['political_geography_name'],
                        );
                        $final_array[] = $g3; // Add Geo Level 3 Into Final Array
                        $parent_geo_id3 = $geolevel3['political_geo_id'];
                        $distibutors_names = $this->ishop_model->get_user_for_geo_data($parent_geo_id3, $country_id, $radio_type, null);
                        $distibutors_names = json_decode($distibutors_names, true);
                        if(!empty($distibutors_names))
                        {
                            foreach ($distibutors_names as $k1 => $distibutors_name)
                            {

                                $dist = array(
                                    "id"=>$distibutors_name['id'],
                                    "display_name"=>$distibutors_name['display_name'],
                                );
                                $final_array[$k3]['distributors'][] = $dist; // Add Geo Level 1 Into Final Array
                                //$final_array[$k3]['distributors'][] = $distibutors_name; // Add Geo Level 1 Into Final Array
                                $distibutor_id = $distibutors_name['id'];

                               $retailers = $this->ishop_model->get_retailer_by_distributor_id($distibutor_id,$country_id);

                              //  dumpme($retailers);

                                $retailer_array = array();

                                if(!empty($retailers))
                                {
                                    foreach ($retailers as $k0 => $retailer)
                                    {
                                        $ret = array(
                                            "id"=>$retailer['id'],
                                            "display_name"=>$retailer['display_name'],
                                        );

                                        $retailer_array[] = $ret;
                                        // Add Geo Level 0 Into Final Array

                                    }
                                    $final_array[$k3]['distributors'][$k1]['retailer'] = $retailer_array;
                                }

                            }
                        }
                    }
                }

            }
            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = array("dp_data"=>$final_array);
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getTarget
     * @ Function Params    : form_date,to_date,by_distributor,by_invoice_no (POST)
     * @ Function Purpose    : Get Primary Sales Invoice Data
     * */
    public function getTarget()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        $checked_type = $this->input->get_post('checked_type');

        if(isset($user_id))
        {
            $target_data = $this->ishop_model->get_target_details($user_id,$country_id,$checked_type,null,'web_service');
            if(!empty($target_data))
            {
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination

                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = $target_data;
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getBudget
     * @ Function Params    : form_date,to_date,by_distributor,by_invoice_no (POST)
     * @ Function Purpose    : Get Primary Sales Invoice Data
     * */
    public function getBudget()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        $checked_type = $this->input->get_post('checked_type');

        if(isset($user_id))
        {
            $budget_data = $this->ishop_model->get_budget_details($user_id,$country_id,$checked_type,null,'web_service');
            if(!empty($budget_data))
            {
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination

                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = $budget_data;
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : viewSchemes
     * @ Function Params    : user_id,country_id,role_id,year,region,territory (POST)
     * @ Function Purpose    : Get Credit Limit Data
     * */
    public function viewSchemes()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        $year = $this->input->get_post("year");
        $retailer = $this->input->get_post("fo_retailer_id");
        $region = $this->input->get_post("region");
        $territory = $this->input->get_post("territory");

        if(isset($user_id) && !empty($user_id)  && isset($country_id) && !empty($country_id) && isset($role_id) && !empty($role_id))
        {
           if($role_id == 7)
           {
               if( isset($year) && !empty($year))
               {
                   $scheme_view = $this->ishop_model->view_schemes_detail($user_id,$country_id,$year,$region,$territory,$role_id,$retailer,null,'web_service');
                   if(!empty($scheme_view))
                   {
                       // For Pagination
                       $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                       $total_rows = $count->result()[0]->total_rows;
                       $pages = $total_rows/10;
                       $pages = ceil($pages);
                       $result['total_rows'] = $total_rows;
                       $result['pages'] = $pages;
                       // For Pagination
                   }
                   $result['status'] = true;
                   $result['message'] = 'Retrieved Successfully.';
                   $result['data'] = !empty($scheme_view) ? $scheme_view : array();
               }
               else
               {
                   $result['status'] = false;
                   $result['message'] = "All Fields are Required.";
               }
           }
            elseif($role_id == 10){
                if( isset($year) && !empty($year))
                {
                    $scheme_view = $this->ishop_model->view_schemes_detail($user_id,$country_id,$year,'','',$role_id,'',null,'web_service');
                    if(!empty($scheme_view))
                    {
                        // For Pagination
                        $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                        $total_rows = $count->result()[0]->total_rows;
                        $pages = $total_rows/10;
                        $pages = ceil($pages);
                        $result['total_rows'] = $total_rows;
                        $result['pages'] = $pages;
                        // For Pagination
                    }
                    $result['status'] = true;
                    $result['message'] = 'Retrieved Successfully.';
                    $result['data'] = !empty($scheme_view) ? $scheme_view : array();
                }
                else
                {
                    $result['status'] = false;
                    $result['message'] = "All Fields are Required.";
                }
            }
            elseif($role_id == 8){
                if( isset($year) && !empty($year) && isset($territory) && !empty($territory))
                {
                   // testdata('in');
                    $scheme_view = $this->ishop_model->view_schemes_detail($user_id,$country_id,$year,'',$territory,$role_id,$retailer,null,'web_service');

                    if(!empty($scheme_view))
                    {
                        // For Pagination
                        $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                        $total_rows = $count->result()[0]->total_rows;
                        $pages = $total_rows/10;
                        $pages = ceil($pages);
                        $result['total_rows'] = $total_rows;
                        $result['pages'] = $pages;
                        // For Pagination
                    }
                    $result['status'] = true;
                    $result['message'] = 'Retrieved Successfully.';
                    $result['data'] = !empty($scheme_view) ? $scheme_view : array();
                }
                else
                {
                    $result['status'] = false;
                    $result['message'] = "All Fields are Required.";
                }
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getCompanyCurrentStock
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function getCompanyCurrentStock()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id))
        {
            $current_stock = $this->ishop_model->get_all_company_current_stock($country_id,'web_service');
            if(!empty($current_stock))
            {
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination
            }
            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = !empty($current_stock) ? $current_stock : array();
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getCreditLimit
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get Credit Limit Data
     * */
    public function getCreditLimit()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $credit_limit= $this->ishop_model->get_all_distributors_credit_limit($country_id,'web_service');
            if(!empty($credit_limit))
            {
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination
            }
            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = !empty($credit_limit) ? $credit_limit : array();
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : editPrimarySalesInvoice
     * @ Function Params    : user_id,country_id,primary_sales_detail,invoice_no,PO_no,order_tracking_no,primary_sales_product_detail,quantity,dispatched_quantity,amount (POST)
     * @ Function Purpose    : Edit Primary Sales Invoice
     * */
    public function editPrimarySalesInvoice()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $update_sales_details = $this->ishop_model->update_sales_detail($user_id,$country_id,'web_service');
            if(!empty($update_sales_details))
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : deletePrimarySalesInvoice
     * @ Function Params    : user_id,country_id,primary_sales_detail,invoice_no,PO_no,order_tracking_no,primary_sales_product_detail,quantity,dispatched_quantity,amount (POST)
     * @ Function Purpose    : Edit Primary Sales Invoice
     * */
    public function deleteData()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $mode = $this->input->get_post('mode');
        $id = $this->input->get_post('id');
        $checked_type = $this->input->get_post('checked_type');

        if(isset($user_id) && !empty($user_id) && isset($id) && !empty($id) && isset($mode) && !empty($mode))
        {
            if($mode == "sales_invoice")
            {
                $id = $this->ishop_model->delete_sales_detail($id);
            }
            elseif($mode == "sales_invoice_product")
            {
                $id = $this->ishop_model->delete_sales_product_detail($id);
            }
            elseif($mode == "rol")
            {
                $id = $this->ishop_model->delete_rol_limit_detail($id);
            }
            elseif($mode == "secondary_sales")
            {
                $id = $this->ishop_model->delete_secondary_sales_detail($id);
            }
            elseif($mode == "secondary_sales_product")
            {
                $id = $this->ishop_model->delete_secondary_sales_product_detail($id);
            }
            elseif($mode == "physical_stock")
            {
                $id = $this->ishop_model->delete_physical_stock_details($id);
            }
            elseif($mode == "schemes")
            {
                $id = $this->ishop_model->delete_schemes_by_id($id);
            }
            elseif($mode == "order")
            {
                $id = $this->ishop_model->delete_order_detail_data($id);
            }
            elseif($mode == "budget"){
                $id = $this->ishop_model->delete_budget_detail($id);
            }
            elseif($mode == "target"){
                $id = $this->ishop_model->delete_target_detail($id);
            }
            elseif($mode == "ishop_sales"){
                $id = $this->ishop_model->delete_ishop_sales_detail($id, $checked_type);
            }
            elseif($mode == "ishop_sales_product"){
                $id = $this->ishop_model->delete_ishop_sales_product_detail($id, $checked_type);
            }
            elseif($mode == "current_stock"){

                $id = $this->ishop_model->delete_current_stock_detail($id);
            }
            elseif($mode == "material_request"){

                $id = $this->ecp_model->delete_material_detail($id);
            }
            elseif($mode == "no_working"){

                $id = $this->ecp_model->delete_no_working_detail($id);
            }
            elseif($mode == "leave"){

                $id = $this->ecp_model->delete_leave_detail($id);
            }

            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Deleted Successfully ('.$mode.')';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Something Went Wrong.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : saveRol
     * @ Function Params    : user_id,country_id,prod_sku,unit,rol_qty,fo_retailer_id,distributor_rol (POST)
     * @ Function Purpose    : Save ROL Data
     * */
    public function saveRol()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->add_rol_detail($user_id,$country_id,null,null);
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : editRol
     * @ Function Params    : user_id,country_id,prod_sku,unit,rol_qty,fo_retailer_id,distributor_rol (POST)
     * @ Function Purpose    : Save ROL Data
     * */
    public function editRol()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->update_rol_limit_detail($user_id,$country_id,'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : saveCompanyCurrentStock
     * @ Function Params    : user_id,country_id,prod_sku,unit,rol_qty,fo_retailer_id,distributor_rol (POST)
     * @ Function Purpose    : Save ROL Data
     * */
    public function saveCompanyCurrentStock()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->add_company_current_stock_detail($user_id,$country_id);
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : editCompanyCurrentStock
     * @ Function Params    : user_id,country_id,prod_sku,unit,rol_qty,fo_retailer_id,distributor_rol (POST)
     * @ Function Purpose    : Save ROL Data
     * */
    public function editCompanyCurrentStock()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->update_current_stock_details($user_id,$country_id,'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : saveCreditLimit
     * @ Function Params    : user_id,country_id,dist_limit,credit_limit,curr_outstanding,curr_date (POST)
     * @ Function Purpose    : Save Credit Limit Data
     * */
    public function saveCreditLimit()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->add_user_credit_limit_datail($user_id,$country_id);
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : saveSchemes
     * @ Function Params    : user_id,country_id,dist_limit,credit_limit,curr_outstanding,curr_date (POST)
     * @ Function Purpose    : Save Credit Limit Data
     * */
    public function saveSchemes()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->add_schemes_detail($user_id,$country_id);
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getSchemes
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get Credit Limit Data
     * */
    public function getSchemes()
    {
        $default_retailer_role = 10;
        $year = $this->input->get_post('year');
        $user_id = $this->input->get_post('user_id');
        $logined_user_role = $this->input->get_post('role_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && !empty($user_id) && isset($year) && !empty($year) && isset($logined_user_role) && !empty($logined_user_role)
            && isset($country_id) && !empty($country_id))
        {
            if($logined_user_role == 7){
                //Get Data
                $final_array = array();
                $geolevels3 = $this->ishop_model->get_business_geo_data($user_id,$country_id,$default_retailer_role,null,$year,$logined_user_role);
                if(!empty($geolevels3))
                {
                    foreach($geolevels3 as $k3 => $geolevel3)
                    {
                        $g3 = array(
                            "id"=>$geolevel3['business_geo_id'],
                            "business_georaphy_name"=>$geolevel3['business_georaphy_name'],
                        );
                        $final_array[] = $g3; // Add Geo Level 3 Into Final Array
                        $parent_geo_id3 = $geolevel3['business_geo_id'];
                        $geolevels2 = $this->ishop_model->get_business_geo_data($user_id,$country_id,$default_retailer_role,$parent_geo_id3,$year,$logined_user_role);
                        if(!empty($geolevels2))
                        {
                            foreach ($geolevels2 as $k2 => $geolevel2)
                            {
                                $g2 = array(
                                    "id"=>$geolevel2['business_geo_id'],
                                    "business_georaphy_name"=>$geolevel2['business_georaphy_name'],
                                );
                                $final_array[$k3]['geolevel2'][] = $g2; // Add Geo Level 2 Into Final Array
                                $parent_geo_id2 = $geolevel2['business_geo_id'];
                                $retailers_names = $this->ishop_model->get_business_geo_data_to_retailer($parent_geo_id2,$country_id);
                                if(!empty($retailers_names))
                                {
                                    foreach ($retailers_names as $k1 => $retailers_name)
                                    {
                                        $final_array[$k3]['geolevel2'][$k2]['retailers'][] = $retailers_name; // Add Geo Level 1 Into Final Array
                                    }
                                }
                            }
                        }
                    }
                }

                $final_array2 = array();
                $schemes = $this->ishop_model->get_schemes_by_selected_year($year,$country_id);
                if(!empty($schemes))
                {
                    foreach($schemes as $k3 => $scheme)
                    {
                        $final_array2[] = $scheme; // Add Geo Level 3 Into Final Array2
                        $scheme_id = $scheme['scheme_id'];
                        $get_slabs = $this->ishop_model->get_slab_by_selected_scheme_id($scheme_id,'web_service');
                        if(!empty($get_slabs))
                        {
                            foreach ($get_slabs as $k2 => $get_slab)
                            {
                                $final_array2[$k3]['slabs'][] = $get_slab; // Add Geo Level 2 Into Final Array2
                            }
                        }
                        else
                        {
                            $final_array2[$k3]['slabs'] = array();
                        }
                    }
                }

                $result['status'] = true;
                $result['message'] = 'Retrieved Successfully.';
                $result['data'] = array(
                    "geo_data" => !empty($final_array) ? $final_array : array(),
                    "schema_data" => !empty($final_array2) ? $final_array2 : array()
                );
            }
            elseif($logined_user_role == 8)
            {
                $final_array = array();
                $geolevels3 = $this->ishop_model->get_business_geo_data($user_id,$country_id,$default_retailer_role,null,$year,$logined_user_role);

                if(!empty($geolevels3))
                {
                    foreach($geolevels3 as $k3 => $geolevel3)
                    {
                        $g3 = array(
                            "id"=>$geolevel3['business_geo_id'],
                            "business_georaphy_name"=>$geolevel3['business_georaphy_name'],
                        );
                        $final_array[] = $g3; // Add Geo Level 3 Into Final Array
                        $parent_geo_id3 = $geolevel3['business_geo_id'];

                        $retailers_names = $this->ishop_model->get_business_geo_data_to_retailer($parent_geo_id3,$country_id);
                                if(!empty($retailers_names))
                                {
                                    foreach ($retailers_names as $k1 => $retailers_name)
                                    {
                                        $final_array[$k3]['retailers'][] = $retailers_name; // Add Geo Level 1 Into Final Array
                                    }
                                }
                    }
                }
                $result['status'] = true;
                $result['message'] = 'Retrieved Successfully.';
                $result['data'] = array(
                    "geo_data" => !empty($final_array) ? $final_array : array(),
                );
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : saveOrderApproval
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function saveOrderApproval()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id))
        {
            $id = $this->ishop_model->update_order_detail_data($this->input->post(),'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : saveOrderStatus
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function saveOrderStatus()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id))
        {
            $id = $this->ishop_model->update_order_data($this->input->post(),'web_service');

            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function get_pending_count()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id))
        {
            $pending_count=$this->ishop_model->get_all_pending_data($user_id,$country_id);

            $result['status'] = true;
            $result['message'] = '';
            $result['data'] = array('count'=>$pending_count);
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : saveOrderPlace
     * @ Function Params    : user_id,distributor_id,retailer_id,invoice_no,invoice_date,order_tracking_no,PO_no,product_sku_id,quantity,dispatched_quantity,amount,country_id (POST)
     * @ Function Purpose    : Save Primary Sales Data
     * */
    public function saveOrderPlace()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->add_order_place_details($user_id,$country_id,'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getConversion
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function getConversion()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $skuid = $this->input->get_post('sku_id');
        $quantity_data = $this->input->get_post('quantity');
        $unit_data = $this->input->get_post('unit');

        if(isset($user_id) && !empty($user_id)
            && isset($country_id) && !empty($country_id)
            && !empty($skuid) && isset($skuid)
            && !empty($quantity_data) && isset($quantity_data)
            && !empty($unit_data) && isset($unit_data)
        )
        {
            $conversion = $this->ishop_model->get_product_conversion_data($skuid,$quantity_data,$unit_data);

            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = !empty($conversion) ? $conversion : "";
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : copyTarget
     * @ Function Params    : user_id,country_id,popup_page(target,budget) (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function copyTarget()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && !empty($user_id))
        {
            $copy = $this->ishop_model->copy_data($this->input->post(),$user_id,'web_service');

            $result['status'] = true;
            $result['message'] = 'Copied Successfully.';
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getAllOrdersCount
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function getAllOrdersCount()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id))
        {
            $pending_orders = $this->db->where('country_id',$country_id)->where('order_status',0)->count_all_results('bf_ishop_orders');
            $dispatched_orders = $this->db->where('country_id',$country_id)->where('order_status',1)->count_all_results('bf_ishop_orders');
            $rejected_orders = $this->db->where('country_id',$country_id)->where('order_status',3)->count_all_results('bf_ishop_orders');
            $op_ackno_orders = $this->db->where('country_id',$country_id)->where('order_status',4)->count_all_results('bf_ishop_orders');
            $all_orders = $this->db->where('country_id',$country_id)->count_all_results('bf_ishop_orders');

            $orders_count = array(
                "pending_orders" => ($pending_orders != 0) ? $pending_orders : "",
                "dispatched_orders" => ($dispatched_orders != 0) ? $dispatched_orders : "",
                "rejected_orders" => ($rejected_orders != 0) ? $rejected_orders : "",
                "op_ackno_orders" => ($op_ackno_orders != 0) ? $op_ackno_orders : "",
                "all_orders" => ($all_orders != 0) ? $all_orders : "",
            );

            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = !empty($orders_count) ? $orders_count : array();
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getRol
     * @ Function Params    : user_id,country_id,role_id,radio_type (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function getOrderPlace()
    {
        $action_data = 'set_rol';
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        $radio_type = $this->input->get_post('radio_type'); // farmer,retailer,distributor

        if(isset($user_id) && !empty($user_id)
            && isset($country_id) && !empty($country_id)
            && isset($role_id) && !empty($role_id)
            && isset($radio_type) && !empty($radio_type)
        )
        {
            // Role Check
            if($radio_type == "farmer"){
                $default_type = 11;
            }
            else if($radio_type == "retailer"){
                $default_type = 10;
            }
            else if($radio_type == "distributor"){
                $default_type = 9;
            }

            //Get Data
            $final_array = array();
            if($default_type == 10)
            {
                $geolevels3 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,null,$default_type,$action_data);
                if(!empty($geolevels3))
                {
                    foreach($geolevels3 as $k3 => $geolevel3)
                    {
                        $g3 = array(
                            "id"=>$geolevel3['political_geo_id'],
                            "political_geography_name"=>$geolevel3['political_geography_name'],
                        );
                        $final_array[] = $g3; // Add Geo Level 3 Into Final Array
                        $parent_geo_id3 = $geolevel3['political_geo_id'];
                        $geolevels2 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,$parent_geo_id3,$default_type,$action_data);
                        if(!empty($geolevels2))
                        {
                            foreach ($geolevels2 as $k2 => $geolevel2)
                            {
                                $g2 = array(
                                    "id"=>$geolevel2['political_geo_id'],
                                    "political_geography_name"=>$geolevel2['political_geography_name'],
                                );
                                $final_array[$k3]['geolevel2'][] = $g2; // Add Geo Level 2 Into Final Array
                                $parent_geo_id2 = $geolevel2['political_geo_id'];
                                $retailers_names = $this->ishop_model->get_user_for_geo_data($parent_geo_id2, $country_id, $radio_type, null);
                                $retailers_names = json_decode($retailers_names, true);
                                if(!empty($retailers_names))
                                {
                                    foreach ($retailers_names as $k1 => $retailers_name)
                                    {
                                        $ret = array(
                                            "id"=>$retailers_name['id'],
                                            "display_name"=>$retailers_name['display_name'],
                                        );
                                        $final_array[$k3]['geolevel2'][$k2]['retailers'][] = $ret; // Add Geo Level 1 Into Final Array
                                        $retailer_id = $retailers_name['id'];
                                        $distributors = $this->ishop_model->get_distributor_by_retailer($country_id,$retailer_id);
                                        $distributors = json_decode($distributors, true);
                                        if(!empty($distributors))
                                        {
                                            foreach ($distributors as $k0 => $distributor)
                                            {
                                                $dist = array(
                                                    "id"=>$distributor['id'],
                                                    "display_name"=>$distributor['display_name'],
                                                );
                                                $final_array[$k3]['geolevel2'][$k2]['retailers'][$k1]['distributors'][] = $dist; // Add Geo Level 0 Into Final Array
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else if($default_type == 9)
            {
                $geolevels3 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,null,$default_type,$action_data);
                if(!empty($geolevels3))
                {
                    foreach($geolevels3 as $k3 => $geolevel3)
                    {
                        $g3 = array(
                            "id"=>$geolevel3['political_geo_id'],
                            "political_geography_name"=>$geolevel3['political_geography_name'],
                        );
                        $final_array[] = $g3; // Add Geo Level 3 Into Final Array
                        $parent_geo_id3 = $geolevel3['political_geo_id'];
                        $distibutors_names = $this->ishop_model->get_user_for_geo_data($parent_geo_id3, $country_id, $radio_type, null);
                        $distibutors_names = json_decode($distibutors_names, true);
                        if(!empty($distibutors_names))
                        {
                            foreach ($distibutors_names as $k1 => $distibutors_name)
                            {
                                $final_array[$k3]['distributors'][] = $distibutors_name; // Add Geo Level 1 Into Final Array
                            }
                        }
                    }
                }
            }

            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = array("dp_data"=>$final_array);
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function getOrderPlaceforFO()
    {
        $action_data = 'order_place';
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        $radio_type = $this->input->get_post('radio_type'); // farmer,retailer,distributor

        if(isset($user_id) && !empty($user_id)
            && isset($country_id) && !empty($country_id)
            && isset($role_id) && !empty($role_id)
            && isset($radio_type) && !empty($radio_type)
        )
        {
            // Role Check
            if($radio_type == "farmer"){
                $default_type = 11;
            }
            else if($radio_type == "retailer"){
                $default_type = 10;
            }
            else if($radio_type == "distributor"){
                $default_type = 9;
            }

            //Get Data
            $final_array = array();
            if($default_type == 10)
            {
                $geolevels3 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,null,$default_type,$action_data);
                if(!empty($geolevels3))
                {
                    foreach($geolevels3 as $k3 => $geolevel3)
                    {
                        $g3 = array(
                            "id"=>$geolevel3['political_geo_id'],
                            "political_geography_name"=>$geolevel3['political_geography_name'],
                        );
                        $final_array[] = $g3; // Add Geo Level 3 Into Final Array
                        $parent_geo_id3 = $geolevel3['political_geo_id'];
                        $geolevels2 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,$parent_geo_id3,$default_type,$action_data);
                        if(!empty($geolevels2))
                        {
                            foreach ($geolevels2 as $k2 => $geolevel2)
                            {
                                $g2 = array(
                                    "id"=>$geolevel2['political_geo_id'],
                                    "political_geography_name"=>$geolevel2['political_geography_name'],
                                );
                                $final_array[$k3]['geolevel2'][] = $g2; // Add Geo Level 2 Into Final Array
                                $parent_geo_id2 = $geolevel2['political_geo_id'];
                                $retailers_names = $this->ishop_model->get_user_for_geo_data($parent_geo_id2, $country_id, $radio_type, null);
                                $retailers_names = json_decode($retailers_names, true);
                                if(!empty($retailers_names))
                                {
                                    foreach ($retailers_names as $k1 => $retailers_name)
                                    {
                                        $ret = array(
                                            "id"=>$retailers_name['id'],
                                            "display_name"=>$retailers_name['display_name'],
                                        );
                                        $final_array[$k3]['geolevel2'][$k2]['retailers'][] = $ret; // Add Geo Level 1 Into Final Array
                                        $retailer_id = $retailers_name['id'];
                                        $distributors = $this->ishop_model->get_distributor_by_retailer($country_id,$retailer_id);
                                        $distributors = json_decode($distributors, true);
                                        if(!empty($distributors))
                                        {
                                            foreach ($distributors as $k0 => $distributor)
                                            {
                                                $dist = array(
                                                    "id"=>$distributor['id'],
                                                    "display_name"=>$distributor['display_name'],
                                                );
                                                $final_array[$k3]['geolevel2'][$k2]['retailers'][$k1]['distributors'][] = $dist; // Add Geo Level 0 Into Final Array
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else if($default_type == 9)
            {
                $geolevels3 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,null,$default_type,$action_data);
              //testdata($geolevels3);
                if(!empty($geolevels3))
                {
                    foreach($geolevels3 as $k3 => $geolevel3)
                    {
                        $g3 = array(
                            "id"=>$geolevel3['political_geo_id'],
                            "political_geography_name"=>$geolevel3['political_geography_name'],
                        );
                        $final_array[] = $g3; // Add Geo Level 3 Into Final Array
                        $parent_geo_id3 = $geolevel3['political_geo_id'];

                        $geolevels2 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,$parent_geo_id3,$default_type,$action_data);
                        if(!empty($geolevels2))
                        {
                            foreach ($geolevels2 as $k2 => $geolevel2)
                            {
                                $g2 = array(
                                    "id"=>$geolevel2['political_geo_id'],
                                    "political_geography_name"=>$geolevel2['political_geography_name'],
                                );
                                $final_array[$k3]['geolevel2'][] = $g2; // Add Geo Level 2 Into Final Array
                                $parent_geo_id2 = $geolevel2['political_geo_id'];

                                $distibutors_names = $this->ishop_model->get_user_for_geo_data($parent_geo_id2, $country_id, $radio_type, null);
                                $distibutors_names = json_decode($distibutors_names, true);
                                if(!empty($distibutors_names))
                                {
                                    foreach ($distibutors_names as $k1 => $distibutors_name)
                                    {
                                        $final_array[$k3]['geolevel2'][$k2]['distributors'][] = $distibutors_name; // Add Geo Level 1 Into Final Array
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else if($default_type == 11)
            {
                $geolevels3 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,null,$default_type,$action_data);
                //testdata($geolevels3);
                if(!empty($geolevels3))
                {
                    foreach($geolevels3 as $k3 => $geolevel3)
                    {
                        $g3 = array(
                            "id"=>$geolevel3['political_geo_id'],
                            "political_geography_name"=>$geolevel3['political_geography_name'],
                        );
                        $final_array[] = $g3; // Add Geo Level 3 Into Final Array
                        $parent_geo_id3 = $geolevel3['political_geo_id'];

                        $geolevels2 = $this->ishop_model->get_employee_geo_data($user_id,$country_id,$role_id,$parent_geo_id3,$default_type,$action_data);
                        if(!empty($geolevels2))
                        {
                            foreach ($geolevels2 as $k2 => $geolevel2)
                            {
                                $g2 = array(
                                    "id"=>$geolevel2['political_geo_id'],
                                    "political_geography_name"=>$geolevel2['political_geography_name'],
                                );
                                $final_array[$k3]['geolevel2'][] = $g2; // Add Geo Level 2 Into Final Array
                                $parent_geo_id2 = $geolevel2['political_geo_id'];
                                $farmer_names = $this->ishop_model->get_user_for_geo_data($parent_geo_id2, $country_id, $radio_type, null);
                                $farmer_names = json_decode($farmer_names, true);
                                if(!empty($farmer_names))
                                {
                                    foreach ($farmer_names as $k1 => $farmer_name)
                                    {
                                        $ret = array(
                                            "id"=>$farmer_name['id'],
                                            "display_name"=>$farmer_name['display_name'],
                                        );
                                        $final_array[$k3]['geolevel2'][$k2]['farmers'][] = $ret; // Add Geo Level 1 Into Final Array
                                        $farmer_id = $farmer_name['id'];
                                        $retailers = $this->ishop_model->get_retailer_for_customer_data($farmer_id,'farmer',null);
                                        //testdata($retailers);
                                        $retailers = json_decode($retailers, true);
                                        if(!empty($retailers))
                                        {
                                            foreach ($retailers as $k0 => $retailer)
                                            {
                                                $dist = array(
                                                    "id"=>$retailer['id'],
                                                    "display_name"=>$retailer['display_name'],
                                                );
                                                $final_array[$k3]['geolevel2'][$k2]['farmers'][$k1]['retailers'][] = $dist; // Add Geo Level 0 Into Final Array
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = array("dp_data"=>$final_array);
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    /**
     * @ Function Name        : saveTarget
     * @ Function Params    : user_id,distributor_id,invoice_no,invoice_date,order_tracking_no,PO_no,product_sku_id,quantity,dispatched_quantity,amount,country_id (POST)
     * @ Function Purpose    : Save Primary Sales Data
     * */
    public function saveTarget()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id))
        {
            $id = $this->ishop_model->add_target_data($this->input->post(),$user_id,'web_service',$country_id);
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function getTargetbyDistributor()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id))
        {
            if(!empty($_POST['from_month_data']) && !empty($_POST['to_month_data'])){
                $target_data = $this->ishop_model->get_target_monthly_data($_POST,'web_service');
                $target_month_data = $this->ishop_model->get_monthly_data($_POST,'web_service');


                $target_month= array();
                if(isset($target_month_data) && !empty($target_month_data)) {
                    foreach ($target_month_data as $key => $value) {
                        $target_month[] = date("Y-M", strtotime($value)) . '(Kg/Ltr)';
                    }
                }

                //  testdata($target_month);

                $final_array = array();

                $final_array["target_data"]["month_data"] = array();
                $final_array["target_data"]["data"] = array();

                if(!empty($target_data) && !empty($target_month_data)){

                    $final_array["target_data"]["month_data"] = $target_month;

                    foreach($target_data as $target_key => $target_value){

                        $inner_array = array();
                        $product_detail_data = explode("-",$target_key);

                        $inner_array['id'] = $product_detail_data[0];
                        $inner_array['code'] = $product_detail_data[1];
                        $inner_array['name'] = $product_detail_data[2];

                        foreach($target_value as $data_key => $target_monthlydata){
                            $inner_array['detail'][] = $target_monthlydata;
                        }

                        $final_array["target_data"]["data"][] = $inner_array;

                    }
                }
                //testdata($final_array);

                $result['status'] = true;
                $result['message'] = 'Retrieved Successfully.';
                $result['data'] = $final_array;
            }
            else{
                $result['status'] = false;
                $result['message'] = "All Fields are Required.";
            }

        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }
    /**
     * @ Function Name        : saveBudget
     * @ Function Params    : user_id,distributor_id,invoice_no,invoice_date,order_tracking_no,PO_no,product_sku_id,quantity,dispatched_quantity,amount,country_id (POST)
     * @ Function Purpose    : Save Primary Sales Data
     * */
    public function saveBudget()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id))
        {
            $id = $this->ishop_model->add_budget_data($this->input->post(),$user_id,'web_service',$country_id);
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : editTarget
     * @ Function Params    : user_id,country_id,prod_sku,unit,rol_qty,fo_retailer_id,distributor_rol (POST)
     * @ Function Purpose    : Save ROL Data
     * */
    public function editTarget()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->update_target_detail($user_id,$country_id,'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : editBudget
     * @ Function Params    : user_id,country_id,prod_sku,unit,rol_qty,fo_retailer_id,distributor_rol (POST)
     * @ Function Purpose    : Save ROL Data
     * */
    public function editBudget()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->update_budget_detail($user_id,$country_id,'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : addUploadData
     * @ Function Params    : user_id,country_id,prod_sku,unit,rol_qty,fo_retailer_id,distributor_rol (POST)
     * @ Function Purpose    : Save ROL Data
     * */
    public function uploadData()
    {
        $file = fopen("api_req.txt","w");
        $param = json_encode($_GET);
        $param .= json_encode($_POST);
        $param .= json_encode($_REQUEST);
        $param .= json_encode($_FILES);
        fwrite($file,$param);
        fclose($file);
        $user_id = $this->input->get_post('user_id');
        $file_name = $this->input->get_post('file_name');
        if(isset($user_id)) {
            // testdata($_POST);
            $_POST['flag'] = 'web_service';
            $data = modules::run('ishop/ishop/upload_data', $_POST, $_FILES);

            if(isset($data['success']))
            {
                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = $data;
            }

            if(isset($data['error']))
            {
                $final_array = array();
                foreach ($data as $key_data => $xl_data) {

                    $final_array["header"][] = $xl_data['header'][1];
                    $initial_array = array();

                    foreach($xl_data as $xlkey => $formate_data){
                        if($xlkey !== 'header'){
                            $initial_array[]['key'] = $formate_data;
                        }
                    }
                    $final_array['error_data'] = $initial_array;
                }
                $result['status'] = true;
                $result['message'] = 'Success';
                $result = $final_array;

            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function create_xl_data()
    {

        if(isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['val']) && !empty($_POST['val']) && isset($_POST['dirname']) && !empty($_POST['dirname']))
        {
            $val_data = json_decode($_POST['val'],TRUE);
            $final_array = array();
            foreach($val_data as $key => $data){

                if($key == 'error_data') {
                    foreach($data as $inner_key => $inner_data) {
                        $final_array[] = $inner_data['key'];
                    }
                }

                if($key == 'header'){

                    $final_array["header"][1] = $data[0];

                }

            }
            $_POST['val'] = $final_array;
            $_POST['role_id'] = $_POST['role_id'];
            $_POST['flag'] = 'web_service';

            modules::run('ishop/ishop/create_data_xl', $_POST);

        }
    else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function add_xl_data()
    {
        $user_id = $_POST['user_id'];
        $country_id = $_POST['country_id'];
        $role_id = $_POST['role_id'];
        $dirname = $_POST["dirname"];
        $value = json_decode($_POST['val']);
        $xl_arr = $value->data->success;

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id) && isset($role_id) && !empty($role_id) && isset($xl_arr) && !empty($xl_arr) && isset($dirname) && !empty($dirname))
        {
            if($dirname == "target"){
                $target_data = $this->ishop_model->add_target_data($xl_arr,$user_id);
            }
            elseif($dirname == "budget"){
                $budget_data = $this->ishop_model->add_budget_data($xl_arr);
            }
            elseif($dirname == "company_current_stock"){

                $current_stock_data = $this->ishop_model->add_company_current_stock_detail($user_id,$country_id,$xl_arr,'excel');
            }
            elseif($dirname == "credit_limit"){

                $credit_limit_data = $this->ishop_model->add_user_credit_limit_datail($user_id,$country_id,$xl_arr,'excel');
            }
            elseif($dirname == "rol"){

                $rol_data = $this->ishop_model->add_rol_detail($user_id,$country_id,$xl_arr,'excel');
            }
            elseif($dirname == "primary_sales"){

                $primary_sales = $this->ishop_model->add_primary_sales_details($user_id,$country_id,$web_service = null,$xl_arr,'excel');
            }
            elseif($dirname == "secondary_sales"){
                if($role_id ==8)
                {
                    $secondary_sales = $this->ishop_model->add_ishop_sales_detail($user_id,$country_id,$xl_arr,'excel');
                }
                else{
                    $secondary_sales = $this->ishop_model->add_secondary_sales_details_data($user_id,$country_id,$xl_arr,'excel');
                }

            }
            elseif($dirname == "physical_stock"){

                $physical_stock = $this->ishop_model->add_physical_stock_detail($user_id,$country_id,$role_id,$xl_arr,'excel');
            }

            $result['status'] = true;
            $result['message'] = "Inserted Successfully.";

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : addUploadData
     * @ Function Params    : user_id,country_id,prod_sku,unit,rol_qty,fo_retailer_id,distributor_rol (POST)
     * @ Function Purpose    : Save ROL Data
     * */
  /*  public function downloadData()
    {
        $user_id = $this->input->get_post('user_id');
        if(isset($user_id))
        {
            $_POST['flag'] = 'web_service';
            $_POST['val'] = json_decode($_POST['val'],true);
            $_POST['val'] = array_pop($_POST['val']);
            modules::run('ishop/ishop/create_data_xl', $_POST);
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }*/


    /* ---------------------------------------------- DISTRIBUTOR --------------------------------------------------- */
    /**
     * @ Function Name        : saveSecondarySales
     * @ Function Params    : user_id,distributor_id,invoice_no,invoice_date,order_tracking_no,PO_no,product_sku_id,quantity,dispatched_quantity,amount,country_id (POST)
     * @ Function Purpose    : Save Primary Sales Data
     * */
    public function saveSecondarySales()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->add_secondary_sales_details_data($user_id,$country_id,null,null,'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getPrimarySalesInvoices
     * @ Function Params    : form_date,to_date,by_distributor,by_invoice_no (POST)
     * @ Function Purpose    : Get Primary Sales Invoice Data
     * */
    public function getSecondarySalesInvoices()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $form_date = $this->input->get_post('form_date');
        $to_date = $this->input->get_post('to_date');
        $by_retailer = $this->input->get_post('by_retailer');
        $by_invoice_no = $this->input->get_post('by_invoice_no');

        if(isset($user_id))
        {
            $secondary_sales_details = $this->ishop_model->secondary_sales_details_data_view($form_date, $to_date, $by_retailer, $by_invoice_no,$user_id,$country_id,null,null,null,null,null,null,'web_service');
            if(!empty($secondary_sales_details))
            {
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination

                $final_array = array();
                foreach($secondary_sales_details as $k => $ssd)
                {
                    $secondary_sales_id = $ssd['secondary_sales_id'];
                    $secondary_sales_product_details = $this->ishop_model->secondary_sales_product_details_view_by_id($secondary_sales_id,'web_service');
                    $ssd["details"]=$secondary_sales_product_details;
                    $final_array[] = $ssd;
                }
                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = $final_array;
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : editSecondarySalesInvoice
     * @ Function Params    : user_id,country_id,primary_sales_detail,invoice_no,PO_no,order_tracking_no,primary_sales_product_detail,quantity,dispatched_quantity,amount (POST)
     * @ Function Purpose    : Edit Primary Sales Invoice
     * */
    public function editSecondarySalesInvoice()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $update_sales_details = $this->ishop_model->update_secondary_sales_detail($user_id,$country_id,'web_service');
            if(!empty($update_sales_details))
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }



    public function getSalesInvoices()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $check_redio = $this->input->get_post('radio1');
        /*$form_date = date("Y-m-d", strtotime($this->input->get_post("form_date")));
        $to_date = date("Y-m-d", strtotime($this->input->get_post("to_date")));*/
        $retailer_id = $this->input->get_post('retailer_id');
        $by_invoice_no = $this->input->get_post('by_invoice_no');
        $distributor_id = $this->input->get_post('distributor_id');
        $to_month = date("Y-m", strtotime($this->input->get_post("to_month")));
        $from_month =  date("Y-m", strtotime($this->input->get_post("from_month")));

        $sales_view = 'sales_view';

        if(isset($user_id) && isset($check_redio))
        {
            if($check_redio == 'distributor'){
                $secondary_sales_details = $this->ishop_model->secondary_sales_details_data_view('', '', '', $by_invoice_no,$user_id,$country_id,$sales_view,$from_month,$to_month,null,$distributor_id,null,'web_service');
                if(!empty($secondary_sales_details))
                {

                    // For Pagination
                    $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                    $total_rows = $count->result()[0]->total_rows;
                    $pages = $total_rows/10;
                    $pages = ceil($pages);
                    $result['total_rows'] = $total_rows;
                    $result['pages'] = $pages;
                    // For Pagination

                    $final_array = array();
                    foreach($secondary_sales_details as $k => $ssd)
                    {
                        $secondary_sales_id = $ssd['secondary_sales_id'];
                        $secondary_sales_product_details = $this->ishop_model->secondary_sales_product_details_view_by_id($secondary_sales_id,'web_service');
                        $ssd["details"]=$secondary_sales_product_details;
                        $final_array[] = $ssd;
                    }
                    $result['status'] = true;
                    $result['message'] = 'Success';
                    $result['data'] = $final_array;
                }
                else
                {
                    $result['status'] = false;
                    $result['message'] = 'No Records Found.';
                }
            }

            elseif($check_redio == 'retailer'){

                $tertiary_sales_details = $this->ishop_model->view_ishop_sales_detail_by_retailer($user_id, $country_id, $from_month, $to_month,null,null, $retailer_id, $page = null,'web_service');
                if(!empty($tertiary_sales_details))
                {
                    // For Pagination
                    $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                    $total_rows = $count->result()[0]->total_rows;
                    $pages = $total_rows/10;
                    $pages = ceil($pages);
                    $result['total_rows'] = $total_rows;
                    $result['pages'] = $pages;
                    // For Pagination

                    $final_array = array();
                    foreach($tertiary_sales_details as $k => $tsd)
                    {
                        $tertiary_sales_id = $tsd['tertiary_sales_id'];
                        $tertiary_sales_product_details = $this->ishop_model->tertiary_sales_product_details_view_by_id($tertiary_sales_id,'web_service');

                        $tsd["details"]=$tertiary_sales_product_details;
                        $final_array[] = $tsd;
                    }
                    $result['status'] = true;
                    $result['message'] = 'Success';
                    $result['data'] = $final_array;
                }
                else
                {
                    $result['status'] = false;
                    $result['message'] = 'No Records Found.';
                }
            }
            else
            {
                $result['status'] = false;
                $result['message'] = "All Fields are Required.";
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function saveSalesInvoice()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->add_ishop_sales_detail($user_id,$country_id,null,null,'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function editSalesInvoice()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $update_sales_details = $this->ishop_model->update_ishop_sales_detail($user_id,$country_id,'web_service');
            if(!empty($update_sales_details))
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    /**
     * @ Function Name        : savePhysicalStock
     * @ Function Params    : user_id,distributor_id,invoice_no,invoice_date,order_tracking_no,PO_no,product_sku_id,quantity,dispatched_quantity,amount,country_id (POST)
     * @ Function Purpose    : Save Primary Sales Data
     * */
    public function savePhysicalStock()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->add_physical_stock_detail($user_id,$country_id,null,null,null);
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getPhysicalStock
     * @ Function Params    : form_date,to_date,by_distributor,by_invoice_no (POST)
     * @ Function Purpose    : Get Primary Sales Invoice Data
     * */
    public function getPhysicalStock()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');

        if(isset($user_id))
        {
            $physical_stock = $this->ishop_model->get_all_physical_stock_by_user($user_id,$country_id,$role_id,null,null,'web_service');
            if(!empty($physical_stock))
            {
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination

                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = $physical_stock;
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : editPhysicalStock
     * @ Function Params    : user_id,country_id,primary_sales_detail,invoice_no,PO_no,order_tracking_no,primary_sales_product_detail,quantity,dispatched_quantity,amount (POST)
     * @ Function Purpose    : Edit Primary Sales Invoice
     * */
    public function editPhysicalStock()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->update_physical_stock_detail($user_id,$country_id,'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Something Went Wrong.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getPerspectiveOrder
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function getPerspectiveOrder()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');

        $from_date = $this->input->get_post('from_date');
        $to_date = $this->input->get_post('to_date');

        if(isset($user_id) && !empty($user_id)
            && isset($country_id) && !empty($country_id)
            && !empty($from_date) && isset($from_date)
            && !empty($to_date) && isset($to_date)
        )
        {
            $prespective_order = $this->ishop_model->get_prespective_order($from_date,$to_date,$role_id,$user_id,null,'web_service');

            // For Pagination
            $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
            $total_rows = $count->result()[0]->total_rows;
            $pages = $total_rows/10;
            $pages = ceil($pages);
            $result['total_rows'] = $total_rows;
            $result['pages'] = $pages;
            // For Pagination

            $final_array = array();
            foreach($prespective_order as $k => $po)
            {
                $order_id = $po['order_id'];
                $prespective_order_details = $this->ishop_model->order_product_details_view_by_id($order_id,'web_service');
                $po["details"]=$prespective_order_details;
                $final_array[] = $po;
            }
            $result['status'] = true;
            $result['message'] = 'Success';
            $result['data'] = $final_array;

           /* $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = !empty($prespective_order) ? $prespective_order : array();*/
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function updatePerspectiveOrder()
    {
        $user_id = $this->input->get_post('user_id');
        $read_status = $this->input->get_post('read_status');
        $order_id = $this->input->get_post('order_id');

        if(isset($user_id)&& !empty($user_id) && isset($order_id) && !empty($order_id)){

            if($read_status == 1){
                $this->ishop_model->order_mark_as_read($order_id);
            }
            if($read_status == 0){
                $this->ishop_model->order_mark_as_unread($order_id);
            }
            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = '';
        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }

    /**
     * @ Function Name        : getInvoiceReceived
     * @ Function Params    : user_id,country_id (POST)
     * @ Function Purpose    : Get Rol and Drop Down Data
     * */
    public function getInvoiceReceived()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');

        $invoice_no = $this->input->get_post('invoice_no');
        $po_no = $this->input->get_post('po_no');
        $invoice_month = $this->input->get_post('month');

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id))
        {
            $invoice_received = $this->ishop_model->invoice_confirmation_received_by_distributor($invoice_month,$po_no,$invoice_no,$user_id,$country_id,null,'web_service');

            if(!empty($invoice_received))
            {
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows/10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination

                $final_array = array();
                foreach($invoice_received as $k => $ir)
                {
                    $primary_sales_id = $ir['primary_sales_id'];
                    $invoice_product = $this->ishop_model->invoice_sales_product_details($primary_sales_id,'web_service');
                    $ir["details"]=$invoice_product;
                    $final_array[] = $ir;
                }
            }
            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = !empty($final_array) ? $final_array : array();
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : confirmInvoiceReceived
     * @ Function Params    : user_id,country_id,primary_sales_detail,invoice_no,PO_no,order_tracking_no,primary_sales_product_detail,quantity,dispatched_quantity,amount (POST)
     * @ Function Purpose    : Edit Primary Sales Invoice
     * */

    public function confirmInvoiceReceived()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        $sales_id = $this->input->get_post('sales_id');

        if(isset($user_id))
        {
            $id = $this->ishop_model->update_invoice_confirmation_received_by_distributor($sales_id,$user_id,$country_id);
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Something Went Wrong.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    /*-------------------------------------------------ECP WEB SERVICE -------------------------------------------------*/

    public function getMaterialRequest()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if((isset($user_id) && !empty($user_id)) &&(isset($country_id) && !empty($country_id)) ) {
            $materials_request = $this->ecp_model->get_all_materials_by_country_id($country_id, null, $local_date = null, $web_service = 'web_service');

            if (!empty($materials_request)) {
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows / 10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination

                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = $materials_request;
            } else {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }


    public function saveMaterialRequest()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');

        if(isset($user_id)&& !empty($user_id))
        {
            $id = $this->ecp_model->add_material_request_detail($user_id,$country_id,'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function getCompititorRetailerAnalysis()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        if((isset($user_id)&& !empty($user_id)) &&(isset($country_id)&& !empty($country_id))) {
            $radio_checked='10';
            $final_array = array();
            $geo_level = $this->ecp_model->get_employee_geo_data($user_id, $country_id, $role_id, $parent_geo_id = null, $action_data = null,$radio_checked);
           // testdata($geo_level);
            if (!empty($geo_level))
            {
                foreach ($geo_level as $k2 => $geolevel2) {
                    $g2 = array(
                        "id" => $geolevel2['political_geo_id'],
                        "political_geography_name" => $geolevel2['political_geography_name'],
                    );
                    $final_array['geolevel2'][] = $g2; // Add Geo Level 2 Into Final Array
                    $parent_geo_id2 = $geolevel2['political_geo_id'];
                    $radio_type = 'retailer';
                    $retailers_names = $this->ishop_model->get_user_for_geo_data($parent_geo_id2, $country_id, $radio_type, null);
                    $retailers_names = json_decode($retailers_names, true);
                    if (!empty($retailers_names)) {
                        foreach ($retailers_names as $k1 => $retailers_name) {
                            $final_array['geolevel2'][$k2]['retailers'][] = $retailers_name; // Add Geo Level 1 Into Final Array
                        }
                    }
                }
            }
            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = array($final_array);
        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function saveTotalCompititorRetailerAnalysis()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        if((isset($user_id)&& !empty($user_id)) &&(isset($country_id)&& !empty($country_id))) {

            $insert=$this->ecp_model->add_retailer_compititor_details($user_id,$country_id,'web_service');
            if($insert==1){
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
                $result['data'] = '';
            }
            else{
                $result['status'] = false;
                $result['message'] = 'Fail';
            }

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }

    public function saveProductCompititorRetailerAnalysis()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        if((isset($user_id)&& !empty($user_id)) &&(isset($country_id)&& !empty($country_id))) {

                $insert=$this->ecp_model->add_retailer_compititor_product_details($user_id,$country_id,'web_service');
            if($insert==1){
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
                $result['data'] = '';
            }
            else{
                $result['status'] = false;
                $result['message'] = 'Fail';
            }

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }

    public function getCompititorDistributorAnalysis()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        if((isset($user_id)&& !empty($user_id)) &&(isset($country_id)&& !empty($country_id))) {
            $radio_checked='9';
            $final_array = array();
            $geo_level = $this->ecp_model->get_employee_geo_data($user_id, $country_id, $role_id, $parent_geo_id = null, $action_data = null,$radio_checked);
            // testdata($geo_level);
            if (!empty($geo_level))
            {
                foreach ($geo_level as $k2 => $geolevel2) {
                    $g2 = array(
                        "id" => $geolevel2['political_geo_id'],
                        "political_geography_name" => $geolevel2['political_geography_name'],
                    );
                    $final_array['geolevel2'][] = $g2; // Add Geo Level 2 Into Final Array
                    $parent_geo_id2 = $geolevel2['political_geo_id'];
                    $radio_type = 'distributor';
                    $distributors_names = $this->ishop_model->get_user_for_geo_data($parent_geo_id2, $country_id, $radio_type, null);
                    $distributors_names = json_decode($distributors_names, true);
                    if (!empty($distributors_names)) {
                        foreach ($distributors_names as $k1 => $distributors_name) {
                            $final_array['geolevel2'][$k2]['distributors'][] = $distributors_name; // Add Geo Level 1 Into Final Array
                        }
                    }
                }
            }
            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = array($final_array);
        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function saveTotalCompititorDistributorAnalysis()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        if((isset($user_id)&& !empty($user_id)) &&(isset($country_id)&& !empty($country_id))) {

            $insert=$this->ecp_model->add_distributor_compititor_details($user_id,$country_id,'web_service');
            if($insert==1){
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
                $result['data'] = '';
            }
            else{
                $result['status'] = false;
                $result['message'] = 'Fail';
            }

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }

    public function saveProductCompititorDistributorAnalysis()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        if((isset($user_id)&& !empty($user_id)) &&(isset($country_id)&& !empty($country_id))) {

            $insert=$this->ecp_model->add_distributor_compititor_product_details($user_id,$country_id,'web_service');
            if($insert==1){
                $result['status'] = true;
                $result['message'] = 'Saved Successfully.';
                $result['data'] = '';
            }
            else{
                $result['status'] = false;
                $result['message'] = 'Fail';
            }

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }

    public function getCompititorRetailer()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $radio = $this->input->get_post('radio');
        $from_month = $this->input->get_post('from_month');
        $to_month = $this->input->get_post('to_month');
        if((isset($user_id) && !empty($user_id)) && (isset($country_id) && !empty($country_id)) && (isset($radio) && !empty($radio)) && (isset($from_month) && !empty($from_month)) && (isset($to_month) && !empty($to_month)))
        {
            $retailer_compititor_details = array();
            if($radio == 'total'){
                $retailer_compititor_details = $this->ecp_model->get_retailer_compititor_details_view($from_month, $to_month,$page=null,$local_date=null,$country_id,'web_service');
            }
            elseif($radio == 'product'){
                $retailer_compititor_details = $this->ecp_model->get_retailer_compititor_product_details_view($from_month, $to_month,$page=null,$local_date=null,$country_id,'web_service');
            }
            // For Pagination
            $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
            $total_rows = $count->result()[0]->total_rows;
            $pages = $total_rows / 10;
            $pages = ceil($pages);
            $result['total_rows'] = $total_rows;
            $result['pages'] = $pages;
            // For Pagination

            $result['status'] = true;
            $result['message'] = 'Saved Successfully.';
            $result['data'] = $retailer_compititor_details;
        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }

    public function getCompititorDistributor()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $radio = $this->input->get_post('radio');
        $from_month = $this->input->get_post('from_month');
        $to_month = $this->input->get_post('to_month');
        if((isset($user_id) && !empty($user_id)) && (isset($country_id) && !empty($country_id)) && (isset($radio) && !empty($radio)) && (isset($from_month) && !empty($from_month)) && (isset($to_month) && !empty($to_month)))
        {
            $distributor_compititor_details = array();
            if($radio == 'total'){
                $distributor_compititor_details = $this->ecp_model->get_distributor_compititor_details_view($from_month, $to_month,$page=null,$local_date=null,$country_id,'web_service');
            }
            elseif($radio == 'product'){
                $distributor_compititor_details = $this->ecp_model->get_distributor_compititor_product_details_view($from_month, $to_month,$page=null,$local_date=null,$country_id,'web_service');
            }
            // For Pagination
            $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
            $total_rows = $count->result()[0]->total_rows;
            $pages = $total_rows / 10;
            $pages = ceil($pages);
            $result['total_rows'] = $total_rows;
            $result['pages'] = $pages;
            // For Pagination

            $result['status'] = true;
            $result['message'] = 'Saved Successfully.';
            $result['data'] = $distributor_compititor_details;
        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function updateCompitiorAnalysis()
    {
        $id = $this->input->get_post('id');
        $amount = $this->input->get_post('amount');
        $quantity = $this->input->get_post('quantity');
        $radio = $this->input->get_post('radio_checked');

        if((isset($id) && !empty($id)) && ((isset($amount) && !empty($amount)) || (isset($quantity) && !empty($quantity))) && (isset($radio) && !empty($radio)))
        {
            $update='';
            if($radio == 'total'){
                 $update=$this->ecp_model->update_compititor_details('web_service');
            }
            elseif($radio == 'product'){
                 $update=$this->ecp_model->update_compititor_product_details('web_service');
            }
            if($update==1){
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
                $result['data'] = '';
            }

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function deleteCompitiorAnalysis()
    {
        $id = $this->input->get_post('id');
        $radio = $this->input->get_post('radio_checked');

        if((isset($id) && !empty($id)) && (isset($radio) && !empty($radio)))
        {
            $delete='';
            if($radio == 'total'){
                $delete=$this->ecp_model->delete_compititor_details($id);
            }
            elseif($radio == 'product'){
                $delete=$this->ecp_model->delete_compititor_product_details($id);
            }
            if($delete==1){
                $result['status'] = true;
                $result['message'] = 'Deleted Successfully.';
                $result['data'] = '';
            }

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function getNoWorking()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        if((isset($user_id) && !empty($user_id)) && (isset($country_id) && !empty($country_id)))
        {
            $no_working_details = $this->ecp_model->all_no_working_details($user_id,$country_id,'web_service');

            $result['status'] = true;
            $result['message'] = 'Success.';
            $result['data'] = $no_working_details;

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }

    public function saveNoWorking()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        if((isset($user_id) && !empty($user_id)) && (isset($country_id) && !empty($country_id)))
        {
            $insert=$this->ecp_model->add_no_working_details($user_id,$country_id);
            if($insert == 1)
            {
                $result['status'] = true;
                $result['message'] = 'Success.';
                $result['data'] = '';
            }

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function getLeave()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        if((isset($user_id) && !empty($user_id)) && (isset($country_id) && !empty($country_id)))
        {
            $leave_details = $this->ecp_model->all_leave_details($user_id,$country_id,'web_service');

            $result['status'] = true;
            $result['message'] = 'Success.';
            $result['data'] = $leave_details;

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }

    public function saveLeave()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        if((isset($user_id) && !empty($user_id)) && (isset($country_id) && !empty($country_id)))
        {

            $insert=$this->ecp_model->add_leave_details($user_id,$country_id);
            if($insert == 1)
            {
                $result['status'] = true;
                $result['message'] = 'Success.';
                $result['data'] = '';
            }

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function confirmMaterialReceived()
    {
        $user_id = $this->input->get_post('user_id');
        $status =  $this->input->get_post('received_status');
        $mr_id = $this->input->get_post('id');

        if((isset($user_id) && !empty($user_id)) && (isset($status) && !empty($status)) && (isset($mr_id) && !empty($mr_id)))
        {
            $id =  $this->ecp_model->update_material_request_detail($user_id,$mr_id,$status);
            if($id == 1)
            {
                $result['status'] = true;
                $result['message'] = 'Updated Successfully.';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Something Went Wrong.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

    public function getMaterialRequestStatus()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $role_id = $this->input->get_post('role_id');
        if((isset($user_id)&& !empty($user_id)) &&(isset($country_id)&& !empty($country_id))) {

            $final_array = array();
            $designations =$this->ecp_model->get_all_designation_by_country($country_id);

            if (!empty($designations))
            {
                foreach ($designations as $k2 => $designation) {
                    $g2 = array(
                        "id" => $designation['desigination_country_id'],
                        "desigination_name" => $designation['desigination_country_name'],
                    );
                    $final_array['designation'][] = $g2; // Add Geo Level 2 Into Final Array
                    $role_id = $designation['role_id'];

                    $employees = $this->ecp_model->get_employee_by_role_id($role_id, $country_id);
                    if (!empty($employees)) {
                        foreach ($employees as $k1 => $employee) {
                            $final_array['designation'][$k2]['employees'][] = $employee; // Add Geo Level 1 Into Final Array
                        }
                    }
                }
            }

            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = array($final_array);
        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }


    public function getAllMaterialRequest()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        $from_date = $this->input->get_post('from_date');
        $to_date = $this->input->get_post('to_date');
        $status_id = $this->input->get_post('status_id');
            $employee_id = $this->input->get_post('employee_id');

        if((isset($user_id) && !empty($user_id)) &&(isset($from_date) && !empty($from_date)) && (isset($to_date) && !empty($to_date)) && (isset($status_id)) &&(isset($employee_id) && !empty($employee_id)) && (isset($country_id) && !empty($country_id))) {

            $materials_request = $this->ecp_model->get_all_materials_request_details_view($from_date, $to_date, $status_id, $employee_id,$page=null,$local_date=null,$country_id,$web_service = 'web_service');

            if (!empty($materials_request)) {
                // For Pagination
                $count = $this->db->query('SELECT FOUND_ROWS() as total_rows');
                $total_rows = $count->result()[0]->total_rows;
                $pages = $total_rows / 10;
                $pages = ceil($pages);
                $result['total_rows'] = $total_rows;
                $result['pages'] = $pages;
                // For Pagination

                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = $materials_request;
            } else {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);

    }

    public function saveAllMaterialRequest()
    {
        $user_id = $this->input->get_post('user_id');
        $country_id = $this->input->get_post('country_id');
        if((isset($user_id) && !empty($user_id)) && (isset($country_id) && !empty($country_id)))
        {
            $insert=$this->ecp_model->update_materials_detail($user_id,'web_service');
            if($insert == 1)
            {
                $result['status'] = true;
                $result['message'] = 'Success.';
                $result['data'] = '';
            }

        }
        else{
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }





    /*-------------------------------------------------ECP WEB SERVICE -------------------------------------------------*/

	//ESP WEBSERVICE
	
	/*
	 * FOR GETTING EMPLOYEE LEVEL DATA
	 */
	/*
	public function get_employee_level_data(){
		
		$user_id = $this->input->get_post('user_id');
		
		if(isset($user_id) && $user_id != "")
        {
            
			$user_data = modules::run('esp/esp/get_user_level_data', $user_id);
			
            if(!empty($user_data))
            {
                $result['status'] = true;
                $result['message'] = 'Successfull';
				$result['data'] = $user_data;
				
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No data found';
				$result['data'] = array();
            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required";
        }
		
        $this->do_json($result);
		
	}
	*/
	/*
	 * FOR GETTING PBG DATA
	 */
	
	public function get_assumption_data(){
		
    	$assumption_data = $this->esp_model->get_assumption_data();
		
        if(!empty($assumption_data))
        {
            $result['status'] = true;
            $result['message'] = 'Successfull';
			$result['data'] = $assumption_data;
        }
        else
        {
            $result['status'] = false;
            $result['message'] = 'No data found';
			$result['data'] = array();
        }
       
        $this->do_json($result);
		
	 }
	
	
	
	/*
	 * FOR GETTING FORECAST DATA FOR EMPLOYEE, SELECTED MONTH, SELECTED PBG
	 */
	
	public function forecast_plan(){
		
		$user_id = $this->input->get_post('user_id');
		
		$form_month = $this->input->get_post('from_month');
		$to_month = $this->input->get_post('to_month');
		
		$pbg_data = $this->input->get_post('pbg_id');
		
		$selected_employee = $this->input->get_post('employee_id');
		
		$business_data = $this->esp_model->get_business_code($selected_employee);
		
		$webservice = "webservice";
		
		$data = array("login_user_id" => $user_id,
					   "from_month" => $form_month,
					   "to_month" => $to_month,
					   "pbg_id" => $pbg_data,
					   "business_code" => $business_data,
					   "webservice" => $webservice
					);
		if((isset($user_id) && !empty($user_id)) && (isset($form_month) && !empty($form_month)) && (isset($to_month) && !empty($to_month)) && (isset($pbg_data) && !empty($pbg_data)) && (isset($selected_employee) && !empty($selected_employee))){
		
			$forecast_data = modules::run('esp/esp/get_pbg_sku_data', $data);
			
			if(!empty($forecast_data))
	        {
	            $result['status'] = true;
	            $result['message'] = 'Successfull';
				$result['data'] = $forecast_data;
	        }
	        else
	        {
	            $result['status'] = false;
	            $result['message'] = 'No data found';
				$result['data'] = array();
	        }
		
		}
		else
		{
			$result['status'] = false;
	        $result['message'] = 'All fields required.';
			$result['data'] = array();
		}
		
		$this->do_json($result);
		
	}
	
	public function get_forecast_value(){
		
		$month_data = $this->input->get_post('monthval');
		$product_sku_id = $this->input->get_post('product_sku_id');
		$forecast_data = $this->input->get_post('forecast_data');
		
		
		$webservice = "webservice";
		
		$data = array("month_data" => $month_data,
					   "product_sku_id" => $product_sku_id,
					   "forecastdata" => $forecast_data,
					   "webservice" => $webservice
					 );
		
		if((isset($month_data) && !empty($month_data)) && (isset($product_sku_id) && !empty($product_sku_id)) && (isset($forecast_data) && !empty($forecast_data))){
		
			
			$forecast_value_data = modules::run('esp/esp/get_forecast_value_data', $data);
			
			if(!empty($forecast_value_data))
	        {
	            $result['status'] = true;
	            $result['message'] = 'Successfull';
				$result['data'] = $forecast_value_data;
	        }
	        else
	        {
	            $result['status'] = false;
	            $result['message'] = 'No data found';
				$result['data'] = "";
	        }
		}
		else
		{
			$result['status'] = false;
	        $result['message'] = 'All fields Required.';
		    $result['data'] = "";
			
		}
		
		$this->do_json($result);
		
	}
	
	public function update_freeze_status(){
		
		$user_id = $this->input->get_post('user_id');
		$forecast_id = $this->input->get_post('forecast_id');
		$freeze_status = $this->input->get_post('freeze_status');
        
        $month_data = $this->input->get_post('month_data');
		
		$webservice = "webservice";
		
		if($user_id != "" && $forecast_id != "" && $freeze_status != "") {

            $data = array("user_id" => $user_id,
                "forecastid" => $forecast_id,
                "freeze_status" => $freeze_status,
                "month_data" => $month_data,
                "webservice" => $webservice
            );

          //  $check_month_data_locked = modules::run('esp/esp/get_forecast_lock_status', $data);

            //CHECK FOR LOWEST USER

            $child_user_data = $this->esp_model->get_user_selected_level_data($user_id, null);

            if ($child_user_data["tot"] == 0){

                if($freeze_status == 1){

                    $forecast_freeze_data = modules::run('esp/esp/update_forecast_freeze_status', $data);

                    if (!empty($forecast_freeze_data)) {
                        if ($forecast_freeze_data == 1) {
                            $freeze_status = 0;
                        }else{
                            $freeze_status = 1;
                        }

                        $result['status'] = true;
                        $result['message'] = 'Successfull';
                        $result['data'] = $freeze_status;
                    } else {
                        $result['status'] = false;
                        $result['message'] = 'No data found';
                        $result['data'] = "";
                    }

                }
                else{

                    $check_month_data_locked = modules::run('esp/esp/get_forecast_lock_status', $data);

                    if ($check_month_data_locked != 1) {

                        $forecast_freeze_data = modules::run('esp/esp/update_forecast_freeze_status', $data);

                        if (!empty($forecast_freeze_data)) {

                            if ($freeze_status == 0) {
                                $freeze_status = 1;
                            }else{
                                $freeze_status = 0;
                            }

                            $result['status'] = true;
                            $result['message'] = 'Successfull';
                            $result['data'] = $freeze_status;
                        } else {
                            $result['status'] = false;
                            $result['message'] = 'No data found';
                            $result['data'] = "";
                        }

                    }
                    else{

                        $result['status'] = false;
                        $result['message'] = 'Selected months are locked by Senior employees.So No data is Freeze or unfreezed';
                        $result['data'] = "";

                    }

                }
            } else{
                    $check_month_data_locked = modules::run('esp/esp/get_forecast_lock_status', $data);

                    if ($check_month_data_locked != 1) {

                    $self_lock_data = $this->esp_model->get_senior_lock_status_data($user_id, $month_data, $forecast_id);


                    if($self_lock_data !=0 && $self_lock_data[0]["lock_status"] == 1) {
                        $forecast_freeze_data = modules::run('esp/esp/update_forecast_freeze_status', $data);

                        if (!empty($forecast_freeze_data)) {
                            if ($forecast_freeze_data == 1) {

                                if ($freeze_status == 1) {
                                    $freeze_status = 0;
                                } else {
                                    $freeze_status = 1;
                                }

                            }

                            $result['status'] = true;
                            $result['message'] = 'Successfull';
                            $result['data'] = $freeze_status;
                        } else {
                            $result['status'] = false;
                            $result['message'] = 'No data found';
                            $result['data'] = "";
                        }
                    } else {
                        $result['status'] = false;
                        $result['message'] = 'Please Lock first and than process further.';
                        $result['data'] = "";
                    }
                } else {

                    $result['status'] = false;
                    $result['message'] = 'Selected months are locked by Senior employees.So No data is Freeze or unfreezed';
                    $result['data'] = "";

                }

            }
		}
		else
        {
            $result['status'] = false;
            $result['message'] = 'All fields Required.';
			$result['data'] = "";
        }
		
		$this->do_json($result);
		
	}

	public function forecast_lock_data(){
				
		$user_id = $this->input->get_post('user_id');
		$forecast_id = $this->input->get_post('forecast_id');
		$month_val = $this->input->get_post('monthval');
		$lock_data = $this->input->get_post('lock_data');
		
		$webservice = "webservice";
		
		if($user_id != "" && $forecast_id != "" && $month_val != "" && $lock_data != ""){
		
			$data = array("user_id" => $user_id,
			   "forecastid" => $forecast_id,
			   "monthval" => $month_val,
			   "lock_data" => $lock_data,
			   "webservice" => $webservice
			 );
		
			$forecast_lock_data = modules::run('esp/esp/set_forecast_lock_data', $data);
			
			if(!empty($forecast_lock_data))
	        {
	        	if($forecast_lock_data == 1){
	        		
	        		if($lock_data == 1){
	        			$lock_data = 0;
	        		}
					else
					{
						$lock_data = 1;
					}
					
	        	}
				
	            $result['status'] = true;
	            $result['message'] = 'Successfull';
				$result['data'] = $lock_data;
	        }
	        else
	        {
	            $result['status'] = false;
	            $result['message'] = 'No data found';
				$result['data'] = "";
	        }
		}
		else
        {
        	
            $result['status'] = false;
            $result['message'] = 'All fields Required.';
			$result['data'] = "";
        }
		
		$this->do_json($result);	
		
	}
	
	
	public function add_update_forecast_data(){
			
		$forecast_data = $this->input->get_post('forecast_data');	
			
		$forecastdata = json_decode($forecast_data,TRUE);
		
		$final_array = array();
		
		foreach($forecastdata as $datakey=>$data){
			
			$final_array["login_user_id"] = $forecastdata["login_user_id"];
			$final_array["login_user_countryid"] = $forecastdata["login_user_countryid"];
			
			$final_array["emp_id"] = $forecastdata["emp_id"];
			
			$final_array["from_month"] = $forecastdata["from_month"];
			$final_array["to_month"] = $forecastdata["to_month"];
			
			$final_array["pbg_data"] = $forecastdata["pbg_data"];
			
			$final_array["forecast_id"] = $forecastdata["forecast_id"];
			$final_array["freeze_status"] = $forecastdata["freeze_status"];
			
			$final_array["product_sku_id"] = $forecastdata["product_sku_id"];
			
			$final_array["forecast_qty"] = array();
			$final_array["forecast_value"] = array();
			
			$final_array["month_data"] = $forecastdata["month_data"];
			
		/*	$final_array["assumption1"] = array();
			$final_array["probablity1"] = array();
			$final_array["assumption2"] = array();
			$final_array["probablity2"] = array();
			$final_array["assumption3"] = array();
			$final_array["probablity3"] = array(); */
			
			if(!empty($forecastdata["forecast_qty"])){
				foreach($forecastdata["forecast_qty"] as $forecast_key => $forecast_data){
					foreach($forecast_data as $f_key => $f_data){
						if($f_key != "monthvalue"){
							foreach($forecastdata["product_sku_id"] as $sku_key => $product_data){
								if($f_key == $product_data){
									$final_array["forecast_qty"][$product_data][] = $f_data;
								}
							}
						}
					}
				}
			}
			
				
				if(!empty($forecastdata["forecast_value"])){
					foreach($forecastdata["forecast_value"] as $forecastvalue_key => $forecastvalue_data){
						foreach($forecastvalue_data as $fv_key => $fv_data){
							if($fv_key != "monthvalue"){
								foreach($forecastdata["product_sku_id"] as $sku_key => $product_data){
									if($fv_key == $product_data){
										$final_array["forecast_value"][$product_data][] = $fv_data;
									}
								}
							}
						}
					}
				}
				
			
			$i = 1;
			foreach($forecastdata["month_data"] as $month_key=>$monthvalue){
			
				$final_array["assumption$i"] = array();
				$final_array["probablity$i"] = array();
				
				if(!empty($forecastdata["assumption"])){
					
					foreach($forecastdata["assumption"] as $assumption_key => $assumption_data){
						
						if($assumption_data["monthvalue"] == $monthvalue){
							$final_array["assumption$i"] = $assumption_data;
						}
					
					}
				}
			
				if(!empty($forecastdata["probablity"])){
					foreach($forecastdata["probablity"] as $probablity_key => $probablity_data){
						if($probablity_data["monthvalue"] == $monthvalue){
							$final_array["probablity$i"] = $probablity_data;
						}
						
					}
				}
				
				$i++;
			}
			
		}
		
		$forecast_data = modules::run('esp/esp/add_forecast', $final_array);
		
		$result['status'] = true;
	    $result['message'] = 'Successfull';
		$result['data'] = $forecast_data;
		
		$this->do_json($result);
		
	}
	
	/*
	 * ESP BUDGET WEBSERVICE 
	 */
	 
	 
	public function esp_budget(){
		
		$user_id = $this->input->get_post('user_id');
		
		$year_val = $this->input->get_post('yearval');
		
		$form_month = $year_val."-01";
		$to_month = $year_val."-12";
		
		$pbg_data = $this->input->get_post('pbg_id');
		
		$selected_employee = $this->input->get_post('employee_id');
		
		$business_data = $this->esp_model->get_business_code($selected_employee);
		
		$webservice = "webservice";
		
		$data = array("login_user_id" => $user_id,
					   "from_month" => $form_month,
					   "to_month" => $to_month,
					   "pbg_id" => $pbg_data,
					   "business_code" => $business_data,
					   "webservice" => $webservice
					);
		if((isset($user_id) && !empty($user_id)) && (isset($form_month) && !empty($form_month)) && (isset($to_month) && !empty($to_month)) && (isset($pbg_data) && !empty($pbg_data)) && (isset($selected_employee) && !empty($selected_employee))){
		
			$budget_data = modules::run('esp/esp/get_pbg_sku_budget_data', $data);
			
			if(!empty($budget_data))
	        {
	            $result['status'] = true;
	            $result['message'] = 'Successfull';
				$result['data'] = $budget_data;
	        }
	        else
	        {
	            $result['status'] = false;
	            $result['message'] = 'No data found';
				$result['data'] = array();
	        }
		
		}
		else
		{
			$result['status'] = false;
	        $result['message'] = 'All fields required.';
			$result['data'] = array();
		}
		
		$this->do_json($result);
		
	}
	 	 
	public function get_budget_value(){
		
		$month_data = $this->input->get_post('monthval');
		$product_sku_id = $this->input->get_post('product_sku_id');
		$budget_data = $this->input->get_post('budget_data');
		
		
		$webservice = "webservice";
		
		$data = array("month_data" => $month_data,
					   "product_sku_id" => $product_sku_id,
					   "budgetdata" => $budget_data,
					   "webservice" => $webservice
					 );
		
		if((isset($month_data) && !empty($month_data)) && (isset($product_sku_id) && !empty($product_sku_id)) && (isset($budget_data) && !empty($budget_data))){
		
			
			$budget_value_data = modules::run('esp/esp/get_budget_value_data', $data);
			
			if($budget_value_data == 0 || $budget_value_data > 0)
	        {
	        	
	            $result['status'] = true;
	            $result['message'] = 'Successfull';
				$result['data'] = $budget_value_data;
	        }
	        else
	        {
	        	
	            $result['status'] = false;
	            $result['message'] = 'No data found';
				$result['data'] = "";
	        }
		}
		else
		{
			$result['status'] = false;
	        $result['message'] = 'All fields Required.';
		    $result['data'] = "";
			
		}
		
		$this->do_json($result);
		
	}
	
	
	public function update_budget_freeze_status(){
		
		$user_id = $this->input->get_post('user_id');
		$budget_id = $this->input->get_post('budget_id');
		$freeze_status = $this->input->get_post('freeze_status');
        
        $yeardata = $this->input->get_post('yeardata'); 
		
		$webservice = "webservice";
		
		if($user_id != "" && $budget_id != "" && $freeze_status != ""){
		
			$data = array("user_id" => $user_id,
			   "budgetid" => $budget_id,
			   "freeze_status" => $freeze_status,
               "yeardata" => $yeardata,
			   "webservice" => $webservice
			 );


            $child_user_data = $this->esp_model->get_user_selected_level_data($user_id, null);

            if ($child_user_data["tot"] == 0){

                if($freeze_status == 1){

                    //$forecast_freeze_data = modules::run('esp/esp/update_forecast_freeze_status', $data);

                    $budget_freeze_data = modules::run('esp/esp/update_budget_freeze_status', $data);

                    if (!empty($budget_freeze_data)) {
                        if ($budget_freeze_data == 1) {
                            $freeze_status = 0;
                        }else{
                            $freeze_status = 1;
                        }

                        $result['status'] = true;
                        $result['message'] = 'Successfull';
                        $result['data'] = $freeze_status;
                    } else {
                        $result['status'] = false;
                        $result['message'] = 'No data found';
                        $result['data'] = "";
                    }

                }
                else{

                    $check_month_data_locked = modules::run('esp/esp/get_budget_lock_status', $data);

                    if ($check_month_data_locked != 1) {

                        $budget_freeze_data = modules::run('esp/esp/update_budget_freeze_status', $data);

                        if (!empty($budget_freeze_data)) {

                            if ($budget_freeze_data == 1) {
                                $freeze_status = 1;
                            }else{
                                $freeze_status = 0;
                            }

                            $result['status'] = true;
                            $result['message'] = 'Successfull';
                            $result['data'] = $freeze_status;
                        } else {
                            $result['status'] = false;
                            $result['message'] = 'No data found';
                            $result['data'] = "";
                        }

                    }
                    else{

                        $result['status'] = false;
                        $result['message'] = 'Selected months are locked by Senior employees.So No data is Freeze or unfreezed';
                        $result['data'] = "";

                    }

                }
            }
            else
            {
                $check_month_data_locked = modules::run('esp/esp/get_budget_lock_status', $data);

                if ($check_month_data_locked != 1) {

                    $self_lock_data = modules::run('esp/esp/get_self_budget_lock_status', $data);


                    if($self_lock_data !=0 && $self_lock_data[0]["lock_status"] == 1) {
                        $budget_freeze_data = modules::run('esp/esp/update_budget_freeze_status', $data);

                        if (!empty($budget_freeze_data)) {
                            if ($budget_freeze_data == 1) {

                                if ($freeze_status == 1) {
                                    $freeze_status = 0;
                                } else {
                                    $freeze_status = 1;
                                }

                            }

                            $result['status'] = true;
                            $result['message'] = 'Successfull';
                            $result['data'] = $freeze_status;
                        } else {
                            $result['status'] = false;
                            $result['message'] = 'No data found';
                            $result['data'] = "";
                        }
                    } else {
                        $result['status'] = false;
                        $result['message'] = 'Please Lock first and than process further.';
                        $result['data'] = "";
                    }
                } else {

                    $result['status'] = false;
                    $result['message'] = 'Selected months are locked by Senior employees.So No data is Freeze or unfreezed';
                    $result['data'] = "";

                }

            }
        }
        else
        {
            $result['status'] = false;
            $result['message'] = 'All fields Required.';
            $result['data'] = "";
        }

		
		$this->do_json($result);
		
	}
	
	
	public function budget_lock_data(){
				
		$user_id = $this->input->get_post('user_id');
		$budget_id = $this->input->get_post('budget_id');
		$year_val = $this->input->get_post('yearval');
		$lock_data = $this->input->get_post('lock_data');
		
		$webservice = "webservice";
		
		if($user_id != "" && $budget_id != "" && $year_val != "" && $lock_data != ""){
		
			$data = array("user_id" => $user_id,
			   "budgetid" => $budget_id,
			   "yearval" => $year_val,
			   "lock_data" => $lock_data,
			   "webservice" => $webservice
			 );
		
			$budget_lock_data = modules::run('esp/esp/set_budget_lock_data', $data);
			
			if(!empty($budget_lock_data))
	        {
	        	if($budget_lock_data == 1){
	        		
	        		if($lock_data == 1){
	        			$lock_data = 0;
	        		}
					else
					{
						$lock_data = 1;
					}
					
	        	}
				
	            $result['status'] = true;
	            $result['message'] = 'Successfull';
				$result['data'] = $lock_data;
	        }
	        else
	        {
	            $result['status'] = false;
	            $result['message'] = 'No data found';
				$result['data'] = "";
	        }
		}
		else
        {
        	
            $result['status'] = false;
            $result['message'] = 'All fields Required.';
			$result['data'] = "";
        }
		
		$this->do_json($result);	
		
	}
	
	
	public function add_update_budget_data(){
			
		$budget_data = $this->input->get_post('budget_data');	
			
		$budgetdata = json_decode($budget_data,TRUE);
		
		//testdata($budgetdata);
		
		$final_array = array();
		
		foreach($budgetdata as $datakey=>$data){
			
			$final_array["login_user_id"] = $budgetdata["login_user_id"];
			$final_array["login_user_countryid"] = $budgetdata["login_user_countryid"];
			
			//$final_array["from_month"] = $budgetdata["from_month"];
			$final_array["emp_id"] = $budgetdata["emp_id"];
			
			$final_array["pbg_data"] = $budgetdata["pbg_data"];
			
			$final_array["budget_id"] = $budgetdata["budget_id"];
			$final_array["freeze_status"] = $budgetdata["freeze_status"];
			
			$final_array["product_sku_id"] = $budgetdata["product_sku_id"];
			
			$final_array["budget_qty"] = array();
			$final_array["budget_value"] = array();
			
			$final_array["month_data"] = $budgetdata["month_data"];
			
		
			
			if(!empty($budgetdata["budget_qty"])){
				foreach($budgetdata["budget_qty"] as $budget_key => $budget_data){
					foreach($budget_data as $b_key => $b_data){
						if($b_key != "monthvalue"){
							foreach($budgetdata["product_sku_id"] as $sku_key => $product_data){
								if($b_key == $product_data){
									$final_array["budget_qty"][$product_data][] = $b_data;
								}
							}
						}
					}
				}
			}
			
				
				if(!empty($budgetdata["budget_value"])){
					foreach($budgetdata["budget_value"] as $budgetvalue_key => $budgetvalue_data){
						foreach($budgetvalue_data as $bv_key => $bv_data){
							if($bv_key != "monthvalue"){
								foreach($budgetdata["product_sku_id"] as $sku_key => $product_data){
									if($bv_key == $product_data){
										$final_array["budget_value"][$product_data][] = $bv_data;
									}
								}
							}
						}
					}
				}
				
		}
		
		$budget_data = modules::run('esp/esp/add_budget', $final_array);
		
		$result['status'] = true;
	    $result['message'] = 'Successfull';
		$result['data'] = $budget_data;
		
		$this->do_json($result);
		
	}
	
	public function get_impact_entry_data(){
		
		$month_val = $this->input->get_post('monthval');
		$bussinesscode = $this->input->get_post('bussiness_code');
		
		$webservice = "webservice";
		
		if($month_val != "" && $bussinesscode != ""){
			
			$data = array(
			   "bussiness_code" => $bussinesscode,
			   "monthval" => $month_val,
			   "webservice" => $webservice
			);
			
			$impact_entry_data = modules::run('esp/esp/get_forecast_impact_data', $data);
			
			if($impact_entry_data != "" || !empty($impact_entry_data) || $impact_entry_data != 0)
			{
				
				$result['status'] = true;
	            $result['message'] = 'Successfull';
				$result['data'] = $impact_entry_data;
				
			}
			else{
				
				$result['status'] = false;
	            $result['message'] = 'No data found';
				$result['data'] = array();
				
			}
			
		}
		else
		{
			
			$result['status'] = false;
	        $result['message'] = 'All fields required.';
			$result['data'] = array();
			
		}
		
		$this->do_json($result);
	}


	public function get_forecast_status_data(){
		
		$roleid = $this->input->get_post('role_id');
		$userid = $this->input->get_post('user_id');
		$webservice = "webservice";
		
		if($roleid != ""){
			
			$data = array(
			   "role_id" => $roleid,
			   "user_id" => $userid,
			   "webservice" => $webservice
			);
			
			$forecast_status_data = modules::run('esp/esp/forecast_status', $data);
			
			//testdata($forecast_status_data);
			
			if($forecast_status_data != "" || !empty($forecast_status_data) || $forecast_status_data != 0)
			{
				
				$result['status'] = true;
	            $result['message'] = 'Successfull';
				$result['data'] = $forecast_status_data;
				
			}
			else{
				
				$result['status'] = false;
	            $result['message'] = 'No data found';
				$result['data'] = array();
				
			}
			
		}
		else
		{
			
			$result['status'] = false;
	        $result['message'] = 'All fields required.';
			$result['data'] = array();
			
		}
		
		$this->do_json($result);
		
	}

	public function show_monthly_user_statusdata(){
		
		$month_val = $this->input->get_post('monthdata');
		$user_level_data = $this->input->get_post('user_level_data');
		$webservice = "webservice";
		
		if($month_val != "" && !empty($user_level_data)){
			
			$data = array(
			   "monthval" => $month_val,
			   "userlevel_formdata" => $user_level_data,
			   "webservice" => $webservice
			);
			
			$forecast_monthly_status_data = modules::run('esp/esp/show_month_user_level_data', $data);
			
			//testdata($forecast_status_data);
			
			if($forecast_monthly_status_data != "" || !empty($forecast_monthly_status_data) || $forecast_monthly_status_data != 0)
			{
				
				$result['status'] = true;
	            $result['message'] = 'Successfull';
				$result['data'] = $forecast_monthly_status_data;
				
			}
			else{
				
				$result['status'] = false;
	            $result['message'] = 'No data found';
				$result['data'] = array();
				
			}
			
		}
		else
		{
			
			$result['status'] = false;
	        $result['message'] = 'All fields required.';
			$result['data'] = array();
			
		}
		
		$this->do_json($result);
		
	}

	public function update_impact_entry(){
		
		$impact_data = $this->input->get_post('impact_data');
		
		$webservice = "webservice";
		
		if(isset($impact_data) && $impact_data != ""){
				
			$impact_data_array = json_decode($impact_data,TRUE);
			
			if(!empty($impact_data_array) && isset($impact_data_array["status"]) && $impact_data_array["status"] != FALSE)
			{
				
				
				$impact_data = modules::run('esp/esp/add_impact_entry', $impact_data_array);
			
					if($impact_data != 0)
			        {
						
			            $result['status'] = true;
			            $result['message'] = 'Successfull Updated';
						
			        }
			        else
			        {
			            $result['status'] = false;
			            $result['message'] = 'Not Updated';
						
			        }
				
			}
			else{
				
				//ERROR
				$result['status'] = false;
	            $result['message'] = 'No data found';
				
			}
			
		}
		else{
			
			//ERROR
			
			$result['status'] = false;
	        $result['message'] = 'No data found';
			
		}
		
		$this->do_json($result);	
		
	}
	
    public function get_budget_lock_data(){
        
        $user_id = $this->input->get_post('user_id');
		$business_emp_id = $this->input->get_post('emp_id');
		$year_val = $this->input->get_post('yearval');
        $pbgid = $this->input->get_post('pbgid');

        //GET BUSSINESS CODE

        $businesscode = $this->esp_model->get_business_code($business_emp_id);

		$webservice = "webservice";
		
		if($user_id != "" && $year_val != ""  && $businesscode != ""  && $pbgid != ""){
		
			$data = array("user_id" => $user_id,
			   "yearval" => $year_val,
               "businesscode" => $businesscode,
               "pbgid" => $pbgid,
			   "webservice" => $webservice
			 );
		
			$budget_lock_data = modules::run('esp/esp/show_budget_lock', $data);
			
          //  testdata($budget_lock_data);
            
			if(!empty($budget_lock_data))
	        {
	            $result['status'] = true;
	            $result['message'] = 'Successfull';
				$result['data'] = $budget_lock_data;
	        }
	        else
	        {
	            $result['status'] = false;
	            $result['message'] = 'No data found';
				$result['data'] = "";
	        }
		}
		else
        {
        	
            $result['status'] = false;
            $result['message'] = 'All fields Required.';
			$result['data'] = "";
        }
		
		$this->do_json($result);	
        
        
    }
    
	/*
	 * FOR GETTING HIREARCHYCIAL USER DATA
	 */
	 
	/* public function test_data($user_id,$role_degigination_data)
	{
			$final_array = array();
		
			$w = $role_degigination_data-1;
					
			$level_user_data = modules::run('esp/esp/get_user_level_data', $user_id);
			
			$k = 1;
			if(!empty($level_user_data))
			{ 
				//if(!isset($final_array[$user_id])){
				//	$final_array[$user_id] = array();	
				//}
												
				foreach($level_user_data as $k=>$d)
				{
					$d['child'] = $this->test_data($d["id"],$role_degigination_data);
					$final_array[$user_id][] = $d;
				}				
			}
		return $final_array;
		
	}

*/

	

    /**
     * @ Function Name        : do_json
     * @ Function Params    : result Array
     * @ Function Purpose    : Make JSON format for Sending Data to Mobile
     * */
    public function do_json($result)
    {
        array_walk_recursive($result, function (&$item, $key) {
            $item = null === $item ? '' : $item;
        });
        echo json_encode($result);
        exit;
    }
}