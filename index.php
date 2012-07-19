<?php
require_once("member_db_class.php");
session_start();
$name=$_POST["name"];
$obj = new operationDb($conninfo);
$obj->arrayDb($name);
$outname = $obj->outname;
$outpass = $obj->outpass;

if(isset($_POST["login"])){
	if($_POST["name"] == $outname && $_POST["password"] == $outpass){
		if(empty($_POST["name"]) && empty($_POST["password"])){//両方が空のとき
			$error_message = "ユーザ名,パスワードが入力されていません";
		header("Location:./login.php");exit;
		}
		//nameとpassが照合できたとき
		$_SESSION["name"] = $_POST["name"];
		header("Location:select.php");//ユーザー画面にリダイレクト
		exit;
	}elseif($_POST["name"] == "kenken" && $_POST["password"] == "0302"){
		header("Location:admin.php");//管理者画面にリダイレクト
		exit;
	}else{
	$error_message = "ユーザ名,パスワードが間違っています";
	}
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Goal Planet</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    
   <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Goal Planet　α.ver</h1>
        <h2>目標×期限×記録=∞</h2>
        <h3>サインイン</h3>
        <div>
        	<form id = "button1" action = "login.php" method = "POST">
            <label>ID</label>
            <input type="text" name="name" value="">
            <label>パスワード</label>
            <input type="password" name="password" value="">
            <input type="submit" name="login" value="サインイン" class="btn">
        	</form>
        </div>
	  </div>
    
	  <div class="row">
        <div class="span4">
          <h2>サインアップ</h2>
           <p>このアプリを使うためにはサインインする必要があります。ここで登録した名前とパスワードでそのままサインインすることができます。</p>
          <p><a class="btn" href="./signin.php">サインアップ &raquo;</a></p>
        </div>
         <!--このアプリを使うためにはログインする必要があります。ここで登録した名前とパスワードでそのままサインインすることができます。-->
        <div class="span4">
          <h2>開発者</h2>
          <p>このアプリの開発者の簡単な紹介など.随時機能の拡張のお知らせなどもここでしていくので確認してみてください。</p>
          <p><a class="btn" href="#">開発者 &raquo;</a></p>
        </div>
	  	<!--このアプリの開発者の簡単な紹介など-->
	  	<div class="span4">
        <h2>問い合わせ</h2>
           <p>何かこのアプリに関する質問があればここから受け付けています。 アドバイスや要望なども待っています。</p>
          <p><a class="btn" href="#">問い合わせ &raquo;</a></p>
       </div> 
	  <!--何かこのアプリに関する質問があればここから受け付けています。-->
    <div id="footer">
     <p style="text-align:center;bottom:0:">&copy; Togatttti 2012　All Rights Reserved.</p>
    </div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>