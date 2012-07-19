<?php
/*
 *クライアント側用のcsvデータダウンロードのサンプルコード。
 * DBのデータを書き出すためには、$dataの部分を書き換える必要があり。
 * リンク乗っけて、張りつけしたらok?
 * */
// CSVファイル名の設定

$csv_file = "test.csv";

// CSVデータの初期化
$csv_data = "";

// CSVに書き出すデータ
$data[0] = array("月曜日","Monday");
$data[1] = array("火曜日", "Tuesday");
$data[2] = array("水曜日", "Wednesday");
$data[3] = array("木曜日", "Thursday");
$data[4] = array("金曜日", "Friday");
$data[5] = array("土曜日", "Saturday");
$data[6] = array("日曜日", "Sunday");

// CSVデータの作成
foreach($data as $key => $value ){
	/*$data = 0~6 7ko
	 * $value[0]とか[1]とかは = arrayの中身ね。
	 * $
	 * 
	 * */
	$csv_data .= $key. ",";
	$csv_data .= $value[0]. ",";
	$csv_data .= $value[1];
	//0,月曜日,Mondayみたいな感じになろよ〜。
	
	if(count($data) !== intval($key)+1){
		
		$csv_data .= "\n";
		//$dataの個数がキーと一致するまで、最後に改行をいれま。
	}
	//ループするよー
}

// MIMEタイプの設定//exe//
header("Content-Type: application/octet-stream");

// ファイル名の表示
header("Content-Disposition: attachment; filename=$csv_file");

// データの出力
echo($csv_data);
//多分これで要件を満たしてるはず！
?>

