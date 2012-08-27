<?php
class SetId (){
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
			$rs = rand(0, 8);
			$a = substr('123456789abcdefghABCDEFGH', $rs, 1);
			$id .= $a;
			}
			return $id;
		}
}