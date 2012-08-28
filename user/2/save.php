<?php
require_once("../../class/db.class.php");
session_start();
if(isset($_SESSION['row']['name'])):$id = $_SESSION['row']['name']; $user_id = $_SESSION['row']['user_id'];//一般ログイン
elseif(isset($_SESSION['user'])):$id = $_SESSION['user']['facebook_name'];$user_id = $_SESSION["user"]["facebook_user_id"];
elseif(isset($_SESSION['twitter_user']['twitter_screen_name'])):$id = $_SESSION['twitter_user']['twitter_screen_name'];$user_id =$_SESSION['twitter_user']['twitter_user_id'];
elseif(empty($_SESSION['row']) && empty($_SESSION['user']) && empty($_SESSION['twtter_user'])):jump('');
endif;
if(isset($_POST["save"])){
	$db = new ExpandDataBase();
	$db->SaveContents($id,$_POST["save"],$user_id,$_POST["due"]);	
	jump("user/2/");
}

