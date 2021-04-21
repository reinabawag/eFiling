<?php

class Hr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (! $this->session->has_userdata('empcode')) {
			redirect('login');
		}
    }
}
