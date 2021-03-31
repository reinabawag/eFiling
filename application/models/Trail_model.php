<?php

class Trail_model extends CI_Model
{
    public $type;
    public $request_id;
    public $approver_id;
    public $status;
    public $date;

    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function insert($type, $request_id, $approver_id, $status)
    {
        $this->type         = $type;
        $this->request_id   = $request_id;
        $this->approver_id  = $approver_id;
        $this->status       = $status;
        $this->date         = NULL;

        return $this->db->insert('trail', $this);
    }
}
