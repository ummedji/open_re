<?php defined('BASEPATH') || exit('No direct script access allowed');
class Ecp extends Front_Controller
{
	protected $permissionCreate = 'Ecp.Ecp.Create';
	protected $permissionDelete = 'Ecp.Ecp.Delete';
	protected $permissionEdit = 'Ecp.Ecp.Edit';
	protected $permissionView = 'Ecp.Ecp.View';

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
		$this->lang->load('ecp');
		$this->load->helper('calendar');

		$this->load->model('ecp_model');
		$this->load->model('ishop/ishop_model');
		$this->load->model('esp/esp_model');

		$this->set_current_user();
		//Assets::add_module_js('ecp', 'ecp.js');
	}

	/**
	 * Display a list of ECP data.
	 *
	 * @return void
	 */
	public function index()
	{
		Template::set_view('ecp/index');
		Template::render();
	}
	public function material_request()
	{
		Assets::add_module_js('ecp', 'materials_request.js');

		$user = $this->auth->user();
		$materials = $this->ecp_model->get_materials_by_country_id($user->country_id);

		$pag = (isset($_POST['page']) ? $_POST['page'] : '');
		if($pag > 0)
		{
			$page = $pag;
		}
		else{
			$page = 1;
		}
		//$materials_request = array();
		$materials_request =  $this->ecp_model->get_all_materials_by_country_id($user->country_id,$page,$user->local_date);
		Template::set('td', $materials_request['count']);
		Template::set('pagination', (isset($materials_request['pagination']) && !empty($materials_request['pagination'])) ? $materials_request['pagination'] : '' );
		Template::set('table', $materials_request);

		Template::set('materials', $materials);
		Template::set('current_user', $user);
		Template::set_view('ecp/material_request');
		Template::render();
	}

	public function add_material_request_details()
	{
		$user = $this->auth->user();
		$add = $this->ecp_model->add_material_request_detail($user->id,$user->country_id);
		echo $add;
		die;
	}

	public function update_material_request_details()
	{
		$user = $this->auth->user();
		$status = $_POST['received_status'];
		$mr_id = $_POST['mr_id'];
		$update = $this->ecp_model->update_material_request_detail($user->id,$mr_id,$status);
		echo $update;
		die;
	}

	public function all_material_request()
	{
		Assets::add_module_js('ecp', 'all_material_requests.js');

		$user = $this->auth->user();

		$designation =  $this->ecp_model->get_all_designation_by_country($user->country_id);
	//	$employee =  $this->ecp_model->get_all_employee_by_country_id($user->country_id);
		Template::set('designation', $designation);
		Template::set('current_user', $user);
		Template::set_view('ecp/all_material_requests');
		Template::render();
	}

	public function get_employees_by_role_id()
	{
		$role_id=$_POST['role_id'];
		//testdata($role_id);
		$user = $this->auth->user();
		$employee =  $this->ecp_model->get_employee_by_role_id($role_id,$user->country_id);
		echo json_encode($employee);
		die;

	}
	public function all_materials_details_view()
	{
		$user = $this->auth->user();

		$from_date = (isset($_POST['from_date']) ? $_POST['from_date'] : '');
		$to_date = (isset($_POST['to_date']) ? $_POST['to_date'] : '');
		$status_id = (isset($_POST['status_id']) ? $_POST['status_id'] : '');
		$employee_id = (isset($_POST['employee_id']) ? $_POST['employee_id'] : '');

		$pag = (isset($_POST['page']) ? $_POST['page'] : '');
		if($pag > 0)
		{
			$page = $pag;
		}
		else{
			$page = 1;
		}

		$materials_request_details = $this->ecp_model->get_all_materials_request_details_view($from_date, $to_date, $status_id, $employee_id,$page,$user->local_date,$user->country_id);

		Template::set('td', $materials_request_details['count']);
		Template::set('pagination', (isset($materials_request_details['pagination']) && !empty($materials_request_details['pagination'])) ? $materials_request_details['pagination'] : '' );
		Template::set('table', $materials_request_details);
		Template::set_view('ecp/all_material_requests');
		Template::render();
	}

	public function update_materials_details()
	{
		$user = $this->auth->user();
		$update = $this->ecp_model->update_materials_detail($user->id);
		echo $update;
		die;
	}

	public function delete_material_details()
	{
		$mr_id = (isset($_POST['mr_id']) ? $_POST['mr_id'] : '');
		$delete = $this->ecp_model->delete_material_detail($mr_id);
		echo $delete;
		die;
	}


	public function retailer_compititor_analysis()
	{
		Assets::add_module_js('ecp', 'retailer_compititor.js');

		$user = $this->auth->user();
		$radio_checked='10';

		$geo_level = $this->ecp_model->get_employee_geo_data($user->id, $user->country_id, $user->role_id, $parent_geo_id = null, $action_data = null,$radio_checked);

		$compititor = $this->ecp_model->get_all_copititor_data($user->country_id);

		Template::set('compititor', $compititor);
		Template::set('current_user', $user);
		Template::set('geo_level', $geo_level);
		Template::set_view('ecp/retailer_compititor');
		Template::render();
	}

	public function retailer_compititor_details()
	{
		$user = $this->auth->user();
		$insert=$this->ecp_model->add_retailer_compititor_details($user->id,$user->country_id);
		echo $insert;
		die;
	}

	public function retailer_compititor_product()
	{
		Assets::add_module_js('ecp', 'retailer_compititor_product.js');

		$user = $this->auth->user();
		$radio_checked='10';

		$geo_level = $this->ecp_model->get_employee_geo_data($user->id, $user->country_id, $user->role_id, $parent_geo_id = null, $action_data = null,$radio_checked);

		$compititor = $this->ecp_model->get_all_copititor_data($user->country_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);

		Template::set('product_sku', $product_sku);
		Template::set('compititor', $compititor);
		Template::set('current_user', $user);
		Template::set('geo_level', $geo_level);
		Template::set_view('ecp/retailer_compititor_product');
		Template::render();
	}

	public function retailer_compititor_product_details()
	{
		$user = $this->auth->user();
		$insert=$this->ecp_model->add_retailer_compititor_product_details($user->id,$user->country_id);
		echo $insert;
		die;
	}

	public function retailer_compititor_view()
	{
		Assets::add_module_js('ecp', 'retailer_compititor_view.js');
		Template::set_view('ecp/retailer_compititor_view');
		Template::render();
	}

	public function retailer_compititor_details_view()
	{
		//testdata($_POST);
		$user = $this->auth->user();

		$radio = (isset($_POST['radio']) ? $_POST['radio'] : '');
		$from_month = (isset($_POST['from_month']) ? $_POST['from_month'] : '');
		$to_month = (isset($_POST['to_month']) ? $_POST['to_month'] : '');

		$pag = (isset($_POST['page']) ? $_POST['page'] : '');
		if($pag > 0)
		{
			$page = $pag;
		}
		else{
			$page = 1;
		}

		if($radio == 'total'){
			$retailer_compititor_details = $this->ecp_model->get_retailer_compititor_details_view($from_month, $to_month,$page,$user->local_date,$user->country_id);
		}
		elseif($radio == 'product'){
			$retailer_compititor_details = $this->ecp_model->get_retailer_compititor_product_details_view($from_month, $to_month,$page,$user->local_date,$user->country_id);
		}


		Template::set('td', $retailer_compititor_details['count']);
		Template::set('pagination', (isset($retailer_compititor_details['pagination']) && !empty($retailer_compititor_details['pagination'])) ? $retailer_compititor_details['pagination'] : '' );
		Template::set('table', $retailer_compititor_details);
		Template::set_view('ecp/retailer_compititor_view');
		Template::render();

	}


	public function distributor_compititor_analysis()
	{
		Assets::add_module_js('ecp', 'distributor_compititor.js');

		$user = $this->auth->user();
		$radio_checked='9';

		$geo_level = $this->ecp_model->get_employee_geo_data($user->id, $user->country_id, $user->role_id, $parent_geo_id = null, $action_data = null,$radio_checked);

		$compititor = $this->ecp_model->get_all_copititor_data($user->country_id);

		Template::set('compititor', $compititor);
		Template::set('current_user', $user);
		Template::set('geo_level', $geo_level);
		Template::set_view('ecp/distributor_compititor');
		Template::render();
	}

	public function distributor_compititor_details()
	{
		$user = $this->auth->user();
		$insert=$this->ecp_model->add_distributor_compititor_details($user->id,$user->country_id);
		echo $insert;
		die;
	}

	public function distributor_compititor_product()
	{
		Assets::add_module_js('ecp', 'distributor_compititor_product.js');

		$user = $this->auth->user();
		$radio_checked='9';

		$geo_level = $this->ecp_model->get_employee_geo_data($user->id, $user->country_id, $user->role_id, $parent_geo_id = null, $action_data = null,$radio_checked);

		$compititor = $this->ecp_model->get_all_copititor_data($user->country_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);

		Template::set('product_sku', $product_sku);
		Template::set('compititor', $compititor);
		Template::set('current_user', $user);
		Template::set('geo_level', $geo_level);
		Template::set_view('ecp/distributor_compititor_product');
		Template::render();
	}

	public function distributor_compititor_product_details()
	{
		$user = $this->auth->user();
		$insert=$this->ecp_model->add_distributor_compititor_product_details($user->id,$user->country_id);
		echo $insert;
		die;
	}

	public function distributor_compititor_view()
	{
		Assets::add_module_js('ecp', 'distributor_compititor_view.js');

		Template::set_view('ecp/distributor_compititor_view');
		Template::render();
	}

	public function distributor_compititor_details_view()
	{
		$user = $this->auth->user();

		$radio = (isset($_POST['radio']) ? $_POST['radio'] : '');
		$from_month = (isset($_POST['from_month']) ? $_POST['from_month'] : '');
		$to_month = (isset($_POST['to_month']) ? $_POST['to_month'] : '');

		$pag = (isset($_POST['page']) ? $_POST['page'] : '');
		if($pag > 0)
		{
			$page = $pag;
		}
		else{
			$page = 1;
		}
		if($radio == 'total'){
			$distributor_compititor_details = $this->ecp_model->get_distributor_compititor_details_view($from_month, $to_month,$page,$user->local_date,$user->country_id);
		}
		elseif($radio == 'product'){
			$distributor_compititor_details = $this->ecp_model->get_distributor_compititor_product_details_view($from_month, $to_month,$page,$user->local_date,$user->country_id);
		}


		Template::set('td', $distributor_compititor_details['count']);
		Template::set('pagination', (isset($distributor_compititor_details['pagination']) && !empty($distributor_compititor_details['pagination'])) ? $distributor_compititor_details['pagination'] : '' );
		Template::set('table', $distributor_compititor_details);
		Template::set_view('ecp/retailer_compititor_view');
		Template::render();
	}


	public function update_compititor_details()
	{
		$user = $this->auth->user();
		$radio = (isset($_POST['radio_checked']) ? $_POST['radio_checked'] : '');
		if($radio == 'total'){
			echo $update=$this->ecp_model->update_compititor_details();
		}
		elseif($radio == 'product'){
			echo $update=$this->ecp_model->update_compititor_product_details();
		}

		die;
	}

	public function delete_compititor_details()
	{
		//$user = $this->auth->user();
		$radio = (isset($_POST['radio_checked']) ? $_POST['radio_checked'] : '');
		$id = $this->input->post("id");
		if($radio == 'total'){
			echo $update=$this->ecp_model->delete_compititor_details($id);
		}
		elseif($radio == 'product'){

			echo $update=$this->ecp_model->delete_compititor_product_details($id);
		}
		die;
	}

	public function no_working()
	{
		Assets::add_module_js('ecp', 'no_working.js');

		$user = $this->auth->user();
		$reason=$this->ecp_model->all_reason_noworking_details($user->country_id);
		$cur_month=date('n');
		$cal_data = $this->getNoWorkingDetailByMonth($cur_month);

		Template::set('reason', $reason);
		Template::set('cal_data', $cal_data);
		Template::set_view('ecp/no_working');
		Template::render();
	}

	public function getNoWorkingDetailByMonth($curr_month = '')
	{
		if($curr_month !='' && !empty($curr_month))
		{
			$cur_month = $curr_month;
		}
		else{
			@list($cur_month,$cur_year) = isset($_POST['cur_month']) ? @explode("-",$_POST['cur_month']) : '';

		}
		$user = $this->auth->user();
		$leave_detail = $this->ecp_model->all_no_working_details($user->id,$user->country_id,null,$cur_month);
		//testdata($leave_detail);
		$action ='no_working';

		$cal_data = $this->leave_sidebar_calender($leave_detail,$action);

		if($curr_month =='')
		{
			echo json_encode($leave_detail);
			die;
		}
		else{
			return $cal_data;
		}
	}


	public function set_leave()
	{
		Assets::add_module_js('ecp', 'leave.js');

		$user = $this->auth->user();
		$leave_type=$this->ecp_model->all_leave_type_details($user->country_id);
		$cur_month=date('n');
		$cal_data = $this->getLeaveDetailByMonth($cur_month);

		Template::set('leave_type', $leave_type);
		Template::set('cal_data', $cal_data);
		Template::set_view('ecp/leave');
		Template::render();
	}

	public function getLeaveDetailByMonth($curr_month = '')
	{
		if($curr_month !='' && !empty($curr_month))
		{
			$cur_month = $curr_month;
		}
		else{
			@list($cur_month,$cur_year) = isset($_POST['cur_month']) ? @explode("-",$_POST['cur_month']) : '';

		}
		$user = $this->auth->user();
		$leave_detail = $this->ecp_model->all_leave_details($user->id,$user->country_id,null,$cur_month);
		//testdata($leave_detail);
		$action ='set_leave';

		$cal_data = $this->leave_sidebar_calender($leave_detail,$action);

		if($curr_month =='')
		{
			echo json_encode($leave_detail);
			die;
		}
		else{
			return $cal_data;
		}
	}


	public function leave_sidebar_calender($leave_details=array(),$action=''){

		$user = $this->auth->user();

// Get current year, month and day
		list($iNowYear, $iNowMonth, $iNowDay) = explode('-', date('Y-m-d'));

// Get current year and month depending on possible GET parameters
		if (isset($_REQUEST['cur_month'])) {
			list($iMonth, $iYear) = explode('-', $_REQUEST['cur_month']);
			$iMonth = (int)$iMonth;
			$iYear = (int)$iYear;
		} else {
			list($iMonth, $iYear) = explode('-', date('n-Y'));
		}

// Get name and number of days of specified month
		$iTimestamp = mktime(0, 0, 0, $iMonth, $iNowDay, $iYear);
		list($sMonthName, $iDaysInMonth) = explode('-', date('F-t', $iTimestamp));

// Get previous year and month
		$iPrevYear = $iYear;
		$iPrevMonth = $iMonth - 1;
		if ($iPrevMonth <= 0) {
			$iPrevYear--;
			$iPrevMonth = 12; // set to December
		}

// Get next year and month
		$iNextYear = $iYear;
		$iNextMonth = $iMonth + 1;
		if ($iNextMonth > 12) {
			$iNextYear++;
			$iNextMonth = 1;
		}

// Get number of days of previous month
		$iPrevDaysInMonth = (int)date('t', mktime(0, 0, 0, $iPrevMonth, $iNowDay, $iPrevYear));

// Get numeric representation of the day of the week of the first day of specified (current) month
		$iFirstDayDow = (int)date('w', mktime(0, 0, 0, $iMonth, 1, $iYear));

// On what day the previous month begins
		$iPrevShowFrom = $iPrevDaysInMonth - $iFirstDayDow + 1;

// If previous month
		$bPreviousMonth = ($iFirstDayDow > 0);

// Initial day
		$iCurrentDay = ($bPreviousMonth) ? $iPrevShowFrom : 1;

		$bNextMonth = false;
		$sCalTblRows = '';

// Generate rows for the calendar
		for ($i = 0; $i < 6; $i++) { // 6-weeks range
			$sCalTblRows .= '<tr>';
			for ($j = 0; $j < 7; $j++) { // 7 days a week

				$sClass = '';
				if ($iNowYear == $iYear && $iNowMonth == $iMonth && $iNowDay == $iCurrentDay && !$bPreviousMonth && !$bNextMonth) {
					$sClass = 'today';
				} elseif (!$bPreviousMonth && !$bNextMonth) {


					if(($iCurrentDay > date("d") && $iMonth >= date("n")) || ($iMonth > date("n"))){
						$sClass = 'current';
					}
					else
					{
						$sClass = 'prev';
					}

				}
				$dYear = $iYear;
				$dMonth = $iMonth;
				if($bPreviousMonth==1){
					$dMonth--;
				} else if($bNextMonth==1){
					if($iMonth==12){
						$dMonth = 1;
						$dYear++;
					} else {
						$dMonth++;
					}
				}

				if(!empty($user->local_date)){
					$dates = strtotime($dYear.'-'.$dMonth.'-'.$iCurrentDay);
					$leave_date = date($user->local_date,$dates);

					if($dates < strtotime(date('Y-m-d')))
					{
						$style = "pointer-events: none;opacity: 0.7;";
					}
					else
					{
						$style = "";
					}

					$style1 = "";

					if(!empty($leave_details) && !empty($action))
					{
						if($action == 'no_working'){
							foreach($leave_details as $k => $ld)
							{
								if($dates == strtotime($ld['no_working_date']))
								{
									$style1 = "background-color: yellow;";
								}
							}
						}
						if($action == 'set_leave'){

							foreach($leave_details as $k => $ld)
							{
								if($dates == strtotime($ld['leave_date']))
								{
									$style1 = "background-color: yellow;";
								}
							}
						}

					}

				}
				else{
					$leave_date = strtotime($dYear.'-'.$dMonth.'-'.$iCurrentDay);

					if($leave_date < strtotime(date('Y-m-d')))
					{
						$style = "pointer-events: none;opacity: 0.7;";
					}
					else
					{
						$style = "";
					}
					$style1 = "";
					if(!empty($leave_details) && !empty($action))
					{
						if($action == 'no_working'){
							foreach($leave_details as $k => $ld)
							{
								if($leave_date == strtotime($ld['no_working_date']))
								{
									$style1 = "background-color: yellow;";
								}
							}
						}

						if($action == 'set_leave'){
							foreach($leave_details as $k => $ld)
							{
								if($leave_date == strtotime($ld['leave_date']))
								{
									$style1 = "background-color: yellow;";
								}
							}
						}
					}

				}

				$sCalTblRows .= '<td class="'.$sClass.'" style="'.$style.'" ><a class="leave_date" style="'.$style1.'" rel="'.$leave_date.'" href="javascript: void(0)">'.$iCurrentDay.'</a></td>';

				// Next day
				$iCurrentDay++;
				if ($bPreviousMonth && $iCurrentDay > $iPrevDaysInMonth) {
					$bPreviousMonth = false;
					$iCurrentDay = 1;
				}
				if (!$bPreviousMonth && !$bNextMonth && $iCurrentDay > $iDaysInMonth) {
					$bNextMonth = true;
					$iCurrentDay = 1;
				}
			}
			$sCalTblRows .= '</tr>';
		}

// Prepare replacement keys and generate the calendar
		$aKeys = array(
			'__prev_month__' => "{$iPrevMonth}-{$iPrevYear}",
			'__next_month__' => "{$iNextMonth}-{$iNextYear}",
			'__cal_caption__' => $sMonthName . ', ' . $iYear,
			'__cal_rows__' => $sCalTblRows,
		);
//$sCalendarItself = strtr(file_get_contents('calendar.html'), $aKeys);
		$sCalendarItself = '';

		$sCalendarItself .= '<div class="navigation">';

		$sCalendarItself .= '<a class="prev" href="javascript: void(0);" onclick="getCalenderData(\''.$aKeys["__prev_month__"].'\')"></a> ';

		$sCalendarItself .= '<div class="title" >'.$aKeys['__cal_caption__'].'</div>';

		$sCalendarItself .= '<a class="next" href="javascript: void(0);" onclick="getCalenderData(\''.$aKeys["__next_month__"].'\')"></a>';

		$sCalendarItself .= '</div><table>
    <tr>
        <th class="weekday">Sun</th>
        <th class="weekday">Mon</th>
        <th class="weekday">Tue</th>
        <th class="weekday">Wed</th>
        <th class="weekday">Thu</th>
        <th class="weekday">Fri</th>
        <th class="weekday">Sat</th>
    </tr>';

		$sCalendarItself .= $aKeys["__cal_rows__"];
		$sCalendarItself .= '</table>';

		if ($this->input->is_ajax_request()) {
			echo $sCalendarItself;
			die;
		}
		else{
			return $sCalendarItself;
		}
	}


	public function no_working_details()
	{
		$user = $this->auth->user();
		$insert=$this->ecp_model->add_no_working_details($user->id,$user->country_id);
		echo $insert;
		die;
	}


	public function check_no_working_type()
	{
		$user = $this->auth->user();

		$cur_date = (isset($_POST['cur_date']) ? $_POST['cur_date'] : '');

		$date = str_replace('/', '-', $cur_date);
		$leave_date = date('Y-m-d', strtotime($date));

		$no_working_type= $this->ecp_model->no_working_details($user->id,$user->country_id,$leave_date);
		echo json_encode($no_working_type);
		die;
	}


	public function delete_no_working_details()
	{
		$id = (isset($_POST["no_working_id"]) ? $_POST["no_working_id"] : '');
		$delete=$this->ecp_model->delete_no_working_detail($id);
		echo $delete;
		die;
	}

	public function leave_details()
	{
		$user = $this->auth->user();
		$insert=$this->ecp_model->add_leave_details($user->id,$user->country_id);
		echo $insert;
		die;
	}

	public function check_leave_type()
	{
		$user = $this->auth->user();

		$cur_date = (isset($_POST['cur_date']) ? $_POST['cur_date'] : '');

		$date = str_replace('/', '-', $cur_date);
		$leave_date = date('Y-m-d', strtotime($date));

		$leave_type= $this->ecp_model->leave_type_details($user->id,$user->country_id,$leave_date);
		echo json_encode($leave_type);
		die;
	}


	public function delete_leave_details()
	{
		$id = (isset($_POST["leave_id"]) ? $_POST["leave_id"] : '');
		$delete=$this->ecp_model->delete_leave_detail($id);
		echo $delete;
		die;
	}

	public function activity_planning()
	{
		Assets::add_module_js('ecp', 'activity_planning.js');
		$user = $this->auth->user();
		$activity_type = $this->ecp_model->activity_type_details($user->country_id);
		$crop_details = $this->ecp_model->crop_details_by_country_id($user->country_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);
		$diseases_details = $this->ecp_model->get_diseases_by_user_id($user->country_id);
		$key_farmer = $this->ecp_model->get_KeyFarmer_by_user_id($user->id,$user->country_id);
		$materials = $this->ecp_model->get_materials_by_country_id($user->country_id);
		$child_user_data = $this->esp_model->get_user_selected_level_data($user->id,null);
		$global_head_user = array();
		$global_jr_user = array();

		$sr_employee_visit = array();
		$jr_employee_visit = array();

		$sr_employee_visit = $this->ecp_model->get_employee_for_loginuser($user->id,$global_head_user);
		$jr_employee_visit = $this->ecp_model->get_jr_employee_for_loginuser($user->id,$global_jr_user);

		//dumpme($jr_employee_visit);

		$employee_visit = array_merge($sr_employee_visit,$jr_employee_visit) ;

		$cur_month=date('n');
		$cur_year=date('Y');
		$cal_data = $this->getActivityDetailByMonth($cur_month,$cur_year);
		$activity_data = $this->getActivityDetailPlanByMonth($cur_month,$cur_year);

		Template::set('child_user_data', $child_user_data);
		Template::set('activity_data', $activity_data);
		Template::set('current_user', $user);
		Template::set('activity_type', $activity_type);
		Template::set('crop_details', $crop_details);
		Template::set('product_sku', $product_sku);
		Template::set('diseases_details', $diseases_details);
		Template::set('key_farmer', $key_farmer);
		Template::set('materials', $materials);
		Template::set('employee_visit', $employee_visit);
		Template::set('cal_data', $cal_data);
		Template::set_view('ecp/activity_planning');
		Template::render();
	}

	public function getActivitySidebar()
	{
		@list($cur_month,$cur_year) = isset($_POST['cur_month']) ? @explode("-",$_POST['cur_month']) : '';

		$cal_data = $this->getActivityDetailByMonth($cur_month,$cur_year);
		$activity_data = $this->getActivityDetailPlanByMonth($cur_month,$cur_year);

		Template::set('cal_data', $cal_data);
		Template::set('activity_data', $activity_data);

		Template::set_view('ecp/activity_sidebar');
		echo Template::render();
	}

	public function KeyFarmer_by_user_id()
	{
		$user = $this->auth->user();
		$key_farmer = $this->ecp_model->get_KeyFarmer_by_user_id($user->id,$user->country_id);
		echo json_encode($key_farmer);
		die;
	}

	public function KeyRetailer_by_user_id()
	{
		$user = $this->auth->user();
		$key_retailer = $this->ecp_model->get_KeyRetailer_by_user_id($user->id,$user->country_id);
		echo json_encode($key_retailer);
		die;
	}


	public function activity_planning_view_edit()
	{
		$user = $this->auth->user();
		$id = (isset($_POST["id"]) ? $_POST["id"] : null);

		$activity  = $this->ecp_model->editViewActivityPlanning($id);
		//testdata($activity);
		$geo_level_2 = array();
		$geo_level_3 = array();
		$geo_level_4 = array();
		$digitalLibrary = array();

		if(!empty($activity))
		{
			if($activity['activity_type_code'] == 'RMP003' || $activity['activity_type_code'] == 'RVP004' )
			{
				$role_id = 10;
				$perent_id = $activity['geo_level_id_2'];
				$second_perent = 'second_perent';

				$geo_level_2 = $this->ecp_model->get_customer_type_geo_data($role_id,$user->country_id,$activity['employee_id'],null,null);

				$geo_level_3 = $this->ecp_model->get_customer_type_geo_data($role_id,$user->country_id,$activity['employee_id'],$perent_id,$second_perent);

			}
			else{
				$role_id = 11;
				$perent_id = $activity['geo_level_id_2'];
				$perent_id2 = $activity['geo_level_id_3'];
				$second_perent = 'second_perent';

				$geo_level_2 = $this->ecp_model->get_customer_type_geo_data($role_id,$user->country_id,$activity['employee_id'],null,null);

				$geo_level_3 = $this->ecp_model->get_customer_type_geo_data($role_id,$user->country_id,$activity['employee_id'],$perent_id,$second_perent);
				$geo_level_4 = $this->ecp_model->get_customer_type_geo_data($role_id,$user->country_id,$activity['employee_id'],$perent_id2,null);

			}
			//testdata($activity['activity_planning_id']);
			$digitalLibrary = $this->ecp_model->getDigitalLibraryDataByCountry($activity['activity_type_id'],$user->country_id);
			//testdata($digitalLibrary);


		}

		Assets::add_module_js('ecp', 'activity_planning.js');
		$user = $this->auth->user();
		$activity_type = $this->ecp_model->activity_type_details($user->country_id);

		$crop_details = $this->ecp_model->crop_details_by_country_id($user->country_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);
		$diseases_details = $this->ecp_model->get_diseases_by_user_id($user->country_id);
		$key_farmer = $this->ecp_model->get_KeyFarmer_by_user_id($user->id,$user->country_id);
		$key_retailer = $this->ecp_model->get_KeyRetailer_by_user_id($user->id,$user->country_id);
		$materials = $this->ecp_model->get_materials_by_country_id($user->country_id);
		$child_user_data = $this->esp_model->get_user_selected_level_data($user->id,null);
		$global_head_user = array();
		$global_jr_user = array();

		$sr_employee_visit = array();
		$jr_employee_visit = array();
		$sr_employee_visit = $this->ecp_model->get_employee_for_loginuser($user->id,$global_head_user);
		$jr_employee_visit = $this->ecp_model->get_jr_employee_for_loginuser($user->id,$global_jr_user);


		$employee_visit = array_merge($sr_employee_visit,$jr_employee_visit) ;

		Template::set('activity_planning', $activity);
		Template::set('child_user_data', $child_user_data);
		Template::set('current_user', $user);
		Template::set('geo_level_2', $geo_level_2);
		Template::set('geo_level_3', $geo_level_3);
		Template::set('geo_level_4', $geo_level_4);
		Template::set('digitalLibrary', $digitalLibrary);
		Template::set('activity_type', $activity_type);
		Template::set('crop_details', $crop_details);
		Template::set('product_sku', $product_sku);
		Template::set('diseases_details', $diseases_details);
		Template::set('key_retailer', $key_retailer);
		Template::set('key_farmer', $key_farmer);
		Template::set('materials', $materials);
		Template::set('employee_visit', $employee_visit);
		Template::set_view('ecp/activity_planning');
		Template::render();
	}



	public function getActivityDetailByMonth($curr_month = '', $curr_year = '')
	{
		if(($curr_month !='' && !empty($curr_month)) &&  ($curr_year != '' && !empty($curr_year)) )
		{
			$cur_month = $curr_month;
			$cur_year = $curr_year;
		}
		else{
			@list($cur_month,$cur_year) = isset($_POST['cur_month']) ? @explode("-",$_POST['cur_month']) : '';

		}
		$user = $this->auth->user();

		$activity_detail = $this->ecp_model->all_activity_planning_details($user->id,$user->country_id,null,$cur_month,$cur_year);

		$action ='activity_planning';

		$cal_data = $this->activity_planning_sidebar_calender($activity_detail,$action);

		if($curr_month =='')
		{
			echo json_encode($activity_detail);
			die;
		}
		else{
			return $cal_data;
		}
	}


	public function getActivityDetailPlanByMonth($curr_month = '' , $curr_year = '')
	{
		if($curr_month !='' && !empty($curr_month) && ($curr_year != '' && !empty($curr_year)))
		{
			$cur_month = $curr_month;
			$cur_year = $curr_year;
		}
		else{
			@list($cur_month,$cur_year) = isset($_POST['cur_month']) ? @explode("-",$_POST['cur_month']) : '';

		}
		$user = $this->auth->user();

		$activity_detail = $this->ecp_model->all_activity_planning($user->id,$user->country_id,null,$cur_month,$cur_year);

	//	testdata($activity_detail);
		$action ='activity_planning';

		//$cal_data = $this->activity_planning_sidebar_calender($activity_detail,$action);

		if($curr_month =='')
		{
			echo json_encode($activity_detail);
			die;
		}
		else{
			//return $cal_data;
			return $activity_detail;
		}
	}



	public function activity_planning_sidebar_calender($activity_details=array(),$action=''){

		// make it dynamically
		$act_status = array('i','p','a','r','e','c');

		$activity_by_date = array();
		if(count($activity_details)  > 0){
			foreach($activity_details as $act)
			{
				$act_date = $act['activity_planning_date'];
				if(!isset($activity_by_date[$act_date]))
				{
					$activity_by_date[$act_date] = array();
				}


				if(!in_array($act_status[$act['status']],$activity_by_date[$act_date]))
				{
					$activity_by_date[$act_date][]= "act_".$act_status[$act['status']];
				}
			}
		}



		$user = $this->auth->user();

// Get current year, month and day
		list($iNowYear, $iNowMonth, $iNowDay) = explode('-', date('Y-m-d'));

// Get current year and month depending on possible GET parameters
		if (isset($_REQUEST['cur_month'])) {
			list($iMonth, $iYear) = explode('-', $_REQUEST['cur_month']);
			$iMonth = (int)$iMonth;
			$iYear = (int)$iYear;
		} else {
			list($iMonth, $iYear) = explode('-', date('n-Y'));
		}

// Get name and number of days of specified month
		$iTimestamp = mktime(0, 0, 0, $iMonth, $iNowDay, $iYear);
		list($sMonthName, $iDaysInMonth) = explode('-', date('F-t', $iTimestamp));

// Get previous year and month
		$iPrevYear = $iYear;
		$iPrevMonth = $iMonth - 1;
		if ($iPrevMonth <= 0) {
			$iPrevYear--;
			$iPrevMonth = 12; // set to December
		}

// Get next year and month
		$iNextYear = $iYear;
		$iNextMonth = $iMonth + 1;
		if ($iNextMonth > 12) {
			$iNextYear++;
			$iNextMonth = 1;
		}

// Get number of days of previous month
		$iPrevDaysInMonth = (int)date('t', mktime(0, 0, 0, $iPrevMonth, $iNowDay, $iPrevYear));

// Get numeric representation of the day of the week of the first day of specified (current) month
		$iFirstDayDow = (int)date('w', mktime(0, 0, 0, $iMonth, 1, $iYear));

// On what day the previous month begins
		$iPrevShowFrom = $iPrevDaysInMonth - $iFirstDayDow + 1;

// If previous month
		$bPreviousMonth = ($iFirstDayDow > 0);

// Initial day
		$iCurrentDay = ($bPreviousMonth) ? $iPrevShowFrom : 1;

		$bNextMonth = false;
		$sCalTblRows = '';

// Generate rows for the calendar
		for ($i = 0; $i < 6; $i++) { // 6-weeks range
			$sCalTblRows .= '<tr>';
			for ($j = 0; $j < 7; $j++) { // 7 days a week

				$clr = array('i','a','r','p');

				$sClass = '';
				if ($iNowYear == $iYear && $iNowMonth == $iMonth && $iNowDay == $iCurrentDay && !$bPreviousMonth && !$bNextMonth) {
					$sClass = 'today';
				} elseif (!$bPreviousMonth && !$bNextMonth) {


					if(($iCurrentDay > date("d") && $iMonth >= date("n")) || ($iMonth > date("n"))){
						$sClass = 'current';
					}
					else
					{
						$sClass = 'prev';
					}

				}
				$dYear = $iYear;
				$dMonth = $iMonth;
				if($bPreviousMonth==1){
					$dMonth--;
				} else if($bNextMonth==1){
					if($iMonth==12){
						$dMonth = 1;
						$dYear++;
					} else {
						$dMonth++;
					}
				}


				$activity_date = strtotime($dYear.'-'.$dMonth.'-'.$iCurrentDay);

				if($activity_date < strtotime(date('Y-m-d')))
				{
					$style = "pointer-events: none;opacity: 0.7;";
				}
				else
				{
					$style = "";
				}
				$act_class = "";
				if(!empty($activity_details) && !empty($action))
				{
					if($action == 'activity_planning')
					{
						if(count($activity_by_date)>0)
						{
							foreach($activity_by_date as $k => $ld)
							{
								if($activity_date == strtotime($k))
								{
									$act_class = " act_date ".@implode(" ",$ld);
								}
							}
						}

					}
				}

				$actClass = array_rand($clr,1);

				$sCalTblRows .= '<td class="'.$sClass.'" style="'.$style.'" ><a class="activity_date act_'.$clr[$actClass].$act_class.'"  href="javascript: void(0)">'.$iCurrentDay.'</a></td>';

				// Next day
				$iCurrentDay++;
				if ($bPreviousMonth && $iCurrentDay > $iPrevDaysInMonth) {
					$bPreviousMonth = false;
					$iCurrentDay = 1;
				}
				if (!$bPreviousMonth && !$bNextMonth && $iCurrentDay > $iDaysInMonth) {
					$bNextMonth = true;
					$iCurrentDay = 1;
				}
			}
			$sCalTblRows .= '</tr>';
		}

// Prepare replacement keys and generate the calendar
		$aKeys = array(
			'__prev_month__' => "{$iPrevMonth}-{$iPrevYear}",
			'__next_month__' => "{$iNextMonth}-{$iNextYear}",
			'__cal_caption__' => $sMonthName . ', ' . $iYear,
			'__cal_rows__' => $sCalTblRows,
		);
//$sCalendarItself = strtr(file_get_contents('calendar.html'), $aKeys);
		$sCalendarItself = '';

		$sCalendarItself .= '<div class="navigation">';
		$sCalendarItself .= '<a class="prev" href="javascript: void(0);" onclick="getActivityCalenderData(\''.$aKeys["__prev_month__"].'\');"></a> ';
		$sCalendarItself .= '<div class="title" >'.$aKeys['__cal_caption__'].'</div>';
		$sCalendarItself .= '<a class="next" href="javascript: void(0);" onclick="getActivityCalenderData(\''.$aKeys["__next_month__"].'\');"></a>';
		$sCalendarItself .= '</div><table>
    <tr>
        <th class="weekday">Sun</th>
        <th class="weekday">Mon</th>
        <th class="weekday">Tue</th>
        <th class="weekday">Wed</th>
        <th class="weekday">Thu</th>
        <th class="weekday">Fri</th>
        <th class="weekday">Sat</th>
    </tr>';

		$sCalendarItself .= $aKeys["__cal_rows__"];
		$sCalendarItself .= '</table>';

		if ($this->input->is_ajax_request()) {
//			echo $sCalendarItself;
//			die;
			return $sCalendarItself;
		}
		else{
			return $sCalendarItself;
		}
	}




	public function get_geo_activity()
	{
		$code = (isset($_POST["activity_type_selected"]) ? $_POST["activity_type_selected"] : '');
		$perent_id = (isset($_POST["perent_id"]) ? $_POST["perent_id"] : null);
		$second_perent = (isset($_POST["second_perent"]) ? $_POST["second_perent"] : null);
		$user = $this->auth->user();

		if($code =='RMP003' || $code =='RVP004' )
		{
			$role_id = 10;
		}
		else{
			$role_id = 11;
		}

		$get_geo_level_data = $this->ecp_model->get_customer_type_geo_data($role_id,$user->country_id,$user->id,$perent_id,$second_perent);
		echo json_encode($get_geo_level_data);
		die;

	}

	public function get_mobile_number_by_farmer()
	{
		$farmer_id=$_POST['farmer_id'];
		$mobile_no = $this->ecp_model->get_mobile_number_by_farmer_id($farmer_id);
		echo json_encode($mobile_no);
		die;
	}


	public function getDigitalLibraryData()
	{
		$activity_type_id = $_POST['activity_type_id'];
		$user = $this->auth->user();
		$mobile_no = $this->ecp_model->getDigitalLibraryDataByCountry($activity_type_id,$user->country_id);
		echo json_encode($mobile_no);
		die;
	}

	public function get_demonstration_data()
	{
		$user = $this->auth->user();
		$get_geo_level_data = $this->ecp_model->get_demonstration_data_by_id($user->country_id);
	}

	public function check_planning_date_in_leave()
	{
		$planning_date = $_POST['planning_date'];

		$user = $this->auth->user();
		$check_date = $this->ecp_model->check_planning_date_in_leaves($user->id,$user->country_id,$planning_date);
		echo $check_date;
		die;

	}

	public function add_activity_planning_details()
	{
		$user = $this->auth->user();
		$add= $this->ecp_model->addActivityPlanning($user->id,$user->country_id,$user->local_date);
		echo $add;
		die;
	}

	public function submit_activity_planning_details()
	{

		$user = $this->auth->user();
		$activity_planning_id = isset($_POST['activity_planning_id']) ? $_POST['activity_planning_id'] : '';
		$submit= $this->ecp_model->submitActivityPlanning($activity_planning_id,$user->id,$user->country_id);
		echo $submit;
		die;
	}

	public function activity_approval()
	{
		Assets::add_module_js('ecp', 'activity_approval.js');
		$user = $this->auth->user();
		$child_user_data = $this->esp_model->get_user_selected_level_data($user->id,null);
		$cur_month=date('Y-m');

		$cal_data = $this->getApprovalActivityByMonth($cur_month);
		/*testdata($cal_data);*/
		Template::set('td', $cal_data['count']);
		Template::set('pagination', (isset($cal_data['pagination']) && !empty($cal_data['pagination'])) ? $cal_data['pagination'] : '' );
		Template::set('table', $cal_data);
		Template::set('child_user_data', $child_user_data);
		Template::set('current_user', $user);
		Template::set_view('ecp/activity_approval');
		Template::render();
	}

	public function getApprovalActivityByMonth($curr_month = '')
		{
			$user = $this->auth->user();
			$child_user_data = $this->esp_model->get_user_selected_level_data($user->id,null);
			if(!empty($_POST['months'] )){
				$cur_month = $_POST['months'];
			}
			else{
				$cur_month = $curr_month;
			}

			$page = isset($_POST['page']) ?  $_POST['page'] : '';
			$cal_data = $this->ecp_model->getApprovalActivityDetailByMonth($cur_month,$child_user_data['level_users'],$user->id,$user->country_id,$user->local_date,$page);
			//testdata($cal_data);
			if(!empty($_POST['months']))
			{

				Template::set('td', $cal_data['count']);
				Template::set('pagination', (isset($cal_data['pagination']) && !empty($cal_data['pagination'])) ? $cal_data['pagination'] : '' );
				Template::set('table', $cal_data);
				Template::set('child_user_data', $child_user_data);
				Template::set('current_user', $user);
				Template::set_view('ecp/activity_approval');
				Template::render();

			}
			else{
				return 	$cal_data;
			}
		}

	public function change_status_activity()
	{
		$status_id = (isset($_POST["status_id"]) ? $_POST["status_id"] : '');
		$planning_id = (isset($_POST["planning_id"]) ? $_POST["planning_id"] : null);
		$user = $this->auth->user();
		$status = $this->ecp_model->changeActivityStatus($status_id,$planning_id,$user->id);
		echo $status;
		die;
	}

	public function activity_planning_edit_view()
	{
		$user = $this->auth->user();
		$id = (isset($_POST["id"]) ? $_POST["id"] : null);
		$activity = $this->ecp_model->editViewActivityPlanning($id);

		if($activity["geo_level_id_2"] != '')
		{
			$geo_level_2 = $this->ecp_model->get_geo_data($activity["geo_level_id_2"]);
		//	testdata($geo_level_2);
		}
		else{
			$geo_level_2 = '';
		}
		if($activity["geo_level_id_3"] != '')
		{
			$geo_level_3 = $this->ecp_model->get_geo_data($activity["geo_level_id_3"]);
		}
		else{
			$geo_level_3 = '';
		}

		if($activity["geo_level_id_4"] != '')
		{
			$geo_level_4 = $this->ecp_model->get_geo_data($activity["geo_level_id_4"]);
		}
		else{
			$geo_level_4 = '';
		}

		$activity_type = $this->ecp_model->activity_type_details($user->country_id);
		$crop_details = $this->ecp_model->crop_details_by_country_id($user->country_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);
		$diseases_details = $this->ecp_model->get_diseases_by_user_id($user->country_id);
		$key_farmer = $this->ecp_model->get_KeyFarmer_by_user_id($activity['employee_id'],$user->country_id);
		$key_retailer = $this->ecp_model->get_KeyRetailer_by_user_id($activity['employee_id'],$user->country_id);


		$materials = $this->ecp_model->get_materials_by_country_id($user->country_id);
		$global_head_user = array();
		$global_jr_user = array();

		/*$employee_visit = $this->ecp_model->get_employee_for_loginuser($user->id,$global_head_user);*/

		$sr_employee_visit = array();
		$jr_employee_visit = array();

		$sr_employee_visit = $this->ecp_model->get_employee_for_loginuser($user->id,$global_head_user);
		$jr_employee_visit = $this->ecp_model->get_jr_employee_for_loginuser($user->id,$global_jr_user);

		//dumpme($jr_employee_visit);

		$employee_visit = array_merge($sr_employee_visit,$jr_employee_visit) ;

		Template::set('geo_level_2', $geo_level_2);
		Template::set('geo_level_3', $geo_level_3);
		Template::set('geo_level_4', $geo_level_4);
		Template::set('activity', $activity);
		Template::set('current_user', $user);
		Template::set('activity_type', $activity_type);
		Template::set('crop_details', $crop_details);
		Template::set('product_sku', $product_sku);
		Template::set('diseases_details', $diseases_details);
		Template::set('key_farmer', $key_farmer);
		Template::set('key_retailer', $key_retailer);
		Template::set('materials', $materials);
		Template::set('employee_visit', $employee_visit);
		Template::set_view('ecp/activity_approval');
		Template::render();

	}

	public function activity_unplanned()
	{
		Assets::add_module_js('ecp', 'activity_unplanned.js');
		$user = $this->auth->user();
		$activity_type = $this->ecp_model->activity_type_details($user->country_id);
		$crop_details = $this->ecp_model->crop_details_by_country_id($user->country_id);
		$product_sku = $this->ishop_model->get_product_sku_by_user_id($user->country_id);
		$diseases_details = $this->ecp_model->get_diseases_by_user_id($user->country_id);
		$key_farmer = $this->ecp_model->get_KeyFarmer_by_user_id($user->id,$user->country_id);
		$materials = $this->ecp_model->get_materials_by_country_id($user->country_id);
		$child_user_data = $this->esp_model->get_user_selected_level_data($user->id,null);
		$global_head_user = array();
		$employee_visit = $this->ecp_model->get_employee_for_loginuser($user->id,$global_head_user);

		Template::set('child_user_data', $child_user_data);
		Template::set('current_user', $user);
		Template::set('activity_type', $activity_type);
		Template::set('crop_details', $crop_details);
		Template::set('product_sku', $product_sku);
		Template::set('diseases_details', $diseases_details);
		Template::set('key_farmer', $key_farmer);
		Template::set('materials', $materials);
		Template::set('employee_visit', $employee_visit);
		Template::set_view('ecp/activity_unplanned');
		Template::render();
	}

	public function add_activity_unplanned_details()
	{
		$user = $this->auth->user();
		$add= $this->ecp_model->addActivityUnplanned($user->id,$user->country_id,null,$user->local_date);
		echo $add;
		die;
	}

	public function activity_execution()
	{

		Template::set_view('ecp/activity_execution');
		Template::render();
	}

}