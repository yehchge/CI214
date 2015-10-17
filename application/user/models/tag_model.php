<?php

class tag_model extends CI_Model {
	
	function __construct() {
		$this->load->database();
	}
	
	/**
	* @desc 抓取單一標籤資料
	* @author Bill Yeh
	* @created 2012/09/20
	*/
	function get_tag_by_id($iTagId) {
		if (!$iTagId) {
			show_error('請帶入標籤序號!');
			exit;
		}
		
		$aRow = array();
		$iQuery = $this->db->where("id",$iTagId)->get('tbl_tag');
		if ($iQuery->num_rows() > 0) {
			$aRow = $iQuery->row_array();
		}
		return $aRow;
	}
	
	/** 
	* @desc 抓取標籤雲
	* @author Bill Yeh
	* @created 2012/09/19
	*/
	function get_tags_cloud() { //  設定font-size: 最小 8pt 最大 23pt
		$iMinFontSize = 8; // 單位: pt 最小字
		$iMaxFontSize = 23; // 單位: pt 最大字
		$iMaxFreq = 0; // 資料庫內最大 Frequency(頻繁)
		$iMinFreq = 0; // 資料庫內最小 Frequency
		
		// 抓取資料庫
		$iQuery = $this->db->get("tbl_tag");
		$aRows = $iQuery->result_array();
		foreach ($aRows as $key => $row) { // 找出最大值最小值
			if ($key==0) $iMinFreq = $row['frequency'];
			if ($iMaxFreq<$row['frequency']) $iMaxFreq = $row['frequency'];
			if ($iMinFreq>$row['frequency']) $iMinFreq = $row['frequency'];
		}
		
		$iSpread = $iMaxFreq - $iMinFreq; // 伸展
		if ($iSpread==0) $iSpread = 1;
		
		foreach ($aRows as $key => $row) { // 計算標籤字型大小
			$iSize = $iMinFontSize + ($row['frequency'] - $iMinFreq) * ($iMaxFontSize - $iMinFontSize) / $iSpread;
			$aRows[$key]['font_size'] = floor($iSize);
		}
		return $aRows;
	}
	
	/**
	* @desc 新增標籤
	* @author Bill Yeh
	* @created 2012/09/18
	*/
	function create_tag($aTags = array()) {
		if (!is_array($aTags)) {
			show_error('參數請帶入陣列');
			exit;
		}
		$aTags = array_unique($aTags); // 剔除重複
		foreach($aTags as $val) {
			if (!$val) continue;
			// 檢查標籤是否存在?
			$iQuery = $this->db
				->from('tbl_tag')
				->where('name', $val)
				->limit(1)
				->get();
			if ($iQuery->num_rows() > 0) { // 假如存在,  frequency + 1
				$aRow = $iQuery->row();
				$data = array('frequency' => $aRow->frequency+1);
				$this->db->where('id',$aRow->id)->update("tbl_tag", $data);
			} else { // 不存在, 新增 Tag
				$data = array(
					"name" => "$val",
					"frequency" => 1
				);
				$this->db->insert('tbl_tag',$data);
			}			
		}
		return TRUE;
	}
	
	/**
	* @desc 刪除標籤
	* @author Bill Yeh
	* @created 2012/09/18
	*/
	function delete_tag($aTags = array()) {
		if (!is_array($aTags)) {
			show_error('參數請帶入陣列');
			exit;
		}
		$aTags = array_unique($aTags); // 剔除重複
		foreach($aTags as $val) {
			// 檢查標籤是否存在?
			$iQuery = $this->db
				->from('tbl_tag')
				->where('name', $val)
				->limit(1)
				->get();
			if ($iQuery->num_rows() > 0) { // 假如存在, 判斷 frequency 值是否大於 1?
				$aRow = $iQuery->row();
				if ($aRow->frequency <=1) { // 假如小於等於 1, 刪除此 Tag
					$this->db
						->where('id', $aRow->id)
						->delete('tbl_tag');
				} else { // frequency - 1
					$data = array('frequency' => $aRow->frequency-1);
					$this->db->where('id',$aRow->id)->update("tbl_tag", $data);
				}
			}			
		}
		return TRUE;
	}
	
	/**
	* @desc 更新標籤
	* @author Bill Yeh
	* @created 2012/09/18
	*/
	function update_tag($aOldTag = array(),$aNewTag = array()) {
		$aOldTag = array_unique($aOldTag); // 剔除重複
		$aNewTag = array_unique($aNewTag); // 剔除重複
		
		$aAll = array();
		foreach ($aOldTag as $val) {
			if (!$val) continue;
			if (!isset($aAll["$val"])) $aAll["$val"] = -1;
			else $aAll["$val"] -= 1;
		}
		foreach ($aNewTag as $val2) {
			if (!$val2) continue;
			if (!isset($aAll["$val2"])) $aAll["$val2"] = 1;
			else $aAll["$val2"] +=1;
		}
		
		$sCreate = "";
		$sDelete = "";
		foreach($aAll as $key3 => $val3) {
			if ($val3==0) continue;
			if ($val3==-1) $sDelete .= $key3.",";
			if ($val3==1) $sCreate .= $key3.",";
		}
		if ($sCreate) {
			$sCreate = substr($sCreate,0,-1);
			$this->create_tag(explode(",",$sCreate));
		}
		if ($sDelete) {
			$sDelete = substr($sDelete,0,-1);
			$this->delete_tag(explode(",",$sDelete));
		}
	}
	
	/***
	*** Sample usage *** 設定, 最小 8pt 最大 23pt
	* $arr = Array('Actionscript' => 35, 'Adobe' => 22, 'Array' => 44, 'Background' => 43,
	* 'Blur' => 18, 'Canvas' => 33, 'Class' => 15, 'Color Palette' => 11, 'Crop' => 42,
	* 'Delimiter' => 13, 'Depth' => 34, 'Design' => 8, 'Encode' => 12, 'Encryption' => 30,
	* 'Extract' => 28, 'Filters' => 42);
	* echo getCloud($arr, 12, 36); 
	*/
	function getCloud( $data = array(), $minFontSize = 12, $maxFontSize = 30 ) {
		$minimumCount = min( array_values( $data ) );
		$maximumCount = max( array_values( $data ) );
		$spread = $maximumCount - $minimumCount;
		$cloudHTML = '';
		$cloudTags = array(); 

		$spread == 0 && $spread = 1; // 如果 spread==0, spread =1, 否則 spread=spread.

		foreach( $data as $tag => $count )
		{
			$size = $minFontSize + ( $count - $minimumCount )
				* ( $maxFontSize - $minFontSize ) / $spread;
			$cloudTags[] = '<a style="font-size: ' . floor( $size ) . 'px'
				. '" href="#" title="\'' . $tag .
				'\' returned a count of ' . $count . '">'
				. htmlspecialchars( stripslashes( $tag ) ) . '</a>';
		} 

		return join( "\n", $cloudTags ) . "\n";
	}

}

?>