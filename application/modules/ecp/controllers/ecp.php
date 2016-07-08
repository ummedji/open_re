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

		$page = (isset($_POST['page']) ? $_POST['page'] : '');
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

		$employee =  $this->ecp_model->get_all_employee_by_country_id($user->country_id);
		Template::set('employee', $employee);
		Template::set('current_user', $user);
		Template::set_view('ecp/all_material_requests');
		Template::render();
	}

	public function all_materials_details_view()
	{
		$user = $this->auth->user();

		$from_date = (isset($_POST['from_date']) ? $_POST['from_date'] : '');
		$to_date = (isset($_POST['to_date']) ? $_POST['to_date'] : '');
		$status_id = (isset($_POST['status_id']) ? $_POST['status_id'] : '');
		$employee_id = (isset($_POST['employee_id']) ? $_POST['employee_id'] : '');

		$page = (isset($_POST['page']) ? $_POST['page'] : '');

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

		$page = (isset($_POST['page']) ? $_POST['page'] : '');

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

		$page = (isset($_POST['page']) ? $_POST['page'] : '');

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
		$action ='no_working';
		$no_working_details = $this->ecp_model->all_no_working_details($user->id,$user->country_id);

		$cal_data = $this->leave_sidebar_calender($no_working_details,$action);

		Template::set('reason', $reason);
		Template::set('cal_data', $cal_data);
		Template::set_view('ecp/no_working');
		Template::render();
	}

	public function set_leave()
	{
		Assets::add_module_js('ecp', 'leave.js');

		$user = $this->auth->user();
		$leave_type=$this->ecp_model->all_leave_type_details($user->country_id);

		$leave_details = $this->ecp_model->all_leave_details($user->id,$user->country_id);
		$action ='set_leave';
		$cal_data = $this->leave_sidebar_calender($leave_details,$action);

		Template::set('leave_type', $leave_type);
		Template::set('cal_data', $cal_data);
		Template::set_view('ecp/leave');
		Template::render();
	}

	public function leave_sidebar_calender($leave_details,$action){
		//testdata($leave_details);

		$user = $this->auth->user();

// Get current year, month and day
		list($iNowYear, $iNowMonth, $iNowDay) = explode('-', date('Y-m-d'));

// Get current year and month depending on possible GET parameters
		if (isset($_GET['month'])) {
			list($iMonth, $iYear) = explode('-', $_GET['month']);
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
					if($iCurrentDay < date("d")){
						$sClass = 'prev';
					} else {
						$sClass = 'current';
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
		$sCalendarItself .= '<a class="prev" href="'.base_url('ecp/leave_sidebar_calender').'?month='.$aKeys["__prev_month__"].'" onclick="$(\'#calendar\').load(\''.base_url('ecp/leave_sidebar_calender').'?month='.$aKeys["__prev_month__"].'&_r=\' + Math.random()); return false;"></a> ';


		$sCalendarItself .= '<div class="title" >'.$aKeys['__cal_caption__'].'</div>';

		$sCalendarItself .= '<a class="next" href="'.base_url('ecp/leave_sidebar_calender').'?month='.$aKeys["__next_month__"].'" onclick="$(\'#calendar\').load(\''.base_url('ecp/leave_sidebar_calender').'?month='.$aKeys["__next_month__"].'&_r=\' + Math.random()); return false;"></a>';

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



}