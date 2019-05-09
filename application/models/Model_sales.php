
<?php 

class Model_sales extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the active store data */
	public function getActiveStore()
	{
		$sql = "SELECT * FROM stores WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the sales data */
	public function getSalesData($id = null)
	{
		if($id) {
			$sql = "SELECT tbl_sales.*,tbl_items.Itm_name FROM tbl_sales JOIN tbl_items on tbl_sales.sale_itm_id = tbl_items.itm_id where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT tbl_sales.*,tbl_items.Itm_name FROM tbl_sales JOIN tbl_items on tbl_sales.sale_itm_id = tbl_items.itm_id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_sales', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('Credits', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('Credits');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalStores()
	{
		$sql = "SELECT * FROM tbl_sales WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
	function Count_today_Sales(){
        $sql = "SELECT * FROM tbl_sales WHERE Date_sold = ?";
        $query = $this->db->query($sql, array(1));
        return $query->num_rows();
    }

}