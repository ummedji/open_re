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
        /*$this->form_validation->set_rules('user_id', 'user_id', 'required');
        $this->form_validation->set_rules('country_id', 'country_id', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required.";
        }
        else
        {*/
            $user_id = $this->input->get_post('user_id');
            $country_id = $this->input->get_post('country_id');

        if(isset($user_id) && isset($country_id)) {
            $distributors = $this->ishop_model->get_distributor_by_user_id($country_id);
            $product_skus = $this->ishop_model->get_product_sku_by_user_id($country_id);

            $dist_array = array();
            if (!empty($distributors)) {
                foreach ($distributors as $distributor) {
                    $dist = array(
                        "display_name" => $distributor['display_name'],
                        "user_code" => $distributor['user_code'],
                    );
                    array_push($dist_array, $dist);
                }
            }
            $product_skus = !empty($product_skus) ? $product_skus : array();
            $data = array("distributors" => $dist_array, "products_skus" => $product_skus);
            $result['status'] = true;
            $result['message'] = 'Success';
            $result['data'] = $data;
        }
       // }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : savePrimarySales
     * @ Function Params    : customer_id,invoice_no,invoice_date,order_tracking_no,PO_no,product_sku_id,quantity,dispatched_quantity,amount (POST)
     * @ Function Purpose    : Save Primary Sales Data
     * */
    public function savePrimarySales()
    {
        $this->form_validation->set_rules('customer_id', 'customer_id', 'required');
        $this->form_validation->set_rules('invoice_no', 'invoice_no', 'required');
        $this->form_validation->set_rules('invoice_date', 'invoice_date', 'required');
        $this->form_validation->set_rules('order_tracking_no', 'order_tracking_no', 'required');
        $this->form_validation->set_rules('PO_no', 'PO_no', 'required');

        $this->form_validation->set_rules('product_sku_id', 'product_sku_id', 'required');
        $this->form_validation->set_rules('quantity', 'quantity', 'required');
        $this->form_validation->set_rules('dispatched_quantity', 'dispatched_quantity', 'required');
        $this->form_validation->set_rules('amount', 'amount', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = false;
            $result['message'] = "All Fields are Required."/*strip_tags(trim(validation_errors()))*/;
        }
        else
        {
            $user_id = $this->input->get_post('customer_id');
            $country_id = $this->input->get_post('country_id');

            $id = $this->ishop_model->add_primary_sales_details($user_id,$country_id,'web_service');
            if($id)
            {
                $result['status'] = true;
                $result['message'] = 'Success';
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'Fail';
            }
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getPrimarySalesInvoices
     * @ Function Params    : form_date,to_date,by_distributor,by_invoice_no (POST)
     * @ Function Purpose    : Get Primary Sales Invoice Data
     * */
    public function getPrimarySalesInvoices()
    {
        $this->form_validation->set_rules('form_date', 'form_date', 'required');
        $this->form_validation->set_rules('to_date', 'to_date', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = false;
            $result['message'] = "Fields are Required."/*strip_tags(trim(validation_errors()))*/;
        }
        else
        {
            $form_date = (isset($_POST['form_date']) ? $_POST['form_date'] : '');
            $to_date = (isset($_POST['to_date']) ? $_POST['to_date'] : '');
            $by_distributor = (isset($_POST['by_distributor']) ? $_POST['by_distributor'] : '');
            $by_invoice_no = (isset($_POST['by_invoice_no']) ? $_POST['by_invoice_no'] : '');

            $primary_sales_details = $this->ishop_model->get_primary_details_view($form_date, $to_date, $by_distributor, $by_invoice_no,'web_service');
            if(!empty($primary_sales_details))
            {
                $result['status'] = true;
                $result['message'] = 'Success';
                $result['data'] = $primary_sales_details;
            }
            else
            {
                $result['status'] = false;
                $result['message'] = 'No Records Found.';
            }
        }
        $this->do_json($result);
    }

    /**
     * @ Function Name        : getPrimarySalesProductDetails
     * @ Function Params    : primary_sales_id (POST)
     * @ Function Purpose    : Get Primary Sales Product Details Data
     * */
    public function getPrimarySalesProductDetails()
    {
        $this->form_validation->set_rules('primary_sales_id', 'primary_sales_id', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $result['status'] = false;
            $result['message'] = "Fields are Required."/*strip_tags(trim(validation_errors()))*/;
        }
        else
        {
            $primary_sales_id = (isset($_POST['primary_sales_id']) ? $_POST['primary_sales_id'] : '');

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