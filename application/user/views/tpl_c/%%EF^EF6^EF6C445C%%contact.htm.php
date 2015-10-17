<?php /* Smarty version 2.6.26, created on 2012-09-20 14:48:20
         compiled from contact.htm */ ?>
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
		<li class="active"><a href="<?php echo $this->_tpl_vars['base_url']; ?>
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
	  <a href="index">首頁</a> &raquo; <span>聯絡</span>
	</div>
	
	<div class="container">
	  <div id="content">
		<h1>聯絡我們</h1>
		<p>如果你有業務諮詢或其他問題，請填寫下面的表單與我們聯繫。謝謝。</p>
		<div class="form">
		  <?php echo $this->_tpl_vars['form_string']; ?>

			<p class="note">欄位有 <span class="required">*</span> 為必填。</p>
			<div class="errorMessage"><?php echo $this->_tpl_vars['validation_errors']; ?>
</div>
			<div class="row">
			  <label for="author" class="required">姓名 <span class="required">*</span></label>
			  <input name="author" id="author" type="text" />
			</div>

			<div class="row">
			  <label for="email" class="required">Email <span class="required">*</span></label>
			  <input name="email" id="email" type="text" />
			</div>

			<div class="row">
			  <label for="subject" class="required">主旨 <span class="required">*</span></label>
			  <input size="60" maxlength="128" name="subject" id="subject" type="text" />
			</div>

			<div class="row">
			  <label for="content_name" class="required">內文 <span class="required">*</span></label>
			  <textarea rows="6" cols="50" name="content" id="content_name"></textarea>
			</div>

			<div class="row">
			  <label for="verifyCode">驗證碼</label>
			  <div>
				<img id="yw1" src="<?php echo $this->_tpl_vars['base_url']; ?>
index.php/captcha" alt="" />
				<input name="verifyCode" id="verifyCode" type="text" />
			  </div>
			  <div class="hint">請輸入圖片所示的字母。
				<br/>字母不區分大小寫。
			  </div>
			</div>
	
			<div class="row submit">
			  <input type="submit" name="sb" value="送出" />	
			</div>
		  </form>
		</div><!-- form -->
		
	  </div>
	</div>
	
	<div id="footer">Copyright &copy; 2012 - All Rights Reserved. - Powered by <a target="_BLANK" href="http://www.codeigniter.org.tw">CodeIgniter</a></div>
  </div><!-- page -->

<script type="text/javascript">

var surl = '<?php echo $this->_tpl_vars['base_url']; ?>
'+'index.php/captcha';
<?php echo ' 
/*<![CDATA[*/
jQuery(function($) {
	jQuery(\'#yw1\').after("<a id=yw1_button href=\'javascript:void(0);\'>取得新的驗證碼<\\/a>");
	$(document).on(\'click\', \'#yw1_button\', function(){
		var ts = new Date().getTime();
		$(\'#yw1\').attr(\'src\',surl+\'?v=\'+ts);
		
		//$.ajax({
		//	url: surl,
		//	dataType: \'text\',
		//	cache: false,
		//	success: function(data) {
		//		$(\'#yw1\').attr(\'src\', data[\'url\']);
		//	}
		//});
		//return false;
	});

});
/*]]>*/
'; ?>

</script>

</body>
</html>