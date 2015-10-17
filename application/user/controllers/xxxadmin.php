<?php

class admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		// 練習 CodeIgniter 後台
		// load helpers
		$this->load->helper('url');
		$data['title'] = "練習 CodeIgniter 後台";
		$this->load->view('admin/admin',$data);
	}

}