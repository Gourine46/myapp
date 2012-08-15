<?php
$self = $_SERVER["SCRIPT_NAME"];
$e_mail = $_POST["e_mail"];
$name = $_POST["name"];
$pass = $_POST["pass"];

$array = ["id"]["e_mail"];

$array = array("id" => array("e_mail" => ""));

//idを取り出す。

$content = array("id" => array("e_mail" => "","pass" => ""));



?>

<html>
<head>
</head>
<body>
<h1>テスト</h1>
<?php var_dump($array);?>
<form action = "<?phpecho $self ?> method="post"/>
<input type="text" name="e_mail">
<input type="text" name="name">
<input type="text" name="pass">
<input type="submit" value="送信">
</body>
</html>