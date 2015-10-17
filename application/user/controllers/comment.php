<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comment extends CI_Controller {
	
	function __construct() {
		session_start();
		parent::__construct();
		$this->load->model('blog_model');
	}
	
	/**
	* @desc 需要批准的評論
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function index() {
		$this->load->helper('url');
		$data['title'] = "評論";
		$this->smarty->assign("title", $data['title']);
		$data['base_url'] = base_url();
		
		// 目前分頁
		$now_page = $this->uri->segment(3);
		//$now_page = $this->input->get('per_page');
		
		// 分頁
		$this->load->library('pagination');
		$config['base_url'] = base_url()."index.php/comment/index";
		$config['total_rows'] = $this->blog_model->get_approve_comments_all_count();
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
		$config['uri_segment'] = 3;
		$config['page_query_string'] = FALSE;
		$config['enable_query_strings'] = FALSE;
		
		$data['total_count'] = $config['total_rows'];
		$data['before_count'] = $now_page;
		$data['now_first'] = $now_page+1;
		$data['now_last'] = (($now_page+$config['per_page'])>=$data['total_count'])?$data['total_count']:($now_page+$config['per_page']);
		if (($now_page+$config['per_page'])>=$data['total_count']) {
			$data['before_count'] = (($data['total_count']-$now_page)>1)?$now_page:($now_page-$config['per_page']);
			if ($data['total_count']==0) $data['now_first']=0;
		}
		
		$data['commrows'] = $this->blog_model->get_approve_comments($config['per_page'],$now_page);

		foreach ($data['commrows'] as $key => $row) {
			$data['commrows'][$key]['content'] = stripslashes($row['content']);
		}
		
		$this->pagination->initialize($config);
		$data['page_string'] = $this->pagination->create_links();
		
		// 需要批准的評論筆數
		$iApprove = 0;
		$iApprove = $this->blog_model->get_approve_comments_count();
		$data['approve_count'] = $iApprove;
		
		// 抓取最近的評論
		$data['recent'] = $this->blog_model->get_recent_comments();
		
		// 抓取標籤
		$this->load->model('tag_model');
		$data['tagData'] = $this->tag_model->get_tags_cloud();

		// Calling the convenience function view() that allows passing data
		$this->smarty->view( 'comment.htm', $data );
	}
	
	/**
	* @desc 批准評論
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function approve() {
		$this->load->helper('url');
		$this->blog_model->approve_comment($this->uri->segment(3));
		redirect('/comment', 'refresh');
	}
	
	/**
	* @desc 刪除評論
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function delete() {
		$this->load->helper('url');
		$this->blog_model->delete_comment($this->uri->segment(3));
		redirect('/comment', 'refresh');
	}
	
	/**
	* @desc 更新評論
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function update() {
		$this->load->helper('form');
		$this->load->library("form_validation");
		$this->load->helper('url');
		
		$this->form_validation->set_rules('author', '姓名', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('content', '內文', 'required');
		
		if ($this->form_validation->run() !== FALSE) {
			$this->blog_model->update_comment();
			redirect('/comment', 'refresh');
			exit;
		}
		
		$data['blog'] = $this->blog_model->get_comment($this->uri->segment(3));
		
		$javascript_action = "
			<SCRIPT language=javascript>\n
			ChangeSelectByValue('status',".$data['blog']['status'].");
			</SCRIPT>";
		
		$data['editJs'] = $javascript_action;
		$data['validation_errors'] = validation_errors();
		
		$data['blog']['content'] = stripslashes($data['blog']['content']);
		$data['base_url'] = base_url();
		$data['form_string'] = form_open("/comment/update/".$this->uri->segment(3));
		//$dataField = array('post_id' => $this->uri->segment(3));
		//$data['form_hidden'] = form_hidden($dataField);
		
		// 需要批准的評論筆數
		$iApprove = 0;
		$iApprove = $this->blog_model->get_approve_comments_count();
		$data['approve_count'] = $iApprove;
		
		// 抓取最近的評論
		$data['recent'] = $this->blog_model->get_recent_comments();
		
		// 抓取標籤
		$this->load->model('tag_model');
		$data['tagData'] = $this->tag_model->get_tags_cloud();
		
		// Calling the convenience function view() that allows passing data
		$this->smarty->view( 'update_comment.htm', $data );
	}
	
}

?>