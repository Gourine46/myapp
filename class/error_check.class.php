<?php
class ErrorCheck
{	public $error_message = "ふひひ！！";
	public $error_flag = true;
	public function SignInErrorCheck($name,$pass,$pass2,$email)
	{
		if(empty($name)||empty($pass)||empty($email))
		{
			$this->error_message = "記入漏れがあります。入力お願いします";
			$error_flag = false;
			return $error_flag;
		}
		if($this->preg_code($name) === false || $this->preg_code($email) === false)
		{
			$this->error_message = "半角英数字のみでお願いします";
			$error_flag = false;
			return $error_flag;
		}
		if($pass != $pass2)
		{
			$this->error_message = "パスワードが合致しません。もう一度記入してください";
			$error_flag = false;
			return $error_flag;
		}
			return $error_flag = true;
	}
	
	public function preg_code($string)
	{
		if(!preg_match("/^[!-~]+$/", $string))
		{
			return false;
		}
	}
}