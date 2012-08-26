<?php
require_once("../../class/db.class.php");
$obj = new operationDb($conninfo);
$title = $_POST['title'];
//$seqの役割
$rs = mysql_query("select max(seq)+1 as c from tasks");
$row = mysql_fetch_assoc($rs);
$seq = $row['c'];

$rs = mysql_query(sprintf("insert into tasks (seq, title, created, modified) 
values (%d, '%s', now(), now())",$seq, $title));