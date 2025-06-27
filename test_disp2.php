<?php
// 辞書オブジェクト Test Source
// jisyo_get関数
function jisyo_get($f_name) {
    // ファイルが存在するか確認
    if (file_exists($f_name)) {
        // ファイルを１行ずつ読み込んで英和辞書を作成
        $lines = file($f_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // key:valueの形式で1行ずつ格納
            list($key, $value) = explode(':', $line, 2);
            $english_words[trim($key)] = trim($value);
        }

    } else {
        echo "ファイルが存在しません: $f_name" . PHP_EOL;
        exit;
    }
    return $english_words;
}

// jisyo_put関数
function jisyo_put($f_name) {
    global $english_words; // グローバル変数を使用

    // ファイルを開く（書き込みモード）
    $file = fopen($f_name, "w");
    if ($file === false) {
        echo "ファイルを開くことができませんでした。" . PHP_EOL;
        exit;
    }
    // 配列の各要素を1行ずつ書き込む
    $list = array_keys($english_words); // 辞書のキーを取得
    foreach ($list as $item) {
        // 書き込み形式は "key:value" とする
        $item = $item . ':' . $english_words[$item];
        // ファイルに書き込む
        fwrite($file, $item . PHP_EOL);
        echo $item . " を書き込みました。" . PHP_EOL;
    }

    // ファイルを閉じる
    fclose($file);
    echo "書き出しが完了しました。". PHP_EOL;
}

// 英和辞書を表示する関数
function disp_english_words($english_words) {
    echo count($english_words) . PHP_EOL;

    foreach ($english_words as $english => $dic_word) {
        echo $english . " : " . $dic_word . PHP_EOL;
    }
}

// メイン
$filename = 'jisyo_fruit.txt'; // 読み書きファイル名
$english_words = []; // 英和辞書を格納する配列

jisyo_get($filename); // 英和辞書を取得
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

jisyo_put($filename); // 英和辞書を書き込み

?>