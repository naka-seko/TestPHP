<?php
$filename = 'jisyo_fruit.txt'; // 読み書きファイル名
$english_words = []; // 英和辞書を格納する配列

// jisyo_get関数
function jisyo_get($f_name) {
    global $english_words; // グローバル変数を使用

    // ファイルが存在するか確認
    if (file_exists($f_name)) {
        // ファイルを１行ずつ読み込んで英和辞書を作成
        $lines = file($f_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // key:valueの形式で1行ずつ格納
            list($key, $value) = explode(',', $line, 2);
            $english_words[trim($key)] = trim($value);
        }

    } else {
        echo "ファイルが存在しません: $f_name" . PHP_EOL;
        exit;
    }

    return $english_words; // 配列を返す
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
        $item = $item . ',' . $english_words[$item];
        // ファイルに書き込む
        fwrite($file, $item . PHP_EOL);
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

// 英和辞書を追加又は更新する関数
function jisyo_henko($english_words) {

    // 入力メッセージ出力
    echo "追加、又は更新する英単語を入力して下さい：" . PHP_EOL;
    $key = trim(readline());
    echo "続けて、日本語を入力して下さい：" . PHP_EOL;
    $value = trim(readline());

    // 更新又は追加処理（英単語の有無により）
    if (array_key_exists($key, $english_words)) {
        echo $key . "を更新します。" . PHP_EOL;
        $english_words[$key] = $value;
    } else {
        echo $key . "を追加します。" . PHP_EOL;
        $english_words[$key] = $value;
    }

    return $english_words; // 配列を返す
}

//
function jisyo_del($english_words) {
    //
    echo "削除英単語を入力して下さい：" . PHP_EOL;
    $key = trim(readline());

    //
    if (array_key_exists($key, $english_words)) {
        echo $key . "を削除します。" . PHP_EOL;
        unset($english_words[$key]);
    } else {
        echo "その英単語に対する辞書は有りません。" . PHP_EOL;
    }

    return $english_words; // 配列を返す
}

// 該当英和辞書を出力する関数
function jisyo_disp($english_words) {

    // 該当英単語入力
    echo "英単語を入力して下さい：";
    $key = readline();

    // 出力判定
    if (array_key_exists($key, $english_words)) {
        echo "日本語：" . $english_words[$key] . PHP_EOL;
    } else {
        echo "その英単語に対する辞書は有りません。" . PHP_EOL;
    }
}

// メイン
$english_words = jisyo_get($filename); // 英和辞書を取得
disp_english_words($english_words);

$english_words = jisyo_henko($english_words); // 英和辞書を追加又は更新
disp_english_words($english_words);

$english_words = jisyo_del($english_words); // 英和辞書を削除
disp_english_words($english_words);

jisyo_disp($english_words); // 該当辞書を表示

jisyo_put($filename); // 英和辞書を書き込み

?>