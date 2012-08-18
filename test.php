<?php

function get_contents_id(){

srand((double) microtime() * 1000000);
for ($i = 1; $i <= 8; $i++) {
$rs = rand(0, 8);
$a = substr('123456789', $rs, 1);
$id .= $a;
}
return $contents_id;
}
$contents_id = get_contents_id();
echo $contents_id;