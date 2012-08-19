<?php
require_once("../../class/member_db_class.php");
session_start();
$table = $_POST["table"];
$inName=$_POST["id"];
$obj = new operationDb($conninfo);
	$result = mysql_query("SELECT * FROM ".TABLE_ADMIN." order by id")
	or die(mysql_error());

	if(isset($table) && isset($inName)){
	$obj->deleteDb($table,$inName);$res=1;
	jump("admin/edit/");
	}
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
		$q = mysql_query(sprintf("select * from ".TABLE_HISTORY." where contents_id = '%d'",$row['contents_id']));
		$goal_flag=mysql_fetch_assoc($q);
		
		echo"<tr><td>id:".$row['id']."</td><td>name:".$row['name']."</td><td>pass:".$row['pass']."</td><td>email:".$row['e_mail']."</td>";
		echo"<td><form method='post' action='mail.php'><input type='submit' value='メッセージを送信' name='mail_user'class='btn'>";
		echo"<input type='hidden' name='id' value='{$row['id']}'>";
		echo"</td>";
		echo"</form>";
		if(empty($goal_flag['goal'])):
			echo"<form action = './' method='post'><td>
			<input type='submit' value='履歴なし' disabled class='btn'/>
			</td>
			</tr>
			</form>";
		else:
			echo"<form action = 'db.php' method='post'><td>
			<input type='submit' value='履歴' class='btn'/>
			<input type='hidden' name='contents_id' value='{$row['contents_id']}'>
			</td>
			</tr>
			</form>";
		endif;
	}
	?>
		</table>
<form action="<?php echo $self ?>" method ="post">
	<label>削除するテーブル</label><input type="text" name="table" value="<?php  echo TABLE_ADMIN?>">
	<label>名前(id)</label><input type="text" name="id" value="">
	<input type='submit'value='データ削除' class='btn'>
</form>
<a href="../">←戻る</a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>