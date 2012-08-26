<?php 
session_start();
$rows = $_SESSION['rows'];
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			会員確認画面
		</title>
		<link href="../../css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<h1><?php echo$rows[0]['adminId'] ?>の履歴一覧</h1>
		<table>
		<tr>
			<th>todo</th>
			<th>created</th>
			<th>status</th>
		</tr>
		<?php foreach($rows as $row):?>
		<tr>
			<td><?php echo$row['goal']; ?></td>
			<td><?php echo$row['created'];?></td>
			<td><?php echo$row['type'];?></td>
		</tr>
		<?php endforeach; ?>
		</table>
		<a href ="./">←戻る</a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>

