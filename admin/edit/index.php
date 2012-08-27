<?php
require_once("../../class/db.class.php");
session_start();
$obj = new operationDb($conninfo);
	$result = mysql_query("SELECT * FROM ".TABLE_ADMIN." order by id")
	or die(mysql_error());
?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			会員確認画面
		</title>
		<link href="../../css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<h1>会員一覧(一般ログイン)</h1>
		<h2><a href="twitter.php">Twitterユーザー</a></h2>
		<h2><a href="facebook.php">facebookユーザー</a></h2>
		<table class=" table table-striped table-bordered table-condensed">
		<?php echo"<th>id</th><th>name</th><th>pass</th><th>email</th><th>///</th><th>history</th>"; ?>
	<?php while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
		$q = mysql_query(sprintf("select * from ".TABLE_HISTORY." where user_id = '%d'",$row['user_id']));
		$content_flag=mysql_fetch_assoc($q);
		echo"<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['pass']."</td><td>".$row['e_mail']."</td>";
		echo"<td><form method='post' action='mail.php'><input type='submit' value='メッセージを送信' name='mail_user'class='btn'>";
		echo"<input type='hidden' name='id' value='{$row['id']}'>";
		echo"</td>";
		echo"</form>";
		if(empty($content_flag['user_id']))://user_idの数＝コンテンツの数になる/それが無ければ履歴がない
			echo"<form action = './' method='post'><td>
			<input type='submit' value='履歴なし' disabled class='btn'/>
			</td>
			</tr>
			</form>";
		else:
			echo"<form action = 'db.php' method='post'><td>
			<input type='submit' value='履歴' class='btn'/>
			<input type='hidden' name='user_id' value='{$row['user_id']}'>
			</td>
			</tr>
			</form>";
		endif;
	}
	?>
		</table>
<a href="../">←戻る</a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>