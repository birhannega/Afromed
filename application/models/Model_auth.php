<?php

class Model_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*
		This function checks if the email exists in the database
	*/
	public function check_user_name($username)
	{
		if($username) {
			$sql = 'SELECT * FROM tbl_users WHERE user_name = ?';
			$query = $this->db->query($sql, array($username));
			$result = $query->num_rows();
			return ($result == 1) ? true : false;
		}

		return false;
	}

	/*
		This function checks if the email and password matches with the database
	*/
	public function login($email, $password) {
		if($email && $password) {
			$sql = "SELECT * FROM tbl_users WHERE user_name = ?";
			$query = $this->db->query($sql, array($email));

			if($query->num_rows() == 1) {
				$result = $query->row_array();
				
				$hash_password = password_verify($password, $result['user_password']);
				if($hash_password === true) {
					return $result;
				}
				else {
					return false;
				}

				
			}
			else {
				return false;
			}
		}
	}
}