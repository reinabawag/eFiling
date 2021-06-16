<?php

class Loan_model extends CI_Model {
    public $id;
    public $empcode;
    public $amount;
    public $created_date;
    public $approved_date;  

    public function create()
    {
        $this->load->database();

        $this->empcode = $this->session->empcode;
        $this->amount = $this->input->post('amount');
        $this->created_date = mdate('%Y-%m-%d %h:%i:%s');

        return $this->db->insert('loans', $this);
    }

    public function get_loans()
    {
        $this->load->database();

        return $this->db->get_where('loans', array('empcode' => $this->session->empcode))->result();
    }
}