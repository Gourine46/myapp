<?php
require_once("../../class/db.class.php");
session_start();
$c_id = $_POST['user_id'];
$obj = new operationDb($conninfo);
$sql = "select adminId,content,created,type from historys where user_id = '".$c_id."'";
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result)){
	$rows[] = $row;
}
$_SESSION['rows'] = $rows;
jump("admin/edit/history.php");