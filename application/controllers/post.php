<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post extends CI_Controller {
	
	function __construct() {
		session_start();
		parent::__construct();
		$this->load->model('blog_model');
	}
	
	/**
	* @desc 文章管理
	* @author Bill Yeh
	* @created 2012/09/11
	*/
	function index() {
		show_404();
	}
	
	/**
	* @desc 新增文章
	* @author Bill Yeh
	* @created 2012/09/12
	*/
	function create() {
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library("form_validation");
		
		// 檢查是否登入, 沒有即回首頁.
		$username = $this->input->cookie("username");
		if ($username=="") redirect("/index/");
		
		$this->form_validation->set_rules('title', '標題', 'required');
		$this->form_validation->set_rules('content', '內文', 'required');
		$this->form_validation->set_rules('status', '狀態', 'required');
		
		$iUserId = $this->blog_model->iGetUserId();
		if (!$iUserId) show_404("您尚未登入!");
		
		if ($this->form_validation->run() !== FALSE) {
			$data = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'tags' => $this->input->post('tags'),
				'status' => $this->input->post('status'),
				'author_id' => $iUserId
			);
			$sTags = trim($this->input->post('tags'));
			if ($sTags) {
				$this->load->model('tag_model');
				$this->tag_model->create_tag(explode(",",$sTags)); // 新增標籤
			}
			$this->blog_model->create_blog($data); // 新增文章
			$insert_id = $this->db->insert_id();
			redirect('/index/post/'.$insert_id, 'refresh');
			exit;
		}
		
		$data['validation_errors'] = validation_errors();
		$data['base_url'] = base_url();
		$data['form_string'] = form_open("/post/create");
		
		// 需要批准的評論筆數
		$iApprove = 0;
		$iApprove = $this->blog_model->get_approve_comments_count();
		$data['approve_count'] = $iApprove;
		
		// 抓取最近的評論
		$data['recent'] = $this->blog_model->get_recent_comments();
		
		// Calling the convenience function view() that allows passing data
		$this->smarty->view( 'create.htm', $data );
	}
	
	/**
	* @desc 更新文章
	* @author Bill Yeh
	* @created 2012/09/13
	*/
	function update() {
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library("form_validation");
		
		// 檢查是否登入, 沒有即回首頁.
		$username = $this->input->cookie("username");
		if ($username=="") redirect("/index/");
		
		$this->form_validation->set_rules('title', '標題', 'required');
		$this->form_validation->set_rules('content', '內文', 'required');
		$this->form_validation->set_rules('status', '狀態', 'required');
		
		$iUserId = $this->blog_model->iGetUserId();
		if (!$iUserId) show_404("您尚未登入!");
		
		if ($this->form_validation->run() !== FALSE) {
			$data = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'tags' => $this->input->post('tags'),
				'status' => $this->input->post('status'),
				'author_id' => $iUserId,
				'post_id' => $this->input->post('post_id')
			);
			
			$iBlogId = $this->input->post('post_id');
			
			// 先抓取此筆資料
			$aRow = $this->blog_model->get_blog($iBlogId);
			
			$sOldTag = trim($aRow['tags']);
			$sNewTag = trim($this->input->post('tags'));
			$this->load->model('tag_model');
			$this->tag_model->update_tag(explode(",",$sOldTag),explode(",",$sNewTag)); // 更新標籤
			
			$this->blog_model->update_blog($data); // 更新文章
			redirect('/index/post/'.$this->input->post('post_id'), 'refresh');
			exit;
		}
		
		$data['blog'] = $this->blog_model->get_blog($this->uri->segment(3));
		
		$javascript_action = " 
			<SCRIPT language=javascript>\n
			ChangeSelectByValue('status',".$data['blog']['status'].");
			</SCRIPT>";
		
		$data['editJs'] = $javascript_action;
		$data['validation_errors'] = validation_errors();
		
		$data['blog']['content'] = stripslashes($data['blog']['content']);
		$data['base_url'] = base_url();
		$data['form_string'] = form_open("/post/update/".$this->uri->segment(3));
		$dataField = array(
			'post_id'  => $this->uri->segment(3)
		);
		$data['form_hidden'] = form_hidden($dataField);
		
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
		$this->smarty->view( 'update.htm', $data );
	}
	
	/**
	* @desc 刪除文章
	* @author Bill Yeh
	* @created 2012/09/14
	*/
	function delete() {
		$this->load->helper('url');
		
		$iBlogId = $this->uri->segment(3);
		
		// 先抓取此筆資料
		$aRow = $this->blog_model->get_blog($iBlogId);
		
		$sTags = trim($aRow['tags']);
	
		if ($sTags) {
			$this->load->model('tag_model');
			$this->tag_model->delete_tag(explode(",",$sTags)); // 刪除標籤
		}
			
		$this->blog_model->delete_blog($iBlogId); // 刪除文章
		redirect('/post/admin/'.$this->uri->segment(5)."/".$this->uri->segment(6)."/".$this->uri->segment(4), 'refresh');
	}
	
	/**
	* @desc 管理文章
	* @author Bill Yeh
	* @created 2012/09/12
	*/
	function admin() {
		$this->load->helper('url');
		//$data['blogs'] = $this->blog_model->admin_blog();
		$data['base_url'] = base_url();
		
		// 排序
		$sort = $this->uri->segment(3);
		if (in_array(strtolower($sort), array('title','create_time','status'))) {
			$sort = strtolower($sort);
		} else $sort = "id";
		
		$order = $this->uri->segment(4);
		if (in_array(strtolower($order), array('asc','desc'))) {
			$order = strtolower($order);
		} else $order = "asc";
		
		$data[$sort] = $order;
		$data['now_sort'] = $sort;
		$data['now_order'] = $order;
		
		// 目前分頁
		$now_page = $this->uri->segment(5);
		
		// 分頁
		$this->load->library('pagination');
		$config['base_url'] = base_url()."index.php/post/admin/$sort/$order";
		$config['total_rows'] = $this->blog_model->get_admin_blog_count();
		$config['per_page'] = 10;
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
		$config['display_pages'] = true; // 是否顯示頁數
		$config['num_links'] = 4;
		$config['uri_segment'] = 5;
		

		$data['total_count'] = $config['total_rows'];
		$data['before_count'] = $now_page;
		$data['now_first'] = $now_page+1;
		$data['now_last'] = (($now_page+$config['per_page'])>=$data['total_count'])?$data['total_count']:($now_page+$config['per_page']);
		if (($now_page+$config['per_page'])>=$data['total_count']) {
			$data['before_count'] = (($data['total_count']-$now_page)>1)?$now_page:($now_page-$config['per_page']);
			if ($data['total_count']==0) $data['now_first']=0;
		}
		
		$data['blogs'] = $this->blog_model->get_admin_blog($config['per_page'],$now_page,$sort,$order);
		
		$this->pagination->initialize($config);
		$data['page_string'] = $this->pagination->create_links();
		
		$data['order'] = (strtolower($order)=="asc")?"desc":"asc";

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
		$this->smarty->view( 'admin.htm', $data );
	}
	
}

?>