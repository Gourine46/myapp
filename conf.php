<?php
/*
 * .htaccess
 * 共通設定ファイル
 * utf8指定
 * */
header('Content-Type: text/html; charset:utf-8');
///Applications/XAMPP/xamppfiles/htdocs/apli1/main2
define('ROOT_PATH', dirname(__FILE__)."/..");
define(TABLE_ADMIN,"id_pass");//会員id,pass,mailなど
define(TABLE_CONTENT,"main");//会員が使うコンテンツ
set_include_path(get_include_path().PATH_SEPARATOR.ROOT_PATH);//インクルードパス指定
$conninfo = array(
	'host' => 'localhost',
	'dbname' => 'db0togattti',
	'user' => 'root',
	'password' => '932Qbff9'
);//DB接続情報

 $a = "";
$self=$_SERVER["SCRIPT_NAME"];
//githubにあげる。
//サーバー環境
//自動送信機能
//定時スクリプト実行cron
//ローカル.

//利用者が毎日の利用。何個かタスクを複数設定。
//時間配分。一時間おきにアラートだす。相手のデスク上で、、、
//javascript 