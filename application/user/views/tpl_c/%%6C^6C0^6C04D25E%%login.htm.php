<?php /* Smarty version 2.6.26, created on 2012-09-20 14:38:16
         compiled from login.htm */ ?>
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
	
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	
	
</head>
<body>
  <div class="container" id="page">
    <div id="header"><!-- 網站名稱 -->
	  <div id="logo">部落格展示</div>
	</div>
	
	<div id="mainmenu"><!-- 選單 -->
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
	</div>
	
	<div class="breadcrumbs"><!-- 麵包屑 -->
	  <a href="index">首頁</a> &raquo; <span>登入</span>
	</div>
	
	<div class="container">
	  <div id="content">
		<h1>登入</h1>
		<p>你的登入認證，請填寫下面的表單：</p>
		<div class="form">
		  <?php echo $this->_tpl_vars['form_string']; ?>

		    <p class="note">欄位有 <span class="required">*</span> 為必填。</p>
			<div class="errorMessage"><?php echo $this->_tpl_vars['validation_errors']; ?>
</div>
			<div class="row">
			  <label for="username" class="required">帳號 <span class="required">*</span></label>
			  <input name="username" id="username" type="text" />
			</div>

			<div class="row">
			  <label for="password" class="required">密碼 <span class="required">*</span></label>
			  <input name="password" id="password" type="password" />
			  <p class="hint">提示：你也許可以輸入 <tt>demo/demo</tt>.</p>
			</div>

			<div class="row rememberMe">
			  <input id="rememberMe" type="hidden" value="0" name="rememberMe" />
			  <input name="rememberMe" id="rememberMe" value="1" type="checkbox" />
			  <label for="rememberMe">下次記住我</label>
			</div>

			<div class="row submit">
			  <input type="submit" name="yt0" value="登入" />
			</div>

		  </form>
		</div><!-- form -->
		
	  </div>
	</div>
	
	<div id="footer">Copyright &copy; 2012 - All Rights Reserved. - Powered by <a target="_BLANK" href="http://www.codeigniter.org.tw">CodeIgniter</a></div>
  </div><!-- page -->
</body>
</html>