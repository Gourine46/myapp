<?php
require_once("../../class/member_db_class.php");
session_start();
$c_id = $_POST['contents_id'];

$obj = new operationDb($conninfo);

/*
 * データをcontents_idで検索
 * 
 * $sql = sprintf("select * from historys where contents_id = '%d', $contents_id ")
 * $r = mysql_query($sql);
 * $row = mysql_fetch_assoc($r);
 * */
$q = "select adminId,goal,created,type from historys where contents_id = '".$c_id."'";
	$a = "select count(*) from historys where contents_id = '".$c_id."'";
$result = mysql_query($q);
while($row = mysql_fetch_assoc($result)){
	$rows[] = $row;
}
$_SESSION['rows'] = $rows;
jump("admin/edit/history.php");