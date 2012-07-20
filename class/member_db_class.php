<?php
 
 /*2012/6/25
  * テストサーバ:http://www41.atpages.jp/togattti/
  * 目標設定とか期限に関しては別に…用意する。ただしデータベースの接続は共通して使えるよ!!
  * いずれは目標とか期限もまとめて使えるようにする。
  * 会員登録用データベース機能を統括したクラスを定義。
  * プロパティはnameとpassと現在時刻。
  * hostとかpass,user,serverなど。
  * 
  * データベース接続のメソッド。
  * コンストラクトを用いて宣言時に作動。
  * 自分のatpagesのレンタルサーバ用。
  * 
  * データベースへの保存のメソッド。
  * 
  * データベースから取り出すメソッド。
  * 
  * データベースから値を削除するメソッド。
  * 最低限の機能を整理してつけるようにする。
  * ファンクションと変数名を一目で分かるようにする。
  * 名前の最初を大文字にしたり、
  * 変数名ノルール、同じファンクションをかかない。
  * ディレクトリ構造、メモ
  * 目標を決めて、期限を通知する！
  * 数日
  * */
 

class operationDb{
	//dbuser:atpages:togattti
	//dbpass:atpages:995944335995a5a27791
	public $connect;//クラス自身のmysql_connect(,,,)を格納
	public $inname;//会員登録用の名前
	public $link;
	public $row;
	public $res;
	public function __construct($conninfo){
		$this->connect = mysql_connect($conninfo['host'],$conninfo['user'],$conninfo['password'])
		//or die("mysql connect failed!");
		//$this->connect = mysql_connect('mysql569.phy.lolipop.jp','LAA0185366','togattti')
		or die("mysql connect failed!");
		mysql_query("SET CHARACTER SET utf8;");
		mysql_select_db($conninfo['dbname'],$this->connect)
		or die(mysql_error());
	}
	
	public function saveIdPassDb($inname,$inpass,$in_e_mail){
		$sql = "INSERT INTO ".TABLE_ADMIN."(name,pass,e_mail) VALUES('$inname','$inpass','$in_e_mail')";
		mysql_query($sql,$this->connect)or die(mysql_error());
		mysql_close($this->connect);
	}
	//上のやつと後で統合する。
	public function saveContentDb($name,$goal,$firstAction,$dueDay){//ログイン時の名前と目標、期限
		$sql = "INSERT INTO ".TABLE_CONTENT." (adminId,goal,firstAction,dueday) VALUES('$name','$goal','$firstAction','$dueDay')";
		mysql_query($sql,$this->connect)or die(mysql_error());
		mysql_close($this->connect);
	}
	//取得したデータをmysql格納用にするメソッド。
	public function format($string){
	$string = htmlspecialchars($string);
		if(0 == get_magic_quotes_gpc()){//5.4以降では常にFALSE.でも今使ってるのは5.3！多分phpinfo()でOFFだった。0
		$string = stripslashes($string);//クォートされた文字列のクォート部分を取り除く
		}
		$string = mysql_real_escape_string($string);//mysql用のものに変換
	return $string;	
	}
	
	//格納データを配列表示して、
	public function arrayDb($name){
		$sql = mysql_query("SELECT * FROM ".TABLE_ADMIN." order by id")
		or die(mysql_error());
		while($row = mysql_fetch_array($sql,MYSQL_ASSOC)){
				
			if($name == $row["name"]){
		$this->outname = $row["name"];
		$this->outpass = $row["pass"];
		return $res = true; 
		
	}
		}
	}
	
	public function deleteDb($table,$inName){
		/*削除するテーブルをまず指定する。$table
		 * 削除するテーブル列をidから特定、検索する。$id
		 * 削除するテーブル列を指定する。
		 * その列のデータ削除のqueryを実行する。
		 * 会員データを削除するパターンと実行中のコンテンツを削除する場合の二通りある。
		 * */
		if($table == TABLE_ADMIN)$sql = "DELETE from ".TABLE_ADMIN." WHERE id ='$inName' ";
		if($table == TABLE_CONTENT)$sql = "DELETE from ".TABLE_CONTENT." WHERE adminId ='$inName' ";
		 mysql_query($sql,$this->connect);
		 mysql_close($this->connect);
	}
	
	public function serachElement($table,$id) {
		/*テーブルを指定し、要素を検索する。
		 * もしその要素が存在していれば、
		 * その列のデータを連想配列として格納して返す。
		 * $obj->$row["adminId"]みたいな感じで取り出す。
		 * 
		 */
		 if($table == TABLE_ADMIN){
		 $sql = mysql_query("SELECT * from ".TABLE_ADMIN." WHERE id = '$id' or name = '$id' ")or die(mysql_error());
		 	while($row = mysql_fetch_array($sql,MYSQL_ASSOC)){
		 		if($id == $row["id"] || $id == $row["name"]){
		 			$this->row = $row;
					mysql_close($this->connect)or die(mysql_error());
					$res = true;//1を返す
					return $this->res = $res;
		 		}
		 }
		 }//if
		 if($table == TABLE_CONTENT){
		$sql = mysql_query("SELECT * from ".TABLE_CONTENT." WHERE adminId = '$id' ")or die(mysql_error());
		 	while($row = mysql_fetch_array($sql,MYSQL_ASSOC)){
		 		if($id == $row["adminId"]){
		 			$this->row = $row;
					mysql_close($this->connect);
					$res = true;//1を返す
					return $this->res = $res;
		 		}
		 	else{echo "できてないよ";}
		 }
	}//if
}//serachElement
	
}//class