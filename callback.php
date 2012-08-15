<?php
//twitter認証後返ってくる。
require_once('twitteroauth/twitteroauth.php');

session_start();

$oauth = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET, $_SESSION['oauth_token'],$_SESSION['oauth_token_secret']);

$access_token = $oauth->getAccessToken($_GET['oauth_verifier']);

$me = $oauth->get('account/verify_credentials');

var_dump($me);
//DBに突っ込む！