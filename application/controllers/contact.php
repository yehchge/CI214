<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact extends CI_Controller {
	
	function __construct() {
		session_start();
		parent::__construct();
	}
	
	function index() {
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library("form_validation");
		
		$this->form_validation->set_rules('author', '姓名', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('subject', '主旨', 'required');
		$this->form_validation->set_rules('content', '內文', 'required');
		$this->form_validation->set_rules('verifyCode', '認證碼', 'required|callback_check_authcode');
		
		if ($this->form_validation->run() !== FALSE) {
			//show_error("處理寄信程式");
			$this->load->library('email');
			
			$this->email->from($this->input->post('email'),$this->input->post('author'));
			$this->email->to('yehchge@gmail.com');
			$this->email->subject($this->input->post('subject'));
			$this->email->message($this->input->post('content'));
			
			$this->email->send();
			
			echo $this->email->print_debugger();
			exit;
		}
		
		$data['title'] = "Contact";
		$data['validation_errors'] = validation_errors();
	
		$this->smarty->assign("title", $data['title']);
		$data['base_url'] = base_url();
		
		$data['form_string'] = form_open("/contact");
		
		// Calling the convenience function view() that allows passing data
		$this->smarty->view( 'contact.htm', $data );

	}
	
	/**
	* @desc 檢測驗證碼是否正確?
	* @author Bill Yeh
	* @created 2012/09/20
	*/
	function check_authcode() {
		// 載入需要元件
		$this->load->helper('form');
		$this->load->library("form_validation");
		
		if (!isset($_SESSION)) session_start(); // 開啟 session
		
		if ($_SESSION['captcha']==$this->input->post('verifyCode')) {
			return true;
		}

		$this->form_validation->set_message("check_authcode","認證碼錯誤!");
		return false;	
	}
	
	
}

?>