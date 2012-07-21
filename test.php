<?php
/*
$dead_day = date("Y-m-d",time()+($due_day * 24 * 60 * 60));//設定日時
$now = time();
classに入れる。
contentsの中のすべてのユーザに対して、
ユーザの名前とduedayをget.
$nowと$deadayを　unixタイムに変換して
if($now > $deadday){
	mailアドレスを取得。
	mailを送信する。
}
別のファイルで出力させる。
*/
require_once("class/member_db_class");

$obj = new operationDb();

$obj->searchAll(TABLE_CONTENT);
