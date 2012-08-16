<?php
require_once("../../class/member_db_class.php");
session_cache_limiter('private_no_expire');
session_start();
if(isset($_SESSION['name']))$login_user_name = $_SESSION['name'];//一般ログイン
elseif(isset($_SESSION['user']))$login_user_name = $_SESSION['user']['facebook_name'];
elseif(isset($_SESSION['twitter_user']['twitter_screen_name']))$login_user_name = $_SESSION['twitter_user']['twitter_screen_name'];
elseif(empty($_SESSION))jump('');
$goal = $_POST['goal'];
$firstAction = $_POST['firstAction'];
$due_day = $_POST['due_day'];

	$obj = new operationDb($conninfo);
	if(isset($_POST["use"]))$obj->saveContentDb($login_user_name,$goal,$firstAction,$due_day);
	$obj = new operationDb($conninfo);
	$obj->serachElement(TABLE_CONTENT, $login_user_name);
	$save_data = $obj->row;
	if(isset($_POST["reset"])){
		$obj = new operationDb($conninfo);
		$obj->deleteDb(TABLE_CONTENT,$login_user_name);
		$obj->res = 1;
		if(isset($_SESSION['user']['facebook_name'])): jump("facebook/facebook_message.php");
		elseif(isset($_SESSION['name'])): jump("user/4/");
		elseif(isset($_SESSION['twitter_user']['twitter_screen_name'])):jump("twitter/twitter_message.php");
		endif;
	}
?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			Goal Planet
		</title>
	</head>
	<body>
		<?php echo $login_user_name?>さん
		<p>目標:<?php echo $save_data['goal']; ?></p>
		<p>いますぐやるべきこと:<?php echo $save_data['firstAction']; ?></p>
		<p>期限:<?php echo $save_data['dueDay']; ?> 日後の21:00時点</p>
		<p>まだ未達成です。</p>
		<form action='<?php echo $self ?>' method='post'>
		<input type='submit' value='目標を消す'>
		<input type='submit' value='達成できたー！'>
		<input type="hidden" name="reset" value="データを消します">
		</form>
		<form action='../2/' method="post">
		<input type="submit" value="トップへ戻るよ！">
		</form>
	</body>
</html>