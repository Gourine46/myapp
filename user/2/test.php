<?php
session_start();
$ad = $_POST["add"];
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($ad)){
		$separator = ",";
		$add = sprintf("%s".$ad,$separator);
		$_SESSION['add'] .= $add;
		$content = explode(",",$_SESSION['add']);
		if(empty($content[0])){
			unset($content[0]);
		}
		$_SESSION["save"] = $content;
	}
?>
<html>
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
		<h1><?php var_dump($_SESSION["save"]);?></h1>
		<a href="../logout.php">ログアウト</a>
		<h2>next step for <?php echo $login_user_name;?></h2>
		<form action="<?php echo$self ?>" method="post">
			<label>todo</label><input type="text" name="add"　value = "" id="todo.1">
			<input type="submit"  value= "項目を追加する" class="btn">
		</form>
		<form action="save.php" method="post">
			<input type="hidden" name="save" value= "保存" class="btn">
			<input type="submit"  value="追加項目の保存" class="btn">
		</form>
		
		<ul>
		<?php if(!empty($_SESSION["add"])):?>
		<?php foreach($content as $val):?>
		<li><?php echo $val; ?></li>
		<?php endforeach; ?>
		<?php endif;?>
		</ul>
		<!--送信ボタンを押す。
			データベース操作ファイルを開く。 
			contentをでーたべーすに格納する。
			接続を外で行う。
			ループでsql操作を行う。
		 -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
	</body>
</html>