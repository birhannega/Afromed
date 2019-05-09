<?php

class Model_items extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /* get the tbl_itemsdata */
    public function getItemsData($id = false)
    {
        $sql = "SELECT tbl_items.itm_id as ID,
       tbl_items.Itm_name as name,
       tbl_items.itm_minimum_price as price,
       tbl_item_categories.cat_name as category,
       sum(tbl_import.imp_item_amount) as totalamount,
      sum(tbl_sales.sale_item_amount) as sold,
       avg(tbl_import.Item_average_price) as average,
       tbl_items.itm_date_created as date_created,
       tbl_items.item_created_by as created_by,
       tbl_items.itm_remark as description
FROM tbl_items
  LEFT JOIN tbl_import on tbl_items.itm_id = tbl_import.imp_item_id
  LEFT join kass_stock.tbl_sales on tbl_items.itm_id=tbl_sales.sale_itm_id
  LEFT JOIN tbl_item_categories on tbl_items.itm_cat_id = tbl_item_categories.cat_id
GROUP BY tbl_items.itm_id
ORDER BY name DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getAvaialbeItemData()
    {
        $sql = "SELECT tbl_items.Itm_name as name,
                  tbl_items.itm_minimum_price,
                  tbl_item_categories.cat_name,
                  sum(tbl_import.imp_item_amount) as instock,
                  sum(tbl_sales.sale_item_amount) as sold
                   FROM tbl_items
                  LEFT JOIN tbl_item_categories on tbl_items.itm_cat_id = tbl_item_categories.cat_id
                  LEFT JOIN tbl_import on tbl_items.itm_id = tbl_import.imp_item_id
                  LEFT JOIN tbl_sales on tbl_items.itm_id = tbl_sales.sale_itm_id
                  GROUP BY tbl_items.itm_id
                 ORDER BY name DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getItemData($id)
    {
        $sql = "SELECT
 tbl_items.itm_id as ID,
 tbl_items.Itm_name as name,
                      tbl_items.itm_minimum_price as UnitPrice,
                      tbl_item_categories.cat_name,
                      sum(tbl_import.imp_item_amount) as instock
                    FROM tbl_items
                    LEFT JOIN tbl_item_categories on tbl_items.itm_cat_id = tbl_item_categories.cat_id
                    LEFT JOIN tbl_import on tbl_items.itm_id = tbl_import.imp_item_id
                      WHERE tbl_items.itm_id=?";
        $query = $this->db->query($sql, array($id));
        return $query->result();
        
    }
    
    public function getItemDetails($id)
    {
        $sql = "SELECT
                      tbl_items.itm_id as ID,
                      tbl_items.itm_cat_id,
                      tbl_items.Itm_name as name,
                      tbl_items.itm_minimum_price as UnitPrice,
                      tbl_item_categories.cat_name,
                      tbl_items.itm_remark,
                      tbl_items.itm_date_created,
                      sum(tbl_import.imp_item_amount) as instock
                    FROM tbl_items
                    LEFT JOIN tbl_item_categories on tbl_items.itm_cat_id = tbl_item_categories.cat_id
                    LEFT JOIN tbl_import on tbl_items.itm_id = tbl_import.imp_item_id
                    WHERE tbl_items.itm_id=?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
        
    }
    
    public function getItemSalesData($id)
    {
        $sql = "SELECT
                      sum(tbl_sales.sale_item_amount) as sold
                    FROM tbl_sales
                      WHERE tbl_sales.sale_itm_id=?";
        $query = $this->db->query($sql, array($id));
        return $query->result();
        
    }
    
    // get the
    //  item data
    public function getOrdersItemData($tm_id = null)
    {
        if (!$tm_id) {
            return false;
        }
        
        $sql = "SELECT * FROM tbl_items WHERE itm_id = ?";
        $query = $this->db->query($sql, array($tm_id));
        return $query->result_array();
    }
    
    public function create($data)
    {
        try {
            $this->db->insert('tbl_items', $data);
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
    
    public function countOrderItem($order_id)
    {
        if ($order_id) {
            $sql = "SELECT * FROM tbl_items WHERE itm_id = ?";
            $query = $this->db->query($sql, array($order_id));
            return $query->num_rows();
        }
    }
    
    public function update($id, $data)
    {
        if ($data && $id) {
            $this->db->where('itm_id', $id);
            $this->db->update('tbl_items', $data);
            return ($this->db->affected_rows() > 0) ? $id : $this->db->error();
        }
    }
    
    public function remove($id)
    {
        if ($id) {
            $this->db->where('id', $id);
            $delete = $this->db->delete('orders');
            
            $this->db->where('order_id', $id);
            $delete_item = $this->db->delete('orders_item');
            return ($delete == true && $delete_item) ? true : false;
        }
    }
    
    public function countTotalPaidOrders()
    {
        $sql = "SELECT * FROM tbl_items WHERE itm_id = ?";
        $query = $this->db->query($sql, array(1));
        return $query->num_rows();
    }
    
    public function CountItems()
    {
        $sql = "SELECT * FROM tbl_items";
        $query = $this->db->query($sql, array(1));
        return $query->num_rows();
    }
    
}