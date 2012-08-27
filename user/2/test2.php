<?php
require_once("../../class/db.class.php");
$db = new ExpandDataBase();

if($db->DeleteContents($_POST["task"])){
	jump("user/2/mypage.php");
}
echo"削除するタスクがありません！";
//配列を受け取ったら,ループを回して、合致するものを消して行く感じで

