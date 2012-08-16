<?php
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="me.css"/>
<title>About me</title>
</head>
<body>
<script>
$(function(){
		$("dl dt").click(function(){
			if($("dl dd").css("display")=="none"){
				$("dl dd").slideDown("slow");
}else{
	$("dl dd:not(:animated)").slideUp("slow");
		
	}
	});
});
</script>
<dl><dt style="cursor:pointer;"><h1>About me←せっかく作ったからここをクリックして！</h1></dt>
	<p><a href="">facebook</a></p>
	<p><a href="">Twitter</a></p>
<div>
	
	<h2>所属:</h2>
	<dd>
		<p>埼玉大学教養学部国際政治学ゼミ,現在4回生</p>
		<p>裏千家茶道部茶楽会 渉外と他大学との窓口係</p>
		<p>とあるWebサービスの企業でシステムエンジニアのお手伝い</p>
	</dd>
	<h2>経歴:</h2>
	<dd>
		<p>２年時、オーストラリアで遊学</p>
		<p>→日本との違いを肌で感じる。帰国後ある挫折を味わう</p>
		<p>→小さな野望を抱く</p>
		<p>→スタートアップのITベンチャーでインターン</p>
		<p>→SNSとかwebサービスにハマる、作りたいってなる</p>
		<p>→エンジニアを志す、ザッカーバーグみたくなりたry</p>
		<p>→現在システム開発の仕事と自作サービスの制作</p>
		<p>=卒業したい、お金ほしい..←今ここ(´・ω・`) </p>
	</dd>
	<h2>スキル</h2>
		<dd>
		<ul>
			<li>ツイストパーソン</li>
			<li>ショートスリーパー</li>
			<li>マイペース</li>
			<li>ビヨンドエクスペクテーションズ</li>
			<li>スマイリー</li>
			<li>ユースフルネス</li>
			<li>レーショナリズム</li>
		</ul>
		</dd>

	<h2>webスキル:</h2>
		<dd><ul>
			<li>HTML</li>
			<li>PHP</li>
			<li>MySQL</li>
			<li>Git</li>
			<li>Linux(簡単なコマンドいじるくらい...)</li>
			<li>その他(wordpressの設定,cakePHP,facebookTwitterのAPI,twitterbootstrapとか少しいじれます。)</li>
		</ul>
		</dd>
	<h2>制作物:</h2>
	<dd>	
		<ul>
			<li><a href="http://togattti.lolipop.jp/myapp/">GoalPlanet</a></li>
		</ul>
	</dd>
	
	</dl>	
</div>
</body>
</html>