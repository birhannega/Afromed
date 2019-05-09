<?php 

class Model_credits extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// get the active atttributes data 
	public function getActiveAttData()
	{
		$sql = "SELECT * FROM atts WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the attribute data */
	public function getAttData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM atts where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM atts";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function countAttValue($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM att_value WHERE att_parent_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->num_rows();
		}
	}

	/* get the attribute value data */
	// $id = attribute_parent_id
	public function getAttValueData($id = null)
	{
		$sql = "SELECT * FROM att_value WHERE att_parent_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function getAttValueById($id = null)
	{
		$sql = "SELECT * FROM att_value WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('atts', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('atts', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('atts');
			return ($delete == true) ? true : false;
		}
	}

	public function createValue($data)
	{
		if($data) {
			$insert = $this->db->insert('att_value', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function updateValue($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('att_value', $data);
			return ($update == true) ? true : false;
		}
	}

	public function removeValue($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('att_value');
			return ($delete == true) ? true : false;
		}
	}

}