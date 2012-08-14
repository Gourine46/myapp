<?php
session_start();

$_SESSION = array();

if(isset($_COOKIE[session_name()])){
	setcookie(session_name(),'',time()-86400,'/myapp/');
}
session_destroy();

jump("");