<?php
require_once("../../class/db.class.php");
session_start();
$id = "kenta";
$user_id = 12345678;
if(isset($_SESSION["save"])){
	$db = new ExpandDataBase();
	$db->SaveContents($id,$_SESSION["save"],$user_id);	
	unset($_SESSION["add"]);
	unset($_SESSION["save"]);
	jump("user/2/mypage.php");
}

