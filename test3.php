<?php
class Television{
	public $channelNo = 8;
	
	function dispChannel($channel){
		$this->channel = $channel;
		print('genzainochannnelha'.$this->channelNo);
	}
		public $b;
	function HOGE(){
		$ab =  $this->channel+$b;
		print($ab);
	}

}


$obj = new Television();
$a = 6;
$obj->dispChannel($a);

$obj->b = 10;

$obj->HOGE();

