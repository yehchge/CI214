<?php

class blog_model extends CI_Model {
	
	function __construct() {
		$this->load->database();
	}
	
	/**
	* @desc 抓取登入者 ID
	* @author Bill Yeh
	* @created 2012/09/18
	*/
	function iGetUserId() {
		// 檢查是否登入, 沒有即回首頁.
		$username = $this->input->cookie("username");
		if ($username=="") return 0;
		
		$iUserId = 0;
		$iQuery = $this->db->select('id')->from('tbl_user')->like('username', $username)->limit(1)->get();
		if ($iQuery->num_rows() > 0) {
			$row2 = $iQuery->row_array(); 
			$iUserId = $row2['id'];
		}
		return $iUserId;
	}

	
	/**
	* @desc 抓取所有狀態的 post 資料
	* @author Bill Yeh
	* @created 2012/09/13
	*/
	function get_blog($id = FALSE) {
		if ($id === FALSE) {
			$this->db->order_by("id", "DESC"); 
			$query = $this->db->get("tbl_post");
			$aRows = $query->result_array();
			foreach ($aRows as $key => $row) {
				$this
					->db
					->select('username')
					->from('tbl_user')
					->where('id', $row['author_id'])
					->limit(1);
				$query2 = $this->db->get();
				if ($query2->num_rows() > 0) {
					$row2 = $query2->row_array(); 
					$aRows[$key]['username'] = $row2['username'];
				} else {
					$aRows[$key]['username'] = "";
				}
				$aRows[$key]['content'] = $row['content'];
				
				$aTagRows = explode(",",$row['tags']);
				$aTag = array();
				foreach($aTagRows as $val2) {
					$query = $this->db
						->where('name', $val2)
						->get("tbl_tag");
					$aRow2 = $query->row_array();	
					$aTag[] = $aRow2;
				}
				$aRows[$key]['tag_arr'] = $aTag;
			}
			return $aRows;
		}
		
		$aRow = array();
		$query = $this->db->get_where("tbl_post", array("id" => $id));
		$aRow = $query->row_array();
		$this->db->select('username')->from('tbl_user')->where('id', $aRow['author_id'])->limit(1);
		$query2 = $this->db->get();
		if ($query2->num_rows() > 0) {
			$row2 = $query2->row_array(); 
			$aRow['username'] = $row2['username'];
		} else {
			$aRow['username'] = "";
		}
		
		$aTagRows = explode(",",$aRow['tags']);
		$aTag = array();
		foreach($aTagRows as $val2) {
			$query = $this->db
				->where('name', $val2)
				->get("tbl_tag");
			$aRow2 = $query->row_array();	
			$aTag[] = $aRow2;
		}
		$aRow['tag_arr'] = $aTag;
				
		// 抓取評論數量
		$aRow['comments'] = $this->db->from("tbl_comment")->where("status",2)->where("post_id",$aRow['id'])->count_all_results();;

		return $aRow;
	}
	
	
	/**
	* @desc 計算有效狀態的 Comments 資料總筆數
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function get_approve_comments_count() {
		$this->db->from('tbl_comment')->where('status',1);
		return $this->db->count_all_results();
	}
	
	/**
	* @desc 需要批准的評論資料 Comments 資料總筆數
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function get_approve_comments_all_count() {
		$this->db->from('tbl_comment');
		return $this->db->count_all_results();
	}
	
	/**
	* @desc 需要批准的評論資料(分頁資料)
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function get_approve_comments($iPageItems,$iStart) {
		date_default_timezone_set("Asia/Taipei"); // 設定時區
		$this->db->order_by('status', 'ASC');
		$this->db->order_by('id', 'DESC');
		$this->db->limit($iPageItems,$iStart);
		$query = $this->db->get("tbl_comment");
		$aRows = $query->result_array();

		foreach ($aRows as $key => $row) {
			$query2 = $this
				->db
				->select('title')
				->from('tbl_post')
				->where('id', $row['post_id'])
				->get();
			if ($query2->num_rows() > 0) {
				$row2 = $query2->row_array(); 
				$aRows[$key]['title'] = $row2['title'];
			} else {
				$aRows[$key]['title'] = "";
			}
			$aRows[$key]['content'] = nl2br($row['content']);
		}
		return $aRows;
	}
	
	/**
	* @desc 計算有效狀態的 post 資料總筆數
	* @author Bill Yeh
	* @created 2012/09/14
	*/
	function get_active_blog_count() {
		$this->db->from('tbl_post')->where('status',2);
		return $this->db->count_all_results();
	}
	
