<?php
// ループ(while) Test Source
$text = "";
$end_text = "finish";

while ($text !== $end_text) {
    // 文字を入力する
    echo $end_text . "と入力してください:";
    $text = readline();

    echo $text . " と入力されました。" . PHP_EOL;
}

echo "終了しました。" . PHP_EOL;

// 辞書オブジェクト Test Source
function disp_english_words($english_words) {
    echo count($english_words) . PHP_EOL;

    foreach ($english_words as $english => $dic_word) {
        echo $english . " : " . $dic_word . PHP_EOL;
    }
}

// 辞書オブジェクトメイン
$filename = 'jisyo_fruit.txt'; // 読み込むファイル名
$english_words = []; // 英和辞書を格納する配列

// ファイルが存在するか確認
if (file_exists($filename)) {
    // ファイルを１行ずつ読み込んで英和辞書を作成
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // key:valueの形式で1行ずつ格納
        list($key, $value) = explode(':', $line, 2);
        $english_words[trim($key)] = trim($value);
    }

} else {
    echo "ファイルが存在しません: $filename" . PHP_EOL;
}
disp_english_words($english_words);

// 英和辞書を追加
$english_words["banana"] = "バナナ";
disp_english_words($english_words);

// 英和辞書を置換
$english_words["banana"] = "スイートバナナ";
disp_english_words($english_words);

// 英和辞書を削除
unset($english_words["orange"]);
disp_english_words($english_words);

// 該当英和辞書を出力
echo "英単語を入力してください：";
$key = readline();

if (array_key_exists($key, $english_words)) {
    echo "日本語：" . $english_words[$key] . PHP_EOL;
} else {
    echo "その英単語に対する辞書は有りません。" . PHP_EOL;
}
?>