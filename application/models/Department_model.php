<?php
/**
* 
*/
class Department_model extends CI_Model
{
	public $deptcode;
	public $name;
	public $status;

	public function __construct()
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
		$query = $this->db->select('deptcode, name');
		$query = $this->db->get('departments');
		return $query->result_array();
	}

	public function insert($deptcode, $name, $status)
	{
		$this->deptcode = $deptcode;
		$this->name = $name;
		$this->status = $status;

		$this->db->insert('departments', $this);
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
}