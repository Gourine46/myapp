<?php
require_once("twitteroauth/twitteroauth.php");
session_start();
if(isset($_SESSION['twitter_user'])):
$message = "おめでとうございます。GoalPlanetを使って、目標を達成しました。テスト投稿。";
$access_token = $_SESSION['twitter_user']['twitter_access_token'];
$access_token_secret = $_SESSION['twitter_user']['twitter_access_token_secret'];
$to = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$access_token,$access_token_secret);
$req = $to->OAuthRequest("https://twitter.com/statuses/update.xml","POST",array("status"=>"$message"));
echo"<a href='../user/logout.php'>ログアウト</a>してください。";
else:
echo"何かおかしい。<a href='../user/logout.php'>ログアウト</a>してください。";
endif;