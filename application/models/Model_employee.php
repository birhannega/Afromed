<?php

class Model_employee extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEmployeeData($empId = null)
    {
        if ($empId) {
            $sql = "SELECT * FROM tbl_employee WHERE emp_user_id = ?";
            $query = $this->db->query($sql, array($empId));
            return $query->row_array();
        }
        $sql = "SELECT * FROM tbl_employee WHERE emp_user_id != ?";
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

    public function create($data = '')
    {

        if ($data) {
            $create = $this->db->insert('tbl_employee', $data);

           // $user_id = $this->db->insert_id();

//            $group_data = array(
//                'user_id' => $user_id,
//                'group_id' => $group_id
//            );
//
//            //$group_data = $this->db->insert('user_group', $group_data);

            return ($create == true) ? true : false;
        }
    }

    public function edit($data = array(), $id = null, $group_id = null)
    {
        $this->db->where('emp_user_id', $id);
        $update = $this->db->update('tbl_employee', $data);

        if ($group_id) {
            // user group
            $update_user_group = array('group_id' => $group_id);
            $this->db->where('user_id', $id);
            $user_group = $this->db->update('user_group', $update_user_group);
            return ($update == true && $user_group == true) ? true : false;
        }

        return ($update == true) ? true : false;
    }

    public function delete($id)
    {
        $this->db->where('emp_user_id', $id);
        $delete = $this->db->delete('tbl_employee');
        return ($delete == true) ? true : false;
    }

    public function countTotalUsers()
    {
        $sql = "SELECT * FROM emp_user_id";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

}