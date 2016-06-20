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
            $product_skus = $this->ishop_model->get_product_sku_by_user_id($country_id);

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

            $data = array("distributors" => $dist_array, "products_skus" => $sku_array, "units" => $units);
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



    /* ---------------------------------------------- HO --------------------------------------------------- */
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
            $primary_sales_details = $this->ishop_model->get_primary_details_view($form_date, $to_date, $by_distributor, $by_invoice_no,'web_service');
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
                        "distributor_name" => $order['fr_fname'].' '.$order['fr_mname'].' '.$order['fr_lname'],
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
        $page_function = 'order_status';

        if(isset($user_id) && !empty($user_id) && isset($country_id) && !empty($country_id))
        {
            $order_data = $this->ishop_model->get_order_data($role_id,$country_id,null,$user_id,$customer_id,$form_date,$to_date,null,null,null,$page_function,null,'web_service');

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
                        "entered_by" => $order['ot_fname'].' '.$order['ot_mname'].' '.$order['ot_lname'],
                        "po_no" => $order['PO_no'],
                        "order_tracking_no" => $order['order_tracking_no'],
                        "order_date" => $order['order_date'],
                        "edd" => $order['estimated_delivery_date'],
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
        $region = $this->input->get_post("region");
        $territory = $this->input->get_post("territory");
        $retailer = $this->input->get_post("fo_retailer_id");

        if(isset($user_id) && !empty($user_id)
            && isset($country_id) && !empty($country_id)
            && isset($role_id) && !empty($role_id)
            && isset($year) && !empty($year)
            && isset($region) && !empty($region)
            && isset($territory) && !empty($territory)
            && isset($region) && !empty($region)
        )
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

        if(isset($user_id) && !empty($user_id)
            && isset($year) && !empty($year)
            && isset($logined_user_role) && !empty($logined_user_role)
            && isset($country_id) && !empty($country_id)
        )
        {
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
        $user_id = $this->input->get_post('user_id');
        if(isset($user_id))
        {
            $_POST['flag'] = 'web_service';
            modules::run('ishop/ishop/upload_data', $_POST);
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
    public function downloadData()
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
    }


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

            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = !empty($prespective_order) ? $prespective_order : array();
        }
        else
        {
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

        if(isset($user_id) && !empty($user_id)
            && isset($country_id) && !empty($country_id)
            && !empty($from_date) && isset($from_date)
            && !empty($to_date) && isset($to_date)
        )
        {
            $invoice_receved = $this->ishop_model->invoice_confirmation_received_by_distributor($invoice_month,$po_no,$invoice_no,$user_id,$country_id,null,'web_service');

            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = !empty($invoice_receved) ? $invoice_receved : array();
        }
        else
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        $this->do_json($result);
    }

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