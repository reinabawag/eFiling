<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['url', 'date', 'html']);
		$this->load->library(['form_validation', 'session']);
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('loan_model');

		$data['active_page'] = 'loan';
		$data['loans'] = $this->loan_model->get_loans();

		$this->load->view('templates/header', $data);
		$this->load->view('loan/index');
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$this->load->model('loan_model');

		$this->form_validation->set_rules('amount', 'Amount', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('loan/create');
			$this->load->view('templates/footer');
		} else {
			$this->loan_model->create();

			redirect('/loan/index');
		}
		
	}
}
