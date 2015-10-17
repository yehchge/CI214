<?php /* Smarty version 2.6.26, created on 2012-09-20 21:27:09
         compiled from admin.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin.htm', 54, false),array('modifier', 'date_format', 'admin.htm', 83, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo $this->_tpl_vars['title']; ?>
</title>
  <!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['base_url']; ?>
/application/views/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['base_url']; ?>
/application/views/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['base_url']; ?>
/application/views/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['base_url']; ?>
/application/views/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['base_url']; ?>
/application/views/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['base_url']; ?>
/application/views/css/styles.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['base_url']; ?>
/application/views/css/pager.css" />
</head>
<body>
  <div class="container" id="page">
    <div id="header"><!-- 網站名稱 -->
	  <div id="logo">部落格展示</div>
	</div>
	
	<div id="mainmenu">
	  <ul>
		<li><a href="<?php echo $this->_tpl_vars['base_url']; ?>
">首頁</a></li>
		<li><a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/about">關於</a></li>
		<li><a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/contact">聯絡</a></li>
		<li>
		  <?php if ($_COOKIE['username']): ?>
			<a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/logout">登出(<?php echo $_COOKIE['username']; ?>
)</a>
		  <?php else: ?>
			<a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/login">登入</a>
		  <?php endif; ?>	
		</li>
	  </ul>	
	</div><!-- mainmenu -->
	
	<div class="breadcrumbs">
	   <a href="<?php echo $this->_tpl_vars['base_url']; ?>
">首頁</a> &raquo; <span>管理文章</span>
	</div><!-- breadcrumbs -->
	
	<div class="container">
	  <div class="span-18">
	    <div id="content">
		  <h1>管理文章</h1>
		  
		  <div id="yw0" class="grid-view">
		  
			<div class="summary">顯示 <?php echo $this->_tpl_vars['now_first']; ?>
-<?php echo $this->_tpl_vars['now_last']; ?>
 共 <?php echo $this->_tpl_vars['total_count']; ?>
 筆.</div>
			
			<table class="items">
			  <thead>
			  <tr>
				<th id="yw0_c0"><a class="sort-link <?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/post/admin/title/<?php echo $this->_tpl_vars['order']; ?>
/<?php echo $this->_tpl_vars['before_count']; ?>
">標題</a></th>
				<th id="yw0_c1"><a class="sort-link <?php echo ((is_array($_tmp=$this->_tpl_vars['status'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/post/admin/status/<?php echo $this->_tpl_vars['order']; ?>
/<?php echo $this->_tpl_vars['before_count']; ?>
">狀態</a></th>
				<th id="yw0_c2"><a class="sort-link <?php echo ((is_array($_tmp=$this->_tpl_vars['create_time'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/post/admin/create_time/<?php echo $this->_tpl_vars['order']; ?>
/<?php echo $this->_tpl_vars['before_count']; ?>
">建立日期</a></th>
				<th id="yw0_c3" class="button-column">&nbsp;</th>
			  </tr>
			  <tr class="filters">
				<td><input name="Post[title]" type="text" maxlength="128" /></td>
				<td><select name="Post[status]">
					  <option value=""></option>
					  <option value="1">草稿</option>
					  <option value="2">發佈</option>
					  <option value="3">存檔</option>
					</select>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  </thead>
			  <tbody>
			  <?php $_from = $this->_tpl_vars['blogs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['entry']):
        $this->_foreach['foo']['iteration']++;
?>
			  <tr class="<?php if (($this->_foreach['foo']['iteration']-1) % 2 == 0): ?> even <?php else: ?>odd <?php endif; ?>">
				<td><a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/index/post/<?php echo $this->_tpl_vars['entry']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
				<td>
				  <?php if ($this->_tpl_vars['entry']['status'] == 1): ?>草稿
				  <?php elseif ($this->_tpl_vars['entry']['status'] == 2): ?>發佈
				  <?php elseif ($this->_tpl_vars['entry']['status'] == 3): ?>存檔
				  <?php else: ?>-
				  <?php endif; ?>
				</td>
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['create_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y/%m/%d %I:%M:%S %p") : smarty_modifier_date_format($_tmp, "%Y/%m/%d %I:%M:%S %p")); ?>
</td>
				<td class="button-column">
				  <a class="view" title="View" href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/index/post/<?php echo $this->_tpl_vars['entry']['id']; ?>
"><img border=0 src="<?php echo $this->_tpl_vars['base_url']; ?>
/application/views/css/view.png" alt="View" /></a> 
				  <a class="update" title="Update" href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/post/update/<?php echo $this->_tpl_vars['entry']['id']; ?>
"><img border=0 src="<?php echo $this->_tpl_vars['base_url']; ?>
/application/views/css/update.png" alt="Update" /></a>  
				  <a class="delete" title="Delete" href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/post/delete/<?php echo $this->_tpl_vars['entry']['id']; ?>
/<?php echo $this->_tpl_vars['before_count']; ?>
/<?php echo $this->_tpl_vars['now_sort']; ?>
/<?php echo $this->_tpl_vars['now_order']; ?>
" onClick="return confirm('你確定要刪除這筆資料嗎?');"><img border=0 src="<?php echo $this->_tpl_vars['base_url']; ?>
/application/views/css/delete.png" alt="Delete" /></a>
				</td>
			  </tr>
			  <?php endforeach; endif; unset($_from); ?>
			  
			  </tbody>
			</table>
			
			<!-- 分頁 開始 -->
			<div class="pager">選擇頁面：<?php echo $this->_tpl_vars['page_string']; ?>
</div>
			<!-- 分頁 結束 -->
			
		  </div>				  
			
		</div><!-- content -->
	  </div>
	  
		<div class="span-6 last">
		  <div id="sidebar"><!-- sidebar -->
		  
			<?php if ($_COOKIE['username']): ?>
			<div class="portlet" id="yw2">
			  <div class="portlet-decoration">
				<div class="portlet-title"><?php echo $_COOKIE['username']; ?>
</div>
			  </div>
			  <div class="portlet-content">
				<ul>
				  <li><a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/post/create">建立新文章</a></li>
				  <li><a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/post/admin">管理文章</a></li>
				  <li><a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/comment">需要批准的評論</a> (<?php echo ((is_array($_tmp=$this->_tpl_vars['approve_count'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)</li>
				  <li><a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/logout">登出</a></li>
				</ul>
			  </div>
			</div>
			<?php endif; ?>
		  
			<div class="portlet">
			  <div class="portlet-decoration">
				<div class="portlet-title">標籤</div>
			  </div>
			  <div class="portlet-content">
				<?php $_from = $this->_tpl_vars['tagData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo4'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo4']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['entry4']):
        $this->_foreach['foo4']['iteration']++;
?>
				<span class="tag" style="font-size:<?php echo $this->_tpl_vars['entry4']['font_size']; ?>
pt"><a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/posts/index/<?php echo ((is_array($_tmp=$this->_tpl_vars['entry4']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['entry4']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></span>
				<?php endforeach; endif; unset($_from); ?>
			  </div>
			</div>
			
			<div class="portlet" id="yw3">
			  <div class="portlet-decoration">
				<div class="portlet-title">最近的評論</div>
			  </div>
			  <div class="portlet-content">
				<ul>
				  <?php $_from = $this->_tpl_vars['recent']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['entry2']):
        $this->_foreach['foo2']['iteration']++;
?>
				  <li><?php echo ((is_array($_tmp=$this->_tpl_vars['entry2']['author'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 on <a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/index/post/<?php echo ((is_array($_tmp=$this->_tpl_vars['entry2']['post_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
#c<?php echo ((is_array($_tmp=$this->_tpl_vars['entry2']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['entry2']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></li>
				  <?php endforeach; endif; unset($_from); ?>
				</ul>
			  </div>
			</div>
			
		  </div><!-- sidebar -->
		</div>
	</div>
	
	<div id="footer">Copyright &copy; 2012 - All Rights Reserved. - Powered by <a target="_BLANK" href="http://www.codeigniter.org.tw">CodeIgniter</a></div><!-- footer -->
  </div><!-- page -->
</body>
</html>