<?php
require_once("../../class/db.class.php");
$obj = new operationDb($conninfo);

$rs = mysql_query("update tasks set type='deleted' where id =".$_POST['id']);