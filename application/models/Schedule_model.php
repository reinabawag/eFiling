<?php
/**
 * 
 */
class Schedule_model extends CI_Model
{
	public $id;
	public $employee_id;
	public $purpose;
	public $from_date;
	public $to_date;
	public $from_time;
	public $to_time;
	public $reason;
	public $reliever;
	public $approver;
	public $personnel;
	public $approved;
	public $status;
	
	function __construct()
	{
		$this->load->database();
	}

	public function insert($data)
	{
		return $this->db->insert('schedule', $data);
	}

	public function get_one($id)
	{
		return $this->db->where('id', $id)->get('schedule')->result();
	}

	public function get($emp)
	{
		return $this->db->where('emp', $emp)->order_by('date_filed', 'DESC')->get('schedule')->result();
	}

	public function for_approval($emp)
	{
		$this->db->select("id, employees.empcode, CONCAT(lname, ', ', fname, ' ', mname) AS name, date_filed, purpose, from_time, to_time, from_date, to_date, reason");
		$this->db->join('employees', 'schedule.emp = employees.empcode');
		return $this->db->where(['approver' => $emp, 'approved' => FALSE])->order_by('id', 'DESC')->get('schedule')->result();
	}

	public function approve($id, $status)
	{
		return $this->db->where('id', $id)->update('schedule', ['approved' => TRUE, 'status' => $status]);
	}
}