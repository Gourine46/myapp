<?php
session_start();

if(isset($_SESSION["row"]['name']))$login_user_name = $_SESSION["row"]['name'];
elseif(isset($_SESSION['user']))$login_user_name = $_SESSION['user']['facebook_name'];
elseif(isset($_SESSION['twitter_user']['twitter_screen_name']))$login_user_name = $_SESSION['twitter_user']['twitter_screen_name'];
elseif(empty($_SESSION))jump('');


?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Goal Planet</title>
		<link href="../../css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
				<?php if(isset($_SESSION['user'])):?>
					<p><img src="<?php echo $_SESSION['user']['facebook_picture'];?>">
					<?php echo $login_user_name;?>のFacebookでログインしています</p>
				<?php elseif(isset($_SESSION['twitter_user'])):?>
					<p><img src="<?php echo $_SESSION['twitter_user']['twitter_profile_image_url'];?>">
					<?php echo $login_user_name;?>のTwitterでログインしています</p>
				<?php endif;?>
				<h1>ここは <?php echo $login_user_name;  ?>さんのページです。</h1>
		<ul>
			<li><a href="../2/">Goal Planetを使う</a></li>
			<li>履歴</li>
			<li>プロフィール編集</li>
			<li><a href="../logout.php">ログアウト</a></li>
		</ul>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
	</body>
</html>
