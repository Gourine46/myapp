<?php
require_once("../class/member_db_class.php");
require_once("../class/error_check.class.php");
require_once("../class/mail_user_class.php");//後でファイル着くってそこにリダイレクト処理させる。
$obj = new ErrorCheck();
$error_check = $obj->SignInErrorCheck($_POST['name'],$_POST['pass'],$_POST['pass2'],$_POST['e_mail']);
$error_message = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if($error_check === false)
	{
		$error_message = $obj->error_message;
	}
	elseif($error_check === true)
	{
		$contents_id = get_contents_id();
		$db=new ExpandDataBase();
		$db->saveIdPassDb($contents_id,$_POST['name'],$_POST['pass'],$_POST['e_mail']);
		$result = "登録完了しました。<a href='../'>トップ画面からログインしてください</a>";
		$res=true;
		$db = new ExpandDataBase();
		$db->serachElement(TABLE_ADMIN,$_POST['name']);
		$mail = new MailUse();
	if($mail == 1){
		$mail->mailUser($obj->row["e_mail"],$mail->subject,$mail->mes1);
	}
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
		<div <?php if($res) echo"style='display:none;'";?>>
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
		</div><!--ここまで消えるぞ！ -->
		<div style="color:red;"><?php echo $result;?></div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	</body>
</html>