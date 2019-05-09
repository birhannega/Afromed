<?php 

class Model_category extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */
	public function getActiveCategroy()
	{
		$sql = "SELECT * FROM tbl_item_categories WHERE cat_deleted = ?";
		$query = $this->db->query($sql, array(0));
		return $query->result_array();
	}

	/* get the brand data */
	public function getCategoryData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_item_categories WHERE cat_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result();
		}

		$sql = "SELECT * FROM tbl_item_categories";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_item_categories', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('cat_id', $id);
			$update = $this->db->update('tbl_item_categories', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('cat_id', $id);
			$delete = $this->db->delete('tbl_item_categories');
			return ($delete == true) ? true : false;
		}
	}public function countcategories()
	{
        $sql = "SELECT * FROM tbl_item_categories";
        $query = $this->db->query($sql);
        return $query->num_rows();
	}

}