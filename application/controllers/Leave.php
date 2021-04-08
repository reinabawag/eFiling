<?php

class Leave extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (! $this->session->has_userdata('empcode')) {
            redirect('login');
        }
    }
}
