<?php
require_once("../../class/db.class.php");
session_start();
$id = "kenta";
$content_id = 12345678;
if(isset($_SESSION["save"])){
	$db = new ExpandDataBase();
	$db->SaveContents($id,$_SESSION["save"],$content_id);	
	jump("user/2/mypage.php");
}

