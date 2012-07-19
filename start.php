<?php
//session_cache_limiter("private");
require_once("member_db_class.php");
//if(isset($_POST["back_top"])){delete_file();delete_session();}
session_start();
$date = date("Y-m-d",time());
$name=$_SESSION["name"];
$obj = new operationDb($conninfo);
$obj->serachElement($table="main",$name);
$goal = $obj->row["goal"];
$firstAction = $obj->row["firstAction"];
$due_day = $obj->row["dueday"];
$dead_day = date("Y-m-d",time()+($due_day * 24 * 60 * 60));
$obj->res;

?>
<html>
	<head>
		<title>
			Goal Planet
		</title>
		<Meta http-equiv="Content-Script-Type" content="text/javascript">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="start.css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div></div>
		<h1><span id="midasi">Goal Planet</span></h1>
		<a href="login.php">ログアウト</a>
		<h2>next step for <?php echo $_SESSION["name"];?></h2>
		<form action="start2.php" method="post">
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
				<h2>while you challenge <?php echo $_SESSION["name"];?></h2>
				<label>目標</label><?php echo $goal ?>
			<label>そのために今すぐやること</label><?php echo $firstAction ?>
			<label>期限</label><?php echo $dead_day ?>
			<p>一度に設定できる目標は一人一つまでです。</p>
			
			<p>目標を決め直すときはここで一度消してから、再サインインしてください。</p>
			<form name="delete" action="start2.php">
			<input type="submit" value="リセット" class="btn">
			</form>
			<?php endif; ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>