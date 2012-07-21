<?php
class MailUse {
	public $mes1 = "登録情報を確認しました。GoalPlanetをご利用いただけます。";
	public $mes2 = "おめでとうございます。目標を達成しました";
	public $subject = "あざーす";
	public $unix_now;
	public $unix_dead;
	public function mailUser($to, $subject, $message){
		$header   = "From: 2013sufla@gmail.com";
		mb_language('ja');
		mb_internal_encoding("UTF-8");
		mb_send_mail($to, $subject, $message, $header);
}
	
	public function autoNotice(){
		
	}

}
