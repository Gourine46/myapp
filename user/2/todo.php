<?php
require_once("../../class/member_db_class.php");
$obj = new operationDb($conninfo);
/*動的に追加できるtodoリストを作成する。
 *チェック方式
 *入力欄:追加
 *ーーーーーー
 *データ表示していく。
 *変更と削除ができるボタンを配置していく
 * 
 * 
 * 
 * 
 * */
$tasks = array();
$rs = mysql_query("select * from tasks where type != 'deleted' order by seq");
while($row = mysql_fetch_assoc($rs)){
	array_push($tasks,$row);
}
//var_dump($tasks);
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			Todo管理
		</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<link href="../../css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	<h2>入力ボタン</h2>
	<p><input type="text" name="title" id="title"> <input type="button" value="追加" id="addTask"></p>
        <ul id="tasks">
        <?php foreach ($tasks as $task) : ?>
        <li id="task_<?php echo($task['id'])?>"><?php echo h($task['title']); ?>　　<span class="deleteTask">[delete]</span>
        <span class="editTask">[edit]</span></li>
        <?php endforeach; ?>
        </ul>
	
	<script>
		$(function() {
			 $('#addTask').click(function() {
                 var title = $('#title').val();
                 $.post('_ajax_add_task.php', {
                     title: title
                 }, function(rs) {
                     // li要素としてtitleを追加
                     $('#tasks').append($('<li></li>').text(title));
                     // フォームを空にする
                     $('#title').val('');
                 });
             });
			$('.deleteTask').live('click',function(){
				if(confirm('are you sure?')) {
					var id =$(this).parent().attr('id').replace('task_','');
					$.post('_ajax_delete_task.php',{
						//params
						id:id
					},function(rs){
						//
						$('#task_'+id).fadeOut();
					});
				}
			});
			$('.editTask').live('click',function(){
				var id =$(this).parent().attr('id').replace('task_','');
				$('#task_'+id).empty().append('<input type="text"> <input type="button" value="更新" class="updatedTask">');
			});
	});
	</script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>