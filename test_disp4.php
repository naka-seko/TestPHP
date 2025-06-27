<?php
// ループ(while)
$text = "";
$end_text = "finish";

while ($text !== $end_text) {
    // 文字を入力する
    echo $end_text . "と入力してください:";
    $text = readline();

    echo $text . " と入力されました。" . PHP_EOL;
}
echo "終了しました。" . PHP_EOL;

// リストオブジェクト anc --> ABC
$list_obj = ["apple", "orange", "banana"];
foreach ($list_obj as $fruit_name) {
    $upper_name = strtoupper($fruit_name);
    echo $upper_name . PHP_EOL;
}

// タプルオブジェクト anc --> ABC
// PHPにはタプルはありませんが、配列で代用します
$tuple_obj = ["apple", "orange", "banana"];
foreach ($tuple_obj as $fruit_name) {
    $upper_name = strtoupper($fruit_name);
    echo $upper_name . PHP_EOL;
}

// 文字列オブジェクト hello --> HELLO
$str_obj = "hello";
for ($i = 0; $i < strlen($str_obj); $i++) {
    $upper_letter = strtoupper($str_obj[$i]);
    echo $upper_letter . PHP_EOL;
}

?>