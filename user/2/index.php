<?php
require_once("../../class/db.class.php");
session_start();
$db = new ExpandDataBase();
$now = date("Y-m-d",time());
if(isset($_SESSION['row']['name'])){
$id = $_SESSION['row']['name'];
$user_id = $_SESSION['row']['user_id'];
}//一般ログイン
elseif(isset($_SESSION['user'])){
	$id = $_SESSION['user']['facebook_name'];
$user_id = $_SESSION["user"]["facebook_user_id"];
}
elseif(isset($_SESSION['twitter_user'])){
	$id = $_SESSION['twitter_user']['twitter_screen_name'];
$user_id = $_SESSION['twitter_user']['twitter_user_id'];
}
elseif(empty($_SESSION['row']) && empty($_SESSION['user']) && empty($_SESSION['twtter_user'])){
	jump('');
}		
		$content = $db->ReturnContents($user_id);
		$count = count($content);

?>
<html>
	<head>
		<title>
			Goal Planet
		</title>
		<Meta http-equiv="Content-Script-Type" content="text/javascript">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="../../css/bootstrap.min.css" rel="stylesheet">
		 <style type="text/css">
      div,form,table,tr,td,li,ul{color: #4D4137}
  </style>
	</head>
	<body style="background-color:#DEE7EE;">
<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="#">
			GoalPlanet
		</a>
		<div class="container">
			<ul class="nav">
				<li class="active"><a href="#">Home</a></li>
				<li class="active"><a href="../logout.php">Logput</a></li>
			</ul>
		</div><!-- container -->
	</div><!-- nav-inner -->
</div><!--  navbar -->	
				
		<div class="container">	
				<div class="row-fluid">
				  <div class="span1" id="space"></div>
					<div class="span4" style="background-color:#E3DFD7;">
					<div class="span1"></div>
					
						<form class="form-vertical" action="save.php" method="post">
							<fieldset>
							 <legend>next step for <?php echo $id;?></legend>
							<div class="control-group">
							<label class="control-label" for="task">Task</label>
							<div class="controls">
								<input type="text" class="span6" name="save"　value = "" id="task">
								<p class="help-block">期限の指定はdueからお願いします</p>
							</div><!-- controls -->
								
								<label class="control-label" for="due">Due</label>
							<div class="controls">
								<input type="date" class="span6" name="due" value="<?php echo $now;?>">
							</div><!-- controls -->
							</div><!-- control-group -->
						    <input type="submit"  value= "項目を追加する" class="btn">
							</fieldset>
						</form>
					  
					</div>
					<div class="span6">
					<h3>現在残しているタスク一覧:<?php echo $db->message;?></h3>
					<form action="test2.php" method="post">
					<input type="submit" value="チェックした項目を削除" class="btn">
						<table class="table table-bordered">
						<tr><th>task</th><th>due</th><tr>
					<?php if( $count > 0):?>
							<?php foreach($content as $val):?>
								<?php $due = ($now == $val["due"]) ? Today : $val['due'];?>
								<tr><td><input type="checkbox" name="task[]" value="<?php echo $val['contents_id'] ?>"><?php echo $val['content']; ?></td>
								<td><?php echo $due;?></td></tr>
							<?php endforeach; ?>
						</table>
					</form>
					<?php elseif($count == 0 ):?>
						<div class="span6" >
							<div class="alert alert-block">
								<?php echo"設定してください";?>
							</div>
						</div>
					<?php endif;?>
					
					</div>
				</div>
				<br>
				<br>
				<br>
				<br>
				<br>
				<div class="span10">
				<table class="table">
					<tbody><tr>
				<td class="title" width="20%">
					利用について
				</td>
				<td class="desc" width="80%">
					　特にないのでご自由にご利用ください。<br /><br /><br />　なお、バグや要望があれば管理人までご一報下さい<br />　　連絡先：<a href="https://twitter.com/togattti" rel="external">https://twitter.com/togattti</a>
				</td>
			</tr>
			</tbody></table>
				</div>
				
		</div><!-- container -->
<div id="footer" class="container" style="background-color:#DEE7EE;">	
<hr>
 <footer class="footer">
        <ul class="credit">
			<li>Copyright &copy; 2010 - 2012 <a href="#">GoalPlanet</a></li>
			<li><address>Created by Togattti who is free creater</address></li>
		</ul>
 </footer>
</div>
		<script type="text/javascript">
			$(function(){
			　$("#datepicker").datepicker({
				numberOfMonths: 3,
				　　showButtonPanel: true
			});
			});
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
	</body>
</html>