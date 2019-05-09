<?php 

class Model_reportss extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getReporData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM Model_reportss where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM reportss ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveReporData()
	{
		$sql = "SELECT * FROM reportss WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('reportss', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('reportss', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('reportss');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalReportss()
	{
		$sql = "SELECT * FROM reportss";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}