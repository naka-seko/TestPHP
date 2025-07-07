<?php
// グローバル変数
$filename = 'jinji_data.txt'; // 人事データファイル名

$jinji_data = []; // 人事データを格納する配列
$lines = []; // ファイルの行を格納する配列

$min_nenrei = 20; // 最小年齢
$max_nenrei = 35; // 最大年齢

// 人事データ読込関数
function jinji_data_get($f_name) {
    global $jinji_data; // グローバル変数を使用
    global $lines; // グローバル変数を使用

    // ファイルが存在するか確認
    if (file_exists($f_name)) {
        // ファイルを１行ずつ読み込んで人事データを作成
        $lines = file($f_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        jinji_data_set($lines);
    } else {
        echo "ファイルが存在しません: $f_name" . PHP_EOL;
        exit;
    }
    return $jinji_data;
}
// 人事データを配列にセットする関数
function jinji_data_set($lines) {
    global $jinji_data; // グローバル変数を使用

    foreach ($lines as $line) {
        // valueの形式で1行ずつ格納
        list($value1, $value2, $value3) = explode(',', $line, 3);
        $jinji_data[] = [
            '名前' => trim($value1),
            '年齢' => (int)trim($value2),
            '職業' => trim($value3)
        ];
    }
    return $jinji_data;
}
// 年齢を入力する関数
function input_nenrei() {
    global $min_nenrei; // グローバル変数を使用
    global $max_nenrei; // グローバル変数を使用

    // 年齢の入力を繰り返す
    while (true) {
        // 対象年齢の入力を促す
        echo "対象年齢（ $min_nenrei ～ $max_nenrei ）以上は？";
        $handle = fopen ("php://stdin","r");
        $in_nenrei = trim(fgets($handle));
        fclose($handle);

        if (!is_numeric($in_nenrei) || intval($in_nenrei) != $in_nenrei) {
            echo "数字（整数）を入れて下さい。\n";
            continue;
        }
        // 年齢の範囲チェック
        $in_nenrei = intval($in_nenrei);
        if ($in_nenrei < $min_nenrei || $in_nenrei > $max_nenrei) {
            continue;
        } else {
            return $in_nenrei;
        }
    }
}
// メイン

jinji_data_get($filename); // 人事データ読込＆配列セット
echo "人事データを読み込みました。\n";

// 年齢が入力年齢以上の人を抽出
$m_nenrei = input_nenrei();
$older_than = array_filter($jinji_data, function($row) use ($m_nenrei) {
    return (int)$row['年齢'] >= $m_nenrei;
});

// 結果を表示
if (empty($older_than)) {
    echo "該当データなし\n";
} else {
    foreach ($older_than as $row) {
        echo "名前:{$row['名前']},年齢:{$row['年齢']},職業:{$row['職業']}\n";
    }
}
// 終了メッセージ
echo "終了します。\n";

?>