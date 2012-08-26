<?php
require_once("class/db.class.php");
session_start();
$db = new ExpandDataBase();
$result = $db->LogInNormal($_POST['name'],$_POST['password']);
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(is_array($result)){
			$_SESSION["row"] = $result;
			jump("user/1/");
		}
		elseif($result == "admin"){
			jump("admin/");
		}
		elseif($result == "error"){
			$error_message= "ID,パスワードに適切なデータが入力されていません";
		}
	}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <META NAME="keywords" CONTENT="GoalPlanet,goalplanet,todo,Todo,togattti,togashi">
    <title>Goal Planet</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/screen" type="text/css">
</head>
<body>
    <div class="container">
   <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Goal Planet　α.ver</h1>
        	<div>
        		<h3>Facebookでサインイン</h3>
        		<a href="facebook/redirect.php"><img src="img/Facebook.png" alt="Facebookでログイン"></a>
        	</div>
        	<div>
        		<h3>Twitterでサインイン</h3>
        		<a href="twitter/twitter_redirect.php"><img src="img/Twitter.png" alt="Twitterでログイン"></a>
        	</div>
        <div>
        	<form id = "button1" action = "index.php" method = "POST">
            <label>ID</label>
            <input type="text" name="name" value="">
            <label>パスワード</label>
            <input type="password" name="password" value="">
            <input type="submit" name="login" value="サインイン" class="btn">
        	</form>
        	<div style= "color:red;"><?php echo $error_message;?></div>
        </div>
	  </div>
	  <div class="span12">
	  <div id="loopslider">
			<ul>
			<li><a href="#"><img src="img/photo01.jpg" width="100" height="100" alt="" /></a></li>
			<li><a href="#"><img src="img/photo02.jpg" width="100" height="100" alt="" /></a></li>
			<li><a href="#"><img src="img/photo03.jpg" width="100" height="100" alt="" /></a></li>
			<li><a href="#"><img src="img/photo04.jpg" width="100" height="100" alt="" /></a></li>
			<li><a href="#"><img src="img/photo05.jpg" width="100" height="100" alt="" /></a></li>
			<li><a href="#"><img src="img/photo06.jpg" width="100" height="100" alt="" /></a></li>
			<li><a href="#"><img src="img/photo07.jpg" width="100" height="100" alt="" /></a></li>
			<li><a href="#"><img src="img/photo08.jpg" width="100" height="100" alt="" /></a></li>
			<li><a href="#"><img src="img/photo09.jpg" width="100" height="100" alt="" /></a></li>
			<li><a href="#"><img src="img/photo10.jpg" width="100" height="100" alt="" /></a></li>
			</ul>
		</div><!--/#loopslider-->
	  </div><!--/.span12-->
	  <div class="row">
        <div class="span4">
          <h2>サインアップ</h2>
           <p>このアプリを使うためにはサインインする必要があります。ここで登録した名前とパスワードでそのままサインインすることができます。</p>
          <p><a class="btn" href="signin/">サインアップ &raquo;</a></p>
        </div>
         <div class="span4">
          <h2>開発者</h2>
          <p>このアプリの開発者の簡単な紹介など.随時機能の拡張のお知らせなどもここでしていくので確認してみてください。</p>
          <p><a class="btn" href="me/">開発者 &raquo;</a></p>
        </div>
	  	<div class="span4">
        <h2>問い合わせ</h2>
           <p>何かこのアプリに関する質問があればここから受け付けています。 アドバイスや要望なども待っています。</p>
          <p><a class="btn" href="https://twitter.com/togattti">問い合わせ &raquo;</a></p>
       </div> 
    <div id="footer">
     <p style="text-align:center;bottom:0:">&copy; Togatttti 2012　All Rights Reserved.</p>
    </div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>