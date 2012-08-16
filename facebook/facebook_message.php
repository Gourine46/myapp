<?php
//ウォール投稿の許可を得る。
require_once'facebook-facebook-php-sdk-1270f0d/src/facebook.php';
session_start();
$appId= APP_ID;
$secret= APP_SECRET;
$id = $_SESSION['user']['facebook_user_id'];
$access_token = $_SESSION['user']['facebook_access_token'];

$message = 'おめでとうございます！GoalPlanetで目標達成しました。スルーでお願いします。GoalPlanet制作者より';
$facebook = new Facebook(array());
$facebook->api('/' . $id . '/feed/', 'POST', array('access_token' => $access_token, 'message' => $message));
jump("user/4/");
