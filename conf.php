<?php
/* 共通設定ファイル
 * */
header('Content-Type: text/html; charset:utf-8');
define('APP_ID','218572684935212');//facebook
define('APP_SECRET','72ddd7176ed834c6db53d98f4c28c8a7');//facebook

define('CON_KEY','7Co6zWYwWhM5GGMaIPgDgw');//twitter
define('CON_SECRET','ztx5Scz13vu7uyddzXy9vOxJekYhwNb7Qka7CYK9hMk');//twitter
define('DEV_Ver',"myapp");//本番を使うときはここをmyappに指定して、ロリポップのdev1.myapp/の中に更新。
define('SITE_URL', 'http://togattti.lolipop.jp/'.DEV_Ver.'/');
error_reporting(E_ALL & ~E_NOTICE);
session_set_cookie_params(0, '/'.DEV_Ver.'/');
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

function h($s){
	return htmlspecialchars($s);
}
/*
function r($s){
	return mysql_real_escape_string($s);
}
*/
function jump($s){
	header('Location:'.SITE_URL.$s);
	exit;
}


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
