<?php

class Main extends CI_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(['url', 'form']);
		$this->load->library(['session']);
		$this->load->model(['department_model', 'employee_model', 'overtime_model', 'overtime_model']);

		if (! $this->session->has_userdata('empcode')) {
			redirect('login');
		}
	}

	public function index()
	{
		$data['active_page'] = 'home';
		$this->load->view('templates/header', $data);

		if (($this->session->supervisor) || ($this->session->depthead) || ($this->session->secthead) || ($this->session->divhead)) {
			$this->load->view('main/index', $data);
		} else {
			$this->load->view('employee/index', $data);
		}

		$this->load->view('templates/footer');
	}

	public function employee()
	{
		$data['active_page'] = 'employees';
		$this->load->view('templates/header', $data);
		$this->load->view('main/employee');
		$this->load->view('templates/footer');
	}

	public function import_employee()
	{
		$result = $this->employee_model->import();
		echo json_encode(['status' => $result]);
	}

	public function get_employee($empcode)
	{
		// var_dump($this->input->is_ajax_request());
		// var_dump("FALSE");

		// if ($this->input->is_ajax_request() === "FALSE") {
		// 	die('BITCH');
		// }
		

		$result = $this->employee_model->get($empcode);
		echo json_encode($result);
	}

	public function get_employees()
	{
		$result = $this->employee_model->get_all();
		echo json_encode(['data' => $result]);
	}

	public function update_employee()
	{
		$empcode = $this->input->post('empcode');
		// $supervisor = $this->input->post('supervisor');
		// $depthead = $this->input->post('depthead');
		// $secthead = $this->input->post('secthead');
		// $divhead = $this->input->post('divhead');

		$supervisor = false;
		$depthead = false;
		$secthead = false;
		$divhead = false;

		switch ($this->input->post('optradio')) {
			case 'supervisor':
				$supervisor = true;
				break;
			case 'depthead':
				$depthead = true;
				break;
			case 'secthead':
				$secthead = true;
				break;
			case 'divhead':
				$divhead = true;
				break;
			default:
				# code...
				break;
		}

		$is_hr = $this->input->post('is_hr');
		$is_payroll = $this->input->post('is_payroll');
		$is_audit = $this->input->post('is_audit');

		$result = $this->employee_model->update($empcode, $supervisor, $depthead, $secthead, $divhead, $is_hr, $is_payroll, $is_audit);
		echo json_encode(['status' => $result]);
	}

	public function department()
	{
		$data['active_page'] = 'departments';
		$this->load->view('templates/header', $data);
		$this->load->view('main/department', $data);
		$this->load->view('templates/footer');
	}

	public function import_department()
	{
		$result = $this->department_model->import();
		echo json_encode(['status' => $result]);
	}

	public function get_departments()
	{
		$result = $this->department_model->get_all();
		echo json_encode(['data' => $result]);
	}

	public function overtime()
	{
		$data['active_page'] = 'overtime';
		$this->load->view('templates/header', $data);
		$this->load->view('main/overtime');
		$this->load->view('templates/footer');
	}

	public function leave()
	{
		$data['active_page'] = 'leave';
		$this->load->view('templates/header', $data);
		$this->load->view('main/leave');
		$this->load->view('templates/footer');
	}

	// public function change_shift()
	// {
	// 	$data['active_page'] = 'change_shift';
	// 	$data['approvers'] = $this->employee_model->get_all_approvers($this->session->deptcode);

	// 	$this->load->view('templates/header', $data);
	// 	$this->load->view('main/change_shift');
	// 	$this->load->view('templates/footer');
	// }

	public function compute_time_diff()
	{
		$start = new datetime($this->input->post('start'));
		$temp = substr($this->input->post('end'), 3, 2);

		if ($temp < 30) {
			$temp = 00;
		} else if ($temp < 45) {
			$temp = 30;
		} else if ($temp < 55) {
			$temp = 45;
		} else if ($temp > 55) {
			$temp = 55;
		}

		$end = new datetime(substr($this->input->post('end'), 0, 3).$temp);
		$val = $end->diff($start);
		
		echo json_encode(['diff' => $val->format('%h.%i')]);
	}

	public function get_approver()
	{
		$deptcode = $this->input->get('deptcode');
		$result = $this->employee_model->get_approver($deptcode);

		echo json_encode($result);
	}

	public function get_rec_approver()
	{
		$deptcode = $this->input->get('deptcode');
		$result = $this->employee_model->get_rec_approver($deptcode);

		if (empty($result))
			$result[] = ['empcode' => '', 'name' => 'N.A'];

		echo json_encode($result);
	}

	public function create_overtime()
	{
		$empcode = $this->input->post('empcode');
		$deptcode = $this->input->post('deptcode');
		$date_filed = $this->input->post('date');
		$start_time = $this->input->post('start');
		$end_time = $this->input->post('end');
		$hrs = $this->input->post('computed_time');
		$reason = $this->input->post('reason');
		$rec_by = $this->input->post('rec_approver');
		$appr_by = $this->input->post('approver');

		$result = $this->overtime_model->insert($empcode, $deptcode, $date_filed, $start_time, $end_time, $hrs, $reason, $rec_by, $appr_by);

		echo json_encode(['status' => $result]);
	}

	public function get_filed_overtime()
	{
		$empcode = $this->input->get('empcode');

		$result = $this->overtime_model->get_all_by_empcode($empcode);
		echo json_encode($result);
	}

	public function logout()
	{
		if ($this->session->has_userdata('empcode')) {
			$this->session->sess_destroy();			
			redirect('login');
		}
	}

	public function get_ot_for_approval()
	{
		$empcode = $this->session->empcode;

		if (($this->session->supervisor) || ($this->session->depthead) || ($this->session->secthead)) {
			$result = $this->overtime_model->get_ot_for_recommendation($empcode);
		} else {
			$result = $this->overtime_model->get_ot_for_approval($empcode);
		}
		
		echo json_encode(['data' => $result]);
	}

	public function approve_ot()
	{
		$recid = $this->input->post('id');
		$status = $this->input->post('approve');

		if (($this->session->supervisor) || ($this->session->depthead) || ($this->session->secthead)) {
			$result = $this->overtime_model->approve_ot_recommendation($recid);
		} else {
			$result = $this->overtime_model->approve_ot_approver($recid);
		}

		$this->load->model('trail_model');

		//$this->trail_model->insert('OT', $recid, $this->session->empcode, $status);

		echo json_encode(['status' => $result]);
	}
}