<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class yii extends CI_Controller {
	
	function __construct() {
		session_start();
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('tag_model');
	}
	
	/**
	* @desc 首頁
	* @author Bill Yeh
	* @created 2012/09/11
	*/
	function index() {
		$this->load->helper('url');
		$data['title'] = "Blog";
		$this->smarty->assign("title", $data['title']);
		$data['base_url'] = base_url();
		
		// 分頁
		$this->load->library('pagination');
		$config['base_url'] = base_url()."index.php?c=index";
		$config['total_rows'] = $this->blog_model->get_active_blog_count();
		$config['per_page'] = 5;
		$config['full_tag_open'] = '<ul class="yiiPager">';
		$config['full_tag_close'] = '</ul>';
		$config['next_link'] = '下一頁';
		$config['prev_link'] = '上一頁';
		$config['first_link'] = '第一頁';
		$config['last_link'] = '最後一頁';
		$config['cur_tag_open'] = '<li class="page selected"><a href="javascript:void(0)">'; // 目前頁面
		$config['cur_tag_close'] = '</a></li> ';
		$config['num_tag_open'] = '<li class="page">'; // 分頁數字
		$config['num_tag_close'] = '</li> '; // 分頁數字
		$config['prev_tag_open'] = '<li class="page">'; // 上一頁
		$config['prev_tag_close'] = '</li> '; // 上一頁
		$config['next_tag_open'] = '<li class="page">'; // 下一頁
		$config['next_tag_close'] = '</li> '; // 下一頁
		$config['first_tag_open'] = '<li class="page">'; // 第一頁
		$config['first_tag_close'] = '</li> '; // 第一頁
		$config['last_tag_open'] = '<li class="page">'; // 最後一頁
		$config['last_tag_close'] = '</li> '; // 最後一頁
		$config['display_pages'] = TRUE; // 是否顯示頁數
		$config['num_links'] = 4;
		$config['uri_segment'] = 2;
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;

		$this->pagination->initialize($config);
		$data['page_string'] = $this->pagination->create_links();
		$now_page = $this->input->get('per_page');
		$data['blogs'] = $this->blog_model->get_active_blog(FALSE,$config['per_page'],$now_page);
		
		// 需要批准的評論筆數
		$iApprove = 0;
		$iApprove = $this->blog_model->get_approve_comments_count();
		$data['approve_count'] = $iApprove;
		
		// 抓取最近的評論
		$data['recent'] = $this->blog_model->get_recent_comments();
		
		// 抓取標籤
		$data['tagData'] = $this->tag_model->get_tags_cloud();
		
		// Calling the convenience function view() that allows passing data
		$this->smarty->view( 'index.htm', $data );
	}
	
	/**
	* @desc 顯示一則文章
	* @author Bill Yeh
	* @created 2012/09/11
	*/
	function post() {
		//if (empty($this->uri->segment(3))) {
		//	show_404();
		//}
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->load->helper('url');
		
		$this->form_validation->set_rules('author', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('content', 'Comment', 'required');
		if ($this->form_validation->run() !== FALSE) {
			$this->blog_model->create_comment(); // 新增評論
			redirect('/index/', 'refresh');
			exit;
		}
		
		$data['validation_errors'] = validation_errors();
		$data['blogs'] = $this->blog_model->get_blog($this->uri->segment(3));
		
		//$data['blogs']['content'] = stripslashes($data['blogs']['content']);
		$data['blogs']['content'] = nl2br($data['blogs']['content']);
		
		$data['title'] = $data['blogs']['title'];
		$data['base_url'] = base_url();
		$data['form_string'] = form_open("/index/post/".$this->uri->segment(3));
		$dataField = array(
			  'post_id'  => $this->uri->segment(3)
			);
		$data['form_hidden'] = form_hidden($dataField);
		
		// 評論
		$data['commrows'] = $this->blog_model->get_blog_comments($this->uri->segment(3));
		foreach ($data['commrows'] as $key => $row) {
			$data['commrows'][$key]['content'] = nl2br($row['content']);
		}
		// 需要批准的評論筆數
		$iApprove = 0;
		$iApprove = $this->blog_model->get_approve_comments_count();
		$data['approve_count'] = $iApprove;
		
		// 抓取最近的評論
		$data['recent'] = $this->blog_model->get_recent_comments();
		
		// 抓取標籤
		$data['tagData'] = $this->tag_model->get_tags_cloud();

		// Calling the convenience function view() that allows passing data
		$this->smarty->view( 'post.htm', $data );
	}
	
}

?>