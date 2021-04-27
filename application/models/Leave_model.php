<?php

class Leave_model extends CI_Model
{
    public $id;
    public $empcode;
    public $name;
    public $date_filed;
    public $date_start;
    public $date_end;
    public $pay;
    public $type;
    public $reason;
    public $recommended_by;
    public $approved_by;
    public $rec_status;
    public $appr_status;
    public $status;

    public function __construct()
    {
        $this->load->database();
    }

    public function insert()
    {
        $this->empcode = $this->input->post('empcode');
        $this->name = $this->input->post('name');
        $this->date_filed = $this->input->post('date_filed');
        $this->date_start = $this->input->post('date_start');
        $this->date_end = $this->input->post('date_end');
        $this->pay = $this->input->post('pay');
        $this->type = $this->input->post('type');
        $this->reason = $this->input->post('reason');
        $this->recommended_by = $this->input->post('recommended_by') == '' ? NULL : $this->input->post('recommended_by');
        $this->approved_by = $this->input->post('approved_by');
        $this->rec_status = $this->input->post('recommended_by') == '' ? TRUE : FALSE;
        $this->appr_status = FALSE;
        $this->status = 'PENDING';

        return $this->db->insert('leaves', $this);
    }

    public function get($empcode)
    {
        return $this->db->get_where('leaves', ['empcode' => $empcode])->result();
    }

    public function getForRecommendation($empcode)
    {
        return $this->db->get_where('leaves', ['recommended_by' => $empcode, 'rec_status' => FALSE, 'status' => 'PENDING'])->result();
    }

    public function getForApproval($empcode)
    {   
        return $this->db->get_where('leaves', ['approved_by' => $empcode, 'rec_status' => TRUE, 'status' => 'PENDING'])->result();
    }

    public function approveForRecommendation($id, $approve)
    {
        if ($approve) {
            return $this->db->where('id', $id)->update('leaves', ['rec_status' => TRUE]);
        } else {
            return $this->db->where('id', $id)->update('leaves', ['rec_status' => FALSE, 'status' => 'DISAPPROVED BY RECOMMENDER']);
        }
    }

    public function Approval($id, $approve)
    {
        if ($approve) {
            return $this->db->where('id', $id)->update('leaves', ['appr_status' => TRUE, 'status' => 'APPROVED']);
        } else {
            return $this->db->where('id', $id)->update('leaves', ['appr_status' => FALSE, 'status' => 'DISAPPROVED BY APPROVER']);
        }
    }

    public function GetLeave($id)
    {
        return $this->db->get_where('leaves', ['id' => $id])->row();
    }
}
