<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?=$title ?></title>
</head>
<body>
	<h1>導引頁</h1>
	<div class="navigation">
	<?php
		// nav bar
		echo anchor('/', 'Home');
		echo (' | ');
		echo anchor('blog', 'Blog');
		echo (' | ');
		echo anchor('links', 'Links');
		echo (' | ');
		echo anchor('news', 'News');
		echo (' | ');
		echo anchor('student', 'Student');
		echo (' | ');
		echo anchor('pages/view', 'Pages');
		echo (' | ');
		echo anchor('yii', 'Yii');
		echo (' | ');
		echo anchor ('rest_server', 'Restful');
		echo (' | ');
		echo anchor('welcome', 'Default CodeIgniter Page');
	?>
	</div>
</body>
</html>	