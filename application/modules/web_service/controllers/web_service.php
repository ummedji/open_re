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

        $this->load->library('users/auth');
        $this->load->model('users/user_model');
        //$this->load->model('role_access/role_access_model');

        $this->lang->load('web_service');

        /*$check_session = $this->check_active_session();
        if($check_session!==false){
            echo json_encode($check_session);
            exit;
        }*/

        Assets::add_module_js('web_service', 'web_service.js');
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
                                    'language' => $code_data['language']
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
        echo json_encode($result);
        exit;
    }

    /**
     * @ Function Name        : get_global_info
     * @ Function Params    : $user_id,$unq_no
     * @ Function Purpose    : Get all user information by user_id
     * */

    public function get_global_info()
    {
        $user_id = $this->input->get_post('user_id');
        $unq_no = $this->input->get_post('unq_no');

        if (trim($user_id) && $user_id != 0) {

        } else {
            $result['status'] = false;
            $result['message'] = '';
            $result['data'] = '';
        }
        echo json_encode($result);
        exit;
    }

}