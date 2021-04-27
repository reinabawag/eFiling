<?php

class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(['url', 'form']);
		$this->load->library(['form_validation', 'session']);
		$this->load->model(['employee_model']);

		if ($this->session->has_userdata('empcode')) {
			redirect('main');
		}
	}

	public function index()
	{
		$data['active_page'] = 'Login';
		$this->load->view('templates/header', $data);
		$this->load->view('main/login');
		$this->load->view('templates/footer');
	}

	public function auth($id)
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$error['username'] = [''];
		$error['password'] = [''];

		if ($this->form_validation->run() == FALSE) {
			$error['username'] = [form_error('username')];
			$error['password'] = [form_error('password')];
			echo json_encode(['validation' => $error, 'msg' => '']);
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$result = $this->employee_model->auth_employee($username, $password);
			if ($result == FALSE) {
				echo json_encode(['status' => FALSE, 'msg' => ucwords('incorrect User ID or Password.'), 'validation' => $error]);
			} else {				
				foreach ($result as $key => $value) {
					$this->session->set_userdata($key, $value);
				}

				$emp = $this->employee_model->get($result->empcode);
				$url = site_url('main');
				echo json_encode(['status' => TRUE, 'url' => $url]);
			}
		}
	}
}
