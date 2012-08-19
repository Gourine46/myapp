<?php
require_once("../../class/member_db_class.php");
session_cache_limiter('private_no_expire');
session_start();
	if(isset($_SESSION['row']['name'])):
		$login_user_name = $_SESSION['row']['name'];
		$contents_id = $_SESSION['row']['contents_id'];//一般ログイン
	elseif(isset($_SESSION['user'])):
		$login_user_name = $_SESSION['user']['facebook_name'];
		$contents_id = $_SESSION['user']['contents_id'];	
	elseif(isset($_SESSION['twitter_user']['twitter_screen_name'])):
		$login_user_name = $_SESSION['twitter_user']['twitter_screen_name'];
		$contents_id = $_SESSION['twitter_user']['contents_id'];
	elseif(empty($_SESSION)):
		jump('');
	endif;
	
	$goal = $_POST['goal'];
	$due_day = $_POST['due_day'];
	$obj = new operationDb($conninfo);
	if(isset($_POST["use"]))$obj->saveContentDb($login_user_name,$goal,$due_day,$contents_id);//!!
	$obj = new operationDb($conninfo);
	$obj->serachElement(TABLE_CONTENT, $login_user_name);
	$save_data = $obj->row;
	if(isset($_POST["reset"])){
		$obj = new operationDb($conninfo);
		$obj->deleteDb(TABLE_CONTENT,$login_user_name);
		$obj->res = 1;
		if(isset($_SESSION['user']['facebook_name'])): jump("facebook/facebook_message.php");
		elseif(isset($_SESSION['row']['name'])): jump("user/4/");
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