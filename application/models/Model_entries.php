<?php 

class Model_entries extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /* get the brand data */
    public function getProductData()
    {
        $sql = "SELECT tbl_import.*,tbl_items.Itm_name as item_name  FROM tbl_import JOIN tbl_items ON tbl_import.imp_item_id = tbl_items.itm_id ORDER BY imp_date DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getEntryData($imp_id)
    {
        $sql = "SELECT tbl_import.*,tbl_items.Itm_name as item_name FROM tbl_import JOIN tbl_items ON  tbl_import.imp_item_id = tbl_items.itm_id WHERE imp_id= ? ";
        $query = $this->db->query($sql, array($imp_id));
        return $query->result_array();
    }
    
    public function create($data)
    {
        if ($data) {
            try {
                $insert = $this->db->insert('tbl_import', $data);
                $insertedId = $this->db->insert_id();
                if (!$insertedId) {
                    return $this->db->error();
                } else {
                    return $insertedId;
                }
            } catch (Exception $e) {
                return 'error';
            }
            
        }
    }
    
    public function update($data, $id)
    {
        if ($data && $id) {
            $this->db->where('imp_id', $id);
            $this->db->update('tbl_import', $data);
            return ($this->db->affected_rows() > 0) ? $id : $this->db->error();
        }
    }
    public function remove($id)
    {
        if ($id) {
            $this->db->where('imp_id', $id);
            $this->db->delete('tbl_import');
            return ($this->db->affected_rows() > 0) ? $id : $this->db->error();
        }else{
            return ($this->db->affected_rows() > 0) ? $id : $this->db->error();
        }
    }
    
	public function countTotalProducts()
	{
		$sql = "SELECT * FROM tbl_import";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}