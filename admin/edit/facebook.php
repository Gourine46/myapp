<?php
require_once("../../class/db.class.php");
session_start();
$obj = new operationDb($conninfo);
	$result = mysql_query("SELECT * FROM ".TABLE_FACEBOOK." order by id")
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
		<h1>会員一覧(facebookユーザー)</h1>
		<h2><a href="./">←戻る</a></h2>
		<table class=" table table-striped table-bordered table-condensed">
		<th>id</th><th>name</th><th>email</th><th>created</th><th>status</th>
	<?php while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
		//---------------------------//履歴があるかないか
		$q = mysql_query(sprintf("select * from ".TABLE_HISTORY." where user_id = '%d'",$row['facebook_user_id']));//facebookはuser_idにfacebook_user_idを入れなければ行けない
		$content_flag=mysql_fetch_assoc($q);
		//---------------------------//
		echo"<tr><td>".$row['id']."</td><td>".$row['facebook_name']."</td><td>".$row['facebook_email']."</td><td>".$row['created']."</td>";
		echo"<input type='hidden' name='user_id' value='{$row['facebook_user_id']}'>";
		echo"</td>";
		if(empty($content_flag['content'])):
			echo"<form action = './' method='post'><td>
			<input type='submit' value='履歴なし' disabled class='btn'/>
			</td>
			</tr>
			</form>";
		else:
			echo"<form action = 'db.php' method='post'><td>
			<input type='submit' value='履歴' class='btn'/>
			<input type='hidden' name='user_id' value='{$row['facebook_user_id']}'>
			</td>
			</tr>
			</form>";
		endif;
	}
	?>
		</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>