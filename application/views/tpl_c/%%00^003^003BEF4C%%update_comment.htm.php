<?php /* Smarty version 2.6.26, created on 2012-09-20 21:27:39
         compiled from update_comment.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'update_comment.htm', 53, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
	<script>
	<?php echo '
	function ChangeSelectByValue(ddlID, value) {
		var ddl = document.getElementById(ddlID);
		for (var i = 0; i < ddl.options.length; i++) {
			if (ddl.options[i].value == value) {
				if (ddl.selectedIndex != i) {
					ddl.selectedIndex = i;
				}
				break;
			}
		}
	}
	'; ?>

	</script>
	
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
">首頁</a> &raquo; <a href="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/comment">評論</a> &raquo; <span>更新評論 #<?php echo ((is_array($_tmp=$this->_tpl_vars['blog']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</span>
	</div><!-- breadcrumbs -->
	
	<div class="container">
	  <div class="span-18">
	    <div id="content">
		  <h1>更新評論 #<?php echo ((is_array($_tmp=$this->_tpl_vars['blog']['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</h1>
		  
			<div class="form">
			  <?php echo $this->_tpl_vars['form_string']; ?>

				<p class="note">欄位有 <span class="required">*</span> 為必填。</p>
				<div class="errorMessage"><?php echo $this->_tpl_vars['validation_errors']; ?>
</div>
				<div class="row">
				  <label for="author" class="required">姓名 <span class="required">*</span></label>
				  <input size="80" maxlength="128" name="author" id="author" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['blog']['author'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
				</div>
				
				<div class="row">
				  <label for="email" class="required">Email <span class="required">*</span></label>
				  <input size="80" maxlength="128" name="email" id="email" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['blog']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
				</div>

				<div class="row">
				  <label for="url" class="required">網站</label>
				  <input size="80" maxlength="128" name="url" id="url" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['blog']['url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
				</div>

				<div class="row">
				  <label for="content_name" class="required">內文 <span class="required">*</span></label>
				  <textarea rows="10" cols="70" name="content" id="content_name"><?php echo $this->_tpl_vars['blog']['content']; ?>
</textarea>
				</div>

				<div class="row buttons">
				  <input type="submit" name="yt0" value="更新" />
				</div>

			  </form>
			</div><!-- form -->
		  
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
<?php echo $this->_tpl_vars['editJs']; ?>

</html>