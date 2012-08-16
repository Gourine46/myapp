<?php
require_once("../class/member_db_class.php"); 
require_once("../class/mail_user_class.php"); 
$uid = $_POST['id'];
$obj = new operationDb($conninfo);
$obj->serachElement(TABLE_ADMIN, $uid);

$e_mail = $_POST["e_mail"];
$subject = $_POST["subject"];
$message = $_POST["message"];
$mail = new MailUse();
if(isset($e_mail) && isset($subject) && isset($message)){
$mail->mailUser($e_mail,$subject,$message);
$res = 1;
}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			ユーザーへメール送信
		</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	<?php if($res !== 1):?>
		<div>
		<h1>メールフォーム</h1>
	<form action=" <?php echo $self;?>"  method ="post">
		<label>id</label><input type="text" name="table" value="<?php echo $obj->row['id']; ?>">
		<label>ユーザid</label><input type="text" name="name" value="<?php echo $obj->row['name']; ?>">
		<label>メールアドレス</label><input type="text" name="e_mail" value="<?php echo $obj->row['e_mail']; ?>">
		<label>タイトル</label><input type="text" name="subject" value="登録完了しました!!">
		<label>メッセージ</label>
		<textarea name="message" cols=40 rows=4><?php echo $mail->mes1;?>
		id:<?php echo $obj->row['name']; ?>  pass:<?php echo $obj->row['pass'];?></textarea>
		<input type="submit" value="送信" class="btn"><?php echo $res;?>
	</form>
		<a href="edit.php">←戻る</a>
		</div>
	<?php else:?>
		<div>メールを送信しました。<a href="edit.php">会員情報管理画面へ戻る</a></div>
	<?php endif;?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>