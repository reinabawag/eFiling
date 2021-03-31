<?php
/**
 * 
 */
class Schedule extends CI_Controller
{
	
	function __construct()
	{	
		parent::__construct();
		$this->load->helper(['url', 'form']);
		$this->load->library(['session']);
		$this->load->model(['schedule_model', 'employee_model']);

		if (! $this->session->has_userdata('empcode')) {
			redirect('login');
		}
	}

	public function index()
	{
		$data['active_page'] = 'change_shift';

		$data['approvers'] = array_merge($this->employee_model->get_rec_approver($this->session->deptcode), $this->employee_model->get_approver($this->session->deptcode));

		$data['schedules'] = $this->schedule_model->get($this->session->empcode);

		$this->load->view('templates/header', $data);
		$this->load->view('main/change_shift');
		$this->load->view('templates/footer');
	}

	public function for_approval()
	{
		echo json_encode(["data" => $this->schedule_model->for_approval($this->session->empcode)]);
	}

	public function view($id)
	{

		var_dump( $this->schedule_model->get_one($id) );
	}

	public function store()
	{
		$this->load->helper(['url']);
		$this->load->library(['session']);

		if ($this->schedule_model->insert($this->input->post())) {
			$this->session->set_flashdata('success', 'Request For Change Schedule Created!');
			return redirect('schedule');
		}
	}

	public function approve()
	{
		$id = $this->input->post('id');
		$bool = $this->input->post('status') == 'APPROVED' ? TRUE : FALSE;
		$status = $this->input->post('status');
		$result = $this->schedule_model->approve($id, $status);

		echo json_encode(['status' => $result]);
	}
}