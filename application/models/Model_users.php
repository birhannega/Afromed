<?php

class Model_users extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getUserData($userId = null)
    {
        if ($userId) {
            $sql = "SELECT tbl_users.*,tbl_employee.*
             FROM tbl_users JOIN tbl_employee
             on  tbl_users.user_emp_id = tbl_employee.emp_user_id
              WHERE id = ?";
            $query = $this->db->query($sql, array($userId));
            return $query->row_array();
        }
    
        $sql = "SELECT tbl_users.*,tbl_employee.*
             FROM tbl_users JOIN tbl_employee
             on  tbl_users.user_emp_id = tbl_employee.emp_user_id
              WHERE id != ?";
        $query = $this->db->query($sql, array(1));
        return $query->result_array();
    }
    
    public function getUserGroup($userId = null)
    {
        if ($userId) {
            $sql = "SELECT * FROM tbl_user_group WHERE group_user_id = ?";
            $query = $this->db->query($sql, array($userId));
            $result = $query->row_array();
            
            $group_id = $result['group_id'];
            $g_sql = "SELECT * FROM tbl_groups WHERE id = ?";
            $g_query = $this->db->query($g_sql, array($group_id));
            $q_result = $g_query->row_array();
            return $q_result;
        }
    }
    
    public function create($data = '', $group_id = null)
    {
        
        if ($data && $group_id) {
            $create = $this->db->insert('tbl_users', $data);
            
            $user_id = $this->db->insert_id();
            
            $group_data = array(
                'group_user_id' => $user_id,
                'group_id' => $group_id
            );
            
            $group_data = $this->db->insert('tbl_user_group', $group_data);
            
            return ($create == true && $group_data) ? true : false;
        }
    }
    
    public function edit($data = array(), $id = null, $group_id = null)
    {
        $this->db->where('id', $id);
        $update = $this->db->update('tbl_users', $data);
        
        if ($group_id) {
            // user group
            $update_user_group = array('group_id' => $group_id);
            $this->db->where('user_id', $id);
            $user_group = $this->db->update('tbl_user_group', $update_user_group);
            return ($update == true && $user_group == true) ? true : false;
        }
        
        return ($update == true) ? true : false;
    }
    
    public function delete($id)
    {
        $this->db->where('id', $id);
        $delete = $this->db->delete('tbl_users');
        return ($delete == true) ? true : false;
    }
    
    public function countTotalUsers()
    {
        $sql = "SELECT * FROM tbl_users";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
}