<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		session_start();
		$this->load->helper('url');
		
		//if (isset($_SESSION['username'])) {
		$username = $this->input->cookie("username");
		if ($username!="") {
			redirect("/index/");
		}
	}
	
	function index() {
		// 載入需要元件
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->load->helper('url');
		
		// 設定表單欄位檢查
		$this->form_validation->set_rules('username', '帳號', 'required');
		$this->form_validation->set_rules('password', '密碼', 'required|callback_check_db');
		
		if ($this->form_validation->run() !== FALSE) {
			// validation passed.
			redirect('/index/');
		}		
		
		$data['title'] = "登入";
		$data['validation_errors'] = validation_errors();
		$data['form_string'] = form_open("/login/");
		$this->smarty->assign("title", $data['title']);
		$data['base_url'] = base_url();
		
		// Calling the convenience function view() that allows passing data
		$this->smarty->view( 'login.htm', $data );
	}
	
	/**
	* @desc 檢查資料庫中的密碼
	* @author Bill Yeh
	* @created 2012/09/12
	*/
	function check_db() {
		// 載入需要元件
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->load->model('login_model');
		
		// then validation passed. Get from the DB.
		$res = $this
				->login_model
				->verify_user(
					$this->input->post("username"),
					$this->input->post("password")
				);
				
		if ( $res !== false) {
			// person has an account
			//$_SESSION['username'] = $this->input->post("username");
			$duration=$this->input->post("rememberMe") ? 3600*24*30 : 0; // 30 days
			//$cookie = array(
			//	'name'   => 'The Cookie Name',
			//	'value'  => 'The Value',
			//	'expire' => '86500',
			//	'domain' => '.some-domain.com',
			//	'path'   => '/',
			//	'prefix' => 'myprefix_',
			//	'secure' => TRUE
			//);

			$this->input->set_cookie("username",$this->input->post("username"),$duration,'','/','');
			
			return true;
		}
		
		$this->form_validation->set_message("check_db","帳號或密碼錯誤!");
		return false;
	}
	
}

?>