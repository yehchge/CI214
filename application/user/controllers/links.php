<?php

class Links extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}
	
	function index() {
		$this->load->model('links_model');
		$links['links'] = $this->links_model->get_links();
		$data = array(
			'title'=>'Test Application',
			'current_page'=>'Welcome',
			'navigation'=>$this->load->view('navigation/nav_main','',true),
			'content'=>$this->load->view('content/link_list',$links,true)
		);
		$this->load->view('layout/main',$data);
	}

}