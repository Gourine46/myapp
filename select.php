<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>Goal Planet</title>
	</head>
	<body>
		<h1>ここは <?php echo$_SESSION["name"] ?>さんのページです。</h1>
		
		<ul>
			<li><a href="./start.php">Goal Planetを使う</a></li>
			<li>履歴</li>
			<li>プロフィール編集</li>
		</ul>
	</body>
</html>
