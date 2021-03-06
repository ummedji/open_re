<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Esp controller
 */
class Esp extends Front_Controller
{
    protected $permissionCreate = 'Esp.Esp.Create';
    protected $permissionDelete = 'Esp.Esp.Delete';
    protected $permissionEdit = 'Esp.Esp.Edit';
    protected $permissionView = 'Esp.Esp.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();


        $this->load->library('users/auth');
        //$this->auth->restrict($this->permissionView);
        $this->load->helper('application');
        $this->load->library('Template');
        $this->load->library('Assets');
        $this->lang->load('application');
        $this->load->library('events');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->lang->load('esp');
        $this->load->model('esp_model');
        $this->set_current_user();

    }

    /**
     * Display a list of ESP data.
     *
     * @return void
     */
    public function index()
    {
        Assets::add_module_js('esp', 'esp.js');

        $user = $this->auth->user();

        $child_user_data = $this->esp_model->get_user_selected_level_data($user->id,null);

        Template::set('current_user', $user);
        Template::set('child_user_data', $child_user_data);

        Template::render();
    }

    public function get_user_level_data($userid = null)
    {

        if (isset($_POST["userid"]) && $userid == null) {
            $userid = $_POST["userid"];

            $user_data = $this->esp_model->get_user_data($userid);

            $html = "";

            if ($user_data != 0) {

                $html .= '<div class="form-group">';
                $html .= '<label>Level<span style="color: red">*</span> &nbsp;</label>';
                $html .= '<select class="employee_data selectpicker"  id="employee_data" name="employee_data" data-live-search="true">';
                $html .= '<option value="">Select Employee</option>';
                foreach ($user_data as $key => $value) {
                    $html .= '<option value="' . $value['id'] . '">' . $value['display_name'] . '</option>';
                }
                $html .= '</select>';
                $html .= '</div>';

            }

            echo $html;
            die;

        } else {
            $userid = $userid;

            $user_data = $this->esp_model->get_user_data($userid);

            return $user_data;

        }

    }

    public function get_pbg_data()
    {

        $user = $this->auth->user();
        $user_country = $user->country_id;

        $pbg_data = $this->esp_model->get_pbg_data($user_country);

        $html = "";

        if ($pbg_data != 0) {

            $html .= '<div class="form-group">';
            $html .= '<label>Select PBG <span style="color: red">*</span> &nbsp;</label>';
            $html .= '<select class="pbg_data selectpicker"  id="pbg_data" name="pbg_data" data-live-search="true">';
            $html .= '<option value="">Select PBG</option>';
            foreach ($pbg_data as $key => $value) {
                $html .= '<option value="' . $value['product_country_id'] . '">' . $value['product_country_name'] . '</option>';
            }
            $html .= '</select>';
            $html .= '</div>';

        }

        echo $html;
        die;

    }

    /*
    * Function Name : get_pbg_sku_data
    * Function Description : Logic For Freeze / Edit / Visiblity of of Forecast data
    *       
    *       check login user equal to freezed user if equal than make data visible and editable else not for   *       login user
    *       If login user is parent of freezed user than he will able to see the forecast data entered by       *       juinor else not        
    */


    public function get_pbg_sku_data($webservice_data = null)
    {


        if ($webservice_data == NULL) {

            //IF NOT WEBSERVICE

            $user = $this->auth->user();
            $login_user_id = $user->id;

            $pbgid = $_POST["pbgid"];
            $from_month = $_POST["frommonth"];
            $to_month = $_POST["tomonth"];

            $businesscode = $_POST["businesscode"];
        } else {

            //IF WEBSERVICE

            $login_user_id = $webservice_data['login_user_id'];

            $pbgid = $webservice_data['pbg_id'];
            $from_month = $webservice_data['from_month'];
            $to_month = $webservice_data['to_month'];

            $businesscode = $webservice_data['business_code'];


            //testdata($webservice_data);

        }

        // GET BUSSINESS CODE USER ID

        $bussiness_code_userdata = $this->esp_model->get_user_data_from_bussinesscode($businesscode);

        $bussinesscode_user_id = $bussiness_code_userdata[0]["id"];

        //echo $bussinesscode_user_id;
        //die;

        $pbg_sku_data = $this->esp_model->get_pbg_sku_data($pbgid);
        $month_data = $this->get_monthly_data($from_month, $to_month);

        //testdata($month_data);

        $assumption_data = $this->esp_model->get_assumption_data();

        $lock_show_data = $this->get_user_level_data($login_user_id);

        $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);

        $login_user_highest_level_data = $this->esp_model->get_higher_level_employee_for_loginuser($login_user_id);
        //dumpme($login_user_highest_level_data);
        // testdata($login_user_highest_level_data);

        $global_head_user = array();

        $login_user_all_parent_data = $this->esp_model->get_employee_for_loginuser($login_user_id, $global_head_user);

        $html = "";
        $html1 = "";
        $html2 = "";
        $freeze_button_data = "";
        $webservice_final_array = array();

        $employee_month_product_forecast_data = 0;


        $forecast_id = "";
        $forecast_freeze_data2 = "";

        if ($pbg_sku_data != 0) {

            $html .= '<table class="col-md-12 table-bordered table-striped table-condensed cf inpt-right-aln">';
            $html .= '<thead>';
            $html .= '<tr style="border-bottom: solid 1px #b1b1b1;">';
            $html .= '<th></th>';


            $lock_data = "";
            $l_array = array();

            $header_final_array = array();


            foreach ($month_data as $monthkey => $monthvalue) {

                $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary freeze_data" id="freeze_data" rel="' . $monthvalue . '">Freeze</button></div>';

                $header_final_array[$monthvalue]["freeze_button"] = 1;

                // if($forecast_id == ""){

                foreach ($pbg_sku_data as $skukey => $skuvalue) {

                    //   $employee_month_product_forecast_data2 = $this->esp_model->get_employee_month_product_forecast_data($businesscode,$skuvalue['product_sku_country_id'],$monthvalue);

                    $employee_month_product_forecast_data2 = $this->esp_model->get_employee_product_forecast_data($businesscode, $pbgid, $bussinesscode_user_id);

                    // dumpme($employee_month_product_forecast_data2);

                    //  echo "HERE";
                    //  die;

                    if ($employee_month_product_forecast_data2 != 0) {
                        $forecast_id = $employee_month_product_forecast_data2[0]['forecast_id'];

                        //$forecast_freeze_data2 = $this->esp_model->get_forecast_freeze_status($forecast_id);

                        //   echo $forecast_id."====".$login_user_id;

                        $forecast_freeze_data2 = $this->esp_model->forecast_freeze_status_history($forecast_id, $monthvalue, $login_user_id);

                        if ($forecast_freeze_data2 != 0) {
                            if (!empty($forecast_freeze_data2) && $forecast_freeze_data2["freeze_status"] == 0) {
                                $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary freeze_data" id="freeze_data" rel="' . $monthvalue . '">Freeze</button></div>';


                                $freeze_button_data = 1;

                            } else {
                                $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary freeze_data" id="freeze_data" rel="' . $monthvalue . '">Unfreeze</button></div>';

                                $freeze_button_data = 0;

                            }
                        } else {
                            $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary freeze_data" id="freeze_data" rel="' . $monthvalue . '">Freeze</button></div>';

                            $freeze_button_data = 1;

                        }


                        break;
                    }

                }

                // echo $login_user_highest_level_data ."== ".$login_user_id;

                if ($login_user_highest_level_data == $login_user_id) {
                    $freeze_button = '';
                    $freeze_button_data = "";
                }


                $child_user_data = $this->esp_model->get_user_selected_level_data($login_user_id, null);

                //testdata($child_user_data);

                $child_forecast_array = array();

                $child_flag = 0;

                if (!empty($child_user_data["level_users"])) {

                    $user_data = explode(",", $child_user_data["level_users"]);

                    foreach ($user_data as $user_key => $userdata) {
                        $child_forecast_data = $this->esp_model->get_forecast_freeze_status($forecast_id, $userdata, $monthvalue);
                        if ($child_forecast_data != 0 && $child_forecast_data["freeze_status"] == 1)
                            $child_forecast_array[] = $child_forecast_data;
                    }
                }

                $child_forecast_array = array_filter($child_forecast_array);

                if (count($child_forecast_array) > 0) {
                    $child_flag = 1;
                }


                $self_freeze_status = $this->esp_model->get_forecast_freeze_status($forecast_id, $login_user_id, $monthvalue);

                //GET ANY SENIOR USER LOCKED OR NOT DATA

                $senior_lock_data = array();

                if (!empty($login_user_all_parent_data)) {
                    foreach ($login_user_all_parent_data as $parent_key => $parentid) {
                        $get_senioruser_lock_status = $this->esp_model->senior_forecast_lock_status($parentid, $forecast_id, $monthvalue);
                        if (!empty($get_senioruser_lock_status) || $get_senioruser_lock_status != 0) {
                            if ($get_senioruser_lock_status[0]["lock_status"] == 1) {
                                $senior_lock_data[] = 1;
                            }
                        }

                    }
                }

                if (in_array(1, $senior_lock_data)) {

                    //SHOW LOCK and make it NON CLICKABLE

                    $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;pointer-events: none;opacity: 0.7;' rel='" . $monthvalue . "' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true''></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Unlock' /></a></div>";

                    // $nonclickable = 1;

                    $header_final_array[$monthvalue]["lockdata"] = 1;
                    $header_final_array[$monthvalue]["clickable"] = 0;

                    //  $lock_data = "lock";

                } else {

                    //GET HIS OWN DATA and make it CLICKABLE

                    if ($lock_show_data != 0) {

                        //IF USER HAVING CHILD


                        //IF SENIOR IS NOT LOCKED AND USER HAVING CHILD DATA

                        $self_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_id, $monthvalue, $forecast_id);

                        if ($self_lock_data != 0) {

                            if ($self_lock_data[0]["lock_status"] != 0) {

                                if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                {
                                    $style = " pointer-events: none;opacity: 0.7; ";

                                   // $final_lock_array["clickable"] = 0;
                                    $header_final_array[$monthvalue]["clickable"] = 0;

                                }
                                else{
                                    $style = "";
                                    //$final_lock_array["clickable"] = 1;
                                    $header_final_array[$monthvalue]["clickable"] = 1;
                                }


                                $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;".$style."' rel='" . $monthvalue . "' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true''></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Unlock' /></a></div>";

                                //  $header_final_array[$monthvalue]['lockdata'] = 1;


                                $header_final_array[$monthvalue]["lockdata"] = 1;


                            } else {


                                if ($child_flag == 1) {


                                    if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                    {
                                        $style = " pointer-events: none;opacity: 0.7; ";

                                        // $final_lock_array["clickable"] = 0;
                                        $header_final_array[$monthvalue]["clickable"] = 0;

                                    }
                                    else{
                                        $style = "";
                                        //$final_lock_array["clickable"] = 1;
                                        $header_final_array[$monthvalue]["clickable"] = 1;
                                    }


                                    $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;".$style."' rel='" . $monthvalue . "' href='javascript:void(0);' class='lock_data' ><i class='fa fa-unlock-alt' aria-hidden='true''></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Lock' /></a></div>";

                                    //$header_final_array[$monthvalue]['lockdata'] = 0;

                                    $header_final_array[$monthvalue]["lockdata"] = 0;
                                   // $header_final_array[$monthvalue]["clickable"] = 1;

                                } else {

                                    $lock_data = "";

                                    //$header_final_array[$monthvalue]['lockdata'] = 0;

                                    $header_final_array[$monthvalue]["lockdata"] = "";
                                    $header_final_array[$monthvalue]["clickable"] = "";

                                    $freeze_button = '';
                                    $freeze_button_data = "";

                                }

                            }

                        } else {

                            // $get_jouinor_freeze_status = $this->esp_modal->


                            if ($child_flag == 1) {

                                if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                {
                                    $style = " pointer-events: none;opacity: 0.7; ";

                                    // $final_lock_array["clickable"] = 0;
                                    $header_final_array[$monthvalue]["clickable"] = 0;

                                }
                                else{
                                    $style = "";
                                    //$final_lock_array["clickable"] = 1;
                                    $header_final_array[$monthvalue]["clickable"] = 1;
                                }

                                $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;".$style."' rel='" . $monthvalue . "' href='javascript:void(0);' class='lock_data' ><i class='fa fa-unlock-alt' aria-hidden='true'></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Lock' /></a></div>";

                                //$header_final_array[$monthvalue]['lockdata'] = 0;

                                $header_final_array[$monthvalue]["lockdata"] = 0;
                               // $header_final_array[$monthvalue]["clickable"] = 1;
                            } else {

                                $lock_data = "";
                                $header_final_array[$monthvalue]["lockdata"] = "";
                                $header_final_array[$monthvalue]["clickable"] = "";


                                $freeze_button = '';
                                $freeze_button_data = "";

                            }

                        }


                    } else {
                        $lock_data = "";


                        $header_final_array[$monthvalue]["lockdata"] = "";
                        $header_final_array[$monthvalue]["clickable"] = "";

                    }

                }

                $header_final_array[$monthvalue]["freeze_button"] = $freeze_button_data;

                $time = strtotime($monthvalue);
                $month = date("F", $time);
                $year = date("Y", $time);

                $html .= '<th colspan="2"><span class="rts_bordet"></span>' . $month . '-' . $year . '&nbsp;&nbsp;' . $lock_data . '&nbsp;&nbsp;' . $freeze_button . '</th>';

            }


            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<th><span class="rts_bordet"></span>';
            $html .= 'PBG';
            $html .= '</th>';
            foreach ($month_data as $monthkey => $monthvalue) {
                $html .= '<th><span class="rts_bordet"></span>';
                $html .= 'Forecast Qty';
                $html .= '</th>';
                $html .= '<th><span class="rts_bordet"></span>';
                $html .= 'Forecast Value';
                $html .= '</th>';
            }
            $html .= '<th><span class="rts_bordet"></span>';
            $html .= 'Yearly';
            $html .= '</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            $i = 1;

            //    $forecast_id = "";


            foreach ($pbg_sku_data as $skukey => $skuvalue) {
                $html .= '<tr>';
                $html .= '<td><input type="hidden" name="product_sku_id[]" value="' . $skuvalue['product_sku_country_id'] . '" />' . $skuvalue['product_sku_name'] . '</td>';

                $l = 1;

                foreach ($month_data as $monthkey => $monthvalue) {


                    $time = strtotime($monthvalue);
                    $month = date("F", $time);
                    $year = date("Y", $time);

                    $employee_month_product_forecast_data = $this->esp_model->get_employee_month_product_forecast_data($businesscode, $skuvalue['product_sku_country_id'], $monthvalue);

                    //  $employee_month_product_forecast_data = $this->esp_model->get_employee_product_forecast_data($businesscode,$pbgid,$bussinesscode_user_id);


                    // echo $monthvalue;
                    //  dumpme($employee_month_product_forecast_data);


                    $forecast_qty = "";
                    $forecast_value = "";

                    $lock_status = "";
                    $lock_by_id = "";

                    //    $freeze_by_id = "";
                    $freeze_status = "";


                    if ($employee_month_product_forecast_data != 0) {

                        $forecast_qty = $employee_month_product_forecast_data[0]['forecast_quantity'];
                        $forecast_value = $employee_month_product_forecast_data[0]['forecast_value'];


                        $lock_status = $employee_month_product_forecast_data[0]['lock_status'];
                        $lock_by_id = $employee_month_product_forecast_data[0]['lock_by_id'];

                        //    $forecast_id = $employee_month_product_forecast_data[0]['forecast_id'];

                    }

                    // echo $forecast_id;die;


                    //   dumpme($employee_month_product_forecast_data);

                    //if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
                    $data_inner_array = array();
                    //}


                    //CHECK DATA FREEZED OR NOT

                    //    echo $forecast_id."===".$login_user_id."===".$monthvalue;

                    $forecast_freeze_data = $this->esp_model->get_forecast_freeze_status($forecast_id, $login_user_id, $monthvalue);

                    $child_user_data = $this->esp_model->get_user_selected_level_data($login_user_id, null);

                    $child_forecast_array = array();

                    $child_flag = 0;

                    if (!empty($child_user_data["level_users"])) {

                        $user_data = explode(",", $child_user_data["level_users"]);

                        foreach ($user_data as $user_key => $userdata) {
                            $child_forecast_data = $this->esp_model->get_forecast_freeze_status($forecast_id, $userdata, $monthvalue);

                            if ($child_forecast_data != 0 && $child_forecast_data["freeze_status"] == 1)
                                $child_forecast_array[] = $child_forecast_data;

                        }
                    }

                    $child_forecast_array = array_filter($child_forecast_array);

                    if (count($child_forecast_array) > 0) {
                        $child_flag = 1;
                    }

                    // echo "asasa";
                    // dumpme($forecast_freeze_data);

                    if ($forecast_freeze_data != 0 || $child_flag == 1) {

                        // echo "UMMED";
                        //    dumpme($forecast_freeze_data);
                        //     echo $monthvalue."===".$forecast_freeze_data["created_by_user"]." ==". $login_user_id;

                        if ($forecast_freeze_data["freeze_status"] == 1 || $forecast_freeze_data["created_by_user"] == $login_user_id) {


                            //SHOW DATA

                            //  echo "1";

                            $editable = "";


                            $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);

                            $locked_user_parent_data = $this->esp_model->get_freeze_user_parent_data($lock_by_id);
                            //   dumpme($locked_user_parent_data);


                            $senior_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_parent_data, $monthvalue, $forecast_id);

                           // testdata($senior_lock_data);

                            $highest_user_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_highest_level_data, $monthvalue, $forecast_id);

                            $logib_user_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_id, $monthvalue, $forecast_id);

                            if (!empty($login_user_all_parent_data)) {
                                foreach ($login_user_all_parent_data as $parent_key => $parentid) {
                                    $get_senioruser_lock_status = $this->esp_model->senior_forecast_lock_status($parentid, $forecast_id, $monthvalue);
                                    if (!empty($get_senioruser_lock_status) || $get_senioruser_lock_status != 0) {
                                        if ($get_senioruser_lock_status[0]["lock_status"] == 1) {
                                            $senior_lock_data[] = 1;
                                        }
                                    }

                                }
                            }


                            $self_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_id, $monthvalue, $forecast_id);

                      //  testdata($self_lock_data);

                            $self_freeze_status = $this->esp_model->get_forecast_freeze_status($forecast_id, $login_user_id, $monthvalue);

                         //   testdata($highest_user_lock_data);

                            if ($login_user_highest_level_data == $login_user_id) {


                                if($highest_user_lock_data != 0 && $highest_user_lock_data[0]["lock_status"] == 1)
                                {
                                    $editable = "";
                                }
                                else
                                {
                                    $editable = "readonly";
                                }

                                //   echo "aaa".$monthvalue."</br>";
                            } else {

                                /*
                                if ($senior_lock_data != 0 && $senior_lock_data[0]["lock_status"] == 1) {

                                    $editable = "readonly";
                                    //   echo "bbb".$monthvalue."</br>";

                                }
                                elseif ($senior_lock_data == 0 || $senior_lock_data[0]["lock_status"] == 0)
                                {

                                    if ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 1) {
                                        //    echo "ccc".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }

                                       //$editable = "";
                                    } elseif ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0) {
                                        //    echo "ddd".$monthvalue."</br>";


                                        $editable = "readonly";
                                    } elseif ($self_lock_data == 0 && $forecast_freeze_data["freeze_status"] == 0) {                                    //echo "fff".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }

                                       // $editable = "";
                                    } else {
                                        //   echo "eee".$monthvalue."</br>";
                                        $editable = "readonly";
                                    }
                                }

                                */


                                if ($senior_lock_data != 0 && $senior_lock_data[0]["lock_status"] == 1) {

                                    $editable = "readonly";
                                    //  echo "bbb".$monthvalue."</br>";

                                }
                                elseif ($senior_lock_data == 0 || $senior_lock_data[0]["lock_status"] == 0)
                                {

                                    if ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 1)
                                    {
                                        //     echo "ccc".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }


                                        // $editable = "";
                                    }
                                    elseif ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0 && ($login_user_id != $employee_month_product_forecast_data[0]["created_by_user"]))
                                    {
                                        //  echo "ddd".$monthvalue."</br>";
                                        $editable = "readonly";
                                    }
                                    elseif($self_lock_data == 0 && $forecast_freeze_data["freeze_status"] == 0 && ($login_user_id == $employee_month_product_forecast_data[0]["created_by_user"]))
                                    {
                                        //echo "fff".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }


                                        //   $editable = "";
                                    }
                                    elseif($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0 && ($login_user_id == $employee_month_product_forecast_data[0]["created_by_user"])){

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }

                                        // $editable = "";
                                    }
                                    else
                                    {
                                        // echo "eee".$monthvalue."</br>";
                                        $editable = "readonly";
                                    }
                                }

                            }


                            //    if($forecast_freeze_data["freeze_status"] == 0){

                            //    }


                            $html .= '<td><input rel="' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" class="forecast_qty" id="forecast_qty_' . $l . '_' . $skuvalue['product_sku_country_id'] . '" type="text" name="forecast_qty[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $forecast_qty . '" ' . $editable . '  /></td>';

                            $html .= '<td><input id="forecast_value_' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" type="text" name="forecast_value[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $forecast_value . '" readonly /></td>';

                            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {
                                $data_inner_array["forecast_qty"] = $forecast_qty;
                                $data_inner_array["forecast_value"] = $forecast_value;

                                $data_inner_array["editable"] = $editable;
                            }


                        } elseif ($child_flag == 1) {

                            //  echo "2";


                            $editable = "";


                            $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);

                            $locked_user_parent_data = $this->esp_model->get_freeze_user_parent_data($lock_by_id);
                            //   dumpme($locked_user_parent_data);


                            $senior_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_parent_data, $monthvalue, $forecast_id);

                            $highest_user_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_highest_level_data, $monthvalue, $forecast_id);

                            $logib_user_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_id, $monthvalue, $forecast_id);


                            $self_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_id, $monthvalue, $forecast_id);

                           // testdata($self_lock_data);

                            $self_freeze_status = $this->esp_model->get_forecast_freeze_status($forecast_id, $login_user_id, $monthvalue);

                         //   testdata($self_freeze_status);

                            if (!empty($login_user_all_parent_data)) {
                                foreach ($login_user_all_parent_data as $parent_key => $parentid) {
                                    $get_senioruser_lock_status = $this->esp_model->senior_forecast_lock_status($parentid, $forecast_id, $monthvalue);
                                    if (!empty($get_senioruser_lock_status) || $get_senioruser_lock_status != 0) {
                                        if ($get_senioruser_lock_status[0]["lock_status"] == 1) {
                                            $senior_lock_data[] = 1;
                                        }
                                    }

                                }
                            }


                            if ($login_user_highest_level_data == $login_user_id) {


                                if($highest_user_lock_data != 0 && $highest_user_lock_data[0]["lock_status"] == 1)
                                {
                                    $editable = "";
                                }
                                else
                                {
                                    $editable = "readonly";
                                }
                               // $editable = "";

                                //   echo "aaa".$monthvalue."</br>";
                            } else {
                                /*
                                if ($senior_lock_data != 0 && $senior_lock_data[0]["lock_status"] == 1) {

                                    $editable = "readonly";
                                    //  echo "bbb".$monthvalue."</br>";

                                } elseif ($senior_lock_data == 0 || $senior_lock_data[0]["lock_status"] == 0) {

                                    if ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 1) {
                                        //     echo "ccc".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }

                                       // $editable = "";
                                    } elseif ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0) {
                                        //     echo "ddd".$monthvalue."</br>";
                                        $editable = "readonly";
                                    }
                                    //    elseif($self_lock_data == 0 && $forecast_freeze_data["freeze_status"] == 0){
                                    //    echo "fff".$monthvalue."</br>";
                                    //        $editable = "";
                                    //    }
                                    else {
                                        //    echo "eee".$monthvalue."</br>";
                                        $editable = "readonly";
                                    }


                                }

                                */


                                if ($senior_lock_data != 0 && $senior_lock_data[0]["lock_status"] == 1) {

                                    $editable = "readonly";
                                    //  echo "bbb".$monthvalue."</br>";

                                }
                                elseif ($senior_lock_data == 0 || $senior_lock_data[0]["lock_status"] == 0)
                                {

                                    if ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 1)
                                    {
                                        //     echo "ccc".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }


                                        // $editable = "";
                                    }
                                    elseif ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0 && ($login_user_id != $employee_month_product_forecast_data[0]["created_by_user"]))
                                    {
                                        //  echo "ddd".$monthvalue."</br>";
                                        $editable = "readonly";
                                    }
                                    elseif($self_lock_data == 0 && $forecast_freeze_data["freeze_status"] == 0 && ($login_user_id == $employee_month_product_forecast_data[0]["created_by_user"]))
                                    {
                                        //echo "fff".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }


                                        //   $editable = "";
                                    }
                                    elseif($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0 && ($login_user_id == $employee_month_product_forecast_data[0]["created_by_user"])){

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }

                                        // $editable = "";
                                    }
                                    else
                                    {
                                        // echo "eee".$monthvalue."</br>";
                                        $editable = "readonly";
                                    }
                                }


                            }


                            //SHOW DATA

                            $html .= '<td><input rel="' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" class="forecast_qty" id="forecast_qty_' . $l . '_' . $skuvalue['product_sku_country_id'] . '" type="text" name="forecast_qty[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $forecast_qty . '" ' . $editable . '  /></td>';

                            $html .= '<td><input id="forecast_value_' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" type="text" name="forecast_value[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $forecast_value . '" readonly /></td>';

                            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {
                                $data_inner_array["forecast_qty"] = $forecast_qty;
                                $data_inner_array["forecast_value"] = $forecast_value;

                                $data_inner_array["editable"] = $editable;
                            }


                        } else {

                            //  echo "3";

                            $html .= '<td><input rel="' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" class="forecast_qty" id="forecast_qty_' . $l . '_' . $skuvalue['product_sku_country_id'] . '" type="text" name="forecast_qty[' . $skuvalue['product_sku_country_id'] . '][]" value=""   /></td>';

                            $html .= '<td><input id="forecast_value_' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" type="text" name="forecast_value[' . $skuvalue['product_sku_country_id'] . '][]" value="" readonly /></td>';

                            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {
                                $data_inner_array["forecast_qty"] = "";
                                $data_inner_array["forecast_value"] = "";

                                $data_inner_array["editable"] = "";
                            }


                        }


                    } else {

                        //   dumpme($forecast_freeze_data);
                        //    echo $login_user_id." == ".$forecast_freeze_data['created_by_user'];

                        if ($login_user_id == $employee_month_product_forecast_data[0]['created_by_user']) {

                            //   echo "4";

                            $editable = "";
                            $self_freeze_status = $this->esp_model->get_forecast_freeze_status($forecast_id, $login_user_id, $monthvalue);

                            if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                            {
                                $editable = "readonly";
                            }
                            else
                            {
                                $editable = "";
                            }


                            $html .= '<td><input rel="' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" class="forecast_qty" id="forecast_qty_' . $l . '_' . $skuvalue['product_sku_country_id'] . '" type="text" name="forecast_qty[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $forecast_qty . '"  '.$editable.'/></td>';

                            $html .= '<td><input id="forecast_value_' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" type="text" name="forecast_value[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $forecast_value . '" readonly /></td>';

                            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {
                                $data_inner_array["forecast_qty"] = $forecast_qty;
                                $data_inner_array["forecast_value"] = $forecast_value;

                                $data_inner_array["editable"] = "";
                            }

                        } else {

                            //  echo "5";
                            //NOT FREZEED
                            $html .= '<td><input rel="' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" class="forecast_qty" id="forecast_qty_' . $l . '_' . $skuvalue['product_sku_country_id'] . '" type="text" name="forecast_qty[' . $skuvalue['product_sku_country_id'] . '][]" value=""   /></td>';

                            $html .= '<td><input id="forecast_value_' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" type="text" name="forecast_value[' . $skuvalue['product_sku_country_id'] . '][]" value="" readonly /></td>';

                            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {
                                $data_inner_array["forecast_qty"] = "";
                                $data_inner_array["forecast_value"] = "";

                                $data_inner_array["editable"] = "";
                            }
                        }

                    }


                    if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {

                        //$data_inner_array = array();

                        //$data_inner_array["forecastid"] = $forecast_id;


                        $data_inner_array["productid"] = $skuvalue['product_sku_country_id'];
                        $data_inner_array["productname"] = $skuvalue['product_sku_name'];
                        //$data_inner_array["forecast_qty"] = $forecast_qty;
                        //$data_inner_array["forecast_value"] = $forecast_value;

                        $webservice_final_array[$monthvalue]["monthvalue"] = $monthvalue;
                        $webservice_final_array[$monthvalue]["monthname"] = $month . "-" . $year;

                        $webservice_final_array[$monthvalue]['productdata'][] = $data_inner_array;
                        if ($lock_status == "") {
                            $lock_status = 0;
                        }
                        $webservice_final_array[$monthvalue]["lock_status"] = $lock_status;


                    }

                    $l++;
                }

                $html .= '<td></td>';
                $html .= '</tr>';

            }
            // dumpme($webservice_final_array);
            // die;

            $html .= '<tr>';
            $html .= '<th>';
            //  $html .= '';
            foreach ($month_data as $monthkey => $monthvalue) {

                $html .= '<input type="hidden" name="month_data[]" value="' . $monthvalue . '" />';
                $html .= '<td>Assumption</td><td>Probability</td>';
            }

            $html .= '</th>';
            $html .= '</tr>';


            $assumption_name_array = array();

            $assumption_month = array();
            $probablity_month = array();

            $lock_status_array = array();


            foreach ($month_data as $monthkey => $monthvalue) {

                $month_assumption_forecast_data = $this->esp_model->get_month_assumption_forecast_data($forecast_id, $monthvalue);
                //  dumpme($month_assumption_forecast_data);


                $employee_month_product_forecast_data = 0;

                foreach ($pbg_sku_data as $skukey => $skuvalue) {

                    $employee_month_product_forecast_data = $this->esp_model->get_employee_month_product_forecast_data($businesscode, $skuvalue['product_sku_country_id'], $monthvalue);
                }


                if ($month_assumption_forecast_data != 0) {
                    $cur_month = $month_assumption_forecast_data[0]['month_data'];

                    if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {

                        if (isset($month_assumption_forecast_data[0]["assumption1_id"]) && $month_assumption_forecast_data[0]["assumption1_id"] != "") {
                            $assumption1_id = $month_assumption_forecast_data[0]["assumption1_id"];

                            $assumption1 = $month_assumption_forecast_data[0]["assumption1"];

                        } else {
                            $assumption1_id = "";
                            $assumption1 = "";
                        }

                        if (isset($month_assumption_forecast_data[0]["assumption2_id"]) && $month_assumption_forecast_data[0]["assumption2_id"] != "") {
                            $assumption2_id = $month_assumption_forecast_data[0]["assumption2_id"];

                            $assumption2 = $month_assumption_forecast_data[0]["assumption2"];

                        } else {
                            $assumption2_id = "";
                            $assumption2 = "";
                        }

                        if (isset($month_assumption_forecast_data[0]["assumption3_id"]) && $month_assumption_forecast_data[0]["assumption3_id"] != "") {
                            $assumption3_id = $month_assumption_forecast_data[0]["assumption3_id"];
                            $assumption3 = $month_assumption_forecast_data[0]["assumption3"];
                        } else {
                            $assumption3_id = "";
                            $assumption3 = "";
                        }


                        if (isset($month_assumption_forecast_data[0]["probability1"]) && $month_assumption_forecast_data[0]["probability1"] != "") {
                            $probability1 = $month_assumption_forecast_data[0]["probability1"];
                        } else {
                            $probability1 = "";
                        }

                        if (isset($month_assumption_forecast_data[0]["probability2"]) && $month_assumption_forecast_data[0]["probability2"] != "") {
                            $probability2 = $month_assumption_forecast_data[0]["probability2"];
                        } else {
                            $probability2 = "";
                        }

                        if (isset($month_assumption_forecast_data[0]["probability3"]) && $month_assumption_forecast_data[0]["probability3"] != "") {
                            $probability3 = $month_assumption_forecast_data[0]["probability3"];
                        } else {
                            $probability3 = "";
                        }

                        $assumption_month[$cur_month] = array($assumption1_id, $assumption2_id, $assumption3_id);

                        $probablity_month[$cur_month] = array($probability1, $probability2, $probability3);


                        $assumption_name_array[$cur_month] = array($assumption1, $assumption2, $assumption3);


                    } else {
                        $assumption_month[$cur_month] = array($month_assumption_forecast_data[0]["assumption1_id"], $month_assumption_forecast_data[0]["assumption2_id"], $month_assumption_forecast_data[0]["assumption3_id"]);

                        $probablity_month[$cur_month] = array($month_assumption_forecast_data[0]["probability1"], $month_assumption_forecast_data[0]["probability2"], $month_assumption_forecast_data[0]["probability3"]);
                    }

                } else {

                    if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {

                        if (isset($month_assumption_forecast_data[0]["assumption1_id"]) && $month_assumption_forecast_data[0]["assumption1_id"] != "") {
                            $assumption1_id = $month_assumption_forecast_data[0]["assumption1_id"];
                            $assumption1 = $month_assumption_forecast_data[0]["assumption1"];
                        } else {
                            $assumption1_id = "";
                            $assumption1 = "";
                        }

                        if (isset($month_assumption_forecast_data[0]["assumption2_id"]) && $month_assumption_forecast_data[0]["assumption2_id"] != "") {
                            $assumption2_id = $month_assumption_forecast_data[0]["assumption2_id"];
                            $assumption2 = $month_assumption_forecast_data[0]["assumption2"];
                        } else {
                            $assumption2_id = "";
                            $assumption2 = "";
                        }

                        if (isset($month_assumption_forecast_data[0]["assumption3_id"]) && $month_assumption_forecast_data[0]["assumption3_id"] != "") {
                            $assumption3_id = $month_assumption_forecast_data[0]["assumption3_id"];
                            $assumption3 = $month_assumption_forecast_data[0]["assumption3"];
                        } else {
                            $assumption3_id = "";
                            $assumption3 = "";
                        }


                        if (isset($month_assumption_forecast_data[0]["probability1"]) && $month_assumption_forecast_data[0]["probability1"] != "") {
                            $probability1 = $month_assumption_forecast_data[0]["probability1"];
                        } else {
                            $probability1 = "";
                        }

                        if (isset($month_assumption_forecast_data[0]["probability2"]) && $month_assumption_forecast_data[0]["probability2"] != "") {
                            $probability2 = $month_assumption_forecast_data[0]["probability2"];
                        } else {
                            $probability2 = "";
                        }

                        if (isset($month_assumption_forecast_data[0]["probability3"]) && $month_assumption_forecast_data[0]["probability3"] != "") {
                            $probability3 = $month_assumption_forecast_data[0]["probability3"];
                        } else {
                            $probability3 = "";
                        }

                        $assumption_month[$monthvalue] = array($assumption1_id, $assumption2_id, $assumption3_id);

                        $probablity_month[$monthvalue] = array($probability1, $probability2, $probability3);


                        $assumption_name_array[$monthvalue] = array($assumption1, $assumption2, $assumption3);


                    } else {

                        $assumption_month[$monthvalue] = array();
                        $probablity_month[$monthvalue] = array();

                        $assumption_name_array[$monthvalue] = array();

                    }
                }

                $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);

                $month_assumption_forecast_lock_data = $this->esp_model->get_month_assumption_forecast_lock_data($forecast_id, $login_user_parent_data, $monthvalue);

                if ($month_assumption_forecast_lock_data != 0) {
                    $lock_status_array[$monthvalue] = $month_assumption_forecast_lock_data[0]["lock_status"];
                } else {
                    $lock_status_array[$monthvalue] = "";
                }


                /*
				if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
							
					$data_assumption_inner_array = array();
					
					
					$webservice_final_array[$monthvalue]['assumptiondata'] = $assumption_month[$monthvalue];
					$webservice_final_array[$monthvalue]['assumption_name_data'] = $assumption_name_array[$monthvalue];
					
					$webservice_final_array[$monthvalue]['probablitydata'] = $probablity_month[$monthvalue];
					
				}

                */


                $forecast_freeze_data = $this->esp_model->get_forecast_freeze_status($forecast_id, $login_user_id, $monthvalue);

                $child_user_data = $this->esp_model->get_user_selected_level_data($login_user_id, null);

                $child_forecast_array = array();

                $child_flag = 0;

                if (!empty($child_user_data["level_users"])) {

                    $user_data = explode(",", $child_user_data["level_users"]);

                    foreach ($user_data as $user_key => $userdata) {
                        // $child_forecast_array[] = $this->esp_model->get_forecast_freeze_status($forecast_id,$userdata,$monthvalue);

                        $child_forecast_data = $this->esp_model->get_forecast_freeze_status($forecast_id, $userdata, $monthvalue);

                        if ($child_forecast_data != 0 && $child_forecast_data["freeze_status"] == 1)
                            $child_forecast_array[] = $child_forecast_data;


                    }
                }

                $child_forecast_array = array_filter($child_forecast_array);

                // echo count($child_forecast_array);

                if (count($child_forecast_array) > 0) {
                    $child_flag = 1;
                }


                //CHECK DATA FREEZED OR NOT

                if ($forecast_freeze_data != 0 || $child_flag == 1) {

                    if ($forecast_freeze_data["freeze_status"] == 1 || $forecast_freeze_data["created_by_user"] == $login_user_id) {


                        //SHOW DATA

                        if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {

                            $data_assumption_inner_array = array();

                            $webservice_final_array[$monthvalue]['assumptiondata'] = $assumption_month[$monthvalue];
                            $webservice_final_array[$monthvalue]['assumption_name_data'] = $assumption_name_array[$monthvalue];

                            $webservice_final_array[$monthvalue]['probablitydata'] = $probablity_month[$monthvalue];

                        }


                    } elseif ($child_flag == 1) {
                        //SHOW DATA


                        if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {

                            $data_assumption_inner_array = array();

                            $webservice_final_array[$monthvalue]['assumptiondata'] = $assumption_month[$monthvalue];
                            $webservice_final_array[$monthvalue]['assumption_name_data'] = $assumption_name_array[$monthvalue];

                            $webservice_final_array[$monthvalue]['probablitydata'] = $probablity_month[$monthvalue];

                        }

                    } else {
                        //DONT SHOW


                        if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {

                            $data_assumption_inner_array = array();

                            $webservice_final_array[$monthvalue]['assumptiondata'] = array("", "", "");
                            $webservice_final_array[$monthvalue]['assumption_name_data'] = array("", "", "");

                            $webservice_final_array[$monthvalue]['probablitydata'] = array("", "", "");

                        }
                    }
                } else {
                    //DONT SHOW

                    //   echo "4";

                    if ($login_user_id == $employee_month_product_forecast_data[0]['created_by_user']) {

                        if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {

                            $data_assumption_inner_array = array();

                            $webservice_final_array[$monthvalue]['assumptiondata'] = $assumption_month[$monthvalue];
                            $webservice_final_array[$monthvalue]['assumption_name_data'] = $assumption_name_array[$monthvalue];

                            $webservice_final_array[$monthvalue]['probablitydata'] = $probablity_month[$monthvalue];

                        }

                    } else {


                        if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {

                            $data_assumption_inner_array = array();

                            $webservice_final_array[$monthvalue]['assumptiondata'] = array("", "", "");
                            $webservice_final_array[$monthvalue]['assumption_name_data'] = array("", "", "");

                            $webservice_final_array[$monthvalue]['probablitydata'] = array("", "", "");

                        }


                    }

                }


            }


            $k = 1;

            $final_data = array();

            for ($a = 1; $a <= 3; $a++) {

                $html .= '<tr>';
                $html .= '<td></td>';

                $j = 1;

                foreach ($month_data as $monthkey => $monthvalue) {

                    $employee_month_product_forecast_data = 0;

                    foreach ($pbg_sku_data as $skukey => $skuvalue) {

                        $employee_month_product_forecast_data = $this->esp_model->get_employee_month_product_forecast_data($businesscode, $skuvalue['product_sku_country_id'], $monthvalue);
                    }


                    $html .= '<td>';

                    //FOR GETTING ASSUMPTION DATA

                    if (isset($assumption_month[$monthvalue][$a - 1]) && !empty($assumption_month[$monthvalue][$a - 1])) {
                        $assumptiondata = $assumption_month[$monthvalue][$a - 1];

                    } else {
                        $assumptiondata = "";
                    }

                    //FOR GETTING PROBABLITY DATA

                    if (isset($probablity_month[$monthvalue][$a - 1]) && !empty($probablity_month[$monthvalue][$a - 1])) {
                        $probablitydata = $probablity_month[$monthvalue][$a - 1];
                    } else {
                        $probablitydata = "";
                    }

                    if ($lock_status_array[$monthvalue] == 1) {
                        $assumption_editable = "disabled";
                        $probablity_editable = "readonly";
                    } else {
                        $assumption_editable = "";
                        $probablity_editable = "";
                    }


                    $forecast_freeze_data = $this->esp_model->get_forecast_freeze_status($forecast_id, $login_user_id, $monthvalue);

                    $child_user_data = $this->esp_model->get_user_selected_level_data($login_user_id, null);

                    $child_forecast_array = array();

                    $child_flag = 0;

                    if (!empty($child_user_data["level_users"])) {

                        $user_data = explode(",", $child_user_data["level_users"]);

                        foreach ($user_data as $user_key => $userdata) {
                            // $child_forecast_array[] = $this->esp_model->get_forecast_freeze_status($forecast_id,$userdata,$monthvalue);

                            $child_forecast_data = $this->esp_model->get_forecast_freeze_status($forecast_id, $userdata, $monthvalue);

                            if ($child_forecast_data != 0 && $child_forecast_data["freeze_status"] == 1)
                                $child_forecast_array[] = $child_forecast_data;


                        }
                    }

                    $child_forecast_array = array_filter($child_forecast_array);

                    // echo count($child_forecast_array);

                    if (count($child_forecast_array) > 0) {
                        $child_flag = 1;
                    }


                    //CHECK DATA FREEZED OR NOT

                    if ($forecast_freeze_data != 0 || $child_flag == 1) {

                        if ($forecast_freeze_data["freeze_status"] == 1 || $forecast_freeze_data["created_by_user"] == $login_user_id) {

                            // echo "1";
                            //SHOW DATA


                            $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);

                            $locked_user_parent_data = $this->esp_model->get_freeze_user_parent_data($lock_by_id);
                            //   dumpme($locked_user_parent_data);


                            $senior_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_parent_data, $monthvalue, $forecast_id);

                            $highest_user_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_highest_level_data, $monthvalue, $forecast_id);

                            $logib_user_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_id, $monthvalue, $forecast_id);

                            if (!empty($login_user_all_parent_data)) {
                                foreach ($login_user_all_parent_data as $parent_key => $parentid) {
                                    $get_senioruser_lock_status = $this->esp_model->senior_forecast_lock_status($parentid, $forecast_id, $monthvalue);
                                    if (!empty($get_senioruser_lock_status) || $get_senioruser_lock_status != 0) {
                                        if ($get_senioruser_lock_status[0]["lock_status"] == 1) {
                                            $senior_lock_data[] = 1;
                                        }
                                    }

                                }
                            }


                            $self_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_id, $monthvalue, $forecast_id);

                            $self_freeze_status = $this->esp_model->get_forecast_freeze_status($forecast_id, $login_user_id, $monthvalue);


                            if ($login_user_highest_level_data == $login_user_id) {

                                if($highest_user_lock_data != 0 && $highest_user_lock_data[0]["lock_status"] == 1)
                                {
                                    $assumption_editable = "";
                                    $probablity_editable = "";
                                }
                                else
                                {
                                    $assumption_editable = "disabled";
                                    $probablity_editable = "readonly";

                                }

                                //   echo "aaa".$monthvalue."</br>";
                            } else {

                                /*
                                if ($senior_lock_data != 0 && $senior_lock_data[0]["lock_status"] == 1) {

                                    $assumption_editable = "disabled";
                                    $probablity_editable = "readonly";
                                    //  echo "bbb".$monthvalue."</br>";

                                } elseif ($senior_lock_data == 0 || $senior_lock_data[0]["lock_status"] == 0) {

                                    if ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 1) {
                                        //     echo "ccc".$monthvalue."</br>";
                                        // $editable = "";



                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                           // $editable = "readonly";

                                            $assumption_editable = "disabled";
                                            $probablity_editable = "readonly";

                                        }
                                        else
                                        {
                                            //$editable = "";

                                            $assumption_editable = "";
                                            $probablity_editable = "";
                                        }

                                      //  $assumption_editable = "";
                                       // $probablity_editable = "";

                                    } elseif ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0) {
                                        //     echo "ddd".$monthvalue."</br>";
                                        //$editable = "readonly";

                                        $assumption_editable = "disabled";
                                        $probablity_editable = "readonly";

                                    } elseif ($self_lock_data == 0 && $forecast_freeze_data["freeze_status"] == 0) {
                                        //    echo "fff".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            // $editable = "readonly";

                                            $assumption_editable = "disabled";
                                            $probablity_editable = "readonly";

                                        }
                                        else
                                        {
                                            //$editable = "";

                                            $assumption_editable = "";
                                            $probablity_editable = "";
                                        }


                                      //  $assumption_editable = "";
                                      //  $probablity_editable = "";
                                    } else {
                                        //    echo "eee".$monthvalue."</br>";
                                        //  $editable = "readonly";

                                        $assumption_editable = "disabled";
                                        $probablity_editable = "readonly";

                                    }
                                }

                                */


                                if ($senior_lock_data != 0 && $senior_lock_data[0]["lock_status"] == 1) {

                                    $assumption_editable = "disabled";
                                    $probablity_editable = "readonly";
                                    //  echo "bbb".$monthvalue."</br>";

                                }
                                elseif ($senior_lock_data == 0 || $senior_lock_data[0]["lock_status"] == 0)
                                {

                                    if ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 1)
                                    {
                                        //     echo "ccc".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $assumption_editable = "disabled";
                                            $probablity_editable = "readonly";
                                        }
                                        else
                                        {
                                            $assumption_editable = "";
                                            $probablity_editable = "";
                                        }


                                        // $editable = "";
                                    }
                                    elseif ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0 && ($login_user_id != $employee_month_product_forecast_data[0]["created_by_user"]))
                                    {
                                        //  echo "ddd".$monthvalue."</br>";
                                        $assumption_editable = "disabled";
                                        $probablity_editable = "readonly";
                                    }
                                    elseif($self_lock_data == 0 && $forecast_freeze_data["freeze_status"] == 0 && ($login_user_id == $employee_month_product_forecast_data[0]["created_by_user"]))
                                    {
                                        //echo "fff".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $assumption_editable = "disabled";
                                            $probablity_editable = "readonly";
                                        }
                                        else
                                        {
                                            $assumption_editable = "";
                                            $probablity_editable = "";
                                        }


                                        //   $editable = "";
                                    }
                                    elseif($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0 && ($login_user_id == $employee_month_product_forecast_data[0]["created_by_user"])){

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $assumption_editable = "disabled";
                                            $probablity_editable = "readonly";
                                        }
                                        else
                                        {
                                            $assumption_editable = "";
                                            $probablity_editable = "";
                                        }

                                        // $editable = "";
                                    }
                                    else
                                    {
                                        // echo "eee".$monthvalue."</br>";
                                        $assumption_editable = "disabled";
                                        $probablity_editable = "readonly";
                                    }
                                }



                            }


                            $html .= '<div class="tp_form">
            <div class="form-group"><select ' . $assumption_editable . ' class="selectpicker assumption_data" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption' . $j . '[]" >

                                <option value= "">Select Assumption</option>';
                            foreach ($assumption_data as $assumption_key => $assumption) {

                                if ($assumption['assumption_id'] == $assumptiondata) {
                                    $selected = "selected='selected'";
                                } else {
                                    $selected = "";
                                }

                                $html .= '<option ' . $selected . ' value= "' . $assumption['assumption_id'] . '">' . $assumption['assumption_name'] . '</option>';
                            }
                            $html .= '</select>';

                            $html .= '</div>
        </div></td><td><input class="probablity_data" type="text" name="probablity' . $j . '[]" value="' . $probablitydata . '" ' . $probablity_editable . ' />';


                        } elseif ($child_flag == 1) {
                            //SHOW DATA

                            //  echo "2";

                            $editable = "";


                            $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);

                            $locked_user_parent_data = $this->esp_model->get_freeze_user_parent_data($lock_by_id);
                            //   dumpme($locked_user_parent_data);


                            $senior_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_parent_data, $monthvalue, $forecast_id);

                            $highest_user_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_highest_level_data, $monthvalue, $forecast_id);

                            $logib_user_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_id, $monthvalue, $forecast_id);

                            if (!empty($login_user_all_parent_data)) {
                                foreach ($login_user_all_parent_data as $parent_key => $parentid) {
                                    $get_senioruser_lock_status = $this->esp_model->senior_forecast_lock_status($parentid, $forecast_id, $monthvalue);
                                    if (!empty($get_senioruser_lock_status) || $get_senioruser_lock_status != 0) {
                                        if ($get_senioruser_lock_status[0]["lock_status"] == 1) {
                                            $senior_lock_data[] = 1;
                                        }
                                    }

                                }
                            }


                            $self_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_id, $monthvalue, $forecast_id);


                            $self_freeze_status = $this->esp_model->get_forecast_freeze_status($forecast_id, $login_user_id, $monthvalue);


                            if ($login_user_highest_level_data == $login_user_id) {

                                if($highest_user_lock_data != 0 && $highest_user_lock_data[0]["lock_status"] == 1)
                                {
                                    $assumption_editable = "";
                                    $probablity_editable = "";
                                }
                                else
                                {
                                    $assumption_editable = "disabled";
                                    $probablity_editable = "readonly";

                                }

                                //$assumption_editable = "";
                                //$probablity_editable = "";

                                //   echo "aaa".$monthvalue."</br>";
                            } else {

                                /*

                                if ($senior_lock_data != 0 && $senior_lock_data[0]["lock_status"] == 1) {

                                    $assumption_editable = "disabled";
                                    $probablity_editable = "readonly";
                                    //  echo "bbb".$monthvalue."</br>";

                                } elseif ($senior_lock_data == 0 || $senior_lock_data[0]["lock_status"] == 0) {

                                    if ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 1) {
                                        //     echo "ccc".$monthvalue."</br>";
                                        // $editable = "";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                           // $editable = "readonly";

                                            $assumption_editable = "disabled";
                                            $probablity_editable = "readonly";
                                        }
                                        else
                                        {
                                            //$editable = "";

                                            $assumption_editable = "";
                                            $probablity_editable = "";
                                        }

                                       // $assumption_editable = "";
                                       // $probablity_editable = "";

                                    } elseif ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0) {
                                        //     echo "ddd".$monthvalue."</br>";
                                        //$editable = "readonly";

                                        $assumption_editable = "disabled";
                                        $probablity_editable = "readonly";

                                    }
                                    //   elseif($self_lock_data == 0 && $forecast_freeze_data["freeze_status"] == 0){
                                    //    echo "fff".$monthvalue."</br>";
                                    //       $assumption_editable = "";
                                    //       $probablity_editable = "";
                                    //   }
                                    else {
                                        //    echo "eee".$monthvalue."</br>";
                                        //  $editable = "readonly";

                                        $assumption_editable = "disabled";
                                        $probablity_editable = "readonly";

                                    }


                                }


                                */

                                if ($senior_lock_data != 0 && $senior_lock_data[0]["lock_status"] == 1) {

                                    $assumption_editable = "disabled";
                                    $probablity_editable = "readonly";
                                    //  echo "bbb".$monthvalue."</br>";

                                }
                                elseif ($senior_lock_data == 0 || $senior_lock_data[0]["lock_status"] == 0)
                                {

                                    if ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 1)
                                    {
                                        //     echo "ccc".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $assumption_editable = "disabled";
                                            $probablity_editable = "readonly";
                                        }
                                        else
                                        {
                                            $assumption_editable = "";
                                            $probablity_editable = "";
                                        }


                                        // $editable = "";
                                    }
                                    elseif ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0 && ($login_user_id != $employee_month_product_forecast_data[0]["created_by_user"]))
                                    {
                                        //  echo "ddd".$monthvalue."</br>";
                                        $assumption_editable = "disabled";
                                        $probablity_editable = "readonly";
                                    }
                                    elseif($self_lock_data == 0 && $forecast_freeze_data["freeze_status"] == 0 && ($login_user_id == $employee_month_product_forecast_data[0]["created_by_user"]))
                                    {
                                        //echo "fff".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $assumption_editable = "disabled";
                                            $probablity_editable = "readonly";
                                        }
                                        else
                                        {
                                            $assumption_editable = "";
                                            $probablity_editable = "";
                                        }


                                        //   $editable = "";
                                    }
                                    elseif($self_lock_data != 0 && $self_lock_data[0]["lock_status"] == 0 && ($login_user_id == $employee_month_product_forecast_data[0]["created_by_user"])){

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $assumption_editable = "disabled";
                                            $probablity_editable = "readonly";
                                        }
                                        else
                                        {
                                            $assumption_editable = "";
                                            $probablity_editable = "";
                                        }

                                        // $editable = "";
                                    }
                                    else
                                    {
                                        // echo "eee".$monthvalue."</br>";
                                        $assumption_editable = "disabled";
                                        $probablity_editable = "readonly";
                                    }
                                }

                            }


                            $html .= '<div class="tp_form">
            <div class="form-group"><select ' . $assumption_editable . ' class="selectpicker assumption_data" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption' . $j . '[]" >

                                <option value= "">Select Assumption</option>';
                            foreach ($assumption_data as $assumption_key => $assumption) {

                                if ($assumption['assumption_id'] == $assumptiondata) {
                                    $selected = "selected='selected'";
                                } else {
                                    $selected = "";
                                }

                                $html .= '<option ' . $selected . ' value= "' . $assumption['assumption_id'] . '">' . $assumption['assumption_name'] . '</option>';
                            }
                            $html .= '</select>';

                            $html .= '</div>
        </div></td><td><input class="probablity_data" type="text" name="probablity' . $j . '[]" value="' . $probablitydata . '" ' . $probablity_editable . ' />';


                        } else {
                            //DONT SHOW

                            //echo "3";

                            $self_freeze_status = $this->esp_model->get_forecast_freeze_status($forecast_id, $login_user_id, $monthvalue);

                            if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                            {
                                // $editable = "readonly";

                                $assumption_editable = "disabled";
                                $probablity_editable = "readonly";
                            }
                            else
                            {
                                //$editable = "";

                                $assumption_editable = "";
                                $probablity_editable = "";
                            }


                            $html .= '<div class="tp_form">
            <div class="form-group"><select class="selectpicker assumption_data" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption' . $j . '[]" '.$assumption_editable.' >

                                <option value= "">Select Assumption</option>';
                            foreach ($assumption_data as $assumption_key => $assumption) {

                                if ($assumption['assumption_id'] == $assumptiondata) {
                                    $selected = "selected='selected'";
                                } else {
                                    $selected = "";
                                }

                                $html .= '<option  value= "' . $assumption['assumption_id'] . '">' . $assumption['assumption_name'] . '</option>';
                            }
                            $html .= '</select>';

                            $html .= '</div>
        </div></td><td><input class="probablity_data" type="text" name="probablity' . $j . '[]" value="" '.$probablity_editable.' />';

                        }

                    } else {
                        //DONT SHOW

                        //    echo $login_user_id.'===='. $employee_month_product_forecast_data[0]['created_by_user'];

                        if ($login_user_id == $employee_month_product_forecast_data[0]['created_by_user']) {

                            //echo "4";

                            $self_freeze_status = $this->esp_model->get_forecast_freeze_status($forecast_id, $login_user_id, $monthvalue);

                            if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                            {
                                // $editable = "readonly";

                                $assumption_editable = "disabled";
                                $probablity_editable = "readonly";
                            }
                            else
                            {
                                //$editable = "";

                                $assumption_editable = "";
                                $probablity_editable = "";
                            }


                            $html .= '<div class="tp_form">
            <div class="form-group"><select class="selectpicker assumption_data" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption' . $j . '[]" '.$assumption_editable.' >

                                <option value= "">Select Assumption</option>';
                            foreach ($assumption_data as $assumption_key => $assumption) {

                                if ($assumption['assumption_id'] == $assumptiondata) {
                                    $selected = "selected='selected'";
                                } else {
                                    $selected = "";
                                }

                                $html .= '<option ' . $selected . ' value= "' . $assumption['assumption_id'] . '">' . $assumption['assumption_name'] . '</option>';
                            }
                            $html .= '</select>';

                            $html .= '</div>
        </div></td><td><input class="probablity_data" type="text" name="probablity' . $j . '[]" value="' . $probablitydata . '"  '.$probablity_editable.'/>';


                        } else {

                            //     echo "5";

                            $html .= '<div class="tp_form">
            <div class="form-group"><select class="selectpicker assumption_data" style="display:block !important;" data-live-search="true" tabindex="-98" name="assumption' . $j . '[]" >

                                <option value= "">Select Assumption</option>';
                            foreach ($assumption_data as $assumption_key => $assumption) {

                                if ($assumption['assumption_id'] == $assumptiondata) {
                                    $selected = "selected='selected'";
                                } else {
                                    $selected = "";
                                }

                                $html .= '<option  value= "' . $assumption['assumption_id'] . '">' . $assumption['assumption_name'] . '</option>';
                            }
                            $html .= '</select>';

                            $html .= '</div>
        </div></td><td><input class="probablity_data" type="text" name="probablity' . $j . '[]" value="" />';


                        }
                    }


                    $html .= '</td>';

                    $j++;

                }

                $html .= '</tr>';
                $k++;

            }


            $html .= '</tbody>';
            $html .= '</table>';

            $freeze_button = "";

            $freeze_status = 0;
            if ($login_user_parent_data != 0) {

                $freeze_show = 1;

                $freeze_history_user_status_data = $this->esp_model->get_freeze_history_user_status_data($login_user_id, $forecast_id);

                //$senior_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_parent_data,$monthvalue,$forecast_id);


                if (!empty($freeze_history_user_status_data) && isset($freeze_history_user_status_data[0]['freeze_status'])) {


                    if ($freeze_history_user_status_data[0]['freeze_status'] == 0) {

                        $freeze_status = 0;
                        $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary freeze_data" id="freeze_data">Freeze</button></div>';
                    } else {
                        $freeze_status = 1;
                        $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary freeze_data" id="freeze_data">Unfreeze</button></div>';
                    }

                } else {
                    $freeze_status = 0;
                    $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary freeze_data" id="freeze_data">Freeze</button></div>';

                }
            } else {
                $freeze_show = 0;
            }

            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {

                //testdata($header_final_array);

                $final_array = array();

                $final_array["forecast_data"] = array_values($webservice_final_array);
                $final_array["header_lock_data"] = array_values($header_final_array);
                $final_array["forecast_id"] = $forecast_id;
                $final_array["freeze_status"] = $freeze_status;
                $final_array["freeze_show"] = $freeze_show;

                //   testdata($final_array);

                return $final_array;
                //die;
            }

            // '.$freeze_button.'

            $html2 .= '<div class="col-md-12 table_bottom text-center">
                <input type="hidden" id="forecast_id" name="forecast_id" value="' . $forecast_id . '" />
                <div class="row">
                    <div class="save_btn">
                        <button type="submit" id="save_data" class="btn btn-primary">Save</button>

                    </div>
                </div>
            </div>';


        }

        echo $html . $html2;
        die;

    }

    public function get_forecast_lock_status($webservice_data = null)
    {

        if ($webservice_data == null) {

            $user = $this->auth->user();
            $login_user_id = $user->id;

            $forecastid = $_POST["forecastid"];
            $freezedate = $_POST["freezedate"];

        } else {

            $login_user_id = $webservice_data["user_id"];

            $forecastid = $webservice_data["forecastid"];
            $freezedate = $webservice_data["month_data"];

            //    $freezedate = explode(",",$monthdate);

        }

        $global_head_user = array();
        $login_user_all_parent_data = $this->esp_model->get_employee_for_loginuser($login_user_id, $global_head_user);

        $all_senior_lock_data = array();

        if (!empty($login_user_all_parent_data)) {
            foreach ($login_user_all_parent_data as $parent_key => $parentid) {
                $get_senioruser_lock_status = $this->esp_model->senior_forecast_lock_status($parentid, $forecastid, $freezedate);
                if (!empty($get_senioruser_lock_status) || $get_senioruser_lock_status != 0) {
                    if ($get_senioruser_lock_status[0]["lock_status"] == 1) {
                        $all_senior_lock_data[] = 1;
                    }
                }

            }
        }


        $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);

        $login_user_highest_level_data = $this->esp_model->get_higher_level_employee_for_loginuser($login_user_id);

        // $explode_date = explode(",",$freezedate);

        $lock_array = array();

        //  foreach($freezedate as $key => $datedata){


        $highest_senior_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_highest_level_data, $freezedate, $forecastid);

        if (!empty($all_senior_lock_data)) {

            if ($webservice_data == null) {
                echo 1;
                die;
            } else {
                return 1;
            }
        } else {
            if ($webservice_data == null) {
                echo 0;
                die;
            } else {
                return 0;
            }
        }

        /*        if(!empty($highest_senior_lock_data) && $highest_senior_lock_data != 0 && $highest_senior_lock_data[0]["lock_status"] == 1){
                    $lock_array[] = $highest_senior_lock_data[0]["lock_status"];
            }
             else{
                
                 $senior_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_parent_data,$freezedate,$forecastid);
            
                if(!empty($senior_lock_data) && $senior_lock_data != 0 && $senior_lock_data[0]["lock_status"] == 1){
                    $lock_array[] = $senior_lock_data[0]["lock_status"];
                }
                
            }
            */

        //   }

        // testdata($lock_array);


    }

    public function check_login_user_lock_status()
    {

        $user = $this->auth->user();
        $login_user_id = $user->id;

        $freeze_date = $_POST["freezedate"];
        $forecast_id = $_POST["forecastid"];

        $lock_array = array();

        //   foreach($freeze_date as $freeze_key => $freeze_date_data){

        //  $freeze_data = $this->esp_model->update_forecast_freeze_status_data($user_id,$forecast_id,$text_data,$freeze_date_data);


        $self_lock_data = $this->esp_model->get_senior_lock_status_data($login_user_id, $freeze_date, $forecast_id);

        if ($self_lock_data != 0 && $self_lock_data[0]["lock_status"] != 0) {
            $lock_array[] = $self_lock_data[0]["lock_status"];
        }

        //    }


        if (!empty($lock_array)) {

            $res = 1;

        } else {
            $res = 0;
        }

        echo $res;
        die;

    }


    public function check_budget_login_user_lock_status()
    {

        $user = $this->auth->user();
        $login_user_id = $user->id;

        $yeardata = $_POST["yeardata"];
        $budget_id = $_POST["budgetid"];

        $from_month = $_POST["yeardata"] . "-01-01";
        $to_month = $_POST["yeardata"] . "-12-01";

        $month_data = $this->get_monthly_data($from_month, $to_month);

        $lock_array = array();

        //   foreach($freeze_date as $freeze_key => $freeze_date_data){

        //  $freeze_data = $this->esp_model->update_forecast_freeze_status_data($user_id,$forecast_id,$text_data,$freeze_date_data);

        foreach ($month_data as $month_key => $monthvalue) {

            $self_lock_data = $this->esp_model->get_budget_senior_lock_status_data($login_user_id, $monthvalue, $budget_id);

            if ($self_lock_data != 0 && $self_lock_data["lock_status"] != 0) {
                $lock_array[] = $self_lock_data["lock_status"];
            }
        }

        //    }


        if (!empty($lock_array)) {

            $res = 1;

        }
        else
        {
            $res = 0;
        }

        echo $res;
        die;

    }

    public function check_login_user_level_status()
    {

        $user = $this->auth->user();
        $login_user_id = $user->id;

        //$login_user_id = $_POST["login_user_id"];

        $child_user_data = $this->esp_model->get_user_selected_level_data($login_user_id, null);

        $child_forecast_array = array();

        $child_flag = 0;

        if (!empty($child_user_data["level_users"])) {

            /*  $user_data = explode(",",$child_user_data["level_users"]);

                foreach($user_data as $user_key => $userdata){
                  // $child_forecast_array[] = $this->esp_model->get_forecast_freeze_status($forecast_id,$userdata,$monthvalue);

                     $child_forecast_data = $this->esp_model->get_forecast_freeze_status($forecast_id,$userdata,$monthvalue);

                    if($child_forecast_data != 0 && $child_forecast_data["freeze_status"] == 1)
                    $child_forecast_array[] = $child_forecast_data;


                }
                
                */

            $child_flag = 1;

        }

        echo $child_flag;
        die;

    }

    public function get_forecast_value_data($webservice_data = NULL)
    {

        if ($webservice_data != NULL && (isset($webservice_data['webservice']) && !empty($webservice_data['webservice']))) {

            $product_sku_id = $webservice_data["product_sku_id"];
            $month_data = $webservice_data['month_data'];
            $forecastdata = $webservice_data['forecastdata'];

        } else {
            $relattrval = $_POST['relattrval'];

            $forecast_data = explode("_", $relattrval);

            $product_sku_id = $forecast_data[1];
            $month_data = $forecast_data[2];

            $forecastdata = $_POST['forecastdata'];
        }

        $forecase_value = $this->esp_model->get_forecast_data($product_sku_id, $month_data);

        $final_forecast_value = $forecastdata * $forecase_value;

        if ($webservice_data != NULL && (isset($webservice_data['webservice']) && !empty($webservice_data['webservice']))) {
            return $final_forecast_value;
        } else {
            echo $final_forecast_value;
            die;
        }
    }

    public function add_forecast($webservice_data = NULL)
    {
        //  testdata($_POST);
        //  $forecast_data = $this->esp_model->add_forecast_data();

        if ($webservice_data != NULL) {
            $_POST = $webservice_data;
        }

        // testdata($_POST);

        if (isset($_POST) && !empty($_POST)) {

            //   testdata($_POST);


            if ($webservice_data == NULL) {

                if (!isset($_POST['employee_data'])) {
                    $forecast_user_id = $_POST['login_user_id'];
                } else {
                    $forecast_user_id = $_POST['employee_data'];
                }


            } else {

                if ($webservice_data["emp_id"] != "") {
                    $forecast_user_id = $webservice_data["emp_id"];
                } else {
                    $forecast_user_id = $webservice_data['login_user_id'];
                }
            }


            $businss_data = $this->esp_model->get_business_code($forecast_user_id);

            $user_business_code = $businss_data;

            $pbg_id = $_POST['pbg_data'];
            $created_user_id = $_POST['login_user_id'];

            $bussiness_user_id = $forecast_user_id;


            //CHECK FOR EMMPLOYEE AND PBG RECORD ALREADY EXIST


            $final_array = array();

            $i = 1;

            $fid = "";

            $forecast_insert_id = '';

            $old_forecast_id = "";

            if (!empty($_POST['month_data'])) {
                foreach ($_POST['month_data'] as $month_key => $month_value) {

                    //  $check_record_exist = $this->esp_model->check_forecast_data($pbg_id,$user_business_code,$month_value);

                    //  echo $user_business_code."====".$pbg_id."====".$bussiness_user_id."</br>";

                    $check_record_exist = $this->esp_model->get_employee_product_forecast_data($user_business_code, $pbg_id, $bussiness_user_id);


                    //    dumpme($check_record_exist);

                    if ($check_record_exist != 0) {
                        // if(isset($_POST["forecast_id"]) && $_POST["forecast_id"] != ""){

                        //UPDATE 

                        $old_forecast_id = $check_record_exist[0]['forecast_id'];

                        //  $old_forecast_id = $_POST["forecast_id"];

                        $fid = $old_forecast_id;
                        //UPDATE MAIN TABLE RECORD

                        $update_status = $this->esp_model->update_forecast_data($old_forecast_id, $created_user_id);

                    } else {

                        //INSERT
                        if ($old_forecast_id == "") {
                            $old_forecast_id = $this->esp_model->insert_forecast_data($pbg_id, $created_user_id, $user_business_code, $_POST['login_user_id']);
                        }

                    }

                    foreach ($_POST['product_sku_id'] as $pkey => $product_data) {

                        $initial_array_forecastqty = $_POST['forecast_qty'][$product_data][$month_key];

                        $initial_array_forecastvalue = $_POST['forecast_value'][$product_data][$month_key];

                        $final_array[$month_value]['productid'][$product_data]['forecast_qty'] = $initial_array_forecastqty;

                        $final_array[$month_value]['productid'][$product_data]['forecast_value'] = $initial_array_forecastvalue;

                    }

                    if (isset($_POST['assumption' . $i])) {
                        $initial_array_assumption = array($_POST['assumption' . $i][0], $_POST['assumption' . $i][1], $_POST['assumption' . $i][2]);
                    } else {
                        $initial_array_assumption = array();
                    }
                    $initial_array_probablity = array($_POST['probablity' . $i][0], $_POST['probablity' . $i][1], $_POST['probablity' . $i][2]);

                    // if($initial_array_assumption != "")

                    $final_array[$month_value]['assumption'] = $initial_array_assumption;
                    $final_array[$month_value]['probablity'] = $initial_array_probablity;


                    $i++;
                }
            }


            //die;

            //  dumpme($final_array);



            if (!empty($final_array)) {
                foreach ($final_array as $key_data => $data) {

                    //   $old_forecast_id = "";

                    $month_data = $key_data;

                    foreach ($data["productid"] as $product_id => $product_data) {

                        $forecast_qty = $product_data["forecast_qty"];
                        $forecast_value = $product_data["forecast_value"];

                        $get_product_old_data = $this->esp_model->get_forecast_product_details($businss_data, $product_id, $month_data);

                        if ($get_product_old_data != 0) {

                            //UPDATE MAIN TABLE RECORD


                            //    if($forecast_insert_id == "")
                            //	{
                            $fid = $old_forecast_id;
                            //	}
                            //	else{
                            //	$fid = $forecast_insert_id;
                            //}

                            //echo "a";

                            $forecast_product_id = $get_product_old_data[0]['forecast_product_id'];
                            $old_forecast_id = $get_product_old_data[0]['forecast_id'];

                            $update_status = $this->esp_model->update_forecast_product_details($forecast_product_id, $forecast_qty, $forecast_value);

                            $history_status_data = 1;

                            //ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE

                            $this->esp_model->insert_forecast_product_details_history($old_forecast_id, $businss_data, $pbg_id, $product_id, $month_data, $forecast_qty, $forecast_value, $history_status_data);


                        } else {

                            //	if($forecast_insert_id == "")
                            //	{
                            $fid = $old_forecast_id;
                            //	}
                            //	else{
                            //		$fid = $forecast_insert_id;
                            //	}


                            $this->esp_model->insert_forecast_product_details($fid, $businss_data, $product_id, $month_data, $forecast_qty, $forecast_value);

                            $history_status_data = 0;

                            //ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE

                            $this->esp_model->insert_forecast_product_details_history($fid, $businss_data, $pbg_id, $product_id, $month_data, $forecast_qty, $forecast_value, $history_status_data);

                        }

                    }

                    $assumption_data = "";
                    $probablity_data = "";

                    if (!empty($data["assumption"])) {

                        $assumption_data = implode("~", $data["assumption"]);
                        $probablity_data = implode("~", $data["probablity"]);

                        //echo $assumption_data."====".$probablity_data."</br>";

                        // echo $old_forecast_id."</br>";

                        $get_assumption_old_data = $this->esp_model->get_forecast_assumption_details($old_forecast_id, $month_data);

                        //echo "aaaa======</br>";
                        //dumpme($get_assumption_old_data);

                        if ($get_assumption_old_data != 0) {

                            //UPDATE MAIN TABLE RECORD

                            if ($forecast_insert_id == "") {
                                $fid = $old_forecast_id;
                            } else {
                                $fid = $forecast_insert_id;
                            }

                            $forecast_assumption_id = $get_assumption_old_data[0]['forecast_assumption_id'];

                            //echo "aaaa======</br>";

                            $update_status = $this->esp_model->update_forecast_assumption_details($forecast_assumption_id, $assumption_data, $probablity_data);

                            $history_update_status = 1;

                            //ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE

                            $this->esp_model->insert_forecast_assumption_data_history($old_forecast_id, $assumption_data, $probablity_data, $month_data, $history_update_status);

                        } else {


                            if ($forecast_insert_id == "") {
                                $fid = $old_forecast_id;
                            } else {
                                $fid = $forecast_insert_id;
                            }

                            //echo $fid."bbbbb======</br>";

                            $this->esp_model->insert_forecast_assumption_probablity_data($fid, $assumption_data, $probablity_data, $month_data);

                            $history_update_status = 0;

                            //ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE

                            $this->esp_model->insert_forecast_assumption_data_history($fid, $assumption_data, $probablity_data, $month_data, $history_update_status);

                        }

                    }

                }

            }

        }

        if ($webservice_data != NULL) {
            $result = "Data Updated Successfully";
            return $result;
        } else {
            echo $fid;
            die;
        }

    }

    public function get_business_code()
    {

        $business_data = $this->esp_model->get_business_code(NULL);
        echo $business_data;
        die;
    }

    public function update_forecast_freeze_status($webservice_data = NULL)
    {

        if (isset($webservice_data) && !empty($webservice_data) && $webservice_data != NULL) {

            $user_id = $webservice_data['user_id'];
            $forecast_id = $webservice_data['forecastid'];
            $freeze_status_data = $webservice_data['freeze_status'];

            if ($freeze_status_data == 1) {
                $text_data = "Freeze";
            }

            if ($freeze_status_data == 0) {
                $text_data = "Unfreeze";
            }

            $freeze_date = $webservice_data["month_data"];

            // echo $user_id."===".$forecast_id."===".$freeze_status_data."===".$text_data."===".$freeze_date;
            // die;

        } else {
            $user = $this->auth->user();
            $forecast_id = $_POST["forecastid"];
            $text_data = $_POST["textdata"];
            $freeze_date = $_POST["freezedate"];

            $user_id = $user->id;
        }

        // dumpme($freeze_date);die;

        //$freeze_date = explode(",",$freeze_date);

        //  foreach($freeze_date as $freeze_key => $freeze_date_data){

        $freeze_data = $this->esp_model->update_forecast_freeze_status_data($user_id, $forecast_id, $text_data, $freeze_date);

        //  }
        if (isset($webservice_data) && !empty($webservice_data) && $webservice_data != NULL) {
            return $freeze_data;
        } else {
            echo $freeze_data;
            die;
        }

    }

    public function set_forecast_lock_data($webservice_data = NULL)
    {

        if (isset($webservice_data) && !empty($webservice_data) && $webservice_data != NULL) {

            $user_id = $webservice_data['user_id'];
            $forecast_id = $webservice_data['forecastid'];
            $monthval = $webservice_data['monthval'];
            $lock_data = $webservice_data['lock_data'];

            if ($lock_data == 1) {
                $text_data = "Lock";
            }

            if ($lock_data == 0) {
                $text_data = "Unlock";
            }

        } else {

            $user = $this->auth->user();
            $forecast_id = $_POST["forecastid"];
            $monthval = $_POST["monthval"];

            $text_data = $_POST["textdata"];
            $user_id = $user->id;

        }

        $lock_data = $this->esp_model->update_forecast_lock_status_data($user_id, $forecast_id, $monthval, $text_data);

        if (isset($webservice_data) && !empty($webservice_data) && $webservice_data != NULL) {
            return $lock_data;
        } else {
            echo $lock_data;
            die;
        }

    }

    public function get_monthly_data($from_month, $to_month)
    {

        $from_date = $from_month . "-01";
        $to_date = $to_month . "-01";

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

    public function get_monthly_select_data($from_month = NULL, $to_month = NULL)
    {

        if (!isset($_POST["frommonth"]) && !isset($_POST["tomonth"])) {
            $from_date = $from_month . "-01";
            $to_date = $to_month . "-01";
        } else {
            $from_date = $_POST["frommonth"] . "-01";
            $to_date = $_POST["tomonth"] . "-01";
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

        if (!isset($_POST["frommonth"]) && !isset($_POST["tomonth"])) {
            return $month_output;
        } else {
            echo json_encode($month_output);
            die;
        }

    }

    public function impact_entry()
    {

        Assets::add_module_js('esp', 'impact_entry.js');

        $user = $this->auth->user();

        $child_user_data = $this->esp_model->get_user_selected_level_data($user->id,null);

        Template::set('child_user_data', $child_user_data);

        Template::set('current_user', $user);
        Template::render();

    }

    public function get_forecast_impact_data($webservice_data = NULL)
    {

        if ($webservice_data == NULL && !isset($webservice_data["webservice"])) {

            $monthdata = $_POST['selectedmonth'] . "-01";

            $user = $this->auth->user();
            $login_bussiness_code = $user->bussiness_code;

        } else {

            $login_bussiness_code = $webservice_data["bussiness_code"];
            $monthdata = $webservice_data["monthval"] . "-01";

        }

        $impact_data = $this->esp_model->get_user_impact_data($login_bussiness_code, $monthdata);

        if ($webservice_data != NULL && isset($webservice_data["webservice"])) {

            return $impact_data;

        }

        $html = "";

        if ($impact_data != 0) {

            //CREATE HTML FOR DATA


            $html .= '<table class="col-md-12 table-bordered table-striped table-condensed cf inpt-right-aln">';
            $html .= '<thead>';
            $html .= '<tr>';
            //$html .= '<th>Product SKU Code</th>';
            //$html .= '<th>Product SKU Name</th>';
            $html .= '<th>PBG Name</th>';
            $html .= '<th>Assumption 1</th>';
            $html .= '<th>Probability 1</th>';
            $html .= '<th>Impact 1</th>';
            $html .= '<th>Assumption 2</th>';
            $html .= '<th>Probability 2</th>';
            $html .= '<th>Impact 2</th>';
            $html .= '<th>Assumption 3</th>';
            $html .= '<th>Probability 3</th>';
            $html .= '<th>Impact 3</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';

            foreach ($impact_data as $impact_key => $impact_value) {

                $html .= '<tr>';

                $html .= '<td><input type="hidden" name="assumption_id[]" value="' . $impact_value['forecast_assumption_id'] . '" />' . $impact_value['product_country_name'] . '</td>';

                //	$html .= '<td>'.$impact_value['product_sku_name'].'</td>';

                $html .= '<td>' . $impact_value['assumption1_name'] . '</td>';
                $html .= '<td>' . $impact_value['probability1'] . '</td>';
                $html .= '<td><input type="text" name="impact1[]" value="' . $impact_value['impact1'] . '" /></td>';

                $html .= '<td>' . $impact_value['assumption2_name'] . '</td>';
                $html .= '<td>' . $impact_value['probability2'] . '</td>';
                $html .= '<td><input type="text" name="impact2[]" value="' . $impact_value['impact2'] . '" /></td>';

                $html .= '<td>' . $impact_value['assumption3_name'] . '</td>';
                $html .= '<td>' . $impact_value['probability3'] . '</td>';
                $html .= '<td><input type="text" name="impact3[]" value="' . $impact_value['impact3'] . '" /></td>';

                $html .= '</tr>';

            }

            $html .= '</tbody>';
            $html .= '</table>';


            $html .= '<div class="col-md-12 table_bottom text-center">
                <div class="row">
                    <div class="save_btn">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>';


        } else {

            //CREATE NO DATA FOUND HTML

            $html .= '<div><h4>No Data Found.</h4></div>';

        }

        echo $html;
        die;

    }

    public function add_impact_entry($webservice_data = NULL)
    {

        //testdata($_POST);
        if ($webservice_data == NULL) {

            $webservice_flag = 0;

            $impact_data = $this->esp_model->add_impact_entry($_POST, $webservice_flag);
            echo $impact_data;
            die;
        } else {
            $webservice_flag = 1;
            $impact_data = $this->esp_model->add_impact_entry($webservice_data, $webservice_flag);
            return $impact_data;
        }
    }

    public function budget()
    {

        Assets::add_module_js('esp', 'esp_budget.js');

        $user = $this->auth->user();

        /*
		$lock_show_data = $this->get_user_level_data($user->id);
		
		if($lock_show_data != 0){
		
			$lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;' rel='".$monthvalue."' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true'></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Lock' /></a></div>";
			}
		else
		{
			$lock_data = "";
	                                
		}
	
	*/

        $child_user_data = $this->esp_model->get_user_selected_level_data($user->id,null);

        Template::set('child_user_data', $child_user_data);
        Template::set('current_user', $user);
        Template::render();

    }

    public function show_budget_lock($webservice_data = NULL)
    {

        if ($webservice_data == NULL) {

            $user = $this->auth->user();
            $login_user_id = $user->id;

            $pbgid = $_POST["pbgid"];
            $from_month = $_POST["frommonth"];
            $to_month = $_POST["tomonth"];

            $selected_year = date("Y", strtotime($from_month));
            $businesscode = $_POST["businesscode"];

        } else {

            $login_user_id = $webservice_data["user_id"];
            $from_month = $webservice_data["yearval"] . "-01-01";
            $to_month = $webservice_data["yearval"] . "-12-01";

            $pbgid = $webservice_data["pbgid"];

            $selected_year = $webservice_data["yearval"];
            $businesscode = $webservice_data["businesscode"];

        }

        $pbg_sku_data = $this->esp_model->get_pbg_sku_data($pbgid);
        $month_data = $this->get_monthly_data($from_month, $to_month);


        $lock_show_data = $this->get_user_level_data($login_user_id);

        /////////

        $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);

        $login_user_highest_level_data = $this->esp_model->get_higher_level_employee_for_loginuser($login_user_id);

        ////////////////

        $global_head_user = array();

        $login_user_all_parent_data = $this->esp_model->get_employee_for_loginuser($login_user_id, $global_head_user);

        // echo $login_user_id."==".$login_user_parent_data."==".$login_user_highest_level_data;
        // die;
        $final_lock_array = array();

        //   $header_final_array["lockdata"] = 1;

        /*
		if($lock_show_data != 0){
		
			foreach($month_data as $monthkey => $monthvalue){
				foreach($pbg_sku_data as $skukey => $skuvalue){
					
					 $employee_month_product_budget_data1 = $this->esp_model->get_employee_month_product_budget_data($businesscode,$skuvalue['product_sku_country_id'],$monthvalue);
			
					 $lock_status = 0;
					 $lock_by_id = "";
					 $check_lock_budget_id = "";
			
					if($employee_month_product_budget_data1 != 0){
			
						$check_lock_budget_id = $employee_month_product_budget_data1[0]['budget_id'];
			
					   $budget_lock_history_data =  $this->esp_model->get_employee_month_product_budget_lock_data($login_user_id,$check_lock_budget_id,$monthvalue);
						if(!empty($budget_lock_history_data)){
							$lock_status = $budget_lock_history_data[0]['lock_status'];
						}
					
					}
                    
                     $get_higher_user_lock_status = $this->esp_model->senior_budget_lock_status($login_user_highest_level_data,$check_lock_budget_id,$monthvalue);
        
        
                        $senior_lock_status = "";

                        if(($get_higher_user_lock_status != 0 || !empty($get_higher_user_lock_status)) && ($get_higher_user_lock_status[0]["lock_status"] == 1)){
                            $senior_lock_status = 1;
                        }
                        else{
                            if($login_user_parent_data != 0){

                                $get_user_lock_status = $this->esp_model->senior_budget_lock_status($login_user_parent_data,$check_lock_budget_id,$monthvalue);
                                if(($get_user_lock_status != 0 || !empty($get_user_lock_status)) && ($get_user_lock_status[0]["lock_status"] == 1)){
                                    $senior_lock_status = 1;
                                }
                                else{
                                    $senior_lock_status = 0;
                                }
                            }
                            else{
                                $senior_lock_status = 0;
                            }
                        }
                    
                    if($senior_lock_status == 1 && ($login_user_highest_level_data != $login_user_id)){
                         $higest_level_user_status = "pointer-events: none;opacity: 0.7;";
                    }
                    else{
                         $higest_level_user_status = "";
                    }
                    
                    if($higest_level_user_status == ""){
                        $higest_user_status = "";
                    }
                    else{
                        $higest_user_status = 1;
                    }

                    
                    if($senior_lock_status == 1)
                    {
                        //SENIOR RESPONSE
                        
                        $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;".$higest_level_user_status."' rel='".$selected_year."' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true''></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Unlock' />1111</a></div>";
                        
                        $final_lock_array["lockdata"] = 1;
                        $final_lock_array["seniorlock"] = 1;
                        $final_lock_array["higherlock"] = $higest_user_status;
                        
                    }
                    else
                    {
                         //OWN RESPONSE
						
					   if($lock_status == 0){
						
							$lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;".$higest_level_user_status."' rel='".$selected_year."' href='javascript:void(0);' class='lock_data' ><i class='fa fa-unlock-alt' aria-hidden='true'></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Lock' />2222</a></div>";
                           
                            $final_lock_array["locakdata"] = 1;
                           
                            $final_lock_array["seniorlock"] = 0;
                            $final_lock_array["higherlock"] = $higest_user_status;
                           
						}
						else{
							$lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;".$higest_level_user_status."' rel='".$selected_year."' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true''></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Unlock' />3333</a></div>";
                            
                            $final_lock_array["locakdata"] = 0;
                            
                            $final_lock_array["seniorlock"] = 0;
                            $final_lock_array["higherlock"] = $higest_user_status;
                            
						} 
                        
                    }
			
				}
			}
			
			
		}
		else
		{


			//$lock_data = "87788";
            
            
            foreach($month_data as $monthkey => $monthvalue){
				foreach($pbg_sku_data as $skukey => $skuvalue){
					
					 $employee_month_product_budget_data1 = $this->esp_model->get_employee_month_product_budget_data($businesscode,$skuvalue['product_sku_country_id'],$monthvalue);
			
					 $lock_status = 0;
					 $lock_by_id = "";
					 $check_lock_budget_id = "";
			
					if($employee_month_product_budget_data1 != 0){
			
						$check_lock_budget_id = $employee_month_product_budget_data1[0]['budget_id'];
			
					   $budget_lock_history_data =  $this->esp_model->get_employee_month_product_budget_lock_data($login_user_id,$check_lock_budget_id,$monthvalue);
						if(!empty($budget_lock_history_data)){
							$lock_status = $budget_lock_history_data[0]['lock_status'];
						}
					
					}
                    
                     $get_higher_user_lock_status = $this->esp_model->senior_budget_lock_status($login_user_highest_level_data,$check_lock_budget_id,$monthvalue);
        
        
                        $senior_lock_status = "";

                        if(($get_higher_user_lock_status != 0 || !empty($get_higher_user_lock_status)) && ($get_higher_user_lock_status[0]["lock_status"] == 1)){
                            $senior_lock_status = 1;
                        }
                        else{
                            if($login_user_parent_data != 0){

                                $get_user_lock_status = $this->esp_model->senior_budget_lock_status($login_user_parent_data,$check_lock_budget_id,$monthvalue);
                                if(($get_user_lock_status != 0 || !empty($get_user_lock_status)) && ($get_user_lock_status[0]["lock_status"] == 1)){
                                    $senior_lock_status = 1;
                                }
                                else{
                                    $senior_lock_status = 0;
                                }
                            }
                            else{
                                $senior_lock_status = 0;
                            }
                        }
                    
                    if($senior_lock_status == 1 && ($login_user_highest_level_data != $login_user_id)){
                         $higest_level_user_status = "pointer-events: none;opacity: 0.7;";
                    }
                    else{
                         $higest_level_user_status = "";
                    }
                    
                    if($higest_level_user_status == ""){
                        $higest_user_status = "";
                    }
                    else{
                        $higest_user_status = 1;
                    }
                    
                    
                    if($senior_lock_status == 1)
                    {
                        //SENIOR RESPONSE
                        
                        $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;".$higest_level_user_status."' rel='".$selected_year."' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true''></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Unlock' />1111</a></div>";
                        
                        $final_lock_array["lockdata"] = 1;
                        $final_lock_array["seniorlock"] = 1;
                        $final_lock_array["higherlock"] = $higest_user_status;
                        
                        
                        
                    }
                    else
                    {
                        $lock_data = "";
                        
                        $final_lock_array["lockdata"] = "";
            
                        $final_lock_array["seniorlock"] = "";
                        $final_lock_array["higherlock"] = "";
                        
                    }
			
				}
			}
	                                
		}

        */

        foreach ($month_data as $monthkey => $monthvalue) {
            foreach ($pbg_sku_data as $skukey => $skuvalue) {


                $employee_month_product_budget_data1 = $this->esp_model->get_employee_month_product_budget_data($businesscode, $skuvalue['product_sku_country_id'], $monthvalue);


                $lock_data = "";

                $lock_status = 0;
                $lock_by_id = "";
                $check_lock_budget_id = "";

                if ($employee_month_product_budget_data1 != 0) {

                    $check_lock_budget_id = $employee_month_product_budget_data1[0]['budget_id'];

                    $budget_lock_history_data = $this->esp_model->get_employee_month_product_budget_lock_data($login_user_id, $check_lock_budget_id, $monthvalue);
                    if (!empty($budget_lock_history_data)) {
                        $lock_status = $budget_lock_history_data[0]['lock_status'];
                    }

                }


                $child_user_data = $this->esp_model->get_user_selected_level_data($login_user_id, null);


                $self_freeze_status = $this->esp_model->get_budget_freeze_status($check_lock_budget_id, $login_user_id);

             //   testdata($self_freeze_status);


//testdata($child_user_data);

                $child_forecast_array = array();

                $child_flag = 0;

                if (!empty($child_user_data["level_users"])) {

                    $user_data = explode(",", $child_user_data["level_users"]);

                    foreach ($user_data as $user_key => $userdata) {
                        $child_forecast_data = $this->esp_model->get_budget_freeze_status($check_lock_budget_id, $userdata);
                        if ($child_forecast_data != 0 && $child_forecast_data["freeze_status"] == 1)
                            $child_forecast_array[] = $child_forecast_data;
                    }
                }

                $child_forecast_array = array_filter($child_forecast_array);

                if (count($child_forecast_array) > 0) {
                    $child_flag = 1;
                }

//GET ANY SENIOR USER LOCKED OR NOT DATA

                //testdata($login_user_all_parent_data);

                $senior_lock_data = array();

                if (!empty($login_user_all_parent_data)) {
                    foreach ($login_user_all_parent_data as $parent_key => $parentid) {
                        $get_senioruser_lock_status = $this->esp_model->senior_budget_lock_status($parentid, $check_lock_budget_id, $monthvalue);
                        if (!empty($get_senioruser_lock_status) || $get_senioruser_lock_status != 0) {
                            if ($get_senioruser_lock_status[0]["lock_status"] == 1) {
                                $senior_lock_data[] = 1;
                            }
                        }

                    }
                }

                //   testdata($senior_lock_data);

                if (in_array(1, $senior_lock_data)) {

                    //SHOW LOCK and make it NON CLICKABLE

                    $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;pointer-events: none;opacity: 0.7;' rel='" . $selected_year . "' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true''></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Unlock' /></a></div>";

                    // $nonclickable = 1;

                    $final_lock_array["lockdata"] = 1;
                    $final_lock_array["clickable"] = 0;

                    //  $lock_data = "lock";

                } else {

//echo $lock_data;die;


                    //GET HIS OWN DATA and make it CLICKABLE

                    //if ($lock_show_data != 0) {

                    //IF USER HAVING CHILD


                    //IF SENIOR IS NOT LOCKED AND USER HAVING CHILD DATA

                    $self_lock_data = $this->esp_model->senior_budget_lock_status($login_user_id, $check_lock_budget_id, $monthvalue);

                    // dumpme($self_lock_data);

                    if ($self_lock_data != 0) {

                        if ($self_lock_data[0]["lock_status"] != 0) {

                            if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                            {
                                $style = " pointer-events: none;opacity: 0.7; ";

                                $final_lock_array["clickable"] = 0;

                            }
                            else{
                                $style = "";
                                $final_lock_array["clickable"] = 1;
                            }



                            $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;".$style."' rel='" . $selected_year . "' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true''></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Unlock' /></a></div>";

                            //  $header_final_array[$monthvalue]['lockdata'] = 1;


                            $final_lock_array["lockdata"] = 1;


                            //$header_final_array[$monthvalue]["lockdata"] = 1;
                            //$header_final_array[$monthvalue]["clickable"] = 1;

                        } else {


                            if ($child_flag == 1) {


                                if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                {
                                    $style = " pointer-events: none;opacity: 0.7; ";

                                    $final_lock_array["clickable"] = 0;

                                }
                                else{
                                    $style = "";
                                    $final_lock_array["clickable"] = 1;
                                }

                                $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;".$style."' rel='" . $selected_year . "' href='javascript:void(0);' class='lock_data' ><i class='fa fa-unlock-alt' aria-hidden='true''></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Lock' /></a></div>";

                                //$header_final_array[$monthvalue]['lockdata'] = 0;


                                $final_lock_array["lockdata"] = 0;
                               // $final_lock_array["clickable"] = 1;

                                // $header_final_array[$monthvalue]["lockdata"] = 0;
                                // $header_final_array[$monthvalue]["clickable"] = 1;

                            } else {

                                $lock_data = "";

                                $final_lock_array["lockdata"] = "";
                                $final_lock_array["clickable"] = "";

                                //$header_final_array[$monthvalue]['lockdata'] = 0;

                                // $header_final_array[$monthvalue]["lockdata"] = "";
                                // $header_final_array[$monthvalue]["clickable"] = "";

                                // $freeze_button = '';
                                // $freeze_button_data = "";

                            }

                        }

                    } else {

                        // $get_jouinor_freeze_status = $this->esp_modal->


                        if ($child_flag == 1) {


                            if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                            {
                                $style = " pointer-events: none;opacity: 0.7; ";

                                $final_lock_array["clickable"] = 0;

                            }
                            else{
                                $style = "";
                                $final_lock_array["clickable"] = 1;
                            }


                            $lock_data = "<div class='lock_unlock_data' ><a style='cursor:pointer;".$style."' rel='" . $selected_year . "' href='javascript:void(0);' class='lock_data' ><i class='fa fa-unlock-alt' aria-hidden='true'></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Lock' /></a></div>";

                            $final_lock_array["lockdata"] = 0;
                            //$final_lock_array["clickable"] = 1;

                            //$header_final_array[$monthvalue]['lockdata'] = 0;

                            //	$header_final_array[$monthvalue]["lockdata"] = 0;
                            //	$header_final_array[$monthvalue]["clickable"] = 1;
                        } else {

                            $lock_data = "";
                            //	$header_final_array[$monthvalue]["lockdata"] = "";
                            //	$header_final_array[$monthvalue]["clickable"] = "";

                            $final_lock_array["lockdata"] = "";
                            $final_lock_array["clickable"] = "";

                            //	$freeze_button = '';
                            //	$freeze_button_data = "";

                        }

                    }

                }

                //   } else {
                //      $lock_data = "yyyy";


                // $header_final_array[$monthvalue]["lockdata"] = "";
                // $header_final_array[$monthvalue]["clickable"] = "";

                //  }
            }

        }


        if ($webservice_data == NULL) {
            echo $lock_data;
            die;
        } else {


            return $final_lock_array;
        }


    }


    public function get_pbg_sku_budget_data($webservice_data = NULL)
    {

        if ($webservice_data == NULL) {

            //IF NOT WEBSERVICE

            $user = $this->auth->user();
            $login_user_id = $user->id;

            $pbgid = $_POST["pbgid"];
            $from_month = $_POST["frommonth"];
            $to_month = $_POST["tomonth"];

            $selected_year = date("Y", strtotime($from_month));


            $businesscode = $_POST["businesscode"];

        } else {
            //IF WEBSERVICE

            $login_user_id = $webservice_data['login_user_id'];

            $pbgid = $webservice_data['pbg_id'];
            $from_month = $webservice_data['from_month'];
            $to_month = $webservice_data['to_month'];

            $businesscode = $webservice_data['business_code'];


        }

        $pbg_sku_data = $this->esp_model->get_pbg_sku_data($pbgid);


        //echo $from_month."====".$to_month."</br>";

        $month_data = $this->get_monthly_data($from_month, $to_month);

        //  testdata($month_data);

        $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);


        //  $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);

        $login_user_highest_level_data = $this->esp_model->get_higher_level_employee_for_loginuser($login_user_id);

        $global_head_user = array();

        $login_user_all_parent_data = $this->esp_model->get_employee_for_loginuser($login_user_id, $global_head_user);


        // testdata($login_user_all_parent_data);


        $html = "";
        $html1 = "";
        $html2 = "";

        $webservice_final_array = array();

        if ($pbg_sku_data != 0) {

            $html .= '<table class="col-md-12 table-bordered table-striped table-condensed cf inpt-right-aln">';
            $html .= '<thead>';
            $html .= '<tr style="border-bottom: solid 1px #b1b1b1;">';
            $html .= '<th></th>';
            foreach ($month_data as $monthkey => $monthvalue) {

                $time = strtotime($monthvalue);
                $month = date("F", $time);
                $year = date("Y", $time);

                $html .= '<th colspan="2"><span class="rts_bordet"></span>' . $month . '-' . $year . '&nbsp;&nbsp;</th>';
            }

            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<th><span class="rts_bordet"></span>';
            $html .= 'PBG';
            $html .= '</th>';
            foreach ($month_data as $monthkey => $monthvalue) {
                $html .= '<input type="hidden" name="month_data[]" value="' . $monthvalue . '" />';

                $html .= '<th><span class="rts_bordet"></span>';
                $html .= 'Budget Qty';
                $html .= '</th>';
                $html .= '<th><span class="rts_bordet"></span>';
                $html .= 'Budget Value';
                $html .= '</th>';
            }
            $html .= '<th><span class="rts_bordet"></span>';
            $html .= 'Yearly';
            $html .= '</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            $i = 1;

            $budget_id = "";


            $freeze_child_forecast_array = array();

            $freeze_child_flag = 0;


            foreach ($pbg_sku_data as $skukey => $skuvalue) {
                $html .= '<tr>';
                $html .= '<td><input type="hidden" name="product_sku_id[]" value="' . $skuvalue['product_sku_country_id'] . '" />' . $skuvalue['product_sku_name'] . '</td>';

                $l = 1;

                foreach ($month_data as $monthkey => $monthvalue) {

                    $time = strtotime($monthvalue);
                    $month = date("F", $time);
                    $year = date("Y", $time);

                    $employee_month_product_budget_data = $this->esp_model->get_employee_month_product_budget_data($businesscode, $skuvalue['product_sku_country_id'], $monthvalue);

                    $budget_qty = "";
                    $budget_value = "";

                    $lock_status = "";
                    $lock_by_id = "";

                    //    echo "<pre>";
                    //    print_r($employee_month_product_forecast_data);

                    if ($employee_month_product_budget_data != 0) {

                        $budget_qty = $employee_month_product_budget_data[0]['budget_quantity'];
                        $budget_value = $employee_month_product_budget_data[0]['budget_value'];


                        $lock_status = $employee_month_product_budget_data[0]['lock_status'];
                        $lock_by_id = $employee_month_product_budget_data[0]['lock_by_id'];

                        $budget_id = $employee_month_product_budget_data[0]['budget_id'];


                    }


                    if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {
                        $data_inner_array = array();
                    }


                    //$forecast_freeze_data = $this->esp_model->get_forecast_freeze_status($forecast_id,$login_user_id,$monthvalue);

                    $budget_freeze_data = $this->esp_model->get_budget_freeze_status($budget_id, $login_user_id);

                    $child_user_data = $this->esp_model->get_user_selected_level_data($login_user_id, null);
                    //    echo $login_user_id;
                    //    dumpme($child_user_data);
                    $child_forecast_array = array();

                    $child_flag = 0;


                    if (!empty($child_user_data["level_users"])) {

                        $user_data = explode(",", $child_user_data["level_users"]);

                        if (!empty($user_data)) {
                            foreach ($user_data as $user_key => $userdata) {
                                $child_forecast_data = $this->esp_model->get_budget_freeze_status($budget_id, $userdata);

                                if ($child_forecast_data != 0 && $child_forecast_data["freeze_status"] == 1)
                                    $child_forecast_array[] = $child_forecast_data;
                                $freeze_child_forecast_array[] = $child_forecast_data;

                            }
                        }
                    }


                    $child_user_data2 = $this->esp_model->get_user_selected_level_data($login_user_id, null);

                    //  testdata($child_user_data1);
                    if ($child_user_data2["level_users"] != "") {

                        $child_forecast_array = array_filter($child_forecast_array);

                        //  dumpme($freeze_child_forecast_array);

                        if (count($child_forecast_array) > 0) {
                            $child_flag = 1;
                        }
                    }
                    //GET ANY SENIOR USER LOCKED OR NOT DATA

                    /*   $senior_lock_data = array();

                       if(!empty($login_user_all_parent_data)){

                           foreach($login_user_all_parent_data as $parent_key => $parentid){

                               $get_senioruser_lock_status = $this->esp_model->senior_budget_lock_status($parentid,$budget_id,$monthvalue);
                               if(!empty($get_senioruser_lock_status)){
                                   if($get_senioruser_lock_status[0]["lock_status"] == 1){

                                       $senior_lock_data[] = 1;

                                   }
                               }

                           }

                       }

                       */

                     //  testdata($employee_month_product_budget_data[0]["created_by_user"]);
                    //CHECK DATA FREEZED OR NOT


                    if ($budget_freeze_data != 0 || $child_flag == 1) {

                        // echo "UMMED";
                        //      dumpme($budget_freeze_data);
                        //     echo $monthvalue."===".$forecast_freeze_data["created_by_user"]." ==". $login_user_id;

                        //  if($budget_freeze_data["freeze_status"] == 1 || $budget_freeze_data["created_by_user"] == $login_user_id){


                        if ($budget_freeze_data["freeze_status"] == 1 || $budget_freeze_data["freeze_status"] == 0)
                        {
                            //SHOW DATA

                            //  echo "1";

                            $editable = "";


                            $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($budget_freeze_data['freeze_user_id']);

                            $locked_user_parent_data = $this->esp_model->get_freeze_user_parent_data($lock_by_id);
                            //   dumpme($locked_user_parent_data);


                            $senior_lock_data = $this->esp_model->get_budget_senior_lock_status_data($login_user_parent_data, $monthvalue, $budget_id);

                            $highest_user_lock_data = $this->esp_model->get_budget_senior_lock_status_data($login_user_highest_level_data, $monthvalue, $budget_id);

                            $logib_user_lock_data = $this->esp_model->get_budget_senior_lock_status_data($login_user_id, $monthvalue, $budget_id);

                            if (!empty($login_user_all_parent_data)) {
                                foreach ($login_user_all_parent_data as $parent_key => $parentid) {
                                    $get_senioruser_lock_status = $this->esp_model->get_budget_senior_lock_status_data($parentid, $budget_id, $monthvalue);
                                    if (!empty($get_senioruser_lock_status) || $get_senioruser_lock_status != 0) {
                                        if ($get_senioruser_lock_status["lock_status"] == 1) {
                                            $senior_lock_data[] = 1;
                                        }
                                    }

                                }
                            }

                            $self_freeze_status = $this->esp_model->get_budget_freeze_status($budget_id, $login_user_id);


                            $self_lock_data = $this->esp_model->get_budget_senior_lock_status_data($login_user_id, $monthvalue, $budget_id);

                            //    dumpme($self_lock_data);
                            //    die;
                            if ($login_user_highest_level_data == $login_user_id) {

                               // testdata($highest_user_lock_data);

                                if($highest_user_lock_data != 0 && $highest_user_lock_data["lock_status"] == 1)
                                {

                                    if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                    {
                                        $editable = "readonly";
                                    }
                                    else
                                    {
                                        $editable = "";
                                    }

                                }
                                else
                                {
                                    $editable = "readonly";
                                }

                                //   echo "aaa".$monthvalue."</br>";
                            } else {
                                if ($senior_lock_data != 0 && $senior_lock_data["lock_status"] == 1) {

                                    $editable = "readonly";
                                     //  echo "bbb".$monthvalue."</br>";

                                }
                                elseif ($senior_lock_data == 0 || $senior_lock_data["lock_status"] == 0)
                                {

                                    if ($self_lock_data != 0 && $self_lock_data["lock_status"] == 1)
                                    {
                                       //     echo "ccc".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }


                                       // $editable = "";
                                    }
                                    elseif ($self_lock_data != 0 && $self_lock_data["lock_status"] == 0 && ($login_user_id != $employee_month_product_budget_data[0]["created_by_user"]))
                                    {
                                          //  echo "ddd".$monthvalue."</br>";
                                        $editable = "readonly";
                                    }
                                    elseif($self_lock_data == 0 && $budget_freeze_data["freeze_status"] == 0 && ($login_user_id == $employee_month_product_budget_data[0]["created_by_user"]))
                                    {
                                       //echo "fff".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }


                                        //   $editable = "";
                                    }
                                    elseif($self_lock_data != 0 && $self_lock_data["lock_status"] == 0 && ($login_user_id == $employee_month_product_budget_data[0]["created_by_user"])){

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }

                                       // $editable = "";
                                    }
                                    else
                                    {
                                          // echo "eee".$monthvalue."</br>";
                                        $editable = "readonly";
                                    }
                                }
                            }


                            $html .= '<td><input rel="' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" class="budget_qty" id="budget_qty_' . $l . '_' . $skuvalue['product_sku_country_id'] . '" type="text" name="budget_qty[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $budget_qty . '" ' . $editable . ' /></td>';

                            $html .= '<td><input id="budget_value_' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" type="text" name="budget_value[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $budget_value . '" readonly /></td>';

                            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {
                                $data_inner_array["budget_qty"] = $budget_qty;
                                $data_inner_array["budget_value"] = $budget_value;

                                $data_inner_array["editable"] = $editable;
                            }


                        } elseif ($child_flag == 1) {

                          //   echo "2";


                            $editable = "";


                            $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($budget_freeze_data['freeze_user_id']);

                            $locked_user_parent_data = $this->esp_model->get_freeze_user_parent_data($lock_by_id);
                            //   dumpme($locked_user_parent_data);


                            $senior_lock_data = $this->esp_model->get_budget_senior_lock_status_data($login_user_parent_data, $monthvalue, $budget_id);

                            $highest_user_lock_data = $this->esp_model->get_budget_senior_lock_status_data($login_user_highest_level_data, $monthvalue, $budget_id);

                            $logib_user_lock_data = $this->esp_model->get_budget_senior_lock_status_data($login_user_id, $monthvalue, $budget_id);

                            if (!empty($login_user_all_parent_data)) {
                                foreach ($login_user_all_parent_data as $parent_key => $parentid) {
                                    $get_senioruser_lock_status = $this->esp_model->get_budget_senior_lock_status_data($parentid, $budget_id, $monthvalue);
                                    if (!empty($get_senioruser_lock_status) || $get_senioruser_lock_status != 0) {
                                        if ($get_senioruser_lock_status["lock_status"] == 1) {
                                            $senior_lock_data[] = 1;
                                        }
                                    }

                                }
                            }


                            $self_freeze_status = $this->esp_model->get_budget_freeze_status($budget_id, $login_user_id);
                            $self_lock_data = $this->esp_model->get_budget_senior_lock_status_data($login_user_id, $monthvalue, $budget_id);

                            // dumpme($self_lock_data);

                            if ($login_user_highest_level_data == $login_user_id) {

                                if($highest_user_lock_data != 0 && $highest_user_lock_data["lock_status"] == 1)
                                {

                                    if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                    {
                                        $editable = "readonly";
                                    }
                                    else
                                    {
                                        $editable = "";
                                    }

                                    //$editable = "";
                                }
                                else
                                {
                                    $editable = "readonly";
                                }

                               // $editable = "";

                                //   echo "aaa".$monthvalue."</br>";
                            } else {
                                if ($senior_lock_data != 0 && $senior_lock_data["lock_status"] == 1) {

                                    $editable = "readonly";
                                    //   echo "bbb".$monthvalue."</br>";

                                } elseif ($senior_lock_data == 0 || $senior_lock_data["lock_status"] == 0) {

                                    if ($self_lock_data != 0 && $self_lock_data["lock_status"] == 1) {
                                        //    echo "ccc".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }

                                        //$editable = "";
                                    }

                                    elseif ($self_lock_data != 0 && $self_lock_data["lock_status"] == 0 && ($login_user_id != $employee_month_product_budget_data[0]["created_by_user"]))
                                    {
                                        //  echo "ddd".$monthvalue."</br>";
                                        $editable = "readonly";
                                    }
                                    elseif($self_lock_data == 0 && $budget_freeze_data["freeze_status"] == 0 && ($login_user_id == $employee_month_product_budget_data[0]["created_by_user"]))
                                    {
                                        //echo "fff".$monthvalue."</br>";

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }

                                        //$editable = "";
                                    }
                                    elseif($self_lock_data != 0 && $self_lock_data["lock_status"] == 0 && ($login_user_id == $employee_month_product_budget_data[0]["created_by_user"])){

                                        if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                                        {
                                            $editable = "readonly";
                                        }
                                        else
                                        {
                                            $editable = "";
                                        }

                                        //$editable = "";
                                    }
                                  //  elseif ($self_lock_data != 0 && $self_lock_data["lock_status"] == 0) {
                                        //    echo "ddd".$monthvalue."</br>";


                                    //    $editable = "readonly";
                                   // }
                                    //  elseif($self_lock_data == 0 && $budget_freeze_data["freeze_status"] == 0){
                                    //    echo "fff".$monthvalue."</br>";
                                    //      $editable = "";
                                    //   }
                                    else {
                                        //   echo "eee".$monthvalue."</br>";
                                        $editable = "readonly";
                                    }
                                }
                            }


                            $html .= '<td><input rel="' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" class="budget_qty" id="budget_qty_' . $l . '_' . $skuvalue['product_sku_country_id'] . '" type="text" name="budget_qty[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $budget_qty . '" ' . $editable . ' /></td>';

                            $html .= '<td><input id="budget_value_' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" type="text" name="budget_value[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $budget_value . '" readonly /></td>';

                            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {
                                $data_inner_array["budget_qty"] = $budget_qty;
                                $data_inner_array["budget_value"] = $budget_value;

                                $data_inner_array["editable"] = $editable;
                            }

                        } else {

                             //   echo "3";

                            /*  $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value=""   /></td>';

                              $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';

                                 if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
                                      $data_inner_array["forecast_qty"] = "";
                                      $data_inner_array["forecast_value"] = "";

                                      $data_inner_array["editable"] = "";
                                }

                                */

                            $html .= '<td><input rel="' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" class="budget_qty" id="budget_qty_' . $l . '_' . $skuvalue['product_sku_country_id'] . '" type="text" name="budget_qty[' . $skuvalue['product_sku_country_id'] . '][]" value=""  /></td>';

                            $html .= '<td><input id="budget_value_' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" type="text" name="budget_value[' . $skuvalue['product_sku_country_id'] . '][]" value="" readonly /></td>';

                            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {
                                $data_inner_array["budget_qty"] = "";
                                $data_inner_array["budget_value"] = "";

                                $data_inner_array["editable"] = "";

                            }


                        }


                    } else {

                        //   dumpme($forecast_freeze_data);
                        //    echo $login_user_id." == ".$forecast_freeze_data['created_by_user'];

                        if ($login_user_id == $employee_month_product_budget_data[0]['created_by_user']) {

                            /*  $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_qty.'"  /></td>';

                             $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="'.$forecast_value.'" readonly /></td>';

                           if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
                                 $data_inner_array["forecast_qty"] = $forecast_qty;
                                 $data_inner_array["forecast_value"] = $forecast_value;

                               $data_inner_array["editable"] = "readonly";
                           }

                           */

                           // echo "4";

                            $editable = "";

                            $self_freeze_status = $this->esp_model->get_budget_freeze_status($budget_id, $login_user_id);

                            if($self_freeze_status != 0 && $self_freeze_status["freeze_status"] == 1)
                            {
                                $editable = "readonly";
                            }
                            else
                            {
                                $editable = "";
                            }


                            $html .= '<td><input rel="' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" class="budget_qty" id="budget_qty_' . $l . '_' . $skuvalue['product_sku_country_id'] . '" type="text" name="budget_qty[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $budget_qty . '" ' . $editable . '  /></td>';

                            $html .= '<td><input id="budget_value_' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" type="text" name="budget_value[' . $skuvalue['product_sku_country_id'] . '][]" value="' . $budget_value . '" readonly /></td>';

                            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {
                                $data_inner_array["budget_qty"] = $budget_qty;
                                $data_inner_array["budget_value"] = $budget_value;

                                $data_inner_array["editable"] = $editable;

                            }

                        } else {

                            //NOT FREZEED
                            /* $html .= '<td><input rel="'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" class="forecast_qty" id="forecast_qty_'.$l.'_'.$skuvalue['product_sku_country_id'].'" type="text" name="forecast_qty['.$skuvalue['product_sku_country_id'].'][]" value=""   /></td>';

                                 $html .= '<td><input id="forecast_value_'.$l.'_'.$skuvalue['product_sku_country_id'].'_'.$monthvalue.'" type="text" name="forecast_value['.$skuvalue['product_sku_country_id'].'][]" value="" readonly /></td>';

                               if(isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])){
                                     $data_inner_array["forecast_qty"] = "";
                                     $data_inner_array["forecast_value"] = "";

                                   $data_inner_array["editable"] = "";
                               }

                               */

                          //  echo "5";

                            $html .= '<td><input rel="' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" class="budget_qty" id="budget_qty_' . $l . '_' . $skuvalue['product_sku_country_id'] . '" type="text" name="budget_qty[' . $skuvalue['product_sku_country_id'] . '][]" value=""  /></td>';

                            $html .= '<td><input id="budget_value_' . $l . '_' . $skuvalue['product_sku_country_id'] . '_' . $monthvalue . '" type="text" name="budget_value[' . $skuvalue['product_sku_country_id'] . '][]" value="" readonly /></td>';

                            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {
                                $data_inner_array["budget_qty"] = "";
                                $data_inner_array["budget_value"] = "";

                                $data_inner_array["editable"] = "";

                            }


                        }

                    }

                    if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {

                        $data_inner_array["productid"] = $skuvalue['product_sku_country_id'];
                        $data_inner_array["productname"] = $skuvalue['product_sku_name'];
                        //$data_inner_array["forecast_qty"] = $forecast_qty;
                        //$data_inner_array["forecast_value"] = $forecast_value;

                        $webservice_final_array[$monthvalue]["monthvalue"] = $monthvalue;
                        $webservice_final_array[$monthvalue]["monthname"] = $month . "-" . $year;

                        $webservice_final_array[$monthvalue]['productdata'][] = $data_inner_array;
                        //if($lock_status == ""){
                        //    $lock_status = 0;
                        //}
                        //$webservice_final_array[$monthvalue]["lock_status"] = $lock_status;

                    }

                    $l++;

                }
                $html .= '<td></td>';
                $html .= '</tr>';

            }


            $html .= '</tbody>';
            $html .= '</table>';

            $freeze_button = "";


            $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary  freeze_data" id="freeze_data" rel="' . $selected_year . '">Freeze</button></div>';

            $freeze_button_data = "1";

            $budget_freeze_data2 = $this->esp_model->get_budget_freeze_history_user_status_data($login_user_id, $budget_id);

            //testdata($budget_freeze_data2);

            if (!empty($budget_freeze_data2)) {
                if (!empty($budget_freeze_data2) && $budget_freeze_data2[0]["freeze_status"] == 0) {
                    $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary freeze_data" id="freeze_data" rel="' . $selected_year . '">Freeze</button></div>';


                    $freeze_button_data = 1;

                } else {
                    $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary freeze_data" id="freeze_data" rel="' . $selected_year . '">Unfreeze</button></div>';

                    $freeze_button_data = 0;

                }
            } else {
                $freeze_button = '<div id="freeze_area" class="freeze_area_btn"><button type="submit" class="btn btn-primary freeze_data" id="freeze_data" rel="' . $selected_year . '">Freeze</button></div>';

                $freeze_button_data = 1;

            }

            //echo $login_user_highest_level_data." == ".$login_user_id;die;


            if ($login_user_highest_level_data == $login_user_id) {
                $freeze_button = '';
                $freeze_button_data = "";
            }


            $child_user_data1 = $this->esp_model->get_user_selected_level_data($login_user_id, null);

            //  testdata($child_user_data1);

            if ($child_user_data1["level_users"] != "") {


                $freeze_child_forecast_array = array_filter($freeze_child_forecast_array);
                //   dumpme($freeze_child_forecast_array);

                if (count($freeze_child_forecast_array) > 0) {
                    $freeze_child_flag = 1;
                }


                if ($freeze_child_flag != 1) {
                    $freeze_button = '';
                    $freeze_button_data = "";
                }
            }


            if (isset($webservice_data['webservice']) && !empty($webservice_data['webservice'])) {


                $final_array = array();

                $final_array["budget_data"] = array_values($webservice_final_array);
                $final_array["budget_id"] = $budget_id;
                $final_array["freeze_status"] = $freeze_button_data;
                //$final_array["freeze_show"] = $freeze_button_data;

                //testdata($final_array);

                return $final_array;
                //die;
            }


            $html2 .= '<div class="col-md-12 table_bottom text-center">
                <input type="hidden" id="budget_id" name="budget_id" value="' . $budget_id . '" />
                <div class="row">
                    <div class="save_btn">
                        <button id="save_data" type="submit" class="btn btn-primary">Save</button>
                        ' . $freeze_button . '
                    </div>
                </div>
            </div>';


        }

        echo $html . $html2;
        die;

    }

    public function add_budget($webservice_data = NULL)
    {
        // testdata($_POST);
        //  $forecast_data = $this->esp_model->add_forecast_data();

        if ($webservice_data != NULL) {
            $_POST = $webservice_data;
        }


        if (isset($_POST) && !empty($_POST)) {

            //   testdata($_POST);

            if ($webservice_data == NULL) {

                if (!isset($_POST['employee_data'])) {
                    $budget_user_id = $_POST['login_user_id'];
                } else {
                    $budget_user_id = $_POST['employee_data'];
                }

            } else {
                if (isset($webservice_data["emp_id"]) && $webservice_data["emp_id"] != "") {
                    $budget_user_id = $webservice_data["emp_id"];
                } else {
                    $budget_user_id = $webservice_data['login_user_id'];
                }
            }



            $businss_data = $this->esp_model->get_business_code($budget_user_id);

            //testdata($businss_data);

            $user_business_code = $businss_data;

            $pbg_id = $_POST['pbg_data'];
            $created_user_id = $_POST['login_user_id'];


            //CHECK FOR EMMPLOYEE AND PBG RECORD ALREADY EXIST


            $final_array = array();

            $i = 1;

            $budget_insert_id = '';

            if (!empty($_POST['month_data'])) {
                foreach ($_POST['month_data'] as $month_key => $month_value) {

                    $check_record_exist = $this->esp_model->check_budget_data($pbg_id, $user_business_code, $month_value);

                    if ($check_record_exist != 0) {

                        //UPDATE 

                        $old_budget_id = $check_record_exist[0]['budget_id'];

                        $budget_insert_id = $old_budget_id;
                        //UPDATE MAIN TABLE RECORD

                        $update_status = $this->esp_model->update_budget_data($old_budget_id, $created_user_id);

                    } else {

                        //INSERT
                        if ($budget_insert_id == "") {
                            $budget_insert_id = $this->esp_model->insert_budget_data($pbg_id, $created_user_id, $user_business_code, $_POST['login_user_id']);
                        }

                    }

                    foreach ($_POST['product_sku_id'] as $pkey => $product_data) {

                        $initial_array_budgetqty = $_POST['budget_qty'][$product_data][$month_key];

                        $initial_array_budgetvalue = $_POST['budget_value'][$product_data][$month_key];

                        $final_array[$month_value]['productid'][$product_data]['budget_qty'] = $initial_array_budgetqty;

                        $final_array[$month_value]['productid'][$product_data]['budget_value'] = $initial_array_budgetvalue;

                    }

                    $i++;
                }
            }

           //  testdata($budget_insert_id);

            if (!empty($final_array)) {
                foreach ($final_array as $key_data => $data) {

                    $old_budget_id = "";

                    $month_data = $key_data;

                    foreach ($data["productid"] as $product_id => $product_data) {


                        $budget_qty = $product_data["budget_qty"];
                        $budget_value = $product_data["budget_value"];

                        $get_product_old_data = $this->esp_model->get_budget_product_details($businss_data, $product_id, $month_data);

                        //echo "aaaaa<pre>";
                        //print_r($get_product_old_data);

                        //echo "</br>";

                        if ($get_product_old_data != 0) {

                            //echo "UPDATE----".$businss_data."----".$product_id.'----'.$month_data."</br>";

                            //UPDATE MAIN TABLE RECORD

                            $budget_product_id = $get_product_old_data[0]['budget_product_id'];
                            $old_budget_id = $get_product_old_data[0]['budget_id'];

                            $update_status = $this->esp_model->update_budget_product_details($budget_product_id, $budget_qty, $budget_value);

                            //$history_status_data = 1;

                            //ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE

                            //	 $this->esp_model->insert_forecast_product_details_history($old_forecast_id,$businss_data,$pbg_id,$product_id,$month_data,$forecast_qty,$forecast_value,$history_status_data);


                        } else {

                            //echo "INSERT----".$businss_data."----".$product_id.'----'.$month_data."</br>";

                            $this->esp_model->insert_budget_product_details($budget_insert_id, $businss_data, $product_id, $month_data, $budget_qty, $budget_value);

                            //$history_status_data = 0;

                            //ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE

                            //	 $this->esp_model->insert_forecast_product_details_history($forecast_insert_id,$businss_data,$pbg_id,$product_id,$month_data,$forecast_qty,$forecast_value,$history_status_data);

                        }

                    }

                }

            }

        }


        if ($webservice_data != NULL) {
            $result = "Data Updated Successfully";
            return $result;
        } else {
            echo $budget_insert_id;
            die;
            //redirect('esp/budget');
        }

    }

    public function update_budget_freeze_status($webservice_data = NULL)
    {

        if (isset($webservice_data) && !empty($webservice_data) && $webservice_data != NULL) {

            $user_id = $webservice_data['user_id'];
            $budget_id = $webservice_data['budgetid'];
            $freeze_status_data = $webservice_data['freeze_status'];

            if ($freeze_status_data == 1) {
                $text_data = "Freeze";
            }

            if ($freeze_status_data == 0) {
                $text_data = "Unfreeze";
            }

        } else {

            $user = $this->auth->user();
            $budget_id = $_POST["budgetid"];
            $text_data = $_POST["textdata"];

            $user_id = $user->id;
        }

        $freeze_data = $this->esp_model->update_budget_freeze_status_data($user_id, $budget_id, $text_data);

        if (isset($webservice_data) && !empty($webservice_data) && $webservice_data != NULL) {
            return $freeze_data;
        } else {
            echo $freeze_data;
            die;
        }

    }

    public function get_budget_lock_status($webservice_data = null)
    {

        if ($webservice_data == null) {
            $budget_id = $_POST["budgetid"];
            $year_data = $_POST["yeardata"];

            $user = $this->auth->user();
            $login_user_id = $user->id;
        } else {

            $budget_id = $webservice_data["budgetid"];
            $year_data = $webservice_data["yeardata"];

            $login_user_id = $webservice_data["user_id"];

        }

        $from_month = $year_data . "-01-01";
        $to_month = $year_data . "-12-01";

        $lock_status = 0;

        $login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);

        $login_user_highest_level_data = $this->esp_model->get_higher_level_employee_for_loginuser($login_user_id);


        $get_higher_user_lock_status = $this->esp_model->senior_budget_lock_status($login_user_highest_level_data, $budget_id, $from_month);


        if (($get_higher_user_lock_status != 0 || !empty($get_higher_user_lock_status)) && ($get_higher_user_lock_status[0]["lock_status"] == 1)) {
            $lock_status = 1;
        } else {
            if ($login_user_parent_data != 0) {

                $get_user_lock_status = $this->esp_model->senior_budget_lock_status($login_user_parent_data, $budget_id, $from_month);
                if (($get_user_lock_status != 0 || !empty($get_user_lock_status)) && ($get_user_lock_status[0]["lock_status"] == 1)) {
                    $lock_status = 1;
                }
            }
        }


        $global_head_user = array();
        $login_user_all_parent_data = $this->esp_model->get_employee_for_loginuser($login_user_id, $global_head_user);

        $all_senior_lock_data = array();

        if (!empty($login_user_all_parent_data)) {
            foreach ($login_user_all_parent_data as $parent_key => $parentid) {
                $get_senioruser_lock_status = $this->esp_model->senior_budget_lock_status($parentid, $budget_id, $from_month);
                if (!empty($get_senioruser_lock_status) || $get_senioruser_lock_status != 0) {
                    if ($get_senioruser_lock_status[0]["lock_status"] == 1) {
                        $all_senior_lock_data[] = 1;
                    }
                }

            }
        }


        if (!empty($all_senior_lock_data)) {

            if ($webservice_data == null) {
                echo 1;
                die;
            } else {
                return 1;
            }
        } else {
            if ($webservice_data == null) {
                echo 0;
                die;
            } else {
                return 0;
            }
        }


        /*
        if($webservice_data == null){
            echo $lock_status;
            die;
        }
        else{
           return $lock_status; 
        }
        */
    }

    public function get_self_budget_lock_status($webservice_data = null)
    {

        if ($webservice_data == null) {
            $budget_id = $_POST["budgetid"];
            $year_data = $_POST["yeardata"];

            $user = $this->auth->user();
            $login_user_id = $user->id;
        } else {


         //   testdata($webservice_data);
            $budget_id = $webservice_data["budgetid"];
            $year_data = $webservice_data["yeardata"];

            $login_user_id = $webservice_data["user_id"];

        }

        $from_month = $year_data . "-01-01";
        $to_month = $year_data . "-12-01";

        $lock_status = 0;

        //$login_user_parent_data = $this->esp_model->get_freeze_user_parent_data($login_user_id);

        //$login_user_highest_level_data = $this->esp_model->get_higher_level_employee_for_loginuser($login_user_id);


        //$get_higher_user_lock_status = $this->esp_model->senior_budget_lock_status($login_user_highest_level_data,$budget_id,$from_month);


        //if(($get_higher_user_lock_status != 0 || !empty($get_higher_user_lock_status)) && ($get_higher_user_lock_status[0]["lock_status"] == 1)){
        //  $lock_status = 1;
        //}
        //else{
        //  if($login_user_parent_data != 0){

        //   $get_user_lock_status = $this->esp_model->senior_budget_lock_status($login_user_parent_data,$budget_id,$from_month);
        $login_user_lock_data = $this->esp_model->get_budget_senior_lock_status_data($login_user_id, $from_month, $budget_id);

//testdata($login_user_lock_data);

        if (($login_user_lock_data != 0 || !empty($login_user_lock_data)) && ($login_user_lock_data["lock_status"] == 1)) {
            $lock_status = 1;
        }
        //   }
        //  }

        if ($webservice_data == null) {
            echo $lock_status;
            die;
        } else {
            return $lock_status;
        }

    }

    public function get_budget_value_data($webservice_data = NULL)
    {

        if ($webservice_data != NULL && (isset($webservice_data['webservice']) && !empty($webservice_data['webservice']))) {

            $product_sku_id = $webservice_data["product_sku_id"];
            $month_data = $webservice_data['month_data'];
            $budgetdata = $webservice_data['budgetdata'];

        } else {

            $relattrval = $_POST['relattrval'];

            $budget_data = explode("_", $relattrval);

            $product_sku_id = $budget_data[1];
            $month_data = $budget_data[2];

            $budgetdata = $_POST['budgetdata'];
        }

        $budget_value = $this->esp_model->get_budget_data($product_sku_id, $month_data);

        $final_budget_value = $budgetdata * $budget_value;

        if ($webservice_data != NULL && (isset($webservice_data['webservice']) && !empty($webservice_data['webservice']))) {
            return $final_budget_value;
        } else {
            echo $final_budget_value;
            die;
        }

    }

    public function set_budget_lock_data($webservice_data = NULL)
    {

        if (isset($webservice_data) && !empty($webservice_data) && $webservice_data != NULL) {

            $user_id = $webservice_data['user_id'];
            $budget_id = $webservice_data['budgetid'];
            $yearval = $webservice_data['yearval'];
            $lock_data = $webservice_data['lock_data'];

            if ($lock_data == 1) {
                $text_data = "Lock";
            }

            if ($lock_data == 0) {
                $text_data = "Unlock";
            }

        } else {

            $user = $this->auth->user();

            $budget_id = $_POST["budgetid"];
            $yearval = $_POST["yearval"];
            $text_data = $_POST["textdata"];
            $user_id = $user->id;

        }

        for ($i = 1; $i <= 12; $i++) {

            if ($i <= 9) {
                $i = "0" . $i;
            }
            $monthval = $yearval . "-" . $i . "-01";
            $lock_data = $this->esp_model->update_budget_lock_status_data($user_id, $budget_id, $monthval, $text_data);

        }

        if (isset($webservice_data) && !empty($webservice_data) && $webservice_data != NULL) {
            return $lock_data;
        } else {
            echo $lock_data;
            die;
        }

    }


    public function forecast_status($webservice_data = NULL)
    {

        Assets::add_module_js('esp', 'esp_budget.js');

        if ($webservice_data != NULL) {

            $user_role_id = $webservice_data["role_id"];
            $user_id = $webservice_data["user_id"];

        } else {

            $user = $this->auth->user();
            $user_role_id = $user->role_id;
            $user_id = $user->id;
        }

        $role_degigination_data = $this->esp_model->get_role_degination_data($user_role_id);

        //testdata($role_degigination_data);

        $final_array = array();

        $webservice_final_array = array();


        $html = "";

        $year = date("Y"); // change this to another year
        $row = 0; // to set the number of rows and columns in yearly calendar 
        $html .= "<table class='main' style='width:50%;float:left;'>"; // Outer table 

        for ($m = 1; $m <= 12; $m++) {
            $month = date($m);  // Month 

            $l = $m;

            if ($l <= 9) {
                $l = "0" . $l;
            }

            $month_data = $year . "-" . $l . "-01";

            $dateObject = DateTime::createFromFormat('!m', $m);
            $monthName = $dateObject->format('F'); // Month name to display at top

            $no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);//calculate number of days in a month

            $j = date('w', mktime(0, 0, 0, $month, 1, $year)); // This will calculate the week day of the first day of the month

            if (($row % 3) == 0) {
                $html .= "</tr><tr>";
            }

            if ($webservice_data != NULL) {
                $webservice_final_array[$month_data]["monthname"] = $monthName . "-" . $year;
                $webservice_final_array[$month_data]["monthvalue"] = $month_data;

                $webservice_final_array[$month_data]["statusdata"] = array();
            }


            $html .= "<td><table class='inner_main' ><td colspan='2' align=center><input type='hidden' name='month_data' value='" . $month_data . "' id='month_data'/> $monthName $year </td></tr>";

            if ($role_degigination_data != 1) {

                $level_user_id = $user_id;

                $html .= "<form id='user_data_form' name='user_data_form'>";

                //echo $role_degigination_data."</br>";

                for ($n = 1; $n < $role_degigination_data; $n++) {

                    $inner_array = array();

                    $level = $n;

                    $levle_data = $this->esp_model->get_user_selected_level_data($level_user_id, $level);

                    // echo $level_user_id."===".$level."</br>";
                    // dumpme($levle_data);

                    $level_user_id = $levle_data['level_users'];

                    $users_forecast_freeze_count_data = $this->esp_model->get_forecast_user_data($levle_data['level_users'], $month_data);

                    $users_forecast_update_count_data = $this->esp_model->get_update_user_data($levle_data['level_users'], $month_data);


                    $html .= "<tr>";
                    $html .= "<td>" . $users_forecast_update_count_data . "</td><td>
						
						<input type='hidden' name='user_level_data_" . $n . "' value='" . $levle_data['level_users'] . "' id='user_level_data_" . $n . "'/>
						
						" . $users_forecast_freeze_count_data . "/" . $levle_data['tot'] . "</td>";
                    $html .= "</tr>";

                    $inner_array["employee_level_data"] = $levle_data['level_users'];

                    $inner_array["update_employee_count"] = $users_forecast_update_count_data;
                    $inner_array["freeze_employee_count"] = $users_forecast_freeze_count_data;
                    $inner_array["total_employee_count"] = $levle_data['tot'];

                    $webservice_final_array[$month_data]["statusdata"][] = $inner_array;

                }

                $html .= "</form>";

            }
            // die;

            $html .= "</tr></table></td>";

            $row = $row + 1;

        } // end of for loop for 12 months

        //testdata($webservice_final_array);
        if ($webservice_data != NULL) {

            $final_array = array();

            $final_array = array_values($webservice_final_array);
            return $final_array;
        }

        $html .= "</table>";

        $child_user_data = $this->esp_model->get_user_selected_level_data($user->id,null);

        Template::set('child_user_data', $child_user_data);

        Template::set('current_user', $user);
        Template::set('calender_data', $html);

        Template::render();

    }

    public function show_month_user_level_data($webservice_data = NULL)
    {

        //testdata($_POST["userlevel_formdata"]);

        $final_array = array();

        if ($webservice_data != NULL) {

            $month_data = $webservice_data["monthval"];

            $webservice_data["userlevel_formdata"] = json_decode($webservice_data["userlevel_formdata"], TRUE);

            $no_of_level = count($webservice_data["userlevel_formdata"]);

            $user_level_formdata = $webservice_data["userlevel_formdata"];


            //dumpme($webservice_data["userlevel_formdata"]);
            //die;

            if (!empty($user_level_formdata)) {

                $l = count($user_level_formdata);

                foreach ($user_level_formdata as $level_key => $leveldata) {

                    //$level_array  = explode("_",$level_key);
                    //$level_data = $level_array["3"];
                    $final_array["level"][] = "Level " . $l;

                    $l--;
                }
            }


        } else {
            $month_data = $_POST["monthval"];
            $no_of_level = count($_POST["userlevel_formdata"]);

            $user_level_formdata = $_POST["userlevel_formdata"];

        }
        $html = "";


        if (!empty($user_level_formdata)) {

            $html .= "<table id='table_user_data' style='width:50%;float:left;'><thead><tr>";

            $level_data_array = array();

            foreach ($user_level_formdata as $user_data_key => $user_level_data) {

                $level_data = $user_level_data["name"];
                $level_array = explode("_", $level_data);
                $level_data = $level_array["3"];
                $level_data_array[] = $level_data;

            }

            $level_data_array = array_reverse($level_data_array);

            foreach ($level_data_array as $l_key => $l_data) {
                $html .= "<th>Level " . $l_data . "</th>";
            }

            $html .= "</tr></thead><tbody>";

            $data_array = array();

            $max_count = 0;

            if ($webservice_data != NULL) {
                $m = count($user_level_formdata);
            }


            foreach ($user_level_formdata as $user_data_key1 => $user_level_data1) {


                if ($webservice_data == NULL) {
                    $level_data = $user_level_data1["name"];

                    $level_array = explode("_", $level_data);

                    $level_data = $level_array["3"];

                    $level_user_data = $user_level_data1["value"];
                } else {
                    $level_user_data = $user_level_data1["employee_level_data"];
                }

                if (!empty($level_user_data)) {
                    $users_forecast_update_status_data = $this->esp_model->get_update_user_detail_data($level_user_data, $month_data);
                } else {
                    $users_forecast_update_status_data = 0;
                }

                if ($users_forecast_update_status_data > $max_count) {
                    $max_count = count($users_forecast_update_status_data);
                }

                if ($webservice_data == NULL) {
                    $data_array[$level_data] = $users_forecast_update_status_data;
                }
                if ($webservice_data != NULL) {

                    $data_array["Level " . $m] = $users_forecast_update_status_data;

                    $final_array["level_data"] = $data_array;
                    $m--;
                }

            }

            //   testdata($data_array);

            //	dumpme($data_array);

            for ($i = 0; $i < $max_count; $i++) {
                $html .= '<tr>';
                for ($j = 0; $j < count($data_array); $j++) {


                    if (isset($data_array[$j + 1][$i])) {
                        $row_data = explode("|||", $data_array[$j + 1][$i]);
                        if ($row_data[1] != "") {
                            $row_data = $row_data[0] . "  " . "<b>&#8226;</b>";
                        } else {
                            $row_data = $row_data[0];
                        }
                    } else {
                        $row_data = "";
                    }

                    $html .= '<td>' . $row_data . '</td>';

                }
                $html .= '</tr>';
            }


            $html .= "</tbody></tbody>";

        }

        if ($webservice_data != NULL) {
            return $final_array;
        }

        echo $html;
        die;

    }

    /*
    public function show_month_user_level_data($webservice_data = NULL)
    {

        //testdata($_POST["userlevel_formdata"]);

        $final_array = array();

        if ($webservice_data != NULL) {

            $month_data = $webservice_data["monthval"];

            $webservice_data["userlevel_formdata"] = json_decode($webservice_data["userlevel_formdata"], TRUE);

            $no_of_level = count($webservice_data["userlevel_formdata"]);

            $user_level_formdata = $webservice_data["userlevel_formdata"];


            //dumpme($webservice_data["userlevel_formdata"]);
            //die;

            if (!empty($user_level_formdata)) {

                $l = count($user_level_formdata);

                foreach ($user_level_formdata as $level_key => $leveldata) {

                    //$level_array  = explode("_",$level_key);
                    //$level_data = $level_array["3"];	
                    $final_array["level"][] = "Level " . $l;

                    $l--;
                }
            }


        } else {
            $month_data = $_POST["monthval"];
            $no_of_level = count($_POST["userlevel_formdata"]);

            $user_level_formdata = $_POST["userlevel_formdata"];

        }
        $html = "";


        if (!empty($user_level_formdata)) {

            $html .= "<table id='table_user_data' style='width:50%;float:left;'><thead><tr>";

            $level_data_array = array();

            foreach ($user_level_formdata as $user_data_key => $user_level_data) {

                $level_data = $user_level_data["name"];
                $level_array = explode("_", $level_data);
                $level_data = $level_array["3"];
                $level_data_array[] = $level_data;

            }

            $level_data_array = array_reverse($level_data_array);

            foreach ($level_data_array as $l_key => $l_data) {
                $html .= "<th>Level " . $l_data . "</th>";
            }

            $html .= "</tr></thead><tbody>";

            $data_array = array();

            $max_count = 0;

            if ($webservice_data != NULL) {
                $m = count($user_level_formdata);
            }


            foreach ($user_level_formdata as $user_data_key1 => $user_level_data1) {


                if ($webservice_data == NULL) {
                    $level_data = $user_level_data1["name"];

                    $level_array = explode("_", $level_data);

                    $level_data = $level_array["3"];

                    $level_user_data = $user_level_data1["value"];
                } else {
                    $level_user_data = $user_level_data1["employee_level_data"];
                }

                if (!empty($level_user_data)) {
                    $users_forecast_update_status_data = $this->esp_model->get_update_user_detail_data($level_user_data, $month_data);
                } else {
                    $users_forecast_update_status_data = 0;
                }

                if ($users_forecast_update_status_data > $max_count) {
                    $max_count = count($users_forecast_update_status_data);
                }

                if ($webservice_data == NULL) {
                    $data_array[$level_data] = $users_forecast_update_status_data;
                }
                if ($webservice_data != NULL) {

                    $data_array["Level " . $m] = $users_forecast_update_status_data;

                    $final_array["level_data"] = $data_array;
                    $m--;
                }

            }

            //   testdata($data_array);


            if ($webservice_data != NULL) {
                return $final_array;
            }

        }

        echo $html;
        die;
    }


    */
    public function generate_forecast_xl_data($webservice_data = null)
    {

        if ($webservice_data == null) {
            $user = $this->auth->user();
            $user_country_id = $user->country_id;
            $bussiness_code = $user->bussiness_code;
        } else {
            $user = $webservice_data["user_id"];
            $user_country_id = $webservice_data["country_id"];
            $bussiness_code = $webservice_data["bussiness_code"];
        }


        $pbgdata = $this->esp_model->get_pbg_data($user_country_id);

        $final_array = array();

        $year = date("Y");

        $from_month = $year . "-01-01";
        $to_month = $year . "-12-01";

        $month_data = $this->get_monthly_data($from_month, $to_month);

        if (!empty($pbgdata)) {

            foreach ($month_data as $month_key => $monthvalue) {

                foreach ($pbgdata as $pbg_key => $pbg_data) {

                    $inner_array = array();

                    //GET PRODUCT SKU FOR EACH PBG

                    $product_sku_country_id = $pbg_data['product_country_id'];
                    $PBG_name = $pbg_data['product_country_name'];

                    $inner_array[$PBG_name]["PBG_name"] = $PBG_name;
                    $inner_array[$PBG_name]["PBG_id"] = $product_sku_country_id;


                    $inner_array[$PBG_name]["sku_data"] = array();

                    $pbg_sku_data = $this->esp_model->get_pbg_sku_data($product_sku_country_id);

                    $forecast_id = 0;

                    if (!empty($pbg_sku_data)) {

                        foreach ($pbg_sku_data as $sku_key => $sku_value) {
                            $sku_data_array = array();

                            $sku_data_array[$sku_value["product_sku_name"]]['product_sku_name'] = $sku_value["product_sku_name"];
                            $sku_data_array[$sku_value["product_sku_name"]]['product_sku_code'] = $sku_value["product_sku_code"];
                            $sku_data_array[$sku_value["product_sku_name"]]['product_sku_id'] = $sku_value["product_sku_country_id"];

                            //FOR GETTING FORECAST DATA FOR SKU

                            $employee_month_product_forecast_data = $this->esp_model->get_employee_month_product_forecast_data($bussiness_code, $sku_value['product_sku_country_id'], $monthvalue);

                            $forecast_qty = 0;

                            if (!empty($employee_month_product_forecast_data)) {
                                $forecast_qty = $employee_month_product_forecast_data[0]["forecast_quantity"];

                                $forecast_id = $employee_month_product_forecast_data[0]["forecast_id"];

                            }


                            $employee_month_product_budget_data = $this->esp_model->get_employee_month_product_budget_data($bussiness_code, $sku_value['product_sku_country_id'], $monthvalue);

                            $budget_qty = 0;

                            if ($employee_month_product_budget_data != 0) {
                                $budget_qty = $employee_month_product_budget_data[0]['budget_quantity'];
                            }


                            $sku_data_array[$sku_value["product_sku_name"]]['forecast_quantity'] = $forecast_qty;
                            $sku_data_array[$sku_value["product_sku_name"]]['budget_quantity'] = $budget_qty;

                            $inner_array[$PBG_name]["sku_data"][] = $sku_data_array;

                        }

                    }


                    //GETTING ASSUMPTION AND PROBABLITY DATA

                    if ($forecast_id != 0) {

                        $month_assumption_forecast_data = $this->esp_model->get_month_assumption_forecast_data($forecast_id, $monthvalue);

                        if (isset($month_assumption_forecast_data[0]["assumption1_id"]) && $month_assumption_forecast_data[0]["assumption1_id"] != "") {
                            $assumption1_id = $month_assumption_forecast_data[0]["assumption1_id"];
                        } else {
                            $assumption1_id = 0;
                        }

                        if (isset($month_assumption_forecast_data[0]["assumption2_id"]) && $month_assumption_forecast_data[0]["assumption2_id"] != "") {
                            $assumption2_id = $month_assumption_forecast_data[0]["assumption2_id"];
                        } else {
                            $assumption2_id = 0;
                        }

                        if (isset($month_assumption_forecast_data[0]["assumption3_id"]) && $month_assumption_forecast_data[0]["assumption3_id"] != "") {
                            $assumption3_id = $month_assumption_forecast_data[0]["assumption3_id"];
                        } else {
                            $assumption3_id = 0;
                        }


                        if (isset($month_assumption_forecast_data[0]["probability1"]) && $month_assumption_forecast_data[0]["probability1"] != "") {
                            $probability1 = $month_assumption_forecast_data[0]["probability1"];
                        } else {
                            $probability1 = 0;
                        }

                        if (isset($month_assumption_forecast_data[0]["probability2"]) && $month_assumption_forecast_data[0]["probability2"] != "") {
                            $probability2 = $month_assumption_forecast_data[0]["probability2"];
                        } else {
                            $probability2 = 0;
                        }

                        if (isset($month_assumption_forecast_data[0]["probability3"]) && $month_assumption_forecast_data[0]["probability3"] != "") {
                            $probability3 = $month_assumption_forecast_data[0]["probability3"];
                        } else {
                            $probability3 = 0;
                        }

                    } else {
                        $assumption1_id = 0;
                        $assumption2_id = 0;
                        $assumption3_id = 0;

                        $probability1 = 0;
                        $probability2 = 0;
                        $probability3 = 0;

                    }

                    $inner_array[$PBG_name]["assumption1"] = $assumption1_id;
                    $inner_array[$PBG_name]["probablity1"] = $probability1;
                    $inner_array[$PBG_name]["assumption2"] = $assumption2_id;
                    $inner_array[$PBG_name]["probablity2"] = $probability2;
                    $inner_array[$PBG_name]["assumption3"] = $assumption3_id;
                    $inner_array[$PBG_name]["probablity3"] = $probability3;

                    $inner_array[$PBG_name]["forecast_id"] = $forecast_id;

                    $final_array[$monthvalue][] = $inner_array;

                }
            }

        } else {

            //NO PBG DATA FOUND

            $final_array[] = "No Data Found";
        }


        if ($webservice_data == null) {

            $xl_data = $this->create_forecast_data_xl($final_array,null);

            die;
        } else {

            $xl_data = $this->create_forecast_data_xl($final_array,"webservice");

            return $xl_data;

        }

    }


    public function create_forecast_data_xl($final_array, $webservice = null)
    {
        //testdata($final_array);
        $this->load->library('excel');
        $obj = new Excel();

        $assumption_data = $this->esp_model->get_assumption_data();

        $assumptiondata = "";

        $assumption_arr = array();

     /*   if (!empty($assumption_data)) {
            foreach ($assumption_data as $k => $ass_data) {

                $assumption_arr[] = $ass_data["assumption_name"];
            }

        }

        if (!empty($assumption_arr)) {
            $assumptiondata = implode(",", $assumption_arr);

            $assumptiondata = '"' . $assumptiondata . '"';

            $assumptiondata = "'" . $assumptiondata . "'";

        }
        */

        $assumption_arr[] = "Banjir";
        $assumption_arr[] = "Curah hujan";
        $assumption_arr[] = "Distribusi sampel demo";
        $assumption_arr[] = "Distribusi sampel gratis";
        $assumption_arr[] = "Dosis penyemprotan";
        $assumption_arr[] = "Harga Naik";
        $assumption_arr[] = "Harga turun";
        $assumption_arr[] = "Hari kegiatan lapangan";
        $assumption_arr[] = "Kelembaban";
        $assumption_arr[] = "Mitra kerja baru";

        //echo "'".$assumptiondata."'";
        //die;
        //testdata($final_array);
        if (!empty($final_array)) {
            $u = 0;
            foreach ($final_array as $key_data => $final_data) {

                // Add new sheet
                $objWorkSheet = $obj->createSheet($u); //Setting index when creating

                //Write cells

                $objWorkSheet->setCellValue('A1', 'PBG Name');
                $objWorkSheet->setCellValue('B1', 'Product SKU Name');
                $objWorkSheet->setCellValue('C1', 'Product SKU Code');
                $objWorkSheet->setCellValue('D1', 'Budget');
                $objWorkSheet->setCellValue('E1', 'Forecast');
                $objWorkSheet->setCellValue('F1', 'Assumption1');
                $objWorkSheet->setCellValue('G1', 'Probability1 (%)');
                $objWorkSheet->setCellValue('H1', 'Assumption2');
                $objWorkSheet->setCellValue('I1', 'Probability2 (%)');
                $objWorkSheet->setCellValue('J1', 'Assumption3');
                $objWorkSheet->setCellValue('K1', 'Probability3 (%)');


                $objWorkSheet->getStyle('A1:K1')->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => '696969')
                        )
                    )
                );


                $BStyle = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('rgb' => '000000')
                        )
                    )
                );

                $objWorkSheet->getDefaultStyle()->getBorders()->applyFromArray($BStyle);

                //$objWorkSheet->getDefaultStyle()->getBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


                $objWorkSheet->getProtection()->setSheet(true);

                $i = 2;
                foreach ($final_data as $pbg_key => $pbg_data) {

                    $k = $i + 1;
                    foreach ($pbg_data as $pbg => $pbgdata) {
                        $pbg_name = $pbgdata["PBG_name"];

                        $objWorkSheet->setCellValue("A$i", $pbg_name);

                        $objWorkSheet->setCellValue("D$i", "0.00");
                        $objWorkSheet->setCellValue("E$i", "0.00");
                    /*
                        $assumption1 = $pbgdata["assumption1"];
                        $assumption2 = $pbgdata["assumption2"];
                        $assumption3 = $pbgdata["assumption3"];

                        $assumption1_name = $this->esp_model->get_assumption_name($assumption1);
                        $assumption2_name = $this->esp_model->get_assumption_name($assumption2);
                        $assumption3_name = $this->esp_model->get_assumption_name($assumption3);

                        */
                       // $objWorkSheet->setCellValue("E$i", $assumption1_name);
                        $objWorkSheet->setCellValue("F$i", "Curah hujan");

                        $objValidation = $objWorkSheet->getCell("F$i")->getDataValidation();
                        $objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                        $objValidation->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                        $objValidation->setAllowBlank(false);
                        $objValidation->setShowInputMessage(true);
                        $objValidation->setShowErrorMessage(true);
                        $objValidation->setShowDropDown(true);
                        $objValidation->setErrorTitle('Input error');
                        $objValidation->setError('Value is not in list.');
                        $objValidation->setPromptTitle('Pick from list');
                        $objValidation->setPrompt('Please pick a value from the drop-down list.');
                        $objValidation->setFormula1('"'.@implode(",",$assumption_arr).'"');

                       // $objWorkSheet->setCellValue("G$i",$assumption2_name);
                        $objWorkSheet->setCellValue("H$i","Harga Naik");

                        $objValidation = $objWorkSheet->getCell("H$i")->getDataValidation();
                        $objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                        $objValidation->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                        $objValidation->setAllowBlank(false);
                        $objValidation->setShowInputMessage(true);
                        $objValidation->setShowErrorMessage(true);
                        $objValidation->setShowDropDown(true);
                        $objValidation->setErrorTitle('Input error');
                        $objValidation->setError('Value is not in list.');
                        $objValidation->setPromptTitle('Pick from list');
                        $objValidation->setPrompt('Please pick a value from the drop-down list.');
                        $objValidation->setFormula1('"'.@implode(",",$assumption_arr).'"');

                        //$objWorkSheet->setCellValue("I$i", $assumption3_name);
                        $objWorkSheet->setCellValue("J$i", "Kelembaban");

                        $objValidation = $objWorkSheet->getCell("J$i")->getDataValidation();
                        $objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                        $objValidation->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                        $objValidation->setAllowBlank(false);
                        $objValidation->setShowInputMessage(true);
                        $objValidation->setShowErrorMessage(true);
                        $objValidation->setShowDropDown(true);
                        $objValidation->setErrorTitle('Input error');
                        $objValidation->setError('Value is not in list.');
                        $objValidation->setPromptTitle('Pick from list');
                        $objValidation->setPrompt('Please pick a value from the drop-down list.');
                        $objValidation->setFormula1('"'.@implode(",",$assumption_arr).'"');


                        $objWorkSheet->getStyle("F$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                        $objWorkSheet->getStyle("H$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                        $objWorkSheet->getStyle("J$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

                        $probablity1 = $pbgdata["probablity1"];
                        $probablity2 = $pbgdata["probablity2"];
                        $probablity3 = $pbgdata["probablity3"];

                        $objWorkSheet->setCellValue("G$i", $probablity1);
                        $objWorkSheet->setCellValue("I$i", $probablity2);
                        $objWorkSheet->setCellValue("K$i", $probablity3);

                        $objWorkSheet->getStyle("G$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                        $objWorkSheet->getStyle("I$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                        $objWorkSheet->getStyle("K$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

                        $objWorkSheet->getStyle("B$i:E$i")->applyFromArray(
                            array(
                                'fill' => array(
                                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array('rgb' => '696969')
                                )

                            )
                        );

                        if (!empty($pbgdata['sku_data'])) {
                            foreach ($pbgdata['sku_data'] as $sku_key => $sku_data) {

                                foreach ($sku_data as $skukey1 => $skudata1) {

                                    $objWorkSheet->setCellValue("A$k", $pbg_name);

                                    $objWorkSheet->setCellValue("B$k", $skudata1["product_sku_name"]);

                                    $objWorkSheet->setCellValue("C$k", $skudata1["product_sku_code"]);

                                    $objWorkSheet->setCellValue("D$k", $skudata1["budget_quantity"]);
                                    $objWorkSheet->setCellValue("E$k", $skudata1["forecast_quantity"]);

                                    $objWorkSheet->getStyle("E$k")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

                                    $objWorkSheet->setCellValue("G$i", 0);
                                    $objWorkSheet->setCellValue("I$i", 0);
                                    $objWorkSheet->setCellValue("K$i", 0);

                                    $objWorkSheet->getStyle("A$k:D$k")->applyFromArray(
                                        array(
                                            'fill' => array(
                                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                                'color' => array('rgb' => '696969')
                                            )

                                        )
                                    );

                                    $objWorkSheet->getStyle("F$k:K$k")->applyFromArray(
                                        array(
                                            'fill' => array(
                                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                                'color' => array('rgb' => '696969')
                                            )

                                        )
                                    );

                                    $i = $k;

                                }

                                $k++;

                            }

                        }

                    }
                    $i++;
                }

                // Rename sheet
                $objWorkSheet->setTitle("$key_data");

                $u++;
            }
        }

        // $filename='just_some_random_name.xls'; //save our workbook as this file name
        $filename = 'Data_' . strtotime(date('d-m-y h:i:s')) . '.xlsx';
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD

        if($webservice == "webservice")
        {
            if (file_exists(FCPATH . "assets/uploads/Uploads/esp_forecast/" . $filename)) {
                unlink(FCPATH . "assets/uploads/Uploads/esp_forecast/" . $filename);
            }
            $objWriter->save(FCPATH . "assets/uploads/Uploads/esp_forecast/" . $filename);

            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = base_url()."assets/uploads/Uploads/esp_forecast/".$filename;
            echo json_encode($result);
            die;
        }
        else
        {
            $objWriter->save('php://output');
            exit();
        }

    }

    public function upload_forecast_data($webservice_data = null)
    {

        if ($webservice_data == null) {

            $user = $this->auth->user();
            $user_id = $user->id;
            $user_country_id = $user->country_id;
            $bussiness_code = $user->bussiness_code;
            $files = $_POST["upload_file_data"];

        } else {
            $user_id = $_POST["user_id"];
            $files = $_FILES["upload_file_data"];
            $user_country_id = $_POST["country_id"];
            $bussiness_code = $_POST["bussiness_code"];
        }



        if (!empty($files)) {

            $file = $_FILES["upload_file_data"]["tmp_name"];

            $filename = explode("_", $_FILES["upload_file_data"]["name"]);

            //$filename[] = $_POST["upload_file_data"]["name"];


            $ext = explode(".", $_FILES["upload_file_data"]["name"]);


            if ($ext[1] == "xls" || $ext[1] == "xlsx") {

                //load the excel library
                $this->load->library('excel');

                //read file from path
                $objPHPExcel = PHPExcel_IOFactory::load($file);

                $sheetCount = $objPHPExcel->getSheetCount();
                $sheetNames = $objPHPExcel->getSheetNames();

                if ($sheetCount == 12) {

                    /*     if ($sheetNames[0] == "budget") {

                         */


                    /*    } else {
                            //SHEET NAME ERROR

                            $error_array["fileerror"][] = "Please upload desired file.";
                            echo json_encode($error_array);
                            die;

                        }
*/

                    $final_array = array();

                    for ($j = 0; $j < $sheetCount; $j++) {

                        $sheetName = $sheetNames[$j];

                        $objWorkSheet = $objPHPExcel->setActiveSheetIndex($j);

                        $cell_collection = $objPHPExcel->getActiveSheet($j)->getCellCollection();

                        //extract to a PHP readable array format

                        $i = 1;

                        $arr_data = array();

                        foreach ($cell_collection as $cell) {

                            $inner_array = array();

                            //if($i != 1){
                            $column = $objPHPExcel->getActiveSheet($j)->getCell($cell)->getColumn();
                            $row = $objPHPExcel->getActiveSheet($j)->getCell($cell)->getRow();
                            $data_value = $objPHPExcel->getActiveSheet($j)->getCell($cell)->getValue();


                            if ($row == 1) {

                                $header[$row][$column] = $data_value;

                            }

                            if ($row != 1) {
                                if ($column == "A" || $column == "B" || $column == "C") {
                                    $arr_data[$row][$column] = $data_value;
                                } elseif ($column == "E") {
                                    $arr_data[$row]["forecast"][$column] = $data_value;
                                    // $inner_array["forecast"] = $data_value;
                                } elseif ($column == "F" || $column == "H" || $column == "J") {
                                    //$inner_array["assumption"][] = $data_value;
                                    $arr_data[$row]["assumption"][$column] = $data_value;
                                } elseif ($column == "G" || $column == "I" || $column == "K") {
                                    //  $inner_array["probablity"][] = $data_value;
                                    $arr_data[$row]["probablity"][$column] = $data_value;
                                }
                            }


                            /*
                            if($column == "B" && $data_value == "") {
                                $arr_data[$data_value]["assumption"] = array();
                                $arr_data[$data_value]["probablity"] = array();
                                $arr_data[$data_value]["skudata"] = array();
                            }

                            */


                            if ($row == 10) {
                              //  break;
                                // die;
                            }
                            $i++;

                            // $arr_data[] = $inner_array;

                        }

                        $data['values'] = $arr_data;
                        $data['header'] = $header[1];

                        $final_array[$sheetName] = $data;

                      //  break;
                        //  testdata($final_array);
                    }

                 //   testdata($final_array);

               $original_final_array = array();

              if(!empty($final_array))
              {
                    $l = 0;
                 foreach ($final_array as $f_key => $f_forecast_data)
                 {
                    $month_data = $f_key;

                    foreach ($f_forecast_data["values"] as $key => $forecast_data)
                    {

                        $pbg = isset($forecast_data["A"]) ? $forecast_data["A"] : "";
                        $sku_code = isset($forecast_data["C"]) ? $forecast_data["C"] : "";
                        $product_sku_name = isset($forecast_data["B"]) ? $forecast_data["B"] : "";

                        if($sku_code != "")
                        {
                            $sku_id = $this->esp_model->get_sku_data($sku_code);
                        }
                        else
                        {
                            $sku_id = "";
                        }


                        if ($pbg != "") {
                            $pbg_id = $this->esp_model->get_pbg_detail_data($pbg, $user_country_id);
                        } else {
                            $pbg_id = "";
                        }

                        if (($pbg != "" || $pbg != 0) && ($pbg_id != "" || $pbg_id != 0)) {

                            $pbg = preg_replace('/\s+/', '_', $pbg);

                            $original_final_array[$month_data][$pbg]["user_id"] = $user_id;
                            $original_final_array[$month_data][$pbg]["user_country_id"] = $user_country_id;
                            $original_final_array[$month_data][$pbg]["bussiness_code"] = $bussiness_code;

                            $original_final_array[$month_data][$pbg]["pbg_id"] = $pbg_id;
                            $original_final_array[$month_data][$pbg]["pbg_name"] = $pbg;

                            if (isset($forecast_data["forecast"])) {
                                if ($sku_code != "") {
                                    $original_final_array[$month_data][$pbg]["forecast"][$sku_id] = $forecast_data["forecast"]["E"];
                                }
                            }

                            if (isset($forecast_data["assumption"])){
                                if ($sku_code == "" && $product_sku_name == "") {
                                    $original_final_array[$month_data][$pbg]["assumption"] = array_values($forecast_data["assumption"]);
                                }
                            }

                            if (isset($forecast_data["probablity"])){
                                if ($sku_code == "" && $product_sku_name == "") {
                                    $original_final_array[$month_data][$pbg]["probablity"] = array_values($forecast_data["probablity"]);
                                }
                            }
                        }
                    }

                     //NEED TO REMOVE BEFORE UPLOAD
                    // if($l == 1){
                    //     break;
                    // }
                     $l++;
                 }

                 // $result_array["status"] = "true";






                  if ($webservice_data == null)
                  {
                      $result_array["data"][] = $original_final_array;
                      echo json_encode($result_array);
                      die;
                  }
                  else
                  {

                      $filename = explode(".",$_FILES["upload_file_data"]["name"]);

                      $filename1 = $user_id."_".$filename[0].".txt";

                      if(file_exists(FCPATH . "assets/uploads/Uploads/esp_forecast/" . $filename1))
                      {
                          unlink(FCPATH . "assets/uploads/Uploads/esp_forecast/" . $filename1);
                      }

                      $myfile = fopen(FCPATH . "assets/uploads/Uploads/esp_forecast/" . $filename1, "w");

                      $result_array["data"][] = $original_final_array;
                      // echo json_encode($result_array);

                      $f_data = json_encode($result_array);
                      fwrite($myfile, $f_data);

                      //$file = FCPATH . "assets/uploads/Uploads/esp_budget/esp_budget.txt";

                      //$file_content = file_get_contents($file);

                      $final_array1["status"] = true;
                      $final_array1["data"] = FCPATH . "assets/uploads/Uploads/esp_forecast/" . $filename1;
                      return json_encode($final_array1);
                  }


              }
              else
              {

                  $error_array["fileerror"][] = "No Data found.";
                  echo json_encode($error_array);
                  die;

              }
                } else {
                    //SHEEET COUNT ERROR

                    $error_array["fileerror"][] = "File must contain twelve sheets only.";
                    echo json_encode($error_array);
                    die;
                }

            } else {
                //EXTENSION ERROR

                $error_array["fileerror"][] = "Incorrect format. Please upload xlsx or xls format file.";
                echo json_encode($error_array);
                die;
            }

        } else {
            $error_array["fileerror"][] = "No file uploaded.";
            echo json_encode($error_array);
            die;
        }

    }


    public function upload_xl_forecast_data($webservice_data = null)
    {

      //  testdata(json_decode($_POST["val"][0],true));
        if ($webservice_data != null) {
            $_POST["val"] = json_decode($webservice_data["val"], true);
        }

        //$user_id,$pbg_id,$sku_id,$user_country_id,$bussiness_code,$budget_data

        $updated_pbg_data_array = array();

       // testdata($_POST["val"][0]);

        foreach ($_POST["val"][0] as $key_data => $forecast_data) {
            $monthdata = $key_data;
            foreach($forecast_data as $k => $forecastdata) {

               // dumpme($forecastdata);


                $user_id = $forecastdata["user_id"];
                $country_id = $forecastdata["user_country_id"];
                $bussiness_code = $forecastdata["bussiness_code"];
                $pbg_id = $forecastdata["pbg_id"];

                $pbg_name = $forecastdata["pbg_name"];

                $pbg_name = preg_replace('/\_+/', ' ', $pbg_name);

                $assumption = isset($forecastdata["assumption"]) ? $forecastdata["assumption"] : "";

                if ($assumption != "") {

                    //GET ASSUMPTION ID FROM NAME

                    $asump_data = array();

                    foreach ($assumption as $ass_key => $assumption_data) {

                        if ($assumption_data != "" || $assumption_data != 0) {

                            $assumptiondata = $this->esp_model->get_assumption_single_data($assumption_data);
                            $asump_data[] = $assumptiondata;
                        }

                    }

                    $assumption = $asump_data;
                }

                $probablity = isset($forecastdata["probablity"]) ? $forecastdata["probablity"] : "";

                $forecast = isset($forecastdata["forecast"]) ? $forecastdata["forecast"] : "";

                //GET CURRENT USER FREEZE STATUS
                if($bussiness_code != "" || !empty($bussiness_code) || $bussiness_code != NULL){

                $employee_month_product_forecast_data2 = $this->esp_model->get_employee_product_forecast_data($bussiness_code, $pbg_id, $user_id);

                if (!empty($employee_month_product_forecast_data2) || $employee_month_product_forecast_data2 != 0) {
                    $forecast_id = $employee_month_product_forecast_data2[0]['forecast_id'];

                    $forecast_freeze_data2 = $this->esp_model->forecast_freeze_status_history($forecast_id, $monthdata, $user_id);

                    if (($forecast_freeze_data2 != 0 && $forecast_freeze_data2["freeze_status"] == 0) || $forecast_freeze_data2 == 0) {
                        // UPDATE FORECAST DATA

                        //FOR FORECAST DATA UPDATE

                        $update_status = $this->esp_model->update_forecast_data($forecast_id, $user_id);

                        if ($forecast != "") {
                            foreach ($forecast as $product_id => $f_data) {
                                $get_product_old_data = $this->esp_model->get_forecast_product_details($bussiness_code, $product_id, $monthdata);

                                if ($get_product_old_data != 0) {

                                    //UPDATE OLD FORECAST DATA

                                    $forecast_product_id = $get_product_old_data[0]['forecast_product_id'];
                                    $old_forecast_id = $get_product_old_data[0]['forecast_id'];

                                    $forecast_value = $this->esp_model->get_forecast_data($product_id, $monthdata);
                                    $final_forecast_value = $f_data * $forecast_value;

                                    $update_data = $this->esp_model->update_forecast_product_details($forecast_product_id, $f_data, $final_forecast_value);

                                    $history_status_data = 1;

                                    $this->esp_model->insert_forecast_product_details_history($forecast_id, $bussiness_code, $pbg_id, $product_id, $monthdata, $f_data, $final_forecast_value, $history_status_data);

                                } else {

                                    //IF DATA NOT ALREADY ADDED THAN INSERT FORECAST

                                    $forecast_value = $this->esp_model->get_forecast_data($product_id, $monthdata);
                                    $final_forecast_value = $f_data * $forecast_value;

                                    $this->esp_model->insert_forecast_product_details($forecast_id, $bussiness_code, $product_id, $monthdata, $f_data, $final_forecast_value);

                                    //ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE

                                    $history_status_data = 1;

                                    $this->esp_model->insert_forecast_product_details_history($forecast_id, $bussiness_code, $pbg_id, $product_id, $monthdata, $f_data, $final_forecast_value, $history_status_data);

                                }
                            }
                        }


                        //UPDATE ASSUMPTION AND PROBABLITY DATA

                        $get_assumption_old_data = $this->esp_model->get_forecast_assumption_details($forecast_id, $monthdata);

                        if ($get_assumption_old_data != 0) {

                            //UPDATE ASSUMPTION DATA
                            if ($forecast != "") {
                                if ($assumption != "" && $probablity != "") {

                                    $forecast_assumption_id = $get_assumption_old_data[0]["forecast_assumption_id"];

                                    $assumption_data = implode("~", $assumption);
                                    $probablity_data = implode("~", $probablity);

                                    $update_status = $this->esp_model->update_forecast_assumption_details($forecast_assumption_id, $assumption_data, $probablity_data);

                                    $history_update_status = 1;

                                    $this->esp_model->insert_forecast_assumption_data_history($forecast_id, $assumption_data, $probablity_data, $monthdata, $history_update_status);

                                }
                            }

                        } else {
                            //INSERT ASSUMPTION DATA

                            if ($forecast != "") {
                                if ($assumption != "" && $probablity != "") {

                                    $assumption_data = implode("~", $assumption);
                                    $probablity_data = implode("~", $probablity);

                                    //    $update_status = $this->esp_model->update_forecast_assumption_details($forecast_assumption_id, $assumption_data, $probablity_data);

                                    $this->esp_model->insert_forecast_assumption_probablity_data($forecast_id, $assumption_data, $probablity_data, $monthdata);

                                    $history_update_status = 1;

                                    $this->esp_model->insert_forecast_assumption_data_history($forecast_id, $assumption_data, $probablity_data, $monthdata, $history_update_status);

                                }
                            }

                        }

                    }

                    $updated_pbg_data_array[] = $pbg_name;

                } else {

                    //INSERT FORECAST DATA

                    if ($forecast != "") {

                        $forecast_id = $this->esp_model->insert_forecast_data($pbg_id, $user_id, $bussiness_code, $user_id);
                    }
                    if ($forecast != "") {
                        foreach ($forecast as $product_id => $f_data) {
                            $forecast_value = $this->esp_model->get_forecast_data($product_id, $monthdata);
                            $final_forecast_value = $f_data * $forecast_value;

                            $this->esp_model->insert_forecast_product_details($forecast_id, $bussiness_code, $product_id, $monthdata, $f_data, $final_forecast_value);

                            //ADD FORECAST PRODUCT DATA DETAIL TO FORECAST PRODUCT HISTORY TABLE

                            $history_status_data = 1;
                            $this->esp_model->insert_forecast_product_details_history($forecast_id, $bussiness_code, $pbg_id, $product_id, $monthdata, $f_data, $final_forecast_value, $history_status_data);

                        }
                    }

                    //INSERT ASSUMPTION DATA

                    if ($forecast != "") {
                        if ($assumption != "" && $probablity != "") {

                            $assumption_data = implode("~", $assumption);
                            $probablity_data = implode("~", $probablity);

                            //    $update_status = $this->esp_model->update_forecast_assumption_details($forecast_assumption_id, $assumption_data, $probablity_data);

                            $this->esp_model->insert_forecast_assumption_probablity_data($forecast_id, $assumption_data, $probablity_data, $monthdata);

                            $history_update_status = 1;

                            $this->esp_model->insert_forecast_assumption_data_history($forecast_id, $assumption_data, $probablity_data, $monthdata, $history_update_status);

                            $updated_pbg_data_array[] = $pbg_name;

                        }
                    }

                }

            }

          }
        }

        if(!empty($updated_pbg_data_array))
        {
            //  $final_array["success"] = true;
            $final_array["success"][] = @implode(",", $updated_pbg_data_array) . " Data uploaded successfully.";
            echo json_encode($final_array);
            die;
        }
        else
        {
            $error_array["error"][] = "Data is freezed by user please unfreezed for current year and than process further.";
            echo json_encode($error_array);
            die;
        }

    }



    public function generate_budget_xl_data($webservice_data = null)
    {

        if ($webservice_data == null) {
            $user = $this->auth->user();
            $user_country_id = $user->country_id;
            $bussiness_code = $user->bussiness_code;
        } else {
            $user = $webservice_data["user_id"];
            $user_country_id = $webservice_data["country_id"];
            $bussiness_code = $webservice_data["bussiness_code"];
        }

        $pbgdata = $this->esp_model->get_pbg_data($user_country_id);

        $final_array = array();

        $year = date("Y");

        $from_month = $year . "-01-01";
        $to_month = $year . "-12-01";

        $month_data = $this->get_monthly_data($from_month, $to_month);

        if (!empty($pbgdata)) {

            foreach ($pbgdata as $pbg_key => $pbg_data) {

                //GET PRODUCT SKU FOR EACH PBG

                $product_sku_country_id = $pbg_data['product_country_id'];
                $PBG_name = $pbg_data['product_country_name'];

                $pbg_sku_data = $this->esp_model->get_pbg_sku_data($product_sku_country_id);

                $forecast_id = 0;

                if (!empty($pbg_sku_data)) {

                    foreach ($pbg_sku_data as $sku_key => $sku_value) {
                        $sku_data_array = array();

                        $sku_data_array['product_sku_code'] = $sku_value["product_sku_code"];
                        $sku_data_array['PBG_name'] = $PBG_name;
                        $sku_data_array['product_sku_name'] = $sku_value["product_sku_name"];

                        $sku_data_array['product_sku_id'] = $sku_value["product_sku_country_id"];

                        foreach ($month_data as $month_key => $monthvalue) {

                            $employee_month_product_budget_data = $this->esp_model->get_employee_month_product_budget_data($bussiness_code, $sku_value['product_sku_country_id'], $monthvalue);

                            $budget_qty = 0;

                            if ($employee_month_product_budget_data != 0) {
                                $budget_qty = $employee_month_product_budget_data[0]['budget_quantity'];
                            }

                            $sku_data_array['budget_quantity'][$monthvalue] = $budget_qty;

                        }
                        $final_array[] = $sku_data_array;

                    }

                }

            }

            //   testdata($final_array);

        } else {

            //NO PBG DATA FOUND

            $final_array[] = "No Data Found";
        }

        if ($webservice_data == null) {
            $xl_data = $this->create_budget_data_xl($final_array, null);
            die;
        } else {
            $xl_data = $this->create_budget_data_xl($final_array, "webservice");

            return $xl_data;

        }
    }

    public function create_budget_data_xl($final_array, $webservice = null)
    {
        //testdata($final_array);

        $this->load->library('excel');
        $obj = new Excel();

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objWorkSheet = $obj->setActiveSheetIndex(0);

        if(!empty($final_array))
        {
            $objWorkSheet->setCellValue('A1','Product SKU Code');
            $objWorkSheet->setCellValue('B1','PBG');
            $objWorkSheet->setCellValue('C1','Product SKU Name');
            $objWorkSheet->setCellValue('D1','Jan (Kg/Ltr)');
            $objWorkSheet->setCellValue('E1','Feb (Kg/Ltr)');
            $objWorkSheet->setCellValue('F1','Mar (Kg/Ltr)');
            $objWorkSheet->setCellValue('G1','Apr (Kg/Ltr)');
            $objWorkSheet->setCellValue('H1','May (Kg/Ltr)');
            $objWorkSheet->setCellValue('I1','Jun (Kg/Ltr)');
            $objWorkSheet->setCellValue('J1','Jul (Kg/Ltr)');
            $objWorkSheet->setCellValue('K1','Aug (Kg/Ltr)');
            $objWorkSheet->setCellValue('L1','Sep (Kg/Ltr)');
            $objWorkSheet->setCellValue('M1','Oct (Kg/Ltr)');
            $objWorkSheet->setCellValue('N1','Nov (Kg/Ltr)');
            $objWorkSheet->setCellValue('O1','Dec (Kg/Ltr)');

            $objWorkSheet->getStyle('A1:O1')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '696969')
                    )
                )
            );

            $BStyle = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '808080'
                        )
                    )
                )
            );

            $objWorkSheet->getDefaultStyle()->getBorders()->applyFromArray($BStyle);
            $objWorkSheet->getProtection()->setSheet(true);
            $u = 2;

            foreach($final_array as $key_data => $final_data)
            {
                $pbg_name = $final_data["PBG_name"];

                $objWorkSheet->setCellValue("A$u", $final_data["product_sku_code"]);
                $objWorkSheet->setCellValue("B$u", $pbg_name);
                $objWorkSheet->setCellValue("C$u", $final_data["product_sku_name"]);

                $objWorkSheet->getStyle("A$u:C$u")->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => '696969')
                        )

                    )
                );

                $final_data["budget_quantity"] = array_values($final_data["budget_quantity"]);

                $budget_quantity_0 = isset($final_data["budget_quantity"][0]) ? $final_data["budget_quantity"][0]:0;
                $budget_quantity_1 = isset($final_data["budget_quantity"][1]) ? $final_data["budget_quantity"][1]:0;
                $budget_quantity_2 = isset($final_data["budget_quantity"][2]) ? $final_data["budget_quantity"][2]:0;
                $budget_quantity_3 = isset($final_data["budget_quantity"][3]) ? $final_data["budget_quantity"][3]:0;
                $budget_quantity_4 = isset($final_data["budget_quantity"][4]) ? $final_data["budget_quantity"][4]:0;
                $budget_quantity_5 = isset($final_data["budget_quantity"][5]) ? $final_data["budget_quantity"][5]:0;
                $budget_quantity_6 = isset($final_data["budget_quantity"][6]) ? $final_data["budget_quantity"][6]:0;
                $budget_quantity_7 = isset($final_data["budget_quantity"][7]) ? $final_data["budget_quantity"][7]:0;
                $budget_quantity_8 = isset($final_data["budget_quantity"][8]) ? $final_data["budget_quantity"][8]:0;
                $budget_quantity_9 = isset($final_data["budget_quantity"][9]) ? $final_data["budget_quantity"][9]:0;
                $budget_quantity_10 = isset($final_data["budget_quantity"][10])? $final_data["budget_quantity"][10]:0;
                $budget_quantity_11 = isset($final_data["budget_quantity"][11])? $final_data["budget_quantity"][11]:0;

                $objWorkSheet->setCellValue("D$u", $budget_quantity_0);
                $objWorkSheet->setCellValue("E$u", $budget_quantity_1);
                $objWorkSheet->setCellValue("F$u", $budget_quantity_2);
                $objWorkSheet->setCellValue("G$u", $budget_quantity_3);
                $objWorkSheet->setCellValue("H$u", $budget_quantity_4);
                $objWorkSheet->setCellValue("I$u", $budget_quantity_5);
                $objWorkSheet->setCellValue("J$u", $budget_quantity_6);
                $objWorkSheet->setCellValue("K$u", $budget_quantity_7);
                $objWorkSheet->setCellValue("L$u", $budget_quantity_8);
                $objWorkSheet->setCellValue("M$u", $budget_quantity_9);
                $objWorkSheet->setCellValue("N$u", $budget_quantity_10);
                $objWorkSheet->setCellValue("O$u", $budget_quantity_11);

                $objWorkSheet->getStyle("D$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objWorkSheet->getStyle("E$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objWorkSheet->getStyle("F$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objWorkSheet->getStyle("G$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objWorkSheet->getStyle("H$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objWorkSheet->getStyle("I$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objWorkSheet->getStyle("J$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objWorkSheet->getStyle("K$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objWorkSheet->getStyle("L$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objWorkSheet->getStyle("M$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objWorkSheet->getStyle("N$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objWorkSheet->getStyle("O$u")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

                $u++;
            }
        }

        $obj->getActiveSheet()->setTitle('budget');

// Redirect output to a client�s web browser (Excel5)
        $filename='Data_'.strtotime(date('d-m-y h:i:s')).'.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        if($webservice == "webservice")
        {
            if (file_exists(FCPATH . "assets/uploads/Uploads/esp_budget/" . $filename)) {
                unlink(FCPATH . "assets/uploads/Uploads/esp_budget/" . $filename);
            }
            $objWriter->save(FCPATH . "assets/uploads/Uploads/esp_budget/" . $filename);

            $result['status'] = true;
            $result['message'] = 'Retrieved Successfully.';
            $result['data'] = base_url()."assets/uploads/Uploads/esp_budget/".$filename;
            echo json_encode($result);
            die;
        }
        else
        {
            $objWriter->save('php://output');
            exit();
        }
    }


    public function upload_budget_data($webservice_data = null)
    {

        if ($webservice_data == null) {

            $user = $this->auth->user();
            $user_id = $user->id;
            $user_country_id = $user->country_id;
            $bussiness_code = $user->bussiness_code;
            $files = $_POST["upload_file_data"];

        } else {
            $user_id = $_POST["user_id"];
            $files = $_FILES["upload_file_data"];
            $user_country_id = $_POST["country_id"];
            $bussiness_code = $_POST["bussiness_code"];
        }

       //   testdata($_POST);

        if (!empty($files)) {

          //  $file = $_POST["upload_file_data"]["tmp_name"];

            $file = $_FILES["upload_file_data"]["tmp_name"];

           // $filename = explode("_", $_POST["upload_file_data"]["name"]);
            $filename = explode("_", $_FILES["upload_file_data"]["name"]);

            //$filename[] = $_POST["upload_file_data"]["name"];

            //$ext = explode(".", $_POST["upload_file_data"]["name"]);
            $ext = explode(".", $_FILES["upload_file_data"]["name"]);


            if ($ext[1] == "xls" || $ext[1] == "xlsx") {

                //load the excel library
                $this->load->library('excel');

                //read file from path
                $objPHPExcel = PHPExcel_IOFactory::load($file);

                $sheetCount = $objPHPExcel->getSheetCount();
                $sheetNames = $objPHPExcel->getSheetNames();

                if ($sheetCount == 1) {

                 //   if ($sheetNames[0] == "budget") {

                        //get only the Cell Collection
                        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();


                        $arr_data = array();
                        //extract to a PHP readable array format

                        $i = 1;

                        $final_array = array();

                        foreach ($cell_collection as $cell) {

                            $inner_array = array();

                            //if($i != 1){
                            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

                            if ($row == 1) {

                                $header[$row][$column] = $data_value;

                            }

                            if ($row != 1) {
                                if ($column == "A" || $column == "B" || $column == "C") {
                                    $arr_data[$row][$column] = $data_value;
                                } else {
                                    $arr_data[$row]["monthdata"][$column] = $data_value;
                                }
                            }

                            if ($row == 10) {
                               // break;
                                //die;
                            }
                            $i++;

                        }

                        $data['values'] = $arr_data;
                        $data['header'] = $header[1];

                        // echo "<pre>";
                        //  print_r($data);

                        if (!empty($data['header'])) {

                            //  testdata($data['header']);

                            if (count($data['header']) != 15 || $data['header']["A"] != "Product SKU Code" || $data['header']["B"] != "PBG" || $data['header']["C"] != "Product SKU Name" || $data['header']["D"] != "Jan (Kg/Ltr)" || $data['header']["E"] != "Feb (Kg/Ltr)" || $data['header']["F"] != "Mar (Kg/Ltr)" || $data['header']["G"] != "Apr (Kg/Ltr)" || $data['header']["H"] != "May (Kg/Ltr)" || $data['header']["I"] != "Jun (Kg/Ltr)" || $data['header']["J"] != "Jul (Kg/Ltr)" || $data['header']["K"] != "Aug (Kg/Ltr)" || $data['header']["L"] != "Sep (Kg/Ltr)" || $data['header']["M"] != "Oct (Kg/Ltr)" || $data['header']["N"] != "Nov (Kg/Ltr)" || $data['header']["O"] != "Dec (Kg/Ltr)") {

                                $error_array["fileerror"][] = "Upload file is not proper. Please download proper format file.";
                                echo json_encode($error_array);

                                    die;


                            }

                        }

                        $final_array = array();

                        foreach ($data['values'] as $key => $budget_data) {

                            $inner_array = array();

                            $sku_code = isset($budget_data["A"]) ? $budget_data["A"] : "";
                            $pbg = isset($budget_data["B"]) ? $budget_data["B"] : "";
                            $product_sku_name = isset($budget_data["C"]) ? $budget_data["C"] : "";

                            if ($sku_code != "") {
                                $sku_id = $this->esp_model->get_sku_data($sku_code);
                            } else {
                                $sku_id = "";
                            }


                            if ($pbg != "") {
                                $pbg_id = $this->esp_model->get_pbg_detail_data($pbg, $user_country_id);
                            } else {
                                $pbg_id = "";
                            }

                            if (($sku_id != "" || $sku_id != 0) && ($pbg_id != "" || $pbg_id != 0)) {

                                $inner_array["user_id"] = $user_id;
                                $inner_array["pbg_id"] = $pbg_id;
                                $inner_array["sku_name"] = $product_sku_name;
                                $inner_array["sku_id"] = $sku_id;
                                $inner_array["user_country_id"] = $user_country_id;
                                $inner_array["bussiness_code"] = $bussiness_code;
                                $inner_array["monthdata"] = $budget_data["monthdata"];

                                $final_array["budget_data"][] = $inner_array;


                                //    $upload_data = $this->upload_xl_budget_data($user_id, $pbg_id, $sku_id, $user_country_id, $bussiness_code, $budget_data["monthdata"]);

                            }

                        }

                        if(!empty($final_array))
                        {
                            if ($webservice_data == null)
                            {
                                echo json_encode($final_array);
                                die;
                            }
                            else{

                                $filename = explode(".",$_FILES["upload_file_data"]["name"]);

                                $filename1 = $user_id."_".$filename[0].".txt";

                                if(file_exists(FCPATH . "assets/uploads/Uploads/esp_budget/" . $filename1))
                                {
                                    unlink(FCPATH . "assets/uploads/Uploads/esp_budget/" . $filename1);
                                }

                                $myfile = fopen(FCPATH . "assets/uploads/Uploads/esp_budget/" . $filename1, "w");

                                $f_data = json_encode($final_array);
                                fwrite($myfile, $f_data);

                                //$file = FCPATH . "assets/uploads/Uploads/esp_budget/esp_budget.txt";

                                //$file_content = file_get_contents($file);

                                $final_array1["status"][] = true;
                                $final_array1["data"][] = FCPATH . "assets/uploads/Uploads/esp_budget/" . $filename1;
                                return json_encode($final_array1);
                            }


                        }
                        else
                        {
                            $error_array["fileerror"][] = "No data found.";
                            echo json_encode($error_array);


                                die;

                        }

                  /*  } else {
                        //SHEET NAME ERROR

                        $error_array["fileerror"][] = "Please upload desired file.";
                        echo json_encode($error_array);
                        die;

                    }
                    */

                } else {
                    //SHEEET COUNT ERROR

                    $error_array["fileerror"][] = "File must contain single sheet only.";
                    echo json_encode($error_array);


                        die;


                }
            } else {
                //EXTENSION ERROR

                $error_array["fileerror"][] = "Incorrect format. Please upload xlsx or xls format file.";
                echo json_encode($error_array);


                    die;


            }

        } else {
            $error_array["fileerror"][] = "No file uploaded.";
            echo json_encode($error_array);


                die;


        }

    }

    public function upload_xl_budget_data($webservice_data = null)
    {

        if ($webservice_data != null) {
            $_POST["val"] = json_decode($webservice_data["val"], true);
        }

        //testdata($_POST["val"]);

        //$user_id,$pbg_id,$sku_id,$user_country_id,$bussiness_code,$budget_data

        $updated_pbg_data_array = array();

        foreach ($_POST["val"] as $key_data => $budgetdata) {

            $user_id = $budgetdata["user_id"];
            $pbg_id = $budgetdata["pbg_id"];
            $sku_name = $budgetdata["sku_name"];
            $sku_id = $budgetdata["sku_id"];
            $user_country_id = $budgetdata["user_country_id"];
            $bussiness_code = $budgetdata["bussiness_code"];
            $budget_data = $budgetdata["monthdata"];


            $budget_data = array_values($budget_data);

            //dumpme($budget_data);

            $year = date("Y");

            $from_month = $year . "-01-01";
            $to_month = $year . "-12-01";

            $month_data = $this->get_monthly_data($from_month, $to_month);
            $i = 0;

            $budget_insert_id = "";
            $old_budget_id = "";


            $freeze_data_array = array();

         //   foreach ($month_data as $month_key => $monthvalue) {
                $check_record_exist1 = $this->esp_model->check_budget_data($pbg_id, $bussiness_code);
                if ($check_record_exist1 != 0) {
                    $check_budget_id = $check_record_exist1[0]['budget_id'];

                    $budget_freeze_data = $this->esp_model->get_budget_freeze_status($check_budget_id, $user_id);

                    if($budget_freeze_data != 0) {
                        if ($budget_freeze_data["freeze_status"] == 1) {
                            $freeze_data_array[] = 1;
                        }
                    }
                }
        //    }

            if(!in_array(1,$freeze_data_array)){

                    foreach ($month_data as $month_key => $monthvalue) {

                        $check_record_exist = $this->esp_model->check_budget_data($pbg_id, $bussiness_code);

                        //dumpme($check_record_exist);

                        if ($check_record_exist != 0) {
                            $budget_insert_id = $check_record_exist[0]['budget_id'];
                            //UPDATE MAIN TABLE RECORD
                            $update_status = $this->esp_model->update_budget_data($old_budget_id, $user_id);
                        } else {
                            //INSERT
                            // if($budget_insert_id == ""){
                            $budget_insert_id = $this->esp_model->insert_budget_data($pbg_id, $user_id, $bussiness_code, $user_id);
                            // }
                        }

                        // echo $budget_insert_id."===".$old_budget_id."</br>";

                        if ($budget_data[$i] == "" || empty($budget_data[$i])) {
                            $budget_qty = 0;
                        } else {
                            $budget_qty = $budget_data[$i];
                        }
                        $budget_value = $this->esp_model->get_budget_data($sku_id, $monthvalue);

                        //    $budget_value = $budget_value*$budget_qty;

                        $get_product_old_data = $this->esp_model->get_budget_product_details($bussiness_code, $sku_id, $monthvalue);

                        if ($get_product_old_data != 0) {
                            //UPDATE MAIN TABLE RECORD

                            $budget_product_id = $get_product_old_data[0]['budget_product_id'];
                            $old_budget_id = $get_product_old_data[0]['budget_id'];

                            $update_status = $this->esp_model->update_budget_product_details($budget_product_id, $budget_qty, $budget_value);

                        } else {
                            $this->esp_model->insert_budget_product_details($budget_insert_id, $bussiness_code, $sku_id, $monthvalue, $budget_qty, $budget_value);
                        }


                        $i++;
                    }

                   // $final_array["success"] = true;
                   // $final_array["message"] = "Data uploaded successfully.";
                   // echo json_encode($final_array);
                   // die;

                $updated_pbg_data_array[] = $sku_name;


                }
                //else
                //{
                //    $error_array["error"][] = "Data is freezed by user please unfreezed for current year and than process further.";
                //    echo json_encode($error_array);
                //    die;
                //}

        }

        if(!empty($updated_pbg_data_array)) {
          //  $final_array["success"] = true;
            $final_array["success"][] = @implode(",", $updated_pbg_data_array) . " Data uploaded successfully.";
            echo json_encode($final_array);
            die;
        }
        else{
                $error_array["error"][] = "Data is freezed by user please unfreezed for current year and than process further.";
                echo json_encode($error_array);
                die;
        }

    }


    public function forecast_freeze_check_lock($webservice_data)
    {


    }

}