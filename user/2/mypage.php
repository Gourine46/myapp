<?php require_once("../../class/db.class.php");
		session_start();
		$id = "kenta";//セッションで処理
		$user_id = 12345678; //セッションで処理
		$db = new ExpandDataBase();
		$content = $db->ReturnContents($user_id);
		$count = count($content);
?>

	<head>
		<title>
			Goal Planet
		</title>
		<Meta http-equiv="Content-Script-Type" content="text/javascript">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="../../css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<h1>Goal Planet</h1>
		<h3><?php echo $db->message;?></h3>
		<h3><a href="test.php">タスクを追加する</a></h3>
		<h3>現在残しているタスク一覧</h3>
		<ul>
		<form action="test2.php" method="post">
		<input type="submit" value="チェックした項目を削除">
		<?php if( $count > 0):?>
			<?php foreach($content as $val):?>
			<p><input type="checkbox" name="task[]" value="<?php echo $val['contents_id'] ?>"><?php echo $val['content']; ?></p>
			<?php endforeach; ?>
		<?php elseif($count == 0 ):?>
			<?php echo"現在タスクはありません。設定してください";　?>
		<?php endif;?>
		</form>
		</ul>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
	</body>
</html>