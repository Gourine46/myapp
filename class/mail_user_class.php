<?php
class MailUse {
	public $mes1 = "登録情報を確認しました。GoalPlanetをご利用いただけます。";//サインイン時のメッセージ
	public $mes2 = "おめでとうございます。目標を達成しました";//目標達成できた
	public $mes3 = ""
	
	public function mailUser($to, $subject, $message){
		$header   = "From: {$mailinfo['from']}";
		mb_language('ja');
		mb_internal_encoding("UTF-8");
		mb_send_mail($to, $subject, $message, $header);
}
}
