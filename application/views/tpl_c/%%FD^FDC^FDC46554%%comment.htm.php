<?php /* Smarty version 2.6.26, created on 2012-09-20 21:27:07
         compiled from comment.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'comment.htm', 55, false),array('modifier', 'date_format', 'comment.htm', 67, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo $this->_tpl_vars['title']; ?>
 - Blog Demo</title>

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
	</div><!-- header -->

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
">首頁</a> &raquo; <span><?php echo $this->_tpl_vars['title']; ?>
</span>
	</div><!-- breadcrumbs -->

	<div class="container">
	  <div class="span-18">
		<div id="content">
		  <h1>評論</h1>

			<div id="yw0" class="list-view">
			  <div class="summary">顯示 <?php echo $this->_tpl_vars['now_first']; ?>
-<?php echo $this->_tpl_vars['now_last']; ?>
 共 <?php echo $this->_tpl_vars['total_count']; ?>
 筆.</div>
			  <div class="items">
				<?php $_from = $this->_tpl_vars['commrows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['entry']):
        $this->_foreach['foo']['iteration']++;
?> 
				<div class="comment" id="c<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
				  <a class="cid" title="Permalink to this comment">#<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a>
				  <div class="author"><?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['author'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 在
					<a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/index/post/<?php echo $this->_tpl_vars['entry']['post_id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a> 文章上面說：
				  </div>
  				  <div class="time">
				    <?php if ($this->_tpl_vars['entry']['status'] == 1): ?>
					<span class="pending">待審核</span> |
					<a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/comment/approve/<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" id="yt0">批准</a> |
					<?php endif; ?>
					<a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/comment/update/<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">更新</a> |
					<a class="delete" href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/comment/delete/<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onClick="return confirm('你確定要刪除 #<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 這筆資料嗎?');">刪除</a> |
					<?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['create_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %e, %Y") : smarty_modifier_date_format($_tmp, "%B %e, %Y")); ?>
 at <?php echo ((is_array($_tmp=$this->_tpl_vars['entry']['create_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>

				  </div>
				  <div class="content"><?php echo $this->_tpl_vars['entry']['content']; ?>
</div>
				</div><!-- comment -->
				<?php endforeach; endif; unset($_from); ?>
			  </div>

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
			
			<div class="portlet">
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