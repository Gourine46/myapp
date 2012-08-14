<?php
session_start();
if(empty($_SESSION['user'])){
	jump("");
}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>Goal Planet</title>
	</head>
	<body>
				<p><img src="<?php echo $_SESSION['user']['facebook_picture'];?>">
				<?php echo $_SESSION['user']['facebook_name'];?>のFacebookでログインしています</p>
				<h1>ここは <?php echo$_SESSION["name"] ?>さんのページです。</h1>
		<ul>
			<li><a href="./start.php">Goal Planetを使う</a></li>
			<li>履歴</li>
			<li>プロフィール編集</li>
			<li><a href="logout.php">ログアウト</a></li>
		</ul>
	</body>
</html>
