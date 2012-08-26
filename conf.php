<?php
/* 共通設定ファイル
 * */
header('Content-Type: text/html; charset:utf-8');
define('APP_ID','218572684935212');//facebook
define('APP_SECRET','72ddd7176ed834c6db53d98f4c28c8a7');//facebook
define('CONSUMER_KEY','7Co6zWYwWhM5GGMaIPgDgw');//twitter
define('CONSUMER_SECRET','ztx5Scz13vu7uyddzXy9vOxJekYhwNb7Qka7CYK9hMk');//twitter
define('DEV_Ver',"myapp");//本番を使うときはここをmyappに指定して、ロリポップのdev1.myapp/の中に更新。
define('SITE_URL', 'http://togattti.lolipop.jp/'.DEV_Ver.'/');
error_reporting(E_ALL & ~E_NOTICE);
session_set_cookie_params(0, '/'.DEV_Ver.'/');//セッションの有効範囲を指定するお！
define('ROOT_PATH', dirname(__FILE__)."/..");
define('TABLE_ADMIN',"registration");//一般会員id,pass,mailなど
define('TABLE_CONTENT',"contents");//会員が使うコンテンツ
define('TABLE_HISTORY',"historys");//全ユーザの履歴用テーブル
define('TABLE_FACEBOOK',"users");//facebook用テーブル
define('TABLE_TWITTER',"twitter_users");//twitter用テーブル
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
define('DB_HOST','mysql569.phy.lolipop.jp');
define('DB_NAME','LAA0185366-togattti');
define('DB_USER','LAA0185366');
define('DB_PASSWORD','togattti');
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

function get_contents_id(){
srand((double) microtime() * 1000000);
for ($i = 1; $i <= 8; $i++) {
$rs = rand(0, 8);
$a = substr('123456789', $rs, 1);
$id .= $a;
}
return $id;
}
echo get_include_path();

/*$conninfo = array(
	'host' => 'localhost',
	'dbname' => 'db0togattti',
	'user' => 'root',
	'password' => '932Qbff9'
);//ローカルDB接続情報
*/

