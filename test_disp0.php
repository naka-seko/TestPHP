<?php
function input_nenrei() {
    // 年齢は0～120歳までとする
    $min_age = 0;
    $max_age = 120;

    while (true) {
        echo "年齢はいくつですか？($min_age ～ $max_age) ";
        $in_age = trim(fgets(STDIN));
        if (!is_numeric($in_age) || intval($in_age) != $in_age) {
            echo "数字（整数）を入れて下さい。\n";
            continue;
        }

        // 年齢の範囲チェック
        $in_age = intval($in_age);
        if ($in_age < $min_age || $in_age > $max_age) {
            continue;
        } else {
            return $in_age;
        }
    }
}

function input_height() {
    // 身長は100cm～300cmまでとする
    // 小数点以下は1桁までとする
    $min_height = 100.0;
    $max_height = 300.0;

    while (true) {
        echo "身長は何センチ？($min_height ～ $max_height) ";
        $in_height = trim(fgets(STDIN));
        if (!is_numeric($in_height)) {
            echo "数字（小数点１桁迄）を入れて下さい。\n";
            continue;
        }
        // 身長の範囲チェック
        // 小数点以下は1桁までとする
        $in_height = floatval($in_height);
        if ($in_height < $min_height || $in_height > $max_height) {
            continue;
        } else {
            return $in_height;
        }
    }
}

// ここでは、年齢10歳以上、身長110cm以上とする
$min_age = 10;
$min_height = 110.0;

// 年齢と身長を入れる
$age = input_nenrei();
$height = input_height();

// 判定処理
if ($min_age <= $age && $min_height <= $height) {
    echo "お乗りいただけます\n";
} else {
    echo "ご遠慮ください\n";
}
?>