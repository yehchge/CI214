<?php

class Links_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	public function get_links() {
		$query = $this->db->get('links');
		return $query->result_array();
	}
}

?>