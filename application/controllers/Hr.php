<?php

class Hr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper(['url', 'form']);

        if (! $this->session->has_userdata('empcode')) {
			redirect('login');
		}
    }

    public function index()
    {
        $data['active_page'] = 'home';
		$this->load->view('templates/header', $data);
        $this->load->view('hr/index', $data);
        $this->load->view('templates/footer');
    }
}
