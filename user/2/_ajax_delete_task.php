<?php
require_once("../../class/member_db_class.php");
$obj = new operationDb($conninfo);

$rs = mysql_query("update tasks set type='deleted' where id =".$_POST['id']);