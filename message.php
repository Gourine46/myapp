<?php
/*目標設定期限をすぎたユーザに対して、自動でメールを送信するファイル。
 * cron設定により、期限の次の日の21時の自動送信する。
 * アドミン、クライアントからむやみに開かない。 
*/
require_once("class/member_db_class.php");
require_once("class/mail_user_class.php");
$obj = new operationDb($conninfo);
$result = mysql_query("SELECT * FROM ".TABLE_CONTENT." order by adminId")
or die(mysql_error());
while($contents = mysql_fetch_array($result,MYSQL_ASSOC)){

	//if($unix_now > $unix_dead){
		 $obj = new operationDb($conninfo);
		 $obj->serachElement(TABLE_ADMIN,$contents["adminId"]);
		 $e_mail = $obj->row["e_mail"];
		 $name =  $contents["adminId"];
		 $subject = "GoalPlanet管理者より";
		 $message = "{$name}さんこんにちは。約束の日時をすぎてしまいました。
		 目標を達成できているなら、マイページからリセットしてください。残念ながら達成できていない場合も
		 リセットをお願いいたします。次回の活用もお待ちしております。GoalPlanet管理者より";
		 $mail = new MailUse();
		 $mail->mailUser($e_mail,$subject,$message);
	//}

	
}
