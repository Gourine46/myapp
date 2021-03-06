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
	public $connect;
	public function __construct(){
		$this->connect = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD)
		or die("mysql connect failed!");
		mysql_query("SET CHARACTER SET utf8;");
		mysql_select_db(DB_NAME,$this->connect)
		or die(mysql_error());
	}
	//上のやつと後で統合する。
	public function saveContentDb($name,$goal,$dueDay,$contents_id){//ログイン時の名前と目標、期限、後で廃止するからいじらなない
		$q = sprintf("insert into ".TABLE_CONTENT."(adminId,goal,dueDay,contents_id,created,modified) values ('%s','%s','%s','%s',now(),now())",
			$name,$goal,$dueDay,$contents_id);
		$q_history = sprintf("insert into ".TABLE_HISTORY."(adminId,goal,dueDay,contents_id,created,modified) values ('%s','%s','%s','%s',now(),now())",
			$name,$goal,$dueDay,$contents_id);
		mysql_query($q,$this->connect)or die(mysql_error());
		mysql_query($q_history,$this->connect)or die(mysql_error());
		
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

class ExpandDataBase extends operationDb{
	function __construct()
	{	
		parent::__construct();
	}
	public function saveIdPassDb($id,$pass,$mail)
	{	
		$user_id = $this->SetUserId();
		$sql = "INSERT INTO ".TABLE_ADMIN."(user_id,name,pass,e_mail) VALUES('$user_id','$id','$pass','$mail')";
		mysql_query($sql,$this->connect)or die(mysql_error());
		return true;
	}
	public function LogInNormal($name,$pass){
		/*twitter,facebook以外の普通のアカウントでのログイン認証
		 * テーブルにデータが無ければ、falseを返す。
		 * 有れば、$dataに該当配列データを入れて、返す。
		 * */
		//$name,$passのデータが有るかどうか
		if(empty($name) || empty($pass))
		{
			$result ="error";
			return $result;
		}
		//テーブル上に該当データが有るかどうか
		$sql = "select * from ".TABLE_ADMIN." where name='".$name."' and pass='".$pass."'";
		$rst = mysql_query($sql)or die(mysql_error());
		if(!$rst)
		{
			$result ="error";	
			return $result;
		}
		while($row = mysql_fetch_assoc($rst)){
			$data = $row;
		}
		//for admin id&pass
		if($name == ADMIN_ID && $pass == ADMIN_PASS)
		{	
			$result = "admin";
			return $result;
		}
		//該当データを配列に格納
		return $this->data = $data;
	}//LogInNormal
	
	public $history_save_flag = true;//historyテーブルにも履歴を残す。
	public function SaveContents($id,$content,$user_id,$due)
	{	/*格納した配列contentをdbに入れる。フラグで履歴に関しても管理*/
		//有無を判断した上で、
		if(empty($id) || empty($content) || empty($user_id))
		{
			return false;
		}	
				$contents_id = $this->SetContentId();
				$sql = sprintf("insert into ".TABLE_CONTENT." (adminId,user_id,content,contents_id,due,created,modified) values ('%s','%s','%s','%s','%s',now(),now())",
				$id,$user_id,$content,$contents_id,$due);
				mysql_query($sql)or die(mysql_error());
			if($this->history_save_flag)
			{	
				$sql = sprintf("insert into ".TABLE_HISTORY." (adminId,user_id,content,contents_id,created,modified) values ('%s','%s','%s','%s',now(),now())",
				$id,$user_id,$content,$contents_id);
				mysql_query($sql)or die(mysql_error());
			}	
		return true;
	}
	
	public function ReturnContents($user_id)
	{		
			if(empty($user_id))
			{	$this->message = "idは空です";
				return false;
			}
			$sql = sprintf("select * from ".TABLE_CONTENT." where user_id = '%d' ",$user_id);
			$rst = mysql_query($sql)or die(mysql_error());
			if($rst)
			{
				while($row = mysql_fetch_assoc($rst))
				{
					$rows[] = $row;
				}
				$this->count = $count;
				$count = count($rows);
				if(count($rows) == 0)
				{
					$this->message = "設定されたtodoがありません";
					$rows = array();
					return $rows;
				}
				$this->message = "あなたのタスクは".$count."件です";
				return $rows;
			}		
	}
	public function DeleteContents($array)//後でuser_idも指定する
	{
		if(!is_array($array) || empty($array))
		{
			return false;
		}
		foreach($array as $val){
			$sql = sprintf("delete from ".TABLE_CONTENT." where contents_id = '%s' ",$val);
			mysql_query($sql)or die (mysql_error());
		}
		return true;
	}
	public function SetUserId()
	{
		srand((double) microtime() * 1000000);
		for ($i = 1; $i <= 8; $i++)
		{
		$rs = rand(0, 8);
		$a = substr('123456789', $rs, 1);
		$id .= $a;
		}
		return $id;
	}
	public function SetContentId()
	{
		srand((double) microtime() * 1000000);
		for ($i = 1; $i <= 8; $i++)
		{
		$rs = rand(0, 30);
		$a = substr('123456789abcdefghijkABCDEFGHIJK', $rs, 1);
		$id .= $a;
		}
		return $id;
	}	
}//ExpandDataBase