	/**
	* @desc 計算有效狀態的 post 資料總筆數(Tag)
	* @author Bill Yeh
	* @created 2012/09/20
	*/
	function getActiveBlogCountByTag($sName) {
		$this->db->from('tbl_post')->like('tags',$sName)->where('status',2);
		return $this->db->count_all_results();
	}
	
	
	/**
	* @desc 抓取部落格評論
	* @author Bill Yeh
	* @created 2012/09/14
	*/
	function get_blog_comments($post_id) {
		date_default_timezone_set("Asia/Taipei"); // 設定時區
		$this->db->order_by("id", "DESC");
		$this->db->where("post_id",$post_id);
		$this->db->where("status",2);
		$query = $this->db->get("tbl_comment");
		$aRows = $query->result_array();
		return $aRows;
	}
	
	/**
	* @desc 抓取有效狀態的 post 資料
	* @author Bill Yeh
	* @created 2012/09/13
	*/
	function get_active_blog($id = FALSE,$iPageItems,$iStart) {
		if ($id === FALSE) {
			$this->db->order_by("id", "DESC"); 
			$query = $this->db
				->where('status', 2)
				->limit($iPageItems,$iStart)
				->get("tbl_post");
			$aRows = $query->result_array();
			foreach ($aRows as $key => $row) {
				$this->db
					->select('username')
					->from('tbl_user')
					->where('id', $row['author_id'])
					->limit(1);
				$query2 = $this->db->get();
				if ($query2->num_rows() > 0) {
					$row2 = $query2->row_array(); 
					$aRows[$key]['username'] = $row2['username'];
				} else {
					$aRows[$key]['username'] = "";
				}
				$aRows[$key]['content'] = nl2br($row['content']);
				$aTagRows = explode(",",$row['tags']);
				$aTag = array();
				foreach($aTagRows as $val2) {
					$query = $this->db
						->where('name', $val2)
						->get("tbl_tag");
					$aRow2 = $query->row_array();	
					$aTag[] = $aRow2;
				}
				$aRows[$key]['tag_arr'] = $aTag;
				
				// 抓取評論數量
				$aRows[$key]['comments'] = $this->db->from("tbl_comment")->where("status",2)->where("post_id",$row['id'])->count_all_results();;
			}
			return $aRows;
		}
		
		$aRow = array();
		$query = $this->db->get_where("tbl_post", array("id" => $id));
		$aRow = $query->row_array();
		$this->db->select('username')->from('tbl_user')->where('id', $aRow['author_id'])->limit(1);
		$query2 = $this->db->get();
		if ($query2->num_rows() > 0) {
			$row2 = $query2->row_array(); 
			$aRow['username'] = $row2['username'];
		} else {
			$aRow['username'] = "";
		}
		$aRow['content'] = nl2br($aRow['content']);
		$aRow['tag_arr'] = explode(",",$aRow['tags']);
		
		// 抓取評論數量
		$aRow['comments'] = $this->db->from("tbl_comment")->where("status",2)->where("post_id",$aRow['id'])->count_all_results();;

		return $aRow;
	}
	
