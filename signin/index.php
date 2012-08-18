<?php
require_once("../class/member_db_class.php");
require_once("../class/mail_user_class.php");
$name = $_POST["name"];
$pass = $_POST["pass"];
$e_mail = $_POST["e_mail"];
$error_message　= "名前,パスワード,e_mailアドレスの記入を完了させてください";
$err = 0;
if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(empty($pass)):$err = 1;	
	elseif(preg_match("/^[a-zA-Z0-9]+$/", $name) === false　|| empty($name)):$err = 1; 	
	elseif(preg_match("/^[a-zA-Z0-9]+$/", $e_mail)  === false　|| empty($e_mail)):$err = 1;	
	endif;

	if(isset($name) && isset($pass) && isset($e_mail) && $err == 0){
		$contents_id = get_contents_id();
		$obj=new operationDb($conninfo);
		$obj->saveIdPassDb($contents_id,$name,$pass,$e_mail);
		$result = "登録完了しました。<a href='index.php'>トップ画面からログインしてください</a>";
		$res=true;
		/*データを取り出して、メールテンプレートにのせて、mailuserを起動して終わり。*/
		$obj = new operationDb($conninfo);
		$obj->serachElement(TABLE_ADMIN,$name);
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
		<div style="color:red;"><?php if($err == 1) echo $error_message; ?></div>
		<form action="<?php echo$self; ?>"  method="post">
			<p <?php if($err == 1)echo "style='color:red;'"?>><label>ID※(半角英数字でお願いします)</label><input type="text" name="name" value="<?php echo @$name; ?>"></p>
			<p <?php if($err == 1)echo "style='color:red;'"?>><label>パスワード</label><input type="password" name="pass" value="<?php echo @$pass;?>"><p/>
			<p <?php if($err == 1)echo "style='color:red;'"?>><label>パスワード(確認のためもう一度記入してください)</label><input type="password" name="pass2"></p>
			<p <?php if($err == 1)echo "style='color:red;'"?>><label>e_mail</label><input type="text" name="e_mail" value="<?php echo @$e_mail;?>"></p>
			<input type="submit" name="conf" value="登録完了" class="btn">
		</form>
		<a href="../">←戻る</a>
		</div>
		<div style="color:red;"><?php echo $result;?></div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	</body>
</html>