<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class about extends CI_Controller {
	
	function __construct() {
		session_start();
		parent::__construct();
	}
	
	function index() {
		$this->load->helper('url');
		$data['title'] = "About";
	
		$this->smarty->assign("title", $data['title']);
		$data['base_url'] = base_url();
		
		// Calling the convenience function view() that allows passing data
		$this->smarty->view( 'about.htm', $data );
	}
	
}

?>