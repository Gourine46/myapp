<?php
function h($s){
	return htmlspecialchars($s);
}

function jump($s){
	header('Location: '.SITE_URL.$s);
	exit;
}