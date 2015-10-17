<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logout extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		session_start();
	}
	
	function index() {
		$this->load->helper('url');
		session_destroy();
		$duration= 3600*24*30; // 30 days
		$this->input->set_cookie("username",'',time()-$duration,'','/','');
		redirect("/index/");
	}
	
}

?>