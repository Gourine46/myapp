<?php
require_once("class/member_db_class.php");
session_start();
if(empty($_GET['code'])) {
	//認証前の処理
	//認証ダイアログを作成
	$_SESSION['state'] = sha1(uniqid(mt_rand(),true));
	
	$params = array(
		'client_id' => APP_ID,
		'redirect_uri' => SITE_URL.'redirect.php',
		'state' => $_SESSION['state'],
		'scope' => 'email,user_hometown,publish_stream'
	);
	
	$url = 'https://www.facebook.com/dialog/oauth?'.http_build_query($params);
	header('Location:'.$url);
	exit;
	//facebookへ飛ばす
} else {
	//認証されて返ってきたときの処理
	if($_SESSION['state'] != $_GET['state']){
		echo"何かがおかしい";
		exit;
	}
	
	
	//ユーザ情報の取得
	$params = array(
		'client_id' => APP_ID,
		'client_secret' => APP_SECRET,
		'code' => $_GET['code'],
		'redirect_uri' => SITE_URL.'redirect.php'
	);
	
	$url = 'https://graph.facebook.com/oauth/access_token?'.http_build_query($params);
	$body = file_get_contents($url);//文字列
	
	parse_str($body);
	//access_token;
	$url = 'https://graph.facebook.com/me?access_token='.$access_token.'&fields=name,picture,email';
	
	$me = json_decode(file_get_contents($url),true);
	//DBへ突っ込む
	$obj = new operationDb($conninfo);
	$q = sprintf("select * from users where facebook_user_id='%s' limit 1",$me['id']);
	$rs = mysql_query($q);
	$user = mysql_fetch_assoc($rs);
	if(empty($user)){
		//データを挿入
		$q = sprintf("insert into users (facebook_user_id, facebook_name, facebook_picture, facebook_email, facebook_access_token, created, modified) values ('%s','%s','%s','%s','%s',now(),now());",
            $me['id'],
            $me['name'],
            $me['picture']['data']['url'],
            $me['email'],
            $access_token);
        $rs = mysql_query($q);
		//挿入されたデータを引っ張ってきて,$userにセット
		$q = sprintf("select * from users where id=%d limit 1", mysql_insert_id());
		$rs = mysql_query($q)or die(mysql_error());
		$user = mysql_fetch_assoc($rs);
			
	}
	//ログイン処理
if(!empty($user)) {
		session_regenerate_id(true);
		$_SESSION['user'] = $user;
	}
	jump("select.php");
	//先へリダイレクト
}

