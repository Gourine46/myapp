<?php
require_once("../class/db.class.php");
require_once("../class/error_check.class.php");
session_start();
$obj = new ErrorCheck();
$error_check = $obj->SignInErrorCheck($_POST['name'],$_POST['pass'],$_POST['pass2'],$_POST['e_mail']);
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if($error_check === false)
	{
		$error_message = $obj->error_message;
	}
	elseif($error_check === true)
	{
		$db=new ExpandDataBase();
		$db->saveIdPassDb($_POST['name'],$_POST['pass'],$_POST['e_mail']);
		jump("");
	}
}//REQUEST _METHOD
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<title>サインアップ</title>
	</head>
	<body>
		<h1>サインアップ</h1>
		<div style="color:red;"><?php echo $error_message;?></div>
		<form action="<?php echo$self; ?>"  method="post">
			<p><label>ID※(半角英数字でお願いします)</label><input type="text" name="name" value="<?php echo @$_POST['name']; ?>"></p>
			<p><label>パスワード</label><input type="password" name="pass" value=""><p/>
			<p><label>パスワード(確認のためもう一度記入してください)</label><input type="password" name="pass2"></p>
			<p><label>e_mail</label><input type="text" name="e_mail" value="<?php echo @$_POST['e_mail'];?>"></p>
			<input type="submit" name="conf" value="登録完了" class="btn">
		</form>
		<a href="../">←戻る</a>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	</body>
</html>