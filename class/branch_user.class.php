<?php
require_once("db.class.php");
//ユーザの分岐はuser_id及びuser_nameで行う。
//まずデータベースの拡張機能を用いて、データベース接続をしてしまう。
//３つのテーブルの中から、ユーザ情報を検索する。
//それは一意になるはずである。
//そして、配列にデータを格納する。最後にuser_type=twitter or facebook or else
//配列最後にpushする。
//
class BranchUser extends　operationDb
{
	function __construct()
	{
		parent::__construct();
	}
	
	function branch($array){
		if(is_array($array)){
			$
		}
	}
}