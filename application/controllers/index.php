<?php

class index extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		// 練習 CodeIgniter 的前導頁
		// load helpers
		$this->load->helper('url');
		$data['title'] = "練習 CodeIgniter 前導頁";
		$this->load->view('index',$data);
	}

}