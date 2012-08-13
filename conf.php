<?php
/*
 * .htaccess
 * 共通設定ファイル
 * utf8指定
 * */
header('Content-Type: text/html; charset:utf-8');
///Applications/XAMPP/xamppfiles/htdocs/apli1/
define('ROOT_PATH', dirname(__FILE__)."/..");
define('TABLE_ADMIN',"registration");//会員id,pass,mailなど
define('TABLE_CONTENT',"contents");//会員が使うコンテンツ
define('ADMIN_ID',"kenken");//管理画面用
define('ADMIN_PASS',"0302");//..
set_include_path(get_include_path().PATH_SEPARATOR.ROOT_PATH);//インクルードパス指定
$self=$_SERVER["SCRIPT_NAME"];
$conninfo = array(
	'host' => 'mysql569.phy.lolipop.jp',
	'dbname' => 'LAA0185366-togattti',
	'user' => 'LAA0185366',
	'password' => 'togattti'
);//ロリポDB接続情報

$mailinfo = array("from" => "2013sufla@gmail.com",
					"to" => "kenta.togasi@gmail.com");
/*$conninfo = array(
	'host' => 'localhost',
	'dbname' => 'db0togattti',
	'user' => 'root',
	'password' => '932Qbff9'
);//ローカルDB接続情報
*/


//githubにあげる。
//サーバー環境
//自動送信機能
//定時スクリプト実行cron
//ローカル.

//利用者が毎日の利用。何個かタスクを複数設定。
//時間配分。一時間おきにアラートだす。相手のデスク上で、、、
//javascript 
