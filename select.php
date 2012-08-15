<?php
session_start();
if(empty($_SESSION['user'])&&empty($_SESSION['name'])){
	jump("");
}
$login_user = (!empty($_SESSION['user']))?$_SESSION['user']['facebook_name']:$_SESSION["name"];
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Goal Planet</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
				<?php if(isset($_SESSION['user'])):?>
				<p><img src="<?php echo $_SESSION['user']['facebook_picture'];?>">
				<?php echo $_SESSION['user']['facebook_name'];?>のFacebookでログインしています</p>
				<?php endif;?>
				<h1>ここは <?php echo $login_user;  ?>さんのページです。</h1>
		<ul>
			<li><a href="./start.php">Goal Planetを使う</a></li>
			<li>履歴</li>
			<li>プロフィール編集</li>
			<li><a href="logout.php">ログアウト</a></li>
		</ul>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>
