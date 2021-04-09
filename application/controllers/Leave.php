<?php

class Leave extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
		$this->load->helper(['url', 'form']);
		$this->load->library(['session']);
		$this->load->model(['department_model', 'employee_model', 'overtime_model', 'overtime_model', 'leave_model']);

		if (! $this->session->has_userdata('empcode')) {
			redirect('login');
		}
	}

    public function index()
    {
        $data['active_page'] = 'leave';
        $data['recommender'] = [];
        $data['approver'] = [];

        foreach ($this->employee_model->get_rec_approver($this->session->deptcode) as $key => $value) {
            $data['recommender'][$value->empcode] = $value->name;
        }

        foreach ($this->employee_model->get_approver($this->session->deptcode) as $key => $value) {
            $data['approver'][$value->empcode] = $value->name;
        }


		$this->load->view('templates/header', $data);
		$this->load->view('main/leave');
		$this->load->view('templates/footer');
    }

    public function create()
    {
        if ($this->leave_model->insert($this->input->post())) {
            echo json_encode(['status' => TRUE, 'message' => 'Leave request created!']);
        } else {
            echo json_encode(['status' => FALSE, 'message' => "There's a problem creating request!"]);
        }
    }

    public function get()
    {
        echo json_encode(['data' => $this->leave_model->get($this->session->empcode)]);
    }
}
