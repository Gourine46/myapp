<?php
require_once("class/member_db_class.php");
session_cache_limiter('private_no_expire');
session_start();
$name = $_SESSION["name"];
$goal = $_POST['goal'];
$firstAction = $_POST['firstAction'];
$due_day = $_POST['due_day'];

$obj = new operationDb($conninfo);
if(isset($_POST["use"]))$obj->saveContentDb($name,$goal,$firstAction,$due_day);
$obj = new operationDb($conninfo);
$obj->serachElement(TABLE_CONTENT, $name);
$save_data = $obj->row;

if(isset($_POST["reset"])){
	$obj = new operationDb($conninfo);
	$obj->deleteDb(TABLE_CONTENT,$name);
	$obj->res = 1;
	header("Location:select.php");
}





?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			Goal Planet
		</title>
		<link rel="stylesheet" type="text/css" href="start.css">
	</head>
	<body>
		
		<?php echo $name?>さん
		<p>目標:<?php echo $save_data['goal']; ?></p>
		<p>いますぐやるべきこと:<?php echo $save_data['firstAction']; ?></p>
		<p>期限:<?php echo $save_data['dueDay']; ?> 日後の21:00時点</p>
		<p>まだ未達成です。</p>
		<form action='<?php echo $self ?>' method='post'>
		<input type='submit' value='目標を消す'>
		<input type='submit' value='達成できたー！'>
		<input type="hidden" name="reset" value="データを消します">
		</form>
		<form action='start.php' method="post">
		<input type="submit" value="トップへ戻るよ！">
		</form>
	</body>
</html>