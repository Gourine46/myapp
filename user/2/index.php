<?php
require_once("../../class/member_db_class.php");
session_start();
if(isset($_SESSION['name']))$login_user_name = $_SESSION['name'];//一般ログイン
elseif(isset($_SESSION['user']))$login_user_name = $_SESSION['user']['facebook_name'];
elseif(isset($_SESSION['twitter_user']['twitter_screen_name']))$login_user_name = $_SESSION['twitter_user']['twitter_screen_name'];
elseif(empty($_SESSION))jump('');
$date = date("Y-m-d",time());
$obj = new operationDb($conninfo);
$obj->serachElement(TABLE_CONTENT,$login_user_name);
$dead_day = date("Y-m-d",time()+($obj->row["dueDay"] * 24 * 60 * 60));


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
		<div></div>
		<h1><span id="midasi">Goal Planet</span></h1>
		<a href="../logout.php">ログアウト</a>
		<h2>next step for <?php echo $login_user_name;?></h2>
		<form action="../3/" method="post">
			<?php echo$date;?>
			<?php if(!$obj->res == 1): ?>
			<label>目標</label><input type="text" name="goal"　value = "">
			<label>そのために今すぐやること</label><input type="text" name="firstAction"　value = "">
			<label>期限</label>
				 <select method="post" name="due_day">
					<option value="1">1日</option>
					<option value="2">2日</option>
					<option value="3">3日</option>
					<option value="4">4日</option>
					<option value="5">5日</option>
				 </select>
			<label>DO YOU HAVE A RESOLUSION?</label><input type="submit" value="Yes!" class="btn">
			<input type='hidden' name='use' value="確認ページへ">
		</form>
			<?php else: ?>
				<h2>while you challenge <?php echo $login_user_name;?></h2>
				<label>目標</label><?php echo $obj->row["goal"] ?>
			<label>そのために今すぐやること</label><?php echo $obj->row["firstAction"]; ?>
			<label>期限</label><?php echo $dead_day ?><div>21:00時点</div>
			<p>一度に設定できる目標は一人一つまでです。</p>
			<p>目標を決め直すときはここで一度消してから、再サインインしてください。</p>
			<form name="delete" action="../3/">
			<input type="submit" value="リセット" class="btn">
			</form>
			<?php endif; ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
	</body>
</html>