	/**
	* @desc 抓取有效狀態的 post 資料(Tag)
	* @author Bill Yeh
	* @created 2012/09/20
	*/
	function getActiveBlogByTag($sName, $iPageItems, $iStart) {
		$query = $this->db
			->where('status', 2)
			->like('tags',$sName)
			->limit($iPageItems,$iStart)
			->order_by("id", "DESC")
			->get("tbl_post");
		$aRows = $query->result_array();
		foreach ($aRows as $key => $row) {
			$this
				->db
				->select('username')
				->from('tbl_user')
				->where('id', $row['author_id'])
				->limit(1);
			$query2 = $this->db->get();
			if ($query2->num_rows() > 0) {
				$row2 = $query2->row_array(); 
				$aRows[$key]['username'] = $row2['username'];
			} else {
				$aRows[$key]['username'] = "";
			}
			$aRows[$key]['content'] = nl2br($row['content']);
			
			$aTagRows = explode(",",$row['tags']);
			$aTag = array();
			foreach($aTagRows as $val2) {
				$query = $this->db
					->where('name', $val2)
					->get("tbl_tag");
				$aRow2 = $query->row_array();	
				$aTag[] = $aRow2;
			}
			$aRows[$key]['tag_arr'] = $aTag;
			
			// 抓取評論數量
			$aRows[$key]['comments'] = $this->db->from("tbl_comment")->where("status",2)->where("post_id",$row['id'])->count_all_results();;
		}
		return $aRows;
	}
	
	/*
	* @desc 新增回覆
	* @author Bill Yeh
	* @created 2012/09/12
	*/
	function create_comment() {
		$this->load->helper('url');
		
		//$slug = url_title($this->input->post('title'), 'dasg', TRUE);
		
		$data = array(
			'content' => $this->input->post('content'),
			'status' => 1,
			'create_time' => time(),
			'author' => $this->input->post('author'),
			'email' => $this->input->post('email'),
			'url' => $this->input->post('url'),
			'post_id' => $this->input->post('post_id'),
		);
		
		return $this->db->insert('tbl_comment',$data);
	}
	
	/**
	* @dsec 新增文章
	* @author Bill Yeh
	* @created 2012/09/12
	*/
	function create_blog($aData = array()) {
		// 檢查傳入資料是否正確.
		$aNewData = array();
		$aParamIndex = array (
			"title" => true,
			"content" => true,
			"tags" => true,
			"status" => true,
			"author_id" => true
		);
	
		foreach($aData AS $key => $value) {
			if ($aParamIndex[strtolower($key)]) {
				$aNewData[strtolower($key)] = trim($value);
				unset($aParamIndex[strtolower($key)]);
			}
		}

		if (count($aParamIndex) > 0) {
			show_error("不足以下欄位：".implode(" , " , array_keys($aParamIndex)));
			return FALSE;
		}
		
		date_default_timezone_set("Asia/Taipei"); // 設定時區
		$sCreated = date( "Y-m-d H:i:s" );
		
		$data = array(
			'title' => $aNewData['title'],
			'content' => stripslashes($aNewData['content']),
			'tags' => $aNewData['tags'],
			'status' => $aNewData['status'],
			'create_time' => time(),
			'update_time' => time(),
			'author_id' => $aNewData['author_id']
		);

		return $this->db->insert('tbl_post',$data);
	}
	
	/**
	* @desc 顯示管理文章
	* @author Bill Yeh
	* @created 2012/09/12
	*/
	function admin_blog() {
		date_default_timezone_set("Asia/Taipei"); // 設定時區
		$this->db->order_by("id", "DESC"); 
		$query = $this->db->get("tbl_post");
		$aRows = $query->result_array();
		foreach ($aRows as $key => $row) {
			$aRows[$key]['content'] = nl2br($row['content']);
		}
		return $aRows;
	}
	
	/**
	* @desc 計算管理文章總筆數
	* @author Bill Yeh
	* @created 2012/09/13
	*/
	function get_admin_blog_count() {
		$this->db->from('tbl_post');
		return $this->db->count_all_results();
	}
	
	/**
	* @desc 顯示管理文章(分頁資料)
	* @author Bill Yeh
	* @created 2012/09/13
	*/
	function get_admin_blog($iPageItems,$iStart,$sSort,$sOrder) {
		date_default_timezone_set("Asia/Taipei"); // 設定時區
		$this->db->order_by($sSort, $sOrder);
		$this->db->limit($iPageItems,$iStart);
		$query = $this->db->get("tbl_post");
		$aRows = $query->result_array();

		foreach ($aRows as $key => $row) {
			$aRows[$key]['content'] = nl2br($row['content']);
		}
		return $aRows;
	}

