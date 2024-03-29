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

		$empcode = $this->session->empcode;
		$emp = $this->employee_model->get($empcode);

		$data['data_info'] = $emp;

		if (($emp->supervisor) || ($emp->depthead) || ($emp->secthead) || ($emp->divhead)) {
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

	public function compute_time_diff()
	{
		$start = new datetime($this->input->post('start'));
		$end = new datetime($this->input->post('end'));
		$val = $start->diff($end);
		
		$hours = (intval($val->d) * 24) + $val->h . ".$val->i";
		
		echo json_encode(['diff' => $hours]);
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
		$emp = $this->employee_model->get($empcode);

		if (($emp->supervisor) || ($emp->depthead) || ($emp->secthead)) {
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
		
		$empcode = $this->session->empcode;
        $emp = $this->employee_model->get($empcode);

		if (($emp ->supervisor) || ($emp ->depthead) || ($emp ->secthead)) {
			$result = $this->overtime_model->approve_ot_recommendation($recid, $status);

			if ($this->overtime_model->getOvertime($recid)->appr_by == NULL) {
				$this->overtime_model->approve_ot_approver($recid);
			}
		} else {
			$result = $this->overtime_model->approve_ot_approver($recid);
		}

		// $this->load->model('trail_model');

		//$this->trail_model->insert('OT', $recid, $this->session->empcode, $status);

		echo json_encode(['status' => $result]);
	}

	public function backup()
	{
		// Load the DB utility class
		$this->load->dbutil();

		$prefs = array(
			'ignore'        => array('changeshifts'),       // List of tables to omit from the backup
			'format'        => 'zip',                       // gzip, zip, txt
			'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
			'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
			'add_insert'    => TRUE,
			'foreign_key_checks' => FALSE                        // Whether to add INSERT data to backup file
		);

		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup($prefs);

		// Load the file helper and write the file to your server

		try {
			$this->load->helper('file');
			write_file('db/db_'.time().'.sql.zip', $backup);
		} catch (Exception $th) {
			print_r($th);
		}
	}
}