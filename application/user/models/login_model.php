<?php

class login_model extends CI_Model {
	
	function __construct() {
		$this->load->database();
	}
	
	function verify_user($username, $password) {
		$q = $this
			->db
			->where("username",$username)
			->limit(1)
			->get("tbl_user");
		
		if ($q->num_rows >0 ) {
			$aRow = $q->row();
			if ($this->validatePassword($password,$aRow->salt,$aRow->password)) { // 檢查密碼是否正確 ?
				// 正確，回傳使用者資料
				return $aRow;
			}
		}
		
		return false;
	}
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password, $salt,$db_password) {
		return $this->hashPassword($password,$salt)===$db_password;
	}	

	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt) {
		return md5($salt.$password);
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	protected function generateSalt() {
		return uniqid('',true);
	}	
	
}

?>