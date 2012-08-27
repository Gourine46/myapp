<?php
//twitter認証後返ってくる。
require_once('../class/db.class.php');
require_once('twitteroauth/twitteroauth.php');

session_start();

$oauth = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET, $_SESSION['oauth_token'],$_SESSION['oauth_token_secret']);

$accessToken = $oauth->getAccessToken($_GET['oauth_verifier']);

$me = $oauth->get('account/verify_credentials');

//DBに突っ込む！

$obj = new ExpandDataBase();
//使用テーブルはtwitter_users

$q = sprintf("select * from twitter_users where twitter_user_id = '%s' limit 1", $me->id_str);
$rs = mysql_query($q)or die(mysql_error());

$twitter_user = mysql_fetch_assoc($rs);

if(empty($twitter_user)){
	//新しくユーザー情報を挿入
	$q = sprintf("insert into twitter_users (twitter_user_id, twitter_screen_name, twitter_profile_image_url, twitter_access_token, twitter_access_token_secret, created, modified) 
	values ('%s', '%s', '%s', '%s', '%s', now(), now());",
		$me->id_str,
		$me->screen_name,
		$me->profile_image_url,
		$accessToken['oauth_token'],
		$accessToken['oauth_token_secret']);
	$rs = mysql_query($q);
	//$twitter_userに情報をセットする。
	$q = sprintf("select * from twitter_users where id=%d limit 1",mysql_insert_id());
	$rs = mysql_query($q);
	$twitter_user = mysql_fetch_assoc($rs);
}

session_regenerate_id(true);
$_SESSION['twitter_user'] = $twitter_user;

jump("user/1/");
exit;