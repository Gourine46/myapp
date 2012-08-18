<?php
require_once("../../class/member_db_class.php");
session_start();
$table = $_POST["table"];
$inName=$_POST["id"];
$obj = new operationDb($conninfo);
$result = mysql_query("SELECT * FROM ".TABLE_ADMIN." order by id")
or die(mysql_error());
if($_SERVER["REQUEST_METHOD"] == "POST")$obj->deleteDb($table,$inName);$res=1;

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
		<h1>会員一覧</h1>
		<table class=" table table-striped table-bordered table-condensed">
	<?php while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
	echo"<tr><td>id:".$row['id']."</td><td>name:".$row['name']."</td><td>pass:".$row['pass']."</td><td>email:".$row['e_mail']."</td>";
	echo"<td><form method='post' action='mail.php'><input type='submit' value='メッセージを送信' name='mail_user'class='btn'>";
	echo"<input type='hidden' name='id' value='{$row['id']}'></td></form>";
	echo"<td><input type='submit' value='履歴' name='delete' class='btn'/></td></tr>";
	}
	?>
		</table>
<form action="<?php echo $self ?>" method ="post">
	<label>削除するテーブル</label><input type="text" name="table" value="<?php  echo TABLE_ADMIN?>">
	<label>名前(id)</label><input type="text" name="id" value="">
	<input type='submit'value='データ削除' class='btn'>
</form>
<a href="../admin">←戻る</a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>