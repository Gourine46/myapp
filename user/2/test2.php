<?php
require_once("../../class/db.class.php");
$db = new ExpandDataBase();

if($db->DeleteContents($_POST["task"])){
	jump("user/2/");
}
echo"削除するタスクを指定してください。<a href='./'>戻る</a>";


