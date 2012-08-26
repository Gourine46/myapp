<?php require_once("../../class/db.class.php");
		session_start();
		$id = "kenta";//セッションで処理
		$contents_id = 12345678; //セッションで処理
		$db = new ExpandDataBase();
		$content = $db->ReturnContents($id,$contents_id);
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
		<h3>現在残しているタスク一覧</h3>
		<ul>
		<?php ?>
		<?php foreach($content as $val):?>
		<p><input type="checkbox" name="#"><?php echo $val['content']; ?></p>
		<?php endforeach; ?>
		</ul>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
	</body>
</html>