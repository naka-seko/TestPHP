<?php
// グローバル変数
$values = []; // 配列の初期化
$end_kensu = 9999; // 件数9999は特別な終了コード
$max_index = 6; // 最大日付数(7日)

// 日付毎の人数を入れる
function input_daily_kensu($max_idx) {
    global $end_kensu; // グローバル変数を使用
    global $values; // グローバル変数を使用

    $index = 0;
    while ($index <= $max_idx) {
        // 日付毎の入力を促す
        echo ($index + 1) . "日目は何件ですか？(終了=$end_kensu)\n";
        $in_kensu = input_kensu();

        /* 終了コード入力時、終了する
            件数が０件の場合、リストオブジェクト０にして終了する
        */
        if ($in_kensu == $end_kensu) {
            if ($index == 0) {
                $values = [0];
            }
            break;
        }
        // 入力数字を配列にセットして次へ
        $values[$index] = $in_kensu;
        $index++;
    }
    // 配列を返す
    return $values;
}

        // 人数を入れる(0～9999)
function input_kensu() {
    global $end_kensu; // グローバル変数を使用

    while (true) {
        // 件数を入力して、数字以外なら再入力
        $in_kensu = readline();
        if (!is_numeric($in_kensu) || strpos($in_kensu, ".") !== false) {
            echo "数字（整数）を入れて下さい。\n";
            continue;
        }
        // 件数を入力して、範囲外なら再入力。範囲内なら返す
        $in_kensu = (int)$in_kensu;
        if ($in_kensu < 0 || $in_kensu > $end_kensu) {
            echo "0～$end_kensu の数字を入れて下さい。\n";
            continue;
        } else {
            return $in_kensu;
        }
    }
}

// 合計値, 平均値, 件数の算出
function total_and_average_and_number($values) {
    // 合計値を算出する
    $total = array_sum($values);

    // 平均値, 件数を算出する
    $num = count($values);
    $average = $num > 0 ? $total / $num : 0;

    // 合計値, 平均値, 件数を返す
    return [$total, $average, $num];
}

// メインルーチン
// 日付毎の人数を入れる
$values = input_daily_kensu($max_index);

// 合計値, 平均値, 件数関数を呼び出し、出力
list($total, $average, $number) = total_and_average_and_number($values);
echo "[" . implode(", ", $values) . "] の 合計は $total 平均は $average 件数は $number です。\n";

?>