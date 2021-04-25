<?php

class Employee_model extends CI_Model
{
	public $empcode;
	public $password;	
	public $lname;
	public $fname;
	public $mname;
	public $deptcode;
	public $supervisor;
	public $depthead;
	public $secthead;
	public $divhead;
	public $is_hr;
	public $is_payroll;
	public $is_audit;
	public $hiredate;
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($empcode)
	{	
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->join('departments', 'departments.deptcode = employees.deptcode');
		$this->db->where('empcode', $empcode);
		return $this->db->get()->row();
	}

	public function set_employee($empcode)
	{
		$result = $this->get($empcode);

		$this->empcode 		= $result->empcode;
		$this->password     = $result->password;
		$this->lname 		= $result->lname;
		$this->fname 		= $result->fname;
		$this->mname 		= $result->mname;
		$this->deptcode 	= $result->deptcode;
		$this->supervisor 	= $result->supervisor;
		$this->depthead 	= $result->depthead;
		$this->secthead 	= $result->secthead;
		$this->hiredate 	= $result->hiredate;
		$this->depthead 	= $result->depthead;
		$this->secthead 	= $result->secthead;
		$this->divhead		= $result->divhead;
		$this->is_hr 		= $result->is_hr;
		$this->is_payroll	= $result->is_payroll;
		$this->is_audit		= $result->is_audit;
	}

	public function get_all()
	{
		$query = $this->db->get('employees');
		return $query->result_array();
	}

	public function insert($empcode, $lname, $fname, $mname, $deptcode, $hiredate)
	{
		$this->empcode = $empcode;
		$this->password = password_hash($hiredate, PASSWORD_DEFAULT);
		$this->lname = $lname;
		$this->fname = $fname;
		$this->mname = $mname;
		$this->deptcode = $deptcode;
		$this->hiredate = $hiredate;

		$this->db->insert('employees', $this);
	}

	public function update($empcode, $supervisor, $depthead, $secthead, $divhead, $is_hr, $is_payroll, $is_audit)
	{
		$this->set_employee($empcode);

		$this->supervisor = $supervisor;
		$this->depthead = $depthead;
		$this->secthead = $secthead;
		$this->divhead = $divhead;
		$this->is_hr = $is_hr;
		$this->is_payroll = $is_payroll;
		$this->is_audit = $is_audit;

		return $this->db->update('employees', $this, array('empcode' => $empcode));
	}

	public function delete($empcode)
	{
		$this->db->delete('employees', array('empcode' => $empcode));
	}

	public function if_exist($empcode)
	{
		$query = $this->db->get_where('employees', array('empcode' => $empcode));
		return $query->result();
	}

	public function import()
	{
		$pserver = $this->load->database('pserver', TRUE);
		$query = $pserver->query('SELECT empcode, lname, fname, mname, deptcode, hiredate FROM employeefile WHERE termdate IS NULL');

		try {
			foreach ($query->result() as $key) {
				if (count($this->if_exist($key->empcode)) == 0) {
					$this->insert($key->empcode, $key->lname, $key->fname, $key->mname, $key->deptcode, $key->hiredate);
				}
			}
			return TRUE;
		} catch (Exception $e) {
			die($e);	
		}
	}

	public function get_approver($deptcode)
	{
		$result = $this->db->query("SELECT empcode, CONCAT(lname, ', ', fname, ' ', mname) AS name FROM employees WHERE deptcode LIKE '".substr($deptcode, 0, 1)."%' AND divhead = 1 ORDER BY name");
		
		return $result->result();
	}

	public function get_rec_approver($deptcode)
	{
		$result = $this->db->query("SELECT empcode, CONCAT(lname, ', ', fname, ' ', mname) AS name FROM employees WHERE (deptcode = '$deptcode') AND (supervisor = 1 OR secthead = 1 OR depthead = 1) ORDER BY name");

		return $result->result();
	}


	public function auth_employee($username, $password)
	{
		$this->db->select("*, CONCAT(lname, ', ', fname, ' ', mname) AS name");
		$result = $this->db->get_where('employees', ['empcode' => $username])->row();

		if ($result && password_verify($password, $result->password)) {
			return $result;
		} else {
			return FALSE;
		}
	}
}
