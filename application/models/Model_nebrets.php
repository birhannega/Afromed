<?php 

class Model_nebrets extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getNebretData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM nebrets where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM nebrets ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveNebretData()
	{
		$sql = "SELECT * FROM nebrets WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('nebrets', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('nebrets', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('nebrets');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalNebrets()
	{
		$sql = "SELECT * FROM nebrets";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}