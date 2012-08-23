<?php
require_once("../class/mail_user_class.php");//後でファイル着くってそこにリダイレクト処理させる
session_start();
$mail = new MailUse();
$mail->mailUser($_SESSION['conf_mail'],$mail->subject,$mail->mes1);

//セッションの消去

jump("");