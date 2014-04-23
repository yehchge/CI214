<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class posts extends CI_Controller {
	
	function __construct() {
		session_start();
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('tag_model');
	}
	
	/**
	* @desc 顯示某一標籤文章
	* @author Bill Yeh
	* @created 2012/09/20
	*/
	function index() {
		$this->load->helper('url');
		$data['title'] = "Blog";
		$this->smarty->assign("title", $data['title']);
		$data['base_url'] = base_url();
		
		$iTagId = $this->uri->segment(3);
		
		// 抓取 Tag 資料
		$aTagRow = $this->tag_model->get_tag_by_id($iTagId);
		$data['tag_name'] = $aTagRow['name'];
		
		$now_page = $this->uri->segment(4);
		
		// 分頁
		$this->load->library('pagination');
		$config['base_url'] = base_url()."index.php/posts/index/".$iTagId;
		$config['total_rows'] = $this->blog_model->getActiveBlogCountByTag($aTagRow['name']);
		$config['per_page'] = 5;
		$config['full_tag_open'] = '<ul class="yiiPager"><div class="pager">選擇頁面：';
		$config['full_tag_close'] = '</div></ul>';
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
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);
		$data['page_string'] = $this->pagination->create_links();
		$data['blogs'] = $this->blog_model->getActiveBlogByTag($aTagRow['name'],$config['per_page'],$now_page);
		
		// 需要批准的評論筆數
		$iApprove = 0;
		$iApprove = $this->blog_model->get_approve_comments_count();
		$data['approve_count'] = $iApprove;
		
		// 抓取最近的評論
		$data['recent'] = $this->blog_model->get_recent_comments();
		
		// 抓取標籤
		$data['tagData'] = $this->tag_model->get_tags_cloud();
		
		// Calling the convenience function view() that allows passing data
		$this->smarty->view( 'posts.htm', $data );
	}

}

?>