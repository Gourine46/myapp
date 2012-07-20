<?php
require_once("class/member_db_class.php");
require_once("class/mail_user_class.php");
$name = $_POST["name"];
$pass = $_POST["pass"];
$e_mail = $_POST["e_mail"];
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($name) || empty($pass)){
	echo"名前とパスワード,もしくは両方入力されていません";
}else{
$obj=new operationDb($conninfo);
$inname=$obj->format($name);
$inpass=$obj->format($pass);
$in_e_mail=$obj->format($e_mail);
$obj->saveIdPassDb($inname,$inpass,$in_e_mail);
$result = "登録完了しました。<a href='index.php'>トップ画面からログインしてください</a>";
$res=true;
/*データを取り出して、メールテンプレートにのせて、mailuserを起動して終わり。*/
$obj = new operationDb($conninfo);
$obj->serachElement(TABLE_ADMIN,$inname);
$mail = new MailUserClass();
if($mail == 1){
$mail->mailUser($obj->row["e_mail"],$mail->subject,$mail->mes1);
}
}
}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="start.css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<title>サインアップ</title>
	</head>
	<body>
		<div <?php if($res) echo"style='display:none;'";?>>
		<h1>サインアップ</h1>
		<form action="<?php echo$self; ?>"  method="post">
			<p><label>名前</label><input type="text" name="name" value=""></p>
			<p><label>パスワード</label><input type="password" name="pass" value=""><p/>
			<p><label>パスワード(確認のためもう一度記入してください)</label><input type="password" name="pass2"></p>
			<p><label>e_mail</label><input type="text" name="e_mail"></p>
			<input type="submit" name="conf" value="登録完了" class="btn">
		</form>
		<a href="./login.php">←戻る</a>
		</div>
		<div><?php echo $result;?></div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>