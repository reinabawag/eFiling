<?php

class Overtime_model extends CI_Model
{
	public $id;
	public $empcode;
	public $deptcode;
	public $date_filed;
	public $start_time;
	public $end_time;
	public $hrs;
	public $reason;
	public $rec_by;
	public $appr_by;
	public $rec_status;
	public $appr_status;
	public $status;
	public $create_date;
	public $appr_date;
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($id)
	{
		return $this->db->get_where('departments', array('id' => $id))->row();
	}

	public function get_all()
	{
		$query = $this->db->select("employees.empcode, CONCAT(lname, ', ', fname, ' ', mname) AS name, start_time, end_time, date_filed, status");
		$this->db->join('employees', 'overtimes.empcode = employees.empcode');
		$query = $this->db->get('overtimes');

		return $query->result_array();
	}

	public function get_all_by_empcode($empcode)
	{
		$this->db->select("LPAD(id, 6, 0) AS id, employees.empcode, CONCAT(lname, ', ', fname, ' ', mname) AS name, start_time, end_time, hrs, date_filed, status");
		$this->db->join('employees', 'overtimes.empcode = employees.empcode');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get_where('overtimes', ['overtimes.empcode' => $empcode]);

		return $query->result_array();
	}

	public function insert($empcode, $deptcode, $date_filed, $start_time, $end_time, $hrs, $reason, $rec_by, $appr_by)
	{
		$this->empcode = $empcode;
		$this->deptcode = $deptcode;
		$this->date_filed = $date_filed;
		$this->start_time = $start_time;
		$this->end_time = $end_time;
		$this->hrs = $hrs;
		$this->reason = $reason;
		$this->rec_by = $rec_by;
		$this->appr_by = $appr_by;

		if ($rec_by == '')
			$this->rec_status = true;

		$this->status = 'PENDING';

		return $this->db->insert('overtimes', $this);
	}

	public function update($id, $name, $status)
	{
		$this->name = $name;
		$this->status = $status;

		$this->db->update('departments', $this, array('id' => $id));
	}

	public function delete($id)
	{
		$this->db->delete('departments', array('id' => $id));
	}

	public function if_exist($depcode)
	{
		$query = $this->db->get_where('departments', array('deptcode' => $depcode));
		return $query->result();
	}

	public function import()
	{
		$pserver = $this->load->database('pserver', TRUE);
		$query = $pserver->query('SELECT deptcode, deptdescription FROM departmentfile');

		try {
			foreach ($query->result() as $key) {
				if (count($this->if_exist($key->deptcode)) == 0) {
					$this->insert($key->deptcode, $key->deptdescription, 'ACTIVE');
				}
			}
			return TRUE;
		} catch (Exception $e) {
			return $e;	
		}
	}

	public function get_ot_for_recommendation($empcode)
	{
		$this->db->select("id, e.empcode, CONCAT(lname, ', ', fname, ' ', mname) AS name, start_time, end_time, hrs, date_filed, reason");
		$this->db->join('employees as e', 'e.empcode = overtimes.empcode');
		$this->db->order_by('create_date', 'asc');
		$result = $this->db->get_where('overtimes', ['rec_by' => $empcode, 'status' => 'PENDING', 'appr_status' => NULL, 'rec_status' => NULL]);

		// die($this->db->last_query());
		return $result->result();
	}

	public function get_ot_for_approval($empcode)
	{
		$this->db->select("id, e.empcode, CONCAT(lname, ', ', fname, ' ', mname) AS name, start_time, end_time, hrs, date_filed, reason");
		$this->db->join('employees as e', 'e.empcode = overtimes.empcode');
		$this->db->order_by('create_date', 'asc')

		
		->where(['appr_by' => $empcode, 'status' => 'PENDING', 'appr_status' => NULL, 'rec_status' => 1]);
		

		// $this->db->where('rec_by', 'null');

		$result = $this->db->get('overtimes');

		// die($this->db->last_query());
		return $result->result();
	}

	public function approve_ot_recommendation($recid)
	{
		$this->db->where('id', $recid);
		return $this->db->update('overtimes', ['rec_status' => TRUE]);
	}

	public function approve_ot_approver($recid)
	{
		$this->db->where('id', $recid);
		return $this->db->update('overtimes', ['appr_status' => TRUE, 'status' => 'APPROVED']);
	}
}