	/**
	* @dsec 更新文章
	* @author Bill Yeh
	* @created 2012/09/13
	*/
	function update_blog($aData = array()) {
		// 檢查傳入資料是否正確.
		$aNewData = array();
		$aParamIndex = array (
			"title" => true,
			"content" => true,
			"tags" => true,
			"status" => true,
			"author_id" => true,
			"post_id" => true
		);
	
		foreach($aData AS $key => $value) {
			if ($aParamIndex[strtolower($key)]) {
				$aNewData[strtolower($key)] = trim($value);
				unset($aParamIndex[strtolower($key)]);
			}
		}

		if (count($aParamIndex) > 0) {
			show_error("不足以下欄位：".implode(" , " , array_keys($aParamIndex)));
			return FALSE;
		}
		
		date_default_timezone_set("Asia/Taipei"); // 設定時區
		$sCreated = date( "Y-m-d H:i:s" );
		
		$data = array(
			'title' => $aNewData['title'],
			'content' => $aNewData['content'],
			'tags' => $aNewData['tags'],
			'status' => $aNewData['status'],
			'create_time' => time(),
			'update_time' => time(),
			'author_id' => $aNewData['author_id']
		);
		
		return $this->db->where("id",$aNewData['post_id'])->update('tbl_post',$data);
	}
	
	/**
	* @desc 批准評論
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function approve_comment($id) {
		$this->load->helper('url');
		
		$username = $this->input->cookie("username");

		if ($username=="") {
			redirect("/index/");
		}
		
		date_default_timezone_set("Asia/Taipei"); // 設定時區
		
		$data = array(
			'status' => 2
		);
		
		$this->db->where("id",$id);
		return $this->db->update('tbl_comment',$data);
	}	
	
	/**
	* @desc 刪除評論
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function delete_comment($id) {
		$this->load->helper('url');
		
		$username = $this->input->cookie("username");

		if ($username=="") {
			redirect("/index/");
		}
		
		date_default_timezone_set("Asia/Taipei"); // 設定時區
		
		$this->db->where("id",$id);
		return $this->db->delete('tbl_comment');
	}

	/**
	* @dsec 刪除文章
	* @author Bill Yeh
	* @created 2012/09/14
	*/
	function delete_blog($id) {
		if (!$id) {
			show_error("請傳入序號!");
			return FALSE;
		}
		
		$this->db->where("id", $id);
		return $this->db->delete('tbl_post');
	}

	/**
	* @desc 抓取所有 comment 資料
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function get_comment($id = FALSE) {
		if ($id === FALSE) {
			$this->db->order_by("id", "DESC"); 
			$query = $this->db->get("tbl_comment");
			$aRows = $query->result_array();
			return $aRows;
		}
		
		$aRow = array();
		$query = $this->db->get_where("tbl_comment", array("id" => $id));
		$aRow = $query->row_array();
		
		return $aRow;
	}
	
	/**
	* @dsec 更新評論
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function update_comment() {
		$this->load->helper('url');
		
		$username = $this->input->cookie("username");

		if ($username=="") {
			redirect("/index/");
		}
		
		date_default_timezone_set("Asia/Taipei"); // 設定時區
		
		$data = array(
			'content' => $this->input->post('content'),
			'author' => $this->input->post('author'),
			'email' => $this->input->post('email'),
			'url' => $this->input->post('url')
		);
		
		$this->db->where("id",$this->uri->segment(3));
		return $this->db->update('tbl_comment',$data);
	}
	
	/**
	* @desc 抓取最近的評論
	* @author Bill Yeh
	* @created 2012/09/17
	*/
	function get_recent_comments() {
		$this->load->helper('url');
		
		date_default_timezone_set("Asia/Taipei"); // 設定時區
		
		$this->db->limit(10);
		$this->db->order_by("id", "DESC");
		$this->db->where("status",2);
		$query = $this->db->get("tbl_comment");
		$aRows = $query->result_array();
		foreach ($aRows as $key => $row) {
			$query2 = $this
				->db
				->select('title')
				->from('tbl_post')
				->where('id', $row['post_id'])
				->get();
			if ($query2->num_rows() > 0) {
				$row2 = $query2->row_array(); 
				$aRows[$key]['title'] = $row2['title'];
			} else {
				$aRows[$key]['title'] = "";
			}
		}
		return $aRows;

	}
	
}

?>